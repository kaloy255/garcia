@extends('layouts.app')
@section('content')
    <div class="self-start border-b border-[#cfd1d0] w-full pb-5">
        <form action="{{ route('products.filter') }}" method="GET" id="category-form">
            <x-nav-link type="submit" name="category" value="men" class="{{ request('category') == 'men' ? 'active' : '' }}">Men</x-nav-link>
            <x-nav-link type="submit" name="category" value="women" class="{{ request('category') == 'women' ? 'active' : '' }}">Women</x-nav-link>
            <x-nav-link type="submit" name="category" value="kids" class="{{ request('category') == 'kids' ? 'active' : '' }}">Kids</x-nav-link>
        </form>
    </div>
        @if (Auth::user()->role == 'admin')
    
            <a class="self-start bg-blue-500 px-5 py-2 text-white rounded-md" href="{{ route('products.create') }}">
            create 
            </a>
        @endif

        <div class="grid grid-cols-4 gap-10 place-items-center mt-10 self-start  w-full">
            @foreach ($products as $product)
                <a href="{{ route('products.find', $product->id) }}" class="w-[250px] flex flex-col">
                    <img class="w-full h-[300px] rounded-2xl" src="{{ asset('storage/' . $product->image) }}" alt="">
                    <p class="font-semibold">{{ $product->name }}</p>
                    <div class="flex justify-between">
                        <p class="font-semibold">₱{{ $product->price }}</p>
                        <p class="text-sm font-semibold text-gray-500">{{ $product->quantity }}</p>
                        <p class="text-sm font-semibold text-gray-500">{{ $product->category }}</p>
                    </div>
                </a>
            
            @endforeach
        </div>
@endsection