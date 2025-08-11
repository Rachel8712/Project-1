<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-black overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card bg-primary-subtle">
                                    <div class="card-header text-black fw-bold ">
                                    Jumlah Produk
                                    </div>
                                    <div class="card-body text-black">
                                        <h1 class="card-title fw-bold" style="font-size: 30px;">{{$jumlahProduk}}</h1>
                                        <p class="card-text">Total produk yang tersedia di sistem.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-success-subtle ">
                                    <div class="card-header text-black fw-bold">
                                    Jumlah Klik Produk
                                    </div>
                                    <div class="card-body text-black">
                                        <h1 class="card-title fw-bold" style="font-size: 30px;">{{ $jumlahKlikProduk }}</h1>
                                        <p class="card-text">Total klik pada produk yang telah dilihat pengguna.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-warning-subtle">
                                    <div class="card-header text-black fw-bold">
                                    Jumlah Kategori Produk
                                    </div>
                                    <div class="card-body text-black">
                                        <h1 class="card-title fw-bold" style="font-size: 30px;">{{ $jumlahKategoriProduk }}</h1>
                                        <p class="card-text">Total kategori produk yang tersedia di sistem.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
