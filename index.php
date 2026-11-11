<?php require 'inc.php'; require 'data.php'; head('Banjir', 'home'); ?>

<section class="hero">
  <div class="hero-in">
    <span class="pill">Sistem Informasi Manajemen Bencana</span>
    <h1>Banjir</h1>
    <a class="btn" href="berita.php">📰 Berita Terkini</a> <a class="btn ghost" href="#materi">📖 Pelajari Materi</a>
  </div>
  <aside class="weather">
    <?php foreach ([['🌧️','Rainy','Thursday',89,75],['☁️','Cloudy','Friday',89,65],['☀️','Sunny','Saturday',45,55]] as [$i,$w,$d,$c,$hm]): ?>
      <div class="wx"><b><?= $i ?> <?= $w ?></b><small><?= $d ?></small><span>Cloudy <?= $c ?>%</span><span>Humidity <?= $hm ?>%</span></div>
    <?php endforeach; ?>
  </aside>
  <svg class="waves" viewBox="0 0 1440 120" preserveAspectRatio="none"><path d="M0,70 C240,120 480,20 720,70 C960,120 1200,20 1440,70 L1440,120 L0,120Z" fill="#38bdf8" opacity=".25"/><path d="M0,85 C240,35 480,125 720,85 C960,35 1200,125 1440,85 L1440,120 L0,120Z" fill="#061a33"/></svg>
</section>

<section class="wrap">
  <h2 class="center">Banjir di Indonesia <em>2026</em></h2>
  <div class="facts"><?php foreach ($statistik as [$n, $l]) echo '<div class="fact"><b>' . e($n) . '</b><span>' . e($l) . '</span></div>'; ?></div>
  <p class="note center">Sumber: <?= e($statistik_sumber) ?></p>
</section>

<section class="wrap" id="materi">
  <h2 class="center">Materi <em>Banjir</em></h2>
  <div class="tabs"><button class="tab" data-t="definisi">Definisi</button><button class="tab" data-t="jenis">Jenis</button><button class="tab" data-t="penyebab">Penyebab</button><button class="tab" data-t="dampak">Dampak</button><button class="tab" data-t="penanggulangan">Penanggulangan</button><button class="tab" data-t="mitigasi">Mitigasi</button></div>
<div class="panel center" id="definisi">
<div class="banner" style="--img:url('assets/img/hujan.jpg')"><h2>Definisi <em>Banjir</em></h2></div>
  <p class="lead">Banjir adalah fenomena alam di mana daratan yang biasanya kering tergenang oleh luapan air dalam jumlah yang besar.</p>
</div>

<div class="panel" id="jenis">
<div class="banner" style="--img:url('assets/img/rumah.jpg')"><h2>Jenis-Jenis <em>Banjir</em></h2></div>
  <?php cards([
    ['Banjir Bandang','Air deras datang secara tiba-tiba dengan membawa material seperti lumpur, batu, dan kayu.'],
    ['Banjir Kiriman','Air dari hulu yang mengalir ke dalam hilir.'],
    ['Banjir Rob','Genangan akibat pasang air laut di wilayah pesisir.'],
    ['Banjir Lokal','Genangan akibat hujan setempat dan drainase buruk.'],
  ]); ?>
</div>

<div class="panel" id="penyebab">
<div class="banner" style="--img:url('assets/img/jalan.jpg')"><h2>Penyebab <em>Banjir</em></h2></div>
  <h3>Faktor Alam</h3>
  <?php cards([
    ['Curah Hujan Tinggi','Hujan dengan intensitas tinggi membuat jumlah air melebihi kemampuan tanah dan saluran air untuk menampungnya.'],
    ['Topografi Rendah','Daerah dataran rendah atau cekungan lebih mudah menjadi tempat berkumpulnya air.'],
    ['Pasang Air Laut (Rob)','Naiknya air laut dapat menggenangi wilayah pesisir dan menghambat aliran air sungai menuju laut.'],
    ['Air Sungai Meluap','Debit air sungai melebihi kapasitas sungai sehingga air meluap ke daerah sekitarnya.'],
  ]); ?>
  <h3>Faktor Manusia</h3>
  <?php cards([
    ['Penggundulan Hutan','Air hujan langsung mengalir tanpa terserap akar pohon.'],
    ['Alih Fungsi Lahan','Lahan resapan berubah jadi permukiman/industri.'],
    ['Drainase Buruk','Saluran air tidak memadai atau tersumbat.'],
    ['Sampah di Sungai','Sampah di sungai/saluran menghambat aliran air.'],
    ['Perubahan Vegetasi','Perubahan pohon menjadi tanaman memengaruhi kemampuan tanah menahan air.'],
  ], 'g5'); ?>
