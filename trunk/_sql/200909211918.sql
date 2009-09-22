/*
Created		28/8/2009
Modified		21/9/2009
Project		
Model		
Company		
Author		
Version		
Database		mySQL 5 
*/


Create table Cliente (
	idCliente Int NOT NULL AUTO_INCREMENT,
	tipoCliente Int NOT NULL,
	emailCliente Varchar(150) NOT NULL,
	senhaCliente Char(32) NOT NULL,
	telefoneCliente Int,
	celularCliente Int,
	chamadoCliente Varchar(45) NOT NULL,
	newsletterCliente Int NOT NULL,
 Primary Key (idCliente)) ENGINE = MyISAM;

Create table ClienteFisico (
	idCliente Int NOT NULL,
	nomeCliente Varchar(150) NOT NULL,
	cpfCliente Int NOT NULL,
	sexoCliente Char(1) NOT NULL,
	nascimentoCliente Date NOT NULL,
 Primary Key (idCliente)) ENGINE = MyISAM;

Create table ClienteJuridico (
	idCliente Int NOT NULL,
	razaoSocialCliente Varchar(150) NOT NULL,
	cnpjCliente Varchar(14) NOT NULL,
	inscricaoEstadualCliente Varchar(45) NOT NULL,
	responsavelCliente Varchar(150) NOT NULL,
 Primary Key (idCliente)) ENGINE = MyISAM;

Create table Endereco (
	idCliente Int NOT NULL,
	idEndereco Int NOT NULL AUTO_INCREMENT,
	tipoEndereco Int NOT NULL,
	ruaEndereco Varchar(150) NOT NULL,
	numeroEndereco Varchar(10) NOT NULL,
	complementoEndereco Varchar(10) NOT NULL,
	bairroEndereco Varchar(45) NOT NULL,
	cepEndereco Char(8) NOT NULL,
	cidadeEndereco Varchar(150) NOT NULL,
	estadoEndereco Char(2) NOT NULL,
 Primary Key (idCliente,idEndereco)) ENGINE = MyISAM;

Create table CategoriaProduto (
	idCategoria Int NOT NULL AUTO_INCREMENT,
	nomeCategoria Varchar(45) NOT NULL,
	descricaoCategoria Varchar(255) NOT NULL,
	visivelCategoria Int NOT NULL,
 Primary Key (idCategoria)) ENGINE = MyISAM;

Create table Produto (
	idCategoria Int NOT NULL,
	idProduto Int NOT NULL AUTO_INCREMENT,
	nomeProduto Varchar(45) NOT NULL,
	descricaoCurtaProduto Text NOT NULL,
	descricaoLongaProduto Text NOT NULL,
	pesoProduto Float NOT NULL,
	fabricanteProduto Varchar(255) NOT NULL,
	precoProduto Decimal(10,2) NOT NULL,
 Primary Key (idCategoria)) ENGINE = MyISAM;

Create table FotoProduto (
	idCategoria Int NOT NULL,
	idFotoProduto Int NOT NULL AUTO_INCREMENT,
	arquivoFotoProduto Varchar(45) NOT NULL,
	visivelFotoProduto Int NOT NULL,
 Primary Key (idCategoria)) ENGINE = MyISAM;

Create table QuestionarioCliente (
	idCliente Int NOT NULL,
	idPergunta Int NOT NULL,
	respostaPergunta Text NOT NULL,
 Primary Key (idCliente,idPergunta)) ENGINE = MyISAM;

Create table ComentarioProduto (
	idCliente Int NOT NULL,
	idCategoria Int NOT NULL,
	dataComentario Datetime NOT NULL,
	aprovadoComentario Int NOT NULL DEFAULT 0,
	textoComentario Text NOT NULL,
 Primary Key (idCliente,idCategoria)) ENGINE = MyISAM;

Create table BonusCliente (
	idCliente Int NOT NULL,
	idBonus Int NOT NULL AUTO_INCREMENT,
	valorBonus Decimal(10,2) NOT NULL,
	origemBonus Varchar(150) NOT NULL,
	dataBonus Datetime NOT NULL,
 Primary Key (idCliente,idBonus)) ENGINE = MyISAM;

