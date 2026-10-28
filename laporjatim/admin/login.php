<?php
require_once __DIR__ . '/../includes/auth.php';
send_security_headers();

if (current_admin()) { header('Location: index.php'); exit; }

$error = null;
$email = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_csrf();
    $email = trim((string)($_POST['email'] ?? ''));
    $pass = (string)($_POST['password'] ?? '');
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $pass === '') {
        $error = 'Masukkan email dan password yang valid.';
    } else {
        $error = attempt_login($email, $pass);
        if ($error === null) { header('Location: index.php'); exit; }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <meta name="theme-color" content="#123b30">
    <title>Login Admin - LaporJatim</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:wght@600;700&family=Figtree:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>/assets/css/style.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>/assets/css/theme-hijau.css" rel="stylesheet">
</head>
<body class="login-page">
<main class="login-shell">

    <section class="login-aside" aria-label="Tentang LaporJatim">
        <a class="login-brand brand-font" href="<?= BASE_URL ?>/index.php" aria-label="LaporJatim — situs publik">
            <span class="brand-mark"><i class="fa-solid fa-location-dot"></i></span>
            <span>Lapor<span>Jatim</span></span>
        </a>
        <div class="login-aside-body">
            <div class="intro-eyebrow mb-3"><span class="intro-eyebrow-dot"></span> Panel Pengelola</div>
            <h1 class="brand-font">Kelola laporan warga,<br><span class="intro-highlight">tindak lanjuti dengan cepat.</span></h1>
            <p class="login-aside-lead">Tinjau laporan masuk, perbarui status penanganan, dan jaga transparansi layanan publik Jawa Timur.</p>
            <div class="intro-trust-row">
                <span><i class="fa-solid fa-list-check"></i> Pantau status</span>
                <span><i class="fa-solid fa-map-location-dot"></i> Lokasi di peta</span>
                <span><i class="fa-solid fa-box-archive"></i> Arsip laporan</span>
            </div>
        </div>
        <p class="login-aside-foot">&copy; <?= date('Y') ?> LaporJatim</p>
    </section>

    <section class="login-main">
        <div class="login-card">
            <div class="login-card-head">
                <span class="section-kicker">AKSES ADMIN</span>
                <h2 class="brand-font">Masuk ke panel</h2>
                <p>Khusus pengelola LaporJatim. Pelapor tidak perlu login.</p>
            </div>

            <form method="post" autocomplete="on" novalidate>
                <?= csrf_field() ?>
                <?php if ($error): ?>
                    <div class="alert alert-danger login-alert" role="alert"><i class="fa-solid fa-circle-exclamation me-2"></i><?= e($error) ?></div>
                <?php endif; ?>

                <div class="mb-3">
                    <label class="form-label" for="email">Email</label>
                    <div class="input-group login-input">
                        <span class="input-group-text"><i class="fa-regular fa-envelope"></i></span>
                        <input type="email" class="form-control" id="email" name="email" value="<?= e($email) ?>" placeholder="nama@instansi.go.id" required autofocus autocomplete="username">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-group login-input">
                        <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required autocomplete="current-password">
                        <button class="btn login-toggle" type="button" id="toggle-pass" aria-label="Tampilkan password" aria-pressed="false"><i class="fa-regular fa-eye"></i></button>
                    </div>
                </div>

                <button class="btn btn-primary w-100 login-submit" type="submit">Masuk <i class="fa-solid fa-arrow-right ms-2"></i></button>
            </form>

            <p class="login-back"><a href="<?= BASE_URL ?>/index.php"><i class="fa-solid fa-arrow-left me-1"></i>Kembali ke situs publik</a></p>
        </div>
    </section>

</main>
<script>
    (() => {
        const btn = document.getElementById('toggle-pass');
        const input = document.getElementById('password');
        if (!btn || !input) return;
        btn.addEventListener('click', () => {
            const show = input.type === 'password';
            input.type = show ? 'text' : 'password';
            btn.setAttribute('aria-pressed', show ? 'true' : 'false');
            btn.setAttribute('aria-label', show ? 'Sembunyikan password' : 'Tampilkan password');
            btn.firstElementChild.className = show ? 'fa-regular fa-eye-slash' : 'fa-regular fa-eye';
        });
    })();
</script>
</body>
</html>