<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Daftar Produk') }}
        </h2>
    </x-slot>
    <div class="container mt-5">
    @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
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

    <!-- Delete Confirmation Modal -->
<div class="modal fade" id="hapusModal" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapusModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus produk ini?
            </div>
            <div class="modal-footer">
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    const deleteButtons = document.querySelectorAll('.btn-danger');
    const deleteForm = document.getElementById('deleteForm');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.closest('tr').querySelector('td').innerText; // Get the product ID from the row
            deleteForm.action = `/products/${productId}`; // Set the form action to the delete route
        });
    });
</script>
</x-app-layout>
