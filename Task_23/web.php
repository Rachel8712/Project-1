<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
  //  return view('welcome');
//});

Route::get("/", [HomeController::class,"index"]);





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');

    Route::resource('category-products',ProductCategoryController::class);
    Route::resource('products', ProductController::class);
    
});

require __DIR__.'/auth.php';



// Route::get('/products/addnew', function () {
//   return view('dashboard.products.addnew');
// })-> name('products-addnew');

// Route::get('/products/edit', function () {
//   return view('dashboard.products.edit');
// })-> name('products-edit');



// Route::get('/category-products/addnew', function () {
//   return view('dashboard.category_products.addnew');
// })-> name('category-products-addnew');

// Route::get('/category-products/edit', function () {
//   return view('dashboard.category_products.edit');
// })-> name('category-products-edit');
