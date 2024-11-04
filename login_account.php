<?php

include_once "koneksi.php";

function login($email, $password)
{
    global $koneksi;

    // Meng-hash password yang dimasukkan
    $hashedPassword = md5($password);

    // Debugging: Periksa email dan hashed password
    var_dump($email);
    var_dump($hashedPassword);

    // Menyiapkan query SQL menggunakan prepared statements
    $stmt = mysqli_prepare($koneksi, "SELECT * FROM account WHERE email = ? AND password = ?");
    mysqli_stmt_bind_param($stmt, "ss", $email, $hashedPassword);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        $ketemu = mysqli_num_rows($result);
        $b = mysqli_fetch_array($result);

        if ($ketemu > 0) {
            session_start();
            $_SESSION['id_user'] = $b['id'];
            $_SESSION['username'] = $b['name']; // Jika ingin tetap menyimpan nama pengguna
            $_SESSION['email'] = $b['email'];
            echo '<script>alert("Login successful!"); window.location.href="index.php";</script>';
        } else {
            echo '<script>alert("Email/Password salah."); window.location.href="login.php";</script>';
        }
    } else {
        echo '<script>alert("Query Error: ' . mysqli_error($koneksi) . '"); window.location.href="index.php";</script>';
    }
}

// Memanggil fungsi login saat form login disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email']; // Ganti username dengan email
    $password = $_POST['password'];
    login($email, $password);
}

?>
