-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2024 at 01:46 AM
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
-- Database: `overseas_jobs_agency`
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

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `password`, `role`, `image`, `created_at`) VALUES
(1, 'admin_super', 'superadmin@example.com', 'hashed_password_super', 'super', NULL, '2024-08-02 23:43:32'),
(2, 'admin_manager', 'manager@example.com', 'hashed_password_manager', 'manager', NULL, '2024-08-02 23:43:32'),
(3, 'admin_officer', 'officer@example.com', 'hashed_password_officer', 'officer', NULL, '2024-08-02 23:43:32');

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `status` enum('applied','reviewed','accepted','rejected') NOT NULL DEFAULT 'applied',
  `applied_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `user_id`, `job_id`, `status`, `applied_at`) VALUES
(1, 1, 1, 'applied', '2024-08-02 23:43:33'),
(2, 2, 2, 'reviewed', '2024-08-02 23:43:33'),
(3, 3, 4, 'accepted', '2024-08-02 23:43:33'),
(4, 4, 3, 'rejected', '2024-08-02 23:43:33'),
(5, 5, 5, 'applied', '2024-08-02 23:43:33'),
(6, 6, 1, 'reviewed', '2024-08-02 23:43:33'),
(7, 7, 2, 'rejected', '2024-08-02 23:43:33'),
(8, 8, 3, 'reviewed', '2024-08-02 23:43:33'),
(9, 9, 4, 'accepted', '2024-08-02 23:43:33'),
(10, 10, 5, 'applied', '2024-08-02 23:43:33');

-- --------------------------------------------------------

--
-- Table structure for table `employee_data`
--

CREATE TABLE `employee_data` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cv` text DEFAULT NULL,
  `resume` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `career_history` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_data`
--

INSERT INTO `employee_data` (`id`, `user_id`, `cv`, `resume`, `image`, `career_history`, `created_at`) VALUES
(1, 1, 'CV of John Doe', 'Resume of John Doe', 'john_doe_cv_image.jpg', 'Experienced web developer...', '2024-08-02 23:43:33'),
(2, 2, 'CV of Jane Smith', 'Resume of Jane Smith', 'jane_smith_cv_image.jpg', 'Skilled in software engineering...', '2024-08-02 23:43:33'),
(3, 3, 'CV of Alice Jones', 'Resume of Alice Jones', 'alice_jones_cv_image.jpg', 'Experienced in UI/UX design...', '2024-08-02 23:43:33'),
(4, 4, 'CV of Bob Brown', 'Resume of Bob Brown', 'bob_brown_cv_image.jpg', 'Experienced in backend development...', '2024-08-02 23:43:33'),
(5, 5, 'CV of Carol White', 'Resume of Carol White', 'carol_white_cv_image.jpg', 'Expert in project management...', '2024-08-02 23:43:33'),
(6, 6, 'CV of David Black', 'Resume of David Black', 'david_black_cv_image.jpg', 'Skilled in database management...', '2024-08-02 23:43:33'),
(7, 7, 'CV of Emily Green', 'Resume of Emily Green', 'emily_green_cv_image.jpg', 'Experienced in mobile app development...', '2024-08-02 23:43:33'),
(8, 8, 'CV of Frank Blue', 'Resume of Frank Blue', 'frank_blue_cv_image.jpg', 'Expert in cybersecurity...', '2024-08-02 23:43:33'),
(9, 9, 'CV of Grace Yellow', 'Resume of Grace Yellow', 'grace_yellow_cv_image.jpg', 'Experienced in cloud computing...', '2024-08-02 23:43:33'),
(10, 10, 'CV of Hank Purple', 'Resume of Hank Purple', 'hank_purple_cv_image.jpg', 'Skilled in network administration...', '2024-08-02 23:43:33');

-- --------------------------------------------------------

--
-- Table structure for table `employer_data`
--

CREATE TABLE `employer_data` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `company_history` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employer_data`
--

