# AI_LOGBOOK.md

# Logbook Pemanfaatan Kecerdasan Artifisial --- LaporJatim

**Nama produk:** LaporJatim\
**Nama peserta:** Muhammad Ricky Fajar Adiputra\
**Nama peserta:** Rafa Baiata Alfaridzi\
**Kelas:** XI SIJA\
**Sekolah:** SMKN Kabuh

> Dokumen ini mencatat penggunaan AI selama pengembangan LaporJatim.
> Sesuaikan kolom "Validasi & Modifikasi Mandiri" dengan tindakan yang
> benar-benar dilakukan. Jangan mencantumkan pengujian atau perubahan
> kode yang belum dilakukan.

------------------------------------------------------------------------

## Tahap 1: Eksplorasi Ide & Perancangan Solusi

**Tujuan:** Menentukan masalah, target pengguna, dan konsep solusi
digital.

### Interaksi dengan AI

**Alat AI:** ChatGPT (OpenAI)

**Contoh prompt utama:**

> Saya ingin membuat proyek website bertema solusi digital untuk
> kehidupan sehari-hari. Bantu rancang platform bernama LaporJatim untuk
> melaporkan masalah lingkungan dan fasilitas umum di Provinsi Jawa
> Timur. Jelaskan masalah yang diselesaikan, target pengguna, fitur
> utama, keunikan, teknologi, dan kemungkinan pengembangan berbantuan
> AI.

**Ringkasan saran AI:** - Membuat platform pelaporan masalah berbasis
lokasi. - Menyediakan peta interaktif dan formulir laporan. -
Menampilkan daftar laporan yang bisa dicari dan difilter. - Menyediakan
login admin untuk memeriksa laporan dan mengubah status. -
Mempertimbangkan fitur lanjutan seperti klasifikasi kategori dan
prioritas laporan berbantuan AI.

**Keputusan peserta:** Konsep LaporJatim difokuskan pada pelaporan
masalah masyarakat di Jawa Timur dengan peta dan pengelolaan status
laporan.

**Validasi & Modifikasi Mandiri:** Saya meninjau saran AI dan memilih
fitur yang sesuai dengan ruang lingkup proyek. Fitur lanjutan yang belum
dibuat tidak dianggap sebagai fitur aktif. Saya juga menyesuaikan
rancangan agar proyek berfokus pada kebutuhan masyarakat dan pengelolaan
laporan.

------------------------------------------------------------------------

## Tahap 2: Penyusunan Kerangka Kode (*Scaffolding*)

**Tujuan:** Menentukan struktur dasar website dan peran setiap
teknologi.

### Interaksi dengan AI

**Contoh prompt utama:**

> Bantu susun kerangka proyek website LaporJatim menggunakan HTML, CSS,
> JavaScript, PHP, MySQL, Leaflet, dan OpenStreetMap. Pisahkan bagian
> halaman publik dan admin, jelaskan fungsi file utama, serta jelaskan
> alur pengiriman laporan dan perubahan status.

**Ringkasan saran AI:** - Memisahkan aset tampilan, JavaScript, dan file
PHP. - Menggunakan PHP untuk memproses permintaan dari website. -
Menggunakan MySQL untuk menyimpan data laporan. - Menggunakan Leaflet
untuk peta interaktif dan OpenStreetMap sebagai sumber peta. - Membatasi
pengelolaan status laporan pada admin yang telah login.

**Keputusan peserta:** Menggunakan struktur proyek web dengan halaman
publik dan area admin. Detail nama file, konfigurasi, dan tabel
mengikuti berkas proyek yang digunakan.

**Validasi & Modifikasi Mandiri:** Saya meninjau struktur folder dan
mencocokkan fungsi file dengan kebutuhan LaporJatim. Sebelum digunakan,
koneksi database, nama tabel, pengaturan unggahan foto, dan jalur
halaman perlu diperiksa berdasarkan kode sebenarnya. Saya tidak menyalin
konfigurasi atau kredensial rahasia ke repositori publik.

------------------------------------------------------------------------

## Tahap 3: Pemecahan Masalah & Penanganan Galat (*Debugging*)

**Tujuan:** Memanfaatkan AI untuk membantu menelusuri dan memperbaiki
masalah kode.

