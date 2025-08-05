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
                            <h3 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Edit Produk</h3>
                            <a href="#" class="btn btn-light btn-sm" onclick="history.back()">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <form id="formTambahKategori">
                            <div class="mb-4">
                                <label for="namaProduk" class="form-label required-field">Nama Produk</label>
                                <input type="text" class="form-control" id="namaProduk" placeholder="Masukkan nama produk" required>
                                
                                <label for="deskripsi" class="form-label mt-3 required-field">Deskripsi Produk</label>
                                <textarea class="form-control" id="deskripsi" rows="3" placeholder="Masukkan deskripsi produk" required></textarea>
                                
                                <label for="stok" class="form-label mt-3 required-field">Stok</label>
                                <input type="number" class="form-control" id="stok" placeholder="Masukkan jumlah stok" required>
                                
                                <label for="harga" class="form-label mt-3 required-field">Harga</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control" id="harga" placeholder="Masukkan harga produk" required>
                                </div>
                                
                                <label for="gambar" class="form-label mt-3">Gambar Produk</label>
                                <input type="file" class="form-control" id="gambar" accept="image/*">
                                
                                <label for="kategori" class="form-label mt-3 required-field">Kategori Produk</label>
                                <select class="form-select" id="kategori" required>
                                    <option value="" selected disabled>Pilih kategori</option>
                                    <option value="elektronik">Elektronik</option>
                                    <option value="fashion">Fashion</option>
                                    <option value="makanan">Makanan</option>
                                </select>
                            </div>
                            
                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-submit btn-lg py-2">
                                    <i class="fas fa-save me-2"></i> Simpan Produk
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
    