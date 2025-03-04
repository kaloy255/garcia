<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Middleware is now applied at the route level
        // No longer using middleware in constructor for Laravel 11 compatibility
    }

    /**
     * Display the user's cart
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = Session::get('cart', []);
        $cartItems = [];
        $total = 0;
        
        // Get product details for each cart item
        foreach ($cart as $id => $item) {
            $product = Product::find($id);
            if ($product) {
                $cartItems[] = [
                    'id' => $id,
                    'product' => $product,
                    'quantity' => $item['quantity'],
                    'subtotal' => $product->price * $item['quantity']
                ];
                $total += $product->price * $item['quantity'];
            }
        }
        
        return view('cart.index', compact('cartItems', 'total'));
    }
    
    /**
     * Add a product to the cart
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        try {
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'quantity' => 'required|integer|min:1'
            ]);
            
            $productId = $request->product_id;
            $quantity = $request->quantity;
            
            // Get the product
            $product = Product::findOrFail($productId);
            
            // Check if there's enough stock
            if ($product->quantity < $quantity) {
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Not enough stock available!'
                    ], 422);
                }
                
                return redirect()->back()->with('error', 'Not enough stock available!');
            }
            
            // Get current cart
            $cart = Session::get('cart', []);
            
            // Check if product is already in cart
            if (isset($cart[$productId])) {
                // Update quantity
                $cart[$productId]['quantity'] += $quantity;
            } else {
                // Add to cart
                $cart[$productId] = [
                    'quantity' => $quantity
                ];
            }
            
            // Update session
            Session::put('cart', $cart);
            
            // Calculate total cart items
            $totalItems = 0;
            foreach ($cart as $item) {
                $totalItems += $item['quantity'];
            }
            
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Product added to cart!',
                    'cart_count' => $totalItems,
                    'product_name' => $product->name,
                    'cart_items' => $cart
                ]);
            }
            
            return redirect()->route('cart.index')->with('success', 'Product added to cart!');
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error adding product to cart: ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->back()->with('error', 'Error adding product to cart: ' . $e->getMessage());
        }
    }
    
    /**
     * Update cart item quantity
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);
        
        $cart = Session::get('cart', []);
        
        if (isset($cart[$id])) {
            // Get the product
            $product = Product::findOrFail($id);
            
            // Check if there's enough stock
            if ($product->quantity < $request->quantity) {
                return redirect()->back()->with('error', 'Not enough stock available!');
            }
            
            $cart[$id]['quantity'] = $request->quantity;
            Session::put('cart', $cart);
        }
        
        return redirect()->route('cart.index')->with('success', 'Cart updated!');
    }
    
    /**
     * Remove an item from the cart
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function remove($id)
    {
        $cart = Session::get('cart', []);
        
        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }
        
        return redirect()->route('cart.index')->with('success', 'Item removed from cart!');
    }
    
    /**
     * Remove multiple items from the cart
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function removeMultiple(Request $request)
    {
        $request->validate([
            'item_ids' => 'required|array',
            'item_ids.*' => 'required|integer'
        ]);
        
        $itemIds = $request->item_ids;
        $cart = Session::get('cart', []);
        
        foreach ($itemIds as $id) {
            if (isset($cart[$id])) {
                unset($cart[$id]);
            }
        }
        
        Session::put('cart', $cart);
        
        return redirect()->route('cart.index')->with('success', 'Selected items removed from cart!');
    }
} 