-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2018 at 06:36 AM
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
(1282, 1, 'Fgfgfgfg', 'Fgfgfg', 'Fgfgfgf', 'N/a', '2018-05-19', 'Female', 'Fgfgfgfg', 'Married', 'N/a', 'N/a', 'N/a', 'N/a', 'N/a', 'N/a', 0, 0, 'N/a', 'Chaprel John Villegas', 'N/A', 'Registered', '2018-05-18 18:13:57');

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
(8, 1282, 'REGION X', 'MISAMIS ORIENTAL', 'CAGAYAN DE ORO CITY', 'FGFGFGFG', 'CAMAMAN-AN');

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
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_employees`
--

INSERT INTO `tbl_employees` (`empID`, `fname`, `lname`, `mname`, `username`, `password`, `type`, `isactive`, `phone`, `date`) VALUES
(10000, 'Chaprel John', 'Villegas', 'Migalang', 'mavis', '1619d7adc23f4f633f11014d2f22b7d8', 'Admin', 1, '09755345781', '2018-03-21 04:40:57'),
(10001, 'John', 'John', 'Joh', 'johh', '6116afedcb0bc31083935c1c262ff4c9', 'Employee', 0, '098989080980980', '2018-03-21 08:58:32'),
(10002, 'Kodiline', 'Band', 'Ride', 'kodaline', '6116afedcb0bc31083935c1c262ff4c9', 'Employee', 1, '09059552941', '2018-05-17 19:50:49');

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
(18, 1280, 'Chaprel John Villegas', 'sister');

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
  MODIFY `profileID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1283;

--
-- AUTO_INCREMENT for table `tbl_address`
--
ALTER TABLE `tbl_address`
  MODIFY `addressID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_cases`
--
ALTER TABLE `tbl_cases`
  MODIFY `caseID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_employees`
--
ALTER TABLE `tbl_employees`
  MODIFY `empID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10003;

--
-- AUTO_INCREMENT for table `tbl_fmember`
--
ALTER TABLE `tbl_fmember`
  MODIFY `fmemberID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
