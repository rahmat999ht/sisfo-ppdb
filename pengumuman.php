<?php
session_start(); // Mulai session
require_once("koneksi.php");
error_reporting(0);

?>


<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Sekolah SD</title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <!-- progress barstle -->
  <link rel="stylesheet" href="css/css-circular-prog-bar.css">
  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,700|Raleway:400,600&display=swap" rel="stylesheet">
  <!-- font wesome stylesheet -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />


  <link rel="stylesheet" href="css/css-circular-prog-bar.css">


</head>

<body class="sub_page">
  <div class="top_container ">
   <!-- header section strats -->
   <header class="header_section">
    <div class="container">
      <nav class="navbar navbar-expand-lg custom_nav-container ">
        <a class="navbar-brand" href="index.php">
          <span>
            Sekolah SD
          </span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <div class="d-flex ml-auto flex-column flex-lg-row align-items-center">
            <ul class="navbar-nav  ">
              <li class="nav-item active">
                <a class="nav-link" href="index.php"> Home <span class="sr-only">(current)</span></a>
              </li>
              <?php if (isset($_SESSION['id_user'])): ?>
                <!-- Cek jika session username ada -->

                <li class="nav-item ">
                  <a class="nav-link" href="pengumuman.php"> Pengumuman </a>
                </li>

                <li class="nav-item ">
                  <a class="nav-link" href="biodata.php"> Biodata </a>
                </li>

                <!-- Dropdown Info Profil dan Log Out -->
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="logout_account.php">Log Out</a>
                  </div>
                </li>
              <?php else: ?>
                <li class="nav-item">
                  <a class="call_to-btn btn_white-border mx-4" href="register.php"> Register </a>
                </li>

                <li class="nav-item">
                  <a class="call_to-btn btn_white-border" href="login.php">Login</a>
                </li>
              <?php endif; ?>

            </ul>
          </div>
      </nav>
    </div>
  </header>
  </div>
  <!-- end header section -->

  <div class="common_style">


    <!-- Pengumuman Kelulusan Section -->
    <section class="admission_section">
      <div class="container">
        <h2 class="text-center mb-4">Pengumuman Kelulusan</h2>

        <!-- Siswa Lulus -->
        <div class="card mb-4">
          <div class="card-header bg-success text-white text-center">
            <h3>Selamat, Anda Dinyatakan LULUS</h3>
          </div>
          <div class="card-body">
            <p class="text-center">Nama: <strong>John Doe</strong></p>
            <p class="text-center">Nomor Peserta: <strong>123456</strong></p>
            <p class="text-center">Sekolah: <strong>SD [Nama Sekolah]</strong></p>
            <div class="alert alert-success text-center" role="alert">
              Anda telah dinyatakan lulus. Terima kasih telah berjuang dengan baik! Selamat melanjutkan pendidikan ke
              jenjang yang lebih tinggi.
            </div>
          </div>
        </div>

        <!-- Siswa Tidak Lulus -->
        <div class="card">
          <div class="card-header bg-danger text-white text-center">
            <h3>Maaf, Anda Dinyatakan TIDAK LULUS</h3>
          </div>
          <div class="card-body">
            <p class="text-center">Nama: <strong>Jane Doe</strong></p>
            <p class="text-center">Nomor Peserta: <strong>654321</strong></p>
            <p class="text-center">Sekolah: <strong>SD [Nama Sekolah]</strong></p>
            <div class="alert alert-danger text-center" role="alert">
              Kami mohon maaf, Anda dinyatakan tidak lulus tahun ini. Jangan berkecil hati, tetap semangat, dan terus
              belajar untuk kesempatan berikutnya.
            </div>
          </div>
        </div>

      </div>
    </section>

    <!-- end about section -->

  </div>

  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>

</body>

</html>