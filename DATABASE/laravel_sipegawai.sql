-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 08, 2021 at 03:18 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_sipegawai`
--

-- --------------------------------------------------------

--
-- Table structure for table `akses`
--

CREATE TABLE `akses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_role` bigint(20) UNSIGNED NOT NULL,
  `id_menu` bigint(20) UNSIGNED NOT NULL,
  `is_aktif` enum('true','false') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cuti`
--

CREATE TABLE `cuti` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pegawai` bigint(20) UNSIGNED NOT NULL,
  `tipe_cuti` enum('Tahunan','Besar','Bersama','Hamil','Sakit','Penting') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_pengajuan` date NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `ket` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Disetujui','Ditolak','Diproses') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_disetujui` date DEFAULT NULL,
  `tgl_ditolak` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nm_divisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id`, `nm_divisi`, `created_at`, `updated_at`) VALUES
(1, 'Eksekutif', NULL, NULL),
(2, 'Human Resource', NULL, NULL),
(3, 'General Affairs', NULL, NULL),
(4, 'Environment', NULL, NULL),
(5, 'Safety', NULL, NULL),
(6, 'Produksi', NULL, NULL),
(7, 'Work Technical', NULL, NULL),
(8, 'Quality Assurance ', NULL, NULL),
(9, 'Engineering', NULL, NULL),
(10, 'Accounting', NULL, NULL),
(11, 'Information Technology', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `group_menu`
--

CREATE TABLE `group_menu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nm_group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `group_menu`
--

