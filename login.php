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

                <!-- <li class="nav-item ">
                  <a class="nav-link" href="about.html"> About </a>
                </li>

                <li class="nav-item ">
                  <a class="nav-link" href="admission.html"> Admission </a>
                </li> -->

                <li class="nav-item">
                  <a class="call_to-btn btn_white-border mx-4" href="register.php"> Register </a>
                </li>

                <li class="nav-item">
                  <a class="call_to-btn btn_white-border" href="login.php">Login</a>
                </li>

              </ul>
            </div>
        </nav>
      </div>
    </header>

  </div>
  <!-- end header section -->

  <!-- contact section -->

  <section class="contact_section ">

    <div class="container">

      <div class="row">
        <div class="col-md-6">
          <div class="d-flex justify-content-center d-md-block">
            <h2>
              Login
            </h2>
          </div>
          <form action="login_account.php" method="POST">
            <div class="contact_form-container">
              <div>
                <div>
                  <input type="email" name="email" placeholder="Email" required>
                </div>
                <div>
                  <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="mt-5">
                  <button type="submit">
                    Login
                  </button>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="col-md-6">
          <div class="contact_img-box">
            <img src="images/determine.png" alt="">
          </div>
        </div>
      </div>
    </div>
  </section>

  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>


</body>

</html>