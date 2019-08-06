-- MySQL dump 10.13  Distrib 8.0.15, for Win64 (x86_64)
--
-- Host: localhost    Database: freelance
-- ------------------------------------------------------
-- Server version	8.0.15

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8mb4 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `country_tb`
--

DROP TABLE IF EXISTS `country_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `country_tb` (
  `id_cy` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_cy`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `country_tb`
--

LOCK TABLES `country_tb` WRITE;
/*!40000 ALTER TABLE `country_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `country_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gender_tb`
--

DROP TABLE IF EXISTS `gender_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `gender_tb` (
  `id_gr` int(11) NOT NULL AUTO_INCREMENT,
  `gender` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_gr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gender_tb`
--

LOCK TABLES `gender_tb` WRITE;
/*!40000 ALTER TABLE `gender_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `gender_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locality_tb`
--

DROP TABLE IF EXISTS `locality_tb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `locality_tb` (
  `id_ly` int(11) NOT NULL AUTO_INCREMENT,
  `locality` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_ly`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locality_tb`
--

LOCK TABLES `locality_tb` WRITE;
/*!40000 ALTER TABLE `locality_tb` DISABLE KEYS */;
/*!40000 ALTER TABLE `locality_tb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `records`
--

DROP TABLE IF EXISTS `records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `records` (
  `id_rec` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `main_text` varchar(5000) DEFAULT NULL,
  `date` timestamp NOT NULL,
  `user` varchar(255) NOT NULL,
  PRIMARY KEY (`id_rec`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `records`
--

LOCK TABLES `records` WRITE;
/*!40000 ALTER TABLE `records` DISABLE KEYS */;
INSERT INTO `records` VALUES (31,'Vasya','My first record!','2019-03-27 06:19:50','vasvas'),(32,'Nikolay','My first record!','2019-03-27 06:24:00','niknik'),(33,'Petr','My first record!','2019-03-27 06:24:51','petrsergeev'),(34,'Product','Milk, bread.','2019-03-27 06:41:29','petrsergeev');
/*!40000 ALTER TABLE `records` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_data`
--

DROP TABLE IF EXISTS `user_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `user_data` (
  `id_ud` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(100) NOT NULL,
  `e_mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` int(11) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `second_name` varchar(255) NOT NULL,
  `birthday` varchar(50) DEFAULT NULL,
  `gender_tb` int(11) DEFAULT NULL,
  `country_tb` int(11) DEFAULT NULL,
  `locality_tb` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_ud`),
  KEY `country_tb` (`country_tb`),
  KEY `locality_tb` (`locality_tb`),
  KEY `gender_tb` (`gender_tb`),
  CONSTRAINT `user_data_ibfk_2` FOREIGN KEY (`country_tb`) REFERENCES `country_tb` (`id_cy`),
  CONSTRAINT `user_data_ibfk_3` FOREIGN KEY (`locality_tb`) REFERENCES `locality_tb` (`id_ly`),
  CONSTRAINT `user_data_ibfk_4` FOREIGN KEY (`gender_tb`) REFERENCES `gender_tb` (`id_gr`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_data`
--

LOCK TABLES `user_data` WRITE;
/*!40000 ALTER TABLE `user_data` DISABLE KEYS */;
INSERT INTO `user_data` VALUES (9,'petrsergeev','petrsergeev@mail.ru','$2y$10$pOBmTcloi.nyZr6V74FlmO6nZMilNcmSAIZGjk3XMZOgfiJd2rvaW',NULL,'Петр','Сергеев',NULL,NULL,NULL,NULL),(10,'vasvas','vasvas@mail.ru','$2y$10$ZXsmdXEng27E/nxfs3bCMeqNus1gc4la7SkRo6UMCc0J9wXM6ztBy',NULL,'Василий','Васильев',NULL,NULL,NULL,NULL),(11,'niknik','niknik@mail.ru','$2y$10$F6GxFjTL7c6WHZN6/fEyDurkBvxazU9LdJTYQj4VYXpjXqUcy8Vp2',NULL,'Николай','Николаев',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `user_data` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-03-27 14:06:08
