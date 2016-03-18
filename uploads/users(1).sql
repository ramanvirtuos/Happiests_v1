-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2016 at 04:45 PM
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
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `user_password` varchar(30) NOT NULL,
  `manager_id` varchar(30) DEFAULT NULL,
  `user_e_code` varchar(30) DEFAULT NULL COMMENT 'Employee Code',
  `user_access_type` enum('1','2','3') DEFAULT '3' COMMENT '1 = CEO/Director/HR, 2 = Manager, 3 = Associate',
  `user_role` enum('HR','IT','Accounts','Default') DEFAULT 'Default',
  `user_first_name` varchar(50) NOT NULL,
  `user_middle_name` varchar(50) DEFAULT NULL,
  `user_last_name` varchar(50) NOT NULL,
  `user_p_email` varchar(45) DEFAULT NULL COMMENT 'User Personal Email',
  `user_o_email` varchar(45) NOT NULL COMMENT 'User Official Email',
  `user_photo` varchar(255) DEFAULT NULL,
  `user_p_address` varchar(255) DEFAULT NULL COMMENT 'Permanent Address',
  `user_p_city` varchar(255) DEFAULT NULL COMMENT 'Permanent City',
  `user_p_state` varchar(255) DEFAULT NULL COMMENT 'Permanent State',
  `user_t_address` varchar(255) DEFAULT NULL COMMENT 'Temporary Address',
  `user_t_city` varchar(255) DEFAULT NULL COMMENT 'Temporary City',
  `user_t_state` varchar(255) DEFAULT NULL COMMENT 'Temporary State',
  `user_p_mobile` varchar(50) DEFAULT NULL COMMENT 'Personal Mobile Number',
  `user_o_mobile` varchar(50) DEFAULT NULL COMMENT 'Official Mobile Number',
  `user_landline_number` varchar(10) DEFAULT NULL,
  `user_extension_number` varchar(3) DEFAULT NULL,
  `user_emergency_mobile` varchar(50) DEFAULT NULL COMMENT 'Emergency Contact Number',
  `user_emergency_contact_type` enum('Wife','Father','Mother','Husband','Sibling','Aunt','Other') DEFAULT 'Other',
  `user_blood_group` char(3) DEFAULT NULL,
  `user_marital_status` enum('Single','Married','Null') DEFAULT 'Null',
  `user_work_location` enum('Gurgaon','Mumbai','Bangalore') DEFAULT NULL,
  `user_pan` varchar(45) DEFAULT NULL COMMENT 'Permanent Account Number',
  `user_dob` date DEFAULT '0000-00-00',
  `user_date_of_joining` date DEFAULT '0000-00-00',
  `user_department` enum('VCEX','YMWD','VCPS','VQA','YMIM','YMCD','HRAA','GIFTCART') DEFAULT NULL,
  `user_group` enum('Launchpad','Virtuos','Giftcart') DEFAULT 'Virtuos',
  `user_type` enum('QE','PE') DEFAULT NULL,
  `user_designation` varchar(100) DEFAULT NULL,
  `user_remaining_cl` int(50) DEFAULT NULL,
  `user_remaining_sl` int(50) DEFAULT NULL,
  `user_remaining_ccl` int(50) DEFAULT NULL,
  `user_remaining_rh` int(50) DEFAULT NULL,
  `user_weekly_shortfall` time DEFAULT NULL,
  `user_status` enum('Active','Inactive') DEFAULT 'Active',
  `user_bank_name` varchar(45) DEFAULT NULL,
  `user_bank_account_number` varchar(45) DEFAULT NULL,
  `user_bank_account_holder` varchar(45) DEFAULT NULL,
  `user_bank_address` varchar(255) DEFAULT NULL,
  `user_bank_ifsc` varchar(45) DEFAULT NULL,
  `user_create_date` date DEFAULT NULL,
  `user_new` char(1) DEFAULT '1',
  `user_spouse_name` varchar(50) DEFAULT NULL,
  `user_spouse_employer` varchar(50) DEFAULT NULL,
  `user_spouse_mobile` varchar(50) DEFAULT NULL,
  `user_anniversary` date DEFAULT NULL,
  `user_mother_tongue` enum('Hindi','English','Punjabi','Other') DEFAULT 'Hindi',
  `user_medical_history` longtext,
  `user_wishlist` longtext,
  `user_police_case` enum('Yes','No') DEFAULT 'No',
  `user_arrested` enum('Yes','No') DEFAULT 'No',
  `relatives_in_virtuos` enum('Yes','No') DEFAULT NULL,
  `relative_name` varchar(45) DEFAULT NULL,
  `relative_designation` varchar(45) DEFAULT NULL,
  `language_spoken` varchar(45) DEFAULT NULL,
  `language_written` varchar(45) DEFAULT NULL,
  `language_read` varchar(45) DEFAULT NULL,
  `user_family_name` varchar(45) DEFAULT NULL,
  `user_family_dob` date DEFAULT NULL,
  `user_family_relation` enum('Husband','Wife','Mother','Father','Sibling','Other') DEFAULT NULL,
  `user_family_occupation` varchar(45) DEFAULT NULL,
  `user_skills` longtext,
  `user_hobbies` longtext,
  `user_description` longtext,
  `user_p_zip` varchar(45) DEFAULT NULL,
  `user_t_zip` varchar(45) DEFAULT NULL,
  `user_emergency_address` varchar(255) DEFAULT NULL,
  `random_key` varchar(45) DEFAULT NULL,
  `user_status_change` date DEFAULT '0000-00-00',
  `user_notes` longtext,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id_UNIQUE` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Employees, Manager, Directors.' AUTO_INCREMENT=44 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `manager_id`, `user_e_code`, `user_access_type`, `user_role`, `user_first_name`, `user_middle_name`, `user_last_name`, `user_p_email`, `user_o_email`, `user_photo`, `user_p_address`, `user_p_city`, `user_p_state`, `user_t_address`, `user_t_city`, `user_t_state`, `user_p_mobile`, `user_o_mobile`, `user_landline_number`, `user_extension_number`, `user_emergency_mobile`, `user_emergency_contact_type`, `user_blood_group`, `user_marital_status`, `user_work_location`, `user_pan`, `user_dob`, `user_date_of_joining`, `user_department`, `user_group`, `user_type`, `user_designation`, `user_remaining_cl`, `user_remaining_sl`, `user_remaining_ccl`, `user_remaining_rh`, `user_weekly_shortfall`, `user_status`, `user_bank_name`, `user_bank_account_number`, `user_bank_account_holder`, `user_bank_address`, `user_bank_ifsc`, `user_create_date`, `user_new`, `user_spouse_name`, `user_spouse_employer`, `user_spouse_mobile`, `user_anniversary`, `user_mother_tongue`, `user_medical_history`, `user_wishlist`, `user_police_case`, `user_arrested`, `relatives_in_virtuos`, `relative_name`, `relative_designation`, `language_spoken`, `language_written`, `language_read`, `user_family_name`, `user_family_dob`, `user_family_relation`, `user_family_occupation`, `user_skills`, `user_hobbies`, `user_description`, `user_p_zip`, `user_t_zip`, `user_emergency_address`, `random_key`, `user_status_change`, `user_notes`) VALUES
(1, 'gs.saini', 'apple', '', 'VINGSS1401', '1', 'HR', 'Gursimran', 'Singh', 'Saini', 'simranjazz@gmail.com', 'gs.saini@virtuos.com', NULL, 'A-26, Azad Nagar, Sirhind Road', 'PATIALA', 'Punjab', 'Second Floor, 610, Sector - 9', 'GURGAON', 'Haryana', '9910102543', '9810085565', '4985530', '530', '9910256669', 'Father', 'O-', 'Single', 'Gurgaon', 'FALPS2786F', '1992-11-03', '2014-07-07', 'VCPS', 'Launchpad', 'QE', 'ExperienceCloud Associate - Technical', 2, 0, 3, 3, NULL, 'Active', 'State Bank of Patiala', '55150817715', 'GURSIMRAN SINGH SAINI', 'MUNICIPAL TOWER, RAILWAY ROAD, DHOBIGHAT, GURGAON(HARYANA)', 'STBP0000232', '2014-11-17', '0', NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', 'very hardworking'),
(2, 'venky.reddy', 'venky', '', 'VINVVR1501', '1', 'Default', 'Venky', 'Vijay', 'Reddi', '', 'vir@virtuos.com', NULL, '', '', '', '', '', '', '', '9810075996', '498511', '511', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'VCEX', 'Virtuos', 'QE', 'President/CEO', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', '', '', '', '2016-01-11', 'Hindi', '', '', 'No', 'No', 'No', '', '', '', '', '', '', '2016-01-11', 'Father', '', '', '', '', '', '', '', NULL, '2016-01-11', ''),
(3, 'shaloo.reddi', 'shaloo', '', 'VINSHR0801', '1', 'Default', 'Shaloo', '', 'Reddi', '', 'sr@virtuos.com', NULL, '', '', '', '', '', '', '', '9810065996', '4985514', '514', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'VCEX', 'Virtuos', 'QE', 'VP-HR/ Director', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '2016-01-11', ''),
(4, 'harish.sharma', 'harish', '', 'VINHAS1001', '3', 'Default', 'Harish', '', 'Sharma', '', 'harish.sharma@virtuos.com', NULL, '', '', '', '', '', '', '', '', '4985546', '546', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'YMWD', 'Virtuos', 'PE', 'UI/UX Development Lead', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '0000-00-00', ''),
(5, 'narendra.kumar', 'narendra', '', 'VINNAK1001', '3', 'Default', 'Narendra', '', 'Kumar', '', 'narendra.kumar@virtuos.com', NULL, '', '', '', '', '', '', '', '9810024708', '4985522', '522', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '0000-00-00', 'YMWD', 'Virtuos', 'QE', 'Lead Solution Developer', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '2016-01-11', ''),
(6, 'moh.yunus', 'yunus', '', 'VINMOY1301', '3', 'Default', 'Mohammad', '', 'Yunus', '', 'md.yunus@virtuos.com', NULL, '', '', '', '', '', '', '', '', '498545', '545', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'YMWD', 'Virtuos', 'QE', 'Graphic Designer', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '2016-01-11', ''),
(7, 'sristy.arya', 'sristy', '', 'VINSRA1501', '1', 'Default', 'Sristy', '', 'Arya', '', 'sristy.arya@virtuos.com', NULL, '', '', '', '', '', '', '', '', '498559', '559', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'VCPS', 'Virtuos', 'PE', 'Application Development Associate', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '0000-00-00', ''),
(8, 'shubham.arora', 'shubham', '', 'VINSHa1501', '3', 'Default', 'Shubham', '', 'Arora', '', 'shubham.arora@virtuos.com', NULL, '', '', '', '', '', '', '', '', '498559', '559', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'VCPS', 'Virtuos', 'PE', 'Application Engineer Associate', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '0000-00-00', ''),
(9, 'sawkat.alam', 'sawkat', '', 'GCSSAA1201', '3', 'Default', 'Sawkat', '', 'Alam', '', 'sawkat_alam@bluehorse.in', NULL, '', '', '', '', '', '', '', '', '498542', '542', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'YMWD', 'Virtuos', 'QE', 'Team Leader', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '2016-01-11', ''),
(10, 'manish.ranjan', 'manish', '', 'VINMAR1501', '3', 'Default', 'Manish', '', 'Ranjan', 'manish24online@gmail.com', 'manish.ranjan@virtuos.com', NULL, '138, Shiv Vihar, Saran Nagar', 'Jodhpur', 'Rajasthan', '1336, 2nd Floor, Sector 17C', 'Gurgaon', 'Haryana', '8527267560', '', '498531', '531', '9414721273', 'Mother', 'B+', '', 'Gurgaon', 'ASFPR9038L', '2016-01-11', '2016-01-11', 'YMWD', 'Virtuos', 'PE', 'Sr.Software Developer', 12, 3, 3, 3, NULL, 'Active', 'Virtuos Solution Pvt Ltd', '002101601118', 'Manish Ranjan', 'ICICI Bank Ltd, Sector 14, Gurgaon', 'ICIC0000021', '2016-01-11', '0', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '', '', NULL, NULL, '0000-00-00', ''),
(11, 'amarinder.singh', 'amarinder', '', 'VINAM0801', '3', 'Default', 'Amarinder', '', 'Singh', '', 'am.singh@virtuos.com', NULL, '', '', '', '', '', '', '', '9810090766', '498519', '519', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'VCPS', 'Virtuos', 'QE', 'Head of CX Services', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '2016-01-11', ''),
(12, 'vaibhav.bhatia', 'vaibhav', '', 'VINVAB1401', '3', 'Default', 'Vaibhav', '', 'Bhatia', '', 'vaibhav.bhatia@virtuos.com', NULL, '', '', '', '', '', '', '', '9910577199', '498528', '528', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'VCPS', 'Virtuos', 'QE', 'Exp.Cloud Associate Technical', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '2016-01-11', ''),
(13, 'pooja.gupta', 'pooja', '', 'VINPOG1501', '3', 'Default', 'Pooja', '', 'Gupta', '', 'pooja.gupta@virtuos.com', NULL, '', '', '', '', '', '', '', '9643401941', '498521', '521', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'VCPS', 'Virtuos', 'QE', 'Exp.Cloud Associate Technical', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '2016-01-11', ''),
(14, 'shivdeep.kumar', 'Newuser@1', '', 'VINSKY1501', '3', 'Default', 'Shivdeep', '', 'Kumar', '', 'shivdeep.kumar@virtuos.com', NULL, '', '', '', '', '', '', '', '9643401942', '498540', '540', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'VCPS', 'Virtuos', 'PE', 'Application Associate', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '0000-00-00', ''),
(15, 'ayushi.sharma', 'ayushi', '', 'VINAYS1501', '3', 'Default', 'Ayushi', '', 'Sharma', '', 'ayushi.sharma@virtuos.com', NULL, '', '', '', '', '', '', '', '', '498565', '565', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'VCPS', 'Virtuos', 'PE', 'Application Engineer Associate', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '0000-00-00', ''),
(16, 'bhavishya.khurana', 'bhavishya', '', 'VINBHK1510', '3', 'Default', 'Bhavishya', '', 'Khurana', '', 'bhavishya.k@virtuos.com', NULL, '', '', '', '', '', '', '', '', '498557', '557', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'VCPS', 'Virtuos', 'PE', 'Application Development Associate', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '0000-00-00', ''),
(17, 'divyanshi.yadav', 'divyanshi', '', 'VINDIY1501', '3', 'Default', 'Divyanshi', '', 'Yadav', '', 'divyanshi.y@virtuos.com', NULL, '', '', '', '', '', '', '', '', '498554', '554', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'VCPS', 'Virtuos', 'PE', 'Application Development Associate', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '0000-00-00', ''),
(18, 'kanika.dua', 'kanika', '', 'VINKAD1501', '3', 'Default', 'Kanika', '', 'Dua', '', 'kanika.dua@virtuos.com', NULL, '', '', '', '', '', '', '', '', '498558', '558', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'VCPS', 'Virtuos', 'PE', 'Application Development Associate', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '0000-00-00', ''),
(19, 'mahak.bansal', 'mahak', '', 'VINMAB1501', '3', 'Default', 'Mahak', '', 'Bansal', '', 'mahak.b@virtuos.com', NULL, '', '', '', '', '', '', '', '', '498553', '553', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'VCPS', 'Virtuos', 'PE', 'Application Engineer Associate', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '0000-00-00', ''),
(20, 'nisha.yadav', 'nisha', '', 'VINNIY1510', '3', 'Default', 'Nisha', '', 'Yadav', '', 'nisha.yadav@virtuos.com', NULL, '', '', '', '', '', '', '', '', '498527', '527', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'VCPS', 'Virtuos', 'PE', 'Application Development Associate', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '0000-00-00', ''),
(21, 'pooja.bajaj', 'pooja', '', 'VINPOOB1501', '3', 'Default', 'Pooja', '', 'Bajaj', '', 'pooja.bajaj@virtuos.com', NULL, '', '', '', '', '', '', '', '', '498527', '527', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'VCPS', 'Virtuos', 'PE', 'Application Development Associate', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '0000-00-00', ''),
(22, 'priyanshi.aggarwal', 'priyanshi', '', 'VINPRA1501', '3', 'Default', 'Priyanshi', '', 'Aggarwal', '', 'priyanshi.a@virtuos.com', NULL, '', '', '', '', '', '', '', '', '498556', '556', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'VCPS', 'Virtuos', 'PE', 'Application Engineer Associate', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '0000-00-00', ''),
(23, 'richa.aneja', 'richa', '', 'VINRIA1501', '3', 'Default', 'Richa', '', 'Aneja', '', 'richa.aneja@virtuos.com', NULL, '', '', '', '', '', '', '', '', '498558', '558', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'VCPS', 'Virtuos', 'PE', 'Application Engineer Associate', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '0000-00-00', ''),
(24, 'satakshi.chaudhary', 'priyanshi', '', 'VINSAC1501', '3', 'Default', 'Satakshi', '', 'Chaudhary', '', 'satakshi.c@virtuos.com', NULL, '', '', '', '', '', '', '', '', '498553', '553', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'VCPS', 'Virtuos', 'PE', 'Application Engineer Associate', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '0000-00-00', ''),
(25, 'sugandha.arya', 'sugandha', '', 'VINSUA1501', '3', 'Default', 'Sugandha', '', 'Arya', '', 'sugandha.arya@virtuos.com', NULL, '', '', '', '', '', '', '', '', '498554', '554', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'VCPS', 'Virtuos', 'PE', 'Application Development Associate', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '0000-00-00', ''),
(26, 'sandeep.rai', 'sandeep', '', 'VINSKR1501', '3', 'Default', 'Sandeep', '', 'Rai', '', 'sandeep.rai@virtuos.com', NULL, '', '', '', '', '', '', '', '', '498502', '502', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'VCPS', 'Virtuos', 'PE', 'Application Associate', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '0000-00-00', ''),
(27, 'neeraj.rohilla', 'neeraj', '', 'VINNER1501', '3', 'Default', 'Neeraj', '', 'Rohilla', '', 'neeraj.rohilla@virtuos.com', NULL, '', '', '', '', '', '', '', '', '498529', '529', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'VQA', 'Virtuos', 'QE', 'Quality Analyst Associate', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '2016-01-11', ''),
(28, 'shivaji.dubey', 'shivaji', '', 'VINSHD1501', '3', 'Default', 'Shivaji', '', 'Dubey', '', 'shivaji.dubey@virtuos.com', NULL, '', '', '', '', '', '', '', '9810055581', '498534', '534', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'YMIM', 'Virtuos', 'QE', 'Sr.Digital Marketing Associate', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '2016-01-11', ''),
(29, 'namrata.shrivastava', 'namrata', '', 'VINNAS1501', '3', 'Default', 'Namrata', '', 'Shrivastava', '', 'namrata.s@virtuos.com', NULL, '', '', '', '', '', '', '', '', '4985532', '532', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'YMIM', 'Virtuos', 'QE', 'SEO Associate', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '2016-01-11', ''),
(30, 'divya.wilson', 'divya', '', 'VINDIW1301', '3', 'Default', 'Divya', '', 'Wilson', '', 'divya.wilson@virtuos.com', NULL, '', '', '', '', '', '', '', '', '498536', '536', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'YMCD', 'Virtuos', 'QE', 'Asst Manager Content & Digital Media', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '2016-01-11', ''),
(31, 'iliena.bosu', 'iliena', '', 'VINILB1301', '3', 'Default', 'Iliena', '', 'Bosu', '', 'iliena.bosu@gmail.com', NULL, '', '', '', '', '', '', '', '', '4985535', '535', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'YMCD', 'Virtuos', 'QE', 'Content Writer', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '2016-01-11', ''),
(32, 'sunny.sharma', 'sunny', '', 'VINSUS1401', '3', '', 'Sunny', '', 'Sharma', '', 'sunny.sharma@virtuos.com', NULL, '', '', '', '', '', '', '', '9810822708', '4985512', '512', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'HRAA', 'Virtuos', 'QE', 'Sr.Accountant', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '2016-01-11', ''),
(33, 'rahul.sharma', 'rahul', '', 'VINRAS1201', '3', 'IT', 'Rahul', '', 'Sharma', 'rahul.ibs1@gmail.com', 'rahul.sharma@virtuos.com', NULL, '16/3 Umri Road Sec 13 Kurukshetra', 'Kurukshetra', 'Haryana', '2078/3 New Shiv mandir near Sec14', 'gurgaon', 'Haryana', '9540458218', '9810052456', '4985562', '562', '9654795782', 'Wife', 'O+', 'Married', 'Gurgaon', 'DAJPS4962K', '1986-02-25', '2016-01-11', 'HRAA', 'Virtuos', 'QE', 'IT/Office Administrator', 12, 3, 3, 3, NULL, 'Active', 'ICICI Bank', '002101601057', 'Rahul Sharma', 'udyog vihar phase 5 gurgaon', 'ICIC0001145', '2016-01-11', '0', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '', '', NULL, NULL, '2016-01-11', ''),
(34, 'palvika.jindal', 'palvika', '', 'VINPAJ1401', '3', 'HR', 'Palvika', '', 'Jindal', '', 'palvika.jindal@virtuos.com', NULL, '', '', '', '', '', '', '', '9810068322', '498513', '513', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'HRAA', 'Virtuos', 'QE', 'Sr.Executive - HR', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '2016-01-11', ''),
(35, 'basant.vats', 'basant', '', 'VINBAV1501', '3', '', 'Basant', '', 'Vats', 'cabasantvats@gmail.com', 'basant.vats@virtuos.com', NULL, '6/40 VATS RESIDENCE, HAILY MANDI, PATAUDI', 'GURGAON', 'Haryana', 'B-29B, SURYA VIHAR', 'GURGAON', 'Haryana', '9671892989', '', '4985512', '512', '9812698850', 'Father', 'B+', 'Single', 'Gurgaon', 'AURPV0197L', '1990-01-30', '2016-01-11', 'HRAA', 'Virtuos', 'QE', 'Sr.Accounts Executive', 12, 3, 3, 3, NULL, 'Active', 'ICICI', '017701587139', 'BASANT VATS', 'DLF PHASE 5, GURGAON', 'ICIC0000177', '2016-01-11', '0', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '', '', NULL, NULL, '2016-01-11', ''),
(36, 'tanvi.chadha', 'tanvi', '', 'VINTAC1501', '3', 'Default', 'Tanvi', '', 'Chadha', '', 'tanvi.chadha@virtuos.com', NULL, '', '', '', '', '', '', '', '', '4985539', '539', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', '', 'Virtuos', 'QE', 'Customer Service Executive', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '2016-01-11', ''),
(37, 'bilal.kirmani', 'bilal', '', 'GCBIK1401', '3', 'Default', 'Bilal', '', 'Kirmani', '', 'bilal.k@giftcart.com', NULL, '', '', '', '', '', '', '', '9650003314', '498538', '538', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'GIFTCART', 'Virtuos', 'PE', 'Category Associate Trainee', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '0000-00-00', ''),
(38, 'saumya.rastogi', 'saumya', '', 'GCSAR1401', '3', 'Default', 'Saumya', '', 'Rastogi', 'saumya120535@gmail.com', 'saumya.r@giftcart.com', NULL, '223/54,Rastogi Tola,Raja Bazaar Lucknow', 'Lucknow', 'Uttar Pradesh', 'U53/1,Sharma Appartments,U-Block,Dlf phase 3,Gurgaon', 'Gurgaon', 'Haryana', '7065432506', '9650003392', '498523', '523', '9335239739', 'Father', 'O-', 'Single', 'Gurgaon', 'BYTPR1316Q', '1993-03-25', '2016-01-11', 'GIFTCART', 'Virtuos', 'PE', 'Category Associate Trainee', 12, 3, 3, 3, NULL, 'Active', 'PUNJAB NATIONAL BANK', '1671000101122158', 'SAUMYA RASTOGI', 'SUBHASH MARG, LUCKNOW BRANCH, LUCKNOW, UTTAR PRADESH', 'PUNB0167100', '2016-01-11', '0', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '', '', NULL, NULL, '0000-00-00', ''),
(39, 'sabhyata.sharma', 'sabhyata', '', 'GCSAS1501', '3', 'Default', 'Sabhyata', '', 'Sharma', 'sabhyata19@gmail.com', 'sabhyata.s@giftcart.com', NULL, 'F-4,1st Floor, Module-11, Mangalam Apartments, Abhay Khand-3, Indirapuram', 'Ghaziabad', 'Uttar Pradesh', 'F-4,1st Floor, Module-11, Mangalam Apartments, Abhay Khand-3, Indirapuram', 'Ghaziabad', 'Uttar Pradesh', '8506009040', '9810078878', '498525', '525', '8447047288', 'Mother', 'O+', 'Single', 'Gurgaon', 'FSBPS60404M', '1991-07-27', '2016-01-11', 'GIFTCART', 'Virtuos', 'PE', 'Category Associate ', 12, 3, 3, 3, NULL, 'Active', 'Kotak Mahindra', '9111230238', 'Sabhyata Sharma', 'Sector-63, Noida', 'KKBK0000180', '2016-01-11', '0', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '', '', NULL, NULL, '0000-00-00', ''),
(40, 'agam.bhatnagar', 'agam', '', 'GCAGB1501', '3', 'Default', 'Agam', '', 'Bhatnagar', '', 'agam.b@giftcart.com', NULL, '', '', '', '', '', '', '', '9810075902', '498524', '524', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2015-01-15', 'GIFTCART', 'Virtuos', 'PE', 'Category Associate', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '0000-00-00', ''),
(41, 'ar.sreenivas', 'sreenivas', '', 'VINARS1001', '3', 'Default', 'Ar', '', 'Sreenivas', '', 'ar.sreenivas@virtuos.com', NULL, '', '', '', '', '', '', '', '9910574499', '498503', '503', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', '', 'Virtuos', 'QE', 'Business Operations Manager', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '0000-00-00', NULL),
(42, 'ankush.bhardawaj', 'ankush', '', 'VINANB1501', '3', 'Default', 'Ankush', '', 'Bhardawaj', '', 'ankush.b@virtuos.com', NULL, '', '', '', '', '', '', '', '8588880508', '4985541', '541', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', '', 'Virtuos', 'QE', 'Business Head Exp.Cloud', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '2016-01-11', ''),
(43, 'rajiv.saikia', 'rajiv', '', 'VINRAS1501', '3', 'Default', 'Rajiv', '', 'Saikia', '', 'rajiv.saikia@virtuos.com', NULL, '', '', '', '', '', '', '', '', '4985541', '541', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', '', 'Virtuos', 'QE', 'Inside Sales Executive', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '0000-00-00', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2016 at 04:45 PM
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
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `user_password` varchar(30) NOT NULL,
  `manager_id` varchar(30) DEFAULT NULL,
  `user_e_code` varchar(30) DEFAULT NULL COMMENT 'Employee Code',
  `user_access_type` enum('1','2','3') DEFAULT '3' COMMENT '1 = CEO/Director/HR, 2 = Manager, 3 = Associate',
  `user_role` enum('HR','IT','Accounts','Default') DEFAULT 'Default',
  `user_first_name` varchar(50) NOT NULL,
  `user_middle_name` varchar(50) DEFAULT NULL,
  `user_last_name` varchar(50) NOT NULL,
  `user_p_email` varchar(45) DEFAULT NULL COMMENT 'User Personal Email',
  `user_o_email` varchar(45) NOT NULL COMMENT 'User Official Email',
  `user_photo` varchar(255) DEFAULT NULL,
  `user_p_address` varchar(255) DEFAULT NULL COMMENT 'Permanent Address',
  `user_p_city` varchar(255) DEFAULT NULL COMMENT 'Permanent City',
  `user_p_state` varchar(255) DEFAULT NULL COMMENT 'Permanent State',
  `user_t_address` varchar(255) DEFAULT NULL COMMENT 'Temporary Address',
  `user_t_city` varchar(255) DEFAULT NULL COMMENT 'Temporary City',
  `user_t_state` varchar(255) DEFAULT NULL COMMENT 'Temporary State',
  `user_p_mobile` varchar(50) DEFAULT NULL COMMENT 'Personal Mobile Number',
  `user_o_mobile` varchar(50) DEFAULT NULL COMMENT 'Official Mobile Number',
  `user_landline_number` varchar(10) DEFAULT NULL,
  `user_extension_number` varchar(3) DEFAULT NULL,
  `user_emergency_mobile` varchar(50) DEFAULT NULL COMMENT 'Emergency Contact Number',
  `user_emergency_contact_type` enum('Wife','Father','Mother','Husband','Sibling','Aunt','Other') DEFAULT 'Other',
  `user_blood_group` char(3) DEFAULT NULL,
  `user_marital_status` enum('Single','Married','Null') DEFAULT 'Null',
  `user_work_location` enum('Gurgaon','Mumbai','Bangalore') DEFAULT NULL,
  `user_pan` varchar(45) DEFAULT NULL COMMENT 'Permanent Account Number',
  `user_dob` date DEFAULT '0000-00-00',
  `user_date_of_joining` date DEFAULT '0000-00-00',
  `user_department` enum('VCEX','YMWD','VCPS','VQA','YMIM','YMCD','HRAA','GIFTCART') DEFAULT NULL,
  `user_group` enum('Launchpad','Virtuos','Giftcart') DEFAULT 'Virtuos',
  `user_type` enum('QE','PE') DEFAULT NULL,
  `user_designation` varchar(100) DEFAULT NULL,
  `user_remaining_cl` int(50) DEFAULT NULL,
  `user_remaining_sl` int(50) DEFAULT NULL,
  `user_remaining_ccl` int(50) DEFAULT NULL,
  `user_remaining_rh` int(50) DEFAULT NULL,
  `user_weekly_shortfall` time DEFAULT NULL,
  `user_status` enum('Active','Inactive') DEFAULT 'Active',
  `user_bank_name` varchar(45) DEFAULT NULL,
  `user_bank_account_number` varchar(45) DEFAULT NULL,
  `user_bank_account_holder` varchar(45) DEFAULT NULL,
  `user_bank_address` varchar(255) DEFAULT NULL,
  `user_bank_ifsc` varchar(45) DEFAULT NULL,
  `user_create_date` date DEFAULT NULL,
  `user_new` char(1) DEFAULT '1',
  `user_spouse_name` varchar(50) DEFAULT NULL,
  `user_spouse_employer` varchar(50) DEFAULT NULL,
  `user_spouse_mobile` varchar(50) DEFAULT NULL,
  `user_anniversary` date DEFAULT NULL,
  `user_mother_tongue` enum('Hindi','English','Punjabi','Other') DEFAULT 'Hindi',
  `user_medical_history` longtext,
  `user_wishlist` longtext,
  `user_police_case` enum('Yes','No') DEFAULT 'No',
  `user_arrested` enum('Yes','No') DEFAULT 'No',
  `relatives_in_virtuos` enum('Yes','No') DEFAULT NULL,
  `relative_name` varchar(45) DEFAULT NULL,
  `relative_designation` varchar(45) DEFAULT NULL,
  `language_spoken` varchar(45) DEFAULT NULL,
  `language_written` varchar(45) DEFAULT NULL,
  `language_read` varchar(45) DEFAULT NULL,
  `user_family_name` varchar(45) DEFAULT NULL,
  `user_family_dob` date DEFAULT NULL,
  `user_family_relation` enum('Husband','Wife','Mother','Father','Sibling','Other') DEFAULT NULL,
  `user_family_occupation` varchar(45) DEFAULT NULL,
  `user_skills` longtext,
  `user_hobbies` longtext,
  `user_description` longtext,
  `user_p_zip` varchar(45) DEFAULT NULL,
  `user_t_zip` varchar(45) DEFAULT NULL,
  `user_emergency_address` varchar(255) DEFAULT NULL,
  `random_key` varchar(45) DEFAULT NULL,
  `user_status_change` date DEFAULT '0000-00-00',
  `user_notes` longtext,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id_UNIQUE` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Employees, Manager, Directors.' AUTO_INCREMENT=44 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `manager_id`, `user_e_code`, `user_access_type`, `user_role`, `user_first_name`, `user_middle_name`, `user_last_name`, `user_p_email`, `user_o_email`, `user_photo`, `user_p_address`, `user_p_city`, `user_p_state`, `user_t_address`, `user_t_city`, `user_t_state`, `user_p_mobile`, `user_o_mobile`, `user_landline_number`, `user_extension_number`, `user_emergency_mobile`, `user_emergency_contact_type`, `user_blood_group`, `user_marital_status`, `user_work_location`, `user_pan`, `user_dob`, `user_date_of_joining`, `user_department`, `user_group`, `user_type`, `user_designation`, `user_remaining_cl`, `user_remaining_sl`, `user_remaining_ccl`, `user_remaining_rh`, `user_weekly_shortfall`, `user_status`, `user_bank_name`, `user_bank_account_number`, `user_bank_account_holder`, `user_bank_address`, `user_bank_ifsc`, `user_create_date`, `user_new`, `user_spouse_name`, `user_spouse_employer`, `user_spouse_mobile`, `user_anniversary`, `user_mother_tongue`, `user_medical_history`, `user_wishlist`, `user_police_case`, `user_arrested`, `relatives_in_virtuos`, `relative_name`, `relative_designation`, `language_spoken`, `language_written`, `language_read`, `user_family_name`, `user_family_dob`, `user_family_relation`, `user_family_occupation`, `user_skills`, `user_hobbies`, `user_description`, `user_p_zip`, `user_t_zip`, `user_emergency_address`, `random_key`, `user_status_change`, `user_notes`) VALUES
