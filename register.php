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

    <?php
    include 'header.php';
    ?>
  </div>

  <!-- contact section -->
  <section class="contact_section ">

    <div class="container">

      <div class="row">
        <div class="col-md-6">
          <div class="d-flex justify-content-center d-md-block">
            <h2>
              Buat Akun
            </h2>
          </div>
          <form action="function/register_account.php" method="POST">
            <div class="contact_form-container">
              <div>
                <div>
                  <input type="text" name="name" placeholder="Name" required>
                </div>
                <div>
                  <input type="email" name="email" placeholder="Email" required>
                </div>
                <div>
                  <input type="password" name="password" placeholder="Password" required>
                </div>
                <div>
                  <input type="password" name="confirm_password" placeholder="Konfirmasi Password" required>
                </div>
                <div class="mt-5">
                  <button type="submit">
                    Daftar
                  </button>
                </div>
              </div>
            </div>
          </form>

        </div>
        <div class="col-md-6">
          <div class="contact_img-box">
            <img src="images/students.jpg" alt="">
          </div>
        </div>
      </div>
    </div>
  </section>

  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>


</body>

</html>