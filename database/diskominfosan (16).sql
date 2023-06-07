-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Bulan Mei 2023 pada 12.22
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

--
-- Dumping data untuk tabel `tbl_jadwal`
--

INSERT INTO `tbl_jadwal` (`id`, `pendaftaran_id`, `tanggal_mulai`, `tanggal_selesai`, `tanggal_bimbingan`, `jam_bimbingan`) VALUES
(1, 9, '2023-03-03', '2023-05-09', '2023-05-04', '08:30:00'),
(2, 8, '2023-05-01', '2023-07-01', '2023-05-02', '09:00:00'),
(3, 11, '2023-05-03', '2023-05-04', '2023-05-11', '09:00:00'),
(4, 11, '2023-05-03', '2023-05-04', '2023-05-23', '09:00:00'),
(5, 11, '2023-05-03', '2023-05-04', '2023-05-18', '09:00:00'),
(6, 11, '2023-05-03', '2023-05-04', '2023-05-25', '08:30:00'),
(7, 12, '2023-03-10', '2023-04-10', '2023-05-25', '08:30:00'),
(8, 8, '2023-05-01', '2023-07-01', '2023-05-16', '09:00:00'),
(11, 18, '2023-05-20', '2023-05-23', '2023-05-22', '09:30:00'),
(12, 19, '2023-05-20', '2023-06-10', '2023-05-25', '07:00:00'),
(13, 8, '2023-05-01', '2023-07-01', '2023-05-30', '08:00:00');

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
  `user_id` int(11) NOT NULL,
  `bidang_id` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `syarat` varchar(60) NOT NULL,
  `tugas` varchar(60) NOT NULL,
  `fitur` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id`, `user_id`, `bidang_id`, `nama_kategori`, `syarat`, `tugas`, `fitur`) VALUES
(1, 10, 1, 'Pengembangan Perangkat Lunak', 'SIM CUTI', 'Aplikasi Pengajuan Cuti', 'Pengajuan Cuti, Verifikasi Permohonan Cuti, Laporan Rekap Permhonan Cuti ( Slot, Terpakai, Sisa, Akumulasi )'),
(2, 0, 1, 'Multimedia', 'Jurusan Multimedia', 'Membuat Video Animasi', ''),
(3, 0, 1, 'Analisis Data', 'Jurusan Sistem Informasi Atau Teknik Informatika, Dapat Meng', 'Menganalisa Sistem ', ''),
(4, 0, 1, 'Aplikasi', 'Blog Jss', 'Aplikasi', 'Jss'),
(5, 0, 2, 'Pengelola Server', '', '', ''),
(6, 0, 2, 'Jaringan', '', '', ''),
(7, 0, 3, 'Operasional Persandian Dan Telekomunikasi', '', '', ''),
(8, 0, 3, 'Pengamanan Informasi', '', '', ''),
(9, 0, 3, 'Pengawasan Pengendalian Persandian Dan Telematika', '', '', ''),
(10, 0, 4, 'Layanan Informasi Dan Pengaduan', '', '', ''),
(11, 0, 4, 'Humas Dan Publikasi', '', '', ''),
(12, 0, 4, 'Pengelolaan Informasi', '', '', '');

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

--
-- Dumping data untuk tabel `tbl_laporan`
--

INSERT INTO `tbl_laporan` (`id`, `user_id`, `judul_laporan`, `link_drive`, `form_nilai`, `surat_selesai_magang`, `created_at`, `updated_at`) VALUES
(1, 10, 'Laporan Perancangan SIAKAD', 'http://localhost:8080/', '10_BIMO SATRIO_Laporan_Magang.pdf', '', '2023-05-04 19:46:31', '2023-05-04 19:46:31'),
(2, 4, 'Laporan Magang Nairobi', 'http://localhost/phpmyadmin/index.php?route=/sql&server=1&db=diskominfosan&table=tbl_jadwal&pos=0', '4_NAIROBI_Laporan_Magang.pdf', '', '2023-05-07 20:22:44', '2023-05-07 20:22:44');

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

--
-- Dumping data untuk tabel `tbl_nilai`
--

INSERT INTO `tbl_nilai` (`id`, `pendaftaran_id`, `ketepatan_waktu`, `tanggung_jawab`, `kehadiran`, `kemampuan_kerja`, `kualitas_kerja`, `kerjasama`, `inisiatif`, `rasa_percaya`, `penampilan`, `patuh_aturan_pkl`, `rata_rata`, `tanda_tangan`) VALUES
(4, 11, 90, 90, 90, 90, 90, 90, 90, 90, 90, 90, 90, 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAZAAAADICAYAAADGFbfiAAAAAXNSR0IArs4c6QAAFU5JREFUeF7tnQ/Mt1VZxz9mWRQakNiamiVmfySBQb');

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

--
-- Dumping data untuk tabel `tbl_pendaftaran`
--

INSERT INTO `tbl_pendaftaran` (`id`, `user_id`, `bidang_id`, `kategori_id`, `mentor_id`, `nomor_pendaftaran`, `nama_peserta`, `nim`, `jenis_permohonan`, `no_hp`, `alamat_peserta`, `nama_kampus`, `prodi`, `keahlian`, `tools`, `judul`, `surat_permohonan`, `status_permohonan`, `nama_anggota_1`, `nama_anggota_2`, `video_perkenalan`, `foto`, `berkas`, `nda`, `tahap_satu`, `tahap_dua`, `tahap_tiga`, `tanggal_pendaftaran`, `status_pendaftaran`, `status_verifikasi`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 5, 2, 202212004, 'BERLIN', '12201069', 'Kerja Praktek', '08122344556', 'Sleman', 'UBSI', 'Sistem Informasi', 'Front End Web', 'Codeigniter 4', 'Aplikasi Magang', '1678166468_0565ab682896b3312058.pdf', 'Individu', '', '', '1678166468_0a728425c96575a93151.mp4', '1679982636_2fde432548f29453a1d1.jpg', '1678166468_c02f7458481a26867c4f.pdf', '1678166468_b8d4f9824fd4b0575ed2.pdf', 'Selesai', 'Selesai', 'Selesai', '2023-03-07', 'Selesai', 'Belum Verifikasi', '', '2023-03-07 12:17:53', '2023-05-10 04:24:11'),
(7, 3, 1, 5, 2, 202212006, 'TOKYO', '12201067', 'Kerja Praktek', '08122344559', 'Purworejo', 'UGM', 'Sistem Informasi', 'Back End Web', 'Laravel', 'Aplikasi Pendataan Karyawan', '1678260323_dd9e1d28a703306393bb.pdf', 'Individu', '', '', '1678260323_8c6e2a33e631ab8e8fe0.mp4', '1678260323_d755ebac279e0050d34a.jpg', '1678260323_89d10a4cdc0555607dc5.pdf', '1678260323_e53c7aa2a2c6da7e4c90.pdf', 'Selesai', 'Selesai', 'Selesai', '2023-03-08', 'Selesai', 'Tidak Diterima', 'Slot Sudah Terisi/Sudah Penuh', '2023-03-07 15:47:07', '2023-05-24 04:45:54'),
(8, 4, 1, 1, 0, 202212007, 'NAIROBI', '12201099', 'Kerja Praktek', '081223345599', 'Gamping Sleman Yogyakarta', 'UGM', 'Teknik Informatika', 'Back End Developer', 'Laravel', 'Aplikasi Manajemen Data', '1679889128_bbf7d58086e05172e3a2.pdf', 'Individu', '', '', '1679889128_0f0344808745fbfdc57f.mp4', '1679889128_54825fa826cc08970bf9.jpg', '1679889128_c9b8d9143faac567bd17.pdf', '1679889128_7a4ef68617d29029569b.pdf', 'Selesai', 'Selesai', 'Selesai', '2023-03-27', 'Selesai', 'Diterima', '', '2023-03-27 10:15:43', '2023-05-06 00:35:51'),
(9, 5, 1, 4, 0, 202212008, 'MARK', '12233456', 'Kerja Praktek', '081291204919', 'Purworejo', 'UPN', 'Sistem Informasi', 'Fullstack Web Developer', 'Laravel', 'Perancangan SIAKAD', '1682090342_6cdb3cdd2c7ff5dc041f.pdf', 'Kelompok', '', '', '1682090342_ed4b7e48ddbaf6c11822.mp4', '1682090342_d087fa0a5832ee9a936d.jpg', '1682090342_742959e410fba72a018f.pdf', '1682090342_0a6c4f1655fbf5b75445.pdf', 'Selesai', 'Selesai', 'Selesai', '2023-04-21', 'Selesai', 'Diterima', '', '2023-04-21 22:02:28', '2023-04-30 02:33:41'),
(11, 10, 1, 4, 0, 202212009, 'BIMO SATRIO PUTRA PRADANA', '12201068', 'Kerja Praktek', '081291204919', 'Purworejo', 'UBSI', 'Sistem Informasi', 'Front End', 'Codeigniter 4', 'Perancangan SIAMANG', '1683176964_264ceeaa4fbe4e7ad4b1.pdf', 'Kelompok', 'SARA PUJA', 'DARMANTO', '1683176964_60e91c781d6437e41a9a.mp4', '1684688319_276e730ecc88f9dda949.jpg', '1683176964_db843255f03e1f629eac.pdf', '1683176964_ddf0b34972084cde5b81.pdf', 'Selesai', 'Selesai', 'Selesai', '2023-05-04', 'Selesai', 'Diterima', '', '2023-05-04 11:45:14', '2023-05-28 06:30:29'),
(12, 11, 1, 1, 0, 202212010, 'ODENSE', '12201068', 'Kerja Praktek', '081291204919', 'Purworejo', 'UNY', 'Sistem Informasi', 'Front End', 'Codeigniter 4', 'Perancangan absensi', '1683176964_264ceeaa4fbe4e7ad4b1.pdf', 'Kelompok', '', '', '1683176964_60e91c781d6437e41a9a.mp4', '1683176964_5d1be7e134cfc57e3384.jpg', '1683176964_db843255f03e1f629eac.pdf', '1683176964_ddf0b34972084cde5b81.pdf', 'Selesai', 'Selesai', 'Selesai', '2023-05-04', 'Selesai', 'Diterima', '', '2023-05-04 11:45:14', '2023-05-04 00:31:24'),
(14, 14, 1, 4, 0, 202212011, 'MICHAEL JORDAN', '12201079', 'Kerja Praktek', '082242249295', 'Gamping Sleman Yogyakarta', 'AMIKOM', 'Teknik Informatika', 'UI UX', 'FIGMA', 'UI UX design interface SIAMANG', '1683724697_24652dbf2094a508a3a3.pdf', 'Kelompok', 'Kobe Bryant', '', '1683724697_6d017864aa1b25fa7bd0.mp4', '1683724697_cec6a6c0b923cb9d5f67.jpg', '1683724697_b97dd58449fa800215eb.pdf', '1683724697_dfb6250d99edc5ac403c.pdf', 'Selesai', 'Selesai', 'Selesai', '2023-05-10', 'Selesai', 'Belum Verifikasi', '', '2023-05-10 19:49:27', '2023-05-10 20:31:23'),
(16, 16, 1, 4, 0, 202212012, 'BEKTI WINDU PRATIWI', '12200270', 'Kerja Praktek', '082241143101', 'Girimulyo, Kulon Progo', 'UGM', 'Sistem Informasi', 'Front End', 'React Js', 'Aplikasi Magang', '1684381163_72a2ab8e7910fda9fd02.pdf', 'Individu', '', '', '1684381163_c08975acd72d601ce8bb.mp4', '1684381163_9b13faeb3c9a428ccc56.jpg', '1684381163_2c7e2934ead627711092.pdf', '1684381163_7e962afd18964880b6aa.pdf', 'Selesai', 'Selesai', 'Selesai', '2023-05-18', 'Selesai', 'Diterima', '', '2023-05-18 10:38:17', '2023-05-17 22:40:02'),
(18, 18, 1, 4, 0, 202212013, 'PAIJO', '12200270', 'Kerja Praktek', '082241143101', 'bbtbtbtbtbtb', 'UNY', 'Sistem Informasi', 'xsxsxsxsxsxsxsxsx', 'figma', 'Aplikasi Magang', '1684546500_67768daa7c22d4ed11e8.pdf', 'Individu', '', '', '1684546500_4efdb8d1b5cbf8a9aa7e.mp4', '1684546500_5d2d94654dc5d3bd7aee.jpg', '1684546500_f850a36522ccf425588e.pdf', '1684546500_37211a1df44b285eb3ff.pdf', 'Selesai', 'Selesai', 'Selesai', '2023-05-20', 'Selesai', 'Diterima', '', '2023-05-20 08:32:47', '2023-05-19 20:36:14'),
(19, 19, 1, 2, 0, 202212014, 'MAULIDYA CAHYA DININGRAT', '12200270', 'Kerja Praktek', '082241143101', 'Kaltim', 'STPMD', 'Periklanan', 'design grafis', 'adobe', 'Multimedia Periklanan pada diskominfosan', '1684547185_3e605de9023784ab1702.pdf', 'Individu', '', '', '1684547185_cf61584eaa2287d5dec6.mp4', '1684547184_bb9cf5b966959c212566.jpg', '1684547184_cee6b36e3253d39db44b.pdf', '1684547185_6bddccbd207701560635.pdf', 'Selesai', 'Selesai', 'Selesai', '2023-05-20', 'Selesai', 'Diterima', '', '2023-05-20 08:42:21', '2023-05-19 20:48:04');

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

--
-- Dumping data untuk tabel `tbl_progresmagang`
--

INSERT INTO `tbl_progresmagang` (`id`, `user_id`, `tgl_bimbingan`, `pencapaian`, `file_presentasi`, `catatan`, `created_at`, `updated_at`) VALUES
(1, 5, '2023-05-04', 'Progress Minggu Pertama', '5_MARK_Progress_Magang.pdf', '', '2023-05-04 15:58:19', '2023-05-04 15:58:19'),
(2, 10, '2023-05-11', 'Progress minggu 1', '10_BIMO SATRIO_Progress_Magang.pdf', '', '2023-05-04 19:44:48', '2023-05-04 19:44:48'),
(3, 4, '2023-05-02', 'Progress minggu 1', '4_NAIROBI_Progress_Magang.pdf', '', '2023-05-07 20:21:38', '2023-05-07 20:21:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_sosialmedia`
--

