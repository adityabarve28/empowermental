-- MySQL dump 10.13  Distrib 8.0.31, for Win64 (x86_64)
--
-- Host: localhost    Database: empowermental
-- ------------------------------------------------------
-- Server version	8.0.31

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
-- Table structure for table `_admins`
--

DROP TABLE IF EXISTS `_admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `_admins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `_admins`
--

LOCK TABLES `_admins` WRITE;
/*!40000 ALTER TABLE `_admins` DISABLE KEYS */;
INSERT INTO `_admins` VALUES (1,'Aditya','adityabarveA128@gmail.com','Aditya@1',NULL,NULL,NULL);
/*!40000 ALTER TABLE `_admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `appointments`
--

DROP TABLE IF EXISTS `appointments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `appointments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `institute_id` bigint unsigned NOT NULL,
  `counselor_id` bigint unsigned NOT NULL,
  `appointment_date` datetime NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `asked_to_reschedule` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `appointments_counselor_id_foreign` (`counselor_id`),
  KEY `fk_institute` (`institute_id`),
  CONSTRAINT `appointments_counselor_id_foreign` FOREIGN KEY (`counselor_id`) REFERENCES `counselors` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_institute` FOREIGN KEY (`institute_id`) REFERENCES `institutes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=123 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appointments`
--

LOCK TABLES `appointments` WRITE;
/*!40000 ALTER TABLE `appointments` DISABLE KEYS */;
INSERT INTO `appointments` VALUES (119,4,48,'2024-11-14 00:00:00','completed',0,'2024-11-12 04:44:47','2024-11-19 10:19:42'),(120,4,48,'2024-11-16 00:00:00','completed',0,'2024-11-12 04:44:57','2024-11-19 10:19:42'),(121,4,48,'2024-11-18 00:00:00','completed',0,'2024-11-12 04:45:06','2024-11-19 10:19:43'),(122,4,48,'2024-11-20 00:00:00','pending',0,'2024-11-12 04:45:12','2024-11-12 07:10:16');
/*!40000 ALTER TABLE `appointments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blogs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `therapist_id` bigint unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `blogs_therapist_id_foreign` (`therapist_id`),
  CONSTRAINT `blogs_therapist_id_foreign` FOREIGN KEY (`therapist_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blogs`
--

LOCK TABLES `blogs` WRITE;
/*!40000 ALTER TABLE `blogs` DISABLE KEYS */;
INSERT INTO `blogs` VALUES (1,48,'Test',NULL,'Test 1','2024-10-30 05:32:54','2024-10-30 05:32:54'),(2,48,'Test',NULL,'Test 1','2024-10-30 05:32:54','2024-10-30 05:32:54'),(3,48,'Aditya',NULL,'Aditya','2024-10-30 05:34:44','2024-10-30 05:34:44'),(4,48,'Test 2',NULL,'Test 2','2024-10-30 05:37:51','2024-10-30 05:37:51'),(5,48,'Test 3',NULL,'Test 3','2024-10-30 05:39:16','2024-10-30 05:39:16'),(6,48,'Test 4','Test 4','Test 4','2024-10-30 05:39:59','2024-10-30 05:39:59'),(7,48,'Test 5','Test 5','Test 5','2024-10-30 05:44:58','2024-10-30 05:44:58'),(8,48,'Test 6','Test 6','Test 6','2024-10-30 05:46:32','2024-10-30 05:46:32'),(9,47,'Test by Taarak Meheta','This is test blog','This is test blog','2024-10-31 02:55:14','2024-10-31 02:55:14'),(10,47,'lorem Ipsum Test','Test','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus tristique varius mauris, in accumsan purus scelerisque vel. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Nam a ante vitae leo bibendum hendrerit at id nisi. Etiam aliquet ullamcorper est, at pulvinar lectus egestas ut. Curabitur at tortor eros. Cras tincidunt ligula ac urna varius fermentum. Aliquam ut nisl in augue sollicitudin suscipit ac ut sem. Ut convallis sem id varius condimentum. Suspendisse potenti. Suspendisse suscipit libero sit amet arcu ultricies tristique.\r\n\r\nNulla facilisi. Curabitur ac lectus eget turpis viverra auctor. Curabitur eu volutpat quam, eget luctus turpis. Integer malesuada auctor diam, sit amet suscipit augue malesuada non. Nullam et neque ultricies, suscipit arcu vel, suscipit sapien. Suspendisse potenti. Aliquam erat volutpat. Morbi vel bibendum turpis. Nam sodales turpis eget arcu cursus aliquet. Integer a feugiat eros. Integer id mi auctor, pulvinar libero eu, scelerisque urna. Nullam sagittis velit ligula, a pretium orci hendrerit eu. Donec non arcu ac erat congue aliquet. Proin sit amet interdum libero, vel tincidunt libero.\r\n\r\nAenean sit amet lacus ac mauris ultricies pharetra. Nullam fringilla mi et arcu pulvinar, vel hendrerit ipsum tempor. Aenean a libero et nunc facilisis pulvinar. Nulla facilisi. Aliquam convallis tincidunt purus. Nam sit amet lacus vitae est finibus sollicitudin in ac nisl. Ut aliquam viverra ex. Nunc cursus convallis metus, nec posuere dui sagittis nec. Nullam id augue risus. Nulla a purus venenatis, ullamcorper lorem sit amet, ultricies leo. Integer condimentum purus in nunc egestas feugiat. Vestibulum vitae dolor accumsan, aliquam ipsum non, tempus arcu. Sed sit amet mi orci. Nam ullamcorper tempor ligula, eu auctor orci maximus vel.\r\n\r\nMauris in felis felis. Vestibulum fermentum, mauris vel varius malesuada, elit justo rhoncus ex, non interdum metus mi a velit. Duis a convallis arcu. Phasellus sit amet arcu ac nisi pellentesque luctus. Pellentesque eget risus sit amet mi cursus blandit. Mauris sed sagittis dui, sed pulvinar arcu. Cras vestibulum erat eget convallis convallis. Curabitur tristique orci sit amet ipsum blandit convallis. Etiam ac faucibus purus. Suspendisse tempus ligula id nibh tincidunt volutpat. Fusce viverra, urna ut facilisis sodales, eros dolor ultricies ligula, nec rhoncus felis mauris eget nisl. Donec varius id tortor eget hendrerit.\r\n\r\nInteger sit amet orci suscipit, aliquam libero eget, dictum augue. Nam feugiat dui ut sem egestas, ac vehicula nulla suscipit. Integer imperdiet eget arcu nec dictum. Vivamus maximus fringilla justo. Suspendisse posuere urna quis risus consequat interdum. Sed eget dui a felis consectetur maximus. Donec eget tortor eget arcu fringilla ullamcorper. Etiam tincidunt diam sit amet aliquet volutpat. Fusce faucibus malesuada odio. Nam consectetur nec ex sit amet venenatis. Praesent fermentum sollicitudin dui et feugiat. Pellentesque','2024-10-31 03:00:45','2024-10-31 03:00:45');
/*!40000 ALTER TABLE `blogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contactus`
--

DROP TABLE IF EXISTS `contactus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contactus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contactus`
--

LOCK TABLES `contactus` WRITE;
/*!40000 ALTER TABLE `contactus` DISABLE KEYS */;
/*!40000 ALTER TABLE `contactus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `counselor_sessions`
--

DROP TABLE IF EXISTS `counselor_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `counselor_sessions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `counselor_id` bigint unsigned NOT NULL,
  `institute_id` bigint unsigned NOT NULL,
  `session_date` timestamp NOT NULL,
  `session_notes` text COLLATE utf8mb4_unicode_ci,
  `session_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `counselor_sessions_counselor_id_foreign` (`counselor_id`),
  KEY `counselor_sessions_institute_id_foreign` (`institute_id`),
  CONSTRAINT `counselor_sessions_counselor_id_foreign` FOREIGN KEY (`counselor_id`) REFERENCES `counselors` (`id`) ON DELETE CASCADE,
  CONSTRAINT `counselor_sessions_institute_id_foreign` FOREIGN KEY (`institute_id`) REFERENCES `institutes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `counselor_sessions`
--

LOCK TABLES `counselor_sessions` WRITE;
/*!40000 ALTER TABLE `counselor_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `counselor_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `counselors`
--

DROP TABLE IF EXISTS `counselors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `counselors` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `license` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qualification` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `experience` int NOT NULL,
  `specialization` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_pic` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `about_me` text COLLATE utf8mb4_unicode_ci,
  `remember_token` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `counselors_email_unique` (`email`),
  UNIQUE KEY `counselors_license_unique` (`license`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `counselors`
--

LOCK TABLES `counselors` WRITE;
/*!40000 ALTER TABLE `counselors` DISABLE KEYS */;
INSERT INTO `counselors` VALUES (47,'Taarak Mehta','tmkoc@gmail.com','TM787459','$2y$12$rfk08yuD2ShQcHKJoLK9luBbQoF5PTWcqAddtJmBpwMCNhdBnqZhO','9845784525','Bachelors in Human behaviour',14,'Human Behaviour','Goregaon','uploads/profile_pics/Shailesh_Lodha_in_1000_episode_celebration_of_TMKOC.jpg','NA','2JbovDAq84','2024-10-28 11:44:10','2024-10-28 11:44:10'),(48,'Champaklal Gada','ckgadaTherapist@gmail.com','CG2778','$2y$12$7Z.A06xqHjJb7b31QY8H0O48pu8S7dvnBICc5J.xiuIHVAtQm8Yau','8745258794','MBBS',17,'Human Behaviour and Manipulation','Bhuj, Kutch','uploads/profile_pics/pVvbug7A_200x200.jpg','NA','Q2KTH3yg4N','2024-10-28 11:46:27','2024-10-30 06:45:42'),(49,'Aditya Barve','adityabarveC128@gmail.com','ADIT3141','$2y$12$ECttEracVmwLTD95Tdw5s.z6AW6BCsV2TLV/OVJ34MaNoNQNNVAmG','9137818209','BE',1,'Brain Science','Titwala','uploads/profile_pics/IMG_20200507_122709_875.jpg','NA','kIb8lxQBLa','2024-10-28 11:48:15','2024-10-28 11:48:15'),(57,'Aditya Nandkumar Barve','Adityabarve2128@gmail.com','ADIT28888','$2y$12$RTWOdXJr5RSowQ5LJIqvw.AZ0q5IcTmvkFEBBryka1HXeRnulNlfO','09137818209','BE',12,'BE','NA','uploads/profile_pics/resize-1707989950184863509Passportsizeimage.jpg','NA','3YpnoVdw5f','2024-11-09 12:45:55','2024-11-09 12:45:55');
/*!40000 ALTER TABLE `counselors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedbacks`
--

DROP TABLE IF EXISTS `feedbacks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `feedbacks` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `role` text NOT NULL,
  `to_id` bigint DEFAULT '0',
  `to_name` text,
  `feedback` longtext NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedbacks`
--

LOCK TABLES `feedbacks` WRITE;
/*!40000 ALTER TABLE `feedbacks` DISABLE KEYS */;
INSERT INTO `feedbacks` VALUES (1,48,'counselor',NULL,NULL,'Good initiative','2024-10-30 08:31:20','2024-10-30 08:31:20'),(2,48,'counselor',NULL,NULL,'Test 1 with null able fields','2024-10-30 09:12:14','2024-10-30 09:12:14'),(3,3,'institute',NULL,NULL,'Very good Counselor','2024-10-30 09:30:56','2024-10-30 09:30:56'),(4,4,'institute',NULL,NULL,'Very Good Counselor','2024-10-30 09:31:32','2024-10-30 09:31:32'),(5,4,'institute',NULL,NULL,'Test null','2024-10-30 09:32:49','2024-10-30 09:32:49'),(6,4,'institute',48,'Champaklal Gada','Test null 2','2024-10-30 09:34:48','2024-10-30 09:34:48'),(7,5,'institute',48,'Champaklal Gada','Test 2 Success View','2024-10-30 09:51:30','2024-10-30 09:51:30'),(8,48,'counselor',6,'Bhide Tuition classes','Test 1','2024-10-30 10:11:12','2024-10-30 10:11:12'),(9,48,'counselor',4,'K.K.Khanna Institute of Science','Test 2','2024-10-30 10:11:30','2024-10-30 10:11:30'),(10,48,'counselor',5,'College of Engineering','Test 3','2024-10-30 10:11:37','2024-10-30 10:11:37'),(11,42,'student',48,NULL,'Test student end 1','2024-10-30 11:00:05','2024-10-30 11:00:05'),(12,42,'student',48,NULL,'Test 3 anonymous','2024-10-30 11:05:17','2024-10-30 11:05:17'),(13,42,'student',48,NULL,'Test 3','2024-10-30 11:07:47','2024-10-30 11:07:47'),(14,42,'student',48,'Champaklal Gada','Test 4','2024-10-30 11:10:08','2024-10-30 11:10:08'),(15,3,'institute',47,'Taarak Mehta','Test','2024-10-30 11:12:10','2024-10-30 11:12:10'),(16,4,'institute',48,'Champaklal Gada','Test','2024-10-30 11:12:48','2024-10-30 11:12:48'),(17,37,'student',47,'Taarak Mehta','Test','2024-10-30 11:29:26','2024-10-30 11:29:26'),(18,4,'institute',0,'Platform','Test','2024-10-31 10:44:41','2024-10-31 10:44:41'),(19,34,'student',0,'Platform','test 2','2024-10-31 10:47:35','2024-10-31 10:47:35'),(20,48,'counselor',0,'Platform','test 3','2024-10-31 10:48:58','2024-10-31 10:48:58');
/*!40000 ALTER TABLE `feedbacks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `filereturns`
--

DROP TABLE IF EXISTS `filereturns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `filereturns` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `counselor_id` bigint unsigned NOT NULL,
  `travel_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `travel_location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `screenshots` json NOT NULL,
  `status` enum('pending','approved','declined','completed') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `filereturns_counselor_id_foreign` (`counselor_id`),
  CONSTRAINT `filereturns_counselor_id_foreign` FOREIGN KEY (`counselor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `filereturns`
--

LOCK TABLES `filereturns` WRITE;
/*!40000 ALTER TABLE `filereturns` DISABLE KEYS */;
INSERT INTO `filereturns` VALUES (1,48,'2024-10-31','Dombivli','NA','[\"uploads/returns/YsdnX66SonAeIGjUvN8edCoerebPWWnwtJsciGMe.jpg\", \"uploads/returns/Bu9mUXtweqVoucDZg1tG9EFbYD6kOJY2AUk8KyhF.jpg\", \"uploads/returns/urhk0vZSWaJ4lWXc9PJOd2iZpZrqeYVukGoFew8P.jpg\"]','completed','2024-10-30 08:08:52','2024-11-01 05:19:33');
/*!40000 ALTER TABLE `filereturns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `followup`
--

DROP TABLE IF EXISTS `followup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `followup` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `location` text NOT NULL,
  `phone_number` bigint NOT NULL,
  `date_of_appointment` datetime NOT NULL,
  `role` text NOT NULL,
  `appointment_type` text NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `followup`
--

LOCK TABLES `followup` WRITE;
/*!40000 ALTER TABLE `followup` DISABLE KEYS */;
/*!40000 ALTER TABLE `followup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `institutes`
--

DROP TABLE IF EXISTS `institutes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `institutes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `institute_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ins_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ins_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ins_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `registration_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ins_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ins_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `principal_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `establishment_year` int NOT NULL,
  `number_of_students` int NOT NULL,
  `affiliations` text COLLATE utf8mb4_unicode_ci,
  `institute_logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `institutes_email_unique` (`ins_email`),
  UNIQUE KEY `institutes_registration_number_unique` (`registration_number`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `institutes`
--

LOCK TABLES `institutes` WRITE;
/*!40000 ALTER TABLE `institutes` DISABLE KEYS */;
INSERT INTO `institutes` VALUES (3,'Global Engineering Institute','Adityabarve28@gmail.com','$2y$12$A/CEI7/a8tEufSGISHcXxO4g7eJSnj/shTN41oEhiGC8SLQCLKz.y','09137818209','ABC123','NA','https://www.google.com','Private','Aditya Barve',1111,1001,'NA','logos/6ImQzRI23rfGf7JAHRjYazXbvw8X6rjDW5eqNAwQ.png','YoqFwd4OOd','2024-10-20 06:14:09','2024-10-27 14:02:16'),(4,'K.K.Khanna Institute of Science','kk@yahoo.com','$2y$12$kSkvI4VTcFRt.0.8hwp6k.PePB06CJYfff8obzOOynCbeO1eN1uFW','1234567890','12gfasd7','madgaon','https://www.google.com','Private','KK Khanna',2024,100,'NA','uploads/IMG_20200507_122709_875.jpg','i7zJ5XCJc9','2024-10-24 06:24:34','2024-10-27 14:02:58'),(5,'College of Engineering','coe@gmail.com','$2y$12$QmXvka33IljblQGxC/X9SOLa2qAwb4nuzcRXTOH40foK/d0oZABOC','7541258952','coe122321','Pune','https://www.google.com','Government','Mr. Kothrud',1958,1896,'NA','uploads/EmpowerMentalEMlogo1.0.png','mVmv04gAUl','2024-10-28 12:44:30','2024-10-28 12:44:30'),(6,'Bhide Tuition classes','bhide@gmail.com','$2y$12$eBPaNgWomAKTwZ9yr1vWvejC1s4PS.Lk4JG9fQ9F16gg2uEQwd8..','9638527410','ATB784596','Gokuldham Society','https://www.google.com','Private','A.T.Bhide',16,150,'NA','uploads/images.jpg','fbEtQwxp6T','2024-10-28 13:22:12','2024-10-28 13:22:12'),(54,'M.K Gandhi College','mk@gmail.com','$2y$12$OYX5zt/6ZwNk8NxELlPm3uUKw36s1SNTMsqsbMPwWokvgx.tPkXaK','8745120214','MK78954','Andheri','https://www.google.com','Private','M.K.Gandhi',1852,2547,'NA','uploads/images.jpg','d8QnQ0oIuT','2024-10-31 08:23:57','2024-10-31 08:23:57'),(55,'Titwala institute of technology','tit@gmail.com','$2y$12$d1ydI8RuufaTlLuvuRPnP.2A1T.t4J85JM6/dJQVdIfVqVfQp4u3W','7845210358','TIT789587','Titwala','https://www.google.com','Private','Aditya Barve',2024,1950,'NA','uploads/Passport-size-image.jpg','0fN7M00TUw','2024-11-06 12:21:31','2024-11-06 12:21:31'),(62,'Gokuldham Institute of Good Behaviour','gkm@gmail.com','$2y$12$4P3VlL7oAGBQ1.i2Zzx67O/Nez0JzrOkPD7rMcBfk1BXdH2OSLIkm','09137818279','GKM9172','Goregaon','https://www.google.com','Private','Mr. Champaklal',2008,2111,NULL,'uploads/pVvbug7A_200x200.jpg','e0y1bAYDun','2024-11-09 13:00:53','2024-11-09 13:00:53');
/*!40000 ALTER TABLE `institutes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000001_create_cache_table',1),(2,'0001_01_01_000002_create_jobs_table',1),(3,'2024_10_16_000001_create_users_table',1),(4,'2024_10_16_000002_create_institutes_table',1),(5,'2024_10_16_000003_create_counselors_table',1),(6,'2024_10_16_000004_create_students_table',1),(7,'2024_10_16_000005_create_appointments_table',1),(8,'2024_10_17_083825_create_reports_table',1),(9,'2024_10_17_084113_create_workshops_table',1),(10,'2024_10_17_084129_create_subscriptions_table',1),(11,'2024_10_17_090838_create_counselorsessions_table',1),(12,'2024_10_17_102033_create_sessions_table',2),(13,'2024_10_20_115246_create_subscription_plans_table_',3),(14,'2024_10_20_121326_create_user_table',4),(15,'2024_10_20_121456_create_blogs_table',5),(17,'2024_10_30_131511_create_filereturns_table',6),(18,'2024_10_31_104503_create__admins_table',7),(19,'2024_10_31_152054_create_contactus_table',8);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reports` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `student_id` bigint unsigned DEFAULT NULL,
  `counselor_id` bigint unsigned DEFAULT NULL,
  `institute_id` bigint unsigned DEFAULT NULL,
  `report_details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reports_student_id_foreign` (`student_id`),
  KEY `reports_counselor_id_foreign` (`counselor_id`),
  KEY `reports_institute_id_foreign` (`institute_id`),
  CONSTRAINT `reports_counselor_id_foreign` FOREIGN KEY (`counselor_id`) REFERENCES `counselors` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reports_institute_id_foreign` FOREIGN KEY (`institute_id`) REFERENCES `institutes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reports_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reports`
--

LOCK TABLES `reports` WRITE;
/*!40000 ALTER TABLE `reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('AvMgxIGu0h1kodyTGg3pyqmTX14H3cGknMRU2pQu',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoieXlFMnpmaEZPSXV4ZHo3REVwWUlpbjNXdkliYTE1WUwxaU1GNjBlZSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjU6Imh0dHA6Ly9lbXBvd2VybWVudGFsLnRlc3QiO319',1731851752),('F6EEJdHzqlADd1gAsIUS0j6YjZsFv7TgltkOrcZD',4,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36','YTo0OntzOjY6Il9mbGFzaCI7YToyOntzOjM6Im5ldyI7YTowOnt9czozOiJvbGQiO2E6MDp7fX1zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0NToiaHR0cDovL2VtcG93ZXJtZW50YWwudGVzdC9pbnN0aXR1dGUtZGFzaGJvYXJkIjt9czo2OiJfdG9rZW4iO3M6NDA6Im9YeDJ3bmRMQjBIN0Z4QkdSblFSdHJkZ2J4RkhZdE90ZmNibzRTcWoiO3M6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjQ7fQ==',1731415450),('FjFapmBPhPxWkUjqJONr5PhdsHckNzMqFNLlewZP',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36','YToyOntzOjY6Il90b2tlbiI7czo0MDoiT1VGUzNBNnNwZGdoMGRBMFZUNnFVRzRBYlFaYWk4RFhPWlo1QVp6eCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1731499933),('Xz0FEZ6URChQY8yY7AyWEkyWLXBtJ0jzU40LiC76',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36','YTozOntzOjY6Il9mbGFzaCI7YToyOntzOjM6Im5ldyI7YTowOnt9czozOiJvbGQiO2E6MDp7fX1zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozNToiaHR0cDovL2VtcG93ZXJtZW50YWwudGVzdC9ibG9ncy9hbGwiO31zOjY6Il90b2tlbiI7czo0MDoidXMxY1loVHY3ZnZBNTRtamZKcU41RzNBRUZyZDFsQmtYSzJNSkRHZCI7fQ==',1731417522),('YKvn2ACHTwe6yt5KJ4BEMOV2uuAH4FJq7VDRzTXF',4,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36','YTo0OntzOjY6Il9mbGFzaCI7YToyOntzOjM6Im5ldyI7YTowOnt9czozOiJvbGQiO2E6MDp7fX1zOjY6Il90b2tlbiI7czo0MDoia1RPc0phNzhtbGtHZzRDQmNoQm1YMGtESjdtOTJzcGVXUGtXQUdVUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDk6Imh0dHA6Ly9lbXBvd2VybWVudGFsLnRlc3QvYWRtaW4vZm9sbG93LXVwcy9jcmVhdGUiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo0O30=',1732032831);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `students` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `institute_id` bigint unsigned NOT NULL,
  `is_account_manager` int DEFAULT NULL,
  `dob` date NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year_of_study` int unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `students_institute_id_foreign` (`institute_id`),
  KEY `students_user_id_foreign` (`user_id`),
  CONSTRAINT `students_institute_id_foreign` FOREIGN KEY (`institute_id`) REFERENCES `institutes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `students_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES (19,34,'Aditya Nandkumar Barve','AdityabarveS128@gmail.com','$2y$12$xvXKBE6aMggInn9iYfS68eBeEbQAX5QNJEAblPoMJ3YYFdGDqa58y',3,0,'2002-03-28','male','09137818209','NA\r\nGayatri Dham C-5/13, Ganesh Mandir road',2024,'2024-10-25 04:03:04','2024-10-27 14:03:22'),(20,37,'Jethalal Gada','jcgada@gmail.com','$2y$12$9ndosB2Q2FT9NNcgTP1BeuxC4gmrt7QwzdYThLymQo4LiRJYVMb62',3,1,'1955-12-31','male','8745896541','Gokuldham Society',2024,'2024-10-25 13:36:59','2024-10-27 14:03:36'),(21,41,'Tipendra Gada','tg@gmail.com','Tipendra@07',4,0,'1998-08-07','male','7841256983','NA',2024,'2024-10-27 14:42:22','2024-10-27 14:43:23'),(22,42,'Sonu Bhide','sb@gmail.com','$2y$12$qqWJ49PlBEbNfevH2mNk6ul6Anmvo4wDcAgrufsDlr3t/dBHNECI.',4,1,'1999-10-29','female','9568745824','NA',2024,'2024-10-27 14:43:04','2024-10-30 10:52:41'),(23,43,'Gulab Kumar Haathi','gkh@gmail.com','Gulab@04',4,0,'1996-09-04','male','8965265874','New York',2024,'2024-10-28 03:35:06','2024-10-28 03:35:06'),(24,52,'Babita Iyer','bi@gmail.com','Babita@25',5,1,'1986-02-25','female','7845621036','Goregaon',2024,'2024-10-29 06:50:03','2024-10-29 06:50:15'),(25,53,'Madhvi Bhide','mb@gmail.com','Madhvi@14',6,1,'1984-09-14','female','8526931047','Goreagaon',2024,'2024-10-29 06:51:26','2024-10-29 06:51:37');
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscription_plans`
--

DROP TABLE IF EXISTS `subscription_plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subscription_plans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'monthly',
  `features` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sessions_approved` int NOT NULL,
  `discount` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscription_plans`
--

LOCK TABLES `subscription_plans` WRITE;
/*!40000 ALTER TABLE `subscription_plans` DISABLE KEYS */;
INSERT INTO `subscription_plans` VALUES (1,'Workshop Plan',10000.00,'Once','Interactive Group Workshop, Single Session, Unlimited student participation, Duration: 45 Minutes to 1Hr 15Mins (Variable)',1,NULL,NULL,NULL),(2,'Basic Plan',50000.00,'Monthly','Therapist Auto Assigned, 3 - 4 days / Month, Confidential Platform, Customized Reporting, 5% Discount full payment of 2 months',4,5.00,NULL,NULL),(3,'Standard Plan',75000.00,'Monthly','Therapist Auto Assigned, 6 - 8 Days / Month, Confidential Platform, Customized Reporting, 10% discount for full payment of 3 months',8,10.00,NULL,NULL),(4,'Premium Plan',100000.00,'monthly','Choose Therapists, 6 - 9 Days/ month, Confidential Platform, Customized Reporting, 15% Discount on full payment of 4 months',10,15.00,NULL,NULL);
/*!40000 ALTER TABLE `subscription_plans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscriptions`
--

DROP TABLE IF EXISTS `subscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subscriptions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `institute_id` bigint unsigned NOT NULL,
  `plan_id` bigint unsigned NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `amount` decimal(8,2) NOT NULL,
  `status` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `therapist_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subscriptions_institute_id_foreign` (`institute_id`),
  KEY `fk_plan_id` (`plan_id`),
  KEY `fk_therapist` (`therapist_id`),
  CONSTRAINT `fk_plan_id` FOREIGN KEY (`plan_id`) REFERENCES `subscription_plans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_therapist` FOREIGN KEY (`therapist_id`) REFERENCES `counselors` (`id`),
  CONSTRAINT `subscriptions_institute_id_foreign` FOREIGN KEY (`institute_id`) REFERENCES `institutes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscriptions`
--

LOCK TABLES `subscriptions` WRITE;
/*!40000 ALTER TABLE `subscriptions` DISABLE KEYS */;
INSERT INTO `subscriptions` VALUES (27,4,2,'2024-11-12','2025-02-12',142500.00,1,'2024-11-12 04:43:02','2024-11-12 04:43:38',48);
/*!40000 ALTER TABLE `subscriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Test User','test@example.com','2024-10-20 06:58:18','$2y$12$O.a9fzhGG3m2xrGFZYyS9OPntlhXWV3yHNzs9jpJAS7nMyx43./DC','jpX47PZZzu','2024-10-20 06:58:19','2024-10-20 06:58:19');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('student','counselor','institute') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'student',
  `is_account_manager` int DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (3,'Global Engineering Institute','Adityabarve28@gmail.com','$2y$12$A/CEI7/a8tEufSGISHcXxO4g7eJSnj/shTN41oEhiGC8SLQCLKz.y','institute',0,'UkHIMgIaOJvYvx7yGUOitWOnAfBq5Opz2wJzYrE7oiAHpcxqVnyVgpqh7QTQ','2024-10-20 06:14:09','2024-10-27 14:02:16'),(4,'K.K.Khanna Institute of Science','kk@yahoo.com','$2y$12$kSkvI4VTcFRt.0.8hwp6k.PePB06CJYfff8obzOOynCbeO1eN1uFW','institute',0,'cOUm3cu98HZviUX6YjH5lHm8LwxwB8luOxRZAXyUS6OPnjSJXUCzXyNoHbU5','2024-10-24 06:24:34','2024-10-27 14:02:58'),(5,'College of Engineering','coe@gmail.com','$2y$12$AgyzaUI8h4hHV6d.0OcNT.AWYuoIXk1kADORNeId3GqibzXIx9a/G','institute',NULL,'m4ncSeDjFVmyMG1fpizR0U9yQTdz8XBz8jEJMbHuYV6JfM6OMBRbJcVL9Tba','2024-10-28 12:44:30','2024-10-28 12:44:30'),(6,'Bhide Tuition classes','bhide@gmail.com','$2y$12$KbqystaKVejqdx38Jvggm.fXUyIFx4MLYdLBvimr6JMxiHGBDFIiS','institute',NULL,'Yimggz0TPj3lTo3gnni9N39Yoav8cQu03slQqr67mFbVz5ohxX0DEXCUkW0N','2024-10-28 13:22:12','2024-10-28 13:22:12'),(34,'Aditya Nandkumar Barve','AdityabarveS128@gmail.com','$2y$12$xvXKBE6aMggInn9iYfS68eBeEbQAX5QNJEAblPoMJ3YYFdGDqa58y','student',0,'V0iWuhRCrzjtvSYOrxOcvYYU1nIKgqWiZwK0pbMTuILoMCpSdYUiqM1DldDK','2024-10-25 04:03:04','2024-10-27 14:03:22'),(37,'Jethalal Gada','jcgada@gmail.com','$2y$12$9ndosB2Q2FT9NNcgTP1BeuxC4gmrt7QwzdYThLymQo4LiRJYVMb62','student',1,'UHZnRQKyAFH1qvaElmh4oEEZAXhjPlogUWgpRXWQjqe9HW8w5LGLjvyDGK9D','2024-10-25 13:36:59','2024-10-27 14:03:36'),(41,'Tipendra Gada','tg@gmail.com','$2y$12$IKcChouLG8iOqYWCpXY7deBOskTxKEDGaBOUqq0b1LnKavBSRhGq6','student',0,'sHvWDUTqSZ','2024-10-27 14:42:22','2024-10-27 14:43:23'),(42,'Sonu Bhide','sb@gmail.com','$2y$12$qqWJ49PlBEbNfevH2mNk6ul6Anmvo4wDcAgrufsDlr3t/dBHNECI.','student',1,'iaSwHYS1dISRTDakkZ80lmxL6728CBoYPiJCrvReeBZxvFS1QH3OdqOSQNC7','2024-10-27 14:43:04','2024-10-30 10:52:41'),(43,'Gulab Kumar Haathi','gkh@gmail.com','$2y$12$x/WGDuS.dDp6JPB03icGr.y3pBAUAgHVXu/QUUeGABx0HY5bSI/Wu','student',NULL,'sRmaGjuXkv','2024-10-28 03:35:06','2024-10-28 03:35:06'),(47,'Taarak Mehta','tmkoc@gmail.com','$2y$12$T89h4ZxC12OzHeA7U/03JemTRRWO/OedRW3p1JbSCIpLZfJ.qiuZ2','counselor',NULL,'kA5N6QMUmmWyR9F4JyDyntAIHGoNMKAaodNcHrIFjtiSJIzORz1emlX99r6S','2024-10-28 11:44:09','2024-10-28 11:44:09'),(48,'Champaklal Gada','ckgadaTherapist@gmail.com','$2y$12$2SNg.P7lUiGI4L2eP7ff7.2QC9JppmbJQIZazYl.L/PfGPfBa8XL2','counselor',NULL,'34QkUiV8mayPg4YmSrdZAS2oFR6LooDiwvOe4e3mtstsz2MpEDH35KYNSZJJ','2024-10-28 11:46:27','2024-10-30 06:45:42'),(49,'Aditya Barve','adityabarveC128@gmail.com','$2y$12$yuI2ejcSL9cQi/mYig78bu2rp9jMFKRDQ41k0.zUG4urVkpFrKauC','counselor',NULL,'xB2X4frNu1','2024-10-28 11:48:15','2024-10-28 11:48:15'),(52,'Babita Iyer','bi@gmail.com','$2y$12$Wf5qNIThTh6lPDC6qmmwlumxSJjrCkakIB16VVsjCK7ffs03UrNXu','student',1,'dheOthd6ur','2024-10-29 06:50:03','2024-10-29 06:50:15'),(53,'Madhvi Bhide','mb@gmail.com','$2y$12$VR5BXncfBg0H41GhjUrntujU3Tg8eCMG/quLl8V/eHQD48w.pJ0VS','student',1,'UcXyQQpXrW','2024-10-29 06:51:26','2024-10-29 06:51:37'),(54,'M.K Gandhi College','mk@gmail.com','$2y$12$zbfCPThBLceszfnFS8EN1O00Sz5oY3kFtwVDA63E3r3Dt.iA.qz4u','institute',NULL,'srQ3liHMYzfYxBAQwU4zayxX2HjOEw3AojBQua1nvnPTTUcUwC59r2QPbI2q','2024-10-31 08:23:55','2024-10-31 08:23:55'),(55,'Titwala institute of technology','tit@gmail.com','$2y$12$PvUWyKpQ24h4I4cd4H3C7OMrr5sG.T6prZnioMDHNoDos/5RWy4ri','institute',NULL,'UlAvFvlNpIeuoyoT8W4g2yK69pV5uJOtAwQXlTwM0CfTYRswxCOXxt8sZ7Yu','2024-11-06 12:21:29','2024-11-06 12:21:29'),(56,'Aditya Nandkumar Barve','Adityabarve2823@gmail.com','$2y$12$xbPNuX.OJZJ1K0X3EgrH9.Hf8Atlr8oDyL0aAHbg64Ix4iRxyQeGu','counselor',NULL,'Em4hrf9FWu','2024-11-09 12:34:48','2024-11-09 12:34:48'),(57,'Aditya Nandkumar Barve','Adityabarve2128@gmail.com','$2y$12$RTWOdXJr5RSowQ5LJIqvw.AZ0q5IcTmvkFEBBryka1HXeRnulNlfO','counselor',NULL,'3YpnoVdw5f','2024-11-09 12:45:55','2024-11-09 12:45:55'),(62,'Gokuldham Institute of Good Behaviour','gkm@gmail.com','$2y$12$0WLRVhRtppvwF8rgdP6Tsub4AHw4nZRJLLaEWnBHDiN78Izte1zAi','institute',NULL,'e0y1bAYDun','2024-11-09 13:00:52','2024-11-09 13:00:52');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workshops`
--

DROP TABLE IF EXISTS `workshops`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `workshops` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `institute_id` bigint unsigned DEFAULT NULL,
  `counselor_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `workshops_institute_id_foreign` (`institute_id`),
  KEY `workshops_counselor_id_foreign` (`counselor_id`),
  CONSTRAINT `workshops_counselor_id_foreign` FOREIGN KEY (`counselor_id`) REFERENCES `counselors` (`id`) ON DELETE CASCADE,
  CONSTRAINT `workshops_institute_id_foreign` FOREIGN KEY (`institute_id`) REFERENCES `institutes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workshops`
--

LOCK TABLES `workshops` WRITE;
/*!40000 ALTER TABLE `workshops` DISABLE KEYS */;
/*!40000 ALTER TABLE `workshops` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-21 17:15:49
