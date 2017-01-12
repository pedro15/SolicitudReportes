-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
-- Servidor: localhost
-- Versión del servidor: 5.7.16-0ubuntu0.16.04.1
-- Versión de PHP: 5.6.29-1+deb.sury.org~xenial+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `solicitud_reportes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE `equipo` (
  `id_equipo` varchar(45) NOT NULL,
  `descripcion` varchar(10) NOT NULL,
  `procesador` varchar(45) DEFAULT NULL,
  `tarjeta_grafica` varchar(45) DEFAULT NULL,
  `memoria_ram` varchar(45) DEFAULT NULL,
  `disco_duro` varchar(45) DEFAULT NULL,
  `tarjeta_madre` varchar(45) DEFAULT NULL,
  `fuente_poder` varchar(45) DEFAULT NULL,
  `monitor` varchar(45) NOT NULL,
  `teclado` varchar(45) NOT NULL,
  `lector_dvd` varchar(45) NOT NULL,
  `sistema_operativo` varchar(45) NOT NULL,
  `id_laboratorio` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `equipo`
--

INSERT INTO `equipo` (`id_equipo`, `descripcion`, `procesador`, `tarjeta_grafica`, `memoria_ram`, `disco_duro`, `tarjeta_madre`, `fuente_poder`, `monitor`, `teclado`, `lector_dvd`, `sistema_operativo`, `id_laboratorio`) VALUES
('uYmnj8eEzZHfkNgs25pc_001', '001', 'Intel core i3', 'Nvidia', '8gb corsair', '500gb western digital', 'Intel ATX', '450w evga', '21', 'VIT', 'Lite-on Hias 124-B', 'Linux Canaima', 'uYmnj8eEzZHfkNgs25'),
('uYmnj8eEzZHfkNgs25pc_002', '002', 'Intel Core i3-6100 3.7GHz Dual-Core', 'PowerColor Radeon RX 480 4GB Red Dragon', 'G.Skill NT Series 8GB (1 x 8GB) DDR4-2400 M', 'Western Digital Caviar Blue 1TB 3.5" 7200RPM ', 'Asus H110M-A/M.2 Micro ATX LGA1151', 'EVGA 500W 80+ Bronze Certified ATX', 'LG 19"', 'VIT', 'lite-on ihas124-14', 'Linux Canaima', 'uYmnj8eEzZHfkNgs25'),
('uYmnj8eEzZHfkNgs25pc_003', '003', 'Intel Core i3-6100 3.7GHz Dual-Core', 'PowerColor Radeon RX 480 4GB Red Dragon', 'G.Skill NT Series 4GB (1 x 4GB) DDR4-2400 M', '500gb western digital', 'Asus H110M-A/M.2 Micro ATX LGA1151', 'EVGA 500W 80+ Bronze Certified ATX', 'LG 19"', 'microsoft', 'Lite-on Hias 124-Y', 'Linux Canaima', 'uYmnj8eEzZHfkNgs25'),
('v7wuId425gpkrcZ0Uxpc_001', '001', 'Intel dual core', 'Nvidia geforce 6200 agp 512mb ', '2gb', '75gb', 'intel', '450w', 'LG 21"', 'microsoft', 'LG', 'Fedora Os', 'v7wuId425gpkrcZ0Ux');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `falla`
--

CREATE TABLE `falla` (
  `id_falla` varchar(20) NOT NULL,
  `id_equipo` varchar(45) NOT NULL,
  `descripcion` text,
  `tipo` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `laboratorio`
--

CREATE TABLE `laboratorio` (
  `id_laboratorio` varchar(20) NOT NULL,
  `id_sede` varchar(20) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `laboratorio`
--

INSERT INTO `laboratorio` (`id_laboratorio`, `id_sede`, `descripcion`) VALUES
('c82Lr9PEoOYUnCzGx1', '4NIf0TAlSJXo321YFUM', 'Laboratorio 02'),
('uYmnj8eEzZHfkNgs25', '4NIf0TAlSJXo321YFUM', 'Laboratorio 1'),
('v7wuId425gpkrcZ0Ux', 'Z36uikLrKDTAGzEdn79', 'Lab 1'),
('yO5pdeb4DPE7W2ZwS8', 'Z36uikLrKDTAGzEdn79', 'Laboratorio 03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte`
--

