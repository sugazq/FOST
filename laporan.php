<?php
session_start();
if ($_SESSION['status'] != "login") {
    header("location:log.php?pesan=belum_login");
}
include 'koneksi.php'; // Pastikan koneksi database sudah benar

// Ambil parameter pencarian jika ada
$kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';
$jenis = isset($_GET['jenis']) ? $_GET['jenis'] : '';
$cari = isset($_GET['cari']) ? $_GET['cari'] : '';

// Query untuk mengambil data pengaduan dengan filter pencarian
$query = "SELECT pengaduan.id_pengaduan, pengaduan.nim, mahasiswa.username, pengaduan.isi_laporan, pengaduan.foto, pengaduan.lokasi, pengaduan.tgl_pengaduan, pengaduan.jenis, pengaduan.kategori, mahasiswa.tlpn 
          FROM pengaduan 
          INNER JOIN mahasiswa ON pengaduan.nim = mahasiswa.nim
          WHERE (pengaduan.isi_laporan LIKE '%$cari%' OR pengaduan.lokasi LIKE '%$cari%')";

// Tambahkan filter untuk kategori jika ada
if ($kategori != '') {
    $query .= " AND pengaduan.kategori LIKE '%$kategori%'";
}

// Tambahkan filter untuk jenis jika ada
if ($jenis != '') {
    $query .= " AND pengaduan.jenis LIKE '%$jenis%'";
}

$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Query Error: " . mysqli_error($koneksi));
}

$nim = $_SESSION['nim'];
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FOST</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Favicons -->
    <link href="assets/dist/img/logo1.png" rel="icon">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
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

        .table th,
        .table td {
            vertical-align: middle;
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
    </style>

</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="" class="navbar-brand">
                    <img src="assets/dist/img/logo.jpg" alt="FoSt Logo" class="brand-image img-circle elevation-3" style="opacity: .8;width: 75px; height: 75px;">
                    <span class="brand-text font-weight-light"></span>
                </a>
                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="dashboard.php" class="nav-link">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a href="pengaduan.php" class="nav-link">Tulis Pengaduan</a>
                        </li>
                        <!--
<li class="nav-item">
    <a href="tanggapan_pengaduan.php" class="nav-link">Tanggapan Pengaduan</a>
</li>
-->

                        <li class="nav-item">
                            <a href="laporan.php" class="nav-link">Laporan Pengaduan</a>
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
                            <h1 class="m-0 gradient-text">Found Objects of Science and Technology</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Form Pencarian dan Filter -->
                            <form method="get" action="laporan.php">
                                <div class="form-row mb-3">
                                    <div class="col-md-3">
                                        <input type="text" class="form-control" name="cari" placeholder="Cari laporan..." value="<?php echo $cari; ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <select class="form-control" name="kategori">
                                            <option value="">Pilih Kategori</option>
                                            <option value="Kendaraan" <?php echo ($kategori == 'Kendaraan' ? 'selected' : ''); ?>>Kendaraan</option>
                                            <option value="Perhiasan" <?php echo ($kategori == 'Perhiasan' ? 'selected' : ''); ?>>Perhiasan</option>
                                            <option value="Elektronik" <?php echo ($kategori == 'Elektronik' ? 'selected' : ''); ?>>Elektronik</option>
                                            <option value="Dokumen" <?php echo ($kategori == 'Dokumen' ? 'selected' : ''); ?>>Dokumen</option>
                                            <option value="Aksesoris" <?php echo ($kategori == 'Aksesoris' ? 'selected' : ''); ?>>Aksesoris</option>
                                            <option value="Pakaian" <?php echo ($kategori == 'Pakaian' ? 'selected' : ''); ?>>Pakaian</option>
                                            <option value="Barang Anak" <?php echo ($kategori == 'Barang Anak' ? 'selected' : ''); ?>>Barang Anak</option>
                                            <option value="Peralatan" <?php echo ($kategori == 'Peralatan' ? 'selected' : ''); ?>>Peralatan</option>
                                            <option value="Buku/Media" <?php echo ($kategori == 'Buku/Media' ? 'selected' : ''); ?>>Buku/Media</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <select class="form-control" name="jenis">
                                            <option value="">Pilih Jenis Laporan</option>
                                            <option value="Kehilangan" <?php echo ($jenis == 'Kehilangan' ? 'selected' : ''); ?>>Kehilangan</option>
                                            <option value="Menemukan" <?php echo ($jenis == 'Menemukan' ? 'selected' : ''); ?>>Menemukan</option>
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
                                    <h5 class="card-title m-0">Data Pengaduan</h5>
                                </div>
                                <div class="card-body">
                                    <div style="max-height: 400px; overflow-y: auto;"> <!-- Set a max height and enable vertical scrolling -->
                                        <table class="table table-secondary table-striped">
                                            <thead class="table-primary text-center">
                                                <tr>
                                                    <th style="width: 10px">No</th>
                                                    <th style="width: 100px">Foto</th>
                                                    <th style="width: 200px">Tanggal Pengaduan</th>
                                                    <th>Isi Laporan</th>
                                                    <th>Lokasi</th>
                                                    <th>Username</th>
                                                    <th>Jenis Laporan</th>
                                                    <th>Kategori</th> <!-- Tambahkan kolom Kategori -->
                                                    <th style="width: 100px">Aksi</th>
                                                </tr>
                                            </thead>

                                            <tbody class="text-center">
                                                <?php
                                                $no = 1;
                                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                                    <tr>
                                                        <td><?php echo $no++; ?></td>
                                                        <?php if (!empty($row['foto']) && file_exists('upload/' . $row['foto'])) {
                                                            echo "<td><img src='upload/" . $row['foto'] . "' alt='Foto' style='width: 100px; height: auto;'></td>";
                                                        } else {
                                                            echo "<td>Tidak ada foto</td>";
                                                        } ?>
                                                        <td><?php echo $row['tgl_pengaduan']; ?></td>
                                                        <td><?php echo $row['isi_laporan']; ?></td>
                                                        <td><?php echo $row['lokasi']; ?></td>
                                                        <td><?php echo $row['username']; ?></td>
                                                        <td><?php echo $row['jenis']; ?></td>
                                                        <td><?php echo isset($row['kategori']) ? $row['kategori'] : 'Kategori Tidak Tersedia'; ?></td>
                                                        <td>
                                                            <!-- Tombol Menanggapi (Link ke WhatsApp) -->
                                                            <a href="https://wa.me/<?php echo '+62' . substr($row['tlpn'], 1); ?>" class="btn btn-success btn-sm" target="_blank">
                                                                <i class="fab fa-whatsapp"></i> Chat
                                                            </a>
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
                </div>
            </div>
        </div>

        <footer class="main-footer">
            <div class="float-right d-none d-sm-inline">
            </div>
            <strong>Copyright &copy; <a href="https://github.com/sugazq">riramwp</a>.</strong> All rights reserved.
        </footer>
    </div>

    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/dist/js/adminlte.min.js"></script>

</body>

</html>