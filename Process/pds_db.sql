-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 12, 2017 at 03:31 PM
-- Server version: 5.6.20-log
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pds_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `UserName` varchar(255) NOT NULL,
  `Password` varchar(64) NOT NULL,
  `sFullname` varchar(255) NOT NULL,
  `sContact` varchar(255) NOT NULL,
  `sAddress` varchar(255) NOT NULL,
  `sEmail` varchar(255) NOT NULL,
  `sPicture` varchar(255) NOT NULL,
  `AccountType` varchar(255) NOT NULL,
  `Hidden` tinyint(1) NOT NULL,
  `sAdd` tinyint(1) NOT NULL,
  `sDelete` tinyint(1) NOT NULL,
  `sUpdate` tinyint(1) NOT NULL,
  `Print` tinyint(1) NOT NULL,
  `recid` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `companysetup`
--

CREATE TABLE IF NOT EXISTS `companysetup` (
  `Index` int(12) NOT NULL,
  `CName` varchar(255) NOT NULL,
  `Loc` varchar(255) NOT NULL,
  `Contact` varchar(255) NOT NULL,
  `TIN` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblchildren`
--

CREATE TABLE IF NOT EXISTS `tblchildren` (
  `empID` int(12) NOT NULL,
  `cChildname` varchar(255) NOT NULL,
  `cCDOB` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblcivilservice`
--

CREATE TABLE IF NOT EXISTS `tblcivilservice` (
  `empID` int(12) NOT NULL,
  `cCareerService` varchar(255) NOT NULL,
  `cRating` varchar(255) NOT NULL,
  `cExamDate` varchar(255) NOT NULL,
  `cExamPlace` varchar(255) NOT NULL,
  `cLicenseNo` varchar(255) NOT NULL,
  `cDateRelease` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbledubak`
--

CREATE TABLE IF NOT EXISTS `tbledubak` (
  `empID` int(12) NOT NULL,
  `cLevel` varchar(255) NOT NULL,
  `cSchoolName` varchar(255) NOT NULL,
  `cCourseDegree` varchar(255) NOT NULL,
  `cGraduated` varchar(255) NOT NULL,
  `cHighestLevel` varchar(255) NOT NULL,
  `cEDateFrom` varchar(255) NOT NULL,
  `cEDateTo` varchar(255) NOT NULL,
  `cScholarshipAcad` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbledubak`
--

INSERT INTO `tbledubak` (`empID`, `cLevel`, `cSchoolName`, `cCourseDegree`, `cGraduated`, `cHighestLevel`, `cEDateFrom`, `cEDateTo`, `cScholarshipAcad`) VALUES
(6, 'Elementary', 'Jose B. Puey Sr. Elementary School', 'N/A', '2006', 'N/A', '2006', '2010', 'N/A'),
(6, 'Secondary', 'Sagay National High School', 'N/A', '2010', 'N/A', '2000', '2006', 'N/A'),
(6, 'Vocational', 'Ambot', 'N/A', '2011', 'N/A', '2010', '2011', 'Ambot'),
(6, 'Vocational', 'Amboooooot', 'N/A', '2013', 'N/A', '2012', '2013', 'N/A'),
(6, 'College', 'Northern Negros State College Of Science and Technology', 'N/A', '2017', 'N/A', '2014', '2017', 'N/A');

-- --------------------------------------------------------

--
-- Table structure for table `tblfambg`
--

CREATE TABLE IF NOT EXISTS `tblfambg` (
  `empID` int(12) NOT NULL,
  `cSSurname` varchar(255) NOT NULL,
  `cSFname` varchar(255) NOT NULL,
  `cSMame` varchar(255) NOT NULL,
  `cOccupation` varchar(255) NOT NULL,
  `cEmployer` varchar(255) NOT NULL,
  `cBusinessAddress` varchar(255) NOT NULL,
  `cFTelNo` varchar(255) NOT NULL,
  `cFSurname` varchar(255) NOT NULL,
  `cFFirstname` varchar(255) NOT NULL,
  `cFMiddlename` varchar(255) NOT NULL,
  `cMSurname` varchar(255) NOT NULL,
  `cMFirstname` varchar(255) NOT NULL,
  `cMMiddlename` varchar(255) NOT NULL,
  `spXtName` varchar(255) NOT NULL,
  `sfXtName` varchar(255) NOT NULL,
  `smXtName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblimgemp`
--

CREATE TABLE IF NOT EXISTS `tblimgemp` (
  `ImageFile` varchar(255) NOT NULL,
  `empID` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblothers`
--

CREATE TABLE IF NOT EXISTS `tblothers` (
  `empID` int(12) NOT NULL,
  `cSkills` varchar(255) NOT NULL,
  `cNAcad` varchar(255) NOT NULL,
  `cOrg` varchar(255) NOT NULL,
  `cQ36a` varchar(255) NOT NULL,
  `cQ36ad` varchar(255) NOT NULL,
  `cQ36b` varchar(255) NOT NULL,
  `cQ36bd` varchar(255) NOT NULL,
  `cQ37a` varchar(255) NOT NULL,
  `cQ37ad` varchar(255) NOT NULL,
  `cQ37b` varchar(255) NOT NULL,
  `cQ37bd` varchar(255) NOT NULL,
  `cQ38` varchar(255) NOT NULL,
  `cQ38d` varchar(255) NOT NULL,
  `cQ39` varchar(255) NOT NULL,
  `cQ39d` varchar(255) NOT NULL,
  `cQ40` varchar(255) NOT NULL,
  `cQ40d` varchar(255) NOT NULL,
  `cQ41a` varchar(255) NOT NULL,
  `cQ41ad` varchar(255) NOT NULL,
  `cQ41b` varchar(255) NOT NULL,
  `cQ41bd` varchar(255) NOT NULL,
  `cQ41c` varchar(255) NOT NULL,
  `cQ41cd` varchar(255) NOT NULL,
  `cTaxNo` varchar(255) NOT NULL,
  `cIssuedAt` varchar(255) NOT NULL,
  `cIssuedOn` date NOT NULL,
  `cpdf` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblpersonalinfo`
--

CREATE TABLE IF NOT EXISTS `tblpersonalinfo` (
`recID` int(12) NOT NULL,
  `csID` varchar(255) NOT NULL,
  `cSurname` varchar(255) NOT NULL,
  `cFname` varchar(255) NOT NULL,
  `cMname` varchar(255) NOT NULL,
  `cname_ext` varchar(255) NOT NULL,
  `cDOB` date NOT NULL,
  `cSex` varchar(255) NOT NULL,
  `cStatus` varchar(255) NOT NULL,
  `cCship` varchar(255) NOT NULL,
  `cHeight` varchar(255) NOT NULL,
  `cWeight` varchar(255) NOT NULL,
  `cBType` varchar(255) NOT NULL,
  `cGSISID` varchar(255) NOT NULL,
  `cPagibigID` varchar(255) NOT NULL,
  `cPHID` varchar(255) NOT NULL,
  `cSSS` varchar(255) NOT NULL,
  `cResAdd` varchar(255) NOT NULL,
  `cRZCode` varchar(255) NOT NULL,
  `cAdd` varchar(255) NOT NULL,
  `cZCode` varchar(255) NOT NULL,
  `cTelNo` varchar(255) NOT NULL,
  `cEmail` varchar(255) NOT NULL,
  `cCPNo` varchar(255) NOT NULL,
  `cAgencyNo` varchar(255) NOT NULL,
  `cTIN` varchar(255) NOT NULL,
  `cPics` varchar(255) NOT NULL,
  `cDateEncoded` date NOT NULL,
  `cEncodedBy` varchar(255) NOT NULL,
  `sStatus` varchar(255) NOT NULL,
  `cRHouse_no` varchar(255) NOT NULL,
  `cPHouse_no` varchar(255) NOT NULL,
  `cPOB` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tblpersonalinfo`
--

INSERT INTO `tblpersonalinfo` (`recID`, `csID`, `cSurname`, `cFname`, `cMname`, `cname_ext`, `cDOB`, `cSex`, `cStatus`, `cCship`, `cHeight`, `cWeight`, `cBType`, `cGSISID`, `cPagibigID`, `cPHID`, `cSSS`, `cResAdd`, `cRZCode`, `cAdd`, `cZCode`, `cTelNo`, `cEmail`, `cCPNo`, `cAgencyNo`, `cTIN`, `cPics`, `cDateEncoded`, `cEncodedBy`, `sStatus`, `cRHouse_no`, `cPHouse_no`, `cPOB`) VALUES
(6, 'asdasd', 'asd', 'asd', 'sad', 'asdasd', '2017-12-12', 'Male', 'Single', 'Filipino', 'asdasd', 'asdasd', 'asdasd', 'asd', 'asd', 'asd', 'asd', 'asdasd, asdasd, asdasd, asdasd, asdasd', 'asdasdasd', 'asd, asd, sad, asdasd, sd', 'd', 'asd', 'asdasd@asdasd.com', 'asdasd', 'asd', 'asd', 'jpg', '2017-12-12', 'Admin', 'Active', 'asdasd', 'asd', 'asdasd');

-- --------------------------------------------------------

--
-- Table structure for table `tblreferences`
--

CREATE TABLE IF NOT EXISTS `tblreferences` (
  `empID` int(12) NOT NULL,
  `cRName` varchar(255) NOT NULL,
  `cRAddress` varchar(255) NOT NULL,
  `cRTel` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbltrainings`
--

CREATE TABLE IF NOT EXISTS `tbltrainings` (
  `empID` int(12) NOT NULL,
  `cSeminar` varchar(255) NOT NULL,
  `cTDateFrom` varchar(255) NOT NULL,
  `cTDateTo` varchar(255) NOT NULL,
  `cNoHours` varchar(255) NOT NULL,
  `cSponsored` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblvolunteer`
--

CREATE TABLE IF NOT EXISTS `tblvolunteer` (
  `empID` int(12) NOT NULL,
  `cCompany` varchar(255) NOT NULL,
  `cVDateFrom` date NOT NULL,
  `cVDateTo` date NOT NULL,
  `cNoHours` varchar(255) NOT NULL,
  `cVPosition` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblworkexp`
--

CREATE TABLE IF NOT EXISTS `tblworkexp` (
  `empID` int(12) NOT NULL,
  `cWDateFrom` date NOT NULL,
  `cWDateTo` date NOT NULL,
  `cWPosistion` varchar(255) NOT NULL,
  `cDepartment` varchar(255) NOT NULL,
  `cSalary` double NOT NULL,
  `cSalaryGrade` varchar(255) NOT NULL,
  `cAppointment` varchar(255) NOT NULL,
  `cGovt` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
 ADD PRIMARY KEY (`UserName`), ADD KEY `recid` (`recid`);

--
-- Indexes for table `companysetup`
--
ALTER TABLE `companysetup`
 ADD KEY `Index` (`Index`);

--
-- Indexes for table `tblchildren`
--
ALTER TABLE `tblchildren`
 ADD KEY `empID` (`empID`);

--
-- Indexes for table `tblcivilservice`
--
ALTER TABLE `tblcivilservice`
 ADD KEY `empID` (`empID`);

--
-- Indexes for table `tbledubak`
--
ALTER TABLE `tbledubak`
 ADD KEY `empID` (`empID`);

--
-- Indexes for table `tblfambg`
--
ALTER TABLE `tblfambg`
 ADD PRIMARY KEY (`empID`), ADD KEY `empID` (`empID`);

--
-- Indexes for table `tblimgemp`
--
ALTER TABLE `tblimgemp`
 ADD KEY `empID` (`empID`);

--
-- Indexes for table `tblothers`
--
ALTER TABLE `tblothers`
 ADD KEY `empID` (`empID`);

--
-- Indexes for table `tblpersonalinfo`
--
ALTER TABLE `tblpersonalinfo`
 ADD PRIMARY KEY (`csID`), ADD UNIQUE KEY `recID` (`recID`);

--
-- Indexes for table `tblreferences`
--
ALTER TABLE `tblreferences`
 ADD KEY `empID` (`empID`);

--
-- Indexes for table `tbltrainings`
--
ALTER TABLE `tbltrainings`
 ADD KEY `empID` (`empID`);

--
-- Indexes for table `tblvolunteer`
--
ALTER TABLE `tblvolunteer`
 ADD KEY `empID` (`empID`);

--
-- Indexes for table `tblworkexp`
--
ALTER TABLE `tblworkexp`
 ADD KEY `empID` (`empID`), ADD KEY `empID_2` (`empID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblpersonalinfo`
--
ALTER TABLE `tblpersonalinfo`
MODIFY `recID` int(12) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
ADD CONSTRAINT `consAccPI` FOREIGN KEY (`recid`) REFERENCES `tblpersonalinfo` (`recID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblchildren`
--
ALTER TABLE `tblchildren`
ADD CONSTRAINT `consChildPI` FOREIGN KEY (`empID`) REFERENCES `tblpersonalinfo` (`recID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblcivilservice`
--
ALTER TABLE `tblcivilservice`
ADD CONSTRAINT `consCVLPI` FOREIGN KEY (`empID`) REFERENCES `tblpersonalinfo` (`recID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbledubak`
--
ALTER TABLE `tbledubak`
ADD CONSTRAINT `consEducBakPI` FOREIGN KEY (`empID`) REFERENCES `tblpersonalinfo` (`recID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblfambg`
--
ALTER TABLE `tblfambg`
ADD CONSTRAINT `consFambgPI` FOREIGN KEY (`empID`) REFERENCES `tblpersonalinfo` (`recID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblimgemp`
--
ALTER TABLE `tblimgemp`
ADD CONSTRAINT `consImgPI` FOREIGN KEY (`empID`) REFERENCES `tblpersonalinfo` (`recID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblothers`
--
ALTER TABLE `tblothers`
ADD CONSTRAINT `consOtPI` FOREIGN KEY (`empID`) REFERENCES `tblpersonalinfo` (`recID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblreferences`
--
ALTER TABLE `tblreferences`
ADD CONSTRAINT `consReferPI` FOREIGN KEY (`empID`) REFERENCES `tblpersonalinfo` (`recID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbltrainings`
--
ALTER TABLE `tbltrainings`
ADD CONSTRAINT `consTrainPI` FOREIGN KEY (`empID`) REFERENCES `tblpersonalinfo` (`recID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblvolunteer`
--
ALTER TABLE `tblvolunteer`
ADD CONSTRAINT `consVolPI` FOREIGN KEY (`empID`) REFERENCES `tblpersonalinfo` (`recID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblworkexp`
--
ALTER TABLE `tblworkexp`
ADD CONSTRAINT `consWorkExpPI` FOREIGN KEY (`empID`) REFERENCES `tblpersonalinfo` (`recID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
