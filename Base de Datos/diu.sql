-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-01-2016 a las 13:13:25
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `alquiler`
--

INSERT INTO `alquiler` (`id`, `usuario`, `sala`, `fechaInicio`, `fechaFin`, `tipoSala`, `asignada`) VALUES
(2, 2, 1, '2016-01-07 00:00:00', '2016-01-09 00:00:00', 'empresa', 1),
(3, 2, 1, '2015-12-17 10:00:00', '2015-12-19 12:00:00', 'empresa', 0),
(4, 2, 2, '2015-12-18 10:00:00', '2015-12-18 12:00:00', 'evento', 0),
(5, 2, 2, '2015-12-27 10:00:00', '2015-12-27 19:00:00', 'evento', 1),
(6, 2, 4, '2015-12-20 10:00:00', '2015-12-20 20:00:00', 'evento', 1),
(7, 6, 1, '2015-12-30 10:00:00', '2016-01-06 18:00:00', 'empresa', 1);

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
(14, 2),
(1, 7),
(14, 7);

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id`, `CIF`, `nombre`, `direccion`, `telefono`, `fax`, `descripcion`, `imagen`, `representante`, `sala`, `promocion`, `baja`) VALUES
(1, 'B14565623', 'OSL UGR', 'Calle falsa, 123', '958282828', '958282828', 'Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in, eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos. Eu sit tincidunt incorrupte definitionem, vis mutat affert percipit cu, eirmod consectetuer signiferumque eu per. In usu latine equidem dolores. Quo no falli viris intellegam, ut fugit veritus placerat per.', 'assets/img/empresas/1.png', 2, 2, 2, 0),
(3, 'B12345648', 'Tuiter', 'Calle Pajarito, 26', '666112233', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus posuere nibh felis, et tempus risus sagittis nec. Integer ut quam nec nibh tempor molestie. In mi ligula, congue nec nibh vitae, condimentum sodales lacus. Sed diam risus, facilisis eu metus a, porta dictum nunc. Pellentesque tortor massa, tempor sed sapien vel, molestie ultricies diam. Maecenas ac fringilla mauris. Etiam eget sem eleifend, viverra odio non, consequat justo. Aliquam ac porttitor lectus. Praesent eget efficitur eros. Etiam lectus dui, mattis fringilla rutrum vitae, elementum id ipsum. Fusce rutrum mauris nec urna aliquet lacinia. Vivamus nec lorem a nibh posuere volutpat in eu libero. Integer felis nunc, dictum vel arcu eu, mollis congue odio. Cras eget magna a urna interdum ornare vitae eget tellus.', 'assets/img/empresas/3.png', 6, NULL, 0, 0),
(4, 'B45895623', 'Unit 5', 'Calle Unidad, 5', '958264897', '958264897', 'Sed sed scelerisque erat, ac tempor elit. Sed malesuada elit vel laoreet laoreet. Donec nec leo eget nisl condimentum ornare. Donec tortor sapien, lacinia nec enim sed, semper dignissim tellus. Maecenas odio sem, fermentum id aliquet tincidunt, vehicula ut nisi. Maecenas id commodo nibh. Donec fringilla eget dui nec fermentum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Quisque malesuada sollicitudin diam, sed mattis ipsum.', 'assets/img/empresas/4.png', 6, 7, 2, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `evento`
--

INSERT INTO `evento` (`id`, `nombre`, `fechaInicio`, `fechaFin`, `precio`, `plazas`, `descripcion`, `requisitos`, `imagen`, `sala`, `empresa`, `usuario`, `promocion`, `baja`) VALUES
(1, 'Hackathon NavideÃ±o', '2015-12-27 12:30:00', '2015-12-27 18:30:00', 0, 150, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 'PortÃ¡til y ganas de colaborar', 'assets/img/eventos/1.jpeg', 5, 1, NULL, 0, 0),
(12, 'Taller de Arduino', '2015-12-15 10:00:00', '2015-12-15 12:00:00', 20, 50, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 'Aparatito para cacharrear', 'assets/img/eventoCancelado.png', NULL, NULL, 2, 0, 1),
(13, 'Taller de jQuery', '2015-12-20 12:00:00', '2015-12-20 13:00:00', 0, 50, 'Mauris condimentum vestibulum tellus, vitae fermentum augue pretium sit amet. Duis ut lectus eget elit fringilla egestas quis et dui. Duis tellus leo, aliquam quis metus non, rutrum pellentesque velit. Vestibulum eget commodo nunc. Integer consectetur vitae massa quis tincidunt. Donec hendrerit velit sed vehicula interdum. Mauris tristique a urna nec sollicitudin. Phasellus lobortis enim et lorem faucibus, ac lobortis lorem porttitor. Mauris commodo interdum risus, quis auctor erat vestibulum et. Integer vehicula sapien quis mi ornare, eu euismod dui luctus. Aliquam id vulputate leo. Vivamus tempor eget leo ac dignissim.', 'PortÃ¡til, conexiÃ³n a Internet', 'assets/img/eventos/13.jpeg', 6, NULL, 2, 0, 0),
(14, 'Taller de VTK', '2016-12-28 10:00:00', '2016-12-28 13:00:00', 0, 2, 'In a sapien sed diam ullamcorper gravida. Quisque tempor nisl ipsum, at vehicula nunc convallis vel. Praesent non justo fringilla, tincidunt dolor a, facilisis nulla. Cras faucibus ullamcorper dui id dapibus. Sed tempus in tellus eget interdum. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Proin porttitor volutpat quam id pharetra. Maecenas eu lorem convallis, ullamcorper dolor in, gravida augue. Praesent at libero facilisis, venenatis tellus tempus, ullamcorper justo.', 'PortÃ¡til con compilador C++', 'assets/img/eventos/14.png', NULL, NULL, 6, 7, 0),
(15, 'Taller de Yii', '2016-12-29 10:00:00', '2016-12-29 13:00:00', 0, 50, 'Mauris rutrum pharetra eros, in dictum mauris luctus in. Suspendisse potenti. Proin quis ante vitae augue feugiat lacinia sit amet ac velit. Curabitur viverra, arcu in lacinia sollicitudin, dolor odio maximus nunc, ac mollis sem lectus nec lorem. Integer tortor nunc, tincidunt porttitor facilisis ac, mattis non odio. Cras sit amet rhoncus magna. Pellentesque consectetur ut justo nec vestibulum. Fusce quis euismod leo. Donec ac vulputate diam.', 'PortÃ¡til', 'assets/img/eventos/15.jpeg', NULL, 3, NULL, 0, 0),
(19, 'Taller de Qt', '2016-12-29 10:00:00', '2016-12-29 14:00:00', 30, 50, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis id arcu eu lectus interdum tempus. Pellentesque aliquet placerat felis, in varius orci aliquet ac. In eget imperdiet arcu, eu tincidunt sapien. Fusce pulvinar laoreet elit eu sodales. Praesent pharetra consequat nisi quis fringilla. Mauris malesuada leo at odio vehicula ultrices. Nullam semper mollis tellus, in dapibus metus suscipit vitae. Cras quis mauris sem. Phasellus vel lacinia odio. Donec ultrices ex ac risus accumsan, id ullamcorper erat dapibus. Duis turpis lectus, volutpat mattis enim et, ornare iaculis augue. Sed pellentesque semper urna, non eleifend ligula. Fusce mollis, turpis in ultricies vulputate, risus ipsum tristique metus, ut venenatis felis magna nec erat. Donec efficitur tellus augue, vel dictum turpis sagittis at. Curabitur dapibus diam et libero dapibus malesuada. Pellentesque vitae enim tortor.', 'Nullam pharetra dapibus blandit. Integer orci ex, tristique quis auctor eu, ornare ac turpis. Nunc pulvinar nunc nec imperdiet dictum.', 'assets/img/eventos/19.jpeg', NULL, NULL, 6, 0, 0);

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
(7, 'louri91', 'e10adc3949ba59abbe56e057f20f883e', 'louri1991@gmail.com', 'Amanda FernÃ¡ndez Piedra', '656661801', 'mujer', 'EspaÃ±a', 'Granada', 'Calle Mirlo', '18014', 'assets/img/user.png');

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
(6, 1),
(6, 2),
(7, 2);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `evento`
--
ALTER TABLE `evento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
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
