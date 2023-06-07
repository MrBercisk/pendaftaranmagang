-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2023 at 08:45 PM
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
(1, '2023-03-27', '2023-03-27', '2023-02-27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bidang_id` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `syarat` varchar(500) NOT NULL,
  `tugas` varchar(500) NOT NULL,
  `fitur` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id`, `user_id`, `bidang_id`, `nama_kategori`, `syarat`, `tugas`, `fitur`) VALUES
(5, 10, 1, 'Pengembangan Perangkat Lunak', 'SIM CUTI', 'Aplikasi Pengajuan Cuti', 'Pengajuan Cuti, Verifikasi Permohonan Cuti, Laporan Rekap Permhonan Cuti ( Slot, Terpakai, Sisa, Akumulasi )'),
(6, 0, 1, 'Multimedia', 'Jurusan Multimedia', 'Membuat Video Animasi', ''),
(7, 0, 2, 'Pengelola Server', '', '', ''),
(8, 0, 4, 'Layanan Informasi Dan Pengaduan', '', '', ''),
(9, 0, 4, 'Humas Dan Publikasi', '', '', ''),
(10, 0, 4, 'Pengelolaan Informasi', '', '', ''),
(11, 0, 1, 'Analisis Data', 'Jurusan Sistem Informasi Atau Teknik Informatika, Dapat Menganalisa Data', 'Menganalisa Sistem ', ''),
(12, 0, 2, 'Jaringan', '', '', ''),
(13, 0, 3, 'Operasional Persandian Dan Telekomunikasi', '', '', ''),
(14, 0, 3, 'Pengamanan Informasi', '', '', ''),
(15, 0, 3, 'Pengawasan Pengendalian Persandian Dan Telematika', '', '', ''),
(19, 0, 1, 'Aplikasi2', 'Blog Jss', 'Aplikasi', 'Jss');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_laporan`
--

INSERT INTO `tbl_laporan` (`id`, `user_id`, `judul_laporan`, `link_drive`, `form_nilai`, `created_at`, `updated_at`) VALUES
(1, 6, 'Sistem Informasi Aplikasi Magang', 'https://chat.openai.com/chat', '6_BERLIN_Laporan_Magang.pdf', '2023-03-21 20:16:03', '2023-03-22 08:59:31');

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
(2, 1, 'Mentor SIS'),
(4, 2, 'Mentor Infrastruktur Telematika');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pendaftaran`
--

CREATE TABLE `tbl_pendaftaran` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bidang_id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `mentor_id` int(11) NOT NULL,
  `nomor_pendaftaran` int(11) NOT NULL,
  `nama_peserta` varchar(256) NOT NULL,
  `nim` varchar(60) NOT NULL,
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

INSERT INTO `tbl_pendaftaran` (`id`, `user_id`, `bidang_id`, `kategori_id`, `mentor_id`, `nomor_pendaftaran`, `nama_peserta`, `nim`, `jenis_permohonan`, `no_hp`, `alamat_peserta`, `nama_kampus`, `prodi`, `keahlian`, `tools`, `judul`, `surat_permohonan`, `status_permohonan`, `video_perkenalan`, `foto`, `berkas`, `nda`, `tahap_satu`, `tahap_dua`, `tahap_tiga`, `tanggal_pendaftaran`, `tanggal_mulai`, `tanggal_selesai`, `status_pendaftaran`, `status_verifikasi`, `created_at`, `updated_at`) VALUES
(5, 6, 1, 5, 2, 202212004, 'BERLIN', '12201069', 'Kerja Praktek', '08122344556', 'Sleman', 'UBSI', 'Sistem Informasi', 'Front End Web', 'Codeigniter 4', 'Aplikasi Magang', '1678166468_0565ab682896b3312058.pdf', 'Individu', '1678166468_0a728425c96575a93151.mp4', '1679982636_2fde432548f29453a1d1.jpg', '1678166468_c02f7458481a26867c4f.pdf', '1678166468_b8d4f9824fd4b0575ed2.pdf', 'Selesai', 'Selesai', 'Selesai', '2023-03-07', '2023-03-10', '2023-06-10', 'Selesai', 'Diterima', '2023-03-07 12:17:53', '2023-03-28 00:50:36'),
(6, 7, 0, 0, 0, 202212005, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Belum', 'Belum', 'Belum', '0000-00-00', '0000-00-00', '0000-00-00', 'Belum Selesai', '', '2023-03-07 14:14:42', '2023-03-07 14:14:42'),
(7, 8, 1, 5, 2, 202212006, 'TOKYO', '12201067', 'Kerja Praktek', '08122344559', 'Purworejo', 'UGM', 'Sistem Informasi', 'Back End Web', 'Laravel', 'Aplikasi Pendataan Karyawan', '1678260323_dd9e1d28a703306393bb.pdf', 'Individu', '1678260323_8c6e2a33e631ab8e8fe0.mp4', '1678260323_d755ebac279e0050d34a.jpg', '1678260323_89d10a4cdc0555607dc5.pdf', '1678260323_e53c7aa2a2c6da7e4c90.pdf', 'Selesai', 'Selesai', 'Selesai', '2023-03-08', '2023-03-08', '2023-04-09', 'Selesai', 'Belum Verifikasi', '2023-03-07 15:47:07', '2023-03-08 14:25:31'),
(8, 11, 1, 5, 0, 202212007, 'NAIROBI', '12201099', 'Kerja Praktek', '081223345599', 'Gamping Sleman Yogyakarta', 'UGM', 'Teknik Informatika', 'Back End Developer', 'Laravel', 'Aplikasi Manajemen Data', '1679889128_bbf7d58086e05172e3a2.pdf', 'Individu', '1679889128_0f0344808745fbfdc57f.mp4', '1679889128_54825fa826cc08970bf9.jpg', '1679889128_c9b8d9143faac567bd17.pdf', '1679889128_7a4ef68617d29029569b.pdf', 'Selesai', 'Selesai', 'Selesai', '2023-03-27', '2023-03-27', '2023-05-27', 'Selesai', 'Tidak Diterima', '2023-03-27 10:15:43', '2023-03-28 00:35:56');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_progresmagang`
--

INSERT INTO `tbl_progresmagang` (`id`, `user_id`, `tgl_bimbingan`, `pencapaian`, `file_presentasi`, `created_at`, `updated_at`) VALUES
(1, 6, '2023-03-22', 'Penambahan Menu Magang', '6_BERLIN_Progress_Magang.pdf', '2023-03-21 20:14:46', '2023-03-22 08:58:54'),
(2, 6, '2023-03-24', 'Penambahan Kalender', '6_BERLIN_Progress_Magang.pdf', '2023-03-23 18:59:45', '2023-03-23 18:59:45'),
(3, 6, '2023-03-24', 'gsgs', '6_BERLIN_Progress_Magang.pdf', '2023-03-23 19:00:38', '2023-03-23 19:00:38');

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
  `token` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `role_id`, `nama`, `email`, `password`, `token`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 'admin@diskominfosan.ac.id', 'g3c2qQEPMVvJ3uuuDdtd5YaxV1H+WbD6r1UzcjQqxtf3JqYGdQD8emmBgneScdvFDFHWPNXfpWGKHenH+Or+uOIHC4OgJCbn1uNuf0kHtkum5fBDeV3fuQ==', '', '2022-09-03 09:04:07', '2022-09-03 09:04:07'),
