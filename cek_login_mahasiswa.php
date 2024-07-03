<?php 
// mengaktifkan session php
session_start();

// menghubungkan dengan koneksi
include 'koneksi.php';

// menangkap data yang dikirim dari form
$username = addslashes( $_POST['username']);
$password = md5($_POST['password']);

// menyeleksi data admin dengan username dan password yang sesuai
$data = mysqli_query($koneksi,"select * from mahasiswa where username='$username' and password='$password'");

// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);

// if($cek > 0){
// 	$_SESSION['username'] = $username;
// 	$_SESSION['nim'] = $nim;
// 	$_SESSION['nama'] = $nama;
// 	$_SESSION['status'] = "login";
// 	header("location:pengaduan.php");
// }else{
// 	header("location:log.php?pesan=gagal");
// }

if($cek > 0){
    $row = mysqli_fetch_assoc($data); // Mendapatkan baris data dari hasil query
    $_SESSION['username'] = $username;
    $_SESSION['nim'] = $row['nim']; // Menggunakan nilai 'nim' dari baris data
    $_SESSION['nama'] = $row['nama']; // Menggunakan nilai 'nama' dari baris data
    $_SESSION['status'] = "login";
    header("location:pengaduan.php");
} else {
    header("location:log.php?pesan=gagal");
}
?>
