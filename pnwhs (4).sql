-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2021 at 07:26 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pnwhs`
--

-- --------------------------------------------------------

--
-- Table structure for table `abide`
--

CREATE TABLE `abide` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `alloted_houses`
--

CREATE TABLE `alloted_houses` (
  `id` int(11) NOT NULL,
  `p_no` int(11) DEFAULT NULL,
  `allocated_house` int(11) DEFAULT NULL,
  `allocated_account_of` varchar(200) DEFAULT NULL,
  `house_dues_instalment` int(200) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `allottee_details_of_kins`
--

CREATE TABLE `allottee_details_of_kins` (
  `id` int(11) NOT NULL,
  `p_no` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `relation` varchar(100) DEFAULT NULL,
  `define_other` varchar(100) DEFAULT NULL,
  `cnic_no` varchar(20) DEFAULT NULL,
  `mobile_no` varchar(12) DEFAULT NULL,
  `country_code` int(30) DEFAULT NULL,
  `share` int(3) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `allottee_details_of_kins`
--

INSERT INTO `allottee_details_of_kins` (`id`, `p_no`, `name`, `relation`, `define_other`, `cnic_no`, `mobile_no`, `country_code`, `share`, `address`, `status`, `created_at`, `updated_at`) VALUES
(2, 2001, 'Sef ALi', 'Son', NULL, '12345-6789766-6', '1234-5667666', 92, 50, 'Islamabad', 0, '2020-12-31 15:35:29', '2020-12-31 15:35:29'),
(3, 2001, 'Sadiya', 'Daughter', NULL, '12344-5555555-5', '3333-3333333', 92, 50, 'Islamabad', 0, '2020-12-31 15:35:29', '2020-12-31 15:35:29'),
(8, 2000, 'Ali', 'Son', '--', '12345-6789098-7', '1234-5678890', 92, 90, 'Karachi', 0, '2020-12-31 19:45:12', '2020-12-31 19:45:12'),
(9, 2003, 'Sanuallah', 'Brother', '--', '45435-3453453-4', '3345-4545454', 92, 50, 'Karachi', 0, '2020-12-31 19:46:28', '2020-12-31 19:46:28'),
(10, 2003, 'Sara', 'Daughter', '--', '23424-2342342-4', '2342-3423423', 92, 50, 'Karachi', 0, '2020-12-31 19:46:28', '2020-12-31 19:46:28'),
(11, 2004, 'Assad', 'Son', '--', '97878-7878787-8', '5675-6756756', 92, 100, 'Karachi', 0, '2020-12-31 19:46:54', '2020-12-31 19:46:54'),
(12, 2002, 'Anitaan', 'Sister', '--', '45454-5454545-4', '2323-2323232', 92, 45, 'Karachi', 0, '2020-12-31 19:47:31', '2020-12-31 19:47:31'),
(14, 10002, 'ISHRAT FATIMA', 'Mother', NULL, '12234-5679898-8', '92333-219374', NULL, 100, 'ISB', 0, '2021-01-11 09:42:07', '2021-01-11 09:42:07'),
(15, 10004, 'ALI', 'Father', NULL, '34325-4324532-4', '92331-267119', NULL, 100, 'RWP', 0, '2021-01-11 09:48:27', '2021-01-11 09:48:27'),
(16, 10005, 'ABC', 'Son', NULL, '33104-2019671-8', '92331-267119', NULL, 100, 'RWP[', 0, '2021-01-11 10:06:56', '2021-01-11 10:06:56'),
(17, 10006, 'MADINA', 'Mother', NULL, '33104-2019671-8', '0312-9000767', NULL, 100, 'RWP', 0, '2021-01-11 10:15:43', '2021-01-11 10:15:43'),
(18, 10007, 'MADINA', 'Mother', NULL, '34325-4324532-4', '0312-9000767', NULL, 50, 'ISB', 0, '2021-01-11 10:33:38', '2021-01-11 10:33:38'),
(19, 10007, 'MUHAMMAD JAN', 'Son', NULL, '45645-4545454-5', '0332-4424254', NULL, 50, 'ISB', 0, '2021-01-11 10:33:38', '2021-01-11 10:33:38'),
(20, 10001, 'ABC', 'Father', '--', '33104-2019671-8', '92331-267119', NULL, 100, 'ISB', 0, '2021-01-11 12:08:44', '2021-01-11 12:08:44'),
(21, 10008, 'ABC', 'Father', NULL, '52301-0299826-8', '0333-3555544', NULL, 100, 'RWP', 0, '2021-01-11 12:12:09', '2021-01-11 12:12:09'),
(22, 10009, 'KOI NI', 'Father', NULL, '12345-6684846-4', '0312-9000676', NULL, 100, 'ISSB', 0, '2021-01-13 11:37:31', '2021-01-13 11:37:31'),
(23, 10010, 'KOI NI', 'Mother', NULL, '12345-6684846-4', '0312-9000676', NULL, 100, 'PNWHS', 0, '2021-01-13 11:51:25', '2021-01-13 11:51:25'),
(25, 10011, 'MADINA', 'Spouse', '--', '33104-2019671-8', '92331-267119', NULL, 100, 'ISB', 0, '2021-01-15 09:46:29', '2021-01-15 09:46:29'),
(31, 654321, 'MADINA', 'Father', '--', '33104-2019671-8', '92331-267119', NULL, 100, 'ISB', 0, '2021-01-15 14:55:03', '2021-01-15 14:55:03'),
(33, 10012, 'MADINA', 'Spouse', '--', '33104-2019671-8', '92331-267119', NULL, 100, 'ISB', 0, '2021-01-15 15:57:02', '2021-01-15 15:57:02'),
(34, 70007, 'R1', 'Father', NULL, '45454-5454545-4', '4545-4545545', NULL, 12, 'saddar', 0, '2021-01-23 06:15:14', '2021-01-23 06:15:14'),
(35, 1234, 'Ali', 'Brother', NULL, '45454-5454545-4', '4545-4545545', 92, 26, 'address-3', 0, '2021-01-24 17:01:11', '2021-01-24 17:01:11');

-- --------------------------------------------------------

--
-- Table structure for table `allottee_details_service`
--

CREATE TABLE `allottee_details_service` (
  `id` int(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `application_id` int(255) NOT NULL,
  `transaction` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `allottee_files`
--

CREATE TABLE `allottee_files` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `application_id` int(11) DEFAULT NULL,
  `p_no` int(11) DEFAULT NULL,
  `cnicfront` text DEFAULT NULL,
  `cnicback` text DEFAULT NULL,
  `childrenbform` text DEFAULT NULL,
  `promotion_letter` varchar(100) DEFAULT NULL,
  `fpaform` text DEFAULT NULL,
  `applicant_photograph` text DEFAULT NULL,
  `frp_fc` text DEFAULT NULL,
  `draft_cheque` text DEFAULT NULL,
  `any_other_docs` varchar(250) DEFAULT NULL,
  `created_at` text DEFAULT NULL,
  `updated_at` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `allottee_files`
--

INSERT INTO `allottee_files` (`id`, `user_id`, `application_id`, `p_no`, `cnicfront`, `cnicback`, `childrenbform`, `promotion_letter`, `fpaform`, `applicant_photograph`, `frp_fc`, `draft_cheque`, `any_other_docs`, `created_at`, `updated_at`) VALUES
(1, 0, NULL, 2000, 'front.jpg', 'front.jpg', 'b-form.png', 'promotion-letter-14.jpg', 'allotment-form.png', 'profile-img.jpg', 'nomination-form.png', 'bank-draft.jpg', 'cheque-sample.jpg', '2020-12-31 06:34:54', '2020-12-31 06:34:54'),
(2, 0, NULL, 2001, 'front.jpg', 'front.jpg', 'b-form.png', 'promotion-letter-14.jpg', 'allotment-form.png', 'profile-img.jpg', 'nomination-form.png', 'bank-draft.jpg', '', '2020-12-31 07:35:29', '2020-12-31 07:35:29'),
(3, 0, NULL, 2002, 'front.jpg', 'front.jpg', 'b-form.png', 'promotion-letter-14.jpg', 'allotment-form.png', 'profile-img.jpg', 'nomination-form.png', 'cheque-sample.jpg', '', '2020-12-31 07:41:59', '2020-12-31 07:41:59'),
(4, 0, NULL, 2003, 'front.jpg', 'front.jpg', 'b-form.png', 'promotion-letter-14.jpg', 'allotment-form.png', 'profile-img.jpg', 'nomination-form.png', 'bank-draft.jpg', '', '2020-12-31 07:48:10', '2020-12-31 07:48:10'),
(5, 0, NULL, 2004, 'front.jpg', 'front.jpg', NULL, NULL, NULL, NULL, NULL, NULL, '', '2020-12-31 07:52:16', '2020-12-31 07:52:16'),
(6, 0, NULL, 10001, '', '', '', '', '', '', '', '', '', '2021-01-11 04:35:26', '2021-01-11 04:35:26'),
(7, 0, NULL, 10002, '', '', '', '', '', '', '', '', '', '2021-01-11 04:42:07', '2021-01-11 04:42:07'),
(8, 0, NULL, 10004, 'Pakistan-Navy.jpg', 'PNWHS LOGO.jpg', 'FRP-36.pdf', 'NEW PIC.jpg', 'NEW PIC.jpg', 'ALLOTMENT LETTER.pdf', '', '', 'B FORM.pdf', '2021-01-11 04:48:27', '2021-01-11 04:48:27'),
(9, 0, NULL, 10005, '', '', '', '', '', '', '', '', '', '2021-01-11 05:06:56', '2021-01-11 05:06:56'),
(10, 0, NULL, 10006, '', '', '', '', '', '', '', '', '', '2021-01-11 05:15:43', '2021-01-11 05:15:43'),
(11, 0, NULL, 10007, 'CNIC FRONT SIDE.pdf', 'CNIC BACK SIDE.pdf', 'B FORM.pdf', 'Challan-form-21-05-2014.pdf', 'Print.pdf', 'NEW PIC.jpg', 'ALLOTMENT LETTER.pdf', 'Pakistan-Navy.jpg', 'PNWHS LOGO.jpg', '2021-01-11 05:33:38', '2021-01-11 05:33:38'),
(12, 0, NULL, 10008, '', '', '', '', '', '', '', '', '', '2021-01-11 07:12:09', '2021-01-11 07:12:09'),
(13, 0, NULL, 10009, '', '', '', '', '', '', '', '', '', '2021-01-13 06:37:31', '2021-01-13 06:37:31'),
(14, 0, NULL, 10010, '', '', '', '', '', '', '', '', '', '2021-01-13 06:51:25', '2021-01-13 06:51:25'),
(15, 0, NULL, 10011, 'Challan-form-21-05-2014.pdf', 'CNIC BACK SIDE.pdf', '', '', '', 'NEW PIC.jpg', '', '', '', '2021-01-15 04:20:44', '2021-01-15 04:46:29'),
(16, 0, NULL, 654321, '', '', '', '', '', '', '', '', '', '2021-01-15 09:52:22', '2021-01-15 09:52:22'),
(17, 0, NULL, 70007, '', '', '', '', '', '', '', '', '', '2021-01-23 11:15:14', '2021-01-23 11:15:14'),
(18, 0, NULL, 1234, '', '', '', '', '', '', '', '', '', '2021-01-24 22:01:11', '2021-01-24 22:01:11');

-- --------------------------------------------------------

--
-- Table structure for table `allottee_particulars`
--

CREATE TABLE `allottee_particulars` (
  `id` int(11) NOT NULL,
  `p_no` bigint(10) DEFAULT NULL,
  `honu_p_no` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `reg_file_no` varchar(100) DEFAULT NULL,
  `membership_date` varchar(200) DEFAULT NULL,
  `rank_rate` int(20) DEFAULT NULL,
  `soldier` varchar(255) DEFAULT NULL,
  `plotassigned` int(11) DEFAULT NULL,
  `get_profit_id` int(11) DEFAULT NULL,
  `name` text DEFAULT NULL,
  `cnic_no` varchar(15) DEFAULT NULL,
  `d_o_b` varchar(255) DEFAULT NULL,
  `d_o_e` varchar(255) DEFAULT NULL,
  `d_o_c` varchar(255) DEFAULT NULL,
  `d_o_p` varchar(255) DEFAULT NULL,
  `d_o_sod` varchar(255) DEFAULT NULL,
  `d_o_sos` varchar(255) DEFAULT NULL,
  `d_o_s` varchar(255) DEFAULT NULL,
  `total_service` varchar(100) DEFAULT NULL,
  `salary` varchar(255) DEFAULT NULL,
  `any_other_benifit` varchar(250) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `branch` varchar(100) DEFAULT NULL,
  `tel_no` bigint(15) DEFAULT NULL,
  `mob_no` text DEFAULT NULL,
  `email_address` varchar(100) DEFAULT NULL,
  `permanent_address` varchar(200) DEFAULT NULL,
  `present_address` varchar(200) DEFAULT NULL,
  `date` varchar(255) NOT NULL,
  `seen` int(255) DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created` varchar(100) DEFAULT NULL,
  `form_status` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) DEFAULT 0,
  `payment_status` tinyint(1) NOT NULL DEFAULT 0,
  `active_date` date DEFAULT NULL,
  `remarks_status` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `approvedocument` text DEFAULT NULL,
  `seperate_view` varchar(255) DEFAULT NULL,
  `membersip_id` int(11) DEFAULT NULL,
  `title` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `allottee_particulars`
