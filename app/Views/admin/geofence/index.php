<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('title') ?>
Pengaturan Geofencing GPS | Attendify
<?= $this->endSection() ?>

<?= $this->section('page_heading') ?>
Lokasi Kantor & Radius Geofencing
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="max-w-3xl mx-auto space-y-6">

    <div class="bg-white p-6 sm:p-8 rounded-3xl border border-slate-200/80 shadow-xs space-y-6">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 text-brand-700 text-xs font-bold mb-2">
                <i class="ri-map-pin-range-line"></i>
                Validasi Haversine Radius Aktif
            </div>
            <h2 class="text-base font-extrabold text-navy-900">Konfigurasi Titik Presensi Kantor</h2>
            <p class="text-xs text-slate-500 mt-0.5">Karyawan hanya dapat melakukan clock-in jika koordinat GPS perangkat mereka berada dalam radius yang ditentukan.</p>
        </div>

        <?= form_open('admin/settings/geofence/update', ['class' => 'space-y-4 text-xs']) ?>
        <input type="hidden" name="id" value="<?= esc($office['id'] ?? '') ?>">

        <div>
            <label class="block font-bold text-navy-900 mb-1">Nama Kantor / Cabang</label>
            <input type="text" name="name" value="<?= esc($office['name'] ?? '') ?>" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-brand-500 font-medium">
        </div>

        <div>
            <label class="block font-bold text-navy-900 mb-1">Alamat Lengkap Kantor</label>
            <textarea name="address" rows="2" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-brand-500 resize-none font-medium"><?= esc($office['address'] ?? '') ?></textarea>
        </div>

        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label class="block font-bold text-navy-900 mb-1">Latitude (Garis Lintang)</label>
                <input type="text" id="input-lat" name="latitude" value="<?= esc($office['latitude'] ?? '') ?>" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-brand-500 font-mono font-medium">
            </div>
            <div>
                <label class="block font-bold text-navy-900 mb-1">Longitude (Garis Bujur)</label>
                <input type="text" id="input-lon" name="longitude" value="<?= esc($office['longitude'] ?? '') ?>" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-brand-500 font-mono font-medium">
            </div>
        </div>

        <div>
            <label class="block font-bold text-navy-900 mb-1">Batas Radius Izin Presensi (Meter)</label>
            <div class="flex items-center gap-3">
                <input type="number" name="radius_meters" value="<?= esc($office['radius_meters'] ?? '100') ?>" min="10" max="5000" required class="w-36 px-3.5 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:border-brand-500 font-bold text-navy-900">
                <span class="text-xs text-slate-500">Meter dari titik koordinat pusat</span>
            </div>
        </div>

        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3">
            <span class="text-xs text-slate-600">Ambil titik koordinat otomatis berdasarkan lokasi perangkat Anda saat ini:</span>
            <button type="button" onclick="detectCurrentLocation()" class="px-4 py-2 bg-white border border-slate-200 hover:bg-slate-100 text-navy-900 rounded-xl text-xs font-bold transition shadow-xs flex items-center gap-1.5 shrink-0">
                <i class="ri-crosshair-line text-brand-600"></i>
                Deteksi Lokasi Saya
            </button>
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full sm:w-auto px-6 py-2.5 bg-brand-600 hover:bg-navy-900 text-white rounded-xl text-xs font-bold transition shadow-md shadow-brand-600/20">
                Simpan Konfigurasi Geofencing
            </button>
        </div>

        <?= form_close() ?>
    </div>

</div>

<script>
    function detectCurrentLocation() {
        if (!navigator.geolocation) {
            alert('Peramban Anda tidak mendukung Geolocation.');
            return;
        }

        navigator.geolocation.getCurrentPosition(
            (pos) => {
                document.getElementById('input-lat').value = pos.coords.latitude.toFixed(8);
                document.getElementById('input-lon').value = pos.coords.longitude.toFixed(8);
                alert('Titik koordinat berhasil dideteksi: ' + pos.coords.latitude + ', ' + pos.coords.longitude);
            },
            (err) => {
                alert('Gagal mendeteksi lokasi: ' + err.message);
            },
            { enableHighAccuracy: true }
        );
    }
</script>

<?= $this->endSection() ?>
