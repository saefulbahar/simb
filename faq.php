<?php
require 'inc.php';

// ====== DATA FAQ ======
// Struktur: kategori => [ikon, judul, daftar [pertanyaan, jawaban]]
// Jawaban bisa berupa teks biasa, atau array [pengantar, [[judul, isi], ...]] untuk daftar poin.
// Tambah pertanyaan baru: salin satu baris [pertanyaan, jawaban] ke kategori yang sesuai.
$faq = [
  'website' => ['💻', 'Seputar Website', [
    ['Apa fungsi RuangSiaga?',
     'RuangSiaga (Sistem Informasi Manajemen Bencana Banjir) menyediakan materi edukasi untuk mengenali, mencegah, dan mengurangi risiko bencana banjir, serta berita terkini, kontak darurat, dan fitur pencarian orang terdampak.'],
    ['Dari mana sumber data berita dan statistik?',
     'Statistik berasal dari BNPB, sedangkan berita diringkas ulang dari media seperti Beritasatu, ANTARA, dan BNPB. Klik kartu berita untuk membaca versi lengkapnya di sumber asli.'],
    ['Seberapa sering berita dan statistik diperbarui?',
     'Data diperbarui secara berkala oleh pengelola, dan tanggal pembaruan terakhir tertera di halaman Berita Terkini. Untuk informasi yang paling baru, cek langsung situs BNPB dan BMKG.'],
    ['Siapa yang membuat website ini?',
     ['Website ini disusun oleh Kelompok 1:', [
       ['Ahmad Solehman', '124250001'],
       ['Saeful Bahar', '124250009'],
       ['Deavera Nirwana', '124250015'],
       ['Najwa Alifa Ramadhani', '124250016'],
       ['Mahdiya Arkaris Putri', '124250017'],
     ]]],
  ]],

  'finding' => ['🔎', 'Finding Orang', [
    ['Bagaimana cara mencari orang yang terdampak banjir?',
     'Buka halaman Finding Orang, lalu ketik nama, lokasi terakhir, atau alamat di kolom cari. Klik nama atau tombol Lihat Detail untuk melihat usia, alamat, kontak keluarga, dan ciri-cirinya.'],
    ['Bagaimana cara melaporkan orang yang hilang?',
     'Isi formulir Tambah Data Orang Hilang di bagian bawah halaman Finding Orang. Hanya nama yang wajib diisi, tetapi makin lengkap usia, lokasi terakhir, kontak keluarga, alamat, dan ciri-ciri, makin mudah orang tersebut dikenali.'],
    ['Apa arti status pada data orang?',
     ['Setiap data punya salah satu dari empat status:', [
       ['Hilang', 'Keberadaan orang tersebut belum diketahui.'],
       ['Ditemukan', 'Sudah ditemukan dan diketahui keberadaannya.'],
       ['Mengungsi', 'Berada di tempat pengungsian atau posko.'],
       ['Dirawat', 'Sedang mendapat perawatan medis.'],
     ]]],
    ['Ciri-ciri apa yang sebaiknya ditulis?',
     'Tulis hal yang mudah dikenali: pakaian terakhir yang dipakai, perkiraan tinggi badan, tanda khusus seperti tato atau tahi lalat, serta aksesori seperti kacamata atau jam tangan.'],
    ['Apakah melapor lewat website cukup?',
     'Belum. Laporan di website membantu penyebaran informasi, tetapi tetap hubungi Basarnas 115 atau layanan darurat 112 dan lapor ke posko terdekat agar pencarian segera dilakukan petugas.'],
  ]],

  'pantau' => ['🛰️', 'Pantau Banjir', [
    ['Apa arti status Aman, Siaga, dan Awas?',
     ['Status banjir menunjukkan seberapa dekat tinggi air dengan batas aman:', [
       ['Aman', 'Tinggi air masih di bawah batas siaga. Kondisi normal.'],
       ['Siaga', 'Air mulai mendekati batas. Pantau terus dan siapkan barang penting.'],
       ['Awas', 'Air sudah melewati batas aman. Risiko banjir tinggi, bersiap mengungsi.'],
     ]]],
    ['Kapan saya harus mulai mengungsi?',
     'Mulai bersiap saat status Siaga, dan segera mengungsi saat status Awas atau saat petugas menyarankannya. Jangan menunggu air masuk ke rumah, karena arus bisa naik dengan cepat.'],
  ]],

  'darurat' => ['🚨', 'Saat Darurat', [
    ['Apa yang harus dilakukan saat banjir datang?',
     'Tetap tenang, matikan listrik dari meja sekring/MCB, amankan dokumen dan barang penting ke tempat tinggi, lalu segera menuju titik evakuasi jika air terus naik. Ikuti arahan petugas BPBD, SAR, atau aparat setempat.'],
    ['Bolehkah menerobos jalan yang tergenang?',
     'Sebaiknya jangan. Arus banjir bisa lebih kuat dari kelihatannya, dan kedalaman air tidak terlihat. Genangan juga bisa menyembunyikan lubang, kabel listrik, atau benda tajam.'],
    ['Siapa yang bisa dihubungi saat butuh bantuan?',
     'Hubungi 112 (layanan darurat), Basarnas 115, atau BNPB 117. Daftar lengkap nomor darurat dan posko ada di halaman Kontak Darurat. Saat menelepon, sebutkan nama, lokasi, jumlah orang, dan kondisi mereka.'],
    ['Apa saja isi tas siaga bencana?',
     'Dokumen penting dalam plastik kedap air, obat-obatan pribadi, senter dan baterai cadangan, power bank, air minum, makanan tahan lama, pakaian ganti, serta HP yang terisi penuh.'],
  ]],

  'pencegahan' => ['🛡️', 'Pencegahan', [
    ['Bagaimana menanggulangi banjir di daerah pesisir atau perairan?',
     ['Di wilayah pesisir dan perairan, salah satu upaya yang efektif adalah menanam pohon mangrove (bakau). Manfaatnya:', [
       ['Meredam gelombang', 'Akar dan batang mangrove menahan hantaman ombak dan air pasang sebelum sampai ke permukiman, sehingga membantu mengurangi banjir rob.'],
       ['Mencegah abrasi', 'Akarnya yang rapat mengikat tanah dan lumpur sehingga garis pantai tidak mudah terkikis.'],
       ['Menahan sedimen', 'Endapan tertahan di sekitar akar, sehingga pesisir lebih stabil dan wilayah daratan lebih terlindungi.'],
       ['Menjaga ekosistem', 'Mangrove menjadi tempat hidup ikan, udang, kepiting, dan burung, sehingga juga mendukung mata pencaharian warga pesisir.'],
     ]]],
    ['Apa yang bisa saya lakukan sebagai warga untuk mencegah banjir?',
     'Jangan buang sampah ke sungai atau saluran, bersihkan selokan secara rutin, buat biopori atau sumur resapan, tanam pohon, dan ikut kerja bakti serta pelatihan siaga bencana.'],
    ['Bagaimana menyiapkan rencana evakuasi keluarga?',
     'Sepakati titik kumpul yang aman dan lebih tinggi, hafalkan jalur menuju ke sana, simpan nomor darurat di HP dan di kertas, siapkan tas siaga, lalu pastikan semua anggota keluarga tahu rencananya, terutama anak-anak dan lansia.'],
  ]],

  'setelah' => ['🧹', 'Setelah Banjir', [
    ['Apa yang harus dilakukan setelah air surut?',
     'Pastikan bangunan aman sebelum masuk, jangan menyalakan listrik sebelum diperiksa, bersihkan lumpur dan sampah, lalu dokumentasikan kerusakan untuk pelaporan dan bantuan.'],
    ['Bagaimana mencegah penyakit pasca banjir?',
     'Gunakan sepatu boots dan sarung tangan saat membersihkan, cuci tangan dengan sabun, pakai air bersih untuk minum dan memasak, serta segera ke puskesmas bila muncul diare, demam, atau gatal-gatal.'],
    ['Bagaimana cara melapor kerusakan atau meminta bantuan?',
     'Laporkan ke RT/RW atau kelurahan, lalu ke BPBD setempat. Siapkan foto kerusakan dan data anggota keluarga yang terdampak.'],
  ]],
];

