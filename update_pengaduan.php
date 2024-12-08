<?php
include 'koneksi.php';

// Ambil data dari form
$id_pengaduan = $_POST['id_pengaduan'];
$isi_laporan = $_POST['isi_laporan'];
$lokasi = $_POST['lokasi'];
$jenis = $_POST['jenis'];
$kategori = $_POST['kategori'];  // Ambil kategori dari form
$foto = $_FILES['foto']['name'];  // Ambil foto yang diupload

// Cek apakah ada foto baru yang diupload
if ($foto != "") {
    // Jika ada foto baru, proses upload seperti biasa
    $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
    $x = explode('.', $foto);
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['foto']['tmp_name'];

    if (in_array($ekstensi, $ekstensi_diperbolehkan)) {
        $nama_foto_baru = rand(1, 999) . '-' . $foto;
        move_uploaded_file($file_tmp, 'upload/' . $nama_foto_baru);

        // Hapus foto lama jika ada
        $query_foto_lama = "SELECT foto FROM pengaduan WHERE id_pengaduan = '$id_pengaduan'";
        $result_foto = mysqli_query($koneksi, $query_foto_lama);
        $data_foto_lama = mysqli_fetch_assoc($result_foto);
        $foto_lama = $data_foto_lama['foto'];

        if ($foto_lama && file_exists('upload/' . $foto_lama)) {
            unlink('upload/' . $foto_lama);  // Hapus foto lama
        }
    } else {
        echo "<script>alert('Ekstensi gambar hanya boleh jpg, jpeg, atau png!');window.location='pengaduan.php';</script>";
        exit();
    }
} else {
    // Jika tidak ada foto baru, gunakan foto lama
    $query_foto_lama = "SELECT foto FROM pengaduan WHERE id_pengaduan = '$id_pengaduan'";
    $result_foto = mysqli_query($koneksi, $query_foto_lama);
    $data_foto_lama = mysqli_fetch_assoc($result_foto);
    $nama_foto_baru = $data_foto_lama['foto'];  // Gunakan foto lama
}

// Update data pengaduan dengan kategori
$query = "UPDATE pengaduan SET isi_laporan = '$isi_laporan', lokasi = '$lokasi', jenis = '$jenis', kategori = '$kategori', foto = '$nama_foto_baru' WHERE id_pengaduan = '$id_pengaduan'";
$result = mysqli_query($koneksi, $query);

if ($result) {
    echo "<script>alert('Pengaduan berhasil diperbarui!');window.location='pengaduan.php';</script>";
} else {
    echo "Gagal memperbarui pengaduan.";
}
?>
