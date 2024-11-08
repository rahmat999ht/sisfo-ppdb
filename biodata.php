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



    <!-- admission section -->
    <section class="admission_section">
      <div class="container">
        <h2>Formulir Biodata</h2>
        <form action="submit_biodata.php" method="post">
          <!-- Nama Lengkap -->
          <div class="form-group">
            <label for="nama">Nama Lengkap:</label>
            <input type="text" id="nama" name="nama" class="form-control" required>
          </div>

          <!-- Tempat Lahir -->
          <div class="form-group">
            <label for="tempat_lahir">Tempat Lahir:</label>
            <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" required>
          </div>

          <!-- Tanggal Lahir -->
          <div class="form-group">
            <label for="tanggal_lahir">Tanggal Lahir:</label>
            <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" required>
          </div>

          <!-- Jenis Kelamin -->
          <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <select id="jenis_kelamin" name="jenis_kelamin" class="form-control" required>
              <option value="">Pilih Jenis Kelamin</option>
              <option value="Laki-laki">Laki-laki</option>
              <option value="Perempuan">Perempuan</option>
            </select>
          </div>

          <!-- Nama Ibu -->
          <div class="form-group">
            <label for="nama_ibu">Nama Ibu:</label>
            <input type="text" id="nama_ibu" name="nama_ibu" class="form-control" required>
          </div>

          <!-- Nama Ayah -->
          <div class="form-group">
            <label for="nama_ayah">Nama Ayah:</label>
            <input type="text" id="nama_ayah" name="nama_ayah" class="form-control" required>
          </div>

          <!-- Alamat -->
          <div class="form-group">
            <label for="alamat">Alamat:</label>
            <textarea id="alamat" name="alamat" class="form-control" rows="3" required></textarea>
          </div>

          <!-- Nomor Telepon -->
          <div class="form-group">
            <label for="no_telepon">No.HP Wali:</label>
            <input type="tel" id="no_telepon" name="no_telepon" class="form-control" pattern="[0-9]{10,12}" required>
          </div>

          <!-- Tombol Submit -->
          <a type="submit" class="call_to-btn btn_white-border">Kirim Biodata</a>
        </form>
      </div>
    </section>

    <!-- end admission section -->

  </div>

  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>


</body>

</html>
