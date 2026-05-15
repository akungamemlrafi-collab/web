@component('mail::message')
# {{ __('Order Confirmation') }}

{{ __('Hello') }} {{ $order->customer_name }},

{{ __('Thank you for your order! We\'ve received your purchase and are preparing your items.') }}

@component('mail::table')
| {{ __('Product') }} | {{ __('Quantity') }} | {{ __('Price') }} | {{ __('Subtotal') }} |
| --- | --- | --- | --- |
@foreach($items as $item)
| {{ $item->product->name }} | {{ $item->quantity }} | Rp {{ number_format($item->unit_price, 0, ',', '.') }} | Rp {{ number_format($item->subtotal, 0, ',', '.') }} |
@endforeach
@endcomponent

**{{ __('Order Details') }}:**
- {{ __('Order ID') }}: #{{ $order->id }}
- {{ __('Total Amount') }}: Rp {{ number_format($order->total_amount, 0, ',', '.') }}
- {{ __('Status') }}: {{ __('Pending Payment') }}
- {{ __('Date') }}: {{ $order->created_at->format('d F Y H:i') }}

@component('mail::button', ['url' => route('checkout.payment', $order->id)])
{{ __('View Order') }}
@endcomponent

{{ __('If you have any questions, please contact us at info@corestone.id') }}

{{ __('Best regards') }},
CoreStone Indonesia
@endcomponent
