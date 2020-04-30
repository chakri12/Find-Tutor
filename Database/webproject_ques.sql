-- MySQL dump 10.13  Distrib 8.0.12, for Win64 (x86_64)
--
-- Host: localhost    Database: webproject
-- ------------------------------------------------------
-- Server version	8.0.12

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ques`
--

DROP TABLE IF EXISTS `ques`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ques` (
  `ques_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `stu_id` bigint(20) DEFAULT NULL,
  `question` longtext NOT NULL,
  `solution` longtext,
  `tut_id` bigint(20) DEFAULT NULL,
  `issolved` tinyint(4) DEFAULT '0',
  `subject` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ques_id`),
  KEY `student_id_idx` (`stu_id`),
  KEY `tutor_id_idx` (`tut_id`),
  CONSTRAINT `student_id` FOREIGN KEY (`stu_id`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tutor_id` FOREIGN KEY (`tut_id`) REFERENCES `tutor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ques`
--

LOCK TABLES `ques` WRITE;
/*!40000 ALTER TABLE `ques` DISABLE KEYS */;
INSERT INTO `ques` VALUES (1,1,'skaldglasiugaub.sdig guadbliadb','hjsabdl kuabdslkbas bas lkbdkuas',1,1,'maths'),(2,1,'shdgflsdufhldsufh lygsdfkdslufg.','asdasd',1,0,'maths'),(4,1,'asdasddgs sgsadfsf',NULL,NULL,0,'chemistry'),(7,1,'dsfbsjhod sdifnsdfb sdhoifidsbf iud fdsis diidsifndsfssd',NULL,NULL,0,'maths'),(8,1,'dsfbsjhod sdifnsdfb sdhoifidsbf iud fdsis diidsifndsfssd',NULL,NULL,0,'maths'),(9,1,'nsdnsdfn jhdsbflsdkfbj sd dsdss\r\n\r\n\r\n',NULL,NULL,0,'maths');
/*!40000 ALTER TABLE `ques` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-04-27 17:43:28
