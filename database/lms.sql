-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2023 at 03:03 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `user_id` int(11) NOT NULL,
  `school_number` int(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `password` varchar(80) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`user_id`, `school_number`, `fname`, `lname`, `password`, `role`) VALUES
(1, 0, 'asd', '', '$2y$10$OKvAbowU9IXlD8YddTBo7ObZgCyMM1SjQ7DGBmMmM4dmbgVZZySna', 'student'),
(2, 1234, 'asdf', 'asdf', '$2y$10$SoQZ2od3rahUbA0Q7azTxe/1wQPRngp2Tz2MkH3pTcPPqx6ZXmMa6', 'student');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `admin_image` varchar(100) NOT NULL,
  `admin_type` varchar(100) NOT NULL,
  `admin_added` datetime NOT NULL,
  `grade_lvl` int(11) NOT NULL,
  `section` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `firstname`, `middlename`, `lastname`, `username`, `password`, `admin_image`, `admin_type`, `admin_added`, `grade_lvl`, `section`, `status`) VALUES
(5, 'Admin', 'Admin', 'Admin', 'admin', '$2y$10$GxNcK7tVtD6HoEintxuZZOlNCdr.zS2m6McuEEf5otRwWX6R.ziA.', 'Glory Mae Nicolas PO.jpg', 'Super Admin', '2023-11-18 01:18:00', 0, '', 0),
(6, 'counselor', 'counselor', 'counselor', 'counselor', '$2y$10$sqjV.6nOmT3K/CvsIMqECOIKnkD6jZHxeZ7YSO774m.RsVevpfKO2', 'Glory Mae Nicolas PO.jpg', 'Adviser', '2023-11-18 22:11:16', 1, 'Alfonso, Redhorse', 0),
(17, 'asdf', 'asd', 'asdf', 'asf', '$2y$10$aqutHa2bSRS4jBP/ILg2AuUtw5TN8H/7r95OCHFmrDZN2OkLBI8o.', 'Screenshot (1).png', 'Adviser', '2023-12-05 08:44:28', 7, 'Sardonyx, Opal', 0),
(18, 'fgjhgf', 's', 'sdg', 'sdfgs', '$2y$10$0UtfYGvbtE5XdObtjXoXFOih6zaWlwG9Z46yXeXrgUbBO75Zaac6u', 'Screenshot (6).png', 'Encoder', '2023-12-05 11:47:30', 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `allowed_book`
--

CREATE TABLE `allowed_book` (
  `allowed_book_id` int(11) NOT NULL,
  `qntty_books` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `allowed_book`
--

INSERT INTO `allowed_book` (`allowed_book_id`, `qntty_books`) VALUES
(1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `allowed_days`
--

CREATE TABLE `allowed_days` (
  `allowed_days_id` int(11) NOT NULL,
  `no_of_days` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `allowed_days`
--

INSERT INTO `allowed_days` (`allowed_days_id`, `no_of_days`) VALUES
(1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `barcode`
--

CREATE TABLE `barcode` (
  `barcode_id` int(11) NOT NULL,
  `pre_barcode` varchar(100) NOT NULL,
  `mid_barcode` int(100) NOT NULL,
  `suf_barcode` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `barcode`
--

INSERT INTO `barcode` (`barcode_id`, `pre_barcode`, `mid_barcode`, `suf_barcode`) VALUES
(1, 'VNHS', 1, 'LMS'),
(2, 'VNHS', 2, 'LMS'),
(3, 'VNHS', 3, 'LMS'),
(4, 'VNHS', 4, 'LMS'),
(5, 'VNHS', 5, 'LMS'),
(6, 'VNHS', 6, 'LMS'),
(7, 'VNHS', 7, 'LMS'),
(8, 'VNHS', 8, 'LMS'),
(9, 'VNHS', 9, 'LMS'),
(10, 'VNHS', 10, 'LMS'),
(11, 'VNHS', 11, 'LMS'),
(12, 'VNHS', 12, 'LMS'),
(13, 'VNHS', 13, 'LMS'),
(14, 'VNHS', 13, 'LMS'),
(15, 'VNHS', 14, 'LMS'),
(16, 'RRTS', 15, 'NSH'),
(17, 'RRTS', 16, 'NSH'),
(18, 'RRTS', 17, 'NSH'),
(19, 'RRTS', 0, 'NSH'),
(20, 'RRTS', 0, 'NSH'),
(21, 'RRTS', 0, 'NSH'),
(22, 'RRTS', 0, 'NSH');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `book_id` int(11) NOT NULL,
  `cn` int(4) NOT NULL,
  `book_title` varchar(100) NOT NULL,
  `category_id` int(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `author_2` varchar(100) NOT NULL,
  `author_3` varchar(100) NOT NULL,
  `author_4` varchar(100) NOT NULL,
  `author_5` varchar(100) NOT NULL,
  `book_copies` int(11) NOT NULL,
  `book_pub` varchar(100) NOT NULL,
  `publisher_name` varchar(100) NOT NULL,
  `isbn` varchar(50) NOT NULL,
  `copyright_year` int(11) NOT NULL,
  `status` varchar(30) NOT NULL,
  `book_image` varchar(100) NOT NULL,
  `date_added` datetime NOT NULL,
  `remarks` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_id`, `cn`, `book_title`, `category_id`, `author`, `author_2`, `author_3`, `author_4`, `author_5`, `book_copies`, `book_pub`, `publisher_name`, `isbn`, `copyright_year`, `status`, `book_image`, `date_added`, `remarks`) VALUES
(1, 1234, 'English Expressways : Second Year', 1, 'Virginia F. Bermudez', 'Remedios F. Nery', 'Josephine M. Cruz', 'Milagrosa A. San Juan', '', 15, '2010', 'SD Publications, INC.', '978-971-0315-72-7', 2010, 'Damaged', '../../image/uploadz/Screenshot (8).png', '2015-12-14 01:06:46', 'Available'),
(23, 1333, '2asd', 1, 'asd', 'asd', 'asd', 'asd', '0', 1, 'asd', 'asd', 'asd', 0, 'New', '../../image/uploadz/Screenshot (15).png', '2023-12-03 11:04:22', 'Available'),
(24, 12345, 'Blablabbla balsdfa', 2, 'balsff', '', '', '', '0', 2, '', '', 'fasfa', 0, 'New', 'Glory Mae Nicolas.jpg', '2023-12-05 20:17:03', 'Available'),
(25, 13121, 'asda', 1, 'asda', '', '', '', '0', 2, '', '', 'asd', 0, 'New', '369049812_879939766855810_4229472135979198381_n.jpg', '2023-12-05 20:45:08', 'Available'),
(26, 223212, 'asda', 1, 'asdas', '', '', '', '0', 2, '', '', 'asa', 0, 'New', 'Glory Mae Nicolas PO.jpg', '2023-12-05 20:45:40', 'Available'),
(27, 2232, 'asa', 1, 'gfds', '', '', '', '0', 2, '', '', 'sdf', 0, 'New', '369049812_879939766855810_4229472135979198381_n.jpg', '2023-12-05 20:46:07', 'Available'),
(28, 77, 'sdfjk', 1, 'pojn', '', '', '', '0', 6, '', '', 'jh', 0, 'New', 'Glory Mae Nicolas.jpg', '2023-12-05 20:46:31', 'Available'),
(29, 77, 'fasf', 1, 'fas', '', '', '', '0', 2, '', '', 'fsa', 0, 'New', '369049812_879939766855810_4229472135979198381_n.jpg', '2023-12-05 20:51:43', 'Available'),
(30, 875, 'ktm', 1, 'bny', '', '', '', '0', 4, '', '', 'm dt', 0, 'New', '369049812_879939766855810_4229472135979198381_n.jpg', '2023-12-05 20:52:47', 'Available'),
(31, 2147483647, 'bzbbfnhfgnhg', 1, ',mnbnmn', '', '', '', '0', 6, '', '', 'mnhb', 0, 'New', '369049812_879939766855810_4229472135979198381_n.jpg', '2023-12-05 20:53:05', 'Available'),
(32, 75645, 'mjdjdsnabaeavav', 1, 'baa', '', '', '', '0', 3, '', '', 'vav', 0, 'New', 'Glory Mae Nicolas PO.jpg', '2023-12-05 20:53:44', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `borrow_book`
--

CREATE TABLE `borrow_book` (
  `borrow_book_id` int(11) NOT NULL,
  `cn` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `date_borrowed` datetime NOT NULL,
  `due_date` datetime NOT NULL,
  `date_returned` datetime NOT NULL,
  `borrowed_status` varchar(100) NOT NULL,
  `book_penalty` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `classname` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `classname`) VALUES
(1, 'Textbook'),
(2, 'English'),
(3, 'Math'),
(4, 'Science'),
(5, 'Encyclopedia'),
(6, 'Filipiniana'),
(7, 'Novel'),
(8, 'General'),
(9, 'References');

-- --------------------------------------------------------

--
-- Table structure for table `grade_section`
--

CREATE TABLE `grade_section` (
  `id` int(11) NOT NULL,
  `section_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grade_section`
--

INSERT INTO `grade_section` (`id`, `section_name`) VALUES
(1, 'Sardonyx'),
(2, 'Opal'),
(3, 'Alexandrite'),
(4, 'Ametyst'),
(5, 'Ruby'),
(6, 'Aquamarine'),
(7, 'Blodstone'),
(8, 'Pearl'),
(9, 'ABM'),
(10, 'SMAW'),
(11, 'ABM');

-- --------------------------------------------------------

--
-- Table structure for table `penalty`
--

CREATE TABLE `penalty` (
  `penalty_id` int(11) NOT NULL,
  `penalty_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `penalty`
--

INSERT INTO `penalty` (`penalty_id`, `penalty_amount`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `report_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `detail_action` varchar(100) NOT NULL,
  `date_transaction` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`report_id`, `book_id`, `user_id`, `admin_name`, `detail_action`, `date_transaction`) VALUES
(1, 7, 2, 'Jane M. Doe', 'Borrowed Book', '2015-12-14 02:50:30'),
(2, 7, 1, 'Jane M. Doe', 'Borrowed Book', '2015-12-14 02:51:00'),
(3, 7, 4, 'Jane M. Doe', 'Borrowed Book', '2015-12-14 02:52:01'),
(4, 3, 4, 'Jane M. Doe', 'Borrowed Book', '2015-12-14 02:53:16'),
(5, 7, 2, 'Jane M. Doe', 'Returned Book', '2015-12-14 02:57:34'),
(6, 7, 1, 'Jane M. Doe', 'Returned Book', '2015-12-14 02:57:37'),
(7, 7, 4, 'Jane M. Doe', 'Returned Book', '2015-12-14 02:57:45'),
(8, 3, 4, 'Jane M. Doe', 'Returned Book', '2015-12-14 02:57:48'),
(9, 7, 17, 'Jane M. Doe', 'Borrowed Book', '2015-12-14 03:08:51'),
(10, 7, 4, 'Jane M. Doe', 'Borrowed Book', '2015-12-14 03:09:01'),
(11, 7, 20, 'Jane M. Doe', 'Borrowed Book', '2015-12-14 03:09:08'),
(12, 4, 14, 'Jane M. Doe', 'Borrowed Book', '2015-12-14 08:32:16'),
(13, 11, 41, 'Jane M. Doe', 'Borrowed Book', '2023-10-15 00:07:19');

-- --------------------------------------------------------

--
-- Table structure for table `return_book`
--

CREATE TABLE `return_book` (
  `return_book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `date_borrowed` datetime NOT NULL,
  `due_date` datetime NOT NULL,
  `date_returned` datetime NOT NULL,
  `book_penalty` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `return_book`
--

INSERT INTO `return_book` (`return_book_id`, `user_id`, `book_id`, `date_borrowed`, `due_date`, `date_returned`, `book_penalty`) VALUES
(1, 2, 7, '2015-11-14 02:50:27', '2015-11-17 02:50:27', '2015-12-14 02:57:31', '27'),
(2, 1, 7, '2015-11-14 02:50:58', '2015-11-17 02:50:58', '2015-12-14 02:57:30', '27'),
(3, 4, 7, '2015-12-14 02:51:59', '2015-12-17 02:51:59', '2015-12-13 02:57:29', 'No Penalty'),
(4, 4, 3, '2015-12-14 02:53:15', '2015-12-17 02:53:15', '2015-12-14 02:57:45', 'No Penalty');

-- --------------------------------------------------------

--
-- Table structure for table `student_user`
--

CREATE TABLE `student_user` (
  `id` int(11) NOT NULL,
  `lrn` int(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `mname` varchar(11) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `sex` varchar(11) NOT NULL,
  `address` varchar(50) NOT NULL,
  `glevel` int(11) NOT NULL,
  `gsection` varchar(11) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_user`
--

INSERT INTO `student_user` (`id`, `lrn`, `fname`, `lname`, `mname`, `contact`, `sex`, `address`, `glevel`, `gsection`, `password`) VALUES
(6, 54, 'asdf', 'asdf', 'asdf', '+6123', 'male', '', 4, 'Aba', '$2y$10$0HUEJ6HhFe.fwnGf4jgkf.HeNlUVEpDwPaepkJJInia'),
(8, 1234, 'asd', 'asd', 'asd', '+63232', 'male', '', 2, 'Aba', '$2y$10$Fkk6uaF.xWGBnHXA40wNUOcJ5wQlLu2we9nbrsst8cj'),
(10, 1010203, 'fas', 'fas', 'fas', '+630101', 'female', 'asdf', 1, 'Aba', '$2y$10$QEDn.dCMEpxOG6C9QOxRVeMgSXKwTitQ.hw4lsKCvJN'),
(11, 101, 'qwer', 'qwer', 'qwer', '123', 'male', 'qwer', 1, 'Aba', '$2y$10$wmmhWCE5p/.281E6xhYtD.dldkX5f29tdROvQw7mfHw'),
(12, 1234, 'test', 'test', 't', '1234', 'male', '', 1, 'Aba', '$2y$10$J3ZEVxMa5W7eXzChVap6F.L.wxB3LObaCPT4DWAzOAY'),
(13, 12345678, 'num', 'n', 'n', '53252', 'male', 'f2fsf', 2, 'Aba', '$2y$10$GfapqanzhmZ5PFz3pAapo.Ndj/Eep1UuEhKMQK2CMry');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_backup`
--

CREATE TABLE `tbl_backup` (
  `id` int(11) NOT NULL,
  `bakupname` varchar(50) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_backup`
--

INSERT INTO `tbl_backup` (`id`, `bakupname`, `date`) VALUES
(2, 'rrtsnss2023-10-22_65353e8cbb7ca.sql', '2023-10-22'),
(3, 'rrtsnss_2023-10-22_653542df05f16.sql', '2023-10-22'),
(4, 'rrtsnss_2023-11-18_6558c400ae57e.sql', '2023-11-18'),
(5, 'rrtsnss_2023-11-20_655b74f792124.sql', '2023-11-20'),
(6, 'rrtsnss_2023-11-20_655b7b72127f5.sql', '2023-11-20'),
(7, 'rrtsnss_2023-11-23_655f79cc5ce91.sql', '2023-11-23'),
(8, '2023-11-26 21:28:11', '2023-11-26'),
(9, '2023-11-26 21:56:42', '2023-11-26'),
(10, 'rrtsnss_2023-11-26_6563b2b131cb6.sql', '2023-11-26');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `school_number` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `level` int(11) NOT NULL,
  `section` varchar(100) NOT NULL,
  `user_image` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `user_added` datetime NOT NULL,
  `status2` int(11) NOT NULL DEFAULT 0,
  `password` varchar(255) DEFAULT 'default1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `school_number`, `firstname`, `middlename`, `lastname`, `contact`, `gender`, `address`, `type`, `level`, `section`, `user_image`, `status`, `user_added`, `status2`, `password`) VALUES
(61, '123456789123', 'Test2', 'T', 'Te', '', 'Male', '', 'Student', 0, '', '../../image/local_image/picture.jpg', 'Offline', '2023-12-05 19:35:14', 0, '$2y$10$sGcN0O7X9heHrmHAhAZQi.6m/Gm/NgVPX9RC9hR15VxdG8QzNnFX6'),
(62, '123456781235', 'Test3', 'T', 'Test3', '09123456789', 'Male', 'Aurora', 'Student', 0, '', 'Screenshot (6).png', 'Offline', '2023-12-05 19:37:50', 0, '$2y$10$09f3CfhYMWi566ytB9FuhenVGUPkPOB7s2aHMR3MARRBRmH9qPyLm'),
(63, '123456781236', 'Test4', 'T', 'Test4', '09123456789', 'Male', 'Aurora', 'Student', 0, '', '../../image/local_image/picture.jpg', 'Offline', '2023-12-05 19:40:18', 0, '$2y$10$KmbII8A/5AeXMM95annVFu.krcPuv/IoQvf/fJAcO6oa65ipH.oC2'),
(64, '123456781236', 'Test4', 'T', 'Test4', '09123456789', 'Male', 'Aurora', 'Student', 0, '', '../../image/local_image/picture.jpg', 'Offline', '2023-12-05 19:42:59', 0, '$2y$10$6pkjNEB2RZAuQjdqXvCm2eGsExMNhIv41SuM5z4WcXVLCf99G48By'),
(65, '123456781237', 'Test5', 'T', 'Test5', '', 'Male', '', 'Student', 7, 'Sardonyx', 'Screenshot (8).png', 'Offline', '2023-12-05 19:44:31', 0, '$2y$10$V3huZoPSj8ebKFCFDrg3vOybd43og8Lk2l5Ja5VZIWGuWya6WaBp2');

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

CREATE TABLE `user_log` (
  `user_log_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `date_log` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `allowed_book`
--
ALTER TABLE `allowed_book`
  ADD PRIMARY KEY (`allowed_book_id`);

--
-- Indexes for table `allowed_days`
--
ALTER TABLE `allowed_days`
  ADD PRIMARY KEY (`allowed_days_id`);

--
-- Indexes for table `barcode`
--
ALTER TABLE `barcode`
  ADD PRIMARY KEY (`barcode_id`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `borrow_book`
--
ALTER TABLE `borrow_book`
  ADD PRIMARY KEY (`borrow_book_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_id` (`category_id`),
  ADD KEY `classid` (`category_id`);

--
-- Indexes for table `grade_section`
--
ALTER TABLE `grade_section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penalty`
--
ALTER TABLE `penalty`
  ADD PRIMARY KEY (`penalty_id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `return_book`
--
ALTER TABLE `return_book`
  ADD PRIMARY KEY (`return_book_id`);

--
-- Indexes for table `student_user`
--
ALTER TABLE `student_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_backup`
--
ALTER TABLE `tbl_backup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_log`
--
ALTER TABLE `user_log`
  ADD PRIMARY KEY (`user_log_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `allowed_book`
--
ALTER TABLE `allowed_book`
  MODIFY `allowed_book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `allowed_days`
--
ALTER TABLE `allowed_days`
  MODIFY `allowed_days_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `barcode`
--
ALTER TABLE `barcode`
  MODIFY `barcode_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `borrow_book`
--
ALTER TABLE `borrow_book`
  MODIFY `borrow_book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=801;

--
-- AUTO_INCREMENT for table `grade_section`
--
ALTER TABLE `grade_section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `penalty`
--
ALTER TABLE `penalty`
  MODIFY `penalty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `return_book`
--
ALTER TABLE `return_book`
  MODIFY `return_book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student_user`
--
ALTER TABLE `student_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_backup`
--
ALTER TABLE `tbl_backup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `user_log`
--
ALTER TABLE `user_log`
  MODIFY `user_log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
