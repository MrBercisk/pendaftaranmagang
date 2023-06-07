-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Jun 2023 pada 10.36
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.28

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
-- Struktur dari tabel `chat`
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
-- Struktur dari tabel `tbl_bidang`
--

CREATE TABLE `tbl_bidang` (
  `id` int(11) NOT NULL,
  `nama_bidang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_bidang`
--

INSERT INTO `tbl_bidang` (`id`, `nama_bidang`) VALUES
(1, 'Sistem Informasi Dan Statistik'),
(2, 'Infrastruktur Telematika'),
(3, 'Persandian Dan Telekomunikasi'),
(4, 'Informasi Dan Komunikasi Publik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_informasi`
--

CREATE TABLE `tbl_informasi` (
  `id` int(11) NOT NULL,
  `tgl_buka` date NOT NULL,
  `tgl_tutup` date NOT NULL,
  `tgl_pengumuman` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_informasi`
--

INSERT INTO `tbl_informasi` (`id`, `tgl_buka`, `tgl_tutup`, `tgl_pengumuman`) VALUES
(1, '2023-05-20', '2023-05-20', '2023-05-20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jadwal`
--

CREATE TABLE `tbl_jadwal` (
  `id` int(11) NOT NULL,
  `pendaftaran_id` int(11) NOT NULL,
  `tanggal_mulai` date NOT NULL DEFAULT current_timestamp(),
  `tanggal_selesai` date NOT NULL DEFAULT current_timestamp(),
  `tanggal_bimbingan` date NOT NULL DEFAULT current_timestamp(),
  `jam_bimbingan` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kampus`
--

CREATE TABLE `tbl_kampus` (
  `id` int(11) NOT NULL,
  `nama_kampus` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_kampus`
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
-- Struktur dari tabel `tbl_kategori`
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
-- Dumping data untuk tabel `tbl_kategori`
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
-- Struktur dari tabel `tbl_laporan`
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
-- Struktur dari tabel `tbl_nilai`
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
-- Struktur dari tabel `tbl_pendaftaran`
--

CREATE TABLE `tbl_pendaftaran` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bidang_id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `mentor_id` int(11) NOT NULL,
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_progresmagang`
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
-- Struktur dari tabel `tbl_user`
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
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `bidang_id`, `kategori_id`, `role_id`, `nama`, `email`, `password`, `token`, `reset_token_created_at`, `created_at`, `updated_at`) VALUES
(1, 0, 0, 1, 'admin', 'admin@diskominfosan.ac.id', 'g3c2qQEPMVvJ3uuuDdtd5YaxV1H+WbD6r1UzcjQqxtf3JqYGdQD8emmBgneScdvFDFHWPNXfpWGKHenH+Or+uOIHC4OgJCbn1uNuf0kHtkum5fBDeV3fuQ==', '', '2023-04-14 10:48:14', '2022-09-03 09:04:07', '2022-09-03 09:04:07'),
(2, 1, 4, 2, 'Mentor Aplikasi', 'mentorapk@diskominfosan.ac.id', 'hcJdk+Zs/DcAdyeLgJqxLsHOjzydN+rPOmunNmGEzsquMDb//CxFIueoa7x1dluEx0QiGnhAcL+86QszoLXtMxdhlLM83keRso7Mq/DULzCi/lVv0hIm/i8=', '', '2023-04-23 13:28:33', '2023-04-23 01:28:33', '2023-04-23 01:28:33'),
(3, 1, 2, 2, 'Mentor Multimedia', 'mentormultimedia@diskominfosan.ac.id', 'BHQ6s1wSL8bVUAtww6sxaYYJ6dkAk28BJdNyWolgk24WRDRo9Z5MtiHcYkExFN8tHMrg2EdOt1q59+mretib8rsitZQzwhuPerfVwaDR2T30Ti6q59qkH/s=', '', '2023-04-27 05:11:49', '2023-04-26 17:11:49', '2023-04-26 17:11:49'),
(4, 1, 1, 2, 'Mentor Perangkat Lunak', 'mentorperangkatlunak@diskominfosan.ac.id', 'yhO5Ij84E8j5J1MwqawZdkVg1QI9WPY43SMNBzOUDoLfKexPcKdJ2CLc4Gxkib6If6fr5nEfmbKcop0txjph2Q0ml1Q60bs/ny+xrB8J/zD9V/nj6OXEY+A=', '', '2023-05-03 13:19:13', '2023-05-03 01:19:13', '2023-05-03 01:19:13'),
(5, 1, 3, 2, 'Mentor Analisis', 'mentoranalisis@diskominfosan.ac.id', 'bQkRup50jqCyFPU7F6kXtA1JKb6k8wN9+IMGYRVtwj4UCXO1/5yn6TUMCFG2G4co1n5PGULcC0lVacsAyHJPqU3Qx6AQGK2cyhJv7SY78rR8tQCjhq1wCaU=', '', '2023-05-08 14:18:29', '2023-05-08 02:18:29', '2023-05-08 02:18:29'),
(6, 2, 6, 2, 'Mentor Jaringan', 'mentorjaringan@diskominfosan.ac.id', 'fNjT6LsqWpt0yRwEskUJLzH5QHhdCaFojNgeBbNA5Yy2WPeZpnDSXiDRtjFEOuKtmD/wsOto61tuSPqhTTcdmEtEY0F8UsECF6caO3Di8hQyo/ASPYcxtlQ=', '', '2023-05-24 18:55:26', '2023-05-24 06:55:26', '2023-05-24 06:55:26'),
(7, 2, 5, 2, 'Mentor Server', 'mentorserver@diskominfosan.ac.id', 'K9+u43PB5aeiX0knacGl0pHiwKwxC+OhX4ByNKDRkUF4q6qUtCZavtutBF5imITUZLkqr6s3vL8EGWLVv2TYMShE3B5dYS+iHaZkM5lHFhrDunl2OTjid8g=', '', '2023-05-24 18:58:13', '2023-05-24 06:58:13', '2023-05-24 06:58:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user_role`
--

CREATE TABLE `tbl_user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user_role`
--

INSERT INTO `tbl_user_role` (`id`, `role`) VALUES
(1, 'Superadmin'),
(2, 'Mentor'),
(3, 'Mahasiswa');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_bidang`
--
ALTER TABLE `tbl_bidang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_informasi`
--
ALTER TABLE `tbl_informasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_jadwal`
--
ALTER TABLE `tbl_jadwal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pendaftaran_id` (`pendaftaran_id`);

--
-- Indeks untuk tabel `tbl_kampus`
--
ALTER TABLE `tbl_kampus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fakultas_id` (`bidang_id`);

--
-- Indeks untuk tabel `tbl_laporan`
--
ALTER TABLE `tbl_laporan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pendaftaran_id` (`pendaftaran_id`);

--
-- Indeks untuk tabel `tbl_pendaftaran`
--
ALTER TABLE `tbl_pendaftaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `tbl_progresmagang`
--
ALTER TABLE `tbl_progresmagang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indeks untuk tabel `tbl_user_role`
--
ALTER TABLE `tbl_user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_bidang`
--
ALTER TABLE `tbl_bidang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_informasi`
--
ALTER TABLE `tbl_informasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_jadwal`
--
ALTER TABLE `tbl_jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_kampus`
--
ALTER TABLE `tbl_kampus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tbl_laporan`
--
ALTER TABLE `tbl_laporan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_pendaftaran`
--
ALTER TABLE `tbl_pendaftaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_progresmagang`
--
ALTER TABLE `tbl_progresmagang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tbl_user_role`
--
ALTER TABLE `tbl_user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_jadwal`
--
ALTER TABLE `tbl_jadwal`
  ADD CONSTRAINT `tbl_jadwal_ibfk_1` FOREIGN KEY (`pendaftaran_id`) REFERENCES `tbl_pendaftaran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD CONSTRAINT `tbl_kategori_ibfk_1` FOREIGN KEY (`bidang_id`) REFERENCES `tbl_bidang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_laporan`
--
ALTER TABLE `tbl_laporan`
  ADD CONSTRAINT `tbl_laporan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  ADD CONSTRAINT `tbl_nilai_ibfk_1` FOREIGN KEY (`pendaftaran_id`) REFERENCES `tbl_pendaftaran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_pendaftaran`
--
ALTER TABLE `tbl_pendaftaran`
  ADD CONSTRAINT `tbl_pendaftaran_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_progresmagang`
--
ALTER TABLE `tbl_progresmagang`
  ADD CONSTRAINT `tbl_progresmagang_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD CONSTRAINT `tbl_user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `tbl_user_role` (`id`);

--
-- Ketidakleluasaan untuk tabel `tbl_user_role`
--
ALTER TABLE `tbl_user_role`
  ADD CONSTRAINT `tbl_user_role_ibfk_1` FOREIGN KEY (`id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
