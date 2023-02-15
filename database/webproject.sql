-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2023 at 02:58 PM
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
(1, 'John F. Kennedy International Airport', 'JFK', 1),
(2, 'Mohammed V International Airport', 'CMN', 2),
(3, 'Heathrow Airport', 'LHR', 3),
(4, 'Abu Dhabi International Airport', 'AUH', 4),
(10, 'Madrid Airport', 'MAD', 8);

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
  `date` date DEFAULT NULL,
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
  `date` date DEFAULT NULL,
  `qrcode` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `commandedf`
--

INSERT INTO `commandedf` (`id`, `flightnum`, `iduser`, `numt_adult`, `numt_child`, `totalprice`, `date`, `qrcode`) VALUES
(14, 1, 1, 1, 0, 5134, '2023-02-03', '1675462061.png'),
(16, 1, 1, 2, 1, 10268, '2023-02-04', '1675513051.png'),
(20, 1, 1, 1, 0, 5134, '2023-02-09', '1675962159.png'),
(21, 1, 1, 1, 0, 5134, '2023-02-10', '1676027971.png'),
(23, 37, 1, 2, 0, 8500, '2023-02-10', '1676033334.png'),
(24, 40, 1, 1, 0, 2100, '2023-02-10', '1676033381.png'),
(25, 40, 1, 2, 0, 4200, '2023-02-10', '1676033437.png'),
(26, 40, 4, 1, 0, 2100, '2023-02-11', '1676113709.png'),
(27, 40, 4, 2, 0, 4200, '2023-02-11', '1676113794.png'),
(28, 40, 4, 1, 1, 4150, '2023-02-11', '1676113847.png'),
(29, 1, 1, 2, 1, 15402, '2023-02-15', '1676125785.png'),
(30, 1, 1, 2, 1, 15402, '2023-02-12', '1676132358.png'),
(31, 1, 1, 2, 1, 15402, '2023-02-12', '1676132358.png'),
(32, 1, 1, 2, 0, 10268, '2023-02-11', '1676132561.png'),
(34, 40, 1, 1, 0, 2100, '2023-02-11', '1676133309.png'),
(38, 1, 1, 1, 0, 5134, '2023-02-11', '1676137368.png'),
(39, 1, 1, 2, 0, 10268, '2023-02-15', '1676279502.png'),
(40, 37, 6, 5, 1, 25500, '2023-03-23', '1676374616.png');

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
(3, 'United Kingdom', 'GBR', 'https://images.unsplash.com/photo-1529180184525-78f99adb8e98?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80'),
(4, 'Émirats arabes unis', 'EAU', 'https://images.unsplash.com/photo-1518684079-3c830dcef090?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80'),
(8, 'Spain', 'ESP', 'https://images.unsplash.com/photo-1495562569060-2eec283d3391?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80');

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
  `totalseats` int(11) NOT NULL,
  `seats_available` int(11) NOT NULL,
  `seats_taken` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`flightnum`, `froma`, `toa`, `idescale`, `boardtime`, `arrivaltime`, `price_adult`, `price_child`, `totalseats`, `seats_available`, `seats_taken`) VALUES
(1, 1, 2, 1, '10:20:00', '18:30:00', 5134, 5134, 200, 200, 3),
(37, 2, 1, 2, '06:00:00', '15:50:00', 4250, 4250, 150, 150, 6),
(40, 2, 4, NULL, '13:44:00', '23:45:00', 2100, 2050, 300, 300, 0);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `idmessage` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(300) NOT NULL,
  `message` varchar(500) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Unread',
  `sentat` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`idmessage`, `fullname`, `email`, `subject`, `message`, `status`, `sentat`) VALUES
(42, 'Mohamed Addar', 'addarm409@gmail.com', 'Thanks for service', 'Hey i am simon', 'Read', '2023-02-11 16:02:49'),
(43, 'Mohamed Addar', 'dfgfdgfd@gdfsv.xczv', 'wow', 'wow owowowowoow', 'Read', '2023-02-11 17:26:33'),
(47, 'yahia kasdi', 'kasdi@gmail.com', 'yahia', 'hey i am kasdi', 'Read', '2023-02-13 10:17:06');

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
(1, 3, '17:10:00', '17:30:00'),
(2, 1, '07:47:00', '20:10:00'),
(3, 2, '05:00:00', '05:15:00'),
(4, 4, '19:14:00', '12:42:00'),
(5, 2, '00:00:00', '00:00:00'),
(6, 1, '02:24:00', '12:58:00');

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
(1, 'testuser', 'simon addar', '25d55ad283aa400af464c76d713c07ad', 'addarm409@gmail.com', '0611051318', 'user'),
(2, 'flyme-admin', NULL, '21232f297a57a5a743894a0e4a801fc3', 'addarm409@gmail.com', '', 'admin'),
(4, 'testuser2', 'Mohamed Addar', '0df4c0c2a86ba43a099f8b2c1ca0685e', 'ghounimhamza27@gmail.com', '', 'user'),
(5, 'testuser1', 'Mohamed addar', '0df4c0c2a86ba43a099f8b2c1ca0685e', 'addrmohammed@gmail.com', '', 'user'),
(6, 'blender45', 'yahia kasdi', '5e7fa31bf47828383aeb12cf5af89276', 'yahiaksd@gmail.com', '', 'user');

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
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`idmessage`);

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
  MODIFY `idairp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `card`
--
ALTER TABLE `card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `commandedf`
--
ALTER TABLE `commandedf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `idcoun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `flights`
--
ALTER TABLE `flights`
  MODIFY `flightnum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `idmessage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `stopover`
--
ALTER TABLE `stopover`
  MODIFY `idstop` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
