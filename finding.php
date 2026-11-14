<?php
include 'inc.php';
include 'dba.php';
head('Finding Orang', 'finding');

$conn = db();
$pesan = '';

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

$cari = isset($_GET['q']) ? $_GET['q'] : "";

if ($cari != "") {
    $sql = "SELECT * FROM orang WHERE nama LIKE '%$cari%' OR lokasi_terakhir LIKE '%$cari%' OR alamat LIKE '%$cari%' ORDER BY id DESC";
} else {
    $sql = "SELECT * FROM orang ORDER BY id DESC";
}
$hasil = mysqli_query($conn, $sql);

function badge($status) {
    $map = [
        'hilang'     => ['#ef4444', '#fff', 'Hilang'],
        'mengungsi'  => ['#eab308', '#000', 'Mengungsi'],
        'ditemukan'  => ['#22c55e', '#fff', 'Ditemukan'],
        'dirawat'    => ['#3b82f6', '#fff', 'Dirawat']
    ];
    $d = $map[$status] ?? ['#64748b', '#fff', ucfirst($status)];
    return '<span style="background:'.$d[0].'; color:'.$d[1].'; padding:5px 12px; border-radius:20px; font-size:12px; font-weight:600;">'.$d[2].'</span>';
}
?>

<section class="wrap" style="max-width:1000px; margin:0 auto; padding:30px 20px;">
    <h1 style="font-size:32px; font-weight:700; margin-bottom:8px;">Pencarian Orang Terdampak Banjir</h1>
    <p style="color:#94a3b8; margin-bottom:30px;">Cari data orang terdampak banjir berdasarkan nama, lokasi, atau status.</p>

    <?php if ($pesan) { ?>
        <div style="background:#166534; color:#bbf7d0; padding:12px 16px; border-radius:10px; margin-bottom:20px; text-align:center;">
            <?= $pesan ?>
        </div>
    <?php } ?>

    <!-- Search -->
    <form method="get" style="display:flex; gap:12px; margin-bottom:30px;">
        <input type="text" name="q" value="<?= htmlspecialchars($cari) ?>" placeholder="Masukkan nama, lokasi, atau kata kunci..."
               style="flex:1; padding:14px 18px; border-radius:12px; border:1px solid #334155; background:#0f172a; color:#fff; font-size:15px;">
        <button type="submit" class="btn" style="padding:14px 32px; border-radius:12px; font-weight:600;">Cari</button>
    </form>

    <!-- List -->
    <div style="background:#0f172a; border:1px solid #1e293b; border-radius:16px; overflow:hidden; margin-bottom:40px;">
        <div style="max-height:450px; overflow-y:auto;">
            <table style="width:100%; border-collapse:collapse;">
                <thead>
                    <tr style="background:#1e293b; color:#94a3b8; font-size:13px; text-transform:uppercase; letter-spacing:0.5px;">
                        <th style="padding:16px 20px; text-align:left;">Nama</th>
                        <th style="padding:16px 20px; text-align:left;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=0; while ($row = mysqli_fetch_assoc($hasil)) { $no++; 
                        $inisial = strtoupper(substr(trim($row['nama']), 0, 2));
                    ?>
                        <tr onclick="toggleDetail('d<?= $no ?>')" style="border-bottom:1px solid #1e293b; cursor:pointer;">
                            <td style="padding:18px 20px;">
                                <div style="display:flex; align-items:center; gap:14px;">
                                    <div style="width:42px; height:42px; background:#1e40af; border-radius:50%; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:14px; color:#fff;">
                                        <?= $inisial ?>
                                    </div>
                                    <div>
                                        <div style="font-weight:600; color:#e2e8f0; font-size:16px;"><?= htmlspecialchars($row['nama']) ?></div>
                                        <div style="color:#64748b; font-size:13px; margin-top:2px;"><?= htmlspecialchars($row['lokasi_terakhir'] ?: 'Lokasi tidak diketahui') ?></div>
                                    </div>
                                </div>
                            </td>
                            <td style="padding:18px 20px; vertical-align:middle;">
                                <?= badge($row['status']) ?>
                            </td>
                        </tr>
                        <tr id="d<?= $no ?>" style="display:none; background:#111827;">
                            <td colspan="2" style="padding:16px 20px 20px 76px; color:#cbd5e1; font-size:14px; line-height:1.7;">
                                <div><b>Usia:</b> <?= $row['usia'] ?> tahun</div>
                                <div><b>Jenis Kelamin:</b> <?= $row['jenis_kelamin']=='L'?'Laki-laki':'Perempuan' ?></div>
                                <div><b>Alamat:</b> <?= htmlspecialchars($row['alamat']) ?></div>
                                <div><b>Kontak:</b> <?= htmlspecialchars($row['kontak']) ?></div>
                                <div><b>Ciri-ciri:</b> <?= htmlspecialchars($row['ciri']) ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Form Tambah Data -->
    <div style="background:#0f172a; border:1px solid #1e293b; border-radius:16px; padding:28px;">
        <h3 style="margin:0 0 6px; font-size:22px; color:#38bdf8;">Tambah Data Orang</h3>
        <p style="color:#64748b; margin:0 0 24px; font-size:14px;">Tambahkan data orang baru yang terdampak banjir.</p>

        <form method="post" style="display:grid; gap:18px;">
            <div>
                <label style="display:block; font-size:13px; color:#94a3b8; margin-bottom:6px;">Nama Lengkap *</label>
                <input type="text" name="nama" required placeholder="Masukkan nama lengkap"
                       style="width:100%; padding:14px; border-radius:10px; border:1px solid #334155; background:#020617; color:#fff; font-size:15px;">
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                <div>
                    <label style="display:block; font-size:13px; color:#94a3b8; margin-bottom:6px;">Usia</label>
                    <input type="number" name="usia" placeholder="Usia"
                           style="width:100%; padding:14px; border-radius:10px; border:1px solid #334155; background:#020617; color:#fff;">
                </div>
                <div>
                    <label style="display:block; font-size:13px; color:#94a3b8; margin-bottom:6px;">Jenis Kelamin</label>
                    <select name="jenis_kelamin" style="width:100%; padding:14px; border-radius:10px; border:1px solid #334155; background:#020617; color:#fff;">
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                <div>
                    <label style="display:block; font-size:13px; color:#94a3b8; margin-bottom:6px;">Lokasi Terakhir</label>
                    <input type="text" name="lokasi_terakhir" placeholder="Lokasi terakhir diketahui"
                           style="width:100%; padding:14px; border-radius:10px; border:1px solid #334155; background:#020617; color:#fff;">
                </div>
                <div>
                    <label style="display:block; font-size:13px; color:#94a3b8; margin-bottom:6px;">Kontak Keluarga</label>
                    <input type="text" name="kontak" placeholder="Nomor telepon keluarga"
                           style="width:100%; padding:14px; border-radius:10px; border:1px solid #334155; background:#020617; color:#fff;">
                </div>
            </div>

            <div>
                <label style="display:block; font-size:13px; color:#94a3b8; margin-bottom:6px;">Alamat</label>
                <input type="text" name="alamat" placeholder="Alamat lengkap"
                       style="width:100%; padding:14px; border-radius:10px; border:1px solid #334155; background:#020617; color:#fff;">
            </div>

            <div>
                <label style="display:block; font-size:13px; color:#94a3b8; margin-bottom:6px;">Status</label>
                <select name="status" style="width:100%; padding:14px; border-radius:10px; border:1px solid #334155; background:#020617; color:#fff;">
                    <option value="hilang">Hilang</option>
                    <option value="mengungsi">Mengungsi</option>
                    <option value="ditemukan">Ditemukan</option>
                    <option value="dirawat">Dirawat</option>
                </select>
            </div>

            <div>
                <label style="display:block; font-size:13px; color:#94a3b8; margin-bottom:6px;">Ciri-ciri</label>
                <textarea name="ciri" rows="4" placeholder="Ciri-ciri fisik atau pakaian yang dikenakan..."
                          style="width:100%; padding:14px; border-radius:10px; border:1px solid #334155; background:#020617; color:#fff; resize:vertical;"></textarea>
            </div>

            <div style="text-align:right; margin-top:8px;">
                <button type="submit" name="simpan" class="btn" style="padding:14px 40px; border-radius:10px; font-weight:600; font-size:15px;">
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
</section>

<script>
function toggleDetail(id) {
    const el = document.getElementById(id);
    el.style.display = (el.style.display === 'none' || el.style.display === '') ? 'table-row' : 'none';
}
</script>

<?php foot(); ?>