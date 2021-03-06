-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema cementerio
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema cementerio
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `cementerio` DEFAULT CHARACTER SET utf8 ;
USE `cementerio` ;

-- -----------------------------------------------------
-- Table `cementerio`.`Cementerios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cementerio`.`Cementerios` (
  `idCementerio` INT NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR(45) NOT NULL,
  `Direccion` VARCHAR(200) NOT NULL,
  `Area` DECIMAL(8,2) NOT NULL,
  `Legalizado` INT(1) NOT NULL DEFAULT 0,
  `Panteonero` VARCHAR(150) NULL,
  `Tipo` VARCHAR(45) NOT NULL,
  `Estado` INT(1) NULL DEFAULT 1,
  PRIMARY KEY (`idCementerio`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cementerio`.`TipoParcela`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cementerio`.`TipoParcela` (
  `idTipoParcela` INT NOT NULL AUTO_INCREMENT,
  `Descripcion` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idTipoParcela`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cementerio`.`Parcelas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cementerio`.`Parcelas` (
  `idParcela` INT NOT NULL AUTO_INCREMENT,
  `idTipoParcela` INT NOT NULL,
  `idCementerio` INT NOT NULL,
  `Poligono` VARCHAR(45) NULL,
  `CoordenadaX` VARCHAR(45) NULL,
  `CoordenadaY` VARCHAR(45) NULL,
  `Numero` VARCHAR(45) NOT NULL,
  `Estado` INT(1) NULL DEFAULT 1,
  `Titulado` INT(1) NULL DEFAULT 0,
  PRIMARY KEY (`idParcela`, `idTipoParcela`, `idCementerio`),
  INDEX `fk_Parcelas_Cementerios_idx` (`idCementerio` ASC),
  INDEX `fk_Parcelas_Tipo_Parcela1_idx` (`idTipoParcela` ASC),
  CONSTRAINT `fk_Parcelas_Cementerios`
    FOREIGN KEY (`idCementerio`)
    REFERENCES `cementerio`.`Cementerios` (`idCementerio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Parcelas_Tipo_Parcela1`
    FOREIGN KEY (`idTipoParcela`)
    REFERENCES `cementerio`.`TipoParcela` (`idTipoParcela`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cementerio`.`CtlEstadosNichos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cementerio`.`CtlEstadosNichos` (
  `idCtlEstadosNicho` INT NOT NULL AUTO_INCREMENT,
  `Descripcion` VARCHAR(45) NOT NULL,
  `Estado` INT(1) NOT NULL,
  PRIMARY KEY (`idCtlEstadosNicho`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cementerio`.`Nichos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cementerio`.`Nichos` (
  `idNicho` INT NOT NULL AUTO_INCREMENT,
  `idParcela` INT NOT NULL,
  `idCtlEstadosNicho` INT NOT NULL,
  `NumeroOrden` INT NOT NULL DEFAULT 0,
  `Fecha` DATE NOT NULL,
  `Estado` INT(1) NULL,
  PRIMARY KEY (`idNicho`, `idParcela`, `idCtlEstadosNicho`),
  INDEX `fk_Nichos_Parcelas1_idx` (`idParcela` ASC),
  INDEX `fk_Nichos_Ctl_Estados_Nichos1_idx` (`idCtlEstadosNicho` ASC),
  CONSTRAINT `fk_Nichos_Parcelas1`
    FOREIGN KEY (`idParcela`)
    REFERENCES `cementerio`.`Parcelas` (`idParcela`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Nichos_Ctl_Estados_Nichos1`
    FOREIGN KEY (`idCtlEstadosNicho`)
    REFERENCES `cementerio`.`CtlEstadosNichos` (`idCtlEstadosNicho`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cementerio`.`Enterramientos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cementerio`.`Enterramientos` (
  `idEnterramiento` INT NOT NULL AUTO_INCREMENT,
  `idNicho` INT NOT NULL,
  `FechaInicio` DATE NOT NULL,
  `FechaFin` DATE NOT NULL,
  `NombresFallecido` VARCHAR(250) NOT NULL,
  `ApellidosFallecido` VARCHAR(250) NOT NULL,
  `FUnoISAM` VARCHAR(45) NOT NULL,
  `TipoInhumacion` VARCHAR(45) NOT NULL,
  `Estado` INT(1) NOT NULL,
  `Observaciones` VARCHAR(255) NULL,
  `Interesado` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`idEnterramiento`, `idNicho`),
  INDEX `fk_Enterramientos_Nichos1_idx` (`idNicho` ASC),
  CONSTRAINT `fk_Enterramientos_Nichos1`
    FOREIGN KEY (`idNicho`)
    REFERENCES `cementerio`.`Nichos` (`idNicho`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cementerio`.`Exhumaciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cementerio`.`Exhumaciones` (
  `idExhumacion` INT NOT NULL AUTO_INCREMENT,
  `idEnterramiento` INT NOT NULL,
  `ViaJudicial` INT(1) NOT NULL DEFAULT 0,
  `Fecha` DATE NOT NULL,
  `Observaciones` VARCHAR(45) NULL,
  `Estado` INT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idExhumacion`, `idEnterramiento`),
  INDEX `fk_Exhumaciones_Enterramientos1_idx` (`idEnterramiento` ASC),
  CONSTRAINT `fk_Exhumaciones_Enterramientos1`
    FOREIGN KEY (`idEnterramiento`)
    REFERENCES `cementerio`.`Enterramientos` (`idEnterramiento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cementerio`.`Traslados`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cementerio`.`Traslados` (
  `idTraslado` INT NOT NULL AUTO_INCREMENT,
  `idEnterramiento` INT NOT NULL,
  `Interesado` VARCHAR(200) NOT NULL,
  `Parentesco` VARCHAR(45) NOT NULL,
  `Destino` VARCHAR(200) NOT NULL,
  `Fecha` DATE NOT NULL,
  `Observaciones` VARCHAR(45) NOT NULL,
  `Estado` INT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idTraslado`, `idEnterramiento`),
  INDEX `fk_Traslados_Enterramientos1_idx` (`idEnterramiento` ASC),
  CONSTRAINT `fk_Traslados_Enterramientos1`
    FOREIGN KEY (`idEnterramiento`)
    REFERENCES `cementerio`.`Enterramientos` (`idEnterramiento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cementerio`.`TipoTitulos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cementerio`.`TipoTitulos` (
  `idTipoTitulo` INT NOT NULL AUTO_INCREMENT,
  `Tipo` VARCHAR(60) NOT NULL,
  `Descripcion` VARCHAR(200) NOT NULL,
  `Estado` INT(1) NOT NULL,
  PRIMARY KEY (`idTipoTitulo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cementerio`.`Ciudadanos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cementerio`.`Ciudadanos` (
  `idCiudadano` INT NOT NULL AUTO_INCREMENT,
  `NombresCiudadano` VARCHAR(45) NOT NULL,
  `ApellidosCiudadano` VARCHAR(45) NOT NULL,
  `FechaNacimiento` VARCHAR(45) NULL,
  `Profesion` VARCHAR(45) NULL,
  `Domicilio` VARCHAR(200) NULL,
  `DUI` VARCHAR(10) NULL,
  PRIMARY KEY (`idCiudadano`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cementerio`.`Titulos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cementerio`.`Titulos` (
  `idTitulo` INT NOT NULL AUTO_INCREMENT,
  `idParcela` INT NOT NULL,
  `idTipoTitulo` INT NOT NULL,
  `NumeroTitulo` VARCHAR(45) NULL,
  `idCiudadanoTitular` INT NOT NULL,
  `FechaExpedido` DATE NULL,
  `NumeroRecibo` VARCHAR(45) NULL,
  `FechaRecibo` DATE NULL,
  `Imagen` VARCHAR(500) NULL,
  `Observaciones` VARCHAR(500) NULL,
  `Estado` INT(1) NOT NULL,
  `Proceso` INT(1) NULL,
  PRIMARY KEY (`idTitulo`, `idParcela`, `idTipoTitulo`, `idCiudadanoTitular`),
  INDEX `fk_Titulos_Parcelas1_idx` (`idParcela` ASC),
  INDEX `fk_Titulos_Tipo_Titulos1_idx` (`idTipoTitulo` ASC),
  INDEX `fk_Titulos_Ciudadanos1_idx` (`idCiudadanoTitular` ASC),
  CONSTRAINT `fk_Titulos_Parcelas1`
    FOREIGN KEY (`idParcela`)
    REFERENCES `cementerio`.`Parcelas` (`idParcela`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Titulos_Tipo_Titulos1`
    FOREIGN KEY (`idTipoTitulo`)
    REFERENCES `cementerio`.`TipoTitulos` (`idTipoTitulo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Titulos_Ciudadanos1`
    FOREIGN KEY (`idCiudadanoTitular`)
    REFERENCES `cementerio`.`Ciudadanos` (`idCiudadano`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cementerio`.`TipoEnterramiento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cementerio`.`TipoEnterramiento` (
  `idTipoEnterramiento` INT NOT NULL AUTO_INCREMENT,
  `Tipo` VARCHAR(45) NOT NULL,
  `Descripcion` VARCHAR(250) NOT NULL,
  `Estado` INT(1) NOT NULL,
  PRIMARY KEY (`idTipoEnterramiento`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cementerio`.`EnterramientoSinTitulo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cementerio`.`EnterramientoSinTitulo` (
  `idEnterramientoFosaComun` INT NOT NULL AUTO_INCREMENT,
  `idCementerio` INT NOT NULL,
  `idTipoEnterramiento` INT NOT NULL,
  `NombreFallecido` VARCHAR(250) NOT NULL,
  `ApellidosFallecido` VARCHAR(250) NOT NULL,
  `Fecha` DATE NOT NULL,
  `Observaciones` VARCHAR(500) NOT NULL,
  PRIMARY KEY (`idEnterramientoFosaComun`, `idCementerio`, `idTipoEnterramiento`),
  INDEX `fk_Enterramiento_Fosa_Comun_Cementerios1_idx` (`idCementerio` ASC),
  INDEX `fk_Enterramiento_Sin_Titulo_Tipo_Enterramiento1_idx` (`idTipoEnterramiento` ASC),
  CONSTRAINT `fk_Enterramiento_Fosa_Comun_Cementerios1`
    FOREIGN KEY (`idCementerio`)
    REFERENCES `cementerio`.`Cementerios` (`idCementerio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Enterramiento_Sin_Titulo_Tipo_Enterramiento1`
    FOREIGN KEY (`idTipoEnterramiento`)
    REFERENCES `cementerio`.`TipoEnterramiento` (`idTipoEnterramiento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cementerio`.`PagosArrendamientos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cementerio`.`PagosArrendamientos` (
  `idPagoArrendamiento` INT NOT NULL AUTO_INCREMENT,
  `Nombres` VARCHAR(45) NULL,
  `Apellidos` VARCHAR(45) NULL,
  `Direccion` VARCHAR(55) NULL,
  `FechaPago` DATE NOT NULL,
  `F1ISAM` VARCHAR(45) NOT NULL,
  `Anios` INT(2) NOT NULL,
  `idParcela` INT NOT NULL,
  PRIMARY KEY (`idPagoArrendamiento`, `idParcela`),
  INDEX `fk_Pagos_Arrendamientos_Parcelas1_idx` (`idParcela` ASC),
  CONSTRAINT `fk_Pagos_Arrendamientos_Parcelas1`
    FOREIGN KEY (`idParcela`)
    REFERENCES `cementerio`.`Parcelas` (`idParcela`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cementerio`.`Usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cementerio`.`Usuarios` (
  `idUsuario` INT NOT NULL AUTO_INCREMENT,
  `NombreUsuario` VARCHAR(45) NOT NULL,
  `CorreoUsuario` VARCHAR(255) NULL DEFAULT NULL,
  `Password` VARCHAR(32) NOT NULL,
  `create_time` DATE NOT NULL,
  `Rol` INT(1) NOT NULL,
  PRIMARY KEY (`idUsuario`));


-- -----------------------------------------------------
-- Table `cementerio`.`Beneficiarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cementerio`.`Beneficiarios` (
  `idBeneficiario` INT NOT NULL AUTO_INCREMENT,
  `idTitulo` INT NOT NULL,
  `idCiudadano` INT NOT NULL,
  `Estado` INT(1) NOT NULL,
  PRIMARY KEY (`idBeneficiario`, `idTitulo`, `idCiudadano`),
  INDEX `fk_Beneficiarios_Titulos1_idx` (`idTitulo` ASC),
  INDEX `fk_Beneficiarios_Ciudadanos1_idx` (`idCiudadano` ASC),
  CONSTRAINT `fk_Beneficiarios_Titulos1`
    FOREIGN KEY (`idTitulo`)
    REFERENCES `cementerio`.`Titulos` (`idTitulo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Beneficiarios_Ciudadanos1`
    FOREIGN KEY (`idCiudadano`)
    REFERENCES `cementerio`.`Ciudadanos` (`idCiudadano`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cementerio`.`Configuraciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cementerio`.`Configuraciones` (
  `idConfiguracion` INT NOT NULL AUTO_INCREMENT,
  `ValorTitulacion` DECIMAL(3,2) NULL,
  `ValorEnterramientoNicho` DECIMAL(3,2) NULL,
  `ValorPermisoAbriryCerrar` DECIMAL(3,2) NULL,
  `ValorEnterramientoTierra` DECIMAL(3,2) NULL,
  `ValorEnterramientoTraslado` DECIMAL(3,2) NULL,
  `ValorEnterramientoTraspaso` DECIMAL(3,2) NULL,
  `ValorConstruccionNivel` DECIMAL(3,2) NULL,
  `RutaTitulos` VARCHAR(100) NULL,
  `Encabezado` VARCHAR(600) NULL,
  PRIMARY KEY (`idConfiguracion`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cementerio`.`Enterramiento_Cem_Privado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cementerio`.`Enterramiento_Cem_Privado` (
  `idEnterramiento` INT NOT NULL,
  `Cementerios_idCementerio` INT NOT NULL,
  PRIMARY KEY (`Cementerios_idCementerio`, `idEnterramiento`),
  CONSTRAINT `fk_Enterramiento_Cem_Privado_Cementerios1`
    FOREIGN KEY (`Cementerios_idCementerio`)
    REFERENCES `cementerio`.`Cementerios` (`idCementerio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cementerio`.`Notificaciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cementerio`.`Notificaciones` (
  `idNotificacion` INT NOT NULL AUTO_INCREMENT,
  `Fecha` DATE NOT NULL,
  `Visto` INT(1) NOT NULL DEFAULT 0,
  `RolAccess` INT(1) NOT NULL,
  `Data` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`idNotificacion`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `cementerio`.`TipoParcela`
-- -----------------------------------------------------
START TRANSACTION;
USE `cementerio`;
INSERT INTO `cementerio`.`TipoParcela` (`idTipoParcela`, `Descripcion`) VALUES (1, 'Perpetuidad');
INSERT INTO `cementerio`.`TipoParcela` (`idTipoParcela`, `Descripcion`) VALUES (2, 'Arrendamiento');

COMMIT;


-- -----------------------------------------------------
-- Data for table `cementerio`.`CtlEstadosNichos`
-- -----------------------------------------------------
START TRANSACTION;
USE `cementerio`;
INSERT INTO `cementerio`.`CtlEstadosNichos` (`idCtlEstadosNicho`, `Descripcion`, `Estado`) VALUES (1, 'Disponible', 1);
INSERT INTO `cementerio`.`CtlEstadosNichos` (`idCtlEstadosNicho`, `Descripcion`, `Estado`) VALUES (2, 'Ocupado', 1);
INSERT INTO `cementerio`.`CtlEstadosNichos` (`idCtlEstadosNicho`, `Descripcion`, `Estado`) VALUES (3, 'Permiso Abrir/Cerrar', 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `cementerio`.`TipoTitulos`
-- -----------------------------------------------------
START TRANSACTION;
USE `cementerio`;
INSERT INTO `cementerio`.`TipoTitulos` (`idTipoTitulo`, `Tipo`, `Descripcion`, `Estado`) VALUES (1, 'Perpetuidad por Primera Vez', 'Título expedido por la autoridad municipal por primera vez', 1);
INSERT INTO `cementerio`.`TipoTitulos` (`idTipoTitulo`, `Tipo`, `Descripcion`, `Estado`) VALUES (2, 'Reposicion de Perpetuidad', 'Título expedido por la autoridad municipal en reposición de un título antiguo', 1);
INSERT INTO `cementerio`.`TipoTitulos` (`idTipoTitulo`, `Tipo`, `Descripcion`, `Estado`) VALUES (3, 'Traspaso', 'Título a perpetuidad por modificaciones en el registro', 1);
INSERT INTO `cementerio`.`TipoTitulos` (`idTipoTitulo`, `Tipo`, `Descripcion`, `Estado`) VALUES (4, 'Título Cancelado', 'Título a perpetuidad cancelado por modificaciones en el registro', 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `cementerio`.`TipoEnterramiento`
-- -----------------------------------------------------
START TRANSACTION;
USE `cementerio`;
INSERT INTO `cementerio`.`TipoEnterramiento` (`idTipoEnterramiento`, `Tipo`, `Descripcion`, `Estado`) VALUES (1, 'Fosa Comun', 'Inhumacion en fosa comun', 1);
INSERT INTO `cementerio`.`TipoEnterramiento` (`idTipoEnterramiento`, `Tipo`, `Descripcion`, `Estado`) VALUES (2, 'Cementerio Privado', 'Inhumacion en Cementerio privado', 1);

COMMIT;

USE `cementerio`;

DELIMITER $$
USE `cementerio`$$
CREATE DEFINER = CURRENT_USER TRIGGER `cementerio`.`Parcelas_AFTER_INSERT` AFTER INSERT ON `Parcelas` FOR EACH ROW
BEGIN

END
$$


DELIMITER ;
