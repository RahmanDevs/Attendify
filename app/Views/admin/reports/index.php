<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('title') ?>
Laporan & Rekapitulasi Presensi | Attendify
<?= $this->endSection() ?>

<?= $this->section('page_heading') ?>
Laporan Kehadiran Karyawan
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="space-y-6">

    <!-- Filter Card -->
    <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-xs space-y-4">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h3 class="text-sm font-extrabold text-navy-900">Filter Rekapitulasi Presensi</h3>
                <p class="text-xs text-slate-500 mt-0.5">Tentukan rentang tanggal dan divisi untuk menghasilkan laporan terstruktur.</p>
            </div>

            <!-- Print / Export Button -->
            <button onclick="window.print()" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-navy-900 rounded-xl text-xs font-bold transition flex items-center gap-2">
                <i class="ri-printer-line text-sm"></i>
                <span>Cetak / Simpan PDF</span>
            </button>
        </div>

        <form method="GET" action="<?= base_url('admin/reports') ?>" class="grid sm:grid-cols-4 gap-3 text-xs pt-2">
            <div>
                <label class="block font-bold text-slate-600 mb-1">Dari Tanggal</label>
                <input type="date" name="start_date" value="<?= esc($startDate) ?>" class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:outline-none focus:border-brand-500 font-medium">
            </div>
            <div>
                <label class="block font-bold text-slate-600 mb-1">Sampai Tanggal</label>
                <input type="date" name="end_date" value="<?= esc($endDate) ?>" class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:outline-none focus:border-brand-500 font-medium">
            </div>
            <div>
                <label class="block font-bold text-slate-600 mb-1">Divisi / Departemen</label>
                <select name="department_id" class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:outline-none focus:border-brand-500 font-medium bg-white">
                    <option value="">Semua Divisi</option>
                    <?php foreach ($departments as $d) : ?>
                        <option value="<?= $d['id'] ?>" <?= ($selectedDept == $d['id']) ? 'selected' : '' ?>><?= esc($d['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit" class="w-full py-2.5 bg-brand-600 hover:bg-navy-900 text-white rounded-xl font-bold transition shadow-xs flex items-center justify-center gap-2">
                    <i class="ri-filter-3-line"></i>
                    <span>Terapkan Filter</span>
                </button>
            </div>
        </form>
    </div>

    <!-- Report Table Card -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
        <?php if (empty($records)) : ?>
            <div class="text-center py-16 space-y-2">
                <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center mx-auto text-slate-400 text-xl">
                    <i class="ri-file-search-line"></i>
                </div>
                <h4 class="text-sm font-bold text-navy-900">Tidak Ada Data Presensi</h4>
                <p class="text-xs text-slate-500">Tidak ditemukan rekaman pada rentang tanggal <?= esc($startDate) ?> s/d <?= esc($endDate) ?>.</p>
            </div>
        <?php else : ?>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="text-[10px] uppercase font-bold text-slate-400 bg-slate-50/60 border-b border-slate-100">
                            <th class="py-3 px-6">Tanggal</th>
                            <th class="py-3 px-4">Karyawan</th>
                            <th class="py-3 px-4">Divisi & Shift</th>
                            <th class="py-3 px-4">Jam Masuk</th>
                            <th class="py-3 px-4">Jam Pulang</th>
                            <th class="py-3 px-4">Akurasi AI</th>
                            <th class="py-3 px-6 text-right">Status Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php foreach ($records as $r) : ?>
                            <tr class="hover:bg-slate-50/60 transition">
                                <td class="py-3.5 px-6 font-bold text-navy-900">
                                    <?= date('d M Y', strtotime($r['attendance_date'])) ?>
                                </td>
                                <td class="py-3.5 px-4">
                                    <p class="font-bold text-navy-900"><?= esc($r['user_name']) ?></p>
                                    <p class="text-[10px] text-slate-400">NIK: <?= esc($r['nik'] ?? '-') ?></p>
                                </td>
                                <td class="py-3.5 px-4">
                                    <p class="font-bold text-slate-700"><?= esc($r['department_name'] ?? 'Umum') ?></p>
                                    <p class="text-[10px] text-slate-400"><?= esc($r['shift_name'] ?? 'Reguler') ?></p>
                                </td>
                                <td class="py-3.5 px-4 font-mono font-bold text-slate-800">
                                    <?= $r['clock_in'] ? substr($r['clock_in'], 0, 5) . ' WIB' : '-' ?>
                                </td>
                                <td class="py-3.5 px-4 font-mono font-bold text-slate-800">
                                    <?= $r['clock_out'] ? substr($r['clock_out'], 0, 5) . ' WIB' : '-' ?>
                                </td>
                                <td class="py-3.5 px-4 font-bold text-brand-700">
                                    <?= (float)$r['match_score'] ?>%
                                </td>
                                <td class="py-3.5 px-6 text-right">
                                    <?php if ($r['status'] === 'present') : ?>
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">Tepat Waktu</span>
                                    <?php elseif ($r['status'] === 'late') : ?>
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800">Terlambat</span>
                                    <?php else : ?>
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-slate-100 text-slate-700"><?= esc(ucfirst($r['status'])) ?></span>
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