### Interaksi dengan AI

**Contoh prompt utama:**

> Periksa bagian JavaScript atau PHP yang bermasalah pada proyek
> LaporJatim. Jelaskan penyebabnya, berikan perubahan yang diperlukan
> tanpa menghilangkan fitur lain, dan sebutkan langkah pengujian untuk
> memastikan perbaikan bekerja.

**Catatan pekerjaan yang relevan:** - Pengembangan melibatkan
pemeriksaan perilaku fitur admin dan status laporan. - Saran AI dapat
digunakan untuk membantu memahami kode dan mencari penyebab galat. -
Setiap perbaikan perlu diuji kembali di lingkungan yang sesuai, termasuk
ketika terhubung ke database.

**Validasi & Modifikasi Mandiri:** Saya perlu membandingkan saran AI
dengan kode proyek, memeriksa perubahan sebelum menyimpan, lalu menguji
fitur yang terdampak. Jika pengujian belum dilakukan atau hasilnya belum
berhasil, hal tersebut harus dicatat sebagai pekerjaan yang belum
selesai, bukan diklaim berhasil.

**Hasil pengujian aktual:** - Fitur yang diuji: \[isi nama fitur\] -
Langkah pengujian: \[isi langkah\] - Hasil: \[berhasil / belum berhasil
/ perlu pengujian lanjutan\] - Perubahan mandiri yang dilakukan:
\[jelaskan perubahan nyata\]

------------------------------------------------------------------------

## Tahap 4: Refleksi & Penjelasan Kode

**Tujuan:** Memastikan peserta memahami fungsi program, batasan, dan
keputusan teknis.

### Pertanyaan refleksi

1.  **Apa fungsi LaporJatim?**\
    LaporJatim membantu masyarakat mengirim laporan masalah dengan
    informasi lokasi, sedangkan admin memeriksa laporan dan memperbarui
    statusnya.

2.  **Apa peran peta interaktif?**\
    Peta membantu pengguna melihat lokasi laporan dan memilih titik
    lokasi yang relevan.

3.  **Mengapa diperlukan login admin?**\
    Agar pengelolaan laporan dan perubahan status tidak dapat dilakukan
    oleh sembarang pengunjung.

4.  **Apa risiko jika saran AI langsung digunakan tanpa pemeriksaan?**\
    Kode bisa tidak cocok dengan struktur proyek, menimbulkan galat,
    atau memiliki celah keamanan. Karena itu, kode harus ditinjau dan
    diuji.

5.  **Apa batasan proyek saat ini?**\
    Fitur yang membutuhkan server dan database bergantung pada
    konfigurasi hosting. Integrasi AI otomatis atau data BMKG hanya
    dapat disebut aktif jika benar-benar diimplementasikan dan diuji.

### Validasi & Modifikasi Mandiri

Saya menjelaskan kembali alur laporan dari pengisian formulir hingga
pembaruan status oleh admin. Saya juga perlu menunjukkan bagian kode
yang menangani proses tersebut dan melakukan demonstrasi langsung.
Bagian yang belum saya pahami harus dipelajari kembali sebelum
presentasi.

**Refleksi pribadi peserta:** - Hal baru yang saya pelajari: \[isi
dengan pengalaman sendiri\] - Kesalahan yang saya temukan dan cara
memperbaikinya: \[isi berdasarkan pengujian\] - Bagian kode yang saya
modifikasi sendiri: \[sebutkan file dan perubahan\] - Rencana perbaikan
berikutnya: \[isi rencana realistis\]

------------------------------------------------------------------------

## Prinsip Etika Penggunaan AI

-   AI digunakan sebagai asisten, bukan pengganti pemahaman peserta.
-   Saran AI diperiksa sebelum diterapkan.
-   Peserta bertanggung jawab terhadap kode dan hasil akhir.
-   Informasi rahasia seperti kata sandi, API key, dan kredensial
    database tidak boleh dimasukkan ke repositori publik.
-   Fitur yang belum selesai atau belum diuji tidak boleh diklaim telah
    berfungsi.
-   Catatan harus mencerminkan proses pengembangan yang benar-benar
    terjadi.

------------------------------------------------------------------------
