-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2016 at 04:24 PM
-- Server version: 5.5.45
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `emt`
--

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE IF NOT EXISTS `attachments` (
  `attachment_id` int(11) NOT NULL AUTO_INCREMENT,
  `attachment_source_id` int(11) DEFAULT NULL,
  `attachment_name` longtext NOT NULL,
  `attachment_source` enum('Message','Task','Project','') NOT NULL,
  `attachment_create_date` datetime NOT NULL,
  PRIMARY KEY (`attachment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `attachments`
--

INSERT INTO `attachments` (`attachment_id`, `attachment_source_id`, `attachment_name`, `attachment_source`, `attachment_create_date`) VALUES
(1, 1, 'Chrysanthemum.jpg', 'Message', '2016-02-09 13:51:39'),
(2, 1, 'Desert.jpg', 'Message', '2016-02-09 13:51:40'),
(3, 1, 'Hydrangeas.jpg', 'Message', '2016-02-09 13:51:40'),
(4, 230, 'DSC07251.JPG', 'Message', '2016-02-09 13:54:14'),
(5, 230, 'DSC07252.JPG', 'Message', '2016-02-09 13:54:14'),
(6, 230, 'DSC07253.JPG', 'Message', '2016-02-09 13:54:15'),
(7, 231, 'Chrysanthemum.jpg', 'Message', '2016-02-09 14:09:05'),
(8, 231, 'Desert.jpg', 'Message', '2016-02-09 14:09:05'),
(9, 231, 'Hydrangeas.jpg', 'Message', '2016-02-09 14:09:05'),
(10, 232, 'Chrysanthemum.jpg', 'Message', '2016-02-09 14:09:49'),
(11, 232, 'Desert.jpg', 'Message', '2016-02-09 14:09:49'),
(12, 232, 'Hydrangeas.jpg', 'Message', '2016-02-09 14:09:49'),
(13, 233, 'Chrysanthemum.jpg', 'Message', '2016-02-09 14:10:30'),
(14, 233, 'Desert.jpg', 'Message', '2016-02-09 14:10:30'),
(15, 233, 'Hydrangeas.jpg', 'Message', '2016-02-09 14:10:30'),
(16, 234, 'Chrysanthemum.jpg', 'Message', '2016-02-09 14:10:59'),
(17, 234, 'Desert.jpg', 'Message', '2016-02-09 14:11:00'),
(18, 234, 'Hydrangeas.jpg', 'Message', '2016-02-09 14:11:00'),
(19, 235, 'Chrysanthemum.jpg', 'Message', '2016-02-09 14:11:08'),
(20, 235, 'Desert.jpg', 'Message', '2016-02-09 14:11:08'),
(21, 235, 'Hydrangeas.jpg', 'Message', '2016-02-09 14:11:08'),
(22, 236, 'Chrysanthemum.jpg', 'Message', '2016-02-09 14:11:18'),
(23, 236, 'Desert.jpg', 'Message', '2016-02-09 14:11:18'),
(24, 236, 'Hydrangeas.jpg', 'Message', '2016-02-09 14:11:18'),
(25, 240, 'Chrysanthemum.jpg', 'Message', '2016-02-09 14:23:59'),
(26, 240, 'Desert.jpg', 'Message', '2016-02-09 14:23:59'),
(27, 241, 'Lighthouse.jpg', 'Message', '2016-02-09 15:33:05'),
(28, 241, 'Penguins.jpg', 'Message', '2016-02-09 15:33:05'),
(29, 241, 'Tulips.jpg', 'Message', '2016-02-09 15:33:05');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2016 at 04:24 PM
-- Server version: 5.5.45
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `emt`
--

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE IF NOT EXISTS `attachments` (
  `attachment_id` int(11) NOT NULL AUTO_INCREMENT,
  `attachment_source_id` int(11) DEFAULT NULL,
  `attachment_name` longtext NOT NULL,
  `attachment_source` enum('Message','Task','Project','') NOT NULL,
  `attachment_create_date` datetime NOT NULL,
  PRIMARY KEY (`attachment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `attachments`
--

INSERT INTO `attachments` (`attachment_id`, `attachment_source_id`, `attachment_name`, `attachment_source`, `attachment_create_date`) VALUES
(1, 1, 'Chrysanthemum.jpg', 'Message', '2016-02-09 13:51:39'),
(2, 1, 'Desert.jpg', 'Message', '2016-02-09 13:51:40'),
(3, 1, 'Hydrangeas.jpg', 'Message', '2016-02-09 13:51:40'),
(4, 230, 'DSC07251.JPG', 'Message', '2016-02-09 13:54:14'),
(5, 230, 'DSC07252.JPG', 'Message', '2016-02-09 13:54:14'),
(6, 230, 'DSC07253.JPG', 'Message', '2016-02-09 13:54:15'),
(7, 231, 'Chrysanthemum.jpg', 'Message', '2016-02-09 14:09:05'),
(8, 231, 'Desert.jpg', 'Message', '2016-02-09 14:09:05'),
(9, 231, 'Hydrangeas.jpg', 'Message', '2016-02-09 14:09:05'),
(10, 232, 'Chrysanthemum.jpg', 'Message', '2016-02-09 14:09:49'),
(11, 232, 'Desert.jpg', 'Message', '2016-02-09 14:09:49'),
(12, 232, 'Hydrangeas.jpg', 'Message', '2016-02-09 14:09:49'),
(13, 233, 'Chrysanthemum.jpg', 'Message', '2016-02-09 14:10:30'),
(14, 233, 'Desert.jpg', 'Message', '2016-02-09 14:10:30'),
(15, 233, 'Hydrangeas.jpg', 'Message', '2016-02-09 14:10:30'),
(16, 234, 'Chrysanthemum.jpg', 'Message', '2016-02-09 14:10:59'),
(17, 234, 'Desert.jpg', 'Message', '2016-02-09 14:11:00'),
(18, 234, 'Hydrangeas.jpg', 'Message', '2016-02-09 14:11:00'),
(19, 235, 'Chrysanthemum.jpg', 'Message', '2016-02-09 14:11:08'),
(20, 235, 'Desert.jpg', 'Message', '2016-02-09 14:11:08'),
(21, 235, 'Hydrangeas.jpg', 'Message', '2016-02-09 14:11:08'),
(22, 236, 'Chrysanthemum.jpg', 'Message', '2016-02-09 14:11:18'),
(23, 236, 'Desert.jpg', 'Message', '2016-02-09 14:11:18'),
(24, 236, 'Hydrangeas.jpg', 'Message', '2016-02-09 14:11:18'),
(25, 240, 'Chrysanthemum.jpg', 'Message', '2016-02-09 14:23:59'),
(26, 240, 'Desert.jpg', 'Message', '2016-02-09 14:23:59'),
(27, 241, 'Lighthouse.jpg', 'Message', '2016-02-09 15:33:05'),
(28, 241, 'Penguins.jpg', 'Message', '2016-02-09 15:33:05'),
(29, 241, 'Tulips.jpg', 'Message', '2016-02-09 15:33:05');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
