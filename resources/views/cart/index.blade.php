@extends('layouts.app')

@section('title', __('Shopping Cart'))

@section('content')
<div class="container mx-auto px-4 py-12">
    <h1 class="text-4xl font-serif font-bold mb-8">{{ __('Shopping Cart') }}</h1>
    
    @if($cart_items && count($cart_items) > 0)
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Cart Items -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow">
                @foreach($cart_items as $item)
                <div class="p-6 border-b border-gray-200 flex justify-between items-center hover:bg-gray-50">
                    <div class="flex-1">
                        <h3 class="font-bold text-lg">{{ $item['product']->name }}</h3>
                        <p class="text-gray-600 text-sm">{{ __('Qty') }}: {{ $item['quantity'] }}</p>
                        <p class="text-maroon-900 font-bold">
                            @if(app()->getLocale() === 'id')
                                Rp {{ number_format($item['product']->price_idr, 0, ',', '.') }}
                            @else
                                \$ {{ number_format($item['product']->price_usd, 2) }}
                            @endif
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="font-bold mb-2">
                            @if(app()->getLocale() === 'id')
                                Rp {{ number_format($item['product']->price_idr * $item['quantity'], 0, ',', '.') }}
                            @else
                                \$ {{ number_format($item['product']->price_usd * $item['quantity'], 2) }}
                            @endif
                        </p>
                        <form action="{{ route('cart.remove', $item['product']->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:text-red-800 text-sm font-bold">{{ __('Remove') }}</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
        <!-- Cart Summary -->
        <div>
            <div class="bg-gray-50 rounded-lg p-6 sticky top-4">
                <h3 class="text-lg font-bold mb-4">{{ __('Order Summary') }}</h3>
                
                <div class="space-y-3 mb-6 pb-6 border-b border-gray-200">
                    <div class="flex justify-between">
                        <span>{{ __('Subtotal') }}:</span>
                        <span class="font-bold">Rp 0</span>
                    </div>
                    <div class="flex justify-between">
                        <span>{{ __('Shipping') }}:</span>
                        <span class="font-bold">{{ __('Calculated at checkout') }}</span>
                    </div>
                </div>
                
                <div class="flex justify-between mb-6 text-lg font-bold">
                    <span>{{ __('Total') }}:</span>
                    <span>Rp 0</span>
                </div>
                
                <a href="{{ route('checkout.index') }}" class="w-full bg-maroon-900 hover:bg-maroon-800 text-white font-bold py-3 rounded block text-center mb-3">
                    {{ __('Proceed to Checkout') }}
                </a>
                <a href="{{ route('products.index') }}" class="w-full border border-maroon-900 text-maroon-900 hover:bg-maroon-50 font-bold py-3 rounded block text-center">
                    {{ __('Continue Shopping') }}
                </a>
            </div>
        </div>
    </div>
    @else
    <div class="text-center py-12">
        <p class="text-xl text-gray-600 mb-6">{{ __('Your cart is empty') }}</p>
        <a href="{{ route('products.index') }}" class="bg-maroon-900 hover:bg-maroon-800 text-white font-bold py-3 px-8 rounded">
            {{ __('Start Shopping') }}
        </a>
    </div>
    @endif
</div>
@endsection
