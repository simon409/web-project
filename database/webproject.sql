-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2023 at 01:28 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `airport`
--

CREATE TABLE `airport` (
  `idairp` int(11) NOT NULL,
  `nameairp` varchar(200) NOT NULL,
  `codeairport` varchar(200) NOT NULL,
  `countryid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `airport`
--

INSERT INTO `airport` (`idairp`, `nameairp`, `codeairport`, `countryid`) VALUES
(3, 'John F. Kennedy International Airport', 'JFK', 1),
(4, 'Mohammed V International Airport', 'CMN', 2),
(5, 'Heathrow Airport', 'LHR', 3);

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

CREATE TABLE `card` (
  `id` int(11) NOT NULL,
  `flightnum` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `numt_adult` int(11) NOT NULL,
  `numt_child` int(11) NOT NULL,
  `totalprice` float NOT NULL,
  `date` date DEFAULT current_timestamp(),
  `qrcode` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `commandedf`
--

CREATE TABLE `commandedf` (
  `id` int(11) NOT NULL,
  `flightnum` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `numt_adult` int(11) NOT NULL,
  `numt_child` int(11) NOT NULL,
  `totalprice` float NOT NULL,
  `date` date DEFAULT current_timestamp(),
  `qrcode` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `commandedf`
--

INSERT INTO `commandedf` (`id`, `flightnum`, `iduser`, `numt_adult`, `numt_child`, `totalprice`, `date`, `qrcode`) VALUES
(14, 1, 1, 1, 0, 5134, '2023-02-03', '1675462061.png'),
(15, 3, 1, 1, 0, 2125, '2023-02-04', '1675512625.png'),
(16, 1, 1, 2, 1, 10268, '2023-02-04', '1675513051.png');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `idcoun` int(11) NOT NULL,
  `namecoun` varchar(50) NOT NULL,
  `codecoun` varchar(3) NOT NULL,
  `image` varchar(2048) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`idcoun`, `namecoun`, `codecoun`, `image`) VALUES
(1, 'United States', 'USA', 'https://images.unsplash.com/photo-1610312278520-bcc893a3ff1d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1147&q=80'),
(2, 'Morocco', 'MAR', 'https://images.unsplash.com/photo-1569383746724-6f1b882b8f46?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80'),
(3, 'United Kingdom', 'GBR', 'https://images.unsplash.com/photo-1529180184525-78f99adb8e98?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80');

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

CREATE TABLE `flights` (
  `flightnum` int(11) NOT NULL,
  `froma` int(11) NOT NULL,
  `toa` int(11) NOT NULL,
  `idescale` int(11) DEFAULT NULL,
  `boardtime` time NOT NULL,
  `arrivaltime` time NOT NULL,
  `price_adult` float NOT NULL,
  `price_child` float NOT NULL,
  `seats_available` int(11) NOT NULL,
  `seats_taken` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`flightnum`, `froma`, `toa`, `idescale`, `boardtime`, `arrivaltime`, `price_adult`, `price_child`, `seats_available`, `seats_taken`) VALUES
(1, 3, 4, 1, '10:20:00', '18:30:00', 5134, 5134, 183, 0),
(3, 4, 5, NULL, '06:10:00', '12:20:00', 2125, 2125, 127, 0);

-- --------------------------------------------------------

--
-- Table structure for table `stopover`
--

CREATE TABLE `stopover` (
  `idstop` int(11) NOT NULL,
  `airid` int(11) NOT NULL,
  `arrival` time NOT NULL,
  `departure` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stopover`
--

INSERT INTO `stopover` (`idstop`, `airid`, `arrival`, `departure`) VALUES
(1, 5, '17:10:00', '17:30:00'),
(2, 3, '07:47:00', '20:10:00'),
(3, 4, '05:00:00', '05:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone_num` varchar(20) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `fullname`, `password`, `email`, `phone_num`, `type`) VALUES
(1, 'testuser', 'simon add 2', '25d55ad283aa400af464c76d713c07ad', 'addarm409@gmail.com', '0611051318', 'user'),
(2, 'flyme-admin', NULL, '21232f297a57a5a743894a0e4a801fc3', 'addarm409@gmail.com', '', 'admin'),
(4, 'testuser2', 'Mohamed Addar', '0df4c0c2a86ba43a099f8b2c1ca0685e', 'ghounimhamza27@gmail.com', '', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `airport`
--
ALTER TABLE `airport`
  ADD PRIMARY KEY (`idairp`),
  ADD KEY `fr_counid_aircoun` (`countryid`);

--
-- Indexes for table `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fr_flightnum_card` (`flightnum`),
  ADD KEY `fr_userid` (`iduser`);

--
-- Indexes for table `commandedf`
--
ALTER TABLE `commandedf`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fr_flightnum_cmd` (`flightnum`),
  ADD KEY `fr_userid_cmd` (`iduser`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`idcoun`);

--
-- Indexes for table `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`flightnum`),
  ADD KEY `fr_fromair_flight` (`froma`),
  ADD KEY `fr_toair_flight` (`toa`),
  ADD KEY `fr_escale_flight` (`idescale`);

--
-- Indexes for table `stopover`
--
ALTER TABLE `stopover`
  ADD PRIMARY KEY (`idstop`),
  ADD KEY `fr_air_airport_stop` (`airid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `airport`
--
ALTER TABLE `airport`
  MODIFY `idairp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `card`
--
ALTER TABLE `card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `commandedf`
--
ALTER TABLE `commandedf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `idcoun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `flights`
--
ALTER TABLE `flights`
  MODIFY `flightnum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stopover`
--
ALTER TABLE `stopover`
  MODIFY `idstop` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `airport`
--
ALTER TABLE `airport`
  ADD CONSTRAINT `fr_counid_aircoun` FOREIGN KEY (`countryid`) REFERENCES `country` (`idcoun`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `card`
--
ALTER TABLE `card`
  ADD CONSTRAINT `fr_flightnum_card` FOREIGN KEY (`flightnum`) REFERENCES `flights` (`flightnum`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fr_userid` FOREIGN KEY (`iduser`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `commandedf`
--
ALTER TABLE `commandedf`
  ADD CONSTRAINT `fr_flightnum_cmd` FOREIGN KEY (`flightnum`) REFERENCES `flights` (`flightnum`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fr_userid_cmd` FOREIGN KEY (`iduser`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `flights`
--
ALTER TABLE `flights`
  ADD CONSTRAINT `fr_escale_flight` FOREIGN KEY (`idescale`) REFERENCES `stopover` (`idstop`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fr_fromair_flight` FOREIGN KEY (`froma`) REFERENCES `airport` (`idairp`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fr_toair_flight` FOREIGN KEY (`toa`) REFERENCES `airport` (`idairp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stopover`
--
ALTER TABLE `stopover`
  ADD CONSTRAINT `fr_air_airport_stop` FOREIGN KEY (`airid`) REFERENCES `airport` (`idairp`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
