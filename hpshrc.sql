-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2020 at 08:56 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hpshrc`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_user_id` bigint(20) NOT NULL,
  `user_firstname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_lastname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_email_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'User email id',
  `user_email_password` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'User email id password encrypted',
  `user_password_salt` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'User email id password salt',
  `user_password_question` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'User email id password security question',
  `user_password_answer` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'User email id password security question answer',
  `user_email_verified_status` int(11) DEFAULT 0 COMMENT 'User email id verification 0,1',
  `user_locked_status` int(11) DEFAULT 0 COMMENT 'User id lock status 0,1',
  `user_attempt` int(10) NOT NULL DEFAULT 0,
  `user_status` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'REMOVED' COMMENT 'ACTIVE or REMOVED',
  `user_activation_dt` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_dt` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `modified_dt` timestamp NULL DEFAULT current_timestamp(),
  `user_login_active` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_user_id`, `user_firstname`, `user_lastname`, `user_email_id`, `user_email_password`, `user_password_salt`, `user_password_question`, `user_password_answer`, `user_email_verified_status`, `user_locked_status`, `user_attempt`, `user_status`, `user_activation_dt`, `created_by`, `created_dt`, `modified_by`, `modified_dt`, `user_login_active`) VALUES
(7241, 'vasim', 'look', 'admin@hpie.in', '202cb962ac59075b964b07152d234b70', NULL, NULL, NULL, 1, 0, 0, 'ACTIVE', '2020-07-17 18:38:14', NULL, '2020-07-17 18:38:14', NULL, '2020-07-17 18:38:14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_token`
--

