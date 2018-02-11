-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 11, 2018 at 04:22 PM
-- Server version: 5.7.21-0ubuntu0.16.04.1
-- PHP Version: 7.0.27-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `magazines`
--

-- --------------------------------------------------------

--
-- Table structure for table `magazines`
--

CREATE TABLE `magazines` (
  `id` bigint(20) NOT NULL,
  `title` text COLLATE utf8_bin NOT NULL,
  `image` varchar(256) COLLATE utf8_bin NOT NULL,
  `issue` varchar(32) COLLATE utf8_bin NOT NULL,
  `publisher` varchar(256) COLLATE utf8_bin NOT NULL,
  `category` text COLLATE utf8_bin NOT NULL,
  `tags` varchar(256) COLLATE utf8_bin NOT NULL,
  `comments` longtext COLLATE utf8_bin NOT NULL,
  `ti` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `magazines`
--
ALTER TABLE `magazines`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `magazines`
--
ALTER TABLE `magazines`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
