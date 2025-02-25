@extends('layouts.app')
@section('title', $product->name)
@section('content')
    <div class="flex mt-10">
        <div class="w-[70rem] flex flex-col gap-5">
            <img src="{{ asset('storage/' . $product->image) }}" alt="" class="w-full">
            <div>
                <p class="font-semibold text-2xl mb-5">Product Description</p>
                <p class="text-gray-500">{{ $product->description }}</p>
            </div>
        </div>

        <div class="flex flex-col gap-5 w-full h-[300px] px-10 justify-between">
            <div class="flex flex-col gap-5 w-full">
                <p class="font-semibold">{{ $product->name }}</p>
                <p class="">Quantity: {{ $product->quantity }}</p>
                <p >Price: <span class="font-semibold">₱{{ $product->price }}</span></p>
            </div>

            <div class="flex flex-col items-center gap-2 ">
                <a class="border border-blue-500 w-full text-center bg-blue-100 text-blue-500 py-2" href="{{ route('products.edit', $product->id) }}">Edit</a>

                <form class="w-full" action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-900 w-full text-center text-white py-2" type="submit" onclick="return confirm('Are you sure delete this item?')">Delete</button>
                </form>
            </div>
        </div>
        
    </div>
    
@endsection