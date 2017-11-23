-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 23-11-2017 a las 20:19:52
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
  `Descripcion Pregunta` varchar(255) NOT NULL,
  `ID_Usuario` int(5) NOT NULL,
  `Fecha Inicio` date NOT NULL,
  `Fecha Final` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Consulta`
--

INSERT INTO `Consulta` (`ID_Consulta`, `Descripcion Pregunta`, `ID_Usuario`, `Fecha Inicio`, `Fecha Final`) VALUES
(1, 'Ser o no ser?', 2, '2017-11-08', '2017-11-17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Invitacion`
--

CREATE TABLE `Invitacion` (
  `ID_Invitacion` int(5) NOT NULL,
  `ID_Usuario` int(5) NOT NULL,
  `ID_Consulta` int(5) NOT NULL,
  `Email Invitado` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Opcion`
--

CREATE TABLE `Opcion` (
  `ID_Opcion` int(5) NOT NULL,
  `ID_Consulta` int(5) NOT NULL,
  `Descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Respuestas`
--

CREATE TABLE `Respuestas` (
  `ID_Respuestas` int(5) NOT NULL,
  `ID_Opcion` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuario`
--

CREATE TABLE `Usuario` (
  `ID_Usuario` int(5) NOT NULL,
  `Nombre` varchar(15) DEFAULT NULL,
  `Apellido` varchar(25) DEFAULT NULL,
  `Usuario` varchar(25) NOT NULL,
  `Contrasena` varchar(25) NOT NULL,
  `Email` varchar(35) NOT NULL,
  `Administrador` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Usuario`
--

INSERT INTO `Usuario` (`ID_Usuario`, `Nombre`, `Apellido`, `Usuario`, `Contrasena`, `Email`, `Administrador`) VALUES
(1, 'José', 'González Castillo', 'JotaGonzalez', '123456', 'jgonzalezc.crn@artsgrafiques.org', 42),
(2, 'Sergi', 'Coma Corcuera', 'Scoma', '123456', 'scomacorcuera@iesesteveterradas.cat', 42),
(3, 'Alvaro', 'Delgado Rioja', 'Adelgado', '654321', 'adelagadorioja@gmail.com', 0);

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
-- Indices de la tabla `Respuestas`
--
ALTER TABLE `Respuestas`
  ADD PRIMARY KEY (`ID_Respuestas`),
  ADD KEY `ID_Opcion` (`ID_Opcion`);

--
-- Indices de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  ADD PRIMARY KEY (`ID_Usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Consulta`
--
ALTER TABLE `Consulta`
  MODIFY `ID_Consulta` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `Invitacion`
--
ALTER TABLE `Invitacion`
  MODIFY `ID_Invitacion` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Opcion`
--
ALTER TABLE `Opcion`
  MODIFY `ID_Opcion` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Respuestas`
--
ALTER TABLE `Respuestas`
  MODIFY `ID_Respuestas` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  MODIFY `ID_Usuario` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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

--
-- Filtros para la tabla `Opcion`
--
ALTER TABLE `Opcion`
  ADD CONSTRAINT `FK_ID_Consulta_Opcion` FOREIGN KEY (`ID_Consulta`) REFERENCES `Consulta` (`ID_Consulta`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `Respuestas`
--
ALTER TABLE `Respuestas`
  ADD CONSTRAINT `FK_ID_Opcion_Respuestas` FOREIGN KEY (`ID_Opcion`) REFERENCES `Opcion` (`ID_Opcion`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
