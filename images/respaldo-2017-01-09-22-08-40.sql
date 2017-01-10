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

INSERT INTO `equipo` (`id_equipo`, `descripcion`, `procesador`, `tarjeta_grafica`, `memoria_ram`, `disco_duro`, `tarjeta_madre`, `fuente_poder`, `monitor`, `teclado`, `lector_dvd`, `sistema_operativo`, `id_laboratorio`) VALUES ('uYmnj8eEzZHfkNgs25pc_001', '001', 'Intel core i3', 'Nvidia', '8gb corsair', '500gb western digital', 'Intel ATX', '450w evga', '21', 'VIT', 'Lite-on Hias 124-B', 'Linux Canaima', 'uYmnj8eEzZHfkNgs25');
INSERT INTO `equipo` (`id_equipo`, `descripcion`, `procesador`, `tarjeta_grafica`, `memoria_ram`, `disco_duro`, `tarjeta_madre`, `fuente_poder`, `monitor`, `teclado`, `lector_dvd`, `sistema_operativo`, `id_laboratorio`) VALUES ('uYmnj8eEzZHfkNgs25pc_002', '002', 'Intel Core i3-6100 3.7GHz Dual-Core', 'PowerColor Radeon RX 480 4GB Red Dragon', 'G.Skill NT Series 8GB (1 x 8GB) DDR4-2400 M', 'Western Digital Caviar Blue 1TB 3.5\" 7200RPM ', 'Asus H110M-A/M.2 Micro ATX LGA1151', 'EVGA 500W 80+ Bronze Certified ATX', 'LG 19\"', 'VIT', 'lite-on ihas124-14', 'Linux Canaima', 'uYmnj8eEzZHfkNgs25');
INSERT INTO `equipo` (`id_equipo`, `descripcion`, `procesador`, `tarjeta_grafica`, `memoria_ram`, `disco_duro`, `tarjeta_madre`, `fuente_poder`, `monitor`, `teclado`, `lector_dvd`, `sistema_operativo`, `id_laboratorio`) VALUES ('uYmnj8eEzZHfkNgs25pc_003', '003', 'Intel Core i3-6100 3.7GHz Dual-Core', 'PowerColor Radeon RX 480 4GB Red Dragon', 'G.Skill NT Series 4GB (1 x 4GB) DDR4-2400 M', '500gb western digital', 'Asus H110M-A/M.2 Micro ATX LGA1151', 'EVGA 500W 80+ Bronze Certified ATX', 'LG 19\"', 'microsoft', 'Lite-on Hias 124-Y', 'Linux Canaima', 'uYmnj8eEzZHfkNgs25');
INSERT INTO `equipo` (`id_equipo`, `descripcion`, `procesador`, `tarjeta_grafica`, `memoria_ram`, `disco_duro`, `tarjeta_madre`, `fuente_poder`, `monitor`, `teclado`, `lector_dvd`, `sistema_operativo`, `id_laboratorio`) VALUES ('v7wuId425gpkrcZ0Uxpc_001', '001', 'Intel dual core', 'Nvidia geforce 6200 agp 512mb ', '2gb', '75gb', 'intel', '450w', 'LG 21\"', 'microsoft', 'LG', 'Fedora Os', 'v7wuId425gpkrcZ0Ux');


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

INSERT INTO `falla` (`id_falla`, `id_equipo`, `descripcion`, `tipo`) VALUES ('BK9xMdolU0vNnHbOL', 'uYmnj8eEzZHfkNgs25pc_001', 'No sirve el mouse.', '0');
INSERT INTO `falla` (`id_falla`, `id_equipo`, `descripcion`, `tipo`) VALUES ('Fzp8hPmDS42xegXuR', 'v7wuId425gpkrcZ0Uxpc_001', 'Ezxploto el mouse', '0');
INSERT INTO `falla` (`id_falla`, `id_equipo`, `descripcion`, `tipo`) VALUES ('gnWB8ubRlsO6Pc7Z2', 'uYmnj8eEzZHfkNgs25pc_001', 'hesuiegseysufesufseduesdeds', '1');


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

