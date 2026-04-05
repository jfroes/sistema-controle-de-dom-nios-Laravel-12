-- MySQL dump 10.13  Distrib 8.0.35, for Linux (x86_64)
--
-- Host: localhost    Database: local
-- ------------------------------------------------------
-- Server version	8.0.35

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
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (1,'Empresa Alpha',NULL,'2026-03-30 01:23:17','2026-03-30 01:23:17');
INSERT INTO `clients` VALUES (2,'Startup Beta',NULL,NULL,NULL);
INSERT INTO `clients` VALUES (3,'Cliente Gamma',NULL,NULL,NULL);
INSERT INTO `clients` VALUES (4,'Cliente sem  teste','2026-03-29 20:20:06','2026-03-30 01:38:04',NULL);
INSERT INTO `clients` VALUES (5,'cliente cadastro front teste','2026-03-29 23:51:46','2026-03-30 01:25:43','2026-03-30 01:25:43');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `domains`
--

DROP TABLE IF EXISTS `domains`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `domains` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` bigint unsigned NOT NULL,
  `registrar_account_id` bigint unsigned NOT NULL,
  `host` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `host_user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expires_at` date NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ativo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `domains_client_id_foreign` (`client_id`),
  KEY `domains_registrar_account_id_foreign` (`registrar_account_id`),
  CONSTRAINT `domains_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  CONSTRAINT `domains_registrar_account_id_foreign` FOREIGN KEY (`registrar_account_id`) REFERENCES `registrar_accounts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `domains`
--

LOCK TABLES `domains` WRITE;
/*!40000 ALTER TABLE `domains` DISABLE KEYS */;
INSERT INTO `domains` VALUES (1,'empresaalpha.com',1,1,'hostgator','alpha_user','2027-03-26','ativo',NULL,NULL,NULL);
INSERT INTO `domains` VALUES (2,'startupbeta.io',2,2,'aws','beta_user','2026-09-26','inativo',NULL,NULL,NULL);
INSERT INTO `domains` VALUES (3,'https://clientegamma.com.br',3,3,'Hostinger','desenvolvimento','2026-05-26','ativo','2026-03-26 20:56:03','2026-03-27 18:24:28',NULL);
INSERT INTO `domains` VALUES (4,'dominio4.com.br',3,3,'Hostinger','desenvolvimento','2026-03-31','ativo','2026-03-26 20:55:50',NULL,NULL);
INSERT INTO `domains` VALUES (5,'empresaalpha.com',1,1,'hostgator','alpha_user','2027-03-26','ativo',NULL,NULL,NULL);
INSERT INTO `domains` VALUES (6,'startupbeta.io',2,2,'aws','beta_user','2026-09-26','inativo',NULL,NULL,NULL);
INSERT INTO `domains` VALUES (7,'clientegamma.com.br',3,3,'Hostinger','desenvolvimento','2026-02-26','expirado','2026-03-26 20:56:03','2026-03-27 19:11:34','2026-03-27 19:11:34');
INSERT INTO `domains` VALUES (8,'dominio4.com.br',3,3,'Hostinger','desenvolvimento','2026-03-31','ativo','2026-03-26 20:55:50',NULL,NULL);
INSERT INTO `domains` VALUES (12,'empresaalpha.com',1,1,'hostgator','alpha_user','2027-03-26','ativo',NULL,NULL,NULL);
INSERT INTO `domains` VALUES (13,'startupbeta.io',2,2,'aws','beta_user','2026-09-26','inativo',NULL,'2026-03-27 19:11:43','2026-03-27 19:11:43');
INSERT INTO `domains` VALUES (14,'https://dominio3teste.com.br',3,3,NULL,NULL,'2026-05-06','expirado','2026-03-26 20:56:03','2026-03-29 19:28:08','2026-03-29 19:28:08');
INSERT INTO `domains` VALUES (15,'dominio4.com.br',3,3,'Hostinger','desenvolvimento','2026-03-31','ativo','2026-03-26 20:55:50',NULL,NULL);
INSERT INTO `domains` VALUES (16,'empresaalpha.com',1,1,'hostgator','alpha_user','2027-03-26','ativo',NULL,NULL,NULL);
INSERT INTO `domains` VALUES (17,'https://startupbeta.io',3,2,'Hostinger','beta_user','2026-09-26','inativo',NULL,'2026-03-28 23:43:21',NULL);
INSERT INTO `domains` VALUES (18,'clientegamma.com.br',3,3,'Hostinger','desenvolvimento','2026-02-26','expirado','2026-03-26 20:56:03',NULL,NULL);
INSERT INTO `domains` VALUES (19,'dominio4.com.br',3,3,'Hostinger','desenvolvimento','2026-03-31','ativo','2026-03-26 20:55:50',NULL,NULL);
INSERT INTO `domains` VALUES (20,'https://dominioteste.com.br',1,3,'Hostinger','desenvolvimento','2026-06-28','ativo','2026-03-28 23:50:30','2026-03-28 23:50:30',NULL);
INSERT INTO `domains` VALUES (21,'https://dominio2teste.com.br',2,1,NULL,NULL,'2026-03-31','ativo','2026-03-28 23:55:18','2026-03-28 23:55:18',NULL);
INSERT INTO `domains` VALUES (22,'https://teste.com.br',5,1,NULL,NULL,'2026-07-28','ativo','2026-03-29 23:52:26','2026-03-29 23:52:26',NULL);
INSERT INTO `domains` VALUES (23,'https://teste2.com.br',2,1,NULL,NULL,'2026-03-31','ativo','2026-03-30 16:55:19','2026-03-30 16:55:19',NULL);
INSERT INTO `domains` VALUES (24,'https://dominio4teste.com.br',3,1,NULL,NULL,'2026-03-31','ativo','2026-03-30 16:57:11','2026-03-30 16:57:11',NULL);
INSERT INTO `domains` VALUES (25,'https://dominio5teste.com.br',3,1,NULL,NULL,'2026-03-31','ativo','2026-03-30 16:57:27','2026-03-30 16:57:27',NULL);
INSERT INTO `domains` VALUES (26,'https://dominio6teste.com.br',3,1,NULL,NULL,'2026-03-31','ativo','2026-03-30 16:58:05','2026-03-30 16:58:05',NULL);
INSERT INTO `domains` VALUES (27,'https://dominio7teste.com.br',3,1,NULL,NULL,'2026-03-31','ativo','2026-03-30 16:58:38','2026-03-30 16:58:38',NULL);
/*!40000 ALTER TABLE `domains` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2026_03_22_190505_create_users_table',1);
INSERT INTO `migrations` VALUES (2,'2026_03_23_170635_add_columns_to_users_table',1);
INSERT INTO `migrations` VALUES (3,'2026_03_25_010212_add_softdeletes_column_to_users_table',1);
INSERT INTO `migrations` VALUES (4,'2026_03_26_125040_create_clients_table',1);
INSERT INTO `migrations` VALUES (5,'2026_03_26_125041_create_registrars_table',1);
INSERT INTO `migrations` VALUES (6,'2026_03_26_125042_create_registrar_accounts_table',1);
INSERT INTO `migrations` VALUES (7,'2026_03_26_125043_create_domains_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registrar_accounts`
--

