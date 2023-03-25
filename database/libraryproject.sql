-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2023 at 08:57 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `libraryproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookstaken`
--

CREATE TABLE `bookstaken` (
  `id` int(11) NOT NULL,
  `student-id` int(11) NOT NULL,
  `BookId` varchar(256) NOT NULL,
  `IssueDate` varchar(256) NOT NULL COMMENT 'year-month-date',
  `borrowtime` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookstaken`
--

INSERT INTO `bookstaken` (`id`, `student-id`, `BookId`, `IssueDate`, `borrowtime`) VALUES
(1136, 19, '2', '2023-03-11', '10 days'),
(1137, 19, '3', '2023-03-11', '30 days'),
(1138, 19, '4', '2023-03-12', '');

-- --------------------------------------------------------

--
-- Table structure for table `book_info`
--

CREATE TABLE `book_info` (
  `Id` int(11) NOT NULL,
  `Book name` varchar(256) NOT NULL,
  `Author` varchar(256) NOT NULL DEFAULT '*CONTROVERTIAL',
  `description` varchar(500) NOT NULL DEFAULT 'Not provided',
  `BOOK id` varchar(256) NOT NULL,
  `AVL book` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_info`
--

INSERT INTO `book_info` (`Id`, `Book name`, `Author`, `description`, `BOOK id`, `AVL book`) VALUES
(1, 'THE POWER OF MYTH', 'Joseph Campbell', '', 'TPOM0001', 3),
(2, 'THE RAGER\'S EDGE ', 'Somerset maugham', '', 'TRE00012', 987),
(3, 'CATCHER IN THE RYE', 'JD Salinger', '', 'CITE0098', 995),
(4, 'RUMI', '*CONTROVERTIAL', '', 'RUMI1236', 997),
(5, 'AUTOBIOGRAPHY OF A YOGI', 'Paramahansa yogananda', '', 'AOY76890', 998),
(6, 'MAN\'S SEARCH FOR MEANING', 'Vectior E ', '', 'MSFM9876', 1),
(8, 'THE BHAGAVAD GITA ', 'Sanjoy', 'Not provided', 'TBG9854', 779),
(9, 'NINE lives ', 'William Dalrymple', 'Not provided', 'NL1278', 896),
(10, 'YOGA OF HEART ', 'Mark Whitwell', 'Not provided', 'YOH7689', 758),
(11, 'hello\'s book', 'bkd', 'hululu', 'THWA', 300),
(12, 'new book', 'bidyut', '', 'bhola', 122),
(13, 'test book', 'me', 'hulului', '123tre', 123);

-- --------------------------------------------------------

--
-- Table structure for table `information`
--

CREATE TABLE `information` (
  `id` int(11) NOT NULL,
  `Firstname` varchar(256) NOT NULL,
  `Middlename` varchar(256) NOT NULL,
  `last Name` varchar(256) NOT NULL,
  `phone number` varchar(256) NOT NULL,
  `EmailId` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `information`
--

INSERT INTO `information` (`id`, `Firstname`, `Middlename`, `last Name`, `phone number`, `EmailId`) VALUES
(16, 'Bidyut', 'Kr  ', 'Das', '6294935776', 'bkdas2017.bd@gmail.com'),
(17, 'Bidyut', 'Kr. ', 'Das', '6294935777', 'bkdas2017.bd@gmail.com'),
(18, 'Bidyut', 'kr ', 'das', '9812037498103280', '12345'),
(19, 'user', 'testing ', 'das', '1234567890', 'abcd');

-- --------------------------------------------------------

--
-- Table structure for table `logindata`
--

CREATE TABLE `logindata` (
  `ID` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `Password` varchar(256) NOT NULL,
  `info-id` int(11) NOT NULL COMMENT 'this is the id of information table to connect both table together',
  `Admin` varchar(10) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logindata`
--

INSERT INTO `logindata` (`ID`, `username`, `Password`, `info-id`, `Admin`) VALUES
(16, 'Bidyut', '123456', 16, 'Y'),
(17, 'bkdas02', '1234567', 17, ''),
(18, 'Bidyut@13456', '12345', 18, ''),
(19, 'user@123', '123456', 19, 'N');

-- --------------------------------------------------------

--
-- Table structure for table `stafflogin`
--

CREATE TABLE `stafflogin` (
  `Password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tableofbooks`
--

CREATE TABLE `tableofbooks` (
  `ID` int(11) NOT NULL,
  `Name` varchar(256) NOT NULL,
  `Author` varchar(256) NOT NULL,
  `BookId` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookstaken`
--
ALTER TABLE `bookstaken`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_info`
--
ALTER TABLE `book_info`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `information`
--
ALTER TABLE `information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logindata`
--
ALTER TABLE `logindata`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tableofbooks`
--
ALTER TABLE `tableofbooks`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookstaken`
--
ALTER TABLE `bookstaken`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1139;

--
-- AUTO_INCREMENT for table `book_info`
--
ALTER TABLE `book_info`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `information`
--
ALTER TABLE `information`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `logindata`
--
ALTER TABLE `logindata`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tableofbooks`
--
ALTER TABLE `tableofbooks`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
