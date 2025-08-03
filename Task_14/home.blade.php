@extends('.dashboard.layout')
@section('title','Adelysia Coffee - Toko Minuman Online')
@section('content')

    <section class="bg-[url('/storage/pictureproduct/Cafe.jpeg')] bg-cover bg-center text-white py-20 relative" id="hero-section">
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="container mx-auto px-4 text-center relative z-10">
            <h1 class="text-4xl font-bold mb-4">Bangkitkan Semangatmu, Sempurnakan Hari Ini</h1>
            <p class="text-xl mb-8">Temukan berbagai pilihan coffee untuk setiap sruputnyaa</p>
            <button class="bg-white text-[#4E3D19] px-8 py-3 rounded-full font-semibold hover:bg-[#92A387] transition">Belanja Sekarang</button>
        </div>
    </section>

    <section class="container mx-auto px-4 py-10" id="products-section">
        <div class="flex flex-col md:flex-row justify-between items-center mb-10">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 md:mb-0">Our Products</h2>
            <div class="flex space-x-4">
                <select id="categoryFilter" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="all">All Drinks</option>
                    <option value="Classic Coffee">Classic Coffee</option>
                    <option value="Classic Tea">Classic Tea</option>
                    <option value="Non-Coffee">Non-Coffee</option>
                </select>
                <button id="filterButton" class="bg-[#CAA494] text-white px-6 py-2 rounded-lg hover:bg-[#63612C] transition">Filter</button>
            </div>
        </div>
        
        <div id="productsContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            {{-- Bagian ini akan di-looping --}}
            @foreach ($products as $product)
                <div class="product-card bg-white rounded-xl overflow-hidden shadow-md transition duration-300">
                    <div class="relative overflow-hidden">
                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="product-image w-full h-48 object-cover">
                    </div>
                    <div class="p-5">
                        <h3 class="text-xl font-semibold mb-2 text-gray-800">{{ $product->name }}</h3>
                        <p class="text-gray-600 mb-3">{{ $product->description }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-[#CAA494] font-bold">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                            <span class="bg-[#CAA494] text-[#4E3D19] text-xs px-2 py-1 rounded">{{ $product->category }}</span>
                        </div>
                        <div class="mt-4 flex flex-col space-y-2">
                            <button id="iceOptionBtn-{{ $product->id }}" class="bg-gray-200 text-gray-800 py-2 rounded-lg hover:bg-gray-300 transition flex items-center justify-between px-4">
                                <span>Add (Ice/Hot)</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div id="iceOptions-{{ $product->id }}" class="hidden bg-white border border-gray-200 rounded-lg p-2 shadow">
                                <div class="flex space-x-2">
                                    <button class="ice-hot-option bg-gray-100 text-gray-800 px-3 py-1 rounded flex-1" data-option="ice">Ice</button>
                                    <button class="ice-hot-option bg-gray-100 text-gray-800 px-3 py-1 rounded flex-1" data-option="hot">Hot</button>
                                </div>
                            </div>
    
                            <button id="sizeOptionBtn-{{ $product->id }}" class="bg-gray-200 text-gray-800 py-2 rounded-lg hover:bg-gray-300 transition flex items-center justify-between px-4">
                                <span>Add (Size)</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div id="sizeOptions-{{ $product->id }}" class="hidden bg-white border border-gray-200 rounded-lg p-2 shadow">
                                <div class="flex space-x-2">
                                    <button class="size-option bg-gray-100 text-gray-800 px-3 py-1 rounded flex-1" data-option="large">Large</button>
                                    <button class="size-option bg-gray-100 text-gray-800 px-3 py-1 rounded flex-1" data-option="reguler">Reguler</button>
                                </div>
                            </div>
    
                            <button class="w-full bg-[#CAA494] text-white py-2 rounded-lg hover:bg-[#63612C] transition">Tambah ke Keranjang</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        {{-- Pagination --}}
        <div class="mt-8">
            {{ $products->links() }}
        </div>
    </section>
@endsection

@push('script')
    <script>
        // Smooth scrolling for navigation links (both header and footer)
        document.querySelectorAll('nav a[href^="#"], footer a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault(); // Prevent default anchor behavior
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth'  
                    });
                }
            });
        });
        
        // --- Perubahan di bagian ini ---
        // Karena data produk sudah diambil dari server, kita tidak perlu array JS lagi.
        // Fungsi filter perlu dimodifikasi untuk memuat ulang halaman dengan filter.
        // Jika ingin filter dinamis tanpa reload halaman, kamu bisa menggunakan AJAX.
        
        // Event listener untuk tombol filter
        document.getElementById('filterButton').addEventListener('click', function() {
            const category = document.getElementById('categoryFilter').value;
            window.location.href = `?category=${category}`; // Redirect ke URL dengan parameter filter
        });

        // Menambahkan event listener untuk tombol pilihan es dan ukuran
        // Kode ini tidak perlu looping `products` lagi, tapi bisa langsung mencari elemen berdasarkan ID
        document.querySelectorAll('.product-card').forEach(card => {
            const productId = card.querySelector('[id^="iceOptionBtn-"]').id.split('-')[1];

            // Ice/Hot options toggle
            const iceBtn = document.getElementById(`iceOptionBtn-${productId}`);
            const iceOptionsDiv = document.getElementById(`iceOptions-${productId}`);
            if (iceBtn && iceOptionsDiv) {
                iceBtn.addEventListener('click', () => {
                    iceOptionsDiv.classList.toggle('hidden');
                });
            }

            // Size options toggle
            const sizeBtn = document.getElementById(`sizeOptionBtn-${productId}`);
            const sizeOptionsDiv = document.getElementById(`sizeOptions-${productId}`);
            if (sizeBtn && sizeOptionsDiv) {
                sizeBtn.addEventListener('click', () => {
                    sizeOptionsDiv.classList.toggle('hidden');
                });
            }

            // Handle selection for Ice/Hot options
            const iceHotButtons = iceOptionsDiv ? iceOptionsDiv.querySelectorAll('.ice-hot-option') : [];
            iceHotButtons.forEach(button => {
                button.addEventListener('click', function() {
                    iceHotButtons.forEach(btn => btn.classList.remove('selected-option', 'bg-blue-100', 'text-blue-800'));
                    iceHotButtons.forEach(btn => btn.classList.add('bg-gray-100', 'text-gray-800'));
                    
                    this.classList.add('selected-option', 'bg-blue-100', 'text-blue-800');
                    this.classList.remove('bg-gray-100', 'text-gray-800');
                });
            });

            // Handle selection for Size options
            const sizeButtons = sizeOptionsDiv ? sizeOptionsDiv.querySelectorAll('.size-option') : [];
            sizeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    sizeButtons.forEach(btn => btn.classList.remove('selected-option', 'bg-blue-100', 'text-blue-800'));
                    sizeButtons.forEach(btn => btn.classList.add('bg-gray-100', 'text-gray-800'));
    
                    this.classList.add('selected-option', 'bg-blue-100', 'text-blue-800');
                    this.classList.remove('bg-gray-100', 'text-gray-800');
                });
            });
        });
    </script>
@endpush