<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;
use Exception;

class MidtransService extends PaymentService
{
    public function __construct()
    {
        parent::__construct();
        $this->initializeMidtrans();
    }

    /**
     * Initialize Midtrans configuration
     */
    private function initializeMidtrans(): void
    {
        Config::$serverKey = config('payment.midtrans.server_key');
        Config::$clientKey = config('payment.midtrans.client_key');
        Config::$isProduction = config('payment.midtrans.environment') === 'production';
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    /**
     * Process payment - Generate Snap token
     */
    public function processPayment(): array
    {
        try {
            $snapToken = $this->generateToken();

            return [
                'success' => true,
                'token' => $snapToken,
                'redirect_url' => "https://app.sandbox.midtrans.com/snap/v2/vtweb/{$snapToken}",
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Verify payment status
     */
    public function verifyPayment(string $transactionId): array
    {
        try {
            $status = Transaction::status($transactionId);

            return [
                'success' => true,
                'status' => $this->mapTransactionStatus($status->transaction_status),
                'transaction_id' => $status->transaction_id,
                'order_id' => $status->order_id,
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Generate payment token
     */
    public function generateToken(): string
    {
        $transactionDetails = [
            'order_id' => $this->order->order_number,
            'gross_amount' => $this->formatAmount($this->order->total_amount),
        ];

        $itemDetails = $this->getItemDetails();
        $customerDetails = $this->getCustomerData();

        $payload = [
            'transaction_details' => $transactionDetails,
            'item_details' => $itemDetails,
            'customer_details' => $customerDetails,
            'callbacks' => [
                'finish' => route('payment.callback'),
                'error' => route('payment.error'),
                'pending' => route('payment.pending'),
            ],
        ];

        return Snap::getSnapToken($payload);
    }

    /**
     * Map Midtrans transaction status to our status
     */
    private function mapTransactionStatus(string $midtransStatus): string
    {
        return match ($midtransStatus) {
            'capture', 'settlement' => 'completed',
            'pending' => 'pending',
            'deny', 'cancel', 'expire' => 'failed',
            default => 'unknown',
        };
    }
}
