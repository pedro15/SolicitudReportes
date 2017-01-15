SET foreign_key_checks = 0;
#
# TABLE STRUCTURE FOR: equipo
#

DROP TABLE IF EXISTS `equipo`;

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
  `id_laboratorio` varchar(20) NOT NULL,
  PRIMARY KEY (`id_equipo`),
  KEY `lab_num` (`id_laboratorio`),
  CONSTRAINT `equipo_ibfk_1` FOREIGN KEY (`id_laboratorio`) REFERENCES `laboratorio` (`id_laboratorio`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `equipo` (`id_equipo`, `descripcion`, `procesador`, `tarjeta_grafica`, `memoria_ram`, `disco_duro`, `tarjeta_madre`, `fuente_poder`, `monitor`, `teclado`, `lector_dvd`, `sistema_operativo`, `id_laboratorio`) VALUES ('Hoq6eysnMOlXFm3g9upc_01', '01', 'Amd fx 6300', 'gtx 650 ti', '8Gb ram', '500gb ', 'Msi amd 970', '500w', 'LG 19\"', 'VIT', 'LG', 'Canaima', 'Hoq6eysnMOlXFm3g9u');


#
# TABLE STRUCTURE FOR: falla
#

DROP TABLE IF EXISTS `falla`;

CREATE TABLE `falla` (
  `id_falla` varchar(20) NOT NULL,
  `id_equipo` varchar(45) NOT NULL,
  `descripcion` text,
  `tipo` int(2) DEFAULT NULL,
  PRIMARY KEY (`id_falla`),
  KEY `id_equipo` (`id_equipo`) USING BTREE,
  CONSTRAINT `falla_ibfk_1` FOREIGN KEY (`id_equipo`) REFERENCES `equipo` (`id_equipo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: laboratorio
#

DROP TABLE IF EXISTS `laboratorio`;

CREATE TABLE `laboratorio` (
  `id_laboratorio` varchar(20) NOT NULL,
  `id_sede` varchar(20) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_laboratorio`),
  KEY `id_sede` (`id_sede`) USING BTREE,
  CONSTRAINT `laboratorio_ibfk_1` FOREIGN KEY (`id_sede`) REFERENCES `sede` (`id_sede`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `laboratorio` (`id_laboratorio`, `id_sede`, `descripcion`) VALUES ('Hoq6eysnMOlXFm3g9u', 'FJgVABw2Gd5SQOHYXT0', 'Laboratorio 1');


#
# TABLE STRUCTURE FOR: reporte
#

DROP TABLE IF EXISTS `reporte`;

CREATE TABLE `reporte` (
  `id_reporte` int(11) NOT NULL AUTO_INCREMENT,
  `id_falla` varchar(20) NOT NULL,
  `cedula_usuario` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `estado` int(2) DEFAULT NULL,
  PRIMARY KEY (`id_reporte`),
  KEY `cedula_usuario` (`cedula_usuario`) USING BTREE,
  KEY `id_falla` (`id_falla`) USING BTREE,
  CONSTRAINT `reporte_ibfk_5` FOREIGN KEY (`id_falla`) REFERENCES `falla` (`id_falla`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `reporte_ibfk_6` FOREIGN KEY (`cedula_usuario`) REFERENCES `usuario` (`cedula_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: sede
#

DROP TABLE IF EXISTS `sede`;

CREATE TABLE `sede` (
  `id_sede` varchar(20) CHARACTER SET utf8 NOT NULL,
  `ubicacion` varchar(45) CHARACTER SET utf8 NOT NULL,
  `nombre` varchar(45) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id_sede`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `sede` (`id_sede`, `ubicacion`, `nombre`) VALUES ('FJgVABw2Gd5SQOHYXT0', 'Merida', 'Fundacite Merida');
INSERT INTO `sede` (`id_sede`, `ubicacion`, `nombre`) VALUES ('PsMKgi3RZHQkUuwJB24', 'El vigia', 'Fundacite el vigia');


#
# TABLE STRUCTURE FOR: usuario
#

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `cedula_usuario` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `clave` varchar(255) DEFAULT NULL,
  `pregunta_activada` int(1) NOT NULL,
  `pregunta_seguridad` int(3) NOT NULL,
  `respuesta_seguridad` text NOT NULL,
  `tipo` int(11) DEFAULT NULL,
  `habilitado` int(1) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cedula_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `usuario` (`cedula_usuario`, `nombre`, `clave`, `pregunta_activada`, `pregunta_seguridad`, `respuesta_seguridad`, `tipo`, `habilitado`, `correo`) VALUES ('23724512', 'Pedro Duran', '$2y$10$nS1WpgrwVthaK8FVJODPkuUWxoZB5aJykVdUJvufZmttls3t05XBi', '1', '3', 'aff24d778e68c5c7a2b40ee1ce63dd09dae154cfe370c6577ab267feb8fa832c106a1fcf21e5173b54f620bf1e934be0716b3270f5b39f4817cd63f5aba8c5cedo33+6mjYUEOBVS+2Z37giX1QWTHTqenhl9Mhu+rP4c=', '3', '1', 'Correo@dominio.com');


SET foreign_key_checks = 1;
