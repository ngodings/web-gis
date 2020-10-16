-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Okt 2020 pada 18.54
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_gis`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bangunan`
--

CREATE TABLE `bangunan` (
  `bangunan_id` int(15) NOT NULL,
  `bangunan_nama` varchar(255) NOT NULL,
  `bangunan_lat` varchar(100) NOT NULL,
  `bangunan_long` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bangunan`
--

INSERT INTO `bangunan` (`bangunan_id`, `bangunan_nama`, `bangunan_lat`, `bangunan_long`) VALUES
(1, 'RS. Moewardi', '110.8419749', '-7.5588231'),
(2, 'RS Hermina', '110.8380198', '-7.5600346'),
(3, 'Dr. Oen Hospital', '110.8358398', '-7.5554557');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bangunan`
--
ALTER TABLE `bangunan`
  ADD PRIMARY KEY (`bangunan_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bangunan`
--
ALTER TABLE `bangunan`
  MODIFY `bangunan_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
