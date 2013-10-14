-- phpMyAdmin SQL Dump
-- version 3.5.8.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 14, 2013 at 03:11 PM
-- Server version: 5.5.32-0ubuntu0.13.04.1
-- PHP Version: 5.4.9-4ubuntu2.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nordic`
--

-- --------------------------------------------------------

--
-- Table structure for table `dates`
--

CREATE TABLE IF NOT EXISTS `dates` (
  `wdate` date DEFAULT NULL,
  `id` int(11) DEFAULT NULL,
  `unqid` int(11) NOT NULL,
  `ids` varchar(100) DEFAULT NULL,
  `walkercount` int(11) DEFAULT NULL,
  PRIMARY KEY (`unqid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(5) NOT NULL,
  `fname` varchar(20) DEFAULT NULL,
  `mnames` varchar(60) DEFAULT NULL,
  `sname` varchar(50) DEFAULT NULL,
  `address1` varchar(50) DEFAULT NULL,
  `address2` varchar(50) DEFAULT NULL,
  `address3` varchar(50) DEFAULT NULL,
  `town` varchar(20) DEFAULT NULL,
  `postcode` varchar(10) DEFAULT NULL,
  `hsform` enum('y','n') DEFAULT NULL,
  `workshopcomp` date DEFAULT NULL,
  `credits` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `walks`
--

CREATE TABLE IF NOT EXISTS `walks` (
  `id` int(11) NOT NULL,
  `location` varchar(50) DEFAULT NULL,
  `meet` varchar(50) DEFAULT NULL,
  `directions` text,
  `details` text,
  `dogs` enum('y','n','d') DEFAULT NULL,
  `wtime` varchar(10) DEFAULT NULL,
  `distance` varchar(10) DEFAULT NULL,
  `imageurl` varchar(100) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `walks`
--

INSERT INTO `walks` (`id`, `location`, `meet`, `directions`, `details`, `dogs`, `wtime`, `distance`, `imageurl`, `url`) VALUES
(1, 'Chapel Porth', 'National Trust car park at Chapel Porth.', 'As you go into St Agnes turn left on the mini round about from here follow the brown signs to Chapel Porth.', 'This is a real feast for the eyes with stunning views and lots of fresh air.  This walk may have to change venue if there is a strong offshore wind or if the weather is particularly bad. We usually relocate to Tehidy Woods. This walk is along the cliffs on the South West Coastal Path and involves some hills.', 'n', '2hrs', '*** miles', 'chapelporth.jpg', 'any'),
(3, 'Godrevy', 'National Trust Car Park at Godrevy cafe car Park', 'Just off B3301, North of Gwithian village. Godrevy Towans, Gwithian, Hayle TR27 5ED, United Kingdom', 'This is an energetic walk either walking across the Towans and back along the beach or along the beach then back over the Towans depending on the tides.  The beach is used by horses, dogs and also life guard vehicles.', 'y', '2hrs', '*** miles', 'godrevy.jpg', 'any');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
