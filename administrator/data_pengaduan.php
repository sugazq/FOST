<?php 
session_start();

// Cek apakah yang mengakses halaman ini sudah login
if ($_SESSION['level'] == "") {
    header("location:../login.php?info=login");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Laporan | FOST</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="icon" type="image/png" href="../assets/dist/img/logo1.jpg">
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
                <img src="../assets/dist/img/logo1.png" alt="" class="brand-image img-circle elevation-3" style="opacity: .8;width: 75px; height: 75px;">
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
                        <h1 class="m-0 gradient-text">Data Laporan</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Form Pencarian dan Filter -->
                        <form method="get" action="data_pengaduan.php">
                            <div class="form-row mb-3">
                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="cari" placeholder="Cari laporan..." value="<?php echo isset($_GET['cari']) ? $_GET['cari'] : ''; ?>">
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control" name="kategori">
                                        <option value="">Pilih Kategori</option>
                                        <option value="Kendaraan" <?php echo (isset($_GET['kategori']) && $_GET['kategori'] == 'Kendaraan') ? 'selected' : ''; ?>>Kendaraan</option <option value="Perhiasan" <?php echo (isset($_GET['kategori']) && $_GET['kategori'] == 'Perhiasan') ? 'selected' : ''; ?>>Perhiasan</option>
                                        <option value="Elektronik" <?php echo (isset($_GET['kategori']) && $_GET['kategori'] == 'Elektronik') ? 'selected' : ''; ?>>Elektronik</option>
                                        <option value="Dokumen" <?php echo (isset($_GET['kategori']) && $_GET['kategori'] == 'Dokumen') ? 'selected' : ''; ?>>Dokumen</option>
                                        <option value="Aksesoris" <?php echo (isset($_GET['kategori']) && $_GET['kategori'] == 'Aksesoris') ? 'selected' : ''; ?>>Aksesoris</option>
                                        <option value="Pakaian" <?php echo (isset($_GET['kategori']) && $_GET['kategori'] == 'Pakaian') ? 'selected' : ''; ?>>Pakaian</option>
                                        <option value="Barang Anak" <?php echo (isset($_GET['kategori']) && $_GET['kategori'] == 'Barang Anak') ? 'selected' : ''; ?>>Barang Anak</option>
                                        <option value="Peralatan" <?php echo (isset($_GET['kategori']) && $_GET['kategori'] == 'Peralatan') ? 'selected' : ''; ?>>Peralatan</option>
                                        <option value="Buku/Media" <?php echo (isset($_GET['kategori']) && $_GET['kategori'] == 'Buku/Media') ? 'selected' : ''; ?>>Buku/Media</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select class="form-control" name="jenis">
                                        <option value="">Pilih Jenis Laporan</option>
                                        <option value="Kehilangan" <?php echo (isset($_GET['jenis']) && $_GET['jenis'] == 'Kehilangan') ? 'selected' : ''; ?>>Kehilangan</option>
                                        <option value="Menemukan" <?php echo (isset($_GET['jenis']) && $_GET['jenis'] == 'Menemukan') ? 'selected' : ''; ?>>Menemukan</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fas fa-search"></i> Cari
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h5 class="card-title m-0">Data Laporan</h5>
                            </div>
                            <div class="card-body">
                                <div style="max-height: 400px; overflow-y: auto;">
                                    <table class="table table-secondary table-striped-columns">
                                        <thead class="table-primary text-center">
                                            <tr>
                                                <th style="width: 10px">No</th>
                                                <th style="width: 100px">Foto</th>
                                                <th style="width: 200px">Tanggal Laporan</th>
                                                <th>Isi Laporan</th>
                                                <th>Lokasi</th>
                                                <th>Username</th>
                                                <th>Jenis Laporan</th>
                                                <th>Kategori</th>
                                                <th style="width: 100px">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            <?php
                                            $no = 1;
                                            include "../koneksi.php";
                                            $kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';
                                            $jenis = isset($_GET['jenis']) ? $_GET['jenis'] : '';
                                            $cari = isset($_GET['cari']) ? $_GET['cari'] : '';

                                            $query = "SELECT * FROM pengaduan WHERE 1=1";

                                            if ($kategori != '') {
                                                $query .= " AND kategori LIKE '%$kategori%'";
                                            }

                                            if ($jenis != '') {
                                                $query .= " AND jenis LIKE '%$jenis%'";
                                            }

                                            if ($cari != '') {
                                                $query .= " AND (isi_laporan LIKE '%$cari%' OR lokasi LIKE '%$cari%')";
                                            }

                                            $result = mysqli_query($koneksi, $query);
                                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                                <tr>
                                                    <td><?php echo $no++; ?></td>
                                                    <?php 
                                                    $fotoPath = '../upload/' . $row['foto'];
                                                    if (!empty($row['foto']) && file_exists($fotoPath)) {
                                                        echo "<td><img src='$fotoPath' alt='Foto' style='width: 100px; height: auto;'></td>";
                                                    } else {
                                                        echo "<td>Tidak ada foto</td>";
                                                        echo "<td>Path: $fotoPath</td>"; // Debugging line
                                                    } ?>
                                                    <td><?php echo $row['tgl_pengaduan']; ?></td>
                                                    <td><?php echo $row['isi_laporan']; ?></td>
                                                    <td><?php echo $row['lokasi']; ?></td>
                                                    <td><?php echo $row['username']; ?></td>
                                                    <td><?php echo $row['jenis']; ?></td>
                                                    <td><?php echo isset($row['kategori']) ? $row['kategori'] : 'Kategori Tidak Tersedia'; ?></td>
                                                    <td>
                                                        <a href="hapus_pengaduan.php?id_pengaduan=<?php echo $row['id_pengaduan']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Mau Di Hapus!!!')"><i class="fas fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <strong>&copy; 2024 RIRAMWP. All rights reserved.</strong>
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<script src="../assets/plugins/jquery/jquery.min.js"></script>
<script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../assets/dist/js/adminlte.min.js"></script>
</body>
</html>