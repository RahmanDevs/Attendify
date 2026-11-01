<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('title') ?>
Pusat Persetujuan Cuti & Izin | Attendify
<?= $this->endSection() ?>

<?= $this->section('page_heading') ?>
Approval Hub Cuti & Izin
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="space-y-6">

    <!-- Filter Tabs -->
    <div class="bg-white p-4 rounded-3xl border border-slate-200/80 shadow-xs flex items-center justify-between">
        <div class="flex items-center gap-2 overflow-x-auto">
            <a href="<?= base_url('admin/leaves') ?>" class="px-4 py-2 rounded-xl text-xs font-bold transition <?= empty($statusFilter) ? 'bg-navy-900 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' ?>">
                Semua Permohonan
            </a>
            <a href="<?= base_url('admin/leaves?status=pending') ?>" class="px-4 py-2 rounded-xl text-xs font-bold transition <?= ($statusFilter === 'pending') ? 'bg-amber-500 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' ?>">
                Menunggu Persetujuan
            </a>
            <a href="<?= base_url('admin/leaves?status=approved') ?>" class="px-4 py-2 rounded-xl text-xs font-bold transition <?= ($statusFilter === 'approved') ? 'bg-emerald-600 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' ?>">
                Disetujui
            </a>
            <a href="<?= base_url('admin/leaves?status=rejected') ?>" class="px-4 py-2 rounded-xl text-xs font-bold transition <?= ($statusFilter === 'rejected') ? 'bg-red-600 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' ?>">
                Ditolak
            </a>
        </div>
    </div>

    <!-- Leaves Table -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
        <?php if (empty($leaves)) : ?>
            <div class="text-center py-16 space-y-2">
                <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center mx-auto text-slate-400 text-xl">
                    <i class="ri-inbox-line"></i>
                </div>
                <p class="text-xs font-medium text-slate-500">Tidak ada data permohonan pada filter ini.</p>
            </div>
        <?php else : ?>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="text-[10px] uppercase font-bold text-slate-400 bg-slate-50/60 border-b border-slate-100">
                            <th class="py-3 px-6">Karyawan</th>
                            <th class="py-3 px-4">Kategori</th>
                            <th class="py-3 px-4">Rentang Tanggal</th>
                            <th class="py-3 px-4">Alasan & Bukti</th>
                            <th class="py-3 px-4">Status</th>
                            <th class="py-3 px-6 text-right">Keputusan HR</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php foreach ($leaves as $item) : ?>
                            <tr class="hover:bg-slate-50/60 transition">
                                <td class="py-4 px-6">
                                    <p class="font-bold text-navy-900"><?= esc($item['user_name']) ?></p>
                                    <p class="text-[10px] text-slate-400"><?= esc($item['department_name'] ?? 'Umum') ?> • <?= esc($item['nik'] ?? '-') ?></p>
                                </td>
                                <td class="py-4 px-4 font-bold text-navy-900 capitalize">
                                    <?= esc($item['type']) ?>
                                </td>
                                <td class="py-4 px-4 text-slate-700">
                                    <?= date('d M Y', strtotime($item['start_date'])) ?> s/d <?= date('d M Y', strtotime($item['end_date'])) ?>
                                </td>
                                <td class="py-4 px-4 max-w-xs">
                                    <p class="text-slate-600 truncate"><?= esc($item['reason']) ?></p>
                                    <?php if (!empty($item['attachment_path'])) : ?>
                                        <a href="<?= base_url($item['attachment_path']) ?>" target="_blank" class="text-[11px] font-bold text-brand-600 hover:underline inline-flex items-center gap-1 mt-0.5">
                                            <i class="ri-attachment-line"></i> Lihat Lampiran Bukti
                                        </a>
                                    <?php endif; ?>
                                </td>
                                <td class="py-4 px-4">
                                    <?php if ($item['status'] === 'approved') : ?>
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">Disetujui</span>
                                    <?php elseif ($item['status'] === 'rejected') : ?>
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-red-100 text-red-800">Ditolak</span>
                                    <?php else : ?>
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800">Menunggu</span>
                                    <?php endif; ?>
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <?php if ($item['status'] === 'pending') : ?>
                                        <div class="inline-flex gap-2">
                                            <?= form_open('admin/leaves/action/' . $item['id'], ['class' => 'inline']) ?>
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" class="px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-[11px] font-bold transition shadow-xs">
                                                Approve
                                            </button>
                                            <?= form_close() ?>

                                            <?= form_open('admin/leaves/action/' . $item['id'], ['class' => 'inline']) ?>
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white rounded-lg text-[11px] font-bold transition shadow-xs">
                                                Tolak
                                            </button>
                                            <?= form_close() ?>
                                        </div>
                                    <?php else : ?>
                                        <span class="text-slate-400 text-[11px]">Selesai diproses</span>
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
