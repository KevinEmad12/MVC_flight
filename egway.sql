-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2022 at 06:34 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `egway`
--

-- --------------------------------------------------------

--
-- Table structure for table `family`
--

CREATE TABLE `family` (
  `guardian_natid` varchar(30) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `natid` varchar(30) DEFAULT NULL,
  `age` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `who` varchar(50) NOT NULL,
  `action` varchar(50) NOT NULL,
  `description` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`date`, `who`, `action`, `description`) VALUES
('2022-06-12 02:14:24', 'nasr', 'update', 'nasr updated mohamed data');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `name` varchar(200) NOT NULL,
  `rev_num` int(25) NOT NULL,
  `f_code` varchar(15) NOT NULL,
  `f_code2` varchar(15) NOT NULL,
  `f_code3` varchar(15) NOT NULL,
  `rate` int(1) DEFAULT NULL,
  `comment` varchar(250) DEFAULT NULL,
  `cancel` tinyint(1) DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `Price` int(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `edit` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`name`, `rev_num`, `f_code`, `f_code2`, `f_code3`, `rate`, `comment`, `cancel`, `date`, `Price`, `status`, `edit`) VALUES
('Guest', 53, 'LO0001PA', 'PA0001CA', '', NULL, NULL, NULL, '2022-06-11 14:08:19', 7900, 'Ordered', 0),
('Guest', 54, 'LO0001PA', 'PA0001CA', '', NULL, NULL, NULL, '2022-06-11 14:08:19', 7900, 'Ordered', 0),
('Guest', 55, 'LO0001PA', 'PA0001CA', '', NULL, NULL, NULL, '2022-06-11 14:08:19', 7900, 'Ordered', 0),
('Guest', 5447, 'LO0001PA', 'PA0001CA', '', 3, 'bad staff', 2, '2022-06-11 14:08:19', 7900, 'Ordered', 0),
('Guest', 11111, 'LO0001PA', 'PA0001CA', '', 4, 'nice', NULL, '2022-06-11 14:08:19', 7900, 'Ordered', 0),
('Guest', 424011, 'LO0001PA', 'PA0001CA', '', 1, 'could not open emergency exit for air', 1, '2022-06-11 14:08:19', 7900, 'Ordered', 0),
('mamdoh@gmail.com', 424014, 'LO0001CA', '', '', NULL, NULL, NULL, '2022-06-12 17:09:38', 5500, NULL, 0),
('samol@gmail.com', 424017, 'CA0001LO', '', '', NULL, NULL, NULL, '2022-06-13 06:25:18', 8800, 'Ordered', 0);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(120) NOT NULL,
  `role` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE `trips` (
  `FlightCode` varchar(10) NOT NULL,
  `FromAirPort` varchar(10) NOT NULL,
  `Destination` varchar(10) NOT NULL,
  `f_date` date NOT NULL DEFAULT current_timestamp(),
  `price` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trips`
--

INSERT INTO `trips` (`FlightCode`, `FromAirPort`, `Destination`, `f_date`, `price`) VALUES
('CA0001LO', 'Cairo', 'London', '2022-06-22', '8800'),
('CA0001PA', 'Cairo', 'Paris', '2022-06-23', '8700'),
('CA0002LO', 'Cairo', 'London', '2022-06-25', '7000'),
('CA0003LO', 'Cairo', 'London', '2022-06-27', '6500'),
('LO0001CA', 'London', 'Cairo', '2022-06-30', '5500'),
('LO0001PA', 'London', 'Paris', '2022-06-29', '3500'),
('LO0004CA', 'London', 'Cairo', '2022-06-29', '5500'),
('PA0001CA', 'Paris', 'Cairo', '2022-06-28', '4400'),
('PA00031LO', 'Paris', 'London', '2022-06-24', '8800');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `natid` varchar(14) NOT NULL,
  `phone_num` varchar(11) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `postal_code` varchar(7) DEFAULT NULL,
  `country` varchar(30) NOT NULL,
  `nationality` varchar(30) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'user',
  `cs_status` tinyint(1) DEFAULT NULL,
  `cs_comment` varchar(100) NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Name`, `Email`, `Password`, `natid`, `phone_num`, `address`, `postal_code`, `country`, `nationality`, `role`, `cs_status`, `cs_comment`, `status`, `date_time`) VALUES
('name cs', 'cs@gmail.com', '202cb962ac59075b964b07152d234b70', '0001', NULL, NULL, NULL, '', '', 'cs', NULL, '', NULL, '2022-06-12 16:42:50'),
('kevin emad', 'kevin@gmail.com', '900150983cd24fb0d6963f7d28e17f72', '8888', '0123455677', 'kevin city', '8877', 'usa', 'eg', 'user', NULL, '', NULL, '2022-06-13 06:13:46'),
('mamdoh', 'mamdoh@gmail.com', 'b706835de79a2b4e80506f582af3676a', '0003', NULL, NULL, NULL, '', '', 'user', NULL, '', NULL, '2022-06-13 06:16:09'),
('Mohammed Nasr', 'nasr@gmail.com', '202cb962ac59075b964b07152d234b70', '0007', '01203559189', 'Obour City', '9999', 'Egypt', 'egyptian', 'user', NULL, '', NULL, '2022-06-13 06:02:50'),
('cs user from qc', 'newcs@gmail.com', '123', '00123123', '01203559189', 'addressidk', '9999222', 'paris', 'german', 'cs', 0, '', NULL, '2022-06-13 06:06:32'),
('name qc', 'qc@gmail.com', '202cb962ac59075b964b07152d234b70', '0000', NULL, NULL, NULL, '', '', 'qc', NULL, '', NULL, '2022-06-12 16:40:04'),
('samoooool', 'samol@gmail.com', 'e99a18c428cb38d5f260853678922e03', '000882', NULL, NULL, NULL, '', '', 'user', NULL, '', NULL, '2022-06-13 06:16:49'),
('yossef', 'yossef@gmail.com', 'eaf1f86c02f9d16ebcaa853220c122e5', '00123321', NULL, NULL, NULL, '', '', 'user', NULL, '', NULL, '2022-06-13 06:34:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `family`
--
ALTER TABLE `family`
  ADD PRIMARY KEY (`guardian_natid`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`rev_num`);

--
-- Indexes for table `trips`
--
ALTER TABLE `trips`
  ADD PRIMARY KEY (`FlightCode`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Email`),
  ADD UNIQUE KEY `NatID` (`natid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `rev_num` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=424018;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
