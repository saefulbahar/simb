<?php

$kontak = [
    ['instansi' => 'Basarnas (SAR)',     'keterangan' => 'Pencarian dan evakuasi korban',           'nomor' => '115',           'icon' => 'bi-life-preserver'],
    ['instansi' => 'BNPB',               'keterangan' => 'Info dan penanganan bencana nasional',    'nomor' => '117',           'icon' => 'bi-shield-check'],
    ['instansi' => 'Ambulans',           'keterangan' => 'Layanan medis darurat',                   'nomor' => '118',           'icon' => 'bi-heart-pulse'],
    ['instansi' => 'Polisi',             'keterangan' => 'Laporan kejadian dan pengamanan',         'nomor' => '110',           'icon' => 'bi-telephone-fill'],
    ['instansi' => 'Pemadam Kebakaran',  'keterangan' => 'Bantuan evakuasi dan penyedotan air',     'nomor' => '113',           'icon' => 'bi-fire'],
    ['instansi' => 'PLN',                'keterangan' => 'Gangguan listrik saat banjir',            'nomor' => '123',           'icon' => 'bi-lightning-charge-fill'],
    ['instansi' => 'PMI',                'keterangan' => 'Bantuan kemanusiaan dan logistik',        'nomor' => '(021) 7992325', 'icon' => 'bi-plus-circle-fill'],
    ['instansi' => 'BPBD Setempat',      'keterangan' => 'Ganti dengan nomor BPBD daerah kalian',   'nomor' => '0000-0000-0000','icon' => 'bi-building'],
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

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--abu-bg);
            color: var(--teks);
        }


        .navbar {
            background: var(--navy);
            border-bottom: 1px solid #12304f;
        }
        .navbar-brand { color: var(--biru) !important; font-weight: 700; }
        .navbar .nav-link { color: #fff; font-weight: 500; }
        .navbar .nav-link:hover,
        .navbar .nav-link.active { color: var(--biru); }

        .header-halaman {
            background: var(--navy-2);
            color: #fff;
            padding: 38px 0 34px;
        }
        .header-halaman h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 6px;
        }
        .header-halaman p {
            margin: 0;
            color: #a9b8cc;
        }
        .breadcrumb { --bs-breadcrumb-divider-color: #7e93ad; font-size: .85rem; margin-bottom: 10px; }
        .breadcrumb a { color: var(--biru); text-decoration: none; }
        .breadcrumb-item.active { color: #a9b8cc; }

        .box {
            background: #fff;
            border: 1px solid var(--garis);
            border-radius: 8px;
        }

        .blok-lapor {
            padding: 22px 24px;
            border-left: 5px solid #e53935;
            margin-top: -22px;
            box-shadow: 0 2px 8px rgba(15, 30, 50, .08);
        }
        .blok-lapor h2 { font-size: 1.15rem; font-weight: 600; margin-bottom: 4px; }
        .blok-lapor p  { color: var(--teks-pudar); margin: 0; font-size: .93rem; }

        .btn-112 { background: #e53935; color: #fff; font-weight: 600; border: 0; }
        .btn-112:hover { background: #c62828; color: #fff; }
        .btn-wa  { background: #25d366; color: #fff; font-weight: 600; border: 0; }
        .btn-wa:hover { background: #1ebe5a; color: #fff; }
        .btn-garis { border: 1px solid var(--garis); color: var(--teks); background: #fff; }
        .btn-garis:hover { background: var(--abu-bg); }


        .judul-bagian {
            font-size: 1.15rem;
            font-weight: 600;
            margin: 40px 0 14px;
            padding-bottom: 8px;
            border-bottom: 2px solid var(--garis);
            position: relative;
        }
        .judul-bagian::after {
            content: '';
            position: absolute;
            left: 0; bottom: -2px;
            width: 60px; height: 2px;
            background: var(--biru-tua);
        }

        .kartu { padding: 16px 18px; height: 100%; }
        .kartu .ikon {
            width: 40px; height: 40px;
            border-radius: 6px;
            background: #e8f1fd;
            color: var(--biru-tua);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.15rem;
            flex-shrink: 0;
        }
        .kartu h5 { font-size: .98rem; font-weight: 600; margin-bottom: 2px; }
        .kartu small { color: var(--teks-pudar); line-height: 1.3; display: block; }
        .nomor { font-size: 1.2rem; font-weight: 700; color: var(--navy); }
        .btn-telp {
            background: var(--biru-tua);
            color: #fff;
            font-size: .85rem;
            font-weight: 500;
            border: 0;
            padding: 5px 14px;
        }
        .btn-telp:hover { background: #0b5ed7; color: #fff; }

        
        .tabel-posko { margin: 0; }
        .tabel-posko thead th {
            background: #eef2f7;
            font-weight: 600;
            font-size: .85rem;
            color: #44546a;
            border-bottom: 1px solid var(--garis);
        }
        .tabel-posko td { font-size: .93rem; }
        .tabel-posko a { color: var(--biru-tua); text-decoration: none; }

    
        .status-item {
            padding: 14px 18px;
            border-left: 5px solid;
            height: 100%;
        }
        .status-item strong { display: block; margin-bottom: 3px; }
        .status-item span { color: var(--teks-pudar); font-size: .92rem; }
        .status-aman  { border-left-color: #43a047; }
        .status-siaga { border-left-color: #f9a825; }
        .status-awas  { border-left-color: #e53935; }

       
        .daftar-tautan a {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 18px;
            color: var(--teks);
            text-decoration: none;
            border-bottom: 1px solid var(--garis);
            font-size: .93rem;
        }
        .daftar-tautan a:last-child { border-bottom: 0; }
        .daftar-tautan a:hover { background: #f7f9fc; color: var(--biru-tua); }

        .catatan {
            background: #fff8e1;
            border: 1px solid #f3e0a1;
            border-radius: 8px;
            padding: 14px 18px;
            font-size: .93rem;
            color: #5d4a0b;
        }

        footer {
            margin-top: 60px;
            padding: 26px 0;
            background: var(--navy);
            text-align: center;
            color: #9fb3cc;
            font-size: .88rem;
        }
    </style>
</head>
<body>

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

<div class="header-halaman">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                <li class="breadcrumb-item active">Kontak Darurat</li>
            </ol>
        </nav>
        <h1>Kontak Darurat</h1>
        <p>Nomor penting BPBD, SAR, PMI, dan posko banjir. Simpan di HP kamu.</p>
    </div>
</div>

<div class="container">

    <div class="box blok-lapor">
        <div class="row align-items-center g-3">
            <div class="col-lg-7">
                <h2>Butuh bantuan sekarang?</h2>
                <p>Telepon kalau air naik cepat, ada warga yang terjebak, atau tanggul jebol. Nomor ini aktif 24 jam.</p>
            </div>
            <div class="col-lg-5 d-flex flex-wrap gap-2 justify-content-lg-end">
                <a href="tel:112" class="btn btn-112"><i class="bi bi-telephone-fill"></i> Telepon 112</a>
                <a href="https://wa.me/6280000000000" target="_blank" class="btn btn-wa"><i class="bi bi-whatsapp"></i> WhatsApp</a>
                <a href="#" class="btn btn-garis">Form Pengaduan</a>
            </div>
        </div>
    </div>

    <h2 class="judul-bagian">Nomor Darurat</h2>
    <div class="row g-3">
        <?php foreach ($kontak as $k): ?>
            <div class="col-md-6 col-lg-3">
                <div class="box kartu d-flex flex-column">
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

    <h2 class="judul-bagian">Posko Banjir</h2>
    <div class="box overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle tabel-posko">
                <thead>
                    <tr>
                        <th class="ps-3">Nama Posko</th>
                        <th>Alamat</th>
                        <th>Penanggung Jawab</th>
                        <th>No. Telepon</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($posko as $p): ?>
                        <tr>
                            <td class="ps-3"><?= htmlspecialchars($p['nama']) ?></td>
                            <td><?= htmlspecialchars($p['alamat']) ?></td>
                            <td><?= htmlspecialchars($p['pj']) ?></td>
                            <td><a href="tel:<?= preg_replace('/[^0-9+]/', '', $p['telp']) ?>"><?= htmlspecialchars($p['telp']) ?></a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <h2 class="judul-bagian">Arti Status Banjir</h2>
    <div class="row g-3">
        <div class="col-md-4">
            <div class="box status-item status-aman">
                <strong>Aman</strong>
                <span>Tinggi air masih di bawah batas siaga. Kondisi normal.</span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box status-item status-siaga">
                <strong>Siaga</strong>
                <span>Air mulai mendekati batas. Pantau terus dan siapkan barang penting.</span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box status-item status-awas">
                <strong>Awas</strong>
                <span>Air sudah lewat batas aman. Risiko banjir tinggi, siap-siap mengungsi.</span>
            </div>
        </div>
    </div>

    <h2 class="judul-bagian">Tautan Berguna</h2>
    <div class="box daftar-tautan overflow-hidden">
        <a href="https://www.bmkg.go.id" target="_blank">BMKG - Prakiraan Cuaca <i class="bi bi-box-arrow-up-right"></i></a>
        <a href="https://bnpb.go.id" target="_blank">BNPB - Badan Nasional Penanggulangan Bencana <i class="bi bi-box-arrow-up-right"></i></a>
        <a href="https://pmi.or.id" target="_blank">PMI - Palang Merah Indonesia <i class="bi bi-box-arrow-up-right"></i></a>
    </div>

    <div class="catatan mt-4">
        <strong>Pas nelpon:</strong> sebutkan nama, lokasi (alamat atau patokan terdekat), jumlah orang yang butuh bantuan,
        dan kondisi mereka (ada lansia, anak kecil, atau yang sakit).
    </div>

</div>

<footer>
    Sistem Informasi Manajemen Bencana &middot;
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>