/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 100132
 Source Host           : localhost:3306
 Source Schema         : motorepuestosjc

 Target Server Type    : MySQL
 Target Server Version : 100132
 File Encoding         : 65001

 Date: 08/09/2020 06:36:52
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for modulo
-- ----------------------------
DROP TABLE IF EXISTS `modulo`;
CREATE TABLE `modulo`  (
  `idmodulo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `url` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `idmodulopadre` int(11) NULL DEFAULT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idmodulo`) USING BTREE,
  INDEX `idmodulopadre`(`idmodulopadre`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of modulo
-- ----------------------------
INSERT INTO `modulo` VALUES (1, 'MANENIMIENTO', NULL, 0, 1);
INSERT INTO `modulo` VALUES (2, 'Cliente', NULL, 1, 1);
INSERT INTO `modulo` VALUES (3, 'Producto', NULL, 1, 1);
INSERT INTO `modulo` VALUES (4, 'VENTAS', NULL, 0, 1);
INSERT INTO `modulo` VALUES (5, 'generar venta', NULL, 4, 1);

-- ----------------------------
-- Table structure for perfil
-- ----------------------------
DROP TABLE IF EXISTS `perfil`;
CREATE TABLE `perfil`  (
  `idperfil` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idperfil`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of perfil
-- ----------------------------
INSERT INTO `perfil` VALUES (1, 'admin', 1);

-- ----------------------------
-- Table structure for permiso
-- ----------------------------
DROP TABLE IF EXISTS `permiso`;
CREATE TABLE `permiso`  (
  `idpermiso` int(11) NOT NULL AUTO_INCREMENT,
  `idmodulo` int(11) NULL DEFAULT NULL,
  `idperfil` int(11) NULL DEFAULT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idpermiso`) USING BTREE,
  INDEX `idmodulo`(`idmodulo`) USING BTREE,
  INDEX `idperfil`(`idperfil`) USING BTREE,
  CONSTRAINT `permiso_ibfk_1` FOREIGN KEY (`idmodulo`) REFERENCES `modulo` (`idmodulo`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `permiso_ibfk_2` FOREIGN KEY (`idperfil`) REFERENCES `perfil` (`idperfil`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of permiso
-- ----------------------------
INSERT INTO `permiso` VALUES (1, 1, 1, 1);
INSERT INTO `permiso` VALUES (2, 2, 1, 1);
INSERT INTO `permiso` VALUES (3, 3, 1, 1);
INSERT INTO `permiso` VALUES (4, 4, 1, 1);
INSERT INTO `permiso` VALUES (5, 5, 1, 1);

-- ----------------------------
-- Table structure for usuario
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario`  (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombreusuario` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nombre` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `contrasena` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `dni` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `telefono` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `idperfil` int(11) NULL DEFAULT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idusuario`) USING BTREE,
  INDEX `idperfil`(`idperfil`) USING BTREE,
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idperfil`) REFERENCES `perfil` (`idperfil`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES (1, 'admin', 'Eladmin Dadmin Dodman', '123', '71654789', '942147895', 1, 1);

-- ----------------------------
-- View structure for view_menuhijos
-- ----------------------------
DROP VIEW IF EXISTS `view_menuhijos`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `view_menuhijos` AS SELECT modulo.idmodulo AS idmodulo,
    modulo.idmodulopadre,
    modulo.nombre,
    modulo.url,
    permiso.idperfil AS perfil
   FROM modulo
     INNER JOIN permiso ON modulo.idmodulo = permiso.idmodulo
  WHERE modulo.estado = 1
  ORDER BY modulo.idmodulo ;

-- ----------------------------
-- View structure for view_menupadres
-- ----------------------------
DROP VIEW IF EXISTS `view_menupadres`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `view_menupadres` AS SELECT modulo.idmodulo AS idmodulo,
    modulo.idmodulopadre,
    modulo.nombre as modulo,
    modulo.url,
    permiso.idperfil
   FROM (modulo
     JOIN permiso ON ((modulo.idmodulo = permiso.idmodulo)))
  WHERE ((modulo.estado = 1) AND (modulo.idmodulopadre = 0))
  ORDER BY modulo.idmodulo ;

SET FOREIGN_KEY_CHECKS = 1;
