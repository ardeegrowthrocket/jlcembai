-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 06, 2020 at 12:30 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jlc`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_accounts`
--

CREATE TABLE `tbl_accounts` (
  `accounts_id` int(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `activated` varchar(5) DEFAULT '1',
  `role` varchar(25) DEFAULT NULL,
  `createdby` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_accounts`
--

INSERT INTO `tbl_accounts` (`accounts_id`, `username`, `password`, `email`, `activated`, `role`, `createdby`) VALUES
(1, 'admin-satch2', '12345', 'admin@gmail.com', '1', '1', NULL),
(3, 'satch', '1234', 'ardeenathanraranga@gmail.com', '1', '', NULL),
(4, 'susanroyveneracion@gmail.com', 'susanroyveneracion@gmail.com', 'susanroyveneracion@gmail.com', '1', '0', NULL),
(5, 'dukito123', 'test', 'ardeenathanraranga+dukeking@gmail.com', '1', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_expenses`
--

CREATE TABLE `tbl_expenses` (
  `id` int(255) NOT NULL,
  `amount` float NOT NULL,
  `remarks` text NOT NULL,
  `loan_id` varchar(255) DEFAULT NULL,
  `passbook_id` varchar(255) DEFAULT NULL,
  `actual` timestamp NULL DEFAULT NULL,
  `createdby` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_expenses`
--

INSERT INTO `tbl_expenses` (`id`, `amount`, `remarks`, `loan_id`, `passbook_id`, `actual`, `createdby`) VALUES
(7, 5555, 'Loan Release 5,555.00 for Ardee Nathan Raranga - 2020-06-01', '19', NULL, '2020-05-31 16:00:00', 'dukito123'),
(10, 550, 'Withdrawal Release 550.00 for Ardee Raranga - 2020-06-01', NULL, '7', '2020-05-31 16:00:00', 'dukito123'),
(11, 2500, 'tissue and alcohol', NULL, NULL, '2020-06-15 16:00:00', 'dukito123');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_files`
--

CREATE TABLE `tbl_files` (
  `id` int(255) NOT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `createdby` varchar(255) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `link` varchar(255) NOT NULL,
  `uploaded` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_files`
--

INSERT INTO `tbl_files` (`id`, `filename`, `createdby`, `remarks`, `link`, `uploaded`) VALUES
(5, 'Screen Shot 2020-05-26 at 6.40.10 PM.png', 'dukito123', 'Sample Form', 'uploads/15911520072060122604.png', '2020-06-03 02:40:07');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_loan`
--

CREATE TABLE `tbl_loan` (
  `id` int(255) NOT NULL,
  `loandesc` varchar(255) DEFAULT NULL,
  `loan_type` varchar(255) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `interest` float DEFAULT NULL,
  `interest_amount` float DEFAULT NULL,
  `terms` int(255) DEFAULT NULL,
  `payment_type` varchar(255) NOT NULL,
  `helper` varchar(255) NOT NULL,
  `penalty` float NOT NULL,
  `loan_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_release` varchar(25) NOT NULL,
  `loan_start` timestamp NULL DEFAULT NULL,
  `remarks` text NOT NULL,
  `user` varchar(255) NOT NULL,
  `net` float NOT NULL,
  `penalty_fee` float NOT NULL,
  `loop_number` int(255) DEFAULT NULL,
  `loop_paid` int(255) DEFAULT 0,
  `loop_amount` float NOT NULL,
  `loan_release` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `createdby` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_loan`
--

INSERT INTO `tbl_loan` (`id`, `loandesc`, `loan_type`, `amount`, `interest`, `interest_amount`, `terms`, `payment_type`, `helper`, `penalty`, `loan_date`, `is_release`, `loan_start`, `remarks`, `user`, `net`, `penalty_fee`, `loop_number`, `loop_paid`, `loop_amount`, `loan_release`, `createdby`) VALUES
(17, 'MEMBERS EMERGENCY LOAN', 'Collateral', 2555, 1, 25.55, 2, 'cutoff', 'monday', 23, '2020-05-26 16:00:00', '1', '2020-05-20 16:00:00', '233', '4', 2580.55, 146.913, 4, 3, 645.138, '2020-05-31 02:10:44', NULL),
(18, 'TRICYCLE LOAN', 'Not Collateral', 12313, 55, 6772.15, 1, 'weekly', 'monday', 23, '2020-06-25 16:00:00', '1', '2020-06-24 16:00:00', 'test', '4', 19085.2, 707.997, 4, 0, 4771.29, NULL, NULL),
(19, 'MEMBERS APPLIANCE LOAN', 'Collateral', 5555, 25, 1388.75, 3, 'monthly', 'monday', 2, '2020-06-03 16:00:00', '1', '2020-06-10 16:00:00', 's5', '4', 6943.75, 37.0333, 3, 0, 2314.58, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_members`
--

CREATE TABLE `tbl_members` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `spouse` varchar(255) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `dependents` varchar(255) NOT NULL,
  `name1` varchar(255) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `occupation1` varchar(255) NOT NULL,
  `contact1` varchar(255) NOT NULL,
  `name2` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `occupation2` varchar(255) NOT NULL,
  `contact2` varchar(255) NOT NULL,
  `custom_label` varchar(255) DEFAULT NULL,
  `savings` float NOT NULL DEFAULT 0,
  `balance` float NOT NULL DEFAULT 0,
  `memberdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `created` varchar(255) DEFAULT current_timestamp(),
  `createdby` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_members`
--

INSERT INTO `tbl_members` (`id`, `name`, `age`, `address`, `contact`, `spouse`, `occupation`, `dependents`, `name1`, `address1`, `occupation1`, `contact1`, `name2`, `address2`, `occupation2`, `contact2`, `custom_label`, `savings`, `balance`, `memberdate`, `created`, `createdby`) VALUES
(3, 'Ardee Raranga', '29', '23 A Ilang Ilang', '099976308112', 'Sathuki Hernandez', 'Web Developer', '3', 'Sathuki Hernandez', '14 Ilang Ilang Street', 'Housewife', '09298348026', 'Jhune Isip', 'Brgy San Juan , #143 ', 'Stock Manager', '3619026', 'POGITO', 0, 0, '2020-05-24 06:56:32', '2020-05-24 14:56:32', NULL),
(4, 'Ardee Nathan Raranga', '123', '23 A Ilang Ilang', '9997630811', '12312', '1123', '123', 'Ardee Nathan Raranga21321', '23 A Ilang Ilang', '3123', '9997630811', 'Invoice VIP', '101 Upper Cross Street #05-16', '12312', '3104691220', '5123', 0, 0, '2020-05-30 03:11:07', '2020-05-30 11:11:07', 'satch');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mutual`
--

CREATE TABLE `tbl_mutual` (
  `id` int(255) NOT NULL,
  `loandesc` varchar(255) DEFAULT NULL,
  `loan_type` varchar(255) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `interest` float DEFAULT NULL,
  `interest_amount` float DEFAULT NULL,
  `terms` int(255) DEFAULT NULL,
  `payment_type` varchar(255) NOT NULL,
  `helper` varchar(255) NOT NULL,
  `penalty` float NOT NULL,
  `loan_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_release` varchar(25) NOT NULL,
  `loan_start` timestamp NULL DEFAULT NULL,
  `remarks` text NOT NULL,
  `user` varchar(255) NOT NULL,
  `net` float NOT NULL,
  `penalty_fee` float NOT NULL,
  `loop_number` int(255) DEFAULT NULL,
  `loop_paid` int(255) DEFAULT 0,
  `loop_amount` float NOT NULL,
  `loan_release` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `createdby` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_mutual`
--

INSERT INTO `tbl_mutual` (`id`, `loandesc`, `loan_type`, `amount`, `interest`, `interest_amount`, `terms`, `payment_type`, `helper`, `penalty`, `loan_date`, `is_release`, `loan_start`, `remarks`, `user`, `net`, `penalty_fee`, `loop_number`, `loop_paid`, `loop_amount`, `loan_release`, `createdby`) VALUES
(3, NULL, NULL, 100, NULL, 100, 5, 'weekly', 'monday', 0, '2020-06-03 05:05:59', '1', '2020-06-10 16:00:00', 'mutual fund remarks', '3', 2000, 0, 20, 0, 100, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_passbook`
--

CREATE TABLE `tbl_passbook` (
  `id` int(255) NOT NULL,
  `user` varchar(255) DEFAULT NULL,
  `amount` float NOT NULL,
  `remarks` text NOT NULL,
  `ptype` varchar(255) NOT NULL,
  `schedule_id` varchar(255) DEFAULT NULL,
  `actual` timestamp NULL DEFAULT NULL,
  `createdby` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_passbook`
--

INSERT INTO `tbl_passbook` (`id`, `user`, `amount`, `remarks`, `ptype`, `schedule_id`, `actual`, `createdby`) VALUES
(1, '4', 1100, 'test', 'savings', '48', '2020-05-30 16:00:00', 'dukito123'),
(2, '4', 300, 'late paid', 'withdraw', '49', '2020-05-30 16:00:00', 'dukito123'),
(3, '4', 2000, 'test', 'savings', '50', '2020-06-03 16:00:00', 'dukito123'),
(4, '4', 57, 'ardee - change to savings', 'savings', NULL, '2020-04-30 16:00:00', 'dukito123'),
(5, '4', 5000, 'initial savings', 'savings', NULL, '2020-06-04 16:00:00', 'dukito123'),
(6, '3', 2500, '123123', 'savings', NULL, '2020-06-02 16:00:00', 'dukito123'),
(7, '3', 550, '123', 'withdraw', NULL, '2020-06-17 16:00:00', 'dukito123');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schedule`
--

CREATE TABLE `tbl_schedule` (
  `id` int(255) NOT NULL,
  `schedule` timestamp NULL DEFAULT NULL,
  `actual` timestamp NULL DEFAULT NULL,
  `payment` float DEFAULT NULL,
  `penalty` float DEFAULT 0,
  `savings` float DEFAULT 0,
  `remarks` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `loan_id` varchar(255) DEFAULT NULL,
  `is_paid` varchar(25) DEFAULT 'no',
  `createdby` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_schedule`
--

INSERT INTO `tbl_schedule` (`id`, `schedule`, `actual`, `payment`, `penalty`, `savings`, `remarks`, `user_id`, `loan_id`, `is_paid`, `createdby`) VALUES
(2, '2020-05-10 16:00:00', '2020-06-04 16:00:00', 2314.58, 0, 0, '1', '4', '19', 'yes', 'dukito123'),
(57, '2020-07-10 16:00:00', NULL, 2314.58, 0, 0, NULL, '4', '19', 'no', NULL),
(58, '2020-08-10 16:00:00', NULL, 2314.58, 0, 0, NULL, '4', '19', 'no', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schedule_mutual`
--

CREATE TABLE `tbl_schedule_mutual` (
  `id` int(255) NOT NULL,
  `schedule` timestamp NULL DEFAULT NULL,
  `actual` timestamp NULL DEFAULT NULL,
  `payment` float DEFAULT NULL,
  `penalty` float DEFAULT 0,
  `savings` float DEFAULT 0,
  `remarks` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `loan_id` varchar(255) DEFAULT NULL,
  `is_paid` varchar(25) DEFAULT 'no',
  `createdby` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_schedule_mutual`
--

INSERT INTO `tbl_schedule_mutual` (`id`, `schedule`, `actual`, `payment`, `penalty`, `savings`, `remarks`, `user_id`, `loan_id`, `is_paid`, `createdby`) VALUES
(2, '2020-06-14 16:00:00', '2020-06-04 16:00:00', 100, 100, 0, '123', '3', '3', 'yes', 'dukito123'),
(22, '2020-06-21 16:00:00', NULL, 100, 0, 0, NULL, '3', '3', 'no', NULL),
(23, '2020-06-28 16:00:00', NULL, 100, 0, 0, NULL, '3', '3', 'no', NULL),
(24, '2020-07-05 16:00:00', NULL, 100, 0, 0, NULL, '3', '3', 'no', NULL),
(25, '2020-07-12 16:00:00', NULL, 100, 0, 0, NULL, '3', '3', 'no', NULL),
(26, '2020-07-19 16:00:00', NULL, 100, 0, 0, NULL, '3', '3', 'no', NULL),
(27, '2020-07-26 16:00:00', NULL, 100, 0, 0, NULL, '3', '3', 'no', NULL),
(28, '2020-08-02 16:00:00', NULL, 100, 0, 0, NULL, '3', '3', 'no', NULL),
(29, '2020-08-09 16:00:00', NULL, 100, 0, 0, NULL, '3', '3', 'no', NULL),
(30, '2020-08-16 16:00:00', NULL, 100, 0, 0, NULL, '3', '3', 'no', NULL),
(31, '2020-08-23 16:00:00', NULL, 100, 0, 0, NULL, '3', '3', 'no', NULL),
(32, '2020-08-30 16:00:00', NULL, 100, 0, 0, NULL, '3', '3', 'no', NULL),
(33, '2020-09-06 16:00:00', NULL, 100, 0, 0, NULL, '3', '3', 'no', NULL),
(34, '2020-09-13 16:00:00', NULL, 100, 0, 0, NULL, '3', '3', 'no', NULL),
(35, '2020-09-20 16:00:00', NULL, 100, 0, 0, NULL, '3', '3', 'no', NULL),
(36, '2020-09-27 16:00:00', NULL, 100, 0, 0, NULL, '3', '3', 'no', NULL),
(37, '2020-10-04 16:00:00', NULL, 100, 0, 0, NULL, '3', '3', 'no', NULL),
(38, '2020-10-11 16:00:00', NULL, 100, 0, 0, NULL, '3', '3', 'no', NULL),
(39, '2020-10-18 16:00:00', NULL, 100, 0, 0, NULL, '3', '3', 'no', NULL),
(40, '2020-10-25 16:00:00', NULL, 100, 0, 0, NULL, '3', '3', 'no', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_system`
--

CREATE TABLE `tbl_system` (
  `id` int(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `value` longtext NOT NULL,
  `datatype` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_system`
--

INSERT INTO `tbl_system` (`id`, `code`, `value`, `datatype`) VALUES
(1, 'task', 'configsave', NULL),
(2, 'user', '', NULL),
(3, 'id', '', NULL),
(4, 'mission', '<pre>123123\\\'/\\\';;;&lt;</pre>', NULL),
(5, 'vision', '55555555', NULL),
(6, 'submit', 'Save Configuration', NULL),
(66, 'loanclass', '{\"1\":{\"label\":\"MEMBER ASSISTANCE LOAN\",\"value\":\"MEMBER ASSISTANCE LOAN\"},\"2\":{\"label\":\"MEMBERS APPLIANCE LOAN\",\"value\":\"MEMBERS APPLIANCE LOAN\"},\"3\":{\"label\":\"MEMBERS EMERGENCY LOAN\",\"value\":\"MEMBERS EMERGENCY LOAN\"},\"4\":{\"label\":\"MEMBERS GADGET LOAN\",\"value\":\"MEMBERS GADGET LOAN\"},\"5\":{\"label\":\"MEMBERS REGULAR LOAN\",\"value\":\"MEMBERS REGULAR LOAN\"},\"6\":{\"label\":\"NON MEMBER LOAN\",\"value\":\"NON MEMBER LOAN\"},\"7\":{\"label\":\"TRICYCLE LOAN\",\"value\":\"TRICYCLE LOAN\"},\"8\":{\"label\":\"MEMBER ASSISTANCE LOAN\",\"value\":\"MEMBER ASSISTANCE LOAN\"}}', NULL),
(319, 'loanterms', '{\"1\":{\"label\":\"1 Month\",\"value\":\"1\"},\"2\":{\"label\":\"2 Months\",\"value\":\"2\"},\"3\":{\"label\":\"3 Months\",\"value\":\"3\"},\"4\":{\"label\":\"4 Months\",\"value\":\"4\"},\"5\":{\"label\":\"5 Months\",\"value\":\"5\"},\"6\":{\"label\":\"6 Months\",\"value\":\"6\"},\"7\":{\"label\":\"7 Months\",\"value\":\"7\"},\"8\":{\"label\":\"8 Months\",\"value\":\"8\"},\"9\":{\"label\":\"9 Months\",\"value\":\"9\"},\"10\":{\"label\":\"10 Months\",\"value\":\"10\"},\"11\":{\"label\":\"11 Months\",\"value\":\"11\"},\"12\":{\"label\":\"12 Months\",\"value\":\"12\"},\"13\":{\"label\":\"24  Months\",\"value\":\"24\"}}', NULL),
(392, 'mutualterms', '{\"1\":{\"label\":\"5 Years\",\"value\":\"60\"},\"2\":{\"label\":\"3 Years\",\"value\":\"36\"},\"3\":{\"label\":\"1 Year\",\"value\":\"12\"}}', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_accounts`
--
ALTER TABLE `tbl_accounts`
  ADD PRIMARY KEY (`accounts_id`);

--
-- Indexes for table `tbl_expenses`
--
ALTER TABLE `tbl_expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_files`
--
ALTER TABLE `tbl_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_loan`
--
ALTER TABLE `tbl_loan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_members`
--
ALTER TABLE `tbl_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_mutual`
--
ALTER TABLE `tbl_mutual`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_passbook`
--
ALTER TABLE `tbl_passbook`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_schedule`
--
ALTER TABLE `tbl_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_schedule_mutual`
--
ALTER TABLE `tbl_schedule_mutual`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_system`
--
ALTER TABLE `tbl_system`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_accounts`
--
ALTER TABLE `tbl_accounts`
  MODIFY `accounts_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_expenses`
--
ALTER TABLE `tbl_expenses`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_files`
--
ALTER TABLE `tbl_files`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_loan`
--
ALTER TABLE `tbl_loan`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_members`
--
ALTER TABLE `tbl_members`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_mutual`
--
ALTER TABLE `tbl_mutual`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_passbook`
--
ALTER TABLE `tbl_passbook`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_schedule`
--
ALTER TABLE `tbl_schedule`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tbl_schedule_mutual`
--
ALTER TABLE `tbl_schedule_mutual`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tbl_system`
--
ALTER TABLE `tbl_system`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=430;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
