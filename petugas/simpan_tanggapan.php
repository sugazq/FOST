<?php 
// koneksi database
include '../koneksi.php';

// menangkap data yang di kirim dari form
$id_pengaduan = $_POST['id_pengaduan'];
$tgl_tanggapan = date('Y-m-d');
$laporan = $_POST['laporan'];
$id_petugas = $_POST['id_petugas'];
$status = $_POST['status'];

// menginput data ke database
mysqli_query($koneksi,"insert into tanggapan values('','$id_pengaduan','$tgl_tanggapan','$laporan','$id_petugas')");
mysqli_query($koneksi,"update pengaduan set status='$status' where id_pengaduan='$id_pengaduan'");
// mengalihkan halaman kembali ke index.php
header("location:data_pengaduan.php");

?>