<?php
include 'cek_akses.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>FOST - Found Objects of Science and Technology</title>
  <meta name="description" content="Lapor barang hilang dan temukan objek sains dan teknologi.">
  <meta name="keywords" content="FOST, barang hilang, pengaduan, sains, teknologi">

  <!-- Favicons -->
  <link href="assets/dist/img/logo1.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
  <style>
    /* Pastikan header tidak membatasi tinggi */
    .header {
      height: auto;
      /* Biarkan tinggi menyesuaikan konten */
      padding: 10px 0;
      /* Tambahkan padding agar konten tidak menempel */
      overflow: visible;
      /* Pastikan elemen di dalamnya tidak terpotong */
    }

    /* Sesuaikan logo */
    .header .logo img {
      height: 100px;
      /* Tinggi logo yang diinginkan */
      width: auto;
      /* Jaga rasio aspek */
      max-height: 100%;
      /* Pastikan tidak lebih besar dari kontainer */
    }


    .info-item {
      background-color: #f9f9f9;
      /* Warna latar belakang */
      border: 1px solid #ddd;
      /* Border */
      border-radius: 10px;
      /* Sudut melengkung */
      padding: 20px;
      /* Jarak dalam */
      margin: 10px;
      /* Jarak antar elemen */
      max-width: 300px;
      /* Lebar maksimum */
      box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
      /* Efek bayangan */
    }

    /* Untuk layar kecil (HP atau tablet) */
    /* Untuk layar kecil (HP atau tablet) */
    /* Untuk layar kecil (HP atau tablet) */
    /* Untuk layar kecil (HP atau tablet) */
    @media (max-width: 768px) {
      .navmenu ul {
        display: none;
        /* Sembunyikan menu di layar kecil */
        flex-direction: column;
        background-color: white;
        position: absolute;
        top: 60px;
        width: 100%;
        z-index: 999;
      }

      .navmenu ul.active {
        display: block;
        /* Tampilkan menu saat kelas 'active' ditambahkan */
      }

      .navmenu i.mobile-nav-toggle {
        display: block;
        /* Tampilkan tombol burger */
        font-size: 1.5rem;
        cursor: pointer;
      }
    }

    /* Untuk layar besar (Laptop/PC) */
    @media (min-width: 769px) {
      .navmenu ul {
        display: flex;
        /* Atur menu horizontal */
        flex-direction: row;
        position: static;
      }

      .navmenu i.mobile-nav-toggle {
        display: none;
        /* Sembunyikan tombol burger pada layar besar */
      }
    }
  </style>
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.html" class="logo d-flex align-items-center me-auto">
        <img src="assets/dist/img/logo1.png" alt="Logo">
        <h1 class="sitename"></h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#contact">Contact</a></li>
          <li><a href="login.php">Admin</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>


      <a class="btn-getstarted" href="log.php">Masuk</a>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">
      <div class="hero-bg">
        <img src="assets/img/hero-bg-light.webp" alt="">
      </div>
      <div class="container text-center">
        <div class="d-flex flex-column justify-content-center align-items-center">
          <h1 data-aos="fade-up">Welcome to <span>FOST</span></h1>
          <p data-aos="fade-up" data-aos-delay="100">Laporkan barang hilang anda dan temukan di FOST<br></p>
          <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
            <a href="log.php" class="btn-get-started">Mulai</a>
            <a href="https://youtu.be/6BlmTpUbjNk" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Tonton Vidio</span>
