<!-- HERO SECTION -->
<section class="relative pt-24 pb-16 md:pt-32 md:pb-20 overflow-hidden bg-gradient-to-b from-cream-100 via-cream-50 to-white">
    <!-- Glow Effect -->
    <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-brand-100/50 blur-[120px] rounded-full pointer-events-none"></div>

    <!-- Container dinaikkan ke max-w-6xl agar tidak terlalu menyebar di layar lebar -->
    <div class="max-w-6xl mx-auto px-6 relative z-10">
        <div class="grid lg:grid-cols-12 gap-8 items-center">

            <!-- Kolom Teks -->
            <div class="lg:col-span-7 space-y-6 text-center lg:text-left hero-text">
                <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-cream-200 border border-cream-300 text-xs font-bold text-navy-900">
                    <span class="flex h-2 w-2 rounded-full bg-brand-600 animate-ping"></span>
                    Teknologi Absensi AI Generasi Baru
                </div>

                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-navy-900 leading-[1.2]">
                    Selamat Datang di <span class="text-transparent bg-clip-text bg-gradient-to-r from-navy-900 via-brand-700 to-brand-500">Attendify</span>
                </h1>

                <p class="text-base sm:text-lg text-navy-700 max-w-xl mx-auto lg:mx-0 leading-relaxed font-normal">
                    Ubah cara tim Anda melakukan presensi. Kehadiran tercatat akurat hanya dalam 2 detik menggunakan pemindaian wajah (<em>Face Recognition</em>) berbasis AI yang presisi dan aman.
                </p>

                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-3 pt-2">
                    <a href="<?= base_url('login?mode=login') ?>" class="w-full sm:w-auto px-6 py-3 rounded-full font-semibold text-sm text-white bg-brand-600 hover:bg-navy-900 transition-all shadow-md shadow-brand-600/20 flex items-center justify-center gap-2 group">
                        Coba Gratis Sekarang
                        <i class="ri-arrow-right-line group-hover:translate-x-1 transition-transform"></i>
                    </a>
                    <a href="<?= base_url('login?mode=login') ?>" class="w-full sm:w-auto px-6 py-3 rounded-full font-semibold text-sm text-navy-900 bg-white border border-cream-300 hover:bg-cream-200 transition-all flex items-center justify-center gap-2 shadow-sm">
                        <i class="ri-play-circle-fill text-lg text-brand-600"></i>
                        Lihat Demo Live
                    </a>
                </div>
            </div>

            <!-- Kolom Visual -->
            <div class="lg:col-span-5 hero-visual">
                <div class="relative mx-auto max-w-[320px] p-3 bg-white rounded-3xl border border-cream-300 shadow-xl">
                    <div class="relative aspect-[3/4] bg-navy-900 rounded-2xl overflow-hidden border border-navy-800 flex flex-col items-center justify-center">

                        <div class="absolute inset-5 border border-dashed border-brand-400/40 rounded-2xl pointer-events-none"></div>
                        <div class="scan-line absolute left-0 w-full h-1 bg-gradient-to-r from-transparent via-brand-400 to-transparent shadow-[0_0_15px_#3b82f6]"></div>

                        <div class="relative z-10 w-28 h-28 rounded-full bg-navy-800 flex items-center justify-center border-2 border-brand-500 shadow-inner">
                            <i class="ri-user-3-line text-5xl text-slate-400"></i>
                            <div class="absolute inset-0 flex items-center justify-center opacity-70">
                                <div class="w-16 h-20 border border-brand-400/60 rounded-full flex flex-col justify-around items-center">
                                    <div class="w-10 h-0.5 bg-brand-400/50"></div>
                                    <div class="w-6 h-0.5 bg-brand-400/50"></div>
                                </div>
                            </div>
                        </div>

                        <div class="absolute bottom-3 left-3 right-3 bg-white/95 border border-cream-200 backdrop-blur-md rounded-xl p-2.5 flex items-center gap-2.5 shadow-md">
                            <div class="w-7 h-7 rounded-full bg-emerald-500/10 border border-emerald-500/30 flex items-center justify-center text-emerald-600 text-xs">
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