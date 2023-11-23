-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Nov 2023 pada 16.04
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `minus_poin`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `datasensor`
--

CREATE TABLE `datasensor` (
  `id` int(6) UNSIGNED NOT NULL,
  `data` int(10) DEFAULT NULL,
  `waktu` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `datasensor`
--

INSERT INTO `datasensor` (`id`, `data`, `waktu`) VALUES
(1, 10, '2023-11-08 08:26:30'),
(2, 20, '2023-11-08 08:27:41'),
(3, 0, '2023-11-08 08:45:37'),
(4, 100, '2023-11-08 08:46:00'),
(5, 78000, '2023-11-08 08:52:57'),
(6, 0, '2023-11-08 08:55:57'),
(7, 0, '2023-11-08 08:58:23'),
(8, 9999999, '2023-11-08 08:58:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `plus_poin`
--

CREATE TABLE `plus_poin` (
  `id` int(11) NOT NULL,
  `nim` int(11) NOT NULL,
  `poin` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `plus_poin`
--

INSERT INTO `plus_poin` (`id`, `nim`, `poin`, `keterangan`, `tanggal`) VALUES
(7, 2202050, 20, 'Mahasiswa berprestasi', '2023-11-23'),
(8, 2202049, 50, 'Menjuarai olimpiade', '2023-11-23'),
(9, 2202049, 80, 'Menjadi Mahasiswa teladan', '2023-11-23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `nama` text NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id`, `nama`, `username`, `password`, `no_hp`, `email`) VALUES
(1, 'Ridwan Arif', 'ridwan', '123', '234255342', 'ganteng12345'),
(2, 'tes123 Coba', 'tes123', '123', '04200802804234', 'ganteng12345'),
(4, 'tes12311', 'tes123123', 'tes123@gmail.com', '04200802804234', '1232321'),
(7, 'Ridwan Arif', 'ridwan123', '123', '98899', 'ddd@dddd.com'),
(9, 'Ori Saputri', 'ori', '69', '696969', 'ori@gmail.com'),
(10, 'Agusti', 'Agusti', '123', '085691964185', 'agusti@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `datasensor`
--
ALTER TABLE `datasensor`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `plus_poin`
--
ALTER TABLE `plus_poin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `datasensor`
--
ALTER TABLE `datasensor`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `plus_poin`
--
ALTER TABLE `plus_poin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
