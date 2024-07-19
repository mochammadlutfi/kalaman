/*
 Navicat Premium Data Transfer

 Source Server         : project
 Source Server Type    : MySQL
 Source Server Version : 50724 (5.7.24)
 Source Host           : localhost:3306
 Source Schema         : db_kalaman

 Target Server Type    : MySQL
 Target Server Version : 50724 (5.7.24)
 File Encoding         : 65001

 Date: 20/07/2024 04:25:48
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admins
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(191) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `username` varchar(191) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(191) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `remember_token` varchar(191) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admins
-- ----------------------------
INSERT INTO `admins` VALUES (1, 'Admin', 'admin', '$2y$10$J6.BnjttGJXeLrQOdHkjKO5oMFCicgoTJYjt7Ph84Zewh1R8tD3j.', 'jKYQ7eFuA9iNFihVTOJtcCDwjPuhr0Gz3ljVecbIbwFOCsaMsHn2Tpq4DgSC', '2023-10-20 10:39:58', '2023-10-20 10:39:58');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (5, '2023_07_31_062928_create_permission_tables', 2);

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `paket_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `nomor` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `durasi` int(11) NULL DEFAULT NULL,
  `harga` float NULL DEFAULT NULL,
  `tgl` date NULL DEFAULT NULL,
  `total` float NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `order_user_rel`(`user_id`) USING BTREE,
  INDEX `order_paket_rel`(`paket_id`) USING BTREE,
  CONSTRAINT `order_user_rel` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `order_paket_rel` FOREIGN KEY (`paket_id`) REFERENCES `paket` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of order
-- ----------------------------
INSERT INTO `order` VALUES (1, 10, 2, NULL, 3, 6000000, '2024-07-19', 18000000, '2024-07-19 17:38:00', '2024-07-19 19:02:05');
INSERT INTO `order` VALUES (2, 10, 3, 'ORD.2407-00001', 1, 8500000, '2024-07-20', 8500000, '2024-07-20 02:17:39', '2024-07-20 02:17:39');

-- ----------------------------
-- Table structure for paket
-- ----------------------------
DROP TABLE IF EXISTS `paket`;
CREATE TABLE `paket`  (
  `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `harga` float NOT NULL,
  `fitur` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `deskripsi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of paket
-- ----------------------------
INSERT INTO `paket` VALUES (1, 'Starter', 3000000, '10 Konten Feed,15 Konten Story,2x Revisi per Desain,15 Konten Video Infografis/Footage,Free Riset Hashtag,Free Copywriting,Free Schedule Posting,Free Admin Posting', 'Direkomendasi untuk Anda yang ingin melacak brand secara individual', '2024-07-19 04:31:53', '2024-07-19 06:08:43');
INSERT INTO `paket` VALUES (2, 'Lite', 6000000, '10 Konten Feed,15 Konten Story,2x Revisi per Desain,15 Konten Video Infografis/Footage,Free Riset Hashtag,Free Copywriting,Free Schedule Posting,Free Admin Posting', 'Bagus untuk Startup atau UKM melakukan tracking atau menganalisis mention', '2024-07-19 04:32:17', '2024-07-19 06:50:28');
INSERT INTO `paket` VALUES (3, 'Business', 8500000, '10 Konten Feed,15 Konten Story,2x Revisi per Desain,15 Konten Video Infografis/Footage,Free Riset Hashtag,Free Copywriting,Free Schedule Posting,Free Admin Posting', 'Bagus untuk Startup atau UKM melakukan tracking atau menganalisis mention', '2024-07-19 04:32:17', '2024-07-19 06:50:28');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for pembayaran
-- ----------------------------
DROP TABLE IF EXISTS `pembayaran`;
CREATE TABLE `pembayaran`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `tgl` date NOT NULL,
  `jumlah` float NOT NULL,
  `bukti` varchar(191) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status` enum('terima','tolak','pending') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pembayaran
-- ----------------------------

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token`) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type`, `tokenable_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for project
-- ----------------------------
DROP TABLE IF EXISTS `project`;
CREATE TABLE `project`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `order_id` bigint(20) NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of project
-- ----------------------------
INSERT INTO `project` VALUES (1, 10, NULL, 2, 'Facebook', '2024-07-19 19:47:37', '2024-07-19 19:47:37');

-- ----------------------------
-- Table structure for task
-- ----------------------------
DROP TABLE IF EXISTS `task`;
CREATE TABLE `task`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `project_id` bigint(20) UNSIGNED NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `link_brief` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tgl_tempo` date NULL DEFAULT NULL,
  `tgl_upload` datetime NULL DEFAULT NULL,
  `status_upload` tinyint(1) UNSIGNED NULL DEFAULT 0,
  `status` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `file` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `task_project_rel`(`project_id`) USING BTREE,
  CONSTRAINT `task_project_rel` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of task
-- ----------------------------
INSERT INTO `task` VALUES (1, 1, 'Task 1', 'https://docs.google.com', '2024-07-20', '2024-07-20 03:58:00', 0, 'pending', NULL, '2024-07-19 21:02:19', '2024-07-19 21:02:19');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `hp` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jk` enum('L','P') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tmp_lahir` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tgl_lahir` date NULL DEFAULT NULL,
  `instansi` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `jabatan` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `username`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (2, 'Bhisma', 'bhisma@gmail.com', '12421321', 'L', NULL, NULL, NULL, NULL, 'wqeqwe', '$2y$10$/yK5YMDP2DW2GPDq0Z90.uKdp2Dr8M031KB/FjO7g79XTD7CIlKQ.', 'M7HvBDLQHW1d9Qm78FsWgq0buhfLDthLKRHyviO07dGvlHST6jeqyBjH0y93', '2023-07-20 16:12:22', '2023-10-20 07:18:37');
INSERT INTO `users` VALUES (7, 'Udin edit', 'udin123@gmail.com', '12312412312', 'P', NULL, NULL, NULL, NULL, 'adksandaskln', '$2y$10$J6.BnjttGJXeLrQOdHkjKO5oMFCicgoTJYjt7Ph84Zewh1R8tD3j.', 'ehecA4aL4QIOcENK2ZAT7r46gwBiHOyXJ3eitl25ypOT78w9pScT5VpXpxET', '2023-10-20 04:38:30', '2023-10-20 06:40:32');
INSERT INTO `users` VALUES (8, 'Bhisma', 'bhisma12@gmail.com', '123415213', 'L', NULL, NULL, NULL, NULL, 'Bandung', '$2y$10$I7QJX2uk9xt7gwTBRTnMoeneiQlxO8dSV1LQxVHXhT6fkgqV.DzVC', 'ADNPucM4uMx1eE4weJnAdqtjKtl4V2wnJLGK46xP01E9nYrqSuNp7z4kjbSO', '2023-10-20 15:42:54', '2023-10-20 15:42:54');
INSERT INTO `users` VALUES (9, 'Testing', 'testing@gmail.com', '12345678945', 'L', 'Bandung', '2024-01-24', NULL, NULL, 'Jl Bandung', '$2y$10$5RHmuSEF/GDfmGrQDXEXEuJbFgSH1cJQuLgvoinWCAg9bwMEYp.OG', 'pnv4xXQ2nqt9C1MgDkyKXBweZBM4FUBwD8oeJyeUr50s3yH6ZN43YUorcQy2', '2024-01-02 10:15:58', '2024-01-02 10:15:58');
INSERT INTO `users` VALUES (10, 'User Test', 'user@gmail.com', '2131', 'L', NULL, NULL, NULL, NULL, NULL, '$2y$10$hmMOLpuKhUdQH57cPN9VyuLTK7CKt/.fvvlLvA4c981F0klWFtpk2', 'ZSTvTCwVpC7TvCpQxVSKyApQPj0h7a0o0Fua3tx6x6VbMQ5EpHHrgtpT5Ee8', '2024-07-06 03:58:19', '2024-07-06 03:58:19');

SET FOREIGN_KEY_CHECKS = 1;
