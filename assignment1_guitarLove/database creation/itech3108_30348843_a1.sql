-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2020 at 02:33 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `itech3108_30348843_a1`
--
CREATE DATABASE IF NOT EXISTS `itech3108_30348843_a1` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin;
USE `itech3108_30348843_a1`;

-- --------------------------------------------------------

--
-- Table structure for table `guitar`
--

CREATE TABLE `guitar` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `guitar`:
--

--
-- Dumping data for table `guitar`
--

INSERT INTO `guitar` (`id`, `title`) VALUES
(1, 'Martin'),
(2, 'Taylor'),
(3, 'Gibson'),
(4, 'Guild'),
(5, 'Seagul'),
(6, 'Yamaha'),
(7, 'monty');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `guitar_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `likes`:
--   `guitar_id`
--       `guitar` -> `id`
--   `user_id`
--       `user` -> `id`
--   `guitar_id`
--       `guitar` -> `id`
--   `user_id`
--       `user` -> `id`
--

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`user_id`, `guitar_id`) VALUES
(30348843, 2),
(30348843, 4),
(30348844, 1),
(30348844, 5),
(123456789, 3),
(123456789, 5);

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

CREATE TABLE `login_details` (
  `login_details_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_type` enum('yes','no','','','') CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- RELATIONSHIPS FOR TABLE `login_details`:
--

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `from_user_id` int(10) UNSIGNED NOT NULL,
  `to_user_id` int(10) UNSIGNED NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `text` text COLLATE utf8mb4_bin NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- RELATIONSHIPS FOR TABLE `message`:
--   `from_user_id`
--       `user` -> `id`
--   `to_user_id`
--       `user` -> `id`
--   `from_user_id`
--       `user` -> `id`
--   `to_user_id`
--       `user` -> `id`
--

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`from_user_id`, `to_user_id`, `datetime`, `text`, `status`) VALUES
(30348843, 30348844, '2020-05-20 05:54:46', 'hii deepak sharma \r\nHow are you???', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `profile` text DEFAULT NULL,
  `photo_url` text DEFAULT NULL,
  `flag1` tinyint(1) NOT NULL,
  `flag2` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `user`:
--

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `profile`, `photo_url`, `flag1`, `flag2`) VALUES
(30348843, 'Balvinder Singh', 'balvindersingh@gmail.com', '$2y$12$qNp35wIhXBC8fY7usbSwIOB.VYi4jtXbRjRtARA.W9d', 'FedUni Stident', 'abcde', 0, 0),
(30348844, 'Deepak Sharma', 'deepak2@gmail.com', '$2y$12$hcCWkzJPKmVQ43HfctGFj.peDVtk15RQwVIqyYM95Kd', 'student', 'indina', 0, 0),
(123456789, 'monty', 'balggfghg@gmail.com', '$2y$12$b1AoqxFmVcPR/IN2mX2NaebkY3ahvvs5KkGOxdbXwny', 'indian', 'bhhgvh', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guitar`
--
ALTER TABLE `guitar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`user_id`,`guitar_id`) USING BTREE,
  ADD KEY `user_id` (`user_id`),
  ADD KEY `guitar_id` (`guitar_id`);

--
-- Indexes for table `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`login_details_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`from_user_id`,`to_user_id`) USING BTREE,
  ADD KEY `to_user_id` (`to_user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guitar`
--
ALTER TABLE `guitar`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `login_details`
--
ALTER TABLE `login_details`
  MODIFY `login_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `from_user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30348845;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=789456457;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`guitar_id`) REFERENCES `guitar` (`id`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`from_user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`to_user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
