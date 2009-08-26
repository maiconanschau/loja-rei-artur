-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Ago 26, 2009 as 05:51 
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
  `visivelCategoria` int(11) NOT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `categoriaproduto`
--

INSERT INTO `categoriaproduto` (`idCategoria`, `nomeCategoria`, `visivelCategoria`) VALUES
(1, 'Camisas', 1),
(2, 'Gravatas', 1);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Extraindo dados da tabela `fotoproduto`
--

INSERT INTO `fotoproduto` (`idProduto`, `idFotoProduto`, `arquivoFotoProduto`, `visivelFotoProduto`) VALUES
(2, 8, 'e1beca2d780df62d64976b051aa8fd24.jpg', 1),
(2, 7, '6a87da4fc78ba874199b1706738f7bd9.jpg', 1),
(2, 6, '9c4d74ecb392bf27deafdf432598de5d.jpg', 1),
(2, 5, '9c64c14f6322d79049f3881e544fa400.jpg', 1),
(2, 9, 'e7249d61bb87689693539d1b834e6789.jpg', 1),
(2, 10, '9df3d936a33e1435927b01f2a6c8608b.jpg', 1),
(2, 11, 'd5f5e4c6df832e3d2479a37589cf1910.jpg', 1),
(2, 12, '8391c61c8015f4be7e7a6f3e81c63a6a.jpg', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE IF NOT EXISTS `produto` (
  `idProduto` int(11) NOT NULL AUTO_INCREMENT,
  `idCategoria` int(11) NOT NULL,
  `nomeProduto` varchar(45) NOT NULL,
  `descricaoProduto` text NOT NULL,
  `pesoProduto` float NOT NULL,
  `precoProduto` decimal(10,2) NOT NULL,
  PRIMARY KEY (`idProduto`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`idProduto`, `idCategoria`, `nomeProduto`, `descricaoProduto`, `pesoProduto`, `precoProduto`) VALUES
(1, 1, 'Camisa Um', 'DescriÃ§Ã£o da Camisa Um', 0.8, '25.00'),
(2, 1, 'Camisa Dois', 'DescriÃ§Ã£o da Camisa Dois', 0.7, '30.00');
