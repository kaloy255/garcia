@extends('layouts.admin')

@section('title', 'Order Management - G CLOTHING')

@section('header', 'Order Management')

@section('content')
<div class="bg-white shadow overflow-hidden sm:rounded-md">
    <!-- Filters and Search -->
    <div class="p-6 border-b border-gray-200">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div class="flex-1 min-w-0">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Orders</h3>
                <p class="mt-1 text-sm text-gray-500">View and manage all customer orders</p>
            </div>
            <div class="mt-4 md:mt-0 md:ml-4 flex space-x-3">
                <div class="relative">
                    <input type="text" id="search-orders" placeholder="Search orders..." class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                </div>
                <select id="filter-status" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                    <option value="">All Statuses</option>
                    <option value="pending">Pending</option>
                    <option value="processing">Processing</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order ID</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Products</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <!-- Sample Orders - Replace with real data from controller -->
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-indigo-600">#ORD-001</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=Juan+Dela+Cruz&background=6366F1&color=fff" alt="">
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">Juan Dela Cruz</div>
                                <div class="text-sm text-gray-500">juan@example.com</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">2 items</span>
                        <div class="text-sm text-gray-500 mt-1">Custom T-shirts</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">₱1,450.00</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Jun 15, 2023</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <button type="button" class="text-indigo-600 hover:text-indigo-900 view-order-details" data-id="1">View</button>
                            <div class="relative inline-block text-left">
                                <button type="button" class="text-gray-500 hover:text-gray-700 update-status-dropdown" data-id="1">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <!-- Status dropdown menu (hidden by default) -->
                                <div class="status-dropdown hidden origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                                    <div class="py-1" role="none">
                                        <button class="text-left block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem" data-status="processing">Mark as Processing</button>
                                        <button class="text-left block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem" data-status="completed">Mark as Completed</button>
                                        <button class="text-left block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem" data-status="cancelled">Mark as Cancelled</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-indigo-600">#ORD-002</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=Maria+Santos&background=6366F1&color=fff" alt="">
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">Maria Santos</div>
                                <div class="text-sm text-gray-500">maria@example.com</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">5 items</span>
                        <div class="text-sm text-gray-500 mt-1">Hoodies & Caps</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">₱4,250.00</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Processing</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Jun 12, 2023</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <button type="button" class="text-indigo-600 hover:text-indigo-900 view-order-details" data-id="2">View</button>
                            <div class="relative inline-block text-left">
                                <button type="button" class="text-gray-500 hover:text-gray-700 update-status-dropdown" data-id="2">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <!-- Status dropdown menu (hidden by default) -->
                                <div class="status-dropdown hidden origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                                    <div class="py-1" role="none">
                                        <button class="text-left block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem" data-status="pending">Mark as Pending</button>
                                        <button class="text-left block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem" data-status="completed">Mark as Completed</button>
                                        <button class="text-left block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem" data-status="cancelled">Mark as Cancelled</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-indigo-600">#ORD-003</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=Carlo+Reyes&background=6366F1&color=fff" alt="">
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">Carlo Reyes</div>
                                <div class="text-sm text-gray-500">carlo@example.com</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">1 item</span>
                        <div class="text-sm text-gray-500 mt-1">Premium Hoodie</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">₱1,850.00</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Completed</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Jun 05, 2023</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <button type="button" class="text-indigo-600 hover:text-indigo-900 view-order-details" data-id="3">View</button>
                            <div class="relative inline-block text-left">
                                <button type="button" class="text-gray-500 hover:text-gray-700 update-status-dropdown" data-id="3">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <!-- Status dropdown menu (hidden by default) -->
                                <div class="status-dropdown hidden origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                                    <div class="py-1" role="none">
                                        <button class="text-left block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem" data-status="pending">Mark as Pending</button>
                                        <button class="text-left block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem" data-status="processing">Mark as Processing</button>
                                        <button class="text-left block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem" data-status="cancelled">Mark as Cancelled</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <nav class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
        <div class="hidden sm:block">
            <p class="text-sm text-gray-700">
                Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of <span class="font-medium">20</span> results
            </p>
        </div>
        <div class="flex-1 flex justify-between sm:justify-end">
            <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                Previous
            </a>
            <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                Next
            </a>
        </div>
    </nav>
