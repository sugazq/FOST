<?php
session_start();
include 'koneksi.php';

// Pastikan user sudah login
if (!isset($_SESSION['nim'])) {
    header("Location: log.php?pesan=belum_login");
    exit();
}

// Validasi input
if (!isset($_POST['id_pengaduan']) || !isset($_POST['tanggapan'])) {
    header("Location: laporan.php?pesan=gagal_tanggapan");
    exit();
}

$id_pengaduan = intval($_POST['id_pengaduan']); // Konversi ke integer untuk keamanan
$tanggapan = mysqli_real_escape_string($koneksi, $_POST['tanggapan']);
$tgl_tanggapan = date("Y-m-d H:i:s");
$nim = $_SESSION['nim']; // Nim mahasiswa yang menanggapi

// Query untuk memasukkan tanggapan ke database
$query = "INSERT INTO tanggapan (id_pengaduan, nim, tanggapan, tgl_tanggapan) 
          VALUES ('$id_pengaduan', '$nim', '$tanggapan', '$tgl_tanggapan')";

if (mysqli_query($koneksi, $query)) {
    header("Location: laporan.php?pesan=tanggapan_terkirim");
} else {
    header("Location: laporan.php?pesan=gagal_tanggapan");
}
exit();
?>
