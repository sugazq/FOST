<?php
include 'koneksi.php';
date_default_timezone_set('Asia/Jakarta');

// Ambil data
$nim          = $_POST['nim'];
$username     = $_POST['username'];
$kategori     = $_POST['kategori'];
$isi_laporan  = $_POST['isi_laporan'];
$lokasi       = $_POST['lokasi'];
$latitude     = $_POST['latitude'];
$longitude    = $_POST['longitude'];
$jenis        = $_POST['jenis'];
$tgl_pengaduan = date('Y-m-d H:i:s');

// VALIDASI LOKASI (LAT & LNG)
if (
    empty($latitude) || 
    empty($longitude) || 
    !is_numeric($latitude) || 
    !is_numeric($longitude) ||
    ($latitude == 0 && $longitude == 0)
) {
    echo "<script>
        alert('Lokasi belum dipilih. Silakan tentukan titik lokasi pada peta.');
        window.location='pengaduan.php';
    </script>";
    exit;
}

// Upload foto
$nama_foto_baru = NULL;

if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {

    $tmp  = $_FILES['foto']['tmp_name'];
    $size = $_FILES['foto']['size'];

    // batas 5MB
    if ($size > 5 * 1024 * 1024) {
        echo "<script>alert('Ukuran foto maksimal 5MB');window.location='pengaduan.php';</script>";
        exit;
    }

    // validasi MIME (AMAN)
    $info = getimagesize($tmp);
    if ($info === false) {
        echo "<script>alert('File bukan gambar valid');window.location='pengaduan.php';</script>";
        exit;
    }

    $mime = $info['mime'];

    $allowedMime = [
        'image/jpeg', // jpg, jpeg, jfif
        'image/png',
        'image/webp',
        'image/gif'
    ];

    if (!in_array($mime, $allowedMime)) {
        echo "<script>alert('Format gambar tidak didukung');window.location='pengaduan.php';</script>";
        exit;
    }

    // normalisasi ekstensi
    switch ($mime) {
        case 'image/jpeg': $ext = '.jpg'; break;
        case 'image/png':  $ext = '.png'; break;
        case 'image/webp': $ext = '.webp'; break;
        case 'image/gif':  $ext = '.gif'; break;
    }

    $nama_foto_baru = uniqid('pengaduan_', true) . $ext;
    move_uploaded_file($tmp, 'upload/' . $nama_foto_baru);
}


// INSERT DATABASE
$query = "INSERT INTO pengaduan 
(tgl_pengaduan, nim, username, kategori, isi_laporan, lokasi, latitude, longitude, jenis, foto)
VALUES
('$tgl_pengaduan','$nim','$username','$kategori','$isi_laporan','$lokasi','$latitude','$longitude','$jenis','$nama_foto_baru')";

$result = mysqli_query($koneksi, $query);

if ($result) {
    echo "<script>alert('Pengaduan berhasil disimpan');window.location='pengaduan.php';</script>";
} else {
    echo "Error: ".mysqli_error($koneksi);
}
?>
