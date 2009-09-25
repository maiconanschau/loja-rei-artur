-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Set 25, 2009 as 06:05 
-- Versão do Servidor: 5.1.37
-- Versão do PHP: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Banco de Dados: `vianna_reiartur`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `bonuscliente`
--

CREATE TABLE IF NOT EXISTS `bonuscliente` (
  `idCliente` int(11) NOT NULL,
  `idBonus` int(11) NOT NULL AUTO_INCREMENT,
  `valorBonus` decimal(10,2) NOT NULL,
  `origemBonus` varchar(150) NOT NULL,
  `dataBonus` datetime NOT NULL,
  PRIMARY KEY (`idCliente`,`idBonus`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientebonus`
--

CREATE TABLE IF NOT EXISTS `clientebonus` (
  `idBonus` int(11) NOT NULL AUTO_INCREMENT,
  `idCliente` int(11) NOT NULL,
  `valorBonus` decimal(10,2) NOT NULL,
  `origemBonus` varchar(255) NOT NULL,
  `dataBonus` datetime NOT NULL,
  PRIMARY KEY (`idBonus`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientecupom`
--

CREATE TABLE IF NOT EXISTS `clientecupom` (
  `idCliente` int(11) NOT NULL,
  `idCupom` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentario`
--

CREATE TABLE IF NOT EXISTS `comentario` (
  `idComentario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `conteudoComentario` text CHARACTER SET utf8 NOT NULL,
  `statusComentario` int(1) unsigned NOT NULL,
  `dataComentario` datetime NOT NULL,
  `idCliente` int(10) unsigned NOT NULL,
  `idProduto` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idComentario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cupom`
--

CREATE TABLE IF NOT EXISTS `cupom` (
  `idCupom` int(11) NOT NULL AUTO_INCREMENT,
  `chaveCupom` varchar(45) NOT NULL,
  `valorCupom` decimal(10,2) NOT NULL,
  `tipoCupom` int(11) NOT NULL,
  `restritoCupom` int(11) NOT NULL,
  PRIMARY KEY (`idCupom`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `opcaopergunta`
--

CREATE TABLE IF NOT EXISTS `opcaopergunta` (
  `idOpcao` int(11) NOT NULL AUTO_INCREMENT,
  `idPergunta` int(11) NOT NULL,
  `valorOpcao` varchar(150) NOT NULL,
  PRIMARY KEY (`idOpcao`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedido`
--

CREATE TABLE IF NOT EXISTS `pedido` (
  `idPedido` int(11) NOT NULL AUTO_INCREMENT,
  `idCupom` int(11) DEFAULT NULL,
  `idCliente` int(11) NOT NULL,
  `idEndereco` int(11) NOT NULL,
  `dataPedido` datetime NOT NULL,
  `valorEntrega` decimal(10,2) NOT NULL,
  PRIMARY KEY (`idPedido`),
  KEY `idCliente` (`idCliente`),
  KEY `idEndereco` (`idEndereco`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidoitem`
--

CREATE TABLE IF NOT EXISTS `pedidoitem` (
  `idCliente` int(11) NOT NULL,
  `idEndereco` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `idProduto` bigint(20) NOT NULL,
  `idPedido` int(11) NOT NULL,
  `quantidadePedidoItem` int(11) NOT NULL,
  `valorPedidoItem` decimal(10,2) NOT NULL,
  KEY `idCliente` (`idCliente`),
  KEY `idEndereco` (`idEndereco`),
  KEY `idCategoria` (`idCategoria`),
  KEY `idProduto` (`idProduto`),
  KEY `idPedido` (`idPedido`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `perguntaquestionario`
--

CREATE TABLE IF NOT EXISTS `perguntaquestionario` (
  `idPergunta` int(11) NOT NULL AUTO_INCREMENT,
  `textoPergunta` varchar(255) NOT NULL,
  `tipoPergunta` int(1) NOT NULL,
  `ordemPergunta` int(11) DEFAULT NULL,
  `ativoPergunta` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idPergunta`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

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
  `cliquesProduto` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idProduto`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `questionariocliente`
--

CREATE TABLE IF NOT EXISTS `questionariocliente` (
  `idCliente` int(11) NOT NULL,
  `idPergunta` int(11) NOT NULL,
  `respostaPergunta` text NOT NULL,
  PRIMARY KEY (`idCliente`,`idPergunta`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
