-- Mengatur pengaturan dasar
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Tabel Peserta
CREATE TABLE `peserta` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `no_peserta` INT(11) NOT NULL,
  `nama` VARCHAR(255) NOT NULL,
  `foto` VARCHAR(255),
  `jenis_kelamin` ENUM('Laki-Laki', 'Perempuan') NOT NULL,
  `tempat_lahir` VARCHAR(100),
  `tanggal_lahir` TIMESTAMP,
  `nama_ibu` VARCHAR(255),
  `nama_ayah` VARCHAR(255),
  `no_hp_wali` VARCHAR(15),
  `alamat` VARCHAR(255),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel Hasil Kelulusan
CREATE TABLE `hasil_kelulusan` (
  `id` VARCHAR(50) NOT NULL,
  `keterangan` VARCHAR(255),
  `status` ENUM('Lulus', 'Tidak Lulus') NOT NULL,
  `id_peserta` INT(11),
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_peserta`) REFERENCES `peserta` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel Jarak Rumah
CREATE TABLE `jarak_rumah` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `alamat` VARCHAR(255) NOT NULL,
  `jarak_rumah` VARCHAR(50),
  `nama_kecamatan` VARCHAR(100),
  `nama_kabupaten` VARCHAR(100),
  `id_peserta` INT(11),
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_peserta`) REFERENCES `peserta` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel Admin
CREATE TABLE `admin` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `emailVerified` DATETIME NULL,
  `image` VARCHAR(255) NULL,
  `password` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel Periode Pendaftaran
CREATE TABLE `periode_pendaftaran` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `status` ENUM('Aktif', 'Tidak Aktif') NOT NULL,
  `tanggal_selesai` TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel Account
CREATE TABLE `account` (
  `id` VARCHAR(50) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(100) UNIQUE NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `id_peserta` INT(11),
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_peserta`) REFERENCES `peserta` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Menambah data ke tabel `peserta`
INSERT INTO `peserta` (`no_peserta`, `nama`, `foto`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `nama_ibu`, `nama_ayah`, `no_hp_wali`, `alamat`)
VALUES 
(12345, 'Ahmad Suryadi', 'ahmad.jpg', 'Laki-Laki', 'Jakarta', '2001-05-17', 'Siti Aminah', 'Budi Suryadi', '08123456789', 'Jl. Merdeka No. 10, Jakarta'),
(12346, 'Dewi Lestari', 'dewi.jpg', 'Perempuan', 'Bandung', '2002-08-21', 'Kartini', 'Darma Lestari', '08234567890', 'Jl. Anggrek No. 25, Bandung');

-- Menambah data ke tabel `hasil_kelulusan`
INSERT INTO `hasil_kelulusan` (`id`, `keterangan`, `status`, `id_peserta`)
VALUES 
('HL001', 'Lulus dengan nilai baik', 'Lulus', 1),
('HL002', 'Tidak lulus karena tidak memenuhi syarat', 'Tidak Lulus', 2);

-- Menambah data ke tabel `jarak_rumah`
INSERT INTO `jarak_rumah` (`alamat`, `jarak_rumah`, `nama_kecamatan`, `nama_kabupaten`, `id_peserta`)
VALUES 
('Jl. Merdeka No. 10, Jakarta', '5 km', 'Gambir', 'Jakarta Pusat', 1),
('Jl. Anggrek No. 25, Bandung', '3 km', 'Cicendo', 'Bandung', 2);

-- Menambah data ke tabel `admin`
INSERT INTO `admin` (`name`, `email`, `emailVerified`, `image`, `password`)
VALUES 
('Admin Satu', 'admin1@example.com', '2024-11-04 10:00:00', 'admin1.jpg', 'password123'),
('Admin Dua', 'admin2@example.com', NULL, 'admin2.jpg', 'password456');

-- Menambah data ke tabel `periode_pendaftaran`
INSERT INTO `periode_pendaftaran` (`status`, `tanggal_selesai`)
VALUES 
('Aktif', '2024-12-31 23:59:59'),
('Tidak Aktif', '2023-12-31 23:59:59');

-- Menambah data ke tabel `account`
INSERT INTO `account` (`id`, `name`, `email`, `password`, `id_peserta`)
VALUES 
('ACC001', 'Ahmad Suryadi', 'ahmad@example.com', 'passAhmad123', 1),
('ACC002', 'Dewi Lestari', 'dewi@example.com', 'passDewi456', 2);


COMMIT;
