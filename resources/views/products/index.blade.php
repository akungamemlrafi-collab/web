@extends('layouts.app')

@section('title', __('Products'))

@section('content')
<div class="container mx-auto px-4 py-12">
    <h1 class="text-4xl font-serif font-bold mb-8">{{ __('Our Products') }}</h1>
    
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Sidebar Filter -->
        <div class="lg:col-span-1">
            <div class="bg-gray-50 p-6 rounded-lg">
                <h3 class="text-lg font-bold mb-4">{{ __('Filter') }}</h3>
                
                <div class="mb-6">
                    <h4 class="font-bold text-sm mb-3">{{ __('Category') }}</h4>
                    <form method="GET" action="{{ route('products.index') }}">
                        @foreach($categories as $cat)
                        <label class="flex items-center mb-2">
                            <input type="checkbox" name="category[]" value="{{ $cat->slug }}" 
                                @if(in_array($cat->slug, request('category', []))) checked @endif
                                class="mr-2" onchange="this.form.submit()">
                            <span>{{ $cat->name }}</span>
                        </label>
                        @endforeach
                    </form>
                </div>
                
                <div class="mb-6">
                    <h4 class="font-bold text-sm mb-3">{{ __('Price Range') }}</h4>
                    <input type="range" min="0" max="5000000" step="100000" class="w-full">
                </div>
            </div>
        </div>
        
        <!-- Products Grid -->
        <div class="lg:col-span-3">
            @if($products->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                @foreach($products as $product)
                <div class="bg-white rounded-lg shadow-lg hover:shadow-xl transition overflow-hidden">
                    <div class="bg-gray-200 h-48 flex items-center justify-center">
                        <span class="text-gray-500">{{ __('Product Image') }}</span>
                    </div>
                    <div class="p-4">
                        <h3 class="font-serif font-bold text-lg mb-2">{{ $product->name }}</h3>
                        <p class="text-gray-600 text-sm mb-2">{{ __('SKU') }}: {{ $product->sku }}</p>
                        <p class="text-gray-600 text-sm mb-4">{{ __('Stock') }}: <span class="font-bold">{{ $product->stock }}</span></p>
                        <div class="flex justify-between items-center">
                            <span class="text-maroon-900 font-bold text-lg">
                                @if(app()->getLocale() === 'id')
                                    Rp {{ number_format($product->price_idr, 0, ',', '.') }}
                                @else
                                    \$ {{ number_format($product->price_usd, 2) }}
                                @endif
                            </span>
                            <a href="{{ route('products.show', $product->slug) }}" class="bg-maroon-900 hover:bg-maroon-800 text-white px-3 py-2 rounded text-sm">
                                {{ __('View') }}
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            {{ $products->links() }}
            @else
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 text-center">
                <p class="text-gray-700">{{ __('No products found') }}</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
