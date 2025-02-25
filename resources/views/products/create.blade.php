@extends('layouts.app')

@section('title', 'Add Product')
@section('content')
    <div  class=" absolute left-5">
        <a href="{{ route('products.index') }}">
            <svg class="w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
            </svg>
        </a>
    </div>
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-gray-700 text-center">Add a New Product</h2>
        
        @if(session('success'))
            <p class="text-green-500 text-center mb-4">{{ session('success') }}</p>
        @endif
        
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label class="block text-gray-600 font-semibold">Product Name:</label>
                <input type="text" name="name" required class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-gray-600 font-semibold">Quantity:</label>
                <input type="number" name="quantity" required class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-gray-600 font-semibold">Price:</label>
                <input type="text" name="price" required class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-gray-600 font-semibold">Description:</label>
                <textarea name="description" cols="30" rows="4" class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <div>
                <label class="block text-gray-600 font-semibold">Product Image:</label>
                <input type="file" name="image" class="w-full p-2 border border-gray-300 rounded-lg">
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white p-3 rounded-lg hover:bg-blue-600 transition duration-300">Add Product</button>
        </form>
    </div>
    
@endsection