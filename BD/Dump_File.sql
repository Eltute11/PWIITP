-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-07-2015 a las 05:01:15
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `seguridadlandia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alarma_cliente`
--

CREATE TABLE IF NOT EXISTS `alarma_cliente` (
  `id_cliente` decimal(10,0) NOT NULL,
`cod_alarma` int(11) NOT NULL,
  `cod_desbloqueo` varchar(40) NOT NULL,
  `estado` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `camaras`
--

CREATE TABLE IF NOT EXISTS `camaras` (
  `id_cliente` decimal(10,0) NOT NULL,
`id_camara` int(11) NOT NULL,
  `descripcion` varchar(30) DEFAULT NULL,
  `disponibilidad` decimal(1,0) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1000 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_cab`
--

CREATE TABLE IF NOT EXISTS `factura_cab` (
  `id_cliente` decimal(10,0) NOT NULL,
  `nro_fact` int(11) NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `estado_pago` decimal(1,0) NOT NULL,
  `total_fact` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_det`
--

CREATE TABLE IF NOT EXISTS `factura_det` (
  `nro_fact` int(11) NOT NULL,
  `nro_subfact` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `cod_prod` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `imp_total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_res`
--

CREATE TABLE IF NOT EXISTS `factura_res` (
  `id_cliente` decimal(10,0) NOT NULL,
`nro_fact` int(11) NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `estado_pago` decimal(1,0) NOT NULL,
  `total_fact` decimal(10,0) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1000 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hist_alarma_cliente`
--

CREATE TABLE IF NOT EXISTS `hist_alarma_cliente` (
`cod_alarma_hist` int(11) NOT NULL,
  `cod_alarma` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `fecha_hora` datetime DEFAULT NULL,
  `real_falsa` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidades`
--

CREATE TABLE IF NOT EXISTS `localidades` (
`cod_loc` int(11) NOT NULL,
  `descr_loc` varchar(30) NOT NULL,
  `cod_prov` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `localidades`
--

INSERT INTO `localidades` (`cod_loc`, `descr_loc`, `cod_prov`) VALUES
(2, 'Castelar', 1),
(3, 'Ituzaingo', 1),
(1, 'San Antonio de Padua', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE IF NOT EXISTS `paises` (
`cod_pais` int(11) NOT NULL,
  `descr_pais` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`cod_pais`, `descr_pais`) VALUES
(1, 'Argentina'),
(2, 'Chile'),
(3, 'Uruguay');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE IF NOT EXISTS `perfiles` (
  `id_perfil` decimal(10,0) NOT NULL,
  `cod_tiporol` decimal(2,0) NOT NULL,
  `cod_tipdoc` decimal(2,0) NOT NULL,
  `nro_doc` decimal(11,0) NOT NULL,
  `nombres` varchar(30) NOT NULL,
  `apellidos` varchar(30) NOT NULL,
  `fecha_nac` date NOT NULL,
  `cod_pais` int(11) NOT NULL,
  `cod_prov` int(11) NOT NULL,
  `cod_loc` int(11) NOT NULL,
  `direccion` varchar(30) NOT NULL,
  `num_direccion` decimal(6,0) NOT NULL,
  `latitud` varchar(40) DEFAULT NULL,
  `longitud` varchar(40) DEFAULT NULL,
  `sexo` varchar(1) NOT NULL,
  `telefono_1` decimal(15,0) NOT NULL,
  `telefono_2` decimal(15,0) DEFAULT NULL,
  `direccion_email` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`id_perfil`, `cod_tiporol`, `cod_tipdoc`, `nro_doc`, `nombres`, `apellidos`, `fecha_nac`, `cod_pais`, `cod_prov`, `cod_loc`, `direccion`, `num_direccion`, `latitud`, `longitud`, `sexo`, `telefono_1`, `telefono_2`, `direccion_email`) VALUES
('1', '1', '1', '35951529', 'Juan Ignacio', 'Urcola', '1992-10-14', 1, 1, 1, 'Scalabrini Ortiz', '525', NULL, NULL, 'M', '1133443344', NULL, 'juanig.urcola@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_sistema`
--

CREATE TABLE IF NOT EXISTS `productos_sistema` (
`cod_prod` int(11) NOT NULL,
  `descr_prod` varchar(100) NOT NULL,
  `precio` decimal(12,2) NOT NULL,
  `stock` decimal(10,0) DEFAULT NULL,
  `obligatorio` decimal(1,0) DEFAULT NULL,
  `permite_cant` decimal(1,0) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos_sistema`
--

INSERT INTO `productos_sistema` (`cod_prod`, `descr_prod`, `precio`, `stock`, `obligatorio`, `permite_cant`) VALUES
(1, 'Costo de instalacion', '3000.00', '20', '1', '0'),
(2, 'Router centralizador de seguridad', '1800.00', '10', '1', '0'),
(3, 'Alarma blindada', '3700.00', '10', '1', '0'),
(4, 'Bateria de sistema de seguridad', '850.00', '10', '1', '0'),
(5, 'Sensores de presencia', '550.00', '10', '1', '1'),
(6, 'Sensores de cierre de aperturas', '750.00', '10', '1', '1'),
(7, 'Camaras IP', '1100.00', '10', '0', '1'),
(8, 'Comunicador 3G', '2500.00', '10', '0', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE IF NOT EXISTS `provincias` (
`cod_prov` int(11) NOT NULL,
  `descr_prov` varchar(30) NOT NULL,
  `cod_pais` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`cod_prov`, `descr_prov`, `cod_pais`) VALUES
(1, 'Buenos Aires', 1),
(2, 'Cordoba', 1),
(3, 'Santigo', 2),
(4, 'Melipilla', 2),
(5, 'Montevideo', 3),
(6, 'Punta del Este', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_documentos`
--

CREATE TABLE IF NOT EXISTS `tipos_documentos` (
  `cod_tipdoc` decimal(2,0) NOT NULL,
  `descr_tipdoc` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipos_documentos`
--

INSERT INTO `tipos_documentos` (`cod_tipdoc`, `descr_tipdoc`) VALUES
('1', 'DNI'),
('2', 'L.E'),
('3', 'L.C');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_roles`
--

CREATE TABLE IF NOT EXISTS `tipos_roles` (
  `cod_tiporol` decimal(2,0) NOT NULL,
  `descr_tipper` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipos_roles`
--

INSERT INTO `tipos_roles` (`cod_tiporol`, `descr_tipper`) VALUES
('1', 'Administrador'),
('2', 'Monitoreador'),
('3', 'Clientes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_perfil` decimal(10,0) NOT NULL,
  `cod_tiporol` decimal(2,0) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_perfil`, `cod_tiporol`, `usuario`, `password`) VALUES
('1', '1', 'jurcola', '202cb962ac59075b964b07152d234b70');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alarma_cliente`
--
ALTER TABLE `alarma_cliente`
 ADD PRIMARY KEY (`cod_alarma`), ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `camaras`
--
ALTER TABLE `camaras`
 ADD PRIMARY KEY (`id_camara`), ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `factura_cab`
--
ALTER TABLE `factura_cab`
 ADD PRIMARY KEY (`nro_fact`), ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `factura_det`
--
ALTER TABLE `factura_det`
 ADD UNIQUE KEY `nro_fact` (`nro_fact`,`nro_subfact`), ADD KEY `cod_prod` (`cod_prod`);

--
-- Indices de la tabla `factura_res`
--
ALTER TABLE `factura_res`
 ADD PRIMARY KEY (`nro_fact`), ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `hist_alarma_cliente`
--
ALTER TABLE `hist_alarma_cliente`
 ADD PRIMARY KEY (`cod_alarma_hist`), ADD KEY `cod_alarma` (`cod_alarma`);

--
-- Indices de la tabla `localidades`
--
ALTER TABLE `localidades`
 ADD PRIMARY KEY (`cod_loc`), ADD UNIQUE KEY `descr_loc` (`descr_loc`,`cod_prov`), ADD KEY `cod_prov` (`cod_prov`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
 ADD PRIMARY KEY (`cod_pais`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
 ADD PRIMARY KEY (`id_perfil`), ADD UNIQUE KEY `cod_tiporol` (`cod_tiporol`,`cod_tipdoc`,`nro_doc`), ADD KEY `cod_tipdoc` (`cod_tipdoc`), ADD KEY `cod_pais` (`cod_pais`), ADD KEY `cod_prov` (`cod_prov`), ADD KEY `cod_loc` (`cod_loc`);

--
-- Indices de la tabla `productos_sistema`
--
ALTER TABLE `productos_sistema`
 ADD PRIMARY KEY (`cod_prod`);

--
-- Indices de la tabla `provincias`
--
ALTER TABLE `provincias`
 ADD PRIMARY KEY (`cod_prov`), ADD KEY `cod_pais` (`cod_pais`);

--
-- Indices de la tabla `tipos_documentos`
--
ALTER TABLE `tipos_documentos`
 ADD PRIMARY KEY (`cod_tipdoc`);

--
-- Indices de la tabla `tipos_roles`
--
ALTER TABLE `tipos_roles`
 ADD PRIMARY KEY (`cod_tiporol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
 ADD PRIMARY KEY (`usuario`), ADD KEY `id_perfil` (`id_perfil`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alarma_cliente`
--
ALTER TABLE `alarma_cliente`
MODIFY `cod_alarma` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `camaras`
--
ALTER TABLE `camaras`
MODIFY `id_camara` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1000;
--
-- AUTO_INCREMENT de la tabla `factura_res`
--
ALTER TABLE `factura_res`
MODIFY `nro_fact` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1000;
--
-- AUTO_INCREMENT de la tabla `hist_alarma_cliente`
--
ALTER TABLE `hist_alarma_cliente`
MODIFY `cod_alarma_hist` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `localidades`
--
ALTER TABLE `localidades`
MODIFY `cod_loc` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
MODIFY `cod_pais` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `productos_sistema`
--
ALTER TABLE `productos_sistema`
MODIFY `cod_prod` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `provincias`
--
ALTER TABLE `provincias`
MODIFY `cod_prov` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alarma_cliente`
--
ALTER TABLE `alarma_cliente`
ADD CONSTRAINT `alarma_cliente_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `perfiles` (`id_perfil`);

--
-- Filtros para la tabla `camaras`
--
ALTER TABLE `camaras`
ADD CONSTRAINT `camaras_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `perfiles` (`id_perfil`);

--
-- Filtros para la tabla `factura_cab`
--
ALTER TABLE `factura_cab`
ADD CONSTRAINT `factura_cab_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `perfiles` (`id_perfil`);

--
-- Filtros para la tabla `factura_det`
--
ALTER TABLE `factura_det`
ADD CONSTRAINT `factura_det_ibfk_1` FOREIGN KEY (`nro_fact`) REFERENCES `factura_cab` (`nro_fact`),
ADD CONSTRAINT `factura_det_ibfk_2` FOREIGN KEY (`cod_prod`) REFERENCES `productos_sistema` (`cod_prod`);

--
-- Filtros para la tabla `factura_res`
--
ALTER TABLE `factura_res`
ADD CONSTRAINT `factura_res_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `perfiles` (`id_perfil`);

--
-- Filtros para la tabla `hist_alarma_cliente`
--
ALTER TABLE `hist_alarma_cliente`
ADD CONSTRAINT `hist_alarma_cliente_ibfk_1` FOREIGN KEY (`cod_alarma`) REFERENCES `alarma_cliente` (`cod_alarma`);

--
-- Filtros para la tabla `localidades`
--
ALTER TABLE `localidades`
ADD CONSTRAINT `localidades_ibfk_1` FOREIGN KEY (`cod_prov`) REFERENCES `provincias` (`cod_prov`);

--
-- Filtros para la tabla `perfiles`
--
ALTER TABLE `perfiles`
ADD CONSTRAINT `perfiles_ibfk_1` FOREIGN KEY (`cod_tiporol`) REFERENCES `tipos_roles` (`cod_tiporol`),
ADD CONSTRAINT `perfiles_ibfk_2` FOREIGN KEY (`cod_tipdoc`) REFERENCES `tipos_documentos` (`cod_tipdoc`),
ADD CONSTRAINT `perfiles_ibfk_3` FOREIGN KEY (`cod_pais`) REFERENCES `paises` (`cod_pais`),
ADD CONSTRAINT `perfiles_ibfk_4` FOREIGN KEY (`cod_prov`) REFERENCES `provincias` (`cod_prov`),
ADD CONSTRAINT `perfiles_ibfk_5` FOREIGN KEY (`cod_loc`) REFERENCES `localidades` (`cod_loc`);

--
-- Filtros para la tabla `provincias`
--
ALTER TABLE `provincias`
ADD CONSTRAINT `provincias_ibfk_1` FOREIGN KEY (`cod_pais`) REFERENCES `paises` (`cod_pais`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_perfil`) REFERENCES `perfiles` (`id_perfil`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
