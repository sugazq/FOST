<?php 
session_start();

  // cek apakah yang mengakses halaman ini sudah login
if($_SESSION['level']==""){
  header("location:../login.php?info=login");
}
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SiPeKa</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="icon" type="../assets/dist/img/logo.png" href="../assets/dist/img/logo.png">
</head>
<body class="hold-transition layout-top-nav">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
      <div class="container">
        <a href="" class="navbar-brand">
          <img src="../assets/dist/img/logo.png" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">SiPeKa</span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
          <!-- Left navbar links -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="data_pengaduan.php" class="nav-link">Data Pengaduan</a>
            </li>
            <li class="nav-item">
              <a href="data_tanggapan.php" class="nav-link">Data Tanggapan</a>
            </li>
            <li class="nav-item">
              <a href="laporan.php" class="nav-link">Generate Laporan</a>
            </li>
          </ul>
        </div>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
          <!-- Messages Dropdown Menu -->
          <li class="nav-item dropdown">
            <a class="nav-link" href="../logout.php" onclick="return confirm('Yakin Mau Keluar!!!')">
              <i class="fas fa-user"></i> Keluar
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <!-- /.navbar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Sistem Pengaduan Warga Informatika</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container">
          <div class="row">
            <!-- /.col-md-6 -->
            <div class="col-lg-12">

              <div class="card card-warning card-outline">
                <div class="card-header">
                  <h5 class="card-title m-0">Data Pengaduan</h5>
                </div>
                  <div class="card-header">
                      <form class="d-flex" role="search" action="" method="POST">
                        <input class="form-control col-3" type="search" placeholder="Search" aria-label="Search" name="key" autocomplete="off">
                        <button class="btn btn-outline-warning form-control col-1" type="submit" name="cari">Search</button>
                      </form>
                      <!-- <form class="d-flex" role="search">
                        <input class="form-control col-10" type="search" placeholder="Search" aria-label="Search" name="key">
                        <button class="btn btn-outline-warning form-control col-2" type="submit" name="cari">Search</button>
                      </form> -->
                  </div>
                <div class="card-body">
                  <table class="table table-bordered">
                    <thead class="table table-warning text-center">
                      <tr>
                        <th style="width: 10px">#</th>
                        <th style="width: 100px">Foto</th>                        
                        <th>Isi Laporan</th>
                        <th style="width: 200px">Tanggal Pengaduan</th>
                        <th>Status Verifikasi</th>
                        <th style="width: 150px">Aksi</th>
                      </tr>
                    </thead>
                    <tbody class="text-center">

                      <?php
                      $no = 1;
                      include "../koneksi.php";
                        // tombol cari
                       if( isset($_POST['cari'])) {
                        $keyword = addslashes($_POST['key']);
                        $q = "SELECT * FROM pengaduan WHERE 
                        isi_laporan like '%$keyword%' OR 
                        status like '%$keyword%' OR
                        tgl_pengaduan like '%$keyword%'
                         order by id_pengaduan desc";
                       } else {
                        $q = "SELECT * FROM pengaduan order by id_pengaduan desc";
                       }
                      $catatan =mysqli_query($koneksi, $q);
                      while($d = mysqli_fetch_array($catatan)){
                        ?>

                        <tr>
                          <td><?php echo $no++; ?></td>
                          <td class="text-center">
                            <a href="" data-toggle="modal" data-target="#modal-view-foto<?php echo $d['id_pengaduan']; ?>"><img src="../upload/<?=$d['foto']?>" width="150"></a><br>
                            <!-- <span class="text-danger text-center">Klik Untuk Melihat</span> -->
                          </td>
                          <td><?=$d['isi_laporan']?></td>
                          <td><?=$d['tgl_pengaduan']?></td>
                          <td>
                            <?php if ($d['status'] == 'menunggu') { ?>
                              <span class="badge bg-warning">Menunggu</span>
                            <?php } else if ($d['status'] == 'proses') { ?>
                              <span class="badge bg-primary">Proses</span>
                            <?php } else { ?>
                              <span class="badge bg-success">Selesai</span>
                            <?php } ?>
                          </td>
                          <td>
                          <a href="" class="btn btn-info btn-sm"  data-toggle="modal" data-target="#modal-tanggapan<?php echo $d['id_pengaduan']; ?>"><i>Tanggapi</i></a>
                            <a href="hapus_pengaduan.php?id_pengaduan=<?php echo $d['id_pengaduan']; ?>"
                              class="btn btn-danger btn-sm" onclick="return confirm('Yakin Mau Di Hapus!!!')" ><i class="fas fa-trash"></i></a>
                          </td>
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
                                  <img src="../upload/<?=$d['foto']?>" width="300">
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
                        <div class="modal fade" id="modal-tanggapan<?php echo $d['id_pengaduan']; ?>">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">Verifikasi dan Isi Tanggapan</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form method="post" action="simpan_tanggapan.php">
                                  <div class="card-body">
                                    <input type="text" name="id_pengaduan" value="<?=$d['id_pengaduan']?>" hidden>
                                    <?php
                                    include "../koneksi.php";
                                    $petugas_login    =mysqli_query($koneksi, "SELECT * FROM petugas WHERE username='$_SESSION[username]'");
                                    $petugas_login    =mysqli_fetch_array($petugas_login);
                                    ?>
                                    <input type="text" name="id_petugas" value="<?=$petugas_login['id_petugas']?>" class="form-control" hidden>                                    
                                    <div class="form-group">
                                      <div class="text-center">
                                    <img src="../upload/<?=$d['foto']?>" width="300">
                                  </div><hr>
                                  <label>Tanggal Pengaduan</label>
                                   <div>
                                    <label class="form-control"><?=$d['tgl_pengaduan']?></label>
                                  </div>
                                   <label>Isi Laporan</label>
                                   <div>
                                    <textarea class="form-control" rows="3" readonly><?=$d['isi_laporan']?></textarea>
                                  </div>
                                      <label>Verifikasi</label>
                                      <select class="form-control" name="status">
                                        <option value="proses">Proses</option>
                                        <option value="selesai">Selesai</option>
                                      </select>
                                    </div>
                                    <div class="form-group">
                                      <label>Isi Tanggapan</label>
                                      <textarea class="form-control" name="laporan" rows="3" placeholder="Enter ..." required></textarea>
                                    </div>                          
                                  </div>                                  
                                </div>
                                <div class="modal-footer justify-content-between">
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Keluar</button>
                                  <button type="submit" class="btn btn-warning">Simpan</button>
                                </div>
                              </form>
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

              <!-- <div class="modal fade" id="modal-edit">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Verifikasi dan Isi Tanggapan</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="simpan_pengaduan">
                        <div class="card-body">
                          <div class="form-group">
                            <label>Verifikasi</label>
                            <select class="form-control">
                              <option>Proses</option>
                              <option>Selesai</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label>Isi Tanggapan</label>
                            <textarea class="form-control" name="laporan" rows="3" placeholder="Enter ..."></textarea>
                          </div>                          
                        </div>
                      </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                      <button type="button" class="btn btn-primary">Simpan</button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="modal fade" id="modal-tambah">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Tambah Pengaduan</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="simpan_pengaduan">
                        <div class="card-body">
                          <div class="form-group">
                            <label>Isi Laporan</label>
                            <textarea class="form-control" name="laporan" rows="3" placeholder="Enter ..."></textarea>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputFile">Upload Foto</label>
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" name="foto" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                      <button type="button" class="btn btn-primary">Simpan Pengaduan</button>
                    </div>
                  </div>
                </div>
              </div> -->

            </div>
            <!-- /.col-md-6 -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        <!-- Anything you want -->
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy;  <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="../assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../assets/dist/js/adminlte.min.js"></script>
</body>
</html>
