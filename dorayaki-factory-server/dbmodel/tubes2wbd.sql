-- MySQL dump 10.13  Distrib 8.0.26, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: test
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.21-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bahan_baku`
--

DROP TABLE IF EXISTS `bahan_baku`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bahan_baku` (
  `nama_bahan_baku` varchar(255) NOT NULL,
  `stok` int(11) DEFAULT 0,
  PRIMARY KEY (`nama_bahan_baku`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bahan_baku`
--

LOCK TABLES `bahan_baku` WRITE;
/*!40000 ALTER TABLE `bahan_baku` DISABLE KEYS */;
INSERT INTO `bahan_baku` VALUES ('anggur',10),('gula',10),('gula_aren',10),('tepung',10);
/*!40000 ALTER TABLE `bahan_baku` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_request`
--

DROP TABLE IF EXISTS `log_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `log_request` (
  `id_log_request` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) NOT NULL,
  `endpoint` varchar(255) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_log_request`)
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_request`
--

LOCK TABLES `log_request` WRITE;
/*!40000 ALTER TABLE `log_request` DISABLE KEYS */;
INSERT INTO `log_request` VALUES (1,'127.0.0.1','/request','2021-11-24 15:00:15'),(2,'127.0.0.1','/request','2021-11-25 23:12:24'),(3,'127.0.0.1','/request','2021-11-25 23:13:21'),(4,'127.0.0.1','/request','2021-11-25 23:55:49'),(5,'127.0.0.1','/request','2021-11-26 00:10:37'),(6,'127.0.0.1','/request','2021-11-26 00:44:07'),(7,'127.0.0.1','/request','2021-11-26 00:56:00'),(8,'127.0.0.1','/request','2021-11-26 00:57:36'),(9,'127.0.0.1','/request','2021-11-26 00:58:09'),(10,'127.0.0.1','/request','2021-11-26 00:58:26'),(11,'127.0.0.1','/request','2021-11-26 00:59:43'),(12,'127.0.0.1','/request','2021-11-26 01:00:04'),(13,'127.0.0.1','/request','2021-11-26 01:02:09'),(14,'127.0.0.1','/request','2021-11-26 01:02:19'),(15,'127.0.0.1','/request','2021-11-26 01:06:09'),(16,'127.0.0.1','/request','2021-11-26 02:34:33'),(17,'','request/check','2021-11-26 06:56:48'),(18,'','request/check','2021-11-26 06:57:40'),(19,'','request/check','2021-11-26 06:58:01'),(20,'','request/check','2021-11-26 07:01:25'),(21,'','request/check','2021-11-26 07:01:50'),(22,'','request/check','2021-11-26 07:02:23'),(23,'','request/check','2021-11-26 07:02:38'),(24,'','request/check','2021-11-26 07:03:59'),(25,'','request/check','2021-11-26 07:04:15'),(26,'','request/check','2021-11-26 07:05:41'),(27,'','request/check','2021-11-26 07:05:45'),(28,'','request/check','2021-11-26 07:05:49'),(29,'','request/check','2021-11-26 07:06:53'),(30,'','request/check','2021-11-26 07:06:55'),(31,'','request/check','2021-11-26 07:07:56'),(32,'','request/check','2021-11-26 07:08:08'),(33,'','request/check','2021-11-26 07:08:21'),(34,'','request/check','2021-11-26 07:08:54'),(35,'','request/check','2021-11-26 07:08:57'),(36,'','request/check','2021-11-26 07:09:06'),(37,'','request/check','2021-11-26 07:09:09'),(38,'','request/check','2021-11-26 07:09:39'),(39,'','request/check','2021-11-26 07:09:46'),(40,'','request/check','2021-11-26 07:10:13'),(41,'','request/check','2021-11-26 07:10:37'),(42,'','request/check','2021-11-26 07:10:41'),(43,'','request/check','2021-11-26 07:10:45'),(44,'','request/check','2021-11-26 07:11:02'),(45,'','request/check','2021-11-26 07:11:21'),(46,'','request/check','2021-11-26 07:11:41'),(47,'','request/check','2021-11-26 07:18:39'),(48,'','request/check','2021-11-26 07:20:39'),(49,'','request/check','2021-11-26 07:20:45'),(50,'','request/check','2021-11-26 07:20:49'),(51,'','request/check','2021-11-26 07:20:53'),(52,'','request/check','2021-11-26 07:20:56'),(53,'','request/check','2021-11-26 07:20:59'),(54,'','request/check','2021-11-26 07:21:02'),(55,'','request/check','2021-11-26 07:21:05'),(56,'','request/check','2021-11-26 07:21:08'),(57,'','request/check','2021-11-26 07:21:11'),(58,'127.0.0.1','request/check','2021-11-26 07:23:51'),(59,'127.0.0.1','request/check','2021-11-26 07:24:14'),(60,'127.0.0.1','request/check','2021-11-26 07:25:09'),(61,'127.0.0.1','request/check','2021-11-26 07:25:48'),(62,'127.0.0.1','request/check','2021-11-26 07:27:23'),(63,'127.0.0.1','request/check','2021-11-26 07:37:26'),(64,'127.0.0.1','request/check','2021-11-26 07:40:47'),(65,'127.0.0.1','request/check','2021-11-26 07:42:52'),(66,'127.0.0.1','request/check','2021-11-26 07:43:49'),(67,'127.0.0.1','request/check','2021-11-26 07:45:45'),(68,'127.0.0.1','request/check','2021-11-26 07:46:01'),(69,'127.0.0.1','request/check','2021-11-26 07:46:11'),(70,'127.0.0.1','request/check','2021-11-26 07:46:36'),(71,'127.0.0.1','request/check','2021-11-26 07:47:10'),(72,'127.0.0.1','request/check','2021-11-26 07:47:32'),(73,'127.0.0.1','request/check','2021-11-26 07:48:22'),(74,'127.0.0.1','request/check','2021-11-26 07:48:53'),(75,'127.0.0.1','request/check','2021-11-26 07:49:28'),(76,'127.0.0.1','request/check','2021-11-26 07:50:39'),(77,'127.0.0.1','request/check','2021-11-26 07:51:04'),(78,'127.0.0.1','request/check','2021-11-26 07:51:41'),(79,'127.0.0.1','request/check','2021-11-26 07:51:55'),(80,'127.0.0.1','request/check','2021-11-26 07:52:19'),(81,'127.0.0.1','request/check','2021-11-26 07:53:27'),(82,'127.0.0.1','request/check','2021-11-26 07:53:54'),(83,'127.0.0.1','request/check','2021-11-26 07:54:12'),(84,'127.0.0.1','request/check','2021-11-26 07:54:45'),(85,'127.0.0.1','request/check','2021-11-26 07:55:44'),(86,'127.0.0.1','request/check','2021-11-26 07:56:06'),(87,'127.0.0.1','request/check','2021-11-26 07:56:58'),(88,'127.0.0.1','request/check','2021-11-26 08:01:07'),(89,'127.0.0.1','request/check','2021-11-26 08:03:04'),(90,'127.0.0.1','request/check','2021-11-26 08:03:33'),(91,'127.0.0.1','request/check','2021-11-26 08:04:46'),(92,'127.0.0.1','request/check','2021-11-26 08:12:44'),(93,'127.0.0.1','request/check','2021-11-26 08:13:05'),(94,'127.0.0.1','request/check','2021-11-26 08:14:50'),(95,'127.0.0.1','request/check','2021-11-26 08:17:38'),(96,'127.0.0.1','request/check','2021-11-26 08:18:55'),(97,'127.0.0.1','request/check','2021-11-26 08:19:41'),(98,'127.0.0.1','request/check','2021-11-26 08:20:08'),(99,'127.0.0.1','request/check','2021-11-26 08:22:14'),(100,'127.0.0.1','request/check','2021-11-26 08:23:46'),(101,'127.0.0.1','request/check','2021-11-26 08:25:19'),(102,'127.0.0.1','request/check','2021-11-26 08:25:54'),(103,'127.0.0.1','request/check','2021-11-26 08:26:34'),(104,'127.0.0.1','request/check','2021-11-26 08:31:02'),(105,'127.0.0.1','request/check','2021-11-26 08:31:59'),(106,'127.0.0.1','request/check','2021-11-26 08:34:20'),(107,'127.0.0.1','request/check','2021-11-26 08:36:43'),(108,'127.0.0.1','request/check','2021-11-26 08:36:51'),(109,'127.0.0.1','request/check','2021-11-26 08:37:03'),(110,'127.0.0.1','request/check','2021-11-26 08:38:12'),(111,'127.0.0.1','request/check','2021-11-26 08:46:04'),(112,'127.0.0.1','request/check','2021-11-26 08:54:13'),(113,'127.0.0.1','request/check','2021-11-26 09:01:10'),(114,'127.0.0.1','request/check','2021-11-26 09:20:15'),(115,'127.0.0.1','request/check','2021-11-26 09:20:50'),(116,'127.0.0.1','request/check','2021-11-26 09:22:32'),(117,'127.0.0.1','request/check','2021-11-26 09:22:40'),(118,'127.0.0.1','request/update','2021-11-26 09:22:46'),(119,'127.0.0.1','request/check','2021-11-26 09:34:06'),(120,'127.0.0.1','request/check','2021-11-26 09:34:15'),(121,'127.0.0.1','request/update','2021-11-26 09:34:22'),(122,'127.0.0.1','request/check','2021-11-26 09:49:57'),(123,'127.0.0.1','request/check','2021-11-26 09:50:08'),(124,'127.0.0.1','request/update','2021-11-26 09:50:14'),(125,'127.0.0.1','request/check','2021-11-26 09:51:30'),(126,'127.0.0.1','request/check','2021-11-26 09:53:29'),(127,'127.0.0.1','request/check','2021-11-26 09:53:45'),(128,'127.0.0.1','request/check','2021-11-26 09:54:11'),(129,'127.0.0.1','request/update','2021-11-26 09:54:17'),(130,'127.0.0.1','request/check','2021-11-26 09:54:45'),(131,'127.0.0.1','request/check','2021-11-26 09:56:08');
/*!40000 ALTER TABLE `log_request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `request`
--

DROP TABLE IF EXISTS `request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `request` (
  `id_request` int(11) NOT NULL AUTO_INCREMENT,
  `nama_dorayaki` varchar(255) NOT NULL,
  `jumlah_stok` int(11) NOT NULL,
  `waktu_request` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0,
  `read_by_store` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_request`),
  KEY `nama_dorayaki` (`nama_dorayaki`),
  CONSTRAINT `request_ibfk_1` FOREIGN KEY (`nama_dorayaki`) REFERENCES `resep` (`nama_dorayaki`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request`
--

LOCK TABLES `request` WRITE;
/*!40000 ALTER TABLE `request` DISABLE KEYS */;
INSERT INTO `request` VALUES (1,'Dorayaki 1',10,'2021-11-24 14:30:44',1,1),(2,'Dorayaki 1',15,'2021-11-24 14:50:39',1,1),(3,'Dorayaki 4',2,'2021-11-25 23:12:24',1,1),(5,'Dorayaki 4',1,'2021-11-25 23:55:49',2,1),(6,'Dorayaki 4',2,'2021-11-26 00:10:37',2,1),(13,'Dorayaki 4',2,'2021-11-26 01:00:04',0,0),(14,'Dorayaki 4',2,'2021-11-26 01:02:09',0,0),(22,'Dorayaki 4',1,'2021-11-26 02:34:33',0,0);
/*!40000 ALTER TABLE `request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resep`
--

DROP TABLE IF EXISTS `resep`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `resep` (
  `nama_dorayaki` varchar(255) NOT NULL,
  `nama_bahan_baku` varchar(255) NOT NULL,
  `jumlah_bahan_baku` int(11) DEFAULT NULL,
  PRIMARY KEY (`nama_dorayaki`,`nama_bahan_baku`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resep`
--

LOCK TABLES `resep` WRITE;
/*!40000 ALTER TABLE `resep` DISABLE KEYS */;
INSERT INTO `resep` VALUES ('Dorayaki 1','gula',2),('Dorayaki 1','gula_aren',2),('Dorayaki 1','tepung',2),('Dorayaki 2','gula',1),('Dorayaki 2','tepung',1),('Dorayaki 3','anggur',2),('Dorayaki 3','gula',2),('Dorayaki 4','tepung',3),('Dorayaki 5','anggur',2),('Dorayaki 5','tepung',2),('Dorayaki 6','anggur',2),('Dorayaki 6','tepung',2),('Dorayaki 7','anggur',2),('Dorayaki 7','tepung',2);
/*!40000 ALTER TABLE `resep` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-11-26  9:59:55
