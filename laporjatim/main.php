<?php
require_once __DIR__ . '/includes/auth.php';
send_security_headers();
$cats = categories();
$regs = regencies();
$csrf = csrf_token();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf" content="<?= e($csrf) ?>">
    <meta name="theme-color" content="#123b30">
    <meta name="description" content="Laporkan masalah di sekitar Anda dan pantau penanganannya melalui peta laporan masyarakat Jawa Timur.">
    <title>LaporJatim — Laporan Warga, Perubahan Nyata</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:wght@600;700&family=Figtree:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>/assets/css/style.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>/assets/css/theme-hijau.css" rel="stylesheet">
</head>
<body data-base="<?= e(BASE_URL) ?>">

<nav class="navbar navbar-expand-md app-nav sticky-top" id="main-nav">
    <div class="container">
        <a class="navbar-brand brand-font d-flex align-items-center gap-2" href="#beranda" aria-label="LaporJatim — beranda">
            <span class="brand-mark"><i class="fa-solid fa-location-dot"></i></span>
            <span>Lapor<span class="brand-word-accent">Jatim</span></span>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Buka menu">
            <i class="fa-solid fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav ms-auto align-items-md-center gap-md-2">
                <li class="nav-item"><a class="nav-link" href="#peta"><i class="fa-solid fa-map-location-dot me-1 d-md-none"></i>Peta laporan</a></li>
                <li class="nav-item"><a class="nav-link" href="#lapor"><i class="fa-solid fa-pen-to-square me-1 d-md-none"></i>Cara melapor</a></li>
                <li class="nav-item ms-md-2"><a class="btn btn-sm btn-outline-primary nav-admin-btn" href="<?= BASE_URL ?>/admin/login.php"><i class="fa-solid fa-lock me-1"></i>Login admin</a></li>
            </ul>
        </div>
    </div>
</nav>

<header class="intro" id="beranda">
    <div class="container">
        <div class="row align-items-center g-5 intro-grid">
            <div class="col-lg-7 intro-copy">
                <div class="intro-eyebrow mb-3"><span class="intro-eyebrow-dot"></span> Platform Pelaporan Publik Jawa Timur</div>
                <h1 class="brand-font">Laporan warga,<br><span class="intro-highlight">perubahan nyata.</span></h1>
                <p class="lead-sm mb-4">Temukan masalah di sekitar, tandai lokasinya, lalu pantau perkembangan penanganannya. Melapor jadi lebih mudah dan transparan.</p>
                <div class="d-flex flex-wrap gap-2 align-items-center intro-actions">
                    <a href="#lapor" class="btn btn-primary btn-lg"><i class="fa-solid fa-pen-to-square me-2"></i>Buat laporan</a>
                    <a href="#peta" class="btn btn-outline-primary btn-lg"><i class="fa-solid fa-map me-2"></i>Jelajahi peta</a>
                </div>
                <div class="intro-trust-row" aria-label="Keunggulan LaporJatim">
                    <span><i class="fa-solid fa-circle-check"></i> Tanpa login</span>
                    <span><i class="fa-solid fa-location-crosshairs"></i> Lokasi di peta</span>
                    <span><i class="fa-solid fa-arrows-rotate"></i> Pantau status</span>
                </div>
            </div>
            <div class="col-lg-5 intro-visual-column">
                <div class="hero-map-card">
                    <div class="hero-map-card-top">
                        <div class="hero-map-card-title"><span class="hero-live-dot"></span><span>Gambaran peta laporan</span></div>
                        <span class="hero-region-tag">JAWA TIMUR</span>
                    </div>
                    <div class="hero-map-canvas">
                        <div class="hero-map-grid"></div>
                        <svg class="hero-map-svg" viewBox="0 0 460 300" role="img" aria-label="Ilustrasi peta dengan beberapa penanda lokasi laporan">
                            <path class="map-land" d="M62 91 L90 72 L124 82 L146 62 L176 76 L199 68 L222 87 L249 79 L272 99 L299 92 L316 111 L347 115 L360 137 L344 158 L363 179 L342 197 L318 196 L300 220 L274 211 L254 230 L228 220 L211 238 L184 220 L165 226 L149 202 L125 197 L112 174 L91 169 L84 146 L63 132 L70 111 Z" />
                            <path class="map-road map-road-main" d="M78 126 C124 112 140 149 177 137 S230 115 255 145 S308 164 345 145" />
                            <path class="map-road" d="M105 91 C132 120 120 155 151 185 S203 210 228 218" />
                            <path class="map-road" d="M170 77 C185 108 214 114 210 151 S241 189 274 211" />
                            <path class="map-road" d="M254 88 C248 111 275 126 291 145 S311 175 318 196" />
                            <path class="map-road" d="M91 169 C137 166 155 147 177 137 S214 143 240 166 S297 187 342 197" />
                            <path class="map-route" d="M121 135 C153 111 180 151 213 143 S265 129 294 158 S327 166 337 143" />
                            <g class="map-pin pin-one" transform="translate(121 135)"><circle r="18"></circle><circle r="9"></circle><circle r="3.5"></circle></g>
                            <g class="map-pin pin-two" transform="translate(213 143)"><circle r="18"></circle><circle r="9"></circle><circle r="3.5"></circle></g>
                            <g class="map-pin pin-three" transform="translate(294 158)"><circle r="18"></circle><circle r="9"></circle><circle r="3.5"></circle></g>
                            <g class="map-pin pin-four" transform="translate(337 143)"><circle r="14"></circle><circle r="7"></circle><circle r="3"></circle></g>
                        </svg>
                        <div class="map-label map-label-one"><i class="fa-solid fa-location-dot"></i> Lokasi laporan</div>
                        <div class="map-compass"><i class="fa-solid fa-location-arrow"></i></div>
                    </div>
                    <div class="hero-map-card-bottom">
                        <div class="hero-card-note">
                            <span class="hero-note-icon"><i class="fa-solid fa-map-location-dot"></i></span>
                            <span><small>Pelaporan berbasis lokasi</small><strong>Lebih mudah dipantau</strong></span>
                        </div>
                        <span class="hero-status-chip"><span></span>Status transparan</span>
                    </div>
                </div>
                <p class="hero-visual-caption"><i class="fa-solid fa-circle-info me-1"></i>Ilustrasi fitur peta, bukan data laporan langsung.</p>
            </div>
        </div>
    </div>
