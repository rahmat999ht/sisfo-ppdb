<?php
// ../register.php

// Sertakan file koneksi
require_once '../koneksi.php';

// Fungsi untuk menyimpan data registrasi
function registerAccount($name, $email, $password) {
    global $koneksi;

    // Sanitasi input untuk mencegah SQL Injection
    $name = mysqli_real_escape_string($koneksi, $name);
    $email = mysqli_real_escape_string($koneksi, $email);
    $password = mysqli_real_escape_string($koneksi, $password);

    // Validasi email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<script>alert("Email tidak valid."); window.location.href="../register.php";</script>';
        return;
    }

    // Cek apakah email sudah terdaftar
    $cek_email = "SELECT * FROM account WHERE email = '$email'";
    $result = mysqli_query($koneksi, $cek_email);
    if (mysqli_num_rows($result) > 0) {
        echo '<script>alert("Email sudah terdaftar."); window.location.href="../register.php";</script>';
        return;
    }

    // Hash password
    $hashedPassword = md5($password);

    // Query untuk memasukkan data ke tabel `account`
    $sql = "INSERT INTO account (id, name, email, password) VALUES (?, ?, ?, ?)";

    // Prepare statement
    $stmt = mysqli_prepare($koneksi, $sql);
    if ($stmt === false) {
        die("Error dalam prepare statement: " . mysqli_error($koneksi));
    }

    // Generate ID unik untuk `id` akun
    $id_account = uniqid("ACC");

    // Bind parameter
    mysqli_stmt_bind_param($stmt, "ssss", $id_account, $name, $email, $hashedPassword);

    // Eksekusi query
    if (mysqli_stmt_execute($stmt)) {
        echo '<script>alert("Registrasi berhasil!"); window.location.href="../login.php";</script>';
    } else {
        echo '<script>alert("Registrasi gagal: ' . mysqli_stmt_error($stmt) . '"); window.location.href="../register.php";</script>';
    }

    // Tutup statement
    mysqli_stmt_close($stmt);
}

// Cek apakah form telah di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil dan sanitasi data dari form
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validasi input dasar
    if (empty($name) || empty($email) || empty($password)) {
        echo '<script>alert("Semua field harus diisi."); window.location.href="../register.php";</script>';
    } else {
        // Panggil fungsi registrasi
        registerAccount($name, $email, $password);
    }
}

// Tutup koneksi
mysqli_close($koneksi);
?>
