-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 08-09-2017 a las 19:43:29
-- Versión del servidor: 5.5.41
-- Versión de PHP: 5.2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `ecursos_empresas`
--

CREATE DATABASE IF NOT EXISTS ecursos_empresas;

Use ecursos_empresas;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dem_asignaciones`
--

CREATE TABLE IF NOT EXISTS `dem_asignaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcurso` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `calificacion` varchar(11) DEFAULT NULL,
  `visto` int(11) NOT NULL DEFAULT '0',
  `estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dem_categorias`
--

CREATE TABLE IF NOT EXISTS `dem_categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `idempresa` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dem_cursos`
--

CREATE TABLE IF NOT EXISTS `dem_cursos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcategoria` int(11) NOT NULL,
  `idsubcategoria` int(11) NOT NULL,
  `empresa` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descripcion` longtext NOT NULL,
  `autor` int(50) NOT NULL,
  `fecha` varchar(50) NOT NULL,
  `hora` varchar(10) NOT NULL,
  `link_imagen` varchar(100) NOT NULL,
  `link_video` varchar(100) NOT NULL,
  `link_doc` varchar(100) NOT NULL,
  `link_audio` varchar(100) NOT NULL,
  `youtube` int(11) NOT NULL DEFAULT '0',
  `espacio` float NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dem_cursos_usuario`
--

CREATE TABLE IF NOT EXISTS `dem_cursos_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcurso` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `calificacion` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pk_usuario_curso` (`idcurso`,`idusuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dem_examenes`
--

CREATE TABLE IF NOT EXISTS `dem_examenes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcurso` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dem_examenes_preguntas`
--

CREATE TABLE IF NOT EXISTS `dem_examenes_preguntas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idexamen` int(11) NOT NULL,
  `pregunta` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dem_examenes_respuestas`
--

CREATE TABLE IF NOT EXISTS `dem_examenes_respuestas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idpregunta` int(11) NOT NULL,
  `respuesta` varchar(500) NOT NULL,
  `correcta` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dem_examenes_usuarios`
--

CREATE TABLE IF NOT EXISTS `dem_examenes_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idexamen` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idpregunta` int(11) NOT NULL,
  `idrespuesta` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dem_notificaciones`
--

CREATE TABLE IF NOT EXISTS `dem_notificaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idautor` int(11) NOT NULL,
  `idcurso` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `mensaje` varchar(255) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dem_subcategorias`
--

CREATE TABLE IF NOT EXISTS `dem_subcategorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcategoria` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dem_usuarios`
--

CREATE TABLE IF NOT EXISTS `dem_usuarios` (
  `estado` int(11) NOT NULL,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `clave` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `perfil` int(11) NOT NULL,
  `empresa` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario_uq` (`usuario`,`empresa`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE IF NOT EXISTS `empresas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estado` int(11) NOT NULL DEFAULT '1',
  `nombre` varchar(100) NOT NULL,
  `carpeta` varchar(50) NOT NULL,
  `usuarios` int(11) NOT NULL,
  `usuarios_utilizados` int(11) NOT NULL,
  `espacio` float NOT NULL,
  `espacio_utilizado` float NOT NULL,
  `pre` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `empresa_uq` (`nombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id`, `estado`, `nombre`, `carpeta`, `usuarios`, `usuarios_utilizados`, `espacio`, `espacio_utilizado`, `pre`) VALUES
(1, 1, 'Empresa demo', 'demo', 10, 1, 1073740000, 1587580, 'dem');

--
-- Volcado de datos para la tabla `dem_usuarios`
--

INSERT INTO `dem_usuarios` (`estado`, `id`, `nombre`, `usuario`, `clave`, `email`, `perfil`, `empresa`) VALUES
(1, 1, 'Usuario 1', 'demo1', '12345', 'jignaciopaz@jipnet.com.ar', 1, 1);

CREATE USER 'ecursos'@'localhost' IDENTIFIED BY 'Ecursos2017';

GRANT ALL PRIVILEGES ON ecursos_empresas.table TO 'ecursos'@'localhost';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
