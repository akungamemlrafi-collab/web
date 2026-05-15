<header class="bg-white border-b border-gray-200 sticky top-0 z-50">
    <div class="container mx-auto px-4 py-4">
        <div class="flex justify-between items-center">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <span class="text-2xl font-serif font-bold text-maroon-900">CoreStone</span>
            </a>
            
            <!-- Navigation -->
            <nav class="hidden md:flex gap-8">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-maroon-900 font-bold">{{ __('Home') }}</a>
                <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-maroon-900 font-bold">{{ __('Products') }}</a>
                <a href="#" class="text-gray-700 hover:text-maroon-900 font-bold">{{ __('About') }}</a>
                <a href="#" class="text-gray-700 hover:text-maroon-900 font-bold">{{ __('Contact') }}</a>
            </nav>
            
            <!-- Right Actions -->
            <div class="flex items-center gap-4">
                <!-- Language Switcher -->
                <div class="relative group">
                    <button class="flex items-center gap-2 px-3 py-2 rounded border border-gray-300 hover:bg-gray-50">
                        {{ app()->getLocale() === 'id' ? '🇮🇩 ID' : '🇬🇧 EN' }}
                        <span>▼</span>
                    </button>
                    <div class="absolute right-0 mt-2 w-32 bg-white border border-gray-300 rounded shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition">
                        <a href="{{ route('home') }}?lang=id" class="block px-4 py-2 hover:bg-gray-100">🇮🇩 Indonesia</a>
                        <a href="{{ route('home') }}?lang=en" class="block px-4 py-2 hover:bg-gray-100">🇬🇧 English</a>
                    </div>
                </div>
                
                <!-- Cart -->
                <a href="{{ route('cart.index') }}" class="relative text-gray-700 hover:text-maroon-900">
                    <span class="text-2xl">🛒</span>
                    <span class="absolute top-0 right-0 bg-red-600 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">0</span>
                </a>
                
                <!-- Mobile Menu Toggle -->
                <button class="md:hidden text-2xl">☰</button>
            </div>
        </div>
    </div>
</header>
