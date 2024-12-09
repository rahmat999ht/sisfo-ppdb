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
    <?php
    include 'header.php';
    ?>

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