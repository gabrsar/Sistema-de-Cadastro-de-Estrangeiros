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
  PRIMARY KEY (`id`),
  UNIQUE INDEX `login_UNIQUE` (`login` ASC))
ENGINE = InnoDB;

--
-- Fazendo dump de dados para tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `login`, `senha_hash`, `email`, `permissao`, `excluido`, `data_cadastro`) VALUES
(1, 'Usuario admin 1', 'admin1', 'd97cd982ae7fcefd0e8ba32f2c95ab6f', 'usuario1@usuarios.com', 0, 0, '2014-09-23 20:01:11'),
(2, 'Usuario normal 1', 'normal1', 'd97cd982ae7fcefd0e8ba32f2c95ab6f', 'usuario2@usuarios.com', 1, 0, '2014-09-23 20:01:11'),
(3, 'Usuario espec 1', 'espec1', 'd97cd982ae7fcefd0e8ba32f2c95ab6f', 'usuario3@usuarios.com', 2, 0, '2014-09-23 20:03:21'),
(4, 'Usuario admin excluido', 'admin0', 'd97cd982ae7fcefd0e8ba32f2c95ab6f', 'usuario4@usuarios.com', 0, 1, '2014-09-23 20:04:25'),
(5, 'Usuario normal excluido', 'normal0', 'd97cd982ae7fcefd0e8ba32f2c95ab6f', 'usuario5@usuarios.com', 1, 1, '2014-09-23 20:05:32'),
(6, 'Usuario espec excluido', 'espec0', 'd97cd982ae7fcefd0e8ba32f2c95ab6f', 'usuario6@usuarios.com', 2, 1, '2014-09-23 20:05:32'),
(7, 'Administrador', 'admin', 'd97cd982ae7fcefd0e8ba32f2c95ab6f', 'admin@email.com.br', 0, 0, '2014-09-24 14:45:44');

-- -----------------------------------------------------
-- Table `erapi`.`departamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `erapi`.`departamento` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(256) NOT NULL,
  `excluido` TINYINT(1) NOT NULL DEFAULT FALSE,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nome_UNIQUE` (`nome` ASC))
ENGINE = MyISAM;

--
-- Fazendo dump de dados para tabela `departamento`
--

INSERT INTO `departamento` (`id`, `nome`,`excluido`) VALUES
(1, 'Departamento de Biologia',0),
(2, 'Departamento de Ciência de Computação e Estatística',0),
(3, 'Departamento de Educação',0),
(4, 'Departamento de Engenharia e Tecnologia de Alimentos',0),
(5, 'Departamento de Estudos Linguísticos e Literários',0),
(6, 'Departamento de Física',0),
(7, 'Departamento de Letras Modernas',0),
(8, 'Departamento de Matemática',0),
(9, 'Departamento de Matemática Aplicada',0),
(10, 'Departamento de Química e Ciências Ambientais',0),
(11, 'Departamento de Zoologia e Botânica',0);

-- -----------------------------------------------------
-- Table `erapi`.`curso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `erapi`.`curso` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(256) NOT NULL,
  `tipo` INT NOT NULL,
  `excluido` TINYINT(1) NOT NULL DEFAULT FALSE,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `nome_UNIQUE` (`nome` ASC))
ENGINE = MyISAM;

--
-- Fazendo dump de dados para tabela `curso`
--

INSERT INTO `curso` (`id`, `nome`, `tipo`, `excluido`) VALUES
(1, 'Bacharelado em Ciência da Computação', 1, 0),
(2, 'Licenciatura em Letras', 1, 0),
(3, 'Licenciatura em Letras com habilitação de Tradutor', 1, 0),
(4, 'Bacharelado/Licenciatura em Matemática', 1, 0),
(5, 'Bacharelado em Física Biológica', 1, 0),
(6, 'Bacharelado/Licenciatura em Química Ambiental', 1, 0),
(7, 'Bacharelado/Licenciatura em Ciências Biológicas', 1, 0),
(8, 'Engenharia de Alimentos', 1, 0),
(9, 'Licenciatura em Pedagogia', 1, 0);

-- -----------------------------------------------------
-- Table `erapi`.`estrangeiro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `erapi`.`estrangeiro` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(256) NOT NULL,
  `email` VARCHAR(64) NOT NULL,
  `passaporte` VARCHAR(16) NOT NULL,
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
  `usuario_validador` INT NULL,
  `departamento` INT NOT NULL,
  `curso` INT NOT NULL,
  `data_cadastro` TIMESTAMP NOT NULL,
  `data_validacao` DATETIME NULL,
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

