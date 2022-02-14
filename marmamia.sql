-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 13-Nov-2020 às 23:19
-- Versão do servidor: 8.0.21
-- versão do PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `marmamia`
--
CREATE DATABASE IF NOT EXISTS `marmamia` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `marmamia`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id_cliente` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `telefone` varchar(16) NOT NULL,
  `email` varchar(40) NOT NULL,
  `senha` varchar(32) NOT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nome`, `cpf`, `telefone`, `email`, `senha`) VALUES
(13, 'Gabriel Oliveira Silva', '596.492.760-25', '(16)99159-8304', 'gabriel_cliente@gmail.com', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedores`
--

DROP TABLE IF EXISTS `fornecedores`;
CREATE TABLE IF NOT EXISTS `fornecedores` (
  `id_fornecedor` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `telefone` varchar(16) NOT NULL,
  `nome_fantasia` varchar(30) NOT NULL,
  `cnpj` varchar(18) NOT NULL,
  `logradouro` varchar(30) NOT NULL,
  `numero` int NOT NULL,
  `complemento` varchar(30) NOT NULL,
  `bairro` varchar(30) NOT NULL,
  `cidade` varchar(20) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `estado` varchar(15) NOT NULL,
  `logo_fornecedor` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `senha` varchar(32) NOT NULL,
  PRIMARY KEY (`id_fornecedor`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `fornecedores`
--

INSERT INTO `fornecedores` (`id_fornecedor`, `nome`, `cpf`, `telefone`, `nome_fantasia`, `cnpj`, `logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `cep`, `estado`, `logo_fornecedor`, `email`, `senha`) VALUES
(15, 'Gabriel Oliveira Silva', '596.492.760-25', '(16)99159-8304', 'Marmitas Vegan', '68.427.453/0001-32', 'Rua Cesário Motta', 644, 'Portão Principal', 'Centro', 'Matão', '15990-050', 'São Paulo', 'Logo2.png', 'gabriel_fornecedor@gmail.com', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE IF NOT EXISTS `pedidos` (
  `id_pedido` int NOT NULL AUTO_INCREMENT,
  `id_cliente` int NOT NULL,
  `id_fornecedor` int NOT NULL,
  `status` varchar(30) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id_pedido`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `id_cliente`, `id_fornecedor`, `status`, `total`, `created`, `modified`) VALUES
(32, 13, 15, 'Entregue', '33.99', '2020-11-13 20:12:06', '2020-11-13 20:12:06');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos_itens`
--

DROP TABLE IF EXISTS `pedidos_itens`;
CREATE TABLE IF NOT EXISTS `pedidos_itens` (
  `id_pedidos_itens` int NOT NULL AUTO_INCREMENT,
  `id_pedido` int NOT NULL,
  `id_cliente` int NOT NULL,
  `id_fornecedor` int NOT NULL,
  `id_produto` int NOT NULL,
  `nome` varchar(30) NOT NULL,
  `quantidade` int NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_pedidos_itens`),
  KEY `fk_id_pedido` (`id_pedido`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `pedidos_itens`
--

INSERT INTO `pedidos_itens` (`id_pedidos_itens`, `id_pedido`, `id_cliente`, `id_fornecedor`, `id_produto`, `nome`, `quantidade`, `preco`, `subtotal`) VALUES
(55, 32, 13, 15, 19, 'Coca-Cola', 1, '6.99', '6.99'),
(56, 32, 13, 15, 20, 'Água', 1, '2.00', '2.00'),
(57, 32, 13, 15, 22, 'Bolo de Chocolate', 2, '5.00', '10.00'),
(58, 32, 13, 15, 24, 'Marmita Tradicional', 1, '15.00', '15.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE IF NOT EXISTS `produtos` (
  `id_produto` int NOT NULL AUTO_INCREMENT,
  `id_fornecedor` int NOT NULL,
  `nome` varchar(30) NOT NULL,
  `tipo` varchar(30) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_produto`),
  KEY `fk_id_fornecedor` (`id_fornecedor`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id_produto`, `id_fornecedor`, `nome`, `tipo`, `descricao`, `preco`) VALUES
(19, 15, 'Coca-Cola', 'Bebida', 'Coca-Cola Original 2L', '6.99'),
(20, 15, 'Água', 'Bebida', 'Água mineral sem gás 500ml', '2.00'),
(21, 15, 'Molho', 'Adicional', 'Molho de Pimenta (Forte)', '2.50'),
(22, 15, 'Bolo de Chocolate', 'Sobremesa', 'Bolo de Chocolate (Fatia)', '5.00'),
(24, 15, 'Marmita Tradicional', 'Marmita', 'Arroz, Feijão, Bife, Batata frita', '15.00'),
(25, 15, 'Macarronada', 'Prato Pronto', 'Macarrão parafuso, molho e salsicha', '10.00');

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `pedidos_itens`
--
ALTER TABLE `pedidos_itens`
  ADD CONSTRAINT `fk_id_pedido` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `fk_id_fornecedor` FOREIGN KEY (`id_fornecedor`) REFERENCES `fornecedores` (`id_fornecedor`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
