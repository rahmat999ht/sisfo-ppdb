<?php
require_once("../../koneksi.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data dari form
    $id_peserta = $_POST['id_peserta'];
    $status = $_POST['status'];
    $keterangan = $_POST['keterangan'];

    // Memeriksa apakah data kelulusan sudah ada
    $query = "SELECT * FROM hasil_kelulusan WHERE id_peserta = ?";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id_peserta);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        // Data sudah ada, lakukan update
        $query = "UPDATE hasil_kelulusan SET status = ?, keterangan = ? WHERE id_peserta = ?";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, 'ssi', $status, $keterangan, $id_peserta);
        if (mysqli_stmt_execute($stmt)) {
            echo '<script>alert("Data kelulusan berhasil diperbarui."); window.location.href="../tabel-kelulusan.php";</script>';
        } else {
            echo '<script>alert("Terjadi kesalahan saat memperbarui data."); window.location.href="../tabel-kelulusan.php";</script>';
        }
    } else {
        // Data belum ada, lakukan insert
        $id = uniqid(); // Menghasilkan id unik untuk kelulusan
        $query = "INSERT INTO hasil_kelulusan (id, status, keterangan, id_peserta) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, 'ssss', $id, $status, $keterangan, $id_peserta);
        if (mysqli_stmt_execute($stmt)) {
            echo '<script>alert("Data kelulusan berhasil ditambahkan."); window.location.href="../tabel-kelulusan.php";</script>';
        } else {
            echo '<script>alert("Terjadi kesalahan saat menambahkan data."); window.location.href="../tabel-kelulusan.php";</script>';
        }
    }
}
?>
