@extends('layouts.app')
@section('title', 'My Orders | G CLOTHING')
@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-8">My Orders</h1>
        
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif
        
        @if(count($orders) > 0)
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-100 text-gray-600 uppercase text-sm">
                                <th class="py-4 px-6">Order #</th>
                                <th class="py-4 px-6">Date</th>
                                <th class="py-4 px-6">Total</th>
                                <th class="py-4 px-6">Status</th>
                                <th class="py-4 px-6">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr class="border-b hover:bg-gray-50 @if($order->created_at->diffInHours() < 24) bg-indigo-50 @endif">
                                    <td class="py-4 px-6 font-medium">
                                        #{{ $order->id }}
                                        @if($order->created_at->diffInHours() < 24)
                                            <span class="ml-2 bg-indigo-600 text-white text-xs px-2 py-0.5 rounded-full">New</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6">
                                        <div>{{ $order->created_at->format('M d, Y') }}</div>
                                        <div class="text-xs text-gray-500">{{ $order->created_at->format('h:i A') }}</div>
                                    </td>
                                    <td class="py-4 px-6 font-medium">₱{{ number_format($order->total_amount, 2) }}</td>
                                    <td class="py-4 px-6">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            @if($order->status == 'completed') bg-green-100 text-green-800
                                            @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                                            @elseif($order->status == 'canceled') bg-red-100 text-red-800
                                            @else bg-yellow-100 text-yellow-800 @endif
                                        ">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6">
                                        <a href="{{ route('orders.show', $order->id) }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800">
                                            <span>View Details</span>
                                            <i class="fa-solid fa-arrow-right ml-1 text-xs"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Pagination -->
            <div class="mt-6">
                {{ $orders->links() }}
            </div>
            
            <!-- Order Status Legend -->
            <div class="mt-8 bg-white rounded-lg p-4 shadow-sm">
                <h3 class="text-sm font-medium text-gray-700 mb-2">Order Status Legend</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                    <div class="flex items-center">
                        <span class="w-3 h-3 rounded-full bg-yellow-100 mr-2"></span>
                        <span class="text-sm text-gray-600">Pending: Order received</span>
                    </div>
                    <div class="flex items-center">
                        <span class="w-3 h-3 rounded-full bg-blue-100 mr-2"></span>
                        <span class="text-sm text-gray-600">Processing: Being prepared</span>
                    </div>
                    <div class="flex items-center">
                        <span class="w-3 h-3 rounded-full bg-green-100 mr-2"></span>
                        <span class="text-sm text-gray-600">Completed: Order delivered</span>
                    </div>
                    <div class="flex items-center">
                        <span class="w-3 h-3 rounded-full bg-red-100 mr-2"></span>
                        <span class="text-sm text-gray-600">Canceled: Order canceled</span>
                    </div>
                </div>
            </div>
        @else
            <div class="bg-white p-8 rounded-lg shadow-sm text-center">
                <div class="flex flex-col items-center justify-center">
                    <div class="w-20 h-20 rounded-full bg-indigo-100 flex items-center justify-center mb-4">
                        <i class="fa-solid fa-box text-indigo-600 text-2xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">No Orders Yet</h2>
                    <p class="text-gray-600 mb-6">You haven't placed any orders yet.</p>
                    <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center px-6 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors">
                        Start Shopping <i class="fa-solid fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        @endif
    </div>
@endsection 