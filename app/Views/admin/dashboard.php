<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('title') ?>
Dashboard HRD & Eksekutif | Attendify
<?= $this->endSection() ?>

<?= $this->section('page_heading') ?>
Executive HR Dashboard
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Top Executive Metrics Bar -->
<div class="grid grid-cols-2 lg:grid-cols-5 gap-4 sm:gap-5">

    <div class="bg-white p-5 rounded-3xl border border-slate-200/80 shadow-xs flex flex-col justify-between">
        <div class="flex items-center justify-between">
            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Total Karyawan</span>
            <div class="w-8 h-8 rounded-lg bg-blue-50 text-brand-600 flex items-center justify-center text-base">
                <i class="ri-team-line"></i>
            </div>
        </div>
        <div class="mt-3">
            <h3 class="text-2xl font-black text-navy-900"><?= $totalEmployees ?></h3>
            <p class="text-[10px] text-slate-400 mt-0.5">Karyawan Terdaftar</p>
        </div>
    </div>

    <div class="bg-white p-5 rounded-3xl border border-slate-200/80 shadow-xs flex flex-col justify-between">
        <div class="flex items-center justify-between">
            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Hadir Hari Ini</span>
            <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center text-base">
                <i class="ri-user-follow-line"></i>
            </div>
        </div>
        <div class="mt-3">
            <h3 class="text-2xl font-black text-emerald-600"><?= $totalPresent ?></h3>
            <p class="text-[10px] text-slate-400 mt-0.5">Clock-In Tercatat</p>
        </div>
    </div>

    <div class="bg-white p-5 rounded-3xl border border-slate-200/80 shadow-xs flex flex-col justify-between">
        <div class="flex items-center justify-between">
            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Terlambat</span>
            <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center text-base">
                <i class="ri-alarm-warning-line"></i>
            </div>
        </div>
        <div class="mt-3">
            <h3 class="text-2xl font-black text-amber-600"><?= $totalLate ?></h3>
            <p class="text-[10px] text-slate-400 mt-0.5">Melebihi Toleransi Shift</p>
        </div>
    </div>

    <div class="bg-white p-5 rounded-3xl border border-slate-200/80 shadow-xs flex flex-col justify-between">
        <div class="flex items-center justify-between">
            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Approval Cuti</span>
            <div class="w-8 h-8 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center text-base">
                <i class="ri-mail-check-line"></i>
            </div>
        </div>
        <div class="mt-3">
            <h3 class="text-2xl font-black text-purple-600"><?= $pendingLeaves ?></h3>
            <p class="text-[10px] text-slate-400 mt-0.5">Menunggu Tindakan HR</p>
        </div>
    </div>

    <div class="col-span-2 lg:col-span-1 bg-gradient-to-tr from-brand-700 to-brand-500 p-5 rounded-3xl text-white shadow-md shadow-brand-600/20 flex flex-col justify-between">
        <div class="flex items-center justify-between">
            <span class="text-[10px] font-bold uppercase tracking-wider text-brand-100">Attendance Rate</span>
            <i class="ri-pie-chart-2-line text-lg text-brand-200"></i>
        </div>
        <div class="mt-3">
            <h3 class="text-2xl font-black"><?= $attendanceRate ?>%</h3>
            <div class="w-full bg-white/20 h-1.5 rounded-full mt-2 overflow-hidden">
                <div class="bg-white h-full rounded-full" style="width: <?= min(100, $attendanceRate) ?>%"></div>
            </div>
        </div>
    </div>

</div>

<!-- Real-time Live Attendance Feed -->
<div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
    <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
        <div>
            <h3 class="text-sm font-extrabold text-navy-900 flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-ping"></span>
                Aktivitas Presensi Terkini (Live Feed)
            </h3>
            <p class="text-xs text-slate-500 mt-0.5">Pemindaian wajah presensi karyawan yang tercatat secara real-time.</p>
        </div>
        <a href="<?= base_url('admin/attendance/live') ?>" class="text-xs font-bold text-brand-600 hover:text-navy-900 transition flex items-center gap-1">
            Lihat Layar Monitor Penuh <i class="ri-arrow-right-line"></i>
        </a>
    </div>

    <?php if (empty($recentFeed)) : ?>
        <div class="text-center py-16 space-y-2">
            <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center mx-auto text-slate-400 text-xl">
                <i class="ri-scan-line"></i>
            </div>
            <p class="text-xs font-medium text-slate-500">Belum ada aktivitas presensi wajah tercatat hari ini.</p>
        </div>
    <?php else : ?>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="text-[10px] uppercase font-bold text-slate-400 bg-slate-50/60 border-b border-slate-100">
                        <th class="py-3 px-6">Karyawan</th>
                        <th class="py-3 px-4">Divisi</th>
                        <th class="py-3 px-4">Jam Masuk</th>
                        <th class="py-3 px-4">Jam Pulang</th>
                        <th class="py-3 px-4">Match Score AI</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-6 text-right">Foto Verifikasi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php foreach ($recentFeed as $feed) : ?>
                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="py-3.5 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-slate-100 overflow-hidden shrink-0 border border-slate-200">
                                        <?php if (!empty($feed['avatar'])) : ?>
                                            <img src="<?= base_url($feed['avatar']) ?>" class="w-full h-full object-cover">
                                        <?php else : ?>
                                            <div class="w-full h-full flex items-center justify-center text-[10px] font-bold text-slate-500">
                                                <?= strtoupper(substr($feed['user_name'] ?? 'U', 0, 2)) ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                        <p class="font-bold text-navy-900"><?= esc($feed['user_name']) ?></p>
                                        <p class="text-[10px] text-slate-400">NIK: <?= esc($feed['nik'] ?? '-') ?></p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3.5 px-4 text-slate-600 font-medium">
                                <?= esc($feed['department_name'] ?? 'Umum') ?>
                            </td>
                            <td class="py-3.5 px-4 font-bold text-navy-900">
                                <?= $feed['clock_in'] ? substr($feed['clock_in'], 0, 5) . ' WIB' : '-' ?>
                            </td>
                            <td class="py-3.5 px-4 font-bold text-navy-900">
                                <?= $feed['clock_out'] ? substr($feed['clock_out'], 0, 5) . ' WIB' : '<span class="text-slate-400 font-normal">Aktif</span>' ?>
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="inline-flex items-center gap-1 font-bold text-brand-700 bg-brand-50 px-2 py-0.5 rounded-full text-[10px]">
                                    <i class="ri-flashlight-line"></i> <?= (float)$feed['match_score'] ?>%
                                </span>
                            </td>
                            <td class="py-3.5 px-4">
                                <?php if ($feed['status'] === 'present') : ?>
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">Tepat Waktu</span>
                                <?php elseif ($feed['status'] === 'late') : ?>
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800">Terlambat</span>
                                <?php else : ?>
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-slate-100 text-slate-700"><?= esc(ucfirst($feed['status'])) ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="py-3.5 px-6 text-right">
                                <?php if (!empty($feed['in_photo'])) : ?>
                                    <img src="<?= base_url($feed['in_photo']) ?>" class="w-8 h-8 rounded-lg object-cover border border-slate-200 inline-block shadow-xs hover:scale-150 transition transform origin-right">
                                <?php else : ?>
                                    <span class="text-slate-400 text-[11px]">-</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