CREATE TABLE `tbl_sosialmedia` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `website` varchar(50) NOT NULL,
  `github` varchar(50) NOT NULL,
  `twitter` varchar(50) NOT NULL,
  `instagram` varchar(50) NOT NULL,
  `facebook` varchar(50) NOT NULL,
  `linkedin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_sosialmedia`
--

INSERT INTO `tbl_sosialmedia` (`id`, `user_id`, `website`, `github`, `twitter`, `instagram`, `facebook`, `linkedin`) VALUES
(2, 10, 'http://localhost:8080/Profile', '', '', '', '', '');

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
(2, 0, 0, 3, 'BERLIN', 'berlinbercisk23@gmail.com', '7gLDb+UbWonkhALjhtoIWQvmyS45ghKqI39CVuqmVzi60mNpQprP4ByOWiIanz8rVLj38VsY7bwJy+ZUGdZ82h8qNCnq5jASTiueQBbH174KXqV0vlHCdfY=', '', '2023-04-14 10:48:14', '2023-03-07 12:17:53', '2023-04-26 04:08:45'),
(3, 0, 0, 3, 'TOKYO', 'tokyo@gmail.com', 'x7kOIMi+AcL9aXQr74fatZGMuUnal50GoO3KBwAwaHKFj8cWHDsLKG9OI8TCQ7jWZYs4cIqzUdJYwCUxExLbW8WUdUPWJxELxnRcPc/t+vZnZvVnC+i2Kw==', '', '2023-04-14 10:48:14', '2023-03-07 15:47:06', '2023-03-07 15:47:06'),
(4, 0, 0, 3, 'NAIROBI', 'nairobi@gmail.com', 'ikHrbWRx6rrasu3IxMHJ7a16c3HxBH2ys2AUFYJaSK6LtG+d5ZOc3YNb660qBl867o58k6Ezwg3GXjCq2x1QIVvVLTDKlZ9EgmNeCrefuyEEaev46oKl6Q==', '', '2023-04-14 10:48:14', '2023-03-27 10:15:39', '2023-03-27 10:15:39'),
(5, 0, 0, 3, 'MARK', 'mark@gmail.com', 'BKgMvc7Xp6S1JHeMkH6GuC445AGKydPzFcABFS4GPBc9PNj0/IlQd9+8ujIAhgxLggkV0belpNZ1aH0w7yIJbg+LzjUfGXmwcUvccJRmLYTpPnuTN7rUCw==', '', '2023-04-21 22:02:27', '2023-04-21 22:02:27', '2023-04-21 22:02:27'),
(6, 1, 4, 2, 'Mentor Aplikasi', 'mentorapk@diskominfosan.ac.id', 'hcJdk+Zs/DcAdyeLgJqxLsHOjzydN+rPOmunNmGEzsquMDb//CxFIueoa7x1dluEx0QiGnhAcL+86QszoLXtMxdhlLM83keRso7Mq/DULzCi/lVv0hIm/i8=', '', '2023-04-23 13:28:33', '2023-04-23 01:28:33', '2023-04-23 01:28:33'),
(7, 1, 2, 2, 'Mentor Multimedia', 'mentormultimedia@diskominfosan.ac.id', 'BHQ6s1wSL8bVUAtww6sxaYYJ6dkAk28BJdNyWolgk24WRDRo9Z5MtiHcYkExFN8tHMrg2EdOt1q59+mretib8rsitZQzwhuPerfVwaDR2T30Ti6q59qkH/s=', '', '2023-04-27 05:11:49', '2023-04-26 17:11:49', '2023-04-26 17:11:49'),
(8, 1, 1, 2, 'Mentor Perangkat Lunak', 'mentorperangkatlunak@diskominfosan.ac.id', 'yhO5Ij84E8j5J1MwqawZdkVg1QI9WPY43SMNBzOUDoLfKexPcKdJ2CLc4Gxkib6If6fr5nEfmbKcop0txjph2Q0ml1Q60bs/ny+xrB8J/zD9V/nj6OXEY+A=', '', '2023-05-03 13:19:13', '2023-05-03 01:19:13', '2023-05-03 01:19:13'),
(10, 0, 4, 3, 'BIMO SATRIO', 'bimosatrio814@gmail.com', '+Rqd0ZzV9Nqsb0JfLhsvtPNo78B9GNSoDDGTyB9WcY8Vd3S4xnpdeFpw/nEOdu3Owsjc3VlWkC8d7qoS/z0BaToctyKSpzDn0+j+hRfXYTAYl7R6F+24sw==', '', '2023-05-04 11:45:14', '2023-05-04 11:45:14', '2023-05-04 11:45:14'),
(11, 0, 0, 3, 'ODENSE', 'odense@gmail.com', 'mQSsVdySqE7BBbr2R1vEsOBWzcyBw2kPP74djPtLJe7bNGH/JqeCxTbjpNe5RG7mfiv/w4lkEhYbZ7FPbXvbJRBWRP5ENwZtzRg5zFJqd1E7uX2ZKRyUng==', '', '2023-05-04 12:29:05', '2023-05-04 12:29:05', '2023-05-04 12:29:05'),
(12, 1, 3, 2, 'Mentor Analisis', 'mentoranalisis@diskominfosan.ac.id', 'bQkRup50jqCyFPU7F6kXtA1JKb6k8wN9+IMGYRVtwj4UCXO1/5yn6TUMCFG2G4co1n5PGULcC0lVacsAyHJPqU3Qx6AQGK2cyhJv7SY78rR8tQCjhq1wCaU=', '', '2023-05-08 14:18:29', '2023-05-08 02:18:29', '2023-05-08 02:18:29'),
(14, 0, 0, 3, 'JORDAN', 'jordan@gmail.com', 'PKXj9vlkyIbxIolDpKHTbQV8WZhon65VYHk/9SYfNcGbs7QWJMrA0nVMgAgl5hrdYpWqRKx7ankFPH8Q9CiYizDstYkb+ABFt9mCDAQsx72hCZL4SUvauw==', '', '2023-05-10 19:49:27', '2023-05-10 19:49:27', '2023-05-10 19:49:27'),
(16, 0, 4, 3, 'BEKTI WINDU PRASTIWI', 'bektiwindu47@gmail.com', 'NiY+804q/+VoqEf9jNeLl+mMLQGD05Ex2hIliAcaC4l8IPqduZhZeCkRPFruYn9053mwIvM1jc3/qimndgMK5EJIrA4R7vmR/ifxeIKbO0JEL9lMdlLdSw==', '', '2023-05-18 10:38:17', '2023-05-18 10:38:17', '2023-05-18 10:38:17'),
(18, 0, 4, 3, 'PAIJO', 'paijo@gmail.com', 'SrWACni1SixssN7yWbD2mhcnWlsvzViAvWgdIVTWkX+1qP/twJU9vr72UaPnG5cKArisOYPGRNq9hlvYaontw/a9FjRGMiuyevuq6jecG4RbcSjmQ4uXBg==', '', '2023-05-20 08:32:47', '2023-05-20 08:32:47', '2023-05-20 08:33:58'),
(19, 0, 2, 3, 'DINI', 'dini@gmail.com', '07SHmvK3hKrH1PBYEfKFi8i94TkcoFIWtIiue6wD29JZr+iwtlXapREXj3zlB+9ckU4MWKIVpzUWPASIP5jWvgmrxkOq09X5B3/rV4gcqaNFg/QVGXmdTA==', '', '2023-05-20 08:42:21', '2023-05-20 08:42:21', '2023-05-20 08:45:40'),
(20, 2, 6, 2, 'Mentor Jaringan', 'mentorjaringan@diskominfosan.ac.id', 'fNjT6LsqWpt0yRwEskUJLzH5QHhdCaFojNgeBbNA5Yy2WPeZpnDSXiDRtjFEOuKtmD/wsOto61tuSPqhTTcdmEtEY0F8UsECF6caO3Di8hQyo/ASPYcxtlQ=', '', '2023-05-24 18:55:26', '2023-05-24 06:55:26', '2023-05-24 06:55:26'),
(21, 2, 5, 2, 'Mentor Server', 'mentorserver@diskominfosan.ac.id', 'K9+u43PB5aeiX0knacGl0pHiwKwxC+OhX4ByNKDRkUF4q6qUtCZavtutBF5imITUZLkqr6s3vL8EGWLVv2TYMShE3B5dYS+iHaZkM5lHFhrDunl2OTjid8g=', '', '2023-05-24 18:58:13', '2023-05-24 06:58:13', '2023-05-24 06:58:13');

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
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `fakultas_id` (`bidang_id`),
  ADD KEY `user_id` (`user_id`);

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
  ADD PRIMARY KEY (`id`);

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
-- Indeks untuk tabel `tbl_sosialmedia`
--
ALTER TABLE `tbl_sosialmedia`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_pendaftaran`
--
ALTER TABLE `tbl_pendaftaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `tbl_progresmagang`
--
ALTER TABLE `tbl_progresmagang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_sosialmedia`
--
ALTER TABLE `tbl_sosialmedia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `tbl_user_role`
--
ALTER TABLE `tbl_user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_laporan`
--
ALTER TABLE `tbl_laporan`
  ADD CONSTRAINT `tbl_laporan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`);

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
