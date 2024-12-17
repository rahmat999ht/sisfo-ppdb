<?php
session_start();
require_once("../../koneksi.php");
error_reporting(0);

if (!$_SESSION['admin_id']) {
    echo '<script>alert("Anda belum login atau session login berakhir"); window.location.href="../admin/login_admin.php";</script>';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : null;
    $status = mysqli_real_escape_string($koneksi, $_POST['status']);
    $tanggal_selesai = mysqli_real_escape_string($koneksi, $_POST['tanggal_selesai']);
    $jadwal_test = mysqli_real_escape_string($koneksi, $_POST['jadwal_test']);

    // Validasi input
    if (empty($status) || empty($tanggal_selesai) || empty($jadwal_test)) {
        echo '<script>alert("Semua field harus diisi!"); window.location.href="../tabel-periode.php";</script>';
        exit;
    }

    if ($id) {
        // Update data
        $query = "UPDATE periode_pendaftaran 
                  SET status = '$status', 
                      tanggal_selesai = '$tanggal_selesai', 
                      jadwal_test = '$jadwal_test' 
                  WHERE id = $id";
    } else {
        // Tambah data baru
        $query = "INSERT INTO periode_pendaftaran (status, tanggal_selesai, jadwal_test) 
                  VALUES ('$status', '$tanggal_selesai', '$jadwal_test')";
    }

    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo '<script>alert("Data berhasil disimpan!"); window.location.href="../tabel-periode.php";</script>';
    } else {
        echo '<script>alert("Gagal menyimpan data: ' . mysqli_error($koneksi) . '"); window.location.href="../tabel-periode.php";</script>';
    }
} else {
    echo '<script>alert("Akses tidak diizinkan!"); window.location.href="../tabel-periode.php";</script>';
    exit;
}
?>
