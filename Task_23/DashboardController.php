<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        //Menampilkan jumlah produk
        $jumlahProduk = Product::count();

        //Menghitung total klik
        $jumlahKlikProduk = Product::sum('click');

        //Menampilkan jumlah kategori produk
        $jumlahKategoriProduk = ProductCategory::count();

        return view("dashboard",
        compact(
            "jumlahProduk",
            "jumlahKlikProduk",
            "jumlahKategoriProduk"
            ));
    }
}
