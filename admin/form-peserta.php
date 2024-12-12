<?php
session_start();
require_once("../koneksi.php");
error_reporting(0);

if (!$_SESSION['admin_id']) {
    echo '<script>alert("Anda belum login atau session login berakhir"); window.location.href="admin/login_admin.php";</script>';
    exit;
}

$pesertaData = null;
$accountData = null;

// Periksa apakah ada parameter id di URL
if (isset($_GET['id'])) {
    $pesertaId = intval($_GET['id']); // Amankan input ID
    $query = "SELECT * FROM peserta LEFT JOIN account ON peserta.id = account.id_peserta WHERE peserta.id = $pesertaId";
    $result = mysqli_query($koneksi, $query);

    // Ambil data peserta jika ditemukan
    if ($result && mysqli_num_rows($result) > 0) {
        $pesertaData = mysqli_fetch_assoc($result);
    } else {
        echo '<script>alert("Peserta tidak ditemukan!"); window.location.href="tabel-peserta.php";</script>';
        exit;
    }
}

$result = $koneksi->query("SELECT MAX(no_peserta) AS last_no FROM peserta");
$row = $result->fetch_assoc();
$fotoPeserta = !empty($pesertaData['foto']) ? '../../' . htmlspecialchars($pesertaData['foto']) : '../images/blank.png';
$no_peserta = $row['last_no'] ? $row['last_no'] + 1 : 1; // Jika kosong, mulai dari 1

// Format nomor peserta menjadi 3 digit
$formatted_no_peserta = str_pad($no_peserta, 3, '0', STR_PAD_LEFT);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Form Peserta</title>
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
    <style>
        #preview {
            max-width: 200px;
            display: block;
            border: 1px solid #ccc;
            padding: 5px;
        }
    </style>
</head>

