<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('title') ?>
Manajemen Shift & Jam Kerja | Attendify
<?= $this->endSection() ?>

<?= $this->section('page_heading') ?>
Pengaturan Shift & Jam Kerja
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="space-y-6">

    <!-- Top Action Bar -->
    <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-xs flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h3 class="text-sm font-extrabold text-navy-900">Jadwal Shift & Kebijakan Toleransi</h3>
            <p class="text-xs text-slate-500 mt-0.5">Konfigurasikan jam masuk kerja, jam pulang, dan menit toleransi keterlambatan.</p>
        </div>

        <button onclick="document.getElementById('modal-add-shift').classList.remove('hidden')" class="px-4 py-2.5 bg-brand-600 hover:bg-navy-900 text-white rounded-xl text-xs font-bold transition shadow-md shadow-brand-600/20 flex items-center gap-2">
            <i class="ri-add-circle-line text-sm"></i>
            <span>Tambah Shift Baru</span>
        </button>
    </div>

    <!-- Shifts Table -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="text-[10px] uppercase font-bold text-slate-400 bg-slate-50/60 border-b border-slate-100">
                        <th class="py-3 px-6">Nama Shift</th>
                        <th class="py-3 px-4">Jam Masuk</th>
                        <th class="py-3 px-4">Jam Pulang</th>
                        <th class="py-3 px-4">Toleransi Telat</th>
                        <th class="py-3 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php foreach ($shifts as $s) : ?>
                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="py-4 px-6 font-bold text-navy-900">
                                <?= esc($s['name']) ?>
                            </td>
                            <td class="py-4 px-4 font-mono font-bold text-brand-600">
                                <?= substr($s['start_time'], 0, 5) ?> WIB
                            </td>
                            <td class="py-4 px-4 font-mono font-bold text-slate-700">
                                <?= substr($s['end_time'], 0, 5) ?> WIB
                            </td>
                            <td class="py-4 px-4 font-bold text-amber-600">
                                <?= $s['late_tolerance_minutes'] ?> Menit
                            </td>
                            <td class="py-4 px-6 text-right">
                                <?= form_open('admin/shifts/delete/' . $s['id'], ['class' => 'inline', 'onsubmit' => 'return confirm("Hapus shift ini?")']) ?>
                                <button type="submit" class="p-1.5 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50 transition">
                                    <i class="ri-delete-bin-line text-sm"></i>
                                </button>
                                <?= form_close() ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Modal Add Shift -->
<div id="modal-add-shift" class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-50 flex items-center justify-center p-4 hidden">
    <div class="bg-white rounded-3xl max-w-md w-full p-6 sm:p-7 space-y-4 shadow-2xl">
        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
            <h3 class="text-sm font-extrabold text-navy-900">Tambah Shift Kerja Baru</h3>
            <button onclick="document.getElementById('modal-add-shift').classList.add('hidden')" class="text-slate-400 hover:text-navy-900 text-lg">
                <i class="ri-close-line"></i>
            </button>
        </div>

        <?= form_open('admin/shifts/save', ['class' => 'space-y-3.5 text-xs']) ?>

        <div>
            <label class="block font-bold text-navy-900 mb-1">Nama Shift</label>
            <input type="text" name="name" placeholder="Contoh: Shift Malam" required class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:outline-none focus:border-brand-500 font-medium">
        </div>

        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="block font-bold text-navy-900 mb-1">Jam Masuk</label>
                <input type="time" name="start_time" required class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:outline-none focus:border-brand-500 font-medium">
            </div>
            <div>
                <label class="block font-bold text-navy-900 mb-1">Jam Pulang</label>
                <input type="time" name="end_time" required class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:outline-none focus:border-brand-500 font-medium">
            </div>
        </div>

        <div>
            <label class="block font-bold text-navy-900 mb-1">Toleransi Keterlambatan (Menit)</label>
            <input type="number" name="late_tolerance_minutes" value="15" min="0" max="120" required class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:outline-none focus:border-brand-500 font-medium">
        </div>

        <div class="pt-3 flex gap-3 justify-end">
            <button type="button" onclick="document.getElementById('modal-add-shift').classList.add('hidden')" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl font-bold transition">
                Batal
            </button>
            <button type="submit" class="px-5 py-2 bg-brand-600 hover:bg-navy-900 text-white rounded-xl font-bold transition shadow-xs">
                Simpan Shift
            </button>
        </div>

        <?= form_close() ?>
    </div>
</div>

<?= $this->endSection() ?>