</a>

          </div>
          <img src="assets/img/hero-services-img.webp" class="img-fluid hero-img" alt="" data-aos="zoom-out" data-aos-delay="300">
        </div>
      </div>
    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
            <p class="who-we-are">Siapa Kami</p>
            <h3>FOST - Found Objects of Science and Technology</h3>
            <p class="fst-italic">
              Kami adalah platform untuk membantu Anda melaporkan barang hilang maupun melaporkan penemuan barang hilang di sains dan teknologi.
            </p>
            <ul>
              <li><i class="bi bi-check-circle"></i> <span>Pengaduan barang hilang yang mudah dan cepat.</span></li>
              <li><i class="bi bi-check-circle"></i> <span>Temukan objek yang hilang dengan bantuan komunitas.</span></li>
              <li><i class="bi bi-check-circle"></i> <span>Langsung laporkan dengan penemuan maupun kehilangan dengan fitur WA.</span></li>
            </ul>
          </div>

          <div class="col-lg-6 about-images" data-aos="fade-up" data-aos-delay="200">
            <div class="row gy-4">
              <div class="col-lg-6">
                <img src="assets/dist/img/fstdepan.jpg" class="img-fluid" alt="">
              </div>
              <div class="col-lg-6">
                <div class="row gy-4">
                  <div class="col-lg-12">
                    <img src="assets/dist/img/parkiran.jpg" class="img-fluid" alt="">
                  </div>
                  <div class="col-lg-12">
                    <img src="assets/dist/img/tengahfst.jpg" class="img-fluid" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- /About Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">
      <div class="container section-title" data-aos="fade-up">
        <h2>Hubungi Kami</h2>
        <p>Jika Anda memiliki pertanyaan atau ingin melaporkan bug silahkan hubungi kami.</p>
      </div><!-- End Section Title -->

      <div class="container">
        <div class="row g-4 justify-content-center">
          <div class="col-lg-4 col-md-6 info-item text-center">
            <i class="bi bi-geo-alt fs-1 mb-3 d-block mx-auto"></i>
            <h3>Alamat</h3>
            <p>Jl. A.H. Nasution No. 105 Cibiru Kota Bandung 40614
              Jawa Barat – Indonesia</p>
          </div>
          <div class="col-lg-4 col-md-6 info-item text-center">
            <i class="bi bi-telephone fs-1 mb-3 d-block mx-auto"></i>
            <h3>Call Us</h3>
            <p>(022)7800525</p>
          </div>
          <div class="col-lg-4 col-md-6 info-item text-center">
            <i class="bi bi-envelope fs-1 mb-3 d-block mx-auto"></i>
            <h3>Email Kami</h3>
            <p>fst@uinsgd.ac.id</p>
          </div>
        </div>
      </div>



      <!-- End Info Item -->
      </div>
      </div>
    </section><!-- /Contact Section -->

  </main>

  <footer id="footer" class="footer position-relative light-background">
    <div class="container footer-top">
      <div class="row gy-4">
        <!-- Footer About -->
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="logo d-flex align-items-center mb-3">
            <span class="sitename">FOST</span>
          </a>
          <div class="footer-contact">
            <p>Fakultas Sains dan Teknologi</p>
            <p>Jl. A.H. Nasution No. 105 Cibiru Kota Bandung 40614<br>Jawa Barat – Indonesia</p>
            <p class="mt-3"><strong>Phone:</strong> <span>(022)7800525</span></p>
            <p><strong>Email:</strong> <span>fst@uinsgd.ac.id</span></p>
          </div>
          <div class="social-links d-flex mt-4">
            <!--<a href="" class="d-flex justify-content-center align-items-center me-3">
            <i class="bi bi-twitter-x">Belum Tersedia</i>
          </a>
          <a href="" class="d-flex justify-content-center align-items-center me-3">
            <i class="bi bi-facebook">Belum Tersedia</i>
          </a>-->
            <a href="https://www.instagram.com/fst.uinbandung/profilecard/?igsh=NHIzdmg0dWQzZDh1" class="d-flex justify-content-center align-items-center">
              <i class="bi bi-instagram"></i>
            </a>
          </div>
        </div>

        <!-- Useful Links -->
        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Tautan Pembantu</h4>
          <ul class="list-unstyled">
            <li><a href="#hero">Beranda</a></li>
            <li><a href="#about">Tentang Kami</a></li>
            <li><a href="#contact">Kontak Kami</a></li>
            <li><a href="login.php">Admin</a></li>
          </ul>
        </div>

        <!-- Our Services -->
        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Layanan Kami</h4>
          <ul class="list-unstyled">
            <li><a href="#">Melaporkan barang hilang atau menemukan barang hilang</a></li>
            <li><a href="#">Mencari barang hilang</a></li>
            <li><a href="#">Didukung Komunitas</a></li>
            <li><a href="#">Terbaru</a></li>
          </ul>
        </div>

        <!-- Additional Logo/Content -->
        <div class="col-lg-4 col-md-6 footer-logo text-center">
          <img src="assets/dist/img/logo1.png" alt="FOST Logo" class="img-fluid mb-3" style="max-width: 150px;">
          <p class="mt-2">Mendukung pelaporan dan pencarian barang hilang untuk komunitas kami.</p>
        </div>
      </div>
    </div>

    <!-- Footer Copyright -->
    <div class="container text-center mt-4">
      <p>© <strong class="sitename">FOST</strong> All Rights Reserved</p>
      <div class="credits">
        Designed by <a href="https://github.com/sugazq">fostretrieve</a>
      </div>
    </div>
  </footer>


  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const mobileNavToggle = document.querySelector('.mobile-nav-toggle');
      const navMenu = document.querySelector('.navmenu ul');

      // Fungsi untuk menangani perubahan ukuran layar
      function handleResize() {
        if (window.innerWidth > 768) {
          navMenu.classList.remove('active'); // Hapus kelas 'active' di layar besar
        } else {
          navMenu.classList.remove('active'); // Pastikan menu disembunyikan di layar kecil
        }
      }

      // Toggle menu saat tombol burger diklik
      mobileNavToggle.addEventListener('click', function() {
        navMenu.classList.toggle('active'); // Toggle kelas 'active' pada menu
      });

      // Panggil handleResize pada saat window di-resize
      window.addEventListener('resize', handleResize);

      // Panggil sekali saat halaman pertama kali dimuat untuk set menu sesuai ukuran layar
      handleResize();
    });
  </script>

</body>

</html>