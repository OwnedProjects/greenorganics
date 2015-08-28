-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 28, 2015 at 11:11 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `production_batch_register`
--

INSERT INTO `production_batch_register` (`production_id`, `batch_no`, `product_produced`, `product_remained`, `filler_powder`, `organic_manure`, `shw`, `awf`, `bags_used`, `production_date`, `production_month`, `production_year`, `batch_status`) VALUES
(7, '10', '10000', '0', '4.400', '3.100', '1.700', '0.800', '250', '1436512298270', '6', '2015', 'closed'),
(8, '11', '10000', '1000', '4.400', '3.100', '1.700', '0.800', '100', '1436166178949', '6', '2015', 'open'),
(9, '2', '10000', '10000', '4.400', '3.100', '1.700', '0.800', '300', '1438755222238', '7', '2015', 'open');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `purchase_bag_register`
--

INSERT INTO `purchase_bag_register` (`purchasebag_id`, `lorry_id`, `supplier_id`, `prod_id`, `number_bags`, `billno`, `bill_amount`, `discount`, `net_amount`, `purchase_date`, `purchase_month`, `purchase_year`) VALUES
(1, 1, 7, 17, '200', '12', '3000', '100', '2900', '1438755105807', '7', '2015');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `purchase_register`
--

INSERT INTO `purchase_register` (`purchase_id`, `lorry_id`, `supplier_id`, `prod_id`, `billno`, `weight`, `rate`, `lorryfreight`, `finalAmt`, `purchase_date`, `purchase_month`, `purchase_year`) VALUES
(11, 2, 4, 13, '', 1000, '5000', '-1000', '4000', '1435744414601', NULL, NULL),
(12, 2, 3, 16, '', 2000, '6000', '0', '12000', '1436522235690', NULL, NULL),
(13, 1, 4, 13, '', 5000, '10000', '0', '50000', '1431252321911', '4', '2015'),
(14, 2, 2, 12, '', 6000, '5000', '0', '30000', '1433930741370', '5', '2015'),
(15, 1, 2, 12, '123456', 1500, '5000', '0', '7500', '1436612875568', '6', '2015'),
(16, 1, 2, 12, '12', 50000, '500', '0', '25000', '1436539888241', '6', '2015'),
(17, 2, 3, 16, '12', 50000, '500', '0', '25000', '1436971905946', '6', '2015'),
(18, 6, 5, 14, '56', 10000, '5000', '0', '50000', '1436539934535', '6', '2015'),
(19, 2, 6, 15, '12', 10000, '10000', '0', '100000', '1437058366471', '6', '2015'),
(20, 1, 5, 14, '132', 15000, '1200', '0', '18000', '1436459557438', '6', '2015'),
(21, 6, 6, 15, '5', 25000, '500', '0', '12500', '1436286944163', '6', '2015'),
(22, 1, 4, 13, '12', 50000, '1500', '0', '75000', '1436188931018', '6', '2015');

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

--
-- Dumping data for table `sales_batch_register`
--

INSERT INTO `sales_batch_register` (`sales_batch_id`, `sales_id`, `batch_no`, `volume`) VALUES
(1, 1, '10', '6000'),
(2, 1, '11', '4000'),
(3, 2, '10', '2000'),
(4, 3, '11', '5000'),
(5, 4, '10', '1000'),
(6, 5, '10', '1000');

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

--
-- Dumping data for table `sales_register`
--

INSERT INTO `sales_register` (`sales_id`, `order_no`, `dc_no`, `order_date`, `dispatch_date`, `client_id`, `lorry_id`, `quantity`, `billno`, `bill_date`, `bill_amount`, `discount`, `net_amount`, `vat_amount`, `sale_date`, `sale_month`, `sale_year`) VALUES
(1, NULL, '123', '1436267959778', '1438255159779', 1, 1, '10000', '101', '1438427959779', NULL, NULL, NULL, NULL, '1438255159779', '6', '2015'),
(2, NULL, '1', '1436445284712', '1438259684712', 1, 2, '2000', '5', '1438346084712', '1500', NULL, NULL, NULL, '1438259684712', '6', '2015'),
(3, NULL, '1', '1436358961303', '1438346161303', 1, 2, '5000', '6', '1439037361303', '15000', NULL, NULL, NULL, '1438259761304', '6', '2015'),
(4, 'D12345', '1234', '1438941791630', '1441015391630', 2, 7, '1000', '321', '1440928991631', '50000', '500', '49500', '200', '1440669791631', '7', '2015'),
(5, 'D18376', '12323', '1438426828829', '1440759628829', 1, 1, '1000', '212', '1441018828829', '2000', '100', '1900', '50', '1440759628829', '7', '2015');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `stock_master`
--

INSERT INTO `stock_master` (`stock_id`, `product_type`, `prod_id`, `stock_avail`, `stock_date`) VALUES
(1, 'Inward', 12, 19400, '1438755222238'),
(2, 'Inward', 13, 37600, '1438755222238'),
(3, 'Inward', 14, 3200, '1438755222238'),
(4, 'Inward', 15, 20800, '1438755222238'),
(5, 'Inward', 16, 45000, '1437490599417'),
(6, 'Inward', 17, 2300, '1438755222238'),
(8, 'Outward', 1, 11000, '1440759628829');

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
(2, 12, 'ABC FIRM', '9090909090', 'Mr. ABC', 'nagar', 'Nagar', '112312313', 'deactive'),
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
