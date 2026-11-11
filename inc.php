<?php
function e($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

function head(string $title, string $page = ''): void {
    $menu = ['home'=>['index.php','Beranda'],'pantau'=>['pantau.php','Pantau Banjir'],'finding'=>['finding.php','Finding Orang'],
             'kontak'=>['kontak.php','Kontak Darurat'],'faq'=>['faq.php','FAQ'],'berita'=>['berita.php','Berita Terkini']]; ?>
<!DOCTYPE html>
<html lang="id"><head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($title) ?> | SIMB Banjir</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/style.css">
</head><body>
<header class="nav"><a class="brand" href="index.php">🌊 SIMB Banjir</a>
<nav>
<?php foreach ($menu as $k => [$u, $t]) echo '<a class="' . ($page === $k ? 'on' : '') . '" href="' . $u . '">' . $t . '</a>'; ?>
</nav></header>
<?php }

function foot(): void { ?>
<footer>Sistem Informasi Manajemen Bencana · Kelompok 1</footer>
</body></html>
<?php }

function cards(array $items, string $cls = ''): void {
    echo '<div class="grid ' . $cls . '">';
    foreach ($items as [$ic, $t, $d]) echo '<article class="card"><span class="ic">' . $ic . '</span><h4>' . e($t) . '</h4><p>' . e($d) . '</p></article>';
    echo '</div>';
}

function berita_card(array $b): void { ?>
<a class="nc" href="<?= e($b['url']) ?>" target="_blank" rel="noopener">
  <div class="nc-top"><span class="nc-ic"><?= $b['ikon'] ?></span><span class="tag"><?= e($b['tag']) ?></span></div>
  <h4><?= e($b['judul']) ?></h4><p><?= e($b['ringkas']) ?></p>
  <small><?= e($b['waktu']) ?> · <?= e($b['sumber']) ?> ↗</small>
</a>
<?php }

function soon(string $title, string $page, string $ikon, string $desc): void {
    head($title, $page); ?>
<section class="soon"><div>
  <div class="big"><?= $ikon ?></div>
  <span class="pill">🚧 Segera Hadir</span>
  <h2><?= e($title) ?></h2>
  <p class="lead"><?= e($desc) ?></p>
  <a class="btn" href="index.php">← Kembali ke Beranda</a>
</div></section>
<?php foot(); }
