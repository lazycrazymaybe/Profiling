-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2018 at 03:35 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `feedpro`
--
CREATE DATABASE IF NOT EXISTS `feedpro` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `feedpro`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feeds`
--

CREATE TABLE `tbl_feeds` (
  `feedID` int(12) NOT NULL,
  `feedName` varchar(50) NOT NULL,
  `crudeProtein` float NOT NULL,
  `crudeFiber` float NOT NULL,
  `crudeFat` float NOT NULL,
  `Calcium` float NOT NULL,
  `Moisture` float NOT NULL,
  `Phosphorous` float NOT NULL,
  `maximumInclusion` float NOT NULL,
  `costPerKilo` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedsused`
--

CREATE TABLE `tbl_feedsused` (
  `feedsUsedID` int(12) DEFAULT NULL,
  `feedID` int(12) NOT NULL,
  `logID` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedtime`
--

CREATE TABLE `tbl_feedtime` (
  `feedTimeID` int(12) NOT NULL,
  `userID` int(12) NOT NULL,
  `time` time NOT NULL,
  `description` varchar(255) NOT NULL,
  `isActive` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_feedtime`
--

INSERT INTO `tbl_feedtime` (`feedTimeID`, `userID`, `time`, `description`, `isActive`) VALUES
(16, 5, '05:14:00', 'Feed Time', 1),
(17, 5, '11:13:00', 'Feed Time', 1),
(18, 5, '00:13:00', 'Feed Time', 0),
(19, 5, '05:19:00', 'Feed Time', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_logs`
--

CREATE TABLE `tbl_logs` (
  `logID` int(12) NOT NULL,
  `userID` int(12) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `weight` float NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_logs`
--

INSERT INTO `tbl_logs` (`logID`, `userID`, `date`, `weight`, `comment`) VALUES
(1, 4, '2018-01-10 05:31:45', 23.6, 'I dunno what to say\r\n'),
(2, 5, '2018-01-10 05:32:18', 21, 'Ill take this chance and just hold me by.'),
(3, 4, '2018-01-14 16:47:50', 22, 'Hashimite miyoka.'),
(4, 5, '2018-01-14 17:32:37', 21, 'Google Map\r\n'),
(5, 9, '2018-01-14 17:32:37', 20, 'Mozilla Map\r\n'),
(6, 12, '2018-01-14 17:36:45', 23, 'Micheal Learns to rock'),
(7, 7, '2018-01-14 17:36:45', 16.3, 'When you say nothing at all'),
(8, 4, '2018-01-14 17:38:41', 17, 'Lorem Epsum Dolor'),
(9, 5, '2018-01-14 17:38:41', 18, 'Samoka ani oi katolgon na kai ko'),
(10, 10, '2018-01-14 17:38:41', 10, 'I dunno how many times does this music loops over'),
(11, 1, '2018-01-14 17:38:41', 22, 'Browse,Structure,SQL,Search,Inser'),
(12, 11, '2018-01-14 17:38:41', 25, 'Loko to ahh'),
(13, 6, '2018-01-14 17:39:14', 34, 'asdf  asdf asdf'),
(14, 13, '2018-01-14 17:39:14', 31, 'asd asdf asdf');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `userID` int(12) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `isActive` int(2) NOT NULL,
  `userType` varchar(10) NOT NULL,
  `img` text,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`userID`, `fname`, `lname`, `username`, `password`, `isActive`, `userType`, `img`, `date`) VALUES
(4, 'Chaprel john', 'Villegas', 'Mavis', 'password', 1, 'User', '', '2018-01-14 20:06:21'),
(5, 'Christopher', 'Columbus', 'Columbus', 'password', 1, 'Admin', '', '2018-01-14 22:12:12'),
(6, 'Lucas', 'Lambert', 'Lucas', '123', 1, 'User', '', '2018-01-14 03:02:10'),
(7, 'Mitsuha', 'Yuki', 'mitsuha', 'password', 1, 'User', '', '2017-12-19 20:39:04'),
(8, 'Natasha', 'Tracy', 'natasha', 'password', 1, 'User', '', '2017-12-21 02:04:44'),
(9, 'Milbert', 'Armstrong', 'armstrong', 'password', 1, 'User', '', '2017-12-21 00:44:04'),
(10, 'Dreadful', 'Darknes', 'dreadful', 'password', 1, 'Admin', '1908345367.jpg', '2018-01-10 04:39:52'),
(11, 'Kirigaki', 'San', 'kirigaki', 'password', 1, 'User', '', '2018-01-14 14:57:39'),
(12, 'Ryukos', 'Sama', 'sama', '123', 0, 'User', '', '2018-01-15 05:43:49'),
(13, 'Harry', 'Potter', 'harry', 'password', 1, 'User', '', '2018-01-15 05:43:40'),
(47, 'Asdfasdf', 'Asdfasdf', 'tydingss', '123', 0, 'Admin', 'http://localhost/feedpro/assets/img/default.png', '2018-01-17 12:59:27'),
(48, 'Asdfasdf', 'Asdfasdf', 'asdfssdf', 'asdfasdfas', 1, 'User', 'http://localhost/feedpro/assets/img/default.png', '2018-01-17 13:06:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_feeds`
--
ALTER TABLE `tbl_feeds`
  ADD PRIMARY KEY (`feedID`);

--
-- Indexes for table `tbl_feedtime`
--
ALTER TABLE `tbl_feedtime`
  ADD PRIMARY KEY (`feedTimeID`);

--
-- Indexes for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  ADD PRIMARY KEY (`logID`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_feeds`
--
ALTER TABLE `tbl_feeds`
  MODIFY `feedID` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_feedtime`
--
ALTER TABLE `tbl_feedtime`
  MODIFY `feedTimeID` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  MODIFY `logID` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `userID` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
