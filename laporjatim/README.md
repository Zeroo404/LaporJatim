# LaporJatim

Platform pelaporan masalah masyarakat se-Provinsi Jawa Timur (PHP + MySQL + Leaflet/OpenStreetMap + Bootstrap 5).

## Cara menjalankan di XAMPP (Windows/macOS/Linux)

1. Salin folder `laporjatim` ke `C:\xampp\htdocs\` (hasilnya: `C:\xampp\htdocs\laporjatim\index.php`).
2. Buka XAMPP Control Panel, lalu **Start** untuk **Apache** dan **MySQL**.
3. Buka `http://localhost/phpmyadmin`, pilih tab **Import**, pilih file `database/laporjatim.sql`, lalu klik **Import**. Database `laporjatim`, semua tabel, kategori, dan 1 akun superadmin akan dibuat.
4. Cek `config/database.php` (default XAMPP: user `root`, password kosong) dan `config/config.php` (`BASE_URL` = `/laporjatim`; ubah jika nama folder Anda berbeda).
5. Pastikan ekstensi PHP `pdo_mysql`, `fileinfo`, dan `mbstring` aktif (default XAMPP sudah aktif).
6. Buka situs publik: `http://localhost/laporjatim/`
7. Buka login admin: `http://localhost/laporjatim/admin/login.php`
   - Email: `admin@laporjatim.local`
   - Password sementara: `LaporJatim#2026`
   - **Segera ganti** lewat menu *Akun saya*, lalu buat akun admin lain lewat menu *Akun admin*.

Catatan: peta, Bootstrap, dan ikon dimuat dari CDN, jadi komputer perlu terhubung internet.

## Skenario uji end-to-end

1. Di halaman publik, isi formulir (klik peta untuk menandai lokasi, unggah foto JPG/PNG/WebP maks. 3 MB), lalu kirim. Titik kuning muncul di peta, daftar, dan statistik.
2. Login admin, buka *Semua laporan*, lalu *Detail*.
3. Isi catatan, klik **Ubah status ke Proses**. Titik di halaman publik berubah biru (otomatis dalam maks. 30 detik, atau muat ulang).
4. Isi catatan wajib, klik **Ubah status ke Selesai**. Titik berubah hijau. Riwayat mencatat waktu, admin, dan catatan.
5. Coba filter (status, kategori, kabupaten/kota, tanggal), **Arsipkan** (laporan hilang dari publik), dan **Ekspor CSV** (pemisah titik koma, cocok untuk Excel Indonesia).
6. Login sebagai admin biasa: menu *Akun admin* tidak muncul dan URL `admin/admins.php` ditolak (403).

## Struktur folder

```
laporjatim/
  index.php            halaman publik (peta, daftar, formulir)
  api/                 reports.php (baca publik), submit.php (kirim laporan)
  admin/               login, ringkasan, laporan, detail, peta, ekspor, akun admin
  includes/            auth.php (sesi, CSRF, login), helpers.php, regions.php (38 kab/kota)
  config/              config.php, database.php (koneksi PDO)
  database/            laporjatim.sql
  assets/              css/style.css, js/public.js, js/admin.js
  uploads/             foto bukti (skrip PHP diblokir via .htaccess)
```

## Keamanan yang diterapkan

- Query memakai prepared statements (PDO, emulasi dimatikan); output di-escape.
- Password di-hash (bcrypt via `password_hash`); kebijakan min. 10 karakter + huruf + angka; kunci akun 15 menit setelah 5 kali gagal.
- Tidak ada registrasi publik; akun hanya dibuat superadmin. Status akun dicek ulang ke database di setiap request.
- CSRF token pada semua formulir yang mengubah data (termasuk login, logout, dan kirim laporan).
- Validasi foto: ukuran, MIME asli (finfo), `getimagesize`, nama acak; folder `uploads` tidak boleh mengeksekusi skrip.
- Pengiriman laporan: honeypot dan batas 5 laporan per 10 menit per sesi.
- Status hanya bisa maju Belum Ditangani, Proses, lalu Selesai, dengan catatan wajib saat Selesai. Laporan tidak pernah tampil "selesai" tanpa tindakan admin.

Sebelum dipakai publik: gunakan HTTPS, ganti password awal, tambahkan pembatasan per IP/CAPTCHA, dan matikan `APP_DEBUG`.

## Tahap 2 (belum dikerjakan): fitur tambahan

Deteksi laporan duplikat (jarak koordinat + kemiripan teks), analisis kepadatan/heatmap, saran kategori dan urgensi berbasis AI, serta prioritas penanganan. Struktur saat ini sudah siap (tinggal tambah kolom `urgency` di `reports`).
