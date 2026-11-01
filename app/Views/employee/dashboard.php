<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('title') ?>
Dashboard Karyawan | Attendify
<?= $this->endSection() ?>

<?= $this->section('page_heading') ?>
Beranda Karyawan
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Welcome & Today Status Hero Card -->
<div class="relative overflow-hidden bg-gradient-to-r from-navy-900 via-navy-800 to-brand-700 rounded-3xl p-6 sm:p-8 text-white shadow-xl">
    <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-brand-500/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative z-10 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
        <div class="space-y-2 max-w-xl">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-md text-[11px] font-bold text-brand-200 border border-white/10">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <?= esc($user['department_name'] ?? 'Divisi Umum') ?> • <?= esc($user['shift_name'] ?? 'Shift Reguler') ?>
            </div>
            <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight">
                Halo, <?= esc($user['name']) ?>! 👋
            </h2>
            <p class="text-xs sm:text-sm text-slate-300 leading-relaxed font-normal">
                Pastikan Anda berada di area kantor saat melakukan presensi wajah. Jam kerja shift Anda: <span class="font-bold text-white"><?= substr($user['start_time'] ?? '08:00', 0, 5) ?> - <?= substr($user['end_time'] ?? '17:00', 0, 5) ?></span>.
            </p>
        </div>

        <!-- Attendance Action Card -->
        <div class="w-full lg:w-auto bg-white/10 backdrop-blur-md rounded-2xl p-5 border border-white/15 flex flex-col sm:flex-row lg:flex-col items-center gap-4 shrink-0">
            <div class="text-center sm:text-left lg:text-center">
                <span class="text-[10px] font-semibold text-slate-300 uppercase tracking-wider block">Status Presensi Hari Ini</span>
                <span class="text-sm font-bold text-white mt-0.5 inline-block">
                    <?php if (empty($todayAttendance['clock_in'])) : ?>
                        <span class="text-amber-300 flex items-center justify-center gap-1.5"><i class="ri-time-line"></i> Belum Presensi Masuk</span>
                    <?php elseif (empty($todayAttendance['clock_out'])) : ?>
                        <span class="text-emerald-400 flex items-center justify-center gap-1.5"><i class="ri-checkbox-circle-fill"></i> Masuk: <?= substr($todayAttendance['clock_in'], 0, 5) ?> (Aktif Bekerja)</span>
                    <?php else : ?>
                        <span class="text-brand-300 flex items-center justify-center gap-1.5"><i class="ri-check-double-line"></i> Selesai (Pulang: <?= substr($todayAttendance['clock_out'], 0, 5) ?>)</span>
                    <?php endif; ?>
                </span>
            </div>

            <?php if (empty($todayAttendance['clock_in'])) : ?>
                <a href="<?= base_url('attendance/scan') ?>" class="w-full sm:w-auto px-6 py-2.5 bg-brand-500 hover:bg-brand-600 text-white rounded-xl text-xs font-bold transition shadow-lg shadow-brand-500/30 flex items-center justify-center gap-2">
                    <i class="ri-scan-2-line text-sm"></i>
                    <span>Absen Masuk Sekarang</span>
                </a>
            <?php elseif (empty($todayAttendance['clock_out'])) : ?>
                <a href="<?= base_url('attendance/scan') ?>" class="w-full sm:w-auto px-6 py-2.5 bg-amber-500 hover:bg-amber-600 text-white rounded-xl text-xs font-bold transition shadow-lg shadow-amber-500/30 flex items-center justify-center gap-2">
                    <i class="ri-logout-box-line text-sm"></i>
                    <span>Absen Pulang Sekarang</span>
                </a>
            <?php else : ?>
                <div class="px-5 py-2 bg-white/20 rounded-xl text-[11px] font-bold text-slate-200 text-center">
                    Tugas Hari Ini Selesai ✨
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- 4 Clean Metric Cards -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
    <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-blue-50 border border-blue-100 flex items-center justify-center text-brand-600 text-xl shrink-0">
            <i class="ri-calendar-check-fill"></i>
        </div>
        <div>
            <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">Hadir Bulan Ini</p>
            <h3 class="text-xl font-extrabold text-navy-900 mt-0.5"><?= $totalPresent ?> Hari</h3>
        </div>
    </div>

    <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-600 text-xl shrink-0">
            <i class="ri-alarm-warning-fill"></i>
        </div>
        <div>
            <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">Terlambat</p>
            <h3 class="text-xl font-extrabold text-navy-900 mt-0.5"><?= $totalLate ?> Hari</h3>
        </div>
    </div>

    <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-600 text-xl shrink-0">
            <i class="ri-shield-check-fill"></i>
        </div>
        <div>
            <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">Tepat Waktu</p>
            <h3 class="text-xl font-extrabold text-navy-900 mt-0.5"><?= max(0, $totalPresent - $totalLate) ?> Hari</h3>
        </div>
    </div>

    <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-purple-50 border border-purple-100 flex items-center justify-center text-purple-600 text-xl shrink-0">
            <i class="ri-flight-takeoff-fill"></i>
        </div>
        <div>
            <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider">Permohonan Izin</p>
            <h3 class="text-xl font-extrabold text-navy-900 mt-0.5"><?= count($recentLeaves) ?> Pengajuan</h3>
        </div>
    </div>
