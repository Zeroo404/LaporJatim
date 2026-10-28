# LaporJatim

**Platform pelaporan masalah lingkungan dan fasilitas umum di Provinsi
Jawa Timur**

## 1. Judul & Deskripsi

LaporJatim adalah website yang dirancang untuk membantu masyarakat
melaporkan masalah di lingkungan sekitar, seperti jalan rusak, sampah
menumpuk, dan fasilitas umum yang rusak. Laporan dapat dilengkapi judul,
deskripsi, kategori, alamat, titik lokasi pada peta, dan foto bukti.
Admin dapat memeriksa laporan serta memperbarui status penanganannya.

**Latar belakang:** Keluhan masyarakat dapat tersebar di berbagai
saluran sehingga sulit dicari dan dipantau. LaporJatim berupaya
mengumpulkan laporan dalam satu platform yang terstruktur dan berbasis
lokasi.

**Target pengguna:** - Masyarakat yang ingin menyampaikan atau melihat
laporan. - Admin/pengelola yang memeriksa dan memperbarui status
laporan.

**Tujuan:** 1. Memudahkan masyarakat menyampaikan laporan. 2.
Menampilkan lokasi laporan melalui peta interaktif. 3. Membantu admin
mengelola laporan berdasarkan kategori, wilayah, dan status. 4.
Meningkatkan transparansi perkembangan penanganan laporan.

## 2. Teknologi yang Digunakan

-   **HTML:** struktur halaman.
-   **CSS:** tampilan dan responsivitas.
-   **JavaScript:** interaksi antarmuka.
-   **PHP:** proses sisi server.
-   **MySQL:** penyimpanan data.
-   **Leaflet:** peta interaktif.
-   **OpenStreetMap:** sumber data peta.
-   **GitHub:** penyimpanan kode sumber dan dokumentasi.

Catatan: versi PHP-MySQL memerlukan hosting yang mendukung PHP dan
MySQL. GitHub Pages tidak menjalankan PHP atau database MySQL secara
langsung.

## 3. Fitur Utama

-   Formulir laporan berisi judul, deskripsi, kategori, alamat, lokasi,
    dan foto bukti.
-   Pemilihan titik lokasi melalui peta.
-   Penanda laporan berdasarkan status.
-   Daftar laporan dengan pencarian dan filter.
-   Ringkasan jumlah laporan menurut status.
-   Login khusus admin.
-   Dashboard untuk memeriksa laporan dan memperbarui status, misalnya
    **Belum Ditangani**, **Proses**, dan **Selesai**.
-   Riwayat perubahan status dan ekspor CSV jika tersedia pada versi
    proyek yang dipasang.

**Catatan:** Pastikan setiap fitur di atas benar-benar tersedia dan
telah diuji pada kode yang dikumpulkan. Batas wilayah Jawa Timur pada
peta juga perlu diverifikasi dengan data geografis tepercaya.

## 4. Pemanfaatan AI (*AI Usage Disclosure*)

### Alat AI

ChatGPT (OpenAI) digunakan sebagai asisten untuk membantu eksplorasi
ide, penyusunan kerangka kode, penjelasan kode, dan pemecahan masalah
selama pengembangan.

### Contoh prompt utama

> Buatkan website LaporJatim untuk pelaporan masalah di Provinsi Jawa
> Timur. Gunakan peta interaktif Leaflet dan OpenStreetMap, formulir
> laporan dengan foto dan titik lokasi, daftar laporan dengan pencarian
> serta filter, dan login admin untuk memperbarui status. Susun kode
> secara terstruktur dan perhatikan keamanan dasar.

Contoh prompt debugging: \> Periksa kode yang bermasalah, jelaskan
penyebabnya, lalu berikan perbaikan tanpa menghilangkan fitur lain.
Jelaskan cara menguji hasil perbaikannya.

### Validasi & Modifikasi Mandiri

