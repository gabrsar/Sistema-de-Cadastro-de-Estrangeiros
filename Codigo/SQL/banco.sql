SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `erapi` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `erapi` ;

-- -----------------------------------------------------
-- Table `erapi`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `erapi`.`usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(256) NOT NULL,
  `login` VARCHAR(16) NOT NULL,
  `senha_hash` VARCHAR(64) NOT NULL,
  `email` VARCHAR(64) NOT NULL,
  `permissao` INT NOT NULL,
  `excluido` TINYINT(1) NOT NULL DEFAULT FALSE,
  `data_cadastro` TIMESTAMP NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `erapi`.`departamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `erapi`.`departamento` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome_ departamento` VARCHAR(256) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `erapi`.`curso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `erapi`.`curso` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(256) NOT NULL,
  `tipo` INT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `erapi`.`estrangeiro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `erapi`.`estrangeiro` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(256) NOT NULL,
  `email` VARCHAR(64) NOT NULL,
  `passaport` VARCHAR(16) NOT NULL,
  `rne` VARCHAR(64) NULL COMMENT 'Descobrir o que é o RNE e como armazenar',
  `atuacao` INT NOT NULL,
  `atuacao_outros` VARCHAR(256) NULL,
  `pais` VARCHAR(256) NOT NULL,
  `instituicao` VARCHAR(256) NOT NULL,
  `docente` VARCHAR(256) NOT NULL,
  `email_docente` VARCHAR(256) NOT NULL,
  `atividade` TEXT NOT NULL,
  `data_chegada` DATE NOT NULL,
  `data_saida` DATE NOT NULL,
  `foto` VARCHAR(512) NOT NULL,
  `validado` TINYINT(1) NOT NULL DEFAULT FALSE,
  `usuario_validador` INT NOT NULL,
  `departamento` INT NOT NULL,
  `curso` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_estrangeiro_usuario_idx` (`usuario_validador` ASC),
  INDEX `fk_estrangeiro_departamento1_idx` (`departamento` ASC),
  INDEX `fk_estrangeiro_curso1_idx` (`curso` ASC),
  CONSTRAINT `fk_estrangeiro_usuario`
    FOREIGN KEY (`usuario_validador`)
    REFERENCES `erapi`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_estrangeiro_departamento1`
    FOREIGN KEY (`departamento`)
    REFERENCES `erapi`.`departamento` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_estrangeiro_curso1`
    FOREIGN KEY (`curso`)
    REFERENCES `erapi`.`curso` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
