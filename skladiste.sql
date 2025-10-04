-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 04, 2025 at 03:06 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skladiste`
--

-- --------------------------------------------------------

--
-- Table structure for table `dobavljac`
--

CREATE TABLE `dobavljac` (
  `dobavljac_id` int(11) NOT NULL,
  `naziv` varchar(100) NOT NULL,
  `kontakt` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dobavljac`
--

INSERT INTO `dobavljac` (`dobavljac_id`, `naziv`, `kontakt`) VALUES
(32, 'Maxi Distributeri', 'maxi@dostava.rs'),
(33, 'Idea Supply', 'kontakt@idea.rs'),
(34, 'Metro Cash&Carry', 'prodaja@metro.rs'),
(35, 'Univerexport Logistika', 'logistika@univerexport.rs'),
(36, 'Lidl Srbija', 'lidl@lidl.rs'),
(37, 'Aroma Plus', 'info@aromaplus.rs'),
(38, 'Mega Market D.O.O.', 'megainfo@market.rs'),
(39, 'Frikom Distribucija', 'prodaja@frikom.rs'),
(40, 'Bambi Commerce', 'kontakt@bambi.rs'),
(41, 'Imlek Logistika', 'info@imlek.rs');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `korisnik_id` int(11) NOT NULL,
  `ime` varchar(50) NOT NULL,
  `prezime` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `lozinka` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`korisnik_id`, `ime`, `prezime`, `email`, `lozinka`) VALUES
(1, 'Teodora', 'Savković', 'teodorasavkovic2005@gmail.com', '$2y$10$.W6lWJQzKb5FQkfR.bqarOMG78YKz3H5VbL3hL.FilK4NCMorYtli');

-- --------------------------------------------------------

--
-- Table structure for table `narudzbina`
--

CREATE TABLE `narudzbina` (
  `narudzbina_id` int(11) NOT NULL,
  `proizvod_id` int(11) DEFAULT NULL,
  `datum` date NOT NULL,
  `kolicina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `narudzbina`
--

INSERT INTO `narudzbina` (`narudzbina_id`, `proizvod_id`, `datum`, `kolicina`) VALUES
(37, 66, '2025-10-01', 20),
(38, 67, '2025-10-02', 15),
(39, 68, '2025-10-03', 5),
(40, 69, '2025-10-03', 12),
(41, 70, '2025-10-04', 10),
(42, 71, '2025-10-04', 50),
(43, 72, '2025-10-05', 30),
(44, 73, '2025-10-05', 8),
(45, 74, '2025-10-06', 18),
(46, 75, '2025-10-06', 60);

-- --------------------------------------------------------

--
-- Table structure for table `proizvod`
--

CREATE TABLE `proizvod` (
  `proizvod_id` int(11) NOT NULL,
  `naziv` varchar(100) NOT NULL,
  `opis` text DEFAULT NULL,
  `cena` decimal(10,2) NOT NULL,
  `dobavljac_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `proizvod`
--

INSERT INTO `proizvod` (`proizvod_id`, `naziv`, `opis`, `cena`, `dobavljac_id`) VALUES
(66, 'Mleko Moja Kravica', '1l, punomasno', 120.00, 32),
(67, 'Plazma keks', '300g original', 280.00, 37),
(68, 'Frikom Pizza', 'Zamrznuta margarita 400g', 450.00, 38),
(69, 'Pileće meso', 'Sveže pile, 1kg', 600.00, 39),
(70, 'Jogurt Imlek', '2.8%mm, 1l', 140.00, 40),
(71, 'Brašno Tip-400', 'Pakovanje 1kg', 100.00, 33),
(72, 'Ulje Dijamant', 'Suncokretovo ulje 1l', 200.00, 41),
(73, 'Kafa Grand Gold', '200g mlevena kafa', 380.00, 34),
(74, 'Čokolada Milka', '100g, razni ukusi', 150.00, 35),
(75, 'Hleb Sava', 'Svež beli hleb', 70.00, 36);

-- --------------------------------------------------------

--
-- Table structure for table `zaliha`
--

CREATE TABLE `zaliha` (
  `zaliha_id` int(11) NOT NULL,
  `proizvod_id` int(11) NOT NULL,
  `kolicina` int(11) NOT NULL,
  `lokacija` varchar(100) DEFAULT NULL,
  `datum_azuriranja` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `zaliha`
--

INSERT INTO `zaliha` (`zaliha_id`, `proizvod_id`, `kolicina`, `lokacija`, `datum_azuriranja`) VALUES
(45, 66, 120, 'Magacin A1', '2025-10-01 06:30:00'),
(46, 67, 75, 'Magacin A2', '2025-10-02 07:15:00'),
(47, 68, 40, 'Hladnjača B1', '2025-10-03 05:45:00'),
(48, 69, 90, 'Magacin C1', '2025-10-03 12:20:00'),
(49, 70, 60, 'Magacin A1', '2025-10-04 08:05:00'),
(50, 71, 200, 'Magacin B3', '2025-10-04 14:40:00'),
(51, 72, 150, 'Magacin B2', '2025-10-05 09:00:00'),
(52, 73, 85, 'Magacin D1', '2025-10-05 11:30:00'),
(53, 74, 110, 'Magacin A2', '2025-10-06 07:50:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dobavljac`
--
ALTER TABLE `dobavljac`
  ADD PRIMARY KEY (`dobavljac_id`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`korisnik_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `narudzbina`
--
ALTER TABLE `narudzbina`
  ADD PRIMARY KEY (`narudzbina_id`),
  ADD KEY `fk_narudzbina_proizvod` (`proizvod_id`);

--
-- Indexes for table `proizvod`
--
ALTER TABLE `proizvod`
  ADD PRIMARY KEY (`proizvod_id`),
  ADD KEY `fk_proizvod_dobavljac` (`dobavljac_id`);

--
-- Indexes for table `zaliha`
--
ALTER TABLE `zaliha`
  ADD PRIMARY KEY (`zaliha_id`),
  ADD KEY `fk_zaliha_proizvod` (`proizvod_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dobavljac`
--
ALTER TABLE `dobavljac`
  MODIFY `dobavljac_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `korisnik_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `narudzbina`
--
ALTER TABLE `narudzbina`
  MODIFY `narudzbina_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `proizvod`
--
ALTER TABLE `proizvod`
  MODIFY `proizvod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `zaliha`
--
ALTER TABLE `zaliha`
  MODIFY `zaliha_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `narudzbina`
--
ALTER TABLE `narudzbina`
  ADD CONSTRAINT `fk_narudzbina_proizvod` FOREIGN KEY (`proizvod_id`) REFERENCES `proizvod` (`proizvod_id`) ON DELETE CASCADE;

--
-- Constraints for table `proizvod`
--
ALTER TABLE `proizvod`
  ADD CONSTRAINT `fk_proizvod_dobavljac` FOREIGN KEY (`dobavljac_id`) REFERENCES `dobavljac` (`dobavljac_id`) ON DELETE CASCADE;

--
-- Constraints for table `zaliha`
--
ALTER TABLE `zaliha`
  ADD CONSTRAINT `fk_zaliha_proizvod` FOREIGN KEY (`proizvod_id`) REFERENCES `proizvod` (`proizvod_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
