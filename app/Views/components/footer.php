<!-- FOOTER -->
<footer class="bg-cream-200 border-t border-cream-300 pt-16 pb-12 text-navy-700 text-sm">
    <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-5 gap-10 pb-12 border-b border-cream-300">
        
        <!-- Kolom Brand & Deskripsi -->
        <div class="md:col-span-2 space-y-4">
            <a href="#" class="flex items-center gap-2.5">
                <!-- Logo Image disesuaikan dengan Navbar -->
                <div class="w-8 h-8 rounded-lg overflow-hidden flex items-center justify-center p-0.5">
                    <img src="<?= base_url("assets/img/brand-logo.png") ?>" alt="Logo Attendify" class="w-full h-full object-contain">
                </div>
                <span class="text-xl font-bold tracking-tight text-navy-900">Attendify<span class="text-brand-600">.</span></span>
            </a>
            
            <p class="text-xs text-navy-700 max-w-sm leading-relaxed">
                Sistem absensi pemindaian wajah (<em>Face Recognition</em>) berbasis AI terdepan untuk meningkatkan efisiensi dan kedisiplinan tim Anda.
            </p>

            <!-- Social Media Icons -->
            <div class="flex gap-2.5 pt-1">
                <a href="#" aria-label="Twitter / X" class="w-9 h-9 rounded-xl bg-white border border-cream-300 flex items-center justify-center text-navy-900 hover:text-brand-600 hover:border-brand-500 transition-all shadow-sm">
                    <i class="ri-twitter-x-line"></i>
                </a>
                <a href="#" aria-label="LinkedIn" class="w-9 h-9 rounded-xl bg-white border border-cream-300 flex items-center justify-center text-navy-900 hover:text-brand-600 hover:border-brand-500 transition-all shadow-sm">
                    <i class="ri-linkedin-fill"></i>
                </a>
                <a href="#" aria-label="Instagram" class="w-9 h-9 rounded-xl bg-white border border-cream-300 flex items-center justify-center text-navy-900 hover:text-brand-600 hover:border-brand-500 transition-all shadow-sm">
                    <i class="ri-instagram-line"></i>
                </a>
            </div>
        </div>

        <!-- Navigation Columns -->
        <div class="space-y-3">
            <p class="text-xs font-bold uppercase tracking-wider text-navy-900">Produk</p>
            <ul class="space-y-2 text-xs font-medium">
                <li><a href="#fitur-utama" class="hover:text-brand-600 transition-colors">Absensi AI</a></li>
                <li><a href="#fitur-utama" class="hover:text-brand-600 transition-colors">Face Recognition</a></li>
                <li><a href="#fitur-utama" class="hover:text-brand-600 transition-colors">Laporan Real-time</a></li>
            </ul>
        </div>

        <div class="space-y-3">
            <p class="text-xs font-bold uppercase tracking-wider text-navy-900">Perusahaan</p>
            <ul class="space-y-2 text-xs font-medium">
                <li><a href="#" class="hover:text-brand-600 transition-colors">Tentang Kami</a></li>
                <li><a href="#" class="hover:text-brand-600 transition-colors">Blog</a></li>
                <li><a href="#" class="hover:text-brand-600 transition-colors">Kontak</a></li>
            </ul>
        </div>

        <div class="space-y-3">
            <p class="text-xs font-bold uppercase tracking-wider text-navy-900">Dukungan</p>
            <ul class="space-y-2 text-xs font-medium">
                <li><a href="#" class="hover:text-brand-600 transition-colors">Pusat Bantuan</a></li>
                <li><a href="#" class="hover:text-brand-600 transition-colors">Syarat & Ketentuan</a></li>
                <li><a href="#" class="hover:text-brand-600 transition-colors">Kebijakan Privasi</a></li>
            </ul>
        </div>
    </div>

    <!-- Copyright Bar -->
    <div class="max-w-6xl mx-auto px-6 pt-8 flex flex-col md:flex-row items-center justify-between gap-4 text-xs font-medium text-navy-700">
        <p>&copy; <?= date('Y') ?> Attendify Inc. Seluruh hak cipta dilindungi.</p>
        <div class="flex gap-6">
            <a href="#" class="hover:text-brand-600 transition-colors">Privasi</a>
            <a href="#" class="hover:text-brand-600 transition-colors">Ketentuan</a>
        </div>
    </div>
</footer>