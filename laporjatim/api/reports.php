<?php
// API publik (hanya baca): statistik, daftar laporan, dan titik peta. Laporan arsip tidak ditampilkan.
require_once __DIR__ . '/../includes/helpers.php';
send_security_headers();

if ($_SERVER['REQUEST_METHOD'] !== 'GET') json_out(['ok' => false, 'message' => 'Metode tidak diizinkan.'], 405);

function format_report(array $r): array {
    return [
        'id'            => (int)$r['id'],
        'title'         => $r['title'],
        'description'   => $r['description'],
        'category'      => $r['category'],
        'address'       => $r['address'],
        'regency'       => $r['regency'],
        'latitude'      => (float)$r['latitude'],
        'longitude'     => (float)$r['longitude'],
        'photo_url'     => $r['photo'] ? UPLOAD_URL . $r['photo'] : null,
        'status'        => $r['status'],
        'status_label'  => STATUSES[$r['status']],
        'created_label' => id_date($r['created_at']),
    ];
}

try {
    $pdo = db();
    $action = $_GET['action'] ?? 'list';
    $from = 'FROM reports r JOIN categories c ON c.id = r.category_id';
    $cols = 'r.id, r.title, r.description, r.address, r.regency, r.latitude, r.longitude, r.photo, r.status, r.created_at, c.name AS category';

    if ($action === 'stats') {
        $s = $pdo->query("SELECT COUNT(*) AS total, SUM(status = 'belum') AS belum, SUM(status = 'proses') AS proses, SUM(status = 'selesai') AS selesai FROM reports WHERE is_archived = 0")->fetch();
        json_out(['ok' => true, 'total' => (int)$s['total'], 'belum' => (int)$s['belum'], 'proses' => (int)$s['proses'], 'selesai' => (int)$s['selesai']]);
    }

    [$where, $params] = report_filters($_GET, false);

    if ($action === 'markers') {
        $st = $pdo->prepare("SELECT $cols $from $where ORDER BY r.created_at DESC LIMIT 1500");
        $st->execute($params);
        json_out(['ok' => true, 'items' => array_map('format_report', $st->fetchAll())]);
    }

    if ($action === 'list') {
        $page = max(1, (int)($_GET['page'] ?? 1));
        $per = PER_PAGE_PUBLIC;
        $off = ($page - 1) * $per;
        $st = $pdo->prepare("SELECT COUNT(*) $from $where");
        $st->execute($params);
        $total = (int)$st->fetchColumn();
        $st = $pdo->prepare("SELECT $cols $from $where ORDER BY r.created_at DESC, r.id DESC LIMIT $per OFFSET $off");
        $st->execute($params);
        json_out(['ok' => true, 'total' => $total, 'page' => $page, 'pages' => max(1, (int)ceil($total / $per)), 'items' => array_map('format_report', $st->fetchAll())]);
    }

    json_out(['ok' => false, 'message' => 'Aksi tidak dikenal.'], 400);
} catch (Throwable $e) {
    error_log('api/reports: ' . $e->getMessage());
    json_out(['ok' => false, 'message' => 'Terjadi kesalahan pada server.'], 500);
}