(2, 4, 'TIDAK_LULUS', 'tidaklulus@gmail.com', 'DM5M6+8YGfl/OPQS4gA5vp9WdkKWAM24GdZX/+1gsPaNrnhexnEp7IIr9ZbfZmH2IOq1Zh5Pxz3ZPi//ztJ64KJb1ibNcDYz5BnEXv2qhwAZO5mVYf6Rwg==', '', '2022-12-12 15:11:39', '2022-12-12 15:11:39'),
(3, 4, 'BIM', 'bim@gmail.com', 'f0D9kURkGwE/Wf8PNiZdC4V0J42DJleCDTmgjqplrdfASShsjLYhgRHvr41GWakDpaSQl9hpnn5RlDLDoiBzYOIYoP3V7pJFGtZs6d2hW7G8kQIR5bIAcQ==', '', '2022-12-12 15:48:34', '2022-12-12 15:48:34'),
(4, 4, 'ANTO', 'darmanto2098@gmail.com', 'aFHtB4JY1YaFWU9HHy1dAw3qqbiZu83w1cq5LQ/QghIIII7LDDezogtli6KFoD8i9DaV/Ol6j3A9Ak5mtxTh0sU/y8ulMR6VXnsUNdbBzlzGHT+DEjAzFtLdxg==', '', '2023-02-26 09:31:47', '2023-03-06 22:43:29'),
(6, 4, 'BERLIN', 'berlinbercisk23@gmail.com', '/f/3kR3I3r0ZM+/mYQJZApRB0tVhVwXFLjF+pNTWuNop7KFgB83TuCxEavSwEZh3Wb/lPTqmIHSQP0wI5SznCY6l0HTrNWS9ida7QV6hKMJMfHMeZcBAZg==', '', '2023-03-07 12:17:53', '2023-03-28 00:51:03'),
(7, 4, 'BIMO', 'bimosatrio814@gmail.com', 'W6lzUPvUHRiM3B2RVExHmhrCmLpOcjjJDn5ocaR7i9zTHGdLhflIa90RGg8AyKers+dgqCXi4htCxpI1hBXB+NE87TFmijwDNrjR0yPC4NcpRXzlFh6Q3g==', '', '2023-03-07 14:14:40', '2023-03-07 14:14:40'),
(8, 4, 'TOKYO', 'tokyo@gmail.com', 'x7kOIMi+AcL9aXQr74fatZGMuUnal50GoO3KBwAwaHKFj8cWHDsLKG9OI8TCQ7jWZYs4cIqzUdJYwCUxExLbW8WUdUPWJxELxnRcPc/t+vZnZvVnC+i2Kw==', '', '2023-03-07 15:47:06', '2023-03-07 15:47:06'),
(10, 2, 'mentor', 'mentor@diskominfosan.ac.id', '42f5cF5wi6nXrv8Mll2JbkXpC04v3E/hKbb1/kSiJeZvEUWraJ0jNlskMOViOVWbnBg4/eGY0Jo9xsIxpdzjT+hCamIYOY4IFkELx+ZaVbOApN7GZyhRNNc=', '', '2022-09-03 09:04:07', '2023-03-24 03:15:03'),
(11, 4, 'NAIROBI', 'nairobi@gmail.com', 'ikHrbWRx6rrasu3IxMHJ7a16c3HxBH2ys2AUFYJaSK6LtG+d5ZOc3YNb660qBl867o58k6Ezwg3GXjCq2x1QIVvVLTDKlZ9EgmNeCrefuyEEaev46oKl6Q==', '', '2023-03-27 10:15:39', '2023-03-27 10:15:39');

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
  ADD KEY `fakultas_id` (`bidang_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_laporan`
--
ALTER TABLE `tbl_laporan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_laporan`
--
ALTER TABLE `tbl_laporan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tbl_mentor`
--
ALTER TABLE `tbl_mentor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_pendaftaran`
--
ALTER TABLE `tbl_pendaftaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_progresmagang`
--
ALTER TABLE `tbl_progresmagang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
  ADD CONSTRAINT `tbl_kategori_ibfk_1` FOREIGN KEY (`bidang_id`) REFERENCES `tbl_bidang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_kategori_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_laporan`
--
ALTER TABLE `tbl_laporan`
  ADD CONSTRAINT `tbl_laporan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