DROP TABLE IF EXISTS `registrar_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `registrar_accounts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `registrar_id` bigint unsigned NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `registrar_accounts_registrar_id_foreign` (`registrar_id`),
  CONSTRAINT `registrar_accounts_registrar_id_foreign` FOREIGN KEY (`registrar_id`) REFERENCES `registrars` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registrar_accounts`
--

LOCK TABLES `registrar_accounts` WRITE;
/*!40000 ALTER TABLE `registrar_accounts` DISABLE KEYS */;
INSERT INTO `registrar_accounts` VALUES (1,1,'Conta Principal GoDaddy','admin@godaddy.com','Conta principal da empresa',NULL,NULL,NULL);
INSERT INTO `registrar_accounts` VALUES (2,2,'Conta Namecheap Dev','dev@namecheap.com',NULL,NULL,NULL,NULL);
INSERT INTO `registrar_accounts` VALUES (3,3,'Conta Registro.br','contato@empresa.com','Domínios .br',NULL,NULL,NULL);
/*!40000 ALTER TABLE `registrar_accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registrars`
--

DROP TABLE IF EXISTS `registrars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `registrars` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registrars`
--

LOCK TABLES `registrars` WRITE;
/*!40000 ALTER TABLE `registrars` DISABLE KEYS */;
INSERT INTO `registrars` VALUES (1,'GoDaddy','https://godaddy.com',NULL,NULL,NULL);
INSERT INTO `registrars` VALUES (2,'Namecheap','https://namecheap.com',NULL,NULL,NULL);
INSERT INTO `registrars` VALUES (3,'Registro.br','https://registro.br',NULL,NULL,NULL);
INSERT INTO `registrars` VALUES (4,'Regitrador teste',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `registrars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `must_change_password` tinyint(1) NOT NULL DEFAULT '0',
  `password_changed_at` datetime DEFAULT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `last_login_at` datetime DEFAULT NULL,
  `blocked_until` datetime DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inativo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'John Doe','admin@email.com','$2y$12$FG3g2rNNyinxNWwgEswaiOXbr/UmqTtkuBtBRVzyo1o8TfPGZ/7ia','admin',NULL,0,NULL,'2026-03-26 13:22:05',NULL,NULL,'ativo','2026-03-26 16:22:05','2026-03-29 22:30:34',NULL);
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

-- Dump completed on 2026-03-31 10:05:17
