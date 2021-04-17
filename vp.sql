-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2021 at 12:47 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vp`
--

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE `forum` (
  `first_name` varchar(100) DEFAULT NULL,
  `forum_entry` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `forum`:
--

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`first_name`, `forum_entry`) VALUES
('Taufique', 'I do not feel mentally well, but vaping helps me push through my days.'),
('Admin', 'I started taking less puffs, It has been hard but we can do it. ');

-- --------------------------------------------------------

--
-- Table structure for table `journal`
--

CREATE TABLE `journal` (
  `j_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `entry` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `journal`:
--   `user_id`
--       `user` -> `user_id`
--

--
-- Dumping data for table `journal`
--

INSERT INTO `journal` (`j_id`, `user_id`, `entry`) VALUES
(1, 1, 'entry by user id 1'),
(2, 2, 'entry by user id 2'),
(3, 2, 'I feel much more anxious than yesterday without vaping. ');

-- --------------------------------------------------------

--
-- Table structure for table `trackhistory`
--

CREATE TABLE `trackhistory` (
  `th_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `attempt` int(11) DEFAULT 0,
  `duration` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `trackhistory`:
--   `user_id`
--       `user` -> `user_id`
--

--
-- Dumping data for table `trackhistory`
--

INSERT INTO `trackhistory` (`th_id`, `user_id`, `attempt`, `duration`) VALUES
(3, 1, 1, 3),
(4, 1, 2, 1),
(5, 2, 1, 10),
(6, 2, 2, 11),
(7, 2, 3, 12),
(8, 2, 4, 30);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `user_password` varchar(100) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `user`:
--

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_email`, `user_password`, `first_name`, `last_name`) VALUES
(1, 'admin@gmail.com', 'admin', 'Admin', 'Admin'),
(2, 'ta@gmail.com', '123', 'Taufique', 'Ahmed'),
(3, 'sm@gmail.com', 'sm123', 'Spider', 'Man');

-- --------------------------------------------------------

--
-- Table structure for table `vapetrack`
--

CREATE TABLE `vapetrack` (
  `currentStartDate` varchar(100) DEFAULT NULL,
  `currentEndDate` varchar(100) DEFAULT NULL,
  `currentDuration` varchar(100) DEFAULT NULL,
  `previousDuration` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `vt_id` int(11) NOT NULL,
  `attempt` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `vapetrack`:
--

--
-- Dumping data for table `vapetrack`
--

INSERT INTO `vapetrack` (`currentStartDate`, `currentEndDate`, `currentDuration`, `previousDuration`, `user_id`, `vt_id`, `attempt`) VALUES
(NULL, '2021/12/17', '31', '30', 2, 1, 4),
(NULL, '2021/04/19', '2', '1', 1, 3, 2),
(NULL, '2021/04/28', '12', '11', 3, 4, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `journal`
--
ALTER TABLE `journal`
  ADD PRIMARY KEY (`j_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `trackhistory`
--
ALTER TABLE `trackhistory`
  ADD PRIMARY KEY (`th_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `vapetrack`
--
ALTER TABLE `vapetrack`
  ADD PRIMARY KEY (`vt_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `journal`
--
ALTER TABLE `journal`
  MODIFY `j_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `trackhistory`
--
ALTER TABLE `trackhistory`
  MODIFY `th_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vapetrack`
--
ALTER TABLE `vapetrack`
  MODIFY `vt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `journal`
--
ALTER TABLE `journal`
  ADD CONSTRAINT `journal_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `trackhistory`
--
ALTER TABLE `trackhistory`
  ADD CONSTRAINT `trackhistory_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
