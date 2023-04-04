-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2022 at 10:33 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sit`
--

-- --------------------------------------------------------

--
-- Table structure for table `coaching_log`
--

CREATE TABLE `coaching_log` (
  `id_coaching_log` int(11) NOT NULL,
  `id_tenant` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  `hasil_sebelumnya` text NOT NULL,
  `tujuan_ini` text NOT NULL,
  `hasil_ingin` text NOT NULL,
  `hasil_dicapai` text NOT NULL,
  `tujuan_selanjutnya` text NOT NULL,
  `jawaban` text NOT NULL,
  `dokumen` varchar(255) NOT NULL,
  `feedback` text NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `coach` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coaching_log`
--

INSERT INTO `coaching_log` (`id_coaching_log`, `id_tenant`, `id_user`, `hasil_sebelumnya`, `tujuan_ini`, `hasil_ingin`, `hasil_dicapai`, `tujuan_selanjutnya`, `jawaban`, `dokumen`, `feedback`, `tanggal`, `coach`) VALUES
(15, '25', 14, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum et augue vel orci efficitur pharetra eu at turpis. Donec pulvinar nec mi in sodales. Ut ac vehicula quam. Sed euismod dignissim erat nec tempor. Mauris laoreet quam lacus. Cras vitae lobortis nunc. Curabitur vitae sapien a justo feugiat vulputate.\r\n\r\nDuis hendrerit justo ut finibus varius. Cras at tellus tristique, aliquet ligula non, rhoncus elit. In congue nibh bibendum nisi tristique vehicula. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris sed sagittis felis, vel luctus erat. Nullam porta neque in finibus pellentesque. Sed magna mi, tincidunt sodales leo sed, semper posuere orci. In tempus, nisl in vehicula dignissim, quam eros facilisis arcu, sit amet pretium lectus massa eu quam.\r\n\r\nPellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Suspendisse varius vitae libero at feugiat. Aenean egestas id dui eget ultricies. In porttitor accumsan diam in lobortis. Vestibulum justo orci, rutrum id sapien eu, volutpat facilisis ipsum. Donec malesuada dui in tortor volutpat molestie. Duis blandit lectus eget tortor fringilla, sed dictum sapien lobortis.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum et augue vel orci efficitur pharetra eu at turpis. Donec pulvinar nec mi in sodales. Ut ac vehicula quam. Sed euismod dignissim erat nec tempor. Mauris laoreet quam lacus. Cras vitae lobortis nunc. Curabitur vitae sapien a justo feugiat vulputate.\r\n\r\nDuis hendrerit justo ut finibus varius. Cras at tellus tristique, aliquet ligula non, rhoncus elit. In congue nibh bibendum nisi tristique vehicula. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris sed sagittis felis, vel luctus erat. Nullam porta neque in finibus pellentesque. Sed magna mi, tincidunt sodales leo sed, semper posuere orci. In tempus, nisl in vehicula dignissim, quam eros facilisis arcu, sit amet pretium lectus massa eu quam.\r\n\r\nPellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Suspendisse varius vitae libero at feugiat. Aenean egestas id dui eget ultricies. In porttitor accumsan diam in lobortis. Vestibulum justo orci, rutrum id sapien eu, volutpat facilisis ipsum. Donec malesuada dui in tortor volutpat molestie. Duis blandit lectus eget tortor fringilla, sed dictum sapien lobortis.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum et augue vel orci efficitur pharetra eu at turpis. Donec pulvinar nec mi in sodales. Ut ac vehicula quam. Sed euismod dignissim erat nec tempor. Mauris laoreet quam lacus. Cras vitae lobortis nunc. Curabitur vitae sapien a justo feugiat vulputate.\r\n\r\nDuis hendrerit justo ut finibus varius. Cras at tellus tristique, aliquet ligula non, rhoncus elit. In congue nibh bibendum nisi tristique vehicula. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris sed sagittis felis, vel luctus erat. Nullam porta neque in finibus pellentesque. Sed magna mi, tincidunt sodales leo sed, semper posuere orci. In tempus, nisl in vehicula dignissim, quam eros facilisis arcu, sit amet pretium lectus massa eu quam.\r\n\r\nPellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Suspendisse varius vitae libero at feugiat. Aenean egestas id dui eget ultricies. In porttitor accumsan diam in lobortis. Vestibulum justo orci, rutrum id sapien eu, volutpat facilisis ipsum. Donec malesuada dui in tortor volutpat molestie. Duis blandit lectus eget tortor fringilla, sed dictum sapien lobortis.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum et augue vel orci efficitur pharetra eu at turpis. Donec pulvinar nec mi in sodales. Ut ac vehicula quam. Sed euismod dignissim erat nec tempor. Mauris laoreet quam lacus. Cras vitae lobortis nunc. Curabitur vitae sapien a justo feugiat vulputate.\r\n\r\nDuis hendrerit justo ut finibus varius. Cras at tellus tristique, aliquet ligula non, rhoncus elit. In congue nibh bibendum nisi tristique vehicula. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris sed sagittis felis, vel luctus erat. Nullam porta neque in finibus pellentesque. Sed magna mi, tincidunt sodales leo sed, semper posuere orci. In tempus, nisl in vehicula dignissim, quam eros facilisis arcu, sit amet pretium lectus massa eu quam.\r\n\r\nPellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Suspendisse varius vitae libero at feugiat. Aenean egestas id dui eget ultricies. In porttitor accumsan diam in lobortis. Vestibulum justo orci, rutrum id sapien eu, volutpat facilisis ipsum. Donec malesuada dui in tortor volutpat molestie. Duis blandit lectus eget tortor fringilla, sed dictum sapien lobortis.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum et augue vel orci efficitur pharetra eu at turpis. Donec pulvinar nec mi in sodales. Ut ac vehicula quam. Sed euismod dignissim erat nec tempor. Mauris laoreet quam lacus. Cras vitae lobortis nunc. Curabitur vitae sapien a justo feugiat vulputate.\r\n\r\nDuis hendrerit justo ut finibus varius. Cras at tellus tristique, aliquet ligula non, rhoncus elit. In congue nibh bibendum nisi tristique vehicula. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris sed sagittis felis, vel luctus erat. Nullam porta neque in finibus pellentesque. Sed magna mi, tincidunt sodales leo sed, semper posuere orci. In tempus, nisl in vehicula dignissim, quam eros facilisis arcu, sit amet pretium lectus massa eu quam.\r\n\r\nPellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Suspendisse varius vitae libero at feugiat. Aenean egestas id dui eget ultricies. In porttitor accumsan diam in lobortis. Vestibulum justo orci, rutrum id sapien eu, volutpat facilisis ipsum. Donec malesuada dui in tortor volutpat molestie. Duis blandit lectus eget tortor fringilla, sed dictum sapien lobortis.', '', '', '', '2022-04-06', 'Wijaya Kusuma, Asep Kuncoro'),
(25, '27', 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum et augue vel orci efficitur pharetra eu at turpis. Donec pulvinar nec mi in sodales. Ut ac vehicula quam. Sed euismod dignissim erat nec tempor. Mauris laoreet quam lacus. Cras vitae lobortis nunc. Curabitur vitae sapien a justo feugiat vulputate.\r\n\r\nDuis hendrerit justo ut finibus varius. Cras at tellus tristique, aliquet ligula non, rhoncus elit. In congue nibh bibendum nisi tristique vehicula. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris sed sagittis felis, vel luctus erat. Nullam porta neque in finibus pellentesque. Sed magna mi, tincidunt sodales leo sed, semper posuere orci. In tempus, nisl in vehicula dignissim, quam eros facilisis arcu, sit amet pretium lectus massa eu quam.\r\n\r\nPellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Suspendisse varius vitae libero at feugiat. Aenean egestas id dui eget ultricies. In porttitor accumsan diam in lobortis. Vestibulum justo orci, rutrum id sapien eu, volutpat facilisis ipsum. Donec malesuada dui in tortor volutpat molestie. Duis blandit lectus eget tortor fringilla, sed dictum sapien lobortis.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum et augue vel orci efficitur pharetra eu at turpis. Donec pulvinar nec mi in sodales. Ut ac vehicula quam. Sed euismod dignissim erat nec tempor. Mauris laoreet quam lacus. Cras vitae lobortis nunc. Curabitur vitae sapien a justo feugiat vulputate.\r\n\r\nDuis hendrerit justo ut finibus varius. Cras at tellus tristique, aliquet ligula non, rhoncus elit. In congue nibh bibendum nisi tristique vehicula. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris sed sagittis felis, vel luctus erat. Nullam porta neque in finibus pellentesque. Sed magna mi, tincidunt sodales leo sed, semper posuere orci. In tempus, nisl in vehicula dignissim, quam eros facilisis arcu, sit amet pretium lectus massa eu quam.\r\n\r\nPellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Suspendisse varius vitae libero at feugiat. Aenean egestas id dui eget ultricies. In porttitor accumsan diam in lobortis. Vestibulum justo orci, rutrum id sapien eu, volutpat facilisis ipsum. Donec malesuada dui in tortor volutpat molestie. Duis blandit lectus eget tortor fringilla, sed dictum sapien lobortis.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum et augue vel orci efficitur pharetra eu at turpis. Donec pulvinar nec mi in sodales. Ut ac vehicula quam. Sed euismod dignissim erat nec tempor. Mauris laoreet quam lacus. Cras vitae lobortis nunc. Curabitur vitae sapien a justo feugiat vulputate.\r\n\r\nDuis hendrerit justo ut finibus varius. Cras at tellus tristique, aliquet ligula non, rhoncus elit. In congue nibh bibendum nisi tristique vehicula. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris sed sagittis felis, vel luctus erat. Nullam porta neque in finibus pellentesque. Sed magna mi, tincidunt sodales leo sed, semper posuere orci. In tempus, nisl in vehicula dignissim, quam eros facilisis arcu, sit amet pretium lectus massa eu quam.\r\n\r\nPellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Suspendisse varius vitae libero at feugiat. Aenean egestas id dui eget ultricies. In porttitor accumsan diam in lobortis. Vestibulum justo orci, rutrum id sapien eu, volutpat facilisis ipsum. Donec malesuada dui in tortor volutpat molestie. Duis blandit lectus eget tortor fringilla, sed dictum sapien lobortis.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum et augue vel orci efficitur pharetra eu at turpis. Donec pulvinar nec mi in sodales. Ut ac vehicula quam. Sed euismod dignissim erat nec tempor. Mauris laoreet quam lacus. Cras vitae lobortis nunc. Curabitur vitae sapien a justo feugiat vulputate.\r\n\r\nDuis hendrerit justo ut finibus varius. Cras at tellus tristique, aliquet ligula non, rhoncus elit. In congue nibh bibendum nisi tristique vehicula. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris sed sagittis felis, vel luctus erat. Nullam porta neque in finibus pellentesque. Sed magna mi, tincidunt sodales leo sed, semper posuere orci. In tempus, nisl in vehicula dignissim, quam eros facilisis arcu, sit amet pretium lectus massa eu quam.\r\n\r\nPellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Suspendisse varius vitae libero at feugiat. Aenean egestas id dui eget ultricies. In porttitor accumsan diam in lobortis. Vestibulum justo orci, rutrum id sapien eu, volutpat facilisis ipsum. Donec malesuada dui in tortor volutpat molestie. Duis blandit lectus eget tortor fringilla, sed dictum sapien lobortis.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum et augue vel orci efficitur pharetra eu at turpis. Donec pulvinar nec mi in sodales. Ut ac vehicula quam. Sed euismod dignissim erat nec tempor. Mauris laoreet quam lacus. Cras vitae lobortis nunc. Curabitur vitae sapien a justo feugiat vulputate.\r\n\r\nDuis hendrerit justo ut finibus varius. Cras at tellus tristique, aliquet ligula non, rhoncus elit. In congue nibh bibendum nisi tristique vehicula. Interdum et malesuada fames ac ante ipsum primis in faucibus. Mauris sed sagittis felis, vel luctus erat. Nullam porta neque in finibus pellentesque. Sed magna mi, tincidunt sodales leo sed, semper posuere orci. In tempus, nisl in vehicula dignissim, quam eros facilisis arcu, sit amet pretium lectus massa eu quam.\r\n\r\nPellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Suspendisse varius vitae libero at feugiat. Aenean egestas id dui eget ultricies. In porttitor accumsan diam in lobortis. Vestibulum justo orci, rutrum id sapien eu, volutpat facilisis ipsum. Donec malesuada dui in tortor volutpat molestie. Duis blandit lectus eget tortor fringilla, sed dictum sapien lobortis.', '', '', '', '2022-04-06', 'Wijaya Kusuma');

-- --------------------------------------------------------

--
-- Table structure for table `data_usaha`
--

CREATE TABLE `data_usaha` (
  `id_data_usaha` int(11) NOT NULL,
  `id_tenant` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `perjanjian_usaha` text NOT NULL,
  `sertifikat_produk` text NOT NULL,
  `mulai_usaha` text NOT NULL,
  `modal_awal` varchar(255) NOT NULL,
  `sumber_usaha` text NOT NULL,
  `produk_dihasilkan` text NOT NULL,
  `aset` text NOT NULL,
  `kapasitas_produksi` varchar(255) NOT NULL,
  `omset` varchar(255) NOT NULL,
  `jangkauan_pasar` text NOT NULL,
  `tenaga_kerja_laki` varchar(255) NOT NULL,
  `tenaga_kerja_wanita` varchar(255) NOT NULL,
  `permasalahan` text NOT NULL,
  `rencana_pengembangan` text NOT NULL,
  `foto_produk` text NOT NULL,
  `proposal` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_usaha`
--

INSERT INTO `data_usaha` (`id_data_usaha`, `id_tenant`, `alamat`, `perjanjian_usaha`, `sertifikat_produk`, `mulai_usaha`, `modal_awal`, `sumber_usaha`, `produk_dihasilkan`, `aset`, `kapasitas_produksi`, `omset`, `jangkauan_pasar`, `tenaga_kerja_laki`, `tenaga_kerja_wanita`, `permasalahan`, `rencana_pengembangan`, `foto_produk`, `proposal`) VALUES
(13, 25, 'kedamaian', 'Tidak ada', 'Tidak ada', 'kemarin', '100.000', 'Pribadi:100.000', 'es', 'Tidak ada', '5', '10.000', 'ramai', '1', '1', 'gak ada', 'gak ada', 'contoh-foto-produk.png,', 'abcd'),
(14, 27, 'kedamaian', 'Tidak ada', 'Tidak ada', 'kemarin', '100.000', 'Pribadi:100.000', 'nasi', 'Tidak ada', '1', '10.000', 'ramai', '1', '1', 'tidak ada', 'tidak ada', 'sit-dashboard.png,', 'abcd'),
(15, 28, 'anjay', 'Tidak ada', 'Tidak ada', 'kamis kemarin', '100.000', 'Pribadi:100.000', 'coklat', 'Tidak ada', '12', '10.000', 'luas', '1', '1', 'tidak ada', 'tidak ada', 'contoh-foto-produk.png,', 'abcd'),
(16, 29, 'Kedaton', 'Tidak ada', 'Tidak ada', 'kemarin', '100.000', 'Pribadi:100.000', 'nasi kepal', 'Tidak ada', '10', '100.000', 'ramain', '1', '1', 'banyak', 'tidak ada', 'onigiri.jpg,onigiri2.jpeg,', 'abcd'),
(17, 31, 'pahoman', 'Tidak ada', 'Tidak ada', 'kemarin', '100.000', 'Pribadi:100.000', 'kroket', 'Tidak ada', '1', '10.000', 'ramai', '1', '1', 'gak ada', 'gak ada', 'contoh-foto-produk.png,', 'abcd'),
(18, 32, 'pahoman', 'Tidak ada', 'Tidak ada', 'kemarin', '100.000', 'Pribadi:100.000', 'kroket', 'Tidak ada', '12', '100.000', 'ramai', '1', '1', 'gak ada', 'gak ada', 'contoh-foto-produk.png,', 'abcd'),
(19, 33, 'a', 'Tidak ada', 'Tidak ada', 'kemarin', '100.000', 'Pribadi:100.000', 'mouse', 'Tidak ada', '1', '10.000', 'ramai', '1', '1', 'a', 'a', 'Mask_Group.png,', 'abcd'),
(21, 35, 'lempasing', 'Tidak ada', 'Tidak ada', 'kemarin', '100.000', 'Crowdfunding:90.000;Pribadi:100.000', 'ikan', 'Tidak ada', '100', '10.000', 'ramai', '1', '1', 'gak ada', 'gak ada', '16478113201_Foto-Produk_Nanda_Ikan.jpg,', '1647811320_Proposal_Nanda_Ikan.pdf'),
(22, 36, 'aaaaa', '16482994741_Perjanjian-Usaha_Anjay_tes.pdf,16482994742_Perjanjian-Usaha_Anjay_tes.pdf,', '16482994741_Sertifikat_Anjay_tes.pdf,', 'a', '123', 'Investasi:123', 'a', '16482994741_Aset_Anjay_tes.pdf,16482994742_Aset_Anjay_tes.pdf,', '123', '10.000', 'ramai', '1', '1', 'awd', 'awd', '16482994741_Foto-Produk_Anjay_tes.jpg,16482994742_Foto-Produk_Anjay_tes.jpg,', '1648299474_Proposal_Anjay_tes.pdf'),
(23, 37, 'awdawd', '16482995471_Perjanjian-Usaha_Anjay_tes_2.pdf,', '16482995471_Sertifikat_Anjay_tes_2.pdf,', 'awd', '1.234', 'Investasi:1.234', 'ikan', 'Tidak ada', '111111111', '1.111.111', 'awd', '1', '1', 'awdawd', 'awdawd', '16482995471_Foto-Produk_Anjay_tes_2.jpg,16482995472_Foto-Produk_Anjay_tes_2.ico,', '1648299547_Proposal_Anjay_tes_2.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `data_usaha2`
--

CREATE TABLE `data_usaha2` (
  `id_data_usaha2` int(11) NOT NULL,
  `id_tenant` int(11) NOT NULL,
  `presentasi` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `data_usaha2`
--

INSERT INTO `data_usaha2` (`id_data_usaha2`, `id_tenant`, `presentasi`, `link`, `profile`) VALUES
(4, 25, '1640337105.pptx', 'VB6SIKl8Md0', 'e07521ee453a21e0119a7dc509b06b7f.pdf'),
(5, 27, 'contoh.pptx', 'VB6SIKl8Md0', 'contoh_dokumen.pdf'),
(6, 28, 'contoh.pptx', '7JmprpRIsEY', 'contoh_dokumen.pdf'),
(7, 29, 'contoh.pptx', 'DEyskuDemx0', 'contoh_dokumen.pdf'),
(8, 33, 'contoh.pptx', 'VB6SIKl8Md0', 'contoh_dokumen.pdf'),
(10, 36, '1648299646_Presentasi_Anjay_tes.pptx', 'VB6SIKl8Md0', '1648299646_Profile_Anjay_tes.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `detail_kelas`
--

CREATE TABLE `detail_kelas` (
  `id_detail_kelas` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_pertemuan_kelas` int(11) NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `file` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_kelas`
--

INSERT INTO `detail_kelas` (`id_detail_kelas`, `id_kelas`, `id_pertemuan_kelas`, `jenis`, `deskripsi`, `file`) VALUES
(8, 1, 3, 'link', 'anjay(linkDelimiter)VB6SIKl8Md0', ''),
(9, 1, 3, 'feedback', 'aaaaaaaaaaaaaaa', ''),
(10, 1, 3, 'dokumen', 'Machine Learning for Lyfe', '1648021501_Machine_Learning_for_Lyfe.pdf'),
(11, 1, 3, 'assignment', 'Tugas Coaching 1(assignmentDelimiter)ini tugas coaching 1, dikerjain ya guys', '1639560119.pdf'),
(12, 1, 4, 'assignment', 'Tugas Coaching 2(assignmentDelimiter)ini tugas coaching 2, dikerjain ya guys', '1639560341.pdf'),
(39, 4, 15, 'dokumen', 'Machine Learning for Lyfe', '1648021501_Machine_Learning_for_Lyfe.pdf'),
(41, 4, 15, 'assignment', 'Training Snack Assignment(assignmentDelimiter)Dikerjain', '1642681632.pdf'),
(42, 4, 15, 'feedback', 'coba dicari cari dulu', ''),
(43, 4, 16, 'dokumen', 'Machine Learning for Lyfe', '1648021501_Machine_Learning_for_Lyfe.pdf'),
(45, 4, 16, 'link', 'anjay(linkDelimiter)VB6SIKl8Md0', ''),
(46, 4, 16, 'assignment', 'Training Snack Assignment 2(assignmentDelimiter)kerjain lagi', '1642682122.pdf'),
(49, 4, 15, 'link', 'anjay(linkDelimiter)VB6SIKl8Md0', ''),
(66, 3, 19, 'link', 'anjay(linkDelimiter)VB6SIKl8Md0', ''),
(69, 3, 18, 'assignment', 'Tugas Coaching Awal 11234(assignmentDelimiter)tolong dikerjain ya gaes aaaaaaaaaaaa aaaaaaaaaa', '1648111247_Assignment_Tugas Coaching Awal 11234.pdf'),
(70, 3, 18, 'dokumen', 'Machine Learning for Lyfe', '1648021501_Machine_Learning_for_Lyfe.pdf'),
(71, 3, 18, 'feedback', 'coba diulang ulang', ''),
(72, 3, 18, 'link', 'Link Materi 1(linkDelimiter)VB6SIKl8Md0', ''),
(73, 3, 19, 'assignment', 'tugas 2(assignmentDelimiter)aaa', '1643018153.pdf'),
(74, 3, 19, 'feedback', 'anjay', ''),
(75, 3, 19, 'dokumen', 'Machine Learning for Lyfe', '1648021501_Machine_Learning_for_Lyfe.pdf'),
(78, 3, 19, 'link', 'anjay(linkDelimiter)VB6SIKl8Md0', ''),
(79, 4, 16, 'link', 'anjay(linkDelimiter)VB6SIKl8Md0', ''),
(81, 3, 7, 'assignment', 'Pertemuan Makanan 1(assignmentDelimiter)Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras at turpis iaculis, pretium libero congue, iaculis velit. Morbi magna mauris, convallis vitae dolor a, venenatis hendrerit lectus. Nam lectus purus, gravida vel imperdiet fermentum, rutrum ac metus. Sed posuere orci neque, ut vestibulum elit gravida at.', '1648029069_Pertemuan_Pertemuan Makanan 1.pdf'),
(82, 4, 22, 'dokumen', 'Machine Learning for Lyfe', '1648021501_Machine_Learning_for_Lyfe.pdf'),
(83, 4, 22, 'link', 'anjay(linkDelimiter)VB6SIKl8Md0', ''),
(84, 4, 22, 'feedback', 'dicoba dulu hayok', ''),
(85, 4, 22, 'assignment', 'Belajar membuat menu(assignmentDelimiter)buatlah sebuah menu ke anjayan', '1643653455.pdf'),
(86, 4, 23, 'dokumen', 'Machine Learning for Lyfe', '1648021501_Machine_Learning_for_Lyfe.pdf'),
(87, 4, 23, 'link', 'anjay(linkDelimiter)VB6SIKl8Md0', ''),
(88, 4, 23, 'feedback', 'anjay', ''),
(89, 4, 23, 'assignment', 'Belajar menarik pelanggan(assignmentDelimiter)disini kita akan mempelajari menarik hati pelanggan', '1643653533.pdf'),
(95, 5, 32, 'assignment', 'anjay(assignmentDelimiter)asd', '1645293834.pdf'),
(96, 4, 31, 'link', 'anjay(linkDelimiter)VB6SIKl8Md0', ''),
(105, 3, 28, 'link', 'Tolong di tonton(linkDelimiter)VB6SIKl8Md0', ''),
(106, 3, 7, 'link', 'Materi Belajar Dirumah(linkDelimiter)7JmprpRIsEY', ''),
(110, 3, 7, 'link', 'link 2(linkDelimiter)VB6SIKl8Md0', ''),
(113, 5, 32, 'link', 'AW(linkDelimiter)VB6SIKl8Md0', '');

-- --------------------------------------------------------

--
-- Table structure for table `enroll_kelas_coaching`
--

CREATE TABLE `enroll_kelas_coaching` (
  `id_enroll_kelas_coaching` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_tenant` int(11) NOT NULL,
  `progress` int(11) NOT NULL,
  `tanggal_selesai` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enroll_kelas_coaching`
--

INSERT INTO `enroll_kelas_coaching` (`id_enroll_kelas_coaching`, `id_kelas`, `id_tenant`, `progress`, `tanggal_selesai`, `status`) VALUES
(1, 3, 25, 41, '', 0),
(2, 4, 25, 37, '', 0),
(6, 3, 27, 0, '', 0),
(7, 5, 25, 0, '', 0),
(8, 3, 29, 41, '', 0),
(9, 5, 29, 0, '', 0),
(10, 3, 28, 0, '', 0),
(11, 5, 28, 0, '', 0),
(12, 4, 28, 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `enroll_kelas_mentoring`
--

CREATE TABLE `enroll_kelas_mentoring` (
  `id_enroll_kelas_mentoring` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_tenant` int(11) NOT NULL,
  `progress` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `enroll_kelas_training`
--

CREATE TABLE `enroll_kelas_training` (
  `id_enroll_kelas_training` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_tenant` int(11) NOT NULL,
  `progress` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enroll_kelas_training`
--

INSERT INTO `enroll_kelas_training` (`id_enroll_kelas_training`, `id_kelas`, `id_tenant`, `progress`) VALUES
(2, 3, 25, 100),
(3, 3, 27, 100),
(4, 4, 28, 100),
(5, 3, 29, 66),
(6, 4, 33, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jawaban`
--

CREATE TABLE `jawaban` (
  `id_jawaban` int(11) NOT NULL,
  `id_progress_kelas` int(11) NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `dokumen` varchar(255) NOT NULL,
  `nilai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jawaban`
--

INSERT INTO `jawaban` (`id_jawaban`, `id_progress_kelas`, `jenis`, `deskripsi`, `dokumen`, `nilai`) VALUES
(8, 48, 'assignment', 'aaaaaaaaaa', '1643024040.pdf', '50'),
(9, 49, 'assignment', 'anjay', '', '70'),
(11, 36, 'assignment', 'anjyaaaa', '', '80'),
(12, 40, 'assignment', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '', '60'),
(13, 62, 'assignment', 'anjay', '1643654168.pdf', '80'),
(14, 106, 'assignment', 'anjay', '1643886387.pdf', '70'),
(15, 14, 'assignment', 'a', '1644437501.pdf', '50');

-- --------------------------------------------------------

--
-- Table structure for table `kelas_coaching`
--

CREATE TABLE `kelas_coaching` (
  `id_kelas_coaching` int(11) NOT NULL,
  `nama_kelas` varchar(255) NOT NULL,
  `enroll_key` varchar(255) NOT NULL,
  `coach` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas_coaching`
--

INSERT INTO `kelas_coaching` (`id_kelas_coaching`, `nama_kelas`, `enroll_key`, `coach`) VALUES
(3, 'Coaching Awal', 'COA01', 7),
(4, 'Coaching Kedua', 'COA02', 8),
(5, 'Coaching Awal Maritim', 'CAM01', 8);

-- --------------------------------------------------------

--
-- Table structure for table `kelas_mentoring`
--

CREATE TABLE `kelas_mentoring` (
  `id_kelas_mentoring` int(11) NOT NULL,
  `nama_kelas` varchar(255) NOT NULL,
  `enroll_key` varchar(255) NOT NULL,
  `mentor` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas_mentoring`
--

INSERT INTO `kelas_mentoring` (`id_kelas_mentoring`, `nama_kelas`, `enroll_key`, `mentor`) VALUES
(1, 'Mentoring Awal Makanan', 'MEM01', 'Surya Gudang');

-- --------------------------------------------------------

--
-- Table structure for table `kelas_training`
--

CREATE TABLE `kelas_training` (
  `id_kelas_training` int(11) NOT NULL,
  `nama_kelas` varchar(255) NOT NULL,
  `enroll_key` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas_training`
--

INSERT INTO `kelas_training` (`id_kelas_training`, `nama_kelas`, `enroll_key`) VALUES
(3, 'Training Makanan', 'MA001'),
(4, 'Training Snack', 'SN001'),
(5, 'Training Maritim', 'MR001'),
(6, 'Training Maritim 2', 'MR002'),
(7, 'Training Maritim 3', 'MR003'),
(8, 'Training Maritim 10', 'MR010');

-- --------------------------------------------------------

--
-- Table structure for table `monev`
--

CREATE TABLE `monev` (
  `id_monev` int(11) NOT NULL,
  `id_tenant` int(11) NOT NULL,
  `nilai_coach` varchar(10) NOT NULL,
  `nilai_inkubator` varchar(10) NOT NULL,
  `tanggal_dikirim` varchar(255) NOT NULL,
  `tanggal_penilaian` varchar(255) NOT NULL,
  `coach` varchar(255) NOT NULL,
  `action_file` varchar(255) NOT NULL,
  `pembukuan` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `monev`
--

INSERT INTO `monev` (`id_monev`, `id_tenant`, `nilai_coach`, `nilai_inkubator`, `tanggal_dikirim`, `tanggal_penilaian`, `coach`, `action_file`, `pembukuan`, `status`) VALUES
(5, 25, '27', '37', '2022-01-30', '2022-02-01', 'Asep Kuncoro', '1643552035_Action-Plan_Nanda_Ice.pdf', '1643552035_Pembukuan_Nanda_Ice.pdf', 2),
(9, 29, '20', '29', '2022-02-03', '2022-02-10', 'Wijaya Kusuma', '1643886675_Action-Plan_Genji_Onigiri.pdf', '1643886675_Pembukuan_Genji_Onigiri.pdf', 1),
(10, 27, '40', '29', '2022-02-03', '2022-02-10', 'Wijaya Kusuma', '1643889124_Action-Plan_Forgos_Eatry.pdf', '1643889124_Pembukuan_Forgos_Eatry.pdf', 2),
(12, 28, '30', '38', '2022-02-10', '2022-02-19', 'Wijaya Kusuma', '1644437598_Action-Plan_Forgos_Coklat.pdf', '1644437598_Pembukuan_Forgos_Coklat.pdf', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id_notifikasi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `pengirim` varchar(255) NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `link` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `waktu` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`id_notifikasi`, `id_user`, `pengirim`, `jenis`, `isi`, `link`, `file`, `waktu`, `status`) VALUES
(1, 6, 'System', 'pendaftaran-tenant', 'User yafi melakukan pendaftaran atas nama tenant Forgos Kroket. Diharap untuk segera melakukan konfirmasi penilaian pendaftaran.', '', '', '01:41:16 13-02-2022', 1),
(2, 6, 'System', 'pendaftaran-tenant', 'User yafi melakukan pendaftaran atas nama tenant Anjay Mouse. Diharap untuk segera melakukan konfirmasi penilaian pendaftaran.', '', '', '16:37:14 15-02-2022', 1),
(3, 9, 'System', 'pendaftaran-tenant', 'User yafi melakukan pendaftaran atas nama tenant Anjay Mouse. Diharap untuk segera melakukan konfirmasi penilaian pendaftaran.', '', '', '16:37:14 15-02-2022', 0),
(4, 14, 'System', 'penilaian-tenant1', 'Penilaian tahap pertama tenant dengan nama tenant Anjay Mouse sudah dilakukan. Silahkan segera melakukan penginputan data tahap ke-2 pada halaman ini. <a href=\'http://localhost/sit/user/uploadTahap2/33\'>Klik disini untuk melanjut kehalaman input data...</a>', '', '', '14:41:28 16-02-2022', 1),
(5, 6, 'System', 'pendaftaran-tenant2', 'User yafi telah menambahkan berkas tahap ke-2 atas nama tenant Anjay Mouse. Diharap untuk segera melakukan penilaian tahap ke-2.', '', '', '15:28:20 16-02-2022', 1),
(6, 9, 'System', 'pendaftaran-tenant2', 'User yafi telah menambahkan berkas tahap ke-2 atas nama tenant Anjay Mouse. Diharap untuk segera melakukan penilaian tahap ke-2.', '', '', '15:28:20 16-02-2022', 0),
(7, 14, 'System', 'penilaian-tenant2', 'Penilaian tahap kedua tenant dengan nama tenant Anjay Mouse sudah dilakukan. Silahkan segera melakukan penginputan data kontrak tenant pada halaman ini. <a href=\'http://localhost/sit/user/uploadKontrakTenant/33\'>Klik disini untuk melanjut kehalaman kontrak tenant...</a>', '', '', '15:32:29 16-02-2022', 1),
(8, 6, 'System', 'kontrak-tenant', 'User yafi melakukan upload kontrak atas nama tenant . Diharap untuk segera melakukan verifikasi terhadap kontrak tenant.', '', '', '15:36:26 16-02-2022', 1),
(9, 9, 'System', 'kontrak-tenant', 'User yafi melakukan upload kontrak atas nama tenant . Diharap untuk segera melakukan verifikasi terhadap kontrak tenant.', '', '', '15:36:26 16-02-2022', 0),
(10, 14, 'System', 'verifikasi-kontrak', 'Selamat! Kontrak dengan atas nama tenant Anjay Mouse sudah diverifikasi. Diharap untuk menunggu informasi selanjutnya dari Inkubator untuk enrollment key kelas Pra-Inkubasi pada halaman notifikasi.', '', '', '15:40:39 16-02-2022', 1),
(12, 14, 'Inkubator', 'enroll', 'Silahkan bergabung kedalam kelas Training Snack dengan memasukkan enroll key : SN001', '', '', '18:25:48 17-02-2022', 1),
(13, 14, 'Inkubator', 'enroll', 'Silahkan bergabung kedalam kelas Coaching Kedua dengan memasukkan enroll key : COA02', '', '', '11:28:00 18-02-2022', 1),
(14, 14, 'Inkubator', 'enroll', 'Untuk tenant Forgos Coklat, silahkan bergabung kedalam kelas Coaching Kedua dengan memasukkan enroll key : COA02', '', '', '11:29:53 18-02-2022', 1),
(15, 14, 'Inkubator', 'enroll', 'Untuk tenant Nanda Ice, silahkan bergabung kedalam kelas Inkubasi Coaching Kedua dengan memasukkan enroll key : COA02', '', '', '11:32:10 18-02-2022', 1),
(16, 14, 'Inkubator', 'enroll', 'Untuk tenant Anjay Mouse, silahkan bergabung kedalam kelas Pra-Inkubasi Training Makanan dengan memasukkan enroll key : MA001', '', '', '11:33:33 18-02-2022', 1),
(17, 14, 'admin tampan - Inkubator', 'umum', 'aaaaa', 'https://www.youtube.com/watch?v=Fht9dNC9RIE', 'contoh_dokumen.pdf', '19:19:36 18-02-2022', 1),
(21, 14, 'System', 'pertemuan-training', 'Inkubator telah menambahkan pertemuan baru pada kelas Training Makanan yang terdaftar terhadap tenant Nanda Ice. Silahkan melakukan pengecekan terhadap kelas baru yang telah dibuat.', '', '', '13:59:21 19-02-2022', 1),
(22, 5, 'System', 'pertemuan-training', 'Inkubator telah menambahkan pertemuan baru pada kelas Training Makanan yang terdaftar terhadap tenant Forgos Eatry. Silahkan melakukan pengecekan terhadap kelas baru yang telah dibuat.', '', '', '13:59:21 19-02-2022', 1),
(23, 17, 'System', 'pertemuan-training', 'Inkubator telah menambahkan pertemuan baru pada kelas Training Makanan yang terdaftar terhadap tenant Genji Onigiri. Silahkan melakukan pengecekan terhadap kelas baru yang telah dibuat.', '', '', '13:59:21 19-02-2022', 1),
(24, 14, 'admin tampan - Inkubator', 'pertemuan', 'Inkubator telah menambahkan pertemuan baru pada kelas Coaching Awal yang terdaftar terhadap tenant Nanda Ice. Silahkan melakukan pengecekan terhadap kelas baru yang telah dibuat.', '', '', '14:09:03 19-02-2022', 1),
(25, 5, 'admin tampan - Inkubator', 'pertemuan', 'Inkubator telah menambahkan pertemuan baru pada kelas Coaching Awal yang terdaftar terhadap tenant Forgos Eatry. Silahkan melakukan pengecekan terhadap kelas baru yang telah dibuat.', '', '', '14:09:03 19-02-2022', 1),
(26, 17, 'admin tampan - Inkubator', 'pertemuan', 'Inkubator telah menambahkan pertemuan baru pada kelas Coaching Awal yang terdaftar terhadap tenant Genji Onigiri. Silahkan melakukan pengecekan terhadap kelas baru yang telah dibuat.', '', '', '14:09:03 19-02-2022', 1),
(27, 14, 'admin tampan - Inkubator', 'pertemuan', 'Inkubator telah menambahkan pertemuan baru pada kelas Coaching Awal yang terdaftar terhadap tenant Forgos Coklat. Silahkan melakukan pengecekan terhadap kelas baru yang telah dibuat.', '', '', '14:09:03 19-02-2022', 1),
(28, 14, 'System', 'pertemuan', 'Inkubator telah menambahkan pertemuan baru pada kelas Training Snack yang terdaftar terhadap tenant Forgos Coklat. Silahkan melakukan pengecekan terhadap kelas baru yang telah dibuat.', '', '', '14:09:48 19-02-2022', 1),
(29, 14, 'System', 'assignment', 'Assignment baru telah ditambahkan pada kelas  yang terdaftar terhadap tenant Nanda Ice. Silahkan melakukan pengecekan di kelas yang telah diperbarui.', '', '', '15:05:14 19-02-2022', 1),
(30, 14, 'System', 'assignment', 'Assignment baru telah ditambahkan pada kelas  yang terdaftar terhadap tenant Nanda Ice. Silahkan melakukan pengecekan di kelas yang telah diperbarui.', '', '', '15:09:41 19-02-2022', 1),
(31, 5, 'System', 'assignment', 'Assignment baru telah ditambahkan pada kelas  yang terdaftar terhadap tenant Forgos Eatry. Silahkan melakukan pengecekan di kelas yang telah diperbarui.', '', '', '15:09:41 19-02-2022', 1),
(32, 17, 'System', 'assignment', 'Assignment baru telah ditambahkan pada kelas  yang terdaftar terhadap tenant Genji Onigiri. Silahkan melakukan pengecekan di kelas yang telah diperbarui.', '', '', '15:09:41 19-02-2022', 1),
(33, 14, 'admin tampan - Inkubator', 'assignment', 'Assignment baru telah ditambahkan pada kelas Coaching Awal yang terdaftar terhadap tenant Nanda Ice. Silahkan melakukan pengecekan di kelas yang telah diperbarui.', '', '', '15:20:27 19-02-2022', 1),
(34, 5, 'admin tampan - Inkubator', 'assignment', 'Assignment baru telah ditambahkan pada kelas Coaching Awal yang terdaftar terhadap tenant Forgos Eatry. Silahkan melakukan pengecekan di kelas yang telah diperbarui.', '', '', '15:20:27 19-02-2022', 1),
(35, 17, 'admin tampan - Inkubator', 'assignment', 'Assignment baru telah ditambahkan pada kelas Coaching Awal yang terdaftar terhadap tenant Genji Onigiri. Silahkan melakukan pengecekan di kelas yang telah diperbarui.', '', '', '15:20:27 19-02-2022', 1),
(36, 14, 'admin tampan - Inkubator', 'assignment', 'Assignment baru telah ditambahkan pada kelas Coaching Awal yang terdaftar terhadap tenant Forgos Coklat. Silahkan melakukan pengecekan di kelas yang telah diperbarui.', '', '', '15:20:27 19-02-2022', 1),
(37, 14, 'System', 'monev', 'Form upload monev untuk tenant Nanda Ice telah dibuka dari tanggal 2022-02-19 sampai dengan tanggal 2022-02-22. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '17:14:05 19-02-2022', 1),
(38, 14, 'System', 'monev', 'Form upload monev untuk tenant Forgos Coklat telah dibuka dari tanggal 2022-02-19 sampai dengan tanggal 2022-02-22. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '17:14:05 19-02-2022', 1),
(39, 17, 'System', 'monev', 'Form upload monev untuk tenant Genji Onigiri telah dibuka dari tanggal 2022-02-19 sampai dengan tanggal 2022-02-22. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '17:14:05 19-02-2022', 1),
(40, 14, 'System', 'monev', 'Form upload monev untuk tenant Nanda Ice telah dibuka dari tanggal 2022-02-19 sampai dengan tanggal 2022-02-22. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '11:14:11 19-02-2022', 1),
(41, 14, 'System', 'monev', 'Form upload monev untuk tenant Forgos Coklat telah dibuka dari tanggal 2022-02-19 sampai dengan tanggal 2022-02-22. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '11:14:11 19-02-2022', 1),
(42, 17, 'System', 'monev', 'Form upload monev untuk tenant Genji Onigiri telah dibuka dari tanggal 2022-02-19 sampai dengan tanggal 2022-02-22. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '11:14:11 19-02-2022', 1),
(43, 14, 'System', 'monev', 'Form upload monev untuk tenant Nanda Ice telah dibuka dari tanggal 2022-02-19 sampai dengan tanggal 2022-02-22. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '11:14:13 19-02-2022', 1),
(44, 14, 'System', 'monev', 'Form upload monev untuk tenant Forgos Coklat telah dibuka dari tanggal 2022-02-19 sampai dengan tanggal 2022-02-22. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '11:14:13 19-02-2022', 1),
(45, 17, 'System', 'monev', 'Form upload monev untuk tenant Genji Onigiri telah dibuka dari tanggal 2022-02-19 sampai dengan tanggal 2022-02-22. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '11:14:13 19-02-2022', 1),
(46, 14, 'System', 'monev', 'Form upload monev untuk tenant Nanda Ice telah dibuka dari tanggal 2022-02-19 sampai dengan tanggal 2022-02-22. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '11:14:29 19-02-2022', 1),
(47, 14, 'System', 'monev', 'Form upload monev untuk tenant Forgos Coklat telah dibuka dari tanggal 2022-02-19 sampai dengan tanggal 2022-02-22. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '11:14:29 19-02-2022', 1),
(48, 17, 'System', 'monev', 'Form upload monev untuk tenant Genji Onigiri telah dibuka dari tanggal 2022-02-19 sampai dengan tanggal 2022-02-22. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '11:14:29 19-02-2022', 1),
(49, 14, 'System', 'monev', 'Form upload monev untuk tenant Nanda Ice telah dibuka dari tanggal 2022-02-19 sampai dengan tanggal 2022-02-22. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '11:14:32 19-02-2022', 1),
(50, 14, 'System', 'monev', 'Form upload monev untuk tenant Forgos Coklat telah dibuka dari tanggal 2022-02-19 sampai dengan tanggal 2022-02-22. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '11:14:32 19-02-2022', 1),
(51, 17, 'System', 'monev', 'Form upload monev untuk tenant Genji Onigiri telah dibuka dari tanggal 2022-02-19 sampai dengan tanggal 2022-02-22. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '11:14:32 19-02-2022', 1),
(52, 14, 'System', 'monev', 'Form upload monev untuk tenant Nanda Ice telah dibuka dari tanggal 2022-02-19 sampai dengan tanggal 2022-02-22. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '11:15:11 19-02-2022', 1),
(53, 14, 'System', 'monev', 'Form upload monev untuk tenant Forgos Coklat telah dibuka dari tanggal 2022-02-19 sampai dengan tanggal 2022-02-22. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '11:15:11 19-02-2022', 1),
(54, 17, 'System', 'monev', 'Form upload monev untuk tenant Genji Onigiri telah dibuka dari tanggal 2022-02-19 sampai dengan tanggal 2022-02-22. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '11:15:11 19-02-2022', 1),
(55, 14, 'System', 'monev', 'Form upload monev untuk tenant Nanda Ice telah dibuka dari tanggal 2022-02-19 sampai dengan tanggal 2022-02-22. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '11:15:12 19-02-2022', 1),
(56, 14, 'System', 'monev', 'Form upload monev untuk tenant Forgos Coklat telah dibuka dari tanggal 2022-02-19 sampai dengan tanggal 2022-02-22. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '11:15:12 19-02-2022', 1),
(57, 17, 'System', 'monev', 'Form upload monev untuk tenant Genji Onigiri telah dibuka dari tanggal 2022-02-19 sampai dengan tanggal 2022-02-22. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '11:15:12 19-02-2022', 1),
(58, 14, 'System', 'monev', 'Form upload monev untuk tenant Nanda Ice telah dibuka dari tanggal 2022-02-19 sampai dengan tanggal 2022-02-22. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '11:15:13 19-02-2022', 1),
(59, 14, 'System', 'monev', 'Form upload monev untuk tenant Forgos Coklat telah dibuka dari tanggal 2022-02-19 sampai dengan tanggal 2022-02-22. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '11:15:13 19-02-2022', 1),
(60, 17, 'System', 'monev', 'Form upload monev untuk tenant Genji Onigiri telah dibuka dari tanggal 2022-02-19 sampai dengan tanggal 2022-02-22. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '11:15:13 19-02-2022', 1),
(61, 14, 'System', 'monev', 'Form upload monev untuk tenant Nanda Ice telah dibuka dari tanggal 2022-02-19 sampai dengan tanggal 2022-02-22. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '17:15:31 19-02-2022', 1),
(62, 14, 'System', 'monev', 'Form upload monev untuk tenant Forgos Coklat telah dibuka dari tanggal 2022-02-19 sampai dengan tanggal 2022-02-22. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '17:15:31 19-02-2022', 1),
(63, 17, 'System', 'monev', 'Form upload monev untuk tenant Genji Onigiri telah dibuka dari tanggal 2022-02-19 sampai dengan tanggal 2022-02-22. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '17:15:31 19-02-2022', 1),
(64, 14, 'System', 'monev', 'Form upload monev untuk tenant Nanda Ice telah dibuka dari tanggal 2022-02-19 sampai dengan tanggal 2022-02-22. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '11:15:35 19-02-2022', 1),
(65, 14, 'System', 'monev', 'Form upload monev untuk tenant Forgos Coklat telah dibuka dari tanggal 2022-02-19 sampai dengan tanggal 2022-02-22. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '11:15:35 19-02-2022', 1),
(66, 17, 'System', 'monev', 'Form upload monev untuk tenant Genji Onigiri telah dibuka dari tanggal 2022-02-19 sampai dengan tanggal 2022-02-22. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '11:15:35 19-02-2022', 1),
(67, 14, 'System', 'monev', 'Form upload monev untuk tenant Nanda Ice telah dibuka dari tanggal 2022-02-19 sampai dengan tanggal 2022-02-22. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '17:17:03 19-02-2022', 1),
(68, 14, 'System', 'monev', 'Form upload monev untuk tenant Forgos Coklat telah dibuka dari tanggal 2022-02-19 sampai dengan tanggal 2022-02-22. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '17:17:03 19-02-2022', 1),
(69, 17, 'System', 'monev', 'Form upload monev untuk tenant Genji Onigiri telah dibuka dari tanggal 2022-02-19 sampai dengan tanggal 2022-02-22. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '17:17:03 19-02-2022', 1),
(70, 14, 'System', 'monev', 'Form upload monev untuk tenant Nanda Ice telah dibuka dari tanggal 2022-02-19 sampai dengan tanggal 2022-02-21. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '17:18:31 19-02-2022', 1),
(71, 14, 'System', 'monev', 'Form upload monev untuk tenant Forgos Coklat telah dibuka dari tanggal 2022-02-19 sampai dengan tanggal 2022-02-21. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '17:18:31 19-02-2022', 1),
(72, 17, 'System', 'monev', 'Form upload monev untuk tenant Genji Onigiri telah dibuka dari tanggal 2022-02-19 sampai dengan tanggal 2022-02-21. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '17:18:31 19-02-2022', 0),
(73, 14, 'System', 'monev', 'Monev dengan nama tenant Forgos Coklat telah selesai dinilai. Hasil dari penilaian dapat dilihat di halaman detail monev.', '', '', '19:05:04 19-02-2022', 1),
(74, 6, 'System', 'enroll-in', 'User System melakukan enroll atas nama tenant 33 kedalam kelas Training Snack.', '', '', '00:59:55 20-02-2022', 1),
(75, 9, 'System', 'enroll-in', 'User System melakukan enroll atas nama tenant 33 kedalam kelas Training Snack.', '', '', '00:59:55 20-02-2022', 0),
(76, 14, 'Asep Kuncoro - Coach', 'pertemuan', 'Pertemuan baru telah ditambahkan pada kelas Coaching Awal Makanan yang terdaftar terhadap tenant Nanda Ice. Silahkan melakukan pengecekan di kelas yang telah diperbarui.', '', '', '01:03:41 20-02-2022', 1),
(77, 17, 'Asep Kuncoro - Coach', 'pertemuan', 'Pertemuan baru telah ditambahkan pada kelas Coaching Awal Makanan yang terdaftar terhadap tenant Genji Onigiri. Silahkan melakukan pengecekan di kelas yang telah diperbarui.', '', '', '01:03:41 20-02-2022', 0),
(78, 14, 'Asep Kuncoro - Coach', 'assignment', 'Assignment baru telah ditambahkan pada kelas Coaching Awal Makanan yang terdaftar terhadap tenant Nanda Ice. Silahkan melakukan pengecekan di kelas yang telah diperbarui.', '', '', '01:03:53 20-02-2022', 1),
(79, 17, 'Asep Kuncoro - Coach', 'assignment', 'Assignment baru telah ditambahkan pada kelas Coaching Awal Makanan yang terdaftar terhadap tenant Genji Onigiri. Silahkan melakukan pengecekan di kelas yang telah diperbarui.', '', '', '01:03:53 20-02-2022', 0),
(80, 8, 'System', 'enroll-in', 'User yafi melakukan enroll atas nama tenant Forgos Coklat kedalam kelas Coaching Kedua.', '', '', '01:12:27 20-02-2022', 1),
(81, 17, 'System', 'monev', 'Form upload monev untuk tenant Genji Onigiri telah dibuka dari tanggal 2022-02-19 sampai dengan tanggal 2022-02-21. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '19:13:39 19-02-2022', 0),
(82, 6, 'System', 'enroll-in', 'User genji melakukan enroll atas nama tenant Genji Sushi kedalam kelas Training Snack.', '', '', '01:38:01 20-02-2022', 1),
(83, 9, 'System', 'enroll-in', 'User genji melakukan enroll atas nama tenant Genji Sushi kedalam kelas Training Snack.', '', '', '01:38:01 20-02-2022', 0),
(84, 14, 'System', 'monev', 'Form upload monev untuk tenant Forgos Coklat telah dibuka dari tanggal 2022-02-19 sampai dengan tanggal 2022-02-21. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '19:46:11 19-02-2022', 1),
(85, 6, 'System', 'pendaftaran-tenant', 'User yafi melakukan pendaftaran atas nama tenant Anjay Uduk. Diharap untuk segera melakukan penilaian tahap ke-1.', '', '', '10:07:12 20-02-2022', 1),
(86, 9, 'System', 'pendaftaran-tenant', 'User yafi melakukan pendaftaran atas nama tenant Anjay Uduk. Diharap untuk segera melakukan penilaian tahap ke-1.', '', '', '10:07:12 20-02-2022', 0),
(87, 5, 'System', 'penilaian-tenant1', 'Penilaian tahap pertama tenant dengan nama tenant Anjay Uduk sudah dilakukan. Silahkan segera melakukan penginputan data tahap ke-2 pada halaman ini. <a href=\'http://localhost/sit/user/uploadTahap2/34\'>Klik disini untuk melanjut kehalaman input data...</a>', '', '', '18:51:29 20-02-2022', 1),
(88, 6, 'System', 'pendaftaran-tenant2', 'User yafi telah menambahkan berkas tahap ke-2 atas nama tenant Anjay Uduk. Diharap untuk segera melakukan penilaian tahap ke-2.', '', '', '18:52:29 20-02-2022', 1),
(89, 9, 'System', 'pendaftaran-tenant2', 'User yafi telah menambahkan berkas tahap ke-2 atas nama tenant Anjay Uduk. Diharap untuk segera melakukan penilaian tahap ke-2.', '', '', '18:52:29 20-02-2022', 0),
(90, 14, 'System', 'monev', 'Form upload monev untuk tenant Nanda Ice telah dibuka dari tanggal 2022-02-21 sampai dengan tanggal 2022-02-24. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '10:18:25 21-02-2022', 1),
(91, 14, 'System', 'monev', 'Form upload monev untuk tenant Forgos Coklat telah dibuka dari tanggal 2022-02-21 sampai dengan tanggal 2022-02-24. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '10:18:25 21-02-2022', 1),
(92, 14, 'System', 'monev', 'Form upload monev untuk tenant Nanda Ice telah dibuka dari tanggal 2022-03-10 sampai dengan tanggal 2022-03-11. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '00:52:57 10-03-2022', 1),
(93, 5, 'System', 'monev', 'Form upload monev untuk tenant Forgos Eatry telah dibuka dari tanggal 2022-03-10 sampai dengan tanggal 2022-03-11. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '00:52:57 10-03-2022', 1),
(94, 14, 'System', 'monev', 'Form upload monev untuk tenant Forgos Coklat telah dibuka dari tanggal 2022-03-10 sampai dengan tanggal 2022-03-11. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '00:52:57 10-03-2022', 1),
(95, 14, 'System', 'monev', 'Form upload monev untuk tenant Nanda Ice telah dibuka dari tanggal 2022-03-10 sampai dengan tanggal 2022-03-11. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '00:53:31 10-03-2022', 1),
(96, 5, 'System', 'monev', 'Form upload monev untuk tenant Forgos Eatry telah dibuka dari tanggal 2022-03-10 sampai dengan tanggal 2022-03-11. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '00:53:31 10-03-2022', 1),
(97, 14, 'System', 'monev', 'Form upload monev untuk tenant Forgos Coklat telah dibuka dari tanggal 2022-03-10 sampai dengan tanggal 2022-03-11. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '00:53:31 10-03-2022', 1),
(98, 14, 'System', 'monev', 'Form upload monev untuk tenant Nanda Ice telah dibuka dari tanggal 2022-03-10 sampai dengan tanggal 2022-03-11. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '01:01:17 10-03-2022', 1),
(99, 5, 'System', 'monev', 'Form upload monev untuk tenant Forgos Eatry telah dibuka dari tanggal 2022-03-10 sampai dengan tanggal 2022-03-11. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '01:01:17 10-03-2022', 1),
(100, 14, 'System', 'monev', 'Form upload monev untuk tenant Forgos Coklat telah dibuka dari tanggal 2022-03-10 sampai dengan tanggal 2022-03-11. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '01:01:17 10-03-2022', 1),
(101, 6, 'System', 'pendaftaran-tenant', 'User yafi melakukan pendaftaran atas nama tenant Nanda Ikan. Diharap untuk segera melakukan penilaian tahap ke-1.', '', '', '04:21:59 21-03-2022', 1),
(102, 9, 'System', 'pendaftaran-tenant', 'User yafi melakukan pendaftaran atas nama tenant Nanda Ikan. Diharap untuk segera melakukan penilaian tahap ke-1.', '', '', '04:21:59 21-03-2022', 0),
(103, 14, 'admin tampan - Inkubator', 'assignment', 'Assignment baru telah ditambahkan pada kelas Coaching Awal yang terdaftar terhadap tenant Nanda Ice. Silahkan melakukan pengecekan di kelas yang telah diperbarui.', '', '', '15:54:00 24-03-2022', 1),
(104, 5, 'admin tampan - Inkubator', 'assignment', 'Assignment baru telah ditambahkan pada kelas Coaching Awal yang terdaftar terhadap tenant Forgos Eatry. Silahkan melakukan pengecekan di kelas yang telah diperbarui.', '', '', '15:54:00 24-03-2022', 1),
(105, 17, 'admin tampan - Inkubator', 'assignment', 'Assignment baru telah ditambahkan pada kelas Coaching Awal yang terdaftar terhadap tenant Genji Onigiri. Silahkan melakukan pengecekan di kelas yang telah diperbarui.', '', '', '15:54:00 24-03-2022', 0),
(106, 14, 'admin tampan - Inkubator', 'assignment', 'Assignment baru telah ditambahkan pada kelas Coaching Awal yang terdaftar terhadap tenant Forgos Coklat. Silahkan melakukan pengecekan di kelas yang telah diperbarui.', '', '', '15:54:00 24-03-2022', 1),
(107, 5, 'System', 'penilaian-tenant2', 'Penilaian tahap pertama tenant dengan nama tenant Anjay Uduk sudah dilakukan. Mohon maaf, tenant anda dinyatakan tidak lulus tahap ke-1', '', '', '19:29:51 26-03-2022', 1),
(108, 6, 'System', 'pendaftaran-tenant', 'User yafi melakukan pendaftaran atas nama tenant Anjay tes. Diharap untuk segera melakukan penilaian tahap ke-1.', '', '', '19:57:53 26-03-2022', 1),
(109, 9, 'System', 'pendaftaran-tenant', 'User yafi melakukan pendaftaran atas nama tenant Anjay tes. Diharap untuk segera melakukan penilaian tahap ke-1.', '', '', '19:57:53 26-03-2022', 0),
(110, 6, 'System', 'pendaftaran-tenant', 'User yafi melakukan pendaftaran atas nama tenant Anjay tes 2. Diharap untuk segera melakukan penilaian tahap ke-1.', '', '', '19:59:06 26-03-2022', 1),
(111, 9, 'System', 'pendaftaran-tenant', 'User yafi melakukan pendaftaran atas nama tenant Anjay tes 2. Diharap untuk segera melakukan penilaian tahap ke-1.', '', '', '19:59:06 26-03-2022', 0),
(112, 5, 'System', 'penilaian-tenant1', 'Penilaian tahap pertama tenant dengan nama tenant Anjay tes sudah dilakukan. Silahkan segera melakukan penginputan data tahap ke-2 pada halaman ini. <a href=\'http://localhost/sit/user/uploadTahap2/36\'>Klik disini untuk melanjut kehalaman input data...</a>', '', '', '19:59:28 26-03-2022', 1),
(113, 5, 'System', 'penilaian-tenant1', 'Penilaian tahap pertama tenant dengan nama tenant Anjay tes 2 sudah dilakukan. Mohon maaf, tenant anda dinyatakan tidak lulus tahap ke-1', '', '', '19:59:39 26-03-2022', 1),
(114, 6, 'System', 'pendaftaran-tenant2', 'User yafi telah menambahkan berkas tahap ke-2 atas nama tenant Anjay tes. Diharap untuk segera melakukan penilaian tahap ke-2.', '', '', '20:00:46 26-03-2022', 1),
(115, 9, 'System', 'pendaftaran-tenant2', 'User yafi telah menambahkan berkas tahap ke-2 atas nama tenant Anjay tes. Diharap untuk segera melakukan penilaian tahap ke-2.', '', '', '20:00:46 26-03-2022', 0),
(116, 14, 'System', 'monev', 'Form upload monev untuk tenant Nanda Ice telah dibuka dari tanggal 2022-03-27 sampai dengan tanggal 2022-03-28. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '17:36:30 27-03-2022', 1),
(117, 5, 'System', 'monev', 'Form upload monev untuk tenant Forgos Eatry telah dibuka dari tanggal 2022-03-27 sampai dengan tanggal 2022-03-28. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '17:36:30 27-03-2022', 0),
(118, 14, 'System', 'monev', 'Form upload monev untuk tenant Forgos Coklat telah dibuka dari tanggal 2022-03-27 sampai dengan tanggal 2022-03-28. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.', '', '', '17:36:30 27-03-2022', 1),
(119, 5, 'System', 'penilaian-tenant2', 'Penilaian tahap kedua tenant dengan nama tenant Anjay tes sudah dilakukan. Silahkan segera melakukan penginputan data kontrak tenant pada halaman ini. <a href=\'http://localhost/sit/user/uploadKontrakTenant/36\'>Klik disini untuk melanjut kehalaman kontrak tenant...</a>', '', '', '10:50:05 29-03-2022', 0),
(120, 6, 'System', 'kontrak-tenant', 'User yafi melakukan upload kontrak atas nama tenant . Diharap untuk segera melakukan verifikasi terhadap kontrak tenant.', '', '', '10:50:41 29-03-2022', 1),
(121, 9, 'System', 'kontrak-tenant', 'User yafi melakukan upload kontrak atas nama tenant . Diharap untuk segera melakukan verifikasi terhadap kontrak tenant.', '', '', '10:50:41 29-03-2022', 0),
(122, 5, 'System', 'verifikasi-kontrak', 'Selamat! Kontrak dengan atas nama tenant Anjay tes sudah diverifikasi. Diharap untuk menunggu informasi selanjutnya dari Inkubator untuk enrollment key kelas Pra-Inkubasi pada halaman notifikasi.', '', '', '10:50:50 29-03-2022', 0),
(123, 14, 'admin tampan - Inkubator', 'umum', 'aaaaaaaaa', '', '', '16:09:05 30-03-2022', 1),
(124, 5, 'admin tampan - Inkubator', 'umum', 'aaaaaaaaaaa', '', '', '16:30:04 30-03-2022', 0),
(125, 6, '14', 'kontak-admin', 'anjay', '', '', '20:37:53 07-04-2022', 1),
(126, 9, '14', 'kontak-admin', 'anjay', '', '', '20:37:53 07-04-2022', 0),
(127, 14, 'Inkubator', 'kontak-user', 'anjay juga mase', '', '', '20:58:51 07-04-2022', 1),
(128, 14, 'Inkubator', 'kontak-user', 'anjay lagi dah', '', '', '20:59:24 07-04-2022', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id_pengumuman` int(11) NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `judul` text NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id_pengumuman`, `tanggal`, `judul`, `deskripsi`) VALUES
(18, '30 March 2022', 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer aliquam tristique quam. Vestibulum bibendum commodo mi quis condimentum. In malesuada mauris at arcu venenatis lacinia a sed libero. Fusce ullamcorper malesuada justo non aliquet. Fusce iaculis egestas tempor. Sed et lectus nibh. Vestibulum pellentesque magna eget elit varius, at fringilla magna volutpat. Vestibulum felis sem, fringilla in tortor sit amet, commodo dapibus ligula. Quisque lacinia nisi eu odio tristique, quis fringilla nisi posuere. Integer id augue at tortor facilisis finibus. Mauris vitae ante ac nulla semper interdum at ut odio. Vivamus in ligula commodo mauris tempor dictum non quis erat. Cras porta, sapien et condimentum gravida, nibh nisi egestas odio, vel scelerisque nunc nisi a sem. Morbi diam tortor, semper sit amet nibh in, blandit congue urna. Mauris molestie euismod purus sit amet porta. Curabitur egestas tincidunt augue sit amet pharetra.\r\n\r\nDuis tempor libero ut ex cursus, ac facilisis nulla ullamcorper. Nam interdum ipsum ac ipsum bibendum ullamcorper. Vestibulum in laoreet erat. Quisque tincidunt sapien ut tempus aliquet. Donec quis finibus diam. Aliquam vel nisi in ex sagittis molestie et non risus. Cras posuere nunc id nunc scelerisque aliquam at nec nulla. Suspendisse nunc lectus, scelerisque vel urna a, varius suscipit nibh. Mauris vitae nisl a lacus dapibus blandit non id augue. Sed fringilla tincidunt eros. Curabitur fermentum tellus id mattis blandit. Aenean eu viverra augue. Maecenas luctus euismod fringilla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Phasellus hendrerit accumsan porta. Phasellus magna quam, molestie id quam in, congue cursus leo.\r\n\r\nVivamus sit amet dolor pulvinar odio malesuada eleifend id feugiat felis. Praesent et tortor est. Vestibulum euismod turpis libero, quis auctor lorem malesuada sed. Phasellus volutpat mollis enim, sed elementum massa lacinia eu. Vivamus sagittis nisl nisl. Sed luctus gravida mi, a mattis justo venenatis eu. Integer tincidunt, quam eget placerat porttitor, ipsum nunc egestas felis, et malesuada enim libero vitae ligula. In ornare placerat dolor in laoreet. Proin nec semper risus. Nulla facilisi.'),
(24, '30 March 2022', 'Lorem Ipsum 6', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer aliquam tristique quam. Vestibulum bibendum commodo mi quis condimentum. In malesuada mauris at arcu venenatis lacinia a sed libero. Fusce ullamcorper malesuada justo non aliquet. Fusce iaculis egestas tempor. Sed et lectus nibh. Vestibulum pellentesque magna eget elit varius, at fringilla magna volutpat. Vestibulum felis sem, fringilla in tortor sit amet, commodo dapibus ligula. Quisque lacinia nisi eu odio tristique, quis fringilla nisi posuere. Integer id augue at tortor facilisis finibus. Mauris vitae ante ac nulla semper interdum at ut odio. Vivamus in ligula commodo mauris tempor dictum non quis erat. Cras porta, sapien et condimentum gravida, nibh nisi egestas odio, vel scelerisque nunc nisi a sem. Morbi diam tortor, semper sit amet nibh in, blandit congue urna. Mauris molestie euismod purus sit amet porta. Curabitur egestas tincidunt augue sit amet pharetra.\r\n\r\nDuis tempor libero ut ex cursus, ac facilisis nulla ullamcorper. Nam interdum ipsum ac ipsum bibendum ullamcorper. Vestibulum in laoreet erat. Quisque tincidunt sapien ut tempus aliquet. Donec quis finibus diam. Aliquam vel nisi in ex sagittis molestie et non risus. Cras posuere nunc id nunc scelerisque aliquam at nec nulla. Suspendisse nunc lectus, scelerisque vel urna a, varius suscipit nibh. Mauris vitae nisl a lacus dapibus blandit non id augue. Sed fringilla tincidunt eros. Curabitur fermentum tellus id mattis blandit. Aenean eu viverra augue. Maecenas luctus euismod fringilla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Phasellus hendrerit accumsan porta. Phasellus magna quam, molestie id quam in, congue cursus leo.\r\n\r\nVivamus sit amet dolor pulvinar odio malesuada eleifend id feugiat felis. Praesent et tortor est. Vestibulum euismod turpis libero, quis auctor lorem malesuada sed. Phasellus volutpat mollis enim, sed elementum massa lacinia eu. Vivamus sagittis nisl nisl. Sed luctus gravida mi, a mattis justo venenatis eu. Integer tincidunt, quam eget placerat porttitor, ipsum nunc egestas felis, et malesuada enim libero vitae ligula. In ornare placerat dolor in laoreet. Proin nec semper risus. Nulla facilisi.'),
(26, '30 March 2022', 'Lorem Ipsum 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer aliquam tristique quam. Vestibulum bibendum commodo mi quis condimentum. In malesuada mauris at arcu venenatis lacinia a sed libero. Fusce ullamcorper malesuada justo non aliquet. Fusce iaculis egestas tempor. Sed et lectus nibh. Vestibulum pellentesque magna eget elit varius, at fringilla magna volutpat. Vestibulum felis sem, fringilla in tortor sit amet, commodo dapibus ligula. Quisque lacinia nisi eu odio tristique, quis fringilla nisi posuere. Integer id augue at tortor facilisis finibus. Mauris vitae ante ac nulla semper interdum at ut odio. Vivamus in ligula commodo mauris tempor dictum non quis erat. Cras porta, sapien et condimentum gravida, nibh nisi egestas odio, vel scelerisque nunc nisi a sem. Morbi diam tortor, semper sit amet nibh in, blandit congue urna. Mauris molestie euismod purus sit amet porta. Curabitur egestas tincidunt augue sit amet pharetra.\r\n\r\nDuis tempor libero ut ex cursus, ac facilisis nulla ullamcorper. Nam interdum ipsum ac ipsum bibendum ullamcorper. Vestibulum in laoreet erat. Quisque tincidunt sapien ut tempus aliquet. Donec quis finibus diam. Aliquam vel nisi in ex sagittis molestie et non risus. Cras posuere nunc id nunc scelerisque aliquam at nec nulla. Suspendisse nunc lectus, scelerisque vel urna a, varius suscipit nibh. Mauris vitae nisl a lacus dapibus blandit non id augue. Sed fringilla tincidunt eros. Curabitur fermentum tellus id mattis blandit. Aenean eu viverra augue. Maecenas luctus euismod fringilla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Phasellus hendrerit accumsan porta. Phasellus magna quam, molestie id quam in, congue cursus leo.\r\n\r\nVivamus sit amet dolor pulvinar odio malesuada eleifend id feugiat felis. Praesent et tortor est. Vestibulum euismod turpis libero, quis auctor lorem malesuada sed. Phasellus volutpat mollis enim, sed elementum massa lacinia eu. Vivamus sagittis nisl nisl. Sed luctus gravida mi, a mattis justo venenatis eu. Integer tincidunt, quam eget placerat porttitor, ipsum nunc egestas felis, et malesuada enim libero vitae ligula. In ornare placerat dolor in laoreet. Proin nec semper risus. Nulla facilisi.'),
(27, '30 March 2022', 'Lorem Ipsum 99', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer aliquam tristique quam. Vestibulum bibendum commodo mi quis condimentum. In malesuada mauris at arcu venenatis lacinia a sed libero. Fusce ullamcorper malesuada justo non aliquet. Fusce iaculis egestas tempor. Sed et lectus nibh. Vestibulum pellentesque magna eget elit varius, at fringilla magna volutpat. Vestibulum felis sem, fringilla in tortor sit amet, commodo dapibus ligula. Quisque lacinia nisi eu odio tristique, quis fringilla nisi posuere. Integer id augue at tortor facilisis finibus. Mauris vitae ante ac nulla semper interdum at ut odio. Vivamus in ligula commodo mauris tempor dictum non quis erat. Cras porta, sapien et condimentum gravida, nibh nisi egestas odio, vel scelerisque nunc nisi a sem. Morbi diam tortor, semper sit amet nibh in, blandit congue urna. Mauris molestie euismod purus sit amet porta. Curabitur egestas tincidunt augue sit amet pharetra.\r\n\r\nDuis tempor libero ut ex cursus, ac facilisis nulla ullamcorper. Nam interdum ipsum ac ipsum bibendum ullamcorper. Vestibulum in laoreet erat. Quisque tincidunt sapien ut tempus aliquet. Donec quis finibus diam. Aliquam vel nisi in ex sagittis molestie et non risus. Cras posuere nunc id nunc scelerisque aliquam at nec nulla. Suspendisse nunc lectus, scelerisque vel urna a, varius suscipit nibh. Mauris vitae nisl a lacus dapibus blandit non id augue. Sed fringilla tincidunt eros. Curabitur fermentum tellus id mattis blandit. Aenean eu viverra augue. Maecenas luctus euismod fringilla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Phasellus hendrerit accumsan porta. Phasellus magna quam, molestie id quam in, congue cursus leo.\r\n\r\nVivamus sit amet dolor pulvinar odio malesuada eleifend id feugiat felis. Praesent et tortor est. Vestibulum euismod turpis libero, quis auctor lorem malesuada sed. Phasellus volutpat mollis enim, sed elementum massa lacinia eu. Vivamus sagittis nisl nisl. Sed luctus gravida mi, a mattis justo venenatis eu. Integer tincidunt, quam eget placerat porttitor, ipsum nunc egestas felis, et malesuada enim libero vitae ligula. In ornare placerat dolor in laoreet. Proin nec semper risus. Nulla facilisi.'),
(28, '30 March 2022', 'Lorem Ipsum 10', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer aliquam tristique quam. Vestibulum bibendum commodo mi quis condimentum. In malesuada mauris at arcu venenatis lacinia a sed libero. Fusce ullamcorper malesuada justo non aliquet. Fusce iaculis egestas tempor. Sed et lectus nibh. Vestibulum pellentesque magna eget elit varius, at fringilla magna volutpat. Vestibulum felis sem, fringilla in tortor sit amet, commodo dapibus ligula. Quisque lacinia nisi eu odio tristique, quis fringilla nisi posuere. Integer id augue at tortor facilisis finibus. Mauris vitae ante ac nulla semper interdum at ut odio. Vivamus in ligula commodo mauris tempor dictum non quis erat. Cras porta, sapien et condimentum gravida, nibh nisi egestas odio, vel scelerisque nunc nisi a sem. Morbi diam tortor, semper sit amet nibh in, blandit congue urna. Mauris molestie euismod purus sit amet porta. Curabitur egestas tincidunt augue sit amet pharetra.\r\n\r\nDuis tempor libero ut ex cursus, ac facilisis nulla ullamcorper. Nam interdum ipsum ac ipsum bibendum ullamcorper. Vestibulum in laoreet erat. Quisque tincidunt sapien ut tempus aliquet. Donec quis finibus diam. Aliquam vel nisi in ex sagittis molestie et non risus. Cras posuere nunc id nunc scelerisque aliquam at nec nulla. Suspendisse nunc lectus, scelerisque vel urna a, varius suscipit nibh. Mauris vitae nisl a lacus dapibus blandit non id augue. Sed fringilla tincidunt eros. Curabitur fermentum tellus id mattis blandit. Aenean eu viverra augue. Maecenas luctus euismod fringilla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Phasellus hendrerit accumsan porta. Phasellus magna quam, molestie id quam in, congue cursus leo.\r\n\r\nVivamus sit amet dolor pulvinar odio malesuada eleifend id feugiat felis. Praesent et tortor est. Vestibulum euismod turpis libero, quis auctor lorem malesuada sed. Phasellus volutpat mollis enim, sed elementum massa lacinia eu. Vivamus sagittis nisl nisl. Sed luctus gravida mi, a mattis justo venenatis eu. Integer tincidunt, quam eget placerat porttitor, ipsum nunc egestas felis, et malesuada enim libero vitae ligula. In ornare placerat dolor in laoreet. Proin nec semper risus. Nulla facilisi.');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian1`
--

CREATE TABLE `penilaian1` (
  `id_penilaian1` int(11) NOT NULL,
  `id_tenant` int(11) NOT NULL,
  `nilai` text NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penilaian1`
--

INSERT INTO `penilaian1` (`id_penilaian1`, `id_tenant`, `nilai`, `total`) VALUES
(7, 25, 'Produk(delimiterPenilaian)2;Model Bisnis(delimiterPenilaian)3;Keuangan(delimiterPenilaian)4;Anjay(delimiterPenilaian)5;', 14),
(8, 27, 'Profil Bisnis(delimiterPenilaian)2;Profil Tim(delimiterPenilaian)2;Produk(delimiterPenilaian)3;Model Bisnis(delimiterPenilaian)4;Keuangan(delimiterPenilaian)5;', 16),
(9, 28, 'Profil Bisnis(delimiterPenilaian)1;Profil Tim(delimiterPenilaian)2;Produk(delimiterPenilaian)3;Model Bisnis(delimiterPenilaian)4;Keuangan(delimiterPenilaian)5;', 15),
(11, 29, 'Profil Bisnis(delimiterPenilaian)3;Profil Tim(delimiterPenilaian)3;Produk(delimiterPenilaian)3;Model Bisnis(delimiterPenilaian)3;Keuangan(delimiterPenilaian)3;Look(delimiterPenilaian)4;', 19),
(13, 33, 'Profil Bisnis(delimiterPenilaian)1;Profil Tim(delimiterPenilaian)2;Produk(delimiterPenilaian)3;Model Bisnis(delimiterPenilaian)4;Keuangan(delimiterPenilaian)5;', 15),
(16, 36, 'Profil Bisnis(delimiterPenilaian)4;Profil Tim(delimiterPenilaian)4;Produk(delimiterPenilaian)4;Model Bisnis(delimiterPenilaian)4;Keuangan(delimiterPenilaian)4;', 20),
(17, 37, 'Profil Bisnis(delimiterPenilaian)1;Profil Tim(delimiterPenilaian)1;Produk(delimiterPenilaian)1;Model Bisnis(delimiterPenilaian)1;Keuangan(delimiterPenilaian)1;', 5);

-- --------------------------------------------------------

--
-- Table structure for table `penilaian2`
--

CREATE TABLE `penilaian2` (
  `id_penilaian2` int(11) NOT NULL,
  `id_tenant` int(11) NOT NULL,
  `nilai` text NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penilaian2`
--

INSERT INTO `penilaian2` (`id_penilaian2`, `id_tenant`, `nilai`, `total`) VALUES
(4, 25, 'Tim(delimiterPenilaian)5;Inovasi Produk(delimiterPenilaian)4;Tampang(delimiterPenilaian)5;', 14),
(5, 27, 'Skala(delimiterPenilaian)1;Tim(delimiterPenilaian)2;Inovasi Produk(delimiterPenilaian)3;Model Bisnis(delimiterPenilaian)4;Keuangan(delimiterPenilaian)5;', 15),
(6, 28, 'Skala(delimiterPenilaian)1;Tim(delimiterPenilaian)2;Inovasi Produk(delimiterPenilaian)3;Model Bisnis(delimiterPenilaian)4;Keuangan(delimiterPenilaian)5;', 15),
(8, 33, 'Skala(delimiterPenilaian)1;Tim(delimiterPenilaian)2;Inovasi Produk(delimiterPenilaian)3;Model Bisnis(delimiterPenilaian)4;Keuangan(delimiterPenilaian)5;', 15),
(10, 36, 'Skala(delimiterPenilaian)3;Tim(delimiterPenilaian)3;Inovasi Produk(delimiterPenilaian)3;Model Bisnis(delimiterPenilaian)3;Keuangan(delimiterPenilaian)3;', 15);

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_monev`
--

CREATE TABLE `penilaian_monev` (
  `id_penilaian_monev` int(11) NOT NULL,
  `id_monev` int(11) NOT NULL,
  `penilaian_coach` text NOT NULL,
  `penilaian_inkubator` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penilaian_monev`
--

INSERT INTO `penilaian_monev` (`id_penilaian_monev`, `id_monev`, `penilaian_coach`, `penilaian_inkubator`) VALUES
(5, 5, 'Perkembangan Bisnis Model;2;coba lagi(delimiter)Perkembangan Produk;3;good(delimiter)Perkembangan / Kelengkapan SDM sebagai team;4;lumayan(delimiter)Aspek Legalitas (HKI, Badan Hukum, dll...);5;perfectos(delimiter)Marketing Plan yang sudah dikerjakan;1;try hard meh!(delimiter)Financial Plan;2;coba lagi(delimiter)Operation Plan;3;good(delimiter)Checklist Action Plan;4;lumayan(delimiter)Jumlah Sesi Coaching;2;coba lagi(delimiter)Kualitas Sesi Coaching;1;try hard meh!(delimiter)', 'Perkembangan Bisnis Model;2;tingkatkan(delimiter)Perkembangan Orang;3;bagus(delimiter)Perkembangan / Kelengkapan SDM sebagai team;4;lumayan(delimiter)Aspek Legalitas (HKI, Badan Hukum, dll...);5;perfect(delimiter)Marketing Plan yang sudah dikerjakan;2;tingkatkan(delimiter)Financial Plan;3;bagus(delimiter)Operation Plan;4;lumayan(delimiter)Checklist Action Plan;5;perfect(delimiter)Jumlah Sesi Coaching;4;lumayan(delimiter)Kualitas Sesi Coaching;5;perfect(delimiter)'),
(6, 9, 'Perkembangan Bisnis Model;2;jelek(delimiter)Perkembangan Produk;3;(delimiter)Perkembangan / Kelengkapan SDM sebagai team;4;(delimiter)Aspek Legalitas (HKI, Badan Hukum, dll...);5;(delimiter)Marketing Plan yang sudah dikerjakan;1;(delimiter)Financial Plan;1;(delimiter)Operation Plan;1;(delimiter)Checklist Action Plan;1;(delimiter)Jumlah Sesi Coaching;1;(delimiter)Kualitas Sesi Coaching;1;(delimiter)', 'Perkembangan Bisnis Model;3;tingkatkan lagi(delimiter)Perkembangan Produk;3;kembangin lagi(delimiter)Perkembangan / Kelengkapan SDM sebagai team;4;a(delimiter)Aspek Legalitas (HKI, Badan Hukum, dll...);5;b(delimiter)Marketing Plan yang sudah dikerjakan;1;c(delimiter)Financial Plan;1;d(delimiter)Operation Plan;2;e(delimiter)Checklist Action Plan;3;f(delimiter)Jumlah Sesi Coaching;4;g(delimiter)Kualitas Sesi Coaching;3;h(delimiter)'),
(7, 10, 'Perkembangan Bisnis Model;1;(delimiter)Perkembangan Produk;2;(delimiter)Perkembangan / Kelengkapan SDM sebagai team;3;(delimiter)Aspek Legalitas (HKI, Badan Hukum, dll...);4;(delimiter)Marketing Plan yang sudah dikerjakan;5;(delimiter)Financial Plan;5;(delimiter)Operation Plan;5;(delimiter)Checklist Action Plan;5;(delimiter)Jumlah Sesi Coaching;5;(delimiter)Kualitas Sesi Coaching;5;(delimiter)', 'Perkembangan Bisnis Model;2;(delimiter)Perkembangan Produk;2;(delimiter)Perkembangan / Kelengkapan SDM sebagai team;3;(delimiter)Aspek Legalitas (HKI, Badan Hukum, dll...);5;(delimiter)Marketing Plan yang sudah dikerjakan;2;(delimiter)Financial Plan;1;(delimiter)Operation Plan;1;(delimiter)Checklist Action Plan;3;(delimiter)Jumlah Sesi Coaching;5;(delimiter)Kualitas Sesi Coaching;5;(delimiter)'),
(11, 12, 'Perkembangan Bisnis Model;1;(delimiter)Perkembangan Produk;2;(delimiter)Perkembangan / Kelengkapan SDM sebagai team;4;(delimiter)Jumlah Sesi Coaching;5;(delimiter)', 'Perkembangan Bisnis Model;2;(delimiter)Perkembangan / Kelengkapan SDM sebagai team;3;(delimiter)Operation Plan;4;(delimiter)Checklist Action Plan;5;(delimiter)Jumlah Sesi Coaching;5;(delimiter)');

-- --------------------------------------------------------

--
-- Table structure for table `periode_monev`
--

CREATE TABLE `periode_monev` (
  `id_periode_monev` int(11) NOT NULL,
  `id_rekrutmen` int(11) NOT NULL,
  `awal` varchar(255) NOT NULL,
  `akhir` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `periode_monev`
--

INSERT INTO `periode_monev` (`id_periode_monev`, `id_rekrutmen`, `awal`, `akhir`, `status`) VALUES
(1, 2, '2022-02-05', '2022-02-05', 1),
(2, 3, '2022-02-07', '2022-02-09', 1),
(3, 2, '2022-02-08', '2022-02-10', 1),
(4, 2, '2022-02-13', '2022-02-14', 1),
(17, 2, '2022-02-21', '2022-02-24', 1),
(18, 2, '2022-03-10', '2022-03-11', 1),
(19, 2, '2022-03-27', '2022-03-28', 1),
(20, 3, '2022-04-06', '2022-04-07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pertemuan_kelas`
--

CREATE TABLE `pertemuan_kelas` (
  `id_pertemuan_kelas` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pertemuan_kelas`
--

INSERT INTO `pertemuan_kelas` (`id_pertemuan_kelas`, `id_kelas`, `nama`, `jenis`, `deskripsi`, `status`) VALUES
(7, 3, 'Training 1 Makanan', 'training', 'anjay', 0),
(15, 4, 'Training Snack 1', 'training', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. \r\nCurabitur condimentum erat eu leo bibendum, sit amet posuere nunc volutpat. Donec est lectus, viverra suscipit velit at, luctus consequat felis. Aliquam sit amet dolor malesuada, mattis ipsum vel, consequat orci. Vivamus et egestas eros, id auctor tortor. Cras scelerisque, leo at tincidunt porta, ex massa fringilla dolor, non eleifend nulla tortor nec mi. Donec eleifend ac tellus vitae vulputate. \r\nNullam quis tellus non sapien viverra aliquet at a ipsum. Proin ut tristique ipsum. Proin porttitor velit at neque consectetur suscipit.', 0),
(16, 4, 'Training Snack 2', 'training', '', 0),
(18, 3, 'Coaching Awal 1', 'coaching', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. \r\n\r\nCurabitur condimentum erat eu leo bibendum, sit amet posuere nunc volutpat. \r\nDonec est lectus, viverra suscipit velit at, luctus consequat felis. \r\nAliquam sit amet dolor malesuada, mattis ipsum vel, consequat orci. Vivamus et egestas eros, id auctor tortor. Cras scelerisque, leo at tincidunt porta, ex massa fringilla dolor, non eleifend nulla tortor nec mi. \r\nDonec eleifend ac tellus vitae vulputate. Nullam quis tellus non sapien viverra aliquet at a ipsum. Proin ut tristique ipsum. Proin porttitor velit at neque consectetur suscipit.', 0),
(19, 3, 'Coaching Awal 2', 'coaching', 'Assalamualaikum Wr. Wb.\r\nKali ini kita akan mempelajari sesuatu ya gaes. hahahaha\r\nBye', 0),
(22, 4, 'Coaching Kedua 1', 'coaching', '', 0),
(23, 4, 'Coaching Kedua 2', 'coaching', '', 0),
(24, 1, 'Mentoring Awal Makanan 1', 'mentoring', '', 0),
(28, 3, 'Training Makanan 3', 'training', '', 0),
(31, 4, 'Training Snack 3', 'training', '', 0),
(32, 5, 'Coaching Awal Makanan 1', 'coaching', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `progress_kelas`
--

CREATE TABLE `progress_kelas` (
  `id_progress_kelas` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `id_detail_kelas` int(11) NOT NULL,
  `id_tenant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `progress_kelas`
--

INSERT INTO `progress_kelas` (`id_progress_kelas`, `status`, `id_detail_kelas`, `id_tenant`) VALUES
(9, 1, 39, 28),
(10, 1, 41, 28),
(11, 1, 42, 28),
(12, 1, 43, 28),
(13, 1, 45, 28),
(14, 1, 46, 28),
(18, 1, 49, 28),
(32, 1, 66, 25),
(36, 1, 69, 25),
(37, 1, 70, 25),
(38, 1, 71, 25),
(39, 1, 72, 25),
(40, 1, 73, 25),
(41, 1, 74, 25),
(42, 1, 75, 25),
(44, 0, 78, 25),
(45, 1, 79, 28),
(48, 1, 81, 25),
(49, 1, 81, 27),
(50, 0, 39, 25),
(51, 0, 41, 25),
(52, 0, 42, 25),
(53, 0, 43, 25),
(54, 0, 45, 25),
(55, 0, 46, 25),
(56, 0, 49, 25),
(58, 0, 79, 25),
(59, 0, 82, 25),
(60, 1, 83, 25),
(61, 1, 84, 25),
(62, 1, 85, 25),
(63, 0, 86, 25),
(64, 0, 87, 25),
(65, 0, 88, 25),
(66, 0, 89, 25),
(73, 0, 66, 27),
(76, 0, 69, 27),
(77, 0, 70, 27),
(78, 0, 71, 27),
(79, 0, 72, 27),
(80, 0, 73, 27),
(81, 0, 74, 27),
(82, 0, 75, 27),
(84, 0, 78, 27),
(86, 0, 81, 27),
(93, 0, 66, 29),
(96, 0, 69, 29),
(97, 1, 70, 29),
(98, 1, 71, 29),
(99, 1, 72, 29),
(100, 0, 73, 29),
(101, 0, 74, 29),
(102, 0, 75, 29),
(104, 0, 78, 29),
(106, 1, 81, 29),
(113, 0, 66, 29),
(116, 0, 69, 29),
(117, 1, 70, 29),
(118, 1, 71, 29),
(119, 1, 72, 29),
(120, 0, 73, 29),
(121, 0, 74, 29),
(122, 0, 75, 29),
(124, 0, 78, 29),
(126, 0, 81, 29),
(133, 0, 66, 28),
(136, 0, 69, 28),
(137, 0, 70, 28),
(138, 0, 71, 28),
(139, 0, 72, 28),
(140, 0, 73, 28),
(141, 0, 74, 28),
(142, 0, 75, 28),
(144, 0, 78, 28),
(146, 0, 81, 28),
(147, 0, 90, 25),
(148, 0, 90, 27),
(149, 0, 90, 29),
(150, 0, 91, 25),
(151, 0, 91, 27),
(152, 0, 91, 29),
(153, 0, 92, 25),
(154, 0, 92, 27),
(155, 0, 92, 29),
(164, 0, 39, 33),
(165, 0, 41, 33),
(166, 0, 42, 33),
(167, 0, 43, 33),
(168, 0, 45, 33),
(169, 0, 46, 33),
(170, 0, 49, 33),
(172, 0, 79, 33),
(173, 0, 82, 33),
(174, 0, 83, 33),
(175, 0, 84, 33),
(176, 0, 85, 33),
(177, 0, 86, 33),
(178, 0, 87, 33),
(179, 0, 88, 33),
(180, 0, 89, 33),
(181, 0, 95, 25),
(182, 0, 95, 29),
(183, 0, 95, 28),
(184, 0, 39, 28),
(185, 0, 41, 28),
(186, 0, 42, 28),
(187, 0, 43, 28),
(188, 0, 45, 28),
(189, 0, 46, 28),
(190, 0, 49, 28),
(192, 0, 79, 28),
(193, 0, 82, 28),
(194, 0, 83, 28),
(195, 0, 84, 28),
(196, 0, 85, 28),
(197, 0, 86, 28),
(198, 0, 87, 28),
(199, 0, 88, 28),
(200, 0, 89, 28),
(201, 0, 39, 30),
(202, 0, 41, 30),
(203, 0, 42, 30),
(204, 0, 43, 30),
(205, 0, 45, 30),
(206, 0, 46, 30),
(207, 0, 49, 30),
(209, 0, 79, 30),
(210, 0, 82, 30),
(211, 0, 83, 30),
(212, 0, 84, 30),
(213, 0, 85, 30),
(214, 0, 86, 30),
(215, 0, 87, 30),
(216, 0, 88, 30),
(217, 0, 89, 30),
(218, 1, 96, 28),
(219, 0, 96, 33),
(220, 0, 96, 30),
(233, 1, 105, 25),
(234, 1, 105, 27),
(235, 0, 105, 29),
(236, 1, 106, 25),
(237, 1, 106, 27),
(238, 0, 106, 29),
(248, 1, 110, 25),
(249, 1, 110, 27),
(250, 0, 110, 29),
(259, 0, 113, 25),
(260, 0, 113, 29),
(261, 0, 113, 28);

-- --------------------------------------------------------

--
-- Table structure for table `rekrutmen`
--

CREATE TABLE `rekrutmen` (
  `id_rekrutmen` int(11) NOT NULL,
  `awal_rekrutmen` varchar(255) NOT NULL,
  `akhir_rekrutmen` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rekrutmen`
--

INSERT INTO `rekrutmen` (`id_rekrutmen`, `awal_rekrutmen`, `akhir_rekrutmen`, `status`) VALUES
(2, '2022-01-01', '2022-01-31', 1),
(3, '2022-02-01', '2022-02-05', 1),
(4, '2022-02-07', '2022-02-09', 1),
(9, '2022-03-10', '2022-03-11', 1),
(10, '2022-03-20', '2022-03-21', 1),
(11, '2022-03-26', '2022-03-27', 1),
(12, '2022-04-06', '2022-04-07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tenant`
--

CREATE TABLE `tenant` (
  `id_tenant` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jenis_tenant` varchar(50) NOT NULL,
  `nama_tenant` varchar(255) NOT NULL,
  `bidang_usaha` varchar(255) NOT NULL,
  `kontrak` varchar(255) NOT NULL,
  `pendamping` text NOT NULL,
  `coach` text NOT NULL,
  `status` int(11) NOT NULL,
  `waktu` varchar(255) NOT NULL,
  `waktu_selesai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tenant`
--

INSERT INTO `tenant` (`id_tenant`, `id_user`, `jenis_tenant`, `nama_tenant`, `bidang_usaha`, `kontrak`, `pendamping`, `coach`, `status`, `waktu`, `waktu_selesai`) VALUES
(25, 14, 'INWALL', 'Nanda Ice', 'minuman', 'Invoice#F-0000053.pdf', '15', '', 5, '2022-01-15', ''),
(27, 5, 'INWALL', 'Forgos Eatry', 'makanan', 'contoh_dokumen.pdf', '15', '', 5, '2022-01-20', ''),
(28, 14, 'OUTWALL', 'Forgos Coklat', 'Snack', 'contoh_dokumen.pdf', '18', '', 5, '2022-01-20', ''),
(29, 17, 'INWALL', 'Genji Onigiri', 'makanan', 'contoh_dokumen.pdf', '', '', 4, '2022-01-21', ''),
(33, 14, 'INWALL', 'Anjay Mouse', 'alat', 'contoh_dokumen.pdf', '', '', 4, '2022-02-15', ''),
(35, 14, 'OUTWALL', 'Nanda Ikan', 'Kemaritiman', '', '', '', 1, '2022-03-21', ''),
(36, 5, 'INWALL', 'Anjay tes', 'Pangan', '1648525842_Kontrak-Tenant_Anjay_tes.pdf', '', '', 4, '2022-03-26', ''),
(37, 5, 'INWALL', 'Anjay tes 2', 'Pangan', '', '', '', 0, '2022-03-26', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `telepon` varchar(50) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` varchar(255) NOT NULL,
  `pendidikan` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `role_id` int(1) NOT NULL,
  `is_active` int(11) NOT NULL,
  `keahlian` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `email`, `password`, `nama`, `telepon`, `tempat_lahir`, `tanggal_lahir`, `pendidikan`, `jenis_kelamin`, `alamat`, `role_id`, `is_active`, `keahlian`) VALUES
(5, 'yafi0721@gmail.com', '$2y$10$9ld7o1GTSsZ7E5w8y/t8l.X0v4o16Bj8LVWRWCo4LIvup5ldapg3G', 'yafi', '0808080808', 'bekasi', '1999-11-10', 's1', 'Laki-laki', 'lampung', 2, 1, ''),
(6, 'admin@gmail.com', '$2y$10$0StEtoJtOcgalcigVtzffuG6vA2hPGwgV/zp32s5An/8luEKsyLJK', 'admin tampan', '0808080808', 'bekasi', '2021-12-01', 's1', 'Laki-laki', 'aa', 1, 1, ''),
(7, 'wijayakusuma@gmail.com', '$2y$10$f03VWs/hGfEmtzyLbmZ9POYKxJh0k1n3IFRUqVNB0HbQtYb3RHmPO', 'Wijaya Kusuma', '0808080808', 'bekasi', '2021-12-01', 's2', 'Laki-laki', 'lampung', 5, 1, ''),
(8, 'asep@gmail.com', '$2y$10$3VzMxElUmDRpC41mSyg2Q.wg6tAjOkiObdMOEnZuFKElzoG6fdLxi', 'Asep Kuncoro', '089659712345', 'Jabar', '2021-12-01', 's2', 'Laki-laki', 'jabar', 5, 1, ''),
(9, 'yafi@gmail.com', '$2y$10$LlMHsioK5rmRd1xHP93ScevbAmlce/X9EObmiD7HUknSS.DzT.37m', 'yafi', '', '', '', '', '', '', 1, 1, ''),
(11, 'irfan@gmail.com', '$2y$10$EESZ0FXRYxdlMy/SThmUcOnAtptuByIw2VIPKqC8xtgvzM/am06zO', 'irfan', '085959595959', 'Bekasi', '2016-10-11', 's1', 'Laki-laki', 'lampung', 2, 1, ''),
(14, 'nandagoreh@gmail.com', '$2y$10$QBIchFSnY/RM2Cz3GBHFNOngFQEmj5eTqdqyMqlgHLldH9WDsyNAm', 'nanda', '08080808080', 'Bekasi', '2021-12-02', 's1', 'Laki-laki', 'lampung', 2, 1, ''),
(15, 'agusrizal@gmail.com', '$2y$10$yeTEZJdCzKQcPsIsGVpFlekgvhI3vRCSodMimHLIdwGY68jHZgV2q', 'Agus Rizaldi', '', '', '', '', '', '', 3, 1, ''),
(16, 'surya@gmail.com', '$2y$10$/Ihzy9.97dmv7ZXOg8ueGuleETKhTVNecTH0JYu/qZYTjCwUHRUcC', 'Surya Gudang', '0808080808', 'bekasi', '2022-02-02', 's1', 'Laki-laki', 'anjay', 4, 1, 'basis data;jarkom;anjay'),
(17, 'takiyagenji0721@gmail.com', '$2y$10$1/zWn9L8C.9fLY0FXIuWze3gYlMbVsA7.wWCg8t4hTtPTt69Ik8ey', 'genji', '089505050505', 'bandarlampung', '1999-07-08', 'SMA', 'Laki-laki', 'kedaton', 2, 1, ''),
(18, 'sage@gmail.com', '$2y$10$Nk.kfMre2OKsHhSL.5nV/eL5Tdlp2QfuMqEkUpYRh8gZS6oPPKQSO', 'Japanese Sage', '', '', '', '', '', '', 3, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id_token` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` text NOT NULL,
  `tanggal` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_token`
--

INSERT INTO `user_token` (`id_token`, `email`, `token`, `tanggal`) VALUES
(34, 'nandagoreh@gmail.com', '1F4WA0', '2022-04-07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coaching_log`
--
ALTER TABLE `coaching_log`
  ADD PRIMARY KEY (`id_coaching_log`);

--
-- Indexes for table `data_usaha`
--
ALTER TABLE `data_usaha`
  ADD PRIMARY KEY (`id_data_usaha`);

--
-- Indexes for table `data_usaha2`
--
ALTER TABLE `data_usaha2`
  ADD PRIMARY KEY (`id_data_usaha2`);

--
-- Indexes for table `detail_kelas`
--
ALTER TABLE `detail_kelas`
  ADD PRIMARY KEY (`id_detail_kelas`);

--
-- Indexes for table `enroll_kelas_coaching`
--
ALTER TABLE `enroll_kelas_coaching`
  ADD PRIMARY KEY (`id_enroll_kelas_coaching`);

--
-- Indexes for table `enroll_kelas_mentoring`
--
ALTER TABLE `enroll_kelas_mentoring`
  ADD PRIMARY KEY (`id_enroll_kelas_mentoring`);

--
-- Indexes for table `enroll_kelas_training`
--
ALTER TABLE `enroll_kelas_training`
  ADD PRIMARY KEY (`id_enroll_kelas_training`);

--
-- Indexes for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`id_jawaban`);

--
-- Indexes for table `kelas_coaching`
--
ALTER TABLE `kelas_coaching`
  ADD PRIMARY KEY (`id_kelas_coaching`);

--
-- Indexes for table `kelas_mentoring`
--
ALTER TABLE `kelas_mentoring`
  ADD PRIMARY KEY (`id_kelas_mentoring`);

--
-- Indexes for table `kelas_training`
--
ALTER TABLE `kelas_training`
  ADD PRIMARY KEY (`id_kelas_training`);

--
-- Indexes for table `monev`
--
ALTER TABLE `monev`
  ADD PRIMARY KEY (`id_monev`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id_notifikasi`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id_pengumuman`);

--
-- Indexes for table `penilaian1`
--
ALTER TABLE `penilaian1`
  ADD PRIMARY KEY (`id_penilaian1`);

--
-- Indexes for table `penilaian2`
--
ALTER TABLE `penilaian2`
  ADD PRIMARY KEY (`id_penilaian2`);

--
-- Indexes for table `penilaian_monev`
--
ALTER TABLE `penilaian_monev`
  ADD PRIMARY KEY (`id_penilaian_monev`);

--
-- Indexes for table `periode_monev`
--
ALTER TABLE `periode_monev`
  ADD PRIMARY KEY (`id_periode_monev`);

--
-- Indexes for table `pertemuan_kelas`
--
ALTER TABLE `pertemuan_kelas`
  ADD PRIMARY KEY (`id_pertemuan_kelas`);

--
-- Indexes for table `progress_kelas`
--
ALTER TABLE `progress_kelas`
  ADD PRIMARY KEY (`id_progress_kelas`);

--
-- Indexes for table `rekrutmen`
--
ALTER TABLE `rekrutmen`
  ADD PRIMARY KEY (`id_rekrutmen`);

--
-- Indexes for table `tenant`
--
ALTER TABLE `tenant`
  ADD PRIMARY KEY (`id_tenant`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coaching_log`
--
ALTER TABLE `coaching_log`
  MODIFY `id_coaching_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `data_usaha`
--
ALTER TABLE `data_usaha`
  MODIFY `id_data_usaha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `data_usaha2`
--
ALTER TABLE `data_usaha2`
  MODIFY `id_data_usaha2` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `detail_kelas`
--
ALTER TABLE `detail_kelas`
  MODIFY `id_detail_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `enroll_kelas_coaching`
--
ALTER TABLE `enroll_kelas_coaching`
  MODIFY `id_enroll_kelas_coaching` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `enroll_kelas_mentoring`
--
ALTER TABLE `enroll_kelas_mentoring`
  MODIFY `id_enroll_kelas_mentoring` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enroll_kelas_training`
--
ALTER TABLE `enroll_kelas_training`
  MODIFY `id_enroll_kelas_training` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `kelas_coaching`
--
ALTER TABLE `kelas_coaching`
  MODIFY `id_kelas_coaching` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kelas_mentoring`
--
ALTER TABLE `kelas_mentoring`
  MODIFY `id_kelas_mentoring` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kelas_training`
--
ALTER TABLE `kelas_training`
  MODIFY `id_kelas_training` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `monev`
--
ALTER TABLE `monev`
  MODIFY `id_monev` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id_pengumuman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `penilaian1`
--
ALTER TABLE `penilaian1`
  MODIFY `id_penilaian1` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `penilaian2`
--
ALTER TABLE `penilaian2`
  MODIFY `id_penilaian2` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `penilaian_monev`
--
ALTER TABLE `penilaian_monev`
  MODIFY `id_penilaian_monev` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `periode_monev`
--
ALTER TABLE `periode_monev`
  MODIFY `id_periode_monev` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pertemuan_kelas`
--
ALTER TABLE `pertemuan_kelas`
  MODIFY `id_pertemuan_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `progress_kelas`
--
ALTER TABLE `progress_kelas`
  MODIFY `id_progress_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=262;

--
-- AUTO_INCREMENT for table `rekrutmen`
--
ALTER TABLE `rekrutmen`
  MODIFY `id_rekrutmen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tenant`
--
ALTER TABLE `tenant`
  MODIFY `id_tenant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id_token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