</div>

<div class="panel" id="dampak">
<div class="banner" style="--img:url('assets/img/jalan.jpg')"><h2>Dampak <em>Banjir</em></h2></div>
  <h3>Dampak Negatif</h3>
  <?php cards([
    ['Masalah Kesehatan','Air banjir yang kotor dapat meningkatkan penyebaran penyakit kulit dan gangguan pencernaan, terutama pada anak-anak dan lansia.'],
    ['Kerugian Ekonomi','Banjir merusak rumah, kendaraan, dan barang-barang milik masyarakat sehingga menimbulkan kerugian ekonomi.'],
    ['Sulitnya Air Bersih','Banjir dapat mencemari sumber air bersih sehingga masyarakat kesulitan mendapatkan air yang aman.'],
    ['Aktivitas Warga Terhambat','Genangan yang menutupi rumah dan jalan menghambat bekerja, bersekolah, dan bepergian.'],
    ['Munculnya Korban Jiwa','Banjir berarus deras dapat membahayakan keselamatan dan menyebabkan korban jiwa karena terseret atau terjebak.'],
  ], 'neg'); ?>
  <h3>Dampak Positif</h3>
  <?php cards([
    ['Menyuburkan Tanah','Banjir membawa lumpur dan endapan berunsur hara sehingga meningkatkan kesuburan tanah di beberapa wilayah.'],
    ['Mengisi Kembali Sumber Air','Pada kondisi tertentu membantu mengisi kembali air tanah, sungai, dan daerah rawa yang kekurangan air.'],
    [,'Memperbarui Ekosistem Sungai','Aliran banjir membantu membersihkan limbah dan polutan di sungai sehingga mendukung kehidupan ikan, tumbuhan, dan hewan air.'],
    ['Meningkatkan Keanekaragaman Hayati','Menciptakan kondisi yang mendukung perkembangbiakan dan perpindahan ikan dan burung air.'],
  ]); ?>
</div>

<div class="panel" id="penanggulangan">
<div class="banner" style="--img:url('assets/img/evakuasi.jpg')"><h2>Penanggulangan <em>Banjir</em></h2></div>
  <p class="lead center">Serangkaian upaya untuk mempersiapkan, menangani, dan memulihkan dampak banjir sebelum, saat, dan setelah bencana terjadi.</p>
  <h3>Sebelum Banjir</h3>
  <?php cards([
    ['Perencanaan & Koordinasi','Menyusun rencana menghadapi banjir bersama masyarakat dan pemerintah.'],
    ['Edukasi & Pelatihan Masyarakat','Meningkatkan pengetahuan dan kesiapan masyarakat menghadapi banjir.'],
    ['Sistem Peringatan Dini','Menyiapkan sirine, pengeras suara, atau kentongan sebagai tanda bahaya.'],
    ['Persiapan Evakuasi','Menyiapkan tempat dan jalur evakuasi serta tim pencarian dan penyelamatan.'],
  ]); ?>
  <h3>Saat Banjir</h3>
  <?php cards([
    ['Evakuasi','Memindahkan warga ke tempat aman dengan memprioritaskan anak-anak, lansia, dan ibu hamil.'],
    ['Koordinasi & Penyelamatan','Koordinasi dengan pemerintah, masyarakat, PMI, dan SAR untuk pencarian serta penyelamatan korban.'],
    ['Pendataan & Logistik','Mendata korban serta menyiapkan pengungsian, tenaga medis, dan kebutuhan logistik.'],
  ], 'g3'); ?>
  <h3>Setelah Banjir</h3>
  <?php cards([
    ['Analisis Kerusakan','Mendata dan mendokumentasikan kerusakan untuk menentukan kebutuhan perbaikan.'],
    ['Pembersihan Pasca Banjir','Membersihkan lumpur, sampah, dan sisa material banjir untuk memulihkan lingkungan.'],
    ['Pemulihan & Rekonstruksi','Memperbaiki infrastruktur terdampak serta memperoleh bantuan dari pihak terkait.'],
  ], 'g3'); ?>
