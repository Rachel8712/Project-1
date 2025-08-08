<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Edit Produk') }}
        </h2>
    </x-slot>
            
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-header py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Produk</h3>
                            <a href="{{ route('products.index') }}" class="btn btn-light btn-sm">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label for="name" class="form-label required-field">Nama Produk</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" placeholder="Masukkan nama produk" required>
                                
                                <label for="description" class="form-label mt-3 required-field">Deskripsi Produk</label>
                                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Masukkan deskripsi produk" required>{{ $product->description }}</textarea>
                                
                                <label for="stock" class="form-label mt-3 required-field">Stok</label>
                                <input type="number" class="form-control" id="stock" name="stock" value="{{ $product->stock }}" placeholder="Masukkan jumlah stok" required>
                                
                                <label for="price" class="form-label mt-3 required-field">Harga</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}" placeholder="Masukkan harga produk" required>
                                </div>
                                
                                <label for="image" class="form-label mt-3">Gambar Produk Saat Ini</label>
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid" style="max-height: 150px">
                                </div>
                                
                                <label for="image" class="form-label mt-3">Ganti Gambar Produk</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                
                                <label for="product_category_id" class="form-label mt-3 required-field">Kategori Produk</label>
                                <select class="form-select" id="product_category_id" name="product_category_id" required>
                                    <option value="" disabled>Pilih kategori</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ $product->product_category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-submit btn-lg py-2">
                                    <i class="fas fa-save me-2"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>