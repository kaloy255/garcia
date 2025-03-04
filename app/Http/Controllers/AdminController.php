<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\Category;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // No middleware call here
    }

    /**
     * Check if user is authenticated and is an admin
     * Use this method at the beginning of each controller method
     */
    private function checkAdmin()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        
        // You can uncomment this when you have role checking in place
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Unauthorized access');
        }
        
        return null;
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $redirectResponse = $this->checkAdmin();
        if ($redirectResponse) {
            return $redirectResponse;
        }
        
        // Get real data for the dashboard
        $totalSales = Order::sum('total_amount');
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalCustomers = User::where('role', '!=', 'admin')->count();
        
        // Get sales data for chart
        $monthlySales = [];
        for ($i = 1; $i <= 12; $i++) {
            $month = now()->startOfYear()->addMonths($i - 1);
            $monthlySales[] = Order::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->sum('total_amount');
        }
        
        // Get low stock products
        $lowStockProducts = Product::lowStock(10)->with('category')->take(5)->get();
        
        // Get recent orders
        $recentOrders = Order::with('user')->latest()->take(3)->get();
        
        // Get revenue by category
        $categories = Category::all();
        $categoryRevenue = [];
        $categoryLabels = [];
        
        foreach ($categories as $category) {
            $revenue = OrderItem::join('products', 'order_items.product_id', '=', 'products.id')
                ->where('products.category', $category->name)
                ->sum('order_items.total');
            
            if ($revenue > 0) {
                $categoryRevenue[] = $revenue;
                $categoryLabels[] = $category->name;
            }
        }
        
        // Get recent activity
        $recentActivity = collect();
        
        // Add recent orders to activity
        $recentOrdersActivity = Order::with('user')->latest()->take(2)->get()->map(function ($order) {
            return [
                'type' => 'order',
                'message' => 'New order placed',
                'details' => 'Order #' . $order->id . ' from ' . $order->user->fullname,
                'time' => $order->created_at,
                'icon' => 'fa-shopping-bag',
                'color' => 'blue'
            ];
        });
        
        // Add recent users to activity
        $recentUsersActivity = User::latest()->take(1)->get()->map(function ($user) {
            return [
                'type' => 'user',
                'message' => 'New customer registered',
                'details' => $user->fullname . ' created an account',
                'time' => $user->created_at,
                'icon' => 'fa-user-plus',
                'color' => 'pink'
            ];
        });
        
        // Add recent products to activity
        $recentProductsActivity = Product::latest()->take(1)->get()->map(function ($product) {
            return [
                'type' => 'product',
                'message' => 'New product added',
                'details' => $product->name,
                'time' => $product->created_at,
                'icon' => 'fa-tshirt',
                'color' => 'indigo'
            ];
        });
        
        $recentActivity = $recentOrdersActivity->concat($recentUsersActivity)
            ->concat($recentProductsActivity)
            ->sortByDesc('time')
            ->take(4);
        
        return view('admin.dashboard', compact(
            'totalSales', 
            'totalOrders', 
            'totalProducts', 
            'totalCustomers',
            'monthlySales',
            'lowStockProducts',
            'recentOrders',
            'categoryRevenue',
            'categoryLabels',
            'recentActivity'
        ));
    }

    /**
     * Show the products management page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function products()
    {
        $redirectResponse = $this->checkAdmin();
        if ($redirectResponse) {
            return $redirectResponse;
        }
        
        $products = Product::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the orders management page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function orders()
    {
        $redirectResponse = $this->checkAdmin();
        if ($redirectResponse) {
            return $redirectResponse;
        }

        // Implement this when Order model is available
        $orders = Order::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.orders.index', compact('orders')); // , compact('orders')
    }

    /**
     * Show the users management page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function users()
    {
        $redirectResponse = $this->checkAdmin();
        if ($redirectResponse) {
            return $redirectResponse;
        }
        
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the categories management page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function categories()
    {
        $redirectResponse = $this->checkAdmin();
        if ($redirectResponse) {
            return $redirectResponse;
        }
        
        // Implement this when Category model is available
        // $categories = Category::orderBy('name')->paginate(10);
        return view('admin.categories.index'); // , compact('categories')
    }

    /**
     * Show the reports page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function reports()
    {
        $redirectResponse = $this->checkAdmin();
        if ($redirectResponse) {
            return $redirectResponse;
        }
        
        return view('admin.reports');
    }

    /**
     * Show the settings page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function settings()
    {
        $redirectResponse = $this->checkAdmin();
        if ($redirectResponse) {
            return $redirectResponse;
        }
        
        return view('admin.settings');
    }
} 