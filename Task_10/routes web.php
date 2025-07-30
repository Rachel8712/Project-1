<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'Route web utama';
});

Route::get('/products', function () {
    return 'Route web products';
});

Route::get('/cart', function () {
    return 'Route web cart';
});

Route::get('/checkout', function () {
    return 'Route web checkout';
});
