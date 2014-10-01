-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 29/09/2014 às 13:47
-- Versão do servidor: 5.5.38-0ubuntu0.14.04.1
-- Versão do PHP: 5.5.9-1ubuntu4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `erapi`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `curso`
--

CREATE TABLE IF NOT EXISTS `curso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(256) NOT NULL,
  `tipo` int(11) NOT NULL,
  `excluido` tinyint(1) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

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

-- --------------------------------------------------------

--
-- Estrutura para tabela `departamento`
--

CREATE TABLE IF NOT EXISTS `departamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(256) NOT NULL,
  `excluido` tinyint(1),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

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

-- --------------------------------------------------------

--
-- Estrutura para tabela `estrangeiro`
--

CREATE TABLE IF NOT EXISTS `estrangeiro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(256) NOT NULL,
  `email` varchar(64) NOT NULL,
  `passaport` varchar(16) NOT NULL,
  `rne` varchar(64) DEFAULT NULL COMMENT 'Descobrir o que é o RNE e como armazenar',
  `atuacao` int(11) NOT NULL,
  `atuacao_outros` varchar(256) DEFAULT NULL,
  `pais` varchar(256) NOT NULL,
  `instituicao` varchar(256) NOT NULL,
  `docente` varchar(256) NOT NULL,
  `email_docente` varchar(256) NOT NULL,
  `atividade` text NOT NULL,
  `data_chegada` date NOT NULL,
  `data_saida` date NOT NULL,
  `foto` varchar(512) NOT NULL,
  `validado` tinyint(1) NOT NULL DEFAULT '0',
  `usuario_validador` int(11) NOT NULL,
  `departamento` int(11) NOT NULL,
  `curso` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_estrangeiro_usuario_idx` (`usuario_validador`),
  KEY `fk_estrangeiro_departamento1_idx` (`departamento`),
  KEY `fk_estrangeiro_curso1_idx` (`curso`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Fazendo dump de dados para tabela `estrangeiro`
--

INSERT INTO `estrangeiro` (`id`, `nome`, `email`, `passaport`, `rne`, `atuacao`, `atuacao_outros`, `pais`, `instituicao`, `docente`, `email_docente`, `atividade`, `data_chegada`, `data_saida`, `foto`, `validado`, `usuario_validador`, `departamento`, `curso`) VALUES
(1, 'Estrangeiro 1', 'estrangeiro1@docentes.com', '21897129', '3298790228', 1, NULL, 'Canadá', 'Universidade Canadense', 'Tio Vavá', 'vava@docentes.com', 'O meliante veio estudar', '2013-09-01', '2014-10-02', 'imagens/estrangeiro1.jpg', 0, 1, 9, 8),
(2, 'Estrangeiro 2', 'estrangeiro2@docentes.com', '23897923', '333329702', 2, NULL, 'USA', 'MIT', 'Tia Ro', 'tiaro@docentes.com', 'Estudar a parametrização cíclica do ambiente estocástico', '2014-09-01', '2015-10-02', 'imagens/estrangeiro2.jpg', 0, 2, 3, 1),
(3, 'Estrangeiro 3', 'estrangeiro3@docentes.com', '9876876329', '398679829', 3, NULL, 'Argentina', 'Universidade de Los Hermanos', 'Zé Pelé', 'pele@docentes.com', 'Ole ole ole, ole ole ola, soy maradona', '2013-09-01', '2015-11-03', 'imagens/estrangeiro3.jpg', 1, 3, 2, 2),
(4, 'Estrangeiro 4', 'estrangeiro4@docentes.com', '888837732', '887367623', 4, NULL, 'Holanda', 'Universidade Epica', 'Simone Simons', 'deusa@docentes.com', 'Uma deusa uma louca uma feiticeira, ela é D+', '2012-11-12', '2013-11-03', 'imagens/estrangeiro4.jpg', 1, 4, 9, 7),
(5, 'Estrangeiro 5', 'estrangeiro5@docentes.com', '77469836', '9876532', 5, NULL, 'Finlândia', 'Universidade Finlândica', 'Alexi Laiho', 'wildchild@docentes.com', 'do you guys wanna rock or what?', '2011-12-12', '2013-11-03', 'imagens/estrangeiro5.png', 1, 7, 7, 6),
(6, 'Estrangeiro 6', 'estrangeiro6@docentes.com', '329879023', '89769273', 0, 'Mestre dos mestres', 'China', 'Universidade Ching Ling', 'Yun Yen Yin', 'yun@docentes.com', 'Veio flitar pastel de flango, com catupili', '2011-07-12', '2013-05-03', 'imagens/estrangeiro6.jpg', 1, 8, 4, 3),
(7, 'Estrangeiro 7', 'estrangeiro7@docentes.com', '663529862', '9765367', 2, NULL, 'França', 'Universidade da Entrada Franca', 'Josefina', 'josefina@docentes.com', 'Palestra sobre estudos avançados da canalização estuporádica mediana', '2013-07-12', '2013-07-15', 'imagens/estrangeiro7.jpg', 1, 2, 3, 7),
(8, 'Estrangeiro 8', 'estrangeiro8@docentes.com', '00387865', '102987682', 1, NULL, 'Alemanha', 'Universidade de Volkswagen', 'Genuino Marfin', 'gm@docentes.com', 'Simpósio nacional de motores v6 turbo GTS', '2013-08-12', '2013-08-15', 'imagens/estrangeiro8.jpg', 1, 3, 8, 8),
(9, 'Estrangeiro 9', 'estrangeiro9@docentes.com', '10928273654', '203938465', 2, NULL, 'Bolívia', 'Universidade Gaseodútica', 'Juan Pablo', 'juan@docentes.com', 'Aplicações baseadas no sistema básico lavrado sobre mediunes fretes', '2011-08-12', '2013-08-15', 'imagens/estrangeiro9.jpg', 1, 4, 3, 6),
(10, 'Estrangeiro 10', 'estrangeiro10@docentes.com', '77492639463', '8837746623992', 4, NULL, 'Guatemala', 'Universidade Pacífica', 'Carlos Maleado', 'maleado@docentes.com', 'Para bailar la bamba, sono sete ticos com la boca de grassa', '2014-08-12', '2015-10-08', 'imagens/estrangeiro10.jpg', 0, 3, 1, 1),
(11, 'Estrangeiro 11', 'estrangeiro11@docentes.com', '28792', '3333333', 0, 'Ouvinte', 'Nhame', 'Universidade BlaBla', 'Batista Ferreira', 'batista@docentes.com', 'Aquele texto', '2013-08-12', '2015-10-08', 'imagens/estrangeiro11.jpg', 0, 4, 2, 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(256) NOT NULL,
  `login` varchar(16) NOT NULL,
  `senha_hash` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `permissao` int(11) NOT NULL,
  `excluido` tinyint(1) NOT NULL DEFAULT '0',
  `data_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Fazendo dump de dados para tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `login`, `senha_hash`, `email`, `permissao`, `excluido`, `data_cadastro`) VALUES
(1, 'Usuario admin 1', 'admin1', '123456', 'usuario1@usuarios.com', 0, 0, '2014-09-23 20:01:11'),
(2, 'Usuario admin 2', 'admin2', '28767869', 'usuario2@usuarios.com', 0, 0, '2014-09-23 20:01:11'),
(3, 'Usuario normal 1', 'normal1', '23987929', 'usuario3@usuarios.com', 1, 0, '2014-09-23 20:01:11'),
(4, 'Usuario normal 2', 'normal2', '876836', 'usuario4@usuarios.com', 1, 0, '2014-09-23 20:03:21'),
(5, 'Usuario espec 1', 'espec1', '986478', 'usuario5@usuarios.com', 2, 0, '2014-09-23 20:03:21'),
(6, 'Usuario espec 2', 'espec2', '663986287', 'usuario6@usuarios.com', 2, 0, '2014-09-23 20:03:21'),
(7, 'Usuario admin excluido', 'admin0', '888899', 'usuario7@usuarios.com', 0, 1, '2014-09-23 20:04:25'),
(8, 'Usuario normal excluido', 'normal0', '28874883', 'usuario8@usuarios.com', 1, 1, '2014-09-23 20:05:32'),
(9, 'Usuario espec excluido', 'espec0', '299388834772', 'usuario9@usuarios.com', 2, 1, '2014-09-23 20:05:32'),
(10, 'Administrador', 'admin', '4abe5e047f97cdaa8a547c7a9c5a4519', 'amin@email.com.br', 0, 0, '2014-09-24 14:45:44');

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `estrangeiro`
--
ALTER TABLE `estrangeiro`
  ADD CONSTRAINT `fk_estrangeiro_curso1` FOREIGN KEY (`curso`) REFERENCES `curso` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_estrangeiro_departamento1` FOREIGN KEY (`departamento`) REFERENCES `departamento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_estrangeiro_usuario` FOREIGN KEY (`usuario_validador`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
