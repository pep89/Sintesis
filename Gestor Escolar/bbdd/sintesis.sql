-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-11-2012 a las 12:58:36
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Volcado de datos para la tabla `any_academic`
--

INSERT INTO `any_academic` (`id`, `any`) VALUES
(36, 2013),
(37, 2014);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `clases`
--

INSERT INTO `clases` (`id`, `id_any`, `id_curs`, `nom`, `codi`, `hores`) VALUES
(7, 36, 8, 'Programació Orientada a objectes', 'POO', 7),
(8, 37, 9, 'XARXES', 'XAR', 70),
(9, 36, 9, 'Sistemes', 'SIM', 60);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id`, `id_any`, `nom`, `acronim`) VALUES
(8, 36, 'Desenvolupament de aplicacions Informatiques', 'DAI'),
(9, 37, 'Administracio de sistemes informatics', 'ASI');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Volcado de datos para la tabla `grups`
--

INSERT INTO `grups` (`id`, `id_any`, `id_curs`, `id_clase`, `nom`, `hores`) VALUES
(16, 36, 8, 7, 'A', 3),
(17, 36, 8, 7, 'B', 4),
(18, 37, 9, 8, 'A', 3),
(19, 36, 9, 9, '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imparticio`
--

CREATE TABLE IF NOT EXISTS `imparticio` (
  `id_grup` int(11) NOT NULL,
  `id_profesor` int(11) NOT NULL,
  `data_inici` date NOT NULL,
  `data_fi` date NOT NULL,
  `substitut` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_grup`,`id_profesor`),
  KEY `id_profesor` (`id_profesor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `imparticio`
--

INSERT INTO `imparticio` (`id_grup`, `id_profesor`, `data_inici`, `data_fi`, `substitut`) VALUES
(16, 2, '2012-09-16', '2013-06-10', 0),
(16, 3, '2013-02-11', '2013-02-28', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persones`
--

CREATE TABLE IF NOT EXISTS `persones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(25) NOT NULL,
  `cognom` varchar(25) NOT NULL,
  `tipus` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tipus` (`tipus`),
  KEY `tipus_2` (`tipus`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `persones`
--

INSERT INTO `persones` (`id`, `nom`, `cognom`, `tipus`) VALUES
(1, 'Moises', 'Gomez', 2),
(2, 'Alex', 'Viejo', 2),
(5, 'Jordi', 'Quesada', 2),
(6, 'Juan', 'Sanchez', 2),
(7, 'Daniel', 'Artola', 3),
(8, 'Miquel', 'Agullo', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesors`
--

CREATE TABLE IF NOT EXISTS `profesors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_persona` int(11) NOT NULL,
  `correu` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_profesor` (`id_persona`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `profesors`
--

INSERT INTO `profesors` (`id`, `id_persona`, `correu`) VALUES
(2, 1, 'moises.gomez@iesjoandaustria.org'),
(3, 5, 'jordi.quesada@iesjoandaustria.org');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipuspersona`
--

CREATE TABLE IF NOT EXISTS `tipuspersona` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipus` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tipuspersona`
--

INSERT INTO `tipuspersona` (`id`, `tipus`) VALUES
(1, 'Administrador'),
(2, 'Profesor'),
(3, 'Alumno');

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

--
-- Filtros para la tabla `imparticio`
--
ALTER TABLE `imparticio`
  ADD CONSTRAINT `imparticio_ibfk_2` FOREIGN KEY (`id_profesor`) REFERENCES `profesors` (`id`),
  ADD CONSTRAINT `imparticio_ibfk_1` FOREIGN KEY (`id_grup`) REFERENCES `grups` (`id`);

--
-- Filtros para la tabla `persones`
--
ALTER TABLE `persones`
  ADD CONSTRAINT `persones_ibfk_1` FOREIGN KEY (`tipus`) REFERENCES `tipuspersona` (`id`);

--
-- Filtros para la tabla `profesors`
--
ALTER TABLE `profesors`
  ADD CONSTRAINT `profesors_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `persones` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
