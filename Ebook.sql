-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 28, 2022 at 05:29 PM
-- Server version: 10.3.29-MariaDB-0ubuntu0.20.04.1
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Ebook`
--

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(3) NOT NULL,
  `fullname` varchar(75) NOT NULL,
  `user` varchar(75) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `fullname`, `user`, `email`, `password`) VALUES
(9, 'Test user', 'bhargav', 'test@gmail.com', 'test'),
(11, 'Test user', 'test1', 'test1@gmail.com', 'testuser'),
(12, 'Deep Mangi', 'deep', 'deep@gmail.com', 'deepmangi'),
(13, 'Nimisha Dama', 'nimu', 'nimi@gmail.com', 'nimu'),
(14, 'Bhargav A Javia', 'bpatel', 'patel28@gmail.com', 'bhargav'),
(15, 'Janak Solanki', 'janak', 'janak@gmail.com', 'janak'),
(16, 'khushi', 'khushi', 'k@gmail.com', 'khushi'),
(17, 'Bhargav A Javia', 'bpatel', 'bhargav28@gmail.com', 'bhargav'),
(18, 'demo', 'demo user', 'demo@gmail.com', 'demouser'),
(19, 'Demo 2', 'demo user 2', 'demo2@gmail.com', 'demo2'),
(20, 'demo 3', 'demouser3', 'demo3@gmail.com', 'deom');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