</div>

<div class="panel" id="mitigasi">
<div class="banner" style="--img:url('assets/img/normalisasi.jpg')"><h2>Mitigasi <em>Banjir</em></h2></div>
  <p class="lead center">Menurut UU No. 24 Tahun 2007, mitigasi adalah serangkaian upaya untuk mengurangi risiko bencana, baik melalui pembangunan fisik maupun penyadaran dan peningkatan kemampuan menghadapi ancaman bencana.</p>
  <h3>Mitigasi Struktural</h3>
  <p class="note">Upaya mengurangi risiko bencana melalui pembangunan infrastruktur prasarana fisik dan rekayasa teknologi.</p>
  <?php cards([
    ['Drainase & Resapan','Saluran air diperbaiki, ditambah biopori dan sumur resapan supaya air hujan meresap ke tanah, bukan menggenang di jalan.'],
    ['Normalisasi Sungai','Sungai dikeruk dari sedimentasi dan sampah agar kapasitas aliran kembali normal dan air tidak mudah meluap.'],
  ], 'g2'); ?>
  <h3>Mitigasi Non-Struktural</h3>
  <p class="note">Upaya pengurangan risiko melalui kebijakan, regulasi, dan edukasi kesiapsiagaan masyarakat.</p>
  <?php cards([
    ['Konservasi Daerah Hulu','Penghijauan dan menjaga hutan membuat tanah mampu menyerap hujan, sehingga debit sungai di hilir tidak naik tiba-tiba.'],
    ['Edukasi & Pengelolaan Sampah','Masyarakat dilatih siaga bencana dan tidak membuang sampah ke saluran agar drainase tidak tersumbat.'],
  ], 'g2'); ?>
  <h3>Jalur Evakuasi</h3>
  <?php cards([
    ['Tentukan Titik Aman','Pilih tempat yang lebih tinggi, tidak tergenang, dan mudah dijangkau warga, misalnya balai RT atau gedung bertingkat.'],
    ['Pasang Rambu Evakuasi','Jalur evakuasi ditandai jelas agar saat banjir datang warga tidak bingung harus ke mana.'],
    ['Prioritaskan Kelompok Rentan','Anak-anak, lansia, ibu hamil, dan penyandang disabilitas dievakuasi lebih dulu.'],
  ], 'g3'); ?>
</div>

</section>

<section class="wrap" id="berita-singkat">
  <h2 class="center">Berita <em>Terkini</em></h2>
  <div class="news"><?php foreach (array_slice($berita, 0, 3) as $b) berita_card($b); ?></div>
  <p class="center"><a class="btn" href="berita.php">Lihat semua berita &amp; video →</a></p>
</section>



<script>
const tabs = [...document.querySelectorAll('.tab')], panels = [...document.querySelectorAll('.panel')];
function show(id) {
  if (!panels.some(p => p.id === id)) id = panels[0].id;
  panels.forEach(p => p.classList.toggle('on', p.id === id));
  tabs.forEach(t => t.classList.toggle('on', t.dataset.t === id));
}
tabs.forEach(t => t.onclick = () => { show(t.dataset.t); history.replaceState(null, '', '#' + t.dataset.t); });
show(location.hash.slice(1));
</script>
<?php foot(); ?>
