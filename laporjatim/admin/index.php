<?php
require_once __DIR__ . '/_layout.php';
$admin = require_admin();
$pdo = db();

$s = $pdo->query("SELECT COUNT(*) AS total, COALESCE(SUM(status = 'belum'), 0) AS belum, COALESCE(SUM(status = 'proses'), 0) AS proses, COALESCE(SUM(status = 'selesai'), 0) AS selesai FROM reports WHERE is_archived = 0")->fetch();
$archived = (int)$pdo->query('SELECT COUNT(*) FROM reports WHERE is_archived = 1')->fetchColumn();
$recent = $pdo->query('SELECT r.id, r.title, r.regency, r.status, r.created_at, c.name AS category FROM reports r JOIN categories c ON c.id = r.category_id WHERE r.is_archived = 0 ORDER BY r.created_at DESC, r.id DESC LIMIT 8')->fetchAll();
$byCat = $pdo->query('SELECT c.name, COUNT(r.id) AS n FROM categories c LEFT JOIN reports r ON r.category_id = c.id AND r.is_archived = 0 GROUP BY c.id, c.name ORDER BY n DESC, c.name LIMIT 8')->fetchAll();
$maxCat = max(1, ...array_map(fn($x) => (int)$x['n'], $byCat ?: [['n' => 1]]));
$done = (int)$s['total'] > 0 ? round($s['selesai'] / $s['total'] * 100) : 0;

admin_header('Ringkasan', 'index', $admin);

// [label, angka, ikon, kelas status, kelas ikon, keterangan]
$cards = [
    ['Total laporan',    $s['total'],   'fa-solid fa-layer-group',  'stat-total',   'icon-total',   'Seluruh laporan aktif'],
    ['Belum ditangani',  $s['belum'],   'fa-regular fa-clock',      'stat-belum',   'icon-belum',   'Menunggu tindak lanjut'],
    ['Dalam proses',     $s['proses'],  'fa-solid fa-arrows-rotate','stat-proses',  'icon-proses',  'Sedang ditindaklanjuti'],
    ['Selesai',          $s['selesai'], 'fa-solid fa-check',        'stat-selesai', 'icon-selesai', 'Telah diselesaikan'],
];
?>
<div class="admin-dash">

    <div class="section-heading">
        <div>
            <span class="section-kicker">PANEL ADMIN</span>
            <h2 class="brand-font">Ringkasan laporan</h2>
            <p>Pantau status penanganan laporan warga Jawa Timur.</p>
        </div>
        <a class="summary-link" href="reports.php">Kelola semua laporan <i class="fa-solid fa-arrow-right ms-1"></i></a>
    </div>

    <section class="dashboard-summary" aria-label="Statistik laporan">
        <div class="row g-3">
            <?php foreach ($cards as [$label, $num, $icon, $cls, $icls, $foot]): ?>
                <div class="col-6 col-xl-3">
                    <article class="stat-card <?= $cls ?> dashboard-stat">
                        <div class="dashboard-stat-top">
                            <span class="dashboard-stat-icon <?= $icls ?>"><i class="<?= $icon ?>"></i></span>
                            <span class="stat-label"><?= e($label) ?></span>
                        </div>
                        <span class="stat-num"><?= (int)$num ?></span>
                        <span class="dashboard-stat-foot"><?= e($foot) ?></span>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <div class="row g-3 align-items-start">
        <div class="col-xl-8">
            <div class="panel admin-panel">
                <div class="list-panel-heading">
                    <div>
                        <span class="section-kicker">PEMBARUAN</span>
                        <h2 class="h6 mb-0 brand-font">Laporan terbaru</h2>
                    </div>
                    <a href="reports.php" class="btn btn-sm btn-outline-primary">Lihat semua</a>
                </div>
                <?php if (!$recent): ?>
                    <div class="empty-state"><i class="fa-solid fa-inbox d-block"></i>Belum ada laporan masuk.</div>
                <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 admin-table">
                        <thead><tr><th>Judul</th><th>Kab/Kota</th><th>Tanggal</th><th>Status</th></tr></thead>
                        <tbody>
                        <?php foreach ($recent as $r): ?>
                            <tr>
                                <td>
                                    <a class="admin-table-title" href="report.php?id=<?= (int)$r['id'] ?>"><?= e($r['title']) ?></a>
                                    <div class="admin-table-sub"><i class="fa-solid fa-tag me-1"></i><?= e($r['category']) ?></div>
                                </td>
                                <td><?= e($r['regency']) ?></td>
                                <td class="text-nowrap"><?= e(id_date($r['created_at'])) ?></td>
                                <td><?= status_badge($r['status']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="admin-progress-card mb-3">
                <div class="admin-progress-top">
                    <span class="admin-progress-label"><span class="hero-live-dot"></span>Tingkat penyelesaian</span>
                    <i class="fa-solid fa-chart-line"></i>
                </div>
                <div class="admin-progress-value brand-font"><?= $done ?><small>%</small></div>
                <div class="admin-progress-track" role="progressbar" aria-valuenow="<?= $done ?>" aria-valuemin="0" aria-valuemax="100" aria-label="Tingkat penyelesaian laporan">
                    <span style="width:<?= $done ?>%"></span>
                </div>
                <div class="admin-progress-note"><i class="fa-solid fa-box-archive me-1"></i><?= $archived ?> laporan berada di arsip.</div>
            </div>

            <div class="panel admin-panel p-3">
                <div class="mb-3">
                    <span class="section-kicker">DISTRIBUSI</span>
                    <h2 class="h6 brand-font mb-0">Laporan per kategori</h2>
                </div>
                <?php if (!$byCat): ?>
                    <div class="small text-muted">Belum ada kategori.</div>
                <?php endif; ?>
                <?php foreach ($byCat as $c): ?>
                    <div class="admin-cat">
                        <div class="admin-cat-row"><span><?= e($c['name']) ?></span><strong><?= (int)$c['n'] ?></strong></div>
                        <div class="admin-cat-track"><span style="width:<?= round($c['n'] / $maxCat * 100) ?>%"></span></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

</div>
<?php admin_footer(); ?>