(1, 'gs.saini', 'apple', '', 'VINGSS1401', '1', 'HR', 'Gursimran', 'Singh', 'Saini', 'simranjazz@gmail.com', 'gs.saini@virtuos.com', NULL, 'A-26, Azad Nagar, Sirhind Road', 'PATIALA', 'Punjab', 'Second Floor, 610, Sector - 9', 'GURGAON', 'Haryana', '9910102543', '9810085565', '4985530', '530', '9910256669', 'Father', 'O-', 'Single', 'Gurgaon', 'FALPS2786F', '1992-11-03', '2014-07-07', 'VCPS', 'Launchpad', 'QE', 'ExperienceCloud Associate - Technical', 2, 0, 3, 3, NULL, 'Active', 'State Bank of Patiala', '55150817715', 'GURSIMRAN SINGH SAINI', 'MUNICIPAL TOWER, RAILWAY ROAD, DHOBIGHAT, GURGAON(HARYANA)', 'STBP0000232', '2014-11-17', '0', NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0000-00-00', 'very hardworking'),
(2, 'venky.reddy', 'venky', '', 'VINVVR1501', '1', 'Default', 'Venky', 'Vijay', 'Reddi', '', 'vir@virtuos.com', NULL, '', '', '', '', '', '', '', '9810075996', '498511', '511', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'VCEX', 'Virtuos', 'QE', 'President/CEO', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', '', '', '', '2016-01-11', 'Hindi', '', '', 'No', 'No', 'No', '', '', '', '', '', '', '2016-01-11', 'Father', '', '', '', '', '', '', '', NULL, '2016-01-11', ''),
(3, 'shaloo.reddi', 'shaloo', '', 'VINSHR0801', '1', 'Default', 'Shaloo', '', 'Reddi', '', 'sr@virtuos.com', NULL, '', '', '', '', '', '', '', '9810065996', '4985514', '514', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'VCEX', 'Virtuos', 'QE', 'VP-HR/ Director', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '2016-01-11', ''),
(4, 'harish.sharma', 'harish', '', 'VINHAS1001', '3', 'Default', 'Harish', '', 'Sharma', '', 'harish.sharma@virtuos.com', NULL, '', '', '', '', '', '', '', '', '4985546', '546', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'YMWD', 'Virtuos', 'PE', 'UI/UX Development Lead', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '0000-00-00', ''),
(5, 'narendra.kumar', 'narendra', '', 'VINNAK1001', '3', 'Default', 'Narendra', '', 'Kumar', '', 'narendra.kumar@virtuos.com', NULL, '', '', '', '', '', '', '', '9810024708', '4985522', '522', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '0000-00-00', 'YMWD', 'Virtuos', 'QE', 'Lead Solution Developer', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '2016-01-11', ''),
(6, 'moh.yunus', 'yunus', '', 'VINMOY1301', '3', 'Default', 'Mohammad', '', 'Yunus', '', 'md.yunus@virtuos.com', NULL, '', '', '', '', '', '', '', '', '498545', '545', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'YMWD', 'Virtuos', 'QE', 'Graphic Designer', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '2016-01-11', ''),
(7, 'sristy.arya', 'sristy', '', 'VINSRA1501', '1', 'Default', 'Sristy', '', 'Arya', '', 'sristy.arya@virtuos.com', NULL, '', '', '', '', '', '', '', '', '498559', '559', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'VCPS', 'Virtuos', 'PE', 'Application Development Associate', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '0000-00-00', ''),
(8, 'shubham.arora', 'shubham', '', 'VINSHa1501', '3', 'Default', 'Shubham', '', 'Arora', '', 'shubham.arora@virtuos.com', NULL, '', '', '', '', '', '', '', '', '498559', '559', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'VCPS', 'Virtuos', 'PE', 'Application Engineer Associate', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '0000-00-00', ''),
(9, 'sawkat.alam', 'sawkat', '', 'GCSSAA1201', '3', 'Default', 'Sawkat', '', 'Alam', '', 'sawkat_alam@bluehorse.in', NULL, '', '', '', '', '', '', '', '', '498542', '542', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'YMWD', 'Virtuos', 'QE', 'Team Leader', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '2016-01-11', ''),
(10, 'manish.ranjan', 'manish', '', 'VINMAR1501', '3', 'Default', 'Manish', '', 'Ranjan', 'manish24online@gmail.com', 'manish.ranjan@virtuos.com', NULL, '138, Shiv Vihar, Saran Nagar', 'Jodhpur', 'Rajasthan', '1336, 2nd Floor, Sector 17C', 'Gurgaon', 'Haryana', '8527267560', '', '498531', '531', '9414721273', 'Mother', 'B+', '', 'Gurgaon', 'ASFPR9038L', '2016-01-11', '2016-01-11', 'YMWD', 'Virtuos', 'PE', 'Sr.Software Developer', 12, 3, 3, 3, NULL, 'Active', 'Virtuos Solution Pvt Ltd', '002101601118', 'Manish Ranjan', 'ICICI Bank Ltd, Sector 14, Gurgaon', 'ICIC0000021', '2016-01-11', '0', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '', '', NULL, NULL, '0000-00-00', ''),
(11, 'amarinder.singh', 'amarinder', '', 'VINAM0801', '3', 'Default', 'Amarinder', '', 'Singh', '', 'am.singh@virtuos.com', NULL, '', '', '', '', '', '', '', '9810090766', '498519', '519', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'VCPS', 'Virtuos', 'QE', 'Head of CX Services', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '2016-01-11', ''),
(12, 'vaibhav.bhatia', 'vaibhav', '', 'VINVAB1401', '3', 'Default', 'Vaibhav', '', 'Bhatia', '', 'vaibhav.bhatia@virtuos.com', NULL, '', '', '', '', '', '', '', '9910577199', '498528', '528', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'VCPS', 'Virtuos', 'QE', 'Exp.Cloud Associate Technical', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '2016-01-11', ''),
(13, 'pooja.gupta', 'pooja', '', 'VINPOG1501', '3', 'Default', 'Pooja', '', 'Gupta', '', 'pooja.gupta@virtuos.com', NULL, '', '', '', '', '', '', '', '9643401941', '498521', '521', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'VCPS', 'Virtuos', 'QE', 'Exp.Cloud Associate Technical', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '2016-01-11', ''),
(14, 'shivdeep.kumar', 'Newuser@1', '', 'VINSKY1501', '3', 'Default', 'Shivdeep', '', 'Kumar', '', 'shivdeep.kumar@virtuos.com', NULL, '', '', '', '', '', '', '', '9643401942', '498540', '540', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'VCPS', 'Virtuos', 'PE', 'Application Associate', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '0000-00-00', ''),
(15, 'ayushi.sharma', 'ayushi', '', 'VINAYS1501', '3', 'Default', 'Ayushi', '', 'Sharma', '', 'ayushi.sharma@virtuos.com', NULL, '', '', '', '', '', '', '', '', '498565', '565', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'VCPS', 'Virtuos', 'PE', 'Application Engineer Associate', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '0000-00-00', ''),
(16, 'bhavishya.khurana', 'bhavishya', '', 'VINBHK1510', '3', 'Default', 'Bhavishya', '', 'Khurana', '', 'bhavishya.k@virtuos.com', NULL, '', '', '', '', '', '', '', '', '498557', '557', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'VCPS', 'Virtuos', 'PE', 'Application Development Associate', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '0000-00-00', ''),
(17, 'divyanshi.yadav', 'divyanshi', '', 'VINDIY1501', '3', 'Default', 'Divyanshi', '', 'Yadav', '', 'divyanshi.y@virtuos.com', NULL, '', '', '', '', '', '', '', '', '498554', '554', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'VCPS', 'Virtuos', 'PE', 'Application Development Associate', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '0000-00-00', ''),
(18, 'kanika.dua', 'kanika', '', 'VINKAD1501', '3', 'Default', 'Kanika', '', 'Dua', '', 'kanika.dua@virtuos.com', NULL, '', '', '', '', '', '', '', '', '498558', '558', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'VCPS', 'Virtuos', 'PE', 'Application Development Associate', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '0000-00-00', ''),
(19, 'mahak.bansal', 'mahak', '', 'VINMAB1501', '3', 'Default', 'Mahak', '', 'Bansal', '', 'mahak.b@virtuos.com', NULL, '', '', '', '', '', '', '', '', '498553', '553', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'VCPS', 'Virtuos', 'PE', 'Application Engineer Associate', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '0000-00-00', ''),
(20, 'nisha.yadav', 'nisha', '', 'VINNIY1510', '3', 'Default', 'Nisha', '', 'Yadav', '', 'nisha.yadav@virtuos.com', NULL, '', '', '', '', '', '', '', '', '498527', '527', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'VCPS', 'Virtuos', 'PE', 'Application Development Associate', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '0000-00-00', ''),
(21, 'pooja.bajaj', 'pooja', '', 'VINPOOB1501', '3', 'Default', 'Pooja', '', 'Bajaj', '', 'pooja.bajaj@virtuos.com', NULL, '', '', '', '', '', '', '', '', '498527', '527', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'VCPS', 'Virtuos', 'PE', 'Application Development Associate', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '0000-00-00', ''),
(22, 'priyanshi.aggarwal', 'priyanshi', '', 'VINPRA1501', '3', 'Default', 'Priyanshi', '', 'Aggarwal', '', 'priyanshi.a@virtuos.com', NULL, '', '', '', '', '', '', '', '', '498556', '556', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'VCPS', 'Virtuos', 'PE', 'Application Engineer Associate', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '0000-00-00', ''),
(23, 'richa.aneja', 'richa', '', 'VINRIA1501', '3', 'Default', 'Richa', '', 'Aneja', '', 'richa.aneja@virtuos.com', NULL, '', '', '', '', '', '', '', '', '498558', '558', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'VCPS', 'Virtuos', 'PE', 'Application Engineer Associate', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '0000-00-00', ''),
(24, 'satakshi.chaudhary', 'priyanshi', '', 'VINSAC1501', '3', 'Default', 'Satakshi', '', 'Chaudhary', '', 'satakshi.c@virtuos.com', NULL, '', '', '', '', '', '', '', '', '498553', '553', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'VCPS', 'Virtuos', 'PE', 'Application Engineer Associate', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '0000-00-00', ''),
(25, 'sugandha.arya', 'sugandha', '', 'VINSUA1501', '3', 'Default', 'Sugandha', '', 'Arya', '', 'sugandha.arya@virtuos.com', NULL, '', '', '', '', '', '', '', '', '498554', '554', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'VCPS', 'Virtuos', 'PE', 'Application Development Associate', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '0000-00-00', ''),
(26, 'sandeep.rai', 'sandeep', '', 'VINSKR1501', '3', 'Default', 'Sandeep', '', 'Rai', '', 'sandeep.rai@virtuos.com', NULL, '', '', '', '', '', '', '', '', '498502', '502', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'VCPS', 'Virtuos', 'PE', 'Application Associate', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '0000-00-00', ''),
(27, 'neeraj.rohilla', 'neeraj', '', 'VINNER1501', '3', 'Default', 'Neeraj', '', 'Rohilla', '', 'neeraj.rohilla@virtuos.com', NULL, '', '', '', '', '', '', '', '', '498529', '529', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'VQA', 'Virtuos', 'QE', 'Quality Analyst Associate', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '2016-01-11', ''),
(28, 'shivaji.dubey', 'shivaji', '', 'VINSHD1501', '3', 'Default', 'Shivaji', '', 'Dubey', '', 'shivaji.dubey@virtuos.com', NULL, '', '', '', '', '', '', '', '9810055581', '498534', '534', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'YMIM', 'Virtuos', 'QE', 'Sr.Digital Marketing Associate', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '2016-01-11', ''),
(29, 'namrata.shrivastava', 'namrata', '', 'VINNAS1501', '3', 'Default', 'Namrata', '', 'Shrivastava', '', 'namrata.s@virtuos.com', NULL, '', '', '', '', '', '', '', '', '4985532', '532', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'YMIM', 'Virtuos', 'QE', 'SEO Associate', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '2016-01-11', ''),
(30, 'divya.wilson', 'divya', '', 'VINDIW1301', '3', 'Default', 'Divya', '', 'Wilson', '', 'divya.wilson@virtuos.com', NULL, '', '', '', '', '', '', '', '', '498536', '536', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'YMCD', 'Virtuos', 'QE', 'Asst Manager Content & Digital Media', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '2016-01-11', ''),
(31, 'iliena.bosu', 'iliena', '', 'VINILB1301', '3', 'Default', 'Iliena', '', 'Bosu', '', 'iliena.bosu@gmail.com', NULL, '', '', '', '', '', '', '', '', '4985535', '535', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'YMCD', 'Virtuos', 'QE', 'Content Writer', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '2016-01-11', ''),
(32, 'sunny.sharma', 'sunny', '', 'VINSUS1401', '3', '', 'Sunny', '', 'Sharma', '', 'sunny.sharma@virtuos.com', NULL, '', '', '', '', '', '', '', '9810822708', '4985512', '512', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'HRAA', 'Virtuos', 'QE', 'Sr.Accountant', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '2016-01-11', ''),
(33, 'rahul.sharma', 'rahul', '', 'VINRAS1201', '3', 'IT', 'Rahul', '', 'Sharma', 'rahul.ibs1@gmail.com', 'rahul.sharma@virtuos.com', NULL, '16/3 Umri Road Sec 13 Kurukshetra', 'Kurukshetra', 'Haryana', '2078/3 New Shiv mandir near Sec14', 'gurgaon', 'Haryana', '9540458218', '9810052456', '4985562', '562', '9654795782', 'Wife', 'O+', 'Married', 'Gurgaon', 'DAJPS4962K', '1986-02-25', '2016-01-11', 'HRAA', 'Virtuos', 'QE', 'IT/Office Administrator', 12, 3, 3, 3, NULL, 'Active', 'ICICI Bank', '002101601057', 'Rahul Sharma', 'udyog vihar phase 5 gurgaon', 'ICIC0001145', '2016-01-11', '0', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '', '', NULL, NULL, '2016-01-11', ''),
(34, 'palvika.jindal', 'palvika', '', 'VINPAJ1401', '3', 'HR', 'Palvika', '', 'Jindal', '', 'palvika.jindal@virtuos.com', NULL, '', '', '', '', '', '', '', '9810068322', '498513', '513', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'HRAA', 'Virtuos', 'QE', 'Sr.Executive - HR', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '2016-01-11', ''),
(35, 'basant.vats', 'basant', '', 'VINBAV1501', '3', '', 'Basant', '', 'Vats', 'cabasantvats@gmail.com', 'basant.vats@virtuos.com', NULL, '6/40 VATS RESIDENCE, HAILY MANDI, PATAUDI', 'GURGAON', 'Haryana', 'B-29B, SURYA VIHAR', 'GURGAON', 'Haryana', '9671892989', '', '4985512', '512', '9812698850', 'Father', 'B+', 'Single', 'Gurgaon', 'AURPV0197L', '1990-01-30', '2016-01-11', 'HRAA', 'Virtuos', 'QE', 'Sr.Accounts Executive', 12, 3, 3, 3, NULL, 'Active', 'ICICI', '017701587139', 'BASANT VATS', 'DLF PHASE 5, GURGAON', 'ICIC0000177', '2016-01-11', '0', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '', '', NULL, NULL, '2016-01-11', ''),
(36, 'tanvi.chadha', 'tanvi', '', 'VINTAC1501', '3', 'Default', 'Tanvi', '', 'Chadha', '', 'tanvi.chadha@virtuos.com', NULL, '', '', '', '', '', '', '', '', '4985539', '539', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', '', 'Virtuos', 'QE', 'Customer Service Executive', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '2016-01-11', ''),
(37, 'bilal.kirmani', 'bilal', '', 'GCBIK1401', '3', 'Default', 'Bilal', '', 'Kirmani', '', 'bilal.k@giftcart.com', NULL, '', '', '', '', '', '', '', '9650003314', '498538', '538', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', 'GIFTCART', 'Virtuos', 'PE', 'Category Associate Trainee', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '0000-00-00', ''),
(38, 'saumya.rastogi', 'saumya', '', 'GCSAR1401', '3', 'Default', 'Saumya', '', 'Rastogi', 'saumya120535@gmail.com', 'saumya.r@giftcart.com', NULL, '223/54,Rastogi Tola,Raja Bazaar Lucknow', 'Lucknow', 'Uttar Pradesh', 'U53/1,Sharma Appartments,U-Block,Dlf phase 3,Gurgaon', 'Gurgaon', 'Haryana', '7065432506', '9650003392', '498523', '523', '9335239739', 'Father', 'O-', 'Single', 'Gurgaon', 'BYTPR1316Q', '1993-03-25', '2016-01-11', 'GIFTCART', 'Virtuos', 'PE', 'Category Associate Trainee', 12, 3, 3, 3, NULL, 'Active', 'PUNJAB NATIONAL BANK', '1671000101122158', 'SAUMYA RASTOGI', 'SUBHASH MARG, LUCKNOW BRANCH, LUCKNOW, UTTAR PRADESH', 'PUNB0167100', '2016-01-11', '0', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '', '', NULL, NULL, '0000-00-00', ''),
(39, 'sabhyata.sharma', 'sabhyata', '', 'GCSAS1501', '3', 'Default', 'Sabhyata', '', 'Sharma', 'sabhyata19@gmail.com', 'sabhyata.s@giftcart.com', NULL, 'F-4,1st Floor, Module-11, Mangalam Apartments, Abhay Khand-3, Indirapuram', 'Ghaziabad', 'Uttar Pradesh', 'F-4,1st Floor, Module-11, Mangalam Apartments, Abhay Khand-3, Indirapuram', 'Ghaziabad', 'Uttar Pradesh', '8506009040', '9810078878', '498525', '525', '8447047288', 'Mother', 'O+', 'Single', 'Gurgaon', 'FSBPS60404M', '1991-07-27', '2016-01-11', 'GIFTCART', 'Virtuos', 'PE', 'Category Associate ', 12, 3, 3, 3, NULL, 'Active', 'Kotak Mahindra', '9111230238', 'Sabhyata Sharma', 'Sector-63, Noida', 'KKBK0000180', '2016-01-11', '0', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, '', '', NULL, NULL, '0000-00-00', ''),
(40, 'agam.bhatnagar', 'agam', '', 'GCAGB1501', '3', 'Default', 'Agam', '', 'Bhatnagar', '', 'agam.b@giftcart.com', NULL, '', '', '', '', '', '', '', '9810075902', '498524', '524', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2015-01-15', 'GIFTCART', 'Virtuos', 'PE', 'Category Associate', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '0000-00-00', ''),
(41, 'ar.sreenivas', 'sreenivas', '', 'VINARS1001', '3', 'Default', 'Ar', '', 'Sreenivas', '', 'ar.sreenivas@virtuos.com', NULL, '', '', '', '', '', '', '', '9910574499', '498503', '503', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', '', 'Virtuos', 'QE', 'Business Operations Manager', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '0000-00-00', NULL),
(42, 'ankush.bhardawaj', 'ankush', '', 'VINANB1501', '3', 'Default', 'Ankush', '', 'Bhardawaj', '', 'ankush.b@virtuos.com', NULL, '', '', '', '', '', '', '', '8588880508', '4985541', '541', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', '', 'Virtuos', 'QE', 'Business Head Exp.Cloud', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '2016-01-11', ''),
(43, 'rajiv.saikia', 'rajiv', '', 'VINRAS1501', '3', 'Default', 'Rajiv', '', 'Saikia', '', 'rajiv.saikia@virtuos.com', NULL, '', '', '', '', '', '', '', '', '4985541', '541', '', 'Father', '', 'Single', 'Gurgaon', '', '2016-01-11', '2016-01-11', '', 'Virtuos', 'QE', 'Inside Sales Executive', 12, 3, 3, 3, NULL, 'Active', '', '', '', '', '', '2016-01-11', '1', NULL, NULL, NULL, NULL, 'Hindi', NULL, NULL, 'No', 'No', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, '0000-00-00', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
