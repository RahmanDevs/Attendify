<!-- Helper -->
<?php helper('form'); ?>

<div class="relative w-full max-h-[580px] md:max-h-[520px] my-auto bg-white rounded-3xl border border-cream-300 shadow-2xl overflow-hidden flex flex-col md:grid md:grid-cols-2">

    <!-- Flash Message Notification -->
    <?php if (session()->getFlashdata('error')) : ?>
        <div class="absolute top-3 left-1/2 -translate-x-1/2 z-50 bg-red-100 border border-red-400 text-red-700 px-3 py-1.5 rounded-xl text-xs font-semibold shadow-md flex items-center gap-2">
            <i class="ri-error-warning-fill text-sm"></i>
            <?= esc(session()->getFlashdata('error')) ?>
        </div>
    <?php endif; ?>

    <!-- ==========================================
             MOBILE TAB TOGGLE (Hanya Tampil di HP)
        =========================================== -->
    <div class="md:hidden p-1.5 m-4 mb-0 bg-cream-100 rounded-2xl flex relative z-30 shrink-0">
        <div id="mobile-pill" class="absolute top-1.5 left-1.5 w-[calc(50%-6px)] h-[calc(100%-12px)] bg-white rounded-xl shadow-sm transition-transform duration-300 ease-in-out"></div>

        <button id="tab-login" type="button" class="flex-1 py-2 text-xs font-bold text-navy-900 z-10 text-center transition-colors">
            Masuk
        </button>
        <button id="tab-register" type="button" class="flex-1 py-2 text-xs font-bold text-navy-700 z-10 text-center transition-colors">
            Daftar
        </button>
    </div>

    <!-- ==========================================
             CAROUSEL SLIDER WRAPPER (Anti Bertumpuk)
        =========================================== -->
    <div class="w-full h-full overflow-hidden md:col-span-2 md:grid md:grid-cols-2">
        <div id="forms-track" class="w-[200%] md:w-full h-full flex md:contents transition-transform duration-500 ease-in-out">

            <!-- CONTAINER FORM LOGIN -->
            <div id="form-login-wrapper" class="w-1/2 md:w-full h-full p-6 sm:p-8 flex flex-col justify-center space-y-3 z-10 shrink-0">
                <div>
                    <h2 class="text-xl font-extrabold text-navy-900">Selamat Datang! 👋</h2>
                    <p class="text-[11px] text-navy-700 mt-0.5">Masuk untuk mengakses dashboard presensi Anda.</p>
                </div>

                <!-- Social Login -->
                <div class="grid grid-cols-2 gap-2.5">
                    <a href="<?= base_url('auth/google') ?>" class="flex items-center justify-center gap-2 py-2 px-3 rounded-xl border border-cream-300 hover:bg-cream-50 text-xs font-semibold text-navy-800 transition shadow-sm">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24">
                            <path fill="#EA4335" d="M12 5c1.6 0 3 .6 4.1 1.6l3.1-3.1C17.3 1.7 14.8 1 12 1 7.5 1 3.7 3.6 1.9 7.3l3.7 2.9C6.5 7.3 9 5 12 5z" />
                            <path fill="#4285F4" d="M23.5 12.3c0-.8-.1-1.6-.2-2.3H12v4.5h6.5c-.3 1.5-1.1 2.8-2.4 3.7l3.7 2.9c2.2-2 3.7-5 3.7-8.8z" />
                            <path fill="#FBBC05" d="M5.6 14.8c-.2-.7-.4-1.5-.4-2.3s.2-1.6.4-2.3L1.9 7.3C.7 9.7 0 10.8 0 12.5s.7 2.8 1.9 5.2l3.7-2.9z" />
                            <path fill="#34A853" d="M12 23c3.2 0 6-1.1 8-3l-3.7-2.9c-1.1.7-2.5 1.2-4.3 1.2-3 0-5.5-2.3-6.4-5.2L1.9 16C3.7 19.7 7.5 23 12 23z" />
                        </svg>
                        Google
                    </a>
                    <a href="<?= base_url('auth/github') ?>" class="flex items-center justify-center gap-2 py-2 px-3 rounded-xl border border-cream-300 hover:bg-cream-50 text-xs font-semibold text-navy-800 transition shadow-sm">
                        <i class="ri-github-fill text-sm"></i>
                        GitHub
                    </a>
                </div>

                <div class="relative flex items-center justify-center my-0.5">
                    <span class="absolute bg-white px-2 text-[9px] uppercase tracking-wider font-bold text-navy-700">atau email</span>
                    <div class="w-full border-t border-cream-300"></div>
                </div>

                <?= form_open('login/process', ['class' => 'space-y-2.5']) ?>
                <div>
                    <label class="block text-[11px] font-bold text-navy-900 mb-0.5">Email</label>
                    <div class="relative">
                        <i class="ri-mail-line absolute left-3 top-1/2 -translate-y-1/2 text-navy-700 text-xs"></i>
                        <input type="email" name="email" value="<?= esc(old('email')) ?>" required placeholder="nama@perusahaan.com" class="w-full pl-9 pr-3 py-1.5 text-xs rounded-xl border border-cream-300 focus:outline-none focus:border-brand-600 transition">
                    </div>
                </div>

                <div>
                    <div class="flex justify-between items-center mb-0.5">
                        <label class="text-[11px] font-bold text-navy-900">Kata Sandi</label>
                        <a href="<?= base_url('forgot-password') ?>" class="text-[10px] font-semibold text-brand-600 hover:underline">Lupa?</a>
                    </div>
                    <div class="relative">
                        <i class="ri-lock-2-line absolute left-3 top-1/2 -translate-y-1/2 text-navy-700 text-xs"></i>
                        <input type="password" name="password" required placeholder="••••••••" class="w-full pl-9 pr-3 py-1.5 text-xs rounded-xl border border-cream-300 focus:outline-none focus:border-brand-600 transition">
                    </div>
                </div>

                <button type="submit" class="w-full py-2.5 bg-brand-600 hover:bg-navy-900 text-white rounded-xl text-xs font-bold transition shadow-md">
                    Masuk Sekarang
                </button>
                <?= form_close() ?>
            </div>

            <!-- CONTAINER FORM REGISTER -->
            <div id="form-register-wrapper" class="w-1/2 md:w-full h-full p-6 sm:p-8 flex flex-col justify-center space-y-2.5 z-10 shrink-0">
                <div>
                    <h2 class="text-xl font-extrabold text-navy-900">Buat Akun Baru 🚀</h2>
                    <p class="text-[11px] text-navy-700 mt-0.5">Daftar sekarang untuk kemudahan absensi AI.</p>
                </div>

                <!-- Social Login -->
                <div class="grid grid-cols-2 gap-2.5">
                    <a href="<?= base_url('auth/google') ?>" class="flex items-center justify-center gap-2 py-2 px-3 rounded-xl border border-cream-300 hover:bg-cream-50 text-xs font-semibold text-navy-800 transition shadow-sm">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24">
                            <path fill="#EA4335" d="M12 5c1.6 0 3 .6 4.1 1.6l3.1-3.1C17.3 1.7 14.8 1 12 1 7.5 1 3.7 3.6 1.9 7.3l3.7 2.9C6.5 7.3 9 5 12 5z" />
                            <path fill="#4285F4" d="M23.5 12.3c0-.8-.1-1.6-.2-2.3H12v4.5h6.5c-.3 1.5-1.1 2.8-2.4 3.7l3.7 2.9c2.2-2 3.7-5 3.7-8.8z" />
                            <path fill="#FBBC05" d="M5.6 14.8c-.2-.7-.4-1.5-.4-2.3L1.9 7.3C.7 9.7 0 10.8 0 12.5s.7 2.8 1.9 5.2l3.7-2.9z" />
                            <path fill="#34A853" d="M12 23c3.2 0 6-1.1 8-3l-3.7-2.9c-1.1.7-2.5 1.2-4.3 1.2-3 0-5.5-2.3-6.4-5.2L1.9 16C3.7 19.7 7.5 23 12 23z" />
                        </svg>
                        Google
                    </a>
                    <a href="<?= base_url('auth/github') ?>" class="flex items-center justify-center gap-2 py-2 px-3 rounded-xl border border-cream-300 hover:bg-cream-50 text-xs font-semibold text-navy-800 transition shadow-sm">
                        <i class="ri-github-fill text-sm"></i>
                        GitHub
                    </a>
                </div>

                <div class="relative flex items-center justify-center my-0.5">
                    <span class="absolute bg-white px-2 text-[9px] uppercase tracking-wider font-bold text-navy-700">atau email</span>
                    <div class="w-full border-t border-cream-300"></div>
                </div>

                <?= form_open('register/process', ['class' => 'space-y-2']) ?>
                <div>
                    <label class="block text-[11px] font-bold text-navy-900 mb-0.5">Nama Lengkap</label>
                    <div class="relative">
                        <i class="ri-user-line absolute left-3 top-1/2 -translate-y-1/2 text-navy-700 text-xs"></i>
                        <input type="text" name="fullname" value="<?= esc(old('fullname')) ?>" required placeholder="John Doe" class="w-full pl-9 pr-3 py-1.5 text-xs rounded-xl border border-cream-300 focus:outline-none focus:border-brand-600 transition">
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-navy-900 mb-0.5">Email</label>
                    <div class="relative">
                        <i class="ri-mail-line absolute left-3 top-1/2 -translate-y-1/2 text-navy-700 text-xs"></i>
                        <input type="email" name="email" value="<?= esc(old('email')) ?>" required placeholder="nama@perusahaan.com" class="w-full pl-9 pr-3 py-1.5 text-xs rounded-xl border border-cream-300 focus:outline-none focus:border-brand-600 transition">
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-navy-900 mb-0.5">Kata Sandi</label>
                    <div class="relative">
                        <i class="ri-lock-2-line absolute left-3 top-1/2 -translate-y-1/2 text-navy-700 text-xs"></i>
                        <input type="password" name="password" required placeholder="Minimal 8 karakter" class="w-full pl-9 pr-3 py-1.5 text-xs rounded-xl border border-cream-300 focus:outline-none focus:border-brand-600 transition">
                    </div>
                </div>

                <button type="submit" class="w-full py-2 bg-navy-900 hover:bg-brand-600 text-white rounded-xl text-xs font-bold transition shadow-md">
                    Daftar Sekarang
                </button>
                <?= form_close() ?>
            </div>

        </div>
    </div>

    <!-- ==========================================
             SLIDING OVERLAY PANEL (KHUSUS DESKTOP)
        =========================================== -->
    <div id="overlay-panel" class="hidden md:flex absolute top-0 left-1/2 w-1/2 h-full bg-gradient-to-tr from-navy-900 via-navy-800 to-brand-700 text-white flex-col justify-center items-center p-8 text-center transition-transform duration-700 ease-in-out z-20 shadow-2xl">
        <div id="overlay-login-content" class="space-y-3 max-w-xs transition-opacity duration-300">
            <h3 class="text-xl font-extrabold">Belum Memiliki Akun?</h3>
            <p class="text-[11px] text-slate-300 leading-relaxed">Bergabunglah bersama ribuan tim yang telah memodernisasi sistem absensi mereka secara presisi.</p>
            <button id="btn-to-register" type="button" class="mt-2 px-6 py-2 rounded-full border-2 border-white text-xs font-bold hover:bg-white hover:text-navy-900 transition-all shadow-md">Daftar Akun</button>
        </div>
        <div id="overlay-register-content" class="hidden space-y-3 max-w-xs transition-opacity duration-300">
            <h3 class="text-xl font-extrabold">Sudah Punya Akun?</h3>
            <p class="text-[11px] text-slate-300 leading-relaxed">Masuk kembali ke dasbor Anda dan pantau absensi tim secara real-time.</p>
            <button id="btn-to-login" type="button" class="mt-2 px-6 py-2 rounded-full border-2 border-white text-xs font-bold hover:bg-white hover:text-navy-900 transition-all shadow-md">Masuk Akun</button>
        </div>
    </div>

</div>

<!-- JavaScript for Sliding Effect Toggle -->
<script src="<?= base_url('assets/js/formFunctional.js') ?>"></script>