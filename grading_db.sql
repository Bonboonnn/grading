-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2018 at 12:15 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grading_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblclass`
--

CREATE TABLE `tblclass` (
  `class_id` int(11) NOT NULL,
  `yearlevel_id` int(11) NOT NULL,
  `classname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblclass`
--

INSERT INTO `tblclass` (`class_id`, `yearlevel_id`, `classname`) VALUES
(1, 1, 'Section A'),
(3, 1, 'Section B'),
(6, 1, 'Section C'),
(8, 1, 'Section D'),
(10, 1, 'Section E'),
(9, 2, 'Section A'),
(12, 2, 'Section B'),
(13, 2, 'Section C');

-- --------------------------------------------------------

--
-- Table structure for table `tblcourse`
--

CREATE TABLE `tblcourse` (
  `course_id` int(11) NOT NULL,
  `courseName` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcourse`
--

INSERT INTO `tblcourse` (`course_id`, `courseName`, `description`) VALUES
(1, 'BSIT', 'Bachelor of Science in Information Technology'),
(2, 'BSHRM', 'Bachelor of Science in Hotel and Restaurant Management'),
(3, 'BSCS', 'Bachelor of Science in Computer Science'),
(4, 'BSBA', 'Bachelor of Science in Business Administration'),
(5, 'ABE', 'Bachelor of Arts in English'),
(6, 'BSCRIM', 'Bachelor of Science in Criminology'),
(7, 'BST', 'Bachelor of Science in Tourism'),
(8, 'BSME', 'Bachelor of Science in Mechanical Engineering'),
(9, 'BSIS', 'Bachelor of Science in Information Systems'),
(10, 'BSAT', 'Bachelor of Science in Accounting Technology'),
(11, 'BSED', 'Bachelor of Science in Education'),
(12, 'BSFI', 'Bachelor of Science in Fisheries'),
(14, 'BSA', 'Bachelor of Science in Agriculture'),
(15, 'BSBIO', 'Bachelor of Science in Biology'),
(16, 'BSMATH', 'Bachelor of Science in Mathematics'),
(17, 'BSMAR-E', 'Bachelor of Science in Marine Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `tblfaculty`
--

CREATE TABLE `tblfaculty` (
  `faculty_id` int(11) NOT NULL,
  `facNo` varchar(15) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `faculty_level` int(1) NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblfaculty`
--

INSERT INTO `tblfaculty` (`faculty_id`, `facNo`, `fname`, `mname`, `lname`, `course_id`, `username`, `password`, `faculty_level`, `created`) VALUES
(1, 'admin-123456', 'admin_fname', 'admin_mname', 'admin_lname', NULL, 'admin', '07011e14bd6cca1c1d43e6d91996f2038f9920b817fdd86ae3d944b47946544b', 1, '2018-08-19');

-- --------------------------------------------------------

--
-- Table structure for table `tblfacultysubject`
--

CREATE TABLE `tblfacultysubject` (
  `faculty_subject_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblschoolyear`
--

CREATE TABLE `tblschoolyear` (
  `schoolyear_id` int(11) NOT NULL,
  `schoolYear` int(11) NOT NULL,
  `semester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblstudent`
--

CREATE TABLE `tblstudent` (
  `student_id` int(11) NOT NULL,
  `studentIdNo` varchar(255) NOT NULL,
  `student_fname` varchar(255) NOT NULL,
  `student_mname` varchar(255) NOT NULL,
  `student_lname` varchar(255) NOT NULL,
  `course_id` int(11) NOT NULL,
  `yearlevel_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblstudentgrade`
--

CREATE TABLE `tblstudentgrade` (
  `studentgrade_id` int(11) NOT NULL,
  `studentIdNo` varchar(255) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `schoolyear_id` int(11) NOT NULL,
  `prelim` double NOT NULL,
  `midterm` double NOT NULL,
  `final` double NOT NULL,
  `finalGrade` double NOT NULL,
  `remarks` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblstudentsubject`
--

CREATE TABLE `tblstudentsubject` (
  `studentsubject_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblsubject`
--

CREATE TABLE `tblsubject` (
  `subject_id` int(11) NOT NULL,
  `subjectCode` varchar(255) NOT NULL,
  `subjectName` varchar(255) NOT NULL,
  `unit` int(11) NOT NULL,
  `yearlevel_id` int(11) NOT NULL,
  `schoolyear_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblyearlevel`
--

CREATE TABLE `tblyearlevel` (
  `yearlevel_id` int(11) NOT NULL,
  `yearLevel` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblyearlevel`
--

INSERT INTO `tblyearlevel` (`yearlevel_id`, `yearLevel`) VALUES
(1, 'First Year'),
(2, 'Second Year'),
(3, 'Third Year');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblclass`
--
ALTER TABLE `tblclass`
  ADD PRIMARY KEY (`class_id`),
  ADD UNIQUE KEY `yearlevel_id_2` (`yearlevel_id`,`classname`),
  ADD KEY `yearLevel_id` (`yearlevel_id`);

--
-- Indexes for table `tblcourse`
--
ALTER TABLE `tblcourse`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `tblfaculty`
--
ALTER TABLE `tblfaculty`
  ADD PRIMARY KEY (`faculty_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `tblfacultysubject`
--
ALTER TABLE `tblfacultysubject`
  ADD PRIMARY KEY (`faculty_subject_id`),
  ADD KEY `faculty_id` (`faculty_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `faculty_id_2` (`faculty_id`,`subject_id`);

--
-- Indexes for table `tblschoolyear`
--
ALTER TABLE `tblschoolyear`
  ADD PRIMARY KEY (`schoolyear_id`);

--
-- Indexes for table `tblstudent`
--
ALTER TABLE `tblstudent`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `studentIdNo` (`studentIdNo`),
  ADD KEY `course_id` (`course_id`,`yearlevel_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `tbl_year_fk` (`yearlevel_id`);

--
-- Indexes for table `tblstudentgrade`
--
ALTER TABLE `tblstudentgrade`
  ADD PRIMARY KEY (`studentgrade_id`),
  ADD KEY `studentIdNo` (`studentIdNo`,`subject_id`,`faculty_id`,`course_id`,`schoolyear_id`),
  ADD KEY `tbl_gr_fac_fk` (`faculty_id`),
  ADD KEY `tbl_gr_crse_fk` (`course_id`),
  ADD KEY `tbl_gr_sub_fk` (`subject_id`),
  ADD KEY `tbl_gr_sch_fk` (`schoolyear_id`);

--
-- Indexes for table `tblstudentsubject`
--
ALTER TABLE `tblstudentsubject`
  ADD PRIMARY KEY (`studentsubject_id`),
  ADD KEY `student_id` (`student_id`,`subject_id`,`faculty_id`),
  ADD KEY `subject_id` (`subject_id`,`faculty_id`),
  ADD KEY `faculty_id` (`faculty_id`);

--
-- Indexes for table `tblsubject`
--
ALTER TABLE `tblsubject`
  ADD PRIMARY KEY (`subject_id`),
  ADD KEY `yearLevel_id` (`yearlevel_id`,`schoolyear_id`),
  ADD KEY `yearLevel_id_2` (`yearlevel_id`,`schoolyear_id`),
  ADD KEY `tbl_sch_fk` (`schoolyear_id`);

--
-- Indexes for table `tblyearlevel`
--
ALTER TABLE `tblyearlevel`
  ADD PRIMARY KEY (`yearlevel_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblclass`
--
ALTER TABLE `tblclass`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tblcourse`
--
ALTER TABLE `tblcourse`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tblfaculty`
--
ALTER TABLE `tblfaculty`
  MODIFY `faculty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblfacultysubject`
--
ALTER TABLE `tblfacultysubject`
  MODIFY `faculty_subject_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblschoolyear`
--
ALTER TABLE `tblschoolyear`
  MODIFY `schoolyear_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblstudent`
--
ALTER TABLE `tblstudent`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblstudentgrade`
--
ALTER TABLE `tblstudentgrade`
  MODIFY `studentgrade_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblstudentsubject`
--
ALTER TABLE `tblstudentsubject`
  MODIFY `studentsubject_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblsubject`
--
ALTER TABLE `tblsubject`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblyearlevel`
--
ALTER TABLE `tblyearlevel`
  MODIFY `yearlevel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblclass`
--
ALTER TABLE `tblclass`
  ADD CONSTRAINT `tbl_class_year_fk` FOREIGN KEY (`yearlevel_id`) REFERENCES `tblyearlevel` (`yearLevel_id`);

--
-- Constraints for table `tblfaculty`
--
ALTER TABLE `tblfaculty`
  ADD CONSTRAINT `tbl_fac_course_fk` FOREIGN KEY (`course_id`) REFERENCES `tblcourse` (`course_id`);

--
-- Constraints for table `tblfacultysubject`
--
ALTER TABLE `tblfacultysubject`
  ADD CONSTRAINT `tbl_fac_fk` FOREIGN KEY (`faculty_id`) REFERENCES `tblfaculty` (`faculty_id`),
  ADD CONSTRAINT `tbl_sub_fk` FOREIGN KEY (`subject_id`) REFERENCES `tblsubject` (`subject_id`);

--
-- Constraints for table `tblstudent`
--
ALTER TABLE `tblstudent`
  ADD CONSTRAINT `tbl_class_fk` FOREIGN KEY (`class_id`) REFERENCES `tblclass` (`class_id`),
  ADD CONSTRAINT `tbl_course_fk` FOREIGN KEY (`course_id`) REFERENCES `tblcourse` (`course_id`),
  ADD CONSTRAINT `tbl_year_fk` FOREIGN KEY (`yearlevel_id`) REFERENCES `tblyearlevel` (`yearLevel_id`);

--
-- Constraints for table `tblstudentgrade`
--
ALTER TABLE `tblstudentgrade`
  ADD CONSTRAINT `tbl_gr_crse_fk` FOREIGN KEY (`course_id`) REFERENCES `tblcourse` (`course_id`),
  ADD CONSTRAINT `tbl_gr_fac_fk` FOREIGN KEY (`faculty_id`) REFERENCES `tblfaculty` (`faculty_id`),
  ADD CONSTRAINT `tbl_gr_sch_fk` FOREIGN KEY (`schoolyear_id`) REFERENCES `tblschoolyear` (`schoolyear_id`),
  ADD CONSTRAINT `tbl_gr_stud_fk` FOREIGN KEY (`studentIdNo`) REFERENCES `tblstudent` (`studentIdNo`),
  ADD CONSTRAINT `tbl_gr_sub_fk` FOREIGN KEY (`subject_id`) REFERENCES `tblsubject` (`subject_id`);

--
-- Constraints for table `tblstudentsubject`
--
ALTER TABLE `tblstudentsubject`
  ADD CONSTRAINT `tbl_sub_fac_fk` FOREIGN KEY (`faculty_id`) REFERENCES `tblfaculty` (`faculty_id`),
  ADD CONSTRAINT `tbl_sub_stud_fk` FOREIGN KEY (`student_id`) REFERENCES `tblstudent` (`student_id`),
  ADD CONSTRAINT `tbl_sub_sub_fk` FOREIGN KEY (`subject_id`) REFERENCES `tblsubject` (`subject_id`);

--
-- Constraints for table `tblsubject`
--
ALTER TABLE `tblsubject`
  ADD CONSTRAINT `tbl_sch_fk` FOREIGN KEY (`schoolyear_id`) REFERENCES `tblschoolyear` (`schoolyear_id`),
  ADD CONSTRAINT `tbl_subj_fk` FOREIGN KEY (`subject_id`) REFERENCES `tblyearlevel` (`yearLevel_id`),
  ADD CONSTRAINT `tbl_yr_fk` FOREIGN KEY (`yearlevel_id`) REFERENCES `tblyearlevel` (`yearLevel_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
