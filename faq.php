<?php
require 'inc.php';

// ====== DATA FAQ ======
// Struktur: kategori => [ikon, judul, daftar [pertanyaan, jawaban]]
// Jawaban bisa berupa teks biasa, atau array [pengantar, [[judul, isi], ...]] untuk daftar poin.
// Tambah pertanyaan baru: salin satu baris [pertanyaan, jawaban] ke kategori yang sesuai.
$faq = [
  'definisi' => ['📘', 'Definisi', [
    ['Apa itu banjir?',
     'Banjir adalah fenomena alam di mana daratan yang biasanya kering tergenang oleh luapan air dalam jumlah yang besar.'],
  ]],

  'jenis' => ['🌊', 'Jenis Banjir', [
    ['Apa saja jenis-jenis banjir?',
     ['Ada empat jenis banjir yang umum terjadi:', [
       ['Banjir bandang', 'Air deras datang secara tiba-tiba dengan membawa material seperti lumpur, batu, dan kayu.'],
       ['Banjir kiriman', 'Air dari hulu yang mengalir ke hilir.'],
       ['Banjir rob', 'Genangan akibat pasang air laut di wilayah pesisir.'],
       ['Banjir lokal', 'Genangan akibat hujan setempat dan drainase buruk.'],
     ]]],
    ['Kenapa banjir bisa terjadi walau di tempat saya tidak hujan?',
     'Bisa jadi itu banjir kiriman (air hujan dari daerah hulu mengalir sampai ke hilir) atau banjir rob (air laut pasang di wilayah pesisir). Keduanya tidak bergantung pada hujan di lokasi yang tergenang.'],
    ['Jenis banjir mana yang paling berbahaya?',
     'Banjir bandang, karena datang tiba-tiba dengan arus deras dan membawa lumpur, batu, serta kayu, sehingga warga hanya punya waktu sangat singkat untuk menyelamatkan diri.'],
  ]],

  'penyebab' => ['🌧️', 'Penyebab Banjir', [
    ['Apa saja faktor alam penyebab banjir?',
     ['Faktor alam yang memicu banjir:', [
       ['Curah hujan tinggi', 'Hujan turun dengan intensitas tinggi sehingga jumlah air bisa melebihi kemampuan tanah dan saluran air untuk menampungnya.'],
       ['Topografi rendah', 'Daerah yang berupa dataran rendah atau cekungan lebih mudah menjadi tempat berkumpulnya air.'],
       ['Pasang air laut (rob)', 'Naiknya air laut dapat menggenangi wilayah pesisir dan juga menghambat aliran air sungai menuju laut.'],
       ['Air sungai meluap', 'Debit air sungai melebihi kapasitas sungai sehingga air meluap ke daerah sekitarnya.'],
     ]]],
    ['Apa saja faktor manusia penyebab banjir?',
     ['Aktivitas manusia yang memperparah risiko banjir:', [
       ['Penggundulan hutan', 'Air hujan langsung mengalir tanpa terserap akar pohon.'],
       ['Alih fungsi lahan', 'Lahan resapan berubah menjadi permukiman atau industri.'],
       ['Drainase buruk', 'Saluran air tidak memadai atau tersumbat.'],
       ['Sampah di sungai', 'Sampah di sungai atau saluran menghambat aliran air.'],
       ['Perubahan vegetasi', 'Perubahan pohon menjadi tanaman lain memengaruhi kemampuan tanah menahan air.'],
     ]]],
  ]],

  'dampak' => ['⚠️', 'Dampak Banjir', [
    ['Apa saja dampak negatif banjir?',
     ['Banjir dapat menimbulkan lima dampak negatif utama:', [
       ['Masalah kesehatan', 'Air banjir yang kotor dapat meningkatkan penyebaran berbagai penyakit, seperti penyakit kulit dan gangguan pencernaan, terutama pada anak-anak dan lansia.'],
       ['Kerugian ekonomi', 'Banjir menyebabkan kerusakan pada rumah, kendaraan, dan barang-barang milik masyarakat sehingga menimbulkan kerugian secara ekonomi.'],
       ['Sulitnya air bersih', 'Banjir dapat mencemari sumber air bersih sehingga masyarakat mengalami kesulitan mendapatkan air yang aman untuk kebutuhan sehari-hari.'],
       ['Aktivitas warga terhambat', 'Genangan air yang menutupi rumah dan jalan dapat menghambat aktivitas sehari-hari, termasuk bekerja, bersekolah, dan bepergian.'],
       ['Munculnya korban jiwa', 'Banjir dengan arus deras dapat membahayakan keselamatan masyarakat dan menyebabkan korban jiwa karena terseret atau terjebak dalam genangan air.'],
     ]]],
    ['Apakah banjir punya dampak positif?',
     ['Ya, pada kondisi tertentu banjir juga membawa dampak positif bagi lingkungan:', [
       ['Menyuburkan tanah', 'Banjir dapat membawa lumpur dan endapan yang mengandung unsur hara sehingga meningkatkan kesuburan tanah di beberapa wilayah.'],
       ['Mengisi kembali sumber air', 'Air banjir dapat membantu mengisi kembali air tanah, sungai, dan daerah rawa yang mengalami kekurangan air.'],
       ['Memperbarui ekosistem sungai', 'Aliran banjir dapat membantu membersihkan limbah dan polutan di sungai, sehingga mendukung kehidupan ikan, tumbuhan, dan hewan air lainnya.'],
       ['Meningkatkan keanekaragaman hayati', 'Banjir dapat menciptakan kondisi yang mendukung perkembangbiakan dan perpindahan beberapa jenis hewan, terutama ikan dan burung air, karena tersedianya air dan sumber makanan.'],
     ]]],
  ]],

  'penanggulangan' => ['🛟', 'Penanggulangan', [
    ['Apa yang dimaksud dengan penanggulangan banjir?',
     'Penanggulangan banjir adalah serangkaian upaya untuk mempersiapkan, menangani, dan memulihkan dampak banjir sebelum, saat, dan setelah bencana terjadi.'],
    ['Apa yang dilakukan sebelum banjir terjadi?',
     ['Persiapan sebelum banjir meliputi:', [
       ['Perencanaan & koordinasi', 'Menyusun rencana menghadapi banjir bersama masyarakat dan pemerintah.'],
       ['Edukasi & pelatihan masyarakat', 'Meningkatkan pengetahuan dan kesiapan masyarakat menghadapi banjir.'],
       ['Sistem peringatan dini', 'Menyiapkan sirine, pengeras suara, atau kentongan sebagai tanda bahaya.'],
       ['Persiapan evakuasi', 'Menyiapkan tempat dan jalur evakuasi serta tim pencarian dan penyelamatan.'],
     ]]],
    ['Apa yang dilakukan saat banjir terjadi?',
     ['Penanganan saat banjir berlangsung:', [
       ['Evakuasi', 'Memindahkan warga ke tempat aman dengan memprioritaskan kelompok rentan seperti anak-anak, lansia, dan ibu hamil.'],
       ['Koordinasi & penyelamatan', 'Koordinasi dengan pemerintah, masyarakat, PMI, dan SAR untuk pencarian serta penyelamatan korban.'],
       ['Pendataan & logistik', 'Mendata korban serta menyiapkan pengungsian, tenaga medis, dan kebutuhan logistik.'],
     ]]],
    ['Apa yang dilakukan setelah banjir surut?',
     ['Pemulihan setelah banjir meliputi:', [
       ['Analisis kerusakan', 'Mendata dan mendokumentasikan kerusakan untuk menentukan kebutuhan perbaikan.'],
       ['Pembersihan pasca banjir', 'Membersihkan lumpur, sampah, dan sisa material banjir untuk memulihkan kondisi lingkungan.'],
       ['Pemulihan & rekonstruksi', 'Memperbaiki infrastruktur terdampak serta memperoleh bantuan dari pihak terkait untuk mendukung pemulihan.'],
     ]]],
  ]],

  'mitigasi' => ['🛡️', 'Mitigasi', [
    ['Apa itu mitigasi banjir?',
     'Menurut UU No. 24 Tahun 2007, mitigasi adalah serangkaian upaya untuk mengurangi risiko bencana, baik melalui pembangunan fisik maupun penyadaran dan peningkatan kemampuan menghadapi ancaman bencana.'],
    ['Apa itu mitigasi struktural?',
     ['Mitigasi struktural adalah upaya mengurangi risiko bencana melalui pembangunan infrastruktur prasarana fisik dan rekayasa teknologi. Contohnya:', [
       ['Drainase & resapan', 'Saluran air diperbaiki, ditambah biopori dan sumur resapan supaya air hujan meresap ke tanah, bukan menggenang di jalan.'],
       ['Normalisasi sungai', 'Sungai dikeruk dari sedimentasi dan sampah agar kapasitas aliran kembali normal dan air tidak mudah meluap.'],
     ]]],
    ['Apa itu mitigasi non-struktural?',
     ['Mitigasi non-struktural adalah upaya pengurangan risiko melalui kebijakan, regulasi, dan edukasi kesiapsiagaan masyarakat. Contohnya:', [
       ['Konservasi daerah hulu', 'Penghijauan dan menjaga hutan membuat tanah mampu menyerap hujan, sehingga debit sungai di hilir tidak naik tiba-tiba.'],
       ['Edukasi & pengelolaan sampah', 'Masyarakat dilatih siaga bencana dan tidak membuang sampah ke saluran agar drainase tidak tersumbat.'],
     ]]],
    ['Bagaimana menyiapkan jalur evakuasi yang baik?',
     ['Jalur evakuasi yang baik memenuhi tiga hal:', [
       ['Tentukan titik aman', 'Pilih tempat yang lebih tinggi, tidak tergenang, dan mudah dijangkau warga, misalnya balai RT atau gedung bertingkat.'],
       ['Pasang rambu evakuasi', 'Jalur evakuasi ditandai jelas agar saat banjir datang warga tidak bingung harus ke mana.'],
       ['Prioritaskan kelompok rentan', 'Anak-anak, lansia, ibu hamil, dan penyandang disabilitas dievakuasi lebih dulu.'],
     ]]],
  ]],

  'darurat' => ['🚨', 'Tips Darurat', [
    ['Apa yang harus dilakukan saat banjir datang?',
     'Tetap tenang, matikan listrik dari meja sekring/MCB, amankan dokumen dan barang penting ke tempat tinggi, lalu segera menuju titik evakuasi jika air terus naik. Ikuti arahan petugas BPBD, SAR, atau aparat setempat.'],
    ['Bolehkah menerobos jalan yang tergenang?',
     'Sebaiknya jangan. Arus banjir bisa lebih kuat dari kelihatannya, dan kedalaman air tidak terlihat. Genangan juga bisa menyembunyikan lubang, kabel listrik, atau benda tajam.'],
    ['Siapa yang bisa dihubungi saat butuh bantuan?',
     'Hubungi 112 (layanan darurat), Basarnas 115, atau BNPB 117. Daftar lengkap nomor darurat dan posko ada di halaman Kontak Darurat. Saat menelepon, sebutkan nama, lokasi, jumlah orang, dan kondisi mereka.'],
    ['Apa saja isi tas siaga bencana?',
     'Dokumen penting dalam plastik kedap air, obat-obatan pribadi, senter dan baterai cadangan, power bank, air minum, makanan tahan lama, pakaian ganti, serta HP yang terisi penuh.'],
    ['Bagaimana mencegah penyakit pasca banjir?',
     'Gunakan sepatu boots dan sarung tangan saat membersihkan, cuci tangan dengan sabun, pakai air bersih untuk minum dan memasak, serta segera ke puskesmas bila muncul diare, demam, atau gatal-gatal.'],
  ]],

  'website' => ['💻', 'Tentang Website', [
    ['Apa fungsi SIMB Banjir?',
     'SIMB (Sistem Informasi Manajemen Bencana) Banjir menyediakan materi edukasi untuk mengenali, mencegah, dan mengurangi risiko bencana banjir, serta berita terkini, kontak darurat, dan fitur pencarian orang terdampak.'],
    ['Dari mana sumber data berita dan statistik?',
     'Statistik berasal dari BNPB, sedangkan berita diringkas ulang dari media seperti Beritasatu, ANTARA, dan BNPB. Klik kartu berita untuk membaca versi lengkapnya di sumber asli.'],
    ['Siapa yang membuat website ini?',
     ['Website ini disusun oleh Kelompok 1:', [
       ['Ahmad Solehman', '124250001'],
       ['Saeful Bahar', '124250009'],
       ['Deavera Nirwana', '124250015'],
       ['Najwa Alifa Ramadhani', '124250016'],
       ['Mahdiya Arkaris Putri', '124250017'],
     ]]],
  ]],
];

