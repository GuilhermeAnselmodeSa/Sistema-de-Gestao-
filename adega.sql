-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 01-Dez-2021 às 02:18
-- Versão do servidor: 8.0.18
-- versão do PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `adega`
--
CREATE DATABASE IF NOT EXISTS `adega` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `adega`;

DELIMITER $$
--
-- Procedimentos
--
DROP PROCEDURE IF EXISTS `carrinho`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `carrinho` (`pidpedido` INT, `pidproduto` INT, `pquantidade_vendida` INT)  begin
    -- declaraÃ§Ã£o de variaveis
	declare vqtde_estoque int;
    declare vpreco, vsubtotal, vtotal decimal(10,2);
    
    -- pegando o valor atual do preÃ§o do produto
    select preco_venda into vpreco from produtos 
    where codigo = pidproduto;
    
    -- pegando a quantidade atual em estoque
    select quantidade_estoque into vqtde_estoque from produtos 
    where codigo = pidproduto;
    
    -- pegando o valor atual do pedido 
    select valor into vtotal from pedido 
    where idpedido = pidpedido;
    
    -- definindo nova quantidade do produto em estoque
    set vqtde_estoque = vqtde_estoque - pquantidade_vendida;

    -- calculando o subtotal
    set vsubtotal = pquantidade_vendida * vpreco;

    -- calculando novo valor do pedido (acumulador)
    set vtotal = vtotal + vsubtotal;

    -- insert da tabela pedido_detalhe
    insert into pedido_detalhe (idpedido, codproduto, quantidade_vendida, subtotal) values (pidpedido, pidproduto, pquantidade_vendida, vsubtotal);
    
    -- atualizaÃ§Ã£o da quantidade em estoque
    update produtos set quantidade_estoque = vqtde_estoque where codigo = pidproduto;

    -- acumulo do valor do pedido
    update pedido set valor = vtotal where idpedido = pidpedido;

end$$

DROP PROCEDURE IF EXISTS `excluir_carrinho`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `excluir_carrinho` (`pidpedido` INT, `pidproduto` INT, `pquantidade_vendida` INT)  begin
    -- declaraÃ§Ã£o de variaveis
	declare vqtde_estoque int;
    declare vpreco, vsubtotal, vtotal decimal(10,2);
	
    -- pegando a quantidade atual em estoque
    select quantidade_estoque into vqtde_estoque from produtos 
    where codigo = pidproduto;
    
    -- pegando o valor atual do pedido 
    select valor into vtotal from pedido where idpedido = pidpedido;
    select subtotal into vsubtotal from pedido_detalhe where idpedido = pidpedido and codproduto = pidproduto;
    
    -- definindo nova quantidade do produto em estoque
    set vqtde_estoque = vqtde_estoque + pquantidade_vendida;
    
    -- calculando novo valor do pedido (acumulador)
    set vtotal = vtotal - vsubtotal;

    -- update da tabela pedido
    update pedido set valor = vtotal where idpedido = idpedido;
    
    -- atualizaÃ§Ã£o da quantidade em estoque
    update produtos set quantidade_estoque = vqtde_estoque where codigo = pidproduto;

	delete from pedido_detalhe where idpedido = pidpedido and codproduto = pidproduto;

end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `idcategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`idcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`idcategoria`, `nome`) VALUES
(1, 'Cerveja'),
(2, 'Refrigerante'),
(3, 'Gin'),
(4, 'Rum'),
(5, 'Whisky'),
(6, 'Tônica'),
(7, 'Energético'),
(8, 'Corote'),
(9, 'Água'),
(10, 'Cachaça'),
(11, 'Vinho'),
(12, 'Vodka'),
(13, 'Destilados');

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `idcliente` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `bairro` varchar(200) NOT NULL,
  `rua` varchar(200) NOT NULL,
  `numero` varchar(10) NOT NULL,
  PRIMARY KEY (`idcliente`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`idcliente`, `nome`, `cpf`, `telefone`, `bairro`, `rua`, `numero`) VALUES
