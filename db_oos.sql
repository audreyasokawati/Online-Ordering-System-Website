/*
 Navicat Premium Data Transfer

 Source Server         : odey
 Source Server Type    : MySQL
 Source Server Version : 100138
 Source Host           : localhost:3306
 Source Schema         : db_oos

 Target Server Type    : MySQL
 Target Server Version : 100138
 File Encoding         : 65001

 Date: 01/06/2020 19:42:15
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tb_akun
-- ----------------------------
DROP TABLE IF EXISTS `tb_akun`;
CREATE TABLE `tb_akun`  (
  `id_akun` int(255) NOT NULL AUTO_INCREMENT,
  `jabatan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_akun`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tb_akun
-- ----------------------------
INSERT INTO `tb_akun` VALUES (1, 'Admin');
INSERT INTO `tb_akun` VALUES (2, 'Kasir');

-- ----------------------------
-- Table structure for tb_detail_order
-- ----------------------------
DROP TABLE IF EXISTS `tb_detail_order`;
CREATE TABLE `tb_detail_order`  (
  `id_detail_order` int(255) NOT NULL AUTO_INCREMENT,
  `id_order` int(255) NOT NULL,
  `id_menu` int(255) NOT NULL,
  `jumlah_order` int(255) NOT NULL,
  `subtotal_order` int(255) NOT NULL,
  `status_detail_order` int(2) NOT NULL,
  PRIMARY KEY (`id_detail_order`) USING BTREE,
  INDEX `id_order`(`id_order`) USING BTREE,
  INDEX `id_menu`(`id_menu`) USING BTREE,
  CONSTRAINT `tb_detail_order_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `tb_order` (`id_order`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tb_detail_order_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `tb_menu` (`id_menu`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 90 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tb_kategori
-- ----------------------------
DROP TABLE IF EXISTS `tb_kategori`;
CREATE TABLE `tb_kategori`  (
  `id_kategori` int(255) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_kategori`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tb_kategori
-- ----------------------------
INSERT INTO `tb_kategori` VALUES (1, 'Makanan');
INSERT INTO `tb_kategori` VALUES (2, 'Minuman');

-- ----------------------------
-- Table structure for tb_kode
-- ----------------------------
DROP TABLE IF EXISTS `tb_kode`;
CREATE TABLE `tb_kode`  (
  `id_kode` int(255) NOT NULL AUTO_INCREMENT,
  `kodeUnik` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `statusKode` int(2) NOT NULL,
  PRIMARY KEY (`id_kode`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 74 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tb_kode
-- ----------------------------
INSERT INTO `tb_kode` VALUES (0, 'admin123', 0);
INSERT INTO `tb_kode` VALUES (64, 'e9390f', 0);
INSERT INTO `tb_kode` VALUES (65, '1b5e77', 0);
INSERT INTO `tb_kode` VALUES (66, '8e6281', 0);
INSERT INTO `tb_kode` VALUES (67, '7fde6d', 0);
INSERT INTO `tb_kode` VALUES (68, 'd247be', 0);
INSERT INTO `tb_kode` VALUES (69, '571d2e', 0);
INSERT INTO `tb_kode` VALUES (70, '69a7be', 0);
INSERT INTO `tb_kode` VALUES (71, 'f7ebdc', 0);
INSERT INTO `tb_kode` VALUES (72, 'e98282', 0);
INSERT INTO `tb_kode` VALUES (73, 'a78b1c', 0);

-- ----------------------------
-- Table structure for tb_menu
-- ----------------------------
DROP TABLE IF EXISTS `tb_menu`;
CREATE TABLE `tb_menu`  (
  `id_menu` int(255) NOT NULL AUTO_INCREMENT,
  `nama_menu` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kategori_menu` int(3) NOT NULL,
  `harga_menu` int(255) NOT NULL,
  `foto_menu` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `status_menu` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_menu`) USING BTREE,
  INDEX `kategori_menu`(`kategori_menu`) USING BTREE,
  CONSTRAINT `tb_menu_ibfk_1` FOREIGN KEY (`kategori_menu`) REFERENCES `tb_kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tb_menu
-- ----------------------------
INSERT INTO `tb_menu` VALUES (1, 'Nasi Goreng    ', 1, 30000, 'nasigoreng.jpg', '1');
INSERT INTO `tb_menu` VALUES (2, 'Kopi       ', 2, 0, 'ayamgoreng.jpg', '1');

-- ----------------------------
-- Table structure for tb_order
-- ----------------------------
DROP TABLE IF EXISTS `tb_order`;
CREATE TABLE `tb_order`  (
  `id_order` int(255) NOT NULL AUTO_INCREMENT,
  `id_kode` int(255) NOT NULL,
  `no_meja` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tanggal_order` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  `nama_pembeli` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `total_harga` int(255) NOT NULL,
  `status_order` int(2) NOT NULL,
  `jenisPembayaran` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_order`) USING BTREE,
  INDEX `id_kode`(`id_kode`) USING BTREE,
  CONSTRAINT `tb_order_ibfk_1` FOREIGN KEY (`id_kode`) REFERENCES `tb_kode` (`id_kode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 34 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tb_order
-- ----------------------------
INSERT INTO `tb_order` VALUES (0, 0, '0', '2020-06-01 19:41:33', 'admin', 0, 0, 'CASH');

-- ----------------------------
-- Table structure for tb_user
-- ----------------------------
DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user`  (
  `id_user` int(255) NOT NULL AUTO_INCREMENT,
  `id_akun` int(255) NOT NULL,
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_user`) USING BTREE,
  INDEX `id_akun`(`id_akun`) USING BTREE,
  CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`id_akun`) REFERENCES `tb_akun` (`id_akun`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tb_user
-- ----------------------------
INSERT INTO `tb_user` VALUES (1, 1, 'audrey', 'audrey');
INSERT INTO `tb_user` VALUES (2, 1, 'rully', 'rully');
INSERT INTO `tb_user` VALUES (3, 1, 'dhimas', 'dhimas');
INSERT INTO `tb_user` VALUES (4, 1, 'andin', 'andin');
INSERT INTO `tb_user` VALUES (5, 2, 'kasir', 'kasir');
INSERT INTO `tb_user` VALUES (6, 1, 'admin', 'admin');

SET FOREIGN_KEY_CHECKS = 1;
