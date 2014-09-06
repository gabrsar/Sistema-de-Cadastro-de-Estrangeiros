SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Table `erapi`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `erapi`.`usuario` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `nome_usuario` VARCHAR(256) NOT NULL,
  `login_usuario` VARCHAR(16) NOT NULL,
  `senha_hash_usuario` VARCHAR(64) NOT NULL,
  `email_usuario` VARCHAR(64) NOT NULL,
  `permissao_usuario` INT NOT NULL,
  `excluido_usuario` TINYINT(1) NOT NULL DEFAULT FALSE,
  `data_cadastro_usuario` TIMESTAMP NOT NULL,
  PRIMARY KEY (`id_usuario`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `erapi`.`departamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `erapi`.`departamento` (
  `id_departamento` INT NOT NULL AUTO_INCREMENT,
  `nome_ departamento` VARCHAR(256) NOT NULL,
  PRIMARY KEY (`id_departamento`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `erapi`.`curso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `erapi`.`curso` (
  `id_curso` INT NOT NULL AUTO_INCREMENT,
  `nome_curso` VARCHAR(256) NOT NULL,
  `tipo_curso` INT NOT NULL,
  PRIMARY KEY (`id_curso`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `erapi`.`estrangeiro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `erapi`.`estrangeiro` (
  `id_estrangeiro` INT NOT NULL,
  `nome_estrangeiro` VARCHAR(256) NOT NULL,
  `email_estrangeiro` VARCHAR(64) NOT NULL,
  `passaport_estrangeiro` VARCHAR(16) NOT NULL,
  `rne_estrangeiro` VARCHAR(64) NULL COMMENT 'Descobrir o que é o RNE e como armazenar',
  `atuacao_estrangeiro` INT NOT NULL,
  `atuacao_outros_estrangeiro` VARCHAR(256) NULL,
  `pais_estrangeiro` VARCHAR(256) NOT NULL,
  `instituicao_estrangeiro` VARCHAR(256) NOT NULL,
  `docente_estrangeiro` VARCHAR(256) NOT NULL,
  `email_docente_estrangeiro` VARCHAR(256) NOT NULL,
  `atividade_estrangeiro` TEXT NOT NULL,
  `data_chegada_estrangeiro` DATE NOT NULL,
  `data_saida_estrangeiro` DATE NOT NULL,
  `foto_estrangeiro` VARCHAR(512) NOT NULL,
  `validado_estrangeiro` TINYINT(1) NOT NULL DEFAULT FALSE,
  `usuario_validador_estrangeiro` INT NOT NULL,
  `departamento_estrangeiro` INT NOT NULL,
  `curso_estrangeiro` INT NOT NULL,
  PRIMARY KEY (`id_estrangeiro`),
  INDEX `fk_estrangeiro_usuario_idx` (`usuario_validador_estrangeiro` ASC),
  INDEX `fk_estrangeiro_departamento1_idx` (`departamento_estrangeiro` ASC),
  INDEX `fk_estrangeiro_curso1_idx` (`curso_estrangeiro` ASC),
  CONSTRAINT `fk_estrangeiro_usuario`
    FOREIGN KEY (`usuario_validador_estrangeiro`)
    REFERENCES `erapi`.`usuario` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_estrangeiro_departamento1`
    FOREIGN KEY (`departamento_estrangeiro`)
    REFERENCES `erapi`.`departamento` (`id_departamento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_estrangeiro_curso1`
    FOREIGN KEY (`curso_estrangeiro`)
    REFERENCES `erapi`.`curso` (`id_curso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
