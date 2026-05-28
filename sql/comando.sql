-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema gameplay
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema gameplay
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `gameplay` DEFAULT CHARACTER SET utf8 ;
USE `gameplay` ;

-- -----------------------------------------------------
-- Table `gameplay`.`game`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gameplay`.`game` (
  `idgame` INT NOT NULL AUTO_INCREMENT,
  `jogos` VARCHAR(200) NULL,
  `preco` VARCHAR(200) NULL,
  `plataforma` VARCHAR(200) NULL,
  `categoria` VARCHAR(200) NULL,
  `faixaetaria` VARCHAR(200) NULL,
  `lancamento` DATE NULL,
  PRIMARY KEY (`idgame`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gameplay`.`acao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gameplay`.`acao` (
  `idacao` INT NOT NULL AUTO_INCREMENT,
  `game_idgame` INT NOT NULL,
  `dat` DATE NULL,
  `usuario` VARCHAR(200) NULL,
  `quant` INT NULL,
  PRIMARY KEY (`idacao`, `game_idgame`),
  INDEX `fk_acao_game_idx` (`game_idgame` ASC) ,
  CONSTRAINT `fk_acao_game`
    FOREIGN KEY (`game_idgame`)
    REFERENCES `gameplay`.`game` (`idgame`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
