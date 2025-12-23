<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login L0FIsT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <!-- Favicons -->
  <link href="assets/dist/img/logo1.png" rel="icon">
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen" style="background-image: url('assets/dist/img/bglogin.jpg'); background-size: cover; background-repeat: no-repeat; background-position: center;">
    <div class="bg-white rounded-lg shadow-lg p-8 flex flex-col md:flex-row items-center md:items-start">
        <div class="w-full md:w-1/2 flex justify-center">
            <img src="assets/dist/img/admin.jpg" alt="Logo" class="rounded-circle" style="width: 150px; height: 150px;" />
        </div>

        <div class="w-full md:w-1/2 mt-8 md:mt-0 md:ml-8">
            <h2 class="text-2xl font-semibold text-gray-700">Sistem Found Object Of Science and Technology</h2>
            <?php
            if (isset($_GET['info'])) {
                if ($_GET['info'] == "gagal") { ?>
                    <div class="bg-gradient-warning text-center p-3 rounded mb-4">
                        Login gagal! username dan password salah!
                    </div>
                <?php } else if ($_GET['info'] == "logout") { ?>
                    <div class="bg-gradient-success text-center p-3 rounded mb-4">
                        Anda telah berhasil logout
                    </div>
                <?php } else if ($_GET['info'] == "login") { ?>
                    <div class="bg-gradient-info text-center p-3 rounded mb-4">
                        Maaf anda harus login terlebih dahulu
                    </div>
            <?php }
            } ?>
            <form action="cek_login.php" method="post" class="space-y-4">
                <div>
                    <label class="sr-only" for="username">Username</label>
                    <input type="text" name="username" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="username" placeholder="Username" required />
                </div>
                <div>
                    <label class="sr-only" for="password">Password</label>
                    <input type="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="password" placeholder="Password" required />
                </div>
                <div class="flex justify-between">
                    <!--<a href="daftaradmin.php" class="text-blue-500 hover:underline">Daftar Admin</a>-->
                    <button type="submit" class="py-2 px-4 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Masuk</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>