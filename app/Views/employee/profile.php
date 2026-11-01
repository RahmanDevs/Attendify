<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('title') ?>
Profil & Keamanan Akun | Attendify
<?= $this->endSection() ?>

<?= $this->section('page_heading') ?>
Profil & Pengaturan Akun
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="max-w-3xl mx-auto space-y-6">

    <!-- Profile Header Card -->
    <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-xs flex flex-col sm:flex-row items-center gap-6">
        <div class="w-20 h-20 rounded-2xl bg-gradient-to-tr from-brand-600 to-brand-400 p-0.5 overflow-hidden flex items-center justify-center shrink-0 shadow-lg shadow-brand-500/20">
            <?php if (!empty($user['avatar'])) : ?>
                <img src="<?= base_url($user['avatar']) ?>" alt="Foto Profil" class="w-full h-full object-cover rounded-2xl">
            <?php else : ?>
                <span class="text-2xl font-black text-white">
                    <?= strtoupper(substr($user['name'], 0, 2)) ?>
                </span>
            <?php endif; ?>
        </div>

        <div class="text-center sm:text-left space-y-1">
            <div class="inline-flex items-center gap-2 px-2.5 py-0.5 rounded-full bg-brand-50 text-[10px] font-bold text-brand-700">
                NIK: <?= esc($user['nik'] ?? 'EMP-NEW') ?>
            </div>
            <h2 class="text-xl font-extrabold text-navy-900"><?= esc($user['name']) ?></h2>
            <p class="text-xs text-slate-500"><?= esc($user['email']) ?> • <span class="capitalize"><?= esc($user['department_name'] ?? 'Karyawan') ?></span></p>
        </div>
    </div>

    <!-- Edit Profile & Password Form -->
    <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-200/80 shadow-xs space-y-6">
        <div>
            <h3 class="text-sm font-extrabold text-navy-900">Perbarui Informasi Pribadi</h3>
            <p class="text-xs text-slate-500 mt-0.5">Kelola identitas dan kata sandi masuk Anda secara mandiri.</p>
        </div>

        <?= form_open('employee/profile/update', ['class' => 'space-y-4 text-xs']) ?>

        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block font-bold text-navy-900 mb-1">Nama Lengkap</label>
                <input type="text" name="name" value="<?= esc(old('name', $user['name'])) ?>" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-brand-500 font-medium">
            </div>
            <div>
                <label class="block font-bold text-navy-900 mb-1">Nomor Telepon / WhatsApp</label>
                <input type="text" name="phone" value="<?= esc(old('phone', $user['phone'] ?? '')) ?>" placeholder="08xxxxxxxxxx" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-brand-500 font-medium">
            </div>
        </div>

        <div class="border-t border-slate-100 pt-4 space-y-4">
            <h4 class="text-xs font-bold text-navy-900">Ubah Kata Sandi (Opsional)</h4>

            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-navy-900 mb-1">Kata Sandi Saat Ini</label>
                    <input type="password" name="old_password" placeholder="••••••••" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-brand-500">
                </div>
                <div>
                    <label class="block font-bold text-navy-900 mb-1">Kata Sandi Baru (Min. 8 Karakter)</label>
                    <input type="password" name="new_password" placeholder="••••••••" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-brand-500">
                </div>
            </div>
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full sm:w-auto px-6 py-2.5 bg-brand-600 hover:bg-navy-900 text-white rounded-xl text-xs font-bold transition shadow-md shadow-brand-600/20">
                Simpan Perubahan
            </button>
        </div>

        <?= form_close() ?>
    </div>

</div>

<?= $this->endSection() ?>
