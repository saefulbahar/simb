<?php
// pantau.php - SIMB Banjir, satu file (PHP + MySQL + Bootstrap 5)
session_start();

// ====== PENGATURAN ======
$DB = ['host' => 'localhost', 'nama' => 'simb_banjir', 'user' => 'root', 'pass' => ''];
const ADMIN_PASS = 'admin123';   // ganti!

function e($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

// ====== KONEKSI + BUAT TABEL OTOMATIS ======
try {
    $db = new PDO("mysql:host={$DB['host']};charset=utf8mb4", $DB['user'], $DB['pass'],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
    $db->exec("CREATE DATABASE IF NOT EXISTS `{$DB['nama']}` CHARACTER SET utf8mb4");
    $db->exec("USE `{$DB['nama']}`");
    $db->exec("CREATE TABLE IF NOT EXISTS stasiun (id INT AUTO_INCREMENT PRIMARY KEY, nama VARCHAR(100) NOT NULL,
        kategori VARCHAR(30), aliran VARCHAR(60), lat DOUBLE NULL, lng DOUBLE NULL,
        batas_siaga INT NULL, batas_awas INT NULL, sumber VARCHAR(100))");
    $db->exec("CREATE TABLE IF NOT EXISTS tma (id INT AUTO_INCREMENT PRIMARY KEY, stasiun_id INT NOT NULL,
        tanggal DATE NOT NULL, waktu TIME NOT NULL, cuaca VARCHAR(30), tinggi INT NOT NULL, sumber VARCHAR(100))");
    $db->exec("CREATE TABLE IF NOT EXISTS kejadian (id INT AUTO_INCREMENT PRIMARY KEY, tanggal DATE NOT NULL,
        lokasi VARCHAR(150) NOT NULL, kecamatan VARCHAR(80), lat DOUBLE NULL, lng DOUBLE NULL, tinggi_cm INT NULL,
        penyebab TEXT, dampak TEXT, status VARCHAR(20), sumber VARCHAR(100))");
    $db->exec("CREATE TABLE IF NOT EXISTS rawan (id INT AUTO_INCREMENT PRIMARY KEY, wilayah VARCHAR(150) NOT NULL,
        tingkat VARCHAR(20), penyebab TEXT, lat DOUBLE NULL, lng DOUBLE NULL, catatan TEXT, sumber VARCHAR(100))");
} catch (PDOException $x) {
    die('<h3>Koneksi database gagal</h3><p>Nyalakan MySQL di XAMPP dan cek pengaturan di bagian atas pantau.php.</p>');
}

// ====== SKEMA FORM: field => [label, tipe, opsi/wajib] ======
$SKEMA = [
  'stasiun'  => ['Stasiun Pantau', [
      'nama' => ['Nama stasiun', 'text', 1], 'kategori' => ['Kategori', 'select', ['Pintu Air', 'Pos Pantau', 'Rumah Pompa', 'Sungai']],
      'aliran' => ['Aliran / sungai', 'text'], 'lat' => ['Latitude', 'num'], 'lng' => ['Longitude', 'num'],
      'batas_siaga' => ['Batas siaga (cm)', 'num'], 'batas_awas' => ['Batas awas (cm)', 'num'], 'sumber' => ['Sumber data', 'text']]],
  'tma'      => ['Tinggi Muka Air', [
      'stasiun_id' => ['Stasiun', 'stasiun', 1], 'tanggal' => ['Tanggal', 'date', 1], 'waktu' => ['Waktu', 'time', 1],
      'cuaca' => ['Cuaca', 'select', ['Terang', 'Berawan', 'Hujan Ringan', 'Hujan Lebat']],
      'tinggi' => ['Tinggi air (cm)', 'num', 1], 'sumber' => ['Sumber data', 'text']]],
  'kejadian' => ['Kejadian & Riwayat', [
      'tanggal' => ['Tanggal', 'date', 1], 'lokasi' => ['Lokasi', 'text', 1], 'kecamatan' => ['Kecamatan', 'text'],
      'lat' => ['Latitude', 'num'], 'lng' => ['Longitude', 'num'], 'tinggi_cm' => ['Tinggi genangan (cm)', 'num'],
      'penyebab' => ['Penyebab', 'area', 1], 'dampak' => ['Dampak', 'area'],
      'status' => ['Status', 'select', ['Berlangsung', 'Surut']], 'sumber' => ['Sumber data', 'text']]],
  'rawan'    => ['Wilayah Rawan', [
      'wilayah' => ['Wilayah', 'text', 1], 'tingkat' => ['Tingkat', 'select', ['Rendah', 'Sedang', 'Tinggi']],
      'penyebab' => ['Faktor penyebab', 'area'], 'lat' => ['Latitude', 'num'], 'lng' => ['Longitude', 'num'],
      'catatan' => ['Catatan', 'area'], 'sumber' => ['Sumber data', 'text']]],
];

function status_tma($tinggi, $st) {
    if (!empty($st['batas_awas']) && $tinggi >= $st['batas_awas']) return 'awas';
    if (!empty($st['batas_siaga']) && $tinggi >= $st['batas_siaga']) return 'siaga';
    return 'aman';
}
function tgl_indo($ymd) {
    $h = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
    $b = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    $t = strtotime($ymd);
    return $h[date('w', $t)] . ', ' . date('j', $t) . ' ' . $b[(int)date('n', $t)] . ' ' . date('Y', $t);
}
if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(16));

// ====== AKSI ADMIN ======
$admin = isset($_GET['admin']);
$tab = $_GET['t'] ?? 'tma';
if (!isset($SKEMA[$tab])) $tab = 'tma';

if ($admin && isset($_GET['keluar'])) { unset($_SESSION['admin']); header('Location: pantau.php?admin=1'); exit; }

if ($admin && $_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['pass'])) {
        if (hash_equals(ADMIN_PASS, $_POST['pass'])) { session_regenerate_id(true); $_SESSION['admin'] = 1; }
        else $_SESSION['pesan'] = 'Password salah.';
        header('Location: pantau.php?admin=1'); exit;
    }
    if (!empty($_SESSION['admin']) && hash_equals($_SESSION['csrf'], $_POST['csrf'] ?? '')) {
        if (($_POST['aksi'] ?? '') === 'hapus') {
            $db->prepare("DELETE FROM `$tab` WHERE id = ?")->execute([(int)$_POST['id']]);
            $_SESSION['pesan'] = 'Data dihapus.';
        } elseif (($_POST['aksi'] ?? '') === 'tambah') {
            $kol = []; $val = []; $galat = [];
            foreach ($SKEMA[$tab][1] as $f => $d) {
                $v = trim($_POST[$f] ?? '');
                if (!empty($d[2]) && $d[2] === 1 && $v === '') $galat[] = $d[0] . ' wajib diisi';
                if ($d[1] === 'num') { if ($v !== '' && !is_numeric($v)) $galat[] = $d[0] . ' harus angka'; $v = $v === '' ? null : $v; }
                if ($d[1] === 'select' && !in_array($v, $d[2], true)) $galat[] = $d[0] . ' tidak valid';
                $kol[] = "`$f`"; $val[] = $v;
            }
            if ($galat) $_SESSION['pesan'] = 'Gagal: ' . implode('; ', $galat);
            else {
                $db->prepare("INSERT INTO `$tab` (" . implode(',', $kol) . ") VALUES (" . implode(',', array_fill(0, count($kol), '?')) . ")")->execute($val);
                $_SESSION['pesan'] = 'Data tersimpan.';
            }
        }
    }
    header('Location: pantau.php?admin=1&t=' . $tab); exit;
}
$pesan = $_SESSION['pesan'] ?? ''; unset($_SESSION['pesan']);
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= $admin ? 'Petugas' : 'Pantau Banjir' ?> · SIMB Banjir</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
:root{--card:#0b2a4f;--line:#17406e;--ink:#eaf4ff;--muted:#8fb0d1;--accent:#38bdf8;--aman:#22c55e;--siaga:#f59e0b;--awas:#ef4444}
body{font-family:'Poppins',sans-serif;background:linear-gradient(160deg,#0a3563,#041a33 45%) fixed;color:var(--ink);min-height:100vh}
.text-secondary{color:var(--muted)!important} a{color:var(--accent)}
.nav-simb{background:rgba(4,20,40,.9);border-bottom:1px solid var(--line)}
.nav-simb .navbar-brand{color:var(--accent)} .nav-simb .nav-link{color:var(--ink)} .nav-simb .nav-link.active{color:var(--accent)}
.panel,.stat{background:var(--card);border:1px solid var(--line);border-radius:16px;padding:1.1rem}
.stat span{display:block;font-size:.78rem;color:var(--muted)} .stat b{font-size:1.7rem}
.stat.aman b{color:var(--aman)} .stat.siaga b{color:var(--siaga)} .stat.awas b{color:var(--awas)}
.nav-pills .nav-link{color:var(--muted);border-radius:999px;font-size:.9rem} .nav-pills .nav-link.active{background:var(--accent);color:#04223f}
#map{height:460px;border-radius:12px;border:1px solid var(--line)}
.legend span{margin-right:.9rem;font-size:.78rem;color:var(--muted)} .legend i{display:inline-block;width:11px;height:11px;border-radius:50%;margin-right:.3rem}
.mk{width:16px;height:16px;background:var(--accent);border:2px solid #fff;border-radius:3px}
.table{--bs-table-bg:transparent;--bs-table-color:var(--ink);--bs-table-border-color:var(--line)}
.table thead th{color:var(--muted);font-size:.78rem;background:rgba(56,189,248,.08);white-space:nowrap} .table td{font-size:.88rem}
.badge-st{padding:.15rem .65rem;border-radius:999px;font-size:.75rem;font-weight:600;border:1px solid currentColor}
.aman{color:var(--aman)} .siaga{color:var(--siaga)} .awas{color:var(--awas)}
.form-control,.form-select{background:#06203e;border-color:var(--line);color:var(--ink)}
.form-control:focus,.form-select:focus{background:#06203e;color:var(--ink);border-color:var(--accent);box-shadow:none}
.form-label{color:var(--muted);font-size:.8rem}
</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark nav-simb">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">SIMB Banjir</a>
    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nv"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse justify-content-end" id="nv">
      <ul class="navbar-nav gap-lg-3">
        <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>
        <li class="nav-item"><a class="nav-link <?= $admin ? '' : 'active' ?>" href="pantau.php">Pantau Banjir</a></li>
        <li class="nav-item"><a class="nav-link" href="finding.php">Finding Orang</a></li>
        <li class="nav-item"><a class="nav-link" href="kontak.php">Kontak Darurat</a></li>
        <li class="nav-item"><a class="nav-link" href="faq.php">FAQ</a></li>
        <li class="nav-item"><a class="nav-link" href="berita.php">Berita Terkini</a></li>
      </ul>
    </div>
  </div>
</nav>
<main class="container py-4">

<?php if ($admin): /* ================= ADMIN ================= */ ?>

  <?php if (empty($_SESSION['admin'])): ?>
    <div class="mx-auto" style="max-width:360px"><div class="panel">
      <h1 class="h5 fw-bold mb-3">Masuk Petugas</h1>
      <?php if ($pesan): ?><div class="alert alert-danger py-2 small"><?= e($pesan) ?></div><?php endif; ?>
      <form method="post"><input type="password" name="pass" class="form-control mb-3" placeholder="Password" required autofocus>
      <button class="btn btn-info w-100 fw-semibold">Masuk</button></form>
    </div></div>
  <?php else:
    $stNama = $db->query("SELECT id, nama FROM stasiun ORDER BY nama")->fetchAll(PDO::FETCH_KEY_PAIR);
    $rows = $db->query("SELECT * FROM `$tab` ORDER BY id DESC LIMIT 200")->fetchAll();
  ?>
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h1 class="h4 fw-bold mb-0">Input Data Banjir</h1>
      <div><a class="btn btn-sm btn-outline-info" href="pantau.php">Lihat halaman</a>
      <a class="btn btn-sm btn-outline-light" href="?admin=1&keluar=1">Keluar</a></div>
    </div>
    <ul class="nav nav-pills mb-3">
      <?php foreach ($SKEMA as $k => $s): ?><li class="nav-item"><a class="nav-link <?= $k === $tab ? 'active' : '' ?>" href="?admin=1&t=<?= $k ?>"><?= e($s[0]) ?></a></li><?php endforeach; ?>
    </ul>
    <?php if ($pesan): ?><div class="alert alert-info py-2"><?= e($pesan) ?></div><?php endif; ?>
    <?php if ($tab === 'tma' && !$stNama): ?><div class="alert alert-warning">Isi dulu data <b>Stasiun Pantau</b>.</div><?php endif; ?>

    <div class="row g-3">
      <div class="col-lg-4"><div class="panel">
        <h2 class="h6 fw-semibold mb-3">Tambah data</h2>
        <form method="post">
          <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>"><input type="hidden" name="aksi" value="tambah">
          <?php foreach ($SKEMA[$tab][1] as $f => $d): ?>
            <div class="mb-2"><label class="form-label mb-1"><?= e($d[0]) ?></label>
            <?php if ($d[1] === 'select'): ?>
              <select name="<?= $f ?>" class="form-select form-select-sm"><?php foreach ($d[2] as $o): ?><option><?= e($o) ?></option><?php endforeach; ?></select>
            <?php elseif ($d[1] === 'stasiun'): ?>
              <select name="<?= $f ?>" class="form-select form-select-sm" required><option value="">— pilih —</option>
              <?php foreach ($stNama as $id => $n): ?><option value="<?= $id ?>"><?= e($n) ?></option><?php endforeach; ?></select>
            <?php elseif ($d[1] === 'area'): ?>
              <textarea name="<?= $f ?>" rows="2" class="form-control form-control-sm" <?= ($d[2] ?? 0) === 1 ? 'required' : '' ?>></textarea>
            <?php else: ?>
              <input type="<?= $d[1] === 'num' ? 'number' : $d[1] ?>" <?= $d[1] === 'num' ? 'step="any"' : '' ?> name="<?= $f ?>"
                value="<?= $d[1] === 'date' ? date('Y-m-d') : ($d[1] === 'time' ? date('H:i') : '') ?>"
                class="form-control form-control-sm" <?= ($d[2] ?? 0) === 1 ? 'required' : '' ?>>
            <?php endif; ?></div>
          <?php endforeach; ?>
          <button class="btn btn-info w-100 fw-semibold mt-2">Simpan</button>
        </form>
        <p class="small text-secondary mt-3 mb-0">Isi kolom sumber (DSDA, BPBD, BMKG, dll.) agar data bisa ditelusuri.</p>
      </div></div>

      <div class="col-lg-8"><div class="panel">
        <h2 class="h6 fw-semibold mb-3"><?= e($SKEMA[$tab][0]) ?> (<?= count($rows) ?>)</h2>
        <div class="table-responsive"><table class="table table-sm align-middle mb-0">
          <thead><tr><?php foreach ($SKEMA[$tab][1] as $f => $d) if ($d[1] !== 'area') echo '<th>' . e($d[0]) . '</th>'; ?><th></th></tr></thead>
          <tbody>
          <?php foreach ($rows as $r): ?><tr>
            <?php foreach ($SKEMA[$tab][1] as $f => $d) if ($d[1] !== 'area') echo '<td>' . e($d[1] === 'stasiun' ? ($stNama[$r[$f]] ?? '?') : $r[$f]) . '</td>'; ?>
            <td><form method="post" onsubmit="return confirm('Hapus data ini?')">
              <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>"><input type="hidden" name="aksi" value="hapus">
              <input type="hidden" name="id" value="<?= (int)$r['id'] ?>"><button class="btn btn-sm btn-outline-danger">Hapus</button></form></td>
          </tr><?php endforeach; if (!$rows) echo '<tr><td colspan="20" class="text-center text-secondary py-3">Belum ada data.</td></tr>'; ?>
          </tbody></table></div>
      </div></div>
    </div>
  <?php endif; ?>

<?php else: /* ================= PUBLIK ================= */
    $kat = $_GET['kat'] ?? ''; $tgl = $_GET['tgl'] ?? ''; $thn = $_GET['thn'] ?? '';

    $stasiun = $db->query("SELECT * FROM stasiun ORDER BY nama")->fetchAll();
    $stById = []; foreach ($stasiun as $s) $stById[$s['id']] = $s;

    // pembacaan terbaru tiap stasiun
    $terbaru = [];
    foreach ($db->query("SELECT * FROM tma ORDER BY tanggal DESC, waktu DESC") as $r)
        if (!isset($terbaru[$r['stasiun_id']])) $terbaru[$r['stasiun_id']] = $r;

    // tabel TMA (filter)
    $q = "SELECT t.*, s.nama, s.kategori, s.aliran, s.batas_siaga, s.batas_awas, s.sumber AS sumber_st
          FROM tma t JOIN stasiun s ON s.id = t.stasiun_id WHERE 1=1"; $p = [];
    if ($kat !== '') { $q .= " AND s.kategori = ?"; $p[] = $kat; }
    if ($tgl !== '') { $q .= " AND t.tanggal = ?"; $p[] = $tgl; }
    $st = $db->prepare($q . " ORDER BY t.tanggal DESC, t.waktu DESC LIMIT 200"); $st->execute($p);
    $tabel = $st->fetchAll();

    $kejadian = $db->query("SELECT * FROM kejadian ORDER BY tanggal DESC")->fetchAll();
    $rawan = $db->query("SELECT * FROM rawan ORDER BY FIELD(tingkat,'Tinggi','Sedang','Rendah'), wilayah")->fetchAll();
    $tahun = array_unique(array_map(fn($k) => substr($k['tanggal'], 0, 4), $kejadian));
    $riwayat = array_filter($kejadian, fn($k) => $thn === '' || substr($k['tanggal'], 0, 4) === $thn);
    $aktif = array_filter($kejadian, fn($k) => $k['status'] === 'Berlangsung');

    $hit = ['aman' => 0, 'siaga' => 0, 'awas' => 0]; $stK = [];
    foreach ($stasiun as $s) {
        $r = $terbaru[$s['id']] ?? null;
        $stK[$s['id']] = $r ? status_tma($r['tinggi'], $s) : 'aman';
        if ($r) $hit[$stK[$s['id']]]++;
    }
?>
  <div class="d-flex flex-wrap justify-content-between align-items-end mb-3">
    <div><div class="small text-secondary text-uppercase fw-semibold">Pantau Banjir</div>
    <h1 class="h3 fw-bold mb-0">Informasi Banjir Terkini</h1></div>
    <div class="small text-secondary"><?= e(tgl_indo(date('Y-m-d'))) ?></div>
  </div>

  <div class="row g-3 mb-4">
    <div class="col-6 col-md-3"><div class="stat"><span>Stasiun dipantau</span><b><?= count($stasiun) ?></b></div></div>
    <div class="col-6 col-md-3"><div class="stat aman"><span>Aman</span><b><?= $hit['aman'] ?></b></div></div>
    <div class="col-6 col-md-3"><div class="stat siaga"><span>Siaga</span><b><?= $hit['siaga'] ?></b></div></div>
    <div class="col-6 col-md-3"><div class="stat awas"><span>Awas</span><b><?= $hit['awas'] ?></b></div></div>
  </div>

  <?php if ($aktif): ?><div class="alert alert-danger border-0"><b>Banjir sedang berlangsung di <?= count($aktif) ?> lokasi:</b>
    <?= e(implode(', ', array_column($aktif, 'lokasi'))) ?></div><?php endif; ?>

  <ul class="nav nav-pills mb-3">
    <li class="nav-item"><button class="nav-link active" data-bs-toggle="pill" data-bs-target="#t-peta">Peta</button></li>
    <li class="nav-item"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#t-tma">Tinggi Muka Air</button></li>
    <li class="nav-item"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#t-sebab">Kejadian &amp; Penyebab</button></li>
    <li class="nav-item"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#t-rawan">Wilayah Rawan</button></li>
    <li class="nav-item"><button class="nav-link" data-bs-toggle="pill" data-bs-target="#t-riwayat">Riwayat</button></li>
  </ul>

  <div class="tab-content">
    <div class="tab-pane fade show active" id="t-peta"><div class="panel">
      <div class="d-flex flex-wrap justify-content-between mb-2">
        <h2 class="h6 fw-semibold">Peta sebaran</h2>
        <div class="legend"><span><i style="background:#22c55e"></i>Aman</span><span><i style="background:#f59e0b"></i>Siaga</span>
          <span><i style="background:#ef4444"></i>Awas</span><span><i style="background:#38bdf8;border-radius:2px"></i>Kejadian</span>
          <span><i style="border:2px dashed #f59e0b"></i>Rawan</span></div>
      </div>
      <div id="map"></div>
      <p class="small text-secondary mt-2 mb-0">Ketuk penanda untuk detail. Peta dasar © OpenStreetMap.</p>
      <!-- data titik peta (dibaca script di bawah) -->
      <div hidden id="titik">
        <?php foreach ($stasiun as $s): if ($s['lat'] === null || $s['lng'] === null) continue; $r = $terbaru[$s['id']] ?? null; ?>
          <i data-j="st" data-lat="<?= e($s['lat']) ?>" data-lng="<?= e($s['lng']) ?>" data-nama="<?= e($s['nama']) ?>"
             data-kat="<?= e($s['kategori']) ?>" data-k="<?= $stK[$s['id']] ?>" data-tinggi="<?= e($r['tinggi'] ?? '') ?>"
             data-waktu="<?= $r ? e($r['tanggal'] . ' ' . substr($r['waktu'], 0, 5)) : '' ?>"></i>
        <?php endforeach; foreach ($kejadian as $k): if ($k['lat'] === null || $k['lng'] === null) continue; ?>
          <i data-j="kej" data-lat="<?= e($k['lat']) ?>" data-lng="<?= e($k['lng']) ?>" data-nama="<?= e($k['lokasi']) ?>"
             data-tgl="<?= e($k['tanggal']) ?>" data-status="<?= e($k['status']) ?>" data-tinggi="<?= e($k['tinggi_cm']) ?>" data-sebab="<?= e($k['penyebab']) ?>"></i>
        <?php endforeach; foreach ($rawan as $w): if ($w['lat'] === null || $w['lng'] === null) continue; ?>
          <i data-j="rwn" data-lat="<?= e($w['lat']) ?>" data-lng="<?= e($w['lng']) ?>" data-nama="<?= e($w['wilayah']) ?>" data-tingkat="<?= e($w['tingkat']) ?>"></i>
        <?php endforeach; ?>
      </div>
    </div></div>

    <div class="tab-pane fade" id="t-tma"><div class="panel">
      <form class="row g-2 align-items-end mb-3" method="get">
        <div class="col-auto"><label class="form-label mb-1">Kategori</label>
          <select name="kat" class="form-select form-select-sm" onchange="this.form.submit()"><option value="">Semua</option>
          <?php foreach ($SKEMA['stasiun'][1]['kategori'][2] as $o): ?><option <?= $kat === $o ? 'selected' : '' ?>><?= e($o) ?></option><?php endforeach; ?></select></div>
        <div class="col-auto"><label class="form-label mb-1">Tanggal</label>
          <input type="date" name="tgl" value="<?= e($tgl) ?>" class="form-control form-control-sm" onchange="this.form.submit()"></div>
        <div class="col-auto"><a class="btn btn-sm btn-outline-info" href="pantau.php">Reset</a></div>
      </form>
      <div class="table-responsive"><table class="table align-middle mb-0">
        <thead><tr><th>Nama</th><th>Kategori</th><th>Tanggal</th><th>Waktu</th><th>Aliran</th><th>Cuaca</th><th class="text-end">Tinggi Air</th><th>Status</th><th>Sumber</th></tr></thead>
        <tbody>
        <?php foreach ($tabel as $r): $k = status_tma($r['tinggi'], $r); ?>
          <tr><td class="fw-medium"><?= e($r['nama']) ?></td><td><?= e($r['kategori']) ?></td>
          <td><?= e(date('d/m/Y', strtotime($r['tanggal']))) ?></td><td><?= e(substr($r['waktu'], 0, 5)) ?></td>
          <td><?= e($r['aliran']) ?></td><td><?= e($r['cuaca']) ?></td><td class="text-end"><?= e($r['tinggi']) ?> cm</td>
          <td><span class="badge-st <?= $k ?>"><?= ['aman' => 'Normal', 'siaga' => 'Siaga', 'awas' => 'Awas'][$k] ?></span></td>
          <td class="small text-secondary"><?= e($r['sumber'] ?: $r['sumber_st']) ?></td></tr>
        <?php endforeach; if (!$tabel) echo '<tr><td colspan="9" class="text-center text-secondary py-4">Belum ada data tinggi muka air.</td></tr>'; ?>
        </tbody></table></div>
    </div></div>

    <div class="tab-pane fade" id="t-sebab"><div class="row g-3">
      <?php foreach (array_slice($kejadian, 0, 12) as $k): ?>
      <div class="col-md-6 col-lg-4"><div class="panel h-100">
        <div class="d-flex justify-content-between"><span class="small text-secondary"><?= e(tgl_indo($k['tanggal'])) ?></span>
          <span class="badge-st <?= $k['status'] === 'Berlangsung' ? 'awas' : 'aman' ?>"><?= e($k['status']) ?></span></div>
        <h3 class="h6 fw-semibold mt-2 mb-0"><?= e($k['lokasi']) ?></h3>
        <div class="small text-secondary mb-2">Kec. <?= e($k['kecamatan']) ?><?= $k['tinggi_cm'] !== null ? ' · genangan ' . e($k['tinggi_cm']) . ' cm' : '' ?></div>
        <div class="small"><b>Penyebab:</b> <?= nl2br(e($k['penyebab'])) ?></div>
        <?php if ($k['dampak']): ?><div class="small mt-1"><b>Dampak:</b> <?= nl2br(e($k['dampak'])) ?></div><?php endif; ?>
        <?php if ($k['sumber']): ?><div class="small text-secondary mt-2">Sumber: <?= e($k['sumber']) ?></div><?php endif; ?>
      </div></div>
      <?php endforeach; if (!$kejadian) echo '<div class="col-12"><div class="panel text-center text-secondary">Belum ada kejadian tercatat.</div></div>'; ?>
    </div></div>

    <div class="tab-pane fade" id="t-rawan"><div class="panel"><div class="table-responsive"><table class="table align-middle mb-0">
      <thead><tr><th>Wilayah</th><th>Tingkat</th><th>Faktor penyebab</th><th>Catatan</th><th>Sumber</th></tr></thead><tbody>
      <?php foreach ($rawan as $r): $c = ['Tinggi' => 'awas', 'Sedang' => 'siaga', 'Rendah' => 'aman'][$r['tingkat']] ?? 'aman'; ?>
        <tr><td class="fw-medium"><?= e($r['wilayah']) ?></td><td><span class="badge-st <?= $c ?>"><?= e($r['tingkat']) ?></span></td>
        <td><?= nl2br(e($r['penyebab'])) ?></td><td><?= nl2br(e($r['catatan'])) ?></td><td class="small text-secondary"><?= e($r['sumber']) ?></td></tr>
      <?php endforeach; if (!$rawan) echo '<tr><td colspan="5" class="text-center text-secondary py-4">Belum ada data wilayah rawan.</td></tr>'; ?>
      </tbody></table></div></div></div>

    <div class="tab-pane fade" id="t-riwayat"><div class="panel">
      <form class="mb-3" method="get"><select name="thn" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
        <option value="">Semua tahun</option><?php foreach ($tahun as $y): ?><option <?= $thn === $y ? 'selected' : '' ?>><?= e($y) ?></option><?php endforeach; ?></select></form>
      <div class="table-responsive"><table class="table align-middle mb-0">
        <thead><tr><th>Tanggal</th><th>Lokasi</th><th>Kecamatan</th><th class="text-end">Genangan</th><th>Penyebab</th><th>Dampak</th><th>Status</th></tr></thead><tbody>
        <?php foreach ($riwayat as $k): ?>
          <tr><td><?= e(date('d/m/Y', strtotime($k['tanggal']))) ?></td><td class="fw-medium"><?= e($k['lokasi']) ?></td><td><?= e($k['kecamatan']) ?></td>
          <td class="text-end"><?= $k['tinggi_cm'] !== null ? e($k['tinggi_cm']) . ' cm' : '-' ?></td><td><?= e($k['penyebab']) ?></td><td><?= e($k['dampak']) ?></td>
          <td><span class="badge-st <?= $k['status'] === 'Berlangsung' ? 'awas' : 'aman' ?>"><?= e($k['status']) ?></span></td></tr>
        <?php endforeach; if (!$riwayat) echo '<tr><td colspan="7" class="text-center text-secondary py-4">Belum ada riwayat kejadian.</td></tr>'; ?>
        </tbody></table></div>
    </div></div>
  </div>
<?php endif; ?>
</main>

<footer class="text-center small text-secondary py-4 border-top border-secondary-subtle">
  Sistem Informasi Manajemen Bencana · Banjir &nbsp;·&nbsp; <a href="?admin=1" class="text-secondary">Petugas</a>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<?php if (!$admin): ?>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
var warna = {aman:'#22c55e', siaga:'#f59e0b', awas:'#ef4444'};
function esc(s){var d=document.createElement('div');d.textContent=s||'';return d.innerHTML;}
var map = L.map('map').setView([-6.9932, 110.4203], 11);   // ubah pusat peta sesuai wilayah
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {maxZoom:19, attribution:'© OpenStreetMap'}).addTo(map);
var pts = [];
document.querySelectorAll('#titik i').forEach(function(el){
  var d = el.dataset, ll = [parseFloat(d.lat), parseFloat(d.lng)];
  if (d.j === 'st') {
    L.circleMarker(ll, {radius:9, color:'#fff', weight:2, fillColor:warna[d.k], fillOpacity:1}).addTo(map)
     .bindPopup('<b>'+esc(d.nama)+'</b><br>'+esc(d.kat)+'<br>'+(d.tinggi ? 'Tinggi air: <b>'+esc(d.tinggi)+' cm</b><br>Status: '+esc(d.k)+'<br><small>'+esc(d.waktu)+'</small>' : 'Belum ada pembacaan'));
  } else if (d.j === 'kej') {
    L.marker(ll, {icon:L.divIcon({className:'', html:'<div class="mk"></div>', iconSize:[16,16]})}).addTo(map)
     .bindPopup('<b>'+esc(d.nama)+'</b><br>'+esc(d.tgl)+' · '+esc(d.status)+'<br>Genangan: '+esc(d.tinggi||'-')+' cm<br>Penyebab: '+esc(d.sebab));
  } else {
    var c = {Tinggi:'awas', Sedang:'siaga', Rendah:'aman'}[d.tingkat] || 'aman';
    L.circle(ll, {radius:600, color:warna[c], weight:2, fill:false, dashArray:'4'}).addTo(map)
     .bindPopup('<b>'+esc(d.nama)+'</b><br>Rawan: '+esc(d.tingkat));
  }
  pts.push(ll);
});
if (pts.length) map.fitBounds(pts, {padding:[40,40], maxZoom:14});
document.querySelector('[data-bs-target="#t-peta"]').addEventListener('shown.bs.tab', function(){ map.invalidateSize(); });
var q = location.search;
if (q.indexOf('kat=') > -1 || q.indexOf('tgl=') > -1) new bootstrap.Tab(document.querySelector('[data-bs-target="#t-tma"]')).show();
if (q.indexOf('thn=') > -1) new bootstrap.Tab(document.querySelector('[data-bs-target="#t-riwayat"]')).show();
</script>
<?php endif; ?>
</body>
</html>