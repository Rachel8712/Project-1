<header class="bg-[#CAA494] text-white" id="header-section">
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center">
            <div class="text-2xl font-bold">AdelysiaCoffee.com</div>

            <nav class="hidden md:block">
                <ul class="flex space-x-6">
                    <li><a href="#hero-section" class="hover:text-[#63612C]">Beranda</a></li>
                    <li><a href="#products-section" class="hover:text-[#63612C]">Produk</a></li>
                    <li><a href="#" class="hover:text-[#63612C]">Tentang Kami</a></li>
                    <li><a href="#" class="hover:text-[#63612C]">Kontak</a></li>
                </ul>
            </nav>

            <div class="flex items-center space-x-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}"
                           class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                                Register
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </div>
</header>