-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2024 at 06:26 PM
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
('502faff84f5e59ca1a814b4587403a05', 61, 'user', '', 1720437703, '{\"login_status\":true,\"expiry_date\":\"2024-07-08 13:21:43\"}', '2024-07-08 10:21:43', '2024-07-08 10:21:43'),
('5cc2a624d7a7e02eec7f987e278eff33', 61, 'user', 'arunselva@gmail.com', 1720459352, '{\"login_status\":true,\"expiry_date\":\"2024-07-08 19:22:32\"}', '2024-07-08 16:22:32', '2024-07-08 16:22:32'),
('b0ccf2ab21d9915cbe93f64a4193cb33', 2, 'admin', 'admin@gmail.com', 1720449982, '{\"login_status\":true,\"expiry_date\":\"2024-07-08 16:46:22\"}', '2024-07-08 13:46:22', '2024-07-08 13:46:22'),
('c46f4a3cf64cf7f252317462dda855c4', 2, 'admin', 'admin@gmail.com', 1720437645, '{\"login_status\":true,\"expiry_date\":\"2024-07-08 13:20:45\"}', '2024-07-08 10:20:45', '2024-07-08 10:20:45'),
('caa70a75221efda220a4e6aec3ce00a4', 61, 'user', 'arunselva@gmail.com', 1720450028, '{\"login_status\":true,\"expiry_date\":\"2024-07-08 16:47:08\"}', '2024-07-08 13:47:08', '2024-07-08 13:47:08'),
('f217b3765f6638ed0cad144dfb4f6932', 61, 'user', 'sarvesskuruvi@gmail.com', 1720436061, '{\"login_status\":true,\"expiry_date\":\"2024-07-08 12:54:21\"}', '2024-07-08 09:54:21', '2024-07-08 09:54:21');

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
  `status` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_login_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `first_name`, `last_name`, `role_id`, `status`, `password`, `created_at`, `updated_at`, `last_login_at`) VALUES
(2, 'admin', 'admin@gmail.com', 'Super', 'Admin', 1, 1, '$2y$10$kaakb6ClfKBmAE1ZGn2ZJestBwtYO7FmbFAkhjypXXdjKEMKOtfzi', '2024-06-24 15:33:33', '2024-07-08 13:46:22', '2024-07-08 13:46:22'),
(60, 'staff', 'Vaccinators@gmail.com', 'Staff', 'Vaccinator', 2, 1, '$2y$10$g8Dz8MgtL2eHRjU5w60NruyrcWWy7sTMc.l9mPXxghRH8fKrfHGZm', '2024-07-01 17:38:11', '2024-07-05 16:45:19', '2024-07-05 16:45:19'),
(61, 'user', 'arunselva@gmail.com', 'Arun', 'Selva', 3, 1, '$2y$10$kaakb6ClfKBmAE1ZGn2ZJestBwtYO7FmbFAkhjypXXdjKEMKOtfzi', '2024-07-08 06:47:22', '2024-07-08 16:22:32', '2024-07-08 16:22:32');

-- --------------------------------------------------------

--
-- Table structure for table `vaccinationcenter`
--

CREATE TABLE `vaccinationcenter` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `PhoneNumber` varchar(20) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Capacity` int(11) NOT NULL,
  `VaccineType` int(100) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vaccinationcenter`
--

INSERT INTO `vaccinationcenter` (`id`, `Name`, `Address`, `PhoneNumber`, `Email`, `Capacity`, `VaccineType`, `CreatedAt`, `UpdatedAt`) VALUES
(6, 'Putra World Trade Center', 'kuala Lumpur', '0143057131', 'sarvesskuruvi@gmail.com', 90, 3, '2024-07-02 15:59:37', '2024-07-02 16:09:54');

-- --------------------------------------------------------

--
-- Table structure for table `vaccinationslot`
--

