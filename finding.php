<?php
include 'inc.php';
include 'dba.php';
head('Finding Orang', 'finding');

$conn = db();
$pesan = '';

// simpan data
if (isset($_POST['simpan'])) {
    $nama     = $_POST['nama'];
    $usia     = $_POST['usia'];
    $jk       = $_POST['jenis_kelamin'];
    $alamat   = $_POST['alamat'];
    $ciri     = $_POST['ciri'];
    $kontak   = $_POST['kontak'];
    $lokasi   = $_POST['lokasi_terakhir'];
    $status   = $_POST['status'];

    $sql = "INSERT INTO orang (nama, usia, jenis_kelamin, alamat, ciri, kontak, lokasi_terakhir, status) 
            VALUES ('$nama', '$usia', '$jk', '$alamat', '$ciri', '$kontak', '$lokasi', '$status')";
    mysqli_query($conn, $sql);
    $pesan = "Data berhasil disimpan!";
}

// Pencarian
$cari = isset($_GET['q']) ? $_GET['q'] : "";

if ($cari != "") {
    $sql = "SELECT * FROM orang WHERE nama LIKE '%$cari%' OR lokasi_terakhir LIKE '%$cari%' OR alamat LIKE '%$cari%' ORDER BY id DESC";
} else {
    $sql = "SELECT * FROM orang ORDER BY id DESC";
}
$hasil = mysqli_query($conn, $sql);
?>

<section class="wrap">
    <h2 class="center">Pencarian Orang Terdampak <em>Banjir</em></h2>

    <?php if ($pesan != "") { ?>
        <p class="center" style="color:#4ade80; font-weight:bold;"><?= $pesan ?></p>
    <?php } ?>

    <!-- Form Cari -->
    <form method="get" style="max-width:500px; margin:20px auto; display:flex; gap:10px;">
        <input type="text" name="q" placeholder="Cari nama atau lokasi..." value="<?= $cari ?>" 
               style="flex:1; padding:12px; border-radius:8px; border:1px solid #334155; background:#0f172a; color:#fff;">
        <button type="submit" class="btn">Cari</button>
    </form>

    <div style="overflow-x:auto; margin:30px 0; background:#0f172a; border-radius:12px; padding:10px; border:1px solid #334155;">
        <div style="max-height:320px; overflow-y:auto;">
            <table style="width:100%; border-collapse:collapse; color:#e2e8f0;">
                <thead style="position:sticky; top:0; background:#1e293b; z-index:1;">
                    <tr>
                        <th style="padding:14px; text-align:left; border-bottom:2px solid #334155;">Nama</th>
                        <th style="padding:14px; text-align:left; border-bottom:2px solid #334155;">Status</th>
                        <th style="padding:14px; text-align:left; border-bottom:2px solid #334155;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 0;
                    while ($row = mysqli_fetch_assoc($hasil)) { 
                        $no++;
                    ?>
                        <tr style="border-bottom:1px solid #334155;">
                            <td style="padding:14px;">
                                <a href="javascript:void(0)" onclick="toggleDetail('detail<?= $no ?>')" 
                                   style="color:#38bdf8; text-decoration:none; font-weight:bold;">
                                    <?= $row['nama'] ?>
                                </a>
                            </td>
                            <td style="padding:14px;"><?= $row['status'] ?></td>
                            <td style="padding:14px;">
                                <button type="button" onclick="toggleDetail('detail<?= $no ?>')" class="btn" style="padding:6px 14px; font-size:14px;">
                                    Lihat Detail
                                </button>
                            </td>
                        </tr>
                        <!-- Baris Detail -->
                        <tr id="detail<?= $no ?>" style="display:none; background:#1e293b;">
                            <td colspan="3" style="padding:16px 20px;">
                                <p><b>Usia:</b> <?= $row['usia'] ?> tahun</p>
                                <p><b>Jenis Kelamin:</b> <?= $row['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan' ?></p>
                                <p><b>Lokasi Terakhir:</b> <?= $row['lokasi_terakhir'] ?></p>
                                <p><b>Alamat:</b> <?= $row['alamat'] ?></p>
                                <p><b>Kontak:</b> <?= $row['kontak'] ?></p>
                                <p><b>Ciri-ciri:</b> <?= $row['ciri'] ?></p>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <hr style="border-color:#334155; margin:40px 0;">

    <!-- Form Tambah Data -->
    <h3 class="center">Tambah Data Orang Hilang</h3>
    <form method="post" style="max-width:600px; margin:20px auto; display:grid; gap:12px;">
        <input type="text" name="nama" placeholder="Nama lengkap *" required 
               style="padding:10px; border-radius:8px; border:1px solid #334155; background:#0f172a; color:#fff;">
        <input type="number" name="usia" placeholder="Usia" 
               style="padding:10px; border-radius:8px; border:1px solid #334155; background:#0f172a; color:#fff;">
        <select name="jenis_kelamin" style="padding:10px; border-radius:8px; border:1px solid #334155; background:#0f172a; color:#fff;">
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
        </select>
        <input type="text" name="lokasi_terakhir" placeholder="Lokasi terakhir" 
               style="padding:10px; border-radius:8px; border:1px solid #334155; background:#0f172a; color:#fff;">
        <input type="text" name="kontak" placeholder="Kontak keluarga" 
               style="padding:10px; border-radius:8px; border:1px solid #334155; background:#0f172a; color:#fff;">
        <input type="text" name="alamat" placeholder="Alamat" 
               style="padding:10px; border-radius:8px; border:1px solid #334155; background:#0f172a; color:#fff;">
        <select name="status" style="padding:10px; border-radius:8px; border:1px solid #334155; background:#0f172a; color:#fff;">
            <option value="hilang">Hilang</option>
            <option value="ditemukan">Ditemukan</option>
            <option value="mengungsi">Mengungsi</option>
            <option value="dirawat">Dirawat</option>
        </select>
        <textarea name="ciri" placeholder="Ciri-ciri" rows="3" 
                  style="padding:10px; border-radius:8px; border:1px solid #334155; background:#0f172a; color:#fff;"></textarea>
        <button type="submit" name="simpan" class="btn">Simpan Data</button>
    </form>
</section>

<script>
function toggleDetail(id) {
    var el = document.getElementById(id);
    if (el.style.display === "none" || el.style.display === "") {
        el.style.display = "table-row";
    } else {
        el.style.display = "none";
    }
}
</script>

<?php foot(); ?>