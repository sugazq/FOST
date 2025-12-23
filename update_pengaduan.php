<?php
include 'koneksi.php';

// ================= VALIDASI ID =================
if (!isset($_POST['id_pengaduan'])) {
    die("ID Pengaduan tidak ditemukan.");
}

// ================= AMBIL DATA =================
$id_pengaduan = $_POST['id_pengaduan'];
$isi_laporan  = $_POST['isi_laporan'];
$lokasi       = $_POST['lokasi'];
$jenis        = $_POST['jenis'];
$kategori     = $_POST['kategori'];
$status       = $_POST['status'];

$latitude  = $_POST['latitude'] ?? '';
$longitude = $_POST['longitude'] ?? '';

// ================= VALIDASI LOKASI =================
if (
    empty($latitude) ||
    empty($longitude) ||
    !is_numeric($latitude) ||
    !is_numeric($longitude)
) {
    echo "<script>
        alert('Data lokasi tidak valid. Pastikan koordinat tersedia.');
        window.location='pengaduan.php';
    </script>";
    exit;
}

// ================= FOTO =================
$nama_foto_baru = null;

// cek foto lama
$qOld = mysqli_query($koneksi, "SELECT foto FROM pengaduan WHERE id_pengaduan='$id_pengaduan'");
$dataOld = mysqli_fetch_assoc($qOld);
$foto_lama = $dataOld['foto'] ?? null;

if (!empty($_FILES['foto']['name'])) {

    $tmp  = $_FILES['foto']['tmp_name'];
    $size = $_FILES['foto']['size'];

    // max 5MB
    if ($size > 5 * 1024 * 1024) {
        echo "<script>alert('Ukuran foto maksimal 5MB');window.location='pengaduan.php';</script>";
        exit;
    }

    // validasi MIME
    $info = getimagesize($tmp);
    if ($info === false) {
        echo "<script>alert('File bukan gambar valid');window.location='pengaduan.php';</script>";
        exit;
    }

    $mime = $info['mime'];
    $allowed = ['image/jpeg','image/png','image/webp','image/gif'];

    if (!in_array($mime, $allowed)) {
        echo "<script>alert('Format gambar tidak didukung');window.location='pengaduan.php';</script>";
        exit;
    }

    switch ($mime) {
        case 'image/jpeg': $ext = '.jpg'; break;
        case 'image/png':  $ext = '.png'; break;
        case 'image/webp': $ext = '.webp'; break;
        case 'image/gif':  $ext = '.gif'; break;
    }

    $nama_foto_baru = uniqid('pengaduan_', true) . $ext;
    move_uploaded_file($tmp, 'upload/' . $nama_foto_baru);

    // hapus foto lama
    if ($foto_lama && file_exists('upload/' . $foto_lama)) {
        unlink('upload/' . $foto_lama);
    }

} else {
    // tidak ganti foto
    $nama_foto_baru = $foto_lama;
}

// ================= UPDATE DATABASE =================
$query = "UPDATE pengaduan SET
    isi_laporan = '$isi_laporan',
    lokasi = '$lokasi',
    latitude = '$latitude',
    longitude = '$longitude',
    jenis = '$jenis',
    kategori = '$kategori',
    status = '$status',
    foto = '$nama_foto_baru'
WHERE id_pengaduan = '$id_pengaduan'";

$result = mysqli_query($koneksi, $query);

// ================= HASIL =================
if ($result) {

    // pindah ke riwayat jika selesai
    if ($status === 'Selesai') {

        mysqli_query($koneksi, "
            INSERT INTO riwayat 
            (nim, isi_laporan, lokasi, latitude, longitude, jenis, kategori, tgl_pengaduan, foto, status)
            SELECT 
                nim, isi_laporan, lokasi, latitude, longitude, jenis, kategori, tgl_pengaduan, foto, status
            FROM pengaduan
            WHERE id_pengaduan = '$id_pengaduan'
        ");

        mysqli_query($koneksi, "DELETE FROM pengaduan WHERE id_pengaduan = '$id_pengaduan'");
    }

    echo "<script>alert('Data pengaduan berhasil diperbarui!');window.location='pengaduan.php';</script>";
} else {
    echo "<script>alert('Gagal memperbarui data.');window.location='pengaduan.php';</script>";
}
?>
