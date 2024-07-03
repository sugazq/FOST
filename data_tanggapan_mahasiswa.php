<?php 
session_start();
if($_SESSION['status']!="login"){
  header("location:log.php?pesan=belum_login");
}

$current_nim = $_SESSION['nim']; // Simpan 'nim' dalam variabel
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
  <link rel="icon" type="assets/dist/img/logo.png" href="assets/dist/img/logo.png">
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
              <a href="data_tanggapan_masyarakat.php" class="nav-link">Tanggapan</a>
            </li>
          </ul>
        </div>

        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
          <li class="nav-item dropdown">
            <a class="nav-link" href="logout.php" onclick="return confirm('Yakin Mau Keluar!!!')">
              <i class="fas fa-user"></i> Keluar
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="content-wrapper">
      <div class="content-header">
        <div class="container">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Sistem Pengaduan Warga Informatika</h1>
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
                  <h5 class="card-title m-0">Data Tanggapan</h5>
                </div>
                <div class="card-header">
                  <form class="d-flex" role="search" action="" method="POST">
                    <input class="form-control col-3" type="search" placeholder="Search" aria-label="Search" name="key" autocomplete="off">
                    <button class="btn btn-outline-warning form-control col-1" type="submit" name="cari">Search</button>
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
                      </tr>
                    </thead>
                    <tbody class="text-center">
                      <?php
                      $no = 1;
                      include "koneksi.php";
                      
                      // tombol cari
                      if (isset($_POST['cari'])) {
                        $keyword = addslashes($_POST['key']);
                        $q = "SELECT * FROM tanggapan 
                              INNER JOIN pengaduan ON tanggapan.id_pengaduan = pengaduan.id_pengaduan 
                              INNER JOIN petugas ON tanggapan.id_petugas = petugas.id_petugas 
                              WHERE (tanggapan.tanggapan LIKE '%$keyword%' OR tgl_tanggapan LIKE '%$keyword%')
                              AND pengaduan.nim = '$current_nim'
                              ORDER BY id_tanggapan DESC";
                      } else {
                        $q = "SELECT * FROM tanggapan 
                              INNER JOIN pengaduan ON tanggapan.id_pengaduan = pengaduan.id_pengaduan 
                              INNER JOIN petugas ON tanggapan.id_petugas = petugas.id_petugas 
                              WHERE pengaduan.nim = '$current_nim'
                              ORDER BY id_tanggapan DESC";
                      }
                      
                      $catatan = mysqli_query($koneksi, $q);
                      while ($d = mysqli_fetch_array($catatan)) {
                      ?>
                        <tr>
                          <td><?php echo $no++; ?></td>
                          <td class="text-center">
                            <a href="" data-toggle="modal" data-target="#modal-view-foto<?php echo $d['id_pengaduan']; ?>"><img src="upload/<?=$d['foto']?>" width="150"></a><br>
                          </td>
                          <td><?=$d['tanggapan']?></td>
                          <td><?=$d['tgl_tanggapan']?></td>
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
                              <div class="modal-body">
                                <div class="text-center">
                                  <img src="upload/<?=$d['foto']?>" width="300">
                                </div><hr>
                                <div class="card-body">
                                  <div class="text-center">
                                    <?=$d['isi_laporan']?>
                                  </div>
                                </div>                                
                              </div>
                              <div class="modal-footer justify-content-between"> 
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
            </div>
          </div>
        </div>
      </div>
    </div>

    <aside class="control-sidebar control-sidebar-dark">
    </aside>

    <footer class="main-footer">
      <div class="float-right d-none d-sm-inline">
      </div>
      <strong>Copyright &copy;  <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
  </div>

  <!-- REQUIRED SCRIPTS -->
  <script src="assets/plugins/jquery/jquery.min.js"></script>
  <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/dist/js/adminlte.min.js"></script>
</body>
</html>
