-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 06, 2022 at 02:25 AM
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
-- Database: `absensi_depag`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_absensi`
--

CREATE TABLE `tb_absensi` (
  `id_absensi` int(11) NOT NULL,
  `timestamp_absensi` timestamp NOT NULL,
  `status_absensi_id` int(11) NOT NULL,
  `tanggal_mulai` datetime DEFAULT NULL,
  `tanggal_selesai` datetime DEFAULT NULL,
  `dokumen_pendukung` varchar(255) DEFAULT NULL,
  `jenis_cuti` varchar(150) DEFAULT NULL,
  `lembur` tinyint(4) NOT NULL DEFAULT '0',
  `keterangan` text,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `alamat_absensi` text NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `user_id` int(11) NOT NULL,
  `jenis_absensi` enum('masuk','keluar') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_master_jabatan_fungsional`
--

CREATE TABLE `tb_master_jabatan_fungsional` (
  `id_jabatan_fungsional` int(11) NOT NULL,
  `jabatan_fungsional` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_master_jabatan_fungsional`
--

INSERT INTO `tb_master_jabatan_fungsional` (`id_jabatan_fungsional`, `jabatan_fungsional`) VALUES
(1, 'Kepala 1'),
(2, 'Kepala 2');

-- --------------------------------------------------------

--
-- Table structure for table `tb_master_jabatan_struktural`
--

CREATE TABLE `tb_master_jabatan_struktural` (
  `id_master_jabatan_struktural` int(11) NOT NULL,
  `jabatan_struktural` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_master_jabatan_struktural`
--

INSERT INTO `tb_master_jabatan_struktural` (`id_master_jabatan_struktural`, `jabatan_struktural`) VALUES
(1, 'Kepala kantor'),
(2, 'Kepala seksi');

-- --------------------------------------------------------

--
-- Table structure for table `tb_master_jenis_tenaga`
--

CREATE TABLE `tb_master_jenis_tenaga` (
  `id_master_jenis_tenaga` int(11) NOT NULL,
  `jenis_tenaga` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_master_jenis_tenaga`
--

INSERT INTO `tb_master_jenis_tenaga` (`id_master_jenis_tenaga`, `jenis_tenaga`) VALUES
(1, 'Honor'),
(2, 'PNS');

-- --------------------------------------------------------

--
-- Table structure for table `tb_master_level`
--

CREATE TABLE `tb_master_level` (
  `id_level` int(11) NOT NULL,
  `level` varchar(50) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_master_level`
--

INSERT INTO `tb_master_level` (`id_level`, `level`, `is_active`) VALUES
(1, 'pegawai', 1),
(2, 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_master_pangkat_golongan`
--

CREATE TABLE `tb_master_pangkat_golongan` (
  `id_pangkat_golongan` int(11) NOT NULL,
  `pangkat_golongan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_master_pangkat_golongan`
--

INSERT INTO `tb_master_pangkat_golongan` (`id_pangkat_golongan`, `pangkat_golongan`) VALUES
(1, 'Golongan Ia'),
(2, 'Golongan Ib');

-- --------------------------------------------------------

--
-- Table structure for table `tb_master_pns_nonpns`
--

CREATE TABLE `tb_master_pns_nonpns` (
  `id_master_pns_nonpns` int(11) NOT NULL,
  `pns_nonpns` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_master_pns_nonpns`
--

INSERT INTO `tb_master_pns_nonpns` (`id_master_pns_nonpns`, `pns_nonpns`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_master_status_absensi`
--

CREATE TABLE `tb_master_status_absensi` (
  `id_status_absensi` int(11) NOT NULL,
  `status_absensi` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_master_status_absensi`
--

INSERT INTO `tb_master_status_absensi` (`id_status_absensi`, `status_absensi`) VALUES
(1, 'WFO (Rumah)'),
(2, 'WFO (Kantor)'),
(3, 'Sakit'),
(4, 'Cuti'),
(5, 'Dinas Luar');

-- --------------------------------------------------------

--
-- Table structure for table `tb_master_unit_kerja`
--

CREATE TABLE `tb_master_unit_kerja` (
  `id_master_unit_kerja` int(11) NOT NULL,
  `unit_kerja` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_master_unit_kerja`
--

INSERT INTO `tb_master_unit_kerja` (`id_master_unit_kerja`, `unit_kerja`) VALUES
(1, 'Kantor urusan agama kecamatan batang gangsal'),
(2, 'Kantor kementerian agama kab. Indragiri hulu');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pegawai`
--

CREATE TABLE `tb_pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nik` int(18) NOT NULL,
  `nip` int(20) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_hp` varchar(16) NOT NULL,
  `pns_nonpns_id` int(11) NOT NULL,
  `jenis_tenaga_id` int(11) NOT NULL,
  `unit_kerja_id` int(11) NOT NULL,
  `jabatan_struktural_id` int(11) NOT NULL,
  `jabatan_fungsional_id` int(11) NOT NULL,
  `pangkat_golongan_id` int(11) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pegawai`
--

INSERT INTO `tb_pegawai` (`id_pegawai`, `nik`, `nip`, `nama_lengkap`, `email`, `no_hp`, `pns_nonpns_id`, `jenis_tenaga_id`, `unit_kerja_id`, `jabatan_struktural_id`, `jabatan_fungsional_id`, `pangkat_golongan_id`, `is_active`) VALUES
(1, 123456, 654321, 'Ahmad', 'ahmad@gmail.com', '082343216534', 1, 1, 2, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nik` int(18) NOT NULL,
  `nip` int(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level_id` int(11) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama`, `nik`, `nip`, `password`, `level_id`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Ahmad', 123456, 654321, '$2y$10$2J8487haXMNup5mpAlbSUeUVJzcqYZuGqimoQVvWZ8s22oa.tRpQG', 1, 1, '2022-04-05 01:44:13', '2022-04-05 01:44:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  ADD PRIMARY KEY (`id_absensi`),
  ADD KEY `FK_AbsensiMasterStatusAbsensi` (`status_absensi_id`);

--
-- Indexes for table `tb_master_jabatan_fungsional`
--
ALTER TABLE `tb_master_jabatan_fungsional`
  ADD PRIMARY KEY (`id_jabatan_fungsional`);

--
-- Indexes for table `tb_master_jabatan_struktural`
--
ALTER TABLE `tb_master_jabatan_struktural`
  ADD PRIMARY KEY (`id_master_jabatan_struktural`);

--
-- Indexes for table `tb_master_jenis_tenaga`
--
ALTER TABLE `tb_master_jenis_tenaga`
  ADD PRIMARY KEY (`id_master_jenis_tenaga`);

--
-- Indexes for table `tb_master_level`
--
ALTER TABLE `tb_master_level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `tb_master_pangkat_golongan`
--
ALTER TABLE `tb_master_pangkat_golongan`
  ADD PRIMARY KEY (`id_pangkat_golongan`);

--
-- Indexes for table `tb_master_pns_nonpns`
--
ALTER TABLE `tb_master_pns_nonpns`
  ADD PRIMARY KEY (`id_master_pns_nonpns`);

--
-- Indexes for table `tb_master_status_absensi`
--
ALTER TABLE `tb_master_status_absensi`
  ADD PRIMARY KEY (`id_status_absensi`);

--
-- Indexes for table `tb_master_unit_kerja`
--
ALTER TABLE `tb_master_unit_kerja`
  ADD PRIMARY KEY (`id_master_unit_kerja`);

--
-- Indexes for table `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD KEY `FK_PegawaiMasterUnitKerja` (`pns_nonpns_id`),
  ADD KEY `FK_PegawaiMasterJenisTenaga` (`jenis_tenaga_id`),
  ADD KEY `FK_PegawaiMasterUnitKerjaDuplicate` (`unit_kerja_id`),
  ADD KEY `FK_PegawaiMasterJabatanStruktural` (`jabatan_struktural_id`),
  ADD KEY `FK_PegawaiMasterJabatanFungsional` (`jabatan_fungsional_id`),
  ADD KEY `FK_PegawaiMasterPangkatGolongan` (`pangkat_golongan_id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `FK_UserMasterLevel` (`level_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  MODIFY `id_absensi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_master_jabatan_fungsional`
--
ALTER TABLE `tb_master_jabatan_fungsional`
  MODIFY `id_jabatan_fungsional` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_master_jabatan_struktural`
--
ALTER TABLE `tb_master_jabatan_struktural`
  MODIFY `id_master_jabatan_struktural` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_master_jenis_tenaga`
--
ALTER TABLE `tb_master_jenis_tenaga`
  MODIFY `id_master_jenis_tenaga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_master_level`
--
ALTER TABLE `tb_master_level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_master_pangkat_golongan`
--
ALTER TABLE `tb_master_pangkat_golongan`
  MODIFY `id_pangkat_golongan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_master_pns_nonpns`
--
ALTER TABLE `tb_master_pns_nonpns`
  MODIFY `id_master_pns_nonpns` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_master_status_absensi`
--
ALTER TABLE `tb_master_status_absensi`
  MODIFY `id_status_absensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_master_unit_kerja`
--
ALTER TABLE `tb_master_unit_kerja`
  MODIFY `id_master_unit_kerja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  ADD CONSTRAINT `FK_AbsensiMasterStatusAbsensi` FOREIGN KEY (`status_absensi_id`) REFERENCES `tb_master_status_absensi` (`id_status_absensi`);

--
-- Constraints for table `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  ADD CONSTRAINT `FK_PegawaiMasterJabatanFungsional` FOREIGN KEY (`jabatan_fungsional_id`) REFERENCES `tb_master_jabatan_fungsional` (`id_jabatan_fungsional`),
  ADD CONSTRAINT `FK_PegawaiMasterJabatanStruktural` FOREIGN KEY (`jabatan_struktural_id`) REFERENCES `tb_master_jabatan_struktural` (`id_master_jabatan_struktural`),
  ADD CONSTRAINT `FK_PegawaiMasterJenisTenaga` FOREIGN KEY (`jenis_tenaga_id`) REFERENCES `tb_master_jenis_tenaga` (`id_master_jenis_tenaga`),
  ADD CONSTRAINT `FK_PegawaiMasterPangkatGolongan` FOREIGN KEY (`pangkat_golongan_id`) REFERENCES `tb_master_pangkat_golongan` (`id_pangkat_golongan`),
  ADD CONSTRAINT `FK_PegawaiMasterUnitKerja` FOREIGN KEY (`pns_nonpns_id`) REFERENCES `tb_master_pns_nonpns` (`id_master_pns_nonpns`),
  ADD CONSTRAINT `FK_PegawaiMasterUnitKerjaDuplicate` FOREIGN KEY (`unit_kerja_id`) REFERENCES `tb_master_unit_kerja` (`id_master_unit_kerja`);

--
-- Constraints for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `FK_UserMasterLevel` FOREIGN KEY (`level_id`) REFERENCES `tb_master_level` (`id_level`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