// ====== FILTER (pakai PHP, tanpa JavaScript) ======
$k = $_GET['k'] ?? 'semua';
if ($k !== 'semua' && !isset($faq[$k])) $k = 'semua';
$q = trim($_GET['q'] ?? '');

function teks_faq($a): string {
    if (!is_array($a)) return $a;
    $s = $a[0];
    foreach ($a[1] as [$l, $i]) $s .= ' ' . $l . ' ' . $i;
    return $s;
}

$tampil = [];   // kategori => daftar pertanyaan yang lolos filter
$total = 0;
foreach ($faq as $kunci => [$ikon, $judul, $qs]) {
    if ($k !== 'semua' && $k !== $kunci) continue;
    foreach ($qs as [$tanya, $jawab]) {
        if ($q !== '' && mb_stripos($tanya . ' ' . teks_faq($jawab), $q) === false) continue;
        $tampil[$kunci][] = [$tanya, $jawab];
        $total++;
    }
}
$semua = 0;
foreach ($faq as [, , $qs]) $semua += count($qs);

function url_faq(string $k, string $q): string {
    $p = [];
    if ($k !== 'semua') $p['k'] = $k;
    if ($q !== '') $p['q'] = $q;
    return 'faq.php' . ($p ? '?' . http_build_query($p) : '');
}

