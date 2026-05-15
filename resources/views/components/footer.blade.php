<footer class="bg-gray-900 text-white py-12 mt-20">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
            <!-- About -->
            <div>
                <h3 class="text-lg font-serif font-bold mb-4">CoreStone Indonesia</h3>
                <p class="text-gray-400 text-sm leading-relaxed">{{ __('Premium agate and jewelry collection for domestic and international markets.') }}</p>
            </div>
            
            <!-- Quick Links -->
            <div>
                <h4 class="font-bold mb-4">{{ __('Quick Links') }}</h4>
                <ul class="space-y-2 text-gray-400 text-sm">
                    <li><a href="{{ route('products.index') }}" class="hover:text-white">{{ __('Shop') }}</a></li>
                    <li><a href="#" class="hover:text-white">{{ __('About Us') }}</a></li>
                    <li><a href="#" class="hover:text-white">{{ __('Contact') }}</a></li>
                    <li><a href="#" class="hover:text-white">{{ __('FAQ') }}</a></li>
                </ul>
            </div>
            
            <!-- Customer Service -->
            <div>
                <h4 class="font-bold mb-4">{{ __('Customer Service') }}</h4>
                <ul class="space-y-2 text-gray-400 text-sm">
                    <li><a href="#" class="hover:text-white">{{ __('Shipping Policy') }}</a></li>
                    <li><a href="#" class="hover:text-white">{{ __('Returns') }}</a></li>
                    <li><a href="#" class="hover:text-white">{{ __('Privacy Policy') }}</a></li>
                    <li><a href="#" class="hover:text-white">{{ __('Terms & Conditions') }}</a></li>
                </ul>
            </div>
            
            <!-- Contact -->
            <div>
                <h4 class="font-bold mb-4">{{ __('Contact Us') }}</h4>
                <p class="text-gray-400 text-sm mb-2">📧 info@corestone.id</p>
                <p class="text-gray-400 text-sm mb-2">📞 +62-812-3456-7890</p>
                <p class="text-gray-400 text-sm">📍 Jakarta, Indonesia</p>
            </div>
        </div>
        
        <div class="border-t border-gray-800 pt-8">
            <div class="flex justify-between items-center">
                <p class="text-gray-400 text-sm">© 2026 CoreStone Indonesia. All rights reserved.</p>
                <div class="flex gap-4 text-gray-400">
                    <a href="#" class="hover:text-white text-lg">f</a>
                    <a href="#" class="hover:text-white text-lg">𝕏</a>
                    <a href="#" class="hover:text-white text-lg">ig</a>
                </div>
            </div>
        </div>
    </div>
</footer>
