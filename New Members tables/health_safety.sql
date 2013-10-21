-- phpMyAdmin SQL Dump
-- version 3.5.8.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 21, 2013 at 10:03 AM
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
-- Table structure for table `health_safety`
--

CREATE TABLE IF NOT EXISTS `health_safety` (
  `member_id` int(4) DEFAULT NULL,
  `hs_status` int(1) DEFAULT NULL,
  `approving_admin` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `health_safety`
--

INSERT INTO `health_safety` (`member_id`, `hs_status`, `approving_admin`) VALUES
(2315, 2, 'Kelly '),
(2316, 1, 'na'),
(2317, 0, 'Ben '),
(2318, 1, 'Kelly '),
(2319, 2, 'Kelly '),
(2320, 1, 'Kelly '),
(2321, 2, 'Kelly '),
(2322, 1, 'Ben '),
(2323, 2, 'Kelly '),
(2324, 2, 'Ben '),
(2325, 2, 'Ben '),
(2326, 2, 'Ben '),
(2327, 0, 'Ben '),
(2328, 1, 'Kelly '),
(2329, 0, 'na'),
(2330, 0, 'na'),
(2331, 1, 'na'),
(2332, 1, 'na'),
(2333, 2, 'Sarah '),
(2334, 0, 'Ben '),
(2335, 2, 'Sarah '),
(2336, 2, 'Sarah '),
(2337, 0, 'Sarah '),
(2338, 0, 'Sarah '),
(2339, 0, 'na'),
(2340, 1, 'Ben '),
(2341, 2, 'na'),
(2342, 0, 'Sarah '),
(2343, 0, 'Sarah '),
(2344, 2, 'Ben '),
(2345, 2, 'Kelly '),
(2346, 2, 'na'),
(2347, 1, 'Kelly '),
(2348, 2, 'Sarah '),
(2349, 1, 'Sarah '),
(2350, 1, 'Sarah '),
(2351, 1, 'Kelly '),
(2352, 0, 'Ben '),
(2353, 2, 'Ben '),
(2354, 1, 'na'),
(2355, 2, 'Sarah '),
(2356, 2, 'Sarah '),
(2357, 0, 'Sarah '),
(2358, 0, 'na'),
(2359, 0, 'na'),
(2360, 1, 'na'),
(2361, 0, 'na'),
(2362, 1, 'Ben '),
(2363, 2, 'Kelly '),
(2364, 0, 'Ben '),
(2365, 1, 'na'),
(2366, 2, 'Ben '),
(2367, 2, 'Sarah '),
(2368, 2, 'Sarah '),
(2369, 2, 'Ben '),
(2370, 0, 'Sarah '),
(2371, 0, 'na'),
(2372, 2, 'Kelly '),
(2373, 0, 'Ben '),
(2374, 1, 'na'),
(2375, 1, 'Ben '),
(2376, 0, 'Ben '),
(2377, 0, 'na'),
(2378, 0, 'Ben '),
(2379, 0, 'Sarah '),
(2380, 1, 'na'),
(2381, 1, 'Sarah '),
(2382, 1, 'Sarah '),
(2383, 2, 'Kelly '),
(2384, 1, 'na'),
(2385, 2, 'Kelly '),
(2386, 2, 'na'),
(2387, 0, 'Kelly '),
(2388, 0, 'Kelly '),
(2389, 2, 'na'),
(2390, 0, 'Sarah '),
(2391, 1, 'na'),
(2392, 2, 'Kelly '),
(2393, 1, 'Kelly '),
(2394, 1, 'na'),
(2395, 0, 'na'),
(2396, 0, 'Ben '),
(2397, 0, 'Kelly '),
(2398, 0, 'na'),
(2399, 0, 'Ben '),
(2400, 2, 'Ben '),
(2401, 0, 'Kelly '),
(2402, 0, 'na'),
(2403, 2, 'Ben '),
(2404, 1, 'na'),
(2405, 1, 'Sarah '),
(2406, 0, 'Kelly '),
(2407, 2, 'Ben '),
(2408, 2, 'Kelly '),
(2409, 1, 'Sarah '),
(2410, 2, 'na'),
(2411, 1, 'na'),
(2412, 2, 'Kelly '),
(2413, 1, 'Ben '),
(2414, 0, 'Sarah ');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
