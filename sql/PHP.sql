-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 29, 2025 at 05:23 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `PHP`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(190) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created`) VALUES
(1, 'alpha', '$2y$10$cNUDWCRPkTJDKyMM0U6/BuQLnIFOqqeEuknZkJLIcRrTYLBxJJpSy', '2025-03-29 16:10:06'),
(2, 'h', '$2y$10$IkCLPIUh631F56ALC1gGQejgx96bOA5iXcmWoBInPHqQS0Um.Arye', '2025-03-29 16:11:58'),
(3, 'root', '$2y$10$8QIiwncocdhUUyvVyzt9U.R.PWSB0Ex5C1MHYb0fsnSa.CfHoTU6S', '2025-03-29 16:13:38'),
(4, 'r', '$2y$10$gaWdgJkU4nf0KcGKyZDc4eNun0eVoOQE5aY69g4BhyaOdzmD8VEy6', '2025-03-29 16:36:02'),
(5, 'almayo', '$2y$10$F2wietWAsCBPrYD97P1DHuaEonJnFZRHeSq1tYFfdGioIa8cT7Go2', '2025-03-29 16:40:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
