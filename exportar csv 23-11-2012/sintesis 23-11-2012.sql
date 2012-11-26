-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-11-2012 a las 11:35:36
-- Versión del servidor: 5.5.27-log
-- Versión de PHP: 5.4.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `sintesis`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `any_academic`
--

CREATE TABLE IF NOT EXISTS `any_academic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `any` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Volcado de datos para la tabla `any_academic`
--

INSERT INTO `any_academic` (`id`, `any`) VALUES
(1, 2013);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clases`
--

CREATE TABLE IF NOT EXISTS `clases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_any` int(11) NOT NULL,
  `id_curs` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `codi` varchar(10) NOT NULL,
  `hores` int(11) NOT NULL,
  PRIMARY KEY (`id`,`id_any`,`id_curs`),
  KEY `id_any` (`id_any`),
  KEY `id_curs` (`id_curs`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `clases`
--

INSERT INTO `clases` (`id`, `id_any`, `id_curs`, `nom`, `codi`, `hores`) VALUES
(1, 1, 1, 'Programació Orientada a objectes', 'POO', 7),
(2, 1, 2, 'XARXES', 'XAR', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE IF NOT EXISTS `cursos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_any` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `acronim` varchar(10) NOT NULL,
  PRIMARY KEY (`id`,`id_any`),
  KEY `id_any` (`id_any`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id`, `id_any`, `nom`, `acronim`) VALUES
(1, 1, 'Desenvolupament de aplicacions Informatiques', 'DAI'),
(2, 1, 'Administracio de sistemes informatics', 'ASI');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grups`
--

CREATE TABLE IF NOT EXISTS `grups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_any` int(11) NOT NULL,
  `id_curs` int(11) NOT NULL,
  `id_clase` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `hores` int(11) NOT NULL,
  PRIMARY KEY (`id`,`id_any`,`id_curs`,`id_clase`),
  KEY `id_any` (`id_any`),
  KEY `id_curs` (`id_curs`),
  KEY `id_clase` (`id_clase`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `grups`
--

INSERT INTO `grups` (`id`, `id_any`, `id_curs`, `id_clase`, `nom`, `hores`) VALUES
(1, 1, 1, 1, 'A', 3),
(2, 1, 1, 1, 'B', 4);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clases`
--
ALTER TABLE `clases`
  ADD CONSTRAINT `clases_ibfk_1` FOREIGN KEY (`id_any`) REFERENCES `any_academic` (`id`),
  ADD CONSTRAINT `clases_ibfk_2` FOREIGN KEY (`id_curs`) REFERENCES `cursos` (`id`);

--
-- Filtros para la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `cursos_ibfk_1` FOREIGN KEY (`id_any`) REFERENCES `any_academic` (`id`);

--
-- Filtros para la tabla `grups`
--
ALTER TABLE `grups`
  ADD CONSTRAINT `grups_ibfk_1` FOREIGN KEY (`id_any`) REFERENCES `any_academic` (`id`),
  ADD CONSTRAINT `grups_ibfk_2` FOREIGN KEY (`id_curs`) REFERENCES `cursos` (`id`),
  ADD CONSTRAINT `grups_ibfk_3` FOREIGN KEY (`id_clase`) REFERENCES `clases` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
