# Project Capstone 2 — Aplikasi Event, Presensi, dan Sertifikat

Aplikasi ini digunakan untuk registrasi event, pencatatan kehadiran berbasis QR Code, dan manajemen sertifikat di lingkungan universitas. Dikembangkan menggunakan **Laravel + MySQL**.

---

## 🔑 Role & Fitur

### Guest
- Melihat daftar event
- Registrasi sebagai member

### Member
- Melihat & daftar event
- Upload bukti pembayaran
- Menampilkan QR Code kehadiran
- Download sertifikat jika tersedia

### Panitia
- Membuka event baru
- Scan QR Code peserta untuk presensi
- Upload sertifikat peserta

### Keuangan
- Verifikasi bukti pembayaran peserta

### Admin
- Kelola user panitia & keuangan (ubah role)

---

## ⚙️ Fitur Utama

| Fitur | Penjelasan |
|-------|------------|
| Auth & Multi-role | Menggunakan middleware role (`guest`, `member`, `admin`, `panitia`, `keuangan`) |
| Manajemen Event | CRUD event oleh panitia, registrasi oleh member |
| Pembayaran | Upload bukti pembayaran dan verifikasi oleh tim keuangan |
| QR Code Presensi | QR dibuat otomatis dan dipindai oleh panitia |
| Sertifikat | Upload oleh panitia, download oleh peserta |
| Role Management | Admin dapat menetapkan/ubah role user ke panitia atau keuangan |

---

## 🛠 Instalasi & Setup

1. Clone repo ini dan masuk ke direktori proyek
2. Jalankan:
```bash
composer install
npm install && npm run dev
cp .env.example .env
php artisan key:generate
```

3. Konfigurasi database di `.env`
4. Jalankan migrasi dan seeder:
```bash
php artisan migrate
php artisan db:seed --class=RoleSeeder
```

5. Jalankan server:
```bash
php artisan serve
```

---

## 🔐 Testing Validasi & Role Akses

| Role     | URL yang dapat diakses                      | Validasi                                         |
|----------|---------------------------------------------|--------------------------------------------------|
| Guest    | `/events` dan `/register`                   | Tidak bisa akses dashboard atau upload           |
| Member   | `/member/events`, `/member/payments/...`    | Hanya bisa lihat event, bayar, dan QR/sertifikat |
| Panitia  | `/panitia/scan/...`, `/panitia/certificate/...` | Tidak bisa akses halaman admin                  |
| Keuangan | `/keuangan/dashboard` *(to be added)*       | Khusus verifikasi pembayaran                     |
| Admin    | `/admin/users`                              | Bisa ubah role user                              |

---

## 📦 Dependencies

- Laravel 10+
- Laravel Breeze
- simple-qrcode
- Tailwind CSS (via Breeze)
