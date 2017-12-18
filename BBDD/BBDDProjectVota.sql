-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 18-12-2017 a las 20:27:00
-- Versión del servidor: 5.7.20-0ubuntu0.16.04.1
-- Versión de PHP: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `BBDDProjectVota`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Votaciones`
--

CREATE TABLE `Votaciones` (
  `ID_Votaciones` int(5) NOT NULL,
  `ID_Opcion` varchar(255) NOT NULL,
  `ID_Usuario` int(5) NOT NULL,
  `ID_Consulta` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Votaciones`
--

INSERT INTO `Votaciones` (`ID_Votaciones`, `ID_Opcion`, `ID_Usuario`, `ID_Consulta`) VALUES
(1, '1', 1, 1),
(2, '1', 1, 1),
(3, '3', 1, 2),
(7, '1', 2, 1),
(11, '1', 5, 1),
(12, '	<?”EZ1Rä”énUÒV', 5, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Votaciones`
--
ALTER TABLE `Votaciones`
  ADD PRIMARY KEY (`ID_Votaciones`),
  ADD KEY `ID_Opcion` (`ID_Opcion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Votaciones`
--
ALTER TABLE `Votaciones`
  MODIFY `ID_Votaciones` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