INSERT INTO `group_menu` (`id`, `nm_group`, `created_at`, `updated_at`) VALUES
(1, 'empty', NULL, NULL),
(2, 'PEGAWAI', NULL, NULL),
(3, 'DIVISI', NULL, NULL),
(4, 'JABATAN', NULL, NULL),
(5, 'CUTI', NULL, NULL),
(6, 'PRESENSI', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nm_jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gaji_pokok` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `nm_jabatan`, `gaji_pokok`, `created_at`, `updated_at`) VALUES
(1, 'Direksi', 15000000, NULL, NULL),
(2, 'Direktur Utama', 10000000, NULL, NULL),
(3, 'Direktur Keuangan', 10000000, NULL, NULL),
(4, 'Direktur Personalia', 10000000, NULL, NULL),
(5, 'Direktur ', 7000000, NULL, NULL),
(6, 'Manager ', 7000000, NULL, NULL),
(7, 'Manager Personalia ', 7000000, NULL, NULL),
(8, 'Manager Pemasaran ', 7000000, NULL, NULL),
(9, 'Staff ', 7000000, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `urutan_menu` bigint(20) UNSIGNED NOT NULL,
  `nm_menu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_menu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url_menu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_group` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_02_27_143833_create_jabatans_table', 1),
(5, '2021_02_27_144019_create_divisis_table', 1),
(6, '2021_02_27_145341_create_group_menus_table', 1),
(7, '2021_02_27_145934_create_menus_table', 1),
(8, '2021_02_27_151649_create_roles_table', 1),
(9, '2021_02_27_155241_create_akses_table', 1),
(10, '2021_02_27_181740_create_pegawais_table', 1),
(13, '2021_02_28_022252_create_riwayat_jabatans_table', 1),
(14, '2021_02_28_022637_create_riwayat_divisis_table', 1),
(15, '2021_02_28_021611_create_cutis_table', 2),
(16, '2021_02_28_021828_create_presensi_harians_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_role` bigint(20) UNSIGNED NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jk` enum('Pria','Wanita') COLLATE utf8mb4_unicode_ci NOT NULL,
  `agama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat_ktp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat_dom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Menikah','Lajang') COLLATE utf8mb4_unicode_ci NOT NULL,
  `jml_anak` int(11) NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_masuk` date NOT NULL,
  `id_jabatan` bigint(20) UNSIGNED NOT NULL,
  `id_divisi` bigint(20) UNSIGNED NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `id_role`, `nik`, `nama`, `jk`, `agama`, `tempat_lahir`, `tgl_lahir`, `alamat_ktp`, `alamat_dom`, `status`, `jml_anak`, `no_hp`, `email`, `password`, `tgl_masuk`, `id_jabatan`, `id_divisi`, `path`, `created_at`, `updated_at`) VALUES
(21030001, 1, '1273372006209355', 'Erik Kurniawan', 'Wanita', 'Hindu', 'Cimahi', '1976-08-25', 'Gg. Batako No. 517', 'Psr. Ketandan No. 27', 'Lajang', 4, '027 1701 5461', 'luwar.wahyudin@yahoo.co.id', '/f\\y=mrP@9_3/&<', '2011-10-21', 1, 9, 'foto.jpg', NULL, NULL),
(21030002, 2, '3523681605073613', 'Galih Wacana M.Kom.', 'Pria', 'Islam', 'Sorong', '1994-01-08', 'Ki. Ciwastra No. 574', 'Dk. Jayawijaya No. 658', 'Menikah', 0, '0831 793 252', 'hariyah.maida@maryati.desa.id', 'eHr:kTbGAC#Ia>v?_bT', '1996-11-14', 4, 9, 'foto.jpg', NULL, NULL),
(21030003, 3, '1403614612196895', 'Ika Restu Yuniar S.Pd', 'Pria', 'Kristen', 'Lhokseumawe', '1996-08-08', 'Ki. Pacuan Kuda No. 691', 'Jr. Sutami No. 204', 'Menikah', 1, '(+62) 813 496 130', 'ssusanti@yahoo.co.id', '.-S=gE[3j[JmQgPr!2', '1982-02-22', 8, 6, 'foto.jpg', NULL, NULL),
(21030004, 3, '6210171708023918', 'Karta Saptono', 'Wanita', 'Protestan', 'Solok', '1997-09-01', 'Ds. Baya Kali Bungur No. 829', 'Jr. Krakatau No. 229', 'Lajang', 5, '(+62) 21 8165 4962', 'prastuti.clara@yahoo.com', '%qjv\'.QC', '1996-12-07', 5, 4, 'foto.jpg', NULL, NULL),
(21030005, 3, '3503811906068099', 'Salsabila Raisa Rahayu S.I.Kom', 'Pria', 'Buddha', 'Balikpapan', '1992-02-11', 'Ds. Setia Budi No. 401', 'Gg. Yosodipuro No. 827', 'Menikah', 3, '0418 9453 332', 'jessica55@yahoo.co.id', '$<oNus7Y', '1997-04-17', 5, 7, 'foto.jpg', NULL, NULL),
(21030006, 2, '1173632112196019', 'Praba Adinata Prasetyo', 'Wanita', 'Kristen', 'Tomohon', '2003-01-21', 'Dk. Ki Hajar Dewantara No. 611', 'Ds. Sudirman No. 284', 'Lajang', 1, '0254 3003 5289', 'putra.genta@gmail.com', 'F#=na8DxK>}3', '1994-03-14', 1, 10, 'foto.jpg', NULL, NULL),
(21030007, 3, '1405856307910155', 'Balapati Wisnu Suwarno', 'Wanita', 'Protestan', 'Jambi', '1994-01-15', 'Ds. Suryo No. 868', 'Jln. Flora No. 930', 'Lajang', 5, '(+62) 615 6385 7127', 'bpadmasari@gmail.com', '8ki$kt\"T?_l]l;of~Djo', '2014-06-14', 2, 11, 'foto.jpg', NULL, NULL),
(21030008, 3, '7315720911091030', 'Ibrani Saefullah', 'Wanita', 'Hindu', 'Sibolga', '1970-06-13', 'Dk. Barat No. 398', 'Jr. Baranangsiang No. 111', 'Lajang', 4, '(+62) 200 8808 035', 'yulia.rahmawati@gmail.co.id', 'vKhQX\"fc\'d', '1986-09-28', 8, 8, 'foto.jpg', NULL, NULL),
(21030009, 3, '6109904304975104', 'Ratih Kuswandari', 'Pria', 'Kristen', 'Pekalongan', '2009-04-15', 'Kpg. Laswi No. 688', 'Jr. Ekonomi No. 563', 'Menikah', 1, '0807 698 792', 'irma92@gmail.co.id', 'EAHwCG,', '2006-11-04', 2, 5, 'foto.jpg', NULL, NULL),
(21030010, 1, '1305571502077862', 'Iriana Pertiwi', 'Wanita', 'Kristen', 'Pontianak', '1973-02-06', 'Jln. Baya Kali Bungur No. 935', 'Gg. Rajawali Barat No. 455', 'Lajang', 1, '0279 7217 019', 'cahyanto.siregar@yahoo.com', 'bfK;_w%zFr,$>2L9{b[', '1970-12-28', 2, 3, 'foto.jpg', NULL, NULL),
(21030011, 2, '9203074401212483', 'Ratih Nasyiah M.Kom.', 'Pria', 'Islam', 'Administrasi Jakarta Timur', '2001-03-12', 'Jr. Achmad No. 265', 'Ki. Raya Ujungberung No. 757', 'Menikah', 0, '(+62) 882 952 418', 'saragih.balapati@yahoo.com', 'sWxTgR(dtKnl\\/', '1997-11-23', 9, 10, 'foto.jpg', NULL, NULL),
(21030012, 1, '6306606411076437', 'Ibrani Pradipta', 'Pria', 'Hindu', 'Palu', '1976-09-15', 'Psr. Nangka No. 505', 'Ki. Sutami No. 257', 'Menikah', 4, '0851 3325 311', 'emil98@gmail.co.id', 'L$/k_>&UbV6JG\\:', '1988-02-22', 9, 9, 'foto.jpg', NULL, NULL),
(21030013, 3, '1274611903000507', 'Tami Purnawati', 'Wanita', 'Kristen', 'Mojokerto', '2005-06-30', 'Kpg. Cut Nyak Dien No. 11', 'Kpg. Basket No. 514', 'Lajang', 1, '0706 0774 873', 'xwidiastuti@yahoo.co.id', 'Z(!c7Eq7S', '1981-03-14', 3, 6, 'foto.jpg', NULL, NULL),
(21030014, 1, '7211992702012835', 'Kairav Prabowo', 'Pria', 'Kristen', 'Lubuklinggau', '1977-04-17', 'Kpg. Abang No. 30', 'Jln. Bakhita No. 71', 'Menikah', 1, '0821 4628 2666', 'knugroho@gmail.co.id', 'Zg_ImNgU\'3W]!trVX3', '2014-07-10', 6, 3, 'foto.jpg', NULL, NULL),
(21030015, 1, '1219385110970607', 'Fitriani Hassanah', 'Pria', 'Hindu', 'Probolinggo', '1987-07-08', 'Gg. Kalimalang No. 960', 'Jr. Sam Ratulangi No. 760', 'Menikah', 4, '(+62) 565 6678 504', 'cpurnawati@wahyuni.desa.id', '[Blh]Bl_F:1[B', '2003-02-15', 2, 11, 'foto.jpg', NULL, NULL),
(21030016, 3, '1214845710106117', 'Tantri Azalea Mayasari', 'Pria', 'Protestan', 'Tidore Kepulauan', '2011-07-06', 'Jr. Labu No. 40', 'Dk. Basuki No. 620', 'Menikah', 5, '(+62) 560 6082 4288', 'zelda94@gmail.com', 'lJ!6Vc1/oA/^cz2I><ly', '1989-05-02', 1, 3, 'foto.jpg', NULL, NULL),
(21030017, 2, '9203450406133335', 'Heru Wawan Thamrin M.Kom.', 'Wanita', 'Kristen', 'Magelang', '2004-07-11', 'Ki. Cihampelas No. 836', 'Kpg. Bambon No. 298', 'Lajang', 1, '(+62) 957 1042 643', 'budiyanto.ajeng@gmail.co.id', '[F8agZwQ/WF', '2001-08-26', 7, 8, 'foto.jpg', NULL, NULL),
(21030018, 2, '5303880504088232', 'Hasna Nuraini', 'Pria', 'Protestan', 'Pasuruan', '2003-05-28', 'Dk. Qrisdoren No. 3', 'Ds. Dewi Sartika No. 919', 'Menikah', 5, '0207 8694 9239', 'msetiawan@laksita.in', ',gYm9s0plU-ZiA8', '1978-09-15', 3, 1, 'foto.jpg', NULL, NULL),
(21030019, 2, '1809864102101160', 'Dagel Jayeng Marpaung', 'Pria', 'Hindu', 'Tebing Tinggi', '1993-10-14', 'Kpg. Otto No. 49', 'Dk. Sampangan No. 279', 'Menikah', 4, '(+62) 776 7036 313', 'bakiadi91@pudjiastuti.com', ']TBN}?@q.', '1993-06-24', 4, 5, 'foto.jpg', NULL, NULL),
(21030020, 3, '1308800305936767', 'Cindy Hasanah', 'Pria', 'Protestan', 'Solok', '1975-11-18', 'Jr. Bakaru No. 412', 'Jr. Suprapto No. 432', 'Menikah', 5, '(+62) 705 6983 360', 'wnasyiah@yahoo.co.id', 'IT3SxKKCuu6t4Jn', '2013-12-03', 9, 8, 'foto.jpg', NULL, NULL),
(21030021, 3, '3507570702124795', 'Candra Damanik', 'Pria', 'Islam', 'Palopo', '2015-10-20', 'Ds. Abang No. 564', 'Gg. Haji No. 882', 'Menikah', 0, '0988 9755 775', 'namaga.harimurti@gmail.co.id', 'D24x6gznDF`NCVFmVB', '2012-10-13', 3, 4, 'foto.jpg', NULL, NULL),
(21030022, 1, '1224421404153112', 'Bella Uyainah', 'Wanita', 'Hindu', 'Madiun', '1977-10-07', 'Psr. Sadang Serang No. 11', 'Psr. Raden No. 209', 'Lajang', 4, '0237 8468 684', 'pudjiastuti.gandewa@nasyidah.net', 'Pw3b!&>f36@1:', '1972-06-10', 8, 1, 'foto.jpg', NULL, NULL),
(21030023, 3, '3374186703949185', 'Luluh Pranowo', 'Pria', 'Buddha', 'Salatiga', '1981-03-16', 'Jr. Sampangan No. 831', 'Ki. Baya Kali Bungur No. 379', 'Menikah', 3, '0854 1588 9506', 'ipudjiastuti@gmail.com', '5S_^VJ,K', '1978-11-25', 3, 9, 'foto.jpg', NULL, NULL),
(21030024, 1, '3321771406150224', 'Natalia Pertiwi', 'Wanita', 'Katholik', 'Jayapura', '1977-04-25', 'Jln. Gegerkalong Hilir No. 310', 'Gg. Aceh No. 756', 'Lajang', 2, '(+62) 849 9981 384', 'mahendra.mariadi@hassanah.sch.id', 'RCx#FFaV4?^v09gPFj4', '2015-08-27', 9, 5, 'foto.jpg', NULL, NULL),
(21030025, 2, '9128855708200164', 'Capa Asmadi Saputra', 'Pria', 'Buddha', 'Administrasi Jakarta Selatan', '2021-01-25', 'Gg. Agus Salim No. 559', 'Jr. B.Agam Dlm No. 36', 'Menikah', 3, '(+62) 20 8462 2049', 'saragih.langgeng@gmail.co.id', 'Ob;>jT=~/th\'sh>}Jt.[', '1975-01-07', 1, 5, 'foto.jpg', NULL, NULL),
(21030026, 3, '9102854805986323', 'Wage Kariman Dabukke', 'Pria', 'Kristen', 'Pariaman', '1999-08-06', 'Ki. Basuki Rahmat  No. 882', 'Kpg. Zamrud No. 564', 'Menikah', 1, '(+62) 680 6204 2299', 'lestari.paulin@gmail.co.id', 'Hf/66AG#\\PRY', '1974-12-06', 1, 8, 'foto.jpg', NULL, NULL),
(21030027, 2, '1220666410120824', 'Luis Hutasoit', 'Wanita', 'Islam', 'Tebing Tinggi', '2002-05-06', 'Gg. Basuki No. 327', 'Jln. R.E. Martadinata No. 365', 'Lajang', 0, '0949 2562 629', 'zpuspita@yahoo.co.id', 'nP#sZObRU>hlF+4~N]\"*', '1988-09-22', 2, 10, 'foto.jpg', NULL, NULL),
(21030028, 2, '9120364402118704', 'Soleh Dongoran S.Pd', 'Wanita', 'Kristen', 'Denpasar', '1988-06-09', 'Ki. Elang No. 719', 'Kpg. Moch. Yamin No. 716', 'Lajang', 1, '0625 4401 048', 'hassanah.mahdi@gmail.co.id', 'f79Wa>e&FiHQcl}', '1990-01-08', 5, 2, 'foto.jpg', NULL, NULL),
(21030029, 1, '1171732404034113', 'Himawan Emong Natsir M.Pd', 'Pria', 'Katholik', 'Serang', '2016-08-20', 'Psr. Bass No. 264', 'Ds. Bambon No. 680', 'Menikah', 2, '0254 1956 9923', 'wirda29@nababan.org', '#wkzap', '2009-12-19', 7, 5, 'foto.jpg', NULL, NULL),
(21030030, 2, '7315844107067011', 'Kayla Puspasari', 'Pria', 'Protestan', 'Pekanbaru', '2009-09-16', 'Ki. Kartini No. 916', 'Jln. R.M. Said No. 98', 'Menikah', 5, '0365 1701 5040', 'dkuswandari@yahoo.com', '$F8?h-oh', '2021-02-06', 3, 9, 'foto.jpg', NULL, NULL),
(21030031, 2, '3301212304000004', 'Hanif Fauzi Hakim', 'Pria', 'Islam', 'Cilacap', '2000-04-23', 'Jl.Karang Kamulyan RW 03', 'Cilacap Selatan', 'Menikah', 1, '081338539449', 'haniffauzihakim4049@gmail.com', '8MGIEOIaRLRz', '2010-04-22', 7, 10, '3301212304000004_0703210850.jpg', '2021-03-07 01:50:16', '2021-03-07 01:50:16');

-- --------------------------------------------------------

--
-- Table structure for table `presensi_harian`
--

CREATE TABLE `presensi_harian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pegawai` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `ket` enum('Hadir','Cuti','Alpha') COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_dtg` time DEFAULT NULL,
  `jam_plg` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `presensi_harian`
--

INSERT INTO `presensi_harian` (`id`, `id_pegawai`, `tanggal`, `ket`, `jam_dtg`, `jam_plg`, `created_at`, `updated_at`) VALUES
(1, 21030004, '2021-03-15', 'Hadir', '15:33:00', '20:29:00', '2021-03-07 01:29:06', '2021-03-07 01:29:06');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_divisi`
--

CREATE TABLE `riwayat_divisi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pegawai` bigint(20) UNSIGNED NOT NULL,
  `id_divisi` bigint(20) UNSIGNED NOT NULL,
  `tgl_mulai` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_jabatan`
--

CREATE TABLE `riwayat_jabatan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pegawai` bigint(20) UNSIGNED NOT NULL,
  `id_jabatan` bigint(20) UNSIGNED NOT NULL,
  `tgl_mulai` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nm_role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `nm_role`, `url`, `created_at`, `updated_at`) VALUES
(1, 'Super-Admin', '/admin', NULL, NULL),
(2, 'HRD', '/hrd', NULL, NULL),
(3, 'Staff', '/staff', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akses`
--
ALTER TABLE `akses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `akses_id_role_index` (`id_role`),
  ADD KEY `akses_id_menu_index` (`id_menu`);

--
-- Indexes for table `cuti`
--
ALTER TABLE `cuti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cuti_id_pegawai_index` (`id_pegawai`);

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `group_menu`
--
ALTER TABLE `group_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id_group_index` (`id_group`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pegawai_nik_unique` (`nik`),
  ADD UNIQUE KEY `pegawai_email_unique` (`email`),
  ADD KEY `pegawai_id_jabatan_index` (`id_jabatan`),
  ADD KEY `pegawai_id_divisi_index` (`id_divisi`),
  ADD KEY `pegawai_id_role_index` (`id_role`);

--
-- Indexes for table `presensi_harian`
--
ALTER TABLE `presensi_harian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `presensi_harian_id_pegawai_index` (`id_pegawai`);

--
-- Indexes for table `riwayat_divisi`
--
ALTER TABLE `riwayat_divisi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `riwayat_divisi_id_pegawai_index` (`id_pegawai`),
  ADD KEY `riwayat_divisi_id_divisi_index` (`id_divisi`);

--
-- Indexes for table `riwayat_jabatan`
--
ALTER TABLE `riwayat_jabatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `riwayat_jabatan_id_pegawai_index` (`id_pegawai`),
  ADD KEY `riwayat_jabatan_id_jabatan_index` (`id_jabatan`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akses`
--
ALTER TABLE `akses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cuti`
--
ALTER TABLE `cuti`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_menu`
--
ALTER TABLE `group_menu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21030032;

--
-- AUTO_INCREMENT for table `presensi_harian`
--
ALTER TABLE `presensi_harian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `riwayat_divisi`
--
ALTER TABLE `riwayat_divisi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `riwayat_jabatan`
--
ALTER TABLE `riwayat_jabatan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `akses`
--
ALTER TABLE `akses`
  ADD CONSTRAINT `akses_id_menu_foreign` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `akses_id_role_foreign` FOREIGN KEY (`id_role`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cuti`
--
ALTER TABLE `cuti`
  ADD CONSTRAINT `cuti_id_pegawai_foreign` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_id_group_foreign` FOREIGN KEY (`id_group`) REFERENCES `group_menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_id_divisi_foreign` FOREIGN KEY (`id_divisi`) REFERENCES `divisi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pegawai_id_jabatan_foreign` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pegawai_id_role_foreign` FOREIGN KEY (`id_role`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `presensi_harian`
--
ALTER TABLE `presensi_harian`
  ADD CONSTRAINT `presensi_harian_id_pegawai_foreign` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `riwayat_divisi`
--
ALTER TABLE `riwayat_divisi`
  ADD CONSTRAINT `riwayat_divisi_id_divisi_foreign` FOREIGN KEY (`id_divisi`) REFERENCES `divisi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `riwayat_divisi_id_pegawai_foreign` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `riwayat_jabatan`
--
ALTER TABLE `riwayat_jabatan`
  ADD CONSTRAINT `riwayat_jabatan_id_jabatan_foreign` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `riwayat_jabatan_id_pegawai_foreign` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
