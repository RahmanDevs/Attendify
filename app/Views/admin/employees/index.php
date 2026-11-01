<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('title') ?>
Manajemen Karyawan | Attendify
<?= $this->endSection() ?>

<?= $this->section('page_heading') ?>
Data Master Karyawan
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="space-y-6">

    <!-- Top Action Bar -->
    <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-xs flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h3 class="text-sm font-extrabold text-navy-900">Kelola Akun & Biometrik Karyawan</h3>
            <p class="text-xs text-slate-500 mt-0.5">Daftarkan staf baru, atur shift, divisi, atau reset data pemindaian wajah.</p>
        </div>

        <button onclick="document.getElementById('modal-add-employee').classList.remove('hidden')" class="px-4 py-2.5 bg-brand-600 hover:bg-navy-900 text-white rounded-xl text-xs font-bold transition shadow-md shadow-brand-600/20 flex items-center gap-2">
            <i class="ri-user-add-line text-sm"></i>
            <span>Tambah Karyawan Baru</span>
        </button>
    </div>

    <!-- Employees Table -->
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="text-[10px] uppercase font-bold text-slate-400 bg-slate-50/60 border-b border-slate-100">
                        <th class="py-3 px-6">Identitas Karyawan</th>
                        <th class="py-3 px-4">NIK</th>
                        <th class="py-3 px-4">Divisi & Shift</th>
                        <th class="py-3 px-4">Hak Akses</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-6 text-right">Opsi Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php foreach ($employees as $emp) : ?>
                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="py-3.5 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-slate-100 overflow-hidden shrink-0 border border-slate-200 flex items-center justify-center font-bold text-[10px] text-slate-600">
                                        <?php if (!empty($emp['avatar'])) : ?>
                                            <img src="<?= base_url($emp['avatar']) ?>" class="w-full h-full object-cover">
                                        <?php else : ?>
                                            <?= strtoupper(substr($emp['name'], 0, 2)) ?>
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                        <p class="font-bold text-navy-900"><?= esc($emp['name']) ?></p>
                                        <p class="text-[10px] text-slate-400"><?= esc($emp['email']) ?></p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3.5 px-4 font-mono font-bold text-slate-700">
                                <?= esc($emp['nik'] ?? '-') ?>
                            </td>
                            <td class="py-3.5 px-4">
                                <p class="font-bold text-navy-900"><?= esc($emp['department_name'] ?? 'Umum') ?></p>
                                <p class="text-[10px] text-slate-500"><?= esc($emp['shift_name'] ?? 'Reguler') ?></p>
                            </td>
                            <td class="py-3.5 px-4">
                                <?php if ($emp['role'] === 'admin') : ?>
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-purple-100 text-purple-800">Admin HR</span>
                                <?php else : ?>
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-100 text-blue-800">Karyawan</span>
                                <?php endif; ?>
                            </td>
                            <td class="py-3.5 px-4">
                                <?php if ($emp['is_active']) : ?>
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">Aktif</span>
                                <?php else : ?>
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-200 text-slate-700">Nonaktif</span>
                                <?php endif; ?>
                            </td>
                            <td class="py-3.5 px-6 text-right space-x-1.5">
                                <!-- Reset Biometrics Button -->
                                <?= form_open('admin/employees/reset-face/' . $emp['id'], ['class' => 'inline', 'onsubmit' => 'return confirm("Reset biometrik wajah karyawan ini?")']) ?>
                                <button type="submit" title="Reset Biometrik Wajah" class="p-1.5 rounded-lg text-slate-400 hover:text-amber-600 hover:bg-amber-50 transition">
                                    <i class="ri-user-unfollow-line text-sm"></i>
                                </button>
                                <?= form_close() ?>

                                <!-- Delete Button -->
                                <?php if ($emp['id'] !== (int)session()->get('user_id')) : ?>
                                    <?= form_open('admin/employees/delete/' . $emp['id'], ['class' => 'inline', 'onsubmit' => 'return confirm("Yakin ingin menghapus karyawan ini?")']) ?>
                                    <button type="submit" title="Hapus Karyawan" class="p-1.5 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50 transition">
                                        <i class="ri-delete-bin-line text-sm"></i>
                                    </button>
                                    <?= form_close() ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Modal Tambah Karyawan -->
<div id="modal-add-employee" class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-50 flex items-center justify-center p-4 hidden">
    <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 space-y-5 shadow-2xl relative">
        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
            <h3 class="text-sm font-extrabold text-navy-900">Tambah Data Karyawan Baru</h3>
            <button onclick="document.getElementById('modal-add-employee').classList.add('hidden')" class="text-slate-400 hover:text-navy-900 text-lg">
                <i class="ri-close-line"></i>
            </button>
        </div>

        <?= form_open('admin/employees/store', ['class' => 'space-y-3.5 text-xs']) ?>

        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="block font-bold text-navy-900 mb-1">NIK (Nomor Induk)</label>
                <input type="text" name="nik" placeholder="EMP-..." required class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:outline-none focus:border-brand-500 font-medium">
            </div>
            <div>
                <label class="block font-bold text-navy-900 mb-1">Nama Lengkap</label>
                <input type="text" name="name" placeholder="John Doe" required class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:outline-none focus:border-brand-500 font-medium">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="block font-bold text-navy-900 mb-1">Email Perusahaan</label>
                <input type="email" name="email" placeholder="nama@perusahaan.com" required class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:outline-none focus:border-brand-500 font-medium">
            </div>
            <div>
                <label class="block font-bold text-navy-900 mb-1">Kata Sandi Awal</label>
                <input type="password" name="password" placeholder="Min. 8 Karakter" required class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:outline-none focus:border-brand-500 font-medium">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="block font-bold text-navy-900 mb-1">Divisi / Departemen</label>
                <select name="department_id" class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:outline-none focus:border-brand-500 font-medium bg-white">
                    <option value="">Pilih Divisi...</option>
                    <?php foreach ($departments as $d) : ?>
                        <option value="<?= $d['id'] ?>"><?= esc($d['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label class="block font-bold text-navy-900 mb-1">Jadwal Shift</label>
                <select name="shift_id" class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:outline-none focus:border-brand-500 font-medium bg-white">
                    <option value="">Pilih Shift...</option>
                    <?php foreach ($shifts as $s) : ?>
                        <option value="<?= $s['id'] ?>"><?= esc($s['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="block font-bold text-navy-900 mb-1">Hak Akses Role</label>
                <select name="role" required class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:outline-none focus:border-brand-500 font-medium bg-white">
                    <option value="employee">Karyawan (Staff)</option>
                    <option value="admin">Administrator / HR</option>
                </select>
            </div>
            <div>
                <label class="block font-bold text-navy-900 mb-1">Nomor WhatsApp</label>
                <input type="text" name="phone" placeholder="08xxxxxxxxxx" class="w-full px-3 py-2 rounded-xl border border-slate-200 focus:outline-none focus:border-brand-500 font-medium">
            </div>
        </div>

        <div class="pt-3 flex gap-3 justify-end">
            <button type="button" onclick="document.getElementById('modal-add-employee').classList.add('hidden')" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl font-bold transition">
                Batal
            </button>
            <button type="submit" class="px-5 py-2 bg-brand-600 hover:bg-navy-900 text-white rounded-xl font-bold transition shadow-xs">
                Simpan Karyawan
            </button>
        </div>

        <?= form_close() ?>
    </div>
</div>

<?= $this->endSection() ?>