</div>

<!-- Order Details Modal -->
<div id="order-details-modal" class="fixed inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        
        <!-- Modal panel -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Order Details - #ORD-001
                            </h3>
                            <button type="button" id="close-order-details" class="text-gray-400 hover:text-gray-500">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        
                        <div class="border-t border-gray-200 py-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Customer Information</h4>
                                    <div class="mt-2 text-sm text-gray-900">
                                        <p class="font-medium">Juan Dela Cruz</p>
                                        <p>juan@example.com</p>
                                        <p>+63 912 345 6789</p>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Shipping Address</h4>
                                    <div class="mt-2 text-sm text-gray-900">
                                        <p>123 Main Street</p>
                                        <p>Barangay San Antonio</p>
                                        <p>Makati City, Metro Manila 1200</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="border-t border-gray-200 py-4">
                            <h4 class="text-sm font-medium text-gray-500 mb-2">Order Items</h4>
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Item</th>
                                        <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Details</th>
                                        <th scope="col" class="px-3 py-2 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                        <th scope="col" class="px-3 py-2 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Qty</th>
                                        <th scope="col" class="px-3 py-2 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-3 py-3 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded" src="https://via.placeholder.com/150/d4d4d4/555555?text=T-shirt" alt="">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-3 py-3">
                                            <div class="text-sm font-medium text-gray-900">Custom T-Shirt</div>
                                            <div class="text-xs text-gray-500">Size: Medium<br>Color: Black<br>Print: Front & Back</div>
                                        </td>
                                        <td class="px-3 py-3 whitespace-nowrap text-sm text-gray-500 text-right">₱450.00</td>
                                        <td class="px-3 py-3 whitespace-nowrap text-sm text-gray-500 text-right">2</td>
                                        <td class="px-3 py-3 whitespace-nowrap text-sm font-medium text-gray-900 text-right">₱900.00</td>
                                    </tr>
                                    <tr>
                                        <td class="px-3 py-3 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded" src="https://via.placeholder.com/150/d4d4d4/555555?text=Cap" alt="">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-3 py-3">
                                            <div class="text-sm font-medium text-gray-900">Cap with Logo</div>
                                            <div class="text-xs text-gray-500">Color: Navy Blue<br>Embroidery: Front</div>
                                        </td>
                                        <td class="px-3 py-3 whitespace-nowrap text-sm text-gray-500 text-right">₱550.00</td>
                                        <td class="px-3 py-3 whitespace-nowrap text-sm text-gray-500 text-right">1</td>
                                        <td class="px-3 py-3 whitespace-nowrap text-sm font-medium text-gray-900 text-right">₱550.00</td>
                                    </tr>
                                </tbody>
                                <tfoot class="bg-gray-50">
                                    <tr>
                                        <td colspan="4" class="px-3 py-2 text-right text-sm font-medium text-gray-500">Subtotal</td>
                                        <td class="px-3 py-2 text-right text-sm font-medium text-gray-900">₱1,450.00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="px-3 py-2 text-right text-sm font-medium text-gray-500">Shipping</td>
                                        <td class="px-3 py-2 text-right text-sm font-medium text-gray-900">₱0.00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="px-3 py-2 text-right text-sm font-medium text-gray-900">TOTAL</td>
                                        <td class="px-3 py-2 text-right text-sm font-medium text-gray-900">₱1,450.00</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        
                        <div class="border-t border-gray-200 py-4">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Order Status</h4>
                                    <div class="mt-2">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Payment Method</h4>
                                    <p class="mt-2 text-sm text-gray-900">GCash</p>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500">Order Date</h4>
                                    <p class="mt-2 text-sm text-gray-900">June 15, 2023</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" id="print-order">
                    <i class="fas fa-print mr-2"></i> Print Order
                </button>
                <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" id="update-order-status">
                    <i class="fas fa-pencil-alt mr-2"></i> Update Status
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Status dropdown toggles
        const statusDropdownButtons = document.querySelectorAll('.update-status-dropdown');
        statusDropdownButtons.forEach(button => {
            button.addEventListener('click', function() {
                const orderId = this.getAttribute('data-id');
                const dropdowns = document.querySelectorAll('.status-dropdown');
                
                // Close all other dropdowns
                dropdowns.forEach(dropdown => {
                    if (dropdown.parentElement.querySelector('.update-status-dropdown').getAttribute('data-id') !== orderId) {
                        dropdown.classList.add('hidden');
                    }
                });
                
                // Toggle this dropdown
                const thisDropdown = this.nextElementSibling;
                thisDropdown.classList.toggle('hidden');
            });
        });
        
        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.update-status-dropdown')) {
                document.querySelectorAll('.status-dropdown').forEach(dropdown => {
                    if (!dropdown.classList.contains('hidden') && !dropdown.contains(event.target)) {
                        dropdown.classList.add('hidden');
                    }
                });
            }
        });
        
        // Order status update buttons
        const statusButtons = document.querySelectorAll('.status-dropdown button');
        statusButtons.forEach(button => {
            button.addEventListener('click', function() {
                const orderId = this.closest('.relative').querySelector('.update-status-dropdown').getAttribute('data-id');
                const newStatus = this.getAttribute('data-status');
                updateOrderStatus(orderId, newStatus);
                
                // Hide dropdown after click
                this.closest('.status-dropdown').classList.add('hidden');
            });
        });
        
        // View order details buttons
        const viewOrderButtons = document.querySelectorAll('.view-order-details');
        const orderDetailsModal = document.getElementById('order-details-modal');
        const closeOrderDetailsButton = document.getElementById('close-order-details');
        
        viewOrderButtons.forEach(button => {
            button.addEventListener('click', function() {
                const orderId = this.getAttribute('data-id');
                showOrderDetails(orderId);
                orderDetailsModal.classList.remove('hidden');
            });
        });
        
        closeOrderDetailsButton.addEventListener('click', function() {
            orderDetailsModal.classList.add('hidden');
        });
        
        // Close modal when clicking outside
        orderDetailsModal.addEventListener('click', function(event) {
            if (event.target === orderDetailsModal) {
                orderDetailsModal.classList.add('hidden');
            }
        });
        
        // Print order button
        document.getElementById('print-order').addEventListener('click', function() {
            window.print();
        });
        
        // Filter functionality
        document.getElementById('filter-status').addEventListener('change', function() {
            filterOrders();
        });
        
        document.getElementById('search-orders').addEventListener('input', function() {
            filterOrders();
        });
        
        // Functions
        function updateOrderStatus(orderId, status) {
            // In a real application, this would be an AJAX call to the server
            console.log(`Updating order ${orderId} to status: ${status}`);
            
            // Simulate successful update (in real app, this would be in the AJAX success callback)
            alert(`Order #${orderId} status updated to ${status}`);
            
            // Here you would refresh the orders or update the status in the UI
        }
        
        function showOrderDetails(orderId) {
            // In a real application, this would fetch order details from the server
            console.log(`Showing details for order ${orderId}`);
            
            // Update modal title with order ID
            document.getElementById('modal-title').textContent = `Order Details - #ORD-00${orderId}`;
            
            // In a real app, you'd populate the modal with actual order data
        }
        
        function filterOrders() {
            const statusFilter = document.getElementById('filter-status').value.toLowerCase();
            const searchQuery = document.getElementById('search-orders').value.toLowerCase();
            
            const rows = document.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                const orderIdCell = row.querySelector('td:first-child').textContent.toLowerCase();
                const customerNameCell = row.querySelector('td:nth-child(2) .text-gray-900').textContent.toLowerCase();
                const statusCell = row.querySelector('td:nth-child(5) span').textContent.toLowerCase();
                
                const matchesStatus = statusFilter === '' || statusCell.includes(statusFilter);
                const matchesSearch = searchQuery === '' || 
                                     orderIdCell.includes(searchQuery) || 
                                     customerNameCell.includes(searchQuery);
                
                if (matchesStatus && matchesSearch) {
                    row.classList.remove('hidden');
                } else {
                    row.classList.add('hidden');
                }
            });
        }
    });
</script>
@endsection