<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Services\PaymentService;
use App\Services\MidtransService;
use App\Services\StripeService;
use App\Services\ShippingService;
use Illuminate\ Validation\ValidationException;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Show checkout form
     */
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('products.index')
                ->with('warning', 'Your cart is empty');
        }

        $shippingService = new ShippingService();
        $provinces = $shippingService->getProvinces();

        return view('checkout.index', [
            'cart' => $cart,
            'provinces' => $provinces['data'] ?? [],
        ]);
    }

    /**
     * Store checkout order
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|string',
            'shipping_address' => 'required|string',
            'city_id' => 'required|integer',
            'province_id' => 'required|integer',
            'postal_code' => 'required|string',
            'shipping_method' => 'required|string',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Cart is empty');
        }

        try {
            // Calculate totals
            $subtotal = collect($cart)->sum(function ($item) {
                return $item['price'] * $item['quantity'];
            });

            // Create order
            $order = Order::create([
                'order_number' => Order::generateOrderNumber(),
                'status' => Order::STATUS_PENDING,
                'payment_status' => Order::PAYMENT_STATUS_UNPAID,
                'subtotal' => $subtotal,
                'shipping_cost' => $request->shipping_cost ?? 0,
                'tax' => 0,
                'total_amount' => $subtotal + ($request->shipping_cost ?? 0),
                'currency' => app()->getLocale() === 'en' ? 'USD' : 'IDR',
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
                'shipping_address' => [
                    'address' => $request->shipping_address,
                    'city_id' => $request->city_id,
                    'province_id' => $request->province_id,
                    'postal_code' => $request->postal_code,
                ],
                'shipping_method' => $request->shipping_method,
            ]);

            // Create order items
            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'product_name' => $item['name'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['price'],
                    'subtotal' => $item['price'] * $item['quantity'],
                ]);
            }

            // Clear cart
            session()->forget('cart');

            // Redirect to payment
            return redirect()->route('payment.show', $order->id);
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to create order: ' . $e->getMessage());
        }
    }

    /**
     * Get cities by province (API)
     */
    public function getCities(Request $request)
    {
        $shippingService = new ShippingService();
        $result = $shippingService->getCities($request->province_id);

        return response()->json($result);
    }
}
