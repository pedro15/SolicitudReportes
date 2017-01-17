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
  `mouse` varchar(45) NOT NULL,
  `lector_dvd` varchar(45) NOT NULL,
  `sistema_operativo` varchar(45) NOT NULL,
  `id_laboratorio` varchar(20) NOT NULL,
  PRIMARY KEY (`id_equipo`),
  KEY `lab_num` (`id_laboratorio`),
  CONSTRAINT `equipo_ibfk_1` FOREIGN KEY (`id_laboratorio`) REFERENCES `laboratorio` (`id_laboratorio`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `equipo` (`id_equipo`, `descripcion`, `procesador`, `tarjeta_grafica`, `memoria_ram`, `disco_duro`, `tarjeta_madre`, `fuente_poder`, `monitor`, `teclado`, `mouse`, `lector_dvd`, `sistema_operativo`, `id_laboratorio`) VALUES ('w5RhYfHrXQ7bcCO1axpc_1', '1', 'Amd', '', '8gb', '500gb', 'Amd 970', '500w', 'LG', 'VIT', 'Genius VTX', 'LG', 'canaima linux', 'w5RhYfHrXQ7bcCO1ax');


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

INSERT INTO `falla` (`id_falla`, `id_equipo`, `descripcion`, `tipo`) VALUES ('1OTMNRujfrXWH8ibo', 'w5RhYfHrXQ7bcCO1axpc_1', 'El sistema operativo no arranca.', '3');
INSERT INTO `falla` (`id_falla`, `id_equipo`, `descripcion`, `tipo`) VALUES ('bkJe4moAjDGVcCOKx', 'w5RhYfHrXQ7bcCO1axpc_1', '\r\n                xdxdxd', '1');
INSERT INTO `falla` (`id_falla`, `id_equipo`, `descripcion`, `tipo`) VALUES ('MAZ8X4pt7Bq9P3Vxc', 'w5RhYfHrXQ7bcCO1axpc_1', 'dededededededee\r\n                ', '0');
INSERT INTO `falla` (`id_falla`, `id_equipo`, `descripcion`, `tipo`) VALUES ('OjIwDkrtX1BbhsK0d', 'w5RhYfHrXQ7bcCO1axpc_1', 'Se ROMPIO LA PANTALLA\r\n                ', '2');
INSERT INTO `falla` (`id_falla`, `id_equipo`, `descripcion`, `tipo`) VALUES ('srFl0LK8M9xGo2mEu', 'w5RhYfHrXQ7bcCO1axpc_1', 'De danio el teclado', '1');
INSERT INTO `falla` (`id_falla`, `id_equipo`, `descripcion`, `tipo`) VALUES ('uReZya2H5S83dP0vE', 'w5RhYfHrXQ7bcCO1axpc_1', 'No sirve la tecla A\r\n                ', '1');
INSERT INTO `falla` (`id_falla`, `id_equipo`, `descripcion`, `tipo`) VALUES ('vs3odlzBc6O0kXiLU', 'w5RhYfHrXQ7bcCO1axpc_1', 'Se rompio el monitor xdxdxdxdd\r\n                ', '2');
INSERT INTO `falla` (`id_falla`, `id_equipo`, `descripcion`, `tipo`) VALUES ('vzgkCx7hcudyZqt6K', 'w5RhYfHrXQ7bcCO1axpc_1', 'Al mouse no le sirve el botón derecho.\r\n                ', '0');


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

INSERT INTO `laboratorio` (`id_laboratorio`, `id_sede`, `descripcion`) VALUES ('w5RhYfHrXQ7bcCO1ax', 'j4gryPA9lqn7DC3ubkc', 'Laboratorio 1');


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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

INSERT INTO `reporte` (`id_reporte`, `id_falla`, `cedula_usuario`, `fecha`, `estado`) VALUES ('2', 'srFl0LK8M9xGo2mEu', '23724512', '2017-01-16', '0');
INSERT INTO `reporte` (`id_reporte`, `id_falla`, `cedula_usuario`, `fecha`, `estado`) VALUES ('3', 'srFl0LK8M9xGo2mEu', '23724512', '2017-01-16', '1');
INSERT INTO `reporte` (`id_reporte`, `id_falla`, `cedula_usuario`, `fecha`, `estado`) VALUES ('4', 'uReZya2H5S83dP0vE', '23724512', '2017-01-16', '0');
INSERT INTO `reporte` (`id_reporte`, `id_falla`, `cedula_usuario`, `fecha`, `estado`) VALUES ('5', 'vzgkCx7hcudyZqt6K', '23724512', '2017-01-16', '0');
INSERT INTO `reporte` (`id_reporte`, `id_falla`, `cedula_usuario`, `fecha`, `estado`) VALUES ('6', 'bkJe4moAjDGVcCOKx', '23724512', '2017-01-16', '0');
INSERT INTO `reporte` (`id_reporte`, `id_falla`, `cedula_usuario`, `fecha`, `estado`) VALUES ('7', 'MAZ8X4pt7Bq9P3Vxc', '23724512', '2017-01-16', '0');
INSERT INTO `reporte` (`id_reporte`, `id_falla`, `cedula_usuario`, `fecha`, `estado`) VALUES ('8', 'OjIwDkrtX1BbhsK0d', '23724512', '2017-01-16', '0');
INSERT INTO `reporte` (`id_reporte`, `id_falla`, `cedula_usuario`, `fecha`, `estado`) VALUES ('9', '1OTMNRujfrXWH8ibo', '23724512', '2017-01-16', '0');
INSERT INTO `reporte` (`id_reporte`, `id_falla`, `cedula_usuario`, `fecha`, `estado`) VALUES ('10', 'uReZya2H5S83dP0vE', '23724512', '2017-01-16', '2');
INSERT INTO `reporte` (`id_reporte`, `id_falla`, `cedula_usuario`, `fecha`, `estado`) VALUES ('11', 'vs3odlzBc6O0kXiLU', '147369', '2017-01-16', '0');
INSERT INTO `reporte` (`id_reporte`, `id_falla`, `cedula_usuario`, `fecha`, `estado`) VALUES ('12', 'vs3odlzBc6O0kXiLU', '23724512', '2017-01-16', '0');
INSERT INTO `reporte` (`id_reporte`, `id_falla`, `cedula_usuario`, `fecha`, `estado`) VALUES ('13', 'vs3odlzBc6O0kXiLU', '23724512', '2017-01-16', '1');


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

INSERT INTO `sede` (`id_sede`, `ubicacion`, `nombre`) VALUES ('j4gryPA9lqn7DC3ubkc', 'Merida', 'Fundacite merida');


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

INSERT INTO `usuario` (`cedula_usuario`, `nombre`, `clave`, `pregunta_activada`, `pregunta_seguridad`, `respuesta_seguridad`, `tipo`, `habilitado`, `correo`) VALUES ('147369', 'Jose ', '$2y$10$QQs.GKAlAVvaE23NcnFFguWN/CQ0S950fCJR6ylqMBR7kxD6X/lAi', '0', '0', '', '1', '1', 'correo@dominio');
INSERT INTO `usuario` (`cedula_usuario`, `nombre`, `clave`, `pregunta_activada`, `pregunta_seguridad`, `respuesta_seguridad`, `tipo`, `habilitado`, `correo`) VALUES ('789456', 'andres', '$2y$10$LBTpJ5B33e0ygBk4ikeWFu/CDTGwgdYre2KYpSGi35LOlf.wgUE0K', '0', '0', '', '2', '1', 'correo@dominio');
INSERT INTO `usuario` (`cedula_usuario`, `nombre`, `clave`, `pregunta_activada`, `pregunta_seguridad`, `respuesta_seguridad`, `tipo`, `habilitado`, `correo`) VALUES ('23724512', 'Pedro Duran', '$2y$10$xBVDY/WxZXZfwlo5dppHCOlUhumqa4jgFQlUxiIU3ZBsAR8lgjmdm', '0', '0', '', '3', '1', 'Correo@dominio.com');


SET foreign_key_checks = 1;
