<?php
session_start(); // Mulai session
require_once("../../koneksi.php");
error_reporting(0);

if (!$_SESSION['admin_id']) {
    echo '<script>alert("Anda belum login atau session login berakhir"); window.location.href="admin/login_admin.php";</script>';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = intval($_GET['id']); // Mengamankan input ID

    // Periksa apakah ID ada di database
    $queryCheck = "SELECT * FROM periode_pendaftaran WHERE id = $id";
    $resultCheck = mysqli_query($koneksi, $queryCheck);

    if ($resultCheck && mysqli_num_rows($resultCheck) > 0) {
        // Hapus data
        $queryDelete = "DELETE FROM periode_pendaftaran WHERE id = $id";
        $resultDelete = mysqli_query($koneksi, $queryDelete);

        if ($resultDelete) {
            echo '<script>alert("Data periode berhasil dihapus."); window.location.href="../tabel-periode.php";</script>';
        } else {
            echo '<script>alert("Gagal menghapus data periode."); window.location.href="../tabel-periode.php";</script>';
        }
    } else {
        echo '<script>alert("Data periode tidak ditemukan."); window.location.href="../tabel-periode.php";</script>';
    }
} else {
    echo '<script>alert("Permintaan tidak valid."); window.location.href="../tabel-periode.php";</script>';
}