CREATE TABLE `vaccinationslot` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `idnumber` varchar(20) DEFAULT NULL,
  `gender` enum('Female','Male') DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `address` text DEFAULT NULL,
  `covid_diagnosis` enum('Yes','No') DEFAULT NULL,
  `disease` text DEFAULT NULL,
  `medication` text DEFAULT NULL,
  `allergies` text DEFAULT NULL,
  `moreDetails` text DEFAULT NULL,
  `symptom1` tinyint(1) DEFAULT NULL,
  `symptom2` tinyint(1) DEFAULT NULL,
  `symptom3` tinyint(1) DEFAULT NULL,
  `symptom4` tinyint(1) DEFAULT NULL,
  `symptom5` tinyint(1) DEFAULT NULL,
  `symptom6` tinyint(1) DEFAULT NULL,
  `symptom7` tinyint(1) DEFAULT NULL,
  `symptom8` tinyint(1) DEFAULT NULL,
  `symptom9` tinyint(1) DEFAULT NULL,
  `symptom10` tinyint(1) DEFAULT NULL,
  `symptom11` tinyint(1) DEFAULT NULL,
  `VaccineType` int(11) DEFAULT NULL,
  `vaccinationcenter` int(11) DEFAULT NULL,
  `vaccinationdate` date DEFAULT NULL,
  `vaccinationtime` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vaccinationslot`
--

INSERT INTO `vaccinationslot` (`id`, `user_id`, `first_name`, `last_name`, `idnumber`, `gender`, `email`, `birth_date`, `address`, `covid_diagnosis`, `disease`, `medication`, `allergies`, `moreDetails`, `symptom1`, `symptom2`, `symptom3`, `symptom4`, `symptom5`, `symptom6`, `symptom7`, `symptom8`, `symptom9`, `symptom10`, `symptom11`, `VaccineType`, `vaccinationcenter`, `vaccinationdate`, `vaccinationtime`, `created_at`, `updated_at`) VALUES
(21, 61, 'Arun', 'Selva', '346453634545746456', 'Male', 'arunselva@gmail.com', '2024-07-08', 'fdgdfgdfg', 'Yes', 'dfgdfdfd', 'fgdfgdfgdf', 'dfgdgdfg', 'fdfgdfgdfgd', 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 6, '2024-07-30', '14:45:00', '2024-07-08 15:42:46', '2024-07-08 15:42:46');

-- --------------------------------------------------------

--
-- Table structure for table `vaccinetype`
--

CREATE TABLE `vaccinetype` (
  `id` int(11) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `manufacturer` varchar(50) NOT NULL,
  `manufacturing_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `batch_no` varchar(20) NOT NULL,
  `registered_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vaccinetype`
--

INSERT INTO `vaccinetype` (`id`, `brand`, `manufacturer`, `manufacturing_date`, `expiry_date`, `batch_no`, `registered_on`, `updated_on`) VALUES
(2, 'AstraZeneca (Vaxzevria)', 'Oxford', '2024-07-02', '2025-05-03', 'AZ234533434', '2024-07-02 15:09:47', '2024-07-02 15:09:47'),
(3, 'Moderna (Spikevax)', 'testing', '2024-07-02', '2027-12-17', 'MOD234533434', '2024-07-02 15:10:43', '2024-07-02 15:44:41');

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
-- Indexes for table `vaccinationcenter`
--
ALTER TABLE `vaccinationcenter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vaccinationslot`
--
ALTER TABLE `vaccinationslot`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `VaccineType` (`VaccineType`),
  ADD KEY `vaccinationcenter` (`vaccinationcenter`);

--
-- Indexes for table `vaccinetype`
--
ALTER TABLE `vaccinetype`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `vaccinationcenter`
--
ALTER TABLE `vaccinationcenter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `vaccinationslot`
--
ALTER TABLE `vaccinationslot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `vaccinetype`
--
ALTER TABLE `vaccinetype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `vaccinationslot`
--
ALTER TABLE `vaccinationslot`
  ADD CONSTRAINT `vaccinationslot_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `vaccinationslot_ibfk_2` FOREIGN KEY (`VaccineType`) REFERENCES `vaccinetype` (`id`),
  ADD CONSTRAINT `vaccinationslot_ibfk_3` FOREIGN KEY (`vaccinationcenter`) REFERENCES `vaccinationcenter` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