INSERT INTO `laboratorio` (`id_laboratorio`, `id_sede`, `descripcion`) VALUES ('c82Lr9PEoOYUnCzGx1', '4NIf0TAlSJXo321YFUM', 'Laboratorio 02');
INSERT INTO `laboratorio` (`id_laboratorio`, `id_sede`, `descripcion`) VALUES ('uYmnj8eEzZHfkNgs25', '4NIf0TAlSJXo321YFUM', 'Laboratorio 1');
INSERT INTO `laboratorio` (`id_laboratorio`, `id_sede`, `descripcion`) VALUES ('v7wuId425gpkrcZ0Ux', 'Z36uikLrKDTAGzEdn79', 'Lab 1');
INSERT INTO `laboratorio` (`id_laboratorio`, `id_sede`, `descripcion`) VALUES ('yO5pdeb4DPE7W2ZwS8', 'Z36uikLrKDTAGzEdn79', 'Laboratorio 03');


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
  CONSTRAINT `reporte_ibfk_5` FOREIGN KEY (`id_falla`) REFERENCES `falla` (`id_falla`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8;

INSERT INTO `reporte` (`id_reporte`, `id_falla`, `cedula_usuario`, `fecha`, `estado`) VALUES ('69', 'BK9xMdolU0vNnHbOL', '23724512', '2017-01-08', '0');
INSERT INTO `reporte` (`id_reporte`, `id_falla`, `cedula_usuario`, `fecha`, `estado`) VALUES ('70', 'BK9xMdolU0vNnHbOL', '23724512', '2017-01-08', '1');
INSERT INTO `reporte` (`id_reporte`, `id_falla`, `cedula_usuario`, `fecha`, `estado`) VALUES ('71', 'BK9xMdolU0vNnHbOL', '23724512', '2017-01-08', '0');
INSERT INTO `reporte` (`id_reporte`, `id_falla`, `cedula_usuario`, `fecha`, `estado`) VALUES ('72', 'BK9xMdolU0vNnHbOL', '23724512', '2017-01-08', '2');
INSERT INTO `reporte` (`id_reporte`, `id_falla`, `cedula_usuario`, `fecha`, `estado`) VALUES ('73', 'Fzp8hPmDS42xegXuR', '23724512', '2017-01-09', '0');
INSERT INTO `reporte` (`id_reporte`, `id_falla`, `cedula_usuario`, `fecha`, `estado`) VALUES ('75', 'Fzp8hPmDS42xegXuR', '23724512', '2017-01-09', '0');
INSERT INTO `reporte` (`id_reporte`, `id_falla`, `cedula_usuario`, `fecha`, `estado`) VALUES ('76', 'Fzp8hPmDS42xegXuR', '23724512', '2017-01-09', '1');
INSERT INTO `reporte` (`id_reporte`, `id_falla`, `cedula_usuario`, `fecha`, `estado`) VALUES ('79', 'gnWB8ubRlsO6Pc7Z2', '23724512', '2017-01-09', '0');


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

INSERT INTO `sede` (`id_sede`, `ubicacion`, `nombre`) VALUES ('4NIf0TAlSJXo321YFUM', 'Merida', 'Fundacite Merida');
INSERT INTO `sede` (`id_sede`, `ubicacion`, `nombre`) VALUES ('Z36uikLrKDTAGzEdn79', 'El vigia', 'Fundacite el vigia');


#
# TABLE STRUCTURE FOR: usuario
#

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `cedula_usuario` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `clave` varchar(255) DEFAULT NULL,
  `pregunta_seguridad` varchar(255) DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL,
  `habilitado` int(1) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cedula_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `usuario` (`cedula_usuario`, `nombre`, `clave`, `pregunta_seguridad`, `tipo`, `habilitado`, `correo`) VALUES ('23724512', 'Pedro Duran', '$2y$10$ff0hoC09WvbDGFLv3I2ede8KIjQyFOxBBwmrzV/WhGb676swqHxla', '', '3', '1', 'correo@dominio');


