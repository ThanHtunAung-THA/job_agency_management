-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2024 at 08:47 AM
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

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `job_title`, `job_desc`, `job_location`, `employer`, `company`, `status`, `post_creator`, `post_updater`, `post_deleter`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Hiring Web Designer for Project', 'Responsible for designing user-friendly and visually appealing websites.', 'Washington. D.C.', 'someboss', 'somework', 1, 'admin', NULL, NULL, '2024-08-08 03:51:30', NULL, NULL),
(2, 'Senior Accountant', 'Manage financial records and prepare tax returns for a large corporation.Manage financial records and prepare tax returns for a large corporation.Manage financial records and prepare tax returns for a large corporation.Manage financial records and prepare tax returns for a large corporation.Manage financial records and prepare tax returns for a large corporation.Manage financial records and prepare tax returns for a large corporation.Manage financial records and prepare tax returns for a large corporation.Manage financial records and prepare tax returns for a large corporation.Manage financial records and prepare tax returns for a large corporation.Manage financial records and prepare tax returns for a large corporation.Manage financial records and prepare tax returns for a large corporation.Manage financial records and prepare tax returns for a large corporation.Manage financial records and prepare tax returns for a large corporation.Manage financial records and prepare tax returns for a large corporation.Manage financial records and prepare tax returns for a large corporation.Manage financial records and prepare tax returns for a large corporation.', 'New York', 'John Doe', 'ABC Corporation', 1, 'admin', NULL, NULL, '2024-08-07 11:00:00', NULL, NULL),
(3, 'Software Engineer', 'Develop and maintain software applications for a tech startup.Develop and maintain software applications for a tech startup.Develop and maintain software applications for a tech startup.Develop and maintain software applications for a tech startup.', 'San Francisco', 'Jane Smith', 'XYZ Inc.', 1, 'admin', NULL, NULL, '2024-08-07 11:00:00', NULL, NULL),
(4, 'Human Resources Manager', 'Oversee recruitment, training, and employee relations for a mid-sized company.Oversee recruitment, training, and employee relations for a mid-sized company.Oversee recruitment, training, and employee relations for a mid-sized company.Oversee recruitment, training, and employee relations for a mid-sized company.', 'Chicago', 'Bob Johnson', ' DEF Inc.', 1, 'admin', NULL, NULL, '2024-08-07 11:00:00', NULL, NULL),
(5, 'Administrative Assistant', 'Provide administrative support to teams and departments for a large corporation.Provide administrative support to teams and departments for a large corporation.Provide administrative support to teams and departments for a large corporation.Provide administrative support to teams and departments for a large corporation.', 'Los Angeles', 'Alice Brown', 'GHI Corporation', 1, 'admin', NULL, NULL, '2024-08-07 11:00:00', NULL, NULL),
(6, 'Data Analyst', 'Analyze and interpret data to inform business decisions for a financial institution.Analyze and interpret data to inform business decisions for a financial institution.Analyze and interpret data to inform business decisions for a financial institution.Analyze and interpret data to inform business decisions for a financial institution.', 'New York', 'Mike Davis', 'JKL Bank', 1, 'admin', NULL, NULL, '2024-08-07 11:00:00', NULL, NULL),
(7, 'Marketing Manager', 'Develop and execute marketing campaigns to promote products or services for a retail company.Develop and execute marketing campaigns to promote products or services for a retail company.Develop and execute marketing campaigns to promote products or services for a retail company.', 'Miami', 'Emily Chen', 'MNO Inc.', 1, 'admin', NULL, NULL, '2024-08-07 11:00:00', NULL, NULL),
(8, 'Network Administrator', 'Install, configure, and maintain computer networks for a tech company.Install, configure, and maintain computer networks for a tech company.Install, configure, and maintain computer networks for a tech company.', 'Seattle', 'David Lee', 'PQR Inc.', 1, 'admin', NULL, NULL, '2024-08-07 11:00:00', NULL, NULL),
(9, 'Graphic Designer', 'Create visual content for websites, social media, and marketing materials for a design firm.Create visual content for websites, social media, and marketing materials for a design firm.Create visual content for websites, social media, and marketing materials for a design firm.', 'Los Angeles', 'Sarah Taylor', 'STU Design', 1, 'admin', NULL, NULL, '2024-08-07 11:00:00', NULL, NULL),
(10, 'Customer Service Representative', 'Respond to customer inquiries and resolve issues for a call center.Respond to customer inquiries and resolve issues for a call center.Respond to customer inquiries and resolve issues for a call center.Respond to customer inquiries and resolve issues for a call center.', 'Dallas', 'Kevin White', 'VWX Inc.', 1, 'admin', NULL, NULL, '2024-08-07 11:00:00', NULL, NULL),
(11, 'Operations Manager', 'Oversee daily operations and manage teams to achieve business objectives for a manufacturing company.Oversee daily operations and manage teams to achieve business objectives for a manufacturing company.Oversee daily operations and manage teams to achieve business objectives for a manufacturing company.Oversee daily operations and manage teams to achieve business objectives for a manufacturing company.', 'Detroit', 'Lisa Nguyen', 'YZA Inc.', 1, 'admin', NULL, NULL, '2024-08-07 11:00:00', NULL, NULL),
(12, 'Sales Manager', 'Develop and execute sales strategies to meet business objectives for a retail company.', 'New York', 'John Smith', 'ABC Corporation', 1, 'admin', NULL, NULL, '2024-08-07 11:00:00', NULL, NULL),
(13, 'IT Project Manager', 'Oversee IT projects from planning to delivery for a tech company.', 'San Francisco', 'Jane Doe', 'XYZ Inc.', 1, 'admin', NULL, NULL, '2024-08-07 11:00:00', NULL, NULL),
(14, 'Financial Analyst', 'Analyze financial data to inform business decisions for a financial institution.', 'Chicago', 'Bob Johnson', ' DEF Inc.', 1, 'admin', NULL, NULL, '2024-08-07 11:00:00', NULL, NULL),
(15, 'Marketing Coordinator', 'Assist in developing and executing marketing campaigns for a retail company.', 'Los Angeles', 'Alice Brown', 'GHI Corporation', 1, 'admin', NULL, NULL, '2024-08-07 11:00:00', NULL, NULL),
(16, 'Software Developer', 'Design, develop, and test software applications for a tech startup.', 'New York', 'Mike Davis', 'JKL Bank', 1, 'admin', NULL, NULL, '2024-08-07 11:00:00', NULL, NULL),
(17, 'Human Resources Generalist', 'Assist in recruitment, training, and employee relations for a mid-sized company.', 'Miami', 'Emily Chen', 'MNO Inc.', 1, 'admin', NULL, NULL, '2024-08-07 11:00:00', NULL, NULL),
(18, 'Network Engineer', 'Design, implement, and maintain computer networks for a tech company.', 'Seattle', 'David Lee', 'PQR Inc.', 1, 'admin', NULL, NULL, '2024-08-07 11:00:00', NULL, NULL),
(19, 'Graphic Designer', 'Create visual content for websites, social media, and marketing materials for a design firm.', 'Los Angeles', 'Sarah Taylor', 'STU Design', 1, 'admin', NULL, NULL, '2024-08-07 11:00:00', NULL, NULL),
(20, 'Customer Service Representative', 'Respond to customer inquiries and resolve issues for a call center.', 'Dallas', 'Kevin White', 'VWX Inc.', 1, 'admin', NULL, NULL, '2024-08-07 11:00:00', NULL, NULL),
(21, 'Operations Coordinator', 'Assist in overseeing daily operations and managing teams for a manufacturing company.', 'Detroit', 'Lisa Nguyen', 'YZA Inc.', 1, 'admin', NULL, NULL, '2024-08-07 11:00:00', NULL, NULL),
(22, 'Data Scientist', 'Analyze and interpret complex data to inform business decisions for a financial institution.', 'New York', 'John Smith', 'ABC Corporation', 1, 'admin', NULL, NULL, '2024-08-07 11:00:00', NULL, NULL),
(23, 'UX Designer', 'Design user interfaces for software applications and websites for a tech company.', 'San Francisco', 'Jane Doe', 'XYZ Inc.', 1, 'admin', NULL, NULL, '2024-08-07 11:00:00', NULL, NULL),
(24, 'Accountant', 'Prepare and review financial statements and tax returns for a mid-sized company.', 'Chicago', 'Bob Johnson', ' DEF Inc.', 1, 'admin', NULL, NULL, '2024-08-07 11:00:00', NULL, NULL),
(25, 'Marketing Research Analyst', 'Analyze market trends and consumer behavior for a retail company.', 'Los Angeles', 'Alice Brown', 'GHI Corporation', 1, 'admin', NULL, NULL, '2024-08-07 11:00:00', NULL, NULL),
(26, 'Software Tester', 'Test and debug software applications for a tech startup.', 'New York', 'Mike Davis', 'JKL Bank', 1, 'admin', NULL, NULL, '2024-08-07 11:00:00', NULL, NULL),
(27, 'Human Resources Manager', 'Oversee recruitment, training, and employee relations for a mid-sized company.', 'Miami', 'Emily Chen', 'MNO Inc.', 1, 'admin', NULL, NULL, '2024-08-07 11:00:00', NULL, NULL),
(28, 'Data Scientist', 'Analyze and interpret complex data to inform business decisions for a tech company.', 'San Francisco', 'Jane Doe', 'XYZ Inc.', 1, 'admin', NULL, NULL, '2024-08-08 05:58:00', NULL, NULL),
(29, 'Product Manager', 'Oversee product development and launch for a tech startup.', 'New York', 'John Smith', 'ABC Corporation', 1, 'admin', NULL, NULL, '2024-08-08 05:58:00', NULL, NULL),
(30, 'UX Designer', 'Design user interfaces for software applications and websites for a design firm.', 'Los Angeles', 'Sarah Taylor', 'STU Design', 1, 'admin', NULL, NULL, '2024-08-08 05:58:00', NULL, NULL),
(31, 'Business Analyst', 'Analyze market trends and business operations for a consulting firm.', 'Chicago', 'Bob Johnson', ' DEF Inc.', 1, 'admin', NULL, NULL, '2024-08-08 05:58:00', NULL, NULL),
(32, 'Content Writer', 'Create engaging and informative content for a media company.', 'Miami', 'Emily Chen', 'MNO Inc.', 1, 'admin', NULL, NULL, '2024-08-08 05:58:00', NULL, NULL),
(33, 'DevOps Engineer', 'Design and implement scalable and secure infrastructure for web applications.', 'Seattle', 'David Lee', 'PQR Inc.', 1, 'admin', NULL, NULL, '2024-08-08 05:58:00', NULL, NULL),
(34, 'Graphic Designer', 'Create visual content for websites, social media, and marketing materials for a marketing agency.', 'Los Angeles', 'Alice Brown', 'GHI Corporation', 1, 'admin', NULL, NULL, '2024-08-08 05:58:00', NULL, NULL),
(35, 'Software Tester', 'Test and debug software applications for a tech company.', 'San Francisco', 'Mike Davis', 'JKL Bank', 1, 'admin', NULL, NULL, '2024-08-08 05:58:00', NULL, NULL),
(36, 'Technical Support Specialist', 'Provide technical assistance and support for a software company.', 'Dallas', 'Kevin White', 'VWX Inc.', 1, 'admin', NULL, NULL, '2024-08-08 05:58:00', NULL, NULL),
(37, 'Web Developer', 'Develop and maintain dynamic web applications using PHP and Laravel for a web development agency.', 'Detroit', 'Lisa Nguyen', 'YZA Inc.', 1, 'admin', NULL, NULL, '2024-08-08 05:58:00', NULL, NULL),
(38, 'Development Team Lead', 'Technical Skills:\r\nProficiency in one or more programming languages (e.g., Java, Python, C++, JavaScript).\r\nExperience with software development methodologies (e.g., Agile, Scrum, Kanban).\r\nStrong understanding of computer science fundamentals, including data structures, algorithms, and software design patterns.\r\nLeadership Experience:\r\n2+ years of experience leading a team of software engineers.\r\nProven track record of delivering high-quality software products on time and on budget.\r\nExperience with mentoring, coaching, and developing the skills of team members.', 'Washington. D.C.', 'Mr. someboss', 'Somesome Co.,Ltd.', 1, 'admin', NULL, NULL, '2024-08-08 18:08:00', NULL, NULL),
(39, 'Make my website responsive device compatible', 'Responsive Web Design:\r\nDesign and develop responsive web pages that adapt to different screen sizes, devices, and browsers.\r\nEnsure that the website is accessible and usable across various devices, including desktops, laptops, tablets, and mobile phones.\r\nImplement responsive design principles, including flexible grids, images, and media queries.\r\nFront-end Development:\r\nWrite clean, efficient, and well-documented front-end code using HTML, CSS, and JavaScript.\r\nUtilize front-end frameworks and libraries, such as Bootstrap, Foundation, or React, to build responsive web pages.\r\nEnsure that the website is compatible with various browsers, including Chrome, Firefox, Safari, and Internet Explorer.\r\nTesting and Debugging:\r\nTest and debug responsive web pages to ensure that they are functioning as expected across various devices and browsers.\r\nIdentify and resolve front-end bugs and issues, including those related to layout, styling, and JavaScript functionality.\r\nCollaborate with the QA team to ensure that the website meets the required quality standards.\r\nCollaboration and Communication:\r\nCollaborate with the design team to ensure that the responsive design meets the required design standards.\r\nCommunicate technical plans, progress, and results to stakeholders, including non-technical audiences.\r\nParticipate in code reviews and provide feedback to ensure that the front-end code is of high quality.\r\nRequirements:\r\n', 'New York', 'Mrs. Code', 'Code de Grace Beauty code', 1, 'admin', NULL, NULL, '2024-08-08 18:14:29', NULL, NULL),
(40, 'Looking WordPress Developer for ThemeForest', 'Develop and maintain dynamic web applications using PHP and Laravel for a web development agency.', 'Mandalay, Myanmar', 'Alex Johnson', 'Creative Agency\n', 1, 'admin', NULL, NULL, '2024-08-08 22:38:51', NULL, NULL),
(41, 'Web Designer', 'Responsible for designing user-friendly and visually appealing websites.', 'Yangon, Myanmar', 'John Doe', 'Creative Agency', 1, 'admin', NULL, NULL, '2024-08-08 22:41:08', NULL, NULL),
(42, 'Web Developer', 'Develop and maintain websites, ensuring high performance and availability.', 'Mandalay, Myanmar', 'Jane Smith', 'Tech Solutions', 1, 'admin', NULL, NULL, '2024-08-08 22:41:08', NULL, NULL),
(43, 'Game Developer', 'Create and develop games for various platforms, focusing on gameplay mechanics.', 'Naypyidaw, Myanmar', 'Alex Johnson', 'Game Studio', 1, 'admin', NULL, NULL, '2024-08-08 22:41:08', NULL, NULL),
(44, 'Graphic Artist', 'Design visual content including illustrations, logos, and advertisements.', 'Yangon, Myanmar', 'Emily Brown', 'Design Hub', 1, 'admin', NULL, NULL, '2024-08-08 22:41:08', NULL, NULL),
(45, 'SEO Specialist', 'Optimize website content for search engines to improve rankings and visibility.', 'Mandalay, Myanmar', 'Chris Lee', 'Digital Marketing Co.', 1, 'admin', NULL, NULL, '2024-08-08 22:41:08', NULL, NULL),
(46, 'Server Administrator', 'Manage and maintain servers, ensuring security and reliability.', 'Yangon, Myanmar', 'Michael Davis', 'IT Solutions', 1, 'admin', NULL, NULL, '2024-08-08 22:41:08', NULL, NULL),
(47, 'Front-End Developer', 'Build and optimize web pages using HTML, CSS, and JavaScript.', 'Yangon, Myanmar', 'David Wilson', 'Bright Tech', 1, 'admin', NULL, NULL, '2024-08-08 22:56:52', NULL, NULL),
(48, 'Back-End Developer', 'Develop server-side logic, databases, and APIs.', 'Mandalay, Myanmar', 'Sophia Martinez', 'Innovative Solutions', 1, 'admin', NULL, NULL, '2024-08-08 22:56:52', NULL, NULL),
(49, 'UI/UX Designer', 'Create user-centered designs by understanding business requirements.', 'Naypyidaw, Myanmar', 'Ethan Garcia', 'Creative Minds', 1, 'admin', NULL, NULL, '2024-08-08 22:56:52', NULL, NULL),
(50, 'Full-Stack Developer', 'Work on both front-end and back-end development tasks.', 'Yangon, Myanmar', 'Liam Anderson', 'Tech Innovators', 1, 'admin', NULL, NULL, '2024-08-08 22:56:52', NULL, NULL),
(51, 'Mobile App Developer', 'Develop mobile applications for Android and iOS platforms.', 'Mandalay, Myanmar', 'Ava Thomas', 'App Masters', 1, 'admin', NULL, NULL, '2024-08-08 22:56:52', NULL, NULL),
(52, 'Game Designer', 'Design game concepts, mechanics, and levels.', 'Naypyidaw, Myanmar', 'Lucas Hernandez', 'Playtime Studios', 1, 'admin', NULL, NULL, '2024-08-08 22:56:52', NULL, NULL),
(53, '3D Animator', 'Create 3D animations for games, movies, and commercials.', 'Yangon, Myanmar', 'Mia Robinson', 'Animation Pro', 1, 'admin', NULL, NULL, '2024-08-08 22:56:52', NULL, NULL),
(54, 'Digital Marketing Specialist', 'Plan and execute digital marketing campaigns.', 'Mandalay, Myanmar', 'Elijah White', 'Marketing Gurus', 1, 'admin', NULL, NULL, '2024-08-08 22:56:52', NULL, NULL),
(55, 'Content Writer', 'Write engaging and SEO-friendly content for websites and blogs.', 'Naypyidaw, Myanmar', 'Amelia Harris', 'Content Creators', 1, 'admin', NULL, NULL, '2024-08-08 22:56:52', NULL, NULL),
(56, 'Network Engineer', 'Design, implement, and manage networking solutions.', 'Yangon, Myanmar', 'James Clark', 'NetWorks', 1, 'admin', NULL, NULL, '2024-08-08 22:56:52', NULL, NULL),
(57, 'DevOps Engineer', 'Automate and streamline development operations and infrastructure.', 'Mandalay, Myanmar', 'Benjamin Lewis', 'CloudOps Ltd.', 1, 'admin', NULL, NULL, '2024-08-08 22:56:52', NULL, NULL),
(58, 'QA Tester', 'Test and ensure the quality of software products.', 'Naypyidaw, Myanmar', 'Charlotte Young', 'Quality First', 1, 'admin', NULL, NULL, '2024-08-08 22:56:52', NULL, NULL),
(59, 'Project Manager', 'Plan, execute, and close projects efficiently.', 'Yangon, Myanmar', 'William King', 'ManageIt Co.', 1, 'admin', NULL, NULL, '2024-08-08 22:56:52', NULL, NULL),
(60, 'Systems Analyst', 'Analyze and design IT systems for business needs.', 'Mandalay, Myanmar', 'Olivia Scott', 'SysTech', 1, 'admin', NULL, NULL, '2024-08-08 22:56:52', NULL, NULL),
(61, 'Data Scientist', 'Analyze data to gain insights and support decision-making.', 'Naypyidaw, Myanmar', 'Henry Green', 'Data Insights', 1, 'admin', NULL, NULL, '2024-08-08 22:56:52', NULL, NULL),
(62, 'Cybersecurity Specialist', 'Protect systems and networks from cyber threats.', 'Yangon, Myanmar', 'Isabella Hall', 'SecureTech', 1, 'admin', NULL, NULL, '2024-08-08 22:56:52', NULL, NULL),
(63, 'Database Administrator', 'Manage and optimize databases.', 'Mandalay, Myanmar', 'Alexander Turner', 'DB Solutions', 1, 'admin', NULL, NULL, '2024-08-08 22:56:52', NULL, NULL),
(64, 'IT Support Specialist', 'Provide technical support to end-users.', 'Naypyidaw, Myanmar', 'Emily Baker', 'HelpDesk Co.', 1, 'admin', NULL, NULL, '2024-08-08 22:56:52', NULL, NULL),
(65, 'Cloud Architect', 'Design and implement cloud infrastructure solutions.', 'Yangon, Myanmar', 'Michael Wright', 'Cloud Innovators', 1, 'admin', NULL, NULL, '2024-08-08 22:56:52', NULL, NULL),
(66, 'Blockchain Developer', 'Develop blockchain-based applications and smart contracts.', 'Mandalay, Myanmar', 'Daniel Walker', 'BlockChain Co.', 1, 'admin', NULL, NULL, '2024-08-08 22:56:52', NULL, NULL),
(67, 'Development Team Lead', 'Lead a team of developers in building and maintaining web applications.', 'Yangon, Myanmar', 'Olivia Evans', 'Tech Lead Co.', 1, 'admin', NULL, NULL, '2024-08-08 23:06:50', NULL, NULL),
(68, 'Make my website responsive device compatible', 'Optimize existing website to be fully responsive and device compatible.', 'Mandalay, Myanmar', 'Liam Davis', 'Responsive Solutions', 1, 'admin', NULL, NULL, '2024-08-08 23:06:50', NULL, NULL),
(69, 'Looking Graphic Designer (Logo + UI)', 'Seeking a skilled graphic designer to create logos and user interface designs.', 'Naypyidaw, Myanmar', 'Sophia Johnson', 'Creative Design Ltd.', 1, 'admin', NULL, NULL, '2024-08-08 23:06:50', NULL, NULL),
(70, 'Are you Typography Expert?', 'Looking for a typography expert to enhance text design across various platforms.', 'Yangon, Myanmar', 'Mason Brown', 'FontMasters', 1, 'admin', NULL, NULL, '2024-08-08 23:06:50', NULL, NULL);

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
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `job_categories`
--
ALTER TABLE `job_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
