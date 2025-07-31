<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .product-image {
            transition: transform 0.3s ease;
        }
        .product-card:hover .product-image {
            transform: scale(1.05);
        }
        /* Kelas untuk tombol yang terpilih */
        .selected-option {
            background-color: #2563eb; /* bg-blue-600 */
            color: #ffffff; /* text-white */
        }
    </style>
</head>
<body class="bg-gray-50">

<!-- Navbar -->
 @include('.dashboard.navbar')

    <!-- Content-->
   @yield('content')

   <x-footer></x-footer>

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

    

        // Fungsi untuk menampilkan produk
        function displayProducts(productsToDisplay) {
            const productsContainer = document.getElementById('productsContainer');
            productsContainer.innerHTML = '';
            
            productsToDisplay.forEach(product => {
                const productCard = document.createElement('div');
                productCard.className = 'product-card bg-white rounded-xl overflow-hidden shadow-md transition duration-300';
                productCard.innerHTML = `
                    <div class="relative overflow-hidden">
                        <img src="${product.image}" alt="${product.name}" class="product-image w-full h-48 object-cover">
                    </div>
                    <div class="p-5">
                        <h3 class="text-xl font-semibold mb-2 text-gray-800">${product.name}</h3>
                        <p class="text-gray-600 mb-3">${product.description}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-[#CAA494] font-bold">Rp${product.price.toLocaleString('id-ID')}</span>
                            <span class="bg-[#CAA494] text-[#4E3D19] text-xs px-2 py-1 rounded">${product.category}</span>
                        </div>
                        <div class= "mt-4 flex flex-col space-y-2">
                            <!-- Tombol untuk pilihan Ice/Hot -->
                            <button id="iceOptionBtn-${product.id}" class="bg-gray-200 text-gray-800 py-2 rounded-lg hover:bg-gray-300 transition flex items-center justify-between px-4">
                                <span>Add (Ice/Hot)</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div id="iceOptions-${product.id}" class="hidden bg-white border border-gray-200 rounded-lg p-2 shadow">
                                <div class="flex space-x-2">
                                    <button class="ice-hot-option bg-gray-100 text-gray-800 px-3 py-1 rounded flex-1" data-option="ice">Ice</button>
                                    <button class="ice-hot-option bg-gray-100 text-gray-800 px-3 py-1 rounded flex-1" data-option="hot">Hot</button>
                                </div>
                            </div>

                            <!-- Tombol untuk pilihan Large/Reguler -->
                            <button id="sizeOptionBtn-${product.id}" class="bg-gray-200 text-gray-800 py-2 rounded-lg hover:bg-gray-300 transition flex items-center justify-between px-4">
                                <span>Add (Size)</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div id="sizeOptions-${product.id}" class="hidden bg-white border border-gray-200 rounded-lg p-2 shadow">
                                <div class="flex space-x-2">
                                    <button class="size-option bg-gray-100 text-gray-800 px-3 py-1 rounded flex-1" data-option="large">Large</button>
                                    <button class="size-option bg-gray-100 text-gray-800 px-3 py-1 rounded flex-1" data-option="reguler">Reguler</button>
                                </div>
                            </div>

                            <button class="w-full bg-[#CAA494] text-white py-2 rounded-lg hover:bg-[#63612C] transition">Tambah ke Keranjang</button>
                        </div>
                    </div>
                `;
                productsContainer.appendChild(productCard);
            });
        }

        // Fungsi untuk filter produk
        function filterProducts() {
            const category = document.getElementById('categoryFilter').value;
            let filteredProducts;
            
            if (category === 'all') {
                filteredProducts = products;
            } else {
                filteredProducts = products.filter(product => product.category === category);
            }
            
            displayProducts(filteredProducts);
        }

        // Event listener untuk tombol filter
        document.getElementById('filterButton').addEventListener('click', filterProducts);

        // Menampilkan semua produk saat halaman pertama kali dimuat
        window.onload = function() {
            displayProducts(products);

            // Tambahkan event listener untuk tombol pilihan es dan ukuran
            products.forEach(product => {
                // Ice/Hot options toggle
                const iceBtn = document.getElementById(`iceOptionBtn-${product.id}`);
                const iceOptionsDiv = document.getElementById(`iceOptions-${product.id}`);

                if (iceBtn && iceOptionsDiv) {
                    iceBtn.addEventListener('click',() => {
                        iceOptionsDiv.classList.toggle('hidden');
                    });
                }

                // Size options toggle
                const sizeBtn = document.getElementById(`sizeOptionBtn-${product.id}`);
                const sizeOptionsDiv = document.getElementById(`sizeOptions-${product.id}`);

                if (sizeBtn && sizeOptionsDiv) {
                    sizeBtn.addEventListener('click',() => {
                        sizeOptionsDiv.classList.toggle('hidden');
                    });
                }

                // Handle selection for Ice/Hot options
                const iceHotButtons = iceOptionsDiv ? iceOptionsDiv.querySelectorAll('.ice-hot-option') : [];
                iceHotButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        // Remove 'selected-option' from all siblings
                        iceHotButtons.forEach(btn => btn.classList.remove('selected-option', 'bg-blue-100', 'text-blue-800'));
                        iceHotButtons.forEach(btn => btn.classList.add('bg-gray-100', 'text-gray-800'));
                        
                        // Add 'selected-option' to the clicked button
                        this.classList.add('selected-option', 'bg-blue-100', 'text-blue-800');
                        this.classList.remove('bg-gray-100', 'text-gray-800');
                    });
                });

                // Handle selection for Size options
                const sizeButtons = sizeOptionsDiv ? sizeOptionsDiv.querySelectorAll('.size-option') : [];
                sizeButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        // Remove 'selected-option' from all siblings
                        sizeButtons.forEach(btn => btn.classList.remove('selected-option', 'bg-blue-100', 'text-blue-800'));
                        sizeButtons.forEach(btn => btn.classList.add('bg-gray-100', 'text-gray-800'));

                        // Add 'selected-option' to the clicked button
                        this.classList.add('selected-option', 'bg-blue-100', 'text-blue-800');
                        this.classList.remove('bg-gray-100', 'text-gray-800');
                    });
                });
            });

            // Smooth scrolling for navigation links (both header and foter)
            document.querySelectorAll('nav a[href^="#"], footer a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault(); // Mencegah perilaku default tautan

                    const targetId = this.getAttribute('href');
                    const targetElement = document.querySelector(targetId);

                    if (targetElement) {
                        targetElement.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                });
            });
        };
    </script>
</body>
</html>
