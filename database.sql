-- MySQL dump 10.13  Distrib 8.0.42, for Win64 (x86_64)
--
-- Host: localhost    Database: interns_task_management_system
-- ------------------------------------------------------
-- Server version	8.0.42

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
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`),
  KEY `admins_role_id_foreign` (`role_id`),
  CONSTRAINT `admins_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'Admin','admin@example.com','$2y$12$N0wrOMgANX7gyIBeKQHMaueKha7oJVH52nJM7a0KhNiTZEs2745Iq',1,'2025-05-09 00:29:46','2025-05-09 00:29:46'),(2,'erter','saralchauhan.ast@gmail.com','$2y$12$MvSaLWtf0CawDALN2cDEWuWYF/jgkIOSAyrlBD9oS4nJr7XFZWbFq',2,'2025-05-09 00:36:44','2025-05-09 00:50:42'),(3,'afrwerwe','werwre@erree','$2y$12$9dYtWN2fhOvLZGmhIeqq/ehqbcAk9jos/Q4t1MX5dMA8xqFunxM9S',2,'2025-05-09 01:20:04','2025-05-09 01:20:04');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
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
INSERT INTO `cache` VALUES ('laravel_cache_admin_4_is_super_admin','b:0;',1747199499),('laravel_cache_admin_4_permission_read_admins','b:1;',1747199499),('laravel_cache_admin_4_permission_read_interns','b:1;',1747199499),('laravel_cache_admin_4_permission_read_tasks','b:1;',1747199499),('laravel_cache_admin_users_listing_1','O:42:\"Illuminate\\Pagination\\LengthAwarePaginator\":12:{s:8:\"\0*\0items\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:3:{i:0;O:15:\"App\\Models\\User\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"users\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:9:{s:2:\"id\";i:1;s:4:\"name\";s:9:\"Test User\";s:5:\"email\";s:16:\"test@example.com\";s:17:\"email_verified_at\";s:19:\"2025-05-09 05:59:45\";s:8:\"password\";s:60:\"$2y$12$nSKGL.WFXr3nEiXOGRbisuMIe6wp4UAWzIbRzsGnLDJClUvkRy5Xq\";s:7:\"role_id\";i:3;s:14:\"remember_token\";s:10:\"zxLRZV7Qie\";s:10:\"created_at\";s:19:\"2025-05-09 05:59:46\";s:10:\"updated_at\";s:19:\"2025-05-09 05:59:46\";}s:11:\"\0*\0original\";a:9:{s:2:\"id\";i:1;s:4:\"name\";s:9:\"Test User\";s:5:\"email\";s:16:\"test@example.com\";s:17:\"email_verified_at\";s:19:\"2025-05-09 05:59:45\";s:8:\"password\";s:60:\"$2y$12$nSKGL.WFXr3nEiXOGRbisuMIe6wp4UAWzIbRzsGnLDJClUvkRy5Xq\";s:7:\"role_id\";i:3;s:14:\"remember_token\";s:10:\"zxLRZV7Qie\";s:10:\"created_at\";s:19:\"2025-05-09 05:59:46\";s:10:\"updated_at\";s:19:\"2025-05-09 05:59:46\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:2:{s:17:\"email_verified_at\";s:8:\"datetime\";s:8:\"password\";s:6:\"hashed\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:2:{s:4:\"role\";O:15:\"App\\Models\\Role\":32:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"roles\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:4:{s:2:\"id\";i:3;s:4:\"name\";s:6:\"intern\";s:10:\"created_at\";s:19:\"2025-05-09 05:59:45\";s:10:\"updated_at\";s:19:\"2025-05-09 05:59:45\";}s:11:\"\0*\0original\";a:4:{s:2:\"id\";i:3;s:4:\"name\";s:6:\"intern\";s:10:\"created_at\";s:19:\"2025-05-09 05:59:45\";s:10:\"updated_at\";s:19:\"2025-05-09 05:59:45\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:13:\"assignedTasks\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:4:{i:0;O:15:\"App\\Models\\Task\":32:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"tasks\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:3:{s:2:\"id\";i:1;s:5:\"title\";s:5:\"erert\";s:6:\"status\";s:9:\"cancelled\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:1;s:5:\"title\";s:5:\"erert\";s:6:\"status\";s:9:\"cancelled\";s:13:\"pivot_user_id\";i:1;s:13:\"pivot_task_id\";i:1;s:16:\"pivot_created_at\";s:19:\"2025-05-09 07:21:13\";s:16:\"pivot_updated_at\";s:19:\"2025-05-09 07:21:13\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"pivot\";O:44:\"Illuminate\\Database\\Eloquent\\Relations\\Pivot\":36:{s:13:\"\0*\0connection\";N;s:8:\"\0*\0table\";s:10:\"task_users\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:0;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:4:{s:7:\"user_id\";i:1;s:7:\"task_id\";i:1;s:10:\"created_at\";s:19:\"2025-05-09 07:21:13\";s:10:\"updated_at\";s:19:\"2025-05-09 07:21:13\";}s:11:\"\0*\0original\";a:4:{s:7:\"user_id\";i:1;s:7:\"task_id\";i:1;s:10:\"created_at\";s:19:\"2025-05-09 07:21:13\";s:10:\"updated_at\";s:19:\"2025-05-09 07:21:13\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:0:{}s:11:\"pivotParent\";O:15:\"App\\Models\\User\":34:{s:13:\"\0*\0connection\";N;s:8:\"\0*\0table\";s:5:\"users\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:0;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:0:{}s:11:\"\0*\0original\";a:0:{}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:2:{s:17:\"email_verified_at\";s:8:\"datetime\";s:8:\"password\";s:6:\"hashed\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:2:{i:0;s:8:\"password\";i:1;s:14:\"remember_token\";}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:4:{i:0;s:4:\"name\";i:1;s:5:\"email\";i:2;s:8:\"password\";i:3;s:7:\"role_id\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:19:\"\0*\0authPasswordName\";s:8:\"password\";s:20:\"\0*\0rememberTokenName\";s:14:\"remember_token\";}s:12:\"pivotRelated\";O:15:\"App\\Models\\Task\":32:{s:13:\"\0*\0connection\";N;s:8:\"\0*\0table\";N;s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:0;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:0:{}s:11:\"\0*\0original\";a:0:{}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:5:\"title\";i:1;s:11:\"description\";i:2;s:6:\"status\";i:3;s:8:\"due_date\";i:4;s:10:\"created_by\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}s:13:\"\0*\0foreignKey\";s:7:\"user_id\";s:13:\"\0*\0relatedKey\";s:7:\"task_id\";}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:5:\"title\";i:1;s:11:\"description\";i:2;s:6:\"status\";i:3;s:8:\"due_date\";i:4;s:10:\"created_by\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:1;O:15:\"App\\Models\\Task\":32:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"tasks\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:3:{s:2:\"id\";i:2;s:5:\"title\";s:6:\"ghgghg\";s:6:\"status\";s:9:\"completed\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:2;s:5:\"title\";s:6:\"ghgghg\";s:6:\"status\";s:9:\"completed\";s:13:\"pivot_user_id\";i:1;s:13:\"pivot_task_id\";i:2;s:16:\"pivot_created_at\";s:19:\"2025-05-09 09:20:38\";s:16:\"pivot_updated_at\";s:19:\"2025-05-09 09:20:38\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"pivot\";O:44:\"Illuminate\\Database\\Eloquent\\Relations\\Pivot\":36:{s:13:\"\0*\0connection\";N;s:8:\"\0*\0table\";s:10:\"task_users\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:0;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:4:{s:7:\"user_id\";i:1;s:7:\"task_id\";i:2;s:10:\"created_at\";s:19:\"2025-05-09 09:20:38\";s:10:\"updated_at\";s:19:\"2025-05-09 09:20:38\";}s:11:\"\0*\0original\";a:4:{s:7:\"user_id\";i:1;s:7:\"task_id\";i:2;s:10:\"created_at\";s:19:\"2025-05-09 09:20:38\";s:10:\"updated_at\";s:19:\"2025-05-09 09:20:38\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:0:{}s:11:\"pivotParent\";r:167;s:12:\"pivotRelated\";r:211;s:13:\"\0*\0foreignKey\";s:7:\"user_id\";s:13:\"\0*\0relatedKey\";s:7:\"task_id\";}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:5:\"title\";i:1;s:11:\"description\";i:2;s:6:\"status\";i:3;s:8:\"due_date\";i:4;s:10:\"created_by\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:2;O:15:\"App\\Models\\Task\":32:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"tasks\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:3:{s:2:\"id\";i:3;s:5:\"title\";s:19:\"erterertert ert ete\";s:6:\"status\";s:9:\"completed\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:3;s:5:\"title\";s:19:\"erterertert ert ete\";s:6:\"status\";s:9:\"completed\";s:13:\"pivot_user_id\";i:1;s:13:\"pivot_task_id\";i:3;s:16:\"pivot_created_at\";s:19:\"2025-05-09 11:27:26\";s:16:\"pivot_updated_at\";s:19:\"2025-05-09 11:27:26\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"pivot\";O:44:\"Illuminate\\Database\\Eloquent\\Relations\\Pivot\":36:{s:13:\"\0*\0connection\";N;s:8:\"\0*\0table\";s:10:\"task_users\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:0;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:4:{s:7:\"user_id\";i:1;s:7:\"task_id\";i:3;s:10:\"created_at\";s:19:\"2025-05-09 11:27:26\";s:10:\"updated_at\";s:19:\"2025-05-09 11:27:26\";}s:11:\"\0*\0original\";a:4:{s:7:\"user_id\";i:1;s:7:\"task_id\";i:3;s:10:\"created_at\";s:19:\"2025-05-09 11:27:26\";s:10:\"updated_at\";s:19:\"2025-05-09 11:27:26\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:0:{}s:11:\"pivotParent\";r:167;s:12:\"pivotRelated\";r:211;s:13:\"\0*\0foreignKey\";s:7:\"user_id\";s:13:\"\0*\0relatedKey\";s:7:\"task_id\";}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:5:\"title\";i:1;s:11:\"description\";i:2;s:6:\"status\";i:3;s:8:\"due_date\";i:4;s:10:\"created_by\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:3;O:15:\"App\\Models\\Task\":32:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"tasks\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:3:{s:2:\"id\";i:4;s:5:\"title\";s:13:\"fggfdgd  dfgf\";s:6:\"status\";s:11:\"in_progress\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:4;s:5:\"title\";s:13:\"fggfdgd  dfgf\";s:6:\"status\";s:11:\"in_progress\";s:13:\"pivot_user_id\";i:1;s:13:\"pivot_task_id\";i:4;s:16:\"pivot_created_at\";s:19:\"2025-05-13 07:38:54\";s:16:\"pivot_updated_at\";s:19:\"2025-05-13 07:38:54\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"pivot\";O:44:\"Illuminate\\Database\\Eloquent\\Relations\\Pivot\":36:{s:13:\"\0*\0connection\";N;s:8:\"\0*\0table\";s:10:\"task_users\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:0;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:4:{s:7:\"user_id\";i:1;s:7:\"task_id\";i:4;s:10:\"created_at\";s:19:\"2025-05-13 07:38:54\";s:10:\"updated_at\";s:19:\"2025-05-13 07:38:54\";}s:11:\"\0*\0original\";a:4:{s:7:\"user_id\";i:1;s:7:\"task_id\";i:4;s:10:\"created_at\";s:19:\"2025-05-13 07:38:54\";s:10:\"updated_at\";s:19:\"2025-05-13 07:38:54\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:0:{}s:11:\"pivotParent\";r:167;s:12:\"pivotRelated\";r:211;s:13:\"\0*\0foreignKey\";s:7:\"user_id\";s:13:\"\0*\0relatedKey\";s:7:\"task_id\";}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:5:\"title\";i:1;s:11:\"description\";i:2;s:6:\"status\";i:3;s:8:\"due_date\";i:4;s:10:\"created_by\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:2:{i:0;s:8:\"password\";i:1;s:14:\"remember_token\";}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:4:{i:0;s:4:\"name\";i:1;s:5:\"email\";i:2;s:8:\"password\";i:3;s:7:\"role_id\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:19:\"\0*\0authPasswordName\";s:8:\"password\";s:20:\"\0*\0rememberTokenName\";s:14:\"remember_token\";}i:1;O:15:\"App\\Models\\User\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"users\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:9:{s:2:\"id\";i:2;s:4:\"name\";s:13:\"Saral Chauhan\";s:5:\"email\";s:26:\"saralchauhan.ast@gmail.com\";s:17:\"email_verified_at\";N;s:8:\"password\";s:60:\"$2y$12$vW7uLbJvctVX6rN5vBV8/eGebCgKGV2rKsBVwY3SgJAf7nYwHRjbe\";s:7:\"role_id\";i:3;s:14:\"remember_token\";N;s:10:\"created_at\";s:19:\"2025-05-09 07:20:48\";s:10:\"updated_at\";s:19:\"2025-05-09 07:20:48\";}s:11:\"\0*\0original\";a:9:{s:2:\"id\";i:2;s:4:\"name\";s:13:\"Saral Chauhan\";s:5:\"email\";s:26:\"saralchauhan.ast@gmail.com\";s:17:\"email_verified_at\";N;s:8:\"password\";s:60:\"$2y$12$vW7uLbJvctVX6rN5vBV8/eGebCgKGV2rKsBVwY3SgJAf7nYwHRjbe\";s:7:\"role_id\";i:3;s:14:\"remember_token\";N;s:10:\"created_at\";s:19:\"2025-05-09 07:20:48\";s:10:\"updated_at\";s:19:\"2025-05-09 07:20:48\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:2:{s:17:\"email_verified_at\";s:8:\"datetime\";s:8:\"password\";s:6:\"hashed\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:2:{s:4:\"role\";r:48;s:13:\"assignedTasks\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:3:{i:0;O:15:\"App\\Models\\Task\":32:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"tasks\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:3:{s:2:\"id\";i:1;s:5:\"title\";s:5:\"erert\";s:6:\"status\";s:9:\"cancelled\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:1;s:5:\"title\";s:5:\"erert\";s:6:\"status\";s:9:\"cancelled\";s:13:\"pivot_user_id\";i:2;s:13:\"pivot_task_id\";i:1;s:16:\"pivot_created_at\";s:19:\"2025-05-09 07:21:13\";s:16:\"pivot_updated_at\";s:19:\"2025-05-09 07:21:13\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"pivot\";O:44:\"Illuminate\\Database\\Eloquent\\Relations\\Pivot\":36:{s:13:\"\0*\0connection\";N;s:8:\"\0*\0table\";s:10:\"task_users\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:0;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:4:{s:7:\"user_id\";i:2;s:7:\"task_id\";i:1;s:10:\"created_at\";s:19:\"2025-05-09 07:21:13\";s:10:\"updated_at\";s:19:\"2025-05-09 07:21:13\";}s:11:\"\0*\0original\";a:4:{s:7:\"user_id\";i:2;s:7:\"task_id\";i:1;s:10:\"created_at\";s:19:\"2025-05-09 07:21:13\";s:10:\"updated_at\";s:19:\"2025-05-09 07:21:13\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:0:{}s:11:\"pivotParent\";r:167;s:12:\"pivotRelated\";r:211;s:13:\"\0*\0foreignKey\";s:7:\"user_id\";s:13:\"\0*\0relatedKey\";s:7:\"task_id\";}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:5:\"title\";i:1;s:11:\"description\";i:2;s:6:\"status\";i:3;s:8:\"due_date\";i:4;s:10:\"created_by\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:1;O:15:\"App\\Models\\Task\":32:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"tasks\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:3:{s:2:\"id\";i:2;s:5:\"title\";s:6:\"ghgghg\";s:6:\"status\";s:9:\"completed\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:2;s:5:\"title\";s:6:\"ghgghg\";s:6:\"status\";s:9:\"completed\";s:13:\"pivot_user_id\";i:2;s:13:\"pivot_task_id\";i:2;s:16:\"pivot_created_at\";s:19:\"2025-05-09 09:20:38\";s:16:\"pivot_updated_at\";s:19:\"2025-05-09 09:20:38\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"pivot\";O:44:\"Illuminate\\Database\\Eloquent\\Relations\\Pivot\":36:{s:13:\"\0*\0connection\";N;s:8:\"\0*\0table\";s:10:\"task_users\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:0;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:4:{s:7:\"user_id\";i:2;s:7:\"task_id\";i:2;s:10:\"created_at\";s:19:\"2025-05-09 09:20:38\";s:10:\"updated_at\";s:19:\"2025-05-09 09:20:38\";}s:11:\"\0*\0original\";a:4:{s:7:\"user_id\";i:2;s:7:\"task_id\";i:2;s:10:\"created_at\";s:19:\"2025-05-09 09:20:38\";s:10:\"updated_at\";s:19:\"2025-05-09 09:20:38\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:0:{}s:11:\"pivotParent\";r:167;s:12:\"pivotRelated\";r:211;s:13:\"\0*\0foreignKey\";s:7:\"user_id\";s:13:\"\0*\0relatedKey\";s:7:\"task_id\";}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:5:\"title\";i:1;s:11:\"description\";i:2;s:6:\"status\";i:3;s:8:\"due_date\";i:4;s:10:\"created_by\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:2;O:15:\"App\\Models\\Task\":32:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"tasks\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:3:{s:2:\"id\";i:3;s:5:\"title\";s:19:\"erterertert ert ete\";s:6:\"status\";s:9:\"completed\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:3;s:5:\"title\";s:19:\"erterertert ert ete\";s:6:\"status\";s:9:\"completed\";s:13:\"pivot_user_id\";i:2;s:13:\"pivot_task_id\";i:3;s:16:\"pivot_created_at\";s:19:\"2025-05-13 08:37:29\";s:16:\"pivot_updated_at\";s:19:\"2025-05-13 08:37:29\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"pivot\";O:44:\"Illuminate\\Database\\Eloquent\\Relations\\Pivot\":36:{s:13:\"\0*\0connection\";N;s:8:\"\0*\0table\";s:10:\"task_users\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:0;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:4:{s:7:\"user_id\";i:2;s:7:\"task_id\";i:3;s:10:\"created_at\";s:19:\"2025-05-13 08:37:29\";s:10:\"updated_at\";s:19:\"2025-05-13 08:37:29\";}s:11:\"\0*\0original\";a:4:{s:7:\"user_id\";i:2;s:7:\"task_id\";i:3;s:10:\"created_at\";s:19:\"2025-05-13 08:37:29\";s:10:\"updated_at\";s:19:\"2025-05-13 08:37:29\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:0:{}s:11:\"pivotParent\";r:167;s:12:\"pivotRelated\";r:211;s:13:\"\0*\0foreignKey\";s:7:\"user_id\";s:13:\"\0*\0relatedKey\";s:7:\"task_id\";}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:5:\"title\";i:1;s:11:\"description\";i:2;s:6:\"status\";i:3;s:8:\"due_date\";i:4;s:10:\"created_by\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:2:{i:0;s:8:\"password\";i:1;s:14:\"remember_token\";}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:4:{i:0;s:4:\"name\";i:1;s:5:\"email\";i:2;s:8:\"password\";i:3;s:7:\"role_id\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:19:\"\0*\0authPasswordName\";s:8:\"password\";s:20:\"\0*\0rememberTokenName\";s:14:\"remember_token\";}i:2;O:15:\"App\\Models\\User\":34:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"users\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:9:{s:2:\"id\";i:3;s:4:\"name\";s:6:\"Chacha\";s:5:\"email\";s:23:\"bhruhanchacha@gmail.com\";s:17:\"email_verified_at\";N;s:8:\"password\";s:60:\"$2y$12$PcUcbeWeMDy7cnbg/CAzee5fTCO12vjxHMAVsVWgX0lV//nqy86cK\";s:7:\"role_id\";i:3;s:14:\"remember_token\";N;s:10:\"created_at\";s:19:\"2025-05-09 11:24:24\";s:10:\"updated_at\";s:19:\"2025-05-09 11:24:24\";}s:11:\"\0*\0original\";a:9:{s:2:\"id\";i:3;s:4:\"name\";s:6:\"Chacha\";s:5:\"email\";s:23:\"bhruhanchacha@gmail.com\";s:17:\"email_verified_at\";N;s:8:\"password\";s:60:\"$2y$12$PcUcbeWeMDy7cnbg/CAzee5fTCO12vjxHMAVsVWgX0lV//nqy86cK\";s:7:\"role_id\";i:3;s:14:\"remember_token\";N;s:10:\"created_at\";s:19:\"2025-05-09 11:24:24\";s:10:\"updated_at\";s:19:\"2025-05-09 11:24:24\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:2:{s:17:\"email_verified_at\";s:8:\"datetime\";s:8:\"password\";s:6:\"hashed\";}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:2:{s:4:\"role\";r:48;s:13:\"assignedTasks\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:3:{i:0;O:15:\"App\\Models\\Task\":32:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"tasks\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:3:{s:2:\"id\";i:3;s:5:\"title\";s:19:\"erterertert ert ete\";s:6:\"status\";s:9:\"completed\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:3;s:5:\"title\";s:19:\"erterertert ert ete\";s:6:\"status\";s:9:\"completed\";s:13:\"pivot_user_id\";i:3;s:13:\"pivot_task_id\";i:3;s:16:\"pivot_created_at\";s:19:\"2025-05-13 08:37:29\";s:16:\"pivot_updated_at\";s:19:\"2025-05-13 08:37:29\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"pivot\";O:44:\"Illuminate\\Database\\Eloquent\\Relations\\Pivot\":36:{s:13:\"\0*\0connection\";N;s:8:\"\0*\0table\";s:10:\"task_users\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:0;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:4:{s:7:\"user_id\";i:3;s:7:\"task_id\";i:3;s:10:\"created_at\";s:19:\"2025-05-13 08:37:29\";s:10:\"updated_at\";s:19:\"2025-05-13 08:37:29\";}s:11:\"\0*\0original\";a:4:{s:7:\"user_id\";i:3;s:7:\"task_id\";i:3;s:10:\"created_at\";s:19:\"2025-05-13 08:37:29\";s:10:\"updated_at\";s:19:\"2025-05-13 08:37:29\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:0:{}s:11:\"pivotParent\";r:167;s:12:\"pivotRelated\";r:211;s:13:\"\0*\0foreignKey\";s:7:\"user_id\";s:13:\"\0*\0relatedKey\";s:7:\"task_id\";}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:5:\"title\";i:1;s:11:\"description\";i:2;s:6:\"status\";i:3;s:8:\"due_date\";i:4;s:10:\"created_by\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:1;O:15:\"App\\Models\\Task\":32:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"tasks\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:3:{s:2:\"id\";i:4;s:5:\"title\";s:13:\"fggfdgd  dfgf\";s:6:\"status\";s:11:\"in_progress\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:4;s:5:\"title\";s:13:\"fggfdgd  dfgf\";s:6:\"status\";s:11:\"in_progress\";s:13:\"pivot_user_id\";i:3;s:13:\"pivot_task_id\";i:4;s:16:\"pivot_created_at\";s:19:\"2025-05-13 07:38:54\";s:16:\"pivot_updated_at\";s:19:\"2025-05-13 07:38:54\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"pivot\";O:44:\"Illuminate\\Database\\Eloquent\\Relations\\Pivot\":36:{s:13:\"\0*\0connection\";N;s:8:\"\0*\0table\";s:10:\"task_users\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:0;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:4:{s:7:\"user_id\";i:3;s:7:\"task_id\";i:4;s:10:\"created_at\";s:19:\"2025-05-13 07:38:54\";s:10:\"updated_at\";s:19:\"2025-05-13 07:38:54\";}s:11:\"\0*\0original\";a:4:{s:7:\"user_id\";i:3;s:7:\"task_id\";i:4;s:10:\"created_at\";s:19:\"2025-05-13 07:38:54\";s:10:\"updated_at\";s:19:\"2025-05-13 07:38:54\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:0:{}s:11:\"pivotParent\";r:167;s:12:\"pivotRelated\";r:211;s:13:\"\0*\0foreignKey\";s:7:\"user_id\";s:13:\"\0*\0relatedKey\";s:7:\"task_id\";}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:5:\"title\";i:1;s:11:\"description\";i:2;s:6:\"status\";i:3;s:8:\"due_date\";i:4;s:10:\"created_by\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:2;O:15:\"App\\Models\\Task\":32:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:5:\"tasks\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:3:{s:2:\"id\";i:5;s:5:\"title\";s:7:\"werwerw\";s:6:\"status\";s:11:\"in_progress\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:5;s:5:\"title\";s:7:\"werwerw\";s:6:\"status\";s:11:\"in_progress\";s:13:\"pivot_user_id\";i:3;s:13:\"pivot_task_id\";i:5;s:16:\"pivot_created_at\";s:19:\"2025-05-13 08:36:39\";s:16:\"pivot_updated_at\";s:19:\"2025-05-13 08:36:39\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:5:\"pivot\";O:44:\"Illuminate\\Database\\Eloquent\\Relations\\Pivot\":36:{s:13:\"\0*\0connection\";N;s:8:\"\0*\0table\";s:10:\"task_users\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:0;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:4:{s:7:\"user_id\";i:3;s:7:\"task_id\";i:5;s:10:\"created_at\";s:19:\"2025-05-13 08:36:39\";s:10:\"updated_at\";s:19:\"2025-05-13 08:36:39\";}s:11:\"\0*\0original\";a:4:{s:7:\"user_id\";i:3;s:7:\"task_id\";i:5;s:10:\"created_at\";s:19:\"2025-05-13 08:36:39\";s:10:\"updated_at\";s:19:\"2025-05-13 08:36:39\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:0:{}s:10:\"\0*\0guarded\";a:0:{}s:11:\"pivotParent\";r:167;s:12:\"pivotRelated\";r:211;s:13:\"\0*\0foreignKey\";s:7:\"user_id\";s:13:\"\0*\0relatedKey\";s:7:\"task_id\";}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:5:{i:0;s:5:\"title\";i:1;s:11:\"description\";i:2;s:6:\"status\";i:3;s:8:\"due_date\";i:4;s:10:\"created_by\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:27:\"\0*\0relationAutoloadCallback\";N;s:26:\"\0*\0relationAutoloadContext\";N;s:10:\"timestamps\";b:1;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:2:{i:0;s:8:\"password\";i:1;s:14:\"remember_token\";}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:4:{i:0;s:4:\"name\";i:1;s:5:\"email\";i:2;s:8:\"password\";i:3;s:7:\"role_id\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}s:19:\"\0*\0authPasswordName\";s:8:\"password\";s:20:\"\0*\0rememberTokenName\";s:14:\"remember_token\";}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}s:10:\"\0*\0perPage\";i:15;s:14:\"\0*\0currentPage\";i:1;s:7:\"\0*\0path\";s:55:\"http://interns-task-management-system-.test/admin/users\";s:8:\"\0*\0query\";a:0:{}s:11:\"\0*\0fragment\";N;s:11:\"\0*\0pageName\";s:4:\"page\";s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:10:\"onEachSide\";i:3;s:10:\"\0*\0options\";a:2:{s:4:\"path\";s:55:\"http://interns-task-management-system-.test/admin/users\";s:8:\"pageName\";s:4:\"page\";}s:8:\"\0*\0total\";i:3;s:11:\"\0*\0lastPage\";i:1;}',1747199259),('laravel_cache_all_permissions','a:12:{s:14:\"create_interns\";i:1;s:12:\"read_interns\";i:2;s:14:\"update_interns\";i:3;s:14:\"delete_interns\";i:4;s:12:\"create_tasks\";i:5;s:10:\"read_tasks\";i:6;s:12:\"update_tasks\";i:7;s:12:\"delete_tasks\";i:8;s:13:\"create_admins\";i:9;s:11:\"read_admins\";i:10;s:13:\"update_admins\";i:11;s:13:\"delete_admins\";i:12;}',1747285654),('laravel_cache_app_permissions','a:12:{i:0;s:14:\"create_interns\";i:1;s:12:\"read_interns\";i:2;s:14:\"update_interns\";i:3;s:14:\"delete_interns\";i:4;s:12:\"create_tasks\";i:5;s:10:\"read_tasks\";i:6;s:12:\"update_tasks\";i:7;s:12:\"delete_tasks\";i:8;s:13:\"create_admins\";i:9;s:11:\"read_admins\";i:10;s:13:\"update_admins\";i:11;s:13:\"delete_admins\";}',1747202949),('laravel_cache_total_unread_admin_1','O:28:\"Illuminate\\Http\\JsonResponse\":11:{s:7:\"headers\";O:50:\"Symfony\\Component\\HttpFoundation\\ResponseHeaderBag\":5:{s:10:\"\0*\0headers\";a:3:{s:13:\"cache-control\";a:1:{i:0;s:17:\"no-cache, private\";}s:4:\"date\";a:1:{i:0;s:29:\"Fri, 09 May 2025 11:08:30 GMT\";}s:12:\"content-type\";a:1:{i:0;s:16:\"application/json\";}}s:15:\"\0*\0cacheControl\";a:0:{}s:23:\"\0*\0computedCacheControl\";a:2:{s:8:\"no-cache\";b:1;s:7:\"private\";b:1;}s:10:\"\0*\0cookies\";a:0:{}s:14:\"\0*\0headerNames\";a:3:{s:13:\"cache-control\";s:13:\"Cache-Control\";s:4:\"date\";s:4:\"Date\";s:12:\"content-type\";s:12:\"Content-Type\";}}s:10:\"\0*\0content\";s:1:\"0\";s:10:\"\0*\0version\";s:3:\"1.0\";s:13:\"\0*\0statusCode\";i:200;s:13:\"\0*\0statusText\";s:2:\"OK\";s:10:\"\0*\0charset\";N;s:7:\"\0*\0data\";s:1:\"0\";s:11:\"\0*\0callback\";N;s:18:\"\0*\0encodingOptions\";i:0;s:8:\"original\";i:0;s:9:\"exception\";N;}',1746788970),('laravel_cache_total_unread_intern_1','O:28:\"Illuminate\\Http\\JsonResponse\":11:{s:7:\"headers\";O:50:\"Symfony\\Component\\HttpFoundation\\ResponseHeaderBag\":5:{s:10:\"\0*\0headers\";a:3:{s:13:\"cache-control\";a:1:{i:0;s:17:\"no-cache, private\";}s:4:\"date\";a:1:{i:0;s:29:\"Fri, 09 May 2025 11:08:30 GMT\";}s:12:\"content-type\";a:1:{i:0;s:16:\"application/json\";}}s:15:\"\0*\0cacheControl\";a:0:{}s:23:\"\0*\0computedCacheControl\";a:2:{s:8:\"no-cache\";b:1;s:7:\"private\";b:1;}s:10:\"\0*\0cookies\";a:0:{}s:14:\"\0*\0headerNames\";a:3:{s:13:\"cache-control\";s:13:\"Cache-Control\";s:4:\"date\";s:4:\"Date\";s:12:\"content-type\";s:12:\"Content-Type\";}}s:10:\"\0*\0content\";s:1:\"0\";s:10:\"\0*\0version\";s:3:\"1.0\";s:13:\"\0*\0statusCode\";i:200;s:13:\"\0*\0statusText\";s:2:\"OK\";s:10:\"\0*\0charset\";N;s:7:\"\0*\0data\";s:1:\"0\";s:11:\"\0*\0callback\";N;s:18:\"\0*\0encodingOptions\";i:0;s:8:\"original\";i:0;s:9:\"exception\";N;}',1746788970);
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
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `task_id` bigint unsigned NOT NULL,
  `user_type` enum('admin','intern') COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_task_id_foreign` (`task_id`),
  CONSTRAINT `comments_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,1,'admin',2,'dfdsdf','2025-05-09 01:56:05','2025-05-09 01:56:05'),(2,1,'admin',2,'defsd','2025-05-09 01:56:08','2025-05-09 01:56:08'),(3,1,'intern',1,'hgfhfg','2025-05-09 03:13:04','2025-05-09 03:13:04'),(4,1,'intern',1,'htgffh','2025-05-09 03:13:11','2025-05-09 03:13:11'),(5,1,'intern',1,'HIii','2025-05-13 00:53:47','2025-05-13 00:53:47'),(6,3,'admin',2,'ttreertert rtytrr trrtyrtyrtyrtr trty rtyrt y','2025-05-13 02:52:58','2025-05-13 02:52:58'),(7,3,'admin',2,'zxzx','2025-05-13 04:09:51','2025-05-13 04:09:51');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
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
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sender_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sender_id` bigint unsigned NOT NULL,
  `receiver_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receiver_id` bigint unsigned NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `messages_sender_type_sender_id_index` (`sender_type`,`sender_id`),
  KEY `messages_receiver_type_receiver_id_index` (`receiver_type`,`receiver_id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,'fsd','intern',1,'admin',1,'2025-05-09 03:48:56','2025-05-09 03:37:44','2025-05-09 03:48:56'),(2,'wefwe','intern',1,'admin',1,'2025-05-09 03:48:56','2025-05-09 03:37:49','2025-05-09 03:48:56'),(3,'rewr','intern',1,'admin',1,'2025-05-09 03:48:56','2025-05-09 03:37:49','2025-05-09 03:48:56'),(4,'sfssdsdf','admin',2,'intern',2,'2025-05-09 05:40:31','2025-05-09 05:39:27','2025-05-09 05:40:31'),(5,'sdf','admin',2,'intern',2,'2025-05-09 05:40:31','2025-05-09 05:39:27','2025-05-09 05:40:31'),(6,'sdf','admin',2,'intern',2,'2025-05-09 05:40:31','2025-05-09 05:39:28','2025-05-09 05:40:31'),(7,'sd','admin',2,'intern',2,'2025-05-09 05:40:31','2025-05-09 05:39:28','2025-05-09 05:40:31'),(8,'fsd','admin',2,'intern',2,'2025-05-09 05:40:31','2025-05-09 05:39:29','2025-05-09 05:40:31'),(9,'rtr','intern',2,'admin',2,'2025-05-09 05:40:40','2025-05-09 05:40:33','2025-05-09 05:40:40'),(10,'trt','intern',2,'admin',2,'2025-05-09 05:40:40','2025-05-09 05:40:33','2025-05-09 05:40:40'),(11,'yrt','intern',2,'admin',2,'2025-05-09 05:40:40','2025-05-09 05:40:34','2025-05-09 05:40:40'),(12,'yrt','intern',2,'admin',2,'2025-05-09 05:40:40','2025-05-09 05:40:34','2025-05-09 05:40:40'),(13,'yry','intern',2,'admin',2,'2025-05-09 05:40:40','2025-05-09 05:40:34','2025-05-09 05:40:40'),(14,'r','intern',2,'admin',2,'2025-05-09 05:40:40','2025-05-09 05:40:34','2025-05-09 05:40:40'),(15,'etrte','admin',2,'intern',2,'2025-05-09 05:40:43','2025-05-09 05:40:43','2025-05-09 05:40:43'),(16,'te','admin',2,'intern',2,'2025-05-09 05:40:44','2025-05-09 05:40:43','2025-05-09 05:40:44'),(17,'rt','admin',2,'intern',2,'2025-05-09 05:40:44','2025-05-09 05:40:44','2025-05-09 05:40:44'),(18,'er','admin',2,'intern',2,'2025-05-09 05:40:44','2025-05-09 05:40:44','2025-05-09 05:40:44'),(19,'t34','intern',2,'admin',2,'2025-05-09 05:40:46','2025-05-09 05:40:46','2025-05-09 05:40:46'),(20,'324','intern',2,'admin',2,'2025-05-09 05:40:46','2025-05-09 05:40:46','2025-05-09 05:40:46'),(21,'234','intern',2,'admin',2,'2025-05-09 05:40:47','2025-05-09 05:40:46','2025-05-09 05:40:47'),(22,'24','intern',2,'admin',2,'2025-05-09 05:40:47','2025-05-09 05:40:46','2025-05-09 05:40:47'),(23,'te','admin',2,'intern',2,'2025-05-09 05:40:49','2025-05-09 05:40:49','2025-05-09 05:40:49'),(24,'teet','admin',2,'intern',2,'2025-05-09 05:40:49','2025-05-09 05:40:49','2025-05-09 05:40:49'),(25,'rte','admin',2,'intern',2,'2025-05-09 05:40:50','2025-05-09 05:40:49','2025-05-09 05:40:50'),(26,'te','admin',2,'intern',2,'2025-05-09 05:40:50','2025-05-09 05:40:49','2025-05-09 05:40:50'),(27,'rte','admin',2,'intern',2,'2025-05-09 05:40:50','2025-05-09 05:40:49','2025-05-09 05:40:50'),(28,'rteteterteteetretertertertert','intern',2,'admin',2,'2025-05-09 05:40:59','2025-05-09 05:40:58','2025-05-09 05:40:59'),(29,'er','intern',2,'admin',2,'2025-05-09 05:40:59','2025-05-09 05:40:59','2025-05-09 05:40:59'),(30,'tert','intern',2,'admin',2,'2025-05-09 05:40:59','2025-05-09 05:40:59','2025-05-09 05:40:59'),(31,'ert','intern',2,'admin',2,'2025-05-09 05:40:59','2025-05-09 05:40:59','2025-05-09 05:40:59'),(32,'ert','intern',2,'admin',2,'2025-05-09 05:41:00','2025-05-09 05:40:59','2025-05-09 05:41:00'),(33,'e','intern',2,'admin',2,'2025-05-09 05:41:00','2025-05-09 05:41:00','2025-05-09 05:41:00'),(34,'tert','admin',2,'intern',2,'2025-05-09 05:41:03','2025-05-09 05:41:02','2025-05-09 05:41:03'),(35,'er','admin',2,'intern',2,'2025-05-09 05:41:03','2025-05-09 05:41:02','2025-05-09 05:41:03'),(36,'er','admin',2,'intern',2,'2025-05-09 05:41:03','2025-05-09 05:41:03','2025-05-09 05:41:03'),(37,'te','admin',2,'intern',2,'2025-05-09 05:41:03','2025-05-09 05:41:03','2025-05-09 05:41:03'),(38,'rte','admin',2,'intern',2,'2025-05-09 05:41:04','2025-05-09 05:41:03','2025-05-09 05:41:04'),(39,'rt','admin',2,'intern',2,'2025-05-09 05:41:04','2025-05-09 05:41:04','2025-05-09 05:41:04'),(40,'ert','admin',2,'intern',2,'2025-05-09 05:41:04','2025-05-09 05:41:04','2025-05-09 05:41:04'),(41,'ert','admin',2,'intern',2,'2025-05-09 05:41:05','2025-05-09 05:41:04','2025-05-09 05:41:05'),(42,'ert','admin',2,'intern',2,'2025-05-09 05:41:05','2025-05-09 05:41:05','2025-05-09 05:41:05'),(43,'ert','admin',2,'intern',2,'2025-05-09 05:41:05','2025-05-09 05:41:05','2025-05-09 05:41:05'),(44,'er','admin',2,'intern',2,'2025-05-09 05:41:05','2025-05-09 05:41:05','2025-05-09 05:41:05'),(45,'hi','admin',1,'intern',1,'2025-05-13 00:55:37','2025-05-13 00:55:33','2025-05-13 00:55:37'),(46,'hi  sir','intern',1,'admin',1,'2025-05-13 00:55:43','2025-05-13 00:55:42','2025-05-13 00:55:43'),(47,'why  you dont complete your work?','admin',1,'intern',1,'2025-05-13 00:56:09','2025-05-13 00:56:08','2025-05-13 00:56:09'),(48,'it is already completed but not opened for the submission?','intern',1,'admin',1,'2025-05-13 00:56:38','2025-05-13 00:56:37','2025-05-13 00:56:38'),(49,'SDGS','intern',1,'admin',1,'2025-05-13 23:28:22','2025-05-13 23:28:20','2025-05-13 23:28:22'),(50,'DSFDSD','admin',1,'intern',1,'2025-05-13 23:28:24','2025-05-13 23:28:23','2025-05-13 23:28:24'),(51,'SDF','intern',1,'admin',1,'2025-05-13 23:28:26','2025-05-13 23:28:25','2025-05-13 23:28:26');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000001_create_cache_table',1),(2,'0001_01_01_000002_create_jobs_table',1),(3,'2025_01_01_000000_create_roles_table',1),(4,'2025_05_05_000004_create_permissions_table',1),(5,'2025_05_05_000006_create_role_permssions_table',1),(6,'2025_05_05_000007_create_users_table',1),(7,'2025_05_05_051036_create_admins_table',1),(8,'2025_05_05_085241_create_tasks_table',1),(9,'2025_05_05_090858_create_comments_table',1),(10,'2025_05_05_090859_create_task_users_table',1),(11,'2025_05_05_090860_create_messages_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `permission` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'create_interns','2025-05-09 00:29:46','2025-05-09 00:29:46'),(2,'read_interns','2025-05-09 00:29:46','2025-05-09 00:29:46'),(3,'update_interns','2025-05-09 00:29:46','2025-05-09 00:29:46'),(4,'delete_interns','2025-05-09 00:29:46','2025-05-09 00:29:46'),(5,'create_tasks','2025-05-09 00:29:46','2025-05-09 00:29:46'),(6,'read_tasks','2025-05-09 00:29:46','2025-05-09 00:29:46'),(7,'update_tasks','2025-05-09 00:29:46','2025-05-09 00:29:46'),(8,'delete_tasks','2025-05-09 00:29:46','2025-05-09 00:29:46'),(9,'create_admins','2025-05-09 00:29:46','2025-05-09 00:29:46'),(10,'read_admins','2025-05-09 00:29:46','2025-05-09 00:29:46'),(11,'update_admins','2025-05-09 00:29:46','2025-05-09 00:29:46'),(12,'delete_admins','2025-05-09 00:29:46','2025-05-09 00:29:46');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_permssions`
--

DROP TABLE IF EXISTS `role_permssions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_permssions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` bigint unsigned NOT NULL,
  `permission_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_permssions`
--

LOCK TABLES `role_permssions` WRITE;
/*!40000 ALTER TABLE `role_permssions` DISABLE KEYS */;
INSERT INTO `role_permssions` VALUES (1,1,1,'2025-05-09 00:29:46','2025-05-09 00:29:46'),(2,1,2,'2025-05-09 00:29:46','2025-05-09 00:29:46'),(3,1,3,'2025-05-09 00:29:46','2025-05-09 00:29:46'),(4,1,4,'2025-05-09 00:29:46','2025-05-09 00:29:46'),(5,1,5,'2025-05-09 00:29:46','2025-05-09 00:29:46'),(6,1,6,'2025-05-09 00:29:46','2025-05-09 00:29:46'),(7,1,7,'2025-05-09 00:29:46','2025-05-09 00:29:46'),(8,1,8,'2025-05-09 00:29:46','2025-05-09 00:29:46'),(9,1,9,'2025-05-09 00:29:46','2025-05-09 00:29:46'),(10,1,10,'2025-05-09 00:29:46','2025-05-09 00:29:46'),(11,1,11,'2025-05-09 00:29:46','2025-05-09 00:29:46'),(12,1,12,'2025-05-09 00:29:46','2025-05-09 00:29:46'),(74,2,1,'2025-05-09 05:48:35','2025-05-09 05:48:35'),(75,2,2,'2025-05-09 05:48:35','2025-05-09 05:48:35'),(76,2,3,'2025-05-09 05:48:35','2025-05-09 05:48:35'),(77,2,4,'2025-05-09 05:48:35','2025-05-09 05:48:35'),(78,2,5,'2025-05-09 05:48:35','2025-05-09 05:48:35'),(79,2,6,'2025-05-09 05:48:35','2025-05-09 05:48:35'),(80,2,7,'2025-05-09 05:48:35','2025-05-09 05:48:35'),(81,2,8,'2025-05-09 05:48:35','2025-05-09 05:48:35'),(82,2,9,'2025-05-09 05:48:35','2025-05-09 05:48:35'),(83,2,10,'2025-05-09 05:48:35','2025-05-09 05:48:35'),(84,2,11,'2025-05-09 05:48:35','2025-05-09 05:48:35'),(85,2,12,'2025-05-09 05:48:35','2025-05-09 05:48:35'),(105,3,1,'2025-05-13 02:51:30','2025-05-13 02:51:30'),(106,3,2,'2025-05-13 02:51:30','2025-05-13 02:51:30'),(107,3,5,'2025-05-13 02:51:30','2025-05-13 02:51:30'),(108,3,8,'2025-05-13 02:51:30','2025-05-13 02:51:30'),(109,3,9,'2025-05-13 02:51:30','2025-05-13 02:51:30');
/*!40000 ALTER TABLE `role_permssions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'super_admin','2025-05-09 00:29:45','2025-05-09 00:29:45'),(2,'admin','2025-05-09 00:29:45','2025-05-09 00:29:45'),(3,'intern','2025-05-09 00:29:45','2025-05-09 00:29:45');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
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
INSERT INTO `sessions` VALUES ('7yBQeZo8FVZkQ7Nf5XLbkokGAoBzDf14dOGLfvvn',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Herd/1.20.0 Chrome/120.0.6099.291 Electron/28.2.5 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUlBFTzJvZ2lmdWhwRDBuOTlvSXMzcEU0UlRxYkdYdlgzUFVDV3MxdyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTY6Imh0dHA6Ly9pbnRlcm5zLXRhc2stbWFuYWdlbWVudC1zeXN0ZW0tLnRlc3QvaW50ZXJuL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1747216924),('AgVd9u0foSFxEwflXqnJNCFwmVnZJP6FlfyjCTM5',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Herd/1.20.0 Chrome/120.0.6099.291 Electron/28.2.5 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiWTZUaHZzOWtsQzExT1hUcFdGWDNXR2lsM0JWYzV5U3ZZdFFGQUlhdSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTc6Imh0dHA6Ly9pbnRlcm5zLXRhc2stbWFuYWdlbWVudC1zeXN0ZW0tLnRlc3QvP2hlcmQ9cHJldmlldyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1747216924),('iZHl6wR7CxjdSDut2xKIRs9eEk87Xukwok7DtYOh',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiV0tSZkc1VHBMZ0t1dmNPaTJreTlHZ1RVSkVmZTBVNzRZWkRpNnVaOSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0ODoiaHR0cDovL2ludGVybnMtdGFzay1tYW5hZ2VtZW50LXN5c3RlbS0udGVzdC9jaGF0Ijt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjA6Imh0dHA6Ly9pbnRlcm5zLXRhc2stbWFuYWdlbWVudC1zeXN0ZW0tLnRlc3QvaW50ZXJuL2Rhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTE6ImxvZ2luX3VzZXJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=',1747218238),('ofq7VhctyGBWwV4urk63yotpKJG7E0QVl9LfeFMc',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Herd/1.20.0 Chrome/120.0.6099.291 Electron/28.2.5 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiekF3WXdselZUMEsybzRVcmNtcWdWd01lMTR5VE12dUhsMlM4VURLRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTY6Imh0dHA6Ly9pbnRlcm5zLXRhc2stbWFuYWdlbWVudC1zeXN0ZW0tLnRlc3QvaW50ZXJuL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1747216933),('rk4vJuG7mYiXR1lUddXLb5UNYBZRZuPSM7RS9Me4',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiV1VQS0lhQ09mS3ZjeWNkUkM2c1RlR0tWRnFqdXJUZGFEMFhOTTF1RCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDk6Imh0dHA6Ly9pbnRlcm5zLXRhc2stbWFuYWdlbWVudC1zeXN0ZW0tLnRlc3QvYWRtaW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUyOiJsb2dpbl9hZG1pbl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==',1747217998),('Tzjai7pYB14FK6XPQxCZ8Ojbf53BKhna5mvPfycf',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Herd/1.20.0 Chrome/120.0.6099.291 Electron/28.2.5 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiOVVGNnNZcHNFU2hKZnBVam8wck9ReXBDZTRCN3R0emc0RjRyNzBObSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTY6Imh0dHA6Ly9pbnRlcm5zLXRhc2stbWFuYWdlbWVudC1zeXN0ZW0tLnRlc3QvaW50ZXJuL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1747216885),('vf6Z0epSCgFTAQyd4h88Fy1PlWUqRPyuW9EgeSt1',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Herd/1.20.0 Chrome/120.0.6099.291 Electron/28.2.5 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoidm9nNjZZTENucUkxc3hxaWJtV0xYTzVzT1dOZEVxUFBVZnJBMVg0ZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTc6Imh0dHA6Ly9pbnRlcm5zLXRhc2stbWFuYWdlbWVudC1zeXN0ZW0tLnRlc3QvP2hlcmQ9cHJldmlldyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1747216933),('Zrf9CsnDOu7Tvo1VKLmyVr9bQfHX7qt03ylrPXbR',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Herd/1.20.0 Chrome/120.0.6099.291 Electron/28.2.5 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiY0FJQ09aT1Jyb1cwYTNreWVkazQ5bDhXRUJCTFAycUgwZklFQ1BwQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTc6Imh0dHA6Ly9pbnRlcm5zLXRhc2stbWFuYWdlbWVudC1zeXN0ZW0tLnRlc3QvP2hlcmQ9cHJldmlldyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1747216885);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task_users`
--

DROP TABLE IF EXISTS `task_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `task_users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `task_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `task_users_task_id_foreign` (`task_id`),
  KEY `task_users_user_id_foreign` (`user_id`),
  CONSTRAINT `task_users_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE,
  CONSTRAINT `task_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_users`
--

LOCK TABLES `task_users` WRITE;
/*!40000 ALTER TABLE `task_users` DISABLE KEYS */;
INSERT INTO `task_users` VALUES (1,1,1,'2025-05-09 01:51:13','2025-05-09 01:51:13'),(2,1,2,'2025-05-09 01:51:13','2025-05-09 01:51:13'),(3,2,1,'2025-05-09 03:50:38','2025-05-09 03:50:38'),(4,2,2,'2025-05-09 03:50:38','2025-05-09 03:50:38'),(5,3,1,'2025-05-09 05:57:26','2025-05-09 05:57:26'),(8,4,1,'2025-05-13 02:08:54','2025-05-13 02:08:54'),(9,4,3,'2025-05-13 02:08:54','2025-05-13 02:08:54'),(10,5,3,'2025-05-13 03:06:39','2025-05-13 03:06:39'),(11,3,2,'2025-05-13 03:07:29','2025-05-13 03:07:29'),(12,3,3,'2025-05-13 03:07:29','2025-05-13 03:07:29'),(13,6,3,'2025-05-14 03:21:38','2025-05-14 03:21:38');
/*!40000 ALTER TABLE `task_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tasks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','in_progress','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL,
  `due_date` timestamp NOT NULL,
  `created_by` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks`
--

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
INSERT INTO `tasks` VALUES (1,'erert','fsdfsrewr er ewr wer werwe','cancelled','2025-05-09 18:30:00',1,'2025-05-09 01:51:13','2025-05-13 00:55:09'),(2,'ghgghg','hghghghghgvvvvvvvvvvvadd','completed','2025-05-08 18:30:00',1,'2025-05-09 03:50:38','2025-05-13 00:54:53'),(3,'erterertert ert ete','34 34  eg dg dfd','completed','2025-05-09 18:30:00',2,'2025-05-09 05:57:26','2025-05-13 03:09:29'),(4,'fggfdgd  dfgf','fsdssdfs fsfsd f sfd fdsd fsd fsd fsdd fdsds fsdfdfdg fdgdfgdtert 89erte98 rte rt8eyterytyie trhtertiherterithertietrer','in_progress','2025-05-30 18:30:00',2,'2025-05-13 02:08:54','2025-05-13 02:09:05'),(5,'werwerw','sfsdf sdfsdfsdf','in_progress','2025-05-14 18:30:00',2,'2025-05-13 03:06:39','2025-05-13 03:06:39'),(6,'grdrgdrg','dgdfgd dfg df gd gdf gd','in_progress','2025-05-21 18:30:00',1,'2025-05-14 03:21:38','2025-05-14 03:21:38');
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
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
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Test User','test@example.com','2025-05-09 00:29:45','$2y$12$nSKGL.WFXr3nEiXOGRbisuMIe6wp4UAWzIbRzsGnLDJClUvkRy5Xq',3,'mhU5QLs6xYIPpcW3ggurXuqu1v6xK0r5fSVhGrIdiavS9AleGbjAtZBSUGQD','2025-05-09 00:29:46','2025-05-09 00:29:46'),(2,'Saral Chauhan','saralchauhan.ast@gmail.com',NULL,'$2y$12$vW7uLbJvctVX6rN5vBV8/eGebCgKGV2rKsBVwY3SgJAf7nYwHRjbe',3,NULL,'2025-05-09 01:50:48','2025-05-09 01:50:48'),(3,'Chacha','bhruhanchacha@gmail.com',NULL,'$2y$12$PcUcbeWeMDy7cnbg/CAzee5fTCO12vjxHMAVsVWgX0lV//nqy86cK',3,NULL,'2025-05-09 05:54:24','2025-05-09 05:54:24');
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

-- Dump completed on 2025-05-14 15:54:11
