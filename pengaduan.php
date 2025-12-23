<?php
session_start();
if ($_SESSION['status'] != "login") {
    header("location:log.php?pesan=belum_login");
}
include 'koneksi.php'; // Pastikan Anda menghubungkan ke database

$nim = $_SESSION['nim'];

$query = "SELECT pengaduan.id_pengaduan, pengaduan.nim, mahasiswa.username, pengaduan.isi_laporan, pengaduan.foto, pengaduan.lokasi, pengaduan.tgl_pengaduan, pengaduan.jenis, pengaduan.kategori, pengaduan.status
          FROM pengaduan
          INNER JOIN mahasiswa ON pengaduan.nim = mahasiswa.nim
          WHERE pengaduan.nim = '$nim'";

$result = mysqli_query($koneksi, $query);

if (!$result) {
    die("Query Error: " . mysqli_error($koneksi));
}

$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FOST</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="assets/dist/img/logo1.png" rel="icon">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="assets/plugins/jquery/jquery.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
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
                    <img src="assets/dist/img/logo.png" alt="FoSt Logo" class="brand-image img-circle elevation-3" style="opacity: .8; width: 75px; height: 75px;">
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
                        <li class="nav-item">
                            <a href="laporan.php" class=" nav-link">Laporan Pengaduan</a>
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
                        <h1 class="m-0 gradient-text" style="color: #007bff;">يٰٓاَيُّهَا الَّذِيْنَ اٰمَنُوا اتَّقُوا اللّٰهَ وَكُوْنُوْا مَعَ الصّٰدِقِيْنَ</h1>
                            <p class="gradient-text" style="color: #007bff; font-size: 12px;">
                                Wahai orang-orang yang beriman, bertakwalah kepada Allah dan tetaplah bersama orang-orang yang benar!
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h5 class="card-title m-0">Data Pengaduan</h5>
                                    <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#modal-tambah">
                                        Tambah Pengaduan
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div style="max-height: 400px; overflow-y: auto;">
                                        <table class="table table-secondary table-striped-columns">
                                            <thead class="table-primary text-center">
                                                <tr>
                                                    <th style="width: 10px">No</th>
                                                    <th style="width: 100px">Foto</th>
                                                    <th style="width: 200px">Tanggal Pengaduan</th>
                                                    <th>Isi Laporan</th>
                                                    <th>Lokasi</th>
                                                    <th>Username</th>
                                                    <th>Jenis Laporan</th>
                                                    <th>Kategori</th>
                                                    <th>Status</th>
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
                                                        <td><?php echo $row['status']; ?></td>

                                                        <td>
                                                            <a href="update_pengaduan.php" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-edit<?php echo $row['id_pengaduan']; ?>"><i class="fas fa-edit"></i></a>
                                                            <a href="hapus_pengaduan.php?id_pengaduan=<?php echo $row['id_pengaduan']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin Mau Di Hapus!!!')"><i class="fas fa-trash"></i></a>
                                                        </td>
                                                    </tr>

                                                    <!-- Modal Edit -->
                                                    <div class="modal fade" id="modal-edit<?php echo $row['id_pengaduan']; ?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Edit Pengaduan</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="post" action="update_pengaduan.php" enctype="multipart/form-data">
                                                                        <input type="hidden" name="id_pengaduan" value="<?php echo $row['id_pengaduan']; ?>">

                                                                        <div class="form-group">
                                                                            <label>Isi Laporan</label>
                                                                            <textarea class="form-control" name="isi_laporan" rows="3" required><?php echo $row['isi_laporan']; ?></textarea>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label>Lokasi</label>
                                                                            <input type="text" name="lokasi" class="form-control" value="<?php echo $row['lokasi']; ?>" required>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label>Jenis</label>
                                                                            <select name="jenis" class="form-control" required>
                                                                                <option value="Kehilangan" <?php echo ($row['jenis'] == 'Kehilangan') ? 'selected' : ''; ?>>Kehilangan</option>
                                                                                <option value="Menemukan" <?php echo ($row['jenis'] == 'Menemukan') ? 'selected' : ''; ?>>Menemukan</option>
                                                                            </select>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label>Kategori</label>
                                                                            <select name="kategori" class="form-control" required>
                                                                                <option value="Kendaraan" <?php echo ($row['kategori'] == 'Kendaraan') ? 'selected' : ''; ?>>Kendaraan</option>
                                                                                <option value="Perhiasan" <?php echo ($row['kategori'] == 'Perhiasan') ? 'selected' : ''; ?>>Perhiasan</option>
                                                                                <option value="Elektronik" <?php echo ($row['kategori'] == 'Elektronik') ? 'selected' : ''; ?>>Elektronik</option>
                                                                                <option value="Dokumen" <?php echo ($row['kategori'] == 'Dokumen') ? 'selected' : ''; ?>>Dokumen</option>
                                                                                <option value="Aksesoris" <?php echo ($row['kategori'] == 'Aksesoris') ? 'selected' : ''; ?>>Aksesoris</option>
                                                                                <option value="Pakaian" <?php echo ($row['kategori'] == 'Pakaian') ? 'selected' : ''; ?>>Pakaian</option>
                                                                                <option value="Barang Anak" <?php echo ($row['kategori'] == 'Barang Anak') ? 'selected' : ''; ?>>Barang Anak</option>
                                                                                <option value="Peralatan" <?php echo ($row['kategori'] == 'Peralatan') ? 'selected' : ''; ?>>Peralatan</option>
                                                                                <option value="Buku/Media" <?php echo ($row['kategori'] == 'Buku/Media') ? 'selected' : ''; ?>>Buku/Media</option>
                                                                            </select>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label>Status</label>
                                                                            <select name="status" class="form-control" required>
                                                                                <option value="Proses" <?php echo ($row['status'] == 'Proses') ? 'selected' : ''; ?>>Proses</option>
                                                                                <option value="Selesai" <?php echo ($row['status'] == 'Selesai') ? 'selected' : ''; ?>>Selesai</option>
                                                                            </select>
                                                                        </div>

                                                                        <div class="form-group">
                                                                            <label>Foto Lama</label><br>
                                                                            <?php if (!empty($row['foto']) && file_exists('upload/' . $row['foto'])): ?>
                                                                                <img src="upload/<?php echo $row['foto']; ?>" alt="Gambar Laporan" style="width: 100px; height: auto;"><br>
                                                                            <?php else: ?>
                                                                                <p>Tidak ada foto yang tersedia.</p>
                                                                            <?php endif; ?>
                                                                            <small>Jika ingin mengganti foto, silakan upload foto baru.</small><br>
                                                                            <label>Upload Foto Baru (opsional)</label>
                                                                            <input type="file" name="foto" class="form-control">
                                                                        </div>

                                                                </div>
                                                                <div class="modal-footer justify-content-between">
                                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Keluar</button>
                                                                    <button type="submit" class="btn btn-warning">Update Pengaduan</button>
                                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </tbody>
                                        </table>
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
                                            <form method="post" action="simpan_pengaduan.php" enctype="multipart/form-data">
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label>NIM</label>
                                                        <input type="text" name="nim" class="form-control" value="<?php echo $nim; ?>" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Username</label>
                                                        <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Isi Laporan</label>
                                                        <textarea class="form-control" name="isi_laporan" rows="3" placeholder="Enter ..." required></textarea>
                                                    </div>
                                                    <div class="form-group">
    <label>Lokasi (Klik di Peta)</label>
    <div id="mapTambah" style="height:300px; border-radius:8px;"></div>

    <input type="text" name="lokasi" id="lokasi" class="form-control mt-2" readonly required>
    <input type="hidden" name="latitude" id="latitude">
    <input type="hidden" name="longitude" id="longitude">
