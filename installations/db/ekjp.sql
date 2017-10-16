-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 18, 2017 at 05:37 PM
-- Server version: 5.5.41-MariaDB
-- PHP Version: 5.4.45

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ekjp`
--

-- --------------------------------------------------------

--
-- Table structure for table `apply`
--

CREATE TABLE IF NOT EXISTS `apply` (
  `apply_id` int(11) NOT NULL,
  `name` varchar(256) CHARACTER SET latin1 NOT NULL,
  `noic` varchar(12) CHARACTER SET latin1 NOT NULL,
  `nationality` int(1) NOT NULL,
  `address` text CHARACTER SET latin1 NOT NULL,
  `postcode` int(5) NOT NULL,
  `notel` varchar(12) CHARACTER SET latin1 NOT NULL,
  `email` varchar(256) CHARACTER SET latin1 NOT NULL,
  `post` varchar(256) CHARACTER SET latin1 NOT NULL,
  `employer` varchar(256) CHARACTER SET latin1 NOT NULL,
  `emp_address` text CHARACTER SET latin1 NOT NULL,
  `emp_postcode` int(5) NOT NULL,
  `emp_notel` varchar(12) CHARACTER SET latin1 NOT NULL,
  `emp_nofax` varchar(12) CHARACTER SET latin1 NOT NULL,
  `skm` int(1) NOT NULL DEFAULT '1',
  `logbook` int(1) NOT NULL,
  `created_on` varchar(24) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2258 DEFAULT CHARSET=utf8;

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Table structure for table `class`
--

CREATE TABLE IF NOT EXISTS `class` (
  `class_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `date_start` varchar(64) CHARACTER SET latin1 NOT NULL,
  `date_end` varchar(64) CHARACTER SET latin1 NOT NULL,
  `time_start` varchar(12) CHARACTER SET latin1 NOT NULL,
  `time_end` varchar(12) CHARACTER SET latin1 NOT NULL,
  `classType` int(11) NOT NULL,
  `complete` int(11) NOT NULL DEFAULT '0',
  `active` int(1) NOT NULL DEFAULT '1',
  `created_on` varchar(24) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=175 DEFAULT CHARSET=utf8;

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `course_id` int(11) NOT NULL,
  `code` varchar(32) CHARACTER SET latin1 NOT NULL,
  `name` varchar(256) CHARACTER SET latin1 NOT NULL,
  `category` int(11) NOT NULL DEFAULT '1',
  `department` int(11) NOT NULL,
  `contents` text NOT NULL,
  `prerequisite` text NOT NULL,
  `fee` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `dur_term` varchar(12) CHARACTER SET latin1 NOT NULL,
  `active` int(11) DEFAULT '1',
  `created_on` varchar(24) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=183 DEFAULT CHARSET=utf8;

--
-- Table structure for table `course_apply`
--

