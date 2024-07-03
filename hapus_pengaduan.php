<?php 
// koneksi database
include 'koneksi.php';

// menangkap data id yang di kirim dari url
$id_pengaduan = $_GET['id_pengaduan'];


// menghapus data dari database
mysqli_query($koneksi,"delete from pengaduan where id_pengaduan='$id_pengaduan'");

// mengalihkan halaman kembali ke index.php
header("location:pengaduan.php");

?>