head('FAQ', 'faq'); ?>
<style>
  .faq-search{max-width:520px;margin:10px auto 6px;display:flex;gap:10px}
  .faq-search input{flex:1;padding:12px 16px;border-radius:10px;border:1px solid #334155;background:#0f172a;color:#fff;font:inherit;box-shadow:0 6px 18px rgba(2,10,24,.35)}
  .faq-search input:focus{outline:2px solid #38bdf8;border-color:#38bdf8}
  .faq-tabs a.tab{display:inline-block;text-decoration:none}
  .faq-tabs{margin-top:22px}
  .faq-cat{margin-top:34px}
  .faq-cat h3{margin-bottom:12px}
  /* kotak dibuat timbul: bayangan, garis aksen di kiri, dan naik sedikit saat disentuh */
  .faq-item{position:relative;background:linear-gradient(180deg,#13203a 0%,#0f172a 100%);border:1px solid #334155;border-left:4px solid #1e6fa0;border-radius:12px;margin-bottom:12px;overflow:hidden;box-shadow:0 8px 22px rgba(2,10,24,.45),inset 0 1px 0 rgba(255,255,255,.05);transition:transform .2s,border-color .2s,box-shadow .2s}
  .faq-item:hover{transform:translateY(-2px);border-color:#38bdf8;box-shadow:0 12px 28px rgba(2,10,24,.55)}
  .faq-item[open]{border-color:#38bdf8;border-left-color:#38bdf8;box-shadow:0 12px 30px rgba(2,10,24,.55),0 0 0 1px rgba(56,189,248,.25),0 0 22px rgba(56,189,248,.18)}
  .faq-item summary{cursor:pointer;list-style:none;padding:17px 20px;font-weight:600;color:#e2e8f0;display:flex;justify-content:space-between;align-items:center;gap:14px}
  .faq-item summary::-webkit-details-marker{display:none}
  .faq-item summary::after{content:'+';font-size:1.4rem;line-height:1;color:#38bdf8;flex-shrink:0;transition:transform .2s}
  .faq-item[open] summary::after{transform:rotate(45deg)}
  .faq-item summary:hover{color:#38bdf8}
  .faq-item[open] summary{color:#fff;border-bottom:1px solid rgba(56,189,248,.2);margin-bottom:14px}
  .faq-item .jawab{padding:0 20px 18px;color:#cbd5e1;line-height:1.7}
  .faq-item .jawab p{margin:0 0 8px}
  .faq-item .jawab ul{margin:6px 0 0;padding-left:20px}
  .faq-item .jawab li{margin-bottom:6px}
  .faq-item .jawab li b{color:#38bdf8}
  .faq-empty{text-align:center;color:#94a3b8;margin:30px 0}
  .faq-help{margin-top:46px;text-align:center}
</style>

<section class="pagehead" style="--img:url('assets/img/hujan.jpg')">
  <div><h1>Pertanyaan <em>Umum</em></h1><p class="sub"><?= $semua ?> pertanyaan seputar banjir · mengenali, mencegah, dan mengurangi risiko bencana</p></div>
</section>

<section class="wrap">
  <form method="get" action="faq.php" class="faq-search">
    <?php if ($k !== 'semua') echo '<input type="hidden" name="k" value="' . e($k) . '">'; ?>
    <input type="text" name="q" value="<?= e($q) ?>" placeholder="Cari pertanyaan, misalnya: evakuasi, rob, drainase...">
    <button type="submit" class="btn">Cari</button>
  </form>
  <p class="note center">
    <?php if ($q !== ''): ?>
      <?= $total ?> hasil untuk “<?= e($q) ?>” · <a href="<?= e(url_faq($k, '')) ?>">hapus pencarian</a>
    <?php else: ?>
      Pilih kategori atau klik pertanyaan untuk melihat jawabannya.
    <?php endif; ?>
  </p>

  <div class="tabs faq-tabs">
    <a class="tab <?= $k === 'semua' ? 'on' : '' ?>" href="<?= e(url_faq('semua', $q)) ?>">Semua</a>
    <?php foreach ($faq as $kunci => [$ikon, $judul]): ?>
      <a class="tab <?= $k === $kunci ? 'on' : '' ?>" href="<?= e(url_faq($kunci, $q)) ?>"><?= e($judul) ?></a>
    <?php endforeach; ?>
  </div>

  <?php foreach ($tampil as $kunci => $qs): [$ikon, $judul] = $faq[$kunci]; ?>
    <div class="faq-cat">
      <h3><?= $ikon ?> <?= e($judul) ?></h3>
      <?php foreach ($qs as [$tanya, $jawab]): ?>
        <details class="faq-item"<?= $q !== '' ? ' open' : '' ?>>
          <summary><?= e($tanya) ?></summary>
          <div class="jawab">
            <?php if (is_array($jawab)): ?>
              <p><?= e($jawab[0]) ?></p>
              <ul><?php foreach ($jawab[1] as [$lbl, $isi]) echo '<li><b>' . e($lbl) . '</b> — ' . e($isi) . '</li>'; ?></ul>
            <?php else: ?>
              <p><?= e($jawab) ?></p>
            <?php endif; ?>
          </div>
        </details>
      <?php endforeach; ?>
    </div>
  <?php endforeach; ?>

  <?php if ($total === 0): ?>
    <p class="faq-empty">Tidak ada pertanyaan yang cocok. Coba kata kunci lain atau <a href="faq.php">lihat semua</a>.</p>
  <?php endif; ?>

  <div class="faq-help">
    <h3>Butuh bantuan sekarang?</h3>
    <p class="note">Untuk kondisi darurat, langsung hubungi nomor di halaman Kontak Darurat.</p>
    <a class="btn" href="kontak.php">📞 Kontak Darurat</a>
    <a class="btn ghost" href="index.php#materi">📖 Pelajari Materi</a>
  </div>
</section>
<?php foot(); ?>