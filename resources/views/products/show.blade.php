@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="container mx-auto px-4 py-12">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Product Image -->
        <div>
            <div class="bg-gray-200 h-96 rounded-lg flex items-center justify-center mb-4">
                <span class="text-gray-500 text-lg">{{ __('Product Image') }}</span>
            </div>
            <div class="grid grid-cols-4 gap-2">
                @for($i = 0; $i < 4; $i++)
                <div class="bg-gray-200 h-20 rounded flex items-center justify-center cursor-pointer hover:bg-gray-300">
                    <span class="text-gray-400 text-xs">{{ __('Img') }} {{ $i + 1 }}</span>
                </div>
                @endfor
            </div>
        </div>
        
        <!-- Product Details -->
        <div>
            <div class="mb-6">
                <span class="text-sm text-gray-600">{{ $product->category->name }}</span>
                <h1 class="text-4xl font-serif font-bold mb-2">{{ $product->name }}</h1>
                <p class="text-gray-600 mb-4">{{ __('SKU') }}: {{ $product->sku }}</p>
                
                <div class="flex items-center mb-4">
                    <span class="text-3xl font-bold text-maroon-900">
                        @if(app()->getLocale() === 'id')
                            Rp {{ number_format($product->price_idr, 0, ',', '.') }}
                        @else
                            \$ {{ number_format($product->price_usd, 2) }}
                        @endif
                    </span>
                    <span class="ml-4 @if($product->stock > 0) text-green-600 @else text-red-600 @endif font-bold">
                        @if($product->stock > 0)
                            {{ __('In Stock') }}
                        @else
                            {{ __('Out of Stock') }}
                        @endif
                    </span>
                </div>
            </div>
            
            <!-- Description -->
            <div class="mb-6">
                <h3 class="text-lg font-bold mb-2">{{ __('Description') }}</h3>
                <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
            </div>
            
            <!-- Add to Cart -->
            <div class="flex items-center gap-4 mb-8">
                <div class="flex items-center border border-gray-300 rounded">
                    <button class="px-3 py-2 text-gray-500" id="decrease">−</button>
                    <input type="number" value="1" min="1" max="{{ $product->stock }}" class="w-16 text-center border-l border-r border-gray-300 py-2" id="quantity">
                    <button class="px-3 py-2 text-gray-500" id="increase">+</button>
                </div>
                <form action="{{ route('cart.add') }}" method="POST" class="flex-1">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" id="qty-input" value="1">
                    <button type="submit" @if($product->stock == 0) disabled @endif class="w-full bg-maroon-900 hover:bg-maroon-800 text-white font-bold py-3 rounded @if($product->stock == 0) opacity-50 cursor-not-allowed @endif">
                        {{ __('Add to Cart') }}
                    </button>
                </form>
            </div>
            
            <!-- Related Products -->
            @if($related_products->count() > 0)
            <div>
                <h3 class="text-lg font-bold mb-4">{{ __('Related Products') }}</h3>
                <div class="grid grid-cols-2 gap-4">
                    @foreach($related_products as $related)
                    <a href="{{ route('products.show', $related->slug) }}" class="bg-gray-50 rounded-lg p-4 hover:shadow-lg transition">
                        <div class="bg-gray-200 h-24 rounded mb-2 flex items-center justify-center">
                            <span class="text-gray-400 text-xs">{{ __('Image') }}</span>
                        </div>
                        <p class="text-sm font-bold text-maroon-900">{{ $related->name }}</p>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<script>
    document.getElementById('decrease').addEventListener('click', () => {
        const qty = parseInt(document.getElementById('quantity').value) || 1;
        if (qty > 1) {
            document.getElementById('quantity').value = qty - 1;
            document.getElementById('qty-input').value = qty - 1;
        }
    });
    
    document.getElementById('increase').addEventListener('click', () => {
        const qty = parseInt(document.getElementById('quantity').value) || 1;
        const max = parseInt(document.getElementById('quantity').max) || 999;
        if (qty < max) {
            document.getElementById('quantity').value = qty + 1;
            document.getElementById('qty-input').value = qty + 1;
        }
    });
    
    document.getElementById('quantity').addEventListener('change', (e) => {
        document.getElementById('qty-input').value = e.target.value;
    });
</script>
@endsection