Create table PerguntaQuestionario (
	idPergunta Int NOT NULL,
	textoPergunta Varchar(255) NOT NULL,
	tipoPergunta Int NOT NULL,
	ativoPergunta Int NOT NULL DEFAULT 1,
	ordemPergunta Int NOT NULL,
 Primary Key (idPergunta)) ENGINE = MyISAM;

Create table OpcaoPergunta (
	idOpcao Int NOT NULL AUTO_INCREMENT,
	idPergunta Int NOT NULL,
	valorOpcao Varchar(150) NOT NULL,
 Primary Key (idOpcao,idPergunta)) ENGINE = MyISAM;

Create table Pedido (
	idPedido Int NOT NULL AUTO_INCREMENT,
	idCupom Int NOT NULL,
	idCliente Int NOT NULL,
	idEndereco Int NOT NULL,
	dataPedido Datetime NOT NULL,
	valorEntrega Decimal(10,2) NOT NULL,
 Primary Key (idPedido,idCliente,idEndereco)) ENGINE = MyISAM;

Create table PedidoItem (
	idCliente Int NOT NULL,
	idEndereco Int NOT NULL,
	idCategoria Int NOT NULL,
	idPedido Int NOT NULL,
	quantidadePedidoItem Int NOT NULL,
	valorPedidoItem Decimal(10,2) NOT NULL,
 Primary Key (idCliente,idEndereco,idCategoria,idPedido)) ENGINE = MyISAM;

Create table Cupom (
	idCupom Int NOT NULL AUTO_INCREMENT,
	chaveCupom Varchar(45) NOT NULL,
	valorCupom Decimal(10,2) NOT NULL,
	tipoCupom Int NOT NULL,
	usoUnicoCupom Int NOT NULL,
	restritoCupom Int NOT NULL,
 Primary Key (idCupom)) ENGINE = MyISAM;

Create table ClienteCupom (
	idCliente Int NOT NULL,
	idCupom Int NOT NULL,
 Primary Key (idCliente,idCupom)) ENGINE = MyISAM;


Alter table ClienteFisico add Foreign Key (idCliente) references Cliente (idCliente) on delete  restrict on update  restrict;
Alter table ClienteJuridico add Foreign Key (idCliente) references Cliente (idCliente) on delete  restrict on update  restrict;
Alter table Endereco add Foreign Key (idCliente) references Cliente (idCliente) on delete  restrict on update  restrict;
Alter table ComentarioProduto add Foreign Key (idCliente) references Cliente (idCliente) on delete  restrict on update  restrict;
Alter table QuestionarioCliente add Foreign Key (idCliente) references Cliente (idCliente) on delete  restrict on update  restrict;
Alter table BonusCliente add Foreign Key (idCliente) references Cliente (idCliente) on delete  restrict on update  restrict;
Alter table ClienteCupom add Foreign Key (idCliente) references Cliente (idCliente) on delete  restrict on update  restrict;
Alter table Pedido add Foreign Key (idCliente,idEndereco) references Endereco (idCliente,idEndereco) on delete  restrict on update  restrict;
Alter table Produto add Foreign Key (idCategoria) references CategoriaProduto (idCategoria) on delete  restrict on update  restrict;
Alter table FotoProduto add Foreign Key (idCategoria) references Produto (idCategoria) on delete  restrict on update  restrict;
Alter table ComentarioProduto add Foreign Key (idCategoria) references Produto (idCategoria) on delete  restrict on update  restrict;
Alter table PedidoItem add Foreign Key (idCategoria) references Produto (idCategoria) on delete  restrict on update  restrict;
Alter table QuestionarioCliente add Foreign Key (idPergunta) references PerguntaQuestionario (idPergunta) on delete  restrict on update  restrict;
Alter table OpcaoPergunta add Foreign Key (idPergunta) references PerguntaQuestionario (idPergunta) on delete  restrict on update  restrict;
Alter table PedidoItem add Foreign Key (idPedido,idCliente,idEndereco) references Pedido (idPedido,idCliente,idEndereco) on delete  restrict on update  restrict;
Alter table ClienteCupom add Foreign Key (idCupom) references Cupom (idCupom) on delete  restrict on update  restrict;
Alter table Pedido add Foreign Key (idCupom) references Cupom (idCupom) on delete  restrict on update  restrict;


