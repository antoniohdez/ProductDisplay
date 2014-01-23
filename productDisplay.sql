-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 21-01-2014 a las 01:54:42
-- Versión del servidor: 5.6.14
-- Versión de PHP: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `productDisplay`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `target`
--

CREATE TABLE IF NOT EXISTS `target` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `url` varchar(128) DEFAULT NULL,
  `facebook` varchar(128) DEFAULT NULL,
  `twitter` varchar(128) DEFAULT NULL,
  `phone` varchar(14) DEFAULT NULL,
  `path_audio` varchar(128) DEFAULT NULL,
  `path_video` varchar(128) DEFAULT NULL,
  `path_image` varchar(128) NOT NULL,
  `vuforiaID` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=109 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `country` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `path_logo` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `country`, `city`, `path_logo`) VALUES
(1, 'Brian', 'brian@illut.io', '$2y$11$dbc7cac81540e0edbd32fOlvCM/vAYtOO4LtJ/Cjnwps9yEouaLRS', 'Mexico', 'Guadalajara', 'uploadedMedia/logo/illutio.png');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `target`
--
ALTER TABLE `target`
  ADD CONSTRAINT `target_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
