<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Edit Kategori Produk') }}
        </h2>
    </x-slot>
         
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-header py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Edit Kategori Baru</h3>
                            <a href="#" class="btn btn-light btn-sm" onclick="history.back()">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{route('category-products.update', $category->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label for="name" class="form-label required-field">Nama Kategori Baru</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}"placeholder="Masukkan nama kategori" required>
                                <div class="form-text text-muted">Masukkan nama kategori yang deskriptif dan unik.</div>
                            </div>
                            
                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-submit btn-lg py-2">
                                    <i class="fas fa-save me-2"></i> Update Kategori Baru
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
   
