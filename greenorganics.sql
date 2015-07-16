-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 16, 2015 at 11:36 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `inward_product_master`
--

INSERT INTO `inward_product_master` (`prod_id`, `prod_name`) VALUES
(12, 'Filler Powder'),
(13, 'Organic Manure'),
(14, 'Slaughter House Waste'),
(15, 'Animal Waste Filler'),
(16, 'Gypsum'),
(17, 'HDPE Bags');

-- --------------------------------------------------------

--
-- Table structure for table `lorry_register`
--

CREATE TABLE IF NOT EXISTS `lorry_register` (
  `lorry_id` int(10) NOT NULL AUTO_INCREMENT,
  `lorry_number` varchar(20) NOT NULL,
  PRIMARY KEY (`lorry_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `lorry_register`
--

INSERT INTO `lorry_register` (`lorry_id`, `lorry_number`) VALUES
(1, 'MH 20/BT 4890'),
(2, 'MH 20/AA 8682\n'),
(6, 'MH 12/LL 2803');

-- --------------------------------------------------------

--
-- Table structure for table `production_profile_master`
--

CREATE TABLE IF NOT EXISTS `production_profile_master` (
  `profile_id` int(10) NOT NULL AUTO_INCREMENT,
  `filler_powder` varchar(10) DEFAULT NULL,
  `organic_manure` varchar(10) DEFAULT NULL,
  `shw` varchar(10) DEFAULT NULL,
  `gypsum` varchar(10) DEFAULT NULL,
  `awf` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`profile_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `production_profile_master`
--

INSERT INTO `production_profile_master` (`profile_id`, `filler_powder`, `organic_manure`, `shw`, `gypsum`, `awf`) VALUES
(4, '5', '5', '5', '5', '5');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_bag_register`
--

CREATE TABLE IF NOT EXISTS `purchase_bag_register` (
  `purchasebag_id` int(10) NOT NULL AUTO_INCREMENT,
  `lorry_id` int(10) NOT NULL,
  `supplier_id` int(10) NOT NULL,
  `prod_id` int(10) NOT NULL,
  `number_bags` varchar(10) NOT NULL,
  `billno` varchar(10) DEFAULT NULL,
  `purchase_date` varchar(50) DEFAULT NULL,
  `purchase_month` varchar(50) DEFAULT NULL,
  `purchase_year` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`purchasebag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_register`
--

CREATE TABLE IF NOT EXISTS `purchase_register` (
  `purchase_id` int(10) NOT NULL AUTO_INCREMENT,
  `lorry_id` int(10) NOT NULL,
  `supplier_id` int(10) NOT NULL,
  `prod_id` int(10) NOT NULL,
  `billno` varchar(50) NOT NULL,
  `weight` int(200) NOT NULL,
  `rate` varchar(100) NOT NULL,
  `lorryfreight` varchar(100) NOT NULL,
  `finalAmt` varchar(100) NOT NULL,
  `purchase_date` varchar(50) NOT NULL,
  `purchase_month` varchar(10) DEFAULT NULL,
  `purchase_year` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`purchase_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `purchase_register`
--

INSERT INTO `purchase_register` (`purchase_id`, `lorry_id`, `supplier_id`, `prod_id`, `billno`, `weight`, `rate`, `lorryfreight`, `finalAmt`, `purchase_date`, `purchase_month`, `purchase_year`) VALUES
(11, 2, 4, 13, '', 1000, '5000', '-1000', '4000', '1435744414601', NULL, NULL),
(12, 2, 3, 16, '', 2000, '6000', '0', '12000', '1436522235690', NULL, NULL),
(13, 1, 4, 13, '', 5000, '10000', '0', '50000', '1431252321911', '4', '2015'),
(14, 2, 2, 12, '', 6000, '5000', '0', '30000', '1433930741370', '5', '2015'),
(15, 1, 2, 12, '123456', 1500, '5000', '0', '7500', '1436612875568', '6', '2015');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `stock_master`
--

INSERT INTO `stock_master` (`stock_id`, `product_type`, `prod_id`, `stock_avail`, `stock_date`) VALUES
(1, 'Inward', 12, 40000, '1436612875568'),
(2, 'Inward', 13, 26000, '1431252321911'),
(3, 'Inward', 14, 10000, '1436671049298'),
(4, 'Inward', 15, 10000, '1436671315463'),
(5, 'Inward', 16, 10000, '1436522235690'),
(6, 'Inward', 17, 2000, '1436268723416');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `supplier_master`
--

INSERT INTO `supplier_master` (`supplier_id`, `prod_id`, `supplier_name`, `supplier_contact`, `supplier_contact_person`, `supplier_address`, `supplier_city`, `vat_no`, `supplier_status`) VALUES
(2, 12, 'ABC FIRM', '9090909090', 'Mr. ABC', 'nagar', 'Nagar', '112312313', 'active'),
(3, 16, 'Gypsum Mill', '9999999999', 'Mr. Patil', 'Nashik Main Road', 'Nashik', 'N123456', 'active'),
(4, 13, 'Lucky Bone Mill', '8888888888', 'Mr. Baig', 'Aurangabad', 'Aurangabad', '12456', 'active'),
(5, 14, 'KK', '123456', 'Wasim', 'NagarRoad', 'Pune', 'V123498765', 'active'),
(6, 15, 'Animal Filler Firm', '123456789', 'Mr. Govind', 'Bombay', 'Bombay', 'V123456789', 'active'),
(7, 17, 'AADI Plastic Ind. P. Ltd', '10741485', 'AADI', 'India', 'Pune', 'V187645', 'active');

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
