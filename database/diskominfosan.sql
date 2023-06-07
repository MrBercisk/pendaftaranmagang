-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2023 at 10:17 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `diskominfosan`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `pengirim` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `pesan` text NOT NULL,
  `waktu_kirim` timestamp NOT NULL DEFAULT current_timestamp(),
  `dibaca` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bidang`
--

CREATE TABLE `tbl_bidang` (
  `id` int(11) NOT NULL,
  `nama_bidang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_bidang`
--

INSERT INTO `tbl_bidang` (`id`, `nama_bidang`) VALUES
(1, 'Sistem Informasi Dan Statistik'),
(2, 'Infrastruktur Telematika'),
(3, 'Persandian Dan Telekomunikasi'),
(4, 'Informasi Dan Komunikasi Publik');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_informasi`
--

CREATE TABLE `tbl_informasi` (
  `id` int(11) NOT NULL,
  `tgl_buka` date NOT NULL,
  `tgl_tutup` date NOT NULL,
  `tgl_pengumuman` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_informasi`
--

INSERT INTO `tbl_informasi` (`id`, `tgl_buka`, `tgl_tutup`, `tgl_pengumuman`) VALUES
(1, '2023-06-02', '2023-06-02', '2023-05-02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jadwal`
--

CREATE TABLE `tbl_jadwal` (
  `id` int(11) NOT NULL,
  `pendaftaran_id` int(11) NOT NULL,
  `tanggal_mulai` date NOT NULL DEFAULT current_timestamp(),
  `tanggal_selesai` date NOT NULL DEFAULT current_timestamp(),
  `tanggal_bimbingan` date NOT NULL DEFAULT current_timestamp(),
  `jam_bimbingan` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_jadwal`
--

INSERT INTO `tbl_jadwal` (`id`, `pendaftaran_id`, `tanggal_mulai`, `tanggal_selesai`, `tanggal_bimbingan`, `jam_bimbingan`) VALUES
(1, 2, '2023-06-01', '2023-08-05', '2023-06-05', '08:30:00'),
(2, 2, '2023-06-01', '2023-08-05', '2023-06-06', '08:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kampus`
--

CREATE TABLE `tbl_kampus` (
  `id` int(11) NOT NULL,
  `nama_kampus` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_kampus`
--

INSERT INTO `tbl_kampus` (`id`, `nama_kampus`) VALUES
(1, 'UBSI'),
(2, 'UGM'),
(3, 'UMY'),
(4, 'UNY'),
(5, 'UAD'),
(6, 'UPN'),
(7, 'STPMD'),
(8, 'AMIKOM');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `id` int(11) NOT NULL,
  `bidang_id` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `syarat` varchar(60) NOT NULL,
  `tugas` varchar(60) NOT NULL,
  `fitur` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id`, `bidang_id`, `nama_kategori`, `syarat`, `tugas`, `fitur`) VALUES
(1, 1, 'Pengembangan Perangkat Lunak', 'SIM CUTI', 'Aplikasi Pengajuan Cuti', 'Pengajuan Cuti, Verifikasi Permohonan Cuti, Laporan Rekap Permhonan Cuti ( Slot, Terpakai, Sisa, Akumulasi )'),
(2, 1, 'Multimedia', 'Jurusan Multimedia', 'Membuat Video Animasi', ''),
(3, 1, 'Analisis Data', 'Jurusan Sistem Informasi Atau Teknik Informatika, Dapat Meng', 'Menganalisa Sistem ', ''),
(4, 1, 'Aplikasi', 'Blog Jss', 'Aplikasi', 'Jss'),
(5, 2, 'Pengelola Server', '', '', ''),
(6, 2, 'Jaringan', '', '', ''),
(7, 3, 'Operasional Persandian Dan Telekomunikasi', '', '', ''),
(8, 3, 'Pengamanan Informasi', '', '', ''),
(9, 3, 'Pengawasan Pengendalian Persandian Dan Telematika', '', '', ''),
(10, 4, 'Layanan Informasi Dan Pengaduan', '', '', ''),
(11, 4, 'Humas Dan Publikasi', '', '', ''),
(12, 4, 'Pengelolaan Informasi', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_laporan`
--

CREATE TABLE `tbl_laporan` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `judul_laporan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_drive` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `form_nilai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surat_selesai_magang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nilai`
--

CREATE TABLE `tbl_nilai` (
  `id` int(11) NOT NULL,
  `pendaftaran_id` int(11) NOT NULL,
  `ketepatan_waktu` int(11) NOT NULL,
  `tanggung_jawab` int(11) NOT NULL,
  `kehadiran` int(11) NOT NULL,
  `kemampuan_kerja` int(11) NOT NULL,
  `kualitas_kerja` int(11) NOT NULL,
  `kerjasama` int(11) NOT NULL,
  `inisiatif` int(11) NOT NULL,
  `rasa_percaya` int(11) NOT NULL,
  `penampilan` int(11) NOT NULL,
  `patuh_aturan_pkl` int(11) NOT NULL,
  `rata_rata` int(11) NOT NULL,
  `tanda_tangan` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pendaftaran`
--

CREATE TABLE `tbl_pendaftaran` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bidang_id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `nomor_pendaftaran` int(11) NOT NULL,
  `nama_peserta` varchar(80) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `jenis_permohonan` varchar(30) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `alamat_peserta` text NOT NULL,
  `nama_kampus` varchar(10) NOT NULL,
  `prodi` varchar(60) NOT NULL,
  `keahlian` text NOT NULL,
  `tools` text NOT NULL,
  `judul` varchar(500) NOT NULL,
  `surat_permohonan` varchar(128) NOT NULL,
  `status_permohonan` varchar(128) NOT NULL,
  `nama_anggota_1` varchar(80) NOT NULL,
  `nama_anggota_2` varchar(80) NOT NULL,
  `video_perkenalan` varchar(128) NOT NULL,
  `foto` text NOT NULL,
  `berkas` text NOT NULL,
  `nda` text NOT NULL,
  `tahap_satu` varchar(128) NOT NULL,
  `tahap_dua` varchar(128) NOT NULL,
  `tahap_tiga` varchar(128) NOT NULL,
  `tanggal_pendaftaran` date NOT NULL,
  `status_pendaftaran` varchar(128) NOT NULL,
  `status_verifikasi` varchar(128) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pendaftaran`
--

INSERT INTO `tbl_pendaftaran` (`id`, `user_id`, `bidang_id`, `kategori_id`, `nomor_pendaftaran`, `nama_peserta`, `nim`, `jenis_permohonan`, `no_hp`, `alamat_peserta`, `nama_kampus`, `prodi`, `keahlian`, `tools`, `judul`, `surat_permohonan`, `status_permohonan`, `nama_anggota_1`, `nama_anggota_2`, `video_perkenalan`, `foto`, `berkas`, `nda`, `tahap_satu`, `tahap_dua`, `tahap_tiga`, `tanggal_pendaftaran`, `status_pendaftaran`, `status_verifikasi`, `keterangan`, `created_at`, `updated_at`) VALUES
(2, 17, 1, 4, 202212001, 'BIMO SATRIO PUTRA PRADANA', '12201068', 'Kerja Praktek', '081291204919', 'DS. Geparang RT 001 RW 001 Geparang Purwodadi', 'UBSI', 'Sistem Informasi', 'Fullstack Developer', 'Codeigniter 4', 'Perancangan SIAKAD', '1685692018_c37161074fd220592cd1.pdf', 'Kelompok', 'SARA PUJA KESUMA', 'DARMANTO', '1685692018_0c3b40abf17ad6100e16.mp4', '1686120976_07bce6bb9a70e5e6eb15.jpg', '1685692018_b59935441cac6a2cecba.pdf', '1685692018_5da4be6ce06557b60a68.pdf', 'Selesai', 'Selesai', 'Selesai', '2023-06-02', 'Selesai', 'Diterima', '', '2023-06-02 14:34:09', '2023-06-07 13:56:16');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_progresmagang`
--

CREATE TABLE `tbl_progresmagang` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tgl_bimbingan` date NOT NULL,
  `pencapaian` text NOT NULL,
  `file_presentasi` varchar(255) NOT NULL,
  `catatan` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `bidang_id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` text NOT NULL,
  `token` varchar(255) NOT NULL,
  `reset_token_created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `bidang_id`, `kategori_id`, `role_id`, `nama`, `email`, `password`, `token`, `reset_token_created_at`, `created_at`, `updated_at`) VALUES
(1, 0, 0, 1, 'admin', 'admin@diskominfosan.ac.id', 'g3c2qQEPMVvJ3uuuDdtd5YaxV1H+WbD6r1UzcjQqxtf3JqYGdQD8emmBgneScdvFDFHWPNXfpWGKHenH+Or+uOIHC4OgJCbn1uNuf0kHtkum5fBDeV3fuQ==', '', '2023-04-14 10:48:14', '2022-09-03 09:04:07', '2022-09-03 09:04:07'),
(2, 1, 4, 2, 'Mentor Aplikasi', 'mentorapk@diskominfosan.ac.id', 'hcJdk+Zs/DcAdyeLgJqxLsHOjzydN+rPOmunNmGEzsquMDb//CxFIueoa7x1dluEx0QiGnhAcL+86QszoLXtMxdhlLM83keRso7Mq/DULzCi/lVv0hIm/i8=', '', '2023-04-23 13:28:33', '2023-04-23 01:28:33', '2023-04-23 01:28:33'),
(3, 1, 2, 2, 'Mentor Multimedia', 'mentormultimedia@diskominfosan.ac.id', 'BHQ6s1wSL8bVUAtww6sxaYYJ6dkAk28BJdNyWolgk24WRDRo9Z5MtiHcYkExFN8tHMrg2EdOt1q59+mretib8rsitZQzwhuPerfVwaDR2T30Ti6q59qkH/s=', '', '2023-04-27 05:11:49', '2023-04-26 17:11:49', '2023-04-26 17:11:49'),
(4, 1, 1, 2, 'Mentor Perangkat Lunak', 'mentorperangkatlunak@diskominfosan.ac.id', 'yhO5Ij84E8j5J1MwqawZdkVg1QI9WPY43SMNBzOUDoLfKexPcKdJ2CLc4Gxkib6If6fr5nEfmbKcop0txjph2Q0ml1Q60bs/ny+xrB8J/zD9V/nj6OXEY+A=', '', '2023-05-03 13:19:13', '2023-05-03 01:19:13', '2023-05-03 01:19:13'),
(5, 1, 3, 2, 'Mentor Analisis', 'mentoranalisis@diskominfosan.ac.id', 'bQkRup50jqCyFPU7F6kXtA1JKb6k8wN9+IMGYRVtwj4UCXO1/5yn6TUMCFG2G4co1n5PGULcC0lVacsAyHJPqU3Qx6AQGK2cyhJv7SY78rR8tQCjhq1wCaU=', '', '2023-05-08 14:18:29', '2023-05-08 02:18:29', '2023-05-08 02:18:29'),
(6, 2, 6, 2, 'Mentor Jaringan', 'mentorjaringan@diskominfosan.ac.id', 'fNjT6LsqWpt0yRwEskUJLzH5QHhdCaFojNgeBbNA5Yy2WPeZpnDSXiDRtjFEOuKtmD/wsOto61tuSPqhTTcdmEtEY0F8UsECF6caO3Di8hQyo/ASPYcxtlQ=', '', '2023-05-24 18:55:26', '2023-05-24 06:55:26', '2023-05-24 06:55:26'),
(7, 2, 5, 2, 'Mentor Server', 'mentorserver@diskominfosan.ac.id', 'K9+u43PB5aeiX0knacGl0pHiwKwxC+OhX4ByNKDRkUF4q6qUtCZavtutBF5imITUZLkqr6s3vL8EGWLVv2TYMShE3B5dYS+iHaZkM5lHFhrDunl2OTjid8g=', '', '2023-05-24 18:58:13', '2023-05-24 06:58:13', '2023-05-24 06:58:13'),
(8, 3, 7, 2, 'Mentor Operasional Persandian dan Telekomunikasi', 'mentoroperasional@diskominfosan.ac.id', '8yuv5GU/Ouo28fzl7iO8dHp0pXHgh3HHxrUPwudmg5GgLEOZ1nR4uJ13HB+oFmTqCaE2cYxguyJuSKG8h66QZ59MjPP31LPejSYbXgN0NHhwL/8nCjclijo=', '', '2023-06-01 18:32:38', '2023-06-01 18:32:38', '2023-06-01 18:32:38'),
(9, 3, 8, 2, 'Mentor Pengamanan Informasi', 'mentorpengamanan@diskominfosan.ac.id', 'OJl6oFxBtq7qzj+CD8FZ/BJUW6BMzax6RZ9AYKV/ybsWWxf3l+s9a+qCWekMTTOZoXQ9WLqnM/UmwYCY8OyQTe/N4vRyeD6+Uq0hhR937lmYdPhfy+tIIbs=', '', '2023-06-01 18:34:23', '2023-06-01 18:34:23', '2023-06-01 18:34:23'),
(10, 3, 9, 2, 'Mentor Pengawasan Pengendalian Persandian Dan Telematika', 'mentorpengawasan@diskominfosan.ac.id', '4uu1h2RG11uUNDolEBorXmKSLRdhurz5NAdZrC8WJEbvAA75bgyzHGvQWoOz0Guu1wF9BYXBoBAw5rUb8HT0RUx8ihRuf6vvOa1iRLspE6nhxvN5YeLYo60=', '', '2023-06-01 18:39:12', '2023-06-01 18:39:12', '2023-06-01 18:39:12'),
(11, 4, 10, 2, 'Mentor Layanan Informasi Dan Pengaduan', 'mentorlayanan@diskominfosan.ac.id', 'MNjW9csmbhs3bRuTbj1fuQ5ZfUaEsRw5DzkqvfDFhTomXQqU86t14dlCeACgJeJpFUa70aJ5rfAlF17d9rPXFBIyvl2THdBTjPKCUgFbGMmXXbHHRagtesE=', '', '2023-06-01 18:40:25', '2023-06-01 18:40:25', '2023-06-01 18:40:25'),
(12, 4, 11, 2, 'Mentor Humas Dan Publikasi', 'mentorhumas@diskominfosan.ac.id', 'UkzRHYN7thNs7jcgNZsVxzDvZYaAKqlGhRrJrIxx7NvTdaNAUyptvVploXcSbEBTo2z1SkD3Ve6A529XdM7oIn/vdoQ9/julloJH9fCsviO8nkPH8bfeFYQ=', '', '2023-06-01 18:41:20', '2023-06-01 18:41:20', '2023-06-01 18:41:20'),
(13, 4, 12, 2, 'Mentor Pengelolaan Informasi', 'mentorpengelolaan@diskominfosan.ac.id', '3IgUvF7NS5SbeHGS2qE6KMlq5fJ96Q+48MuoFeNnHurdsT/nntzsgYDQn9UPKuUz4sKRVHliWY1yG99lemY3wkfrIpLgtRjwGoz2M1Wg8YRI2gH/QB2bdZU=', '', '2023-06-01 18:43:25', '2023-06-01 18:43:25', '2023-06-01 18:43:25'),
(15, 1, 3, 2, 'mentortesting1', 'mentortes@diskominfosan.ac.id', 'D7XeGowjTQhe2EFhrubmMEw0BgS6paFRx5WtUGisbL9Rjod2wVIzzq25c+1M7iwrtlA7XnAh60dMEyWn68I1Ui5ULpf5y4qIvxKnd+4YUkW0uRnROJcyCks=', '', '2023-06-02 13:08:34', '2023-06-02 13:08:34', '2023-06-07 10:56:25'),
(17, 1, 4, 3, 'BIMO SATRIO PUTRA PRADANA', 'bimosatrio814@gmail.com', 'qgkNkApyzbwuhsiBT2raCz/BJZEjGa1AStRfqh2sI8+HkNbnovbkPEeAyw/gZneHokEexXlcnejrdOfurWyR5VNCI4MMUxvQQ+Dxh8fOe7MPb1SbhudAiw==', '', '2023-06-02 14:33:57', '2023-06-02 14:33:57', '2023-06-02 14:45:45');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_role`
--

CREATE TABLE `tbl_user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_role`
--

INSERT INTO `tbl_user_role` (`id`, `role`) VALUES
(1, 'Superadmin'),
(2, 'Mentor'),
(3, 'Mahasiswa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_bidang`
--
ALTER TABLE `tbl_bidang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_informasi`
--
ALTER TABLE `tbl_informasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_jadwal`
--
ALTER TABLE `tbl_jadwal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pendaftaran_id` (`pendaftaran_id`);

--
-- Indexes for table `tbl_kampus`
--
ALTER TABLE `tbl_kampus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fakultas_id` (`bidang_id`);

--
-- Indexes for table `tbl_laporan`
--
ALTER TABLE `tbl_laporan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pendaftaran_id` (`pendaftaran_id`);

--
-- Indexes for table `tbl_pendaftaran`
--
ALTER TABLE `tbl_pendaftaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_progresmagang`
--
ALTER TABLE `tbl_progresmagang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `tbl_user_role`
--
ALTER TABLE `tbl_user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_bidang`
--
ALTER TABLE `tbl_bidang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_informasi`
--
ALTER TABLE `tbl_informasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_jadwal`
--
ALTER TABLE `tbl_jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_kampus`
--
ALTER TABLE `tbl_kampus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_laporan`
--
ALTER TABLE `tbl_laporan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_pendaftaran`
--
ALTER TABLE `tbl_pendaftaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_progresmagang`
--
ALTER TABLE `tbl_progresmagang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_user_role`
--
ALTER TABLE `tbl_user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_jadwal`
--
ALTER TABLE `tbl_jadwal`
  ADD CONSTRAINT `tbl_jadwal_ibfk_1` FOREIGN KEY (`pendaftaran_id`) REFERENCES `tbl_pendaftaran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD CONSTRAINT `tbl_kategori_ibfk_1` FOREIGN KEY (`bidang_id`) REFERENCES `tbl_bidang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_laporan`
--
ALTER TABLE `tbl_laporan`
  ADD CONSTRAINT `tbl_laporan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  ADD CONSTRAINT `tbl_nilai_ibfk_1` FOREIGN KEY (`pendaftaran_id`) REFERENCES `tbl_pendaftaran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_pendaftaran`
--
ALTER TABLE `tbl_pendaftaran`
  ADD CONSTRAINT `tbl_pendaftaran_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_progresmagang`
--
ALTER TABLE `tbl_progresmagang`
  ADD CONSTRAINT `tbl_progresmagang_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD CONSTRAINT `tbl_user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `tbl_user_role` (`id`);

--
-- Constraints for table `tbl_user_role`
--
ALTER TABLE `tbl_user_role`
  ADD CONSTRAINT `tbl_user_role_ibfk_1` FOREIGN KEY (`id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
