-- MySQL Workbench Synchronization
-- Generated: 2023-09-27 15:36
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: ALUNO

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

CREATE SCHEMA IF NOT EXISTS `agrofam` DEFAULT CHARACTER SET utf8 ;

CREATE TABLE IF NOT EXISTS `agrofam`.`agricultores` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `CAF` VARCHAR(45) BINARY NOT NULL,
  `CPF` VARCHAR(11) BINARY NOT NULL,
  `local` VARCHAR(50) NOT NULL,
  `senha` VARCHAR(12) NOT NULL,
  `telefone` VARCHAR(45) NULL DEFAULT NULL,
  `email` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `agrofam`.`ofertas` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `produtos_id` INT(11) NOT NULL,
  `agricultores_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_ofertas_produtos_idx` (`produtos_id` ASC),
  INDEX `fk_ofertas_agricultores1_idx` (`agricultores_id` ASC),
  CONSTRAINT `fk_ofertas_produtos`
    FOREIGN KEY (`produtos_id`)
    REFERENCES `agrofam`.`produtos` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_ofertas_agricultores1`
    FOREIGN KEY (`agricultores_id`)
    REFERENCES `agrofam`.`agricultores` (`id`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `agrofam`.`produtos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `subtipo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `agrofam`.`instituicoes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `CNPJ` VARCHAR(45) NOT NULL,
  `local` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `agrofam`.`editais` (
  `data` INT(11) NOT NULL,
  `nome` VARCHAR(45) NOT NULL,
  `instituicoes_id` INT(11) NOT NULL,
  PRIMARY KEY (`data`),
  INDEX `fk_editais_instituicoes1_idx` (`instituicoes_id` ASC),
  CONSTRAINT `fk_editais_instituicoes1`
    FOREIGN KEY (`instituicoes_id`)
    REFERENCES `agrofam`.`instituicoes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
