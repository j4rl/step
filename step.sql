-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 12 jan 2024 kl 00:20
-- Serverversion: 10.4.32-MariaDB
-- PHP-version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `step`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `tblcomp`
--

CREATE TABLE `tblcomp` (
  `id` int(11) NOT NULL,
  `compname` varchar(200) NOT NULL,
  `startdate` date NOT NULL,
  `stopdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `tblcomp`
--

INSERT INTO `tblcomp` (`id`, `compname`, `startdate`, `stopdate`) VALUES
(1, 'Test', '2024-01-11', '2029-01-10');

-- --------------------------------------------------------

--
-- Tabellstruktur `tblsteps`
--

CREATE TABLE `tblsteps` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `steps` int(11) NOT NULL,
  `posted` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `tblsteps`
--

INSERT INTO `tblsteps` (`id`, `userid`, `steps`, `posted`) VALUES
(1, 1, 2345, '2024-01-11 21:55:29');

-- --------------------------------------------------------

--
-- Tabellstruktur `tblteam`
--

CREATE TABLE `tblteam` (
  `id` int(11) NOT NULL,
  `teamname` varchar(200) NOT NULL,
  `teamleader` int(11) NOT NULL,
  `wins` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `tblteam`
--

INSERT INTO `tblteam` (`id`, `teamname`, `teamleader`, `wins`) VALUES
(3, 'Wolfpack', 1, NULL);

-- --------------------------------------------------------

--
-- Tabellstruktur `tbluser`
--

CREATE TABLE `tbluser` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `team` int(11) DEFAULT NULL,
  `userlevel` int(11) NOT NULL DEFAULT 10
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumpning av Data i tabell `tbluser`
--

INSERT INTO `tbluser` (`id`, `username`, `password`, `name`, `team`, `userlevel`) VALUES
(1, 'jlc', '1a1dc91c907325c69271ddf0c944bc72', 'Charlie Jarl', 3, 100),
(2, 'bak', '1a1dc91c907325c69271ddf0c944bc72', 'Bengt Karlsson', 0, 10);

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `tblcomp`
--
ALTER TABLE `tblcomp`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `tblsteps`
--
ALTER TABLE `tblsteps`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `tblteam`
--
ALTER TABLE `tblteam`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `tblcomp`
--
ALTER TABLE `tblcomp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT för tabell `tblsteps`
--
ALTER TABLE `tblsteps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT för tabell `tblteam`
--
ALTER TABLE `tblteam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT för tabell `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