</header>

<main>
    <section class="dashboard-summary container" aria-labelledby="summary-heading">
        <div class="section-heading summary-heading">
            <div>
                <span class="section-kicker">RINGKASAN PUBLIK</span>
                <h2 id="summary-heading" class="brand-font">Pantau perkembangan laporan</h2>
                <p>Ringkasan status laporan yang tercatat di LaporJatim.</p>
            </div>
            <a class="summary-link" href="#peta">Lihat semua laporan <i class="fa-solid fa-arrow-right ms-1"></i></a>
        </div>
        <div class="row g-3" id="stats">
            <div class="col-6 col-xl-3">
                <article class="stat-card stat-total dashboard-stat">
                    <div class="dashboard-stat-top"><span class="dashboard-stat-icon icon-total"><i class="fa-solid fa-layer-group"></i></span><span class="stat-label">Total laporan</span></div>
                    <span class="stat-num" id="stat-total">-</span>
                    <span class="dashboard-stat-foot">Seluruh laporan tercatat</span>
                </article>
            </div>
            <div class="col-6 col-xl-3">
                <article class="stat-card stat-belum dashboard-stat">
                    <div class="dashboard-stat-top"><span class="dashboard-stat-icon icon-belum"><i class="fa-regular fa-clock"></i></span><span class="stat-label">Belum ditangani</span></div>
                    <span class="stat-num" id="stat-belum">-</span>
                    <span class="dashboard-stat-foot">Menunggu tindak lanjut</span>
                </article>
            </div>
            <div class="col-6 col-xl-3">
                <article class="stat-card stat-proses dashboard-stat">
                    <div class="dashboard-stat-top"><span class="dashboard-stat-icon icon-proses"><i class="fa-solid fa-arrows-rotate"></i></span><span class="stat-label">Dalam proses</span></div>
                    <span class="stat-num" id="stat-proses">-</span>
                    <span class="dashboard-stat-foot">Sedang ditindaklanjuti</span>
                </article>
            </div>
            <div class="col-6 col-xl-3">
                <article class="stat-card stat-selesai dashboard-stat">
                    <div class="dashboard-stat-top"><span class="dashboard-stat-icon icon-selesai"><i class="fa-solid fa-check"></i></span><span class="stat-label">Selesai</span></div>
                    <span class="stat-num" id="stat-selesai">-</span>
                    <span class="dashboard-stat-foot">Telah diselesaikan</span>
                </article>
            </div>
        </div>
    </section>

    <section id="peta" class="container dashboard-section">
        <div class="section-heading dashboard-section-header">
            <div>
                <span class="section-kicker">JELAJAHI LAPORAN</span>
                <h2 class="brand-font mb-1"><i class="fa-solid fa-map-location-dot me-2 section-heading-icon"></i>Peta & daftar laporan</h2>
                <p>Telusuri masalah berdasarkan lokasi, kategori, dan status penanganan.</p>
            </div>
            <span class="public-data-pill"><i class="fa-solid fa-globe me-1"></i>Informasi publik</span>
        </div>

        <div class="panel filter-panel p-3 mb-3">
            <div class="filter-panel-heading"><i class="fa-solid fa-sliders me-2"></i>Temukan laporan</div>
            <div class="row g-2 align-items-center">
                <div class="col-12 col-lg-4">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                        <input type="search" id="f-q" class="form-control" placeholder="Cari judul, deskripsi, atau alamat" maxlength="100" aria-label="Cari laporan">
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <select id="f-category" class="form-select" aria-label="Filter kategori">
                        <option value="">Semua kategori</option>
                        <?php foreach ($cats as $c): ?><option value="<?= (int)$c['id'] ?>"><?= e($c['name']) ?></option><?php endforeach; ?>
                    </select>
                </div>
                <div class="col-6 col-lg-3">
                    <select id="f-regency" class="form-select" aria-label="Filter kabupaten atau kota">
                        <option value="">Semua kabupaten/kota</option>
                        <?php foreach ($regs as $name => $_): ?><option value="<?= e($name) ?>"><?= e($name) ?></option><?php endforeach; ?>
                    </select>
                </div>
                <div class="col-8 col-lg-1">
                    <select id="f-status" class="form-select" aria-label="Filter status">
                        <option value="">Status</option>
                        <?php foreach (STATUSES as $k => $v): ?><option value="<?= e($k) ?>"><?= e($v) ?></option><?php endforeach; ?>
                    </select>
                </div>
                <div class="col-4 col-lg-1">
                    <button type="button" id="f-reset" class="btn btn-outline-secondary w-100" title="Atur ulang filter" aria-label="Atur ulang filter"><i class="fa-solid fa-rotate-left"></i><span class="reset-label d-lg-none ms-1">Reset</span></button>
                </div>
            </div>
        </div>

        <div class="row g-3 map-dashboard-row">
            <div class="col-lg-8 map-column">
                <div class="map-panel-heading"><div><h3 class="brand-font">Sebaran laporan</h3><p>Titik penanda berdasarkan lokasi masalah.</p></div><span class="map-panel-icon"><i class="fa-solid fa-expand"></i></span></div>
                <div class="map-wrap">
                    <div id="map" aria-label="Peta laporan Jawa Timur"></div>
                    <div class="legend">
                        <span><i class="dot dot-belum"></i>Belum ditangani</span>
                        <span><i class="dot dot-proses"></i>Proses</span>
                        <span><i class="dot dot-selesai"></i>Selesai</span>
                    </div>
                    <div id="map-loading" class="map-loading"><div class="spinner-border spinner-border-sm text-primary me-2"></div>Memuat titik laporan</div>
                </div>
                <div class="map-footnote"><i class="fa-solid fa-circle-info me-1"></i>Pilih penanda di peta untuk melihat detail laporan.</div>
            </div>
            <div class="col-lg-4 reports-column">
                <div class="panel list-panel">
                    <div class="list-panel-heading">
                        <div><span class="section-kicker">PEMBARUAN</span><h2 class="h6 mb-0 brand-font">Laporan terbaru</h2></div>
                        <span class="small text-muted" id="list-count">-</span>
                    </div>
                    <div id="report-list" class="report-list"></div>
                    <div class="p-3 border-top text-center d-none" id="more-wrap">
                        <button type="button" id="btn-more" class="btn btn-sm btn-outline-primary">Muat lebih banyak <i class="fa-solid fa-arrow-down ms-1"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="lapor" class="container report-section pb-5">
        <div class="section-heading report-section-heading">
            <div>
                <span class="section-kicker">IKUT BERKONTRIBUSI</span>
                <h2 class="brand-font mb-1">Mulai dari laporanmu</h2>
                <p>Sampaikan masalah dengan informasi yang jelas agar mudah ditindaklanjuti.</p>
            </div>
        </div>
        <div class="row g-4 align-items-stretch report-layout">
            <div class="col-lg-4">
                <aside class="report-intro-card h-100">
                    <span class="report-safe-badge"><i class="fa-solid fa-shield-halved me-1"></i>Pelaporan mudah</span>
                    <h3 class="brand-font">Bantu lingkunganmu jadi lebih baik.</h3>
                    <p>Isi laporan secara jelas, tandai titik lokasi yang tepat, dan sertakan foto jika tersedia.</p>
                    <div class="report-steps">
                        <div class="report-step"><span class="report-step-number">01</span><span><strong>Jelaskan masalah</strong><small>Tulis judul, kategori, dan deskripsi.</small></span></div>
                        <div class="report-step"><span class="report-step-number">02</span><span><strong>Tandai lokasi</strong><small>Pilih kabupaten/kota dan titik pada peta.</small></span></div>
                        <div class="report-step"><span class="report-step-number">03</span><span><strong>Kirim laporan</strong><small>Admin memperbarui status tindak lanjut.</small></span></div>
                    </div>
                    <div class="report-tip-box"><i class="fa-solid fa-lightbulb"></i><span><strong>Tips:</strong> Sertakan foto dan alamat yang spesifik supaya masalah lebih mudah dikenali.</span></div>
                </aside>
            </div>
            <div class="col-lg-8">
                <form id="report-form" class="panel report-form-card p-3 p-md-4" novalidate enctype="multipart/form-data">
                    <div class="form-card-heading">
                        <div><span class="section-kicker">FORMULIR PUBLIK</span><h3 class="brand-font">Detail laporan</h3></div>
                        <span class="form-required-note"><span class="required-mark">*</span> Wajib diisi</span>
                    </div>
                    <input type="hidden" name="csrf" value="<?= e($csrf) ?>">
                    <div class="d-none" aria-hidden="true"><label>Website<input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label" for="title">Judul laporan <span class="required-mark">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" required minlength="5" maxlength="150" placeholder="Contoh: Jalan berlubang di depan pasar">
                            <div class="invalid-feedback" data-err="title">Judul 5–150 karakter.</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="category_id">Kategori <span class="required-mark">*</span></label>
                            <select class="form-select" id="category_id" name="category_id" required>
                                <option value="">Pilih kategori</option>
                                <?php foreach ($cats as $c): ?><option value="<?= (int)$c['id'] ?>"><?= e($c['name']) ?></option><?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback" data-err="category_id">Pilih kategori.</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="regency">Kabupaten/kota <span class="required-mark">*</span></label>
                            <select class="form-select" id="regency" name="regency" required>
                                <option value="">Pilih kabupaten/kota</option>
                                <?php foreach ($regs as $name => $ll): ?><option value="<?= e($name) ?>" data-lat="<?= $ll[0] ?>" data-lng="<?= $ll[1] ?>"><?= e($name) ?></option><?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback" data-err="regency">Pilih kabupaten/kota.</div>
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="address">Alamat lokasi <span class="required-mark">*</span></label>
                            <input type="text" class="form-control" id="address" name="address" required minlength="5" maxlength="255" placeholder="Nama jalan, desa/kelurahan, kecamatan">
                            <div class="invalid-feedback" data-err="address">Alamat 5–255 karakter.</div>
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="description">Deskripsi masalah <span class="required-mark">*</span></label>
                            <textarea class="form-control" id="description" name="description" rows="4" required minlength="20" maxlength="2000" placeholder="Jelaskan apa yang terjadi, sejak kapan, dan dampaknya."></textarea>
                            <div class="invalid-feedback" data-err="description">Deskripsi 20–2000 karakter.</div>
                        </div>
                        <div class="col-12 report-location-field">
                            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-2">
                                <label class="form-label mb-0">Titik lokasi pada peta <span class="required-mark">*</span></label>
                                <button type="button" class="btn btn-sm btn-outline-primary" id="btn-locate"><i class="fa-solid fa-location-crosshairs me-1"></i>Gunakan lokasi saya</button>
                            </div>
                            <div id="pick-map"></div>
                            <div class="row g-2 mt-1">
                                <div class="col-6"><input type="text" class="form-control form-control-sm" id="latitude" name="latitude" placeholder="Latitude" readonly aria-label="Latitude"></div>
                                <div class="col-6"><input type="text" class="form-control form-control-sm" id="longitude" name="longitude" placeholder="Longitude" readonly aria-label="Longitude"></div>
                            </div>
                            <div class="text-danger small mt-1 d-none" data-err="coords">Tandai lokasi masalah pada peta.</div>
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="photo">Foto bukti <?= PHOTO_REQUIRED ? '<span class="required-mark">*</span>' : '<span class="optional-mark">(opsional)</span>' ?></label>
                            <input type="file" class="form-control" id="photo" name="photo" accept="image/jpeg,image/png,image/webp" <?= PHOTO_REQUIRED ? 'required' : '' ?> aria-describedby="photo-help">
                            <div class="form-text" id="photo-help">Format JPG, PNG, atau WebP. Maksimal 3 MB.</div>
                            <div class="invalid-feedback" data-err="photo">Unggah foto JPG, PNG, atau WebP maksimal 3 MB.</div>
                            <img id="photo-preview" class="photo-preview d-none" alt="Pratinjau foto bukti">
                        </div>
                        <div class="col-12 d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 pt-2">
                            <p class="form-bottom-note mb-0"><i class="fa-solid fa-lock me-1"></i>Periksa kembali detail sebelum mengirim.</p>
                            <button type="submit" class="btn btn-primary px-4" id="btn-submit">
                                <span class="spinner-border spinner-border-sm me-2 d-none" id="submit-spin"></span><span id="submit-text">Kirim laporan</span><i class="fa-solid fa-arrow-right ms-2" id="submit-arrow"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>

