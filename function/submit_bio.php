<?php
// Mulai session
session_start();

// Panggil koneksi database
require_once("../koneksi.php");

// Cek apakah data dikirim melalui POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $nama = $_POST['nama'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $nama_ibu = $_POST['nama_ibu'];
    $nama_ayah = $_POST['nama_ayah'];
    $no_hp_wali = $_POST['no_telepon'];
    $alamat = $_POST['alamat'];
    $id_login = $_SESSION['id_user'] ?? null; // Ambil id_login dari session

    // Validasi login
    if (!$id_login) {
        echo '<script>alert("Anda harus login terlebih dahulu."); window.location.href="../login.php";</script>';
        exit;
    }

    // Handle upload foto
    $foto = null;
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        if ($_FILES['foto']['size'] > 2 * 1024 * 1024) { // Maksimal 2 MB
            echo '<script>alert("Ukuran file terlalu besar."); history.back();</script>';
            exit;
        }

        $allowedTypes = ['image/jpeg', 'image/png'];
        if (!in_array($_FILES['foto']['type'], $allowedTypes)) {
            echo '<script>alert("Jenis file tidak diizinkan."); history.back();</script>';
            exit;
        }

        $foto = 'images/' . basename($_FILES['foto']['name']);
        if (!move_uploaded_file($_FILES['foto']['tmp_name'], $foto)) {
            echo '<script>alert("Gagal mengunggah foto."); history.back();</script>';
            exit;
        }
    }

    try {
        // Mulai transaksi
        $koneksi->begin_transaction();

        // Ambil nomor peserta terakhir
        $result = $koneksi->query("SELECT MAX(no_peserta) AS last_no FROM peserta");
        $row = $result->fetch_assoc();
        $no_peserta = $row['last_no'] ? $row['last_no'] + 1 : 1; // Jika kosong, mulai dari 1

        // Tambahkan data ke tabel peserta
        $stmtPeserta = $koneksi->prepare("
            INSERT INTO peserta (no_peserta, nama, foto, jenis_kelamin, tempat_lahir, tanggal_lahir, nama_ibu, nama_ayah, no_hp_wali, alamat)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmtPeserta->bind_param("isssssssss", $no_peserta, $nama, $foto, $jenis_kelamin, $tempat_lahir, $tanggal_lahir, $nama_ibu, $nama_ayah, $no_hp_wali, $alamat);
        $stmtPeserta->execute();

        // Ambil ID peserta yang baru saja ditambahkan
        $id_peserta = $koneksi->insert_id;

        // Perbarui tabel account
        $stmtAccount = $koneksi->prepare("
            UPDATE account
            SET id_peserta = ?
            WHERE id = ?
        ");
        $stmtAccount->bind_param("is", $id_peserta, $id_login);
        $stmtAccount->execute();

        // Commit transaksi
        $koneksi->commit();

        // Tampilkan alert sukses dan redirect
        echo '<script>alert("Data berhasil ditambahkan."); window.location.href="../index.php";</script>';
    } catch (Exception $e) {
        // Rollback jika terjadi kesalahan
        $koneksi->rollback();

        // Tampilkan alert error dan kembali ke halaman sebelumnya
        echo '<script>alert("Terjadi kesalahan: ' . $e->getMessage() . '"); history.back();</script>';
    }
}
?>
