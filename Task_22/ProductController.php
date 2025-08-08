<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource with pagination and filtering.
     */
    public function index(Request $request)
    {
        $products = Product::with('category')->paginate(5);
        $products->appends($request->query());
        return view('dashboard.products.index', compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ProductCategory::all();
        return view("dashboard.products.addnew", compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi data yang masuk
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'stock' => 'required|integer|min:0',
            'product_category_id' => 'required|integer|exists:product_categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $categories = ProductCategory::findOrFail($request->product_category_id);
        
        $product = new Product;
        $product->name = $request->name;
        $product->price = $request->price;  
        $product->description = $request->description;
        $product->stock = $request->stock;
        $product->product_category_id = $categories->id;
        if($request->hasFile('image')){
            $product->image = $request->file('image')->store('products','public');
        }
        $product->save();
        
        // 5. Redirect ke halaman 'products.index' dengan pesan sukses
        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');

        


    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = ProductCategory::all();
        return view('dashboard.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // 1. Validasi data yang masuk
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'stock' => 'required|integer|min:0',
            'product_category_id' => 'required|integer|exists:product_categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);
    
        $product->name = $request->name;
        $product->price = $request->price;  
        $product->description = $request->description;
        $product->stock = $request->stock;
        $product->product_category_id = $request->product_category_id;
        if($request->hasFile('image')){
            $product->image = $request->file('image')->store('products','public');
        }
        $product->save();
    
        // 5. Redirect ke halaman 'products.index' dengan pesan sukses
        return redirect()->route('products.index')->with('success', 'Update produk berhasil!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product = Product::findOrFail($product->id);
        $product->delete(); // Delete the product
        return redirect()->route('products.index')
                    ->with('success', 'Produk berhasil dihapus!');
    }
}