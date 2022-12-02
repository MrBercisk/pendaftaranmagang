-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2022 at 08:40 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

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
-- Table structure for table `tbl_bidang`
--

CREATE TABLE `tbl_bidang` (
  `id` int(11) NOT NULL,
  `nama_bidang` varchar(255) NOT NULL
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
(1, '2022-12-02', '2022-12-02', '2022-12-02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `id` int(11) NOT NULL,
  `bidang_id` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `syarat` varchar(500) NOT NULL,
  `tugas` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id`, `bidang_id`, `nama_kategori`, `syarat`, `tugas`) VALUES
(5, 1, 'Aplikasi', 'Jurusan Sistem Informasi, Dapat Menguasai Codeigniter 4,Html,CSS,JavaScript', 'Membuat Aplikasi'),
(6, 1, 'Multimedia', 'Jurusan Multimedia', 'Membuat Video Animasi'),
(7, 2, 'Pengelola Server', '', ''),
(8, 4, 'Layanan Informasi Dan Pengaduan', '', ''),
(9, 4, 'Humas Dan Publikasi', '', ''),
(10, 4, 'Pengelolaan Informasi', '', ''),
(11, 1, 'Analisis Data', 'Jurusan Sistem Informasi Atau Teknik Informatika, Dapat Menganalisa Data', 'Menganalisa Sistem '),
(12, 2, 'Jaringan', '', ''),
(13, 3, 'Operasional Persandian Dan Telekomunikasi', '', ''),
(14, 3, 'Pengamanan Informasi', '', ''),
(15, 3, 'Pengawasan Pengendalian Persandian Dan Telematika', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mentor`
--

CREATE TABLE `tbl_mentor` (
  `id` int(11) NOT NULL,
  `bidang_id` int(11) NOT NULL,
  `nama_mentor` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_mentor`
--

INSERT INTO `tbl_mentor` (`id`, `bidang_id`, `nama_mentor`) VALUES
(2, 1, 'Anonim');

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
  `nama_peserta` varchar(256) NOT NULL,
  `jenis_permohonan` varchar(128) NOT NULL,
  `no_hp` varchar(128) NOT NULL,
  `alamat_peserta` text NOT NULL,
  `nama_kampus` varchar(256) NOT NULL,
  `prodi` varchar(60) NOT NULL,
  `keahlian` text NOT NULL,
  `tools` text NOT NULL,
  `judul` varchar(500) NOT NULL,
  `surat_permohonan` varchar(128) NOT NULL,
  `status_permohonan` varchar(128) NOT NULL,
  `video_perkenalan` varchar(128) NOT NULL,
  `foto` text NOT NULL,
  `berkas` text NOT NULL,
  `nda` text NOT NULL,
  `tahap_satu` varchar(128) NOT NULL,
  `tahap_dua` varchar(128) NOT NULL,
  `tahap_tiga` varchar(128) NOT NULL,
  `tanggal_pendaftaran` date NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `status_pendaftaran` varchar(128) NOT NULL,
  `status_verifikasi` varchar(128) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pendaftaran`
--

INSERT INTO `tbl_pendaftaran` (`id`, `user_id`, `bidang_id`, `kategori_id`, `nomor_pendaftaran`, `nama_peserta`, `jenis_permohonan`, `no_hp`, `alamat_peserta`, `nama_kampus`, `prodi`, `keahlian`, `tools`, `judul`, `surat_permohonan`, `status_permohonan`, `video_perkenalan`, `foto`, `berkas`, `nda`, `tahap_satu`, `tahap_dua`, `tahap_tiga`, `tanggal_pendaftaran`, `tanggal_mulai`, `tanggal_selesai`, `status_pendaftaran`, `status_verifikasi`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 5, 202212001, 'CALON PESERTA', 'Riset', '0812912244', 'Yogyakarta', 'UBSI', 'Sistem Informasi', 'Front end web', 'Laravel', 'Sistem Pendaftaran Magang Mahasiswa', '1669969250_cdd86471f5b35326c56e.pdf', 'Individu', '1669969250_3f92634b975114fef15c.mp4', '1669969250_1c9f16c5596170dfdd3f.jpg', '1669969250_97afa39b6d5e87d6b843.pdf', '1669969250_0db2f1c3eb04dd7bf406.pdf', 'Selesai', 'Selesai', 'Selesai', '2022-12-02', '2022-12-02', '2023-02-02', 'Selesai', 'Belum Verifikasi', '2022-12-02 15:18:31', '2022-12-02 15:22:45');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `role_id`, `nama`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 'admin@gmail.com', 'g3c2qQEPMVvJ3uuuDdtd5YaxV1H+WbD6r1UzcjQqxtf3JqYGdQD8emmBgneScdvFDFHWPNXfpWGKHenH+Or+uOIHC4OgJCbn1uNuf0kHtkum5fBDeV3fuQ==', '2022-09-03 09:04:07', '2022-09-03 09:04:07'),
(2, 4, 'CALON PESERTA', 'peserta@gmail.com', '2A0RzgduDPVZWy1hJli3o8QWSeJ2AXZFLigy1fKWupeH+cBGFtp6/lKnUM87T/2wzdURPyK+6yKEDUwo1itAgUuH7jTjFXJ3Uz7MNz7KMgReOCQ6HhbKzA==', '2022-12-02 15:18:31', '2022-12-02 15:18:31');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_role`
--

CREATE TABLE `tbl_user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_role`
--

INSERT INTO `tbl_user_role` (`id`, `role`) VALUES
(1, 'Superadmin'),
(2, 'Mentor'),
(3, 'Admin'),
(4, 'Mahasiswa');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fakultas_id` (`bidang_id`);

--
-- Indexes for table `tbl_mentor`
--
ALTER TABLE `tbl_mentor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mentor_id` (`bidang_id`);

--
-- Indexes for table `tbl_pendaftaran`
--
ALTER TABLE `tbl_pendaftaran`
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
-- AUTO_INCREMENT for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_mentor`
--
ALTER TABLE `tbl_mentor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_pendaftaran`
--
ALTER TABLE `tbl_pendaftaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_user_role`
--
ALTER TABLE `tbl_user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD CONSTRAINT `tbl_kategori_ibfk_1` FOREIGN KEY (`bidang_id`) REFERENCES `tbl_bidang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_mentor`
--
ALTER TABLE `tbl_mentor`
  ADD CONSTRAINT `tbl_mentor_ibfk_1` FOREIGN KEY (`bidang_id`) REFERENCES `tbl_bidang` (`id`);

--
-- Constraints for table `tbl_pendaftaran`
--
ALTER TABLE `tbl_pendaftaran`
  ADD CONSTRAINT `tbl_pendaftaran_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD CONSTRAINT `tbl_user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `tbl_user_role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
