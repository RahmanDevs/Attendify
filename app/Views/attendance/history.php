<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('title') ?>
Riwayat Presensi | Attendify
<?= $this->endSection() ?>

<?= $this->section('page_heading') ?>
Riwayat & Timesheet Kehadiran
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="space-y-6">

    <!-- Filter & Header Bar -->
    <div class="bg-white p-5 rounded-3xl border border-slate-200/80 shadow-xs flex flex-col sm:flex-row items-center justify-between gap-4">
        <div>
            <h3 class="text-sm font-extrabold text-navy-900">Rekapitulasi Kehadiran</h3>
            <p class="text-xs text-slate-500">Daftar presensi harian beserta catatan jam masuk dan pulang.</p>
        </div>

        <form method="GET" action="<?= base_url('attendance/history') ?>" class="flex items-center gap-2.5 w-full sm:w-auto">
            <label class="text-xs font-bold text-slate-600 shrink-0">Bulan:</label>
            <input type="month" name="month" value="<?= esc($selectedMonth) ?>" onchange="this.form.submit()" class="px-3 py-1.5 text-xs rounded-xl border border-slate-200 focus:outline-none focus:border-brand-500 font-medium">
            <button type="submit" class="px-3.5 py-1.5 bg-brand-600 hover:bg-navy-900 text-white rounded-xl text-xs font-bold transition shadow-xs">
                Filter
            </button>
        </form>
    </div>

    <!-- Attendance History Table Card -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
        <?php if (empty($attendances)) : ?>
            <div class="text-center py-16 space-y-3">
                <div class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center mx-auto text-slate-400 text-2xl">
                    <i class="ri-calendar-event-line"></i>
                </div>
                <h4 class="text-sm font-bold text-navy-900">Belum Ada Catatan Presensi</h4>
                <p class="text-xs text-slate-500 max-w-sm mx-auto">Tidak ditemukan rekaman absensi pada periode bulan <?= esc($selectedMonth) ?>.</p>
            </div>
        <?php else : ?>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="text-[10px] uppercase font-bold text-slate-400 bg-slate-50/70 border-b border-slate-100">
                            <th class="py-3 px-6">Tanggal</th>
                            <th class="py-3 px-4">Jam Masuk</th>
                            <th class="py-3 px-4">Jam Pulang</th>
                            <th class="py-3 px-4">Akurasi AI</th>
                            <th class="py-3 px-4">Status</th>
                            <th class="py-3 px-6 text-right">Foto Bukti</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php foreach ($attendances as $row) : ?>
                            <tr class="hover:bg-slate-50/60 transition">
                                <td class="py-4 px-6 font-bold text-navy-900">
                                    <?= date('d M Y', strtotime($row['attendance_date'])) ?>
                                </td>
                                <td class="py-4 px-4 font-semibold text-slate-700">
                                    <?= $row['clock_in'] ? substr($row['clock_in'], 0, 5) . ' WIB' : '-' ?>
                                </td>
                                <td class="py-4 px-4 font-semibold text-slate-700">
                                    <?= $row['clock_out'] ? substr($row['clock_out'], 0, 5) . ' WIB' : '-' ?>
                                </td>
                                <td class="py-4 px-4">
                                    <span class="inline-flex items-center gap-1 font-bold text-brand-700 bg-brand-50 px-2.5 py-0.5 rounded-full text-[11px]">
                                        <i class="ri-flashlight-line"></i> <?= (float)$row['match_score'] ?>%
                                    </span>
                                </td>
                                <td class="py-4 px-4">
                                    <?php if ($row['status'] === 'present') : ?>
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                            Tepat Waktu
                                        </span>
                                    <?php elseif ($row['status'] === 'late') : ?>
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800">
                                            Terlambat
                                        </span>
                                    <?php else : ?>
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-slate-100 text-slate-700">
                                            <?= esc(ucfirst($row['status'])) ?>
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <?php if (!empty($row['in_photo'])) : ?>
                                        <img src="<?= base_url($row['in_photo']) ?>" alt="Bukti Presensi" class="w-9 h-9 rounded-xl object-cover border border-slate-200 inline-block shadow-xs hover:scale-150 transition transform origin-right">
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

</div>

<?= $this->endSection() ?>
