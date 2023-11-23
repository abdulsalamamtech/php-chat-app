-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2023 at 03:04 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chat_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` int(11) NOT NULL,
  `msg_from` varchar(30) NOT NULL,
  `msg_to` varchar(30) NOT NULL,
  `msg_text` text NOT NULL,
  `msg_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `msg_from`, `msg_to`, `msg_text`, `msg_time`) VALUES
(1, 'amtech@gmail.com', 'admin@gmail', 'Hello Admin', '2023-11-22 11:10:44'),
(2, 'amtech@gmail.com', 'admin@gmail', 'Hello Admin', '2023-11-22 11:11:13'),
(3, 'admin@gmail.com', 'amtech@gmai', 'Hello Customer', '2023-11-22 11:14:10'),
(4, 'amtech@gmail.com', 'admin@gmail', 'How are you', '0000-00-00 00:00:00'),
(5, 'amtech@gmail.com', 'admin@gmail', 'How are you', '0000-00-00 00:00:00'),
(6, 'amtech@gmail.com', 'admin@gmail', 'hi', '0000-00-00 00:00:00'),
(7, 'amtech@gmail.com', 'admin@gmail', 'hi', '0000-00-00 00:00:00'),
(8, 'amtech@gmail.com', 'admin@gmail', 'How are you', '0000-00-00 00:00:00'),
(9, 'amtech@gmail.com', 'admin@gmail', 'How are you', '0000-00-00 00:00:00'),
(10, 'amtech@gmail.com', 'admin@gmail', 'How are you', '0000-00-00 00:00:00'),
(11, 'amtech@gmail.com', 'admin@gmail', 'How are you', '0000-00-00 00:00:00'),
(12, 'amtech@gmail.com', 'admin@gmail', 'How are you', '0000-00-00 00:00:00'),
(13, 'amtech@gmail.com', 'admin@gmail', 'How are you', '0000-00-00 00:00:00'),
(14, 'amtech@gmail.com', 'admin@gmail', 'How are you', '0000-00-00 00:00:00'),
(15, 'amtech@gmail.com', 'admin@gmail', 'How are you', '0000-00-00 00:00:00'),
(16, 'amtech@gmail.com', 'admin@gmail', 'How are you', '0000-00-00 00:00:00'),
(17, 'amtech@gmail.com', 'admin@gmail', 'How are you', '0000-00-00 00:00:00'),
(18, 'amtech@gmail.com', 'admin@gmail', 'How are you', '0000-00-00 00:00:00'),
(19, 'amtech@gmail.com', 'admin@gmail', 'How are you', '0000-00-00 00:00:00'),
(20, 'amtech@gmail.com', 'admin@gmail', 'hi', '0000-00-00 00:00:00'),
(21, 'amtech@gmail.com', 'admin@gmail', 'hi', '0000-00-00 00:00:00'),
(22, 'amtech@gmail.com', 'admin@gmail', 'hi', '0000-00-00 00:00:00'),
(23, 'amtech@gmail.com', 'admin@gmail', 'hi', '0000-00-00 00:00:00'),
(24, 'amtech@gmail.com', 'admin@gmail', 'Hello my admin', '0000-00-00 00:00:00'),
(25, 'admin@gmail.com', 'amtech@gmail.com', 'admin to amtech', '2023-11-22 13:18:49'),
(26, 'admin@gmail.com', 'amtech@gmail.com', 'admin to amtech', '2023-11-22 13:18:49'),
(27, 'amtech@gmail.com', 'admin@gmail.com', 'Hello my admin', '0000-00-00 00:00:00'),
(28, 'amtech@gmail.com', 'admin@gmail.com', 'hi', '0000-00-00 00:00:00'),
(29, 'amtech@gmail.com', 'admin@gmail.com', 'Hello Customer care', '0000-00-00 00:00:00'),
(30, 'admin@gmail.com', 'admin@gmail.com', 'How can i help you', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(1, 'admin@gmail.com', 'admin'),
(2, 'amtech@gmail.com', 'amtech');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
