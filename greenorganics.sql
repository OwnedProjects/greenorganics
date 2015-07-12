-- phpMyAdmin SQL Dump
-- version 4.4.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2015 at 05:34 AM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `greenorganics`
--

-- --------------------------------------------------------

--
-- Table structure for table `inward_product_master`
--

CREATE TABLE IF NOT EXISTS `inward_product_master` (
  `prod_id` int(10) NOT NULL,
  `prod_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inward_product_master`
--

INSERT INTO `inward_product_master` (`prod_id`, `prod_name`) VALUES
(12, 'Filler Powder'),
(13, 'Organic Manure'),
(14, 'Slaughter House Waste'),
(15, 'Animal Waste Filler'),
(16, 'Gypsum');

-- --------------------------------------------------------

--
-- Table structure for table `lorry_register`
--

CREATE TABLE IF NOT EXISTS `lorry_register` (
  `lorry_id` int(10) NOT NULL,
  `lorry_number` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lorry_register`
--

INSERT INTO `lorry_register` (`lorry_id`, `lorry_number`) VALUES
(1, 'MH 20/BT 4890'),
(2, 'MH 20/AA 8682\n'),
(6, 'MH 12/LL 2803');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_master`
--

CREATE TABLE IF NOT EXISTS `purchase_master` (
  `purchase_id` int(10) NOT NULL,
  `lorry_id` int(10) NOT NULL,
  `supplier_id` int(10) NOT NULL,
  `prod_id` int(10) NOT NULL,
  `weight` int(200) NOT NULL,
  `rate` varchar(100) NOT NULL,
  `lorryfreight` varchar(100) NOT NULL,
  `finalAmt` varchar(100) NOT NULL,
  `purchase_date` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stock_master`
--

CREATE TABLE IF NOT EXISTS `stock_master` (
  `stock_id` int(10) NOT NULL,
  `product_type` varchar(100) NOT NULL,
  `prod_id` int(10) NOT NULL,
  `stock_avail` int(50) DEFAULT NULL,
  `stock_date` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_master`
--

INSERT INTO `stock_master` (`stock_id`, `product_type`, `prod_id`, `stock_avail`, `stock_date`) VALUES
(1, 'Inward', 12, 32500, '1436671471551'),
(2, 'Inward', 13, 20000, '1436671126332'),
(3, 'Inward', 14, 10000, '1436671049298'),
(4, 'Inward', 15, 10000, '1436671315463'),
(5, 'Inward', 16, 8000, '1435807606918');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_master`
--

CREATE TABLE IF NOT EXISTS `supplier_master` (
  `supplier_id` int(10) NOT NULL,
  `prod_id` int(10) NOT NULL,
  `supplier_name` varchar(100) NOT NULL,
  `supplier_contact` varchar(20) NOT NULL,
  `supplier_contact_person` varchar(50) NOT NULL,
  `supplier_address` varchar(500) NOT NULL,
  `supplier_city` varchar(100) NOT NULL,
  `vat_no` varchar(50) NOT NULL,
  `supplier_status` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier_master`
--

INSERT INTO `supplier_master` (`supplier_id`, `prod_id`, `supplier_name`, `supplier_contact`, `supplier_contact_person`, `supplier_address`, `supplier_city`, `vat_no`, `supplier_status`) VALUES
(2, 12, 'ABC FIRM', '9090909090', 'Mr. ABC', 'nagar', 'Nagar', '112312313', 'active'),
(3, 16, 'Gypsum Mill', '9999999999', 'Mr. Patil', 'Nashik Main Road', 'Nashik', 'N123456', 'active'),
(4, 13, 'Lucky Bone Mill', '8888888888', 'Mr. Baig', 'Aurangabad', 'Aurangabad', '12456', 'active'),
(5, 14, 'KK', '123456', 'Wasim', 'NagarRoad', 'Pune', 'V123498765', 'active'),
(6, 15, 'Animal Filler Firm', '123456789', 'Mr. Govind', 'Bombay', 'Bombay', 'V123456789', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE IF NOT EXISTS `user_master` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`username`, `password`) VALUES
('admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inward_product_master`
--
ALTER TABLE `inward_product_master`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `lorry_register`
--
ALTER TABLE `lorry_register`
  ADD PRIMARY KEY (`lorry_id`);

--
-- Indexes for table `purchase_master`
--
ALTER TABLE `purchase_master`
  ADD PRIMARY KEY (`purchase_id`);

--
-- Indexes for table `stock_master`
--
ALTER TABLE `stock_master`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `supplier_master`
--
ALTER TABLE `supplier_master`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `user_master`
--
ALTER TABLE `user_master`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inward_product_master`
--
ALTER TABLE `inward_product_master`
  MODIFY `prod_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `lorry_register`
--
ALTER TABLE `lorry_register`
  MODIFY `lorry_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `purchase_master`
--
ALTER TABLE `purchase_master`
  MODIFY `purchase_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `stock_master`
--
ALTER TABLE `stock_master`
  MODIFY `stock_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `supplier_master`
--
ALTER TABLE `supplier_master`
  MODIFY `supplier_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
