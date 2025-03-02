@extends('layouts.app')
@section('title', $product->name . ' | G CLOTHING')
@section('content')
    <!-- Breadcrumb -->
    <nav class="flex mb-6 text-sm" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="/" class="text-gray-700 hover:text-indigo-600 transition-colors">
                    <i class="fa-solid fa-home mr-2"></i>Home
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <i class="fa-solid fa-chevron-right text-gray-400 mx-2 text-xs"></i>
                    <a href="/?category={{ $product->category }}" class="text-gray-700 hover:text-indigo-600 transition-colors">
                        {{ ucfirst($product->category) }}
                    </a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <i class="fa-solid fa-chevron-right text-gray-400 mx-2 text-xs"></i>
                    <span class="text-gray-500">{{ $product->name }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Product Details -->
    <div class="bg-white rounded-xl overflow-hidden shadow-sm">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-6">
            <!-- Product Images -->
            <div>
                <div class="relative overflow-hidden rounded-lg bg-gray-100 mb-4">
                    <img 
                        src="{{ asset('storage/' . $product->image) }}" 
                        alt="{{ $product->name }}" 
                        class="w-full h-auto object-cover aspect-square"
                    >
                </div>
                
                <!-- Additional images would go here in thumbnails -->
                <div class="grid grid-cols-4 gap-2">
                    <button class="border-2 border-indigo-600 rounded-md overflow-hidden">
                        <img 
                            src="{{ asset('storage/' . $product->image) }}" 
                            alt="Thumbnail" 
                            class="w-full h-auto aspect-square object-cover"
                        >
                    </button>
                    <!-- Placeholder thumbnails -->
                    @for ($i = 0; $i < 3; $i++)
                        <button class="border border-gray-200 rounded-md overflow-hidden opacity-50">
                            <div class="w-full h-auto aspect-square bg-gray-100 flex items-center justify-center text-gray-400">
                                <i class="fa-regular fa-image"></i>
                            </div>
                        </button>
                    @endfor
                </div>
            </div>
            
            <!-- Product Info -->
            <div class="flex flex-col">
                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $product->name }}</h1>
                    <div class="flex items-center mb-4">
                        <div class="flex text-amber-400 mr-2">
                            @for ($i = 0; $i < 5; $i++)
                                <i class="fa-solid fa-star"></i>
                            @endfor
                        </div>
                        <span class="text-sm text-gray-500">(12 reviews)</span>
                    </div>
                    <p class="text-3xl font-bold text-gray-900 mb-6">₱{{ number_format($product->price, 2) }}</p>
                    
                    <div class="space-y-4 mb-6">
                        <!-- Availability -->
                        <div class="flex items-center">
                            @if($product->quantity > 10)
                                <span class="text-green-600 flex items-center">
                                    <i class="fa-solid fa-check mr-2"></i> In Stock
                                </span>
                            @elseif($product->quantity > 0)
                                <span class="text-amber-600 flex items-center">
                                    <i class="fa-solid fa-clock mr-2"></i> Low Stock ({{ $product->quantity }} left)
                                </span>
                            @else
                                <span class="text-red-600 flex items-center">
                                    <i class="fa-solid fa-xmark mr-2"></i> Out of Stock
                                </span>
                            @endif
                        </div>
                        
                        <!-- Category -->
                        <div class="flex items-center">
                            <span class="text-gray-500 mr-2">Category:</span>
                            <a href="/?category={{ $product->category }}" class="text-indigo-600 hover:underline">
                                {{ ucfirst($product->category) }}
                            </a>
                        </div>
                    </div>
                </div>
                
                @if($product->quantity > 0)
                    <!-- Add to Cart Form -->
                    <form class="mb-6">
                        <div class="flex items-center mb-4">
                            <label for="quantity" class="mr-4 font-medium text-gray-700">Quantity</label>
                            <div class="custom-number-input h-10 w-32">
                                <div class="flex flex-row h-10 w-full rounded-lg relative bg-transparent mt-1">
                                    <button type="button" data-action="decrement" class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:bg-gray-200 h-full w-20 rounded-l cursor-pointer outline-none border border-gray-200">
                                        <span class="m-auto text-xl font-bold">−</span>
                                    </button>
                                    <input 
                                        type="number" 
                                        id="quantity" 
                                        name="quantity" 
                                        class="outline-none focus:outline-none text-center w-full border-t border-b border-gray-200 font-semibold text-md hover:text-black focus:text-black md:text-base cursor-default flex items-center text-gray-700" 
                                        min="1" 
                                        max="{{ $product->quantity }}" 
                                        value="1"
                                    >
                                    <button type="button" data-action="increment" class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:bg-gray-200 h-full w-20 rounded-r cursor-pointer border border-gray-200">
                                        <span class="m-auto text-xl font-bold">+</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-6 rounded-md transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500 flex items-center justify-center">
                                <i class="fa-solid fa-cart-plus mr-2"></i> Add to Cart
                            </button>
                            <button type="button" class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium py-3 px-6 rounded-md transition-colors focus:outline-none focus:ring-2 focus:ring-gray-300 flex items-center justify-center">
                                <i class="fa-regular fa-heart mr-2"></i> Add to Wishlist
                            </button>
                        </div>
                    </form>
                @endif
                
                <!-- Admin Actions -->
                @auth
                    @if(Auth::user()->is_admin)
                        <div class="flex flex-col space-y-3 mt-auto pt-6 border-t border-gray-200">
                            <a href="{{ route('products.edit', $product->id) }}" class="inline-flex items-center justify-center px-4 py-2 border border-indigo-500 text-indigo-600 bg-white hover:bg-indigo-50 rounded-md transition-colors">
                                <i class="fa-solid fa-pen-to-square mr-2"></i> Edit Product
                            </a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this product?')" class="w-full inline-flex items-center justify-center px-4 py-2 border border-red-500 text-red-600 bg-white hover:bg-red-50 rounded-md transition-colors">
                                    <i class="fa-solid fa-trash mr-2"></i> Delete Product
                                </button>
                            </form>
                        </div>
                    @endif
                @endauth
            </div>
        </div>
        
        <!-- Product Description -->
        <div class="p-6 border-t border-gray-200">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Product Description</h2>
            <div class="prose max-w-none text-gray-600">
                <p>{{ $product->description }}</p>
            </div>
        </div>
    </div>
    
    <!-- Related Products (placeholder) -->
    <div class="mt-16">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">You May Also Like</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @for ($i = 0; $i < 4; $i++)
                <div class="group relative overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm transition-all hover:shadow-md opacity-50">
                    <div class="relative overflow-hidden pt-[100%]">
                        <div class="absolute inset-0 bg-gray-100 flex items-center justify-center">
                            <i class="fa-solid fa-shirt text-4xl text-gray-300"></i>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="mb-1 text-sm font-medium text-gray-500 uppercase">Category</h3>
                        <p class="block mb-2 text-lg font-semibold text-gray-800">Product Name</p>
                        <div class="flex items-center justify-between">
                            <span class="text-lg font-bold text-gray-800">₱0.00</span>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>

    <script>
        // Custom number input
        document.addEventListener('DOMContentLoaded', function() {
            function decrement(e) {
                const btn = e.target.closest('button');
                const input = btn.parentNode.querySelector('input[type="number"]');
                const min = input.getAttribute('min');
                
                let value = parseInt(input.value);
                value = isNaN(value) ? 1 : value;
                value = value > 1 ? value - 1 : min;
                
                input.value = value;
            }

            function increment(e) {
                const btn = e.target.closest('button');
                const input = btn.parentNode.querySelector('input[type="number"]');
                const max = parseInt(input.getAttribute('max'));
                
                let value = parseInt(input.value);
                value = isNaN(value) ? 1 : value;
                value = value < max ? value + 1 : max;
                
                input.value = value;
            }

            const decrementButtons = document.querySelectorAll('button[data-action="decrement"]');
            const incrementButtons = document.querySelectorAll('button[data-action="increment"]');

            decrementButtons.forEach(btn => {
                btn.addEventListener('click', decrement);
            });

            incrementButtons.forEach(btn => {
                btn.addEventListener('click', increment);
            });
        });
    </script>
@endsection