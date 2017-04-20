-- MySQL dump 10.13  Distrib 5.5.53, for debian-linux-gnu (x86_64)
-- ------------------------------------------------------
-- Server version	5.5.53-0ubuntu0.14.04.1

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
-- Table structure for table `asiakas`
--

DROP TABLE IF EXISTS `asiakas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asiakas` (
  `asiakasID` int(11) NOT NULL AUTO_INCREMENT,
  `etunimi` tinytext NOT NULL,
  `sukunimi` tinytext NOT NULL,
  `lahiosoite` tinytext NOT NULL,
  `postinumero` text NOT NULL,
  `postitoimipaikka` tinytext NOT NULL,
  `puhelinnumero` text NOT NULL,
  `sposti` tinytext NOT NULL,
  PRIMARY KEY (`asiakasID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asiakas`
--

LOCK TABLES `asiakas` WRITE;
/*!40000 ALTER TABLE `asiakas` DISABLE KEYS */;
/*!40000 ALTER TABLE `asiakas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `erikoisala`
--

DROP TABLE IF EXISTS `erikoisala`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `erikoisala` (
  `erikoisalaID` int(11) NOT NULL AUTO_INCREMENT,
  `erikoisalaseloste` text NOT NULL,
  PRIMARY KEY (`erikoisalaID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `erikoisala`
--

LOCK TABLES `erikoisala` WRITE;
/*!40000 ALTER TABLE `erikoisala` DISABLE KEYS */;
/*!40000 ALTER TABLE `erikoisala` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kalenteri`
--

DROP TABLE IF EXISTS `kalenteri`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kalenteri` (
  `varausID` int(11) NOT NULL AUTO_INCREMENT,
  `laakariID` int(11) NOT NULL,
  `pvm` date NOT NULL,
  `klo` time NOT NULL,
  `asiakasID` int(11) NOT NULL,
  `viesti` text,
  PRIMARY KEY (`varausID`)
) ENGINE=InnoDB AUTO_INCREMENT=2238 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kalenteri`
--

LOCK TABLES `kalenteri` WRITE;
/*!40000 ALTER TABLE `kalenteri` DISABLE KEYS */;
/*!40000 ALTER TABLE `kalenteri` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `laakari`
--

DROP TABLE IF EXISTS `laakari`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `laakari` (
  `laakariID` int(11) NOT NULL AUTO_INCREMENT,
  `etunimi` text NOT NULL,
  `sukunimi` text NOT NULL,
  `puhelin` text NOT NULL,
  `erikoisalaID` int(11) NOT NULL,
  `sahkoposti` text NOT NULL,
  `toimipisteID` int(11) NOT NULL,
  PRIMARY KEY (`laakariID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `laakari`
--

LOCK TABLES `laakari` WRITE;
/*!40000 ALTER TABLE `laakari` DISABLE KEYS */;
/*!40000 ALTER TABLE `laakari` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sairauskertomus`
--

DROP TABLE IF EXISTS `sairauskertomus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sairauskertomus` (
  `kertomusID` int(11) NOT NULL AUTO_INCREMENT,
  `asiakasID` int(11) NOT NULL,
  `laakariID` int(11) NOT NULL,
  `pvm` date NOT NULL,
  `sairauskertomus` text NOT NULL,
  PRIMARY KEY (`kertomusID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sairauskertomus`
--

LOCK TABLES `sairauskertomus` WRITE;
/*!40000 ALTER TABLE `sairauskertomus` DISABLE KEYS */;
/*!40000 ALTER TABLE `sairauskertomus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `toimipiste`
--

DROP TABLE IF EXISTS `toimipiste`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `toimipiste` (
  `toimipisteID` int(11) NOT NULL AUTO_INCREMENT,
  `toimipistenimi` text NOT NULL,
  `lahiosoite` text NOT NULL,
  `postinumero` int(11) NOT NULL,
  `postitoimipaikka` text NOT NULL,
  PRIMARY KEY (`toimipisteID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `toimipiste`
--

LOCK TABLES `toimipiste` WRITE;
/*!40000 ALTER TABLE `toimipiste` DISABLE KEYS */;
INSERT INTO `toimipiste` VALUES (1,'Lappeenranta','Lappeenrannan keskussairaala',53500,'Lappeenranta'),(2,'Taipalsaari','Saimaanharjun sairaala',54920,'Saimaanharju');
/*!40000 ALTER TABLE `toimipiste` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-04-18 12:02:29
