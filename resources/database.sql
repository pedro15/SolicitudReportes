-- Este archvio es el que toma el sistema a la hora de instalar la base de datos
-- -----------------------------------------------------------------------------

-- Versión del servidor: 5.7.16-0ubuntu0.16.04.1
-- Versión de PHP: 5.6.29-1+deb.sury.org~xenial+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

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
  `mouse` varchar(45) NOT NULL,
  `lector_dvd` varchar(45) NOT NULL,
  `sistema_operativo` varchar(45) NOT NULL,
  `id_laboratorio` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Estructura de tabla para la tabla `falla`
--

CREATE TABLE IF NOT EXISTS `falla` (
  `id_falla` varchar(20) NOT NULL,
  `id_equipo` varchar(45) NOT NULL,
  `descripcion` text,
  `tipo` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Estructura de tabla para la tabla `laboratorio`
--

CREATE TABLE IF NOT EXISTS `laboratorio` (
  `id_laboratorio` varchar(20) NOT NULL,
  `id_sede` varchar(20) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Estructura de tabla para la tabla `reporte`
--

CREATE TABLE IF NOT EXISTS `reporte` (
  `id_reporte` int(11) NOT NULL,
  `id_falla` varchar(20) NOT NULL,
  `cedula_usuario` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `estado` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Estructura de tabla para la tabla `sede`
--

CREATE TABLE IF NOT EXISTS `sede` (
  `id_sede` varchar(20) CHARACTER SET utf8 NOT NULL,
  `ubicacion` varchar(45) CHARACTER SET utf8 NOT NULL,
  `nombre` varchar(45) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
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
  MODIFY `id_reporte` int(11) NOT NULL AUTO_INCREMENT;
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
  ADD CONSTRAINT `reporte_ibfk_5` FOREIGN KEY (`id_falla`) REFERENCES `falla` (`id_falla`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reporte_ibfk_6` FOREIGN KEY (`cedula_usuario`) REFERENCES `usuario` (`cedula_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;