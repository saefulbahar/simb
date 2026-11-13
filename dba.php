<?php
function db() {
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "simb_banjir";

    $conn = mysqli_connect($host, $user, $pass, $dbname);

    if (!$conn) {
        $conn = mysqli_connect($host, $user, $pass);
        mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS $dbname");
        $conn = mysqli_connect($host, $user, $pass, $dbname);
    }

    $sql = "CREATE TABLE IF NOT EXISTS orang (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nama VARCHAR(100) NOT NULL,
        usia TINYINT,
        jenis_kelamin ENUM('L','P') DEFAULT 'L',
        alamat VARCHAR(255),
        ciri TEXT,
        kontak VARCHAR(60),
        lokasi_terakhir VARCHAR(255),
        status ENUM('hilang','ditemukan','mengungsi','dirawat') DEFAULT 'hilang',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    mysqli_query($conn, $sql);

    return $conn;
}
?>