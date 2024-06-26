-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2024 at 07:41 PM
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
-- Database: `vaccinemanagesys`
--

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `session_id` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `expires` int(11) DEFAULT NULL,
  `data` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`session_id`, `user_id`, `username`, `email`, `expires`, `data`, `created_at`, `updated_at`) VALUES
('1d4c49f1948e6c45bfa40fbddf98c04a', 2, 'admin', 'admin@example.com', 1719423690, '{\"login_status\":true,\"expiry_date\":\"2024-06-26 19:41:30\"}', '2024-06-26 16:41:30', '2024-06-26 16:41:30'),
('1dedf38965f8260ad77a54f5581077dc', 3, 'staff', 'vaccinator@example.com', 1719423208, '{\"login_status\":true,\"expiry_date\":\"2024-06-26 19:33:28\"}', '2024-06-26 16:33:28', '2024-06-26 16:33:28'),
('339660525678849e63f30418fb96acb8', 2, 'admin', 'admin@example.com', 1719420050, '{\"login_status\":true,\"expiry_date\":\"2024-06-26 18:40:50\"}', '2024-06-26 15:40:50', '2024-06-26 15:40:50'),
('3648fc97cbb24979d88c261f4a1b9731', 2, 'admin', 'admin@example.com', 1719423717, '{\"login_status\":true,\"expiry_date\":\"2024-06-26 19:41:57\"}', '2024-06-26 16:41:57', '2024-06-26 16:41:57'),
('496a369742a32e676b46ff1c6eec4eca', 2, 'admin', 'admin@example.com', 1719426509, '{\"login_status\":true,\"expiry_date\":\"2024-06-26 20:28:29\"}', '2024-06-26 17:28:29', '2024-06-26 17:28:29'),
('4f21f29a213c39a16e4a620b60a7de67', 2, 'admin', 'admin@example.com', 1719420077, '{\"login_status\":true,\"expiry_date\":\"2024-06-26 18:41:17\"}', '2024-06-26 15:41:17', '2024-06-26 15:41:17'),
('5a8f89176abebc4b56b855445428f0f4', 2, 'admin', 'admin@example.com', 1719423975, '{\"login_status\":true,\"expiry_date\":\"2024-06-26 19:46:15\"}', '2024-06-26 16:46:15', '2024-06-26 16:46:15'),
('5ca2f44dc5c90e38f63a017e319d8fb2', 3, 'staff', 'vaccinator@example.com', 1719423300, '{\"login_status\":true,\"expiry_date\":\"2024-06-26 19:35:00\"}', '2024-06-26 16:35:00', '2024-06-26 16:35:00'),
('77dbe0d3754d4deac3ecf75b5e583a7c', 2, 'admin', 'admin@example.com', 1719423706, '{\"login_status\":true,\"expiry_date\":\"2024-06-26 19:41:46\"}', '2024-06-26 16:41:46', '2024-06-26 16:41:46'),
('85950b132c85db67cfcad823d8983765', 2, 'admin', 'admin@example.com', 1719422509, '{\"login_status\":true,\"expiry_date\":\"2024-06-26 19:21:49\"}', '2024-06-26 16:21:49', '2024-06-26 16:21:49'),
('8d474a65014d41ab2468cb0e0f3bcea4', 2, 'admin', 'admin@example.com', 1719419363, '{\"login_status\":true,\"expiry_date\":\"2024-06-26 18:29:23\"}', '2024-06-26 15:29:23', '2024-06-26 15:29:23'),
('9293eb1ca9c1b035672ac45ebe39df3c', 2, 'admin', 'admin@example.com', 1719423525, '{\"login_status\":true,\"expiry_date\":\"2024-06-26 19:38:45\"}', '2024-06-26 16:38:45', '2024-06-26 16:38:45'),
('96e59511bb1c369e04facfe64b0707e3', 2, 'admin', 'admin@example.com', 1719419416, '{\"login_status\":true,\"expiry_date\":\"2024-06-26 18:30:16\"}', '2024-06-26 15:30:16', '2024-06-26 15:30:16'),
('98e0afac07c5472a578eb671d7133bbc', 2, 'admin', 'admin@example.com', 1719419336, '{\"login_status\":true,\"expiry_date\":\"2024-06-26 18:28:56\"}', '2024-06-26 15:28:56', '2024-06-26 15:28:56'),
('9d31a14528e06f7e1dc4581b68820a5e', 3, 'staff', 'vaccinator@example.com', 1719423172, '{\"login_status\":true,\"expiry_date\":\"2024-06-26 19:32:52\"}', '2024-06-26 16:32:52', '2024-06-26 16:32:52'),
('a06bdf3ef3d12c99c587b74905fc11a9', 2, 'admin', 'admin@example.com', 1719423700, '{\"login_status\":true,\"expiry_date\":\"2024-06-26 19:41:40\"}', '2024-06-26 16:41:40', '2024-06-26 16:41:40'),
('aa3dcc390548ad3fa19bc6d3e2a91751', 2, 'admin', 'admin@example.com', 1719423234, '{\"login_status\":true,\"expiry_date\":\"2024-06-26 19:33:54\"}', '2024-06-26 16:33:54', '2024-06-26 16:33:54'),
('ae4f7adfe104ebd81712e4da1e0914ed', 2, 'admin', 'admin@example.com', 1719419431, '{\"login_status\":true,\"expiry_date\":\"2024-06-26 18:30:31\"}', '2024-06-26 15:30:31', '2024-06-26 15:30:31'),
('aef5c498cd53de2fd4e54ae1ebfa658f', 2, 'admin', 'admin@example.com', 1719412618, '{\"login_status\":true,\"expiry_date\":\"2024-06-26 16:36:58\"}', '2024-06-26 13:36:58', '2024-06-26 13:36:58'),
('afdb7710ef74d3a2130ded120e58de84', 3, 'staff', 'vaccinator@example.com', 1719423868, '{\"login_status\":true,\"expiry_date\":\"2024-06-26 19:44:28\"}', '2024-06-26 16:44:28', '2024-06-26 16:44:28'),
('b34c765e947226039cd957c97e8077fb', 2, 'admin', 'admin@example.com', 1719423089, '{\"login_status\":true,\"expiry_date\":\"2024-06-26 19:31:29\"}', '2024-06-26 16:31:29', '2024-06-26 16:31:29'),
('bb4cd1045ef66d71ea0c12dbddc56a39', 2, 'admin', 'admin@example.com', 1719421307, '{\"login_status\":true,\"expiry_date\":\"2024-06-26 19:01:47\"}', '2024-06-26 16:01:47', '2024-06-26 16:01:47'),
('bd001e123a5c7ca1f305a2533b0b64d6', 2, 'admin', 'admin@example.com', 1719419545, '{\"login_status\":true,\"expiry_date\":\"2024-06-26 18:32:25\"}', '2024-06-26 15:32:25', '2024-06-26 15:32:25'),
('ce8a392c742426dce5f3e18ad0bc8dca', 3, 'staff', 'vaccinator@example.com', 1719426461, '{\"login_status\":true,\"expiry_date\":\"2024-06-26 20:27:41\"}', '2024-06-26 17:27:41', '2024-06-26 17:27:41'),
('d7691379ac8dc6d1dbf4b3ae7aca5295', 2, 'admin', 'admin@example.com', 1719426678, '{\"login_status\":true,\"expiry_date\":\"2024-06-26 20:31:18\"}', '2024-06-26 17:31:18', '2024-06-26 17:31:18'),
('de45ba5ec38d02d27823a6210885cd14', 1, 'user', 'johndoe@example.com', 1719426477, '{\"login_status\":true,\"expiry_date\":\"2024-06-26 20:27:57\"}', '2024-06-26 17:27:57', '2024-06-26 17:27:57'),
('e3e99f95b64e56484c81a2c59e1c566a', 1, 'user', 'johndoe@example.com', 1719423474, '{\"login_status\":true,\"expiry_date\":\"2024-06-26 19:37:54\"}', '2024-06-26 16:37:54', '2024-06-26 16:37:54'),
('f0ad660b68548b2bb16772c4d4c7de7d', 2, 'admin', 'admin@example.com', 1719421334, '{\"login_status\":true,\"expiry_date\":\"2024-06-26 19:02:14\"}', '2024-06-26 16:02:14', '2024-06-26 16:02:14'),
('f77ea5d331dacb20a3d076dc593c66ed', 2, 'admin', 'admin@example.com', 1719427094, '{\"login_status\":true,\"expiry_date\":\"2024-06-26 20:38:14\"}', '2024-06-26 17:38:14', '2024-06-26 17:38:14'),
('f8b1f9a697bde0e000ab9f707ea905ef', 1, 'user', 'johndoe@example.com', 1719423143, '{\"login_status\":true,\"expiry_date\":\"2024-06-26 19:32:23\"}', '2024-06-26 16:32:23', '2024-06-26 16:32:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `role_id` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_login_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `first_name`, `last_name`, `role_id`, `password`, `created_at`, `updated_at`, `last_login_at`) VALUES
(1, 'user', 'johndoe@example.com', 'Arun', 'Selva', 3, '$2a$12$dhviaguqaG0RQAkaMRdyEur7hNFILbazn3tIJcQ/LgxC/EK3sLsg6', '2024-06-24 15:33:33', '2024-06-26 17:27:57', '2024-06-26 17:27:57'),
(2, 'admin', 'admin@example.com', 'Administrator', '', 1, '$2a$12$dhviaguqaG0RQAkaMRdyEur7hNFILbazn3tIJcQ/LgxC/EK3sLsg6', '2024-06-24 15:33:33', '2024-06-26 17:38:14', '2024-06-26 17:38:14'),
(3, 'staff', 'vaccinator@example.com', 'SN. Saira', 'Ramesh', 2, '$2a$12$dhviaguqaG0RQAkaMRdyEur7hNFILbazn3tIJcQ/LgxC/EK3sLsg6', '2024-06-24 15:33:33', '2024-06-26 17:27:41', '2024-06-26 17:27:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`session_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
