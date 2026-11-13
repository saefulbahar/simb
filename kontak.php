<?php
// kontak.php - halaman kontak darurat SIMB Banjir

$kontak = [
    [
        'instansi'   => 'Basarnas (SAR)',
        'keterangan' => 'Pencarian dan evakuasi korban',
        'nomor'      => '115',
        'icon'       => 'bi-life-preserver',
    ],
    [
        'instansi'   => 'BNPB',
        'keterangan' => 'Info dan penanganan bencana nasional',
        'nomor'      => '117',
        'icon'       => 'bi-shield-check',
    ],
    [
        'instansi'   => 'Ambulans',
        'keterangan' => 'Layanan medis darurat',
        'nomor'      => '118',
        'icon'       => 'bi-heart-pulse',
    ],
    [
        'instansi'   => 'Polisi',
        'keterangan' => 'Laporan kejadian dan pengamanan',
        'nomor'      => '110',
        'icon'       => 'bi-telephone-fill',
    ],
    [
        'instansi'   => 'Pemadam Kebakaran',
        'keterangan' => 'Bantuan evakuasi dan penyedotan air',
        'nomor'      => '113',
        'icon'       => 'bi-fire',
    ],
    [
        'instansi'   => 'PLN',
        'keterangan' => 'Gangguan listrik saat banjir',
        'nomor'      => '123',
        'icon'       => 'bi-lightning-charge-fill',
    ],
    [
        'instansi'   => 'PMI',
        'keterangan' => 'Bantuan kemanusiaan dan logistik',
        'nomor'      => '(021) 7992325',
        'icon'       => 'bi-plus-circle-fill',
    ],
    [
        'instansi'   => 'BPBD Setempat',
        'keterangan' => 'Ganti dengan nomor BPBD daerah kalian',
        'nomor'      => '0000-0000-0000',
        'icon'       => 'bi-building',
    ],
];

