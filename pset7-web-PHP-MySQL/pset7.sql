-- MySQL dump 10.13  Distrib 5.5.44, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: pset7
-- ------------------------------------------------------
-- Server version	5.5.44-0ubuntu0.14.04.1-log

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
-- Table structure for table `History`
--

DROP TABLE IF EXISTS `History`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `History` (
  `id` int(10) unsigned NOT NULL,
  `datetime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `transaction` varchar(5) CHARACTER SET ascii NOT NULL,
  `symbol` varchar(255) CHARACTER SET ascii NOT NULL,
  `shares` int(10) unsigned NOT NULL,
  `price` decimal(65,4) unsigned NOT NULL,
  `total` decimal(65,4) unsigned NOT NULL,
  PRIMARY KEY (`id`,`datetime`),
  KEY `datetime` (`datetime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `History`
--

LOCK TABLES `History` WRITE;
/*!40000 ALTER TABLE `History` DISABLE KEYS */;
INSERT INTO `History` VALUES (13,'07/24/15 11:52:15 PM','BUY','goog',1,623.5600,623.5600),(13,'07/24/15 11:54:27 PM','BUY','aapl',1,124.5000,124.5000),(13,'07/24/15 11:55:57 PM','BUY','FREE',2,1.3600,2.7200),(13,'07/25/15 1:36:34 AM','BUY','FREE',1,1.3600,1.3600),(13,'07/25/15 1:37:14 AM','BUY','FREE',1,1.3600,1.3600),(13,'07/25/15 1:38:12 AM','BUY','FREE',1,1.3600,1.3600),(13,'07/25/15 1:39:10 AM','BUY','FREE',1,1.3600,1.3600),(13,'07/25/15 1:39:45 AM','BUY','FREE',1,1.3600,1.3600),(13,'07/25/15 1:42:22 AM','BUY','FREE',1,1.3600,1.3600),(13,'07/25/15 1:44:27 AM','BUY','FREE',1,1.3600,1.3600),(13,'07/25/15 1:45:11 AM','BUY','FREE',1,1.3600,1.3600),(13,'07/25/15 1:46:09 AM','BUY','FREE',1,1.3600,1.3600),(13,'07/25/15 1:47:21 AM','BUY','FREE',1,1.3600,1.3600),(13,'07/25/15 1:47:43 AM','BUY','FREE',1,1.3600,1.3600),(13,'07/25/15 12:01:57 AM','SELL','FREE',27,1.3600,36.7200),(13,'07/25/15 12:27:26 AM','BUY','S',20,3.4400,68.8000),(13,'07/25/15 2:01:43 AM','BUY','FREE',1,1.3600,1.3600),(13,'07/25/15 2:07:05 AM','BUY','AAPL',10,124.5000,1245.0000),(13,'07/25/15 2:10:09 AM','BUY','AAPL',1,124.5000,124.5000),(15,'07/25/15 2:30:21 PM','BUY','FREE',1,1.2000,1.2000),(15,'07/25/15 2:37:45 PM','BUY','FREE',1,1.2000,1.2000),(15,'07/25/15 2:38:52 PM','BUY','GOOG',1,627.6000,627.6000),(15,'07/25/15 2:42:36 PM','BUY','AAPL',1,122.7300,122.7300),(15,'07/25/15 2:44:51 PM','BUY','FB',1,94.1850,94.1850),(15,'07/25/15 3:05:20 PM','BUY','FREE',1,1.2000,1.2000),(15,'07/25/15 3:08:33 PM','BUY','FREE',1,1.2000,1.2000),(15,'07/25/15 3:10:10 PM','BUY','FREE',1,1.2000,1.2000),(15,'07/25/15 3:10:48 PM','BUY','FREE',1,1.2000,1.2000),(15,'07/25/15 3:11:09 PM','BUY','FREE',1,1.2000,1.2000),(15,'07/25/15 3:11:15 PM','BUY','FREE',1,1.2000,1.2000),(15,'07/25/15 3:12:01 PM','BUY','FREE',1,1.2000,1.2000),(15,'07/25/15 3:12:27 PM','BUY','FREE',1,1.2000,1.2000),(15,'07/25/15 3:12:57 PM','BUY','FREE',1,1.2000,1.2000),(15,'07/25/15 3:13:35 PM','BUY','S',1,3.1000,3.1000),(15,'07/25/15 3:15:39 PM','BUY','YHOO',1,37.8300,37.8300),(15,'07/25/15 3:26:25 PM','BUY','SBUX',1,56.9350,56.9350),(15,'07/25/15 3:28:01 PM','BUY','FREE',1,1.2000,1.2000),(15,'07/25/15 3:49:39 PM','BUY','FREE',1,1.2000,1.2000),(15,'07/25/15 3:53:12 PM','BUY','S',1,3.1000,3.1000),(15,'07/25/15 4:12:24 PM','BUY','S',1,3.1000,3.1000),(15,'07/26/15 10:00:06 AM','BUY','FREE',1,1.1100,1.1100),(15,'07/26/15 10:00:45 AM','BUY','FREE',1,1.1100,1.1100),(15,'07/26/15 10:03:07 AM','BUY','FREE',1,1.1100,1.1100),(15,'07/26/15 10:03:12 AM','BUY','FREE',1,1.1100,1.1100),(15,'07/26/15 10:03:41 AM','BUY','FREE',1,1.1100,1.1100),(15,'07/26/15 10:07:23 AM','BUY','FREE',1,1.1100,1.1100),(15,'07/26/15 10:07:29 AM','BUY','FREE',1,1.1100,1.1100),(15,'07/26/15 10:08:30 AM','BUY','FREE',1,1.1100,1.1100),(15,'07/26/15 10:08:57 AM','BUY','FREE',1,1.1100,1.1100),(15,'07/26/15 10:09:11 AM','BUY','FREE',1,1.1100,1.1100),(15,'07/26/15 10:09:28 AM','BUY','FREE',1,1.1100,1.1100),(15,'07/26/15 10:10:53 AM','BUY','FREE',1,1.1100,1.1100),(15,'07/26/15 10:12:14 AM','BUY','FREE',1,1.1100,1.1100),(15,'07/26/15 10:13:22 AM','BUY','FREE',1,1.1100,1.1100),(15,'07/26/15 10:14:29 AM','BUY','FREE',1,1.1100,1.1100),(15,'07/26/15 10:17:05 AM','BUY','FREE',1,1.1100,1.1100),(15,'07/26/15 10:19:03 AM','BUY','FREE',1,1.1100,1.1100),(15,'07/26/15 10:20:45 AM','BUY','FREE',1,1.1100,1.1100),(15,'07/26/15 10:25:10 AM','BUY','S',1,3.4800,3.4800),(15,'07/26/15 10:27:17 AM','BUY','S',1,3.4800,3.4800),(15,'07/26/15 10:33:46 AM','SELL','GOOG',1,631.9300,631.9300),(15,'07/26/15 10:46:05 AM','BUY','AAPL',1,122.9900,122.9900),(15,'07/26/15 10:57:10 AM','BUY','AAPL',1,122.9900,122.9900),(15,'07/26/15 11:06:49 AM','BUY','FREE',1,1.1100,1.1100),(15,'07/26/15 11:08:12 AM','BUY','FREE',1,1.1100,1.1100),(15,'07/26/15 5:57:27 AM','BUY','S',1,3.5250,3.5250),(15,'07/26/15 5:58:25 AM','BUY','S',1,3.5250,3.5250),(15,'07/26/15 6:00:32 AM','BUY','FREE',1,1.1099,1.1099),(15,'07/26/15 6:01:14 AM','BUY','FREE',1,1.1099,1.1099),(15,'07/26/15 6:18:15 AM','BUY','FREE',1,1.1100,1.1100),(15,'07/26/15 8:20:49 AM','BUY','FREE',1,1.1100,1.1100),(15,'07/26/15 9:54:19 AM','BUY','FREE',1,1.1100,1.1100),(15,'07/26/15 9:55:55 AM','BUY','FREE',1,1.1100,1.1100),(15,'07/26/15 9:56:28 AM','BUY','FREE',1,1.1100,1.1100),(15,'07/26/15 9:57:08 AM','BUY','FREE',1,1.1100,1.1100),(15,'07/26/15 9:57:33 AM','BUY','FREE',1,1.1100,1.1100),(15,'07/26/15 9:58:08 AM','BUY','FREE',1,1.1100,1.1100),(15,'07/26/15 9:58:13 AM','BUY','FREE',1,1.1100,1.1100),(15,'07/26/15 9:58:47 AM','BUY','FREE',1,1.1100,1.1100),(15,'08/02/15 3:04:16 PM','SELL','S',7,3.3700,23.5900),(15,'08/02/15 3:46:34 PM','BUY','S',1,3.3700,3.3700),(15,'08/02/15 3:46:47 PM','BUY','S',1,3.3700,3.3700),(15,'08/02/15 3:48:33 PM','SELL','AAPL',3,121.3000,363.9000);
/*!40000 ALTER TABLE `History` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Portfolio`
--

DROP TABLE IF EXISTS `Portfolio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Portfolio` (
  `id` int(10) unsigned NOT NULL,
  `symbol` varchar(255) CHARACTER SET ascii NOT NULL,
  `shares` int(10) NOT NULL,
  PRIMARY KEY (`id`,`symbol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Portfolio`
--

LOCK TABLES `Portfolio` WRITE;
/*!40000 ALTER TABLE `Portfolio` DISABLE KEYS */;
INSERT INTO `Portfolio` VALUES (0,'FREE',10),(1,'free',1),(1,'goog',1),(2,'goog',1),(3,'goog',1),(4,'goog',1),(5,'goog',1),(6,'goog',1),(7,'goog',1),(13,'AAPL',17),(13,'FB',1),(13,'FREE',12),(13,'GOOG',6),(13,'S',20),(15,'FB',1),(15,'FREE',45),(15,'S',2),(15,'SBUX',1),(15,'YHOO',1);
/*!40000 ALTER TABLE `Portfolio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cash` decimal(65,4) unsigned NOT NULL DEFAULT '0.0000',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'belindazeng','belindanotreally@harvard.edu','$1$50$oxJEDBo9KDStnrhtnSzir0',10000.0000),(2,'caesar','caesarnotreally@harvard.edu','$1$50$GHABNWBNE/o4VL7QjmQ6x0',10000.0000),(3,'jharvard','jharvardnotreally@harvard.edu','$1$50$RX3wnAMNrGIbgzbRYrxM1/',10000.0000),(4,'malan','malannotreally@harvard.edu','$1$50$lJS9HiGK6sphej8c4bnbX.',10000.0000),(5,'rob','robnotreally@harvard.edu','$1$HA$l5llES7AEaz8ndmSo5Ig41',10000.0000),(6,'skroob','skroobnotreally@harvard.edu','$1$50$euBi4ugiJmbpIbvTTfmfI.',10000.0000),(7,'zamyla','zamylanotreally@harvard.edu','$1$50$uwfqB45ANW.9.6qaQ.DcF.',10000.0000),(15,'makary','makarymalinouski@gmail.com','$1$0DgOwKL4$eQpSVQztg6qcZUmFyYIe7/',9752.9902);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-08-02 15:54:28
