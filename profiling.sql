-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2018 at 12:13 PM
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
-- Database: `profiling`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_addprofile`
--

CREATE TABLE `tbl_addprofile` (
  `profileID` int(20) NOT NULL,
  `isactive` tinyint(1) NOT NULL DEFAULT '1',
  `fname` varchar(50) CHARACTER SET utf8 NOT NULL,
  `lname` varchar(50) CHARACTER SET utf8 NOT NULL,
  `mname` varchar(50) CHARACTER SET utf8 NOT NULL,
  `extension` varchar(50) NOT NULL,
  `birth` date NOT NULL,
  `gender` enum('Male','Female',',') DEFAULT NULL,
  `pob` varchar(50) NOT NULL,
  `civilstatus` enum('Single','Married','Widow','Widower','Separated',',') NOT NULL,
  `profession` varchar(50) NOT NULL,
  `mother` varchar(50) NOT NULL,
  `occupationm` varchar(50) NOT NULL,
  `father` varchar(50) NOT NULL,
  `occupationf` varchar(50) NOT NULL,
  `presadd` varchar(50) NOT NULL,
  `nos` int(11) NOT NULL,
  `noc` int(11) NOT NULL,
  `spouse` varchar(50) NOT NULL,
  `bhw` varchar(50) NOT NULL,
  `vin` varchar(50) NOT NULL,
  `comstat` varchar(15) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_addprofile`
--

INSERT INTO `tbl_addprofile` (`profileID`, `isactive`, `fname`, `lname`, `mname`, `extension`, `birth`, `gender`, `pob`, `civilstatus`, `profession`, `mother`, `occupationm`, `father`, `occupationf`, `presadd`, `nos`, `noc`, `spouse`, `bhw`, `vin`, `comstat`, `date`) VALUES
(511, 1, 'Arexa Belle', 'Tabile', 'Demata', 'N/a', '2015-06-15', 'Female', 'Cagayan De Oro', 'Single', 'None', 'Annabelle Demata Tabile', 'Teacher', 'None', 'None', 'Imburnal, Camaman-an', 0, 0, 'N/a', 'Helen A. Tanggan', 'N/A', 'Registered', '2018-05-17 07:54:43'),
(1279, 1, 'Dannilyn', 'Labare', 'Labuanan', 'N/a', '1992-06-21', 'Female', 'Bukidnon', 'Single', 'Housekeeper', 'N/a', 'N/a', 'Housekeeper', 'Housekeeper', 'Bolonsiri, Paglantao, Camaman-an', 0, 0, 'N/a', 'Gloria G. Diamante', 'N/A', 'Registered', '2018-05-17 20:06:26'),
(1280, 1, 'Beehive', 'Beehive', 'Beehive', 'N/a', '2018-12-31', 'Male', 'Beehive', 'Single', 'N/a', 'N/a', 'N/a', 'N/a', 'N/a', 'N/a', 0, 0, 'N/a', 'Beehive', 'N/A', 'Unregistered', '2018-05-17 20:54:14'),
(1281, 1, 'Beehive', 'Beehive', 'Beehive', 'N/a', '2018-12-31', 'Male', 'Beehive', 'Single', 'N/a', 'N/a', 'N/a', 'N/a', 'N/a', 'N/a', 0, 0, 'N/a', 'Beehive', 'N/A', 'Registered', '2018-05-17 21:04:24'),
(1283, 1, 'George', 'Reca', 'Martin', 'Jr', '2018-06-16', 'Male', 'United States Of America', 'Married', 'N/a', 'N/a', 'N/a', 'N/a', 'N/a', 'N/a', 4, 0, 'Gregory Binay', 'Chaprel John Villegas', 'N/A', 'Unregistered', '2018-06-16 07:46:26'),
(1284, 1, 'Chaprel John', 'Villegas', 'Migalang', 'N/a', '2018-01-01', 'Male', 'Asdfasdfsadf', 'Single', 'N/a', 'N/a', 'N/a', 'N/a', 'N/a', 'N/a', 0, 0, 'N/a', 'Sdfsdfds', 'N/A', 'Unregistered', '2018-06-16 08:56:56'),
(1285, 1, 'Chaprel John', 'Villega', 'Migalang', 'N/a', '2018-01-01', 'Male', 'Cagayand De Oro', 'Single', 'N/a', 'N/a', 'N/a', 'N/a', 'N/a', 'N/a', 0, 0, 'N/a', 'Nancy Binay', 'N/A', 'Registered', '2018-06-16 09:02:42'),
(1286, 1, 'Chaprel John', 'Villegas', 'Migalang', 'N/a', '2018-01-01', 'Male', 'Alkdfjasldfjslk', 'Single', 'N/a', 'N/a', 'N/a', 'N/a', 'N/a', 'N/a', 0, 0, 'N/a', 'Sjfklajsdlfk', 'N/A', 'Registered', '2018-06-16 09:20:36');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_address`
--

CREATE TABLE `tbl_address` (
  `addressID` int(20) NOT NULL,
  `profileID` int(20) NOT NULL,
  `region` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `sitio` varchar(255) NOT NULL,
  `brgy` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_address`
--

