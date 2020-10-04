/*
 Navicat Premium Data Transfer

 Source Server         : MySQL
 Source Server Type    : MySQL
 Source Server Version : 100414
 Source Host           : localhost:3306
 Source Schema         : motorepuestosjc

 Target Server Type    : MySQL
 Target Server Version : 100414
 File Encoding         : 65001

 Date: 03/10/2020 21:32:02
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for categoria
-- ----------------------------
DROP TABLE IF EXISTS `categoria`;
CREATE TABLE `categoria`  (
  `idcategoria` int NOT NULL AUTO_INCREMENT,
  `categoria` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `estadocategoria` tinyint NOT NULL DEFAULT 1,
  PRIMARY KEY (`idcategoria`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of categoria
-- ----------------------------
INSERT INTO `categoria` VALUES (1, 'Evasado', 1);
INSERT INTO `categoria` VALUES (2, 'Articulo de Limpoieza', 1);

-- ----------------------------
-- Table structure for cliente
-- ----------------------------
DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente`  (
  `idcliente` int NOT NULL AUTO_INCREMENT,
  `documento` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `razonsocial` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nombrecomercial` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `direccion` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `telefono_cel` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `idtipodocumento` int NULL DEFAULT NULL,
  `estadocliente` tinyint NOT NULL DEFAULT 1,
  PRIMARY KEY (`idcliente`) USING BTREE,
  INDEX `idtipodocumento`(`idtipodocumento`) USING BTREE,
  CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`idtipodocumento`) REFERENCES `tipodocumento` (`idtipodocumento`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cliente
-- ----------------------------

-- ----------------------------
-- Table structure for compra
-- ----------------------------
DROP TABLE IF EXISTS `compra`;
CREATE TABLE `compra`  (
  `idcompra` int NOT NULL AUTO_INCREMENT,
  `idproveedor` int NULL DEFAULT NULL,
  `idcomprobante` int NULL DEFAULT NULL,
  `fechacompra` date NULL DEFAULT NULL,
  `totalcompra` int NULL DEFAULT NULL,
  `direccioncompra` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `estadocompra` tinyint NOT NULL DEFAULT 1,
  PRIMARY KEY (`idcompra`) USING BTREE,
  INDEX `idproveedor`(`idproveedor`) USING BTREE,
  INDEX `idcomprobante`(`idcomprobante`) USING BTREE,
  CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`idproveedor`) REFERENCES `proveedor` (`idproveedor`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `compra_ibfk_2` FOREIGN KEY (`idcomprobante`) REFERENCES `comprobante` (`idcomprobante`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of compra
-- ----------------------------

-- ----------------------------
-- Table structure for comprobante
-- ----------------------------
DROP TABLE IF EXISTS `comprobante`;
CREATE TABLE `comprobante`  (
  `idcomprobante` int NOT NULL AUTO_INCREMENT,
  `comprobante` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `estadocomprobante` tinyint NOT NULL DEFAULT 1,
  PRIMARY KEY (`idcomprobante`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of comprobante
-- ----------------------------

-- ----------------------------
-- Table structure for detcompro
-- ----------------------------
DROP TABLE IF EXISTS `detcompro`;
CREATE TABLE `detcompro`  (
  `iddetcompro` int NOT NULL AUTO_INCREMENT,
  `idcompra` int NULL DEFAULT NULL,
  `idproducto` int NULL DEFAULT NULL,
  `preciocompraunidad` int NULL DEFAULT NULL,
  `cantidadcompra` int NULL DEFAULT NULL,
  `estadodetcompro` tinyint NOT NULL DEFAULT 1,
  PRIMARY KEY (`iddetcompro`) USING BTREE,
  INDEX `idcompra`(`idcompra`) USING BTREE,
  INDEX `idproducto`(`idproducto`) USING BTREE,
  CONSTRAINT `detcompro_ibfk_1` FOREIGN KEY (`idcompra`) REFERENCES `compra` (`idcompra`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `detcompro_ibfk_2` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detcompro
-- ----------------------------

-- ----------------------------
-- Table structure for detingpro
-- ----------------------------
DROP TABLE IF EXISTS `detingpro`;
CREATE TABLE `detingpro`  (
  `iddetingpro` int NOT NULL AUTO_INCREMENT,
  `idingreso` int NULL DEFAULT NULL,
  `idproducto` int NULL DEFAULT NULL,
  `cantidadingreso` int NULL DEFAULT NULL,
  `preciounidad` int NULL DEFAULT NULL,
  `estadodetingpro` tinyint NOT NULL DEFAULT 1,
  PRIMARY KEY (`iddetingpro`) USING BTREE,
  INDEX `idingreso`(`idingreso`) USING BTREE,
  INDEX `idproducto`(`idproducto`) USING BTREE,
  CONSTRAINT `detingpro_ibfk_1` FOREIGN KEY (`idingreso`) REFERENCES `ingreso` (`idingreso`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `detingpro_ibfk_2` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detingpro
-- ----------------------------

-- ----------------------------
-- Table structure for detsalpro
-- ----------------------------
DROP TABLE IF EXISTS `detsalpro`;
CREATE TABLE `detsalpro`  (
  `iddetsalpro` int NOT NULL AUTO_INCREMENT,
  `idsalida` int NULL DEFAULT NULL,
  `idproducto` int NULL DEFAULT NULL,
  `cantidadsalida` int NULL DEFAULT NULL,
  `preciounidad` int NULL DEFAULT NULL,
  `estadodetsalpro` tinyint NOT NULL DEFAULT 1,
  `subtotal` decimal(11, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`iddetsalpro`) USING BTREE,
  INDEX `idsalida`(`idsalida`) USING BTREE,
  INDEX `idproducto`(`idproducto`) USING BTREE,
  CONSTRAINT `detsalpro_ibfk_1` FOREIGN KEY (`idsalida`) REFERENCES `salida` (`idsalida`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `detsalpro_ibfk_2` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detsalpro
-- ----------------------------
INSERT INTO `detsalpro` VALUES (1, 4, 1, 6, 5, 1, 30.00);
INSERT INTO `detsalpro` VALUES (2, 4, 4, 2, 2, 1, 4.00);
INSERT INTO `detsalpro` VALUES (3, 5, 1, 6, 5, 1, 30.00);
INSERT INTO `detsalpro` VALUES (4, 5, 4, 2, 2, 1, 4.00);
INSERT INTO `detsalpro` VALUES (5, 6, 1, 2, 5, 1, 10.00);
INSERT INTO `detsalpro` VALUES (6, 6, 5, 1, 5, 1, 5.00);

-- ----------------------------
-- Table structure for detvenpro
-- ----------------------------
DROP TABLE IF EXISTS `detvenpro`;
CREATE TABLE `detvenpro`  (
  `iddetvenpro` int NOT NULL AUTO_INCREMENT,
  `idventa` int NULL DEFAULT NULL,
  `idproducto` int NULL DEFAULT NULL,
  `cantidadventa` int NULL DEFAULT NULL,
  `estadodetvenpro` tinyint NOT NULL DEFAULT 1,
  PRIMARY KEY (`iddetvenpro`) USING BTREE,
  INDEX `idventa`(`idventa`) USING BTREE,
  INDEX `idproducto`(`idproducto`) USING BTREE,
  CONSTRAINT `detvenpro_ibfk_1` FOREIGN KEY (`idventa`) REFERENCES `venta` (`idventa`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `detvenpro_ibfk_2` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of detvenpro
-- ----------------------------

-- ----------------------------
-- Table structure for ingreso
-- ----------------------------
DROP TABLE IF EXISTS `ingreso`;
CREATE TABLE `ingreso`  (
  `idingreso` int NOT NULL AUTO_INCREMENT,
  `idtipoingreso` int NULL DEFAULT NULL,
  `idcomprobanteingreso` int NULL DEFAULT NULL,
  `fechaingreso` date NULL DEFAULT NULL,
  `totalingreso` int NULL DEFAULT NULL,
  `descripcioningreso` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `estadoingreso` tinyint NOT NULL DEFAULT 1,
  PRIMARY KEY (`idingreso`) USING BTREE,
  INDEX `idcomprobanteingreso`(`idcomprobanteingreso`) USING BTREE,
  INDEX `idtipoingreso`(`idtipoingreso`) USING BTREE,
  CONSTRAINT `ingreso_ibfk_1` FOREIGN KEY (`idcomprobanteingreso`) REFERENCES `comprobante` (`idcomprobante`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `ingreso_ibfk_2` FOREIGN KEY (`idtipoingreso`) REFERENCES `tipoingreso` (`idtipoingreso`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ingreso
-- ----------------------------

-- ----------------------------
-- Table structure for modulo
-- ----------------------------
DROP TABLE IF EXISTS `modulo`;
CREATE TABLE `modulo`  (
  `idmodulo` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `url` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `idmodulopadre` int NULL DEFAULT NULL,
  `estado` tinyint NOT NULL DEFAULT 1,
  PRIMARY KEY (`idmodulo`) USING BTREE,
  INDEX `idmodulopadre`(`idmodulopadre`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of modulo
-- ----------------------------
INSERT INTO `modulo` VALUES (1, 'MANENIMIENTO', NULL, 0, 1);
INSERT INTO `modulo` VALUES (2, 'Cliente', NULL, 1, 1);
INSERT INTO `modulo` VALUES (3, 'Producto', NULL, 1, 1);
INSERT INTO `modulo` VALUES (4, 'VENTAS', NULL, 0, 1);
INSERT INTO `modulo` VALUES (5, 'generar venta', '/VisualizarVenta', 4, 1);
INSERT INTO `modulo` VALUES (6, 'SEGURIDAD', NULL, 0, 1);
INSERT INTO `modulo` VALUES (7, 'Usuaio', '/visualizarusuario', 6, 1);
INSERT INTO `modulo` VALUES (8, 'ALMACEN', NULL, 0, 1);
INSERT INTO `modulo` VALUES (9, 'salida', '/salida', 8, 1);

-- ----------------------------
-- Table structure for perfil
-- ----------------------------
DROP TABLE IF EXISTS `perfil`;
CREATE TABLE `perfil`  (
  `idperfil` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `estado` tinyint NOT NULL DEFAULT 1,
  PRIMARY KEY (`idperfil`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of perfil
-- ----------------------------
INSERT INTO `perfil` VALUES (1, 'admin', 1);
INSERT INTO `perfil` VALUES (2, 'empleado', 1);

-- ----------------------------
-- Table structure for permiso
-- ----------------------------
DROP TABLE IF EXISTS `permiso`;
CREATE TABLE `permiso`  (
  `idpermiso` int NOT NULL AUTO_INCREMENT,
  `idmodulo` int NULL DEFAULT NULL,
  `idperfil` int NULL DEFAULT NULL,
  `estado` tinyint NOT NULL DEFAULT 1,
  PRIMARY KEY (`idpermiso`) USING BTREE,
  INDEX `idmodulo`(`idmodulo`) USING BTREE,
  INDEX `idperfil`(`idperfil`) USING BTREE,
  CONSTRAINT `permiso_ibfk_1` FOREIGN KEY (`idmodulo`) REFERENCES `modulo` (`idmodulo`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `permiso_ibfk_2` FOREIGN KEY (`idperfil`) REFERENCES `perfil` (`idperfil`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permiso
-- ----------------------------
INSERT INTO `permiso` VALUES (1, 1, 1, 1);
INSERT INTO `permiso` VALUES (2, 2, 1, 1);
INSERT INTO `permiso` VALUES (3, 3, 1, 1);
INSERT INTO `permiso` VALUES (4, 4, 1, 1);
INSERT INTO `permiso` VALUES (5, 5, 1, 1);
INSERT INTO `permiso` VALUES (6, 6, 1, 1);
INSERT INTO `permiso` VALUES (7, 7, 1, 1);
INSERT INTO `permiso` VALUES (8, 8, 1, 1);
INSERT INTO `permiso` VALUES (9, 9, 1, 1);

-- ----------------------------
-- Table structure for producto
-- ----------------------------
DROP TABLE IF EXISTS `producto`;
CREATE TABLE `producto`  (
  `idproducto` int NOT NULL AUTO_INCREMENT,
  `idcategoria` int NULL DEFAULT NULL,
  `producto` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `descripcionproducto` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `stock` int NULL DEFAULT NULL,
  `preciounidad` int NULL DEFAULT NULL,
  `estadoproducto` tinyint NOT NULL DEFAULT 1,
  PRIMARY KEY (`idproducto`) USING BTREE,
  INDEX `idcategoria`(`idcategoria`) USING BTREE,
  CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`idcategoria`) REFERENCES `categoria` (`idcategoria`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of producto
-- ----------------------------
INSERT INTO `producto` VALUES (1, 2, 'Atún A1', 'Atun A1', 500, 5, 1);
INSERT INTO `producto` VALUES (2, 2, 'Detergente Patito', 'Detergente Patito', 200, 2, 1);
INSERT INTO `producto` VALUES (3, 2, 'Detergente Ace', 'Detergente Ace', 200, 2, 1);
INSERT INTO `producto` VALUES (4, 2, 'Detergente Opal', 'Detergente Opal', 300, 2, 1);
INSERT INTO `producto` VALUES (5, 2, 'Lavavajilla Lesli', 'Lavavajilla Lesli', 220, 5, 1);
INSERT INTO `producto` VALUES (6, 2, 'esponja', 'esponcaj de lavar platos', 100, 5, 1);

-- ----------------------------
-- Table structure for proveedor
-- ----------------------------
DROP TABLE IF EXISTS `proveedor`;
CREATE TABLE `proveedor`  (
  `idproveedor` int NOT NULL AUTO_INCREMENT,
  `idtipodocumento` int NULL DEFAULT NULL,
  `documento` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `razonsocial` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nombrecomercial` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `direccion` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `telefono_cel` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `estadoproveedor` tinyint NOT NULL DEFAULT 1,
  PRIMARY KEY (`idproveedor`) USING BTREE,
  INDEX `idtipodocumento`(`idtipodocumento`) USING BTREE,
  CONSTRAINT `proveedor_ibfk_1` FOREIGN KEY (`idtipodocumento`) REFERENCES `tipodocumento` (`idtipodocumento`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of proveedor
-- ----------------------------

-- ----------------------------
-- Table structure for salida
-- ----------------------------
DROP TABLE IF EXISTS `salida`;
CREATE TABLE `salida`  (
  `idsalida` int NOT NULL AUTO_INCREMENT,
  `idtiposalida` int NULL DEFAULT NULL,
  `idcomprobantesalida` int NULL DEFAULT NULL,
  `fechasalida` date NULL DEFAULT NULL,
  `totalsalida` int NULL DEFAULT NULL,
  `descripcionsalida` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `estadosalida` tinyint NOT NULL DEFAULT 1,
  PRIMARY KEY (`idsalida`) USING BTREE,
  INDEX `idcomprobantesalida`(`idcomprobantesalida`) USING BTREE,
  INDEX `idtiposalida`(`idtiposalida`) USING BTREE,
  CONSTRAINT `salida_ibfk_2` FOREIGN KEY (`idtiposalida`) REFERENCES `tiposalida` (`idtiposalida`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of salida
-- ----------------------------
INSERT INTO `salida` VALUES (1, 3, NULL, '2020-10-01', 500, 'Traslado a xx', 1);
INSERT INTO `salida` VALUES (2, 1, NULL, '2020-10-03', 24, 'Traslado', 1);
INSERT INTO `salida` VALUES (3, 2, NULL, '2020-10-03', 34, 'a Juanjui', 1);
INSERT INTO `salida` VALUES (4, 2, NULL, '2020-10-03', 34, 'a Juanjui', 1);
INSERT INTO `salida` VALUES (5, 2, NULL, '2020-10-03', 34, 'a Juanjui', 1);
INSERT INTO `salida` VALUES (6, 3, NULL, '2020-10-03', 15, 'prestando', 1);

-- ----------------------------
-- Table structure for tipodocumento
-- ----------------------------
DROP TABLE IF EXISTS `tipodocumento`;
CREATE TABLE `tipodocumento`  (
  `idtipodocumento` int NOT NULL AUTO_INCREMENT,
  `tipodocumento` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `estadotipodocumento` tinyint NOT NULL DEFAULT 1,
  PRIMARY KEY (`idtipodocumento`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tipodocumento
-- ----------------------------

-- ----------------------------
-- Table structure for tipoingreso
-- ----------------------------
DROP TABLE IF EXISTS `tipoingreso`;
CREATE TABLE `tipoingreso`  (
  `idtipoingreso` int NOT NULL AUTO_INCREMENT,
  `tipoingreso` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `estadotipoingreso` tinyint NOT NULL DEFAULT 1,
  PRIMARY KEY (`idtipoingreso`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tipoingreso
-- ----------------------------

-- ----------------------------
-- Table structure for tiposalida
-- ----------------------------
DROP TABLE IF EXISTS `tiposalida`;
CREATE TABLE `tiposalida`  (
  `idtiposalida` int NOT NULL AUTO_INCREMENT,
  `tiposalida` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `estadotiposalida` tinyint NOT NULL DEFAULT 1,
  PRIMARY KEY (`idtiposalida`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tiposalida
-- ----------------------------
INSERT INTO `tiposalida` VALUES (1, 'Venta', 1);
INSERT INTO `tiposalida` VALUES (2, 'Traslado', 1);
INSERT INTO `tiposalida` VALUES (3, 'Otros', 1);

-- ----------------------------
-- Table structure for usuario
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario`  (
  `idusuario` int NOT NULL AUTO_INCREMENT,
  `nombreusuario` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nombre` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `contrasena` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `dni` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `telefono` varchar(9) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `idperfil` int NULL DEFAULT NULL,
  `estado` tinyint NOT NULL DEFAULT 1,
  PRIMARY KEY (`idusuario`) USING BTREE,
  INDEX `idperfil`(`idperfil`) USING BTREE,
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idperfil`) REFERENCES `perfil` (`idperfil`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of usuario
-- ----------------------------
INSERT INTO `usuario` VALUES (1, 'admin', 'Eladmin Dadmin Dodman', '123', '71654789', '942147895', 1, 1);
INSERT INTO `usuario` VALUES (2, 'empleado', 'Elempleado ', '123', '87645768', '987654345', 2, 1);

-- ----------------------------
-- Table structure for venta
-- ----------------------------
DROP TABLE IF EXISTS `venta`;
CREATE TABLE `venta`  (
  `idventa` int NOT NULL AUTO_INCREMENT,
  `idcliente` int NULL DEFAULT NULL,
  `idusuario` int NULL DEFAULT NULL,
  `idcomprobante` int NULL DEFAULT NULL,
  `fechaventa` date NULL DEFAULT NULL,
  `direccioncliente` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `totalventa` int NULL DEFAULT NULL,
  `estadoventa` tinyint NOT NULL DEFAULT 1,
  PRIMARY KEY (`idventa`) USING BTREE,
  INDEX `idcliente`(`idcliente`) USING BTREE,
  INDEX `idusuario`(`idusuario`) USING BTREE,
  INDEX `idcomprobante`(`idcomprobante`) USING BTREE,
  CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `venta_ibfk_2` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `venta_ibfk_3` FOREIGN KEY (`idcomprobante`) REFERENCES `comprobante` (`idcomprobante`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of venta
-- ----------------------------

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
