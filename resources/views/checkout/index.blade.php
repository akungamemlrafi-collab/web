@extends('layouts.app')

@section('title', __('Checkout'))

@section('content')
<div class="container mx-auto px-4 py-12">
    <h1 class="text-4xl font-serif font-bold mb-8">{{ __('Checkout') }}</h1>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Checkout Form -->
        <div class="lg:col-span-2">
            <form action="{{ route('checkout.store') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Personal Information -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-bold mb-4">{{ __('Personal Information') }}</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold mb-2">{{ __('Full Name') }} *</label>
                            <input type="text" name="customer_name" required class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-maroon-900">
                        </div>
                        <div>
                            <label class="block text-sm font-bold mb-2">{{ __('Email') }} *</label>
                            <input type="email" name="customer_email" required class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-maroon-900">
                        </div>
                        <div class="col-span-2">
                            <label class="block text-sm font-bold mb-2">{{ __('Phone Number') }} *</label>
                            <input type="tel" name="customer_phone" required class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-maroon-900">
                        </div>
                    </div>
                </div>
                
                <!-- Shipping Address -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-bold mb-4">{{ __('Shipping Address') }}</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-bold mb-2">{{ __('Address') }} *</label>
                            <textarea name="address" rows="3" required class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-maroon-900"></textarea>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-bold mb-2">{{ __('City') }} *</label>
                                <input type="text" name="city" required class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-maroon-900">
                            </div>
                            <div>
                                <label class="block text-sm font-bold mb-2">{{ __('Postal Code') }} *</label>
                                <input type="text" name="postal_code" required class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-maroon-900">
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Shipping Method -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-bold mb-4">{{ __('Shipping Method') }}</h3>
                    <div class="space-y-3">
                        <label class="flex items-center p-3 border border-gray-300 rounded cursor-pointer hover:bg-gray-50">
                            <input type="radio" name="shipping" value="domestic" required class="mr-3" checked>
                            <span class="font-bold">{{ __('Domestic Shipping') }}</span>
                        </label>
                        <label class="flex items-center p-3 border border-gray-300 rounded cursor-pointer hover:bg-gray-50">
                            <input type="radio" name="shipping" value="international" required class="mr-3">
                            <span class="font-bold">{{ __('International Shipping') }}</span>
                        </label>
                    </div>
                </div>
                
                <button type="submit" class="w-full bg-maroon-900 hover:bg-maroon-800 text-white font-bold py-3 rounded">
                    {{ __('Continue to Payment') }}
                </button>
            </form>
        </div>
        
        <!-- Order Summary -->
        <div>
            <div class="bg-gray-50 rounded-lg p-6 sticky top-4">
                <h3 class="text-lg font-bold mb-4">{{ __('Order Summary') }}</h3>
                <div class="space-y-3 mb-6 pb-6 border-b border-gray-200">
                    <div class="flex justify-between">
                        <span>{{ __('Items') }}:</span>
                        <span class="font-bold">0</span>
                    </div>
                    <div class="flex justify-between">
                        <span>{{ __('Subtotal') }}:</span>
                        <span class="font-bold">Rp 0</span>
                    </div>
                </div>
                <div class="flex justify-between text-lg font-bold">
                    <span>{{ __('Total') }}:</span>
                    <span>Rp 0</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
