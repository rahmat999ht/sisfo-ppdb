<?php
session_start(); // Mulai session
require_once("koneksi.php");
error_reporting(0);

$id_login = $_SESSION['id_user']; // Ambil id_login dari session

// Periksa apakah pengguna sudah login
if (!$id_login) {
    echo '<script>alert("Anda harus login terlebih dahulu."); window.location.href="login.php";</script>';
    exit;
}

// Ambil data id_peserta dari tabel account
$queryAccount = $koneksi->prepare("SELECT id_peserta FROM account WHERE id = ?");
$queryAccount->bind_param("i", $id_login);
$queryAccount->execute();
$resultAccount = $queryAccount->get_result();
$rowAccount = $resultAccount->fetch_assoc();

$id_peserta = $rowAccount['id_peserta'] ?? null;

$formData = null;

// Jika id_peserta tidak null, ambil data dari tabel peserta
if ($id_peserta) {
    $queryPeserta = $koneksi->prepare("SELECT * FROM peserta WHERE id = ?");
    $queryPeserta->bind_param("i", $id_peserta);
    $queryPeserta->execute();
    $resultPeserta = $queryPeserta->get_result();
    $formData = $resultPeserta->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Sekolah SD</title>
  <!-- CSS dan Font -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <link rel="stylesheet" href="css/css-circular-prog-bar.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <link href="css/style.css" rel="stylesheet" />
  <link href="css/responsive.css" rel="stylesheet" />
</head>

<body class="sub_page">
  <div class="top_container ">
    <?php include 'header.php'; ?>
  </div>

  <div class="common_style">
    <section class="admission_section">
      <div class="container">
        <h2>Formulir Biodata</h2>
        <form action="function/submit_bio.php" method="post" enctype="multipart/form-data">
          <!-- Preview Foto -->
          <div class="form-group">
            <label for="preview">Preview Foto:</label>
            <img id="preview" src="<?= $formData['foto'] ?? 'images/blank.png'; ?>" alt="Preview Foto" style="max-width: 200px; display: block; border: 1px solid #ccc; padding: 5px;" />
          </div>

          <!-- Input Foto -->
          <div class="form-group">
            <label for="foto">Foto:</label>
            <input type="file" id="foto" name="foto" class="form-control" accept="image/*" <?= $id_peserta ? '' : 'required'; ?>>
          </div>

          <!-- Nama Lengkap -->
          <div class="form-group">
            <label for="nama">Nama Lengkap:</label>
            <input type="text" id="nama" name="nama" class="form-control" value="<?= $formData['nama'] ?? ''; ?>" <?= $id_peserta ? 'readonly' : 'required'; ?>>
          </div>

          <!-- Tempat Lahir -->
          <div class="form-group">
            <label for="tempat_lahir">Tempat Lahir:</label>
            <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" value="<?= $formData['tempat_lahir'] ?? ''; ?>" <?= $id_peserta ? 'readonly' : 'required'; ?>>
          </div>

          <!-- Tanggal Lahir -->
          <div class="form-group">
            <label for="tanggal_lahir">Tanggal Lahir:</label>
            <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" value="<?= $formData['tanggal_lahir'] ?? ''; ?>" <?= $id_peserta ? 'readonly' : 'required'; ?>>
          </div>

          <!-- Jenis Kelamin -->
          <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <select id="jenis_kelamin" name="jenis_kelamin" class="form-control" <?= $id_peserta ? 'disabled' : 'required'; ?>>
              <option value="">Pilih Jenis Kelamin</option>
              <option value="Laki-laki" <?= isset($formData['jenis_kelamin']) && $formData['jenis_kelamin'] === 'Laki-laki' ? 'selected' : ''; ?>>Laki-laki</option>
              <option value="Perempuan" <?= isset($formData['jenis_kelamin']) && $formData['jenis_kelamin'] === 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
            </select>
          </div>

          <!-- Nama Ibu -->
          <div class="form-group">
            <label for="nama_ibu">Nama Ibu:</label>
            <input type="text" id="nama_ibu" name="nama_ibu" class="form-control" value="<?= $formData['nama_ibu'] ?? ''; ?>" <?= $id_peserta ? 'readonly' : 'required'; ?>>
          </div>

          <!-- Nama Ayah -->
          <div class="form-group">
            <label for="nama_ayah">Nama Ayah:</label>
            <input type="text" id="nama_ayah" name="nama_ayah" class="form-control" value="<?= $formData['nama_ayah'] ?? ''; ?>" <?= $id_peserta ? 'readonly' : 'required'; ?>>
          </div>

          <!-- Nomor Telepon -->
          <div class="form-group">
            <label for="no_telepon">No.HP Wali:</label>
            <input type="tel" id="no_telepon" name="no_telepon" class="form-control" value="<?= $formData['no_hp_wali'] ?? ''; ?>" <?= $id_peserta ? 'readonly' : 'required'; ?>>
          </div>

          <!-- Alamat -->
          <div class="form-group">
            <label for="alamat">Alamat:</label>
            <textarea id="alamat" name="alamat" class="form-control" rows="3" <?= $id_peserta ? 'readonly' : 'required'; ?>><?= $formData['alamat'] ?? ''; ?></textarea>
          </div>

          <!-- Tombol Submit -->
          <?php if (!$id_peserta) : ?>
            <button type="submit" class="call_to-btn btn_white-border">Kirim Biodata</button>
          <?php else : ?>
            <p>Data Anda sudah terisi. Perubahan hanya dapat dilakukan oleh admin.</p>
          <?php endif; ?>
        </form>
      </div>
    </section>
  </div>

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
        preview.src = "images/blank.png";
      }
    });
  </script>
</body>
</html>
