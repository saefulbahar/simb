<?php
// ====== Konfigurasi database (sesuaikan dengan XAMPP/Laragon kamu) ======
const DB_HOST = '127.0.0.1';
const DB_USER = 'root';
const DB_PASS = '';
const DB_NAME = 'simb_banjir';

// Koneksi + otomatis membuat database, tabel, dan data contoh saat pertama kali dibuka
function db(): PDO {
    static $pdo = null;
    if ($pdo) return $pdo;
    $pdo = new PDO('mysql:host=' . DB_HOST . ';charset=utf8mb4', DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    $pdo->exec('CREATE DATABASE IF NOT EXISTS `' . DB_NAME . '` CHARACTER SET utf8mb4');
    $pdo->exec('USE `' . DB_NAME . '`');
    $pdo->exec("CREATE TABLE IF NOT EXISTS orang (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nama VARCHAR(100) NOT NULL,
        usia TINYINT UNSIGNED NULL,
        jenis_kelamin ENUM('L','P') NOT NULL DEFAULT 'L',
        alamat VARCHAR(255) NULL,
        ciri TEXT NULL,
        kontak VARCHAR(60) NULL,
        lokasi_terakhir VARCHAR(255) NULL,
        lat DECIMAL(9,6) NULL,
        lng DECIMAL(9,6) NULL,
        waktu_terakhir DATETIME NULL,
        status ENUM('hilang','ditemukan','mengungsi','dirawat') NOT NULL DEFAULT 'hilang',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");
    if ((int)$pdo->query('SELECT COUNT(*) FROM orang')->fetchColumn() === 0) {
        $s = $pdo->prepare('INSERT INTO orang (nama,usia,jenis_kelamin,alamat,ciri,kontak,lokasi_terakhir,lat,lng,waktu_terakhir,status) VALUES (?,?,?,?,?,?,?,?,?,?,?)');
        foreach ([
            ['Budi Santoso (contoh)', 67, 'L', 'RT 03/RW 05, Kampung Melayu', 'Lansia, memakai kaos biru & sarung, tinggi ±160 cm', '0812-0000-0001 (Siti, anak)', 'Dekat bantaran sungai, Kampung Melayu', -6.226800, 106.864500, '2026-11-08 19:30:00', 'hilang'],
            ['Rina Aulia (contoh)', 8, 'P', 'RT 01/RW 02, Bukit Duri', 'Anak perempuan, rambut dikepang, jaket kuning', '0812-0000-0002 (Ibu Rina)', 'Posko balai RT 01', -6.223000, 106.855000, '2026-11-09 07:15:00', 'mengungsi'],
            ['Ahmad Fauzi (contoh)', 34, 'L', 'Jl. Kebon Baru No. 12', 'Bertato kecil di lengan kiri, kacamata', '0812-0000-0003 (Dewi, istri)', 'Puskesmas Tebet', -6.231000, 106.853000, '2026-11-09 11:00:00', 'dirawat'],
        ] as $r) $s->execute($r);
    }
    return $pdo;
}
