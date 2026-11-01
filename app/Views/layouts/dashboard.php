<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?? 'Dashboard | Attendify' ?></title>

    <!-- Favicon Configuration -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/img/favicon/apple-touch-icon.png') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/img/favicon/favicon-32x32.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/img/favicon/favicon-16x16.png') ?>">
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/favicon/favicon.ico') ?>">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN + Theme Config -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        navy: {
                            900: '#0a0f1d',
                            800: '#0f172a',
                            700: '#1e293b',
                            600: '#334155'
                        },
                        brand: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af'
                        },
                        cream: {
                            50: '#fdfbf7',
                            100: '#f7f4ed',
                            200: '#ede8dd',
                            300: '#e2dacb'
                        }
                    }
                }
            }
        }
    </script>

    <!-- Remix Icon CDN -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />

    <style>
        /* Modern subtle scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>

    <?= $this->renderSection('extra_head') ?>
</head>

<body class="h-full flex overflow-hidden font-sans text-slate-800 antialiased selection:bg-brand-600 selection:text-white">

    <!-- Mobile Sidebar Backdrop -->
    <div id="sidebar-backdrop" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-40 hidden md:hidden transition-opacity"></div>

    <!-- ==========================================
             MODERN CLEAN SIDEBAR
        =========================================== -->
    <aside id="main-sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-navy-900 text-white flex flex-col justify-between transition-transform duration-300 ease-in-out -translate-x-full md:translate-x-0 md:static shrink-0 border-r border-slate-800/80 shadow-2xl md:shadow-none">
        
        <!-- Top: Brand Header -->
        <div>
            <div class="h-16 md:h-20 flex items-center justify-between px-6 border-b border-slate-800/80">
                <a href="<?= base_url() ?>" class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-brand-600 to-brand-400 p-0.5 shadow-md shadow-brand-500/20 flex items-center justify-center">
                        <img src="<?= base_url('assets/img/brand-logo.png') ?>" alt="Logo" class="w-full h-full object-contain filter brightness-110">
                    </div>
                    <div>
                        <span class="text-base font-extrabold tracking-tight text-white">Attendify<span class="text-brand-500">.</span></span>
                        <span class="block text-[10px] font-semibold text-slate-400 uppercase tracking-widest -mt-0.5">
                            <?= session()->get('role') === 'admin' ? 'Admin Hub' : 'Employee' ?>
                        </span>
                    </div>
                </a>
                <button id="close-sidebar-btn" class="md:hidden text-slate-400 hover:text-white text-xl">
                    <i class="ri-close-line"></i>
                </button>
            </div>

            <!-- Navigation Links -->
            <nav class="p-4 space-y-1.5 overflow-y-auto max-h-[calc(100vh-180px)]">

                <?php $currentUri = uri_string(); ?>

                <?php if (session()->get('role') === 'admin') : ?>
                    <!-- ADMIN NAVIGATION -->
                    <div class="px-3 pt-2 pb-1 text-[10px] font-bold uppercase tracking-wider text-slate-500">
                        Overview
                    </div>
                    <a href="<?= base_url('admin/dashboard') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold transition <?= str_contains($currentUri, 'admin/dashboard') ? 'bg-brand-600 text-white shadow-lg shadow-brand-600/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' ?>">
                        <i class="ri-dashboard-3-line text-base"></i>
                        <span>Dashboard Utama</span>
                    </a>
                    <a href="<?= base_url('admin/attendance/live') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold transition <?= str_contains($currentUri, 'admin/attendance/live') ? 'bg-brand-600 text-white shadow-lg shadow-brand-600/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' ?>">
                        <i class="ri-rfid-line text-base"></i>
                        <span>Live Feed Presensi</span>
                    </a>

                    <div class="px-3 pt-4 pb-1 text-[10px] font-bold uppercase tracking-wider text-slate-500">
                        Manajemen SDM
                    </div>
                    <a href="<?= base_url('admin/employees') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold transition <?= str_contains($currentUri, 'admin/employees') ? 'bg-brand-600 text-white shadow-lg shadow-brand-600/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' ?>">
                        <i class="ri-user-settings-line text-base"></i>
                        <span>Data Karyawan</span>
                    </a>
                    <a href="<?= base_url('admin/leaves') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold transition <?= str_contains($currentUri, 'admin/leaves') ? 'bg-brand-600 text-white shadow-lg shadow-brand-600/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' ?>">
                        <i class="ri-calendar-check-line text-base"></i>
                        <span>Approval Cuti & Izin</span>
                    </a>
                    <a href="<?= base_url('admin/shifts') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold transition <?= str_contains($currentUri, 'admin/shifts') ? 'bg-brand-600 text-white shadow-lg shadow-brand-600/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' ?>">
                        <i class="ri-time-line text-base"></i>
                        <span>Shift & Jam Kerja</span>
                    </a>

                    <div class="px-3 pt-4 pb-1 text-[10px] font-bold uppercase tracking-wider text-slate-500">
                        Sistem & Lokasi
                    </div>
                    <a href="<?= base_url('admin/settings/geofence') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold transition <?= str_contains($currentUri, 'settings/geofence') ? 'bg-brand-600 text-white shadow-lg shadow-brand-600/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' ?>">
                        <i class="ri-map-pin-range-line text-base"></i>
                        <span>Geofence GPS</span>
                    </a>
                    <a href="<?= base_url('admin/reports') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold transition <?= str_contains($currentUri, 'admin/reports') ? 'bg-brand-600 text-white shadow-lg shadow-brand-600/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' ?>">
                        <i class="ri-file-chart-line text-base"></i>
                        <span>Laporan Rekapitulasi</span>
                    </a>

                <?php else : ?>
                    <!-- EMPLOYEE NAVIGATION -->
                    <div class="px-3 pt-2 pb-1 text-[10px] font-bold uppercase tracking-wider text-slate-500">
                        Presensi & Aktivitas
                    </div>
                    <a href="<?= base_url('employee/dashboard') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold transition <?= str_contains($currentUri, 'employee/dashboard') ? 'bg-brand-600 text-white shadow-lg shadow-brand-600/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' ?>">
                        <i class="ri-home-5-line text-base"></i>
                        <span>Dashboard Saya</span>
                    </a>
                    <a href="<?= base_url('attendance/scan') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold transition <?= str_contains($currentUri, 'attendance/scan') ? 'bg-brand-600 text-white shadow-lg shadow-brand-600/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' ?>">
                        <i class="ri-scan-2-line text-base"></i>
                        <span>Scan Presensi AI</span>
                    </a>
                    <a href="<?= base_url('attendance/history') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold transition <?= str_contains($currentUri, 'attendance/history') ? 'bg-brand-600 text-white shadow-lg shadow-brand-600/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' ?>">
                        <i class="ri-history-line text-base"></i>
                        <span>Riwayat Absensi</span>
                    </a>

                    <div class="px-3 pt-4 pb-1 text-[10px] font-bold uppercase tracking-wider text-slate-500">
                        Layanan Mandiri
                    </div>
                    <a href="<?= base_url('employee/leaves') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold transition <?= str_contains($currentUri, 'employee/leaves') ? 'bg-brand-600 text-white shadow-lg shadow-brand-600/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' ?>">
                        <i class="ri-calendar-2-line text-base"></i>
                        <span>Pengajuan Izin / Cuti</span>
                    </a>
                    <a href="<?= base_url('employee/face-enrollment') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold transition <?= str_contains($currentUri, 'face-enrollment') ? 'bg-brand-600 text-white shadow-lg shadow-brand-600/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' ?>">
                        <i class="ri-user-smile-line text-base"></i>
                        <span>Kalibrasi Biometrik</span>
                    </a>
                    <a href="<?= base_url('employee/profile') ?>" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold transition <?= str_contains($currentUri, 'employee/profile') ? 'bg-brand-600 text-white shadow-lg shadow-brand-600/30' : 'text-slate-300 hover:bg-slate-800/70 hover:text-white' ?>">
                        <i class="ri-user-3-line text-base"></i>
                        <span>Profil & Keamanan</span>
                    </a>
                <?php endif; ?>

            </nav>
        </div>

        <!-- Bottom: User Card & Logout -->
        <div class="p-4 border-t border-slate-800/80 bg-slate-900/60">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-slate-800 border border-slate-700 overflow-hidden flex items-center justify-center shrink-0">
                    <?php if (session()->get('avatar')) : ?>
                        <img src="<?= base_url(session()->get('avatar')) ?>" alt="Avatar" class="w-full h-full object-cover">
                    <?php else : ?>
                        <span class="text-xs font-bold text-brand-400">
                            <?= strtoupper(substr(session()->get('name') ?? 'U', 0, 2)) ?>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-bold text-white truncate"><?= esc(session()->get('name')) ?></p>
                    <p class="text-[10px] text-slate-400 truncate"><?= esc(session()->get('email')) ?></p>
                </div>
                <a href="<?= base_url('logout') ?>" title="Keluar" class="p-2 text-slate-400 hover:text-red-400 hover:bg-slate-800 rounded-lg transition">
                    <i class="ri-logout-box-r-line text-base"></i>
                </a>
            </div>
        </div>

    </aside>

    <!-- ==========================================
             MAIN CONTENT AREA
        =========================================== -->
    <div class="flex-1 flex flex-col min-w-0 h-full overflow-hidden bg-slate-50">

        <!-- Top Header Bar -->
        <header class="h-16 md:h-20 bg-white border-b border-slate-200/80 px-4 sm:px-8 flex items-center justify-between shrink-0 shadow-xs z-30">
            <div class="flex items-center gap-3">
                <button id="open-sidebar-btn" class="md:hidden text-2xl text-slate-700 hover:text-navy-900 p-1.5 rounded-xl hover:bg-slate-100 transition">
                    <i class="ri-menu-2-line"></i>
                </button>
                <div>
                    <h1 class="text-base md:text-lg font-extrabold text-navy-900 leading-tight">
                        <?= $this->renderSection('page_heading') ?? 'Dashboard' ?>
                    </h1>
                    <p class="text-[11px] text-slate-500 hidden sm:block">
                        <?= date('l, d F Y') ?> • <span id="live-clock" class="font-semibold text-brand-600">--:--:--</span>
                    </p>
                </div>
            </div>

            <!-- Quick Action / Status Badge -->
            <div class="flex items-center gap-3">
                <a href="<?= base_url('attendance/scan') ?>" class="hidden sm:inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold text-white bg-brand-600 hover:bg-navy-900 shadow-md shadow-brand-600/20 transition-all">
                    <i class="ri-scan-2-line"></i>
                    <span>Presensi Cepat</span>
                </a>
                <a href="<?= base_url() ?>" class="p-2 text-slate-500 hover:text-navy-900 hover:bg-slate-100 rounded-xl transition" title="Ke Beranda">
                    <i class="ri-external-link-line text-base"></i>
                </a>
            </div>
        </header>

        <!-- Flash Messages Notification -->
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="mx-4 sm:mx-8 mt-4 bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-2xl text-xs font-medium flex items-center justify-between shadow-xs">
                <div class="flex items-center gap-2.5">
                    <i class="ri-checkbox-circle-fill text-emerald-600 text-base"></i>
                    <span><?= esc(session()->getFlashdata('success')) ?></span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">
                    <i class="ri-close-line text-base"></i>
                </button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="mx-4 sm:mx-8 mt-4 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-2xl text-xs font-medium flex items-center justify-between shadow-xs">
                <div class="flex items-center gap-2.5">
                    <i class="ri-error-warning-fill text-red-600 text-base"></i>
                    <span><?= esc(session()->getFlashdata('error')) ?></span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700">
                    <i class="ri-close-line text-base"></i>
                </button>
            </div>
        <?php endif; ?>

        <!-- Dynamic Body Content -->
        <main class="flex-1 overflow-y-auto p-4 sm:p-8 space-y-6">
            <?= $this->renderSection('content') ?>
        </main>

    </div>

    <!-- Live Digital Clock & Mobile Sidebar Script -->
    <script>
        function updateClock() {
            const clockEl = document.getElementById('live-clock');
            if (clockEl) {
                const now = new Date();
                clockEl.textContent = now.toLocaleTimeString('id-ID', { hour12: false });
            }
        }
        setInterval(updateClock, 1000);
        updateClock();

        // Sidebar Drawer Toggle for Mobile
        const sidebar = document.getElementById('main-sidebar');
        const backdrop = document.getElementById('sidebar-backdrop');
        const openBtn = document.getElementById('open-sidebar-btn');
        const closeBtn = document.getElementById('close-sidebar-btn');

        function toggleSidebar(open) {
            if (open) {
                sidebar.classList.remove('-translate-x-full');
                backdrop.classList.remove('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                backdrop.classList.add('hidden');
            }
        }

        openBtn?.addEventListener('click', () => toggleSidebar(true));
        closeBtn?.addEventListener('click', () => toggleSidebar(false));
        backdrop?.addEventListener('click', () => toggleSidebar(false));
    </script>

    <?= $this->renderSection('extra_scripts') ?>
</body>

</html>