<body>

    <?php
    include 'header.php';
    include 'sidebar.php';
    ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Form Peserta</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item">Forms</li>
                    <li class="breadcrumb-item active">Peserta</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <?php if ($pesertaData): ?>
                                <h5 class="card-title">Form Ubah Peserta</h5>
                            <?php else: ?>
                                <h5 class="card-title">Form Tambah Peserta</h5>
                            <?php endif; ?>

                            <form action="func/save-peserta.php" method="POST" enctype="multipart/form-data">
                                <?php if ($pesertaData): ?>
                                    <input type="hidden" name="id" value="<?php echo $pesertaData['id']; ?>">
                                <?php endif; ?>

                                <!-- Preview Foto -->
                                <div class="row mb-3">
                                    <label for="preview" class="col-sm-2 col-form-label">Preview Foto</label>
                                    <div class="col-sm-10">
                                        <img id="preview"
                                            src="<?php echo $fotoPeserta; ?>"
                                            alt="Preview Foto"
                                            style="max-width: 200px; display: block; border: 1px solid #ccc; padding: 5px;" />
                                    </div>
                                </div>

                                <!-- Input Foto -->
                                <div class="row mb-3">
                                    <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                                    <div class="col-sm-10">
                                        <input type="file" id="foto" name="foto" class="form-control" accept="images/*" <?= $id_peserta ? '' : ''; ?>>
                                        <!-- <input type="file" id="foto" name="foto" class="form-control" accept="image/*" <?= $id_peserta ? '' : 'required'; ?>> -->
                                    </div>
                                </div>

                                <!-- No Peserta -->
                                <div class="row mb-3">
                                    <label for="noPeserta" class="col-sm-2 col-form-label">No Peserta</label>
                                    <div class="col-sm-10">
                                        <input type="number" readonly class="form-control" id="noPeserta" name="no_peserta" value="<?php echo $pesertaData['no_peserta'] ?? $formatted_no_peserta; ?>" required>
                                    </div>
                                </div>

                                <!-- Nama -->
                                <div class="row mb-3">
                                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $pesertaData['nama'] ?? ''; ?>" required>
                                    </div>
                                </div>

                                <!-- Jenis Kelamin -->
                                <div class="row mb-3">
                                    <label for="jenisKelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="jenisKelamin" name="jenis_kelamin" required>
                                            <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                            <option value="Laki-Laki" <?php echo (isset($pesertaData['jenis_kelamin']) && $pesertaData['jenis_kelamin'] == 'Laki-Laki') ? 'selected' : ''; ?>>Laki-Laki</option>
                                            <option value="Perempuan" <?php echo (isset($pesertaData['jenis_kelamin']) && $pesertaData['jenis_kelamin'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Tempat Lahir -->
                                <div class="row mb-3">
                                    <label for="tempatLahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="tempatLahir" name="tempat_lahir" value="<?php echo $pesertaData['tempat_lahir'] ?? ''; ?>">
                                    </div>
                                </div>

                                <!-- Tanggal Lahir -->
                                <div class="row mb-3">
                                    <label for="tanggalLahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="tanggalLahir" name="tanggal_lahir" value="<?php echo isset($pesertaData['tanggal_lahir']) ? date('Y-m-d', strtotime($pesertaData['tanggal_lahir'])) : ''; ?>">
                                    </div>
                                </div>

                                <!-- Nama Ibu -->
                                <div class="row mb-3">
                                    <label for="namaIbu" class="col-sm-2 col-form-label">Nama Ibu</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="namaIbu" name="nama_ibu" value="<?php echo $pesertaData['nama_ibu'] ?? ''; ?>">
                                    </div>
                                </div>

                                <!-- Nama Ayah -->
                                <div class="row mb-3">
                                    <label for="namaAyah" class="col-sm-2 col-form-label">Nama Ayah</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="namaAyah" name="nama_ayah" value="<?php echo $pesertaData['nama_ayah'] ?? ''; ?>">
                                    </div>
                                </div>

                                <!-- No HP Wali -->
                                <div class="row mb-3">
                                    <label for="noHpWali" class="col-sm-2 col-form-label">No HP Wali</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="noHpWali" name="no_hp_wali" value="<?php echo $pesertaData['no_hp_wali'] ?? ''; ?>">
                                    </div>
                                </div>

                                <!-- Alamat -->
                                <div class="row mb-3">
                                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="alamat" name="alamat"><?php echo $pesertaData['alamat'] ?? ''; ?></textarea>
                                    </div>
                                </div>

                                <hr>

                                <!-- Form Akun -->
                                <h5>Data Akun</h5>

                                <!-- wali -->
                                <div class="row mb-3">
                                    <label for="name" class="col-sm-2 col-form-label">Nama Wali</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama_wali" name="nama_wali" value="<?php echo $pesertaData['name'] ?? ''; ?>">
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="row mb-3">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $pesertaData['email'] ?? ''; ?>">

                                    </div>
                                </div>

                                <?php if (!$pesertaData): ?>
                                    <!-- Password -->
                                    <div class="row mb-3">
                                        <label for="pass" class="col-sm-2 col-form-label">Password</label>
                                        <div class="col-sm-10">
                                            <input type="pass" class="form-control" id="pass" name="pass" <?php echo $pesertaData ? '' : 'required'; ?>>
                                        </div>
                                    </div>

                                <?php else: ?>

                                    <!-- Password Baru (Dengan Checkbox) -->
                                    <div class="row mb-3">
                                        <label for="updatePassword" class="col-sm-2 col-form-label">Perbarui Password</label>
                                        <div class="col-sm-10">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="updatePassword" name="update_password">
                                                <label class="form-check-label" for="updatePassword">
                                                    Ceklis untuk mengubah password
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Form Password Baru (Default Tersembunyi) -->
                                    <div class="row mb-3" id="passwordForm" style="display: none;">
                                        <label for="password" class="col-sm-2 col-form-label">Password Baru</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password Baru">
                                        </div>
                                    </div>

                                <?php endif; ?>

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

    <script>
        // JavaScript untuk mengatur visibilitas form password baru
        document.getElementById("updatePassword").addEventListener("change", function() {
            const passwordForm = document.getElementById("passwordForm");
            if (this.checked) {
                passwordForm.style.display = "block";
            } else {
                passwordForm.style.display = "none";
                document.getElementById("password").value = ""; // Kosongkan field jika tidak digunakan
            }
        });
    </script>

    <script>
        document.getElementById("foto").addEventListener("change", function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById("preview");
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = "../images/blank.png";
            }
        });
    </script>

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