-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Ago 27, 2009 as 04:50 
-- Versão do Servidor: 5.1.37
-- Versão do PHP: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Banco de Dados: `vianna_reiartur`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoriaproduto`
--

CREATE TABLE IF NOT EXISTS `categoriaproduto` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nomeCategoria` varchar(45) NOT NULL,
  `descricaoCategoria` varchar(255) NOT NULL,
  `visivelCategoria` int(11) NOT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `categoriaproduto`
--

INSERT INTO `categoriaproduto` (`idCategoria`, `nomeCategoria`, `descricaoCategoria`, `visivelCategoria`) VALUES
(1, 'Camisas', 'Camisas confortÃ¡veis sem perder a elegÃ¢ncia', 1),
(2, 'Gravatas', 'Gravatas nos mais diversos estilos, do tradicional ao moderno', 1),
(3, 'Ternos', 'Ternos <span>Ternos para todas as ocasiÃµes: casamentos,eventos formais e informais', 1),
(4, 'CalÃ§as', 'CalÃ§as nos mais diversos tamanhos e cores', 1),
(5, 'Sapatos', 'Sapatos em couro com durabilidade e conforto', 1),
(6, 'AcessÃ³rios', 'Cintos, pregadores, lenÃ§os, calÃ§adores e muitos outros', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `idCliente` int(11) NOT NULL AUTO_INCREMENT,
  `tipoCliente` int(1) NOT NULL,
  `emailCliente` varchar(150) NOT NULL,
  `senhaCliente` char(32) NOT NULL,
  `telefoneCliente` int(11) DEFAULT NULL,
  `celularCliente` int(11) DEFAULT NULL,
  `chamadoCliente` varchar(45) NOT NULL,
  `newsletterCliente` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idCliente`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`idCliente`, `tipoCliente`, `emailCliente`, `senhaCliente`, `telefoneCliente`, `celularCliente`, `chamadoCliente`, `newsletterCliente`) VALUES
(1, 1, 'txgruppi@gmail.com', 'be499017489faf269a474dc5d09067f5', NULL, 2147483647, 'TarcÃ­sio', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientefisico`
--

CREATE TABLE IF NOT EXISTS `clientefisico` (
  `idCliente` int(11) NOT NULL,
  `nomeCliente` varchar(150) NOT NULL,
  `cpfCliente` int(11) NOT NULL,
  `sexoCliente` char(1) NOT NULL,
  `nascimentoCliente` date NOT NULL,
  PRIMARY KEY (`idCliente`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `clientefisico`
--

INSERT INTO `clientefisico` (`idCliente`, `nomeCliente`, `cpfCliente`, `sexoCliente`, `nascimentoCliente`) VALUES
(1, 'TarcÃ­sio Xavier Gruppi', 2147483647, 'M', '0000-00-00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientejuridico`
--

CREATE TABLE IF NOT EXISTS `clientejuridico` (
  `idCliente` int(11) NOT NULL,
  `razaoSocialCliente` varchar(150) NOT NULL,
  `cnpjCliente` int(11) NOT NULL,
  `inscricaoEstadualCliente` varchar(45) NOT NULL,
  `responsavelCliente` varchar(150) NOT NULL,
  PRIMARY KEY (`idCliente`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `clientejuridico`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE IF NOT EXISTS `endereco` (
  `idCliente` int(11) NOT NULL,
  `idEndereco` int(11) NOT NULL AUTO_INCREMENT,
  `tipoEndereco` int(11) NOT NULL,
  `ruaEndereco` varchar(150) NOT NULL,
  `numeroEndereco` varchar(10) NOT NULL,
  `complementoEndereco` varchar(10) DEFAULT NULL,
  `bairroEndereco` varchar(45) NOT NULL,
  `cepEndereco` char(8) NOT NULL,
  `cidadeEndereco` varchar(150) NOT NULL,
  `estadoEndereco` char(2) NOT NULL,
  PRIMARY KEY (`idEndereco`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `endereco`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `fotoproduto`
--

CREATE TABLE IF NOT EXISTS `fotoproduto` (
  `idProduto` int(11) NOT NULL,
  `idFotoProduto` int(11) NOT NULL AUTO_INCREMENT,
  `arquivoFotoProduto` varchar(45) NOT NULL,
  `visivelFotoProduto` int(11) NOT NULL,
  PRIMARY KEY (`idFotoProduto`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `fotoproduto`
--

INSERT INTO `fotoproduto` (`idProduto`, `idFotoProduto`, `arquivoFotoProduto`, `visivelFotoProduto`) VALUES
(1, 1, 'ddf5f837dbe96e6691f1171ef0835130.jpg', 1),
(1, 2, 'd8b0966bc27372ccf4912658cf59d5e8.jpg', 1),
(1, 3, '01213b23c504fda2707c0feb19e7a20b.jpg', 1),
(1, 4, '63fb5bc44af18e4989bb89edaa9c97ef.jpg', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE IF NOT EXISTS `produto` (
  `idProduto` int(11) NOT NULL AUTO_INCREMENT,
  `idCategoria` int(11) NOT NULL,
  `nomeProduto` varchar(45) NOT NULL,
  `descricaoCurtaProduto` text NOT NULL,
  `descricaoLongaProduto` text NOT NULL,
  `pesoProduto` float NOT NULL,
  `fabricanteProduto` varchar(255) NOT NULL,
  `precoProduto` decimal(10,2) NOT NULL,
  PRIMARY KEY (`idProduto`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`idProduto`, `idCategoria`, `nomeProduto`, `descricaoCurtaProduto`, `descricaoLongaProduto`, `pesoProduto`, `fabricanteProduto`, `precoProduto`) VALUES
(1, 1, 'Camisa de teste 1', 'DescriÃ§Ã£o curta da camisa de teste 1', 'DescriÃ§Ã£o longa da camisa de teste 1', 0.7, 'FÃ¡brica de Camisas', '30.00');
