<?php
session_start(); // Mulai session
require_once("../koneksi.php");
error_reporting(0);

if (!$_SESSION['admin_id']) {
    echo '<script>alert("Anda belum login atau session login berakhir"); window.location.href="admin/login_admin.php";</script>';
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Data Peserta</title>
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
            <h1>Data Peserta</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item">Tables</li>
                    <li class="breadcrumb-item active">Data Peserta</li>
                </ol>
            </nav>
        </div>
        <!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <a href="form-peserta.php" class="btn btn-primary btn-custom my-3">
                                Tambah Peserta
                            </a>

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Foto</th>
                                        <th>No Peserta</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Alamat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM peserta";
                                    $query = mysqli_query($koneksi, $sql);
                                    $no = 1;
                                    while ($row = mysqli_fetch_array($query)) {
                                        $pesertaId = htmlspecialchars($row['id']);
                                        $noPeserta = htmlspecialchars($row['no_peserta']);
                                        $namaPeserta = htmlspecialchars($row['nama']);
                                        $fotoPeserta = !empty($row['foto']) ? '../images/' . htmlspecialchars($row['foto']) : '../images/blank.png';
                                        $jenisKelamin = htmlspecialchars($row['jenis_kelamin']);
                                        $tempatLahir = htmlspecialchars($row['tempat_lahir']);
                                        $tanggalLahir = htmlspecialchars(date('d-m-Y', strtotime($row['tanggal_lahir'])));
                                        $namaOrangTua = htmlspecialchars($row['nama_ayah'] . ' / ' . $row['nama_ibu']);
                                        $noHpWali = htmlspecialchars($row['no_hp_wali']);
                                        $alamatPeserta = htmlspecialchars($row['alamat']);
                                    ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td>
                                                <img src="<?php echo $fotoPeserta; ?>" alt="<?php echo $namaPeserta; ?>" style="width: auto; height: 40px;">
                                            </td>
                                            <td><?php echo $noPeserta; ?></td>
                                            <td><?php echo $namaPeserta; ?></td>
                                            <td><?php echo $jenisKelamin; ?></td>
                                            <td><?php echo $alamatPeserta; ?></td>
                                            <td>
                                                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalDetailPeserta<?php echo $pesertaId; ?>">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                                <!-- Modal Detail Peserta -->
                                                <div class="modal fade" id="modalDetailPeserta<?php echo $pesertaId; ?>" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Detail Peserta</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="modal-body text-center">
                                                                    <img src="<?php echo $fotoPeserta; ?>" alt="<?php echo $namaPeserta; ?>" style="max-width: 100%; height: auto; margin-bottom: 15px;">
                                                                </div>
                                                                <p><strong>Nama:</strong> <?php echo $namaPeserta; ?></p>
                                                                <p><strong>No Peserta:</strong> <?php echo $noPeserta; ?></p>
                                                                <p><strong>Jenis Kelamin:</strong> <?php echo $jenisKelamin; ?></p>
                                                                <p><strong>Tempat, Tanggal Lahir:</strong> <?php echo $tempatLahir . ', ' . $tanggalLahir; ?></p>
                                                                <p><strong>Nama Orang Tua:</strong> <?php echo $namaOrangTua; ?></p>
                                                                <p><strong>No HP Wali:</strong> <?php echo $noHpWali; ?></p>
                                                                <p><strong>Alamat:</strong> <?php echo $alamatPeserta; ?></p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="form-peserta.php?id=<?php echo $pesertaId; ?>" class="btn btn-warning">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <button class="btn btn-danger btn-delete" data-id="<?php echo $pesertaId; ?>">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php $no++;
                                    } ?>
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- End #main -->

    <?php
    include 'footer.php';
    ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.btn-delete');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const pesertaId = this.getAttribute('data-id');

                    if (confirm('Yakin ingin menghapus peserta ini?')) {
                        fetch('func/delete_peserta.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    action: 'delete',
                                    id: pesertaId
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    alert(data.message);
                                    location.reload();
                                } else {
                                    alert(data.message);
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('Terjadi kesalahan saat menghapus peserta.');
                            });
                    }
                });
            });
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