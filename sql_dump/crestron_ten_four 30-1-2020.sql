-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 30, 2020 at 12:58 AM
-- Server version: 8.0.18
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crestron_ten_four`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `user_status` tinyint(1) NOT NULL,
  `user_level` tinyint(4) NOT NULL,
  `user_last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `firstname`, `lastname`, `user_status`, `user_level`, `user_last_login`) VALUES
(1, 'admin@bang.com.au', '$2y$12$WkRbu/eVu3e8bWoVltzODuBD6ASast8DiG0a5dp0SF7yOEg9XnvHG', 'Bang', 'admin\r\n', 1, 1, '2020-01-30 00:36:03');

-- --------------------------------------------------------

--
-- Table structure for table `work_form`
--

CREATE TABLE `work_form` (
  `work_form_id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `organization` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `post` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `comments` longtext NOT NULL,
  `insert_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `work_form`
--

INSERT INTO `work_form` (`work_form_id`, `fname`, `lname`, `organization`, `phone`, `email`, `post`, `comments`, `insert_date`) VALUES
(1, 'Amaya', 'Hicks', 'Cline and Valentine Trading', '+158-16942', 'gyzasy@mailinator.com', 'Anim amet omnis qui', 'Molestiae minim unde', '2020-01-30 10:50:37'),
(2, 'Vanna', 'Ferrell', 'Barrett and English Plc', '2233377732', 'gulolizat@mailinator.net', 'Dolor et amet illum', 'Molestias dolore vol', '2020-01-30 10:51:41'),
(3, 'Vanna', 'Ferrell', 'Barrett and English Plc', '2233377732', 'gulolizat@mailinator.net', 'Dolor et amet illum', 'Molestias dolore vol', '2020-01-30 10:51:41'),
(4, 'Rana', 'Parks', 'Craft and Rivas Traders', '+1 (567) 4', 'guhugod@mailinator.net', 'Recusandae Deserunt', 'Anim nesciunt dicta', '2020-01-30 10:59:35'),
(5, 'Rafael', 'Merrill', 'Hendricks and Bates Trading', '+1 (966)33', 'qaxegixe@mailinator.net', 'In reprehenderit pr', 'Qui autem asperiores', '2020-01-30 11:06:23'),
(6, 'Gannon', 'Holcomb', 'Daugherty and Miles Co', '+1 (955) 6', 'fozer@mailinator.com', 'Officia non fugiat e', 'Lorem non quidem con', '2020-01-30 11:20:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `work_form`
--
ALTER TABLE `work_form`
  ADD PRIMARY KEY (`work_form_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `work_form`
--
ALTER TABLE `work_form`
  MODIFY `work_form_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
