<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Daftar Produk') }}
        </h2>
    </x-slot>
    <div class="container mt-5">
        <div class="header-section">
            <div>
                <a href="{{ route('products.create') }}" class="btn btn-primary">
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
                            @foreach ($products as $product )
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->description }}</td>
                                <td>{{$product->stock}}</td>
                                <td>Rp{{number_format($product->price, 0,",", ".")}}</td>
                                <td><img src= "{{ asset('storage/'. $product->image) }}" alt={{ $product->name }} class="img-fluid" style="max-height: 150px"></td>
                                <td>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning action-btn">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <button class="btn btn-sm btn-danger action-btn" data-bs-toggle="modal" data-bs-target="#hapusModal">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <nav aria-label="Page navigation">
                    {{ $products->links() }}
                </nav>
            </div>
        </div>
    </div>

</x-app-layout>
