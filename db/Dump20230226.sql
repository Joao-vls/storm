CREATE DATABASE  IF NOT EXISTS `usuarios` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `usuarios`;
-- MySQL dump 10.13  Distrib 8.0.32, for Linux (x86_64)
--
-- Host: localhost    Database: usuarios
-- ------------------------------------------------------
-- Server version	8.0.32-0ubuntu0.22.04.2

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
-- Table structure for table `arquivos`
--

DROP TABLE IF EXISTS `arquivos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `arquivos` (
  `id_post` varchar(100) NOT NULL,
  `id_arquivo` varchar(400) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `caminho` varchar(500) NOT NULL,
  PRIMARY KEY (`caminho`),
  KEY `id_post` (`id_post`),
  CONSTRAINT `arquivos_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `postagens` (`id_post`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `arquivos`
--

LOCK TABLES `arquivos` WRITE;
/*!40000 ALTER TABLE `arquivos` DISABLE KEYS */;
INSERT INTO `arquivos` VALUES ('63fad3be6811dp764p63fad3be6812e','63fad3be6c338a298a63fad3be6c341.jpeg,63fad3be6c4b4a247a63fad3be6c4b8.jpeg,63fad3be6c5b3a576a63fad3be6c5b5.jpeg,63fad3be6c73aa209a63fad3be6c73e.jpeg','arquivos/63fad3be6811dp764p63fad3be6812e'),('63fad3cbd2717p779p63fad3cbd2730','','arquivos/63fad3cbd2717p779p63fad3cbd2730'),('63fad3d7325c0p834p63fad3d7325d7','63fad3d7329c1a373a63fad3d7329cb.jpeg,63fad3d732bf2a36a63fad3d732bf6.jpeg,63fad3d732ddda9a63fad3d732de1.jpeg,63fad3d732f98a509a63fad3d732f9b.jpeg','arquivos/63fad3d7325c0p834p63fad3d7325d7'),('63fad3f351141p280p63fad3f351155','63fad3f35670ca979a63fad3f356716.jpeg,63fad3f356b08a246a63fad3f356b0f.jpeg,63fad3f356d04a175a63fad3f356d09.jpeg,63fad3f356f1ba972a63fad3f356f20.jpeg','arquivos/63fad3f351141p280p63fad3f351155'),('63fad4038dcefp598p63fad4038dd08','','arquivos/63fad4038dcefp598p63fad4038dd08');
/*!40000 ALTER TABLE `arquivos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comentarios`
--

DROP TABLE IF EXISTS `comentarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comentarios` (
  `id_post` varchar(100) NOT NULL,
  `user_coment_id_nome` varchar(100) NOT NULL,
  KEY `id_post` (`id_post`),
  KEY `user_coment_id_nome` (`user_coment_id_nome`),
  CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `postagens` (`id_post`),
  CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`user_coment_id_nome`) REFERENCES `users` (`id_nome`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comentarios`
--

LOCK TABLES `comentarios` WRITE;
/*!40000 ALTER TABLE `comentarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `comentarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `info_postagens`
--

DROP TABLE IF EXISTS `info_postagens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `info_postagens` (
  `id_post` varchar(100) NOT NULL,
  `quantidade_coment` int DEFAULT NULL,
  `quantidade_compart` int DEFAULT NULL,
  `quantidade_coracao` int DEFAULT NULL,
  `quantidade_supresa` int DEFAULT NULL,
  `quantidade_alegre` int DEFAULT NULL,
  `quantidade_triste` int DEFAULT NULL,
  `quantidade_irritado` int DEFAULT NULL,
  `quantidade_reacao` int DEFAULT NULL,
  `quantidade_viw` int DEFAULT NULL,
  KEY `id_post` (`id_post`),
  CONSTRAINT `info_postagens_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `postagens` (`id_post`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `info_postagens`
--

LOCK TABLES `info_postagens` WRITE;
/*!40000 ALTER TABLE `info_postagens` DISABLE KEYS */;
/*!40000 ALTER TABLE `info_postagens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `info_users`
--

DROP TABLE IF EXISTS `info_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `info_users` (
  `user_id_nome` varchar(100) NOT NULL,
  `login_date` datetime DEFAULT NULL,
  `quantidade_seguidor` int DEFAULT NULL,
  `quantidade_post` int DEFAULT NULL,
  `quantidade_coment` int DEFAULT NULL,
  `quantidade_compart` int DEFAULT NULL,
  KEY `user_id_nome` (`user_id_nome`),
  CONSTRAINT `info_users_ibfk_1` FOREIGN KEY (`user_id_nome`) REFERENCES `users` (`id_nome`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `info_users`
--

LOCK TABLES `info_users` WRITE;
/*!40000 ALTER TABLE `info_users` DISABLE KEYS */;
INSERT INTO `info_users` VALUES ('jjojj','2023-02-25 22:49:00',NULL,NULL,NULL,NULL),('jjoj','2023-02-11 00:00:00',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `info_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `postagens`
--

DROP TABLE IF EXISTS `postagens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `postagens` (
  `user_id_nome` varchar(100) NOT NULL,
  `id_post` varchar(100) NOT NULL,
  `date_post` datetime NOT NULL,
  `body` varchar(460) NOT NULL,
  `e_comentario` bit(1) DEFAULT b'0',
  PRIMARY KEY (`id_post`),
  KEY `user_id_nome` (`user_id_nome`),
  CONSTRAINT `postagens_ibfk_1` FOREIGN KEY (`user_id_nome`) REFERENCES `users` (`id_nome`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `postagens`
--

LOCK TABLES `postagens` WRITE;
/*!40000 ALTER TABLE `postagens` DISABLE KEYS */;
INSERT INTO `postagens` VALUES ('jjojj','63fad3be6811dp764p63fad3be6812e','2023-02-26 00:36:00','hhh',_binary '\0'),('jjojj','63fad3cbd2717p779p63fad3cbd2730','2023-02-26 00:36:00','ss',_binary '\0'),('jjojj','63fad3d7325c0p834p63fad3d7325d7','2023-02-26 00:36:00','ss',_binary '\0'),('jjojj','63fad3f351141p280p63fad3f351155','2023-02-26 00:37:00','ss',_binary '\0'),('jjojj','63fad4038dcefp598p63fad4038dd08','2023-02-26 00:37:00','sss',_binary '\0'),('jjojj','63fad4a436505p683p63fad4a43651e','2023-02-26 00:40:00','sss',_binary '\0'),('jjojj','63fad4b49bb64p762p63fad4b49bb76','2023-02-26 00:40:00','sssrrrr',_binary '\0');
/*!40000 ALTER TABLE `postagens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quem_comentou`
--

DROP TABLE IF EXISTS `quem_comentou`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quem_comentou` (
  `id_post` varchar(100) NOT NULL,
  `user_id_nome` varchar(100) NOT NULL,
  KEY `user_id_nome` (`user_id_nome`),
  KEY `id_post` (`id_post`),
  CONSTRAINT `quem_comentou_ibfk_1` FOREIGN KEY (`user_id_nome`) REFERENCES `users` (`id_nome`),
  CONSTRAINT `quem_comentou_ibfk_2` FOREIGN KEY (`id_post`) REFERENCES `postagens` (`id_post`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quem_comentou`
--

LOCK TABLES `quem_comentou` WRITE;
/*!40000 ALTER TABLE `quem_comentou` DISABLE KEYS */;
/*!40000 ALTER TABLE `quem_comentou` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quem_compartilhou`
--

DROP TABLE IF EXISTS `quem_compartilhou`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quem_compartilhou` (
  `id_post` varchar(100) NOT NULL,
  `user_id_nome` varchar(100) NOT NULL,
  KEY `user_id_nome` (`user_id_nome`),
  KEY `id_post` (`id_post`),
  CONSTRAINT `quem_compartilhou_ibfk_1` FOREIGN KEY (`user_id_nome`) REFERENCES `users` (`id_nome`),
  CONSTRAINT `quem_compartilhou_ibfk_2` FOREIGN KEY (`id_post`) REFERENCES `postagens` (`id_post`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quem_compartilhou`
--

LOCK TABLES `quem_compartilhou` WRITE;
/*!40000 ALTER TABLE `quem_compartilhou` DISABLE KEYS */;
/*!40000 ALTER TABLE `quem_compartilhou` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quem_interagiu`
--

DROP TABLE IF EXISTS `quem_interagiu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quem_interagiu` (
  `id_post` varchar(100) NOT NULL,
  `user_id_nome` varchar(100) NOT NULL,
  `tipo_de_interacao` varchar(8) NOT NULL,
  KEY `user_id_nome` (`user_id_nome`),
  KEY `id_post` (`id_post`),
  CONSTRAINT `quem_interagiu_ibfk_1` FOREIGN KEY (`user_id_nome`) REFERENCES `users` (`id_nome`),
  CONSTRAINT `quem_interagiu_ibfk_2` FOREIGN KEY (`id_post`) REFERENCES `postagens` (`id_post`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quem_interagiu`
--

LOCK TABLES `quem_interagiu` WRITE;
/*!40000 ALTER TABLE `quem_interagiu` DISABLE KEYS */;
/*!40000 ALTER TABLE `quem_interagiu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id_nome` varchar(100) NOT NULL,
  `email_numero` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `dia_cadastro` datetime NOT NULL,
  `idade` date NOT NULL,
  `img_perfil` varchar(1000) NOT NULL DEFAULT 'http://localhost/storm/img/per.png',
  PRIMARY KEY (`id_nome`),
  UNIQUE KEY `email_numero` (`email_numero`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('jjoj','rtrtt@gmail.com','$2y$10$t.NDKbqUeyssu0p79YfRJ.Xb9F2etySqMZ9MrGU4j0yMHSFjACzS.','joao','2023-02-11 15:22:00','2023-02-10','imgs_perfil/63dc3fc09d082.png'),('jjojj','n1@gmail.com','$2y$10$.46c8sX21Ywxt5xroWaP8ejRxWTQn/mPZRGl1kSVKRlHNUGPUP5X.','joao','2023-02-10 21:41:00','2023-02-10','imgs_perfil/63e6e409cb865.jpg'),('joj','yyy@gmail.com','$2y$10$0jDgLaL8/Tc2RFPzUi1MGeuQiHtq.TnLWQp6MODjWc45U/S1QCTdy','ddd','2023-02-25 15:43:00','2000-04-10','http://localhost/storm/img/per.png'),('jou','yy@gmail.com','$2y$10$oWN7ZyY0wimPXhtgmXps5ecFz5cr6n.jkFLTjCdc4lSiLpXxmjltm','d  dd','2023-02-25 15:47:00','2000-02-17','http://localhost/storm/img/per.png');
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

-- Dump completed on 2023-02-26  0:52:15
