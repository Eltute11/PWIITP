-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-07-2015 a las 06:48:19
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
  `sexo` varchar(1) NOT NULL,
  `telefono_1` decimal(15,0) NOT NULL,
  `telefono_2` decimal(15,0) DEFAULT NULL,
  `direccion_email` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`id_perfil`, `cod_tiporol`, `cod_tipdoc`, `nro_doc`, `nombres`, `apellidos`, `fecha_nac`, `cod_pais`, `cod_prov`, `cod_loc`, `direccion`, `num_direccion`, `sexo`, `telefono_1`, `telefono_2`, `direccion_email`) VALUES
('1', '1', '1', '35951529', 'Juan Ignacio', 'Urcola', '1992-10-14', 1, 1, 1, 'Scalabrini Ortiz', '525', 'M', '1133443344', NULL, 'juanig.urcola@gmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
 ADD PRIMARY KEY (`id_perfil`), ADD UNIQUE KEY `cod_tiporol` (`cod_tiporol`,`cod_tipdoc`,`nro_doc`), ADD KEY `cod_tipdoc` (`cod_tipdoc`), ADD KEY `cod_pais` (`cod_pais`), ADD KEY `cod_prov` (`cod_prov`), ADD KEY `cod_loc` (`cod_loc`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `perfiles`
--
ALTER TABLE `perfiles`
ADD CONSTRAINT `perfiles_ibfk_1` FOREIGN KEY (`cod_tiporol`) REFERENCES `tipos_roles` (`cod_tiporol`),
ADD CONSTRAINT `perfiles_ibfk_2` FOREIGN KEY (`cod_tipdoc`) REFERENCES `tipos_documentos` (`cod_tipdoc`),
ADD CONSTRAINT `perfiles_ibfk_3` FOREIGN KEY (`cod_pais`) REFERENCES `paises` (`cod_pais`),
ADD CONSTRAINT `perfiles_ibfk_4` FOREIGN KEY (`cod_prov`) REFERENCES `provincias` (`cod_prov`),
ADD CONSTRAINT `perfiles_ibfk_5` FOREIGN KEY (`cod_loc`) REFERENCES `localidades` (`cod_loc`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
