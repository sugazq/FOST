<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Sistem Pengaduan Warga Informatika</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
    <link rel="icon" type="assets/dist/img/logo.png" href="assets/dist/img/logo.png">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-warning">
            <div class="card-header text-center">
                <a href="assets/index2.html" class="h1">Daftar</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sistem Pengaduan Warga Informatika</p>

                <form action="simpan_daftar_admin.php" method="post">
                    <input type="hidden" name="id_petugas" class="form-control" placeholder="id_petugas" required>
                    <div class="input-group-append">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="nama_petugas" class="form-control" placeholder="Nama Petugas" required>
                        <div class="input-group-append">
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                        <div class="input-group-append">
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        <div class="input-group-append">
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="telp" class="form-control" placeholder="Telepon" required>
                        <div class="input-group-append">
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <select name="level" id="level" class="form-control">
                            <option value="admin">Admin</option>
                            <option value="petugas">Petugas</option>
                        </select>
                        <div class="input-group-append">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <a href="login.php" class="text-center">Sudah Punya Akun</a>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-warning btn-block">Daftar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/dist/js/adminlte.min.js"></script>
</body>

</html>