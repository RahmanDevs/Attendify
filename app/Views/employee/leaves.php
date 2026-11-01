<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('title') ?>
Pengajuan Izin & Cuti | Attendify
<?= $this->endSection() ?>

<?= $this->section('page_heading') ?>
Layanan Pengajuan Izin & Cuti
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="grid lg:grid-cols-12 gap-6">

    <!-- Form Pengajuan Baru -->
    <div class="lg:col-span-5 bg-white p-6 sm:p-7 rounded-3xl border border-slate-200/80 shadow-xs space-y-5">
        <div>
            <h3 class="text-sm font-extrabold text-navy-900">Form Pengajuan Izin Baru</h3>
            <p class="text-xs text-slate-500 mt-0.5">Kirimkan permohonan ketidakhadiran resmi kepada HRD.</p>
        </div>

        <?= form_open_multipart('employee/leaves/submit', ['class' => 'space-y-4 text-xs']) ?>

        <div>
            <label class="block font-bold text-navy-900 mb-1">Kategori Permohonan</label>
            <select name="type" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-brand-500 bg-white font-medium">
                <option value="leave">Cuti Tahunan (Annual Leave)</option>
                <option value="sick">Sakit (Memerlukan Surat Dokter)</option>
                <option value="permit">Izin Keperluan Pribadi / Mendesak</option>
                <option value="overtime">Pengajuan Lembur (Overtime)</option>
            </select>
        </div>

        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="block font-bold text-navy-900 mb-1">Tanggal Mulai</label>
                <input type="date" name="start_date" required value="<?= date('Y-m-d') ?>" class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:outline-none focus:border-brand-500 font-medium">
            </div>
            <div>
                <label class="block font-bold text-navy-900 mb-1">Tanggal Selesai</label>
                <input type="date" name="end_date" required value="<?= date('Y-m-d') ?>" class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:outline-none focus:border-brand-500 font-medium">
            </div>
        </div>

        <div>
            <label class="block font-bold text-navy-900 mb-1">Alasan Permohonan</label>
            <textarea name="reason" rows="3" required placeholder="Jelaskan keperluan atau keterangan medis secara ringkas..." class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-brand-500 resize-none font-medium"></textarea>
        </div>

        <div>
            <label class="block font-bold text-navy-900 mb-1">Dokumen Pendukung (Opsional)</label>
            <input type="file" name="attachment" accept=".pdf,.jpg,.jpeg,.png" class="w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-brand-50 file:text-brand-700 hover:file:bg-brand-100 cursor-pointer">
            <span class="text-[10px] text-slate-400 mt-1 block">Maksimal 2MB (Format PDF, PNG, atau JPG)</span>
        </div>

        <button type="submit" class="w-full py-3 bg-brand-600 hover:bg-navy-900 text-white rounded-xl text-xs font-bold transition shadow-md shadow-brand-600/20">
            Kirim Pengajuan ke HRD
        </button>

        <?= form_close() ?>
    </div>

    <!-- Riwayat Permohonan -->
    <div class="lg:col-span-7 bg-white p-6 sm:p-7 rounded-3xl border border-slate-200/80 shadow-xs space-y-4">
        <div>
            <h3 class="text-sm font-extrabold text-navy-900">Riwayat Pengajuan Saya</h3>
            <p class="text-xs text-slate-500 mt-0.5">Pantau status verifikasi dan tanggapan dari tim HRD.</p>
        </div>

        <?php if (empty($leaves)) : ?>
            <div class="text-center py-16 space-y-3">
                <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center mx-auto text-slate-400 text-xl">
                    <i class="ri-folder-open-line"></i>
                </div>
                <p class="text-xs font-medium text-slate-500">Anda belum pernah mengajukan izin atau cuti.</p>
            </div>
        <?php else : ?>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="text-[10px] uppercase font-bold text-slate-400 border-b border-slate-100">
                            <th class="pb-2.5">Kategori</th>
                            <th class="pb-2.5">Rentang Tanggal</th>
                            <th class="pb-2.5">Alasan</th>
                            <th class="pb-2.5 text-right">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <?php foreach ($leaves as $item) : ?>
                            <tr>
                                <td class="py-3.5 font-bold text-navy-900 capitalize">
                                    <?= esc($item['type']) ?>
                                </td>
                                <td class="py-3.5 text-slate-600">
                                    <?= date('d M', strtotime($item['start_date'])) ?> - <?= date('d M Y', strtotime($item['end_date'])) ?>
                                </td>
                                <td class="py-3.5 text-slate-500 max-w-[200px]">
                                    <p class="truncate font-medium"><?= esc($item['reason']) ?></p>
                                    <?php if (!empty($item['admin_notes'])) : ?>
                                        <p class="text-[10px] text-amber-700 font-semibold mt-0.5">Catatan HR: <?= esc($item['admin_notes']) ?></p>
                                    <?php endif; ?>
                                </td>
                                <td class="py-3.5 text-right">
                                    <?php if ($item['status'] === 'approved') : ?>
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                            Disetujui
                                        </span>
                                    <?php elseif ($item['status'] === 'rejected') : ?>
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-red-100 text-red-800">
                                            Ditolak
                                        </span>
                                    <?php else : ?>
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800">
                                            Menunggu
                                        </span>
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
