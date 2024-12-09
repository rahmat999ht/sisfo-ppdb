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

<body>
  <div class="top_container">

    <?php
    include 'header.php';
    ?>

    <section class="hero_section ">
      <div class="hero-container container">
        <div class="hero_detail-box">
          <h2>
            Selamat Datang di Sistem Informasi Pendaftaran Peserta Didik Baru (PPDB) SD [Nama Sekolah]
          </h2>
          <p>
            Sistem ini dirancang untuk memudahkan proses pendaftaran siswa baru secara online,
            sehingga orang tua/wali murid dapat mendaftarkan putra-putrinya dengan mudah tanpa perlu datang ke sekolah.
          </p>
          <div class="hero_btn-continer">
            <a href="#about" class="call_to-btn btn_white-border">
              Baca selengkapnya
            </a>
          </div>
        </div>
        <div class="hero_img-container">
          <div>
            <img src="images/hero.png" alt="" class="img-fluid">
          </div>
        </div>
      </div>
    </section>
  </div>

  <div class="common_style">

    <!-- about section -->
    <section class="about_section" , id="about">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="about_img-container">
              <img src="images/about.png" alt="">
            </div>
          </div>
          <div class="col-md-6">
            <div class="about_detail-box">
              <h3>
                Tentang SD [Nama Sekolah]
              </h3>
              <p>
                SD [Nama Sekolah] adalah lembaga pendidikan dasar yang berkomitmen untuk mencetak generasi yang cerdas,
                berbudi pekerti, dan memiliki keterampilan abad 21. Berdiri sejak [tahun berdiri],
                sekolah kami telah melahirkan banyak alumni yang sukses dan berprestasi di berbagai bidang.
              </p>
              <div class="">
                <a href="#admission" class="call_to-btn btn_white-border">
                  Baca selengkapnya
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


    <!-- end about section -->

    <!-- admission section -->
    <section class="admission_section" id="admission">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="admission_detail-box">
              <h3>
                Penerimaan Peserta Didik Baru
              </h3>
              <p>
                Selamat datang di sistem penerimaan peserta didik baru SD [Nama Sekolah]. Ikuti langkah-langkah di bawah
                ini untuk mendaftarkan putra/putri Anda secara online dengan mudah.
              </p>
              <h4>Proses Pendaftaran:</h4>
              <ol>
                <li>
                  <strong>Registrasi Akun:</strong> Orang tua/wali siswa harus membuat akun di sistem kami dengan
                  mengisi data dasar dan alamat email yang valid.
                </li>
                <li>
                  <strong>Pengisian Formulir:</strong> Isi formulir pendaftaran dengan data calon siswa, seperti nama,
                  tanggal lahir, alamat, serta dokumen pendukung seperti akta kelahiran dan kartu keluarga.
                </li>
                <li>
                  <strong>Unggah Dokumen:</strong> Unggah dokumen-dokumen penting seperti foto calon siswa, dan
                  administrasi penting lainnya.
                </li>
                <li>
                  <strong>Pengumuman Kelulusan:</strong> Pengumuman hasil seleksi akan diumumkan melalui sistem ini.
                  Jika diterima, orang tua dapat langsung melakukan pendaftaran ulang secara online.
                </li>
              </ol>
              <div class="">
                <a href="register.php" class="call_to-btn btn_white-border">
                  Buat Akun
                </a>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="admission_img-container">
              <img src="images/admission.png" alt="Penerimaan Peserta Didik Baru">
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>


  <!-- footer section -->
  <section class="container-fluid footer_section">
    <p>
      Copyright & copy; 2024 All Rights Reserved By Adzkia Amatillah
      <!-- <a href="https://html.design/">Free Html Templates</a> -->
    </p>
  </section>
  <!-- footer section -->

  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>


</body>

</html>