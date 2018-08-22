-- MySQL dump 10.16  Distrib 10.1.32-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: grading_db
-- ------------------------------------------------------
-- Server version	10.1.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tblclass`
--

DROP TABLE IF EXISTS `tblclass`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblclass` (
  `class_id` int(11) NOT NULL AUTO_INCREMENT,
  `yearlevel_id` int(11) NOT NULL,
  `classname` varchar(255) NOT NULL,
  PRIMARY KEY (`class_id`),
  UNIQUE KEY `yearlevel_id_2` (`yearlevel_id`,`classname`),
  KEY `yearLevel_id` (`yearlevel_id`),
  CONSTRAINT `tbl_class_year_fk` FOREIGN KEY (`yearlevel_id`) REFERENCES `tblyearlevel` (`yearlevel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblclass`
--

LOCK TABLES `tblclass` WRITE;
/*!40000 ALTER TABLE `tblclass` DISABLE KEYS */;
INSERT INTO `tblclass` VALUES (1,1,'Section A'),(3,1,'Section B'),(6,1,'Section C'),(8,1,'Section D'),(10,1,'Section E'),(9,2,'Section A'),(12,2,'Section B'),(13,2,'Section C'),(14,3,'Section A'),(15,3,'Section B');
/*!40000 ALTER TABLE `tblclass` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblcourse`
--

DROP TABLE IF EXISTS `tblcourse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblcourse` (
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `courseName` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblcourse`
--

LOCK TABLES `tblcourse` WRITE;
/*!40000 ALTER TABLE `tblcourse` DISABLE KEYS */;
INSERT INTO `tblcourse` VALUES (1,'BSIT','Bachelor of Science in Information Technology'),(2,'BSHRM','Bachelor of Science in Hotel and Restaurant Management'),(3,'BSCS','Bachelor of Science in Computer Science'),(4,'BSBA','Bachelor of Science in Business Administration'),(5,'ABE','Bachelor of Arts in English'),(6,'BSCRIM','Bachelor of Science in Criminology'),(7,'BST','Bachelor of Science in Tourism'),(8,'BSME','Bachelor of Science in Mechanical Engineering'),(9,'BSIS','Bachelor of Science in Information Systems'),(10,'BSAT','Bachelor of Science in Accounting Technology'),(11,'BSED','Bachelor of Science in Education'),(12,'BSFI','Bachelor of Science in Fisheries'),(14,'BSA','Bachelor of Science in Agriculture'),(15,'BSBIO','Bachelor of Science in Biology'),(16,'BSMATH','Bachelor of Science in Mathematics'),(17,'BSMAR-E','Bachelor of Science in Marine Engineering');
/*!40000 ALTER TABLE `tblcourse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblfaculty`
--

DROP TABLE IF EXISTS `tblfaculty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblfaculty` (
  `faculty_id` int(11) NOT NULL AUTO_INCREMENT,
  `facNo` varchar(15) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `faculty_level` int(1) NOT NULL,
  `created` date NOT NULL,
  PRIMARY KEY (`faculty_id`),
  KEY `course_id` (`course_id`),
  CONSTRAINT `tbl_fac_course_fk` FOREIGN KEY (`course_id`) REFERENCES `tblcourse` (`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblfaculty`
--

LOCK TABLES `tblfaculty` WRITE;
/*!40000 ALTER TABLE `tblfaculty` DISABLE KEYS */;
INSERT INTO `tblfaculty` VALUES (1,'admin-123456','admin_fname','admin_mname','admin_lname',NULL,'admin','07011e14bd6cca1c1d43e6d91996f2038f9920b817fdd86ae3d944b47946544b',1,'2018-08-19');
/*!40000 ALTER TABLE `tblfaculty` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblfacultysubject`
--

DROP TABLE IF EXISTS `tblfacultysubject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblfacultysubject` (
  `faculty_subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `faculty_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  PRIMARY KEY (`faculty_subject_id`),
  KEY `faculty_id` (`faculty_id`),
  KEY `subject_id` (`subject_id`),
  KEY `faculty_id_2` (`faculty_id`,`subject_id`),
  CONSTRAINT `tbl_fac_fk` FOREIGN KEY (`faculty_id`) REFERENCES `tblfaculty` (`faculty_id`),
  CONSTRAINT `tbl_sub_fk` FOREIGN KEY (`subject_id`) REFERENCES `tblsubject` (`subject_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblfacultysubject`
--

LOCK TABLES `tblfacultysubject` WRITE;
/*!40000 ALTER TABLE `tblfacultysubject` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblfacultysubject` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblschoolyear`
--

DROP TABLE IF EXISTS `tblschoolyear`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblschoolyear` (
  `schoolyear_id` int(11) NOT NULL AUTO_INCREMENT,
  `schoolYear` varchar(30) NOT NULL,
  `semester` varchar(30) NOT NULL,
  PRIMARY KEY (`schoolyear_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblschoolyear`
--

LOCK TABLES `tblschoolyear` WRITE;
/*!40000 ALTER TABLE `tblschoolyear` DISABLE KEYS */;
INSERT INTO `tblschoolyear` VALUES (1,'2018 - 2019','First Semester');
/*!40000 ALTER TABLE `tblschoolyear` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblstudent`
--

DROP TABLE IF EXISTS `tblstudent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblstudent` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `studentIdNo` varchar(255) NOT NULL,
  `student_fname` varchar(255) NOT NULL,
  `student_mname` varchar(255) NOT NULL,
  `student_lname` varchar(255) NOT NULL,
  `course_id` int(11) NOT NULL,
  `yearlevel_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created` date NOT NULL,
  PRIMARY KEY (`student_id`),
  UNIQUE KEY `studentIdNo` (`studentIdNo`),
  KEY `course_id` (`course_id`,`yearlevel_id`),
  KEY `class_id` (`class_id`),
  KEY `tbl_year_fk` (`yearlevel_id`),
  CONSTRAINT `tbl_class_fk` FOREIGN KEY (`class_id`) REFERENCES `tblclass` (`class_id`),
  CONSTRAINT `tbl_course_fk` FOREIGN KEY (`course_id`) REFERENCES `tblcourse` (`course_id`),
  CONSTRAINT `tbl_year_fk` FOREIGN KEY (`yearlevel_id`) REFERENCES `tblyearlevel` (`yearlevel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblstudent`
--

LOCK TABLES `tblstudent` WRITE;
/*!40000 ALTER TABLE `tblstudent` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblstudent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblstudentgrade`
--

DROP TABLE IF EXISTS `tblstudentgrade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblstudentgrade` (
  `studentgrade_id` int(11) NOT NULL AUTO_INCREMENT,
  `studentIdNo` varchar(255) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `schoolyear_id` int(11) NOT NULL,
  `prelim` double NOT NULL,
  `midterm` double NOT NULL,
  `final` double NOT NULL,
  `finalGrade` double NOT NULL,
  `remarks` double NOT NULL,
  PRIMARY KEY (`studentgrade_id`),
  KEY `studentIdNo` (`studentIdNo`,`subject_id`,`faculty_id`,`course_id`,`schoolyear_id`),
  KEY `tbl_gr_fac_fk` (`faculty_id`),
  KEY `tbl_gr_crse_fk` (`course_id`),
  KEY `tbl_gr_sub_fk` (`subject_id`),
  KEY `tbl_gr_sch_fk` (`schoolyear_id`),
  CONSTRAINT `tbl_gr_crse_fk` FOREIGN KEY (`course_id`) REFERENCES `tblcourse` (`course_id`),
  CONSTRAINT `tbl_gr_fac_fk` FOREIGN KEY (`faculty_id`) REFERENCES `tblfaculty` (`faculty_id`),
  CONSTRAINT `tbl_gr_sch_fk` FOREIGN KEY (`schoolyear_id`) REFERENCES `tblschoolyear` (`schoolyear_id`),
  CONSTRAINT `tbl_gr_stud_fk` FOREIGN KEY (`studentIdNo`) REFERENCES `tblstudent` (`studentIdNo`),
  CONSTRAINT `tbl_gr_sub_fk` FOREIGN KEY (`subject_id`) REFERENCES `tblsubject` (`subject_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblstudentgrade`
--

LOCK TABLES `tblstudentgrade` WRITE;
/*!40000 ALTER TABLE `tblstudentgrade` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblstudentgrade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblstudentsubject`
--

DROP TABLE IF EXISTS `tblstudentsubject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblstudentsubject` (
  `studentsubject_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  PRIMARY KEY (`studentsubject_id`),
  KEY `student_id` (`student_id`,`subject_id`,`faculty_id`),
  KEY `subject_id` (`subject_id`,`faculty_id`),
  KEY `faculty_id` (`faculty_id`),
  CONSTRAINT `tbl_sub_fac_fk` FOREIGN KEY (`faculty_id`) REFERENCES `tblfaculty` (`faculty_id`),
  CONSTRAINT `tbl_sub_stud_fk` FOREIGN KEY (`student_id`) REFERENCES `tblstudent` (`student_id`),
  CONSTRAINT `tbl_sub_sub_fk` FOREIGN KEY (`subject_id`) REFERENCES `tblsubject` (`subject_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblstudentsubject`
--

LOCK TABLES `tblstudentsubject` WRITE;
/*!40000 ALTER TABLE `tblstudentsubject` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblstudentsubject` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblsubject`
--

DROP TABLE IF EXISTS `tblsubject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblsubject` (
  `subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `subjectCode` varchar(255) NOT NULL,
  `subjectName` varchar(255) NOT NULL,
  `unit` int(11) NOT NULL,
  `yearlevel_id` int(11) NOT NULL,
  `schoolyear_id` int(11) NOT NULL,
  PRIMARY KEY (`subject_id`),
  KEY `yearLevel_id` (`yearlevel_id`,`schoolyear_id`),
  KEY `yearLevel_id_2` (`yearlevel_id`,`schoolyear_id`),
  KEY `tbl_sch_fk` (`schoolyear_id`),
  CONSTRAINT `tbl_sch_fk` FOREIGN KEY (`schoolyear_id`) REFERENCES `tblschoolyear` (`schoolyear_id`),
  CONSTRAINT `tbl_subj_fk` FOREIGN KEY (`subject_id`) REFERENCES `tblyearlevel` (`yearlevel_id`),
  CONSTRAINT `tbl_yr_fk` FOREIGN KEY (`yearlevel_id`) REFERENCES `tblyearlevel` (`yearlevel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblsubject`
--

LOCK TABLES `tblsubject` WRITE;
/*!40000 ALTER TABLE `tblsubject` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblsubject` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblyearlevel`
--

DROP TABLE IF EXISTS `tblyearlevel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblyearlevel` (
  `yearlevel_id` int(11) NOT NULL AUTO_INCREMENT,
  `yearLevel` varchar(11) NOT NULL,
  PRIMARY KEY (`yearlevel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblyearlevel`
--

LOCK TABLES `tblyearlevel` WRITE;
/*!40000 ALTER TABLE `tblyearlevel` DISABLE KEYS */;
INSERT INTO `tblyearlevel` VALUES (1,'First Year'),(2,'Second Year'),(3,'Third Year'),(4,'Fourth Year'),(5,'Fifth Year');
/*!40000 ALTER TABLE `tblyearlevel` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-08-22 23:05:55
