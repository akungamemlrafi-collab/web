<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\MidtransService;
use App\Services\StripeService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Show payment page
     */
    public function show(Order $order)
    {
        if ($order->payment_status !== Order::PAYMENT_STATUS_UNPAID) {
            return redirect()->route('orders.show', $order)
                ->with('info', 'This order has already been paid');
        }

        $paymentService = $this->getPaymentService($order);
        $result = $paymentService->setOrder($order)->processPayment();

        if (!$result['success']) {
            return back()->with('error', $result['error'] ?? 'Payment processing failed');
        }

        return view('payment.show', [
            'order' => $order,
            'paymentData' => $result,
        ]);
    }

    /**
     * Handle payment callback (Midtrans)
     */
    public function callback(Request $request)
    {
        // Verify callback from Midtrans
        $midtransService = new MidtransService();
        $result = $midtransService->verifyPayment($request->input('transaction_id'));

        if ($result['success']) {
            $order = Order::where('order_number', $result['order_id'])->firstOrFail();
            
            if ($result['status'] === 'completed') {
                $order->update([
                    'payment_status' => Order::PAYMENT_STATUS_PAID,
                    'status' => Order::STATUS_PROCESSING,
                    'paid_at' => now(),
                ]);
            }
        }

        return response()->json(['success' => $result['success']]);
    }

    /**
     * Handle Stripe webhook
     */
    public function stripeWebhook(Request $request)
    {
        $event = $request->input('type');

        if ($event === 'payment_intent.succeeded') {
            $paymentIntentId = $request->input('data.object.id');
            $orderId = $request->input('data.object.metadata.order_id');

            $order = Order::findOrFail($orderId);
            $order->update([
                'payment_status' => Order::PAYMENT_STATUS_PAID,
                'status' => Order::STATUS_PROCESSING,
                'paid_at' => now(),
            ]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Get appropriate payment service based on order currency
     */
    private function getPaymentService(Order $order): object
    {
        if ($order->currency === 'IDR') {
            return new MidtransService();
        } else {
            return new StripeService();
        }
    }
}
