<?php
include_once("../../koneksi.php");

function login($username, $password)
{
    global $koneksi;

    // Meng-hash password yang dimasukkan
    $hashedPassword = md5($password);

    // Menyiapkan query SQL menggunakan prepared statements
    $stmt = mysqli_prepare($koneksi, "SELECT * FROM admin WHERE username = ? AND password = ?");
    mysqli_stmt_bind_param($stmt, "ss", $username, $hashedPassword);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        $ketemu = mysqli_num_rows($result);
        $b = mysqli_fetch_array($result);

        if ($ketemu > 0) {
            session_start();
            $_SESSION['admin_id'] = $b['id'];
            $_SESSION['admin_username'] = $b['username'];
            echo '<script>alert("Anda berhasil login"); window.location.href="../index.php";</script>';
        } else {
            echo '<script>alert("Username/Password salah atau akun Anda belum aktif."); window.location.href="../login_admin.php";</script>';
        }
    } else {
        echo '<script>alert("Query Error: ' . mysqli_error($koneksi) . '"); window.location.href="../login_admin.php";</script>';
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Panggil fungsi login
    login($username, $password);
}
