@extends('layouts.app')

@section('title', 'Add Product')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Back button -->
        <div class="mb-6">
            <a href="{{ route('products.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                </svg>
                <span>Back to Products</span>
            </a>
        </div>

        <!-- Form container -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden max-w-6xl mx-auto">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-6 py-5">
                <h1 class="text-2xl font-bold text-white">Add New Product</h1>
                <p class="text-blue-100 mt-1">Enter the product details below</p>
            </div>

            @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 p-4 m-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Left column: Main product info -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Product name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Product Name</label>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                placeholder="Enter product name" 
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                            >
                            <x-form-error name="name" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Price -->
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price (₱)</label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <span class="text-gray-500 sm:text-sm">₱</span>
                                    </div>
                                    <input 
                                        type="text" 
                                        id="price" 
                                        name="price" 
                                        placeholder="0.00" 
                                        required
                                        class="block w-full rounded-md border-gray-300 pl-7 pr-3 focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                    >
                                </div>
                                <x-form-error name="price" />
                            </div>
                            
                            <!-- Quantity -->
                            <div>
                                <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Quantity in Stock</label>
                                <input 
                                    type="number" 
                                    id="quantity" 
                                    name="quantity" 
                                    placeholder="Enter quantity available" 
                                    min="0" 
                                    required
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                >
                                <x-form-error name="quantity" />
                            </div>
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                            <select 
                                id="category" 
                                name="category" 
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                            >
                                <option value="">Select a category</option>
                                <option value="men">Men</option>
                                <option value="women">Women</option>
                                <option value="kids">Kids</option>
                            </select>
                            <x-form-error name="category" />
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Product Description</label>
                            <textarea 
                                id="description" 
                                name="description" 
                                rows="5" 
                                placeholder="Enter product description and details"
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                            ></textarea>
                        </div>
                    </div>

                    <!-- Right column: Image upload and submit -->
                    <div class="lg:col-span-1 space-y-6">
                        <!-- Image upload with preview -->
                        <div class="bg-gray-50 rounded-lg p-6 border-2 border-dashed border-gray-300">
                            <div class="text-center">
                                <div class="mt-1 flex justify-center">
                                    <img id="preview-image" class="hidden max-h-40 mb-4 rounded" alt="Product preview">
                                </div>
                                <div class="space-y-2">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600 justify-center">
                                        <label for="image" class="relative cursor-pointer rounded-md bg-white font-medium text-blue-600 focus-within:outline-none hover:text-blue-500">
                                            <span>Upload a photo</span>
                                            <input id="image" name="image" type="file" class="sr-only" accept="image/*">
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                                </div>
                            </div>
                            <x-form-error name="image" />
                        </div>

                        <!-- Tips card -->
                        <div class="bg-blue-50 rounded-lg p-4">
                            <h3 class="text-sm font-medium text-blue-800 mb-2">Tips for adding products</h3>
                            <ul class="text-xs text-blue-700 space-y-1 pl-5 list-disc">
                                <li>Include accurate and detailed descriptions</li>
                                <li>Upload high-quality images</li>
                                <li>Set competitive prices</li>
                                <li>Select the right category for better visibility</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Submit button -->
                <div class="mt-8 flex justify-end">
                    <button 
                        type="submit" 
                        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Add Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Image preview functionality
    document.getElementById('image').addEventListener('change', function(event) {
        const previewImage = document.getElementById('preview-image');
        const file = event.target.files[0];
        
        if (file) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewImage.classList.remove('hidden');
            }
            
            reader.readAsDataURL(file);
        } else {
            previewImage.src = '';
            previewImage.classList.add('hidden');
        }
    });
</script>
@endsection