Isi bagian ini sesuai pekerjaan yang benar-benar dilakukan: - \[ \]
Memeriksa struktur folder dan memahami fungsi file utama. - \[ \]
Menjalankan website di lokal atau hosting. - \[ \] Menguji formulir,
peta, login admin, dan perubahan status. - \[ \] Menyesuaikan tampilan
serta alur penggunaan. - \[ \] Memeriksa dan memperbaiki saran AI yang
belum sesuai. - \[ \] Menguji validasi input, unggahan foto, dan akses
admin.

Contoh pernyataan yang dapat disesuaikan: \> Saya meninjau saran kode
dari AI, menyesuaikannya dengan kebutuhan proyek, dan menguji fitur
secara bertahap. Saya tidak menganggap saran AI selalu benar, sehingga
kode tetap diperiksa dan diuji sebelum digunakan.

AI digunakan sebagai alat bantu pengembangan. Fitur AI di dalam
website---misalnya klasifikasi otomatis kategori atau prioritas
laporan---jangan dinyatakan aktif jika belum benar-benar dibuat dan
diuji.

## 5. Panduan Penggunaan

### Untuk masyarakat

1.  Buka website LaporJatim.
2.  Buka formulir pelaporan.
3.  Isi judul, deskripsi, kategori, dan alamat masalah.
4.  Pilih titik lokasi yang sesuai pada peta.
5.  Tambahkan foto bukti jika diminta.
6.  Periksa informasi, lalu kirim laporan.
7.  Gunakan pencarian dan filter pada daftar laporan untuk menemukan
    laporan yang diinginkan.

### Untuk admin

1.  Buka halaman login admin.
2.  Masuk menggunakan akun admin yang telah dikonfigurasi.
3.  Periksa laporan dan bukti yang dikirim.
4.  Perbarui status sesuai hasil pemeriksaan.
5.  Simpan perubahan dan pastikan status terbaru tampil dengan benar.

Jangan menuliskan kata sandi atau kredensial admin di README atau
repositori publik.

### Menjalankan secara lokal

1.  Pasang lingkungan server lokal yang mendukung PHP dan MySQL,
    misalnya XAMPP.
2.  Salin folder proyek ke direktori web server.
3.  Jalankan web server dan MySQL.
4.  Buat database sesuai konfigurasi proyek.
5.  Impor berkas SQL jika disertakan.
6.  Sesuaikan konfigurasi koneksi database.
7.  Pastikan direktori unggahan foto tersedia dan dapat ditulis.
8.  Buka proyek melalui `http://localhost/nama-folder-proyek/`.
9.  Uji seluruh fitur publik dan admin.

Nama database, berkas konfigurasi, tabel, dan alamat login dapat berbeda
antarversi. Periksa kode proyek sebelum konfigurasi. Jangan mengunggah
kredensial database ke repositori publik.

### Publikasi online

Gunakan hosting yang mendukung PHP dan MySQL. Unggah kode, siapkan
database online, impor struktur database, sesuaikan konfigurasi, atur
direktori unggahan, lalu uji kembali website.

## 6. Keamanan & Keterbatasan

-   Validasi input dan file foto sebelum disimpan.
-   Gunakan prepared statements untuk query database.
-   Lindungi halaman admin dengan autentikasi dan pemeriksaan hak akses.
-   Terapkan perlindungan CSRF dan pencegahan spam jika belum tersedia.
-   Kelola foto dan informasi pribadi dengan hati-hati.
-   Status laporan berasal dari pengelola dan perlu diverifikasi di
    lapangan.
-   Integrasi BMKG atau fitur AI hanya boleh disebut aktif jika
    integrasi dan pengujiannya sudah diterapkan.

## 7. Identitas Pengembang

-   **Nama:** Muhammad Ricky Fajar Adiputra
-   **Nama:** Rafa Baiata Alfaridzi
-   **Kelas:** XI SIJA
-   **Jurusan:** Sistem Informasi, Jaringan, dan Aplikasi (SIJA)
-   **Sekolah:** SMKN Kabuh

## 8. Sumber & Referensi

-   Leaflet: https://leafletjs.com/
-   OpenStreetMap: https://www.openstreetmap.org/
-   GitHub: https://github.com/

------------------------------------------------------------------------# LaporJatim
Platform pelaporan masalah lingkungan dan fasilitas umum di Provinsi Jawa Timur
