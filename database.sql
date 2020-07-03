-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 28-Jun-2020 às 22:30
-- Versão do servidor: 5.7.26
-- versão do PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `documentos`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_categoria`
--

DROP TABLE IF EXISTS `tbl_categoria`;
CREATE TABLE IF NOT EXISTS `tbl_categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_categoria`
--

INSERT INTO `tbl_categoria` (`id`, `nome`, `foto`) VALUES
(1, 'RH', 'rh-small.jpg'),
(2, 'Financeiro', 'financeiro-small.jpg'),
(3, 'Operacional', 'operacional-small.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_cliente`
--

DROP TABLE IF EXISTS `tbl_cliente`;
CREATE TABLE IF NOT EXISTS `tbl_cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` char(1) DEFAULT '0',
  `empresa` varchar(255) DEFAULT NULL,
  `cnpj` varchar(18) DEFAULT NULL,
  `cep` varchar(255) DEFAULT '9',
  `endereco` varchar(255) DEFAULT NULL,
  `numero` varchar(30) DEFAULT NULL,
  `bairro` varchar(255) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `estado` char(2) DEFAULT NULL,
  `complemento` varchar(255) DEFAULT NULL,
  `fone` varchar(15) DEFAULT NULL,
  `logotipo` varchar(255) DEFAULT 'img-default.jpg',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_documento`
--

DROP TABLE IF EXISTS `tbl_documento`;
CREATE TABLE IF NOT EXISTS `tbl_documento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` mediumint(9) DEFAULT '11',
  `id_categoria` int(11) DEFAULT '0',
  `id_tipo` int(11) DEFAULT '0',
  `documento_nome` varchar(255) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `data_cad` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_estado`
--

DROP TABLE IF EXISTS `tbl_estado`;
CREATE TABLE IF NOT EXISTS `tbl_estado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sigla` char(2) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_estado`
--

INSERT INTO `tbl_estado` (`id`, `sigla`, `nome`) VALUES
(1, 'AC', 'Acre'),
(2, 'AL', 'Alagoas'),
(3, 'AP', 'Amapá'),
(4, 'AM', 'Amazonas'),
(5, 'BA', 'Bahia'),
(6, 'CE', 'Ceará'),
(7, 'DF', 'Distrito Federal'),
(8, 'ES', 'Espírito Santo'),
(9, 'GO', 'Goiás'),
(10, 'MA', 'Maranhão'),
(11, 'MT', 'Mato Grosso'),
(12, 'MS', 'Mato Grosso do Sul'),
(13, 'MG', 'Minas Gerais'),
(14, 'PA', 'Pará'),
(15, 'PB', 'Paraíba'),
(16, 'PR', 'Paraná'),
(17, 'PE', 'Pernambuco'),
(18, 'PI', 'Piauí'),
(19, 'RJ', 'Rio de Janeiro'),
(20, 'RN', 'Rio Grande do Norte'),
(21, 'RS', 'Rio Grande do Sul'),
(22, 'RO', 'Rondónia'),
(23, 'RR', 'Roraima'),
(24, 'SC', 'Santa Catarina'),
(25, 'SP', 'São Paulo'),
(26, 'SE', 'Sergipe'),
(27, 'TO', 'Tocantins');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_tipo`
--

DROP TABLE IF EXISTS `tbl_tipo`;
CREATE TABLE IF NOT EXISTS `tbl_tipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_categoria` int(11) DEFAULT '0',
  `nome` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_tipo`
--

INSERT INTO `tbl_tipo` (`id`, `id_categoria`, `nome`) VALUES
(1, 1, 'Cadastro de funcionário'),
(2, 1, 'Guias'),
(3, 1, 'Holerith'),
(4, 1, 'Beneficios'),
(5, 1, 'Férias'),
(6, 1, 'Licenças'),
(7, 2, 'Contratos'),
(8, 2, 'Notas'),
(9, 2, 'Boletos'),
(10, 3, 'Escala de serviço'),
(11, 3, 'Confirmação de posto'),
(12, 3, 'Avisos'),
(13, 3, 'Advertências'),
(14, 3, 'Ocorrências');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_usuario`
--

DROP TABLE IF EXISTS `tbl_usuario`;
CREATE TABLE IF NOT EXISTS `tbl_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) DEFAULT NULL,
  `padrao` char(3) DEFAULT '0',
  `status` char(3) DEFAULT '0',
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `fone` varchar(15) DEFAULT NULL,
  `senha` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tbl_usuario`
--

INSERT INTO `tbl_usuario` (`id`, `id_empresa`, `padrao`, `status`, `nome`, `email`, `fone`, `senha`) VALUES
(1, 0, '1', '0', 'admin', 'admin@admin.com.br', '(11) 4525-4525', '123123');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
