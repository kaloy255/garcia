@extends('layouts.app')
@section('title', 'Order #' . $order->id . ' | G CLOTHING')
@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold">Order #{{ $order->id }}</h1>
            <a href="{{ route('orders.index') }}" class="text-indigo-600 hover:text-indigo-800">
                <i class="fa-solid fa-arrow-left mr-1"></i> Back to Orders
            </a>
        </div>
        
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 flex justify-between items-center">
                <div>
                    <i class="fa-solid fa-check-circle mr-2"></i>
                    {{ session('success') }}
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('products.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                        <i class="fa-solid fa-cart-shopping mr-1"></i> Continue Shopping
                    </a>
                </div>
            </div>
        @endif
        
        <!-- Order Status -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-8">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-semibold mb-4">Order Status</h2>
                
                <div class="mb-6">
                    <!-- Order Status Timeline -->
                    <div class="relative">
                        <div class="absolute left-0 w-full border-t-2 border-gray-200 top-1/2 -translate-y-1/2"></div>
                        <div class="relative flex justify-between">
                            <div class="text-center">
                                <div class="@if($order->status == 'pending' || $order->status == 'processing' || $order->status == 'completed') bg-indigo-600 border-indigo-600 @else bg-gray-200 border-gray-200 @endif w-6 h-6 rounded-full border-2 mx-auto z-10"></div>
                                <div class="text-xs mt-1 @if($order->status == 'pending' || $order->status == 'processing' || $order->status == 'completed') font-medium text-indigo-600 @else text-gray-500 @endif">Order Placed</div>
                            </div>
                            <div class="text-center">
                                <div class="@if($order->status == 'processing' || $order->status == 'completed') bg-indigo-600 border-indigo-600 @else bg-gray-200 border-gray-200 @endif w-6 h-6 rounded-full border-2 mx-auto z-10"></div>
                                <div class="text-xs mt-1 @if($order->status == 'processing' || $order->status == 'completed') font-medium text-indigo-600 @else text-gray-500 @endif">Processing</div>
                            </div>
                            <div class="text-center">
                                <div class="@if($order->status == 'completed') bg-indigo-600 border-indigo-600 @else bg-gray-200 border-gray-200 @endif w-6 h-6 rounded-full border-2 mx-auto z-10"></div>
                                <div class="text-xs mt-1 @if($order->status == 'completed') font-medium text-indigo-600 @else text-gray-500 @endif">Completed</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Order Date</p>
                        <p class="font-medium">{{ $order->created_at->format('M d, Y') }}</p>
                    </div>
                    
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Order Status</p>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            @if($order->status == 'completed') bg-green-100 text-green-800
                            @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                            @elseif($order->status == 'canceled') bg-red-100 text-red-800
                            @else bg-yellow-100 text-yellow-800 @endif
                        ">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                    
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Payment Method</p>
                        <p class="font-medium">
                            @if($order->payment_method == 'cash_on_delivery')
                                Cash on Delivery
                            @elseif($order->payment_method == 'credit_card')
                                Credit Card
                            @elseif($order->payment_method == 'bank_transfer')
                                Bank Transfer
                            @else
                                {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}
                            @endif
                        </p>
                    </div>
                    
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Payment Status</p>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            @if($order->payment_status == 'paid') bg-green-100 text-green-800
                            @else bg-yellow-100 text-yellow-800 @endif
                        ">
                            {{ ucfirst($order->payment_status ?? 'pending') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Order Items -->
            <div class="md:col-span-2">
                <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-6">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold mb-6">Order Items</h2>
                        
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead>
                                    <tr class="bg-gray-100 text-gray-600 uppercase text-sm">
                                        <th class="py-4 px-6">Product</th>
                                        <th class="py-4 px-6">Price</th>
                                        <th class="py-4 px-6">Quantity</th>
                                        <th class="py-4 px-6">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->items as $item)
                                        <tr class="border-b hover:bg-gray-50">
                                            <td class="py-4 px-6">
                                                <div class="flex items-center">
                                                    <div>
                                                        <p class="font-medium text-gray-800">{{ $item->product_name ?? $item->product->name ?? 'Product' }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-4 px-6 text-gray-800">₱{{ number_format($item->price, 2) }}</td>
                                            <td class="py-4 px-6 text-gray-800">{{ $item->quantity }}</td>
                                            <td class="py-4 px-6 font-medium text-gray-800">₱{{ number_format($item->price * $item->quantity, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="bg-gray-50">
                                        <td colspan="3" class="py-4 px-6 text-right font-medium text-gray-700">Total</td>
                                        <td class="py-4 px-6 font-bold text-gray-800">₱{{ number_format($order->total_amount, 2) }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                
                <!-- Actions -->
                <div class="flex space-x-4 mb-6">
                    <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-indigo-600 rounded-md text-indigo-600 hover:bg-indigo-50 transition-colors">
                        <i class="fa-solid fa-tag mr-2"></i> Continue Shopping
                    </a>
                    <a href="#" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition-colors">
                        <i class="fa-solid fa-download mr-2"></i> Download Receipt
                    </a>
                </div>
            </div>
            
            <!-- Shipping Information -->
            <div class="md:col-span-1">
                <div class="bg-white rounded-lg shadow-sm overflow-hidden mb-6">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold mb-4">Shipping Information</h2>
                        
                        <div class="space-y-4">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900 mb-3">Shipping Information</h3>
                                <div class="space-y-4">
                                    <div>
                                        <p class="text-sm text-gray-600 mb-1">Address</p>
                                        <p class="font-medium">{{ $order->address }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 mb-1">City</p>
                                        <p class="font-medium">{{ $order->shipping_city ?? $order->city }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 mb-1">Zip Code</p>
                                        <p class="font-medium">{{ $order->shipping_zip ?? $order->postal_code }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 mb-1">Contact Number</p>
                                        <p class="font-medium">{{ $order->contact_number ?? $order->phone }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Need Help? Card -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold mb-4">Need Help?</h2>
                        <p class="text-gray-600 mb-4">Have questions about your order or need assistance? Our customer support team is here to help!</p>
                        <div class="space-y-3">
                            <a href="#" class="flex items-center text-indigo-600 hover:text-indigo-800">
                                <i class="fa-solid fa-message mr-2"></i> Contact Support
                            </a>
                            <a href="#" class="flex items-center text-indigo-600 hover:text-indigo-800">
                                <i class="fa-solid fa-question-circle mr-2"></i> FAQ
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 