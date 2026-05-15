@component('mail::message')
# {{ __('Payment Receipt') }}

{{ __('Hello') }} {{ $order->customer_name }},

{{ __('Your payment has been successfully received! Here is your receipt.') }}

**{{ __('Order Information') }}:**
- {{ __('Order ID') }}: #{{ $order->id }}
- {{ __('Payment Status') }}: <span style="color: green; font-weight: bold;">{{ __('PAID') }}</span>
- {{ __('Payment Method') }}: {{ ucfirst($order->payment_method) }}
- {{ __('Date') }}: {{ $order->paid_at->format('d F Y H:i') }}

**{{ __('Order Summary') }}:**
- {{ __('Subtotal') }}: Rp {{ number_format($order->subtotal, 0, ',', '.') }}
- {{ __('Shipping') }}: Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}
- **{{ __('Total') }}: Rp {{ number_format($order->total_amount, 0, ',', '.') }}**

**{{ __('Shipping Address') }}:**
{{ $order->customer_name }}
{{ $order->shipping_address }}

@component('mail::button', ['url' => route('checkout.tracking', $order->id)])
{{ __('Track Your Order') }}
@endcomponent

{{ __('Thank you for your purchase!') }}

{{ __('Best regards') }},
CoreStone Indonesia
@endcomponent
