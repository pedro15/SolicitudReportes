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

INSERT INTO `equipo` (`id_equipo`, `descripcion`, `procesador`, `tarjeta_grafica`, `memoria_ram`, `disco_duro`, `tarjeta_madre`, `fuente_poder`, `monitor`, `teclado`, `mouse`, `lector_dvd`, `sistema_operativo`, `id_laboratorio`) VALUES ('fE4wmuGSA71xeRNIDvpc_1', '1', 'Amd ', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'fE4wmuGSA71xeRNIDv');
INSERT INTO `equipo` (`id_equipo`, `descripcion`, `procesador`, `tarjeta_grafica`, `memoria_ram`, `disco_duro`, `tarjeta_madre`, `fuente_poder`, `monitor`, `teclado`, `mouse`, `lector_dvd`, `sistema_operativo`, `id_laboratorio`) VALUES ('T8okYXPjnBtcCGZ427pc_1', '1', 'Amd', 'Gtx 750', '8gb', '500gb', 'Amd 970', 'Evga 500w', 'Lg 21\"', 'VIT', 'Vit', 'Lg ', 'canaima linux', 'T8okYXPjnBtcCGZ427');


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

INSERT INTO `falla` (`id_falla`, `id_equipo`, `descripcion`, `tipo`) VALUES ('72SML65yFtuXRCshI', 'T8okYXPjnBtcCGZ427pc_1', 'ehsigeysfyufsukfesfs', '8');
INSERT INTO `falla` (`id_falla`, `id_equipo`, `descripcion`, `tipo`) VALUES ('I43F0YSoLyzu5aGt7', 'T8okYXPjnBtcCGZ427pc_1', 'No prende la maquina.\r\n                ', '0');
INSERT INTO `falla` (`id_falla`, `id_equipo`, `descripcion`, `tipo`) VALUES ('qmM1lB4GyQpzZKjIu', 'T8okYXPjnBtcCGZ427pc_1', 'El mouse no funciona.', '6');
INSERT INTO `falla` (`id_falla`, `id_equipo`, `descripcion`, `tipo`) VALUES ('qxJuy4M7t8vZ3O0Sz', 'T8okYXPjnBtcCGZ427pc_1', 'pjeoishuioegsiuesyfe\r\n                ', '3');
INSERT INTO `falla` (`id_falla`, `id_equipo`, `descripcion`, `tipo`) VALUES ('xYfPE5rzldhI3T8uZ', 'T8okYXPjnBtcCGZ427pc_1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla dictum mi purus, vitae ultricies lorem accumsan eu. Aliquam neque felis, scelerisque at mattis posuere, tincidunt id arcu. Nulla efficitur mauris in elementum convallis. Quisque nisl ante, scelerisque sodales ipsum sed, venenatis volutpat mi. Praesent vulputate nulla mauris. Etiam et ipsum viverra, accumsan orci at, egestas nisi. Suspendisse maximus consequat convallis. Cras venenatis magna quis orci semper, nec consequat enim dignissim. Aliquam erat volutpat. Praesent a ex quis felis malesuada molestie vel sed l\r\n                ', '3');


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

INSERT INTO `laboratorio` (`id_laboratorio`, `id_sede`, `descripcion`) VALUES ('fE4wmuGSA71xeRNIDv', 'ZyTpqYdgWXD79bfacIh', 'Laboratorio 2');
INSERT INTO `laboratorio` (`id_laboratorio`, `id_sede`, `descripcion`) VALUES ('T8okYXPjnBtcCGZ427', 'ZyTpqYdgWXD79bfacIh', 'laboratorio 1');


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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

INSERT INTO `reporte` (`id_reporte`, `id_falla`, `cedula_usuario`, `fecha`, `estado`) VALUES ('3', 'I43F0YSoLyzu5aGt7', '23724512', '2017-01-17', '0');
INSERT INTO `reporte` (`id_reporte`, `id_falla`, `cedula_usuario`, `fecha`, `estado`) VALUES ('4', 'qmM1lB4GyQpzZKjIu', '23724512', '2017-01-17', '0');
INSERT INTO `reporte` (`id_reporte`, `id_falla`, `cedula_usuario`, `fecha`, `estado`) VALUES ('6', 'xYfPE5rzldhI3T8uZ', '23724512', '2017-01-18', '0');
INSERT INTO `reporte` (`id_reporte`, `id_falla`, `cedula_usuario`, `fecha`, `estado`) VALUES ('7', 'I43F0YSoLyzu5aGt7', '23724512', '2017-01-18', '1');
INSERT INTO `reporte` (`id_reporte`, `id_falla`, `cedula_usuario`, `fecha`, `estado`) VALUES ('8', 'qmM1lB4GyQpzZKjIu', '23724512', '2017-01-18', '2');
INSERT INTO `reporte` (`id_reporte`, `id_falla`, `cedula_usuario`, `fecha`, `estado`) VALUES ('9', 'qmM1lB4GyQpzZKjIu', '23724512', '2017-01-18', '2');
INSERT INTO `reporte` (`id_reporte`, `id_falla`, `cedula_usuario`, `fecha`, `estado`) VALUES ('10', 'xYfPE5rzldhI3T8uZ', '23724512', '2017-01-19', '1');
INSERT INTO `reporte` (`id_reporte`, `id_falla`, `cedula_usuario`, `fecha`, `estado`) VALUES ('11', '72SML65yFtuXRCshI', '23724512', '2017-01-19', '0');
INSERT INTO `reporte` (`id_reporte`, `id_falla`, `cedula_usuario`, `fecha`, `estado`) VALUES ('12', 'qxJuy4M7t8vZ3O0Sz', '23724512', '2017-01-19', '0');


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

INSERT INTO `sede` (`id_sede`, `ubicacion`, `nombre`) VALUES ('ZyTpqYdgWXD79bfacIh', 'Merida', 'Fundacite merida');


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

INSERT INTO `usuario` (`cedula_usuario`, `nombre`, `clave`, `pregunta_activada`, `pregunta_seguridad`, `respuesta_seguridad`, `tipo`, `habilitado`, `correo`) VALUES ('23724512', 'Pedro Duran', '$2y$10$xBVDY/WxZXZfwlo5dppHCOlUhumqa4jgFQlUxiIU3ZBsAR8lgjmdm', '1', '0', 'aa2823ed19a53d9abf1cd5ab8a8a3cdd4807fec47fd8314fb6466acc5f05e7b4399853fbb9ce53ab5737fc7786e7b6702c3ca5eb31dc860d4e4aa76d1daa35b9yd1cqncomFqZ0XUgyW9lwKve5uG8K5BbxYwtoxBooT8=', '3', '1', 'Correo@dominio.com');


SET foreign_key_checks = 1;
