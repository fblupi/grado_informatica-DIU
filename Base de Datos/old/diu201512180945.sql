-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-12-2015 a las 09:44:53
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `diu`
--
CREATE DATABASE IF NOT EXISTS `diu` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `diu`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alquiler`
--

CREATE TABLE IF NOT EXISTS `alquiler` (
  `id` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `sala` int(11) NOT NULL,
  `fechaInicio` datetime NOT NULL,
  `fechaFin` datetime NOT NULL,
  `tipoSala` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `asignada` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `alquiler`
--

INSERT INTO `alquiler` (`id`, `usuario`, `sala`, `fechaInicio`, `fechaFin`, `tipoSala`, `asignada`) VALUES
(2, 2, 1, '2016-07-12 00:00:00', '2016-09-22 00:00:00', 'empresa', 0),
(3, 2, 1, '2015-12-17 10:00:00', '2015-12-19 12:00:00', 'empresa', 0),
(4, 2, 2, '2015-12-18 10:00:00', '2015-12-18 12:00:00', 'evento', 0),
(5, 2, 2, '2015-12-27 10:00:00', '2015-12-27 19:00:00', 'evento', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE IF NOT EXISTS `asistencia` (
  `evento` int(11) NOT NULL,
  `usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`evento`, `usuario`) VALUES
