<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Daftar Produk') }}
        </h2>
    </x-slot>
    <div class="container mt-5">
        <div class="header-section">
            <div>
                <a href="{{ route('products-addnew') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Produk
                </a>
            </div>
        </div>

        <div class="card table-container">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Daftar Produk</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3 search-box">
                            <input type="text" class="form-control" placeholder="Cari produk...">
                            <button class="btn btn-outline-secondary" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nama Produk</th>
                                <th>Deskripsi</th>
                                <th>Stok</th>
                                <th>Harga</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Americano</td>
                                <td>Americano: Kopi, Air, Sejati.</td>
                                <td>150</td>
                                <td>Rp 15.000</td>
                                <td><img scr="https://via.placeholder.com/150" alt="Americano"></td>
                                <td>
                                    <a href="{{ route('products-edit') }}" class="btn btn-sm btn-warning action-btn">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <button class="btn btn-sm btn-danger action-btn" data-bs-toggle="modal" data-bs-target="#hapusModal">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <!-- <td>2</td>
                                <td>Fashion</td>
                                <td>87</td>
                                <td>
                                    <button class="btn btn-sm btn-warning action-btn" data-bs-toggle="modal" data-bs-target="#editModal">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="btn btn-sm btn-danger action-btn" data-bs-toggle="modal" data-bs-target="#hapusModal">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Kesehatan</td>
                                <td>42</td>
                                <td>
                                    <button class="btn btn-sm btn-warning action-btn" data-bs-toggle="modal" data-bs-target="#editModal">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="btn btn-sm btn-danger action-btn" data-bs-toggle="modal" data-bs-target="#hapusModal">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

</x-app-layout>
