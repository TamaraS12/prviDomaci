-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2023 at 09:27 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `turisticka_agencija`
--
CREATE DATABASE IF NOT EXISTS `turisticka_agencija` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `turisticka_agencija`;

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL,
  `korisnicko_ime` varchar(255) NOT NULL,
  `lozinka` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `korisnicko_ime`, `lozinka`) VALUES
(1, 'pera', 'pera123'),
(2, 'mile', 'mile123');

-- --------------------------------------------------------

--
-- Table structure for table `prijava`
--

CREATE TABLE `prijava` (
  `id` int(11) NOT NULL,
  `broj_osoba` int(11) NOT NULL,
  `datum_od` date NOT NULL,
  `datum_do` date NOT NULL,
  `cena` decimal(10,0) NOT NULL,
  `korisnik_id` int(11) NOT NULL,
  `smestaj_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prijava`
--

INSERT INTO `prijava` (`id`, `broj_osoba`, `datum_od`, `datum_do`, `cena`, `korisnik_id`, `smestaj_id`) VALUES
(15, 7, '2023-02-08', '2023-02-15', '24500', 1, 4),
(18, 5, '2023-01-19', '2023-01-27', '20000', 2, 2),
(19, 3, '2023-01-25', '2023-01-31', '12000', 1, 2),
(20, 2, '2023-01-26', '2023-01-31', '8000', 1, 2),
(21, 2, '2023-01-26', '2023-01-31', '7000', 1, 4),
(25, 4, '2023-01-03', '2023-01-02', '8000', 2, 1),
(26, 3, '2023-01-28', '2023-02-11', '12000', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `smestaj`
--

CREATE TABLE `smestaj` (
  `id` int(11) NOT NULL,
  `tip` varchar(255) NOT NULL,
  `naziv` varchar(255) NOT NULL,
  `mesto` varchar(255) NOT NULL,
  `kapacitet` int(11) NOT NULL,
  `cena_po_osobi` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `smestaj`
--

INSERT INTO `smestaj` (`id`, `tip`, `naziv`, `mesto`, `kapacitet`, `cena_po_osobi`) VALUES
(1, 'Apartman', 'Sunce', 'Sokobanja', 4, '2000'),
(2, 'Vila', 'Stankovic', 'Zajecar', 8, '4000'),
(3, 'Kuca', 'Rezidencija Peric', 'Maldivi', 5, '3000'),
(4, 'Apartman', 'Biser Jadrana', 'Boka Kotorska', 6, '3500');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prijava`
--
ALTER TABLE `prijava`
  ADD PRIMARY KEY (`id`),
  ADD KEY `korisnik_spoljni_kljuc` (`korisnik_id`),
  ADD KEY `smestaj_spoljni_kljuc` (`smestaj_id`);

--
-- Indexes for table `smestaj`
--
ALTER TABLE `smestaj`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `prijava`
--
ALTER TABLE `prijava`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `smestaj`
--
ALTER TABLE `smestaj`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `prijava`
--
ALTER TABLE `prijava`
  ADD CONSTRAINT `korisnik_spoljni_kljuc` FOREIGN KEY (`korisnik_id`) REFERENCES `korisnik` (`id`),
  ADD CONSTRAINT `smestaj_spoljni_kljuc` FOREIGN KEY (`smestaj_id`) REFERENCES `smestaj` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
