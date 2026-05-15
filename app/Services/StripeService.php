<?php

namespace App\Services;

use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class StripeService extends PaymentService
{
    public function __construct()
    {
        parent::__construct();
        Stripe::setApiKey(config('payment.stripe.secret_key'));
    }

    /**
     * Process payment - Create Payment Intent
     */
    public function processPayment(): array
    {
        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => $this->formatAmount($this->order->total_amount * 100),
                'currency' => strtolower($this->order->currency),
                'metadata' => [
                    'order_id' => $this->order->id,
                    'order_number' => $this->order->order_number,
                ],
                'description' => "Order {$this->order->order_number}",
            ]);

            return [
                'success' => true,
                'client_secret' => $paymentIntent->client_secret,
                'payment_intent_id' => $paymentIntent->id,
            ];
        } catch (ApiErrorException $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Verify payment status
     */
    public function verifyPayment(string $paymentIntentId): array
    {
        try {
            $paymentIntent = PaymentIntent::retrieve($paymentIntentId);

            return [
                'success' => true,
                'status' => $this->mapPaymentIntentStatus($paymentIntent->status),
                'payment_intent_id' => $paymentIntent->id,
                'charge_id' => $paymentIntent->charges->data[0]->id ?? null,
            ];
        } catch (ApiErrorException $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Generate payment token (client secret for Stripe)
     */
    public function generateToken(): string
    {
        $result = $this->processPayment();
        return $result['success'] ? $result['client_secret'] : '';
    }

    /**
     * Map Stripe payment intent status to our status
     */
    private function mapPaymentIntentStatus(string $stripeStatus): string
    {
        return match ($stripeStatus) {
            'succeeded' => 'completed',
            'processing' => 'processing',
            'requires_payment_method', 'requires_confirmation', 'requires_action' => 'pending',
            'canceled' => 'cancelled',
            default => 'unknown',
        };
    }
}
