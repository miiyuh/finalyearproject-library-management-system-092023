-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 3 Nov, 2023 at 08:15 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+08:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Database: `library`

-- --------------------------------------------------------

-- Table structure for table `admin`

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `admin_name` varchar(100) DEFAULT NULL,
  `admin_email` varchar(120) DEFAULT NULL,
  `admin_username` varchar(100) NOT NULL,
  `admin_password` varchar(100) NOT NULL,
  `updation_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table `admin`

INSERT INTO `admin` (`id`, `admin_name`, `admin_email`, `admin_username`, `admin_password`, `updation_date`) VALUES
(1, 'Admong Us', 'admongus@gmail.com', 'admin', 'e6e061838856bf47e1de730719fb2609', '2023-11-01 00:00:00');

-- --------------------------------------------------------

-- Table structure for table `authors`

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `author_name` varchar(159) DEFAULT NULL,
  `creation_date` timestamp NULL DEFAULT current_timestamp(),
  `updation_date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table `authors`

INSERT INTO `authors` (`id`, `author_name`, `creation_date`, `updation_date`) VALUES
(1, 'Hajima Isayama', '2009-09-09 00:00:00', '2023-11-05 16:03:23'),
(2, 'Oda', '2023-07-08 14:30:23', '2023-11-28 16:03:35'),
(3, 'Ryan Gosling', '2023-07-08 14:35:08', '2023-11-28 16:03:43'),
(4, 'Among U.S.', '2023-07-08 14:35:21', NULL),
(5, 'J. Kidding', '2023-07-08 14:35:36', NULL),
(9, 'Fuhrer', '2023-07-08 15:22:03', NULL);

-- --------------------------------------------------------

-- Table structure for table `books`

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `book_name` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `isbn_number` int(11) DEFAULT NULL,
  `book_price` int(11) DEFAULT NULL,
  `register_date` timestamp NULL DEFAULT current_timestamp(),
  `updation_date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table `books`

INSERT INTO `books` (`id`, `book_name`, `category_id`, `author_id`, `isbn_number`, `book_price`, `register_date`, `updation_date`) VALUES
(1, 'PHP And MySQL Programming', 5, 1, 222333, 20, '2023-07-08 20:04:55', '2023-07-15 05:54:41'),
(3, 'SPM Physics', 6, 4, 1111, 15, '2023-07-08 20:17:31', '2023-07-15 06:13:17');

-- --------------------------------------------------------

-- Table structure for table `category`

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(150) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `creation_date` timestamp NULL DEFAULT current_timestamp(),
  `updation_date` timestamp NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table `category`

INSERT INTO `category` (`id`, `category_name`, `status`, `creation_date`, `updation_date`) VALUES
(4, 'Romance', 1, '2023-07-04 18:35:25', '2023-07-06 16:00:42'),
(5, 'Technology', 1, '2023-07-04 18:35:39', '2023-07-08 17:13:03'),
(6, 'Science', 1, '2023-07-04 18:35:55', '0000-00-00 00:00:00'),
(7, 'Management', 0, '2023-07-04 18:36:16', '0000-00-00 00:00:00');

-- --------------------------------------------------------

-- Table structure for table `issued_book_details`

CREATE TABLE `issued_book_details` (
  `id` int(11) NOT NULL,
  `book_id` int(11) DEFAULT NULL,
  `student_id` varchar(150) DEFAULT NULL,
  `issues_date` timestamp NULL DEFAULT current_timestamp(),
  `return_date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `return_status` int(1) DEFAULT NULL,
  `fine` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table `issued_book_details`

INSERT INTO `issued_book_details` (`id`, `book_id`, `student_id`, `issues_date`, `return_date`, `return_status`, `fine`) VALUES
(1, 1, 'SID002', '2023-07-15 06:09:47', '2023-07-15 11:15:20', 1, 0),
(2, 1, 'SID002', '2023-07-15 06:12:27', '2023-07-15 11:15:23', 1, 5),
(3, 3, 'SID002', '2023-07-15 06:13:40', NULL, 0, NULL),
(4, 3, 'SID002', '2023-07-15 06:23:23', '2023-07-15 11:22:29', 1, 2),
(5, 1, 'SID009', '2023-07-15 10:59:26', NULL, 0, NULL),
(6, 3, 'SID011', '2023-07-15 18:02:55', NULL, 0, NULL);

-- --------------------------------------------------------

-- Table structure for table `students`

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `student_id` varchar(100) DEFAULT NULL,
  `student_name` varchar(120) DEFAULT NULL,
  `student_email` varchar(120) DEFAULT NULL,
  `student_phonenumber` char(11) DEFAULT NULL,
  `student_password` varchar(120) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `register_date` timestamp NULL DEFAULT current_timestamp(),
  `updation_date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table `students`

INSERT INTO `students` (`id`, `student_id`, `student_name`, `student_email`, `student_phonenumber`, `student_password`, `status`, `register_date`, `updation_date`) VALUES
(1, 'SID002', 'Eren Yaeger', 'freedom_slave@gmail.com', '0196387642', 'f925916e2754e5e03f75dd58a5733251', 1, '2023-07-11 15:37:05', '2023-07-15 18:26:21'),
(4, 'SID005', 'Mikasa Ackerman', 'mikasa@gmail.com', '0193689952', '92228410fc8b872914e023160cf4ae8f', 0, '2023-07-11 15:41:27', '2023-07-15 17:43:03'),
(8, 'SID009', 'test', 'test@gmail.com', '2359874527', 'f925916e2754e5e03f75dd58a5733251', 1, '2023-07-11 15:58:28', '2023-07-15 13:42:44'),
(9, 'SID010', 'Armin Arlert', 'sea_lover@gmail.com', '0148367522', 'f925916e2754e5e03f75dd58a5733251', 1, '2023-07-15 13:40:30', NULL),
(10, 'SID011', 'Reiner Braun', 'iwtkms@gmail.com', '0133856920', 'f925916e2754e5e03f75dd58a5733251', 1, '2023-07-15 18:00:59', NULL);

-- Indexes for dumped tables

-- Indexes for table `admin`
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

-- Indexes for table `tblauthors`
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

-- Indexes for table `tblbooks`
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

-- Indexes for table `tblcategory`
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

-- Indexes for table `tblissuedbookdetails`
ALTER TABLE `issued_book_details`
  ADD PRIMARY KEY (`id`);

-- Indexes for table `tblstudents`
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`student_id`);

-- AUTO_INCREMENT for dumped tables

-- AUTO_INCREMENT for table `admin`
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

-- AUTO_INCREMENT for table `tblauthors`
ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

-- AUTO_INCREMENT for table `tblbooks`
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

-- AUTO_INCREMENT for table `tblcategory`
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

-- AUTO_INCREMENT for table `tblissuedbookdetails`
ALTER TABLE `issued_book_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

-- AUTO_INCREMENT for table `tblstudents`
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;