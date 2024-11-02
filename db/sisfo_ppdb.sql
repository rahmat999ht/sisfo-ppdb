-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 21, 2020 at 07:38 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Atur charset dan collation
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------
-- Database: `karyawansi`
-- --------------------------------------------------------

--
-- Table structure for table `tb_mahasiswa`
--

CREATE TABLE `tb_mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tmp_tgl_lahir` varchar(255) NOT NULL,
  `jenkel` ENUM('Laki-laki', 'Perempuan') NOT NULL,
  `agama` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `no_tel` varchar(18) NOT NULL,
  `foto` varchar(50) NOT NULL,
  PRIMARY KEY (`id_mahasiswa`)  -- Tambahkan primary key
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert data ke tb_mahasiswa
INSERT INTO `tb_mahasiswa` (`id_mahasiswa`, `username`, `password`, `nama`, `tmp_tgl_lahir`, `jenkel`, `agama`, `alamat`, `no_tel`, `foto`) VALUES
(220001, 'Abdul', 'd41d8cd98f00b204e9800998ecf8427e', 'Abdul Muhlisin Sudirman', 'Klaten / 19-09-1994', 'Laki-laki', 'Islam', 'China', '0895635721923',  '21092020072509employee1.png'),
(220002, 'sarah', '9e9d7a08e048e9d604b79460b54969c3', 'Sarah Mutia', 'Cianjur / 10-12-1992', 'Perempuan', 'Islam', '', '08128384848', '10092020025112employee3.png'),
(220003, 'bagas', 'ee776a18253721efe8a62e4abd29dc47', 'bagas a', 'Jakarta / 10-01-1990', 'Laki-laki', 'Islam', 'Jakarta', '0895628383333', '10092020024120employee3.png'),
(220004, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'Budi Sanjaya', 'Bekasi / 10-12-1980', 'Laki-laki', 'Kristen', '', '0895254859994', '10092020023942employee1.png');

-- --------------------------------------------------------
-- Table structure for table `tb_absensi`
--
CREATE TABLE `tb_absensi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `tgl_masuk` varchar(255) NOT NULL,
  `tgl_keluar` varchar(255),
  `jam_masuk` varchar(255) NOT NULL,
  `jam_keluar` varchar(255),
  `long` varchar(50) NOT NULL,
  `lat` varchar(50) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  PRIMARY KEY (`id`),  -- Primary key di tb_absensi
  INDEX (`id_mahasiswa`),  -- Tambahkan index untuk kolom foreign key
  CONSTRAINT `fk_tb_absensi_mahasiswa` FOREIGN KEY (`id_mahasiswa`) 
    REFERENCES `tb_mahasiswa` (`id_mahasiswa`)
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert data ke tb_absensi
INSERT INTO `tb_absensi` (`id`, `id_mahasiswa`, `nama`, `tgl_masuk`, `tgl_keluar`, `jam_masuk`, `jam_keluar`, `long`, `lat`) VALUES
(16, 220004, 'Budi Sanjaya', '2020-09-10', '2020-09-10', '07:52:25', '17:52:25', '-5.140265823643097', '119.48310235406784'),
(17, 220002, 'Sarah Mutia', '2020-09-10', '2020-09-10', '07:54:45', '17:54:45', '-5.140265823643097', '119.48310235406784'),
(18, 220001, 'Abdul Muhlisin Sudirman', '2020-09-20', '2020-09-20', '13:31:05', '17:31:05', '-5.140265823643097', '119.48310235406784');

-- --------------------------------------------------------
-- Table structure for table `tb_izin`
--
CREATE TABLE `tb_izin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `keterangan` ENUM('Sakit', 'Izin', 'Keperluan keluarga') NOT NULL,
  `alasan` varchar(255) NOT NULL,
  `waktu` varchar(255) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX (`id_mahasiswa`),  -- Tambahkan index untuk kolom foreign key
  CONSTRAINT `fk_tb_izin_mahasiswa` FOREIGN KEY (`id_mahasiswa`) 
    REFERENCES `tb_mahasiswa` (`id_mahasiswa`)
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert data ke tb_izin
INSERT INTO `tb_izin` (`id`, `id_mahasiswa`, `nama`, `keterangan`, `alasan`, `waktu`) VALUES
(16, 220004, 'Budi Sanjaya', 'Sakit', 'Saya Sakit Pak', '2020-09-10 07:52:25'),
(17, 220002, 'Sarah Mutia', 'Izin', 'Saya harus pergi', '2020-09-10 07:54:45'),
(18, 220001, 'Abdul Muhlisin Sudirman', 'Izin', 'Keperluan keluarga', '2020-09-20 13:31:05');

-- --------------------------------------------------------
-- Table structure for table `tb_pembimbing`
--
CREATE TABLE `tb_pembimbing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert data ke tb_pembimbing
INSERT INTO `tb_pembimbing` (`id`, `username`, `password`) VALUES
(2, 'pembimbing', 'pembimbing'),
(5, 'pembimbing2', 'pembimbing2');

-- --------------------------------------------------------
-- Table structure for table `tb_dokumentasi`
--
CREATE TABLE `tb_dokumentasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `asal_kampus` varchar(255) NOT NULL,
  `bidang_penempatan` varchar(255) NOT NULL,
  `nama_kegiatan` varchar(255) NOT NULL,
  `waktu` varchar(255) NOT NULL,
  `id_mahasiswa` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX (`id_mahasiswa`),  -- Tambahkan index untuk kolom foreign key
  CONSTRAINT `fk_tb_dokumentasi_mahasiswa` FOREIGN KEY (`id_mahasiswa`) 
    REFERENCES `tb_mahasiswa` (`id_mahasiswa`)
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert data ke tb_dokumentasi
INSERT INTO `tb_dokumentasi` (`id`, `id_mahasiswa`, `nama`, `asal_kampus`, `bidang_penempatan`, `nama_kegiatan`, `waktu`) VALUES
(51, 220001, 'Abdul Muhlisin Sudirman', 'STMIK Indonesia', 'IT Programmer', 'Buat Aplikasi', '2020-09-20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tb_absensi`
  ADD CONSTRAINT `fk_tb_absensi_mahasiswa` 
  FOREIGN KEY (`id_mahasiswa`) 
  REFERENCES `tb_mahasiswa` (`id_mahasiswa`) 
  ON DELETE CASCADE 

--
-- Indexes for table `tb_pembimbing`
--

ALTER TABLE `tb_pembimbing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_mahasiswa`
--
ALTER TABLE `tb_mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`);

--
-- Indexes for table `tb_dokumentasi`
--
ALTER TABLE `tb_dokumentasi`
  ADD PRIMARY KEY (`id`);
  ADD CONSTRAINT `fk_tb_dokumentasi_mahasiswa` FOREIGN KEY (`id_mahasiswa`) REFERENCES `tb_mahasiswa` (`id_mahasiswa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

-- Tabel tb_izin dengan FK
ALTER TABLE `tb_izin`
  ADD CONSTRAINT `fk_tb_izin_mahasiswa` FOREIGN KEY (`id_mahasiswa`) REFERENCES `tb_mahasiswa` (`id_mahasiswa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- AUTO_INCREMENT for table `tb_pembimbing`
--
ALTER TABLE `tb_pembimbing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_dokumentasi`
--
ALTER TABLE `tb_dokumentasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
