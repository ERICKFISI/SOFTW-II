-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-09-2020 a las 14:48:07
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
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `idmodulo` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `url` varchar(75) DEFAULT NULL,
  `idmodulopadre` int(11) DEFAULT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `modulo`
--

INSERT INTO `modulo` (`idmodulo`, `nombre`, `url`, `idmodulopadre`, `estado`) VALUES
(1, 'Seguridad', 'asdasd', NULL, 1),
(2, 'Visualizar usuario', 'asdasdasd', 1, 1),
(3, 'Registrar usuario', 'asdasd', 1, 1),
(4, 'Visualizar perfil', 'asdasdasd', 1, 1),
(5, 'Registrar perfil', 'asdasdasd', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `idperfil` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`idperfil`, `nombre`, `estado`) VALUES
(1, 'Encargado de Seguridad', 1),
(2, 'Encargado Miss Feed', 1),
(3, 'Encargado Miss Feed', 1),
(4, 'Encargado', 1),
(5, 'Encargado', 1),
(6, 'Encargado de Seguridad', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `idpermiso` int(11) NOT NULL,
  `idmodulo` int(11) DEFAULT NULL,
  `idperfil` int(11) DEFAULT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`idpermiso`, `idmodulo`, `idperfil`, `estado`) VALUES
(1, 1, 1, 1),
(2, 2, 1, 1),
(3, 3, 1, 1),
(4, 4, 1, 1),
(5, 5, 1, 1),
(6, 1, 2, 1),
(7, 2, 2, 1),
(8, 3, 2, 1),
(9, 1, 2, 1),
(10, 2, 2, 1),
(11, 3, 2, 1),
(12, 2, 4, 1),
(13, 3, 4, 1),
(14, 2, 4, 1),
(15, 3, 4, 1),
(16, 1, 1, 1),
(17, 2, 1, 1),
(18, 3, 1, 1),
(19, 4, 1, 1),
(20, 5, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `idperfil` int(11) NOT NULL,
  `nombreusuario` varchar(25) DEFAULT NULL,
  `nombre` varchar(40) DEFAULT NULL,
  `contrasena` varchar(8) DEFAULT NULL,
  `dni` varchar(8) DEFAULT NULL,
  `telefono` varchar(9) DEFAULT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `idperfil`, `nombreusuario`, `nombre`, `contrasena`, `dni`, `telefono`, `estado`) VALUES
(1, 1, 'PelayoC', 'Pelayo Cayao Navarro', 'Hol@123', '72167199', '123321123', 1),
(2, 1, 'JimH25', 'Jim Harold Padilla Pierola', 'G@12345', '72167100', '222222222', 1),
(3, 1, 'JuanJ', 'Juan el guapo Martínez', 'G@12345', '12312312', '123123123', 1),
(4, 1, 'JuanJim', 'Juan Jimenez', 'Ga123123', '12312312', '942058012', 1),
(5, 1, 'JuanJim', 'Juan Jimenez', 'Ga123123', '12312312', '942058012', 1),
(6, 1, 'JuanJim', 'Juan Jimenez', 'Ga123123', '12312312', '942058012', 1),
(7, 1, 'JuanJim', 'Juan Jimenez', 'Ga123123', '12312312', '942058012', 1),
(8, 1, 'JuanJ', 'Jim Padilla', '12312312', '33333334', '942058012', 1),
(9, 1, 'JuanJ', 'Jim Padilla', '12312312', '33333334', '942058012', 1),
(10, 1, 'JuanJim12', 'Harold Padilla', '123123', '33333333', '942058012', 0),
(11, 1, 'JuanJ223', 'Harold Padilla', '123123', '33333334', '942058012', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`idmodulo`),
  ADD KEY `idmodulopadre` (`idmodulopadre`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`idperfil`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`idpermiso`),
  ADD KEY `idmodulo` (`idmodulo`),
  ADD KEY `idperfil` (`idperfil`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `FK_perfil_usuario_idperfil` (`idperfil`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `modulo`
--
ALTER TABLE `modulo`
  MODIFY `idmodulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `idperfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `idpermiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD CONSTRAINT `modulo_ibfk_1` FOREIGN KEY (`idmodulopadre`) REFERENCES `modulo` (`idmodulo`);

--
-- Filtros para la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD CONSTRAINT `permiso_ibfk_1` FOREIGN KEY (`idmodulo`) REFERENCES `modulo` (`idmodulo`),
  ADD CONSTRAINT `permiso_ibfk_2` FOREIGN KEY (`idperfil`) REFERENCES `perfil` (`idperfil`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `FK_perfil_usuario_idperfil` FOREIGN KEY (`idperfil`) REFERENCES `perfil` (`idperfil`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