CREATE TABLE `reporte` (
  `id_reporte` int(11) NOT NULL,
  `id_falla` varchar(20) NOT NULL,
  `cedula_usuario` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `estado` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sede`
--

CREATE TABLE `sede` (
  `id_sede` varchar(20) CHARACTER SET utf8 NOT NULL,
  `ubicacion` varchar(45) CHARACTER SET utf8 NOT NULL,
  `nombre` varchar(45) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sede`
--

INSERT INTO `sede` (`id_sede`, `ubicacion`, `nombre`) VALUES
('4NIf0TAlSJXo321YFUM', 'Merida', 'Fundacite Merida'),
('Z36uikLrKDTAGzEdn79', 'El vigia', 'Fundacite el vigia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `cedula_usuario` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `clave` varchar(255) DEFAULT NULL,
  `pregunta_activada` int(1) NOT NULL,
  `pregunta_seguridad` int(3) NOT NULL,
  `respuesta_seguridad` text NOT NULL,
  `tipo` int(11) DEFAULT NULL,
  `habilitado` int(1) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`cedula_usuario`, `nombre`, `clave`, `pregunta_activada`, `pregunta_seguridad`, `respuesta_seguridad`, `tipo`, `habilitado`, `correo`) VALUES
(147258, 'Jose Medina', '$2y$10$coUhfEXW8ij2Px39WvEqYec99AYY2iuvdkoJ4WFtWycInz0FLOPGa', 0, 0, '', 2, 1, 'correo@dominio.com'),
(19848049, 'Yasbell Rosales', '$2y$10$JBzEoA18ho2xqia1m99jjOmOGRATGCzf/gZFkFHkTmSo6T6jLSUIe', 0, 0, '', 3, 1, 'correo@dominio.com'),
(21306666, 'Tibisay Moreno', '$2y$10$wvCwlDW8.Jrms1zrzU/RfOP3BCpcdkPkPvwIbhJmrqjWwoqWpZ.Pe', 0, 0, '', 3, 1, 'correo@dominio.com'),
(22655221, 'Daymara albarran', '$2y$10$5wJHjeqmjndkKXnXimPkzeGfYPV8PuF3KEVbg21tfLD3RgZVVleYW', 0, 0, '', 3, 1, 'correo@dominio.com'),
(23724512, 'Pedro Duran', '$2y$10$UunyfuGt/tRtyxhd5idjIOqS1TIsix14ErWnSfo4.mtQ4Z6J9LnLK', 1, 2, '1c74b0cb86b0278d0f80900ab4868db6b5d9ef2238529b60343438fdb7327902d1caa4f817a63275706e0f79ab69bf799a5a054a3af6fd2b24917e5aa0dc846fQBF2e7pNqd1FmK0RIfPK1n2vqHNSLC8=', 3, 1, 'correo@dominio');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`id_equipo`),
  ADD KEY `lab_num` (`id_laboratorio`);

--
-- Indices de la tabla `falla`
--
ALTER TABLE `falla`
  ADD PRIMARY KEY (`id_falla`),
  ADD KEY `id_equipo` (`id_equipo`) USING BTREE;

--
-- Indices de la tabla `laboratorio`
--
ALTER TABLE `laboratorio`
  ADD PRIMARY KEY (`id_laboratorio`),
  ADD KEY `id_sede` (`id_sede`) USING BTREE;

--
-- Indices de la tabla `reporte`
--
ALTER TABLE `reporte`
  ADD PRIMARY KEY (`id_reporte`),
  ADD KEY `cedula_usuario` (`cedula_usuario`) USING BTREE,
  ADD KEY `id_falla` (`id_falla`) USING BTREE;

--
-- Indices de la tabla `sede`
--
ALTER TABLE `sede`
  ADD PRIMARY KEY (`id_sede`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`cedula_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `reporte`
--
ALTER TABLE `reporte`
  MODIFY `id_reporte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD CONSTRAINT `equipo_ibfk_1` FOREIGN KEY (`id_laboratorio`) REFERENCES `laboratorio` (`id_laboratorio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `falla`
--
ALTER TABLE `falla`
  ADD CONSTRAINT `falla_ibfk_1` FOREIGN KEY (`id_equipo`) REFERENCES `equipo` (`id_equipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `laboratorio`
--
ALTER TABLE `laboratorio`
  ADD CONSTRAINT `laboratorio_ibfk_1` FOREIGN KEY (`id_sede`) REFERENCES `sede` (`id_sede`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reporte`
--
ALTER TABLE `reporte`
  ADD CONSTRAINT `reporte_ibfk_5` FOREIGN KEY (`id_falla`) REFERENCES `falla` (`id_falla`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;