(1, 'Marcelo Andrade Dias', '190.639.190-42', '(53) 3432-3631', 'Jardim Aeroporto', 'Rua Dr Norberto Dias', '121'),
(3, 'Cristofer Neto Correa', '539.705.340-62', '(53) 35373-621', 'Campolim', 'Rua José Consagrado Dias', '432'),
(4, 'Eliane Gonçaves Mendonça', '435.873.040-09', '(53) 64211-631', 'Condominío Salvilhas', 'Rua Alves Filho', '71'),
(5, 'Juliana Alves', '465.560.770-03', '(53) 21532-621', 'Jardim Bairro', 'Rua João Augusto Luvizotto', '10'),
(6, 'Guilherme Anselmo de Sa', '436.498.398-57', '(15) 99788-6904', 'Narita Park ', 'Rua Andrade Pedesche', '86'),
(7, 'Nicolas Diniz da Silva', '528.826.978-56', '(15) 99718-4983', 'Jardim Aeroporto', 'Salgado Filho', '40'),
(9, 'Dafny Vieira da Silva ', '295.476.848-76', '(15) 99679-7101', 'Centro', '13 de Maio', '296'),
(10, 'João Augusto Luvizotto', '428.848.288-77', '(15) 99152-8428', 'Vila Americana', 'Rua Maneco Fonseca ', '716'),
(11, 'Balcão', '902.520.988-20', '(15) 99609-8953', 'Centro', 'José de Moraes', '140');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

DROP TABLE IF EXISTS `pedido`;
CREATE TABLE IF NOT EXISTS `pedido` (
  `idpedido` int(11) NOT NULL AUTO_INCREMENT,
  `dataped` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `valor` decimal(10,2) DEFAULT '0.00',
  `idcliente` int(11) DEFAULT NULL,
  PRIMARY KEY (`idpedido`),
  KEY `idcliente` (`idcliente`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pedido`
--

INSERT INTO `pedido` (`idpedido`, `dataped`, `valor`, `idcliente`) VALUES
(1, '2021-12-01 00:34:08', '10.00', 7),
(3, '2021-12-01 00:42:28', '10.00', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido_detalhe`
--

DROP TABLE IF EXISTS `pedido_detalhe`;
CREATE TABLE IF NOT EXISTS `pedido_detalhe` (
  `idpedido` int(11) NOT NULL,
  `codproduto` int(11) NOT NULL,
  `quantidade_vendida` int(11) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`idpedido`,`codproduto`),
  KEY `codproduto` (`codproduto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pedido_detalhe`
--

INSERT INTO `pedido_detalhe` (`idpedido`, `codproduto`, `quantidade_vendida`, `subtotal`) VALUES
(1, 421876521, 1, '10.00'),
(3, 421876521, 1, '10.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE IF NOT EXISTS `produtos` (
  `codigo` int(11) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `preco_custo` decimal(5,2) NOT NULL,
  `preco_venda` decimal(5,2) NOT NULL,
  `unidade_medida` varchar(3) NOT NULL,
  `quantidade_fardo` int(11) NOT NULL,
  `quantidade_estoque` int(11) NOT NULL,
  `fkcategoria` varchar(50) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`codigo`, `marca`, `tipo`, `preco_custo`, `preco_venda`, `unidade_medida`, `quantidade_fardo`, `quantidade_estoque`, `fkcategoria`) VALUES
(4237456, 'Budweiser ', 'Fardo', '5.00', '13.00', 'ML', 0, 60, 'Cerveja'),
(8735456, 'Bonafont', 'Unitario', '2.00', '4.00', 'ML', 0, 20, 'Água'),
(9857127, 'Flying Horse', 'Fardo', '4.00', '10.00', 'L', 4, 30, 'Energético'),
(69841391, 'Askov Morango', 'Unitario', '5.00', '15.00', 'ML', 0, 23, 'Vodka'),
(258741968, 'Porto', 'Unitario', '100.00', '279.00', 'L', 0, 5, 'Vinho'),
(421876521, 'Coca-Cola', 'Unitario', '4.00', '10.00', 'L', 0, 17, 'Refrigerante'),
(436345214, 'Brahma', 'Fardo', '3.00', '6.00', 'ML', 0, 30, 'Cerveja');

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`idcliente`) REFERENCES `clientes` (`idcliente`);

--
-- Limitadores para a tabela `pedido_detalhe`
--
ALTER TABLE `pedido_detalhe`
  ADD CONSTRAINT `pedido_detalhe_ibfk_1` FOREIGN KEY (`idpedido`) REFERENCES `pedido` (`idpedido`),
  ADD CONSTRAINT `pedido_detalhe_ibfk_2` FOREIGN KEY (`codproduto`) REFERENCES `produtos` (`codigo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
