<?php

$koneksi = mysqli_connect("localhost", "root", "", "formsimbah");

$jenis_list = array(
    "Genangan naik cepat",
    "Warga terjebak / butuh evakuasi",
    "Tanggul atau tanggul sungai jebol",
    "Butuh logistik (makanan, air bersih, selimut)",
    "Butuh bantuan medis",
    "Listrik padam / korsleting",
    "Lainnya"
);

$nama = "";
$no_hp = "";
$jenis = "";
$lokasi = "";
$kelurahan = "";
$waktu_kejadian = "";
$jumlah_terdampak = "";
$deskripsi = "";

$error = array();
$sukses = false;
$kode = "";

if (isset($_POST['kirim'])) {

    $nama = trim($_POST['nama']);
    $no_hp = trim($_POST['no_hp']);
    $jenis = $_POST['jenis'];
    $lokasi = trim($_POST['lokasi']);
    $kelurahan = trim($_POST['kelurahan']);
    $waktu_kejadian = $_POST['waktu_kejadian'];
    $jumlah_terdampak = trim($_POST['jumlah_terdampak']);
    $deskripsi = trim($_POST['deskripsi']);

    if (strlen($nama) < 3) {
        $error[] = "Nama minimal 3 huruf.";
    }

    $hp_bersih = str_replace(array(" ", "-"), "", $no_hp);
    if (!preg_match("/^08[0-9]{8,11}$/", $hp_bersih)) {
        $error[] = "Nomor HP tidak valid. Contoh: 081234567890";
    }

    if ($jenis == "") {
        $error[] = "Pilih jenis laporan dulu.";
    }

    if (strlen($lokasi) < 8) {
        $error[] = "Lokasi kejadian kurang jelas. Tulis alamat atau patokan terdekat.";
    }

    if (strlen($deskripsi) < 15) {
        $error[] = "Ceritakan kondisinya sedikit lebih lengkap (minimal 15 karakter).";
    }

    if ($jumlah_terdampak != "" && !is_numeric($jumlah_terdampak)) {
        $error[] = "Jumlah orang terdampak harus berupa angka.";
    }

    $nama_foto = "";
    if ($_FILES['foto']['name'] != "") {
        $ekstensi = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        $ukuran = $_FILES['foto']['size'];

        if ($ekstensi != "jpg" && $ekstensi != "jpeg" && $ekstensi != "png") {
            $error[] = "Foto harus berformat JPG atau PNG.";
        } elseif ($ukuran > 2097152) {
            $error[] = "Ukuran foto maksimal 2 MB.";
        } else {
            if (!is_dir("uploads/pengaduan")) {
                mkdir("uploads/pengaduan", 0777, true);
            }
            $nama_foto = time() . "_" . rand(100, 999) . "." . $ekstensi;
            move_uploaded_file($_FILES['foto']['tmp_name'], "uploads/pengaduan/" . $nama_foto);
        }
    }

    if (count($error) == 0) {

        $kode = "LP-" . date("ymd") . "-" . rand(1000, 9999);
        $nama_db = mysqli_real_escape_string($koneksi, $nama);
        $hp_db = mysqli_real_escape_string($koneksi, $hp_bersih);
        $jenis_db = mysqli_real_escape_string($koneksi, $jenis);
        $lokasi_db = mysqli_real_escape_string($koneksi, $lokasi);
        $kelurahan_db = mysqli_real_escape_string($koneksi, $kelurahan);
        $deskripsi_db = mysqli_real_escape_string($koneksi, $deskripsi);

        if ($waktu_kejadian != "") {
            $waktu_db = "'" . date("Y-m-d H:i:s", strtotime($waktu_kejadian)) . "'";
        } else {
            $waktu_db = "NULL";
        }

        if ($jumlah_terdampak != "") {
            $jumlah_db = (int) $jumlah_terdampak;
        } else {
            $jumlah_db = "NULL";
        }

        $query = "INSERT INTO pengaduan
                  (kode, nama, no_hp, jenis, lokasi, kelurahan, waktu_kejadian, jumlah_terdampak, deskripsi, foto)
                  VALUES
                  ('$kode', '$nama_db', '$hp_db', '$jenis_db', '$lokasi_db', '$kelurahan_db', $waktu_db, $jumlah_db, '$deskripsi_db', '$nama_foto')";

        if (mysqli_query($koneksi, $query)) {
            $sukses = true;
        } else {
            $error[] = "Laporan belum bisa disimpan. Kalau darurat, langsung telepon 112.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Pengaduan | SIMB Banjir</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --navy: #071a33;
            --navy-2: #0c2442;
            --biru: #29b6f6;
            --biru-tua: #0d6efd;
            --abu-bg: #f3f5f8;
            --garis: #dde3ea;
            --teks: #1f2d3d;
            --teks-pudar: #6b7a8c;
        }
        body { font-family: 'Open Sans', Arial, sans-serif; background: var(--abu-bg); color: var(--teks); }

        .navbar { background: var(--navy); border-bottom: 1px solid #12304f; }
        .navbar-brand { color: var(--biru) !important; font-weight: 700; }
        .navbar .nav-link { color: #fff; font-weight: 500; }
        .navbar .nav-link:hover, .navbar .nav-link.active { color: var(--biru); }

        .header-halaman { background: var(--navy-2); color: #fff; padding: 38px 0 60px; }
        .header-halaman h1 { font-size: 2rem; font-weight: 700; margin-bottom: 6px; }
        .header-halaman p { margin: 0; color: #a9b8cc; }
        .breadcrumb { --bs-breadcrumb-divider-color: #7e93ad; font-size: .85rem; margin-bottom: 10px; }
        .breadcrumb a { color: var(--biru); text-decoration: none; }
        .breadcrumb-item.active { color: #a9b8cc; }

        .box { background: #fff; border: 1px solid var(--garis); border-radius: 8px; }
        .form-box { padding: 28px 30px; margin-top: -36px; box-shadow: 0 2px 8px rgba(15, 30, 50, .08); }

        .form-label { font-weight: 500; font-size: .92rem; margin-bottom: 4px; }
        .form-label .wajib { color: #e53935; }
        .form-text { font-size: .8rem; }
        .form-control, .form-select { font-size: .93rem; border-color: var(--garis); }
        .form-control:focus, .form-select:focus {
            border-color: var(--biru-tua);
            box-shadow: 0 0 0 .2rem rgba(13, 110, 253, .12);
        }

        .sub-judul {
            font-size: 1rem; font-weight: 600;
            padding-bottom: 6px; margin: 6px 0 14px;
            border-bottom: 1px solid var(--garis);
        }

        .btn-kirim { background: var(--biru-tua); color: #fff; font-weight: 600; border: 0; padding: 10px 26px; }
        .btn-kirim:hover { background: #0b5ed7; color: #fff; }
        .btn-batal { border: 1px solid var(--garis); background: #fff; color: var(--teks); padding: 10px 22px; }
        .btn-batal:hover { background: var(--abu-bg); }

        .info-samping { padding: 20px 22px; font-size: .9rem; }
        .info-samping h3 { font-size: 1rem; font-weight: 600; }
        .info-samping ul { padding-left: 18px; margin: 0; color: var(--teks-pudar); }
        .info-samping li { margin-bottom: 6px; }
        .darurat { border-left: 5px solid #e53935; }

        .sukses { padding: 34px 30px; text-align: center; margin-top: -36px; box-shadow: 0 2px 8px rgba(15, 30, 50, .08); }
        .sukses .centang { font-size: 3rem; color: #43a047; }
        .kode-laporan {
            display: inline-block; margin: 12px 0 6px;
            padding: 8px 20px; font-size: 1.4rem; font-weight: 700; letter-spacing: 1px;
            background: #eef2f7; border: 1px dashed #9fb0c4; border-radius: 6px;
        }

        footer { margin-top: 60px; padding: 26px 0; background: var(--navy); text-align: center; color: #9fb3cc; font-size: .88rem; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="index.php"></i>RuangSiaga</a>
        <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="menu">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="pantau.php">Pantau Banjir</a></li>
                <li class="nav-item"><a class="nav-link" href="finding.php">Finding Orang</a></li>
                <li class="nav-item"><a class="nav-link active" href="kontak.php">Kontak Darurat</a></li>
                <li class="nav-item"><a class="nav-link" href="faq.php">FAQ</a></li>
                <li class="nav-item"><a class="nav-link" href="berita.php">Berita Terkini</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="header-halaman">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                <li class="breadcrumb-item"><a href="kontak.php">Kontak Darurat</a></li>
                <li class="breadcrumb-item active">Form Pengaduan</li>
            </ol>
        </nav>
        <h1>Form Pengaduan</h1>
        <p>Laporkan kondisi banjir di sekitarmu supaya bisa segera ditindaklanjuti.</p>
    </div>
</div>

<div class="container">

<?php if ($sukses) { ?>

    <div class="box sukses">
        <div class="centang"><i class="bi bi-check-circle-fill"></i></div>
        <h2 class="h4 fw-semibold mt-2">Laporan kamu sudah masuk</h2>
        <p class="text-secondary mb-1">Catat kode laporan ini kalau nanti mau menanyakan perkembangannya.</p>
        <div class="kode-laporan"><?php echo $kode; ?></div>
        <p class="text-secondary small mb-4">Kalau kondisinya makin parah, jangan nunggu balasan. Langsung telepon 112.</p>
        <a href="pengaduan.php" class="btn btn-batal me-2">Buat laporan lagi</a>
        <a href="index.php" class="btn btn-kirim">Kembali ke Beranda</a>
    </div>

<?php } else { ?>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="box form-box">

                <?php if (count($error) > 0) { ?>
                    <div class="alert alert-danger py-2">
                        <strong>Ada yang perlu dicek lagi:</strong>
                        <ul class="mb-0 mt-1">
                            <?php foreach ($error as $pesan) { ?>
                                <li><?php echo $pesan; ?></li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>

                <form method="post" action="pengaduan.php" enctype="multipart/form-data">

                    <div class="sub-judul">Data pelapor</div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="nama" class="form-label">Nama lengkap <span class="wajib">*</span></label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo htmlspecialchars($nama); ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="no_hp" class="form-label">Nomor HP / WhatsApp <span class="wajib">*</span></label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="081234567890" value="<?php echo htmlspecialchars($no_hp); ?>">
                            <div class="form-text">Dipakai petugas buat menghubungi kamu balik.</div>
                        </div>
                    </div>

                    <div class="sub-judul mt-4">Detail kejadian</div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-12">
                            <label for="jenis" class="form-label">Jenis laporan <span class="wajib">*</span></label>
                            <select class="form-select" id="jenis" name="jenis">
                                <option value="">- Pilih jenis laporan -</option>
                                <?php foreach ($jenis_list as $j) { ?>
                                    <option value="<?php echo $j; ?>" <?php if ($jenis == $j) { echo "selected"; } ?>><?php echo $j; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-8">
                            <label for="lokasi" class="form-label">Lokasi kejadian <span class="wajib">*</span></label>
                            <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Nama jalan, RT/RW, atau patokan terdekat" value="<?php echo htmlspecialchars($lokasi); ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="kelurahan" class="form-label">Kelurahan</label>
                            <input type="text" class="form-control" id="kelurahan" name="kelurahan" value="<?php echo htmlspecialchars($kelurahan); ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="waktu_kejadian" class="form-label">Kapan kejadiannya?</label>
                            <input type="datetime-local" class="form-control" id="waktu_kejadian" name="waktu_kejadian" value="<?php echo htmlspecialchars($waktu_kejadian); ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="jumlah_terdampak" class="form-label">Perkiraan jumlah orang terdampak</label>
                            <input type="number" min="0" class="form-control" id="jumlah_terdampak" name="jumlah_terdampak" value="<?php echo htmlspecialchars($jumlah_terdampak); ?>">
                        </div>
                        <div class="col-12">
                            <label for="deskripsi" class="form-label">Ceritakan kondisinya <span class="wajib">*</span></label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" placeholder="Misalnya: air sudah setinggi lutut dan masih naik, ada 2 lansia di lantai satu."><?php echo htmlspecialchars($deskripsi); ?></textarea>
                        </div>
                        <div class="col-12">
                            <label for="foto" class="form-label">Foto (opsional)</label>
                            <input type="file" class="form-control" id="foto" name="foto" accept="image/jpeg,image/png">
                            <div class="form-text">Format JPG atau PNG, maksimal 2 MB.</div>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" name="kirim" class="btn btn-kirim"><i class="bi bi-send"></i> Kirim Laporan</button>
                        <a href="kontak.php" class="btn btn-batal">Batal</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="box info-samping darurat mb-3 mt-lg-0" style="margin-top: -36px;">
                <h3><i class="bi bi-exclamation-triangle-fill text-danger"></i> Lagi darurat?</h3>
                <p class="text-secondary mb-2">Form ini diproses petugas, jadi tidak langsung. Kalau ada yang terjebak atau butuh evakuasi sekarang, telepon langsung.</p>
                <a href="tel:112" class="btn btn-sm btn-danger fw-semibold"><i class="bi bi-telephone-fill"></i> Telepon 112</a>
            </div>
            <div class="box info-samping">
                <h3>Biar laporan cepat ditangani</h3>
                <ul>
                    <li>Tulis lokasi sejelas mungkin, kalau perlu sebut patokan seperti masjid atau warung.</li>
                    <li>Sebutkan kondisi orang yang butuh bantuan (lansia, anak kecil, orang sakit).</li>
                    <li>Pastikan nomor HP aktif dan bisa dihubungi.</li>
                    <li>Lampirkan foto kalau ada.</li>
                </ul>
            </div>
        </div>
    </div>

<?php } ?>

</div>

<footer>
    © 2026 RuangSiagaBanjir
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
