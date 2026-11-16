-- Jalankan di phpMyAdmin (pilih database simb dulu, atau buat dulu)
-- CREATE DATABASE IF NOT EXISTS simb CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
-- USE simb;

CREATE TABLE IF NOT EXISTS pengaduan (
    id               INT AUTO_INCREMENT PRIMARY KEY,
    kode             VARCHAR(20)  NOT NULL UNIQUE,
    nama             VARCHAR(100) NOT NULL,
    no_hp            VARCHAR(20)  NOT NULL,
    jenis            VARCHAR(100) NOT NULL,
    lokasi           VARCHAR(255) NOT NULL,
    kelurahan        VARCHAR(100) NULL,
    waktu_kejadian   DATETIME     NULL,
    jumlah_terdampak INT          NULL,
    deskripsi        TEXT         NOT NULL,
    foto             VARCHAR(100) NULL,
    status           ENUM('baru','diproses','selesai') NOT NULL DEFAULT 'baru',
    created_at       TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
