-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 07, 2016 at 11:36 AM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

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
  `acc_client_id` int(10) DEFAULT NULL,
  `acc_nonclientid` varchar(20) DEFAULT NULL,
  `acc_type` varchar(20) DEFAULT NULL,
  `credit_debit` varchar(20) NOT NULL,
  `acc_amount` varchar(100) NOT NULL,
  `acc_date` varchar(50) DEFAULT NULL,
  `acc_month` varchar(50) DEFAULT NULL,
  `acc_year` varchar(10) DEFAULT NULL,
  `acc_particulars` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=79 ;

--
-- Dumping data for table `account_register`
--

INSERT INTO `account_register` (`account_id`, `acc_client_id`, `acc_nonclientid`, `acc_type`, `credit_debit`, `acc_amount`, `acc_date`, `acc_month`, `acc_year`, `acc_particulars`) VALUES
(49, 7, NULL, 'inward', 'debit', '2500', '1443536252309', '8', '2015', 'sdfsdfsdfs'),
(50, 1, NULL, 'outward', 'debit', '6500', '1443536468987', '8', '2015', NULL),
(51, 1, NULL, 'outward', 'debit', '50000', '1443973935787', '9', '2015', NULL),
(52, 1, NULL, 'outward', 'debit', '49000', '1445164635368', '9', '2015', NULL),
(53, 1, NULL, 'outward', 'debit', '1500', '1445166148426', '9', '2015', NULL),
(54, 8, NULL, 'inward', 'credit', '40000', '1445758571043', '9', '2015', NULL),
(55, 3, NULL, 'outward', 'debit', '50000', '1445758860933', '9', '2015', NULL),
(56, 7, NULL, 'inward', 'credit', '500000', '1446694214915', '10', '2015', NULL),
(57, 8, NULL, 'inward', 'credit', '2500', '1447338174826', '10', '2015', NULL),
(58, 8, NULL, 'inward', 'debit', '1000', '1447338174826', '10', '2015', 'wewr'),
(59, 1, NULL, 'outward', 'debit', '4000', '1447338972658', '10', '2015', NULL),
(60, 1, NULL, 'outward', 'credit', '4000', '1447338972658', '10', '2015', 'rggdf'),
(61, 5, NULL, 'inward', 'credit', '12420', '1447252066327', '10', '2015', NULL),
(62, 5, NULL, 'inward', 'debit', '233', '1447252066327', '10', '2015', 'fvxg'),
(63, 7, NULL, 'inward', 'debit', '800', '1449554355490', '11', '2015', 'sdfsf'),
(64, 7, NULL, 'inward', 'debit', '1000', '1444459440292', '9', '2015', 'TEST'),
(65, 7, NULL, 'inward', 'debit', '100000', '1446706118181', '10', '2015', 'New Coin'),
(66, 3, NULL, 'outward', 'debit', '', '1448972943888', '11', '2015', NULL),
(67, 4, NULL, 'inward', 'credit', '564500', '1452223517358', '0', '2016', NULL),
(68, 4, NULL, 'inward', 'debit', '564500', '1452223517358', '0', '2016', 'asfsa'),
(69, 8, NULL, 'inward', 'credit', '300000', '1452091439023', '0', '2016', NULL),
(70, 8, NULL, 'inward', 'debit', '300000', '1452091439023', '0', '2016', 'fmdak'),
(71, 6, NULL, 'inward', 'credit', '1000', '1454558496903', '1', '2016', NULL),
(72, 6, NULL, 'inward', 'debit', '1000', '1454558496903', '1', '2016', 'nadbfkhbda'),
(73, 6, NULL, 'inward', 'credit', '50000', '1454507564909', '1', '2016', NULL),
(74, 6, NULL, 'inward', 'debit', '50000', '1454507564909', '1', '2016', 'Payment'),
(75, 7, NULL, 'inward', 'credit', '1400', '1454566430658', '1', '2016', NULL),
(76, 7, NULL, 'inward', 'debit', '1400', '1454566430658', '1', '2016', 'HDPE mohseen'),
(77, 9, NULL, 'inward', 'credit', '29000', '1464772603924', '5', '2016', NULL),
(78, 9, NULL, 'inward', 'debit', '9000', '1462439928705', '4', '2016', 'Credit 20000');

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
  `contact_person` varchar(100) DEFAULT NULL,
  `vat_no` varchar(50) DEFAULT NULL,
  `client_status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `otherexpense_master`
--

CREATE TABLE IF NOT EXISTS `otherexpense_master` (
  `expense_id` int(10) NOT NULL AUTO_INCREMENT,
  `expense_name` varchar(500) NOT NULL,
  PRIMARY KEY (`expense_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `otherexpense_master`
--

INSERT INTO `otherexpense_master` (`expense_id`, `expense_name`) VALUES
(1, 'Travel to Bagdad'),
(2, 'Rent');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

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
  `lorry_id` int(10) DEFAULT NULL,
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
  `order_completion_date` varchar(30) DEFAULT NULL,
  `order_completion_month` varchar(10) DEFAULT NULL,
  `order_completion_year` varchar(10) DEFAULT NULL,
  `sale_status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`sales_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `stock_master`
--

INSERT INTO `stock_master` (`stock_id`, `product_type`, `prod_id`, `stock_avail`, `stock_date`) VALUES
(1, 'Inward', 12, '0', '1454472153908'),
(2, 'Inward', 13, '0', '1454472153908'),
(3, 'Inward', 14, '0', '1464772603924'),
(4, 'Inward', 15, '0', '1454507564909'),
(5, 'Inward', 17, '0', '1454566430658'),
(6, 'Outward', 1, '0', '1454472153908');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

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
