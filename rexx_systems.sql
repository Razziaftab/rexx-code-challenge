-- phpMyAdmin SQL Dump
-- version 5.1.1deb3+bionic1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 09, 2023 at 10:43 PM
-- Server version: 5.7.42-0ubuntu0.18.04.1
-- PHP Version: 8.1.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rexx_systems`
--

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `sale_id` int(11) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_mail` varchar(255) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_price` decimal(10,2) DEFAULT NULL,
  `sale_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `sale_id`, `customer_name`, `customer_mail`, `product_id`, `product_name`, `product_price`, `sale_date`) VALUES
(1, 1, 'Reto Fanzen', 'reto.fanzen@no-reply.rexx-systems.com', 1, 'Refactoring: Improving the Design of Existing Code', '49.99', '2019-04-02 08:05:12'),
(2, 2, 'Reto Fanzen', 'reto.fanzen@no-reply.rexx-systems.com', 2, 'Clean Architecture: A Craftsman\'s Guide to Software Structure and Design', '24.99', '2019-05-01 11:07:18'),
(3, 3, 'Leandro Bußmann', 'leandro.bussmann@no-reply.rexx-systems.com', 2, 'Clean Architecture: A Craftsman\'s Guide to Software Structure and Design', '19.99', '2019-05-06 14:26:14'),
(4, 4, 'Hans Schäfer', 'hans.schaefer@no-reply.rexx-systems.com', 1, 'Refactoring: Improving the Design of Existing Code', '37.98', '2019-06-07 11:38:39'),
(5, 5, 'Mia Wyss', 'mia.wyss@no-reply.rexx-systems.com', 1, 'Refactoring: Improving the Design of Existing Code', '37.98', '2019-07-01 15:01:13'),
(6, 6, 'Mia Wyss', 'mia.wyss@no-reply.rexx-systems.com', 2, 'Clean Architecture: A Craftsman\'s Guide to Software Structure and Design', '19.99', '2019-08-07 19:08:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
