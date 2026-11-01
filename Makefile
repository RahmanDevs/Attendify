# ==============================================================================
# Makefile - Attendify (Sistem Presensi AI Face Recognition)
# ==============================================================================

.PHONY: help serve start stop setup migrate seed test routes docker-up docker-down clean

# Default Target: Menampilkan panduan bantuan perintah
help:
	@echo ""
	@echo "======================================================================"
	@echo "                    ATTENDIFY - DEV TOOLKIT                           "
	@echo "======================================================================"
	@echo "  Perintah yang tersedia:"
	@echo ""
	@echo "  make serve       - Jalankan server lokal (http://localhost:8080)"
	@echo "  make stop        - Matikan server yang berjalan pada port 8080"
	@echo "  make setup       - Inisialisasi basis data (Migrate + Seed Data Awal)"
	@echo "  make migrate     - Jalankan seluruh migrasi database"
	@echo "  make seed        - Isi database dengan data akun awal (Admin & Karyawan)"
	@echo "  make routes      - Tampilkan daftar seluruh endpoint rute HTTP"
	@echo "  make test        - Jalankan automated unit tests (PHPUnit)"
	@echo "  make docker-up   - Jalankan container database MySQL & phpMyAdmin"
	@echo "  make docker-down - Matikan container Docker"
	@echo "  make clean       - Bersihkan cache dan session pada folder writable/"
	@echo "======================================================================"
	@echo ""

# Menjalankan server lokal pengembangan CodeIgniter 4
serve:
	@echo "🚀 Menjalankan Attendify pada http://localhost:8080 ..."
	@php spark serve --host 0.0.0.0 --port 8080

start: serve

# Mematikan server yang sedang berjalan pada port 8080
stop:
	@echo "🛑 Mematikan server pada port 8080..."
	@fuser -k 8080/tcp 2>/dev/null || pkill -f "spark serve" 2>/dev/null || true
	@echo "✅ Server berhasil dimatikan."

# Setup lengkap: Menjalankan migrasi dan seeding data awal
setup: migrate seed
	@echo "🎉 Setup database selesai! Anda siap menjalankan 'make serve'."

# Menjalankan migrasi database
migrate:
	@echo "📦 Menjalankan migrasi tabel database..."
	@php spark migrate

# Menjalankan seeding data akun awal
seed:
	@echo "🌱 Mengisi data awal (Admin, Karyawan, Shift, Geofence)..."
	@php spark db:seed AttendifySeeder

# Menampilkan seluruh daftar rute HTTP yang terdaftar
routes:
	@php spark routes

# Menjalankan unit testing
test:
	@echo "🧪 Menjalankan pengujian otomatis (PHPUnit)..."
	@./vendor/bin/phpunit -c phpunit.dist.xml --no-coverage tests/unit/

# Mengelola container Docker MySQL (port 3307)
docker-up:
	@echo "🐳 Menjalankan container Docker MySQL..."
	@docker compose up -d

docker-down:
	@echo "🛑 Menghentikan container Docker..."
	@docker compose down

# Membersihkan file cache dan debugbar pada writable/
clean:
	@echo "🧹 Membersihkan cache sistem..."
	@rm -rf writable/cache/* writable/debugbar/*
	@echo "✅ Cache berhasil dibersihkan."
