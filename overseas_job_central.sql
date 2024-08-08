-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2024 at 07:51 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `overseas_job_central`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('super','manager','officer') NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `cv_file_path` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `username`, `email`, `password`, `cv_file_path`, `description`, `image`, `created_at`) VALUES
(1, 'ThanTunAung', 't.thantunaung@gmail.com', '$2y$10$ckQGklaSy4QnbWDbjp7EBO2GhHU5uTtKfBoNFWrZhDCYskPBRa4/u', NULL, NULL, NULL, '2024-08-08 00:26:00');

-- --------------------------------------------------------

--
-- Table structure for table `employers`
--

CREATE TABLE `employers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employers`
--

INSERT INTO `employers` (`id`, `username`, `email`, `password`, `company_name`, `description`, `image`, `created_at`) VALUES
(1, 'ThanHtunAung', 't.thanhtunaung@gmail.com', '$2y$10$iOSJ6vRW2QxWnXw8aZb5c.art7688jAPxdY3kagMKEZVCnUfAIMY6', '', NULL, NULL, '2024-08-08 00:25:23');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `job_desc` text NOT NULL,
  `job_location` varchar(100) NOT NULL,
  `employer` varchar(50) NOT NULL,
  `company` varchar(100) NOT NULL,
  `status` int(10) DEFAULT NULL,
  `post_creator` varchar(50) NOT NULL,
  `post_updater` varchar(50) DEFAULT NULL,
  `post_deleter` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_categories`
--

CREATE TABLE `job_categories` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_categories`
--

INSERT INTO `job_categories` (`id`, `title`, `description`, `created_at`) VALUES
(1, 'Accountant', 'Manage financial records and prepare tax returns.', '2024-08-07 22:10:29'),
(2, 'Software Engineer', 'Develop and maintain software applications.', '2024-08-07 22:10:29'),
(3, 'Human Resources Manager', 'Oversee recruitment, training, and employee relations.', '2024-08-07 22:10:29'),
(4, 'Administrative Assistant', 'Provide administrative support to teams and departments.', '2024-08-07 22:10:29'),
(5, 'Data Analyst', 'Analyze and interpret data to inform business decisions.', '2024-08-07 22:10:29'),
(6, 'Marketing Manager', 'Develop and execute marketing campaigns to promote products or services.', '2024-08-07 22:10:29'),
(7, 'Network Administrator', 'Install, configure, and maintain computer networks.', '2024-08-07 22:10:29'),
(8, 'Graphic Designer', 'Create visual content for websites, social media, and marketing materials.', '2024-08-07 22:10:29'),
(9, 'Customer Service Representative', 'Respond to customer inquiries and resolve issues.', '2024-08-07 22:10:29'),
(10, 'Operations Manager', 'Oversee daily operations and manage teams to achieve business objectives.', '2024-08-07 22:10:29'),
(11, 'Frontend Developer', 'Develop responsive and interactive web applications using HTML, CSS, and JavaScript.', '2024-08-07 22:10:29'),
(12, 'Backend Developer', 'Design and develop scalable and secure backend systems using Node.js and Ruby on Rails.', '2024-08-07 22:10:29'),
(13, 'Full Stack Developer', 'Develop complete web applications using React, Angular, and Vue.js.', '2024-08-07 22:10:29'),
(14, 'Game Developer', 'Design and develop engaging and interactive games using Unity and Unreal Engine.', '2024-08-07 22:10:29'),
(15, 'UX/UI Designer', 'Create user-centered design solutions for web and mobile applications.', '2024-08-07 22:10:29'),
(16, 'Web Developer', 'Develop and maintain dynamic web applications using PHP and Laravel.', '2024-08-07 22:10:29'),
(17, 'Game Artist', 'Create 2D and 3D game assets, including characters, environments, and effects.', '2024-08-07 22:10:29'),
(18, 'Quality Assurance Engineer', 'Test and ensure the quality of web and mobile applications.', '2024-08-07 22:10:29'),
(19, 'DevOps Engineer', 'Design and implement scalable and secure infrastructure for web applications.', '2024-08-07 22:10:29'),
(20, 'Technical Writer', 'Create technical documentation and guides for web and mobile applications.', '2024-08-07 22:10:29');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `zipcode` varchar(20) NOT NULL,
  `timezone` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `city`, `country`, `zipcode`, `timezone`) VALUES
(1, 'New York', 'United States', '10021', 'America/New_York'),
(2, 'London', 'United Kingdom', 'SW1A 1AA', 'Europe/London'),
(3, 'Tokyo', 'Japan', '100-0001', 'Asia/Tokyo'),
(4, 'Paris', 'France', '75001', 'Europe/Paris'),
(5, 'Beijing', 'China', '100000', 'Asia/Shanghai'),
(6, 'Sydney', 'Australia', '2000', 'Australia/Sydney'),
(7, 'Bangkok', 'Thailand', '10110', 'Asia/Bangkok'),
(8, 'Dubai', 'United Arab Emirates', '00000', 'Asia/Dubai'),
(9, 'Mumbai', 'India', '400001', 'Asia/Kolkata'),
(10, 'Los Angeles', 'United States', '90001', 'America/Los_Angeles');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `employers`
--
ALTER TABLE `employers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_categories`
--
ALTER TABLE `job_categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employers`
--
ALTER TABLE `employers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `job_categories`
--
ALTER TABLE `job_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
