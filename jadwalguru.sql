-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 01, 2026 at 09:52 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jadwalguru`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_jadwal`
--

CREATE TABLE `detail_jadwal` (
  `id_detail` int(11) NOT NULL,
  `id_jadwal` int(10) NOT NULL,
  `kd_mapel` int(10) NOT NULL,
  `kd_guru` int(5) NOT NULL,
  `hari` varchar(15) NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_jadwal`
--

INSERT INTO `detail_jadwal` (`id_detail`, `id_jadwal`, `kd_mapel`, `kd_guru`, `hari`, `jam_mulai`, `jam_selesai`) VALUES
(1, 1, 100, 100, 'Selasa', '09:00:00', '11:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ekstra_2511500058`
--

CREATE TABLE `ekstra_2511500058` (
  `id_ekstra` int(5) NOT NULL,
  `nama_ekstra` varchar(50) NOT NULL,
  `ket` varchar(20) NOT NULL,
  `semester` int(5) NOT NULL,
  `thn_ajaran` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ekstra_2511500058`
--

INSERT INTO `ekstra_2511500058` (`id_ekstra`, `nama_ekstra`, `ket`, `semester`, `thn_ajaran`) VALUES
(100, 'AECC', 'Gamer', 1, '2023/2024');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `kd_guru` int(5) NOT NULL,
  `nm_guru` varchar(50) NOT NULL,
  `jenkel` varchar(10) NOT NULL,
  `pend_terakhir` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`kd_guru`, `nm_guru`, `jenkel`, `pend_terakhir`) VALUES
(100, 'Sarah', 'Perempuan', 'S2');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_kelas`
--

CREATE TABLE `jadwal_kelas` (
  `id_jadwal` int(10) NOT NULL,
  `kd_guru` int(5) NOT NULL,
  `id_kelas` int(10) NOT NULL,
  `thn_ajaran` varchar(20) NOT NULL,
  `semester` enum('ganjil','genap') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal_kelas`
--

INSERT INTO `jadwal_kelas` (`id_jadwal`, `kd_guru`, `id_kelas`, `thn_ajaran`, `semester`) VALUES
(1, 100, 110, '2025/2026', 'genap');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(10) NOT NULL,
  `nm_kelas` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nm_kelas`) VALUES
(110, 'TI2B');

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `kd_mapel` int(10) NOT NULL,
  `nm_mapel` varchar(10) NOT NULL,
  `kkm` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`kd_mapel`, `nm_mapel`, `kkm`) VALUES
(100, 'PWT', 75);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nis` int(10) NOT NULL,
  `nm_siswa` varchar(20) NOT NULL,
  `jenkel` varchar(20) NOT NULL,
  `id_kelas` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nis`, `nm_siswa`, `jenkel`, `id_kelas`) VALUES
(555, 'Tio', 'L', 12);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id_users` int(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','guru','siswa') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id_users`, `username`, `password`, `role`) VALUES
(1, 'admin', 'admin', 'admin'),
(11, 'guru', '1111', 'guru'),
(13, 'siswa', '1112', 'siswa'),
(32, '100', '1212', 'guru'),
(35, '100', '1234', 'guru'),
(37, '555', '1111', 'siswa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_jadwal`
--
ALTER TABLE `detail_jadwal`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `kd_mapel` (`kd_mapel`),
  ADD KEY `kd_guru` (`kd_guru`),
  ADD KEY `id_jadwal` (`id_jadwal`);

--
-- Indexes for table `ekstra_2511500058`
--
ALTER TABLE `ekstra_2511500058`
  ADD PRIMARY KEY (`id_ekstra`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`kd_guru`);

--
-- Indexes for table `jadwal_kelas`
--
ALTER TABLE `jadwal_kelas`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `kd_guru` (`kd_guru`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`kd_mapel`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_jadwal`
--
ALTER TABLE `detail_jadwal`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ekstra_2511500058`
--
ALTER TABLE `ekstra_2511500058`
  MODIFY `id_ekstra` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `jadwal_kelas`
--
ALTER TABLE `jadwal_kelas`
  MODIFY `id_jadwal` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `kd_mapel` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id_users` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
