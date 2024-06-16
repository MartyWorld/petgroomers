/*
 Navicat Premium Data Transfer

 Source Server         : 0-localhost
 Source Server Type    : MySQL
 Source Server Version : 100427
 Source Host           : localhost:3306
 Source Schema         : petcare

 Target Server Type    : MySQL
 Target Server Version : 100427
 File Encoding         : 65001

 Date: 16/06/2024 17:19:30
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for contact_us
-- ----------------------------
DROP TABLE IF EXISTS `contact_us`;
CREATE TABLE `contact_us`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `lastName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `mobile` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `contact_us_id_index`(`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of contact_us
-- ----------------------------

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (5, '2024_06_15_085850_add_missing_column_in_usres', 2);
INSERT INTO `migrations` VALUES (7, '2024_06_15_00000_create_on_board_pets_table', 3);
INSERT INTO `migrations` VALUES (8, '2024_06_15_085926_create_petlockers_table', 3);
INSERT INTO `migrations` VALUES (9, '2024_06_15_085958_create_on_board_pricings_table', 3);
INSERT INTO `migrations` VALUES (10, '2024_06_15_090209_create_contact_us_table', 3);
INSERT INTO `migrations` VALUES (11, '2024_06_16_105848_addmisssing_coumn_in_pet_car', 4);
INSERT INTO `migrations` VALUES (12, '2024_06_16_111006_addmisssing_coumn_in_pet_care', 5);
INSERT INTO `migrations` VALUES (13, '2024_06_16_115933_addmisssing_coumn_in_pet_cares', 5);

-- ----------------------------
-- Table structure for on_board_pets
-- ----------------------------
DROP TABLE IF EXISTS `on_board_pets`;
CREATE TABLE `on_board_pets`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `petName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` bigint NOT NULL DEFAULT 0,
  `weight` bigint NOT NULL DEFAULT 0,
  `pricingId` bigint NOT NULL DEFAULT 0,
  `lockerId` bigint NOT NULL DEFAULT 0,
  `paymentStatus` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `checkIn` timestamp(0) NULL DEFAULT NULL,
  `checkOut` timestamp(0) NULL DEFAULT NULL,
  `lastUpdate` timestamp(0) NULL DEFAULT NULL,
  `description` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `instructions` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `dueAmount` double(9, 2) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `on_board_pets_id_index`(`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of on_board_pets
-- ----------------------------

-- ----------------------------
-- Table structure for on_board_pricings
-- ----------------------------
DROP TABLE IF EXISTS `on_board_pricings`;
CREATE TABLE `on_board_pricings`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `planName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(9, 2) NOT NULL DEFAULT 0,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `on_board_pricings_id_index`(`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of on_board_pricings
-- ----------------------------
INSERT INTO `on_board_pricings` VALUES (1, 'Dog Rate Under 2', '2', 10.00, '2024-06-16 15:15:59', NULL);
INSERT INTO `on_board_pricings` VALUES (2, 'Dog Rate Under 2 - to 5', '5', 20.00, '2024-06-16 15:16:22', NULL);
INSERT INTO `on_board_pricings` VALUES (3, 'Dog Rate Above 5', '100', 100.00, '2024-06-16 15:17:06', NULL);
INSERT INTO `on_board_pricings` VALUES (4, 'Cat Rate', '10', 50.00, '2024-06-16 15:17:41', NULL);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token`) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type`, `tokenable_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for petlockers
-- ----------------------------
DROP TABLE IF EXISTS `petlockers`;
CREATE TABLE `petlockers`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `LockerName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `petId` bigint UNSIGNED NULL DEFAULT 0,
  `petName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `petInTime` timestamp(0) NULL DEFAULT NULL,
  `petOutTime` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `petlockers_petid_foreign`(`petId`) USING BTREE,
  INDEX `petlockers_id_index`(`id`) USING BTREE,
  INDEX `petlockers_lockername_index`(`LockerName`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 43 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of petlockers
-- ----------------------------
INSERT INTO `petlockers` VALUES (1, 'Dog Locker #1', NULL, NULL, NULL, NULL, '2024-06-16 15:27:07', NULL);
INSERT INTO `petlockers` VALUES (2, 'Dog Locker #2', NULL, NULL, NULL, NULL, '2024-06-16 15:27:07', NULL);
INSERT INTO `petlockers` VALUES (3, 'Dog Locker #3', NULL, NULL, NULL, NULL, '2024-06-16 15:27:07', NULL);
INSERT INTO `petlockers` VALUES (4, 'Dog Locker #4', NULL, NULL, NULL, NULL, '2024-06-16 15:27:07', NULL);
INSERT INTO `petlockers` VALUES (5, 'Dog Locker #5', NULL, NULL, NULL, NULL, '2024-06-16 15:27:07', NULL);
INSERT INTO `petlockers` VALUES (6, 'Dog Locker #6', NULL, NULL, NULL, NULL, '2024-06-16 15:27:07', NULL);
INSERT INTO `petlockers` VALUES (7, 'Dog Locker #7', NULL, NULL, NULL, NULL, '2024-06-16 15:27:07', NULL);
INSERT INTO `petlockers` VALUES (8, 'Dog Locker #8', NULL, NULL, NULL, NULL, '2024-06-16 15:27:07', NULL);
INSERT INTO `petlockers` VALUES (9, 'Dog Locker #9', NULL, NULL, NULL, NULL, '2024-06-16 15:27:07', NULL);
INSERT INTO `petlockers` VALUES (10, 'Dog Locker #10', NULL, NULL, NULL, NULL, '2024-06-16 15:27:07', NULL);
INSERT INTO `petlockers` VALUES (11, 'Dog Locker #11', NULL, NULL, NULL, NULL, '2024-06-16 15:27:07', NULL);
INSERT INTO `petlockers` VALUES (12, 'Dog Locker #12', NULL, NULL, NULL, NULL, '2024-06-16 15:27:07', NULL);
INSERT INTO `petlockers` VALUES (13, 'Dog Locker #13', NULL, NULL, NULL, NULL, '2024-06-16 15:27:07', NULL);
INSERT INTO `petlockers` VALUES (14, 'Dog Locker #14', NULL, NULL, NULL, NULL, '2024-06-16 15:27:07', NULL);
INSERT INTO `petlockers` VALUES (15, 'Dog Locker #15', NULL, NULL, NULL, NULL, '2024-06-16 15:27:07', NULL);
INSERT INTO `petlockers` VALUES (16, 'Dog Locker #16', NULL, NULL, NULL, NULL, '2024-06-16 15:27:07', NULL);
INSERT INTO `petlockers` VALUES (17, 'Dog Locker #17', NULL, NULL, NULL, NULL, '2024-06-16 15:27:07', NULL);
INSERT INTO `petlockers` VALUES (18, 'Dog Locker #18', NULL, NULL, NULL, NULL, '2024-06-16 15:27:07', NULL);
INSERT INTO `petlockers` VALUES (19, 'Dog Locker #19', NULL, NULL, NULL, NULL, '2024-06-16 15:27:07', NULL);
INSERT INTO `petlockers` VALUES (20, 'Dog Locker #20', NULL, NULL, NULL, NULL, '2024-06-16 15:27:07', NULL);
INSERT INTO `petlockers` VALUES (21, 'Dog Locker #21', NULL, NULL, NULL, NULL, '2024-06-16 15:27:07', NULL);
INSERT INTO `petlockers` VALUES (22, 'Dog Locker #22', NULL, NULL, NULL, NULL, '2024-06-16 15:27:07', NULL);
INSERT INTO `petlockers` VALUES (23, 'Dog Locker #23', NULL, NULL, NULL, NULL, '2024-06-16 15:27:07', NULL);
INSERT INTO `petlockers` VALUES (24, 'Dog Locker #24', NULL, NULL, NULL, NULL, '2024-06-16 15:27:07', NULL);
INSERT INTO `petlockers` VALUES (25, 'Dog Locker #25', NULL, NULL, NULL, NULL, '2024-06-16 15:27:07', NULL);
INSERT INTO `petlockers` VALUES (26, 'Dog Locker #26', NULL, NULL, NULL, NULL, '2024-06-16 15:27:07', NULL);
INSERT INTO `petlockers` VALUES (27, 'Dog Locker #27', NULL, NULL, NULL, NULL, '2024-06-16 15:27:07', NULL);
INSERT INTO `petlockers` VALUES (28, 'Dog Locker #28', NULL, NULL, NULL, NULL, '2024-06-16 15:27:07', NULL);
INSERT INTO `petlockers` VALUES (29, 'Dog Locker #29', NULL, NULL, NULL, NULL, '2024-06-16 15:27:07', NULL);
INSERT INTO `petlockers` VALUES (30, 'Dog Locker #30', NULL, NULL, NULL, NULL, '2024-06-16 15:27:07', NULL);
INSERT INTO `petlockers` VALUES (31, 'Cat Locker #1', NULL, NULL, NULL, NULL, '2024-06-16 15:27:07', '2024-06-16 11:47:09');
INSERT INTO `petlockers` VALUES (32, 'Cat Locker #2', NULL, NULL, NULL, NULL, '2024-06-16 15:27:07', NULL);
INSERT INTO `petlockers` VALUES (33, 'Cat Locker #3', NULL, NULL, NULL, NULL, '2024-06-16 15:27:07', NULL);
INSERT INTO `petlockers` VALUES (34, 'Cat Locker #4', NULL, NULL, NULL, NULL, '2024-06-16 15:27:07', NULL);
INSERT INTO `petlockers` VALUES (35, 'Cat Locker #5', NULL, NULL, NULL, NULL, '2024-06-16 15:27:07', NULL);
INSERT INTO `petlockers` VALUES (36, 'Cat Locker #6', NULL, NULL, NULL, NULL, '2024-06-16 15:27:07', NULL);
INSERT INTO `petlockers` VALUES (37, 'Cat Locker #7', NULL, NULL, NULL, NULL, '2024-06-16 15:27:07', NULL);
INSERT INTO `petlockers` VALUES (38, 'Cat Locker #8', NULL, NULL, NULL, NULL, '2024-06-16 15:27:07', NULL);
INSERT INTO `petlockers` VALUES (39, 'Cat Locker #9', NULL, NULL, NULL, NULL, '2024-06-16 15:27:07', NULL);
INSERT INTO `petlockers` VALUES (40, 'Cat Locker #10', NULL, NULL, NULL, NULL, '2024-06-16 15:27:07', NULL);
INSERT INTO `petlockers` VALUES (41, 'Cat Locker #11', NULL, NULL, NULL, NULL, '2024-06-16 15:27:07', NULL);
INSERT INTO `petlockers` VALUES (42, 'Cat Locker #12', NULL, NULL, NULL, NULL, '2024-06-16 15:27:07', NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `userType` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Super  Admin', 'admin@petCare.com', '2024-06-15 15:44:33', '$2y$10$ewdteSgh01vAeue/PQsZ4OqDRegtWCj5n28qAYsEzFX2Ha2PYp.2G', NULL, '2024-06-15 15:44:48', '2024-06-15 15:44:52', NULL);

SET FOREIGN_KEY_CHECKS = 1;