</div>

<!-- Details & Quick Tables Section -->
<div class="grid lg:grid-cols-12 gap-6">

    <!-- Today's Schedule Card -->
    <div class="lg:col-span-5 bg-white p-6 rounded-3xl border border-slate-200/80 shadow-xs space-y-5">
        <div class="flex items-center justify-between">
            <h3 class="text-sm font-extrabold text-navy-900 flex items-center gap-2">
                <i class="ri-time-line text-brand-600"></i>
                Rincian Jadwal Hari Ini
            </h3>
            <span class="text-[10px] font-bold text-brand-600 bg-brand-50 px-2.5 py-1 rounded-full">
                <?= esc($user['shift_name'] ?? 'Reguler') ?>
            </span>
        </div>

        <div class="space-y-3">
            <div class="flex items-center justify-between p-3.5 rounded-xl bg-slate-50 border border-slate-100">
                <span class="text-xs font-semibold text-slate-600">Jam Masuk Shift</span>
                <span class="text-xs font-extrabold text-navy-900"><?= substr($user['start_time'] ?? '08:00:00', 0, 5) ?> WIB</span>
            </div>
            <div class="flex items-center justify-between p-3.5 rounded-xl bg-slate-50 border border-slate-100">
                <span class="text-xs font-semibold text-slate-600">Batas Toleransi Keterlambatan</span>
                <span class="text-xs font-extrabold text-amber-600"><?= $user['late_tolerance_minutes'] ?? 15 ?> Menit</span>
            </div>
            <div class="flex items-center justify-between p-3.5 rounded-xl bg-slate-50 border border-slate-100">
                <span class="text-xs font-semibold text-slate-600">Jam Pulang Shift</span>
                <span class="text-xs font-extrabold text-navy-900"><?= substr($user['end_time'] ?? '17:00:00', 0, 5) ?> WIB</span>
            </div>
        </div>

        <div class="pt-2">
            <a href="<?= base_url('employee/face-enrollment') ?>" class="w-full flex items-center justify-center gap-2 py-2.5 rounded-xl border border-dashed border-brand-300 hover:border-brand-500 hover:bg-brand-50/50 text-xs font-bold text-brand-700 transition">
                <i class="ri-user-smile-line text-sm"></i>
                Kalibrasi Biometrik Wajah
            </a>
        </div>
    </div>

    <!-- Recent Leaves Card -->
    <div class="lg:col-span-7 bg-white p-6 rounded-3xl border border-slate-200/80 shadow-xs space-y-4">
        <div class="flex items-center justify-between">
            <h3 class="text-sm font-extrabold text-navy-900 flex items-center gap-2">
                <i class="ri-file-list-3-line text-brand-600"></i>
                Status Pengajuan Izin / Cuti Terakhir
            </h3>
            <a href="<?= base_url('employee/leaves') ?>" class="text-[11px] font-bold text-brand-600 hover:underline">
                Ajukan Baru →
            </a>
        </div>

        <?php if (empty($recentLeaves)) : ?>
            <div class="text-center py-10 space-y-2">
                <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center mx-auto text-slate-400 text-xl">
                    <i class="ri-inbox-line"></i>
                </div>
                <p class="text-xs font-medium text-slate-500">Belum ada pengajuan izin atau cuti yang diajukan.</p>
            </div>
        <?php else : ?>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="text-[10px] uppercase font-bold text-slate-400 border-b border-slate-100">
                            <th class="pb-2.5">Tipe</th>
                            <th class="pb-2.5">Tanggal</th>
                            <th class="pb-2.5">Alasan</th>
                            <th class="pb-2.5 text-right">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php foreach ($recentLeaves as $l) : ?>
                            <tr>
                                <td class="py-3 font-bold text-navy-900 capitalize"><?= esc($l['type']) ?></td>
                                <td class="py-3 text-slate-600"><?= esc($l['start_date']) ?> s/d <?= esc($l['end_date']) ?></td>
                                <td class="py-3 text-slate-500 max-w-xs truncate"><?= esc($l['reason']) ?></td>
                                <td class="py-3 text-right">
                                    <?php if ($l['status'] === 'approved') : ?>
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">Disetujui</span>
                                    <?php elseif ($l['status'] === 'rejected') : ?>
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-red-100 text-red-800">Ditolak</span>
                                    <?php else : ?>
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800">Menunggu</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

</div>

<?= $this->endSection() ?>
