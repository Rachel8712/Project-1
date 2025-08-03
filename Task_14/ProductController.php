<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource with pagination and filtering.
     */
    public function index()
    {
        return view('dashboard.home', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("products.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi data yang masuk
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'stock' => 'required|integer|min:0',
            'product_category_id' => 'required|integer|exists:product_category,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        // 2. Unggah file gambar dan simpan ke folder 'picture_product'
        // dan dapatkan path-nya.
        $imagePath = $request->file('image')->store('pictureproduct', 'public');
        
        // 3. Gabungkan path gambar ke dalam data yang divalidasi
        $validatedData['image'] = $imagePath;
        
        // 4. Buat dan simpan produk baru ke database
        Product::create($validatedData);
        
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}