<header class="bg-white shadow-sm sticky top-0 z-50">
    <div class="container mx-auto px-4 py-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <!-- Logo -->
            <a href="/" class="flex items-center">
                <span class="text-2xl font-bold text-gray-800">G<span class="text-indigo-600">CLOTHING</span></span>
            </a>
            
            <!-- Search form -->
            <div class="hidden md:block flex-grow max-w-md mx-4">
                <form action="{{ route('products.filter') }}" method="GET" class="relative">
                    <input 
                        class="w-full h-10 pl-10 pr-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors"
                        type="text" 
                        name="name" 
                        value="{{ request('name') }}" 
                        placeholder="Search for products..."
                    >
                    <button type="submit" class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                    </button>
                </form>
            </div>
            
            <!-- Nav links and buttons -->
            <div class="flex items-center space-x-4">
                <!-- Mobile search button -->
                <button class="md:hidden p-2 rounded-full hover:bg-gray-100" type="button" id="mobile-search-button">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
                
                @guest
                    <a href="/login" class="hidden sm:inline-flex px-4 py-2 text-sm font-medium text-indigo-600 hover:text-indigo-800 transition-colors">Log in</a>
                    <a href="/register" class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-full hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-colors">Register</a>
                @endguest

                @auth
                    @if(!Auth::user()->is_admin)
                    <div x-data="{ open: false }" class="relative">
                        <a href="{{ route('cart.index') }}" class="p-2 relative text-gray-700 hover:text-indigo-600 transition-colors">
                            <i class="fa-solid fa-cart-shopping text-xl" id="cart-icon"></i>
                            @php
                                $cartCount = 0;
                                foreach(session('cart', []) as $item) {
                                    $cartCount += $item['quantity'];
                                }
                            @endphp
                            <span id="cart-count" class="absolute -top-1 -right-1 bg-indigo-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">{{ $cartCount }}</span>
                        </a>
                    </div>
                    @endif
                    
                    @if(Auth::user()->is_admin)
                    <a href="/admin" class="hidden sm:inline-flex px-3 py-1.5 text-sm font-medium text-white bg-indigo-600 rounded-full hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-colors">
                        <i class="fa-solid fa-gauge-high mr-1.5"></i>Admin
                    </a>
                    @endif
                    
                    <!-- User menu -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center text-sm font-medium text-gray-700 hover:text-indigo-600 focus:outline-none transition-colors">
                            <span class="mr-1">{{ Auth::user()->name }}</span>
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </button>
                        
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50" style="display: none;">
                            @if(!Auth::user()->is_admin)
                                <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fa-solid fa-box mr-2"></i>My Orders
                                </a>
                            @endif
                            @if(Auth::user()->is_admin)
                                <a href="/admin" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fa-solid fa-gauge-high mr-2"></i>Admin Dashboard
                                </a>
                               
                            @endif
                            <a href="/logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fa-solid fa-arrow-right-from-bracket mr-2"></i>Log out
                            </a>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
        
        <!-- Mobile search form -->
        <div id="mobile-search" class="mt-4 md:hidden hidden">
            <form action="{{ route('products.filter') }}" method="GET" class="relative">
                <input 
                    class="w-full h-10 pl-10 pr-4 py-2 rounded-full border border-gray-300 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
                    type="text" 
                    name="name" 
                    value="{{ request('name') }}" 
                    placeholder="Search for products..."
                >
                <button type="submit" class="absolute inset-y-0 left-0 pl-3 flex items-center">
                    <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                </button>
            </form>
        </div>
    </div>
</header>

<script>
    // Toggle mobile search
    document.addEventListener('DOMContentLoaded', function() {
        const mobileSearchBtn = document.getElementById('mobile-search-button');
        const mobileSearch = document.getElementById('mobile-search');
        
        if (mobileSearchBtn && mobileSearch) {
            mobileSearchBtn.addEventListener('click', function() {
                mobileSearch.classList.toggle('hidden');
            });
        }
    });
</script>