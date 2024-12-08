<?php
session_start();
include 'koneksi.php'; // Pastikan file koneksi diimpor

if ($_SESSION['status'] != "login") {
    header("location:log.php?pesan=belum_login");
    exit;
}

$current_nim = $_SESSION['nim']; // Mendapatkan 'nim' dari sesi

// Proses penyimpanan tanggapan
if (isset($_POST['submit_tanggapan'])) {
    if (isset($_GET['id_pengaduan']) && !empty($_GET['id_pengaduan'])) {
        $id_pengaduan = $_GET['id_pengaduan']; // Ambil ID pengaduan dari URL
        $tanggapan = mysqli_real_escape_string($koneksi, $_POST['tanggapan']); // Amankan input
        $status = mysqli_real_escape_string($koneksi, $_POST['status']); // Amankan input status
        
        // Query untuk memasukkan data tanggapan ke dalam tabel tanggapan_pengaduan
        $query = "INSERT INTO tanggapan_pengaduan (id_pengaduan, tanggapan, tgl_tanggapan, status, nim_penanggap)
                  VALUES ('$id_pengaduan', '$tanggapan', NOW(), '$status', '$current_nim')";
        
        if (mysqli_query($koneksi, $query)) {
            echo "<script>alert('Tanggapan berhasil dikirim!');</script>";
            // Redirect agar tidak mengirim ulang data saat refresh
            header("Location: tanggapan_pengaduan.php?id_pengaduan=$id_pengaduan");
            exit; // Menghentikan eksekusi skrip
        } else {
            echo "<script>alert('Error: " . mysqli_error($koneksi) . "');</script>";
        }
    } else {
        echo "<script>alert('ID pengaduan tidak ditemukan.');</script>";
    }
}

if (basename($_SERVER['PHP_SELF']) == 'tanggapan_pengaduan.php') {
  if (isset($_GET['id_pengaduan'])) {
      $id_pengaduan = $_GET['id_pengaduan'];
  } else {
      // Tangani jika ID pengaduan tidak ada di URL
      echo "<script>alert('ID Pengaduan tidak ditemukan!');</script>";
      exit;
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SiPeKa</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="icon" type="image/png" href="assets/dist/img/logo.png">
</head>
<body class="hold-transition layout-top-nav">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
      <div class="container">
        <a href="" class="navbar-brand">
          <img src="assets/dist/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">SiPeKa</span>
        </a>
        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="pengaduan.php" class="nav-link">Tulis Pengaduan</a>
            </li>
            <li class="nav-item">
              <a href="tanggapan_pengaduan.php" class="nav-link">Tanggapan Pengaduan</a>
            </li>
            <li class="nav-item">
              <a href="laporan.php" class="nav-link">Laporan Pengaduan</a>
            </li>
          </ul>
        </div>
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
          <li class="nav-item dropdown">
            <a class="nav-link" href="logout.php" onclick="return confirm('Yakin Mau Keluar?')">
              <i class="fas fa-user"></i> Keluar
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
      <div class="content-header">
        <div class="container">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Sistem Pengaduan Barang Hilang dan Penemuan</h1>
            </div>
          </div>
        </div>
      </div>
      <div class="content">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="card card-warning card-outline">
                <div class="card-header">
                  <form class="d-flex" role="search" action="" method="POST">
                    <select class="form-control col-3" name="status">
                      <option value="">-- Pilih Status --</option>
                      <option value="menunggu">Menunggu</option>
                      <option value="proses">Proses</option>
                      <option value="selesai">Selesai</option>
                    </select>
                    <button class="btn btn-outline-warning form-control col-1" type="submit" name="cari">Cari</button>
                  </form>
                </div>
                <div class="card-body">
                  <table class="table table-bordered">
                    <thead class="table table-warning text-center">
                      <tr>
                        <th style="width: 10px">#</th>
                        <th style="width: 100px">Foto</th>
                        <th>Isi Tanggapan</th>
                        <th style="width: 200px">Tanggal Tanggapan</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody class="text-center">
                      <?php
                      $no = 1;
                      include "koneksi.php";
                      
                      if (isset($_POST['cari'])) {
                        $status = addslashes($_POST['status']);
                        if ($status != "") {
                          $q = "SELECT * FROM tanggapan_pengaduan 
                                INNER JOIN pengaduan ON tanggapan_pengaduan.id_pengaduan = pengaduan.id_pengaduan 
                                WHERE pengaduan.nim = '$current_nim' AND tanggapan_pengaduan.status = '$status'
                                ORDER BY id_tanggapan DESC";
                        } else {
                          $q = "SELECT * FROM tanggapan_pengaduan 
                                INNER JOIN pengaduan ON tanggapan_pengaduan.id_pengaduan = pengaduan.id_pengaduan 
                                WHERE pengaduan.nim = '$current_nim'
                                ORDER BY id_tanggapan DESC";
                        }
                      } else {
                        $q = "SELECT * FROM tanggapan_pengaduan 
                              INNER JOIN pengaduan ON tanggapan_pengaduan.id_pengaduan = pengaduan.id_pengaduan 
                              WHERE pengaduan.nim = '$current_nim'
                              ORDER BY id_tanggapan DESC";
                      }
                      
                      $catatan = mysqli_query($koneksi, $q);
                      while ($d = mysqli_fetch_array($catatan)) {
                      ?>
                        <tr>
                          <td><?php echo $no++; ?></td>
                          <td class="text-center">
                            <a href="" data-toggle="modal" data-target="#modal-view-foto<?php echo $d['id_pengaduan']; ?>"><img src="upload/<?=$d['foto']?>" width="150"></a>
                          </td>
                          <td><?=$d['tanggapan']?></td>
                          <td><?=$d['tgl_tanggapan']?></td>
                          <td><?=$d['status']?></td>
                        </tr>
                        <div class="modal fade" id="modal-view-foto<?php echo $d['id_pengaduan']; ?>">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">Foto Pengaduan</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body text-center">
                                <img src="upload/<?=$d['foto']?>" width="300"><hr>
                                <p><?=$d['isi_laporan']?></p>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-warning" data-dismiss="modal">Keluar</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      <?php 
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>

              <!-- Form untuk tanggapan pengaduan -->
              <form method="POST" action="tanggapan_pengaduan.php?id_pengaduan=<?php echo $d['id_pengaduan']; ?>">
                  <textarea class="form-control" name="tanggapan" required></textarea>
                  <select class="form-control" name="status">
                      <option value="menunggu">Menunggu</option>
                      <option value="proses">Proses</option>
                      <option value="selesai">Selesai</option>
                  </select>
                  <button type="submit" class="btn btn-success mt-2" name="submit_tanggapan" onclick="alert('Tanggapan sedang dikirim');">Kirim Tanggapan</button>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>

    <footer class="main-footer">
      <strong>Copyright &copy; <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
  </div>

  <script src="assets/plugins/jquery/jquery.min.js"></script>
  <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/dist/js/adminlte.min.js"></script>
</body>
</html>
