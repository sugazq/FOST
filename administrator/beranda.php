<?php
session_start();

// Check if the user is logged in
if ($_SESSION['level'] == "") {
  header("location:../login.php?info=login");
  exit();
}

include '../koneksi.php'; // Ensure the correct path to koneksi.php

// Fetch overall report statistics
$query = "SELECT COUNT(*) AS total_reports FROM pengaduan";
$total_reports_result = mysqli_query($koneksi, $query);
$total_reports_data = mysqli_fetch_assoc($total_reports_result);
$total_reports = $total_reports_data['total_reports'];

// Fetch monthly report statistics
$current_month = date('m');
$query_monthly = "SELECT COUNT(*) AS total_monthly_reports FROM pengaduan WHERE MONTH(tgl_pengaduan) = '$current_month'";
$total_monthly_result = mysqli_query($koneksi, $query_monthly);
$total_monthly_data = mysqli_fetch_assoc($total_monthly_result);
$total_monthly_reports = $total_monthly_data['total_monthly_reports'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard Admin | Laporan Mahasiswa</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
    }

    .dashboard-card {
      margin: 20px 0;
    }

    /* Scrollbar kustom untuk browser Webkit (Chrome, Safari) */
    ::-webkit-scrollbar {
      width: 8px;
    }

    ::-webkit-scrollbar-thumb {
      background: #888;
      border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
      background: #555;
    }

    /* Scrollbar kustom untuk Firefox */
    .scrollable {
      scrollbar-width: thin;
      scrollbar-color: #888 #f1f1f1;
    }

    .dashboard-card {
      margin: 20px 0;
    }

    .navbar-nav .nav-link {
      transition: color 0.3s ease, transform 0.2s ease;
      /* Transisi yang halus */
    }

    .nav-link:hover {
      background: linear-gradient(to right, #00ff00, #007bff);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .nav-link::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 0;
      height: 3px;
      /* Tinggi garis bawah */
      background: linear-gradient(to right, #00ff00, #007bff);
      transition: width 0.3s ease;
    }

    /* Gaya dasar untuk navbar link */
    .navbar-nav .nav-link {
      position: relative;
      transition: color 0.3s ease;
    }




    .gradient-text {
      background: linear-gradient(to right, #00ff00, #007bff);
      /* Gradasi hijau dan biru */
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      font-size: 36px;
      /* Ubah ukuran teks sesuai kebutuhan */
    }

    /* Tambahkan garis biru di bawah saat hover */
    .navbar-nav .nav-link:hover::after {
      content: "";
      position: absolute;
      bottom: 0;
      left: 0;
      height: 3px;
      width: 100%;
      background-color: #007bff;
      /* Warna biru */
      transition: all 0.3s ease;
    }



    .card-body p.display-4 {
      font-size: 3rem;
      font-weight: bold;
    }

    .table th,
    .table td {
      vertical-align: middle;
    }

    .card-header {
      background-color: #f8f9fa;
      font-weight: bold;
    }

    @media (max-width: 768px) {
      .display-4 {
        font-size: 2rem;
      }

      .card-header h3 {
        font-size: 1.25rem;
      }
    }
  </style>
</head>

<body class="hold-transition layout-top-nav">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
      <div class="container">
        <a href="" class="navbar-brand">
          <img src="../assets/dist/img/logo.png" alt="FoSt Logo" class="brand-image img-circle elevation-3" style="opacity: .8; width: 75px; height: 75px;">
          <span class="brand-text font-weight-light"></span>
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
          <ul class="navbar-nav">
          <li class="nav-item">
              <a href="beranda.php" class="nav-link">Beranda</a>
            </li>  
          <li class="nav-item">
              <a href="data_pengaduan.php" class="nav-link">Data Laporan</a>
            </li>
            <!--<li class="nav-item">
              <a href="data_tanggapan.php" class="nav-link">Data Tanggapan</a>
            </li>-->
            <!--<li class="nav-item">
              <a href="laporan.php" class="nav-link">Generate Laporan</a>
            </li>-->
          </ul>
        </div>

        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
          <li class="nav-item dropdown">
            <a class="nav-link" href="../logout.php" onclick="return confirm('Yakin Mau Keluar!!!')">
              <i class="fas fa-user"></i> Keluar
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <!-- /.navbar -->

    <div class="content-wrapper">
      <div class="content-header">
        <div class="container">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 gradient-text">Dashboard Admin</h1>
            </div>
          </div>
        </div>
      </div>

      <div class="content">
        <div class="container">
          <div class="row">
            <!-- Welcome Card -->
            <div class="col-lg-12 dashboard-card">
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Selamat Datang, Admin</h3>
                </div>
                <div class="card-body">
                  <p>Selamat datang di Dashboard Admin FOST! Berikut adalah statistik Laporannya:</p>
                </div>
              </div>
            </div>

            <!-- Dashboard Cards -->
            <div class="col-lg-6 col-md-6 dashboard-card">
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">Total Laporan Masuk</h3>
                </div>
                <div class="card-body text-center">
                  <p class="display-4"><?php echo $total_reports; ?></p>
                  <p>Total Laporan yang diterima di sistem.</p>
                </div>
              </div>
            </div>

            <div class="col-lg-6 col-md-6 dashboard-card">
              <div class="card card-warning">
                <div class="card-header">
                  <h3 class="card-title">Laporan Bulan Ini</h3>
                </div>
                <div class="card-body text-center">
                  <p class="display-4"><?php echo $total_monthly_reports; ?></p>
                  <p>Total laporan yang diterima bulan ini.</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Table of Reports -->
          <div class="row">
            <div class="col-lg-12">
              <div class="card card-outline card-primary">
                <div class="card-header">
                  <h5 class="card-title">Daftar Laporan</h5>
                </div>
                <div class="card-body">
                  <div style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-info table-striped-columns">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Tanggal Laporan</th>
                          <th>Isi Laporan</th>
                          <th>Lokasi</th>
                          <th>Jenis</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        // Mengambil semua laporan
                        $query_all_reports = "SELECT * FROM pengaduan ORDER BY tgl_pengaduan DESC";
                        $all_reports_result = mysqli_query($koneksi, $query_all_reports);
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($all_reports_result)) { ?>
                          <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $row['tgl_pengaduan']; ?></td>
                            <td><?php echo $row['isi_laporan']; ?></td>
                            <td><?php echo $row['lokasi']; ?></td>
                            <td><?php echo $row['jenis']; ?></td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <footer class="main-footer">
      <strong>&copy; 2024 RIRAMWP. All rights reserved.</strong>
    </footer>

  </div>

  <script src="../assets/plugins/jquery/jquery.min.js"></script>
  <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/dist/js/adminlte.min.js"></script>
</body>

</html>