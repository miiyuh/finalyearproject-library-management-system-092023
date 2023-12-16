-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2023 at 07:20 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library_v0`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `admin_name` varchar(100) DEFAULT NULL,
  `admin_email` varchar(120) DEFAULT NULL,
  `admin_username` varchar(100) NOT NULL,
  `admin_password` varchar(100) NOT NULL,
  `updation_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `admin_name`, `admin_email`, `admin_username`, `admin_password`, `updation_date`) VALUES
(1, 'Muhamad Azri', 'admin@gmail.com', 'admin', 'f925916e2754e5e03f75dd58a5733251', '2023-12-16 08:13:08');

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `author_name` varchar(159) DEFAULT NULL,
  `creation_date` timestamp NULL DEFAULT current_timestamp(),
  `updation_date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `author_name`, `creation_date`, `updation_date`) VALUES
(1, 'Hajime Isayama', '2023-01-21 23:23:03', '2023-01-21 23:23:03'),
(2, 'Afiq A.', '2023-01-21 23:23:03', '2023-01-21 23:23:03'),
(16, 'W Jason Gilmore', '2023-12-16 06:56:59', NULL),
(17, 'Gege Akutami', '2023-12-16 10:31:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `book_name` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `isbn_number` varchar(25) DEFAULT NULL,
  `book_price` decimal(10,2) DEFAULT NULL,
  `book_image` varchar(250) NOT NULL,
  `is_issued` int(1) DEFAULT NULL,
  `registration_date` timestamp NULL DEFAULT current_timestamp(),
  `updation_date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `book_name`, `category_id`, `author_id`, `isbn_number`, `book_price`, `book_image`, `is_issued`, `registration_date`, `updation_date`) VALUES
(1, 'Beginning PHP and MySQL', 5, 16, '1430231149', 164.00, 'cea87edb9497eead7b38eab19ecfbaa2.jpg', 1, '2023-01-21 23:23:03', '2023-12-16 09:35:34'),
(12, 'Attack on Titan Volume 34', 10, 1, '9781646512362', 49.90, 'fb79e782abc4487ef5bf2a23be9f9027.jpg', 1, '2023-12-15 17:03:57', '2023-12-16 09:34:47'),
(13, 'Attack on Titan Volume 30', 10, 1, '9781632369024', 49.90, 'ce1cc7870098a380d805a4c1d156669c.png', 1, '2023-12-16 07:10:09', '2023-12-16 09:35:10'),
(14, 'Attack on Titan Volume 23', 10, 1, '9781632364630', 49.90, 'adb8a911f9dfe75d58789bcdf14d64f8.png', NULL, '2023-12-16 10:30:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `book_categories`
--

CREATE TABLE `book_categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(150) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `creation_date` timestamp NULL DEFAULT current_timestamp(),
  `updation_date` timestamp NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `book_categories`
--

INSERT INTO `book_categories` (`id`, `category_name`, `status`, `creation_date`, `updation_date`) VALUES
(4, 'Romance', 1, '2023-01-21 23:23:03', '2023-01-21 23:23:03'),
(5, 'Technology', 1, '2023-01-21 23:23:03', '2023-01-21 23:23:03'),
(10, 'Anime / Manga', 1, '2023-12-15 16:54:11', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `issued_book_details`
--

CREATE TABLE `issued_book_details` (
  `id` int(11) NOT NULL,
  `book_id` int(11) DEFAULT NULL,
  `student_id` varchar(150) DEFAULT NULL,
  `issued_date` timestamp NULL DEFAULT current_timestamp(),
  `return_date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `return_status` int(1) DEFAULT NULL,
  `fine` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `issued_book_details`
--

INSERT INTO `issued_book_details` (`id`, `book_id`, `student_id`, `issued_date`, `return_date`, `return_status`, `fine`) VALUES
(17, 12, 'SID002', '2023-12-16 09:34:47', NULL, NULL, NULL),
(18, 13, 'SID005', '2023-12-16 09:35:10', NULL, NULL, NULL),
(19, 1, 'SID017', '2023-12-16 09:35:34', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `student_id` varchar(100) DEFAULT NULL,
  `student_name` varchar(120) DEFAULT NULL,
  `student_email` varchar(120) DEFAULT NULL,
  `student_phonenumber` char(11) DEFAULT NULL,
  `student_password` varchar(120) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `registration_date` timestamp NULL DEFAULT current_timestamp(),
  `updation_date` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_id`, `student_name`, `student_email`, `student_phonenumber`, `student_password`, `status`, `registration_date`, `updation_date`) VALUES
(1, 'SID002', 'Eren Jaeger', 'jaeger@gmail.com', '9865472555', 'a209541310cac0ba0f9d419d51061198', 1, '2023-01-01 23:23:03', '2023-12-16 08:53:49'),
(4, 'SID005', 'Mikasa Ackerman', 'mikasa@gmail.com', '8569710025', '92228410fc8b872914e023160cf4ae8f', 1, '2023-01-01 23:23:03', '2023-01-22 08:25:53'),
(16, 'SID016', 'Test Testing', 'test@gmail.com', '0102133264', 'f925916e2754e5e03f75dd58a5733251', 1, '2023-12-16 06:12:54', '2023-12-16 07:36:54'),
(17, 'SID017', 'Ally', 'ally@gmail.com', '0192523688', '2ad733df56aaafa5650bafc9c98c6ffb', 1, '2023-12-16 09:00:53', '2023-12-16 09:07:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_categories`
--
ALTER TABLE `book_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issued_book_details`
--
ALTER TABLE `issued_book_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `book_categories`
--
ALTER TABLE `book_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `issued_book_details`
--
ALTER TABLE `issued_book_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
