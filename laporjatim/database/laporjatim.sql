-- LaporJatim: skema database + data awal (kategori & 1 akun superadmin)
CREATE DATABASE IF NOT EXISTS laporjatim CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE laporjatim;

CREATE TABLE IF NOT EXISTS admins (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  role ENUM('superadmin','admin') NOT NULL DEFAULT 'admin',
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  failed_attempts INT UNSIGNED NOT NULL DEFAULT 0,
  locked_until DATETIME NULL,
  last_login_at DATETIME NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY uq_admin_email (email)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS categories (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(80) NOT NULL,
  UNIQUE KEY uq_category_name (name)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS reports (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(150) NOT NULL,
  description TEXT NOT NULL,
  category_id INT UNSIGNED NOT NULL,
  address VARCHAR(255) NOT NULL,
  regency VARCHAR(60) NOT NULL,
  latitude DECIMAL(10,7) NOT NULL,
  longitude DECIMAL(10,7) NOT NULL,
  photo VARCHAR(255) NULL,
  status ENUM('belum','proses','selesai') NOT NULL DEFAULT 'belum',
  is_archived TINYINT(1) NOT NULL DEFAULT 0,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY idx_status (status),
  KEY idx_regency (regency),
  KEY idx_category (category_id),
  KEY idx_archived_created (is_archived, created_at),
  CONSTRAINT fk_reports_category FOREIGN KEY (category_id) REFERENCES categories(id) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS report_history (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  report_id INT UNSIGNED NOT NULL,
  admin_id INT UNSIGNED NULL,
  old_status ENUM('belum','proses','selesai') NULL,
  new_status ENUM('belum','proses','selesai') NOT NULL,
  note TEXT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY idx_history_report (report_id, created_at),
  CONSTRAINT fk_history_report FOREIGN KEY (report_id) REFERENCES reports(id) ON DELETE CASCADE,
  CONSTRAINT fk_history_admin FOREIGN KEY (admin_id) REFERENCES admins(id) ON DELETE SET NULL
) ENGINE=InnoDB;

INSERT IGNORE INTO categories (name) VALUES
 ('Jalan Rusak'),('Sampah dan Kebersihan'),('Banjir dan Drainase'),('Penerangan Jalan'),
 ('Air Bersih dan Sanitasi'),('Fasilitas Umum'),('Keamanan dan Ketertiban'),('Lingkungan Hidup'),('Lainnya');

-- Superadmin awal. Password sementara: LaporJatim#2026  (WAJIB diganti setelah login pertama)
INSERT IGNORE INTO admins (name, email, password_hash, role)
VALUES ('Super Admin', 'admin@laporjatim.local', '$2b$12$hNKf8fCR4EFR8ABy65mbneK4Vffdm/Gm1ETAQYMTBoQxE3rkMVb4K', 'superadmin');
