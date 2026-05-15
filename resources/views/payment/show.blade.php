@extends('layouts.app')

@section('title', __('Payment'))

@section('content')
<div class="container mx-auto px-4 py-12">
    <h1 class="text-4xl font-serif font-bold mb-8">{{ __('Complete Your Payment') }}</h1>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Payment Method -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h3 class="text-lg font-bold mb-4">{{ __('Select Payment Method') }}</h3>
                <div class="space-y-4">
                    @if(app()->getLocale() === 'id')
                    <label class="flex items-center p-4 border-2 border-gray-300 rounded cursor-pointer hover:border-maroon-900">
                        <input type="radio" name="payment_method" value="midtrans" required class="mr-3" checked>
                        <div>
                            <span class="font-bold block">💳 Midtrans (IDR)</span>
                            <span class="text-sm text-gray-600">Kartu Kredit, Bank Transfer, E-wallet</span>
                        </div>
                    </label>
                    @endif
                    
                    <label class="flex items-center p-4 border-2 border-gray-300 rounded cursor-pointer hover:border-maroon-900">
                        <input type="radio" name="payment_method" value="stripe" required class="mr-3">
                        <div>
                            <span class="font-bold block">💳 Stripe (USD)</span>
                            <span class="text-sm text-gray-600">Credit/Debit Card, Apple Pay, Google Pay</span>
                        </div>
                    </label>
                    
                    <label class="flex items-center p-4 border-2 border-gray-300 rounded cursor-pointer hover:border-maroon-900">
                        <input type="radio" name="payment_method" value="paypal" required class="mr-3">
                        <div>
                            <span class="font-bold block">🔵 PayPal</span>
                            <span class="text-sm text-gray-600">Secure payment via PayPal</span>
                        </div>
                    </label>
                </div>
            </div>
            
            <!-- Terms -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                <label class="flex items-start">
                    <input type="checkbox" required class="mt-1 mr-3">
                    <span class="text-sm">{{ __('I agree to the terms and conditions') }}</span>
                </label>
            </div>
            
            <form action="{{ route('payment.process') }}" method="POST" id="paymentForm">
                @csrf
                <input type="hidden" name="order_id" value="{{ $order->id }}">
                <button type="submit" class="w-full bg-maroon-900 hover:bg-maroon-800 text-white font-bold py-3 rounded text-lg">
                    {{ __('Pay Now') }}
                </button>
            </form>
        </div>
        
        <!-- Order Summary -->
        <div>
            <div class="bg-gray-50 rounded-lg p-6 sticky top-4">
                <h3 class="text-lg font-bold mb-4">{{ __('Order Details') }}</h3>
                
                <div class="space-y-4 mb-6 pb-6 border-b border-gray-200">
                    <div>
                        <p class="text-sm text-gray-600">{{ __('Order #') }}{{ $order->id }}</p>
                        <p class="font-bold">{{ date('d M Y', strtotime($order->created_at)) }}</p>
                    </div>
                    
                    @foreach($order->items as $item)
                    <div class="flex justify-between text-sm">
                        <span>{{ $item->product->name }} x{{ $item->quantity }}</span>
                        <span>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                    </div>
                    @endforeach
                </div>
                
                <div class="space-y-2 mb-6">
                    <div class="flex justify-between text-sm">
                        <span>{{ __('Subtotal') }}:</span>
                        <span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span>{{ __('Shipping') }}:</span>
                        <span>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                    </div>
                </div>
                
                <div class="flex justify-between text-lg font-bold border-t border-gray-300 pt-4">
                    <span>{{ __('Total') }}:</span>
                    <span>
                        @if($order->currency === 'IDR')
                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                        @else
                            \$ {{ number_format($order->total_amount, 2) }}
                        @endif
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
