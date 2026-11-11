<?php
// ====== DATA BERITA (ringkasan ditulis ulang, baca selengkapnya di link sumber) ======
// Data per 11 November 2026. Tambah berita baru cukup menyalin satu blok array di bawah.
$statistik = [['620','Kejadian banjir di 2026'],['70','Korban meninggal'],['49','Luka-luka'],['4.900+','Rumah rusak']];
$statistik_sumber = 'BNPB melalui Beritasatu, data 1 Januari – 10 November 2026';

$berita = [
 ['ikon'=>'📊','tag'=>'Nasional','waktu'=>'10 Nov 2026','judul'=>'BNPB: 620 Kejadian Banjir Tercatat Sepanjang 2026',
  'ringkas'=>'Banjir menjadi bencana dengan jumlah kejadian terbanyak tahun ini. Korban meninggal mencapai 70 orang, 49 orang luka-luka, dan lebih dari 4.900 rumah mengalami kerusakan.',
  'sumber'=>'Beritasatu','url'=>'https://www.beritasatu.com/nasional/3040130/bnpb-catat-620-banjir-sepanjang-2026-70-orang-meninggal'],
 ['ikon'=>'⛰️','tag'=>'Sumatera','waktu'=>'9 Nov 2026','judul'=>'Banjir Susulan Hambat Pemulihan di Aceh, Sumut, dan Sumbar',
  'ringkas'=>'Mendagri menyebut ada 41 kejadian banjir susulan di tiga provinsi itu selama April–Oktober 2026. Sebanyak 137 sungai ikut terdampak dan menyulitkan penanganan.',
  'sumber'=>'ANTARA','url'=>'https://www.antaranews.com/berita/5842607/mendagri-banjir-susulan-hambat-penanganan-bencana-di-sumatera'],
 ['ikon'=>'🧹','tag'=>'Sumatera Barat','waktu'=>'7 Nov 2026','judul'=>'Banjir Padang Pariaman Surut, Warga Mulai Bersihkan Lumpur',
  'ringkas'=>'Luapan sungai merendam sekitar 81 rumah, dua rumah ibadah, dan 20 hektare lahan pertanian. Jalan provinsi Padang–Pasaman Barat sempat terganggu, kini lalu lintas kembali normal.',
  'sumber'=>'BNPB','url'=>'https://www.bnpb.go.id/berita/perkembangan-situasi-dan-penanganan-bencana-di-tanah-air-7-november-2026'],
 ['ikon'=>'🛟','tag'=>'Nasional','waktu'=>'6 Nov 2026','judul'=>'Polri Siagakan Personel dan Anjing Pelacak Hadapi Bencana Akhir Tahun',
  'ringkas'=>'Sebanyak 305 personel gabungan, termasuk unit K9, disiapkan untuk mengantisipasi banjir dan tanah longsor menjelang akhir 2026.',
  'sumber'=>'Okezone','url'=>'https://www.okezone.com/tag/banjir'],
 ['ikon'=>'🌊','tag'=>'Pesisir','waktu'=>'Peringatan 2–17 Nov 2026','judul'=>'BMKG Ingatkan Potensi Banjir Rob di 18 Wilayah Pesisir',
  'ringkas'=>'Fase Bulan Baru pada 9 November 2026 meningkatkan pasang maksimum air laut sehingga banjir rob berpotensi terjadi di sejumlah wilayah pesisir hingga 17 November.',
  'sumber'=>'Beritasatu','url'=>'https://www.beritasatu.com/nusantara/3038386/banjir-rob-landa-18-wilayah-hingga-17-november-2026'],
 ['ikon'=>'🌧️','tag'=>'Jawa Timur','waktu'=>'2–3 Nov 2026','judul'=>'Lumajang dan Malang Dilanda Banjir Akibat Hujan Deras',
  'ringkas'=>'Hujan lebat memicu sungai meluap, tanggul jebol, dan longsor di Lumajang. Di Malang, banjir melanda empat kecamatan: Ampelgading, Bantur, Pagelaran, dan Sumbermanjing Wetan.',
  'sumber'=>'BNPB','url'=>'https://www.bnpb.go.id/berita/perkembangan-situasi-dan-penanganan-bencana-di-tanah-air-3-november-2026'],
 ['ikon'=>'🚨','tag'=>'Sumatera','waktu'=>'2 Nov 2026','judul'=>'Banjir Bandang Terjang Tiga Provinsi di Sumatera',
  'ringkas'=>'BNPB melaporkan banjir di Sumbar, Sumut, dan Aceh. Di Langkat, 3.157 KK terdampak. Aceh Selatan menetapkan status tanggap darurat 30 Oktober–12 November 2026.',
  'sumber'=>'RCTI+','url'=>'https://rctiplus.com/news/detail/nasional/5507697/banjir-bandang-terjang-3-provinsi-di-sumatera-ribuan-warga-terdampak'],
 ['ikon'=>'🏞️','tag'=>'Sumatera Barat','waktu'=>'1–2 Nov 2026','judul'=>'Banjir Bandang Rendam Rumah dan Kolam Ikan di Tanah Datar',
  'ringkas'=>'Banjir bandang di Nagari Pandai Sikek, Kecamatan X Koto, berdampak pada 15 rumah, 15 hektare lahan pertanian, dan 20 kolam ikan menurut data sementara.',
  'sumber'=>'IDN Times','url'=>'https://www.idntimes.com/news/indonesia/bnpb-catat-2-278-bencana-terjadi-di-indonesia-hingga-2-november-2026-00-3m8tp-f313nz'],
];

// ====== VIDEO ======
// 1) Video YouTube: isi ID video (huruf/angka setelah "v=" pada link YouTube), contoh ['id'=>'AbCdEfGhIjK','judul'=>'Judul video']
$video_youtube = [
  // ['id'=>'ISI_ID_VIDEO','judul'=>'Judul video banjir'],
];
// 2) Video lokal: taruh file MP4 di assets/video/banjir.mp4, otomatis tampil
$video_lokal = 'assets/video/banjir.mp4';
// 3) Kanal berita yang rutin menayangkan video banjir
$kanal = [
  ['📺','ANTARA TV','Video liputan bencana dan banjir dari kantor berita ANTARA','https://www.youtube.com/@AntaraTV'],
  ['📺','Liputan6','Liputan dan detik-detik kejadian banjir di berbagai daerah','https://www.youtube.com/@liputan6_news'],
  ['📺','Metro TV','Siaran berita dan laporan lapangan banjir terkini','https://www.youtube.com/user/metrotvnews'],
  ['🔎','Cari di YouTube','Hasil pencarian “banjir bandang terbaru”','https://www.youtube.com/results?search_query=banjir+bandang+terbaru'],
];