CREATE TABLE IF NOT EXISTS `course_apply` (
  `course_apply_id` int(11) NOT NULL,
  `course` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `class` int(11) DEFAULT NULL,
  `noic` varchar(12) CHARACTER SET latin1 NOT NULL,
  `status` int(1) NOT NULL DEFAULT '2',
  `active` int(11) NOT NULL DEFAULT '1',
  `created_on` varchar(24) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3725 DEFAULT CHARSET=utf8;

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `depart_id` int(11) NOT NULL,
  `name` varchar(256) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `level_id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`level_id`, `name`) VALUES
(1, 'Pentadbir Aplikasi'),
(2, 'Penyelaras Program');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `message` text CHARACTER SET latin1 NOT NULL,
  `time` varchar(128) CHARACTER SET latin1 NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Table structure for table `nationality`
--

CREATE TABLE IF NOT EXISTS `nationality` (
  `nationality_id` int(11) NOT NULL,
  `name` varchar(64) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nationality`
--

INSERT INTO `nationality` (`nationality_id`, `name`) VALUES
(1, 'Warganeraga'),
(2, 'Bukan Warganeraga');

-- --------------------------------------------------------

--
-- Table structure for table `skm`
--

CREATE TABLE IF NOT EXISTS `skm` (
  `skm_id` int(11) NOT NULL,
  `name` varchar(64) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `skm`
--

INSERT INTO `skm` (`skm_id`, `name`) VALUES
(1, 'Tiada Sijil Kemahiran Malaysia'),
(2, 'Sijil Kemahiran Malaysia Tahap 1'),
(3, 'Sijil Kemahiran Malaysia Tahap 2'),
(4, 'Sijil Kemahiran Malaysia Tahap 3'),
(5, 'Sijil Kemahiran Malaysia Tahap 4'),
(6, 'Sijil Kemahiran Malaysia Tahap 5');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `status_id` int(11) NOT NULL,
  `name` varchar(32) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `name`) VALUES
(1, 'Proses Semakan'),
(2, 'Proses Pengesahan'),
(3, 'Permohonan Diterima'),
(4, 'Permohonan Ditolak'),
(5, 'Selesai'),
(6, 'Tidak Ditawarkan');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `username` varchar(128) CHARACTER SET latin1 NOT NULL,
  `pass` varchar(256) CHARACTER SET latin1 NOT NULL,
  `fullname` varchar(256) CHARACTER SET latin1 NOT NULL,
  `telnum` varchar(12) CHARACTER SET latin1 NOT NULL,
  `email` varchar(256) CHARACTER SET latin1 NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `level` int(11) NOT NULL DEFAULT '3',
  `last_login` varchar(64) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apply`
--
ALTER TABLE `apply`
  ADD PRIMARY KEY (`apply_id`),
  ADD KEY `nationality` (`nationality`),
  ADD KEY `skm` (`skm`),
  ADD KEY `noic` (`noic`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`class_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `category` (`category`),
  ADD KEY `department` (`department`);

--
-- Indexes for table `course_apply`
--
ALTER TABLE `course_apply`
  ADD PRIMARY KEY (`course_apply_id`),
  ADD KEY `course` (`course`),
  ADD KEY `class` (`class`),
  ADD KEY `status` (`status`),
  ADD KEY `noic` (`noic`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`depart_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `nationality`
--
ALTER TABLE `nationality`
  ADD PRIMARY KEY (`nationality_id`);

--
-- Indexes for table `skm`
--
ALTER TABLE `skm`
  ADD PRIMARY KEY (`skm_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apply`
--
ALTER TABLE `apply`
  MODIFY `apply_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2258;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=175;
--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=183;
--
-- AUTO_INCREMENT for table `course_apply`
--
ALTER TABLE `course_apply`
  MODIFY `course_apply_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3725;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `depart_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `nationality`
--
ALTER TABLE `nationality`
  MODIFY `nationality_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `skm`
--
ALTER TABLE `skm`
  MODIFY `skm_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `apply`
--
ALTER TABLE `apply`
  ADD CONSTRAINT `apply_ibfk_3` FOREIGN KEY (`nationality`) REFERENCES `nationality` (`nationality_id`),
  ADD CONSTRAINT `apply_ibfk_4` FOREIGN KEY (`skm`) REFERENCES `skm` (`skm_id`);

--
-- Constraints for table `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `class_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`);

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`category`) REFERENCES `category` (`cat_id`),
  ADD CONSTRAINT `course_ibfk_2` FOREIGN KEY (`department`) REFERENCES `department` (`depart_id`);

--
-- Constraints for table `course_apply`
--
ALTER TABLE `course_apply`
  ADD CONSTRAINT `course_apply_ibfk_1` FOREIGN KEY (`course`) REFERENCES `course` (`course_id`),
  ADD CONSTRAINT `course_apply_ibfk_2` FOREIGN KEY (`class`) REFERENCES `class` (`class_id`),
  ADD CONSTRAINT `course_apply_ibfk_3` FOREIGN KEY (`status`) REFERENCES `status` (`status_id`),
  ADD CONSTRAINT `course_apply_ibfk_4` FOREIGN KEY (`noic`) REFERENCES `apply` (`noic`);

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