<footer class="site-footer">
    <div class="container">
        <div class="row g-3 align-items-center">
            <div class="col-md-6">
                <a class="footer-brand d-inline-flex align-items-center gap-2 mb-2" href="#beranda">
                    <span class="brand-mark"><i class="fa-solid fa-location-dot"></i></span>
                    <span class="brand-font">Lapor<span>Jatim</span></span>
                </a>
                <p class="small mb-0 footer-copy">&copy; <?= date('Y') ?> LaporJatim — Platform pelaporan masalah masyarakat Jawa Timur.</p>
            </div>
            <div class="col-md-6 text-md-end">
                <div class="d-flex flex-wrap gap-3 justify-content-md-end small footer-links">
                    <a href="#peta"><i class="fa-solid fa-map me-1"></i>Peta laporan</a>
                    <a href="#lapor"><i class="fa-solid fa-pen-to-square me-1"></i>Buat laporan</a>
                    <a href="https://www.openstreetmap.org/copyright" target="_blank" rel="noopener"><i class="fa-solid fa-globe me-1"></i>OpenStreetMap</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<a href="#lapor" class="fab-lapor" id="fab-lapor"><i class="fa-solid fa-pen-to-square"></i><span>Buat laporan</span></a>
<div class="toast-container position-fixed bottom-0 end-0 p-3" id="toasts"></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="<?= BASE_URL ?>/assets/js/public.js"></script>
<script>
    // Tombol laporan melayang hanya tampil saat formulir belum memenuhi area layar.
    (() => {
        const fab = document.getElementById('fab-lapor');
        const section = document.getElementById('lapor');
        if (!fab || !section || !('IntersectionObserver' in window)) return;
        const observer = new IntersectionObserver(([entry]) => {
            fab.classList.toggle('is-hidden', entry.isIntersecting);
        }, { threshold: 0.12 });
        observer.observe(section);
    })();
</script>
</body>
</html>
