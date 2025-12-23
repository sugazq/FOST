<?php
include 'koneksi.php';

// Cek apakah id_pengaduan ada di POST
if (!isset($_POST['id_pengaduan'])) {
    die("ID Pengaduan tidak ditemukan.");
}

$id_pengaduan = $_POST['id_pengaduan'];
$isi_laporan = $_POST['isi_laporan'];
$lokasi = $_POST['lokasi'];
$jenis = $_POST['jenis'];
$kategori = $_POST['kategori'];  // Ambil kategori dari form
$status = $_POST['status'];  // Ambil status dari form
$foto = $_FILES['foto']['name'];  // Ambil foto yang diupload

// Cek apakah ada foto baru yang diupload
if (!empty($_FILES['foto']['name'])) {

    $tmp  = $_FILES['foto']['tmp_name'];
    $size = $_FILES['foto']['size'];

    if ($size > 5 * 1024 * 1024) {
        echo "<script>alert('Ukuran foto maksimal 5MB');window.location='pengaduan.php';</script>";
        exit;
    }

    $info = getimagesize($tmp);
    if ($info === false) {
        echo "<script>alert('File bukan gambar valid');window.location='pengaduan.php';</script>";
        exit;
    }

    $mime = $info['mime'];
    $allowedMime = ['image/jpeg','image/png','image/webp','image/gif'];

    if (!in_array($mime, $allowedMime)) {
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
    $q = mysqli_query($koneksi, "SELECT foto FROM pengaduan WHERE id_pengaduan='$id_pengaduan'");
    $old = mysqli_fetch_assoc($q)['foto'];
    if ($old && file_exists('upload/'.$old)) {
        unlink('upload/'.$old);
    }

} else {
    // pakai foto lama
    $q = mysqli_query($koneksi, "SELECT foto FROM pengaduan WHERE id_pengaduan='$id_pengaduan'");
    $nama_foto_baru = mysqli_fetch_assoc($q)['foto'];
}

$latitude  = $_POST['latitude'] ?? null;
$longitude = $_POST['longitude'] ?? null;

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


// Update data pengaduan dengan kategori dan status
$query = "UPDATE pengaduan SET isi_laporan = '$isi_laporan', lokasi = '$lokasi', jenis = '$jenis', kategori = '$kategori', status = '$status', foto = '$nama_foto_baru' WHERE id_pengaduan = '$id_pengaduan'";
$result = mysqli_query($koneksi, $query);

if ($result) {
    // Jika status adalah 'Selesai', pindahkan ke tabel riwayat
    if ($status == 'Selesai') {
        // Pindahkan data ke tabel riwayat
        $query_riwayat = "INSERT INTO riwayat (nim, isi_laporan, lokasi, jenis, kategori, tgl_pengaduan, foto, status) 
                          SELECT nim, isi_laporan, lokasi, jenis, kategori, tgl_pengaduan, foto, status 
                          FROM pengaduan 
                          WHERE id_pengaduan = '$id_pengaduan'";
        mysqli_query($koneksi, $query_riwayat);

        // Hapus pengaduan dari tabel pengaduan
        $query_hapus = "DELETE FROM pengaduan WHERE id_pengaduan = '$id_pengaduan'";
        mysqli_query($koneksi, $query_hapus);
    }

    echo "<script>alert('Data pengaduan berhasil diperbarui!');window.location='pengaduan.php';</script>";
} else {
    echo "<script>alert('Gagal memperbarui data pengaduan. Silakan coba lagi.');window.location='pengaduan.php';</script>";
}
?>