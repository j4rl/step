-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2024 at 06:08 PM
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
-- Database: `step`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblcomp`
--

CREATE TABLE `tblcomp` (
  `compid` int(11) NOT NULL,
  `compname` varchar(200) NOT NULL,
  `startdate` date NOT NULL,
  `stopdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcomp`
--

INSERT INTO `tblcomp` (`compid`, `compname`, `startdate`, `stopdate`) VALUES
(1, 'Test', '2024-01-11', '2029-01-10'),
(3, 'Klutt', '2024-01-25', '2024-01-25');

-- --------------------------------------------------------

--
-- Table structure for table `tblsteps`
--

CREATE TABLE `tblsteps` (
  `stepsid` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `comp` int(11) NOT NULL,
  `steps` int(11) NOT NULL,
  `posted` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblsteps`
--

INSERT INTO `tblsteps` (`stepsid`, `user`, `comp`, `steps`, `posted`) VALUES
(1, 1, 0, 2345, '2024-01-11 21:55:29'),
(2, 0, 1, 1200, '2024-01-14 03:20:37'),
(3, 0, 1, 122, '2024-01-14 03:35:23');

-- --------------------------------------------------------

--
-- Table structure for table `tblteam`
--

CREATE TABLE `tblteam` (
  `teamid` int(11) NOT NULL,
  `teamname` varchar(200) NOT NULL,
  `teamleader` int(11) NOT NULL,
  `wins` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblteam`
--

INSERT INTO `tblteam` (`teamid`, `teamname`, `teamleader`, `wins`) VALUES
(3, 'Wolfpack', 4, 3),
(4, 'Gurkan', 5, NULL),
(5, 'Fjärtisarna', 1, NULL);

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
(1, 'jlc', '1a1dc91c907325c69271ddf0c944bc72', 'Charlie Jarl', 3, 124),
(4, 'mao', '1a1dc91c907325c69271ddf0c944bc72', 'Ola Magnell', NULL, 10),
(5, 'kab', '1a1dc91c907325c69271ddf0c944bc72', 'Bert Karlsson', NULL, 10),
(8, 'btc', 'dc647eb65e6711e155375218212b3964', 'Bertolomeus Crenshaw', NULL, 10);

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
  MODIFY `stepsid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblteam`
--
ALTER TABLE `tblteam`
  MODIFY `teamid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