--

INSERT INTO `allottee_particulars` (`id`, `p_no`, `honu_p_no`, `user_id`, `created_by`, `reg_file_no`, `membership_date`, `rank_rate`, `soldier`, `plotassigned`, `get_profit_id`, `name`, `cnic_no`, `d_o_b`, `d_o_e`, `d_o_c`, `d_o_p`, `d_o_sod`, `d_o_sos`, `d_o_s`, `total_service`, `salary`, `any_other_benifit`, `unit`, `branch`, `tel_no`, `mob_no`, `email_address`, `permanent_address`, `present_address`, `date`, `seen`, `is_deleted`, `created`, `form_status`, `status`, `payment_status`, `active_date`, `remarks_status`, `created_at`, `updated_at`, `approvedocument`, `seperate_view`, `membersip_id`, `title`) VALUES
(1, 2000, NULL, NULL, 27, '900000', '01-12-2020', 1, 'uniform', 0, NULL, 'Arslan', '12345-6789097-5', '05-01-1998', '17-05-2010', '17-08-2010', '15-12-2015', '17-08-2010', '25-12-2030', NULL, '( 20 year 4 month 8 days )', '1', 'NA', 'Unit-1', 'Rank-Rate', NULL, '12345-6789098', 'arsalan@mail.com', 'Karachi', 'Karachi', '31-12-2020', 1, 0, NULL, 0, 1, 0, NULL, '15-01', '2020-12-31 14:34:54', '2021-01-15 14:47:54', NULL, NULL, NULL, NULL),
(2, 2001, NULL, NULL, 27, '2001', '01-12-2020', 5, 'civilian', 0, NULL, 'Sadam Hussain', '12345-6789098-7', '26-3-1983', '1-02-2000', '1-06-2000', '15-12-2005', '01-12-2020', NULL, '11-12-2027', '( 44 year 8 month 16 days )', '1', 'NA', 'Unit-1', 'Rank-Rate', NULL, '12345-6778988', 'sadam@mail.com', 'Islamabad', 'Islamabad', '', 1, 0, NULL, 0, 0, 0, NULL, NULL, '2020-12-31 15:35:29', '2020-12-31 15:36:07', NULL, NULL, NULL, NULL),
(3, 2002, NULL, NULL, 27, '6000', '01-12-2020', 4, 'uniform', 0, NULL, 'Shan Ali', '34556-6666666-6', '01-07-1995', '1-05-2013', '5-08-2013', '15-12-2015', '01-12-2020', '31-12-2040', NULL, '( 27 year 4 month 26 days )', '1', 'NA', 'Unit-1', 'Rank-Rate', NULL, '34323-2323232', NULL, 'Karachi', 'Karachi', '31-12-2020', 1, 0, NULL, 0, 0, 0, NULL, NULL, '2020-12-31 15:41:58', '2020-12-31 19:47:31', NULL, NULL, NULL, NULL),
(4, 2003, NULL, NULL, 27, '900001', '01-12-2020', 3, 'uniform', 0, NULL, 'Abid Ali', '32323-2323232-3', '5-1-1978', '1-03-1995', '1-08-1995', '15-12-2005', '01-12-2020', '25-12-2030', NULL, '( 35 year 4 month 24 days )', '1', 'house', 'Unit-1', 'Rank-Rate', NULL, '23232-3232323', NULL, 'Karachi', 'Karachi', '31-12-2020', 1, 0, NULL, 0, 0, 0, NULL, NULL, '2020-12-31 15:48:10', '2020-12-31 19:46:28', NULL, NULL, NULL, NULL),
(5, 2004, NULL, NULL, 27, '900002', '01-12-2020', 2, 'uniform', 0, NULL, 'Khan Ali', '54545-4545455-4', '26-3-1983', '17-05-2002', '17-08-2002', '15-12-2015', '01-12-2020', '25-12-2035', NULL, '( 33 year 4 month 8 days )', '1', 'NA', 'Unit-1', 'Rank-Rate', NULL, '23123-1231313', 'khan@gmail.com', 'Karachi', 'Karachi', '31-12-2020', 1, 0, NULL, 0, 0, 0, NULL, NULL, '2020-12-31 15:52:16', '2020-12-31 19:46:54', NULL, NULL, NULL, NULL),
(14, 2005, NULL, NULL, 27, NULL, '31-12-2020', 6, NULL, 0, NULL, 'Sarfraz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 0, NULL, 0, 1, 0, NULL, '15-01', '2021-01-01 05:14:24', '2021-01-15 09:25:29', NULL, NULL, NULL, NULL),
(15, 2006, NULL, NULL, 27, NULL, '31-12-2020', 10, NULL, 0, NULL, 'Ayaz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 1, 0, NULL, 0, 0, 0, NULL, NULL, '2021-01-01 05:14:24', '2021-01-01 05:14:24', NULL, NULL, NULL, NULL),
(16, 10001, NULL, NULL, 27, '0001', '11-01-2021', 11, 'uniform', 0, NULL, 'KALEEM KHAN', '12345-6789132-6', '17-05-1985', '05-08-2005', '17-06-2008', '05-08-2009', '02-12-2027', '02-12-2028', NULL, '( 20 year 5 month 15 days )', NULL, NULL, 'COMNOR', 'LT', NULL, '92366-5641364', NULL, 'ISB', 'ISB', '11-01-2021', 1, 0, NULL, 0, 1, 0, NULL, 'OKK', '2021-01-11 09:35:26', '2021-01-11 12:08:44', NULL, NULL, NULL, NULL),
(17, 10002, NULL, NULL, 27, '2002', '11-01-2021', 7, 'uniform', 0, NULL, 'MUHAMMAD KASHIF', '61101-8796541-3', '13-11-1987', '04-03-2003', '03-04-2005', '04-03-2007', '19-09-2030', '19-09-2031', NULL, '( 26 year 5 month 16 days )', NULL, 'house', 'COMKAR', 'MCPO', NULL, '92347-5959655', NULL, 'ISB', 'ISB', '', 1, 0, NULL, 0, 1, 0, NULL, 'OKK', '2021-01-11 09:42:07', '2021-01-11 09:42:28', NULL, NULL, NULL, NULL),
(18, 10004, NULL, NULL, 27, '6001', '11-01-2021', 4, 'uniform', 0, NULL, 'FAIZAN ALI', '88303-2155988-5', '27-01-1986', '09-07-2006', '09-07-2007', '17-12-2009', '23-12-2028', '23-12-2029', NULL, '( 22 year 5 month 14 days )', NULL, 'house', 'KARSAZ', 'PO', NULL, '92335-5546131', NULL, 'RWP', 'RWP', '', 1, 0, NULL, 0, 1, 0, NULL, 'OKK', '2021-01-11 09:48:27', '2021-01-11 09:50:56', NULL, NULL, NULL, NULL),
(19, 10005, NULL, NULL, 27, '6002', '11-01-2021', 4, 'uniform', 0, NULL, 'SALEEM JAN', '54102-3651588-9', '11-03-1987', '17-05-2004', '17-07-2005', '17-07-2007', '12-12-2027', '25-12-2028', NULL, '( 23 year 5 month 8 days )', NULL, NULL, 'DILAWAR', 'PO-MUS', NULL, '92333-3333333', NULL, 'ISB', 'ISB', '', 1, 0, NULL, 0, 1, 0, NULL, 'OKK', '2021-01-11 10:06:56', '2021-01-11 10:07:18', NULL, NULL, NULL, NULL),
(20, 10006, NULL, NULL, 27, '6003', '11-01-2021', 4, 'uniform', 0, NULL, 'KHALID ALI', '54666-6632145-8', '04-03-1986', '05-11-2005', '05-11-2006', '11-01-2008', '15-05-2028', '15-05-2029', NULL, '( 22 year 6 month 10 days )', NULL, 'house', 'comnor', 'PO-MUS', NULL, '92322-2444444', NULL, 'ISB', 'ISB', '', 1, 0, NULL, 0, 1, 0, NULL, 'OKK', '2021-01-11 10:15:43', '2021-01-11 10:16:08', NULL, NULL, NULL, NULL),
(21, 10007, NULL, NULL, 27, '2003', '11-01-2021', 5, 'civilian', 0, NULL, 'JUNAID', '54136-6666774-5', '01-01-1990', '10-12-2005', '10-12-2006', '10-11-2008', '07-03-2035', NULL, '07-02-2051', '( 61 year 1 month 6 days )', NULL, 'house', 'DILAWAR', 'ASST', NULL, '92335-5546131', NULL, 'ISB', 'ISB', '', 1, 0, NULL, 0, 1, 0, NULL, 'OKK', '2021-01-11 10:33:38', '2021-01-11 10:34:35', NULL, NULL, NULL, NULL),
(22, 10008, NULL, NULL, 27, '0002', '11-01-2021', 12, 'uniform', 0, NULL, 'ZAHID', '12345-6789101-1', '02-08-1984', '03-07-2005', '03-07-2007', '05-03-2009', '29-09-2028', '29-09-2029', NULL, '( 22 year 2 month 26 days )', NULL, 'house', 'COMNOR', 'LT CDR PN', NULL, '92347-5959655', NULL, 'ISB', 'ISB', '', 0, 0, NULL, 1, 0, 0, NULL, NULL, '2021-01-11 12:12:09', '2021-01-11 12:12:09', NULL, NULL, NULL, NULL),
(23, 10009, NULL, NULL, 27, '2004', '13-01-2021', 5, 'uniform', 0, NULL, 'KALEEM', '12345-6468468-6', '05-02-1987', '06-04-2000', '06-04-2002', '05-06-2010', '07-09-2022', '07-09-2023', NULL, '( 21 year 5 month 1 days )', NULL, 'house', 'COMNOR', 'MGAM-I', NULL, '92312-9000767', NULL, 'ISSB', 'ISSB', '', 1, 0, NULL, 0, 1, 0, NULL, 'OKKK', '2021-01-13 11:37:31', '2021-01-13 11:38:06', NULL, NULL, NULL, NULL),
(24, 10010, NULL, NULL, 27, '0003', '13-01-2021', 10, 'civilian', 0, NULL, 'KASHIF', '12345-6468468-6', '05-02-1987', '03-03-2005', '03-03-2007', '05-04-2009', '07-09-2022', NULL, '05-09-2027', '( 40 year 7 month 0 days )', NULL, 'flat', 'COMNOR', 'SUPDT', NULL, '92312-9000767', NULL, 'PNWHS', 'PNWHS', '', 1, 0, NULL, 0, 1, 0, NULL, 'OKKK', '2021-01-13 11:51:25', '2021-01-13 11:52:17', NULL, NULL, NULL, NULL),
(25, 10011, NULL, NULL, 27, '2006', '15-01-2021', 7, 'civilian', 0, NULL, 'Bilal', '36302-4354075-1', '01-02-1971', '01-02-1991', '01-02-1993', '01-03-2005', '18-04-2025', NULL, '18-04-2026', '( 55 year 2 month 17 days )', '50000', 'flat', 'COMNOR', 'FM', 0, '92347-5959655', 'pnwhs.isb@gmail.com', 'ISB', 'isb', '15-01-2021', 1, 0, NULL, 0, 1, 0, NULL, '15 JAN', '2021-01-15 09:20:44', '2021-01-19 06:16:18', NULL, NULL, NULL, NULL),
(26, 654321, NULL, NULL, 27, '900003', '01-12-2020', 2, 'uniform', 0, NULL, 'MUBEEN', '36302-4354075-1', '01-05-1983', '05-05-2001', '05-05-2003', '05-05-2005', '07-07-2027', '07-08-2028', NULL, '( 25 year 3 month 2 days )', NULL, 'NA', 'COMNOR', 'OD', NULL, '92312-9000767', NULL, 'ISB', 'ISB', '15-01-2021', 1, 0, NULL, 0, 1, 0, NULL, '15-01', '2021-01-15 14:52:22', '2021-01-15 14:55:03', NULL, NULL, NULL, NULL),
(27, 100009, NULL, NULL, 27, '6003', '01-01-1990', 13, 'uniform', 0, NULL, 'TESTING DATA MEMBER', '54666-6632145-8', '04-03-1986', '05-11-2005', '05-11-2006', '11-01-2008', '15-05-2028', '15-05-2029', NULL, '( 22 year 6 month 10 days )', NULL, 'house', 'comnor', 'PO-MUS', NULL, '92322-2444444', NULL, 'ISB', 'ISB', '22-01-2021', 1, 0, NULL, 0, 1, 0, NULL, 'OKK', '2021-01-11 10:15:43', '2021-01-22 01:44:05', NULL, NULL, NULL, NULL),
(28, 70007, NULL, NULL, 27, '60112', '01-01-1990', 14, 'civilian', NULL, NULL, 'Khan Ali', '32323-2323232-3', '05-01-1998', '17-05-2002', '17-08-2002', '15-12-2015', '30-12-2020', NULL, NULL, '( 0 year 0 month 0 days )', NULL, NULL, 'Unit-1', 'Rank-Rate', NULL, '12345-6778988', 'khan@gmail.com', 'saddar', 'saddar', '', 1, 0, NULL, 0, 0, 1, NULL, NULL, '2021-01-23 06:15:14', '2021-01-24 14:56:29', NULL, NULL, NULL, NULL),
(29, 1234, NULL, NULL, 27, '900004', '01-01-2005', 19, 'uniform', NULL, NULL, 'Deepak', '32323-2323232-3', '05-01-1998', '17-05-2002', '17-08-2002', '15-12-2015', '30-12-2020', '31-12-2040', NULL, '( 38 year 4 month 14 days )', '1', 'NA', 'Unit-1', 'Rank-Rate', NULL, '23455-6777778', NULL, 'address-2', 'Address-1', '', 1, 0, NULL, 0, 0, 1, '2020-01-01', NULL, '2021-01-24 17:01:11', '2021-01-25 01:12:58', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `assigned_policies`
--

CREATE TABLE `assigned_policies` (
  `id` int(11) NOT NULL,
  `policy_id` int(11) DEFAULT NULL,
  `p_no` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assigned_policies`
--

INSERT INTO `assigned_policies` (`id`, `policy_id`, `p_no`, `created_at`, `updated_at`) VALUES
(2, 7, '12345', '2021-01-21 04:43:20', '2021-01-21 04:43:20'),
(8, 20, '2002', '2021-01-21 05:44:11', '2021-01-21 05:44:11'),
(9, 20, '10004', '2021-01-21 05:44:11', '2021-01-21 05:44:11'),
(10, 20, '10005', '2021-01-21 05:44:11', '2021-01-21 05:44:11'),
(11, 20, '10006', '2021-01-21 05:44:11', '2021-01-21 05:44:11'),
(12, 21, '2002', '2021-01-21 06:15:33', '2021-01-21 06:15:33'),
(13, 21, '10004', '2021-01-21 06:15:33', '2021-01-21 06:15:33'),
(14, 21, '10005', '2021-01-21 06:15:33', '2021-01-21 06:15:33'),
(15, 21, '10006', '2021-01-21 06:15:33', '2021-01-21 06:15:33'),
(17, 21, '100009', '2021-01-22 01:43:23', '2021-01-22 01:43:23'),
(18, 32, '100009', '2021-01-22 01:44:05', '2021-01-22 01:44:05'),
(19, 32, '100009', '2021-01-22 03:38:15', '2021-01-22 03:38:15'),
(20, 33, '100009', '2021-01-22 07:12:38', '2021-01-22 07:12:38'),
(24, 1, '2004', '2021-01-24 15:14:45', '2021-01-24 15:14:45'),
(25, 1, '654321', '2021-01-24 15:14:45', '2021-01-24 15:14:45'),
(26, 1, '70007', '2021-01-24 15:14:45', '2021-01-24 15:14:45');

-- --------------------------------------------------------

--
-- Table structure for table `assignplot`
--

CREATE TABLE `assignplot` (
  `id` int(11) NOT NULL,
  `plot_id` int(11) NOT NULL,
  `p_no` varchar(11) DEFAULT NULL,
  `member_id` int(11) NOT NULL,
  `contractor_id` int(11) NOT NULL,
  `total_amount` varchar(255) DEFAULT NULL,
  `plot_amount` varchar(255) DEFAULT NULL,
  `constructor` varchar(255) DEFAULT NULL,
  `membership_id` varchar(255) DEFAULT NULL,
  `pendingamount` varchar(255) DEFAULT NULL,
  `memberpaidamount` varchar(255) DEFAULT NULL,
  `possession` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assignplot`
--

INSERT INTO `assignplot` (`id`, `plot_id`, `p_no`, `member_id`, `contractor_id`, `total_amount`, `plot_amount`, `constructor`, `membership_id`, `pendingamount`, `memberpaidamount`, `possession`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 35, '9', 4, 10, '1800000', '900000', '900000', '4', '1715000', '100000', '1715000', 27, '2020-03-31 17:24:17', ''),
(2, 34, '342', 1, 4, '1400000', '600000', '800000', '4', 'NaN', NULL, 'NaN', 27, '2020-04-02 06:22:50', ''),
(3, 36, '442', 5, 11, '2900000', '900000', '2000000', '4', '2905000', '10000', '2905000', 27, '2020-06-24 12:47:02', ''),
(4, 37, '80', 6, 11, '3000000', '1000000', '2000000', '4', '2945000', '70000', '2945000', 27, '2020-06-25 05:58:04', '');

-- --------------------------------------------------------

--
-- Table structure for table `block`
--

CREATE TABLE `block` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `block`
--

INSERT INTO `block` (`id`, `name`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Block A', 'Block A', 1, '2020-10-02 05:53:46', '2020-10-02 05:53:46'),
(2, 'Block B', 'Block B', 0, '2020-10-02 05:54:00', '2020-10-02 06:02:34');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` varchar(19) DEFAULT NULL,
  `state` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `state`) VALUES
(2, 'Karachi', 'Sindh'),
(3, 'Lahore', 'Punjab'),
(4, 'Faisalābād', 'Punjab'),
(5, 'Serai', 'Khyber Pakhtunkhwa'),
(6, 'Rāwalpindi', 'Punjab'),
(7, 'Multān', 'Punjab'),
(8, 'Gujrānwāla', 'Punjab'),
(9, 'Hyderābād City', 'Sindh'),
(10, 'Peshāwar', 'Khyber Pakhtunkhwa'),
(11, 'Abbottābād', 'Khyber Pakhtunkhwa'),
(12, 'Islamabad', 'Islāmābād'),
(13, 'Quetta', 'Balochistān'),
(14, 'Bannu', 'Khyber Pakhtunkhwa'),
(15, 'Bahāwalpur', 'Punjab'),
(16, 'Sargodha', 'Punjab'),
(17, 'Siālkot City', 'Punjab'),
(18, 'Sukkur', 'Sindh'),
(19, 'Lārkāna', 'Sindh'),
(20, 'Sheikhupura', 'Punjab'),
(21, 'Mīrpur Khās', 'Sindh'),
(22, 'Rahīmyār Khān', 'Punjab'),
(23, 'Kohāt', 'Khyber Pakhtunkhwa'),
(24, 'Jhang Sadr', 'Punjab'),
(25, 'Gujrāt', 'Punjab'),
(26, 'Bardār', 'Khyber Pakhtunkhwa'),
(27, 'Kasūr', 'Punjab'),
(28, 'Dera Ghāzi Khān', 'Punjab'),
(29, 'Masīwāla', 'Punjab'),
(30, 'Nawābshāh', 'Sindh'),
(31, 'Okāra', 'Punjab'),
(32, 'Gilgit', 'Gilgit-Baltistan'),
(33, 'Chiniot', 'Punjab'),
(34, 'Sādiqābād', 'Punjab'),
(35, 'Turbat', 'Balochistān'),
(36, 'Dera Ismāīl Khān', 'Khyber Pakhtunkhwa'),
(37, 'Chaman', 'Balochistān'),
(38, 'Zhob', 'Balochistān'),
(39, 'Mehra', 'Khyber Pakhtunkhwa'),
(40, 'Parachinār', 'Federally Administered Tribal Areas'),
(41, 'Gwādar', 'Balochistān'),
(42, 'Kundiān', 'Punjab'),
(43, 'Shahdād Kot', 'Sindh'),
(44, 'Harīpur', 'Khyber Pakhtunkhwa'),
(45, 'Matiāri', 'Sindh'),
(46, 'Dera Allāhyār', 'Balochistān'),
(47, 'Lodhrān', 'Punjab'),
(48, 'Batgrām', 'Khyber Pakhtunkhwa'),
(49, 'Thatta', 'Sindh'),
(50, 'Bāgh', 'Azad Kashmir'),
(51, 'Badīn', 'Sindh'),
(52, 'Mānsehra', 'Khyber Pakhtunkhwa'),
(53, 'Ziārat', 'Balochistān'),
(54, 'Muzaffargarh', 'Punjab'),
(55, 'Tando Allāhyār', 'Sindh'),
(56, 'Dera Murād Jamāli', 'Balochistān'),
(57, 'Karak', 'Khyber Pakhtunkhwa'),
(58, 'Mardan', 'Khyber Pakhtunkhwa'),
(59, 'Uthal', 'Balochistān'),
(60, 'Nankāna Sāhib', 'Punjab'),
(61, 'Bārkhān', 'Balochistān'),
(62, 'Hāfizābād', 'Punjab'),
(63, 'Kotli', 'Azad Kashmir'),
(64, 'Loralai', 'Balochistān'),
(65, 'Dera Bugti', 'Balochistān'),
(66, 'Jhang City', 'Punjab'),
(67, 'Sāhīwāl', 'Punjab'),
(68, 'Sānghar', 'Sindh'),
(69, 'Pākpattan', 'Punjab'),
(70, 'Chakwāl', 'Punjab'),
(71, 'Khushāb', 'Punjab'),
(72, 'Ghotki', 'Sindh'),
(73, 'Kohlu', 'Balochistān'),
(74, 'Khuzdār', 'Balochistān'),
(75, 'Awārān', 'Balochistān'),
(76, 'Nowshera', 'Khyber Pakhtunkhwa'),
(77, 'Chārsadda', 'Khyber Pakhtunkhwa'),
(78, 'Qila Abdullāh', 'Balochistān'),
(79, 'Bahāwalnagar', 'Punjab'),
(80, 'Dādu', 'Sindh'),
(81, 'Alīābad', 'Gilgit-Baltistan'),
(82, 'Lakki Marwat', 'Khyber Pakhtunkhwa'),
(83, 'Chilās', 'Gilgit-Baltistan'),
(84, 'Pishin', 'Balochistān'),
(85, 'Tānk', 'Khyber Pakhtunkhwa'),
(86, 'Chitrāl', 'Khyber Pakhtunkhwa'),
(87, 'Qila Saifullāh', 'Balochistān'),
(88, 'Shikārpur', 'Sindh'),
(89, 'Panjgūr', 'Balochistān'),
(90, 'Mastung', 'Balochistān'),
(91, 'Kalāt', 'Balochistān'),
(92, 'Gandāvā', 'Balochistān'),
(93, 'Khānewāl', 'Punjab'),
(94, 'Nārowāl', 'Punjab'),
(95, 'Khairpur', 'Sindh'),
(96, 'Malakand', 'Khyber Pakhtunkhwa'),
(97, 'Vihāri', 'Punjab'),
(98, 'Saidu Sharif', 'Khyber Pakhtunkhwa'),
(99, 'Jhelum', 'Punjab'),
(100, 'Mandi Bahāuddīn', 'Punjab'),
(101, 'Bhakkar', 'Punjab'),
(102, 'Toba Tek Singh', 'Punjab'),
(103, 'Jāmshoro', 'Sindh'),
(104, 'Khārān', 'Balochistān'),
(105, 'Umarkot', 'Sindh'),
(106, 'Hangu', 'Khyber Pakhtunkhwa'),
(107, 'Timargara', 'Khyber Pakhtunkhwa'),
(108, 'Gākuch', 'Gilgit-Baltistan'),
(109, 'Jacobābād', 'Sindh'),
(110, 'Alpūrai', 'Khyber Pakhtunkhwa'),
(111, 'Miānwāli', 'Punjab'),
(112, 'Mūsa Khel Bāzār', 'Balochistān'),
(113, 'Naushahro Fīroz', 'Sindh'),
(114, 'New Mīrpur', 'Azad Kashmir'),
(115, 'Daggar', 'Khyber Pakhtunkhwa'),
(116, 'Eidgāh', 'Gilgit-Baltistan'),
(117, 'Sibi', 'Balochistān'),
(118, 'Dālbandīn', 'Balochistān'),
(119, 'Rājanpur', 'Punjab'),
(120, 'Leiah', 'Punjab'),
(121, 'Upper Dir', 'Khyber Pakhtunkhwa'),
(122, 'Tando Muhammad Khān', 'Sindh'),
(123, 'Attock City', 'Punjab'),
(124, 'Rāwala Kot', 'Azad Kashmir'),
(125, 'Swābi', 'Khyber Pakhtunkhwa'),
(126, 'Kandhkot', 'Sindh'),
(127, 'Dasu', 'Khyber Pakhtunkhwa'),
(128, 'Athmuqam', 'Azad Kashmir');

-- --------------------------------------------------------

--
-- Table structure for table `construction`
--

CREATE TABLE `construction` (
  `id` int(11) NOT NULL,
  `constructor_id` int(11) DEFAULT NULL,
  `category` varchar(11) DEFAULT NULL,
  `plot_id` int(11) DEFAULT NULL,
  `duaration` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Working',
  `initial_price` varchar(255) DEFAULT NULL,
  `final_price` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `construction`
--

INSERT INTO `construction` (`id`, `constructor_id`, `category`, `plot_id`, `duaration`, `price`, `status`, `initial_price`, `final_price`, `created_at`, `updated_at`) VALUES
(1, 1, 'A', 1, '10 Months', NULL, 'progress', '2000000', NULL, '2020-10-02 10:11:29', '2020-10-02 10:11:29'),
(2, 2, 'B', 2, '12 Months', NULL, 'completed', '2000055', NULL, '2020-10-02 10:11:53', '2020-10-02 10:35:08'),
(3, 3, 'C', 3, '24 Months', NULL, 'completed', '4000000', NULL, '2020-10-02 10:12:17', '2020-10-02 10:34:52'),
(4, 4, 'D', 4, '24 Months', '3800000', 'progress', '3500000', NULL, '2020-10-02 10:12:59', '2020-10-08 10:50:50');

-- --------------------------------------------------------

--
-- Table structure for table `constructor`
--

CREATE TABLE `constructor` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `mobile_no` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `constructor`
--

INSERT INTO `constructor` (`id`, `name`, `email`, `description`, `mobile_no`, `address`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Ali', 'ali@mail.com', 'descriptoin', '03000000000', 'ali address', NULL, '2020-10-02 10:03:03', '2020-10-02 10:03:03'),
(2, 'Ahmed', 'ahmed@mail.com', 'description', '03000000000', 'ahmed address', NULL, '2020-10-02 10:03:26', '2020-10-02 10:03:26'),
(3, 'Ayaz', 'ayaz@mail.com', 'description', '03000000000', 'address', NULL, '2020-10-02 10:03:57', '2020-10-02 10:03:57'),
(4, 'Arshad', 'arshad@mail.com', 'description', '03000000000', 'address', 'null', '2020-10-02 10:04:32', '2020-12-30 07:00:22'),
(5, 'Khan', 'khanali@gmail.com', 'tested', '23434-34236', 'saddars', 'closing-balance-2.PNG', '2021-01-24 20:53:47', '2021-01-24 21:24:51');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `p_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `p_no`, `amount`, `date`, `created_at`, `updated_at`) VALUES
(1, 'p no', 'amount', 'date', '2020-06-25 09:36:16', '2020-06-25 09:36:16'),
(2, '442', '5000', '13/07/2020', '2020-06-25 09:36:16', '2020-06-25 09:36:16'),
(3, '442', '5000', '13/08/2020', '2020-06-25 09:36:16', '2020-06-25 09:36:16'),
(4, 'p no', 'amount', 'date', '2020-06-25 09:53:50', '2020-06-25 09:53:50'),
(5, '80', '30000', '13/07/2020', '2020-06-25 09:53:50', '2020-06-25 09:53:50'),
(6, '80', '10000', '13/08/2020', '2020-06-25 09:53:50', '2020-06-25 09:53:50');

-- --------------------------------------------------------

--
-- Table structure for table `csv_data`
--

CREATE TABLE `csv_data` (
  `id` int(11) NOT NULL,
  `csv_file_id` int(11) DEFAULT NULL,
  `is_member` tinyint(1) NOT NULL DEFAULT 0,
  `p_no` int(11) DEFAULT NULL,
  `rank` varchar(11) DEFAULT NULL,
  `name` varchar(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `s_no` varchar(255) DEFAULT NULL,
  `dep_date` varchar(255) DEFAULT NULL,
  `p_no_of_hony` varchar(255) DEFAULT NULL,
  `cat` varchar(255) DEFAULT NULL,
  `g_r` varchar(255) DEFAULT NULL,
  `dd_ch` varchar(255) DEFAULT NULL,
  `dd_cheq_date` varchar(255) DEFAULT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `dep_slip` varchar(255) DEFAULT NULL,
  `receipt` varchar(255) DEFAULT NULL,
  `reg_fee` varchar(255) DEFAULT NULL,
  `insurance_payment` varchar(255) DEFAULT NULL,
  `month` varchar(200) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `csv_file`
--

CREATE TABLE `csv_file` (
  `id` int(10) UNSIGNED NOT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `csv_raw_data`
--

CREATE TABLE `csv_raw_data` (
  `id` int(11) NOT NULL,
  `raw_file_id` int(11) DEFAULT NULL,
  `s_no` int(11) DEFAULT NULL,
  `cat_no` int(11) DEFAULT NULL,
  `rank` varchar(20) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `cat` varchar(200) DEFAULT NULL,
  `pjo` int(100) DEFAULT NULL,
  `p_no_for_hony` int(100) DEFAULT NULL,
  `g_r` int(11) DEFAULT NULL,
  `dd_ch` varchar(255) DEFAULT NULL,
  `dd_cheq_date` varchar(255) DEFAULT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `dep_slip` varchar(255) DEFAULT NULL,
  `receipt` varchar(255) DEFAULT NULL,
  `reg_fee` varchar(200) DEFAULT NULL,
  `insurance` varchar(200) DEFAULT NULL,
  `dd_date` varchar(200) DEFAULT NULL,
  `dep_date` varchar(200) DEFAULT NULL,
  `date` varchar(200) DEFAULT NULL,
  `month` varchar(200) DEFAULT NULL,
  `monthly_amount` varchar(200) DEFAULT NULL,
  `reg_insurance` varchar(200) DEFAULT NULL,
  `g_total_w_o_reg_ins` varchar(200) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `csv_raw_data`
--

INSERT INTO `csv_raw_data` (`id`, `raw_file_id`, `s_no`, `cat_no`, `rank`, `name`, `cat`, `pjo`, `p_no_for_hony`, `g_r`, `dd_ch`, `dd_cheq_date`, `bank`, `dep_slip`, `receipt`, `reg_fee`, `insurance`, `dd_date`, `dep_date`, `date`, `month`, `monthly_amount`, `reg_insurance`, `g_total_w_o_reg_ins`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, 'AB', 'Arslan', NULL, 2000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3000', NULL, NULL, 'Only Three Thousands', '2021-01-19 08:32:33', '2021-01-19 08:32:33'),
(2, 1, 2, NULL, 'LDG', 'Abid Ali', NULL, 2003, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3000', NULL, NULL, 'Only Three Thousands', '2021-01-19 08:32:33', '2021-01-19 08:32:33'),
(3, 1, 3, NULL, 'OD', 'Khan Ali', NULL, 2004, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3000', NULL, NULL, 'Only Three Thousands', '2021-01-19 08:32:33', '2021-01-19 08:32:33'),
(4, 1, 4, NULL, 'CPO', 'Sadam Hussain', NULL, 2001, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9000', NULL, NULL, 'Only Nine Thousands', '2021-01-19 08:32:33', '2021-01-19 08:32:33'),
(5, 1, 5, NULL, 'PO', 'Shan Ali', NULL, 2002, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5000', NULL, NULL, 'Only Five Thousands', '2021-01-19 08:32:33', '2021-01-19 08:32:33');

-- --------------------------------------------------------

--
-- Table structure for table `csv_raw_files`
--

CREATE TABLE `csv_raw_files` (
  `id` int(11) NOT NULL,
  `file_name` varchar(100) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `csv_raw_files`
--

INSERT INTO `csv_raw_files` (`id`, `file_name`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'monthly_records.xlsx', 27, '2021-01-19 08:32:33', '2021-01-19 08:32:33');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `gallery_images`
--

CREATE TABLE `gallery_images` (
  `id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gallery_images`
--

INSERT INTO `gallery_images` (`id`, `created_by`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 27, 'Capture.PNG', 1, '2020-08-13 08:54:12', '2020-08-13 08:54:12');

-- --------------------------------------------------------

--
-- Table structure for table `get_profits`
--

CREATE TABLE `get_profits` (
  `id` int(11) NOT NULL,
  `profit_rate_id` int(11) DEFAULT NULL,
  `p_no` int(11) DEFAULT NULL,
  `account_of` varchar(200) DEFAULT NULL,
  `paid_amount` varchar(200) DEFAULT NULL,
  `profit_amount` varchar(200) DEFAULT NULL,
  `total_amount` varchar(200) DEFAULT NULL,
  `payment_method` varchar(200) DEFAULT NULL,
  `beneficiary_name` varchar(200) DEFAULT NULL,
  `ref_cheque_no` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `date` varchar(200) DEFAULT NULL,
  `reciever_name` varchar(200) DEFAULT NULL,
  `reciever_cnic` varchar(200) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `payment_status` varchar(200) DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hereby`
--

CREATE TABLE `hereby` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `house_alloted_details`
--

CREATE TABLE `house_alloted_details` (
  `id` int(11) NOT NULL,
  `p_no` bigint(10) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `title` int(255) NOT NULL,
  `name` text DEFAULT NULL,
  `rank_rate` int(20) DEFAULT NULL,
  `cnic_no` varchar(15) DEFAULT NULL,
  `d_o_b` varchar(255) DEFAULT NULL,
  `father_name_particular` text DEFAULT NULL,
  `d_o_e` varchar(255) DEFAULT NULL,
  `branch` varchar(100) DEFAULT NULL,
  `d_o_c` varchar(255) DEFAULT NULL,
  `d_o_p` varchar(255) DEFAULT NULL,
  `d_o_sod` varchar(255) DEFAULT NULL,
  `d_o_sos` varchar(255) DEFAULT NULL,
  `total_service` varchar(100) DEFAULT NULL,
  `d_o_s` varchar(255) DEFAULT NULL,
  `tel_no` bigint(15) DEFAULT NULL,
  `mob_no` bigint(15) DEFAULT NULL,
  `email_address` varchar(100) DEFAULT NULL,
  `salary` varchar(255) DEFAULT NULL,
  `date` varchar(255) NOT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `wife_name` varchar(255) DEFAULT NULL,
  `wife_cnic` text DEFAULT NULL,
  `wife_security_clearance` varchar(255) DEFAULT NULL,
  `wife_blacklist` varchar(255) DEFAULT NULL,
  `total_childs` varchar(255) DEFAULT NULL,
  `child_name` text DEFAULT NULL,
  `child_b_form` text DEFAULT NULL,
  `child_age` text DEFAULT NULL,
  `child_gender` text DEFAULT NULL,
  `child_security_clearance` text DEFAULT NULL,
  `child_blacklist` text DEFAULT NULL,
  `made_name` text DEFAULT NULL,
  `made_cnic` text DEFAULT NULL,
  `made_mobile` text DEFAULT NULL,
  `made_security_clearance` text DEFAULT NULL,
  `made_blacklist` int(11) DEFAULT NULL,
  `driver_name` text DEFAULT NULL,
  `driver_cnic` text DEFAULT NULL,
  `driver_mobile` text DEFAULT NULL,
  `driver_clearance` text DEFAULT NULL,
  `driver_blacklist` text DEFAULT NULL,
  `guard_name` text DEFAULT NULL,
  `guard_cnic` text DEFAULT NULL,
  `guard_mobile` text DEFAULT NULL,
  `guard_security_clearance` text DEFAULT NULL,
  `guard_blacklist` text DEFAULT NULL,
  `chef_name` text DEFAULT NULL,
  `chef_cnic` text DEFAULT NULL,
  `chef_mobile` int(11) DEFAULT NULL,
  `chef_security_clearance` int(11) DEFAULT NULL,
  `chef_blacklist` int(11) DEFAULT NULL,
  `gardener_name` text DEFAULT NULL,
  `gardener_cnic` text DEFAULT NULL,
  `gardener_mobile` text DEFAULT NULL,
  `gardener_security_gardener` text DEFAULT NULL,
  `gardener_blacklist` text DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `house_categories`
--

CREATE TABLE `house_categories` (
  `id` int(11) NOT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `start_range` varchar(255) DEFAULT NULL,
  `end_range` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `house_categories`
--

INSERT INTO `house_categories` (`id`, `created_by`, `name`, `start_range`, `end_range`, `status`, `created_at`, `updated_at`) VALUES
(1, '27', 'A', '0001', '2000', 1, '2020-12-31 11:20:43', '2020-12-31 11:20:43'),
(2, '27', 'B', '2001, 500000', '599999, 899999', 1, '2020-12-31 11:20:43', '2020-12-31 11:20:43'),
(3, '27', 'C', '6000', '499999', 1, '2020-12-31 11:20:43', '2020-12-31 11:20:43'),
(4, '27', 'D', '900000', '', 1, '2020-12-31 11:20:43', '2020-12-31 11:20:43');

-- --------------------------------------------------------

--
-- Table structure for table `house_cost`
--

CREATE TABLE `house_cost` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `initial_cost` int(200) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `house_cost`
--

INSERT INTO `house_cost` (`id`, `category_id`, `initial_cost`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 4, 100000, 1, 27, '2020-07-25 07:19:43', '2020-11-12 15:39:37'),
(3, 2, 5700000, 1, 27, '2021-01-15 10:55:26', '2021-01-19 05:43:11');

-- --------------------------------------------------------

--
-- Table structure for table `kinsmulltiplefiles`
--

CREATE TABLE `kinsmulltiplefiles` (
  `id` int(11) NOT NULL,
  `p_no` int(11) DEFAULT NULL,
  `application_id` int(11) DEFAULT NULL,
  `alloteefiles_id` int(11) NOT NULL DEFAULT 0,
  `fileposition` text DEFAULT NULL,
  `filetext` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` text DEFAULT NULL,
  `updated_at` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kinsmulltiplefiles`
--

INSERT INTO `kinsmulltiplefiles` (`id`, `p_no`, `application_id`, `alloteefiles_id`, `fileposition`, `filetext`, `status`, `created_at`, `updated_at`) VALUES
(1, 2000, NULL, 0, 'nextofkinfilefront', '1609396494front.jpg', 0, '2020-12-31 06:34:54', '2020-12-31 06:34:54'),
(2, 2000, NULL, 0, 'nextofkinfileback', '1609396494front.jpg', 0, '2020-12-31 06:34:54', '2020-12-31 06:34:54'),
(3, 2001, NULL, 0, 'nextofkinfilefront', '1609400129front.jpg', 0, '2020-12-31 07:35:29', '2020-12-31 07:35:29'),
(4, 2001, NULL, 0, 'nextofkinfileback', '1609400129front.jpg', 0, '2020-12-31 07:35:29', '2020-12-31 07:35:29'),
(5, 2002, NULL, 0, 'nextofkinfilefront', '1609400519front.jpg', 0, '2020-12-31 07:41:59', '2020-12-31 07:41:59'),
(6, 2002, NULL, 0, 'nextofkinfileback', '1609400519front.jpg', 0, '2020-12-31 07:41:59', '2020-12-31 07:41:59'),
(7, 2003, NULL, 0, 'nextofkinfilefront', '1609400890front.jpg', 0, '2020-12-31 07:48:10', '2020-12-31 07:48:10'),
(8, 2003, NULL, 0, 'nextofkinfileback', '1609400890front.jpg', 0, '2020-12-31 07:48:10', '2020-12-31 07:48:10'),
(13, 10007, NULL, 0, 'nextofkinfilefront', '1610343218NOKFRONTSIDE.pdf', 0, '2021-01-11 05:33:38', '2021-01-11 05:33:38'),
(14, 10007, NULL, 0, 'nextofkinfileback', '1610343218NOKBACKSIDE.pdf', 0, '2021-01-11 05:33:38', '2021-01-11 05:33:38');

-- --------------------------------------------------------

--
-- Table structure for table `membershippayment`
--

CREATE TABLE `membershippayment` (
  `id` int(11) NOT NULL,
  `mpayment` varchar(255) DEFAULT NULL,
  `m_rank` varchar(200) DEFAULT NULL,
  `effective_date` varchar(200) DEFAULT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `members_profit`
--

CREATE TABLE `members_profit` (
  `id` int(11) NOT NULL,
  `rate` int(11) DEFAULT NULL,
  `effected_date` varchar(200) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `members_profit`
--

INSERT INTO `members_profit` (`id`, `rate`, `effected_date`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 7, '2020-08-05', 1, 27, '2020-08-04 08:05:08', '2020-08-04 08:42:05');

-- --------------------------------------------------------

--
-- Table structure for table `monthly_instalments`
--

CREATE TABLE `monthly_instalments` (
  `id` int(11) NOT NULL,
  `p_no` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `paid_date` varchar(200) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `monthly_instalments`
--

INSERT INTO `monthly_instalments` (`id`, `p_no`, `amount`, `paid_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 3450, 560, '2020-07-16', 1, '2020-07-16 10:06:58', '2020-07-16 10:16:28');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `newsletterfile` text NOT NULL,
  `expiry_date` text NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`id`, `user_id`, `subject`, `title`, `newsletterfile`, `expiry_date`, `is_active`, `created_at`, `updated_at`) VALUES
(7, 27, 'test 24', 'test 24', '1595572882rows.txt', '2020-07-26', 1, '2020-07-24 06:41:22', '2020-07-24 06:41:22'),
(8, 27, '26 subject testing', '26 title testing', '1595572971Capture.PNG', '2020-07-26', 1, '2020-07-24 06:42:51', '2020-07-24 06:42:51'),
(9, 27, 'test', 'rest', '1596636527age-b.png', '2020-08-05', 1, '2020-08-05 14:08:47', '2020-08-05 14:08:47'),
(10, 27, 'test', 'rest', '1596636595age-b.png', '2020-08-05', 1, '2020-08-05 14:09:55', '2020-08-05 14:09:55'),
(11, 27, 'test', 'rest', '1596636682age-b.png', '2020-08-20', 1, '2020-08-05 14:11:22', '2020-08-05 14:11:22'),
(12, 27, 'test', 'rest 2', '1596636682age-b.png', '2020-08-20', 1, '2020-08-05 14:11:22', '2020-08-05 14:11:22'),
(13, 27, 'Subject for testing', 'Testing purpose', '1601635079form.PNG', '2020-10-03', 1, '2020-10-02 10:37:59', '2020-10-02 10:37:59'),
(14, 27, 'Subject 2 for testing', 'Testing 2 title', '1601635113allotement-colorfulyform.jpg', '2020-10-03', 1, '2020-10-02 10:38:33', '2020-10-02 10:38:33'),
(15, 27, 'allotment ceremony', 'what is this', '1602157510favicon.png', '2020-10-09', 1, '2020-10-08 11:45:10', '2020-10-08 11:45:10');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) UNSIGNED NOT NULL,
  `record_id` int(11) NOT NULL,
  `notif_for` int(11) NOT NULL,
  `order_for` int(11) NOT NULL,
  `order_for_user_id` int(11) NOT NULL,
  `seen` tinyint(11) NOT NULL DEFAULT 0,
  `shop_seen` int(11) NOT NULL,
  `admin_seen` int(11) NOT NULL DEFAULT 0,
  `seperate_view` varchar(256) DEFAULT NULL,
  `title` varchar(256) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `record_id`, `notif_for`, `order_for`, `order_for_user_id`, `seen`, `shop_seen`, `admin_seen`, `seperate_view`, `title`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 0, 0, 0, 0, 0, 'Installment/5', 'Installment Not Of2020-01', 27, '2020-02-11 00:04:10', NULL),
(2, 5, 1, 0, 0, 0, 0, 0, 'Installment/5', 'Installment Not Of2020-01', 27, '2020-02-11 00:04:10', NULL),
(3, 5, 1, 0, 0, 0, 0, 0, 'Installment/5', 'Installment Not Of2020-01', 27, '2020-02-11 00:19:56', NULL),
(4, 5, 1, 0, 0, 0, 0, 0, 'Installment/5', 'Installment Not Of2020-01', 27, '2020-02-11 00:19:56', NULL),
(5, 5, 1, 0, 0, 0, 0, 0, 'Installment/5', 'Installment Not Of2020-01', 27, '2020-02-11 00:26:18', NULL),
(6, 5, 1, 0, 0, 0, 0, 0, 'Installment/5', 'Installment Not Of2020-01', 27, '2020-02-11 00:26:18', NULL),
(7, 5, 1, 0, 0, 0, 0, 0, 'Installment/5', 'Installment Not Of2020-01', 27, '2020-02-11 00:29:28', NULL),
(8, 5, 1, 0, 0, 0, 0, 0, 'Installment/5', 'Installment Not Of2020-01', 27, '2020-02-11 00:29:28', NULL),
(9, 5, 1, 0, 0, 0, 0, 0, 'Installment/5', 'Installment Not Of2020-01', 27, '2020-02-11 00:31:39', NULL),
(10, 5, 1, 0, 0, 0, 0, 0, 'Installment/5', 'Installment Not Of2020-01', 27, '2020-02-11 00:31:39', NULL),
(11, 5, 1, 0, 0, 0, 0, 0, 'Installment/5', 'Installment Not Of2020-01', 27, '2020-02-11 00:32:57', NULL),
(12, 5, 1, 0, 0, 0, 0, 0, 'Installment/5', 'Installment Not Of2020-01', 27, '2020-02-11 00:32:57', NULL),
(13, 5, 1, 0, 0, 0, 0, 0, 'Installment/5', 'Installment Not Of2020-01', 27, '2020-02-11 00:34:38', NULL),
(14, 5, 1, 0, 0, 0, 0, 0, 'Installment/5', 'Installment Not Of2020-01', 27, '2020-02-11 00:34:38', NULL),
(15, 5, 1, 0, 0, 0, 0, 0, 'Installment/5', 'Installment Not Of2020-01', 27, '2020-02-11 00:35:35', NULL),
(16, 5, 1, 0, 0, 0, 0, 0, 'Installment/5', 'Installment Not Of2020-01', 27, '2020-02-11 00:35:35', NULL),
(17, 5, 1, 0, 0, 0, 0, 0, 'Installment/5', 'Installment Not Of2020-01', 27, '2020-02-11 00:51:53', NULL),
(18, 5, 1, 0, 0, 0, 0, 0, 'Installment/5', 'Installment Not Of2020-01', 27, '2020-02-11 00:51:53', NULL),
(19, 5, 1, 0, 0, 0, 0, 0, 'Installment/5', 'Installment Not Of2020-01', 27, '2020-02-11 00:53:38', NULL),
(20, 5, 1, 0, 0, 0, 0, 0, 'Installment/5', 'Installment Not Of2020-01', 27, '2020-02-11 00:53:38', NULL),
(21, 5, 1, 0, 0, 0, 0, 0, 'Installment/5', 'Installment Not Of2020-01', 27, '2020-02-11 00:54:17', NULL),
(22, 5, 1, 0, 0, 0, 0, 0, 'Installment/5', 'Installment Not Of2020-01', 27, '2020-02-11 00:54:17', NULL),
(23, 5, 1, 0, 0, 0, 0, 0, 'Installment/5', 'Installment Not Of2020-01', 27, '2020-02-11 00:55:02', NULL),
(24, 5, 1, 0, 0, 0, 0, 0, 'Installment/5', 'Installment Not Of2020-01', 27, '2020-02-11 00:55:02', NULL),
(25, 5, 1, 0, 0, 0, 0, 0, 'Installment/5', 'Installment Not Of2020-01', 27, '2020-02-11 00:55:40', NULL),
(26, 5, 1, 0, 0, 0, 0, 0, 'Installment/5', 'Installment Not Of2020-01', 27, '2020-02-11 00:55:40', NULL),
(27, 5, 1, 0, 0, 0, 0, 0, 'Installment/5', 'Installment Not Of2020-01', 27, '2020-02-11 00:56:11', NULL),
(28, 5, 1, 0, 0, 0, 0, 0, 'Installment/5', 'Installment Not Of2020-01', 27, '2020-02-11 00:56:11', NULL),
(29, 5, 1, 0, 0, 0, 0, 0, 'Installment/5', 'Installment Not Of2020-01', 27, '2020-02-11 00:56:19', NULL),
(30, 5, 1, 0, 0, 0, 0, 0, 'Installment/5', 'Installment Not Of2020-01', 27, '2020-02-11 00:56:19', NULL),
(31, 5, 1, 0, 0, 0, 0, 0, 'Installment/5', 'Installment Not Of2020-01', 27, '2020-02-11 00:57:25', NULL),
(32, 5, 1, 0, 0, 0, 0, 0, 'Installment/5', 'Installment Not Of2020-01', 27, '2020-02-11 00:57:26', NULL),
(33, 5, 1, 0, 0, 0, 0, 0, 'Installment/5', 'Installment Not Of2020-01', 27, '2020-02-11 00:57:36', NULL),
(34, 5, 1, 0, 0, 0, 0, 0, 'Installment/5', 'Installment Not Of2020-01', 27, '2020-02-11 00:57:36', NULL),
(35, 5, 1, 0, 0, 0, 0, 0, 'Installment/5', 'Installment Not Of2020-01', 27, '2020-02-11 00:58:05', NULL),
(36, 5, 1, 0, 0, 0, 0, 0, 'Installment/5', 'Installment Not Of2020-01', 27, '2020-02-11 00:58:05', NULL),
(37, 5, 1, 0, 0, 0, 0, 0, 'Installment/5', 'Installment Not Of2020-01', 27, '2020-02-11 00:58:35', NULL),
(38, 5, 1, 0, 0, 0, 0, 0, 'Installment/5', 'Installment Not Of2020-01', 27, '2020-02-11 00:58:35', NULL),
(39, 5, 1, 0, 0, 0, 0, 0, 'Installment/5', 'Installment Not Of2020-01', 27, '2020-02-11 00:59:09', NULL),
(40, 5, 1, 0, 0, 0, 0, 0, 'Installment/5', 'Installment Not Of2020-01', 27, '2020-02-11 00:59:09', NULL),
(41, 5, 1, 0, 0, 0, 0, 0, 'Installment/5', 'Installment Not Of2020-01', 27, '2020-02-11 00:59:10', NULL),
(42, 5, 1, 0, 0, 0, 0, 0, 'Installment/5', 'Installment Not Of2020-01', 27, '2020-02-11 00:59:10', NULL),
(43, 5, 1, 0, 0, 0, 0, 0, 'Installment/5', 'Installment Not Of2020-01', 27, '2020-02-11 00:59:15', NULL),
(44, 5, 1, 0, 0, 0, 0, 0, 'Installment/5', 'Installment Not Of2020-01', 27, '2020-02-11 00:59:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `other`
--

CREATE TABLE `other` (
  `id` int(11) NOT NULL,
  `application_id` int(11) NOT NULL,
  `sum_of` varchar(255) DEFAULT NULL,
  `draft_no` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `pjo` varchar(255) DEFAULT NULL,
  `rate` varchar(255) DEFAULT NULL,
  `countersigned_name` varchar(255) DEFAULT NULL,
  `countersigned_no` varchar(255) DEFAULT NULL,
  `dated` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `other`
--

INSERT INTO `other` (`id`, `application_id`, `sum_of`, `draft_no`, `date`, `pjo`, `rate`, `countersigned_name`, `countersigned_no`, `dated`) VALUES
(1, 1, '1', '1', '2019-12-19', '1', '200', '1', '1', ''),
(2, 2, '1', '1', '2019-12-19', '1', '200', '1', '1', ''),
(3, 3, '1', '1', '2019-12-19', '1', '200', '1', '1', ''),
(4, 4, '1', '1', '2019-12-19', '1', '200', '1', '1', ''),
(5, 5, '1', '1', '2019-12-19', '1', '200', '1', '1', ''),
(6, 7, '00009', '00009', '00009', '00009', '00009', '00009', '00009', ''),
(7, 8, '00000010', '00000010', '00000010', '00000010', '00000010', '00000010', '00000010', ''),
(8, 9, '1', '1', '2019-12-19', '1', '200', '1', '1', ''),
(9, 10, '123', '123', '123', '123', '123', '123', '123', ''),
(10, 11, '00009', '00009', '00009', '00009', '00009', '00009', '00009', ''),
(11, 12, '00009', '00009', '00009', '00009', '00009', '00009', '00009', ''),
(12, 13, '00009', '00009', '00009', '00009', '00009', '00009', '00009', ''),
(13, 14, '00009', '00009', '00009', '00009', '00009', '00009', '00009', ''),
(14, 15, '00009', '00009', '00009', '00009', '00009', '00009', '00009', ''),
(15, 16, '00009', '00009', '00009', '00009', '00009', '00009', '00009', ''),
(16, 17, '00009', '00009', '00009', '00009', '00009', '00009', '00009', ''),
(17, 18, '00009', '00009', '00009', '00009', '00009', '00009', '00009', ''),
(18, 19, '00009', '00009', '00009', '00009', '00009', '00009', '00009', ''),
(19, 20, '00009', '00009', '00009', '00009', '00009', '00009', '00009', ''),
(20, 21, '00009', '00009', '00009', '00009', '00009', '00009', '00009', ''),
(21, 22, '00009', '00009', '00009', '00009', '00009', '00009', '00009', ''),
(22, 23, '00009', '00009', '00009', '00009', '00009', '00009', '00009', ''),
(23, 24, '00009', '00009', '00009', '00009', '00009', '00009', '00009', ''),
(24, 25, '00009', '00009', '00009', '00009', '00009', '00009', '00009', ''),
(25, 26, '00009', '00009', '00009', '00009', '00009', '00009', '00009', ''),
(26, 27, '00009', '00009', '00009', '00009', '00009', '00009', '00009', ''),
(27, 28, '000123', '000123', '000123', '000123', '000123', '000123', '000123', ''),
(28, 29, '000123', '000123', '000123', '000123', '000123', '000123', '000123', ''),
(29, 30, '000123', '000123', '000123', '000123', '000123', '000123', '000123', ''),
(30, 31, '000123', '000123', '000123', '000123', '000123', '000123', '000123', ''),
(31, 32, '000123', '000123', '000123', '000123', '000123', '000123', '000123', ''),
(32, 33, '000123', '000123', '000123', '000123', '000123', '000123', '000123', ''),
(33, 34, '000123', '000123', '000123', '000123', '000123', '000123', '000123', ''),
(34, 35, '000123', '000123', '000123', '000123', '000123', '000123', '000123', ''),
(35, 36, '000123', '000123', '000123', '000123', '000123', '000123', '000123', ''),
(36, 37, '000123', '000123', '000123', '000123', '000123', '000123', '000123', ''),
(37, 38, '000123', '000123', '000123', '000123', '000123', '000123', '000123', ''),
(38, 39, '000123', '000123', '000123', '000123', '000123', '000123', '000123', ''),
(39, 40, '000123', '000123', '000123', '000123', '000123', '000123', '000123', ''),
(40, 41, '000123', '000123', '000123', '000123', '000123', '000123', '000123', ''),
(41, 42, '000123', '000123', '000123', '000123', '000123', '000123', '000123', ''),
(42, 43, '000123', '000123', '000123', '000123', '000123', '000123', '000123', ''),
(43, 44, '000123', '000123', '000123', '000123', '000123', '000123', '000123', ''),
(44, 45, '000123', '000123', '000123', '000123', '000123', '000123', '000123', ''),
(45, 46, '000123', '000123', '000123', '000123', '000123', '000123', '000123', ''),
(46, 47, '000123', '000123', '000123', '000123', '000123', '000123', '000123', ''),
(47, 48, '000123', '000123', '000123', '000123', '000123', '000123', '000123', ''),
(48, 49, '000123', '000123', '000123', '000123', '000123', '000123', '000123', ''),
(49, 50, '000123', '000123', '000123', '000123', '000123', '000123', '000123', ''),
(50, 51, '000123', '000123', '2019-12-13', '000123', '000123', '000123', '000123', ''),
(51, 52, '000123', '000123', '2019-12-13', '000123', '000123', '000123', '000123', ''),
(52, 53, '00009', '1', '2019-12-19', '00000010', '00000010', '00000010', '123', ''),
(53, 54, '1', '1', '1', '1', '1', '1', '1', ''),
(54, 55, '1', '1', '1', '1', '1', '1', '1', ''),
(55, 56, '1', '1', '1', '1', '1', '1', '1', ''),
(56, 57, '1', '1', '1', '1', '1', '1', '1', ''),
(57, 58, '1', '1', '1', '1', '1', '1', '1', ''),
(58, 59, '1', '1', '1', '1', '1', '1', '1', ''),
(59, 60, '1', '1', '1', '1', '1', '1', '1', ''),
(60, 61, '1', '1', '1', '1', '1', '1', '1', ''),
(61, 62, '1', '1', '1', '1', '1', '1', '1', ''),
(62, 63, '00009', '00000010', '2019-12-13', '00009', '00000010', '000123', '00000010', ''),
(63, 64, '00009', '00000010', '2019-12-13', '00009', '00000010', '000123', '00000010', ''),
(64, 65, '1', '1', '1', '1', '1', '1', '1', ''),
(65, 66, '1', '1', '1', '1', '1', '1', '1', ''),
(66, 67, '1', '1', '1', '1', '1', '1', '1', ''),
(67, 68, '1', '1', '1', '1', '1', '1', '1', ''),
(68, 72, '00009', '000123', '2020-02-25', '00000010', '000123', '00000010', '123', '2020-02-25'),
(69, 73, '1', '1', '2020-02-25', NULL, NULL, NULL, '1', '2020-02-25'),
(70, 75, '123', '123', '2020-02-26', '00000010', '00000010', '00000010', '00000010', '2020-02-26'),
(71, 76, '00000010', '00000010', '2020-02-26', '00000010', '00000010', '00000010', '00000010', '2020-02-26'),
(72, 77, '00000010', '00000010', '2020-02-26', '1', '00000010', '00000010', '00000010', '2020-02-15');

-- --------------------------------------------------------

--
-- Table structure for table `payable_reg_insurances`
--

CREATE TABLE `payable_reg_insurances` (
  `id` int(11) NOT NULL,
  `promoted_id` varchar(255) DEFAULT NULL,
  `member_id` varchar(255) DEFAULT NULL,
  `policy_id` varchar(255) DEFAULT NULL,
  `total_amount` varchar(255) DEFAULT NULL,
  `payable_amount` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payable_reg_insurances`
--

INSERT INTO `payable_reg_insurances` (`id`, `promoted_id`, `member_id`, `policy_id`, `total_amount`, `payable_amount`, `created_at`, `updated_at`) VALUES
(1, '48', '29', '3', '400', '400', '2021-01-24 17:01:11', '2021-01-24 17:01:11'),
(2, '49', '29', '4', '600', '200', '2021-01-24 17:48:44', '2021-01-24 17:48:44');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `p_no` int(255) NOT NULL,
  `member_id` int(11) DEFAULT NULL,
  `voucher_no` varchar(200) DEFAULT NULL,
  `plot_no` int(255) DEFAULT NULL,
  `get_profit_id` int(11) DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `total_amount` int(100) DEFAULT NULL,
  `reg_insu_fee` varchar(255) DEFAULT NULL,
  `sub_monthly_install` int(100) DEFAULT NULL,
  `submitted_amount` int(100) DEFAULT NULL,
  `current_paid` varchar(255) DEFAULT NULL,
  `amount` int(100) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `deposit_date` varchar(100) DEFAULT NULL,
  `instrument_no` varchar(100) DEFAULT NULL,
  `slip_no` varchar(255) DEFAULT NULL,
  `remarks` varchar(200) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `policy_id` int(11) DEFAULT NULL,
  `payment_status` int(11) NOT NULL DEFAULT 0,
  `half_yearly_installments` varchar(255) DEFAULT NULL,
  `amount_type` varchar(255) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `month` varchar(255) DEFAULT NULL,
  `booking` varchar(255) DEFAULT NULL,
  `possession` varchar(255) DEFAULT NULL,
  `amounts` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `p_no`, `member_id`, `voucher_no`, `plot_no`, `get_profit_id`, `payment_type`, `total_amount`, `reg_insu_fee`, `sub_monthly_install`, `submitted_amount`, `current_paid`, `amount`, `bank_name`, `deposit_date`, `instrument_no`, `slip_no`, `remarks`, `is_active`, `policy_id`, `payment_status`, `half_yearly_installments`, `amount_type`, `year`, `month`, `booking`, `possession`, `amounts`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 70007, 28, '1166', NULL, NULL, 'cash', -300, '300', 0, 0, '300', 0, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-24 14:56:29', '2021-01-24 14:56:29'),
(2, 70007, 28, '8172', NULL, NULL, 'cash', -47700, '47700', 2300, 2300, '50000', 2300, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-24 14:57:26', '2021-01-24 14:57:26'),
(3, 70007, 28, '9668', NULL, NULL, 'cash', 0, NULL, 15000, 17300, '15000', 15000, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-24 14:58:21', '2021-01-24 14:58:21'),
(20, 1234, 29, '1794', NULL, NULL, 'cash', -400, '200', 0, 0, '200', -200, NULL, '2021-01-25', NULL, '12345', 'test', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-25 01:12:06', '2021-01-25 01:12:06'),
(21, 1234, 29, '8146', NULL, NULL, 'cash', -200, '200', 300, 300, '500', 300, NULL, '2021-01-25', NULL, '2345', 'test', 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-25 01:12:58', '2021-01-25 01:12:58'),
(22, 1234, 29, '9251', NULL, NULL, 'cash', 0, NULL, 1000, 1300, '1000', 1000, NULL, '2021-01-25', NULL, '3456', 'test', 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-25 01:16:28', '2021-01-25 01:16:28'),
(23, 1234, 29, '8734', NULL, NULL, 'cash', 0, NULL, 1500, 2800, '1500', 1500, NULL, '2021-01-25', NULL, '4567', 'test', 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-25 01:17:30', '2021-01-25 01:17:30'),
(24, 1234, 29, '4941', NULL, NULL, 'cash', -200, '200', 300, 3100, '500', 300, NULL, '2021-01-25', NULL, '5678', 'test', 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-25 01:21:33', '2021-01-25 01:21:33');

-- --------------------------------------------------------

--
-- Table structure for table `payment_policies`
--

CREATE TABLE `payment_policies` (
  `id` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `registration_payment` int(100) DEFAULT NULL,
  `insurance_payment` int(100) DEFAULT NULL,
  `monthly_instalment` int(100) DEFAULT NULL,
  `effective_date` date DEFAULT NULL,
  `expire_date` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `cat_id` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_policies`
--

INSERT INTO `payment_policies` (`id`, `created_by`, `registration_payment`, `insurance_payment`, `monthly_instalment`, `effective_date`, `expire_date`, `status`, `created_at`, `updated_at`, `cat_id`) VALUES
(2, 27, 100, 100, 100, '2000-01-01', '2002-01-01', 1, '2021-01-24 15:23:13', '2021-01-24 15:23:38', NULL),
(3, 27, 200, 200, 200, '2001-12-29', NULL, 1, '2021-01-24 15:23:38', '2021-01-24 15:23:38', NULL),
(4, 27, 300, 300, 300, '2010-01-01', NULL, 1, '2021-01-24 15:24:00', '2021-01-24 15:24:00', NULL),
(5, 27, 400, 400, 400, '2020-01-01', NULL, 1, '2021-01-24 15:24:19', '2021-01-24 15:24:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment_policy_data`
--

CREATE TABLE `payment_policy_data` (
  `id` int(11) NOT NULL,
  `payment_policy_id` int(11) DEFAULT NULL,
  `rank_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `effective_date` date DEFAULT NULL,
  `expire_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_policy_data`
--

INSERT INTO `payment_policy_data` (`id`, `payment_policy_id`, `rank_id`, `created_at`, `updated_at`, `effective_date`, `expire_date`) VALUES
(5, 2, 19, '2021-01-24 15:23:13', '2021-01-24 15:23:38', '2000-01-01', '2001-12-29'),
(6, 3, 19, '2021-01-24 15:23:38', '2021-01-24 15:23:38', '2001-12-29', NULL),
(7, 4, 20, '2021-01-24 15:24:00', '2021-01-24 15:24:00', '2010-01-01', NULL),
(8, 5, 21, '2021-01-24 15:24:19', '2021-01-24 15:24:19', '2020-01-01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `plots`
--

CREATE TABLE `plots` (
  `id` int(11) NOT NULL,
  `personel_type` varchar(255) DEFAULT NULL,
  `plot_no` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `features` varchar(300) NOT NULL,
  `phase` varchar(255) NOT NULL,
  `block` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `assign_plot` int(11) NOT NULL DEFAULT 0,
  `image` varchar(200) NOT NULL,
  `plot_status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plots`
--

INSERT INTO `plots` (`id`, `personel_type`, `plot_no`, `type`, `size`, `features`, `phase`, `block`, `amount`, `assign_plot`, `image`, `plot_status`, `created_at`, `updated_at`) VALUES
(1, 'officer', '001', '1', '1', 'Residential', '1', '1', '400000', 0, '', 0, '2020-10-02 07:47:08', '2020-10-02 07:47:08'),
(2, 'officer', '002', '1', '2', 'Residential', '2', '2', '200000', 0, '', 1, '2020-10-02 07:47:43', '2020-10-02 07:47:43'),
(3, 'Civilian', '003', '1', '3', 'Residential', '3', '3', '250000', 0, '', 1, '2020-10-02 07:48:08', '2020-10-02 07:48:08'),
(4, 'officer', '004', '1', '4', 'Residential', '4', '1', '400000', 0, '', 1, '2020-10-02 07:48:38', '2020-10-02 07:48:38'),
(5, 'officer', '005', '1', '2', 'Residential', '1', '1', '400000', 0, '', 1, '2020-10-02 07:49:04', '2020-10-02 07:49:04'),
(6, 'officer', '10002', '1', '1', 'test', '1', '1', '102999', 0, '[\"1602152559rate.PNG\"]', 0, '2020-10-08 10:22:39', '2020-10-08 10:22:39'),
(7, 'Civilian', '0030', '1', '4', 'rtts', '3', '2', '10000', 0, '[]', 1, '2021-01-24 21:35:52', '2021-01-24 21:45:44');

-- --------------------------------------------------------

--
-- Table structure for table `promoted_members`
--

CREATE TABLE `promoted_members` (
  `id` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `member_id` varchar(155) DEFAULT NULL,
  `promoted_rank_id` int(11) DEFAULT NULL,
  `file_registration_no` varchar(200) DEFAULT NULL,
  `old_p_no` int(11) DEFAULT NULL,
  `new_p_no` int(11) DEFAULT NULL,
  `d_o_p` date DEFAULT NULL,
  `d_o_sod` varchar(200) DEFAULT NULL,
  `d_o_sos` varchar(200) DEFAULT NULL,
  `d_o_s` varchar(200) DEFAULT NULL,
  `soldier` varchar(200) DEFAULT NULL,
  `rank_rate` varchar(255) DEFAULT NULL,
  `gross_salary` varchar(200) DEFAULT NULL,
  `total_service` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `promoted_members`
--

INSERT INTO `promoted_members` (`id`, `created_by`, `member_id`, `promoted_rank_id`, `file_registration_no`, `old_p_no`, `new_p_no`, `d_o_p`, `d_o_sod`, `d_o_sos`, `d_o_s`, `soldier`, `rank_rate`, `gross_salary`, `total_service`, `created_at`, `updated_at`) VALUES
(46, 27, '28', 16, '50003', 70007, 700079, '1990-01-01', '31-01-2021', NULL, '01-01-2021', 'civilian', 'rank_rate', '12312312', '( 22 year 11 month 27 days )', '2021-01-23 07:10:24', '2021-01-23 07:10:24'),
(47, 27, '28', 17, '6011210', 70007, 700010, '2021-01-01', '12-01-2021', NULL, '01-01-2021', 'civilian', 'rank_rate', '1', '( 22 year 11 month 27 days )', '2021-01-24 07:55:02', '2021-01-24 07:55:02'),
(48, 27, '29', 19, '900004', 1234, 1234, '2015-12-15', '30-12-2020', '31-12-2040', NULL, 'uniform', 'Rank-Rate', '1', '( 38 year 4 month 14 days )', '2021-01-24 17:01:11', '2021-01-24 17:01:11'),
(49, 27, '29', 20, '6004', 1234, 12345, '2020-12-15', '17-08-2010', NULL, '01-01-2021', 'civilian', 'rank_rate', '2', '( 22 year 11 month 27 days )', '2021-01-24 17:48:44', '2021-01-24 17:48:44');

-- --------------------------------------------------------

--
-- Table structure for table `property_type`
--

CREATE TABLE `property_type` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `property_type`
--

INSERT INTO `property_type` (`id`, `name`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Residential', 'Residential', 1, '2019-12-02 11:57:53', '2020-02-26 09:08:08'),
(4, 'sami56', 'tes56', 1, '2021-01-24 21:48:04', '2021-01-24 21:48:25');

-- --------------------------------------------------------

--
-- Table structure for table `ranks`
--

CREATE TABLE `ranks` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `category` varchar(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ranks`
--

INSERT INTO `ranks` (`id`, `name`, `category`, `status`, `created_at`, `updated_at`) VALUES
(1, 'AB', '4', 1, '2020-10-01 08:22:38', '2020-10-01 08:22:38'),
(2, 'OD', '4', 1, '2020-10-01 08:22:48', '2020-10-01 08:22:48'),
(3, 'LDG', '4', 1, '2020-10-01 08:22:59', '2020-10-01 08:22:59'),
(4, 'PO', '3', 1, '2020-10-01 08:23:11', '2020-10-01 08:23:11'),
(5, 'CPO', '2', 1, '2020-10-01 08:23:26', '2020-10-01 08:23:26'),
(6, 'FCPO', '2', 1, '2020-10-01 08:23:46', '2020-10-01 08:23:46'),
(7, 'MCPO', '2', 1, '2020-10-01 08:23:57', '2020-10-01 08:23:57'),
(8, 'HONU SBLT', '2', 1, '2020-10-01 08:25:37', '2020-10-01 08:25:37'),
(9, 'HONU LT', '2', 1, '2020-10-01 08:25:50', '2020-10-01 08:25:50'),
(10, 'SBLT', '1', 1, '2020-10-01 08:26:01', '2020-10-01 08:26:01'),
(11, 'LT', '1', 1, '2020-10-01 08:26:11', '2020-10-01 08:26:11'),
(12, 'LTCDR', '1', 1, '2020-10-01 08:26:21', '2020-10-01 08:26:21'),
(19, 'test rank 1', '4', 1, '2021-01-24 15:21:16', '2021-01-24 15:22:10'),
(20, 'test rank 2', '3', 1, '2021-01-24 15:21:33', '2021-01-24 15:21:33'),
(21, 'test rank 3', '2', 1, '2021-01-24 15:21:45', '2021-01-24 15:21:45');

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `property_type` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`id`, `name`, `description`, `is_active`, `property_type`, `created_at`, `updated_at`) VALUES
(1, '180 SqYd', '80 SqYd', 1, '1', '2020-10-02 07:33:30', '2020-10-08 11:38:52'),
(2, '120 SqYd', '120 SqYd', 1, '1', '2020-10-02 07:34:04', '2020-10-02 07:34:04'),
(3, '180 SqYd', '180 SqYd', 1, '1', '2020-10-02 07:34:26', '2020-10-02 07:34:26'),
(4, '240 SqYd', '240 SqYd', 1, '1', '2020-10-02 07:34:44', '2020-10-02 07:34:44'),
(5, '240 sqr', 'sdf-des', 1, '4', '2021-01-24 21:49:28', '2021-01-24 21:49:59');

-- --------------------------------------------------------

--
-- Table structure for table `userroles`
--

CREATE TABLE `userroles` (
  `id` int(1) NOT NULL,
  `role` text NOT NULL,
  `parent_id` int(1) NOT NULL DEFAULT 0,
  `rights` text NOT NULL,
  `description` text NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT 0,
  `created_at` text NOT NULL,
  `updated_at` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userroles`
--

INSERT INTO `userroles` (`id`, `role`, `parent_id`, `rights`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(2, 'Admin', 0, '[\"Application_view\",\"Application_insert\",\"Application_update\",\"Application_delete\",\"Users\"]', '', 0, '2020-01-16 10:51:14', '2020-01-18 06:29:50'),
(3, 'View Only', 0, '[\"Application_view\",\"Application_delete\"]', '', 0, '2020-01-17 05:22:57', '2020-02-19 07:24:42'),
(4, 'Data Entry', 0, '[\"BS\",\"CF\",\"Changes Equity\",\"Statement\",\"N4.1-N21\",\"N22-N27\",\"Sales Report\"]', '', 0, '2020-01-17 11:04:43', '2020-02-19 07:25:00'),
(7, 'Supervisor Entry', 42, '[\"BS\",\"CF\",\"Changes Equity\",\"Statement\",\"N4.1-N21\",\"N22-N27\",\"Sales Report\",\"Users\",\"Account\",\"Account Readonly\",\"Vouchers\",\"Vouchers Readonly\",\"JournalVoucher\",\"JournalVoucher Readonly\",\"Title\",\"Title Readonly\"]', '', 0, '2020-01-20 11:32:25', '2020-02-19 07:25:18'),
(8, 'user', 27, '[]', '', 0, '2020-07-22 11:19:28', '2020-07-22 11:19:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `role` int(11) NOT NULL DEFAULT 0,
  `user_type` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `p_no` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cell` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `api_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `user_type`, `created_by`, `p_no`, `name`, `cell`, `email`, `password`, `remember_token`, `api_token`, `is_active`, `status`, `created_at`, `updated_at`) VALUES
(27, 2, 1, 1, 2020, 'Asad', NULL, 'admin@mail.com', '$2y$10$S9gsARO8wbuqr1jKY19.EexTeJFvD6CI7zc5OmytyqHUEZTzXDpya', '8ISd3f9H397DUWrI6M8ojVee6xlQHeRSbpQF7VRkkrNDDe4ijkpY48gHwvGa', 'ry0EOhGwvQdPkEcOgomzDdKeBY9wbAZmqYYD1wDUJSdSs86judU43kJRzYUg', 1, 1, '2019-10-02 08:04:42', '2020-02-26 01:21:45'),
(112, 8, 5, 27, 2000, 'Arslan', NULL, '2000', '$2y$10$6tso1lCXClgalp6fu999ieai4D7m4vs.42OWTN8gYVwSRxJw296/m', NULL, NULL, 1, 1, '2020-12-31 14:34:54', '2020-12-31 14:34:54'),
(113, 8, 5, 27, 2001, 'Sadam Hussain', NULL, '2001', '$2y$10$zaBHxoV4X6uzpe3P9V3euewdrZJ/JY6.9UrP4hVMq7DiipIQ2okW.', NULL, NULL, 1, 1, '2020-12-31 15:35:29', '2020-12-31 15:35:29'),
(114, 8, 5, 27, 2002, 'Shan Ali', NULL, '2002', '$2y$10$ZNAxBhx1pdM.btmcTANW4.OkiqRbY08Mf3J2hWItiJrBSBIfV6Dra', NULL, NULL, 1, 1, '2020-12-31 15:41:59', '2020-12-31 15:41:59'),
(115, 8, 5, 27, 2003, 'Abid Ali', NULL, '2003', '$2y$10$KHLyGyUxPvzlBYKaMkb9leKb9i/amOBK1Usc5IenJ.BeRb8r0Yyay', NULL, NULL, 1, 1, '2020-12-31 15:48:10', '2020-12-31 15:48:10'),
(116, 8, 5, 27, 2004, 'Khan Ali', NULL, '2004', '$2y$10$PzZQugDnhkqxOchjq0mwjOIUvOiaU4CeXTgnTe2zeN3dpEtcpKwbK', NULL, NULL, 1, 1, '2020-12-31 15:52:16', '2020-12-31 15:52:16'),
(117, 8, 5, 27, 10001, 'KALEEM KHAN', NULL, '10001', '$2y$10$bEN/hcMPKWxbgutsqd372uVHH32d0/3BFBDtPCPGfBD6Aw0pMPg.W', NULL, NULL, 1, 1, '2021-01-11 09:35:26', '2021-01-11 09:35:26'),
(118, 8, 5, 27, 10002, 'MUHAMMAD KASHIF', NULL, '10002', '$2y$10$F53AMQJABJWr4oliiKDA9.U/FDfiD4eZw9XYY4BJJ/nYljhAZ6bRa', NULL, NULL, 1, 1, '2021-01-11 09:42:07', '2021-01-11 09:42:07'),
(119, 8, 5, 27, 10004, 'FAIZAN ALI', NULL, '10004', '$2y$10$Ft9hRGNMaFD2bYgxN6CdGObFOw5K4zz3bq6lgwFx6ZSNPgHVUhx52', NULL, NULL, 1, 1, '2021-01-11 09:48:27', '2021-01-11 09:48:27'),
(120, 8, 5, 27, 10005, 'SALEEM JAN', NULL, '10005', '$2y$10$hpuYQ7c0zC1luEbOOauJ0OVFUE2Hqu2TXIJ20h4r7.nQkONrs9Z3S', NULL, NULL, 1, 1, '2021-01-11 10:06:56', '2021-01-11 10:06:56'),
(121, 8, 5, 27, 10006, 'KHALID ALI', NULL, '10006', '$2y$10$Q9PnQAA.m8PPbHTD29QqauBauQPlOvhljsk5yLfaeX19wNkbxmjt6', NULL, NULL, 1, 1, '2021-01-11 10:15:43', '2021-01-11 10:15:43'),
(122, 8, 5, 27, 10007, 'JUNAID', NULL, '10007', '$2y$10$aOeEl4Z8TYImQy15eE2EfuUJXlyjjZjYGJr4s0Cp/Mr163MSV0ChC', NULL, NULL, 1, 1, '2021-01-11 10:33:38', '2021-01-11 10:33:38'),
(123, 8, 5, 27, 10008, 'ZAHID', NULL, '10008', '$2y$10$TVGBBJzcgJVkDgTJyxCjhOc3fL3odQkDkpW/sOPZlb0rTZeqo3X6e', NULL, NULL, 1, 1, '2021-01-11 12:12:09', '2021-01-11 12:12:09'),
(124, 8, 5, 27, 10009, 'KALEEM', NULL, '10009', '$2y$10$bblDj9UlZuQYUPGpCLLdOOKQv3fbn4akQRq9Dm4r4LbpKrAVpyFUG', NULL, NULL, 1, 1, '2021-01-13 11:37:31', '2021-01-13 11:37:31'),
(125, 8, 5, 27, 10010, 'KASHIF', NULL, '10010', '$2y$10$aOWtriez59wLJBL9A0DO.eh4LWtWbO8kgaCgNZSO5hT7CkANfqEAC', NULL, NULL, 1, 1, '2021-01-13 11:51:25', '2021-01-13 11:51:25'),
(126, 8, 5, 27, 10011, 'Bilal', NULL, '10011', '$2y$10$CovqTVFrjJT26m252JEj3uk0TfhZPoZnm8GFo8XnpWi8Ml/HYqoPq', NULL, NULL, 1, 1, '2021-01-15 09:20:44', '2021-01-15 09:20:44'),
(127, 8, 5, 27, 654321, 'MUBEEN', NULL, '654321', '$2y$10$NISM0T733KNP6SEEvzHoZeAZXZVvCzHddd7O4//doag7UWoeMRupO', NULL, NULL, 1, 1, '2021-01-15 14:52:22', '2021-01-15 14:52:22'),
(128, 8, 5, 27, 70007, 'Khan Ali', NULL, '70007', '$2y$10$yvXGH8suc54tLKCKB3U9z.eFEOzis3fzd9V3cWUCZwt0bBj6dkECW', NULL, NULL, 1, 1, '2021-01-23 06:15:14', '2021-01-23 06:15:14'),
(129, 8, 5, 27, 1234, 'Deepak', NULL, '1234', '$2y$10$XNIAvYZzM01jn47lKT7qQuBWyv9rZ5d1/3I3opHn6vzNrMLONM1Kq', NULL, NULL, 1, 1, '2021-01-24 17:01:11', '2021-01-24 17:01:11');

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE `usertype` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `statuss` int(11) DEFAULT 1,
  `rights_id` varchar(255) DEFAULT NULL,
  `user_of` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`id`, `name`, `description`, `statuss`, `rights_id`, `user_of`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', 1, '[\"1\",\"2\",\"4\"]', 1, 1, '2019-07-29 20:48:16', '2019-08-19 01:22:57'),
(2, 'viewonly', 'User', 1, '[\"1\"]', 1, 1, '2019-07-29 20:48:28', '2019-08-19 01:23:21'),
(3, 'dataentry', 'User', 1, '[\"1\"]', 1, 1, '2019-07-29 20:48:28', '2019-08-19 01:23:21'),
(4, 'supervisor', 'User', 1, '[\"1\"]', 1, 1, '2019-07-29 20:48:28', '2019-08-19 01:23:21'),
(5, 'user', 'User', 1, '[\"1\"]', 1, 1, '2019-07-29 20:48:28', '2019-08-19 01:23:21');

-- --------------------------------------------------------

--
-- Table structure for table `user_chefs`
--

CREATE TABLE `user_chefs` (
  `id` int(11) NOT NULL,
  `p_no` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `cnic_no` varchar(20) DEFAULT NULL,
  `mobile_no` varchar(12) DEFAULT NULL,
  `security_clearance` tinyint(1) DEFAULT 0,
  `blacklist` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_children`
--

CREATE TABLE `user_children` (
  `id` int(11) NOT NULL,
  `p_no` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `age` varchar(2) DEFAULT NULL,
  `gender` varchar(11) DEFAULT NULL,
  `security_clearance` tinyint(1) DEFAULT 0,
  `blacklist` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_drivers`
--

CREATE TABLE `user_drivers` (
  `id` int(11) NOT NULL,
  `p_no` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `cnic_no` varchar(20) DEFAULT NULL,
  `mobile_no` varchar(12) DEFAULT NULL,
  `security_clearance` tinyint(1) DEFAULT 0,
  `blacklist` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_gardeners`
--

CREATE TABLE `user_gardeners` (
  `id` int(11) NOT NULL,
  `p_no` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `cnic_no` varchar(20) DEFAULT NULL,
  `mobile_no` varchar(12) DEFAULT NULL,
  `security_clearance` tinyint(1) DEFAULT 0,
  `blacklist` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_mades`
--

CREATE TABLE `user_mades` (
  `id` int(11) NOT NULL,
  `p_no` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `cnic_no` varchar(20) DEFAULT NULL,
  `mobile_no` varchar(12) DEFAULT NULL,
  `security_clearance` tinyint(1) DEFAULT 0,
  `blacklist` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_permission`
--

CREATE TABLE `user_permission` (
  `id` int(1) NOT NULL,
  `name` text NOT NULL,
  `parent_id` int(1) NOT NULL DEFAULT 0,
  `description` text NOT NULL,
  `created_at` text NOT NULL,
  `updated_at` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_permission`
--

INSERT INTO `user_permission` (`id`, `name`, `parent_id`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Application_view', 0, 'Application_view', '17-01-20202 12:12:00', '2020-02-19 07:56:30'),
(4, 'Application_insert', 0, 'Application_insert', '2020-01-16 10:09:52', '2020-02-19 07:57:40'),
(5, 'Application_update', 0, 'Application_update', '2020-01-16 10:10:26', '2020-02-19 08:00:11'),
(6, 'Application_delete', 0, 'Application_delete', '2020-01-16 10:10:33', '2020-02-19 08:00:35'),
(9, 'Users', 0, 'Users', '2020-01-16 10:11:10', '2020-02-19 12:38:06'),
(10, 'excel', 27, 'file upload', '2020-07-17 10:22:56', '2020-07-17 10:22:56'),
(11, 'user', 27, 'user', '2020-07-22 11:23:25', '2020-07-22 11:23:25');

-- --------------------------------------------------------

--
-- Table structure for table `user_wivies`
--

CREATE TABLE `user_wivies` (
  `id` int(11) NOT NULL,
  `p_no` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `cnic_no` varchar(20) DEFAULT NULL,
  `mobile_no` varchar(12) DEFAULT NULL,
  `security_clearance` tinyint(1) DEFAULT 0,
  `blacklist` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abide`
--
ALTER TABLE `abide`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `alloted_houses`
--
ALTER TABLE `alloted_houses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `allottee_details_of_kins`
--
ALTER TABLE `allottee_details_of_kins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `allottee_details_service`
--
ALTER TABLE `allottee_details_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `allottee_files`
--
ALTER TABLE `allottee_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `allottee_particulars`
--
ALTER TABLE `allottee_particulars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assigned_policies`
--
ALTER TABLE `assigned_policies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignplot`
--
ALTER TABLE `assignplot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `block`
--
ALTER TABLE `block`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `construction`
--
ALTER TABLE `construction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `constructor`
--
ALTER TABLE `constructor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `csv_data`
--
ALTER TABLE `csv_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `csv_file`
--
ALTER TABLE `csv_file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `csv_raw_data`
--
ALTER TABLE `csv_raw_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `csv_raw_files`
--
ALTER TABLE `csv_raw_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery_images`
--
ALTER TABLE `gallery_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `get_profits`
--
ALTER TABLE `get_profits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hereby`
--
ALTER TABLE `hereby`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `house_alloted_details`
--
ALTER TABLE `house_alloted_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `house_categories`
--
ALTER TABLE `house_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `house_cost`
--
ALTER TABLE `house_cost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kinsmulltiplefiles`
--
ALTER TABLE `kinsmulltiplefiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `membershippayment`
--
ALTER TABLE `membershippayment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members_profit`
--
ALTER TABLE `members_profit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monthly_instalments`
--
ALTER TABLE `monthly_instalments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `other`
--
ALTER TABLE `other`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payable_reg_insurances`
--
ALTER TABLE `payable_reg_insurances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_policies`
--
ALTER TABLE `payment_policies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_policy_data`
--
ALTER TABLE `payment_policy_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plots`
--
ALTER TABLE `plots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promoted_members`
--
ALTER TABLE `promoted_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_type`
--
ALTER TABLE `property_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ranks`
--
ALTER TABLE `ranks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userroles`
--
ALTER TABLE `userroles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `usertype`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_chefs`
--
ALTER TABLE `user_chefs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_children`
--
ALTER TABLE `user_children`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_drivers`
--
ALTER TABLE `user_drivers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_gardeners`
--
ALTER TABLE `user_gardeners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_mades`
--
ALTER TABLE `user_mades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_permission`
--
ALTER TABLE `user_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_wivies`
--
ALTER TABLE `user_wivies`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abide`
--
ALTER TABLE `abide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `alloted_houses`
--
ALTER TABLE `alloted_houses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `allottee_details_of_kins`
--
ALTER TABLE `allottee_details_of_kins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `allottee_details_service`
--
ALTER TABLE `allottee_details_service`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `allottee_files`
--
ALTER TABLE `allottee_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `allottee_particulars`
--
ALTER TABLE `allottee_particulars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `assigned_policies`
--
ALTER TABLE `assigned_policies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `assignplot`
--
ALTER TABLE `assignplot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `block`
--
ALTER TABLE `block`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `construction`
--
ALTER TABLE `construction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `constructor`
--
ALTER TABLE `constructor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `csv_data`
--
ALTER TABLE `csv_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `csv_file`
--
ALTER TABLE `csv_file`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `csv_raw_data`
--
ALTER TABLE `csv_raw_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `csv_raw_files`
--
ALTER TABLE `csv_raw_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery_images`
--
ALTER TABLE `gallery_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `get_profits`
--
ALTER TABLE `get_profits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hereby`
--
ALTER TABLE `hereby`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `house_alloted_details`
--
ALTER TABLE `house_alloted_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `house_categories`
--
ALTER TABLE `house_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `house_cost`
--
ALTER TABLE `house_cost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kinsmulltiplefiles`
--
ALTER TABLE `kinsmulltiplefiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `membershippayment`
--
ALTER TABLE `membershippayment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members_profit`
--
ALTER TABLE `members_profit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `monthly_instalments`
--
ALTER TABLE `monthly_instalments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `other`
--
ALTER TABLE `other`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `payable_reg_insurances`
--
ALTER TABLE `payable_reg_insurances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `payment_policies`
--
ALTER TABLE `payment_policies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment_policy_data`
--
ALTER TABLE `payment_policy_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `plots`
--
ALTER TABLE `plots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `promoted_members`
--
ALTER TABLE `promoted_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `property_type`
--
ALTER TABLE `property_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ranks`
--
ALTER TABLE `ranks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `userroles`
--
ALTER TABLE `userroles`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `usertype`
--
ALTER TABLE `usertype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_chefs`
--
ALTER TABLE `user_chefs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_children`
--
ALTER TABLE `user_children`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_drivers`
--
ALTER TABLE `user_drivers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_gardeners`
--
ALTER TABLE `user_gardeners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_mades`
--
ALTER TABLE `user_mades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_permission`
--
ALTER TABLE `user_permission`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_wivies`
--
ALTER TABLE `user_wivies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
