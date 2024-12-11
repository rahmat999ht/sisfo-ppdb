<?php
session_start(); // Mulai session
require_once("koneksi.php");
error_reporting(0);

$id_login = $_SESSION['id_user']; // Ambil id_login dari session

// Periksa apakah pengguna sudah login
if (!$id_login) {
  echo '<script>alert("Anda harus login terlebih dahulu."); window.location.href="login.php";</script>';
  exit;
}

// Ambil data id_peserta dari tabel account dengan prepared statement
$queryAccount = $koneksi->prepare("SELECT id_peserta FROM account WHERE id = ?");
$queryAccount->bind_param("s", $id_login); // Gunakan "s" karena id_user kemungkinan string
$queryAccount->execute();
$resultAccount = $queryAccount->get_result();
$rowAccount = $resultAccount->fetch_assoc();

$id_peserta = $rowAccount['id_peserta'] ?? null;
$statusPeserta = null; // Default null

if ($id_peserta) {
  // Query hasil kelulusan berdasarkan id_peserta
  $pesertaID = 1;
  $queryHK = $koneksi->prepare("SELECT * FROM hasil_kelulusan WHERE id_peserta = ?");
  $queryHK->bind_param("i", $pesertaID);
  $queryHK->execute();
  $resultHK = $queryHK->get_result();
  $rowHK = $resultHK->fetch_assoc();

  $queryPeserta = $koneksi->prepare("SELECT * FROM peserta WHERE id = ?");
  $queryPeserta->bind_param("i", $id_peserta);
  $queryPeserta->execute();
  $resultPeserta = $queryPeserta->get_result();
  $rowPeserta = $resultPeserta->fetch_assoc();

  $statusPeserta = $rowHK['status'] ?? null;
  $namaPeserta = $rowPeserta['nama'] ?? 'Nama Tidak Diketahui';
  $nomorPeserta = $rowPeserta['no_peserta'] ?? 'Nomor Tidak Diketahui';
}
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
  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,700|Raleway:400,600&display=swap" rel="stylesheet">
  <!-- font awesome stylesheet -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
</head>

<body class="sub_page">
  <div class="top_container ">
    <?php include 'header.php'; ?>
  </div>

  <div class="common_style">
    <!-- Pengumuman Kelulusan Section -->
    <section class="admission_section">
      <div class="container">
        <!-- <h2 class="text-center mb-4">Pengumuman Kelulusan</h2> -->

        <?php if ($statusPeserta === null) { ?>
          <div class="alert alert-info text-center mt-xl-5 role=" alert">
            <h3><i class="fa fa-calendar"></i> Pengumuman Kelulusan</h3>
            <p>Harap bersabar, pengumuman kelulusan akan disampaikan pada <strong>tanggal yang telah ditentukan</strong>. Pastikan untuk terus memantau informasi terbaru di website kami.</p>
          </div>
        <?php } elseif ($statusPeserta === 'Lulus') { ?>

          <h2 class="text-center mb-4">Hasil Pengumuman</h2>
          <!-- Siswa Lulus -->
          <div class="card mb-4">
            <div class="card-header bg-success text-white text-center">
              <h3>Selamat, Anda Dinyatakan LULUS</h3>
            </div>
            <div class="card-body">
              <p class="text-center">Nama: <strong><?= htmlspecialchars($namaPeserta); ?></strong></p>
              <p class="text-center">Nomor Peserta: <strong><?= htmlspecialchars($nomorPeserta); ?></strong></p>
              <div class="alert alert-success text-center" role="alert">
                Anda telah dinyatakan lulus. Terima kasih telah berjuang dengan baik! Selamat melanjutkan pendidikan ke jenjang yang lebih tinggi.
              </div>
            </div>
          </div>
        <?php } elseif ($statusPeserta === 'Tidak Lulus') { ?>

          <h2 class="text-center mb-4">Hasil Pengumuman</h2>
          <!-- Siswa Tidak Lulus -->
          <div class="card">
            <div class="card-header bg-danger text-white text-center">
              <h3>Maaf, Anda Dinyatakan TIDAK LULUS</h3>
            </div>
            <div class="card-body">
              <p class="text-center">Nama: <strong><?= htmlspecialchars($namaPeserta); ?></strong></p>
              <p class="text-center">Nomor Peserta: <strong><?= htmlspecialchars($nomorPeserta); ?></strong></p>
              <div class="alert alert-danger text-center" role="alert">
                Kami mohon maaf, Anda dinyatakan tidak lulus tahun ini. Jangan berkecil hati, tetap semangat, dan terus belajar untuk kesempatan berikutnya.
              </div>
            </div>
          </div>
        <?php } ?>

      </div>
    </section>
  </div>

  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>

</body>

</html>