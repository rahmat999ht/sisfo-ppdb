<?php
session_start();
require_once("../koneksi.php");
error_reporting(0);

if (!$_SESSION['admin_id']) {
    echo '<script>alert("Anda belum login atau session login berakhir"); window.location.href="admin/login_admin.php";</script>';
    exit;
}

$periodeData = null;

// Periksa apakah ada parameter id di URL
if (isset($_GET['id'])) {
    $periodeId = intval($_GET['id']); // Amankan input ID
    $query = "SELECT * FROM periode_pendaftaran WHERE id = $periodeId";
    $result = mysqli_query($koneksi, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $periodeData = mysqli_fetch_assoc($result);
    } else {
        echo '<script>alert("Data periode tidak ditemukan!"); window.location.href="tabel-periode.php";</script>';
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Form Periode</title>
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

    <?php
    include 'header.php';
    include 'sidebar.php';
    ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Form Periode</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item">Forms</li>
                    <li class="breadcrumb-item active">Periode</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <?php if ($periodeData): ?>
                                <h5 class="card-title">Form Ubah Periode</h5>
                            <?php else: ?>
                                <h5 class="card-title">Form Tambah Periode</h5>
                            <?php endif; ?>

                            <form action="func/save_periode.php" method="POST">
                                <?php if ($periodeData): ?>
                                    <input type="hidden" name="id" value="<?php echo $periodeData['id']; ?>">
                                <?php endif; ?>

                                <!-- Status -->
                                <div class="row mb-3">
                                    <label for="status" class="col-sm-2 col-form-label">Status</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="status" name="status" required>
                                            <option value="Aktif" <?php echo (isset($periodeData['status']) && $periodeData['status'] === 'Aktif') ? 'selected' : ''; ?>>Aktif</option>
                                            <option value="Tidak Aktif" <?php echo (isset($periodeData['status']) && $periodeData['status'] === 'Tidak Aktif') ? 'selected' : ''; ?>>Tidak Aktif</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Tanggal Selesai -->
                                <div class="row mb-3">
                                    <label for="tanggalSelesai" class="col-sm-2 col-form-label">Tanggal Selesai</label>
                                    <div class="col-sm-10">
                                        <input type="datetime-local" class="form-control" id="tanggalSelesai" name="tanggal_selesai" value="<?php echo isset($periodeData['tanggal_selesai']) ? date('Y-m-d\TH:i', strtotime($periodeData['tanggal_selesai'])) : ''; ?>" required>
                                    </div>
                                </div>

                                <!-- Tombol -->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
</body>

</html>