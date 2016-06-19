SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `solicitud_reporte` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `solicitud_reporte` ;

-- -----------------------------------------------------
-- Table `usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `solicitud_reporte`.`usuario` ;

CREATE  TABLE IF NOT EXISTS `solicitud_reporte`.`usuario` (
  `cedula` INT NOT NULL ,
  `nombre` TEXT NULL ,
  `clave` TEXT NULL ,
  `pregunta_seguridad` TEXT NULL ,
  `tipo` INT NULL ,
  `correo` TEXT NULL ,
  PRIMARY KEY (`cedula`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `equipo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `solicitud_reporte`.`equipo` ;

CREATE  TABLE IF NOT EXISTS `solicitud_reporte`.`equipo` (
  `num_equipo` INT NOT NULL AUTO_INCREMENT ,
  `cpu` VARCHAR(45) NULL ,
  `gpu` VARCHAR(45) NULL ,
  `ram` VARCHAR(45) NULL ,
  `hdd` VARCHAR(45) NULL ,
  `tarjeta_madre` VARCHAR(45) NULL ,
  `fuente_poder` VARCHAR(45) NULL ,
  PRIMARY KEY (`num_equipo`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laboratorio`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `solicitud_reporte`.`laboratorio` ;

CREATE  TABLE IF NOT EXISTS `solicitud_reporte`.`laboratorio` (
  `numero` INT NOT NULL ,
  `descripcion` TEXT NULL ,
  `num_equipo` INT NOT NULL ,
  PRIMARY KEY (`numero`, `num_equipo`) ,
  INDEX `fk_laboratorio_equipo1` (`num_equipo` ASC) ,
  CONSTRAINT `fk_laboratorio_equipo1`
    FOREIGN KEY (`num_equipo` )
    REFERENCES `solicitud_reporte`.`equipo` (`num_equipo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `falla`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `solicitud_reporte`.`falla` ;

CREATE  TABLE IF NOT EXISTS `solicitud_reporte`.`falla` (
  `id` INT NOT NULL ,
  `descripcion` TEXT NULL ,
  `tipo_falla` VARCHAR(45) NULL ,
  `lab_num` INT NOT NULL ,
  PRIMARY KEY (`id`, `lab_num`) ,
  INDEX `fk_falla_laboratorio1` (`lab_num` ASC) ,
  CONSTRAINT `fk_falla_laboratorio1`
    FOREIGN KEY (`lab_num` )
    REFERENCES `solicitud_reporte`.`laboratorio` (`numero` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `reporte`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `solicitud_reporte`.`reporte` ;

CREATE  TABLE IF NOT EXISTS `solicitud_reporte`.`reporte` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `fecha` DATE NULL ,
  `estado` VARCHAR(45) NULL ,
  `cedula_usr` INT NULL ,
  `cedula_usuario` INT NOT NULL ,
  `falla_id` INT NOT NULL ,
  PRIMARY KEY (`id`, `cedula_usuario`, `falla_id`) ,
  UNIQUE INDEX `cedula_usr_UNIQUE` (`cedula_usr` ASC) ,
  INDEX `fk_Reporte_Usuario` (`cedula_usuario` ASC) ,
  INDEX `fk_reporte_falla1` (`falla_id` ASC) ,
  CONSTRAINT `fk_Reporte_Usuario`
    FOREIGN KEY (`cedula_usuario` )
    REFERENCES `solicitud_reporte`.`usuario` (`cedula` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_reporte_falla1`
    FOREIGN KEY (`falla_id` )
    REFERENCES `solicitud_reporte`.`falla` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;