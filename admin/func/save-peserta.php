<?php
// Mulai session
session_start();

// Panggil koneksi database
require_once("../../koneksi.php");

function savePeserta($koneksi)
{
    // Periksa apakah form telah di-submit
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Ambil data dari form
        $id = isset($_POST['id']) ? intval($_POST['id']) : null;
        $no_peserta = mysqli_real_escape_string($koneksi, $_POST['no_peserta']);
        $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
        $jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
        $tempat_lahir = mysqli_real_escape_string($koneksi, $_POST['tempat_lahir']);
        $tanggal_lahir = mysqli_real_escape_string($koneksi, $_POST['tanggal_lahir']);
        $nama_ibu = mysqli_real_escape_string($koneksi, $_POST['nama_ibu']);
        $nama_ayah = mysqli_real_escape_string($koneksi, $_POST['nama_ayah']);
        $no_hp_wali = mysqli_real_escape_string($koneksi, $_POST['no_hp_wali']);
        $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
        $nama_wali = mysqli_real_escape_string($koneksi, $_POST['nama_wali']);
        $email = mysqli_real_escape_string($koneksi, $_POST['email']);

        $foto = null;
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $foto = "images/" . basename($_FILES['foto']['name']);
            move_uploaded_file($_FILES['foto']['tmp_name'], "../../" . $foto);
        }

        // Password baru jika diperlukan
        $password = null;
        if (isset($_POST['update_password']) && $_POST['update_password'] === 'on') {
            $password = password_hash(mysqli_real_escape_string($koneksi, $_POST['password']), PASSWORD_BCRYPT);
        } elseif (!$id) { // Tambahkan password baru jika peserta baru
            $password = password_hash(mysqli_real_escape_string($koneksi, $_POST['pass']), PASSWORD_BCRYPT);
        }

        if ($id) {
            // Update data peserta
            $query = "UPDATE peserta SET 
                        no_peserta = '$no_peserta', 
                        nama = '$nama', 
                        jenis_kelamin = '$jenis_kelamin', 
                        tempat_lahir = '$tempat_lahir', 
                        tanggal_lahir = '$tanggal_lahir', 
                        nama_ibu = '$nama_ibu', 
                        nama_ayah = '$nama_ayah', 
                        no_hp_wali = '$no_hp_wali', 
                        alamat = '$alamat',
                        foto = IF('$foto' != '', '$foto', foto)
                      WHERE id = $id";

            if (mysqli_query($koneksi, $query)) {
                // Update data akun jika ada
                if ($password || $email) {
                    $queryAccount = "UPDATE account SET 
                                        email = '$email', 
                                        password = IF('$password' != '', '$password', password)
                                      WHERE id_peserta = $id";
                    mysqli_query($koneksi, $queryAccount);
                }

                echo '<script>alert("Data peserta berhasil diperbarui."); window.location.href="../tabel-peserta.php";</script>';
            } else {
                echo '<script>alert("Gagal memperbarui data peserta."); window.history.back();</script>';
            }
        } else {
            // Insert data peserta baru
            $query = "INSERT INTO peserta (no_peserta, nama, jenis_kelamin, tempat_lahir, tanggal_lahir, nama_ibu, nama_ayah, no_hp_wali, alamat, foto) 
                    VALUES ('$no_peserta', '$nama', '$jenis_kelamin', '$tempat_lahir', '$tanggal_lahir', '$nama_ibu', '$nama_ayah', '$no_hp_wali', '$alamat', '$foto')";

            if (mysqli_query($koneksi, $query)) {
                $newId = mysqli_insert_id($koneksi);
                // Check if email already exists
                $emailCheckQuery = "SELECT * FROM account WHERE email = '$email'";
                $emailCheckResult = mysqli_query($koneksi, $emailCheckQuery);

                if (mysqli_num_rows($emailCheckResult) > 0) {
                    // Email already exists, show an error or handle accordingly
                    echo '<script>alert("Email sudah terdaftar. Silakan gunakan email lain."); window.history.back();</script>';
                    exit;
                } else {
                    // Proceed with inserting the new account
                    $queryAccount = "INSERT INTO account (id_peserta, name, email, password) 
                     VALUES ('$newId', '$nama_wali', '$email', '$password')";

                    if (mysqli_query($koneksi, $queryAccount)) {
                        echo '<script>alert("Data peserta berhasil ditambahkan."); window.location.href="../tabel-peserta.php";</script>';
                    } else {
                        echo '<script>alert("Gagal menambahkan data akun."); window.history.back();</script>';
                    }
                }
            } else {
                echo '<script>alert("Gagal menambahkan data peserta."); window.history.back();</script>';
            }
        }
    }
}

// Panggil fungsi
savePeserta($koneksi);
