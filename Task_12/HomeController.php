<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view(".dashboard.home");
    }

    public function cart(){
        return view(".dashboard.cart");
    }
}
