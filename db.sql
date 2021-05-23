-- MySQL dump 10.13  Distrib 8.0.21, for Win64 (x86_64)
--
-- Host: eu-cdbr-west-01.cleardb.com    Database: heroku_abfbfe11d70b5c8
-- ------------------------------------------------------
-- Server version	5.6.50-log

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
-- Table structure for table `chats`
--

DROP TABLE IF EXISTS `chats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chats` (
  `id` bigint(20) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `from_user_id` bigint(20) unsigned NOT NULL,
  `to_user_id` bigint(20) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chats`
--

LOCK TABLES `chats` WRITE;
/*!40000 ALTER TABLE `chats` DISABLE KEYS */;
/*!40000 ALTER TABLE `chats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=335 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (155,325,15,'2021-05-13 11:57:41','Not so long'),(175,335,15,'2021-05-14 20:52:52','Ayyy, we posting'),(185,335,65,'2021-05-15 12:27:00','Hey man awesome post'),(195,345,65,'2021-05-15 12:28:17','Test post'),(205,355,15,'2021-05-20 15:31:20','Spamming posts #1'),(215,365,15,'2021-05-20 15:31:28','Spamming posts #2'),(225,375,15,'2021-05-20 15:31:40','Spamming posts #3'),(235,385,15,'2021-05-20 15:31:50','Spamming posts #4'),(245,395,15,'2021-05-20 15:32:01','Spamming posts #5'),(255,405,15,'2021-05-20 15:32:08','Spamming posts #6'),(265,415,15,'2021-05-20 15:32:20','Spamming posts #7'),(275,425,15,'2021-05-20 15:37:00','Spamming posts #8'),(285,435,15,'2021-05-20 16:50:38','Creating boring topic after merge'),(295,445,15,'2021-05-20 16:50:54','Fun fun'),(305,455,85,'2021-05-20 17:44:19','sun is shining'),(315,455,85,'2021-05-20 17:44:00','please reply'),(325,465,85,'2021-05-20 18:10:19','SELECT * FROM Users WHERE UserId = 105 OR 1=1;');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messages` (
  `id` bigint(20) unsigned NOT NULL,
  `chat_id` bigint(20) unsigned NOT NULL,
  `body` varchar(255) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=475 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (325,'New post after loooong time',15,'2021-05-13 11:57:41'),(335,'Creating late night post',15,'2021-05-14 20:52:52'),(345,'New post from Nikulás',65,'2021-05-15 12:28:17'),(355,'Spamming posts #1',15,'2021-05-20 15:31:20'),(365,'Spamming posts #2',15,'2021-05-20 15:31:28'),(375,'Spamming posts #3',15,'2021-05-20 15:31:40'),(385,'Spamming posts #4',15,'2021-05-20 15:31:50'),(395,'Spamming posts #5',15,'2021-05-20 15:32:01'),(405,'Spamming posts #6',15,'2021-05-20 15:32:08'),(415,'Spamming posts #7',15,'2021-05-20 15:32:20'),(425,'Spamming posts #8',15,'2021-05-20 15:37:00'),(435,'Creating boring topic after merge',15,'2021-05-20 16:50:38'),(445,'Creating topic for fun',15,'2021-05-20 16:50:54'),(455,'hey there',85,'2021-05-20 17:44:19'),(465,'SELECT * FROM Users WHERE UserId = 105 OR 1=1;',85,'2021-05-20 18:10:19');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_images`
--

DROP TABLE IF EXISTS `user_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `url` varchar(255) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=195 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_images`
--

LOCK TABLES `user_images` WRITE;
/*!40000 ALTER TABLE `user_images` DISABLE KEYS */;
INSERT INTO `user_images` VALUES (55,15,'60992bdc81e2d2.79023713.png'),(65,15,'609beada32c9d4.98020873.png'),(75,65,'609fbde11c7ea4.67223111.jpg'),(85,65,'609fbde94f3d98.75385343.jpg'),(95,75,'0'),(105,75,'0'),(115,75,'0'),(125,15,'0'),(135,15,'60a66717060489.85876825.png'),(145,15,'60a6672361f603.30944103.png'),(155,85,'0'),(165,85,'0'),(175,85,'0'),(185,85,'0');
/*!40000 ALTER TABLE `user_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (5,'Nikulás','Óskarsson','nikulasoskarsson@gmail.com','nikulasoskarsson','$2y$10$MKfNugqjZLwNOqa3KxK4XeC1jsiEkQRmWaRVCfu5woSoHeannLOVq','2021-05-10 09:55:39'),(15,'Arnas','Butnevicius','butnevicius@gmail.com','tester','$2y$10$9dneC2O5V7pLQmJdYLredurE7TQyYCAxlwsKEaodE3lYif/Jp8C3u','2021-05-10 11:36:18'),(25,'Arnas','Butnevicius','butnevicius1@gmail.com','tester1','$2y$10$WMrh10JzXYhEZF.H2zFT4.DUau4hCShoq/5eW4mLgEAwh/n4w7SiG','2021-05-10 11:38:43'),(35,'Arnas','Butnevicius','butnevicius2@gmail.com','tester2','$2y$10$lzPlnLbckHWhQFbO09ipJ.Cp.qYtzp1CvFlILFZJrXOn.Jys0sCWW','2021-05-10 11:48:51'),(45,'Arnas','Butnevicius','butnevicius3@gmail.com','tester3','$2y$10$GI1HTFhzQr8ABdKocdtxduoayF4rd2vIdnrMSlsU5EZkNCsg1CcMq','2021-05-10 11:54:13'),(55,'Arnas','Butnevicius','butnevicius4@gmail.com','tester4','$2y$10$Hd1fCAc/SGY8rlM2A98A8eh7wHzj9EXooA2oqjAHRTpUwzlUufeD.','2021-05-10 11:55:39'),(65,'Nikulás','Óskarsson','nikulasoskarsson10@gmail.com','nikulasoskarsson10','$2y$10$SvjhVPdinJnFR9Pk85Kbn.y.CCh.PwEWPp1YfBryz0zpMbE/jM7Ju','2021-05-15 12:25:06'),(75,'Black','Hat','blackhat@gmail.com','blackhat','$2y$10$rjllhd75dYimV5edJIEZIe.02HBoDv.dY.vGCbVuTvZtmTqEoxHPC','2021-05-17 08:48:45'),(85,'dummy','dummy','barbekina@gmail.com','dummy','$2y$10$KgUp2lqENgFVZlBnT6WQVuR30exGUmzTCDUKCwZysqajzuURSwWi6','2021-05-20 17:40:48');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'heroku_abfbfe11d70b5c8'
--

--
-- Dumping routines for database 'heroku_abfbfe11d70b5c8'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-05-23 11:32:53
