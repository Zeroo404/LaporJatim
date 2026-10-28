<?php
require_once __DIR__ . '/config.php';

// Kredensial database (default XAMPP: user root tanpa password)
const DB_HOST = 'localhost';
const DB_NAME = 'laporjatim';
const DB_USER = 'root';
const DB_PASS = '';

function db(): PDO {
    static $pdo = null;
    if ($pdo === null) {
        try {
            $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET time_zone = '+07:00'",
            ]);
        } catch (PDOException $e) {
            error_log('DB connect: ' . $e->getMessage());
            http_response_code(500);
            exit('Koneksi database gagal. Pastikan MySQL berjalan dan database sudah diimpor (lihat README).');
        }
    }
    return $pdo;
}
