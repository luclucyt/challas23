-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2023 at 04:40 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `challas`
--

-- --------------------------------------------------------

--
-- Table structure for table `confirm`
--

CREATE TABLE `confirm` (
  `linkID` varchar(255) NOT NULL,
  `userID` varchar(255) NOT NULL,
  `linkType` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `confirm`
--

INSERT INTO `confirm` (`linkID`, `userID`, `linkType`) VALUES
('9a3787e1fdcbbaad81d831ae3aeea5c0', 'c274492f90f1aed21ca20a7417432689', 'confirm'),
('f8fa846d5f3a12669528b6a478742c90', '954935683be1a9253ac215a3ebb2b818', 'confirm');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` varchar(255) NOT NULL,
  `name` varchar(63) NOT NULL,
  `email` varchar(63) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(64) NOT NULL,
  `isAdmin` int(7) NOT NULL,
  `isAllowed` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `name`, `email`, `password`, `status`, `isAdmin`, `isAllowed`) VALUES
('449431385a3106ac8c9581231cc8f71a', 'Lucas van Briemen', '088875@glr.nl', '$2y$10$aRdKVEy2wHuL5G4ic7dj5.f/OTxakedsPT027imF7QnuntzbhimCa', '', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `confirm`
--
ALTER TABLE `confirm`
  ADD PRIMARY KEY (`linkID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
