-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 28, 2017 at 06:58 PM
-- Server version: 5.7.16-0ubuntu0.16.04.1
-- PHP Version: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_is`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `author` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `level` smallint(1) NOT NULL,
  `content` longtext NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `author`, `title`, `level`, `content`, `date`) VALUES
(1, 'csadmin', 'Enrollment Schedule', 1, 'The results of the first preenlistment round for First Semester AY 2016-2017 have been released. Please log in to view your granted classes via the Preenlistment module.\r\n\r\nThe second preenlistment round for Second Semester AY 2016-2017 will start on 06 December 2016 (Tuesday) and will end on 27 December 2016 (Tuesday) at 11:59pm.  Your module is currently in view mode. If you wish to cancel a class, you can do so come 06 December 2016 when the second round of preenlistment starts. If you did not participate in the first round of preenlistment but will be participating in the second round, please fill out your Student Profile before preenlisting.\r\n\r\nThe result of the Second Batch Run is scheduled to be released on 03 January 2017 (Tuesday).\r\n\r\nStudents are advised to settle their accountabilities or process their scholarships (especially STFAP bracket / ST discount) ahead of time to avoid inconveniences during the registration period\r\n\r\nFor inquiries regarding offered classes, please directly contact the academic unit concerned.\r\n\r\nIf you\'re experiencing problems with the CRS website, (e.g. missing modules) kindly email us.', '2016-12-12'),
(2, 'loremipsum', 'Lorem ipsum', 1, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc.', '2016-12-12');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `title` varchar(20) NOT NULL,
  `room` varchar(10) NOT NULL,
  `units` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `room`, `units`, `semester`, `year`) VALUES
(1, 'CS 133', 'CLR2', 3, 1, 2016),
(2, 'CS 135', 'LECHALL', 3, 2, 2015),
(3, 'CS 32', 'LECHALL', 3, 2, 2015),
(4, 'CS 11', 'CLR1', 3, 1, 2016);

-- --------------------------------------------------------

--
-- Table structure for table `course_schedules`
--

CREATE TABLE `course_schedules` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `day_of_week` char(1) NOT NULL,
  `schedule_start` time NOT NULL,
  `schedule_end` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course_schedules`
--

INSERT INTO `course_schedules` (`id`, `course_id`, `day_of_week`, `schedule_start`, `schedule_end`) VALUES
(1, 1, 'T', '13:00:00', '14:30:00'),
(2, 1, 'H', '13:00:00', '14:30:00'),
(3, 2, 'T', '14:30:00', '16:00:00'),
(4, 2, 'H', '14:30:00', '16:00:00'),
(5, 3, 'M', '08:00:00', '11:00:00'),
(6, 4, 'T', '10:00:00', '13:00:00'),
(7, 4, 'H', '10:00:00', '12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `enlistment`
--

CREATE TABLE `enlistment` (
  `id` int(11) NOT NULL,
  `courseid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `approved` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `enlistment`
--

INSERT INTO `enlistment` (`id`, `courseid`, `uid`, `approved`) VALUES
(2, 1, 2, 1),
(3, 2, 2, 1),
(11, 4, 1, 0),
(12, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `uid`) VALUES
(1, 3),
(2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(11) NOT NULL,
  `studentid` int(11) NOT NULL,
  `courseid` int(11) NOT NULL,
  `instructorid` int(11) NOT NULL,
  `grade` float NOT NULL,
  `semester` smallint(6) NOT NULL,
  `year` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `studentid`, `courseid`, `instructorid`, `grade`, `semester`, `year`) VALUES
(1, 1, 1, 2, 3, 1, 2016),
(2, 1, 2, 2, 2.25, 1, 2016);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'user', 'password'),
(2, 'leuser', 'lepassword'),
(3, 'afaculty', 'afacultypass'),
(4, 'afaculty2', 'mypassword'),
(5, 'newuser', 'password'),
(6, 'user1', 'password');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `id` int(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `studentnumber` int(9) NOT NULL,
  `bracket` char(1) NOT NULL,
  `degreeprog` varchar(100) NOT NULL,
  `college` varchar(100) NOT NULL,
  `is_student` tinyint(1) NOT NULL,
  `is_enrolled` tinyint(1) NOT NULL,
  `approved` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `username`, `firstname`, `middlename`, `lastname`, `studentnumber`, `bracket`, `degreeprog`, `college`, `is_student`, `is_enrolled`, `approved`) VALUES
(1, 'user', 'Jahziel Rae', 'Millare', 'Arceo', 201489573, 'E', 'BS Computer Science', 'Engineering', 1, 0, 1),
(2, 'leuser', 'CS', 'The', 'Lord', 201564644, 'A', 'BS Computer Science', 'Engineering', 1, 1, 1),
(3, 'afaculty', 'Juan', 'Ibarra', 'Dela Cruz', 200899999, 'A', 'BS Statistics', 'School of Statistics', 0, 0, 1),
(4, 'afaculty2', 'Justin', 'Berdugo', 'Bieber', 200569693, 'A', 'MS Computer Science', 'Engineering', 1, 1, 1),
(5, 'newuser', 'Philo', 'Logos', 'Ethos', 201655555, 'A', 'BA Philosophy', 'Social Sciences and Philosophy', 1, 0, 1),
(6, 'user1', 'efwef', 'efwefwe', 'fewfew', 201455555, 'A', 'efewf', 'Engineering', 1, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_schedules`
--
ALTER TABLE `course_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_grade_id` (`course_id`);

--
-- Indexes for table `enlistment`
--
ALTER TABLE `enlistment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_courseid` (`courseid`),
  ADD KEY `fk_uid` (`uid`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_stud_id` (`studentid`),
  ADD KEY `fk_course_id` (`courseid`),
  ADD KEY `fk_inst_id` (`instructorid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `course_schedules`
--
ALTER TABLE `course_schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `enlistment`
--
ALTER TABLE `enlistment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `course_schedules`
--
ALTER TABLE `course_schedules`
  ADD CONSTRAINT `fk_grade_id` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constraints for table `enlistment`
--
ALTER TABLE `enlistment`
  ADD CONSTRAINT `fk_courseid` FOREIGN KEY (`courseid`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `fk_uid` FOREIGN KEY (`uid`) REFERENCES `user_info` (`id`);

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `fk_course_id` FOREIGN KEY (`courseid`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `fk_inst_id` FOREIGN KEY (`instructorid`) REFERENCES `faculty` (`id`),
  ADD CONSTRAINT `fk_stud_id` FOREIGN KEY (`studentid`) REFERENCES `user_info` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
