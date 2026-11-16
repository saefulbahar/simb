<?php
$DB = ['host' => 'localhost', 'nama' => 'simb_banjir', 'user' => 'root', 'pass' => ''];

function e($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }
function tgl_indo($ymd) {
    $b = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    $t = strtotime($ymd);
    return date('j', $t) . ' ' . $b[(int)date('n', $t)] . ' ' . date('Y', $t);
}

try {
    $db = new PDO("mysql:host={$DB['host']};charset=utf8mb4", $DB['user'], $DB['pass'],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
    $db->exec("CREATE DATABASE IF NOT EXISTS `{$DB['nama']}` CHARACTER SET utf8mb4");
    $db->exec("USE `{$DB['nama']}`");
    $db->exec("CREATE TABLE IF NOT EXISTS kejadian (
        id INT AUTO_INCREMENT PRIMARY KEY, 
        lokasi VARCHAR(150), 
        tanggal DATE, 
        tinggi_air INT NULL, 
        cuaca VARCHAR(50), 
        status VARCHAR(50) DEFAULT 'Normal'
    )");
} catch (PDOException $x) {
    die('<h3>Koneksi database gagal</h3><p>Nyalakan MySQL di XAMPP dan cek pengaturan di bagian atas pantau.php.</p>');
}

$thn = preg_match('/^\d{4}$/', $_GET['thn'] ?? '') ? $_GET['thn'] : '';
$q = "SELECT * FROM kejadian WHERE 1=1"; $p = [];
if ($thn !== '') { $q .= " AND YEAR(tanggal) = ?"; $p[] = $thn; }
$st = $db->prepare($q . " ORDER BY tanggal DESC, id DESC LIMIT 500"); $st->execute($p);
$data = $st->fetchAll();

$daftarTahun = $db->query("SELECT DISTINCT YEAR(tanggal) FROM kejadian WHERE tanggal IS NOT NULL ORDER BY 1 DESC")->fetchAll(PDO::FETCH_COLUMN);
$ring = $db->query("SELECT COUNT(*) total, SUM(YEAR(tanggal) = YEAR(CURDATE())) tahun_ini,
    SUM(status = 'Siaga' OR status = 'Awas') aktif, MAX(tinggi_air) maks FROM kejadian")->fetch();
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Pemantauan Banjir · SIMB Banjir</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
:root{--card:#0b2a4f;--line:#17406e;--ink:#eaf4ff;--muted:#8fb0d1;--accent:#38bdf8;--aman:#22c55e;--awas:#ef4444}
body{font-family:'Poppins',sans-serif;background:linear-gradient(160deg,#0a3563,#041a33 45%) fixed;color:var(--ink);min-height:100vh}
.text-secondary{color:var(--muted)!important} a{color:var(--accent)}
.nav-simb{background:rgba(4,20,40,.9);border-bottom:1px solid var(--line)}
.nav-simb .navbar-brand{color:var(--accent)} .nav-simb .nav-link{color:var(--ink)} .nav-simb .nav-link.active{color:var(--accent)}
.panel,.stat{background:var(--card);border:1px solid var(--line);border-radius:16px;padding:1.1rem}
.stat span{display:block;font-size:.78rem;color:var(--muted)} .stat b{font-size:1.7rem}
#map{height:420px;border-radius:12px;border:1px solid var(--line)}
.mk{width:16px;height:16px;background:var(--accent);border:2px solid #fff;border-radius:3px}
.mk.aktif{background:var(--awas)}
.table{--bs-table-bg:transparent;--bs-table-color:var(--ink);--bs-table-border-color:var(--line)}
.table thead th{color:var(--muted);font-size:.78rem;background:rgba(56,189,248,.08);white-space:nowrap} .table td{font-size:.88rem}
.badge-st{padding:.15rem .65rem;border-radius:999px;font-size:.75rem;font-weight:600;border:1px solid currentColor}
.aman{color:var(--aman)} .awas{color:var(--awas)}
.form-select{background-color:#06203e;border-color:var(--line);color:var(--ink)}
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
        <li class="nav-item"><a class="nav-link active" href="pantau.php">Pantau Banjir</a></li>
        <li class="nav-item"><a class="nav-link" href="finding.php">Finding Orang</a></li>
        <li class="nav-item"><a class="nav-link" href="kontak.php">Kontak Darurat</a></li>
        <li class="nav-item"><a class="nav-link" href="faq.php">FAQ</a></li>
        <li class="nav-item"><a class="nav-link" href="berita.php">Berita Terkini</a></li>
      </ul>
    </div>
  </div>
</nav>

<main class="container py-4">
  <div class="mb-3">
    <div class="small text-secondary text-uppercase fw-semibold">Pantau Banjir</div>
    <h1 class="h3 fw-bold mb-0">Pemantauan Tinggi Air</h1>
  </div>

  <div class="row g-3 mb-4">
    <div class="col-6 col-md-3"><div class="stat"><span>Total pemantauan</span><b><?= (int)$ring['total'] ?></b></div></div>
    <div class="col-6 col-md-3"><div class="stat"><span>Pantauan tahun ini</span><b><?= (int)$ring['tahun_ini'] ?></b></div></div>
    <div class="col-6 col-md-3"><div class="stat"><span>Status Siaga/Awas</span><b class="awas"><?= (int)$ring['aktif'] ?></b></div></div>
    <div class="col-6 col-md-3"><div class="stat"><span>Tinggi air tertinggi</span><b><?= $ring['maks'] !== null ? e($ring['maks']) . ' cm' : '-' ?></b></div></div>
  </div>

  <div class="panel mb-4">
    <div class="d-flex flex-wrap justify-content-between mb-2">
      <h2 class="h6 fw-semibold mb-0">Peta lokasi kejadian</h2>
      <span class="small text-secondary"><i class="d-inline-block align-middle mk" style="width:11px;height:11px"></i> Aman
        &nbsp; <i class="d-inline-block align-middle mk aktif" style="width:11px;height:11px"></i> Siaga</span>
    </div>
    <div id="map"></div>
    <p class="small text-secondary mt-2 mb-0">Klik penanda untuk detail. Hanya kejadian yang punya koordinat yang tampil. Peta dasar © OpenStreetMap.</p>
    <div hidden id="titik">
      <?php foreach ($data as $k): 
          if (empty($k['lat']) || empty($k['lng'])) continue; 
      ?>
        <i data-lat="<?= e($k['lat']) ?>" data-lng="<?= e($k['lng']) ?>" data-nama="<?= e($k['lokasi']) ?>"
           data-tgl="<?= e(tgl_indo($k['tanggal'])) ?>" data-status="<?= e($k['status']) ?>"
           data-tinggi="<?= e($k['tinggi_air']) ?>" data-sebab="<?= e($k['cuaca']) ?>"></i>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="panel">
    <form class="row g-2 align-items-end mb-3" method="get">
      <div class="col-auto"><label class="form-label mb-1">Tahun</label>
        <select name="thn" class="form-select form-select-sm" onchange="this.form.submit()"><option value="">Semua</option>
        <?php foreach ($daftarTahun as $y): ?><option <?= (string)$thn === (string)$y ? 'selected' : '' ?>><?= e($y) ?></option><?php endforeach; ?></select></div>
      <div class="col-auto"><a class="btn btn-sm btn-outline-info" href="pantau.php">Reset</a></div>
      <div class="col text-end small text-secondary"><?= count($data) ?> pemantauan</div>
    </form>

    <div class="table-responsive"><table class="table align-middle mb-0">
      <thead><tr><th>Tanggal</th><th>Lokasi</th><th class="text-end">Tinggi Air</th><th>Cuaca</th><th>Status</th></tr></thead>
      <tbody>
      <?php foreach ($data as $k): ?>
        <tr>
          <td class="text-nowrap"><?= $k['tanggal'] ? e(date('d/m/Y', strtotime($k['tanggal']))) : '-' ?></td>
          <td class="fw-medium"><?= e($k['lokasi']) ?></td>
          <td class="text-end text-nowrap"><?= isset($k['tinggi_air']) && $k['tinggi_air'] !== '' ? e($k['tinggi_air']) . ' cm' : '-' ?></td>
          <td><?= e($k['cuaca']) ?></td>
          <td><span class="badge-st <?= (strtolower($k['status']) === 'normal' || strtolower($k['status']) === 'aman') ? 'aman' : 'awas' ?>"><?= e($k['status']) ?></span></td>
        </tr>
      <?php endforeach; if (!$data): ?>
        <tr><td colspan="5" class="text-center text-secondary py-4">Belum ada data pemantauan<?= ($thn !== '') ? ' untuk filter ini' : '' ?>.</td></tr>
      <?php endif; ?>
      </tbody>
    </table></div>
  </div>
</main>

<footer class="text-center small text-secondary py-4 border-top border-secondary-subtle">
  Sistem Informasi Manajemen Bencana · Banjir
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
function esc(s){var d=document.createElement('div');d.textContent=s||'';return d.innerHTML;}
var map = L.map('map').setView([-7.7956, 110.3695], 12);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {maxZoom:19, attribution:'© OpenStreetMap'}).addTo(map);
var pts = [];
document.querySelectorAll('#titik i').forEach(function(el){
  var d = el.dataset, ll = [parseFloat(d.lat), parseFloat(d.lng)];
  var aktif = (d.status.toLowerCase() !== 'normal' && d.status.toLowerCase() !== 'aman');
  L.marker(ll, {icon:L.divIcon({className:'', html:'<div class="mk'+(aktif?' aktif':'')+'"></div>', iconSize:[16,16]})}).addTo(map)
   .bindPopup('<b>'+esc(d.nama)+'</b><br>'+esc(d.tgl)+' · '+esc(d.status)+'<br>Tinggi air: '+esc(d.tinggi||'-')+' cm<br>Cuaca: '+esc(d.sebab));
  pts.push(ll);
});
if (pts.length) map.fitBounds(pts, {padding:[40,40], maxZoom:14});
</script>
</body>
</html>