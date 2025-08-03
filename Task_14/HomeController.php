<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index(Request $request){
        // Mulai query dengan filter
        $query = Product::query();

        if ($request->has('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        // Terapkan pagination pada hasil query
        $products = $query->paginate(5);
        
        return view(".dashboard.home", compact("products"));
    }

    public function cart(){
        return view(".dashboard.cart");
    }
    
}
