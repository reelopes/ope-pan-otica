/* 
SQLyog v4.0
Host - localhost : Database - otica_pan
**************************************************************
Server version 5.5.16
*/

SET FOREIGN_KEY_CHECKS=0;

create database if not exists `otica_pan`;

use `otica_pan`;

/*
Table structure for agendamento
*/

drop table if exists `agendamento`;
CREATE TABLE `agendamento` (
  `data_consulta` date DEFAULT NULL,
  `horario_consulta` varchar(4) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cliente` (`id_cliente`),
  CONSTRAINT `agendamento_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
Table structure for armacao
*/

drop table if exists `armacao`;
CREATE TABLE `armacao` (
  `aro` int(11) DEFAULT NULL,
  `marca` varchar(50) DEFAULT NULL,
  `modelo` varchar(50) DEFAULT NULL,
  `preco_custo` double DEFAULT NULL,
  `id_fornecedor` int(11) DEFAULT NULL,
  `id_produto` int(11) DEFAULT NULL,
  KEY `id_produto` (`id_produto`),
  KEY `id_fornecedor` (`id_fornecedor`),
  CONSTRAINT `armacao_ibfk_1` FOREIGN KEY (`id_fornecedor`) REFERENCES `fornecedor` (`id`),
  CONSTRAINT `armacao_ibfk_2` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id`),
  CONSTRAINT `armacao_ibfk_3` FOREIGN KEY (`id_fornecedor`) REFERENCES `fornecedor` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
Table structure for catalogo_de_lentes
*/

drop table if exists `catalogo_de_lentes`;
CREATE TABLE `catalogo_de_lentes` (
  `descricao` text,
  `edicao` varchar(50) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `marca` varchar(50) DEFAULT NULL,
  `id_fornecedor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_fornecedor` (`id_fornecedor`),
  CONSTRAINT `catalogo_de_lentes_ibfk_1` FOREIGN KEY (`id_fornecedor`) REFERENCES `fornecedor` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
Table structure for cliente
*/

drop table if exists `cliente`;
CREATE TABLE `cliente` (
  `cpf` varchar(15) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pessoa` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pessoa` (`id_pessoa`),
  CONSTRAINT `cliente_ibfk_2` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoa` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*
Table data for otica_pan.cliente
*/

INSERT INTO `cliente` VALUES 
('39160321865','1990-01-13',4,4);

/*
Table structure for consulta
*/

drop table if exists `consulta`;
CREATE TABLE `consulta` (
  `id_agendamento` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_medico` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_agendamento` (`id_agendamento`),
  KEY `id_medico` (`id_medico`),
  CONSTRAINT `consulta_ibfk_1` FOREIGN KEY (`id_agendamento`) REFERENCES `agendamento` (`id`),
  CONSTRAINT `consulta_ibfk_2` FOREIGN KEY (`id_medico`) REFERENCES `medico` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
Table structure for diagnostico
*/

drop table if exists `diagnostico`;
CREATE TABLE `diagnostico` (
  `cilindrico` int(11) DEFAULT NULL,
  `dp` int(11) DEFAULT NULL,
  `eixo` int(11) DEFAULT NULL,
  `esferico` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
Table structure for endereco
*/

drop table if exists `endereco`;
CREATE TABLE `endereco` (
  `bairro` varchar(50) DEFAULT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `complemento` varchar(20) DEFAULT NULL,
  `estado` varchar(2) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logradouro` varchar(80) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cliente` (`id_cliente`),
  CONSTRAINT `endereco_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*
Table data for otica_pan.endereco
*/

INSERT INTO `endereco` VALUES 
('Vila Carmela','07859180','Franco da Rocha','Casa','SP',3,'Guaratingueta,70',4);

/*
Table structure for fornecedor
*/

drop table if exists `fornecedor`;
CREATE TABLE `fornecedor` (
  `cnpj` varchar(15) DEFAULT NULL,
  `id_pessoa` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `id_pessoa` (`id_pessoa`),
  CONSTRAINT `fornecedor_ibfk_1` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoa` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
Table structure for informacoes_olho
*/

drop table if exists `informacoes_olho`;
CREATE TABLE `informacoes_olho` (
  `distancia` varchar(20) DEFAULT NULL,
  `id_diagnostico` int(11) DEFAULT NULL,
  KEY `id_diagnostico` (`id_diagnostico`),
  CONSTRAINT `informacoes_olho_ibfk_1` FOREIGN KEY (`id_diagnostico`) REFERENCES `diagnostico` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
Table structure for lente
*/

drop table if exists `lente`;
CREATE TABLE `lente` (
  `referencia` varchar(100) DEFAULT NULL,
  `id_tipo_lente` int(11) DEFAULT NULL,
  `id_produto` int(11) DEFAULT NULL,
  KEY `id_tipo_lente` (`id_tipo_lente`),
  KEY `id_produto` (`id_produto`),
  CONSTRAINT `lente_ibfk_1` FOREIGN KEY (`id_tipo_lente`) REFERENCES `tipo_lente` (`id`),
  CONSTRAINT `lente_ibfk_2` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
Table structure for medico
*/

drop table if exists `medico`;
CREATE TABLE `medico` (
  `crm` varchar(20) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
Table structure for orcamento
*/

drop table if exists `orcamento`;
CREATE TABLE `orcamento` (
  `data` date DEFAULT NULL,
  `forma_pgto` varchar(20) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `preco_final` double DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cliente` (`id_cliente`),
  CONSTRAINT `orcamento_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
Table structure for orcamento_produto
*/

drop table if exists `orcamento_produto`;
CREATE TABLE `orcamento_produto` (
  `id_orcamento` int(11) DEFAULT NULL,
  `id_produto` int(11) DEFAULT NULL,
  KEY `id_orcamento` (`id_orcamento`),
  KEY `id_produto` (`id_produto`),
  CONSTRAINT `orcamento_produto_ibfk_1` FOREIGN KEY (`id_orcamento`) REFERENCES `orcamento` (`id`),
  CONSTRAINT `orcamento_produto_ibfk_2` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
Table structure for ordem_servico
*/

drop table if exists `ordem_servico`;
CREATE TABLE `ordem_servico` (
  `data` date DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prazo_entrega` date DEFAULT NULL,
  `id_receita` int(11) DEFAULT NULL,
  `id_orcamento` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_receita` (`id_receita`),
  KEY `id_orcamento` (`id_orcamento`),
  CONSTRAINT `ordem_servico_ibfk_1` FOREIGN KEY (`id_receita`) REFERENCES `receita` (`id`),
  CONSTRAINT `ordem_servico_ibfk_2` FOREIGN KEY (`id_orcamento`) REFERENCES `orcamento` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
Table structure for pessoa
*/

drop table if exists `pessoa`;
CREATE TABLE `pessoa` (
  `email` varchar(100) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*
Table data for otica_pan.pessoa
*/

INSERT INTO `pessoa` VALUES 
('fdias.d.neves@gmail.com','Fernando Dias Das Neves',4);

/*
Table structure for produto
*/

drop table if exists `produto`;
CREATE TABLE `produto` (
  `cod_barra` varchar(20) DEFAULT NULL,
  `data_entrega` date DEFAULT NULL,
  `descricao` text,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `preco` double DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `validade` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
Table structure for receita
*/

drop table if exists `receita`;
CREATE TABLE `receita` (
  `crm` varchar(20) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `id_diagnostico` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `medico` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_diagnostico` (`id_diagnostico`),
  CONSTRAINT `receita_ibfk_1` FOREIGN KEY (`id_diagnostico`) REFERENCES `diagnostico` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
Table structure for telefone
*/

drop table if exists `telefone`;
CREATE TABLE `telefone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num_telefone` varchar(15) NOT NULL,
  `id_tipo_telefone` int(11) DEFAULT NULL,
  `id_pessoa` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_tipo_telefone` (`id_tipo_telefone`),
  KEY `id_pessoa` (`id_pessoa`),
  CONSTRAINT `telefone_ibfk_1` FOREIGN KEY (`id_tipo_telefone`) REFERENCES `tipo_telefone` (`id`),
  CONSTRAINT `telefone_ibfk_2` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoa` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*
Table data for otica_pan.telefone
*/

INSERT INTO `telefone` VALUES 
(4,'1144447088',1,4),
(5,'11965099747',2,4);

/*
Table structure for tipo_lente
*/

drop table if exists `tipo_lente`;
CREATE TABLE `tipo_lente` (
  `descricao` text,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
Table structure for tipo_telefone
*/

drop table if exists `tipo_telefone`;
CREATE TABLE `tipo_telefone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*
Table data for otica_pan.tipo_telefone
*/

INSERT INTO `tipo_telefone` VALUES 
(1,'Fixo'),
(2,'Celular');

/*
Table structure for usuario
*/

drop table if exists `usuario`;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) DEFAULT NULL,
  `senha` varchar(20) DEFAULT NULL,
  `lembrete_senha` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS=1;

