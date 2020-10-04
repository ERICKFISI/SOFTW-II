-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-10-2020 a las 15:15:22
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `motorepuestosjc`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idcategoria` int(11) NOT NULL,
  `categoria` varchar(150) DEFAULT NULL,
  `estadocategoria` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idcategoria`, `categoria`, `estadocategoria`) VALUES
(1, 'Aceite', 1),
(2, 'Llantas', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idcliente` int(11) NOT NULL,
  `documento` varchar(15) DEFAULT NULL,
  `razonsocial` varchar(100) DEFAULT NULL,
  `nombrecomercial` varchar(150) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `telefono_cel` varchar(9) DEFAULT NULL,
  `idtipodocumento` int(11) DEFAULT NULL,
  `estadocliente` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `idcompra` int(11) NOT NULL,
  `idproveedor` int(11) DEFAULT NULL,
  `idcomprobante` int(11) DEFAULT NULL,
  `fechacompra` date DEFAULT NULL,
  `totalcompra` int(11) DEFAULT NULL,
  `direccioncompra` varchar(200) DEFAULT NULL,
  `estadocompra` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprobante`
--

CREATE TABLE `comprobante` (
  `idcomprobante` int(11) NOT NULL,
  `comprobante` varchar(150) DEFAULT NULL,
  `estadocomprobante` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detcompro`
--

CREATE TABLE `detcompro` (
  `iddetcompro` int(11) NOT NULL,
  `idcompra` int(11) DEFAULT NULL,
  `idproducto` int(11) DEFAULT NULL,
  `preciocompraunidad` int(11) DEFAULT NULL,
  `cantidadcompra` int(11) DEFAULT NULL,
  `estadodetcompro` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detingpro`
--

CREATE TABLE `detingpro` (
  `iddetingpro` int(11) NOT NULL,
  `idingreso` int(11) DEFAULT NULL,
  `idproducto` int(11) DEFAULT NULL,
  `cantidadingreso` int(11) DEFAULT NULL,
  `preciounidad` int(11) DEFAULT NULL,
  `estadodetingpro` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detsalpro`
--

CREATE TABLE `detsalpro` (
  `iddetsalpro` int(11) NOT NULL,
  `idsalida` int(11) DEFAULT NULL,
  `idproducto` int(11) DEFAULT NULL,
  `cantidadsalida` int(11) DEFAULT NULL,
  `preciounidad` int(11) DEFAULT NULL,
  `estadodetsalpro` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detvenpro`
--

CREATE TABLE `detvenpro` (
  `iddetvenpro` int(11) NOT NULL,
  `idventa` int(11) DEFAULT NULL,
  `idproducto` int(11) DEFAULT NULL,
  `cantidadventa` int(11) DEFAULT NULL,
  `estadodetvenpro` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingreso`
--

CREATE TABLE `ingreso` (
  `idingreso` int(11) NOT NULL,
  `idtipoingreso` int(11) DEFAULT NULL,
  `idcomprobanteingreso` int(11) DEFAULT NULL,
  `fechaingreso` date DEFAULT NULL,
  `totalingreso` int(11) DEFAULT NULL,
  `descripcioningreso` varchar(500) DEFAULT NULL,
  `estadoingreso` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea`
--

CREATE TABLE `linea` (
  `idlinea` int(11) NOT NULL,
  `linea` varchar(255) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `linea`
--

INSERT INTO `linea` (`idlinea`, `linea`, `estado`) VALUES
(1, 'Original', 1),
(2, 'Genérico', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `idmarca` int(11) NOT NULL,
  `marca` varchar(255) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`idmarca`, `marca`, `estado`) VALUES
(1, 'Adidas', 1),
(2, 'Marca 2', 0),
(3, 'Toyota', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `idmodulo` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `url` varchar(75) DEFAULT NULL,
  `idmodulopadre` int(11) DEFAULT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `modulo`
--

INSERT INTO `modulo` (`idmodulo`, `nombre`, `url`, `idmodulopadre`, `estado`) VALUES
(1, 'Módulo Ventas', NULL, 0, 1),
(2, 'Módulo Compras', NULL, 1, 1),
(3, 'Módulo Almacén', NULL, 0, 1),
(4, 'Módulo Reportes', NULL, 3, 1),
(5, 'Módulo Seguridad', NULL, 0, 1),
(6, 'Visualizar Usuario', '/visualizarusuario', 5, 1),
(7, 'Registrar Usuario', '/home/registrarusuario', 5, 1),
(8, 'Visualizar Perfil', '/visualizarperfil', 5, 1),
(9, 'Registrar Perfil', '/registrarperfil', 5, 1),
(10, 'Visualizar Producto', '/VisualizarProducto', 3, 1),
(11, 'Registrar Producto', '/home/registrarproducto', 3, 1),
(12, 'Visualizar Categoría', '/VisualizarCategoria', 3, 1),
(13, 'Registrar Categoría', '/VisualizarCategoria/show', 3, 1),
(14, 'Visualizar Marca', '/visualizarMarca', 3, 1),
(15, 'Registrar Marca', '/home/registrarmarca', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `idperfil` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`idperfil`, `nombre`, `estado`) VALUES
(1, 'Admin', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `idpermiso` int(11) NOT NULL,
  `idmodulo` int(11) DEFAULT NULL,
  `idperfil` int(11) DEFAULT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`idpermiso`, `idmodulo`, `idperfil`, `estado`) VALUES
(1, 1, 1, 1),
(2, 2, 1, 1),
(3, 3, 1, 1),
(4, 4, 1, 1),
(5, 5, 1, 1),
(6, 6, 1, 1),
(7, 7, 1, 1),
(8, 8, 1, 1),
(9, 9, 1, 1),
(10, 10, 1, 1),
(11, 12, 1, 1),
(12, 11, 1, 1),
(13, 13, 1, 1),
(14, 14, 1, 1),
(15, 15, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idproducto` int(11) NOT NULL,
  `idcategoria` int(11) DEFAULT NULL,
  `idmarca` int(11) DEFAULT NULL,
  `idlinea` int(11) DEFAULT NULL,
  `producto` varchar(150) DEFAULT NULL,
  `descripcionproducto` varchar(500) DEFAULT NULL,
  `rutafoto` varchar(255) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `preciounidad` int(11) DEFAULT NULL,
  `estadoproducto` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idproducto`, `idcategoria`, `idmarca`, `idlinea`, `producto`, `descripcionproducto`, `rutafoto`, `stock`, `preciounidad`, `estadoproducto`) VALUES
(1, 1, 1, 1, 'Mi nuevo producto', 'Es un producto grandioso', 'Cmap-0.jpg', 23, 12, 0),
(2, 2, 1, 1, 'El gran producto', 'Este no es un gran producto', '', 21, 41, 0),
(3, 1, 1, 1, 'Rayo de alumnio', 'Es rayo nada mas', 'Cmap-0.jpg', 23, 12, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `idproveedor` int(11) NOT NULL,
  `idtipodocumento` int(11) DEFAULT NULL,
  `documento` varchar(15) DEFAULT NULL,
  `razonsocial` varchar(100) DEFAULT NULL,
  `nombrecomercial` varchar(150) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `telefono_cel` varchar(9) DEFAULT NULL,
  `estadoproveedor` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salida`
--

CREATE TABLE `salida` (
  `idsalida` int(11) NOT NULL,
  `idtiposalida` int(11) DEFAULT NULL,
  `idcomprobantesalida` int(11) DEFAULT NULL,
  `fechasalida` date DEFAULT NULL,
  `totalsalida` int(11) DEFAULT NULL,
  `descripcionsalida` varchar(500) DEFAULT NULL,
  `estadosalida` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodocumento`
--

CREATE TABLE `tipodocumento` (
  `idtipodocumento` int(11) NOT NULL,
  `tipodocumento` varchar(150) DEFAULT NULL,
  `estadotipodocumento` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoingreso`
--

CREATE TABLE `tipoingreso` (
  `idtipoingreso` int(11) NOT NULL,
  `tipoingreso` varchar(150) DEFAULT NULL,
  `estadotipoingreso` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposalida`
--

CREATE TABLE `tiposalida` (
  `idtiposalida` int(11) NOT NULL,
  `tiposalida` varchar(150) DEFAULT NULL,
  `estadotiposalida` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nombreusuario` varchar(25) DEFAULT NULL,
  `nombre` varchar(40) DEFAULT NULL,
  `contrasena` varchar(8) DEFAULT NULL,
  `dni` varchar(8) DEFAULT NULL,
  `telefono` varchar(9) DEFAULT NULL,
  `idperfil` int(11) DEFAULT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombreusuario`, `nombre`, `contrasena`, `dni`, `telefono`, `idperfil`, `estado`) VALUES
(1, 'admin', 'Eladmin Dadmin Dodman', '123', '71654789', '942147895', 1, 1),
(2, 'JuanJim', 'Harold Padilla', '123123as', '33333334', '942058012', 1, 1),
(3, 'Harold Padilla ', 'Jim Padilla', 'Demonmal', '33333334', '942058012', 1, 0),
(4, 'Jim H', 'Harold Padilla', '123123@', '33333333', '123123123', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `idventa` int(11) NOT NULL,
  `idcliente` int(11) DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `idcomprobante` int(11) DEFAULT NULL,
  `fechaventa` date DEFAULT NULL,
  `direccioncliente` varchar(150) DEFAULT NULL,
  `totalventa` int(11) DEFAULT NULL,
  `estadoventa` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_menuhijos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_menuhijos` (
`idmodulo` int(11)
,`idmodulopadre` int(11)
,`nombre` varchar(50)
,`url` varchar(75)
,`perfil` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_menupadres`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_menupadres` (
`idmodulo` int(11)
,`idmodulopadre` int(11)
,`modulo` varchar(50)
,`url` varchar(75)
,`idperfil` int(11)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `view_menuhijos`
--
DROP TABLE IF EXISTS `view_menuhijos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_menuhijos`  AS  select `modulo`.`idmodulo` AS `idmodulo`,`modulo`.`idmodulopadre` AS `idmodulopadre`,`modulo`.`nombre` AS `nombre`,`modulo`.`url` AS `url`,`permiso`.`idperfil` AS `perfil` from (`modulo` join `permiso` on(`modulo`.`idmodulo` = `permiso`.`idmodulo`)) where `modulo`.`estado` = 1 order by `modulo`.`idmodulo` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `view_menupadres`
--
DROP TABLE IF EXISTS `view_menupadres`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_menupadres`  AS  select `modulo`.`idmodulo` AS `idmodulo`,`modulo`.`idmodulopadre` AS `idmodulopadre`,`modulo`.`nombre` AS `modulo`,`modulo`.`url` AS `url`,`permiso`.`idperfil` AS `idperfil` from (`modulo` join `permiso` on(`modulo`.`idmodulo` = `permiso`.`idmodulo`)) where `modulo`.`estado` = 1 and `modulo`.`idmodulopadre` = 0 order by `modulo`.`idmodulo` ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idcliente`),
  ADD KEY `idtipodocumento` (`idtipodocumento`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`idcompra`),
  ADD KEY `idproveedor` (`idproveedor`),
  ADD KEY `idcomprobante` (`idcomprobante`);

--
-- Indices de la tabla `comprobante`
--
ALTER TABLE `comprobante`
  ADD PRIMARY KEY (`idcomprobante`);

--
-- Indices de la tabla `detcompro`
--
ALTER TABLE `detcompro`
  ADD PRIMARY KEY (`iddetcompro`),
  ADD KEY `idcompra` (`idcompra`),
  ADD KEY `idproducto` (`idproducto`);

--
-- Indices de la tabla `detingpro`
--
ALTER TABLE `detingpro`
  ADD PRIMARY KEY (`iddetingpro`),
  ADD KEY `idingreso` (`idingreso`),
  ADD KEY `idproducto` (`idproducto`);

--
-- Indices de la tabla `detsalpro`
--
ALTER TABLE `detsalpro`
  ADD PRIMARY KEY (`iddetsalpro`),
  ADD KEY `idsalida` (`idsalida`),
  ADD KEY `idproducto` (`idproducto`);

--
-- Indices de la tabla `detvenpro`
--
ALTER TABLE `detvenpro`
  ADD PRIMARY KEY (`iddetvenpro`),
  ADD KEY `idventa` (`idventa`),
  ADD KEY `idproducto` (`idproducto`);

--
-- Indices de la tabla `ingreso`
--
ALTER TABLE `ingreso`
  ADD PRIMARY KEY (`idingreso`),
  ADD KEY `idcomprobanteingreso` (`idcomprobanteingreso`),
  ADD KEY `idtipoingreso` (`idtipoingreso`);

--
-- Indices de la tabla `linea`
--
ALTER TABLE `linea`
  ADD PRIMARY KEY (`idlinea`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`idmarca`);

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`idmodulo`) USING BTREE,
  ADD KEY `idmodulopadre` (`idmodulopadre`) USING BTREE;

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`idperfil`) USING BTREE;

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`idpermiso`) USING BTREE,
  ADD KEY `idmodulo` (`idmodulo`) USING BTREE,
  ADD KEY `idperfil` (`idperfil`) USING BTREE;

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idproducto`),
  ADD KEY `idcategoria` (`idcategoria`),
  ADD KEY `idmarca` (`idmarca`),
  ADD KEY `idlinea` (`idlinea`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`idproveedor`),
  ADD KEY `idtipodocumento` (`idtipodocumento`);

--
-- Indices de la tabla `salida`
--
ALTER TABLE `salida`
  ADD PRIMARY KEY (`idsalida`),
  ADD KEY `idcomprobantesalida` (`idcomprobantesalida`),
  ADD KEY `idtiposalida` (`idtiposalida`);

--
-- Indices de la tabla `tipodocumento`
--
ALTER TABLE `tipodocumento`
  ADD PRIMARY KEY (`idtipodocumento`);

--
-- Indices de la tabla `tipoingreso`
--
ALTER TABLE `tipoingreso`
  ADD PRIMARY KEY (`idtipoingreso`);

--
-- Indices de la tabla `tiposalida`
--
ALTER TABLE `tiposalida`
  ADD PRIMARY KEY (`idtiposalida`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`) USING BTREE,
  ADD KEY `idperfil` (`idperfil`) USING BTREE;

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`idventa`),
  ADD KEY `idcliente` (`idcliente`),
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `idcomprobante` (`idcomprobante`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `idcompra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comprobante`
--
ALTER TABLE `comprobante`
  MODIFY `idcomprobante` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detcompro`
--
ALTER TABLE `detcompro`
  MODIFY `iddetcompro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detingpro`
--
ALTER TABLE `detingpro`
  MODIFY `iddetingpro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detsalpro`
--
ALTER TABLE `detsalpro`
  MODIFY `iddetsalpro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detvenpro`
--
ALTER TABLE `detvenpro`
  MODIFY `iddetvenpro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ingreso`
--
ALTER TABLE `ingreso`
  MODIFY `idingreso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `linea`
--
ALTER TABLE `linea`
  MODIFY `idlinea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `idmarca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `modulo`
--
ALTER TABLE `modulo`
  MODIFY `idmodulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `idperfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `idpermiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `idproveedor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `salida`
--
ALTER TABLE `salida`
  MODIFY `idsalida` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipodocumento`
--
ALTER TABLE `tipodocumento`
  MODIFY `idtipodocumento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipoingreso`
--
ALTER TABLE `tipoingreso`
  MODIFY `idtipoingreso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tiposalida`
--
ALTER TABLE `tiposalida`
  MODIFY `idtiposalida` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `idventa` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`idtipodocumento`) REFERENCES `tipodocumento` (`idtipodocumento`);

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`idproveedor`) REFERENCES `proveedor` (`idproveedor`),
  ADD CONSTRAINT `compra_ibfk_2` FOREIGN KEY (`idcomprobante`) REFERENCES `comprobante` (`idcomprobante`);

--
-- Filtros para la tabla `detcompro`
--
ALTER TABLE `detcompro`
  ADD CONSTRAINT `detcompro_ibfk_1` FOREIGN KEY (`idcompra`) REFERENCES `compra` (`idcompra`),
  ADD CONSTRAINT `detcompro_ibfk_2` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`);

--
-- Filtros para la tabla `detingpro`
--
ALTER TABLE `detingpro`
  ADD CONSTRAINT `detingpro_ibfk_1` FOREIGN KEY (`idingreso`) REFERENCES `ingreso` (`idingreso`),
  ADD CONSTRAINT `detingpro_ibfk_2` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`);

--
-- Filtros para la tabla `detsalpro`
--
ALTER TABLE `detsalpro`
  ADD CONSTRAINT `detsalpro_ibfk_1` FOREIGN KEY (`idsalida`) REFERENCES `salida` (`idsalida`),
  ADD CONSTRAINT `detsalpro_ibfk_2` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`);

--
-- Filtros para la tabla `detvenpro`
--
ALTER TABLE `detvenpro`
  ADD CONSTRAINT `detvenpro_ibfk_1` FOREIGN KEY (`idventa`) REFERENCES `venta` (`idventa`),
  ADD CONSTRAINT `detvenpro_ibfk_2` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`);

--
-- Filtros para la tabla `ingreso`
--
ALTER TABLE `ingreso`
  ADD CONSTRAINT `ingreso_ibfk_1` FOREIGN KEY (`idcomprobanteingreso`) REFERENCES `comprobante` (`idcomprobante`),
  ADD CONSTRAINT `ingreso_ibfk_2` FOREIGN KEY (`idtipoingreso`) REFERENCES `tipoingreso` (`idtipoingreso`);

--
-- Filtros para la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD CONSTRAINT `permiso_ibfk_1` FOREIGN KEY (`idmodulo`) REFERENCES `modulo` (`idmodulo`),
  ADD CONSTRAINT `permiso_ibfk_2` FOREIGN KEY (`idperfil`) REFERENCES `perfil` (`idperfil`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`idcategoria`) REFERENCES `categoria` (`idcategoria`),
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`idmarca`) REFERENCES `marca` (`idmarca`),
  ADD CONSTRAINT `producto_ibfk_3` FOREIGN KEY (`idlinea`) REFERENCES `linea` (`idlinea`);

--
-- Filtros para la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD CONSTRAINT `proveedor_ibfk_1` FOREIGN KEY (`idtipodocumento`) REFERENCES `tipodocumento` (`idtipodocumento`);

--
-- Filtros para la tabla `salida`
--
ALTER TABLE `salida`
  ADD CONSTRAINT `salida_ibfk_1` FOREIGN KEY (`idcomprobantesalida`) REFERENCES `comprobante` (`idcomprobante`),
  ADD CONSTRAINT `salida_ibfk_2` FOREIGN KEY (`idtiposalida`) REFERENCES `tiposalida` (`idtiposalida`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idperfil`) REFERENCES `perfil` (`idperfil`);

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`idcliente`) REFERENCES `cliente` (`idcliente`),
  ADD CONSTRAINT `venta_ibfk_2` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`),
  ADD CONSTRAINT `venta_ibfk_3` FOREIGN KEY (`idcomprobante`) REFERENCES `comprobante` (`idcomprobante`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