--
-- Fazendo dump de dados para tabela `estrangeiro`
--
INSERT INTO `estrangeiro` (`id`, `nome`, `email`, `passaporte`, `rne`, `atuacao`, `atuacao_outros`, `pais`, `instituicao`, `docente`, `email_docente`, `atividade`, `data_chegada`, `data_saida`, `foto`, `validado`, `usuario_validador`, `departamento`, `curso`, `data_cadastro`, `data_validacao`) VALUES
(1, 'Bryan Kim ', 'bryankim@email.com', '21897129', '3298790228', 1, NULL, 'Canadá', 'Universidade Canadense', 'Tio Vavá', 'vava@email.com', 'O meliante veio estudar', '2013-09-01', '2014-10-02', '', 0, 1, 9, 8, '2012-09-01 20:01:11', '2012-10-01'),
(2, 'Kathleen Kennedy', 'kathleen@email.com', '23897923', '333329702', 2, NULL, 'USA', 'MIT', 'Tia Ro', 'tiaro@email.com', 'Estudar a parametrização cíclica do ambiente estocástico', '2014-09-01', '2015-10-02', '', 0, 2, 3, 1, '2014-05-01 20:03:21', '2014-04-01'),
(3, 'Jimmie Newton', 'jimmie@email.com', '9876876329', '398679829', 3, NULL, 'Argentina', 'Universidade de Los Hermanos', 'Zé Pelé', 'pele@email.com', 'Ole ole ole, ole ole ola, soy maradona', '2013-09-01', '2015-11-03', '', 1, 3, 2, 2, '2013-05-01 23:03:21', '2013-04-01'),
(4, 'Tommy Crawford', 'tommy@email.com', '888837732', '887367623', 4, NULL, 'Holanda', 'Universidade Epica', 'Simone Simons', 'deusa@email.com', 'Uma deusa uma louca uma feiticeira, ela é D+', '2012-11-12', '2013-11-03', '', 1, 4, 9, 7, '2012-06-12 15:05:21', '2012-05-12'),
(5, 'Vicki Pope', 'vicki@email.com', '77469836', '9876532', 5, NULL, 'Finlândia', 'Universidade Finlândica', 'Alexi Laiho', 'wildchild@email.com', 'do you guys wanna rock or what?', '2011-12-12', '2013-11-03', '.png', 1, 7, 7, 6, '2011-12-01 20:03:00', '2011-12-10'),
(6, 'Johanna Hernandez', 'johanna@email.com', '329879023', '89769273', 0, 'Mestre dos mestres', 'China', 'Universidade Ching Ling', 'Yun Yen Yin', 'yun@email.com', 'Veio flitar pastel de flango, com catupili', '2011-07-12', '2013-05-03', '', 1, 8, 4, 3, '2011-03-12 20:03:21', '2011-04-17'),
(7, 'Lucas Potter', 'lucas@email.com', '663529862', '9765367', 2, NULL, 'França', 'Universidade da Entrada Franca', 'Josefina', 'josefina@email.com', 'Palestra sobre estudos avançados da canalização estuporádica mediana', '2013-07-12', '2013-07-15', '', 1, 2, 3, 7, '2013-01-12 20:03:21', '2013-03-12'),
(8, 'Curtis Mills', 'curtis@email.com', '00387865', '102987682', 1, NULL, 'Alemanha', 'Universidade de Volkswagen', 'Genuino Marfin', 'gm@email.com', 'Simpósio nacional de motores v6 turbo GTS', '2013-08-12', '2013-08-15', '', 1, 3, 8, 8, '2013-07-12 03:55:44', '2013-07-28'),
(9, 'Roxanne Richardson ', 'roxanne@email.com', '10928273654', '203938465', 2, NULL, 'Bolívia', 'Universidade Gaseodútica', 'Juan Pablo', 'juan@email.com', 'Aplicações baseadas no sistema básico lavrado sobre mediunes fretes', '2011-08-12', '2013-08-15', '', 1, 4, 3, 6, '2011-04-15 13:27:32', '2011-04-16'),
(10, 'Nettie Barnett', 'nettie@email.com', '77492639463', '8837746623992', 4, NULL, 'Guatemala', 'Universidade Pacífica', 'Carlos Maleado', 'maleado@email.com', 'Para bailar la bamba, sono sete ticos com la boca de grassa', '2014-08-12', '2015-10-08', '', 0, 3, 1, 1, '2011-02-10 10:00:00', '2011-02-12');

-- --------------------------------------------------------

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
