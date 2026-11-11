<?php require 'inc.php'; require 'data.php'; head('Berita Terkini', 'berita'); ?>
<section class="pagehead" style="--img:url('assets/img/jalan.jpg')">
  <div><h1>Berita <em>Terkini</em></h1><p class="sub">Kabar banjir di Indonesia · diperbarui 11 November 2026</p></div>
</section>

<section class="wrap">
  <div class="facts">
    <?php foreach ($statistik as [$n, $l]) echo '<div class="fact"><b>' . e($n) . '</b><span>' . e($l) . '</span></div>'; ?>
  </div>
  <p class="note center">Sumber: <?= e($statistik_sumber) ?></p>

  <h3>📰 Kabar Terbaru</h3>
  <div class="news"><?php foreach ($berita as $b) berita_card($b); ?></div>
  <p class="note">Ringkasan ditulis ulang dari pemberitaan media. Klik kartu untuk membaca berita lengkap di sumbernya.</p>

  <h3 id="video">🎬 Video Banjir</h3>
  <div class="vids">
    <?php foreach ($video_youtube as $v): if (empty($v['id'])) continue; ?>
      <figure><iframe class="vid" src="https://www.youtube-nocookie.com/embed/<?= e($v['id']) ?>" title="<?= e($v['judul']) ?>" allowfullscreen loading="lazy"></iframe><figcaption><?= e($v['judul']) ?></figcaption></figure>
    <?php endforeach; ?>
    <?php if (is_file(__DIR__ . '/' . $video_lokal)): ?>
      <figure><video class="vid" controls preload="metadata"><source src="<?= e($video_lokal) ?>" type="video/mp4"></video><figcaption>Video dokumentasi banjir</figcaption></figure>
    <?php endif; ?>
  </div>
  <p class="note">Tonton liputan video banjir terbaru dari kanal berita berikut:</p>
  <div class="grid g2">
    <?php foreach ($kanal as [$ic, $t, $d, $u]): ?>
      <a class="card kanal" href="<?= e($u) ?>" target="_blank" rel="noopener"><span class="ic"><?= $ic ?></span><h4><?= e($t) ?> ▶</h4><p><?= e($d) ?></p></a>
    <?php endforeach; ?>
  </div>
</section>
<?php foot(); ?>
