-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2022 at 04:26 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_penjurusan`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_guru`
--

CREATE TABLE `tb_guru` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nip` int(16) NOT NULL,
  `alamat` text NOT NULL,
  `foto` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_guru`
--

INSERT INTO `tb_guru` (`id`, `user_id`, `nama`, `username`, `nip`, `alamat`, `foto`, `email`, `created_at`, `updated_at`) VALUES
(1, 2, 'Guru Kuy', 'guru', 2222222, 'uiuiu hjhuh', '124345456_images.jpeg', 'gurukuy@gmail.com', '2022-03-26 02:47:09', '2022-03-31 16:23:14'),
(2, 9, 'Rila', 'rila c', 11223344, 'Jalans dsdksd', '', 'rila@gmail.com', '2022-03-26 14:58:19', '2022-03-26 14:58:19'),
(3, 14, 'Rila', 'rilab', 11223344, 'Jalans dsdksd', '', 'rila@gmail.com', '2022-03-27 15:38:15', '2022-03-27 15:38:15'),
(4, 16, 'helo', 'helo', 122434545, 'helo', '', 'helo@gmail.com', '2022-04-02 07:56:03', '2022-04-02 07:56:03'),
(5, 17, 'hoi', 'hoi', 12323434, 'gfgfg', '', 'gfgfg@gmail.com', '2022-04-02 08:03:20', '2022-04-02 08:03:20'),
(6, 18, 'ghghg', 'tes', 545476, 'hjhjjh', '', 'ghghghg', '2022-04-02 08:12:53', '2022-04-02 08:12:53');

-- --------------------------------------------------------

--
-- Table structure for table `tb_hasil`
--

