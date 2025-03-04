<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
       if(Auth::guest()){
            return redirect('/login');
       }
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('products.index',[
            'products' => $products,
        ]);
    }

    public function filter(Request $request)
    {
        // Validate the inputs
        $request->validate([
            'name' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
        ]);
    
        // Get the validated inputs
        $name = $request->input('name');
        $category = $request->input('category');
    
        // Filter products based on the inputs
        $products = Product::when($name, function ($query) use ($name) {
                            return $query->where('name', 'LIKE', '%' . $name . '%');
                        })
                        ->when($category, function ($query) use ($category) {
                            return $query->where('category', '=', '' . $category . '');
                        })
                        ->orderBy('created_at', 'desc')
                        ->get();
    
        // Pass the filtered products to the view
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string|max:1000',
            'category' => 'required|string|max:255',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }


        Product::create([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'image' => $imagePath,
            'description' => $request->description,
            'category' => $request->category,
        ]);

        return redirect()->route('products.index')->with('success', 'Product added successfully!');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function find(int $id)
    {
        $username = Auth::user()->fullname;
        $product = Product::find($id);
        return view('products.item', compact('product', 'username'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string|max:1000',
            'category' => 'required|string|max:255'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        $product->update([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'description' => $request->description,
            'category' => $request->category
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}
