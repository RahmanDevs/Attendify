<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('title') ?>
Live Feed Presensi Real-Time | Attendify
<?= $this->endSection() ?>

<?= $this->section('page_heading') ?>
Live Stream Presensi Karyawan
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="space-y-6">

    <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-xs flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <div class="inline-flex items-center gap-2 px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-bold mb-1">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
                Auto-Refresh Stream Aktif (Detik per Detik)
            </div>
            <h2 class="text-base font-extrabold text-navy-900">Pemindaian Wajah Detik Demi Detik</h2>
            <p class="text-xs text-slate-500">Menampilkan verifikasi presensi terbaru di seluruh terminal kantor.</p>
        </div>

        <button onclick="window.location.reload()" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-navy-900 rounded-xl text-xs font-bold transition flex items-center gap-2">
            <i class="ri-refresh-line"></i>
            Segarkan Layar
        </button>
    </div>

    <!-- Live Grid Cards -->
    <?php if (empty($feed)) : ?>
        <div class="bg-white p-12 rounded-3xl border border-slate-200/80 text-center space-y-3 shadow-xs">
            <div class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center mx-auto text-slate-400 text-2xl">
                <i class="ri-time-line"></i>
            </div>
            <h3 class="text-sm font-bold text-navy-900">Belum Ada Presensi Masuk Hari Ini</h3>
            <p class="text-xs text-slate-500">Saat karyawan melakukan scan wajah, log verifikasi akan tampil di layar ini secara otomatis.</p>
        </div>
    <?php else : ?>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
            <?php foreach ($feed as $item) : ?>
                <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs flex flex-col justify-between space-y-3 hover:border-brand-300 transition">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-slate-100 overflow-hidden shrink-0 border border-slate-200">
                            <?php if (!empty($item['in_photo'])) : ?>
                                <img src="<?= base_url($item['in_photo']) ?>" class="w-full h-full object-cover">
                            <?php else : ?>
                                <div class="w-full h-full flex items-center justify-center font-black text-slate-400 text-sm">
                                    <?= strtoupper(substr($item['user_name'] ?? 'U', 0, 2)) ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="min-w-0">
                            <h4 class="text-xs font-extrabold text-navy-900 truncate"><?= esc($item['user_name']) ?></h4>
                            <p class="text-[10px] text-slate-500"><?= esc($item['department_name'] ?? 'Divisi Umum') ?></p>
                            <span class="inline-flex items-center gap-1 font-bold text-brand-700 text-[10px]">
                                <i class="ri-flashlight-line"></i> <?= (float)$item['match_score'] ?>% Match
                            </span>
                        </div>
                    </div>

                    <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-100 text-[11px] space-y-1">
                        <div class="flex justify-between">
                            <span class="text-slate-500">Jam Masuk:</span>
                            <span class="font-bold text-navy-900"><?= $item['clock_in'] ? substr($item['clock_in'], 0, 5) : '-' ?> WIB</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-500">Status:</span>
                            <?php if ($item['status'] === 'present') : ?>
                                <span class="font-bold text-emerald-700">Tepat Waktu</span>
                            <?php elseif ($item['status'] === 'late') : ?>
                                <span class="font-bold text-amber-700">Terlambat</span>
                            <?php else : ?>
                                <span class="font-bold text-slate-700"><?= esc(ucfirst($item['status'])) ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</div>

<script>
    // Auto-refresh feed every 15 seconds
    setTimeout(() => {
        window.location.reload();
    }, 15000);
</script>

<?= $this->endSection() ?>
