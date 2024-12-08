<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Pendaftaran FOST</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <!-- Favicons -->
  <link href="assets/dist/img/logo1.png" rel="icon">
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen" style="background-image: url('assets/dist/img/bglogin.jpg'); background-size: cover; background-repeat: no-repeat; background-position: center;">
    <div class="bg-white rounded-lg shadow-lg p-8 flex flex-col md:flex-row items-center md:items-start">
        <div class="w-full md:w-1/2 flex justify-center">
            <img alt="" class="w-full max-w-sm" height="300" src="assets/dist/img/daftar.jpg" width="400"/>
        </div>
        <div class="w-full md:w-1/2 mt-8 md:mt-0 md:ml-8">
            <h2 class="text-2xl font-semibold text-gray-700">Daftar</h2>
            <p class="text-gray-500 mb-6">Found Object Of Science and Technology</p>

            <form action="simpan_daftar.php" method="post" class="space-y-4">
                <div>
                    <label class="sr-only" for="nim">NIM</label>
                    <input type="text" name="nim" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="nim" placeholder="NIM" required/>
                </div>
                <div>
                    <label class="sr-only" for="nama">Nama</label>
                    <input type="text" name="nama" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="nama" placeholder="Nama" required/>
                </div>
                <div>
                    <label class="sr-only" for="username">Username</label>
                    <input type="text" name="username" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="username" placeholder="Username" required/>
                </div>
                <div>
                    <label class="sr-only" for="password">Password</label>
                    <input type="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="password" placeholder="Password" required/>
                </div>
                <div>
                    <label class="sr-only" for="telp">Telepon</label>
                    <input type="text" name="telp" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="telp" placeholder="Telepon" required/>
                </div>
                <div class="flex justify-between">
                    <a href="log.php" class="text-blue-500 hover:underline">Sudah Punya Akun?</a>
                    <button type="submit" class="py-2 px-4 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Daftar</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>