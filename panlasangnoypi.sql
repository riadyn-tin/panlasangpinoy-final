-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2024 at 06:46 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `panlasangnoypi`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `profile_picture`) VALUES
(1, 'Riadsyn', 'iiriadynlaquite@gmail.com', '$2y$10$WNcD/TdhcwzzBTIm41WpceRJzlEvrhnpf6cLzrjoqpeDvGdmeIy.6', 'uploads/profile_pictures/profile_0bbc710a2f9a6f0c4302160c1f39e42d.jpg'),
(2, 'Christopher', 'christopherlaquite00@gmail.com', '$2y$10$dgu9BCQRDEYkyuBZBaoahuio5zFc/Wfqr.xtsmTegG/aaZZLfumeO', NULL),
(3, 'Riadyn', 'priadynlaquite@gmail.com', '$2y$10$qW6quEW6XLZpdhjMsHIlaOtyB5.Sa7beOY4Pb7EqpnUITtcSaa2oe', 'uploads/profile_pictures/profile_42a134bef73c06e3b00f4c8290f12f6a.png'),
(4, 'Angela Castro', 'angelacastro@gmail.com', '$2y$10$cBogiC7K9KxVJ7OlfawC/u1RbzosJgeZsTnVJeJDrGlzhFxfep2nS', NULL),
(5, 'Angela Castro2', 'angelacastro2@gmail.com', '$2y$10$dIOOswdTldLFClPAC1sGSejFP8o8b5Z001VcbcpqIkPXJD1h2NRBe', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `email`, `profile_picture`, `created_at`, `updated_at`) VALUES
(7, 'iiriadynlaquite@gmail.com', 'uploads/fbc59cb553a376004a28c6b9a7abcd83.jpg', '2024-12-17 05:27:27', '2024-12-17 05:37:22'),
(8, 'priadynlaquite@gmail.com', 'uploads/893e5d2660437d96b11e0df28f765be6.png', '2024-12-17 05:27:51', '2024-12-17 05:41:41'),
(19, 'angelacastro2@gmail.com', 'uploads/3ef41d99b515518c7d287d44ea13036e.jpg', '2024-12-17 05:43:53', '2024-12-17 05:43:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
