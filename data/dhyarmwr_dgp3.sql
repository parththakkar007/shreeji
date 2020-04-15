-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 08, 2020 at 01:27 PM
-- Server version: 5.6.41-84.1-log
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dhyarmwr_dgp3`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `holder` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `opening_balance`
--

CREATE TABLE `opening_balance` (
  `id` int(255) NOT NULL,
  `opening` varchar(255) NOT NULL,
  `closing` varchar(255) NOT NULL,
  `actual_opening` varchar(255) NOT NULL,
  `actual_closing` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `note200` int(255) NOT NULL,
  `note50` int(255) NOT NULL,
  `note20` int(255) NOT NULL,
  `note10` int(255) NOT NULL,
  `note5` int(255) NOT NULL,
  `note2` int(255) NOT NULL,
  `note1` int(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `opening_balance`
--

INSERT INTO `opening_balance` (`id`, `opening`, `closing`, `actual_opening`, `actual_closing`, `date`, `note200`, `note50`, `note20`, `note10`, `note5`, `note2`, `note1`, `created_at`, `updated_at`, `user_id`) VALUES
(1, '67980', '67980', '', '0', '2019-09-12', 0, 0, 0, 0, 0, 0, 0, '2019-09-12 16:48:09', '2019-09-13 16:31:19', 0),
(2, '67980', '56300', '', '0', '2019-09-13', 0, 0, 0, 0, 0, 0, 0, '2019-09-13 15:53:39', '2019-09-13 16:34:39', 0),
(3, '52185', '', '', '0', '2020-04-07', 0, 0, 0, 0, 0, 0, 0, '2020-04-07 16:47:23', '0000-00-00 00:00:00', 0);

--
-- Triggers `opening_balance`
--
DELIMITER $$
CREATE TRIGGER `insert_actual_opening` BEFORE INSERT ON `opening_balance` FOR EACH ROW BEGIN
SET NEW.actual_closing=NEW.note200*200+NEW.note50*50+NEW.note20*20+NEW.note10*10+NEW.note5*5+NEW.note2*2+NEW.note1*1;
#IF NEW.status = 1 THEN SET NEW.accepted_date = now();
#ELSEIF NEW.status = 2 THEN SET NEW.send_date = now();
#ELSEIF NEW.status = 3 THEN SET NEW.complete_date=now();
#ELSEIF NEW.status = 4 THEN SET NEW.rejected_date=now();
#END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_actual_opening` BEFORE UPDATE ON `opening_balance` FOR EACH ROW BEGIN
SET NEW.actual_closing=NEW.note200*200+NEW.note50*50+NEW.note20*20+NEW.note10*10+NEW.note5*5+NEW.note2*2+NEW.note1*1;
#IF NEW.status = 1 THEN SET NEW.accepted_date = now();
#ELSEIF NEW.status = 2 THEN SET NEW.send_date = now();
#ELSEIF NEW.status = 3 THEN SET NEW.complete_date=now();
#ELSEIF NEW.status = 4 THEN SET NEW.rejected_date=now();
#END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `party`
--

CREATE TABLE `party` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `party`
--