CREATE TABLE `tb_hasil` (
  `id_hasil` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `hasil_akhir` varchar(3) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_hasil`
--

INSERT INTO `tb_hasil` (`id_hasil`, `siswa_id`, `hasil_akhir`, `created_at`, `updated_at`) VALUES
(1, 1, 'IPA', '2022-03-26 02:05:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_hasil_detail`
--

CREATE TABLE `tb_hasil_detail` (
  `id_hasil_detail` int(11) NOT NULL,
  `hasil_id` int(11) NOT NULL,
  `jawaban_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_hasil_detail`
--

INSERT INTO `tb_hasil_detail` (`id_hasil_detail`, `hasil_id`, `jawaban_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2022-03-26 02:05:53', NULL),
(2, 1, 2, '2022-03-26 02:05:53', NULL),
(3, 1, 3, '2022-03-26 02:05:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_jawaban`
--

CREATE TABLE `tb_jawaban` (
  `id_jawaban` int(11) NOT NULL,
  `pertanyaan_id` int(11) NOT NULL,
  `jawaban` varchar(100) NOT NULL,
  `skor` varchar(3) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jawaban`
--

INSERT INTO `tb_jawaban` (`id_jawaban`, `pertanyaan_id`, `jawaban`, `skor`, `created_at`, `updated_at`) VALUES
(1, 1, 'Jawaban A', 'IPA', '2022-03-26 02:06:41', NULL),
(2, 1, 'Jawaban B', 'IPA', '2022-03-26 02:06:41', NULL),
(3, 1, 'Jawaban C', 'IPS', '2022-03-26 02:06:41', NULL),
(4, 1, 'Jawaban D', 'IPS', '2022-03-26 02:06:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_nilai_siswa`
--

CREATE TABLE `tb_nilai_siswa` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rata_raport_ipa` double NOT NULL,
  `rata_raport_ips` double NOT NULL,
  `rata_akhir` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_nilai_siswa`
--

INSERT INTO `tb_nilai_siswa` (`id`, `user_id`, `rata_raport_ipa`, `rata_raport_ips`, `rata_akhir`, `created_at`, `updated_at`) VALUES
(14, 13, 45, 67, 56, '2022-04-03 12:56:49', '2022-04-03 12:56:49'),
(15, 2, 45, 67, 56, '2022-04-03 14:06:15', '2022-04-03 14:06:15');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pertanyaan`
--

CREATE TABLE `tb_pertanyaan` (
  `id_pertanyaan` int(11) NOT NULL,
  `pertanyaan` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pertanyaan`
--

INSERT INTO `tb_pertanyaan` (`id_pertanyaan`, `pertanyaan`, `created_at`, `updated_at`) VALUES
(1, 'Pertanyaan 1', '2022-03-26 02:06:58', NULL),
(2, 'Pertanyaan 2', '2022-03-26 02:06:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nisn` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `agama` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `foto` varchar(50) NOT NULL,
  `asal_sekolah` varchar(50) NOT NULL,
  `status_asal_sekolah` varchar(50) NOT NULL,
  `nama_ayah` varchar(50) NOT NULL,
  `umur_ayah` varchar(50) NOT NULL,
  `agama_ayah` varchar(50) NOT NULL,
  `pendidikan_terakhir_ayah` varchar(50) NOT NULL,
  `pekerjaan_ayah` varchar(50) NOT NULL,
  `nama_ibu` varchar(50) NOT NULL,
  `umur_ibu` varchar(50) NOT NULL,
  `agama_ibu` varchar(50) NOT NULL,
  `pendidikan_terakhir_ibu` varchar(50) NOT NULL,
  `pekerjaan_ibu` varchar(50) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_siswa`
--

INSERT INTO `tb_siswa` (`id`, `user_id`, `username`, `nisn`, `nama`, `kelas`, `tanggal_lahir`, `agama`, `alamat`, `foto`, `asal_sekolah`, `status_asal_sekolah`, `nama_ayah`, `umur_ayah`, `agama_ayah`, `pendidikan_terakhir_ayah`, `pekerjaan_ayah`, `nama_ibu`, `umur_ibu`, `agama_ibu`, `pendidikan_terakhir_ibu`, `pekerjaan_ibu`, `tempat_lahir`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', '111111111111', 'Murid Hei', 'II IPS', '2022-02-04', 'Islam', 'rengat', '12345_images.jpeg', 'SMAN 1', 'Negeri', 'Dudung', '49', 'Islam', 'D3/S1', 'Guru', 'Walia', '45', 'Islam', 'D3/S1', 'Guru', 'Rengat', '2022-04-03 12:32:06', '2022-04-03 12:32:06'),
(2, 13, 'ridho', '123224343', 'Ridho Afni', 'II IPS', '2022-02-04', 'Islam', 'Jalan negara', '', 'SMAN 1', 'Negeri', 'Ayah', '12', 'Islam', 'D3/S1', 'Karyawan', 'Rohina', '40', 'Islam', 'D3/S1', 'Karyawan', 'riau', '2022-03-30 13:47:33', '2022-03-26 15:08:52'),
(3, 15, 'ridhos', '123224343', 'Ridho Afni', 'II IPS', '2022-02-04', 'Islam', 'Jalan negara', '', 'SMAN 1', 'Negeri', 'Ayah', '12', 'Islam', 'D3/S1', 'Karyawan', 'Rohina', '40', 'Islam', 'D3/S1', 'Karyawan', 'riau', '2022-03-30 13:47:35', '2022-03-27 16:03:50'),
(4, 19, 'huhu', '4545', 'hjhjhj', 'II IPA', '2022-04-02', 'Buddha', 'hghgh', '', 'hjhj', 'hhhh', 'yy', '', 'Kristen Protestan', 'S2', 'ihih', 'jhh', '87', 'Kristen Protestan', 'S2', 'hhh', 'gghghg', '2022-04-02 08:14:21', '2022-04-02 08:14:21');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('siswa','guru') NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `level`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$vctn6Ifhyzl1/SKdEJ7Nc.kiKOkDcGyhbKuimjoVLUq1tiTc7e3xe', 'siswa', '2022-02-06 01:23:41', '2022-03-23 04:41:15', '2022-04-01 02:57:06'),
(2, 'guru', '$2y$10$vctn6Ifhyzl1/SKdEJ7Nc.kiKOkDcGyhbKuimjoVLUq1tiTc7e3xe', 'guru', '2022-03-26 02:47:09', '2022-03-26 02:47:09', '2022-03-31 16:20:17'),
(9, 'rila c', '$2y$10$Rmc/gAUL8QxiLrpRzlWA1eJSnr88Bh1qOk/ia3Aw/BnwbWH1WkZC6', 'guru', '2022-03-26 14:58:19', '2022-03-26 14:58:19', '2022-03-26 14:58:19'),
(13, 'ridho', '$2y$10$dOtf4m.0iqWTWNIsTTbZsOxVYXc5q4my1iMjY0Ef4f//.r8Q1AY5y', 'siswa', '2022-03-26 15:08:52', '2022-03-26 15:08:52', '2022-03-26 15:08:52'),
(14, 'rilab', '$2y$10$zvPmtt5tsvATMsn4.3LCuerpsWoXf55i3ESUhDaS8yE0SJ5Gr12nW', 'guru', '2022-03-27 15:38:15', '2022-03-27 15:38:15', '2022-03-27 15:38:15'),
(15, 'ridhos', '$2y$10$NytMZPoh.FGuytXrt2K/WuoBfJc9MxLrfuBhJuCiB9S3e7DWJkv.a', 'siswa', '2022-03-27 16:03:50', '2022-03-27 16:03:50', '2022-03-27 16:03:50'),
(16, 'helo', '$2y$10$dsBCBBfV16428hFfeb9bF.lfomSgkhu0rj5PWiCeWdXkOFeM4qHw.', 'guru', '2022-04-02 07:56:03', '2022-04-02 07:56:03', '2022-04-02 07:56:03'),
(17, 'hoi', '$2y$10$ftsM2fKJwFmVEPft.oXJ0eA3IJaivdGUQ4pi9sjC6Y3DSseJ64OlC', 'guru', '2022-04-02 08:03:20', '2022-04-02 08:03:20', '2022-04-02 08:03:20'),
(18, 'tes', '$2y$10$EOQKwUIfihwx6pIX5J3Oq.48u1HQv7UyI95qxz.Mi4lyy1b6wF0cy', 'guru', '2022-04-02 08:12:53', '2022-04-02 08:12:53', '2022-04-02 08:12:53'),
(19, 'huhu', '$2y$10$F7UR9gC4zaM/gWOvphrOxe4NXDM7NaWm84CGC93W97gKBXgI92CpO', 'siswa', '2022-04-02 08:14:21', '2022-04-02 08:14:21', '2022-04-02 08:14:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_guru`
--
ALTER TABLE `tb_guru`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_hasil`
--
ALTER TABLE `tb_hasil`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indexes for table `tb_hasil_detail`
--
ALTER TABLE `tb_hasil_detail`
  ADD PRIMARY KEY (`id_hasil_detail`);

--
-- Indexes for table `tb_jawaban`
--
ALTER TABLE `tb_jawaban`
  ADD PRIMARY KEY (`id_jawaban`);

--
-- Indexes for table `tb_nilai_siswa`
--
ALTER TABLE `tb_nilai_siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pertanyaan`
--
ALTER TABLE `tb_pertanyaan`
  ADD PRIMARY KEY (`id_pertanyaan`);

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_guru`
--
ALTER TABLE `tb_guru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_hasil`
--
ALTER TABLE `tb_hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_hasil_detail`
--
ALTER TABLE `tb_hasil_detail`
  MODIFY `id_hasil_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_jawaban`
--
ALTER TABLE `tb_jawaban`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_nilai_siswa`
--
ALTER TABLE `tb_nilai_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_pertanyaan`
--
ALTER TABLE `tb_pertanyaan`
  MODIFY `id_pertanyaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