(1, 2),
(1, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE IF NOT EXISTS `empresa` (
  `id` int(11) NOT NULL,
  `CIF` varchar(9) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `fax` varchar(45) DEFAULT NULL,
  `descripcion` text NOT NULL,
  `imagen` varchar(45) NOT NULL,
  `representante` int(11) NOT NULL,
  `sala` int(11) DEFAULT NULL,
  `promocion` int(11) NOT NULL DEFAULT '0',
  `baja` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id`, `CIF`, `nombre`, `direccion`, `telefono`, `fax`, `descripcion`, `imagen`, `representante`, `sala`, `promocion`, `baja`) VALUES
(1, '1', 'OSL UGR', 'Calle falsa, 123', '958282828', '958282828', 'Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos. Eu sit tincidunt incorrupte definitionem, vis mutat affert percipit cu, eirmod consectetuer signiferumque eu per. In usu latine equidem dolores. Quo no falli viris intellegam, ut fugit veritus placerat per.', 'assets/img/empresa.png', 2, NULL, 1, 0),
(2, '123', 'Alsa', 'Calle 123', '958123123', '958123123', 'Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos. Eu sit tincidunt incorrupte definitionem, vis mutat affert percipit cu, eirmod consectetuer signiferumque eu per. In usu latine equidem dolores. Quo no falli viris intellegam, ut fugit veritus placerat per.', 'assets/img/empresa.png', 2, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE IF NOT EXISTS `evento` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `fechaInicio` datetime NOT NULL,
  `fechaFin` datetime NOT NULL,
  `precio` float NOT NULL,
  `plazas` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `requisitos` text NOT NULL,
  `imagen` varchar(45) NOT NULL,
  `sala` int(11) DEFAULT NULL,
  `empresa` int(11) DEFAULT NULL,
  `usuario` int(11) DEFAULT NULL,
  `promocion` int(11) NOT NULL DEFAULT '0',
  `baja` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `evento`
--

INSERT INTO `evento` (`id`, `nombre`, `fechaInicio`, `fechaFin`, `precio`, `plazas`, `descripcion`, `requisitos`, `imagen`, `sala`, `empresa`, `usuario`, `promocion`, `baja`) VALUES
(1, 'Hackathon NavideÃ±o', '2015-12-27 12:30:00', '2015-12-27 14:30:00', 0, 150, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 'PortÃ¡til', 'assets/img/eventos/1.jpeg', 5, 1, NULL, 0, 0),
(12, 'Taller de Arduino', '2015-12-15 10:00:00', '2015-12-15 12:00:00', 20, 50, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', '123123123', 'assets/img/eventoCancelado.png', NULL, NULL, 2, 0, 1),
(13, 'Taller de Node.js', '2015-12-20 12:00:00', '2015-12-20 13:00:00', 0, 50, 'Ã±adjaÃ±slkdj', 'aÃ±lksdjaÃ±skldjaÃ±lskdjasÃ±ldkjadsÃ±lkakjwebqwe,mn', 'assets/img/eventos/13.jpeg', NULL, NULL, 2, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE IF NOT EXISTS `permisos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Permisos Admin', 'Gestión Evento Admin, Gestión Empresa Admin, Gestionar Sala, Añadir Permisos'),
(2, 'Permisos Usuario', 'Gestión Evento Usuario, Gestión Empresa Usuario, Alquilar Sala, Apuntarse a Evento');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sala`
--

CREATE TABLE IF NOT EXISTS `sala` (
  `id` int(11) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `planta` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `capacidad` int(11) NOT NULL,
  `imagen` varchar(45) NOT NULL DEFAULT 'assets/img/sala.jpg',
  `baja` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sala`
--

INSERT INTO `sala` (`id`, `tipo`, `nombre`, `planta`, `numero`, `capacidad`, `imagen`, `baja`) VALUES
(1, 'empresa', 'Alhambra', 1, 3, 500, 'assets/img/salas/1.jpeg', 0),
(2, 'evento', 'ContemporÃ¡nea', 2, 1, 200, 'assets/img/salas/2.jpeg', 0),
(3, 'evento', 'Sacromonte', 2, 2, 20, 'assets/img/salas/3.jpeg', 0),
(4, 'evento', 'AlbaicÃ­n', 2, 3, 50, 'assets/img/salas/4.jpeg', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL,
  `login` varchar(45) NOT NULL,
  `pass` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `sexo` varchar(45) DEFAULT NULL,
  `pais` varchar(45) DEFAULT NULL,
  `localidad` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `codigoPostal` varchar(45) DEFAULT NULL,
  `imagen` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `login`, `pass`, `email`, `nombre`, `telefono`, `sexo`, `pais`, `localidad`, `direccion`, `codigoPostal`, `imagen`) VALUES
(1, 'admin', 'c84258e9c39059a89ab77d846ddab909', 'admin@admin.com', 'JosÃ© Fortunato', '655555555', '', 'EspaÃ±a', 'Granada', 'Calle Falsa', '18001', 'assets/img/user.png'),
(2, 'usuario', 'f8032d5cae3de20fcec887f395ec9a6a', 'usuario@usuario.com', 'Marcial Conrado', '677777777', '', 'EspaÃ±a', 'Granada', 'Calle Falsa', '18001', 'assets/img/user.png'),
(6, 'fblupi', '879a461dd87fe28e3360e83c3878d21f', 'fboli94@gmail.com', 'Francisco Javier BolÃ­var LupiÃ¡Ã±ez', '601189876', 'hombre', 'EspaÃ±a', 'Lobras', 'Calle Acequia', '18449', 'assets/img/users/fblupi.png'),
(7, 'louri91', '47e8ce3fe1245476051a1c81820e30fe', 'louri1991@gmail.com', 'Amanda FernÃ¡ndez Piedra', '656661801', 'mujer', 'EspaÃ±a', 'Granada', 'Calle Mirlo', '18014', 'assets/img/users/louri91.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_permisos`
--

CREATE TABLE IF NOT EXISTS `usuario_permisos` (
  `usuario` int(11) NOT NULL,
  `permiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario_permisos`
--

INSERT INTO `usuario_permisos` (`usuario`, `permiso`) VALUES
(1, 1),
(2, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alquiler`
--
ALTER TABLE `alquiler`
  ADD PRIMARY KEY (`id`,`usuario`,`sala`,`fechaInicio`,`fechaFin`);

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`evento`,`usuario`), ADD KEY `fk_Evento_has_Usuario_Usuario1_idx` (`usuario`), ADD KEY `fk_Evento_has_Usuario_Evento1_idx` (`evento`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `CIF_UNIQUE` (`CIF`), ADD KEY `fk_Empresa_Usuario1_idx` (`representante`), ADD KEY `fk_Empresa_Sala1_idx` (`sala`);

--
-- Indices de la tabla `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`id`), ADD KEY `fk_Evento_Sala1_idx` (`sala`), ADD KEY `fk_Evento_Empresa1_idx` (`empresa`), ADD KEY `fk_Evento_Usuario1_idx` (`usuario`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sala`
--
ALTER TABLE `sala`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `login_UNIQUE` (`login`), ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- Indices de la tabla `usuario_permisos`
--
ALTER TABLE `usuario_permisos`
  ADD PRIMARY KEY (`usuario`,`permiso`), ADD KEY `fk_Usuario_has_Permisos_Permisos1_idx` (`permiso`), ADD KEY `fk_Usuario_has_Permisos_Usuario_idx` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alquiler`
--
ALTER TABLE `alquiler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `evento`
--
ALTER TABLE `evento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `sala`
--
ALTER TABLE `sala`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
ADD CONSTRAINT `fk_Evento_has_Usuario_Evento1` FOREIGN KEY (`evento`) REFERENCES `evento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Evento_has_Usuario_Usuario1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `empresa`
--
ALTER TABLE `empresa`
ADD CONSTRAINT `fk_Empresa_Alquiler1` FOREIGN KEY (`sala`) REFERENCES `alquiler` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Empresa_Usuario1` FOREIGN KEY (`representante`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `evento`
--
ALTER TABLE `evento`
ADD CONSTRAINT `fk_Evento_Alquiler1` FOREIGN KEY (`sala`) REFERENCES `alquiler` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Evento_Empresa1` FOREIGN KEY (`empresa`) REFERENCES `empresa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Evento_Usuario1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario_permisos`
--
ALTER TABLE `usuario_permisos`
ADD CONSTRAINT `fk_Usuario_has_Permisos_Permisos1` FOREIGN KEY (`permiso`) REFERENCES `permisos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_Usuario_has_Permisos_Usuario` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