CREATE TABLE `admin_token` (
  `token_id` bigint(20) NOT NULL,
  `admin_user_id` bigint(20) NOT NULL,
  `token` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `timemodified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin_token`
--

INSERT INTO `admin_token` (`token_id`, `admin_user_id`, `token`, `timemodified`) VALUES
(3, 7241, 'uvL0YTzjEx', '2020-07-26 04:30:49');

-- --------------------------------------------------------

--
-- Table structure for table `hpshrc_categories`
--

CREATE TABLE `hpshrc_categories` (
  `category_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Unique Category Code',
  `category_title` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Displayed on the UI',
  `category_description` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Description of the category if any',
  `category_type` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Category Type for Category if they need to be grouped.',
  `ref_category_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `category_ref_type` enum('MAIN_TYPE','SUB_TYPE') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'MAIN_TYPE',
  `category_status` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A',
  `created_by` bigint(20) NOT NULL,
  `created_dt` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_by` bigint(20) DEFAULT NULL,
  `modified_dt` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hpshrc_categories`
--

INSERT INTO `hpshrc_categories` (`category_code`, `category_title`, `category_description`, `category_type`, `ref_category_code`, `category_ref_type`, `category_status`, `created_by`, `created_dt`, `modified_by`, `modified_dt`) VALUES
('FILE_SUB_TYP_ADMIN', 'Administrative Order', 'Semi Urban', 'UPLOAD_FILE_TYP_ORD', 'FILE_TYP_ORD', 'SUB_TYPE', 'A', 0, '2017-07-23 13:10:08', NULL, '2020-07-21 14:43:43'),
('FILE_SUB_TYP_FINAL', 'Final Order', 'Semi Urban', 'UPLOAD_FILE_TYP_ORD', 'FILE_TYP_ORD', 'SUB_TYPE', 'A', 0, '2017-07-23 13:10:08', NULL, '2020-07-21 14:43:47'),
('FILE_SUB_TYP_GAZZ', 'Gazzette', 'Semi Urban', 'UPLOAD_FILE_TYP_REC', 'FILE_TYP_REC', 'SUB_TYPE', 'A', 0, '2017-07-23 13:10:08', NULL, '2020-07-21 14:43:56'),
('FILE_SUB_TYP_INTRIM', 'Intrim Order', 'Semi Urban', 'UPLOAD_FILE_TYP_ORD', 'FILE_TYP_ORD', 'SUB_TYPE', 'A', 0, '2017-07-23 13:10:08', NULL, '2020-07-21 14:44:07'),
('FILE_SUB_TYP_PUBL', 'Publication', 'Semi Urban', 'UPLOAD_FILE_TYP_REC', 'FILE_TYP_REC', 'SUB_TYPE', 'A', 0, '2017-07-23 13:10:08', NULL, '2020-07-21 14:44:10'),
('FILE_TYP_COMP', 'Complaint', 'Semi Urban', 'UPLOAD_FILE_TYP', '', 'MAIN_TYPE', 'A', 0, '2017-07-23 13:10:08', NULL, '2020-07-21 12:41:41'),
('FILE_TYP_ORD', 'Order', 'Semi Urban', 'UPLOAD_FILE_TYP', '', 'MAIN_TYPE', 'A', 0, '2017-07-23 13:10:08', NULL, '2020-07-21 06:00:48'),
('FILE_TYP_REC', 'Record', 'Semi Urban', 'UPLOAD_FILE_TYP', '', 'MAIN_TYPE', 'A', 0, '2017-07-23 13:10:08', NULL, '2020-07-21 12:41:51');

-- --------------------------------------------------------

--
-- Table structure for table `hpshrc_upload_files`
--

CREATE TABLE `hpshrc_upload_files` (
  `upload_file_id` bigint(20) NOT NULL,
  `admin_user_id` bigint(20) DEFAULT NULL,
  `upload_file_title` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Title of the file to be dispayed',
  `upload_file_desc` varchar(500) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Description of the file to be dispayed',
  `upload_file_ref_no` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'File refrence number',
  `upload_file_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Type or File ORDER, RECORD, TENDER, COMPLAINT etc to be picked from hpshrc_categories',
  `upload_file_sub_type` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Admin Order, Legal Record, etc  will be subtype of filtype from hpshrc_categories table if avaliable',
  `upload_file_original_name` varchar(80) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Original file name',
  `upload_file_location` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Upload file path',
  `upload_file_status` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ACTIVE' COMMENT 'ACTIVE or REMOVED'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hpshrc_upload_files`
--

INSERT INTO `hpshrc_upload_files` (`upload_file_id`, `admin_user_id`, `upload_file_title`, `upload_file_desc`, `upload_file_ref_no`, `upload_file_type`, `upload_file_sub_type`, `upload_file_original_name`, `upload_file_location`, `upload_file_status`) VALUES
(6, 7241, 'ancd', 'abcd', '20', 'FILE_TYP_REC', 'FILE_SUB_TYP_PUBL', 'sample.pdf', 'uploads-24231-1595673813-20200725-124333pm.pdf', 'REMOVED'),
(7, 7241, 'test', 'asas', '10', 'FILE_TYP_REC', 'FILE_SUB_TYP_GAZZ', 'sample.pdf', 'uploads-52654-1595674042-20200725-124722pm.pdf', 'ACTIVE'),
(8, 7241, 'order file', 'testing file', '20', 'FILE_TYP_ORD', 'FILE_SUB_TYP_FINAL', 'sample.pdf', 'uploads-61327-1595728515-20200726-035515am.pdf', 'ACTIVE'),
(9, 7241, 'administrative order file', 'administrative order file', '5', 'FILE_TYP_ORD', 'FILE_SUB_TYP_ADMIN', 'sample.pdf', 'uploads-19720-1595728550-20200726-035550am.pdf', 'ACTIVE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_user_id`);

--
-- Indexes for table `admin_token`
--
ALTER TABLE `admin_token`
  ADD PRIMARY KEY (`token_id`);

--
-- Indexes for table `hpshrc_categories`
--
ALTER TABLE `hpshrc_categories`
  ADD PRIMARY KEY (`category_code`);

--
-- Indexes for table `hpshrc_upload_files`
--
ALTER TABLE `hpshrc_upload_files`
  ADD PRIMARY KEY (`upload_file_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7242;

--
-- AUTO_INCREMENT for table `admin_token`
--
ALTER TABLE `admin_token`
  MODIFY `token_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hpshrc_upload_files`
--
ALTER TABLE `hpshrc_upload_files`
  MODIFY `upload_file_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
