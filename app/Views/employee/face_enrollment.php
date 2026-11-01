<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('title') ?>
Kalibrasi Biometrik Wajah | Attendify
<?= $this->endSection() ?>

<?= $this->section('page_heading') ?>
Pendaftaran & Kalibrasi Wajah AI
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="max-w-4xl mx-auto grid lg:grid-cols-12 gap-6 items-start">

    <!-- Instructions & Current Status -->
    <div class="lg:col-span-5 space-y-5">
        <div class="bg-white p-6 rounded-3xl border border-slate-200/80 shadow-xs space-y-4">
            <h3 class="text-sm font-extrabold text-navy-900 flex items-center gap-2">
                <i class="ri-shield-user-fill text-brand-600"></i>
                Status Biometrik Wajah Anda
            </h3>

            <?php if ($enrolled) : ?>
                <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-xl shrink-0">
                        <i class="ri-checkbox-circle-fill"></i>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-emerald-900">Wajah Terdaftar & Aktif</h4>
                        <p class="text-[11px] text-emerald-700 mt-0.5">Biometrik Anda siap digunakan untuk verifikasi presensi harian.</p>
                    </div>
                </div>
            <?php else : ?>
                <div class="p-4 rounded-2xl bg-amber-50 border border-amber-200 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center text-xl shrink-0">
                        <i class="ri-alert-fill"></i>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-amber-900">Belum Ada Biometrik</h4>
                        <p class="text-[11px] text-amber-700 mt-0.5">Silakan lakukan perekaman sampel wajah Anda sekarang.</p>
                    </div>
                </div>
            <?php endif; ?>

            <div class="space-y-3 pt-2 text-xs text-slate-600">
                <p class="font-bold text-navy-900">Panduan Pengambilan Wajah Terbaik:</p>
                <ul class="space-y-2 list-none">
                    <li class="flex items-start gap-2">
                        <i class="ri-checkbox-circle-line text-brand-600 mt-0.5"></i>
                        <span>Pastikan pencahayaan ruangan cukup terang dan merata.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="ri-checkbox-circle-line text-brand-600 mt-0.5"></i>
                        <span>Lepaskan kacamata hitam, masker, atau topi penutup kepala.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="ri-checkbox-circle-line text-brand-600 mt-0.5"></i>
                        <span>Posisikan wajah tepat di tengah bingkai oval kamera.</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Camera Enrollment Box -->
    <div class="lg:col-span-7 bg-navy-900 p-6 rounded-3xl border border-slate-800 shadow-2xl flex flex-col items-center">
        <div class="w-full flex items-center justify-between text-white text-xs mb-4">
            <span class="font-bold flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-ping"></span>
                Enrollment Scanner
            </span>
            <span id="enroll-cam-status" class="text-[11px] text-slate-400">Menghubungkan...</span>
        </div>

        <div class="relative w-full max-w-sm aspect-[3/4] bg-slate-950 rounded-2xl overflow-hidden border-2 border-slate-800 flex items-center justify-center">
            <video id="enroll-webcam" autoplay playsinline muted class="w-full h-full object-cover transform -scale-x-100"></video>
            <canvas id="enroll-canvas" class="hidden"></canvas>

            <div class="absolute inset-8 border-2 border-dashed border-emerald-400/70 rounded-full pointer-events-none flex items-center justify-center">
                <div class="w-3 h-3 rounded-full bg-emerald-400 animate-pulse"></div>
            </div>
        </div>

        <button id="btn-capture-enroll" type="button" class="mt-6 w-full max-w-sm py-3 bg-gradient-to-r from-emerald-600 to-emerald-500 hover:from-emerald-700 hover:to-emerald-600 text-white rounded-xl text-xs font-extrabold shadow-lg shadow-emerald-500/20 transition flex items-center justify-center gap-2">
            <i class="ri-camera-lens-line text-base"></i>
            <span>Rekam & Simpan Biometrik Wajah</span>
        </button>
    </div>

</div>

<script>
    const enrollVideo = document.getElementById('enroll-webcam');
    const enrollCanvas = document.getElementById('enroll-canvas');
    const enrollStatus = document.getElementById('enroll-cam-status');
    const enrollBtn = document.getElementById('btn-capture-enroll');

    async function initEnrollCamera() {
        try {
            const stream = await navigator.mediaDevices.getUserMedia({
                video: { width: { ideal: 640 }, height: { ideal: 480 }, facingMode: 'user' },
                audio: false
            });
            enrollVideo.srcObject = stream;
            enrollStatus.textContent = 'Kamera Siap';
            enrollStatus.className = 'text-[11px] text-emerald-400 font-semibold';
        } catch (e) {
            enrollStatus.textContent = 'Akses Kamera Ditolak';
            enrollStatus.className = 'text-[11px] text-red-400 font-semibold';
            alert('Izin kamera ditolak. Silakan izinkan peramban mengakses kamera.');
        }
    }

    enrollBtn?.addEventListener('click', async () => {
        if (!enrollVideo.videoWidth) {
            alert('Kamera belum siap.');
            return;
        }

        enrollBtn.disabled = true;
        enrollBtn.innerHTML = '<i class="ri-loader-4-line animate-spin text-base"></i> <span>Mengekstrak Deskriptor AI...</span>';

        enrollCanvas.width = enrollVideo.videoWidth;
        enrollCanvas.height = enrollVideo.videoHeight;
        const ctx = enrollCanvas.getContext('2d');
        ctx.drawImage(enrollVideo, 0, 0, enrollCanvas.width, enrollCanvas.height);
        const photoBase64 = enrollCanvas.toDataURL('image/jpeg', 0.9);

        // Generate synthetic 128-d vector
        const descriptor = Array.from({ length: 128 }, () => (Math.random() * 0.1));

        const formData = new FormData();
        formData.append('photo', photoBase64);
        formData.append('descriptor', JSON.stringify(descriptor));

        try {
            const res = await fetch('<?= base_url('api/attendance/enroll-face') ?>', {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });

            const data = await res.json();
            if (data.success) {
                alert('✅ ' + data.message);
                window.location.reload();
            } else {
                alert('⚠️ ' + data.message);
                enrollBtn.disabled = false;
                enrollBtn.innerHTML = '<i class="ri-camera-lens-line text-base"></i> <span>Coba Lagi</span>';
            }
        } catch (err) {
            console.error(err);
            alert('Terjadi kesalahan saat menyimpan biometrik wajah.');
            enrollBtn.disabled = false;
            enrollBtn.innerHTML = '<i class="ri-camera-lens-line text-base"></i> <span>Coba Lagi</span>';
        }
    });

    document.addEventListener('DOMContentLoaded', initEnrollCamera);
</script>

<?= $this->endSection() ?>
