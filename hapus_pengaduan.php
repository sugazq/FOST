<?php 
// Koneksi database
include 'koneksi.php';

// Periksa apakah ID dikirim melalui URL
if (!isset($_GET['id_pengaduan']) || empty($_GET['id_pengaduan'])) {
    echo "ID Pengaduan tidak ditemukan.";
    exit();
}

// Tangkap ID pengaduan
$id_pengaduan = $_GET['id_pengaduan'];

// Escape karakter untuk mencegah SQL Injection
$id_pengaduan = mysqli_real_escape_string($koneksi, $id_pengaduan);

// Query untuk mendapatkan nama foto
$query_foto = "SELECT foto FROM pengaduan WHERE id_pengaduan='$id_pengaduan'";
$result_foto = mysqli_query($koneksi, $query_foto);
$row_foto = mysqli_fetch_assoc($result_foto);

// Cek apakah foto ada dan file tersebut ada di folder upload
if ($row_foto && !empty($row_foto['foto'])) {
    $foto_lama = 'upload/' . $row_foto['foto'];
    if (file_exists($foto_lama)) {
        unlink($foto_lama);  // Hapus foto dari folder
    }
}

// Menghapus data dari database
$query = "DELETE FROM pengaduan WHERE id_pengaduan='$id_pengaduan'";
if (mysqli_query($koneksi, $query)) {
    // Redirect jika berhasil
    header("Location: pengaduan.php");
    exit();
} else {
    // Tampilkan pesan error jika gagal
    echo "Error: " . mysqli_error($koneksi);
    exit();
}
?>
