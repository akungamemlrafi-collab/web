@extends('layouts.app')

@section('title', __('Home'))

@section('content')
<!-- Hero Section -->
<section class="hero bg-gradient-to-r from-maroon-900 to-maroon-800 text-white py-20">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-5xl font-serif font-bold mb-4">{{ __('CoreStone Indonesia') }}</h1>
        <p class="text-xl mb-8">{{ __('Premium Agate & Jewelry Collection') }}</p>
        <a href="{{ route('products.index') }}" class="bg-gold hover:bg-yellow-600 text-maroon-900 font-bold py-3 px-8 rounded">
            {{ __('Shop Now') }}
        </a>
    </div>
</section>

<!-- Categories Section -->
<section class="categories py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-serif font-bold text-center mb-12">{{ __('Shop by Category') }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($categories as $category)
            <div class="bg-white rounded-lg shadow-lg hover:shadow-xl transition p-6 text-center">
                <div class="text-5xl mb-4">{{ $category->icon ?? '✨' }}</div>
                <h3 class="text-xl font-serif font-bold mb-2">{{ $category->name }}</h3>
                <p class="text-gray-600 mb-4">{{ $category->description }}</p>
                <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="text-maroon-900 font-bold hover:text-gold">
                    {{ __('View Category') }} →
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<section class="featured-products py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-serif font-bold text-center mb-12">{{ __('Featured Products') }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($featured_products as $product)
            <div class="bg-white rounded-lg shadow-lg hover:shadow-xl transition overflow-hidden">
                <div class="bg-gray-200 h-48 flex items-center justify-center">
                    <span class="text-gray-500">{{ __('Product Image') }}</span>
                </div>
                <div class="p-4">
                    <h3 class="font-serif font-bold text-lg mb-2">{{ $product->name }}</h3>
                    <p class="text-gray-600 text-sm mb-4">{{ Str::limit($product->description, 100) }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-maroon-900 font-bold text-lg">
                            @if(app()->getLocale() === 'id')
                                Rp {{ number_format($product->price_idr, 0, ',', '.') }}
                            @else
                                \$ {{ number_format($product->price_usd, 2) }}
                            @endif
                        </span>
                        <a href="{{ route('products.show', $product->slug) }}" class="bg-maroon-900 hover:bg-maroon-800 text-white px-4 py-2 rounded text-sm">
                            {{ __('View') }}
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
