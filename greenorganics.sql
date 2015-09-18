-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 18, 2015 at 01:55 PM
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
-- Table structure for table `account_register`
--

CREATE TABLE IF NOT EXISTS `account_register` (
  `account_id` int(100) NOT NULL AUTO_INCREMENT,
  `acc_client_id` int(10) NOT NULL,
  `acc_nonclient` varchar(20) DEFAULT NULL,
  `acc_nonclient_desc` varchar(1000) DEFAULT NULL,
  `credit_debit` varchar(20) NOT NULL,
  `acc_amount` varchar(100) NOT NULL,
  `acc_date` varchar(50) DEFAULT NULL,
  `acc_month` varchar(50) DEFAULT NULL,
  `acc_year` varchar(10) DEFAULT NULL,
  `acc_particulars` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Table structure for table `client_master`
--

CREATE TABLE IF NOT EXISTS `client_master` (
  `client_id` int(10) NOT NULL AUTO_INCREMENT,
  `client_name` varchar(500) DEFAULT NULL,
  `address` varchar(1000) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `district` varchar(20) DEFAULT NULL,
  `contact_no` varchar(15) DEFAULT NULL,
  `client_status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `client_master`
--

INSERT INTO `client_master` (`client_id`, `client_name`, `address`, `city`, `district`, `contact_no`, `client_status`) VALUES
(1, 'MAHARASHTRA AGRO AGENCIES', 'RAJAPUR', 'RAJAPUR', 'RAJAPUR', '12345678', 'active'),
(2, 'SAMARTH TRADING CO.', 'ATPADI', 'ATPADI', 'ATPADI', '987654321', 'active');

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
(13, 'Raw Organic Manure'),
(14, 'Slaughter House Waste'),
(15, 'Animal Waste Filler'),
(17, 'HDPE Bags');

-- --------------------------------------------------------

--
-- Table structure for table `lorry_register`
--

CREATE TABLE IF NOT EXISTS `lorry_register` (
  `lorry_id` int(10) NOT NULL AUTO_INCREMENT,
  `lorry_number` varchar(20) NOT NULL,
  PRIMARY KEY (`lorry_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `lorry_register`
--

INSERT INTO `lorry_register` (`lorry_id`, `lorry_number`) VALUES
(1, 'MH 20/BT 4890'),
(2, 'MH 20/AA 8682\n'),
(6, 'MH 12/LL 2803'),
(7, 'KA 10/AA 1234');

-- --------------------------------------------------------

--
-- Table structure for table `outward_product_master`
--

CREATE TABLE IF NOT EXISTS `outward_product_master` (
  `prod_id` int(10) NOT NULL AUTO_INCREMENT,
  `prod_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`prod_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `outward_product_master`
--

INSERT INTO `outward_product_master` (`prod_id`, `prod_name`) VALUES
(1, 'echomeal');

-- --------------------------------------------------------

--
-- Table structure for table `production_batch_register`
--

CREATE TABLE IF NOT EXISTS `production_batch_register` (
  `production_id` int(10) NOT NULL AUTO_INCREMENT,
  `batch_no` varchar(50) NOT NULL,
  `product_produced` varchar(20) DEFAULT NULL,
  `product_remained` varchar(30) DEFAULT NULL,
  `filler_powder` varchar(10) DEFAULT NULL,
  `organic_manure` varchar(10) DEFAULT NULL,
  `shw` varchar(10) DEFAULT NULL,
  `awf` varchar(10) DEFAULT NULL,
  `bags_used` varchar(10) DEFAULT NULL,
  `production_date` varchar(20) DEFAULT NULL,
  `production_month` varchar(10) DEFAULT NULL,
  `production_year` varchar(10) DEFAULT NULL,
  `batch_status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`production_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `production_profile_master`
--

INSERT INTO `production_profile_master` (`profile_id`, `filler_powder`, `organic_manure`, `shw`, `gypsum`, `awf`) VALUES
(5, '5', '2', '10', '5', '10'),
(6, '4.400', '3.100', '1.700', NULL, '0.800');

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
  `bill_amount` varchar(50) DEFAULT NULL,
  `discount` varchar(20) DEFAULT NULL,
  `net_amount` varchar(50) DEFAULT NULL,
  `purchase_date` varchar(50) DEFAULT NULL,
  `purchase_month` varchar(50) DEFAULT NULL,
  `purchase_year` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`purchasebag_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

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
  `weight` varchar(200) NOT NULL,
  `rate` varchar(100) NOT NULL,
  `lorryfreight` varchar(100) NOT NULL,
  `finalAmt` varchar(100) NOT NULL,
  `purchase_date` varchar(50) NOT NULL,
  `purchase_month` varchar(10) DEFAULT NULL,
  `purchase_year` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`purchase_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

-- --------------------------------------------------------

--
-- Table structure for table `sales_batch_register`
--

CREATE TABLE IF NOT EXISTS `sales_batch_register` (
  `sales_batch_id` int(10) NOT NULL AUTO_INCREMENT,
  `sales_id` int(10) NOT NULL,
  `batch_no` varchar(10) DEFAULT NULL,
  `volume` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`sales_batch_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `sales_register`
--

CREATE TABLE IF NOT EXISTS `sales_register` (
  `sales_id` int(10) NOT NULL AUTO_INCREMENT,
  `order_no` varchar(25) DEFAULT NULL,
  `dc_no` varchar(10) DEFAULT NULL,
  `order_date` varchar(20) DEFAULT NULL,
  `dispatch_date` varchar(20) DEFAULT NULL,
  `client_id` int(10) NOT NULL,
  `lorry_id` int(10) NOT NULL,
  `quantity` varchar(10) DEFAULT NULL,
  `billno` varchar(10) DEFAULT NULL,
  `bill_date` varchar(20) DEFAULT NULL,
  `bill_amount` varchar(50) DEFAULT NULL,
  `discount` varchar(10) DEFAULT NULL,
  `net_amount` varchar(10) DEFAULT NULL,
  `vat_amount` varchar(10) DEFAULT NULL,
  `sale_date` varchar(20) DEFAULT NULL,
  `sale_month` varchar(10) DEFAULT NULL,
  `sale_year` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`sales_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `stock_master`
--

CREATE TABLE IF NOT EXISTS `stock_master` (
  `stock_id` int(10) NOT NULL AUTO_INCREMENT,
  `product_type` varchar(100) NOT NULL,
  `prod_id` int(10) NOT NULL,
  `stock_avail` varchar(50) DEFAULT NULL,
  `stock_date` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`stock_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `stock_master`
--

INSERT INTO `stock_master` (`stock_id`, `product_type`, `prod_id`, `stock_avail`, `stock_date`) VALUES
(1, 'Inward', 12, '0', ''),
(2, 'Inward', 13, '0', ''),
(3, 'Inward', 14, '0', ''),
(4, 'Inward', 15, '0', ''),
(5, 'Inward', 16, '0', ''),
(6, 'Inward', 17, '0', ''),
(8, 'Outward', 1, '0', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `supplier_master`
--

INSERT INTO `supplier_master` (`supplier_id`, `prod_id`, `supplier_name`, `supplier_contact`, `supplier_contact_person`, `supplier_address`, `supplier_city`, `vat_no`, `supplier_status`) VALUES
(2, 12, 'ABC FIRM', '9090909090', 'Mr. ABC', 'nagar', 'Nagar', '112312313', 'deactive'),
(3, 16, 'Gypsum Mill', '9999999999', 'Mr. Patil', 'Nashik Main Road', 'Nashik', 'N123456', 'active'),
(4, 13, 'Lucky Bone Mill', '8888888888', 'Mr. Baig', 'Aurangabad', 'Aurangabad', '12456', 'active'),
(5, 14, 'KK', '123456', 'Wasim', 'NagarRoad', 'Pune', 'V123498765', 'active'),
(6, 15, 'Animal Filler Firm', '123456789', 'Mr. Govind', 'Bombay', 'Bombay', 'V123456789', 'active'),
(7, 17, 'AADI Plastic Ind. P. Ltd', '10741485', 'AADI', 'India', 'Pune', 'V187645', 'active'),
(8, 12, 'KK Pvt Ltd', '1212121212', '1212121212', 'Kolhapur', 'Kolhapur', 'V212121212', 'active');

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