$posko = [
    ['nama' => 'Posko Banjir Kelurahan A', 'alamat' => 'Jl. Contoh No. 1', 'pj' => 'Pak Budi', 'telp' => '0812-0000-0001'],
    ['nama' => 'Posko Banjir Kelurahan B', 'alamat' => 'Jl. Contoh No. 2', 'pj' => 'Bu Sari',  'telp' => '0812-0000-0002'],
    ['nama' => 'Posko Banjir Kelurahan C', 'alamat' => 'Jl. Contoh No. 3', 'pj' => 'Pak Andi', 'telp' => '0812-0000-0003'],
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kontak Darurat | SIMB Banjir</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #071a33;
            color: #e8eef7;
        }

        .navbar {
            background: #061528;
            border-bottom: 1px solid #12304f;
        }
        .navbar-brand {
            color: #29b6f6 !important;
            font-weight: 700;
        }
        .navbar .nav-link {
            color: #fff;
            font-weight: 500;
        }
        .navbar .nav-link:hover,
        .navbar .nav-link.active {
            color: #29b6f6;
        }

        .judul {
            padding: 60px 0 30px;
            text-align: center;
        }
        .judul h1 {
            font-weight: 700;
            font-size: 2.6rem;
        }
        .judul p {
            color: #a9b8cc;
            max-width: 560px;
            margin: 10px auto 0;
        }

        .kartu {
            background: #0c2442;
            border: 1px solid #16385e;
            border-radius: 10px;
            padding: 18px 20px;
            height: 100%;
        }
        .kartu .ikon {
            width: 44px;
            height: 44px;
            border-radius: 8px;
            background: #12335a;
            color: #29b6f6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            flex-shrink: 0;
        }
        .kartu h5 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 2px;
        }
        .kartu small {
            color: #8fa3bd;
        }
        .nomor {
            font-size: 1.25rem;
            font-weight: 700;
            color: #fff;
            text-decoration: none;
        }
        .nomor:hover {
            color: #29b6f6;
        }

        .btn-telp {
            background: #29b6f6;
            color: #04213a;
            font-weight: 600;
            border: 0;
            padding: 6px 16px;
            border-radius: 6px;
            font-size: .9rem;
        }
        .btn-telp:hover {
            background: #4fc3f7;
            color: #04213a;
        }

        .judul-bagian {
            font-weight: 600;
            font-size: 1.4rem;
            margin: 50px 0 16px;
        }

        .tabel-posko {
            --bs-table-bg: #0c2442;
            --bs-table-color: #e8eef7;
            --bs-table-border-color: #16385e;
            border-radius: 10px;
            overflow: hidden;
        }
        .tabel-posko th {
            background: #12335a;
            color: #cfe3f7;
            font-weight: 500;
            font-size: .9rem;
        }

        .catatan {
            background: #0c2442;
            border-left: 4px solid #29b6f6;
            border-radius: 6px;
            padding: 14px 18px;
            color: #c3d1e3;
            font-size: .95rem;
        }

        .blok-lapor {
            background: #0c2442;
            border: 1px solid #16385e;
            border-radius: 10px;
            padding: 24px 26px;
            margin-bottom: 32px;
        }
        .blok-lapor h2 {
            font-size: 1.3rem;
            font-weight: 600;
        }
        .blok-lapor p {
            color: #a9b8cc;
            margin-bottom: 0;
        }
        .btn-112 {
            background: #e53935;
            color: #fff;
            font-weight: 600;
            border: 0;
            border-radius: 6px;
            padding: 8px 20px;
        }
        .btn-112:hover { background: #ef5350; color: #fff; }
        .btn-wa {
            background: #25d366;
            color: #06301a;
            font-weight: 600;
            border: 0;
            border-radius: 6px;
            padding: 8px 20px;
        }
        .btn-wa:hover { background: #3ddc7a; color: #06301a; }
        .btn-garis {
            border: 1px solid #2c5282;
            color: #e8eef7;
            border-radius: 6px;
            padding: 8px 20px;
        }
        .btn-garis:hover { background: #12335a; color: #fff; }

        .status-item {
            background: #0c2442;
            border: 1px solid #16385e;
            border-left-width: 5px;
            border-radius: 8px;
            padding: 14px 18px;
            height: 100%;
        }
        .status-item strong { display: block; margin-bottom: 4px; }
        .status-item span { color: #a9b8cc; font-size: .93rem; }
        .status-aman  { border-left-color: #43a047; }
        .status-siaga { border-left-color: #fbc02d; }
        .status-awas  { border-left-color: #e53935; }

        .daftar-tautan a {
            display: block;
            padding: 10px 0;
            color: #7fd0f7;
            text-decoration: none;
            border-bottom: 1px solid #16385e;
        }
        .daftar-tautan a:hover { color: #fff; }

        footer {
            margin-top: 70px;
            padding: 28px 0;
            border-top: 1px solid #12304f;
            text-align: center;
            color: #9fb3cc;
            font-size: .9rem;
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="index.php"><i class="bi bi-water"></i> SIMB Banjir</a>
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

<!-- JUDUL -->
<div class="container">
    <div class="judul">
        <h1>Kontak Darurat</h1>
        <p>Simpan nomor-nomor di bawah ini. Kalau situasi sudah berbahaya, jangan tunggu air naik, langsung hubungi.</p>
    </div>

    <!-- LAPOR / MINTA TOLONG -->
    <div class="blok-lapor">
        <div class="row align-items-center g-3">
            <div class="col-lg-7">
                <h2>Butuh bantuan sekarang?</h2>
                <p>Telepon kalau air naik cepat, ada warga yang terjebak, atau tanggul jebol.
                   Nomor ini aktif 24 jam.</p>
            </div>
            <div class="col-lg-5 d-flex flex-wrap gap-2 justify-content-lg-end">
                <a href="tel:112" class="btn btn-112"><i class="bi bi-telephone-fill"></i> Telepon 112</a>
                <a href="https://wa.me/6280000000000" target="_blank" class="btn btn-wa"><i class="bi bi-whatsapp"></i> WhatsApp</a>
                <a href="#" class="btn btn-garis">Form Pengaduan</a>
            </div>
        </div>
    </div>

    <!-- DAFTAR NOMOR -->
    <div class="row g-3">
        <?php foreach ($kontak as $k): ?>
            <div class="col-md-6 col-lg-3">
                <div class="kartu d-flex flex-column">
                    <div class="d-flex gap-3 mb-3">
                        <div class="ikon"><i class="bi <?= $k['icon'] ?>"></i></div>
                        <div>
                            <h5><?= htmlspecialchars($k['instansi']) ?></h5>
                            <small><?= htmlspecialchars($k['keterangan']) ?></small>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-auto">
                        <span class="nomor"><?= htmlspecialchars($k['nomor']) ?></span>
                        <a href="tel:<?= preg_replace('/[^0-9+]/', '', $k['nomor']) ?>" class="btn btn-telp">Telepon</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- POSKO -->
    <h2 class="judul-bagian">Posko Banjir</h2>
    <div class="table-responsive">
        <table class="table tabel-posko align-middle mb-0">
            <thead>
                <tr>
                    <th>Nama Posko</th>
                    <th>Alamat</th>
                    <th>Penanggung Jawab</th>
                    <th>No. Telepon</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($posko as $p): ?>
                    <tr>
                        <td><?= htmlspecialchars($p['nama']) ?></td>
                        <td><?= htmlspecialchars($p['alamat']) ?></td>
                        <td><?= htmlspecialchars($p['pj']) ?></td>
                        <td><a href="tel:<?= preg_replace('/[^0-9+]/', '', $p['telp']) ?>" class="text-info text-decoration-none"><?= htmlspecialchars($p['telp']) ?></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- STATUS -->
    <h2 class="judul-bagian">Arti Status Banjir</h2>
    <div class="row g-3">
        <div class="col-md-4">
            <div class="status-item status-aman">
                <strong>Aman</strong>
                <span>Tinggi air masih di bawah batas siaga. Kondisi normal.</span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="status-item status-siaga">
                <strong>Siaga</strong>
                <span>Air mulai mendekati batas. Pantau terus dan siapkan barang penting.</span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="status-item status-awas">
                <strong>Awas</strong>
                <span>Air sudah lewat batas aman. Risiko banjir tinggi, siap-siap mengungsi.</span>
            </div>
        </div>
    </div>

    <!-- TAUTAN -->
    <h2 class="judul-bagian">Tautan Berguna</h2>
    <div class="daftar-tautan">
        <a href="https://www.bmkg.go.id" target="_blank">BMKG - Prakiraan Cuaca <i class="bi bi-box-arrow-up-right ms-1"></i></a>
        <a href="https://bnpb.go.id" target="_blank">BNPB - Badan Nasional Penanggulangan Bencana <i class="bi bi-box-arrow-up-right ms-1"></i></a>
        <a href="https://pmi.or.id" target="_blank">PMI - Palang Merah Indonesia <i class="bi bi-box-arrow-up-right ms-1"></i></a>
    </div>

    <!-- CATATAN -->
    <div class="catatan mt-4">
        Waktu menelepon, sebutkan nama, lokasi (alamat atau patokan terdekat), jumlah orang yang butuh bantuan,
        dan kondisi mereka (ada lansia, anak kecil, atau yang sakit).
    </div>

    <div class="text-center mt-5">
        <a href="index.php" class="btn btn-telp px-4 py-2">&larr; Kembali ke Beranda</a>
    </div>
</div>

<footer>
    Sistem Informasi Manajemen Bencana &middot; Kelompok 1
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>