<?php
session_start();
if ($_SESSION['status'] != "login") {
    header("location:log.php?pesan=belum_login");
}
include 'koneksi.php'; // Pastikan Anda menghubungkan ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_pengaduan = $_POST['id_pengaduan'];
    $status = $_POST['status'];

    // Update status pengaduan di database
    $query = "UPDATE pengaduan SET status='$status' WHERE id='$id_pengaduan'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("location: pengaduan.php?pesan=update_berhasil");
    } else {
        header("location: pengaduan.php?pesan=update_gagal");
    }
}
?>