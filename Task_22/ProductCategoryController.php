<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ProductCategory::withCount('products')->paginate(5);
        return view('dashboard.category_products.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.category_products.addnew');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        @request()->validate([
            'name'=> ['required', 'string', 'max:255']
        ]);

        $name_check = ProductCategory::where('name', $request->name)->exists();

        if ($name_check) {
            return back()
            ->withInput()
            ->withErrors(['Category name already exists']);
        }else {
            $category = new ProductCategory();
            $category->name = $request->name;
            $category->save();
            return redirect()
                ->route('category-products.index')
                ->with('success','Category created successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = ProductCategory::findOrFail($id);
        return view('dashboard.category_products.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        @request()->validate([
            'name'=> ['required', 'string', 'max:255']
        ]);

        $name_check = ProductCategory::where('name', $request->name)
        ->where('id', '!=', $id)
        ->exists();

        if ($name_check) {
            return back()
            ->withInput()
            ->withErrors(['Category name already exists']);
        }else {
            $category = ProductCategory::findOrFail($id);
            $category->name = $request->name;
            $category->save();
            
            return redirect()
                ->route('category-products.index')
                ->with('success','Update Kategori Berhasil!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = ProductCategory::findOrFail($id);
        $category->delete();
        
        return redirect()->route('category-products.index')
                   ->with('success', 'Kategori berhasil dihapus!');
    }
}
