<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendify | Sistem Absensi Face Recognition Modern</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Konfigurasi Tailwind Langsung Di Sini -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        navy: {
                            900: '#0f172a',
                            800: '#1e293b',
                            700: '#334155',
                        },
                        brand: {
                            700: '#1d4ed8',
                            600: '#2563eb',
                            500: '#3b82f6',
                            400: '#60a5fa',
                            100: '#dbeafe',
                            50: '#eff6ff',
                        },
                        cream: {
                            300: '#ede6d8',
                            200: '#f7f3eb',
                            100: '#fdfbf7',
                            50: '#fffefc',
                        }
                    }
                }
            }
        }
    </script>

    <!-- Remix Icon CDN -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />

    <!-- Style CSS Custom -->
    <link rel="stylesheet" href="<?= base_url("assets/css/style.css") ?>">
</head>

<body class="bg-cream-100 text-navy-900 font-sans antialiased selection:bg-brand-600 selection:text-white overflow-x-hidden">

    <!-- Header / Navigation -->
    <header id="navbar" class="fixed top-0 left-0 w-full z-50 transition-all duration-300 border-b border-cream-300/60 bg-cream-100/90 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <a href="#" class="flex items-center gap-2.5">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-navy-900 to-brand-600 flex items-center justify-center text-white shadow-md shadow-brand-600/20">
                    <i class="ri-user-scan-line text-xl"></i>
                </div>
                <span class="text-xl font-bold tracking-tight text-navy-900">Attendify<span class="text-brand-600">.</span></span>
            </a>

            <nav class="hidden md:flex items-center gap-8 text-sm font-semibold text-navy-700">
                <a href="#fitur-utama" class="hover:text-brand-600 transition-colors">Fitur Utama</a>
                <a href="#cara-kerja" class="hover:text-brand-600 transition-colors">Cara Kerja</a>
                <a href="#keunggulan" class="hover:text-brand-600 transition-colors">Keunggulan</a>
            </nav>

            <div class="flex items-center gap-4">
                <a href="#demo" class="hidden sm:inline-block px-5 py-2.5 rounded-full text-sm font-semibold text-navy-900 bg-white border border-cream-300 hover:border-brand-500 hover:bg-cream-50 transition-all shadow-sm">Demo</a>
                <a href="#mulai" class="px-5 py-2.5 rounded-full text-sm font-semibold text-white bg-navy-900 hover:bg-brand-600 transition-all shadow-md shadow-navy-900/20">Mulai Sekarang</a>

                <button id="menu-btn" class="md:hidden text-2xl text-navy-900 focus:outline-none ml-2">
                    <i class="ri-menu-3-line"></i>
                </button>
            </div>
        </div>

        <div id="mobile-menu" class="hidden md:hidden bg-cream-100 border-b border-cream-300 px-6 py-4 space-y-3">
            <a href="#fitur-utama" class="block text-sm font-semibold text-navy-700 hover:text-brand-600 py-1">Fitur Utama</a>
            <a href="#cara-kerja" class="block text-sm font-semibold text-navy-700 hover:text-brand-600 py-1">Cara Kerja</a>
            <a href="#keunggulan" class="block text-sm font-semibold text-navy-700 hover:text-brand-600 py-1">Keunggulan</a>
            <a href="#demo" class="block text-sm font-semibold text-navy-700 hover:text-brand-600 py-1 sm:hidden">Lihat Demo</a>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative pt-36 pb-20 md:pt-48 md:pb-28 overflow-hidden bg-gradient-to-b from-cream-100 via-cream-50 to-white">
        <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-brand-100/50 blur-[130px] rounded-full pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="grid lg:grid-cols-12 gap-12 items-center">

                <div class="lg:col-span-7 space-y-8 text-center lg:text-left hero-text">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-cream-200 border border-cream-300 text-xs font-bold text-navy-900">
                        <span class="flex h-2.5 w-2.5 rounded-full bg-brand-600 animate-ping"></span>
                        Teknologi Absensi AI Generasi Baru
                    </div>

                    <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight text-navy-900 leading-[1.15]">
                        Selamat Datang di <span class="text-transparent bg-clip-text bg-gradient-to-r from-navy-900 via-brand-700 to-brand-500">Attendify</span>
                    </h1>

                    <p class="text-lg text-navy-700 max-w-2xl mx-auto lg:mx-0 leading-relaxed font-normal">
                        Ubah cara tim Anda melakukan presensi. Kehadiran tercatat akurat hanya dalam 2 detik menggunakan pemindaian wajah (<em>Face Recognition</em>) berbasis AI yang presisi dan aman.
                    </p>

                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                        <a href="#mulai" class="w-full sm:w-auto px-8 py-3.5 rounded-full font-semibold text-white bg-brand-600 hover:bg-navy-900 transition-all shadow-lg shadow-brand-600/25 flex items-center justify-center gap-2 group">
                            Coba Gratis Sekarang
                            <i class="ri-arrow-right-line group-hover:translate-x-1 transition-transform"></i>
                        </a>
                        <a href="#demo" class="w-full sm:w-auto px-8 py-3.5 rounded-full font-semibold text-navy-900 bg-white border border-cream-300 hover:bg-cream-200 transition-all flex items-center justify-center gap-2 shadow-sm">
                            <i class="ri-play-circle-fill text-xl text-brand-600"></i>
                            Lihat Demo Live
                        </a>
                    </div>
                </div>

                <div class="lg:col-span-5 hero-visual">
                    <div class="relative mx-auto max-w-[360px] p-4 bg-white rounded-3xl border border-cream-300 shadow-2xl">
                        <div class="relative aspect-[3/4] bg-navy-900 rounded-2xl overflow-hidden border border-navy-800 flex flex-col items-center justify-center">

                            <div class="absolute inset-6 border border-dashed border-brand-400/40 rounded-2xl pointer-events-none"></div>
                            <div class="scan-line absolute left-0 w-full h-1 bg-gradient-to-r from-transparent via-brand-400 to-transparent shadow-[0_0_15px_#3b82f6]"></div>

                            <div class="relative z-10 w-32 h-32 rounded-full bg-navy-800 flex items-center justify-center border-2 border-brand-500 shadow-inner">
                                <i class="ri-user-3-line text-6xl text-slate-400"></i>
                                <div class="absolute inset-0 flex items-center justify-center opacity-70">
                                    <div class="w-20 h-24 border border-brand-400/60 rounded-full flex flex-col justify-around items-center">
                                        <div class="w-12 h-0.5 bg-brand-400/50"></div>
                                        <div class="w-8 h-0.5 bg-brand-400/50"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="absolute bottom-4 left-4 right-4 bg-white/95 border border-cream-200 backdrop-blur-md rounded-xl p-3 flex items-center gap-3 shadow-lg">
                                <div class="w-8 h-8 rounded-full bg-emerald-500/10 border border-emerald-500/30 flex items-center justify-center text-emerald-600 text-sm">
                                    <i class="ri-check-line font-bold"></i>
                                </div>
                                <div class="text-left">
                                    <p class="text-xs font-bold text-navy-900">Terverifikasi (1.2 Detik)</p>
                                    <p class="text-[10px] text-navy-700 font-medium">Alex • 99% Match Score</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- SECTION FITUR UTAMA HIGHLIGHT -->
    <section id="fitur-utama" class="py-20 bg-white border-y border-cream-300/80">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <h2 class="text-xs font-bold uppercase tracking-widest text-brand-600 mb-3">Fitur Utama</h2>
                <p class="text-3xl md:text-4xl font-extrabold text-navy-900 tracking-tight">Presisi & Kecepatan Tanpa Kompromi</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <div class="feature-card p-8 md:p-10 rounded-3xl bg-cream-100 border border-cream-300 hover:border-brand-500 transition-all relative overflow-hidden group shadow-sm">
                    <div class="absolute top-0 right-0 p-8 text-navy-900/5 group-hover:text-brand-600/10 transition-colors text-9xl font-black pointer-events-none select-none">
                        2s
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-brand-600 text-white flex items-center justify-center text-3xl mb-6 shadow-md shadow-brand-600/20">
                        <i class="ri-flashlight-line"></i>
                    </div>
                    <div class="inline-block px-3 py-1 rounded-md bg-brand-100 text-brand-700 text-xs font-bold mb-3">Scanning Speed</div>
                    <h3 class="text-2xl font-bold text-navy-900 mb-4">Pemindaian Kilat 2 Detik</h3>
                    <p class="text-navy-700 text-sm leading-relaxed mb-6">
                        Proses pengenalan wajah berlangsung kurang dari 2 detik. Mengeliminasi antrean panjang saat jam masuk kerja dan meningkatkan efisiensi waktu operasional kantor secara signifikan.
                    </p>
                    <div class="flex items-center gap-2 text-xs text-navy-900 font-semibold">
                        <i class="ri-checkbox-circle-fill text-brand-600 text-base"></i>
                        <span>Bisa digunakan tanpa sentuhan fisik (Touchless)</span>
                    </div>
                </div>

                <div class="feature-card p-8 md:p-10 rounded-3xl bg-navy-900 border border-navy-800 text-white transition-all relative overflow-hidden group shadow-xl">
                    <div class="absolute top-0 right-0 p-8 text-white/5 group-hover:text-brand-400/10 transition-colors text-9xl font-black pointer-events-none select-none">
                        99%
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-cream-200 text-navy-900 flex items-center justify-center text-3xl mb-6 shadow-md">
                        <i class="ri-user-unfollow-line"></i>
                    </div>
                    <div class="inline-block px-3 py-1 rounded-md bg-navy-800 text-brand-400 text-xs font-bold mb-3">AI Precision</div>
                    <h3 class="text-2xl font-bold text-white mb-4">Akurasi Deteksi Wajah 99%</h3>
                    <p class="text-slate-300 text-sm leading-relaxed mb-6">
                        Algoritma Machine Learning menganalisis hingga puluhan koordinat titik wajah secara presisi. Tetap akurat meskipun pengguna memakai kacamata, masker, atau gaya rambut berbeda.
                    </p>
                    <div class="flex items-center gap-2 text-xs text-brand-400 font-semibold">
                        <i class="ri-shield-check-fill text-brand-400 text-base"></i>
                        <span>Dilengkapi Liveness Detection (Anti-Foto / Video)</span>
                    </div>
                </div>
            </div>

            <div id="keunggulan" class="grid md:grid-cols-3 gap-6 mt-12">
                <div class="p-6 rounded-2xl bg-cream-50 border border-cream-300/80 shadow-sm hover:border-brand-400 transition-all">
                    <i class="ri-map-pin-user-line text-brand-600 text-2xl mb-3 block"></i>
                    <h4 class="text-base font-bold text-navy-900 mb-1">Geofencing GPS</h4>
                    <p class="text-navy-700 text-xs leading-relaxed">Kunci radius lokasi absensi sesuai koordinat yang ditentukan.</p>
                </div>
                <div class="p-6 rounded-2xl bg-cream-50 border border-cream-300/80 shadow-sm hover:border-brand-400 transition-all">
                    <i class="ri-file-chart-line text-brand-600 text-2xl mb-3 block"></i>
                    <h4 class="text-base font-bold text-navy-900 mb-1">Rekap Laporan Real-Time</h4>
                    <p class="text-navy-700 text-xs leading-relaxed">Ekspor data kehadiran harian ke format Excel/PDF otomatis.</p>
                </div>
                <div class="p-6 rounded-2xl bg-cream-50 border border-cream-300/80 shadow-sm hover:border-brand-400 transition-all">
                    <i class="ri-smartphone-line text-brand-600 text-2xl mb-3 block"></i>
                    <h4 class="text-base font-bold text-navy-900 mb-1">Multi-Device Support</h4>
                    <p class="text-navy-700 text-xs leading-relaxed">Akses dari Tablet kantor, HP Android, iOS, maupun Browser.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="cara-kerja" class="py-24 bg-cream-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <h2 class="text-xs font-bold uppercase tracking-widest text-brand-600 mb-3">Langkah Praktis</h2>
                <p class="text-3xl font-bold text-navy-900 tracking-tight">Cara Kerja Absensi di Attendify</p>
            </div>

            <div class="grid md:grid-cols-4 gap-8 relative">
                <div class="step-card text-center space-y-4">
                    <div class="w-16 h-16 rounded-2xl bg-white border border-cream-300 text-navy-900 font-extrabold text-xl flex items-center justify-center mx-auto shadow-md">01</div>
                    <h3 class="text-lg font-bold text-navy-900">Buka Aplikasi</h3>
                    <p class="text-xs text-navy-700 leading-relaxed">Karyawan membuka aplikasi Attendify lewat tablet kantor atau HP pribadi.</p>
                </div>

                <div class="step-card text-center space-y-4">
                    <div class="w-16 h-16 rounded-2xl bg-white border border-cream-300 text-brand-600 font-extrabold text-xl flex items-center justify-center mx-auto shadow-md">02</div>
                    <h3 class="text-lg font-bold text-navy-900">Scan Wajah</h3>
                    <p class="text-xs text-navy-700 leading-relaxed">Cukup arahkan wajah ke kamera. Kamera mendeteksi dalam rentang 2 detik.</p>
                </div>

                <div class="step-card text-center space-y-4">
                    <div class="w-16 h-16 rounded-2xl bg-white border border-cream-300 text-navy-900 font-extrabold text-xl flex items-center justify-center mx-auto shadow-md">03</div>
                    <h3 class="text-lg font-bold text-navy-900">Validasi AI</h3>
                    <p class="text-xs text-navy-700 leading-relaxed">Sistem memverifikasi identitas 99% akurat beserta koordinat lokasi GPS.</p>
                </div>

                <div class="step-card text-center space-y-4">
                    <div class="w-16 h-16 rounded-2xl bg-white border border-cream-300 text-emerald-600 font-extrabold text-xl flex items-center justify-center mx-auto shadow-md">04</div>
                    <h3 class="text-lg font-bold text-navy-900">Selesai</h3>
                    <p class="text-xs text-navy-700 leading-relaxed">Absensi berhasil dicatat secara instan ke dalam dashboard HRD.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section id="mulai" class="py-20 bg-white border-t border-cream-300">
        <div class="max-w-5xl mx-auto px-6">
            <div class="relative rounded-3xl bg-gradient-to-r from-navy-900 via-navy-800 to-brand-700 p-10 md:p-16 text-center overflow-hidden shadow-2xl">
                <div class="relative z-10 space-y-6 max-w-2xl mx-auto">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-white tracking-tight">Siap Modernisasi Absensi Perusahaan Anda?</h2>
                    <p class="text-brand-100 text-sm md:text-base">Nikmati kemudahan absensi presisi dengan masa uji coba gratis 14 hari tanpa perlu kartu kredit.</p>
                    <div class="pt-4 flex flex-col sm:flex-row justify-center gap-4">
                        <a href="#" class="px-8 py-3.5 rounded-full font-semibold text-navy-900 bg-cream-100 hover:bg-white transition-all shadow-lg">Mulai Uji Coba Gratis</a>
                        <a href="#" class="px-8 py-3.5 rounded-full font-semibold text-white bg-navy-800/80 hover:bg-navy-900 transition-all border border-brand-400/30">Hubungi Sales</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-cream-200 border-t border-cream-300 pt-16 pb-12 text-navy-700 text-sm">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-5 gap-10 pb-12 border-b border-cream-300">
            <div class="md:col-span-2 space-y-4">
                <a href="#" class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-navy-900 to-brand-600 flex items-center justify-center text-white">
                        <i class="ri-user-scan-line"></i>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-navy-900">Attendify<span class="text-brand-600">.</span></span>
                </a>
                <p class="text-xs text-navy-700 max-w-sm leading-relaxed">
                    Sistem absensi pemindaian wajah (<em>Face Recognition</em>) berbasis AI terdepan untuk meningkatkan efisiensi dan kedisiplinan tim Anda.
                </p>
                <div class="flex gap-3 pt-2">
                    <a href="#" aria-label="Twitter / X" class="w-9 h-9 rounded-lg bg-white border border-cream-300 flex items-center justify-center text-navy-900 hover:text-brand-600 hover:border-brand-500 transition-all shadow-sm"><i class="ri-twitter-x-line"></i></a>
                    <a href="#" aria-label="LinkedIn" class="w-9 h-9 rounded-lg bg-white border border-cream-300 flex items-center justify-center text-navy-900 hover:text-brand-600 hover:border-brand-500 transition-all shadow-sm"><i class="ri-linkedin-fill"></i></a>
                    <a href="#" aria-label="Instagram" class="w-9 h-9 rounded-lg bg-white border border-cream-300 flex items-center justify-center text-navy-900 hover:text-brand-600 hover:border-brand-500 transition-all shadow-sm"><i class="ri-instagram-line"></i></a>
                </div>
            </div>

            <div class="space-y-3">
                <p class="text-xs font-bold uppercase tracking-wider text-navy-900">Produk</p>
                <ul class="space-y-2 text-xs font-medium">
                    <li><a href="#fitur-utama" class="hover:text-brand-600 transition-colors">Instant-OCR</a></li>
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

        <div class="max-w-7xl mx-auto px-6 pt-8 flex flex-col md:flex-row items-center justify-between gap-4 text-xs font-medium">
            <p>&copy; 2026 Attendify Inc. Seluruh hak cipta dilindungi.</p>
            <div class="flex gap-6">
                <a href="#" class="hover:text-brand-600 transition-colors">Privasi</a>
                <a href="#" class="hover:text-brand-600 transition-colors">Ketentuan</a>
            </div>
        </div>
    </footer>

    <!-- Panggil GSAP & ScrollTrigger CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

    <!-- Panggil Custom Script GSAP Kamu -->
    <script src="<?= base_url("assets/js/gsap.js") ?>"></script>
</body>

</html>