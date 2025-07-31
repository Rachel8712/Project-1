@extends('.dashboard.layout')
@section('title','Adelysia Coffee - Toko Minuman Online')
@section('content')


    <!-- Hero Section -->
    <section class="bg-[url('picture_product/Cafe.jpeg')] bg-cover bg-center text-white py-20 relative" id="hero-section">
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="container mx-auto px-4 text-center relative z-10">
            <h1 class="text-4xl font-bold mb-4">Bangkitkan Semangatmu, Sempurnakan Hari Ini</h1>
            <p class="text-xl mb-8">Temukan berbagai pilihan coffee untuk setiap sruputnyaa</p>
            <button class="bg-white text-[#4E3D19] px-8 py-3 rounded-full font-semibold hover:bg-[#92A387] transition">Belanja Sekarang</button>
        </div>
    </section>

    <!-- Filter Section -->
    <section class="container mx-auto px-4 py-10" id="products-section">
        <div class="flex flex-col md:flex-row justify-between items-center mb-10">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 md:mb-0">Our Products</h2>
            <div class="flex space-x-4">
                <select id="categoryFilter" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="all">All Drinks</option>
                    <option value="teh">Classic Coffee</option>
                    <option value="kopi">Classic Tea</option>
                    <option value="kopi">Non_Coffee</option>
                </select>
                <button id="filterButton" class="bg-[#CAA494] text-white px-6 py-2 rounded-lg hover:bg-[#63612C] transition">Filter</button>
            </div>
        </div>
        
        <!-- Products Container -->
        <div id="productsContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            <!-- Products will be loaded here by JavaScript -->
        </div>
    </section>

    @endsection
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

        // Array data produk minuman
        const products = [
            {
                id: 1,
                name: "Americano",
                price: 15000,
                description: "Americano: Kopi, Air, Sejati.",
                category: "Classic Coffee",
                image: "./picture_product/Americano.jpeg"
            },
            {
                id: 2,
                name: "Espresso",
                price: 12000,
                description: "Espresso: Jantung Kopi Sejati.",
                category: "Classic COffee",
                image: "./picture_product/Espresso.jpeg"
            },
            {
                id: 3,
                name: "Cappucino",
                price: 15000,
                description: "Cappucino: Kelembutan dalam Genggaman.",
                category: "Classic Coffee",
                image: "./picture_product/Cappuccino.jpeg"
            },
            {
                id: 4,
                name: "Matcha Latte",
                price: 20000,
                description: "Manisnya Matcha, Lembutnya Susu.",
                category: "Non-Coffee",
                image: "./picture_product/Matcha Latte.jpeg"
            },
            {
                id: 5,
                name: "Taro Latte",
                price: 20000,
                description: "Keajaiban Ungu dengan Aroma Unik dan Rasa yang Memikat.",
                category: "Non-Coffee",
                image: "./picture_product/Taro Latte.jpeg"
            },
            {
                id: 6,
                name: "Thai Tea",
                price: 23000,
                description: "Sensasi Eksotis Thailand dengan Rasa yang Menggoda.",
                category: "Non-Coffee",
                image: "./picture_product/Thai Tea.jpeg"
            },
            {
                id: 7,
                name: "Ice Tea Original",
                price: 5000,
                description: "Penawar Dahaga Terbaik dengan Rasanya yang Klasik.",
                category: "Classic Tea",
                image: "./picture_product/Ice Tea Original.jpeg"
            },
            {
                id: 8,
                name: "Chamomile Tea",
                price: 7000,
                description: "Penenang Jiwa dalam Kedamaian Herbal.",
                category: "Classic Tea",
                image: "./picture_product/Chamomile Tea.jpeg"
            },
            {
                id: 9,
                name: "Earl Grey Tea",
                price: 7000,
                description:"Teh dengan Aroma Bergamot dengan Ketenangan yang Berkelas",
                category: "Classic Tea",
                image: "./picture_product/Earl Grey Tea.jpeg"
            }
        ];

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
