<!-- NAVBAR -->
<header id="navbar" class="fixed top-0 left-0 w-full z-50 transition-all duration-300 border-b border-cream-300/60 bg-cream-100/90 backdrop-blur-md">
    <div class="max-w-6xl mx-auto px-6 h-16 md:h-20 flex items-center justify-between">
        <a href="#" class="flex items-center gap-2.5">
            <!-- Container Logo Image -->
            <div class="w-9 h-9 md:w-10 md:h-10 rounded-xl overflow-hidden flex items-center justify-center p-0.5 shadow-sm">
                <img src="<?= base_url("assets/img/brand-logo.png") ?>" alt="Logo Attendify" class="w-full h-full object-contain">
            </div>
            <!-- Teks Brand Utama -->
            <span class="text-lg md:text-xl font-bold tracking-tight text-navy-900">Attendify<span class="text-brand-600">.</span></span>
        </a>

        <nav class="hidden md:flex items-center gap-8 text-sm font-semibold text-navy-700">
            <a href="#" class="hover:text-brand-600 transition-colors">Beranda</a>
            <a href="#fitur-utama" class="hover:text-brand-600 transition-colors">Fitur Utama</a>
            <a href="#cara-kerja" class="hover:text-brand-600 transition-colors">Cara Kerja</a>
        </nav>

        <div class="flex items-center gap-3 md:gap-4">
            <a href="#demo" class="hidden sm:inline-block px-4 py-2 md:px-5 md:py-2.5 rounded-full text-xs md:text-sm font-semibold text-navy-900 bg-white border border-cream-300 hover:border-brand-500 hover:bg-cream-50 transition-all shadow-sm">Register</a>
            <a href="#mulai" class="px-4 py-2 md:px-5 md:py-2.5 rounded-full text-xs md:text-sm font-semibold text-white bg-navy-900 hover:bg-brand-600 transition-all shadow-md shadow-navy-900/20">Login</a>

            <button id="menu-btn" class="md:hidden text-2xl text-navy-900 focus:outline-none ml-1">
                <i class="ri-menu-3-line"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Menu Container -->
    <div id="mobile-menu" class="hidden md:hidden bg-cream-100 border-b border-cream-300 px-6 py-4 space-y-3 shadow-lg">
        <a href="#" class="block text-sm font-semibold text-navy-700 hover:text-brand-600 py-1">Beranda</a>
        <a href="#fitur-utama" class="block text-sm font-semibold text-navy-700 hover:text-brand-600 py-1">Fitur Utama</a>
        <a href="#cara-kerja" class="block text-sm font-semibold text-navy-700 hover:text-brand-600 py-1">Cara Kerja</a>
    </div>
</header>