-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Jun 2022 pada 12.30
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_selecta`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detail_paket`
--

CREATE TABLE `tb_detail_paket` (
  `detail_id` int(11) NOT NULL,
  `detail_wahana_id` int(11) NOT NULL,
  `detail_paket_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_detail_paket`
--

INSERT INTO `tb_detail_paket` (`detail_id`, `detail_wahana_id`, `detail_paket_id`, `created_at`, `updated_at`) VALUES
(231, 39, 49, '2022-06-22 16:23:31', NULL),
(232, 42, 49, '2022-06-22 16:23:31', NULL),
(233, 44, 49, '2022-06-22 16:23:31', NULL),
(234, 45, 49, '2022-06-22 16:23:31', NULL),
(235, 46, 49, '2022-06-22 16:23:31', NULL),
(236, 42, 50, '2022-06-22 16:30:26', NULL),
(237, 44, 50, '2022-06-22 16:30:26', NULL),
(238, 45, 50, '2022-06-22 16:30:26', NULL),
(239, 39, 51, '2022-06-22 16:30:59', NULL),
(240, 46, 51, '2022-06-22 16:30:59', NULL),
(241, 80, 51, '2022-06-22 16:30:59', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_paket`
--

CREATE TABLE `tb_paket` (
  `paket_id` int(11) NOT NULL,
  `code` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  `diskon` int(11) DEFAULT NULL,
  `image` varchar(256) DEFAULT NULL,
  `status` int(1) NOT NULL COMMENT '1:active 2:inactive\r\n',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_paket`
--

INSERT INTO `tb_paket` (`paket_id`, `code`, `name`, `diskon`, `image`, `status`, `created_at`, `updated_at`) VALUES
(49, 'PKT001', 'Paket Terusan', 10, NULL, 1, '2022-06-22 16:23:17', NULL),
(50, 'PKT002', 'Paket Serba 10k', 5, NULL, 1, '2022-06-22 16:30:26', NULL),
(51, 'PKT003', 'Paket Weekday', 0, NULL, 1, '2022-06-22 16:30:59', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tiketonline`
--

CREATE TABLE `tb_tiketonline` (
  `tiketonline_id` int(11) NOT NULL,
  `order_key` varchar(256) NOT NULL,
  `nik` varchar(256) DEFAULT NULL,
  `name` varchar(256) DEFAULT NULL,
  `telp` varchar(256) DEFAULT NULL,
  `ticket_total` int(11) DEFAULT NULL,
  `reservationdate` date DEFAULT NULL,
  `ticket_type` int(1) DEFAULT NULL COMMENT '1:perorangan 2:rombongan',
  `paket_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `order_id` varchar(256) NOT NULL,
  `gross_amount` int(11) NOT NULL,
  `payment_type` varchar(256) NOT NULL,
  `transaction_time` varchar(256) NOT NULL,
  `transaction_status` varchar(256) NOT NULL,
  `bank` varchar(256) NOT NULL,
  `va_number` varchar(256) NOT NULL,
  `pdf_url` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) DEFAULT NULL,
  `password` varchar(256) NOT NULL,
  `level` int(1) NOT NULL COMMENT '1:marketing 2:kasir 3:portir 4:konsumen',
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`user_id`, `name`, `email`, `image`, `password`, `level`, `created_at`) VALUES
(2, 'Gilang Surya Pratama', 'gilang@gmail.com', 'default.jpg', '42ace1431b95d0fed5b7f5d9d183c4d5b095753b', 1, '2022-05-10'),
(5, 'Azalia Putri Safira', 'azalia@gmail.com', 'default.jpg', '9f3cb948017408f0c4b21b1e266badb5bed82f8f', 3, '2022-05-10'),
(7, 'cokimi', 'cokimi@gmail.com', 'default.jpg', 'eaa9cbcb4931adb160376768c9863b79bedee00b', 4, '2022-05-16'),
(13, 'Panpan Safira', 'panpan@gmail.com', 'default.jpg', '6e4c967c80bde9e59094d00549672b9c90096603', 4, '2022-05-28'),
(14, 'heru', 'heru@gmail.com', 'default.jpg', 'c0d35209e3ce0c0e1ae251271d4e24363900006b', 4, '2022-05-30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_wahana`
--

CREATE TABLE `tb_wahana` (
  `wahana_id` int(11) NOT NULL,
  `code` varchar(256) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(256) DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '1:active 2:inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_wahana`
--

INSERT INTO `tb_wahana` (`wahana_id`, `code`, `name`, `price`, `image`, `status`, `created_at`, `updated_at`) VALUES
(39, 'WHN001', '4 Dimensi', 35000, '4dimensi.jpg', 2, '2022-05-30 14:44:58', '2022-06-22 02:50:59'),
(42, 'WHN002', 'Sky Bike', 10000, 'sepedaudara.jpg', 2, '2022-05-31 00:25:25', '2022-06-22 02:51:39'),
(44, 'WHN004', 'Bianglala', 10000, 'bianglala.jpg', 1, '2022-05-31 02:06:48', '2022-06-22 02:52:27'),
(45, 'WHN005', 'Perahu Ayun', 10000, 'perahuayun.jpg', 1, '2022-05-31 07:35:09', '2022-06-22 02:53:32'),
(46, 'WHN006', 'Roller Coaster', 20000, 'rollercoaster.jpg', 1, '2022-05-31 07:35:38', '2022-06-22 02:54:05'),
(80, 'WHN007', 'Tagada Putar', 15000, 'tagada.jpg', 1, '2022-06-22 07:40:02', '2022-06-22 04:15:38');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_detail_paket`
--
ALTER TABLE `tb_detail_paket`
  ADD PRIMARY KEY (`detail_id`);

--
-- Indeks untuk tabel `tb_paket`
--
ALTER TABLE `tb_paket`
  ADD PRIMARY KEY (`paket_id`);

--
-- Indeks untuk tabel `tb_tiketonline`
--
ALTER TABLE `tb_tiketonline`
  ADD PRIMARY KEY (`tiketonline_id`);

--
-- Indeks untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`order_id`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indeks untuk tabel `tb_wahana`
--
ALTER TABLE `tb_wahana`
  ADD PRIMARY KEY (`wahana_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_detail_paket`
--
ALTER TABLE `tb_detail_paket`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=242;

--
-- AUTO_INCREMENT untuk tabel `tb_paket`
--
ALTER TABLE `tb_paket`
  MODIFY `paket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT untuk tabel `tb_tiketonline`
--
ALTER TABLE `tb_tiketonline`
  MODIFY `tiketonline_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tb_wahana`
--
ALTER TABLE `tb_wahana`
  MODIFY `wahana_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
