<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
  //  return view('welcome');
//});

Route::get("/", [HomeController::class,"index"]);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/products', function () {
  return view('dashboard.products.index');
})-> name('products');

Route::get('/products/addnew', function () {
  return view('dashboard.products.addnew');
})-> name('products-addnew');

Route::get('/products/edit', function () {
  return view('dashboard.products.edit');
})-> name('products-edit');

Route::get('/category-products', function () {
  return view('dashboard.category_products.index');
})-> name('category-products');

Route::get('/category-products/addnew', function () {
  return view('dashboard.category_products.addnew');
})-> name('category-products-addnew');

Route::get('/category-products/edit', function () {
  return view('dashboard.category_products.edit');
})-> name('category-products-edit');
