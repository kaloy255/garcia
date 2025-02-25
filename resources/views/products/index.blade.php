@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center gap-2">
        <p class="uppercase font-semibold text-lg">clothing collection</p>
        <p class="text-sm">Find everything you need to look and feel your best, and shop the latest fashion and lifestyle products</p>

        <div class="flex gap-8 mt-5">
            <a href="" class="border border-black px-5 py-1 rounded-full hover:bg-black hover:text-white">Tshirt</a>
            <a href="" class="border border-black px-5 py-1 rounded-full hover:bg-black hover:text-white">Jacket</a>
            <a href="" class="border border-black px-5 py-1 rounded-full hover:bg-black hover:text-white">Pants</a>
            <a href="" class="border border-black px-5 py-1 rounded-full hover:bg-black hover:text-white">Hoodie</a>
            <a href="">
                <svg  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
               </svg>
            </a>
              
        </div>
    </div>

    <a href="{{ route('products.create') }}" class="bg-blue-800 text-white py-2 px-5 rounded-md w-[10rem] text-center self-start"> Add Product</a>

    <div class="grid grid-cols-4 gap-10 place-items-center mt-10 self-start  w-full">
        @foreach ($products as $product)
            <a href="{{ route('products.find', $product->id) }}" class="w-[250px] flex flex-col">
                <img class="w-full h-[300px] rounded-2xl" src="{{ asset('storage/' . $product->image) }}" alt="">
                <p class="font-semibold">{{ $product->name }}</p>
                <div class="flex justify-between">
                    <p class="font-semibold">₱{{ $product->price }}</p>
                    <p class="text-sm font-semibold text-gray-500">{{ $product->quantity }}</p>
                </div>
            </a>
           
        @endforeach
      
        

    </div>
    
@endsection