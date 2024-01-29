-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2024 at 10:22 AM
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
-- Database: `mockelngymnasie`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblcomp`
--

CREATE TABLE `tblcomp` (
  `compid` int(11) NOT NULL,
  `compname` varchar(200) NOT NULL,
  `totsteps` int(11) NOT NULL DEFAULT 0,
  `startdate` date NOT NULL,
  `stopdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcomp`
--

INSERT INTO `tblcomp` (`compid`, `compname`, `totsteps`, `startdate`, `stopdate`) VALUES
(1, 'Test', 1367, '2024-01-11', '2029-01-10'),
(3, 'Klutt', 1870, '2024-01-03', '2024-01-25');

-- --------------------------------------------------------

--
-- Table structure for table `tblsteps`
--

CREATE TABLE `tblsteps` (
  `stepsid` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `comp` int(11) NOT NULL,
  `team` int(11) NOT NULL,
  `steps` int(11) NOT NULL,
  `posted` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblsteps`
--

INSERT INTO `tblsteps` (`stepsid`, `user`, `comp`, `team`, `steps`, `posted`) VALUES
(1, 1, 3, 0, 2345, '2024-01-11 21:55:29'),
(2, 6, 1, 0, 1200, '2024-01-14 03:20:37'),
(3, 8, 1, 8, 122, '2024-01-14 03:35:23'),
(4, 4, 3, 3, 1852, '2024-01-14 22:37:44'),
(5, 4, 1, 0, 1287, '2024-01-14 22:38:07'),
(6, 1, 3, 0, 1523, '2024-01-17 19:58:45'),
(7, 69, 3, 3, 18, '2024-01-19 09:39:23'),
(8, 69, 3, 0, 785, '2024-01-19 09:39:33'),
(9, 69, 3, 0, 362, '2024-01-19 09:39:40'),
(10, 69, 3, 0, 254, '2024-01-19 09:39:51'),
(11, 69, 3, 0, 555, '2024-01-19 09:40:00'),
(12, 69, 3, 0, 65, '2024-01-19 09:40:12'),
(13, 70, 1, 0, 18, '2024-01-22 11:49:07'),
(14, 1, 1, 8, 1245, '2024-01-25 09:32:43');

-- --------------------------------------------------------

--
-- Table structure for table `tblteam`
--

CREATE TABLE `tblteam` (
  `teamid` int(11) NOT NULL,
  `teamname` varchar(200) NOT NULL,
  `teamleader` int(11) DEFAULT NULL,
  `wins` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblteam`
--

INSERT INTO `tblteam` (`teamid`, `teamname`, `teamleader`, `wins`) VALUES
(3, 'Wolfpack', 4, 3),
(8, 'Berts Bananer', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `userid` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `team` int(11) DEFAULT NULL,
  `userlevel` int(11) NOT NULL DEFAULT 10
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`userid`, `username`, `password`, `name`, `team`, `userlevel`) VALUES
(1, 'jlc', '1a1dc91c907325c69271ddf0c944bc72', 'Charlie Jarl', 8, 124),
(4, 'mao', '1a1dc91c907325c69271ddf0c944bc72', 'Ola Magnell', 35, 10),
(5, 'kab', '1a1dc91c907325c69271ddf0c944bc72', 'Bert Karlsson', 35, 10),
(8, 'btc', 'dc647eb65e6711e155375218212b3964', 'Bertolomeus Crenshaw', 35, 10),
(69, 'ola', '75b71aa6842e450f12aca00fdf54c51d', 'Ola Nilsson', 35, 10),
(70, 'regis', '37a589be66ea07f71b0696e6df282647', 'Reginald Swatteam', 8, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblcomp`
--
ALTER TABLE `tblcomp`
  ADD PRIMARY KEY (`compid`);

--
-- Indexes for table `tblsteps`
--
ALTER TABLE `tblsteps`
  ADD PRIMARY KEY (`stepsid`),
  ADD KEY `user` (`user`,`comp`);

--
-- Indexes for table `tblteam`
--
ALTER TABLE `tblteam`
  ADD PRIMARY KEY (`teamid`),
  ADD KEY `teamleader` (`teamleader`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`userid`),
  ADD KEY `team` (`team`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblcomp`
--
ALTER TABLE `tblcomp`
  MODIFY `compid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblsteps`
--
ALTER TABLE `tblsteps`
  MODIFY `stepsid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tblteam`
--
ALTER TABLE `tblteam`
  MODIFY `teamid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
