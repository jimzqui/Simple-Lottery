-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 24, 2014 at 10:20 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lottery`
--
CREATE DATABASE IF NOT EXISTS `lottery` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `lottery`;

-- --------------------------------------------------------

--
-- Table structure for table `bets`
--

CREATE TABLE IF NOT EXISTS `bets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `combination` varchar(30) NOT NULL,
  `combination_sort` varchar(30) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `luckypick` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `draws`
--

CREATE TABLE IF NOT EXISTS `draws` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `combination` varchar(30) NOT NULL,
  `combination_sort` varchar(30) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `winners`
--

CREATE TABLE IF NOT EXISTS `winners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bet_id` int(11) NOT NULL,
  `draw_id` int(11) NOT NULL,
  `type` varchar(30) DEFAULT 'jackpot',
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
