-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 18-12-2017 a las 18:03:17
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
-- Estructura de tabla para la tabla `Consulta`
--

CREATE TABLE `Consulta` (
  `ID_Consulta` int(5) NOT NULL,
  `Desc_Pregunta` varchar(255) NOT NULL,
  `ID_Usuario` int(5) NOT NULL,
  `F_Inicio` date NOT NULL,
  `F_Final` date NOT NULL,
  `H_Inicio` varchar(5) DEFAULT NULL,
  `H_Final` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Consulta`
--

INSERT INTO `Consulta` (`ID_Consulta`, `Desc_Pregunta`, `ID_Usuario`, `F_Inicio`, `F_Final`, `H_Inicio`, `H_Final`) VALUES
(1, 'Ser o no ser?', 2, '2017-11-08', '2017-11-17', '20:00', '20:00'),
(2, 'Es Marc Guerra un pelotudo?', 1, '2017-11-25', '2017-11-27', '20:00', '20:00'),
(3, 'Funciona esta mierda?', 1, '2017-12-28', '2018-01-10', '01:00', '01:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Invitacion`
--

CREATE TABLE `Invitacion` (
  `ID_Invitacion` int(5) NOT NULL,
  `ID_Usuario` int(5) NOT NULL,
  `ID_Consulta` int(5) NOT NULL,
  `Email` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Invitacion`
--

INSERT INTO `Invitacion` (`ID_Invitacion`, `ID_Usuario`, `ID_Consulta`, `Email`) VALUES
(1, 4, 1, 'locotedelacolina@gmail.com'),
(2, 1, 1, 'jgonzalezc.crn@artsgrafiques.org');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Opcion`
--

CREATE TABLE `Opcion` (
  `ID_Opcion` int(5) NOT NULL,
  `ID_Consulta` int(5) NOT NULL,
  `Descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Opcion`
--

INSERT INTO `Opcion` (`ID_Opcion`, `ID_Consulta`, `Descripcion`) VALUES
(1, 1, 'Ser'),
(2, 1, 'No ser'),
(3, 3, 'Holi'),
(4, 3, 'Adiosito'),
(5, 2, 'Si'),
(6, 2, 'Claro que si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuario`
--

CREATE TABLE `Usuario` (
  `ID_Usuario` int(5) NOT NULL,
  `Nombre` varchar(15) DEFAULT NULL,
  `Apellido` varchar(25) DEFAULT NULL,
  `Usuario` varchar(25) DEFAULT NULL,
  `Contrasena` varchar(25) DEFAULT NULL,
  `Email` varchar(35) NOT NULL,
  `Administrador` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Usuario`
--

INSERT INTO `Usuario` (`ID_Usuario`, `Nombre`, `Apellido`, `Usuario`, `Contrasena`, `Email`, `Administrador`) VALUES
(1, 'José', 'González Castillo', 'JotaGonzalez', '123456', 'jgonzalezc.crn@artsgrafiques.org', 42),
(2, 'Sergi', 'Coma Corcuera', 'Scoma', '123456', 'scomacorcuera@iesesteveterradas.cat', 42),
(3, 'Alvaro', 'Delgado Rioja', 'Adelgado', '654321', 'adelagadorioja@gmail.com', 0),
(4, NULL, NULL, NULL, NULL, 'locotedelacolina@gmail.com', 0),
(5, 'Test', 'test', 'test', '123456', 'test@test.com', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Votaciones`
--

CREATE TABLE `Votaciones` (
  `ID_Votaciones` int(5) NOT NULL,
  `ID_Opcion` varchar(255) NOT NULL,
  `ID_Usuario` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Votaciones`
--

INSERT INTO `Votaciones` (`ID_Votaciones`, `ID_Opcion`, `ID_Usuario`) VALUES
(1, '1', 1),
(2, '1', 1),
(3, '3', 1),
(7, '1', 2),
(8, '*v`nù§)\'™89v‘', 2),
(9, 'Ì`ýZãËå‰ÐfŸ­–9', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Consulta`
--
ALTER TABLE `Consulta`
  ADD PRIMARY KEY (`ID_Consulta`),
  ADD KEY `Index` (`ID_Usuario`),
  ADD KEY `ID_Usuario` (`ID_Usuario`);

--
-- Indices de la tabla `Invitacion`
--
ALTER TABLE `Invitacion`
  ADD PRIMARY KEY (`ID_Invitacion`),
  ADD KEY `ID_Usuario` (`ID_Usuario`),
  ADD KEY `ID_Consulta` (`ID_Consulta`);

--
-- Indices de la tabla `Opcion`
--
ALTER TABLE `Opcion`
  ADD PRIMARY KEY (`ID_Opcion`),
  ADD KEY `ID_Consulta` (`ID_Consulta`);

--
-- Indices de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  ADD PRIMARY KEY (`ID_Usuario`),
  ADD UNIQUE KEY `Email` (`Email`);

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
-- AUTO_INCREMENT de la tabla `Consulta`
--
ALTER TABLE `Consulta`
  MODIFY `ID_Consulta` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `Invitacion`
--
ALTER TABLE `Invitacion`
  MODIFY `ID_Invitacion` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `Opcion`
--
ALTER TABLE `Opcion`
  MODIFY `ID_Opcion` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  MODIFY `ID_Usuario` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `Votaciones`
--
ALTER TABLE `Votaciones`
  MODIFY `ID_Votaciones` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Consulta`
--
ALTER TABLE `Consulta`
  ADD CONSTRAINT `FK_ID_Usuario_Consulta` FOREIGN KEY (`ID_Usuario`) REFERENCES `Usuario` (`ID_Usuario`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `Invitacion`
--
ALTER TABLE `Invitacion`
  ADD CONSTRAINT `FK_ID_Consulta_Invitacion` FOREIGN KEY (`ID_Consulta`) REFERENCES `Consulta` (`ID_Consulta`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ID_Usuario_Invitacion` FOREIGN KEY (`ID_Usuario`) REFERENCES `Usuario` (`ID_Usuario`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
