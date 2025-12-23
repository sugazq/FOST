<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Login L0FIsT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <!-- Favicons -->
  <link href="assets/dist/img/logo.png" rel="icon">
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen" style="background-image: url('assets/dist/img/bglogin.jpg'); background-size: cover; background-repeat: no-repeat; background-position: center;">
    <div class="bg-white rounded-lg shadow-lg p-8 flex flex-col md:flex-row items-center md:items-start">
        <div class="w-full md:w-1/2 flex justify-center">
            <img alt="" class="w-full max-w-sm" height="300" src="assets/dist/img/bingung.jpg" width="400"/>
        </div>
        <div class="w-full md:w-1/2 mt-8 md:mt-0 md:ml-8">
            <h2 class="text-2xl font-semibold text-gray-700">Selamat datang!</h2>
            <p class="text-gray-500 mb-6">Masukan akun L0FIsT anda</p>
            <?php 
            if(isset($_GET['pesan'])){
                if($_GET['pesan'] == "gagal"){ ?>
                    <div class="col-md-12">
                        <div class="bg-gradient-warning text-center p-3 rounded">
                            Login gagal! username dan password salah!
                        </div>
                    </div>
                <?php } else if($_GET['pesan'] == "logout"){ ?>
                    <div class="col-md-12">
                        <div class="bg-gradient-success text-center p-3 rounded">
                            Anda telah berhasil logout
                        </div>
                    </div>
                <?php } else if($_GET['pesan'] == "belum_login"){ ?>
                    <!-- Pesan belum login bisa ditambahkan di sini -->
                <?php } 
            } ?>
            <form action="cek_login_mahasiswa.php" method="post" class="space-y-4">
                <div>
                    <label class="sr-only" for="username">Username</label>
                    <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="username" name="username" placeholder="Username" type="text" required/>
                </div>
                <div>
                    <label class="sr-only" for="password">Password</label>
                    <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="password" name="password" placeholder="Password" type="password" required/>
                </div>
                <div class="flex space-x-4">
                    <button class="w-full py-2 px-4 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500" type="submit">MASUK</button>
                    <button class="w-full py-2 px-4 border border-blue-500 text-blue-500 rounded-lg hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500" type="button" onclick="window.location.href='daftar.php'">DAFTAR</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>