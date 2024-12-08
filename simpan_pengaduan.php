<?php
include 'koneksi.php';


// Mengatur zona waktu ke Jakarta (WIB)
date_default_timezone_set('Asia/Jakarta');

// Ambil data dari form
$nim = $_POST['nim'];
$username = $_POST['username'];
$kategori = $_POST['kategori']; // Mendapatkan kategori yang dipilih
$isi_laporan = $_POST['isi_laporan'];
$lokasi = $_POST['lokasi'];
$jenis = $_POST['jenis'];
$tgl_pengaduan = date('Y-m-d H:i:s');
$foto = $_FILES['foto']['name'];  // Ambil nama foto yang diupload

// Cek apakah ada foto yang diupload
if ($foto != "") {
    $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
    $x = explode('.', $foto);
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['foto']['tmp_name'];
    
    if (in_array($ekstensi, $ekstensi_diperbolehkan)) {
        // Tentukan nama file yang akan disimpan di server
        $nama_foto_baru = rand(1, 999) . '-' . $foto;  // Nama file acak
        move_uploaded_file($file_tmp, 'upload/' . $nama_foto_baru);  // Simpan file
    } else {
        echo "<script>alert('Ekstensi gambar hanya boleh jpg, jpeg, atau png!');window.location='pengaduan.php';</script>";
        exit();
    }
} else {
    // Jika tidak ada foto yang diupload, set foto menjadi null
    $nama_foto_baru = null;
}

// Query untuk menyimpan laporan
$query = "INSERT INTO pengaduan (tgl_pengaduan, nim, username, kategori, isi_laporan, lokasi, jenis, foto) 
          VALUES ('$tgl_pengaduan', '$nim', '$username', '$kategori', '$isi_laporan', '$lokasi', '$jenis', '$nama_foto_baru')";


$result = mysqli_query($koneksi, $query);

if ($result) {
    echo "<script>alert('Pengaduan berhasil disimpan!');window.location='pengaduan.php';</script>";
} else {
    echo "Gagal menyimpan data pengaduan.";
}
?>