INSERT INTO `party` (`id`, `name`, `mobile`, `city`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'BAIJU', '', '', '2019-09-12 16:51:24', '0000-00-00 00:00:00', 0),
(2, 'CASH SALE', '', '', '2019-09-12 16:52:17', '0000-00-00 00:00:00', 0),
(3, 'SAVAN', '', '', '2019-09-12 16:52:37', '0000-00-00 00:00:00', 0),
(4, 'HDBF', '', '', '2019-09-12 16:53:21', '0000-00-00 00:00:00', 0),
(5, 'bholu bhai', '', '', '2019-09-13 15:55:00', '0000-00-00 00:00:00', 0),
(6, 'subo', '', '', '2019-09-13 15:58:02', '0000-00-00 00:00:00', 0),
(7, 'CHINTU HOME', '', '', '2019-09-13 16:03:05', '0000-00-00 00:00:00', 0),
(8, 'MAGAN', '', '', '2019-09-13 16:03:59', '0000-00-00 00:00:00', 0),
(9, 'S P', '', '', '2019-09-13 16:04:43', '0000-00-00 00:00:00', 0),
(10, 'CASH PURCHASE', '', '', '2019-09-13 16:06:09', '0000-00-00 00:00:00', 0),
(11, 'UTTAM', '', '', '2019-09-13 16:06:28', '0000-00-00 00:00:00', 0),
(12, 'SHAYLESH BHAI MUAAN BHAI', '', '', '2019-09-13 16:07:02', '0000-00-00 00:00:00', 0),
(13, 'NAIMESH TVS', '', '', '2019-09-13 16:07:36', '0000-00-00 00:00:00', 0),
(14, 'HARSHIL', '', '', '2019-09-13 16:07:51', '0000-00-00 00:00:00', 0),
(15, 'HARESH BHAI', '', '', '2019-09-13 16:24:00', '0000-00-00 00:00:00', 0),
(16, 'CHETAN CHING', '', '', '2019-09-13 16:24:23', '0000-00-00 00:00:00', 0),
(17, 'SUNIL BHAI HOME', '', '', '2019-09-13 16:38:00', '0000-00-00 00:00:00', 0),
(18, 'piyush bhai', '', '', '2020-04-07 16:45:34', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(255) NOT NULL,
  `date` date NOT NULL,
  `party_id` int(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `remark` text NOT NULL,
  `bank` int(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `date`, `party_id`, `type`, `amount`, `remark`, `bank`, `created_at`, `updated_at`, `user_id`) VALUES
(37, '2020-04-08', 1, 'credit', '1000', '', 0, '2020-04-08 10:15:02', '0000-00-00 00:00:00', 0),
(19, '2019-09-13', 5, 'credit', '20000', '', 0, '2019-09-13 16:20:19', '0000-00-00 00:00:00', 0),
(20, '2019-09-13', 2, 'credit', '18000', 'M40 ', 0, '2019-09-13 16:20:38', '0000-00-00 00:00:00', 0),
(21, '2019-09-13', 6, 'credit', '30000', '', 0, '2019-09-13 16:20:44', '0000-00-00 00:00:00', 0),
(22, '2019-09-13', 2, 'credit', '4000', 'IPHONE 6 S TO F11 PRO', 0, '2019-09-13 16:21:04', '2019-09-13 16:36:36', 0),
(23, '2019-09-13', 2, 'credit', '3000', 'RIPELESS IPHONE 7', 0, '2019-09-13 16:22:03', '0000-00-00 00:00:00', 0),
(24, '2019-09-13', 7, 'debit', '1100', '', 0, '2019-09-13 16:22:27', '0000-00-00 00:00:00', 0),
(25, '2019-09-13', 8, 'debit', '70000', '', 0, '2019-09-13 16:22:34', '0000-00-00 00:00:00', 0),
(26, '2019-09-13', 9, 'debit', '2000', '', 0, '2019-09-13 16:22:41', '0000-00-00 00:00:00', 0),
(27, '2019-09-13', 10, 'debit', '10000', 'vivo v11', 0, '2019-09-13 16:23:04', '0000-00-00 00:00:00', 0),
(28, '2019-09-13', 11, 'debit', '2000', '', 0, '2019-09-13 16:23:12', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(255) NOT NULL,
  `permission` int(6) NOT NULL COMMENT '0=no permissions, 1=edit, 2=delete, 3=ALL'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `created_at`, `updated_at`, `user_id`, `permission`) VALUES
(2, 'admin', '1234', '2019-06-19 10:05:13', '0000-00-00 00:00:00', 0, 0),
(3, 'pratik', '12345', '2019-06-23 14:29:51', '0000-00-00 00:00:00', 0, 0),
(4, 'akki', 'akki', '2019-06-28 11:56:56', '0000-00-00 00:00:00', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `opening_balance`
--
ALTER TABLE `opening_balance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `party`
--
ALTER TABLE `party`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `opening_balance`
--
ALTER TABLE `opening_balance`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `party`
--
ALTER TABLE `party`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
