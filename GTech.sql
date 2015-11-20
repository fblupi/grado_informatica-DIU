-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema diu
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema diu
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `diu` DEFAULT CHARACTER SET utf8 ;
USE `diu` ;

-- -----------------------------------------------------
-- Table `diu`.`Sala`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `diu`.`Sala` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(45) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `planta` INT NOT NULL,
  `numero` INT NOT NULL,
  `capacidad` INT NOT NULL,
  `imagen` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `diu`.`Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `diu`.`Usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(45) NOT NULL,
  `pass` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `telefono` VARCHAR(45) NULL,
  `sexo` VARCHAR(45) NULL,
  `pais` VARCHAR(45) NULL,
  `localidad` VARCHAR(45) NULL,
  `direccion` VARCHAR(45) NULL,
  `codigoPostal` VARCHAR(45) NULL,
  `imagen` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `login_UNIQUE` (`login` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `diu`.`Empresa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `diu`.`Empresa` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `direccion` VARCHAR(45) NOT NULL,
  `telefono` VARCHAR(45) NOT NULL,
  `fax` VARCHAR(45) NULL,
  `descripcion` TEXT NOT NULL,
  `imagen` VARCHAR(45) NOT NULL,
  `representante` INT NOT NULL,
  `sala` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Empresa_Usuario1_idx` (`representante` ASC),
  INDEX `fk_Empresa_Sala1_idx` (`sala` ASC),
  CONSTRAINT `fk_Empresa_Usuario1`
    FOREIGN KEY (`representante`)
    REFERENCES `diu`.`Usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Empresa_Sala1`
    FOREIGN KEY (`sala`)
    REFERENCES `diu`.`Sala` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `diu`.`Evento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `diu`.`Evento` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `fecha` DATETIME NOT NULL,
  `precio` FLOAT NOT NULL,
  `plazas` INT NOT NULL,
  `descripcion` TEXT NOT NULL,
  `requisitos` TEXT NOT NULL,
  `imagen` VARCHAR(45) NOT NULL,
  `sala` INT NULL,
  `empresa` INT NULL,
  `usuario` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Evento_Sala1_idx` (`sala` ASC),
  INDEX `fk_Evento_Empresa1_idx` (`empresa` ASC),
  INDEX `fk_Evento_Usuario1_idx` (`usuario` ASC),
  CONSTRAINT `fk_Evento_Sala1`
    FOREIGN KEY (`sala`)
    REFERENCES `diu`.`Sala` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Evento_Empresa1`
    FOREIGN KEY (`empresa`)
    REFERENCES `diu`.`Empresa` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Evento_Usuario1`
    FOREIGN KEY (`usuario`)
    REFERENCES `diu`.`Usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `diu`.`Permisos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `diu`.`Permisos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `descripcion` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `diu`.`Usuario_Permisos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `diu`.`Usuario_Permisos` (
  `usuario` INT NOT NULL,
  `permiso` INT NOT NULL,
  PRIMARY KEY (`usuario`, `permiso`),
  INDEX `fk_Usuario_has_Permisos_Permisos1_idx` (`permiso` ASC),
  INDEX `fk_Usuario_has_Permisos_Usuario_idx` (`usuario` ASC),
  CONSTRAINT `fk_Usuario_has_Permisos_Usuario`
    FOREIGN KEY (`usuario`)
    REFERENCES `diu`.`Usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuario_has_Permisos_Permisos1`
    FOREIGN KEY (`permiso`)
    REFERENCES `diu`.`Permisos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `diu`.`Asistencia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `diu`.`Asistencia` (
  `evento` INT NOT NULL,
  `usuario` INT NOT NULL,
  PRIMARY KEY (`evento`, `usuario`),
  INDEX `fk_Evento_has_Usuario_Usuario1_idx` (`usuario` ASC),
  INDEX `fk_Evento_has_Usuario_Evento1_idx` (`evento` ASC),
  CONSTRAINT `fk_Evento_has_Usuario_Evento1`
    FOREIGN KEY (`evento`)
    REFERENCES `diu`.`Evento` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Evento_has_Usuario_Usuario1`
    FOREIGN KEY (`usuario`)
    REFERENCES `diu`.`Usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