INSERT INTO `employer_data` (`id`, `user_id`, `company_name`, `company_history`, `image`, `created_at`) VALUES
(1, 11, 'Tech Inc.', 'Tech Inc. is a leading tech company specializing in software solutions.', 'tech_inc_company_image.jpg', '2024-08-02 23:43:33'),
(2, 12, 'Build Corp.', 'Build Corp. focuses on construction and real estate development.', 'build_corp_company_image.jpg', '2024-08-02 23:43:33'),
(3, 13, 'Design LLC', 'Design LLC offers top-notch design services for various industries.', 'design_llc_company_image.jpg', '2024-08-02 23:43:33'),
(4, 14, 'Healthcare Co.', 'Healthcare Co. provides innovative solutions in the healthcare sector.', 'healthcare_co_company_image.jpg', '2024-08-02 23:43:33'),
(5, 15, 'Finance Firm', 'Finance Firm specializes in financial consulting and investment services.', 'finance_firm_company_image.jpg', '2024-08-02 23:43:33');

-- --------------------------------------------------------

--
-- Table structure for table `interviews`
--

CREATE TABLE `interviews` (
  `id` int(11) NOT NULL,
  `application_id` int(11) NOT NULL,
  `interview_date` datetime NOT NULL,
  `status` enum('scheduled','completed','cancelled') NOT NULL,
  `feedback` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `interviews`
--

INSERT INTO `interviews` (`id`, `application_id`, `interview_date`, `status`, `feedback`, `created_at`) VALUES
(1, 1, '2024-08-10 10:00:00', 'scheduled', NULL, '2024-08-02 23:43:34'),
(2, 2, '2024-08-11 14:00:00', 'completed', 'Good interview but not selected.', '2024-08-02 23:43:34'),
(3, 3, '2024-08-12 09:00:00', 'completed', 'Great candidate, moving forward.', '2024-08-02 23:43:34'),
(4, 4, '2024-08-13 11:00:00', 'cancelled', 'Candidate withdrew application.', '2024-08-02 23:43:34'),
(5, 5, '2024-08-14 15:00:00', 'scheduled', NULL, '2024-08-02 23:43:34');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `location` varchar(100) NOT NULL,
  `salary` decimal(10,2) NOT NULL,
  `type` enum('full_time','part_time','contract') NOT NULL,
  `employer_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `title`, `description`, `location`, `salary`, `type`, `employer_id`, `created_at`) VALUES
(1, 'Web Developer', 'Develop and maintain websites.', 'New York, NY', '75000.00', 'full_time', 11, '2024-08-02 23:43:33'),
(2, 'Software Engineer', 'Work on software solutions.', 'San Francisco, CA', '90000.00', 'full_time', 11, '2024-08-02 23:43:33'),
(3, 'Project Manager', 'Manage projects and teams.', 'Chicago, IL', '85000.00', 'full_time', 12, '2024-08-02 23:43:33'),
(4, 'UI/UX Designer', 'Design user interfaces and experiences.', 'Austin, TX', '70000.00', 'full_time', 13, '2024-08-02 23:43:33'),
(5, 'Mobile App Developer', 'Develop mobile applications.', 'Seattle, WA', '80000.00', 'full_time', 11, '2024-08-02 23:43:33');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `read_status` enum('unread','read') NOT NULL DEFAULT 'unread',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `message`, `read_status`, `created_at`) VALUES
(1, 1, 'Your application for Web Developer has been received.', 'unread', '2024-08-02 23:43:34'),
(2, 2, 'Your application status for Software Engineer has been updated.', 'unread', '2024-08-02 23:43:34'),
(3, 3, 'Your interview for Project Manager is scheduled.', 'unread', '2024-08-02 23:43:34'),
(4, 4, 'Your application for UI/UX Designer has been reviewed.', 'unread', '2024-08-02 23:43:34'),
(5, 5, 'New job listing for Mobile App Developer available.', 'unread', '2024-08-02 23:43:34'),
(6, 6, 'Your application for Web Developer has been reviewed.', 'unread', '2024-08-02 23:43:34'),
(7, 7, 'Your application for Software Engineer has been rejected.', 'unread', '2024-08-02 23:43:34'),
(8, 8, 'Your interview for Project Manager is scheduled.', 'unread', '2024-08-02 23:43:34'),
(9, 9, 'Your application for UI/UX Designer has been accepted.', 'unread', '2024-08-02 23:43:34'),
(10, 10, 'New job listing for Mobile App Developer available.', 'unread', '2024-08-02 23:43:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('employee','employer') NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `image`, `created_at`) VALUES
(1, 'john_doe', 'john.doe@example.com', 'hashed_password_john', 'employee', 'john_doe_image.jpg', '2024-08-02 23:43:32'),
(2, 'jane_smith', 'jane.smith@example.com', 'hashed_password_jane', 'employee', 'jane_smith_image.jpg', '2024-08-02 23:43:32'),
(3, 'alice_jones', 'alice.jones@example.com', 'hashed_password_alice', 'employee', 'alice_jones_image.jpg', '2024-08-02 23:43:32'),
(4, 'bob_brown', 'bob.brown@example.com', 'hashed_password_bob', 'employee', 'bob_brown_image.jpg', '2024-08-02 23:43:32'),
(5, 'carol_white', 'carol.white@example.com', 'hashed_password_carol', 'employee', 'carol_white_image.jpg', '2024-08-02 23:43:32'),
(6, 'david_black', 'david.black@example.com', 'hashed_password_david', 'employee', 'david_black_image.jpg', '2024-08-02 23:43:32'),
(7, 'emily_green', 'emily.green@example.com', 'hashed_password_emily', 'employee', 'emily_green_image.jpg', '2024-08-02 23:43:32'),
(8, 'frank_blue', 'frank.blue@example.com', 'hashed_password_frank', 'employee', 'frank_blue_image.jpg', '2024-08-02 23:43:32'),
(9, 'grace_yellow', 'grace.yellow@example.com', 'hashed_password_grace', 'employee', 'grace_yellow_image.jpg', '2024-08-02 23:43:32'),
(10, 'hank_purple', 'hank.purple@example.com', 'hashed_password_hank', 'employee', 'hank_purple_image.jpg', '2024-08-02 23:43:32'),
(11, 'tech_inc', 'info@techinc.com', 'hashed_password_tech', 'employer', 'tech_inc_image.jpg', '2024-08-02 23:43:32'),
(12, 'build_corp', 'contact@buildcorp.com', 'hashed_password_build', 'employer', 'build_corp_image.jpg', '2024-08-02 23:43:32'),
(13, 'design_llc', 'support@designllc.com', 'hashed_password_design', 'employer', 'design_llc_image.jpg', '2024-08-02 23:43:32'),
(14, 'healthcare_co', 'hello@healthcareco.com', 'hashed_password_healthcare', 'employer', 'healthcare_co_image.jpg', '2024-08-02 23:43:32'),
(15, 'finance_firm', 'info@financefirm.com', 'hashed_password_finance', 'employer', 'finance_firm_image.jpg', '2024-08-02 23:43:32');

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
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `job_id` (`job_id`);

--
-- Indexes for table `employee_data`
--
ALTER TABLE `employee_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `employer_data`
--
ALTER TABLE `employer_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `interviews`
--
ALTER TABLE `interviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `application_id` (`application_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employer_id` (`employer_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `employee_data`
--
ALTER TABLE `employee_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `employer_data`
--
ALTER TABLE `employer_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `interviews`
--
ALTER TABLE `interviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`);

--
-- Constraints for table `employee_data`
--
ALTER TABLE `employee_data`
  ADD CONSTRAINT `employee_data_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `employer_data`
--
ALTER TABLE `employer_data`
  ADD CONSTRAINT `employer_data_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `interviews`
--
ALTER TABLE `interviews`
  ADD CONSTRAINT `interviews_ibfk_1` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`);

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `jobs_ibfk_1` FOREIGN KEY (`employer_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
