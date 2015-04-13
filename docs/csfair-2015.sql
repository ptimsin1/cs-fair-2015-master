-- MySQL dump 10.13  Distrib 5.1.73, for redhat-linux-gnu (x86_64)
--
-- Host: webdb.uvm.edu    Database: CSFAIR_2015
-- ------------------------------------------------------
-- Server version	5.5.41-37.0-log

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
-- Table structure for table `tblAdmin`
--

DROP TABLE IF EXISTS `tblAdmin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblAdmin` (
  `pkUsername` varchar(10) NOT NULL,
  PRIMARY KEY (`pkUsername`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblAdmin`
--

LOCK TABLES `tblAdmin` WRITE;
/*!40000 ALTER TABLE `tblAdmin` DISABLE KEYS */;
INSERT INTO `tblAdmin` VALUES ('csfair'),('meppstei'),('rerickso');
/*!40000 ALTER TABLE `tblAdmin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblConflict`
--

DROP TABLE IF EXISTS `tblConflict`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblConflict` (
  `pkConflictId` int(11) NOT NULL AUTO_INCREMENT,
  `fldTimeConflict` varchar(25) NOT NULL,
  `fldDisplayOrder` int(11) NOT NULL,
  PRIMARY KEY (`pkConflictId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblConflict`
--

LOCK TABLES `tblConflict` WRITE;
/*!40000 ALTER TABLE `tblConflict` DISABLE KEYS */;
INSERT INTO `tblConflict` VALUES (1,'12:50 pm to 1:40 pm',0),(2,'1:55 pm to 2:45 pm',1),(3,'3:00 pm to 3:50 pm',2);
/*!40000 ALTER TABLE `tblConflict` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblJudge`
--

DROP TABLE IF EXISTS `tblJudge`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblJudge` (
  `pkJudgeId` int(11) NOT NULL AUTO_INCREMENT,
  `fkSponsorId` int(11) NOT NULL,
  `fldTypeofJudge` varchar(255) NOT NULL,
  `fldJudgeCode` varchar(20) NOT NULL,
  `fldFirstName` varchar(15) DEFAULT NULL,
  `fldLastName` varchar(15) DEFAULT NULL,
  `fldEmail` varchar(255) NOT NULL,
  `fldImageName` varchar(255) NOT NULL DEFAULT '',
  `fldJobTitle` varchar(255) NOT NULL,
  `fldBio` mediumtext NOT NULL,
  `fldApproved` int(11) NOT NULL,
  PRIMARY KEY (`pkJudgeId`)
) ENGINE=MyISAM AUTO_INCREMENT=87 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblJudge`
--

LOCK TABLES `tblJudge` WRITE;
/*!40000 ALTER TABLE `tblJudge` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblJudge` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblProject`
--

DROP TABLE IF EXISTS `tblProject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblProject` (
  `pkProjectID` int(3) NOT NULL AUTO_INCREMENT,
  `fldQrCode` int(11) NOT NULL,
  `fldProjectName` varchar(255) DEFAULT NULL,
  `fldProjectSite` varchar(255) DEFAULT NULL,
  `fldGroupSize` int(11) NOT NULL,
  `fldProjectDesc` text,
  `fldProjectCourses` tinytext NOT NULL,
  `fldCategory` varchar(30) NOT NULL,
  `fldProjectImageURL` varchar(255) DEFAULT NULL,
  `fldProjectBoothNum` int(11) NOT NULL,
  `fldBoothSide` varchar(5) NOT NULL,
  `fldFullPresent` tinyint(1) NOT NULL DEFAULT '0',
  `fldPresentationTimeSlot` timestamp NOT NULL DEFAULT '2013-12-05 13:00:00',
  `fldProjectNotes` varchar(255) DEFAULT NULL,
  `fldConfirmed` int(1) NOT NULL DEFAULT '0',
  `fldDateSubmitted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fldDateUpdated` datetime NOT NULL,
  `fldAttemptedConfirms` int(11) NOT NULL DEFAULT '0',
  `fldApproved` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pkProjectID`)
) ENGINE=InnoDB AUTO_INCREMENT=309 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblProject`
--

LOCK TABLES `tblProject` WRITE;
/*!40000 ALTER TABLE `tblProject` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblProject` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblProjectConflict`
--

DROP TABLE IF EXISTS `tblProjectConflict`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblProjectConflict` (
  `fkProjectId` int(11) NOT NULL DEFAULT '0',
  `fkConflictId` int(11) NOT NULL,
  PRIMARY KEY (`fkProjectId`,`fkConflictId`),
  KEY `fkConflictId` (`fkConflictId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblProjectConflict`
--

LOCK TABLES `tblProjectConflict` WRITE;
/*!40000 ALTER TABLE `tblProjectConflict` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblProjectConflict` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblSponsor`
--

DROP TABLE IF EXISTS `tblSponsor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblSponsor` (
  `pkSponsorID` int(11) NOT NULL AUTO_INCREMENT,
  `fldCompanyName` varchar(255) DEFAULT NULL,
  `fldCompanySite` varchar(255) DEFAULT NULL,
  `fldCompanyLogo` varchar(255) NOT NULL,
  `fldContactName` varchar(255) DEFAULT NULL,
  `fldContactEmail` varchar(255) DEFAULT NULL,
  `fldContactPhone` varchar(20) DEFAULT NULL,
  `fldSponsorLevel` varchar(20) DEFAULT NULL,
  `fldSponsorAmount` int(20) DEFAULT NULL,
  `fldBoothPerson` varchar(255) NOT NULL,
  `fldItemDonations` tinytext NOT NULL,
  `fldSponsorBoothNum` int(11) DEFAULT NULL,
  `fldSponsorNotes` text,
  `fldConfirmed` int(1) NOT NULL DEFAULT '0',
  `fldDateSubmitted` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fldAttemptedConfirms` int(11) NOT NULL DEFAULT '0',
  `fldApproved` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pkSponsorID`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblSponsor`
--

LOCK TABLES `tblSponsor` WRITE;
/*!40000 ALTER TABLE `tblSponsor` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblSponsor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblStudent`
--

DROP TABLE IF EXISTS `tblStudent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblStudent` (
  `pkUsername` varchar(10) NOT NULL,
  `fldFirstName` varchar(15) DEFAULT NULL,
  `fldLastName` varchar(15) DEFAULT NULL,
  `fldTshirtSize` varchar(2) NOT NULL DEFAULT 'M',
  `fldPresented` tinyint(1) NOT NULL DEFAULT '1',
  `fldTShirtPickedUp` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pkUsername`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblStudent`
--

LOCK TABLES `tblStudent` WRITE;
/*!40000 ALTER TABLE `tblStudent` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblStudent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblStudentProject`
--

DROP TABLE IF EXISTS `tblStudentProject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblStudentProject` (
  `fkProjectId` varchar(10) NOT NULL DEFAULT '',
  `fkUVMId` varchar(15) NOT NULL DEFAULT '',
  `fldOrder` tinyint(4) NOT NULL,
  PRIMARY KEY (`fkProjectId`,`fkUVMId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblStudentProject`
--

LOCK TABLES `tblStudentProject` WRITE;
/*!40000 ALTER TABLE `tblStudentProject` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblStudentProject` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblTimeSlot`
--

DROP TABLE IF EXISTS `tblTimeSlot`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblTimeSlot` (
  `pkTimeSlotId` int(11) NOT NULL AUTO_INCREMENT,
  `fldTime` varchar(25) NOT NULL,
  `fldDisplayOrder` int(11) NOT NULL,
  PRIMARY KEY (`pkTimeSlotId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblTimeSlot`
--

LOCK TABLES `tblTimeSlot` WRITE;
/*!40000 ALTER TABLE `tblTimeSlot` DISABLE KEYS */;
INSERT INTO `tblTimeSlot` VALUES (1,'12:50 pm to 1:40 pm',0),(2,'1:55 pm to 2:45 pm',1),(3,'3:00 pm to 3:50 pm',2);
/*!40000 ALTER TABLE `tblTimeSlot` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tblVotes`
--

DROP TABLE IF EXISTS `tblVotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tblVotes` (
  `fkUVMId` varchar(15) NOT NULL DEFAULT '',
  `fkProjectId` varchar(10) NOT NULL DEFAULT '',
  `fldType` varchar(10) NOT NULL,
  `fldDateSubmitted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`fkUVMId`,`fkProjectId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tblVotes`
--

LOCK TABLES `tblVotes` WRITE;
/*!40000 ALTER TABLE `tblVotes` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblVotes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-02-07 12:36:54
