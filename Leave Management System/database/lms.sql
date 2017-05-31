-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2015 at 11:49 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `leave_requests`
--

CREATE TABLE IF NOT EXISTS `leave_requests` (
  `staff_id` varchar(50) NOT NULL,
  `leave_type` varchar(50) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `days_requested` int(2) NOT NULL,
  `date_applied` date NOT NULL,
  `leave_status` varchar(30) NOT NULL DEFAULT 'Pending',
  PRIMARY KEY (`staff_id`,`start_date`,`end_date`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leave_requests`
--

INSERT INTO `leave_requests` (`staff_id`, `leave_type`, `start_date`, `end_date`, `days_requested`, `date_applied`, `leave_status`) VALUES
('anuj@live.in', 'Weekend Leave', '2015-04-03', '2015-04-04', 2, '2015-04-23', 'Approved'),
('anuj@live.in', 'Casual Leave', '2015-04-23', '2015-04-23', 1, '2015-04-23', 'Pending'),
('anuj@live.in', 'Casual Leave', '2015-04-23', '2015-04-30', 8, '2015-04-23', 'Pending'),
('anuj@live.in', 'Weekend Leave', '2015-04-25', '2015-04-25', 1, '2015-04-23', 'Approved'),
('anuj@live.in', 'Sick Leave', '2015-06-13', '2015-06-18', 6, '2015-04-23', 'Approved'),
('anuj@live.in', 'Weekend Leave', '2015-06-21', '2015-06-25', 5, '2015-04-23', 'Approved'),
('jayantgope@yahoo.in', 'Weekend Leave', '2015-04-03', '2015-04-03', 1, '2015-04-23', 'Pending'),
('jayantgope@yahoo.in', 'Sick Leave', '2015-04-11', '2015-04-11', 1, '2015-04-10', 'Pending'),
('jayantgope@yahoo.in', 'Weekend Leave', '2015-04-17', '2015-04-17', 1, '2015-04-23', 'Pending'),
('jayantgope@yahoo.in', 'Sick Leave', '2015-04-17', '2015-04-18', 2, '2015-04-10', 'Approved'),
('jayantgope@yahoo.in', 'Weekend Leave', '2015-04-24', '2015-04-24', 1, '2015-04-23', 'Pending'),
('jayantgope@yahoo.in', 'Weekend Leave', '2015-04-24', '2015-05-08', 15, '2015-04-23', 'Pending'),
('jayantgope@yahoo.in', 'Casual Leave', '2015-08-08', '2015-08-30', 23, '2015-04-23', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `leave_statistics`
--

CREATE TABLE IF NOT EXISTS `leave_statistics` (
  `staff_id` varchar(50) NOT NULL,
  `leave_type` varchar(50) NOT NULL,
  `maximum_leaves` int(2) NOT NULL,
  `leaves_taken` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`staff_id`,`leave_type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leave_statistics`
--

INSERT INTO `leave_statistics` (`staff_id`, `leave_type`, `maximum_leaves`, `leaves_taken`) VALUES
('anuj@live.in', 'Casual Leave', 45, 0),
('anuj@live.in', 'New', 10, 0),
('anuj@live.in', 'Newest', 15, 0),
('anuj@live.in', 'Sick Leave', 10, 6),
('anuj@live.in', 'Weekend Leave', 10, 9),
('dhoni@ms.com', '', 0, 0),
('dhoni@ms.com', 'New', 10, 0),
('dhoni@ms.com', 'Newest', 15, 0),
('jayantgope@yahoo.in', 'Casual Leave', 45, 0),
('jayantgope@yahoo.in', 'New', 10, 0),
('jayantgope@yahoo.in', 'Newest', 15, 0),
('jayantgope@yahoo.in', 'Sick Leave', 10, 3),
('jayantgope@yahoo.in', 'Weekend Leave', 10, 0),
('rahul@gmail.com', 'Casual Leave', 45, 0),
('rahul@gmail.com', 'New', 10, 0),
('rahul@gmail.com', 'Newest', 15, 0),
('rahul@gmail.com', 'Sick Leave', 10, 0),
('rahul@gmail.com', 'Weekend Leave', 10, 0),
('sachin@ms.com', 'Casual Leave', 45, 0),
('sachin@ms.com', 'New', 10, 0),
('sachin@ms.com', 'Newest', 15, 0),
('sachin@ms.com', 'Sick Leave', 10, 0),
('sachin@ms.com', 'Weekend Leave', 10, 0),
('virendra@apiit.edu.in', 'Casual Leave', 45, 0),
('virendra@apiit.edu.in', 'New', 10, 0),
('virendra@apiit.edu.in', 'Newest', 15, 0),
('virendra@apiit.edu.in', 'Weekend Leave', 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `leave_types`
--

CREATE TABLE IF NOT EXISTS `leave_types` (
  `leave_type` varchar(50) NOT NULL,
  `no_of_days` int(2) NOT NULL,
  PRIMARY KEY (`leave_type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leave_types`
--

INSERT INTO `leave_types` (`leave_type`, `no_of_days`) VALUES
('Casual Leave', 45),
('New', 10),
('Newest', 15),
('Sick Leave', 10),
('Weekend Leave', 10);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `user_id` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`,`user_type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`user_id`, `password`, `user_type`) VALUES
('admin', 'pass', 'admin'),
('anuj@live.in', 'anuj', 'Staff'),
('dhoni@ms.com', 'ms', 'Staff'),
('jayantgope@yahoo.in', 'l', 'Staff'),
('rahul@gmail.com', 'r', 'Staff'),
('sachin@ms.com', 's', 'Staff'),
('virendra@apiit.edu.in', 'vk', 'PC');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `staff_id` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  PRIMARY KEY (`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `first_name`, `middle_name`, `last_name`) VALUES
('anuj@live.in', 'Anuj', 'Kumar', 'Parashar'),
('dhoni@ms.com', 'Mahendra', 'Singh', 'Dhoni'),
('jayantgope@yahoo.in', 'Jayant', 'Kumar', 'Gope'),
('rahul@gmail.com', 'Rahul', '', 'Sharma'),
('sachin@ms.com', 'Sachin', '', 'Tend'),
('virendra@apiit.edu.in', 'Virendra', '', 'Srivastava');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