</div>

                                                    <div class="form-group">
                                                        <label>Jenis</label>
                                                        <select name="jenis" class="form-control" required>
                                                            <option value="">-- Pilih Jenis --</option>
                                                            <option value="Kehilangan">Kehilangan</option>
                                                            <option value="Menemukan">Menemukan</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Kategori</label>
                                                        <select name="kategori" class="form-control" required>
                                                            <option value="">-- Pilih Kategori --</option>
                                                            <option value="Kendaraan">Kendaraan</option>
                                                            <option value="Perhiasan">Perhiasan</option>
                                                            <option value="Elektronik">Elektronik</option>
                                                            <option value="Dokumen">Dokumen</option>
                                                            <option value="Aksesoris">Aksesoris</option>
                                                            <option value="Pakaian">Pakaian</option>
                                                            <option value="Barang Anak">Barang Anak</option>
                                                            <option value="Peralatan">Peralatan</option>
                                                            <option value="Buku/Media">Buku/Media</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Status</label>
                                                        <select name="status" class="form-control" required>
                                                            <option value="Proses">Proses</option>
                                                            <option value="Selesai">Selesai</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Foto</label>
                                                        <input type="file" name="foto" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Keluar</button>
                                                    <button type="submit" class="btn btn-success">Simpan Pengaduan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="main-footer">
                <div class="float-right d-none d-sm-inline"></div>
                <strong>Copyright &copy; <a href="https://github.com/sugazq">riramwp</a>.</strong> All rights reserved.
            </footer>
        </div>

        <script src="assets/plugins/jquery/jquery.min.js"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/dist/js/adminlte.min.js"></script>
        <script>
let mapTambah, markerTambah;

$('#modal-tambah').on('shown.bs.modal', function () {

    if (mapTambah) {
        mapTambah.invalidateSize();
        return;
    }

    mapTambah = L.map('mapTambah').setView([-6.931, 107.717], 16);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap'
    }).addTo(mapTambah);

    mapTambah.on('click', function (e) {
        const lat = e.latlng.lat;
        const lon = e.latlng.lng;

        if (markerTambah) {
            mapTambah.removeLayer(markerTambah);
        }

        markerTambah = L.marker([lat, lon]).addTo(mapTambah);

        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lon;

        fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lon}`)
            .then(res => res.json())
            .then(data => {
                document.getElementById('lokasi').value = data.display_name;
            });
    });
});
</script>

    </body>
</html>