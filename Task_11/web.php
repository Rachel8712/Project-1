<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return 'Route web utama';
});

//Route::get('/products', function () {
//    return 'Route web products';//
//});

Route::get('/cart', function () {
    return 'Route web cart';
});

Route::get('/checkout', function () {
    return 'Route web checkout';
});

Route::resource('products', ProductController::class);
