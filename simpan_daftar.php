<?php 
// koneksi database
include 'koneksi.php';

// menangkap data yang di kirim dari form
$nim = $_POST['nim'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = md5($_POST['password']);
$telp = $_POST['telp'];



// menginput data ke database
mysqli_query($koneksi,"insert into mahasiswa values('$nim','$nama','$username','$password','$telp')");

// mengalihkan halaman kembali ke index.php
header("location:log.php");

?>

