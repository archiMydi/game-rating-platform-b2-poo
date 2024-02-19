-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: db_game_rating_platform_b2_oop
-- ------------------------------------------------------
-- Server version	8.0.36

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `game_id` int NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_game_id_category` (`game_id`),
  CONSTRAINT `fk_game_id_category` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `criterion`
--

DROP TABLE IF EXISTS `criterion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `criterion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `criterion`
--

LOCK TABLES `criterion` WRITE;
/*!40000 ALTER TABLE `criterion` DISABLE KEYS */;
INSERT INTO `criterion` VALUES (1,'gameplay'),(2,'graphics'),(3,'music');
/*!40000 ALTER TABLE `criterion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gallery`
--

DROP TABLE IF EXISTS `gallery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gallery` (
  `game_id` int NOT NULL,
  `url` text,
  KEY `fk_game_id_gallery` (`game_id`),
  CONSTRAINT `fk_game_id_gallery` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery`
--

LOCK TABLES `gallery` WRITE;
/*!40000 ALTER TABLE `gallery` DISABLE KEYS */;
/*!40000 ALTER TABLE `gallery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game`
--

DROP TABLE IF EXISTS `game`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `game` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `genre` varchar(30) NOT NULL,
  `visuel` text,
  `infos` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game`
--

LOCK TABLES `game` WRITE;
/*!40000 ALTER TABLE `game` DISABLE KEYS */;
INSERT INTO `game` VALUES (1,'Elden Ring','Action RPG','https://tse1.mm.bing.net/th?id=OIP.ylgvYYsqA_2LCUxohexA7wHaJN&pid=Api','Jeu d\'aventure développé par FROM SOFTWARE'),(2,'Super Mario Galaxy','Plateforme','https://media.senscritique.com/media/000007003315/source_big/super_mario_galaxy.jpg','Jeu de plateforme édité par Nintendo'),(3,'Minecraft','Action RPG','https://media.ldlc.com/r1600/ld/products/00/04/89/99/LD0004899922_2.jpg','Jeu indépendant de craft et de survie'),(4,'Persona 5','J-RPG','https://tse2.mm.bing.net/th?id=OIP.qKtaBpewc6r3NXYGfI3p_AHaHa&pid=Api','Jeu de rôle développé par Atlus'),(5,'Fortnite','Battle Royal','https://images-na.ssl-images-amazon.com/images/I/81USj-o7CvL._AC_SL1500_.jpg','Jeu de Battle Royal édité par Epic Game'),(6,'Life is strange','Point & Click','https://tse2.mm.bing.net/th?id=OIP.hmcufxZh61sMdDbwx4vPWwHaKj&pid=Api','Jeu de Point & Click édité par Dontnod'),(7,'Xenoblade Chronicles','J-RPG','https://tse4.mm.bing.net/th?id=OIP.VvrKNtPKugtbhY7f0m4amAHaKc&pid=Api','Jeu de rôle développé par Monolith Soft'),(8,'Doom','FPS','https://tse1.mm.bing.net/th?id=OIP.78ECBDmu4EOdgDFHnzEYhwHaKG&pid=Api','Jeu de tir à la première personne édité par Id Software'),(9,'The evil within','Survival horror','https://tse4.mm.bing.net/th?id=OIP.2hHDa3x8DmlUasxzSolb8gAAAA&pid=Api','Jeu de survival horror édité par Bethesda'),(10,'Five nights at Freddy\'s','Survival horror','https://tse2.mm.bing.net/th?id=OIP.7JG3J_NkHd2YpoF9NphtjgHaHa&pid=Api','Jeu indépendant de survie');
/*!40000 ALTER TABLE `game` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rating`
--

DROP TABLE IF EXISTS `rating`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rating` (
  `criterion_id` int NOT NULL,
  `game_id` int NOT NULL,
  `user_id` int NOT NULL,
  `value` tinyint NOT NULL,
  PRIMARY KEY (`criterion_id`,`user_id`,`game_id`),
  KEY `fk_game_id_rating` (`game_id`),
  KEY `fk_user_id_rating` (`user_id`),
  CONSTRAINT `fk_criterion_id_rating` FOREIGN KEY (`criterion_id`) REFERENCES `criterion` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_game_id_rating` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_user_id_rating` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ck_value` CHECK ((`value` between 0 and 5))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rating`
--

LOCK TABLES `rating` WRITE;
/*!40000 ALTER TABLE `rating` DISABLE KEYS */;
INSERT INTO `rating` VALUES (1,1,1,5),(1,3,1,5),(1,4,1,3),(1,5,1,4),(1,7,1,2),(1,8,1,4),(1,9,1,4),(1,10,1,4),(1,1,2,5),(1,2,2,5),(1,3,2,4),(1,6,2,3),(1,8,2,5),(1,9,2,5),(1,2,3,5),(1,4,3,4),(1,5,3,5),(1,6,3,2),(1,7,3,4),(1,10,3,3),(1,1,4,5),(1,2,4,5),(1,3,4,3),(1,4,4,5),(1,5,4,5),(1,6,4,1),(1,7,4,3),(1,8,4,5),(1,9,4,5),(1,10,4,2),(2,1,1,5),(2,3,1,3),(2,4,1,3),(2,5,1,4),(2,7,1,4),(2,8,1,3),(2,9,1,4),(2,10,1,2),(2,1,2,5),(2,2,2,4),(2,3,2,2),(2,6,2,2),(2,8,2,2),(2,9,2,4),(2,2,3,5),(2,4,3,4),(2,5,3,3),(2,6,3,3),(2,7,3,5),(2,10,3,2),(2,1,4,5),(2,2,4,4),(2,3,4,3),(2,4,4,4),(2,5,4,5),(2,6,4,2),(2,7,4,3),(2,8,4,3),(2,9,4,5),(2,10,4,3),(3,1,1,5),(3,3,1,5),(3,4,1,5),(3,5,1,2),(3,7,1,4),(3,8,1,1),(3,9,1,3),(3,10,1,4),(3,1,2,4),(3,2,2,5),(3,3,2,4),(3,6,2,5),(3,8,2,5),(3,9,2,5),(3,2,3,5),(3,4,3,5),(3,5,3,1),(3,6,3,3),(3,7,3,5),(3,10,3,1),(3,1,4,5),(3,2,4,5),(3,3,4,5),(3,4,4,4),(3,5,4,3),(3,6,4,4),(3,7,4,5),(3,8,4,3),(3,9,4,5),(3,10,4,2);
/*!40000 ALTER TABLE `rating` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(20) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pseudo` (`pseudo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'enzo','password',NULL),(2,'julie','password',NULL),(3,'antoine','password',NULL),(4,'archibald','password',NULL);
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

-- Dump completed on 2024-02-19 11:02:06
