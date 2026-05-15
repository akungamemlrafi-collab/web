<?php

namespace App\Services;

use App\Models\Order;

abstract class PaymentService
{
    protected Order $order;
    protected array $config;

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    /**
     * Set order for payment
     */
    public function setOrder(Order $order): self
    {
        $this->order = $order;
        return $this;
    }

    /**
     * Process payment - to be implemented by subclasses
     */
    abstract public function processPayment(): array;

    /**
     * Verify payment - to be implemented by subclasses
     */
    abstract public function verifyPayment(string $transactionId): array;

    /**
     * Generate payment token - to be implemented by subclasses
     */
    abstract public function generateToken(): string;

    /**
     * Format currency for payment gateway
     */
    protected function formatAmount(float $amount): int
    {
        return (int) round($amount);
    }

    /**
     * Get customer data
     */
    protected function getCustomerData(): array
    {
        return [
            'name' => $this->order->customer_name,
            'email' => $this->order->customer_email,
            'phone' => $this->order->customer_phone,
        ];
    }

    /**
     * Get item details for payment
     */
    protected function getItemDetails(): array
    {
        $items = [];
        
        foreach ($this->order->items as $item) {
            $items[] = [
                'id' => $item->product_sku,
                'price' => (int) $item->unit_price,
                'quantity' => $item->quantity,
                'name' => $item->product_name,
            ];
        }

        return $items;
    }
}
