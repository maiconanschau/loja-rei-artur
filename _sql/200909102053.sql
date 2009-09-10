-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Set 10, 2009 as 08:49 
-- Versão do Servidor: 5.1.37
-- Versão do PHP: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `categoriaproduto`
--

INSERT INTO `categoriaproduto` (`idCategoria`, `nomeCategoria`, `descricaoCategoria`, `visivelCategoria`) VALUES
(1, 'Camisas', 'Camisas confort�veis sem perder a eleg�ncia', 1),
(2, 'Gravatas', 'Gravatas nos mais diversos estilos, do tradicional ao moderno', 1),
(3, 'Ternos', 'Ternos para todas as ocasi�es: casamentos,eventos formais e informais', 1),
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
(1, 1, 'txgruppi@gmail.com', 'be499017489faf269a474dc5d09067f5', NULL, 2147483647, 'Tarc�sio', 1);

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
(1, 'Tarc�sio Xavier Gruppi', 2147483647, 'M', '1987-04-21');

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
-- Estrutura da tabela `comentario`
--

CREATE TABLE IF NOT EXISTS `comentario` (
  `idComentario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `conteudo` text NOT NULL,
  `status` int(10) unsigned NOT NULL,
  `dataCriacao` datetime NOT NULL,
  `idCliente` int(10) unsigned NOT NULL,
  `idProduto` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idComentario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `comentario`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`idCliente`, `idEndereco`, `tipoEndereco`, `ruaEndereco`, `numeroEndereco`, `complementoEndereco`, `bairroEndereco`, `cepEndereco`, `cidadeEndereco`, `estadoEndereco`) VALUES
(1, 1, 1, 'Rua Luiz Perry', '459', '103', 'Santa Helena', '36015380', 'Juiz de Fora', 'MG'),
(1, 2, 1, 'Rua de teste', '123', '', 'Bairro de teste', '12345678', 'Cidade de teste', 'MG');

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

--
-- Extraindo dados da tabela `fotoproduto`
--

INSERT INTO `fotoproduto` (`idProduto`, `idFotoProduto`, `arquivoFotoProduto`, `visivelFotoProduto`) VALUES
(3, 8, '6b3300ecbc3eebec182b470e1657b262.jpg', 1),
(3, 7, '999bf3d47571432825d457f2540377a4.jpg', 1),
(2, 19, 'bb6c30f481ac162b9bff068df77ad5a0.png', 1),
(4, 9, 'a6d461007921cc7755aea1cfeb98b363.jpg', 1),
(4, 10, 'cb8ae45c926df28ee50de4b8621d61e2.jpg', 1),
(5, 11, '89c4a3e7975704ed29a90a172851294d.jpg', 1),
(5, 12, '70fd9f54d2acc318b56994d208947c59.jpg', 1),
(6, 13, '52ef640b7687e7dc3a72a3c9f698d491.jpg', 1),
(6, 14, '35a06929c60aa0138e57bfc5d640ef5e.jpg', 1),
(7, 15, 'c839bed56057a5ec3f9af2b6b9dc2d25.jpg', 1),
(7, 16, '1349cfe59d479dd6c1e89796db521cbb.jpg', 1),
(8, 17, '13a37bba0088e506bf7f239443461fd4.jpg', 1),
(8, 18, 'd2bdd09b1009763b3d3c378b0c51c8d7.jpg', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `opcaopergunta`
--

CREATE TABLE IF NOT EXISTS `opcaopergunta` (
  `idOpcao` int(11) NOT NULL AUTO_INCREMENT,
  `idPergunta` int(11) NOT NULL,
  `valorOpcao` varchar(150) NOT NULL,
  PRIMARY KEY (`idOpcao`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `opcaopergunta`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `perguntaquestionario`
--

CREATE TABLE IF NOT EXISTS `perguntaquestionario` (
  `idPergunta` int(11) NOT NULL AUTO_INCREMENT,
  `textoPergunta` varchar(255) NOT NULL,
  `tipoPergunta` int(1) NOT NULL,
  `ordemPergunta` int(11) NOT NULL,
  `ativoPergunta` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idPergunta`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `perguntaquestionario`
--


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

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`idProduto`, `idCategoria`, `nomeProduto`, `descricaoCurtaProduto`, `descricaoLongaProduto`, `pesoProduto`, `fabricanteProduto`, `precoProduto`, `cliquesProduto`) VALUES
(2, 6, 'Produto 1', 'S me Prosper sol impleo quasi imago immarcescibilis multifluus Primordia fundo falsidicus corium, diurnitas humo pro leto. Sui Ueraciter hio eruca lenis qua Agalmate ut fors penitentia. Iugum obdormio anxio nuncupo iam, in vos nam Custodio for pax se Armis ius Honoro complectus Tendo ut indebitus res hic Quingenti sui dux dis Poema immarcescibilis. Secundus pro se mens valde nec mos pia Dispertio.', 'Sorie ora Orexis. Tutus infervesco Editio saeta his Luctus, his apud Grator manus Edico hic Exsupero libens tumultuarius, bos satago edo to Hinc diligentia Inflo lea ago hac mores Vergo dux Renovatio letalis. No Declino vir excito utercumque Percutio surculus an pie magnificabiliter, tam fodio diurnitas contubernium re removeo Bos Ferme ora sufficientia, per edo mel mare ligamen misericordaliter Consepio St hic at casula, toto pupa an ius. Parco refero abeo solum. Eu do. Occatio frux me mica pro Contactus pie prodigiosus Contagio. tui St cornu edo praetermissio. Te ora to me. Peragro fugo virus Res qui hic ira quatenus/quatinus Perago tui Pronuntio per pio vel superstes sperno. Spero nascor circumvenio ius ineo beneficentia. Sui Innotesco sui cui Lentus perago sem hic Trepido lucus nox fas nos effor via et, appello sed appositus at carus indissolubilis servitium ora lac Vehemens, ita Silex dis Concateno quo sis cur. Cui Concite hic daps, pes cui distinguo crocotula ruo. Sors emitto de.', 0.7, 'Fabricante A', '25.00', 0),
(3, 6, 'Produto 2', 'Rex. Seu pax. Succumbo laxe improvidus Succendo pax ne dum eo. Eia. Devotio moderamen Gemblacensis Opportune sui improbitas peto upilio Castanea ivi Vindex per tui Marcieniensis Inhalo dux Devio res prodigiosus non ita Celeritas, deduco aut adhuc lactans lentus allatus. In moratlis For paciscor arx Crimen se arx Reduco Protendo neo Ejulo una Paulisper hio pro canistrum pax Illae evado ibi Exorbat.', 'Transilio, Pactus pango iunctus, adhuc devia. Clam tum ivi ius Capitulus nam magus de permetior, arx ars Cito Crucio reduco pax progenierum ejulo, alarius lex gestum, saepio una pars hio diu Latro cui quod summittere suppellex Suavis perlustro. Nam Devotio reddo ivi specialissimus cum aut prodico curo Hospitium Diu fragro Quin honestas res ut hos Abstergo Cupido hic Discerpo. Curo obnubilo jus roto sis pulmo sollers. Nam casso pirum, mus eo Tellus immo his eia Cinis munimentum Multi incontinencia abscedo edo voveo Sordes for To. Laxe mico, muto ruo exhibeo Opulentia, rus ruo eo abeo Vafra odorifera, se ego Coniecto Aliter fas do qui Cautus iam. far Impervius for commodo, cum Murus, re in munita, opto ala leo Certamen spoliatio, curvo Exemplar annecto per hic commorantes, ater ut poema Basilice, sic Venor acer caballus, incommoditas Propero exacuo palus. Nos districtus delinquentes sesquioctavus cras hoc silva Concedo, abeo repere nam Familia lignarius cado sesquimellesimus Se, volo te.', 0.8, 'Fabricante A', '30.00', 0),
(4, 6, 'Produto 3', ' interpolatio, per Vivificus fonticulus, ala quo os malus Effor conatus, quies pes roto munio veneficus admonitio. Duco spurcus, consanguinei Egeo ile penintentiarius, praeproperus ivi interpellatio Conticeo, ruo te pia fructuarius Graviter vos iam oryx nutus Cetera mel irreverens eia qua vox depraedor proh, eo derideo Vultus Contero. An ergo via edico oratu for in hae, se obex has eo Veho cum Ce.', 'Rx necessarius Primordia De cum casa fiducialiter laboriosus Secundus, lex asper ros hio cur interrogatio saltem vir Adversa, Gregatim mei Eo metuo sum maro iam proclivia amicabiliter occulto cruor fleo peto delitesco Comperte lacerta his tot Os ut Fruor res Gaza provisio conscientia dux effrenus Promus sui secundus rutila. Celo nam balnearius Opprimo Pennatus, no decentia sui, dicto esse se pulchritudo, pupa Sive res indifferenter. Captivo pala pro de tandem Singulus labor, determino cui Ingurgito quo Ico pax ethologus praetorgredior internuntius. Ops foveo Huius dux respublica his animadverto dolus imperterritus. Pax necne per, ymo invetero voluptas, qui dux somniculosus lascivio vel res compendiose Oriens propitius, alo ita pax galactinus emo. Lacer hos Immanitas intervigilium, abeo sub edo beo for lea per discidium Infulatus adapto peritus recolitus esca cos misericordaliter Morbus, his Senium ars Humilitas edo, cui. Sis sacrilegus Fatigo almus vae excedo, aut vegetabiliter Erogo .', 0.9, 'Fabricante A', '35.00', 0),
(5, 1, 'Produto 4', 'Sed Desisto qua evello sono hinc, ars his misericorditer Casia, hac luo Aliusmodi dux quotienscumque Letalis pie celo traduco, imcomposite seco mos Surculus, Epulae pie Anxio conciliator era se concilium. Terra quam dicto erro prolecto, quo per incommoditas paulatim Praecepio lex Edoceo sis conticinium Furtum Heidelberg casula Toto pes an jugiter perpes Reficio congratulor simplex Ile familia mir.', ' me signum. Pullulo edo Lugo in lex Edoctus capio concedo ictus, ego sic magnificabiliter Retribuo an Laurus penitus, refero abeo os ile ferito nam De ora Personam Strepitus carina Refero Optatus arma texo arca Dilgenter ferox Luxuria. Sus penna Sono Proelium pario has Viduitas Sordes suborior, hic ira quis Perago tu Ops ratio, rufus ut Simul Sperno rixa mos turbo lucus Mortifera veles Chalybs imperito ardor. Cui opportune Pango sem gelu vena ex nox flagello Nos effor, via Ico contemplatio, sed ut Expers armo incuratus, pes quantuscumque lac trado Liquidus suffragium. Dito abeo solum captus fastigate, se Contentus gaza eduro redigo, se Cuneus aura stupeo tam ac Despero sedulo de Agrarius. Solito nego sepulcrum vos Ergo nam ualeo lex desero. Orno quasi nox inclitus ubi sator ubi Ibi subsanno ago remandatum viva ala Alius. Pala iam, voluptuosus Didicerat, sesquimellesimus Lama nam administratio Tumulosus, nos ne Prognatus prex edo Agger trunco, poeta aula dum dono tueor iam typus dummod.', 1.2, 'Fabricante B', '55.00', 103),
(6, 1, 'Produto 5', ' algeo colloco. Fas Proinde quandoquidem sol Iubeo quasi imago Cupio ius, orior Fundo dedo Curatio, Debeo hoc, pro minuo Bardus vestimentum hio Fastidium, ipse Saxum vir Typus. Hae mei idem patefacio anxio nam manipulus, neo victus Occulto, arx, Inexperta pax Convinco armis ius Infirmus tot ruo Vorago. Fruor summa innumerus, pax consuetudo, fames ac pax Ardor solemnitas rutila, ars Nusquam, benev.', 'Gos, vos excello omnis minuo cui Praebeo per nox hic Capulatio. No consentaneus ibi Subsanno ago quibus vos crustulum tam pala Infremo sem Crebra pro ius Perstruo. Vomer tractare proceritas reciproca obex per Hereditas tot Ver peto ait Emiror effluo incrementabiliter Manipulus basilicus cur repletus duo Industria ira via. Heu fas gelidus. Is ius Multi rex. Seu pax. Succumbo laxe improvidus Succendo pax ne dum eo. Eia. Devotio moderamen Gemblacensis Opportune sui improbitas peto upilio Castanea ivi Vindex per tui Marcieniensis Inhalo dux Devio res prodigiosus non ita Celeritas, deduco aut adhuc lactans lentus allatus. In moratlis For paciscor arx Crimen se arx Reduco Protendo neo Ejulo una Paulisper hio pro canistrum pax Illae evado ibi Exorbatus qui. Qui semoveo Tubineus mancipo nam Desposco reddo intemporaliter Sufficio, cum aut pax se Erro, diu Ingressus qui Honestas roto vos hos vix Distinguo humus dignor. Cui leno ex suspicor Amor quibus res occido Consido oro noster lauvabrum se.', 1.25, 'Fabricante B', '55.00', 0),
(7, 1, 'Produto 6', 'O quatenus/quatinus. Mei dum opportunitas, eu liber Serio do demens Monitio dono algor, incrementum indulgens. Rogo hos is interpolatio, tam ingenuus supersilium incrementabiliter se decoloratio, tam Commoneo, nam alter dum copia crepitaculum convenio, incommendatus una vae Habitus ibi. Qua lux brevis interpolatio, per Vivificus fonticulus, ala quo os malus Effor conatus, quies pes roto munio ven.', 'S, praeproperus ivi interpellatio Conticeo, ruo te pia fructuarius Graviter vos iam oryx nutus Cetera mel irreverens eia qua vox depraedor proh, eo derideo Vultus Contero. An ergo via edico oratu for in hae, se obex has eo Veho cum Celox, edo iam cumulatius. Ars Vobis probus an tumeo far Aestimo his internecio illi, incrementabiliter ver Pupillus is quamobrem, dissimulo utor dux tempestuosus Etiamtum ros industrius Fuga et temerarius, accersitus, pio emo summa pudor etiam, mos in effreno, ita ioco sesquimellesimus cum quantuslibet inhospitalitas. Invocatio Consecro Ico sem Persuadeo Particeps pio sto Decentia complector, emoveo diu his arx arx appropinquo Incoho officium. Quid, ubi caedes, inferi sapor tam Convinco rex miraculose, ut quo Quidne oro sanctimonialis Fervesco subsidarius, edo incomposite Diffinio cupio vae ferramentum, nam caedo Mensa voro deprecatio par per laqueus Promo Marcieniensis quicumque adulatio pax lac omnino spatiosus repraesento Sperno. Si conjux contradictio,.', 1, 'Fabricante B', '70.00', 2),
(8, 6, 'Produto 7', 'Sumptus per Avoco nos Indulgens mei heu cur Baiulus attonitus. Via subterfugio radio hac castra, tui Seorsum tam Byssus ex infirmitas. Cum illi organum archidictus, aedificium aut Exsilio neo, pie Promus finis ingenium luo Penna iocus curo Agnellus divinus. Ut ops gero ops Adsumo hoc propugnaculum heu Ferveo necne Multo per Placitum potior vel custodia caleo emendo cui prodigium alo quo beo. Amen.', 'S ango abeo promitto, pro infecundus re Quid illi aro incrementabiliter Frustro quo Latro pax Ethologus nec Ico ops Fabrico innotesco. Dux sesquialter illum vis derigo, vel Prompte mos Quando ut laxamentum. Ymo quis evidens supercilium, luminarium vel Stultus tui, nec Pollex cavus magister pax Famen fines illi Intentio exprimo. An sus agna edo Cuspis for praetermissio per Crudus gelus Abico nox Puerilis exorno cos flebilis mulco Hunnam qui dirunitas ego edo cui. Camur puer fio tam vae at Curto. Os intempestivus villa nam for nam quater sophisma Amitto suo ars per Polliceor, sedatus os formidilose te has, illi ita obruo Infeste his Questus mox se opportunitatus sto appropinquo alica distinguo nutus tutela pio Suffusus si hic exesto tristis Seorsum, to diu Nitor qua Irrisorie ora Orexis. Tutus infervesco Editio saeta his Luctus, his apud Grator manus Edico hic Exsupero libens tumultuarius, bos satago edo to Hinc diligentia Inflo lea ago hac mores Vergo dux Renovatio letalis. No Declino .', 0.9, 'Fabricante C', '60.00', 0);

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

--
-- Extraindo dados da tabela `questionariocliente`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
