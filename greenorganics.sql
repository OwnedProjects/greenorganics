-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 09, 2015 at 11:27 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `greenorganics`
--

-- --------------------------------------------------------

--
-- Table structure for table `inward_product_master`
--

CREATE TABLE IF NOT EXISTS `inward_product_master` (
  `prod_id` int(10) NOT NULL AUTO_INCREMENT,
  `prod_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`prod_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `inward_product_master`
--

INSERT INTO `inward_product_master` (`prod_id`, `prod_name`) VALUES
(12, 'Filler Powder'),
(13, 'Organic Manure');

-- --------------------------------------------------------

--
-- Table structure for table `lorry_register`
--

CREATE TABLE IF NOT EXISTS `lorry_register` (
  `lorry_id` int(10) NOT NULL AUTO_INCREMENT,
  `lorry_number` varchar(20) NOT NULL,
  PRIMARY KEY (`lorry_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `lorry_register`
--

INSERT INTO `lorry_register` (`lorry_id`, `lorry_number`) VALUES
(1, 'MH 20/BT 4890'),
(2, 'MH 20/AA 8682\n');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_master`
--

CREATE TABLE IF NOT EXISTS `purchase_master` (
  `purchase_id` int(10) NOT NULL AUTO_INCREMENT,
  `lorry_id` int(10) NOT NULL,
  `supplier_id` int(10) NOT NULL,
  `prod_id` int(10) NOT NULL,
  `weight` int(200) NOT NULL,
  `rate` varchar(100) NOT NULL,
  `discount` varchar(100) NOT NULL,
  `finalAmt` varchar(100) NOT NULL,
  `purchase_date` varchar(50) NOT NULL,
  PRIMARY KEY (`purchase_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `purchase_master`
--

INSERT INTO `purchase_master` (`purchase_id`, `lorry_id`, `supplier_id`, `prod_id`, `weight`, `rate`, `discount`, `finalAmt`, `purchase_date`) VALUES
(3, 1, 2, 12, 1000, '50', '1000', '49000', '1436271579128'),
(4, 1, 2, 12, 2000, '50', '100', '99900', '1436358025369'),
(5, 2, 2, 12, 3000, '50', '0', '150000', '1436423398511'),
(6, 1, 2, 12, 1000, '100', '0', '100000', '1435905529333'),
(8, 1, 2, 12, 2200, '20', '0', '44000', '1436424286396');

-- --------------------------------------------------------

--
-- Table structure for table `stock_master`
--

CREATE TABLE IF NOT EXISTS `stock_master` (
  `stock_id` int(10) NOT NULL AUTO_INCREMENT,
  `product_type` varchar(100) NOT NULL,
  `prod_id` int(10) NOT NULL,
  `stock_avail` int(50) DEFAULT NULL,
  `stock_date` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`stock_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `stock_master`
--

INSERT INTO `stock_master` (`stock_id`, `product_type`, `prod_id`, `stock_avail`, `stock_date`) VALUES
(1, 'Inward', 12, 10200, '1436424290206'),
(2, 'Inward', 13, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `supplier_master`
--

CREATE TABLE IF NOT EXISTS `supplier_master` (
  `supplier_id` int(10) NOT NULL AUTO_INCREMENT,
  `prod_id` int(10) NOT NULL,
  `supplier_name` varchar(100) NOT NULL,
  `supplier_contact` varchar(20) NOT NULL,
  `supplier_contact_person` varchar(50) NOT NULL,
  `supplier_address` varchar(500) NOT NULL,
  `supplier_city` varchar(100) NOT NULL,
  `vat_no` varchar(50) NOT NULL,
  `supplier_status` varchar(20) NOT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `supplier_master`
--

INSERT INTO `supplier_master` (`supplier_id`, `prod_id`, `supplier_name`, `supplier_contact`, `supplier_contact_person`, `supplier_address`, `supplier_city`, `vat_no`, `supplier_status`) VALUES
(2, 12, 'ABC FIRM', '9090909090', 'Mr. ABC', 'nagar', 'Nagar', '112312313', 'active'),
(3, 12, 'Bone Mill', '9999999999', 'Mr. Patil', 'Nashik Main Road', 'Nashik', 'N123456', 'active'),
(4, 13, 'Lucky Bone Mill', '8888888888', 'Mr. Baig', 'Aurangabad', 'Aurangabad', '12456', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE IF NOT EXISTS `user_master` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`username`, `password`) VALUES
('admin', 'admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
