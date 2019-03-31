-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2019 at 06:18 AM
-- Server version: 5.7.21-log
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `unscript`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `student_id` varchar(300) CHARACTER SET latin1 NOT NULL,
  `teacher_id` varchar(300) CHARACTER SET latin1 DEFAULT NULL,
  `sub_id` int(200) DEFAULT NULL,
  `attendance` varchar(300) CHARACTER SET latin1 DEFAULT NULL,
  `a_sem` int(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`student_id`, `teacher_id`, `sub_id`, `attendance`, `a_sem`) VALUES
('test', 'Teacher1', 1, '78', 5),
('test', 'Teacher1', 2, '85', 5),
('test', 'Teacher1', 3, '90', 5),
('test', 'Teacher1', 4, '80', 5);

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `student_id` varchar(300) CHARACTER SET latin1 NOT NULL,
  `teacher_id` varchar(300) CHARACTER SET latin1 NOT NULL,
  `sub_id` int(200) NOT NULL,
  `mrk` varchar(300) CHARACTER SET latin1 NOT NULL,
  `m_sem` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `marks`
--

INSERT INTO `marks` (`student_id`, `teacher_id`, `sub_id`, `mrk`, `m_sem`) VALUES
('test', 'Teacher1', 1, '85', 5),
('test', 'Teacher1', 2, '45', 5),
('test', 'Teacher1', 3, '75', 5),
('test', 'Teacher1', 4, '40', 5);

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

CREATE TABLE `parent` (
  `student_id` varchar(300) CHARACTER SET latin1 NOT NULL,
  `password` varchar(300) CHARACTER SET latin1 NOT NULL,
  `sf_name` varchar(300) CHARACTER SET latin1 DEFAULT NULL,
  `sl_name` varchar(300) CHARACTER SET latin1 DEFAULT NULL,
  `pf_name` varchar(300) CHARACTER SET latin1 DEFAULT NULL,
  `pl_name` varchar(300) CHARACTER SET latin1 DEFAULT NULL,
  `phone` varchar(300) CHARACTER SET latin1 DEFAULT NULL,
  `email` varchar(300) CHARACTER SET latin1 DEFAULT NULL,
  `address` text CHARACTER SET latin1,
  `teacher_id` varchar(300) CHARACTER SET latin1 DEFAULT NULL,
  `class` varchar(300) CHARACTER SET latin1 DEFAULT NULL,
  `semister` varchar(300) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parent`
--

INSERT INTO `parent` (`student_id`, `password`, `sf_name`, `sl_name`, `pf_name`, `pl_name`, `phone`, `email`, `address`, `teacher_id`, `class`, `semister`) VALUES
('HimTha98208', '', 'Himani', 'Thakkar', 'Himani', 'Thakkar', '9820813980', 'thinkhimani@gmail.com', '1301/B,Park Royal,Madan Malvia Road, Mulund west.', 'Teacher1', NULL, NULL),
('test', '098f6bcd4621d373cade4e832627b4f6', 'Himani', 'Thakkar', 'Preeti', 'Thakkar', '920813980', 'thakkarhimani16@gmail.com', '1202, Sai Avenue, Sai Complex, Navghar Road, Mulund east, Mumbai - 400081', 'Teacher1', '3', '5'),
('test2', 'ad0234829205b9033196ba818f7a872b', 'Viraj', 'Modi', 'Chintan', 'Modi', '1234567890', 'viraj.modi@sakec.ac.in', 'dlief iffcjk qqefnjk eiwnkoiwin  fwnkem,', 'Teacher1', '4', '5'),
('test3', '8ad8757baa8564dc136c1e07507f4a98', 'Jai', 'Parekh', 'Manoj', 'Parekh', '0987654321', 'jai.parekh@sakec.ac.in', 'hello address', 'Teacher2', '4', '5');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `sub_id` int(200) NOT NULL,
  `sub_name` varchar(400) CHARACTER SET latin1 NOT NULL,
  `type` int(11) DEFAULT NULL,
  `s_sem` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`sub_id`, `sub_name`, `type`, `s_sem`) VALUES
(1, 'DWM', 1, 5),
(2, 'DWM Pracs', 0, 5),
(3, 'CSS', 1, 5),
(4, 'CSS Lab', 0, 5);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacher_id` varchar(300) CHARACTER SET latin1 NOT NULL,
  `phone` varchar(300) CHARACTER SET latin1 DEFAULT NULL,
  `email` varchar(300) CHARACTER SET latin1 DEFAULT NULL,
  `password` varchar(300) CHARACTER SET latin1 NOT NULL,
  `tf_name` varchar(300) CHARACTER SET latin1 DEFAULT NULL,
  `tl_name` varchar(300) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `phone`, `email`, `password`, `tf_name`, `tl_name`) VALUES
('Teacher1', '9820813980', 'thinkhimani@gmail.com', '598496796e42bb5c11bdc13a874d1748', 'Himani', 'Teacher');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `parent`
--
ALTER TABLE `parent`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`sub_id`),
  ADD UNIQUE KEY `sub_name` (`sub_name`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `sub_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