// Warna penanda untuk poin yang berupa status (selain itu pakai warna biru default)
$warna_status = [
  'aman' => '#16a34a', 'siaga' => '#d97706', 'awas' => '#dc2626',
  'hilang' => '#dc2626', 'ditemukan' => '#16a34a', 'mengungsi' => '#2563eb', 'dirawat' => '#7c3aed',
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
  .faq-page{--navy:#0f2240;--blue:#1d6fe0;--blue-soft:#eaf1fd;--sky:#1ea7f0;--ink:#1e293b;--muted:#64748b;--line:#e2e8f0;--bg:#f3f6fb;
    background:var(--bg);color:var(--ink);padding-bottom:70px}
  .faq-page a{text-decoration:none}

  /* ---------- Band judul ---------- */
  .faq-band{background:var(--navy);padding:34px 0 62px!important}
  .faq-band .wrap,.faq-main{padding-top:0!important;padding-bottom:0!important}
  .faq-crumb{font-size:.92rem;color:#cbd5e1;margin-bottom:14px}
  .faq-crumb a{color:var(--sky)}
  .faq-crumb span{margin:0 8px;color:#64748b}
  .faq-band h1{margin:0;color:#fff;font-size:clamp(1.9rem,4vw,2.5rem);font-weight:700;line-height:1.15}
  .faq-band p{margin:8px 0 0;color:#cbd5e1;font-size:1.05rem}

  /* ---------- Kartu cari (menimpa band) ---------- */
  .faq-top{margin-top:-36px;position:relative;z-index:2;display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:20px 32px;
    background:#fff;border:1px solid var(--line);border-left:6px solid var(--blue);border-radius:14px;padding:24px 30px;box-shadow:0 10px 30px rgba(15,34,64,.12)}
  .faq-top .txt{flex:1 1 320px}
  .faq-top h2{margin:0 0 4px;font-size:1.45rem;color:var(--ink)}
  .faq-top .txt p{margin:0;color:var(--muted);line-height:1.6}
  .faq-top .txt p a{color:var(--blue);font-weight:600}
  .faq-search{flex:1 1 420px;max-width:560px;display:flex;gap:10px;margin:0}
  .faq-search input{flex:1;min-width:0;padding:13px 16px;border:1px solid #cbd5e1;border-radius:10px;background:#f8fafc;color:var(--ink);font:inherit;transition:border-color .2s,box-shadow .2s,background .2s}
  .faq-search input::placeholder{color:#94a3b8}
  .faq-search input:focus{outline:none;background:#fff;border-color:var(--blue);box-shadow:0 0 0 4px rgba(29,111,224,.15)}
  .fq-btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:12px 22px;border:1px solid transparent;border-radius:10px;background:var(--blue);color:#fff;font:inherit;font-weight:600;cursor:pointer;white-space:nowrap;transition:background .2s,transform .15s,box-shadow .2s}
  .fq-btn:hover{background:#1558b8;transform:translateY(-1px);box-shadow:0 6px 14px rgba(29,111,224,.3)}
  .fq-btn.red{background:#e53935}.fq-btn.red:hover{background:#c62828;box-shadow:0 6px 14px rgba(229,57,53,.3)}
  .fq-btn.ghost{background:#fff;color:var(--ink);border-color:var(--line)}
  .fq-btn.ghost:hover{background:#f8fafc;box-shadow:none;border-color:#cbd5e1}

  /* ---------- Tata letak ---------- */
  .faq-layout{display:grid;grid-template-columns:270px minmax(0,1fr);gap:30px;align-items:start;margin-top:34px}

  /* Sidebar kategori */
  .faq-side{position:sticky;top:96px;display:grid;gap:10px}
  .faq-side .cat{display:flex;align-items:center;gap:12px;padding:12px 14px;background:#fff;border:1px solid var(--line);border-radius:14px;color:var(--ink);transition:border-color .2s,box-shadow .2s,transform .15s}
  .faq-side .cat:hover{border-color:#bfd3f5;transform:translateX(2px);box-shadow:0 6px 16px rgba(15,34,64,.08)}
  .faq-side .cat .tile{width:40px;height:40px;flex-shrink:0;display:grid;place-items:center;border-radius:10px;background:var(--blue-soft);font-size:1.15rem}
  .faq-side .cat .t{display:flex;flex-direction:column;line-height:1.3;font-weight:600}
  .faq-side .cat small{font-weight:400;color:var(--muted);font-size:.82rem}
  .faq-side .cat.on{border-color:var(--blue);box-shadow:0 0 0 1px var(--blue),0 8px 20px rgba(29,111,224,.15)}
  .faq-side .cat.on .tile{background:var(--blue);filter:none}
  .faq-side .cat.on .t{color:var(--blue)}

  /* ---------- Judul seksi ---------- */
  .faq-sec{margin-bottom:38px}
  .faq-sec:last-child{margin-bottom:0}
  .sec-title{position:relative;display:flex;align-items:baseline;justify-content:space-between;gap:12px;margin:0 0 18px;padding-bottom:10px;border-bottom:2px solid var(--line);font-size:1.4rem;font-weight:700;color:var(--ink)}
  .sec-title::after{content:'';position:absolute;left:0;bottom:-2px;width:90px;height:2px;background:var(--blue)}
  .sec-title small{font-size:.82rem;font-weight:500;color:var(--muted)}

  /* ---------- Kartu pertanyaan ---------- */
  .faq-item{background:#fff;border:1px solid var(--line);border-radius:14px;margin-bottom:12px;box-shadow:0 1px 2px rgba(15,34,64,.04);transition:border-color .2s,box-shadow .2s}
  .faq-item:hover{border-color:#bfd3f5;box-shadow:0 6px 18px rgba(15,34,64,.08)}
  .faq-item[open]{border-color:var(--blue);box-shadow:0 10px 26px rgba(29,111,224,.14)}
  .faq-item summary{cursor:pointer;list-style:none;display:flex;align-items:center;gap:14px;padding:16px 18px;font-weight:600;line-height:1.45;color:var(--ink)}
  .faq-item summary::-webkit-details-marker{display:none}
  .faq-item summary::before{content:'?';flex-shrink:0;width:38px;height:38px;display:grid;place-items:center;border-radius:10px;background:var(--blue-soft);color:var(--blue);font-weight:700;font-size:1.1rem}
  .faq-item summary .q{flex:1}
  .faq-item summary::after{content:'';flex-shrink:0;width:9px;height:9px;margin:0 6px 4px 0;border-right:2px solid var(--muted);border-bottom:2px solid var(--muted);transform:rotate(45deg);transition:transform .25s,border-color .2s}
  .faq-item[open] summary{color:var(--blue)}
  .faq-item[open] summary::before{background:var(--blue);color:#fff}
  .faq-item[open] summary::after{transform:rotate(225deg) translate(-2px,-2px);border-color:var(--blue)}
  .faq-item summary:focus-visible{outline:2px solid var(--blue);outline-offset:-2px;border-radius:14px}

  .faq-item .jawab{margin:0 18px 0 70px;padding:0 0 20px;color:#475569;line-height:1.75;animation:faqIn .25s ease}
  .faq-item .jawab p{margin:0 0 10px}
  .faq-item .jawab p:last-child{margin-bottom:0}
  @keyframes faqIn{from{opacity:0;transform:translateY(-4px)}to{opacity:1;transform:none}}

  .faq-item .jawab ul{list-style:none;margin:12px 0 0;padding:0;display:grid;gap:8px}
  .faq-item .jawab li{--c:var(--blue);display:flex;flex-direction:column;gap:2px;padding:10px 14px;border-radius:10px;background:#f8fafc;border:1px solid var(--line);border-left:4px solid var(--c)}
  .faq-item .jawab li b{color:var(--c);font-size:.95rem}
  .faq-item .jawab li span{color:#475569;font-size:.93rem;line-height:1.6}
  @media(min-width:700px){
    .faq-item .jawab li{flex-direction:row;gap:14px;align-items:baseline}
    .faq-item .jawab li b{flex:0 0 170px}
  }

  /* ---------- Kosong & bantuan ---------- */
  .faq-empty{text-align:center;color:var(--muted);padding:36px 20px;background:#fff;border:1px dashed #cbd5e1;border-radius:14px}
  .faq-empty a{color:var(--blue);font-weight:600}

  .faq-help{margin-top:44px;display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:18px 30px;
    background:#fff;border:1px solid var(--line);border-left:6px solid #e53935;border-radius:14px;padding:24px 30px;box-shadow:0 6px 20px rgba(15,34,64,.08)}
  .faq-help .txt{flex:1 1 320px}
  .faq-help h3{margin:0 0 4px;font-size:1.35rem;color:var(--ink)}
  .faq-help p{margin:0;color:var(--muted);line-height:1.6}
  .faq-help .acts{display:flex;flex-wrap:wrap;gap:10px}

  /* ---------- Responsif ---------- */
  @media(max-width:900px){
    .faq-layout{grid-template-columns:1fr;gap:24px}
    .faq-side{position:static;display:flex;overflow-x:auto;gap:8px;padding-bottom:6px;scrollbar-width:thin}
    .faq-side .cat{flex-shrink:0;padding:8px 14px 8px 8px}
    .faq-side .cat small{display:none}
    .faq-side .cat .tile{width:32px;height:32px;font-size:1rem}
  }
  @media(max-width:600px){
    .faq-band{padding:24px 0 54px!important}
    .faq-top,.faq-help{padding:20px 18px}
    .faq-search{flex-wrap:wrap;max-width:none}
    .faq-search input{flex-basis:100%}
    .faq-search .fq-btn{flex:1}
    .faq-item summary{padding:14px;gap:12px}
    .faq-item .jawab{margin:0 14px 0 14px}
  }
  @media(prefers-reduced-motion:reduce){.faq-page *{transition:none!important;animation:none!important}}
</style>

<div class="faq-page">
  <div class="faq-band">
    <div class="wrap">
      <div class="faq-crumb"><a href="index.php">Beranda</a><span>/</span>FAQ</div>
      <h1>Pertanyaan Umum</h1>
      <p><?= $semua ?> pertanyaan seputar website, fitur, dan keselamatan saat banjir.</p>
    </div>
  </div>

  <div class="wrap faq-main">
    <div class="faq-top">
      <div class="txt">
        <h2>Cari jawaban dengan cepat</h2>
        <p>
          <?php if ($q !== ''): ?>
            <?= $total ?> hasil untuk “<?= e($q) ?>” · <a href="<?= e(url_faq($k, '')) ?>">hapus pencarian</a>
          <?php else: ?>
            Ketik kata kunci atau pilih kategori di bawah, lalu klik pertanyaan untuk melihat jawabannya.
          <?php endif; ?>
        </p>
      </div>
      <form method="get" action="faq.php" class="faq-search" role="search">
        <?php if ($k !== 'semua') echo '<input type="hidden" name="k" value="' . e($k) . '">'; ?>
        <input type="text" name="q" value="<?= e($q) ?>" placeholder="Contoh: mangrove, status, tas siaga..." aria-label="Cari pertanyaan">
        <button type="submit" class="fq-btn">🔍 Cari</button>
      </form>
    </div>

    <div class="faq-layout">
      <nav class="faq-side" aria-label="Kategori FAQ">
        <a class="cat <?= $k === 'semua' ? 'on' : '' ?>" href="<?= e(url_faq('semua', $q)) ?>">
          <span class="tile">📚</span>
          <span class="t">Semua<small><?= $semua ?> pertanyaan</small></span>
        </a>
        <?php foreach ($faq as $kunci => [$ikon, $judul, $qs_]): ?>
          <a class="cat <?= $k === $kunci ? 'on' : '' ?>" href="<?= e(url_faq($kunci, $q)) ?>">
            <span class="tile"><?= $ikon ?></span>
            <span class="t"><?= e($judul) ?><small><?= count($qs_) ?> pertanyaan</small></span>
          </a>
        <?php endforeach; ?>
      </nav>

      <div class="faq-list">
        <?php foreach ($tampil as $kunci => $qs): [$ikon, $judul] = $faq[$kunci]; ?>
          <div class="faq-sec">
            <h3 class="sec-title"><span><?= e($judul) ?></span><small><?= count($qs) ?> pertanyaan</small></h3>
            <?php foreach ($qs as [$tanya, $jawab]): ?>
              <details class="faq-item"<?= $q !== '' ? ' open' : '' ?>>
                <summary><span class="q"><?= e($tanya) ?></span></summary>
                <div class="jawab">
                  <?php if (is_array($jawab)): ?>
                    <p><?= e($jawab[0]) ?></p>
                    <ul>
                      <?php foreach ($jawab[1] as [$lbl, $isi]):
                          $c = $warna_status[mb_strtolower($lbl)] ?? ''; ?>
                        <li<?= $c ? ' style="--c:' . $c . '"' : '' ?>><b><?= e($lbl) ?></b><span><?= e($isi) ?></span></li>
                      <?php endforeach; ?>
                    </ul>
                  <?php else: ?>
                    <p><?= e($jawab) ?></p>
                  <?php endif; ?>
                </div>
              </details>
            <?php endforeach; ?>
          </div>
        <?php endforeach; ?>

        <?php if ($total === 0): ?>
          <p class="faq-empty">😕 Tidak ada pertanyaan yang cocok.<br>Coba kata kunci lain atau <a href="faq.php">lihat semua</a>.</p>
        <?php endif; ?>
      </div>
    </div>

    <div class="faq-help">
      <div class="txt">
        <h3>Butuh bantuan sekarang?</h3>
        <p>Untuk kondisi darurat, langsung hubungi nomor di halaman Kontak Darurat. Layanan 112 aktif 24 jam.</p>
      </div>
      <div class="acts">
        <a class="fq-btn red" href="tel:112">📞 Telepon 112</a>
        <a class="fq-btn" href="kontak.php">Kontak Darurat</a>
        <a class="fq-btn ghost" href="index.php#materi">📖 Pelajari Materi</a>
      </div>
    </div>
  </div>
</div>
<?php foot(); ?>