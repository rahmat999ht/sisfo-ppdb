<?php
session_start();
require_once("../koneksi.php");
error_reporting(0);

if (!$_SESSION['admin_id']) {
  echo '<script>alert("Anda belum login atau session login berakhir"); window.location.href="admin/login_admin.php";</script>';
  exit;
}

// Query untuk jumlah total peserta
$total_peserta_query = "SELECT COUNT(*) AS total_peserta FROM peserta";
$total_peserta_result = mysqli_query($koneksi, $total_peserta_query);
$total_peserta_data = mysqli_fetch_assoc($total_peserta_result);
$total_peserta = $total_peserta_data['total_peserta'] ?? 0;

// Query untuk total akun pengguna
$total_accounts_query = "SELECT COUNT(*) AS total_accounts FROM account";
$total_accounts_result = mysqli_query($koneksi, $total_accounts_query);
$total_accounts_data = mysqli_fetch_assoc($total_accounts_result);
$total_accounts = $total_accounts_data['total_accounts'] ?? 0;

// Query untuk statistik hasil kelulusan
$kelulusan_query = "
    SELECT 
        SUM(status = 'Lulus') AS total_lulus, 
        SUM(status = 'Tidak Lulus') AS total_tidak_lulus 
    FROM hasil_kelulusan";
$kelulusan_result = mysqli_query($koneksi, $kelulusan_query);
$kelulusan_data = mysqli_fetch_assoc($kelulusan_result);
$total_lulus = $kelulusan_data['total_lulus'] ?? 0;
$total_tidak_lulus = $kelulusan_data['total_tidak_lulus'] ?? 0;

// Query untuk periode pendaftaran aktif
$active_registration_query = "SELECT * FROM periode_pendaftaran WHERE status = 'Aktif' LIMIT 1";
$active_registration_result = mysqli_query($koneksi, $active_registration_query);
$active_registration_data = mysqli_fetch_assoc($active_registration_result);
$registration_active = $active_registration_data ? true : false;
$tanggal_selesai = $active_registration_data['tanggal_selesai'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />

  <title>Dasboard</title>
  <meta content="" name="description" />
  <meta content="" name="keywords" />

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon" />
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect" />
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Poppins:300,400,500,600,700"
    rel="stylesheet" />

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet" />

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
  <?php include 'header.php'; ?>
  <?php include 'sidebar.php'; ?>

  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div>

    <section class="section dashboard">
      <div class="row">
        <!-- Total Peserta -->
        <div class="col-md-4">
          <div class="card info-card">
            <div class="card-body">
              <h5 class="card-title">Total Peserta</h5>
              <div class="d-flex align-items-center">
                <div class="ps-3">
                  <h6><?php echo $total_peserta; ?></h6>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Total Akun -->
        <!-- <div class="col-md-4">
          <div class="card info-card">
            <div class="card-body">
              <h5 class="card-title">Total Akun Pengguna</h5>
              <div class="d-flex align-items-center">
                <div class="ps-3">
                  <h6><?php echo $total_accounts; ?></h6>
                </div>
              </div>
            </div>
          </div>
        </div> -->
        <!-- Statistik Kelulusan -->
        <div class="col-md-4">
          <div class="card info-card">
            <div class="card-body">
              <h5 class="card-title">Lulus</h5>
              <div class="d-flex align-items-center">
                <div class="ps-3">
                  <h6><?php echo $total_lulus; ?></h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Statistik Kelulusan -->
        <div class="col-md-4">
          <div class="card info-card">
            <div class="card-body">
              <h5 class="card-title">Tidak Lulus</h5>
              <div class="d-flex align-items-center">
                <div class="ps-3">
                  <h6><?php echo $total_tidak_lulus; ?></h6>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      </div>
      <!-- Pendaftaran Aktif -->
      <div class="col-md-12">
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-body">
            <h5 class="card-title text-center fw-bold">Pendaftaran Saat Ini</h5>
            <div class="d-flex flex-column align-items-center">
              <?php if ($registration_active): ?>
                <div class="text-center">
                  <i class="bi bi-check-circle text-success" style="font-size: 3rem;"></i>
                  <p class="mt-3">Pendaftaran sedang berlangsung hingga:</p>
                  <h4 class="text-success fw-bold"><?php echo date('d-m-Y H:i:s', strtotime($tanggal_selesai)); ?></h4>
                </div>
              <?php else: ?>
                <div class="text-center">
                  <i class="bi bi-x-circle text-danger" style="font-size: 3rem;"></i>
                  <p class="mt-3">Saat ini tidak ada pendaftaran yang sedang berlangsung.</p>
                  <h4 class="text-danger fw-bold">Harap cek kembali nanti.</h4>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>

    </section>
  </main>

  <?php include 'footer.php'; ?>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/js/main.js"></script>
</body>

</html>