INSERT INTO `tbl_address` (`addressID`, `profileID`, `region`, `province`, `city`, `sitio`, `brgy`) VALUES
(2, 511, 'REGION X', 'MISAMIS ORIENTAL', 'CAGAYAN DE ORO CITY', 'BOLONSORI', 'CAMAMAN-AN'),
(5, 1279, 'REGION X', 'MISAMIS ORIENTAL', 'CAGAYAN DE ORO CITY', 'TRAXIKAD', 'CAMAMAN-AN'),
(6, 1280, 'REGION X', 'MISAMIS ORIENTAL', 'CAGAYAN DE ORO CITY', 'BEEHIVE', 'CAMAMAN-AN'),
(7, 1281, 'REGION X', 'MISAMIS ORIENTAL', 'CAGAYAN DE ORO CITY', 'BEEHIVE', 'CAMAMAN-AN'),
(9, 1283, 'REGION X', 'MISAMIS ORIENTAL', 'CAGAYAN DE ORO CITY', 'CAMAMAN-AN', 'CAMAMAN-AN'),
(10, 1284, 'REGION X', 'MISAMIS ORIENTAL', 'CAGAYAN DE ORO CITY', 'LUMBIA', 'CAMAMAN-AN'),
(11, 1285, 'REGION X', 'MISAMIS ORIENTAL', 'CAGAYAN DE ORO CITY', 'LUMBIA', 'CAMAMAN-AN'),
(12, 1286, 'REGION X', 'MISAMIS ORIENTAL', 'CAGAYAN DE ORO CITY', 'LUMBIA', 'CAMAMAN-AN');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cases`
--

CREATE TABLE `tbl_cases` (
  `caseID` int(20) NOT NULL,
  `profileID` int(20) NOT NULL,
  `caseTitle` varchar(255) NOT NULL,
  `byWhome` varchar(255) NOT NULL,
  `lupon` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_cases`
--

INSERT INTO `tbl_cases` (`caseID`, `profileID`, `caseTitle`, `byWhome`, `lupon`, `status`, `date`, `description`) VALUES
(1, 1279, 'Nangawat', 'Chaprel John Villegas', 'James Gaid', 'Served', '2018-05-18', 'Nangawat ug manok sa silingan ug iya kining gi limod bisan klaro pa kaayu ang balahibo sa iyang baba.\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employees`
--

CREATE TABLE `tbl_employees` (
  `empID` int(10) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL DEFAULT '123',
  `type` varchar(255) NOT NULL,
  `isactive` int(11) NOT NULL DEFAULT '1',
  `phone` varchar(15) NOT NULL,
  `sessionKey` varchar(255) DEFAULT NULL,
  `profile` blob NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_employees`
--

INSERT INTO `tbl_employees` (`empID`, `fname`, `lname`, `mname`, `username`, `password`, `type`, `isactive`, `phone`, `sessionKey`, `profile`, `date`) VALUES
(10000, 'Chaprel John', 'Villegas', 'Migalang', 'mavis', '1619d7adc23f4f633f11014d2f22b7d8', 'Admin', 1, '09755345781', '84f8a9d6b6c817a6dc8c51f29ecd6514', '', '2018-06-20 08:00:42'),
(10001, 'John', 'John', 'Joh', 'johh', '6116afedcb0bc31083935c1c262ff4c9', 'Employee', 1, '098989080980980', NULL, '', '2018-03-21 08:58:32'),
(10002, 'Kodiline', 'Band', 'Ride', 'kodaline', '6116afedcb0bc31083935c1c262ff4c9', 'Employee', 1, '09059552941', NULL, '', '2018-05-17 19:50:49'),
(10003, 'Mitsuha', 'Taki', 'Kimi', 'mitsuha', '6116afedcb0bc31083935c1c262ff4c9', 'Employee', 1, '090032420302', NULL, '', '2018-06-16 07:38:18'),
(10004, 'Google', 'Chrome', 'Google', 'iamgoogle', '6116afedcb0bc31083935c1c262ff4c9', 'Admin', 1, '09234092340', NULL, '', '2018-06-20 08:16:13');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_fmember`
--

CREATE TABLE `tbl_fmember` (
  `fmemberID` int(20) NOT NULL,
  `profileID` int(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `relation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_fmember`
--

INSERT INTO `tbl_fmember` (`fmemberID`, `profileID`, `name`, `relation`) VALUES
(7, 1279, 'Chaprel John Villegas', 'brother'),
(14, 511, 'Sdfsdf', 'gradma'),
(18, 1280, 'Chaprel John Villegas', 'sister'),
(19, 1281, 'Chaprel John Villegas', 'gradson'),
(20, 1283, 'George Binay', 'father'),
(21, 1283, 'Gregoria Binay', 'daughter'),
(22, 1285, 'Georgy', 'son');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_addprofile`
--
ALTER TABLE `tbl_addprofile`
  ADD PRIMARY KEY (`profileID`);

--
-- Indexes for table `tbl_address`
--
ALTER TABLE `tbl_address`
  ADD PRIMARY KEY (`addressID`);

--
-- Indexes for table `tbl_cases`
--
ALTER TABLE `tbl_cases`
  ADD PRIMARY KEY (`caseID`);

--
-- Indexes for table `tbl_employees`
--
ALTER TABLE `tbl_employees`
  ADD PRIMARY KEY (`empID`);

--
-- Indexes for table `tbl_fmember`
--
ALTER TABLE `tbl_fmember`
  ADD PRIMARY KEY (`fmemberID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_addprofile`
--
ALTER TABLE `tbl_addprofile`
  MODIFY `profileID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1287;

--
-- AUTO_INCREMENT for table `tbl_address`
--
ALTER TABLE `tbl_address`
  MODIFY `addressID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_cases`
--
ALTER TABLE `tbl_cases`
  MODIFY `caseID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_employees`
--
ALTER TABLE `tbl_employees`
  MODIFY `empID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10005;

--
-- AUTO_INCREMENT for table `tbl_fmember`
--
ALTER TABLE `tbl_fmember`
  MODIFY `fmemberID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
