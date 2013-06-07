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
  `data_consulta` date NOT NULL,
  `horario_consulta` varchar(5) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `id_dependente` int(11) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cliente` (`id_cliente`),
  KEY `id_dependente` (`id_dependente`),
  CONSTRAINT `agendamento_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`),
  CONSTRAINT `agendamento_ibfk_2` FOREIGN KEY (`id_dependente`) REFERENCES `dependente` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

/*
Table data for otica_pan.agendamento
*/

INSERT INTO `agendamento` VALUES 
('2013-04-24','08:00',1,8,NULL,'Faltou'),
('2013-04-24','08:30',3,8,1,'Faltou'),
('2013-04-30','08:00',4,8,NULL,'Faltou'),
('2013-04-29','10:00',6,8,1,'Faltou'),
('2013-04-30','09:00',8,200,NULL,'Faltou'),
('2013-04-30','18:00',9,200,NULL,'Faltou'),
('2013-04-29','08:00',10,204,NULL,'Faltou'),
('2013-04-29','18:00',11,212,NULL,'Faltou'),
('2013-04-29','09:00',12,203,NULL,'Faltou'),
('2013-05-24','08:00',13,203,NULL,'Pendente'),
('2013-05-24','18:00',14,207,NULL,'Pendente'),
('2013-05-02','08:00',15,8,2,'Faltou'),
('2013-05-01','16:00',16,8,NULL,'Faltou'),
('2013-05-09','08:00',17,8,2,'Pendente'),
('2013-05-09','09:00',18,8,NULL,'Pendente'),
('2013-05-06','13:00',20,8,2,'Faltou'),
('2013-05-05','20:00',21,603,NULL,'Faltou'),
('2013-05-20','08:00',22,603,NULL,'Pendente'),
('2013-05-20','17:31',23,204,NULL,'Pendente'),
('2013-05-25','08:00',24,200,NULL,'Pendente'),
('2013-05-31','08:00',25,200,NULL,'Pendente'),
('2013-05-31','19:30',26,200,NULL,'Pendente'),
('2013-05-06','11:00',27,204,NULL,'Faltou'),
('2013-05-06','14:00',28,204,NULL,'Faltou'),
('2013-05-06','10:20',29,282,NULL,'Faltou'),
('2013-05-06','16:00',30,212,NULL,'Faltou'),
('2013-05-06','17:30',31,512,NULL,'Pendente'),
('2013-05-07','08:00',32,8,NULL,'Pendente'),
('2013-05-07','09:00',33,8,1,'Pendente'),
('2013-05-07','08:30',34,200,NULL,'Pendente');

/*
Table structure for armacao
*/

drop table if exists `armacao`;
CREATE TABLE `armacao` (
  `largura_lente` int(11) DEFAULT NULL,
  `largura_ponte` int(11) DEFAULT NULL,
  `comprimento_haste` int(11) DEFAULT NULL,
  `modelo` varchar(20) DEFAULT NULL,
  `id_fornecedor` int(11) DEFAULT NULL,
  `id_produto` int(11) NOT NULL,
  `id_grife` int(11) DEFAULT NULL,
  KEY `id_produto` (`id_produto`),
  KEY `id_fornecedor` (`id_fornecedor`),
  KEY `id_grife` (`id_grife`),
  CONSTRAINT `armacao_ibfk_1` FOREIGN KEY (`id_fornecedor`) REFERENCES `fornecedor` (`id`),
  CONSTRAINT `armacao_ibfk_2` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id`),
  CONSTRAINT `armacao_ibfk_3` FOREIGN KEY (`id_grife`) REFERENCES `grife` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
Table structure for cheque
*/

drop table if exists `cheque`;
CREATE TABLE `cheque` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` date NOT NULL,
  `valor` double NOT NULL,
  `id_venda` int(11) NOT NULL,
  `descricao` text,
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_venda` (`id_venda`),
  CONSTRAINT `cheque_ibfk_1` FOREIGN KEY (`id_venda`) REFERENCES `venda` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
Table structure for cliente
*/

drop table if exists `cliente`;
CREATE TABLE `cliente` (
  `cpf` varchar(15) NOT NULL,
  `data_nascimento` date DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pessoa` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pessoa` (`id_pessoa`),
  CONSTRAINT `cliente_ibfk_2` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoa` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=605 DEFAULT CHARSET=utf8;

/*
Table data for otica_pan.cliente
*/

INSERT INTO `cliente` VALUES 
('391.603.218-65','1990-01-13',8,10),
('391.505.488-75','1993-06-28',9,11),
('406.762.338-05','1992-01-06',10,18),
('125.602.153-90','2013-04-21',11,19),
('990.000.711-51','1960-03-22',200,24262),
('990.001.831-11','1959-05-14',203,24265),
('990.000.384-56','1959-06-01',204,24266),
('990.001.393-09','1959-07-25',207,24269),
('990.001.218-68','1959-10-23',212,24274),
('990.000.718-28','1960-02-08',218,24280),
('990.001.328-00','1960-05-08',223,24285),
('990.001.432-41','1960-07-01',226,24288),
('990.000.302-00','1960-09-11',230,24292),
('990.000.109-50','1961-02-02',238,24300),
('990.000.685-25','1961-07-14',247,24309),
('990.000.952-55','1961-08-01',248,24310),
('990.001.549-52','1961-08-19',249,24311),
('990.001.048-58','1961-09-06',250,24312),
('990.000.818-90','1961-10-12',252,24314),
('990.001.012-47','1961-10-30',253,24315),
('990.000.430-26','1961-12-05',255,24317),
('990.000.515-50','1961-12-23',256,24318),
('990.002.005-71','1962-01-10',257,24319),
('990.001.535-57','1962-03-05',260,24322),
('990.000.019-60','1962-03-23',261,24323),
('990.000.036-60','1962-04-28',263,24325),
('990.000.099-44','1962-06-21',266,24328),
('990.000.177-00','1962-08-14',269,24331),
('990.000.388-80','1962-09-01',270,24332),
('990.001.366-28','1962-11-30',275,24337),
('990.001.347-65','1963-01-05',277,24339),
('990.002.085-56','1963-01-23',278,24340),
('990.000.362-40','1963-02-10',279,24341),
('990.001.970-90','1963-04-05',282,24344),
('990.001.969-57','1963-04-23',283,24345),
('990.002.118-59','1963-05-29',285,24347),
('990.000.230-09','1963-06-16',286,24348),
('990.002.136-30','1963-08-09',289,24351),
('990.000.216-42','1963-08-27',290,24352),
('990.000.258-00','1963-09-14',291,24353),
('990.001.247-00','1963-10-02',292,24354),
('990.000.722-04','1963-11-25',295,24357),
('990.001.242-98','1964-01-18',298,24360),
('990.000.041-28','1964-02-05',299,24361),
('990.002.051-07','1964-02-23',300,24362),
('990.001.216-04','1964-03-12',301,24363),
('990.000.335-78','1964-03-30',302,24364),
('990.000.725-57','1964-04-17',303,24365),
('990.001.314-05','1964-05-05',304,24366),
('990.000.392-66','1964-05-23',305,24367),
('990.000.142-71','1964-08-03',309,24371),
('990.001.703-03','1964-08-21',310,24372),
('990.000.011-02','1964-09-26',312,24374),
('990.001.281-02','1964-10-14',313,24375),
('990.001.971-71','1964-11-01',314,24376),
('990.000.726-38','1964-11-19',315,24377),
('990.001.003-56','1964-12-07',316,24378),
('990.001.331-06','1964-12-25',317,24379),
('990.000.724-76','1965-01-12',318,24380),
('990.000.848-06','1965-03-07',321,24383),
('990.001.700-52','1965-03-25',322,24384),
('990.000.013-74','1965-04-30',324,24386),
('990.000.727-19','1965-05-18',325,24387),
('990.000.393-47','1965-06-05',326,24388),
('990.001.925-36','1965-06-23',327,24389),
('990.000.012-93','1965-07-11',328,24390),
('990.001.836-26','1965-07-29',329,24391),
('990.001.433-22','1965-09-03',331,24393),
('990.001.630-05','1965-09-21',332,24394),
('990.000.259-82','1965-10-09',333,24395),
('990.001.434-03','1965-12-02',336,24398),
('990.001.631-96','1965-12-20',337,24399),
('990.000.730-14','1966-03-02',341,24403),
('990.002.134-79','1966-04-07',343,24405),
('990.000.395-09','1966-04-25',344,24406),
('990.001.772-27','1966-05-13',345,24407),
('990.000.732-86','1966-05-31',346,24408),
('990.000.735-29','1966-07-06',348,24410),
('990.000.729-80','1966-07-24',349,24411),
('990.000.734-48','1966-08-11',350,24412),
('990.000.595-34','1966-08-29',351,24413),
('990.001.706-48','1966-09-16',352,24414),
('990.001.839-79','1966-11-27',356,24418),
('990.001.838-98','1966-12-15',357,24419),
('990.000.396-90','1967-02-07',360,24422),
('990.001.249-64','1967-03-15',362,24424),
('990.000.260-16','1967-04-02',363,24425),
('990.001.801-04','1967-04-20',364,24426),
('990.001.632-77','1967-05-08',365,24427),
('990.000.398-51','1967-05-26',366,24428),
('990.000.599-68','1967-06-13',367,24429),
('990.000.739-52','1967-07-01',368,24430),
('990.000.741-77','1967-09-29',373,24435),
('990.001.972-52','1967-11-04',375,24437),
('990.000.176-10','1967-12-28',378,24440),
('990.000.267-92','1968-01-15',379,24441),
('990.000.737-90','1968-02-02',380,24442),
('990.001.368-90','1968-02-20',381,24443),
('990.001.707-29','1968-03-09',382,24444),
('990.001.204-62','1968-03-27',383,24445),
('990.000.401-91','1968-06-07',387,24449),
('990.001.250-06','1968-06-25',388,24450),
('990.001.708-00','1968-07-13',389,24451),
('990.000.743-39','1968-08-18',391,24453),
('990.000.745-09','1968-09-05',392,24454),
('990.000.748-43','1968-09-23',393,24455),
('990.000.747-62','1968-10-11',394,24456),
('990.001.709-90','1968-10-29',395,24457),
('990.000.757-34','1968-12-22',398,24460),
('990.000.369-17','1969-01-09',399,24461),
('990.001.773-08','1969-03-22',403,24465),
('990.000.600-36','1969-04-27',405,24467),
('990.001.367-09','1969-05-15',406,24468),
('990.000.756-53','1969-06-02',407,24469),
('990.001.372-76','1969-10-06',414,24476),
('990.000.215-61','1969-11-11',416,24478),
('990.000.761-10','1969-11-29',417,24479),
('990.000.759-04','1969-12-17',418,24480),
('990.001.776-50','1970-01-04',419,24481),
('990.000.760-30','1970-01-22',420,24482),
('990.000.511-26','1970-03-17',423,24485),
('990.001.634-39','1970-04-04',424,24486),
('990.000.405-15','1970-05-28',427,24489),
('990.000.143-52','1970-11-06',436,24498),
('990.001.842-74','1970-11-24',437,24499),
('990.000.767-06','1970-12-30',439,24501),
('990.001.635-10','1971-03-12',443,24505),
('990.000.017-06','1971-04-17',445,24507),
('990.000.679-87','1971-06-10',448,24510),
('990.000.409-49','1971-06-28',449,24511),
('990.000.769-78','1971-07-16',450,24512),
('990.000.603-89','1971-08-03',451,24513),
('990.000.410-82','1971-08-21',452,24514),
('990.000.770-01','1971-09-26',454,24516),
('990.000.411-63','1971-10-14',455,24517),
('990.000.412-44','1971-11-19',457,24519),
('990.001.636-09','1971-12-07',458,24520),
('990.001.251-89','1972-01-12',460,24522),
('990.000.186-92','1972-01-30',461,24523),
('990.000.185-01','1972-05-17',467,24529),
('990.001.398-05','1972-06-04',468,24530),
('990.000.774-35','1972-06-22',469,24531),
('990.000.750-68','1972-07-10',470,24532),
('990.001.664-54','1972-10-26',476,24538),
('990.000.514-79','1972-12-01',478,24540),
('990.001.253-40','1973-02-11',482,24544),
('990.000.776-05','1973-03-01',483,24545),
('990.000.145-14','1973-04-24',486,24548),
('990.001.777-31','1973-05-12',487,24549),
('990.000.161-34','1973-05-30',488,24550),
('990.001.778-12','1973-06-17',489,24551),
('990.000.309-86','1973-07-05',490,24552),
('990.001.843-55','1973-07-23',491,24553),
('990.000.778-69','1973-08-10',492,24554),
('990.001.212-72','1973-08-28',493,24555),
('990.000.780-83','1973-09-15',494,24556),
('990.000.781-64','1973-10-03',495,24557),
('990.001.283-66','1973-11-26',498,24560),
('990.000.775-16','1974-01-01',500,24562),
('990.001.169-45','1974-01-19',501,24563),
('990.000.014-55','1974-03-14',504,24566),
('990.000.543-03','1974-05-25',508,24570),
('990.000.407-87','1974-06-30',510,24572),
('990.001.841-93','1974-07-18',511,24573),
('990.001.714-58','1974-08-05',512,24574),
('990.000.286-55','1974-08-23',513,24575),
('990.001.975-03','1974-09-10',514,24576),
('990.000.604-60','1974-09-28',515,24577),
('990.000.147-86','1974-11-03',517,24579),
('990.000.789-11','1974-12-27',520,24582),
('990.001.845-17','1975-01-14',521,24583),
('990.001.284-47','1975-02-01',522,24584),
('990.000.187-73','1975-03-27',525,24587),
('990.000.605-40','1975-05-02',527,24589),
('990.001.779-01','1975-05-20',528,24590),
('990.001.442-13','1975-06-25',530,24592),
('990.001.354-94','1975-07-13',531,24593),
('990.001.221-63','1975-07-31',532,24594),
('990.000.790-55','1975-08-18',533,24595),
('990.001.254-21','1975-09-23',535,24597),
('990.002.098-70','1975-10-11',536,24598),
('990.000.021-84','1976-01-09',541,24603),
('990.000.794-89','1976-01-27',542,24604),
('990.000.018-89','1976-03-21',545,24607),
('990.001.285-28','1976-04-08',546,24608),
('990.000.795-60','1976-04-26',547,24609),
('990.001.101-57','1976-07-25',552,24614),
('990.001.977-67','1976-08-30',554,24616),
('990.000.654-29','1976-09-17',555,24617),
('990.001.373-57','1976-11-10',558,24620),
('990.000.703-41','1976-11-28',559,24621),
('990.001.846-06','1976-12-16',560,24622),
('990.001.780-37','1977-02-08',563,24625),
('990.000.310-10','1977-02-26',564,24626),
('990.001.445-66','1977-04-03',566,24628),
('990.000.470-13','1977-08-25',574,24636),
('990.000.311-09','1977-09-12',575,24637),
('990.000.301-29','1977-11-23',579,24641),
('990.000.262-88','1977-12-29',581,24643),
('990.001.450-23','1978-05-22',589,24651),
('990.001.243-79','1978-08-02',593,24655),
('990.000.787-50','1978-08-20',594,24656),
('990.000.978-94','1978-09-25',596,24658),
('990.000.801-42','1978-10-13',597,24659),
('990.000.190-79','1978-10-31',598,24660),
('990.002.055-30','1978-11-18',599,24661),
('848.681.715-34','1950-10-10',600,24663),
('275.451.554-24','2013-04-28',601,24664),
('710.263.843-46','1900-10-10',602,24665),
('657.028.283-21','1992-05-18',603,24666);

/*
Table structure for consulta
*/

drop table if exists `consulta`;
CREATE TABLE `consulta` (
  `id_agendamento` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_medico` int(11) NOT NULL,
  `id_receita` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_agendamento` (`id_agendamento`),
  KEY `id_receita` (`id_receita`),
  KEY `id_medico` (`id_medico`),
  CONSTRAINT `consulta_ibfk_1` FOREIGN KEY (`id_agendamento`) REFERENCES `agendamento` (`id`),
  CONSTRAINT `consulta_ibfk_2` FOREIGN KEY (`id_receita`) REFERENCES `receita` (`id`),
  CONSTRAINT `consulta_ibfk_3` FOREIGN KEY (`id_medico`) REFERENCES `medico` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
Table structure for dependente
*/

drop table if exists `dependente`;
CREATE TABLE `dependente` (
  `data_nascimento` date DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `responsavel` varchar(20) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `dependente_ibfk_1` (`id_cliente`),
  CONSTRAINT `dependente_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*
Table data for otica_pan.dependente
*/

INSERT INTO `dependente` VALUES 
('2000-01-01','Analia Nascimento','Sobrinha',1,8),
('1991-01-01','Bruno','teste',2,8),
('2000-01-22','Julia','Irma',3,11),
('1990-01-01','Teste','teste',4,8),
('1992-01-06','Pedro','Filho',5,8),
('2000-01-01','Kauane','Noiva',7,8);

/*
Table structure for diagnostico
*/

drop table if exists `diagnostico`;
CREATE TABLE `diagnostico` (
  `cilindrico` double DEFAULT NULL,
  `dnp` double DEFAULT NULL,
  `eixo` double DEFAULT NULL,
  `esferico` double DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_receita` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_receita` (`id_receita`),
  CONSTRAINT `diagnostico_ibfk_1` FOREIGN KEY (`id_receita`) REFERENCES `receita` (`id`)
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
  `logradouro` varchar(80) DEFAULT NULL,
  `id_cliente` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cliente` (`id_cliente`),
  CONSTRAINT `endereco_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=507 DEFAULT CHARSET=utf8;

/*
Table data for otica_pan.endereco
*/

INSERT INTO `endereco` VALUES 
('Vila Carmela','07859-180','Franco da Rocha','Casa','SP',7,'Rua Guaratingueta, 70',8),
('Perdizes','04110-000','Taboão da Serra','Casa','SP',8,'Rua da Lavoura, 999',9),
('Vila da Saúde','04183-444','São Paulo','Ap. 17','SP',9,'Rua Fiação da Saúde, 580',10),
('0','0','0','0','SP',10,'0',11),
('','','','','SP',161,'',200),
('','','','','SP',163,'',203),
(NULL,NULL,NULL,NULL,NULL,164,'',204),
(NULL,NULL,NULL,NULL,NULL,167,'',207),
(NULL,NULL,NULL,NULL,NULL,170,'',212),
(NULL,NULL,NULL,NULL,NULL,174,'',218),
(NULL,NULL,NULL,NULL,NULL,177,'',223),
(NULL,NULL,NULL,NULL,NULL,180,'',226),
(NULL,NULL,NULL,NULL,NULL,184,'',230),
('','','','','AC',189,'',238),
(NULL,NULL,NULL,NULL,NULL,196,'',247),
(NULL,NULL,NULL,NULL,NULL,197,'',248),
(NULL,NULL,NULL,NULL,NULL,198,'',249),
(NULL,NULL,NULL,NULL,NULL,199,'',250),
(NULL,NULL,NULL,NULL,NULL,201,'',252),
(NULL,NULL,NULL,NULL,NULL,202,'',253),
(NULL,NULL,NULL,NULL,NULL,203,'',255),
(NULL,NULL,NULL,NULL,NULL,204,'',256),
(NULL,NULL,NULL,NULL,NULL,205,'',257),
(NULL,NULL,NULL,NULL,NULL,208,'',260),
(NULL,NULL,NULL,NULL,NULL,209,'',261),
(NULL,NULL,NULL,NULL,NULL,211,'',263),
(NULL,NULL,NULL,NULL,NULL,212,'',266),
(NULL,NULL,NULL,NULL,NULL,214,'',269),
(NULL,NULL,NULL,NULL,NULL,215,'',270),
(NULL,NULL,NULL,NULL,NULL,217,'',275),
(NULL,NULL,NULL,NULL,NULL,219,'',277),
(NULL,NULL,NULL,NULL,NULL,220,'',278),
(NULL,NULL,NULL,NULL,NULL,221,'',279),
(NULL,NULL,NULL,NULL,NULL,222,'',282),
(NULL,NULL,NULL,NULL,NULL,223,'',283),
(NULL,NULL,NULL,NULL,NULL,225,'',285),
(NULL,NULL,NULL,NULL,NULL,226,'',286),
(NULL,NULL,NULL,NULL,NULL,228,'',289),
(NULL,NULL,NULL,NULL,NULL,229,'',290),
(NULL,NULL,NULL,NULL,NULL,230,'',291),
(NULL,NULL,NULL,NULL,NULL,231,'',292),
(NULL,NULL,NULL,NULL,NULL,234,'',295),
(NULL,NULL,NULL,NULL,NULL,236,'',298),
(NULL,NULL,NULL,NULL,NULL,237,'',299),
(NULL,NULL,NULL,NULL,NULL,238,'',300),
(NULL,NULL,NULL,NULL,NULL,239,'',301),
(NULL,NULL,NULL,NULL,NULL,240,'',302),
(NULL,NULL,NULL,NULL,NULL,241,'',303),
(NULL,NULL,NULL,NULL,NULL,242,'',304),
(NULL,NULL,NULL,NULL,NULL,243,'',305),
(NULL,NULL,NULL,NULL,NULL,247,'',309),
(NULL,NULL,NULL,NULL,NULL,248,'',310),
(NULL,NULL,NULL,NULL,NULL,250,'',312),
(NULL,NULL,NULL,NULL,NULL,251,'',313),
(NULL,NULL,NULL,NULL,NULL,252,'',314),
(NULL,NULL,NULL,NULL,NULL,253,'',315),
(NULL,NULL,NULL,NULL,NULL,254,'',316),
(NULL,NULL,NULL,NULL,NULL,255,'',317),
(NULL,NULL,NULL,NULL,NULL,256,'',318),
(NULL,NULL,NULL,NULL,NULL,259,'',321),
(NULL,NULL,NULL,NULL,NULL,260,'',322),
(NULL,NULL,NULL,NULL,NULL,261,'',324),
(NULL,NULL,NULL,NULL,NULL,262,'',325),
(NULL,NULL,NULL,NULL,NULL,263,'',326),
(NULL,NULL,NULL,NULL,NULL,264,'',327),
(NULL,NULL,NULL,NULL,NULL,265,'',328),
(NULL,NULL,NULL,NULL,NULL,266,'',329),
(NULL,NULL,NULL,NULL,NULL,268,'',331),
(NULL,NULL,NULL,NULL,NULL,269,'',332),
(NULL,NULL,NULL,NULL,NULL,270,'',333),
(NULL,NULL,NULL,NULL,NULL,272,'',336),
(NULL,NULL,NULL,NULL,NULL,273,'',337),
(NULL,NULL,NULL,NULL,NULL,277,'',341),
(NULL,NULL,NULL,NULL,NULL,279,'',343),
(NULL,NULL,NULL,NULL,NULL,280,'',344),
(NULL,NULL,NULL,NULL,NULL,281,'',345),
(NULL,NULL,NULL,NULL,NULL,282,'',346),
(NULL,NULL,NULL,NULL,NULL,283,'',348),
(NULL,NULL,NULL,NULL,NULL,284,'',349),
(NULL,NULL,NULL,NULL,NULL,285,'',350),
(NULL,NULL,NULL,NULL,NULL,286,'',351),
(NULL,NULL,NULL,NULL,NULL,287,'',352),
(NULL,NULL,NULL,NULL,NULL,289,'',356),
(NULL,NULL,NULL,NULL,NULL,290,'',357),
(NULL,NULL,NULL,NULL,NULL,292,'',360),
(NULL,NULL,NULL,NULL,NULL,294,'',362),
(NULL,NULL,NULL,NULL,NULL,295,'',363),
(NULL,NULL,NULL,NULL,NULL,296,'',364),
(NULL,NULL,NULL,NULL,NULL,297,'',365),
(NULL,NULL,NULL,NULL,NULL,298,'',366),
(NULL,NULL,NULL,NULL,NULL,299,'',367),
(NULL,NULL,NULL,NULL,NULL,300,'',368),
(NULL,NULL,NULL,NULL,NULL,303,'',373),
(NULL,NULL,NULL,NULL,NULL,305,'',375),
(NULL,NULL,NULL,NULL,NULL,308,'',378),
(NULL,NULL,NULL,NULL,NULL,309,'',379),
(NULL,NULL,NULL,NULL,NULL,310,'',380),
(NULL,NULL,NULL,NULL,NULL,311,'',381),
(NULL,NULL,NULL,NULL,NULL,312,'',382),
(NULL,NULL,NULL,NULL,NULL,313,'',383),
(NULL,NULL,NULL,NULL,NULL,317,'',387),
(NULL,NULL,NULL,NULL,NULL,318,'',388),
(NULL,NULL,NULL,NULL,NULL,319,'',389),
(NULL,NULL,NULL,NULL,NULL,321,'',391),
(NULL,NULL,NULL,NULL,NULL,322,'',392),
(NULL,NULL,NULL,NULL,NULL,323,'',393),
(NULL,NULL,NULL,NULL,NULL,324,'',394),
(NULL,NULL,NULL,NULL,NULL,325,'',395),
(NULL,NULL,NULL,NULL,NULL,328,'',398),
(NULL,NULL,NULL,NULL,NULL,329,'',399),
(NULL,NULL,NULL,NULL,NULL,332,'',403),
(NULL,NULL,NULL,NULL,NULL,334,'',405),
(NULL,NULL,NULL,NULL,NULL,335,'',406),
(NULL,NULL,NULL,NULL,NULL,336,'',407),
(NULL,NULL,NULL,NULL,NULL,340,'',414),
(NULL,NULL,NULL,NULL,NULL,342,'',416),
(NULL,NULL,NULL,NULL,NULL,343,'',417),
(NULL,NULL,NULL,NULL,NULL,344,'',418),
(NULL,NULL,NULL,NULL,NULL,345,'',419),
(NULL,NULL,NULL,NULL,NULL,346,'',420),
(NULL,NULL,NULL,NULL,NULL,348,'',423),
(NULL,NULL,NULL,NULL,NULL,349,'',424),
(NULL,NULL,NULL,NULL,NULL,352,'',427),
(NULL,NULL,NULL,NULL,NULL,358,'',436),
(NULL,NULL,NULL,NULL,NULL,359,'',437),
(NULL,NULL,NULL,NULL,NULL,360,'',439),
(NULL,NULL,NULL,NULL,NULL,364,'',443),
(NULL,NULL,NULL,NULL,NULL,366,'',445),
(NULL,NULL,NULL,NULL,NULL,368,'',448),
(NULL,NULL,NULL,NULL,NULL,369,'',449),
(NULL,NULL,NULL,NULL,NULL,370,'',450),
(NULL,NULL,NULL,NULL,NULL,371,'',451),
(NULL,NULL,NULL,NULL,NULL,372,'',452),
(NULL,NULL,NULL,NULL,NULL,373,'',454),
(NULL,NULL,NULL,NULL,NULL,374,'',455),
(NULL,NULL,NULL,NULL,NULL,376,'',457),
(NULL,NULL,NULL,NULL,NULL,377,'',458),
(NULL,NULL,NULL,NULL,NULL,378,'',460),
(NULL,NULL,NULL,NULL,NULL,379,'',461),
(NULL,NULL,NULL,NULL,NULL,384,'',467),
(NULL,NULL,NULL,NULL,NULL,385,'',468),
(NULL,NULL,NULL,NULL,NULL,386,'',469),
(NULL,NULL,NULL,NULL,NULL,387,'',470),
(NULL,NULL,NULL,NULL,NULL,392,'',476),
(NULL,NULL,NULL,NULL,NULL,394,'',478),
(NULL,NULL,NULL,NULL,NULL,397,'',482),
(NULL,NULL,NULL,NULL,NULL,398,'',483),
(NULL,NULL,NULL,NULL,NULL,400,'',486),
(NULL,NULL,NULL,NULL,NULL,401,'',487),
(NULL,NULL,NULL,NULL,NULL,402,'',488),
(NULL,NULL,NULL,NULL,NULL,403,'',489),
(NULL,NULL,NULL,NULL,NULL,404,'',490),
(NULL,NULL,NULL,NULL,NULL,405,'',491),
(NULL,NULL,NULL,NULL,NULL,406,'',492),
(NULL,NULL,NULL,NULL,NULL,407,'',493),
(NULL,NULL,NULL,NULL,NULL,408,'',494),
(NULL,NULL,NULL,NULL,NULL,409,'',495),
(NULL,NULL,NULL,NULL,NULL,412,'',498),
(NULL,NULL,NULL,NULL,NULL,413,'',500),
(NULL,NULL,NULL,NULL,NULL,414,'',501),
(NULL,NULL,NULL,NULL,NULL,417,'',504),
(NULL,NULL,NULL,NULL,NULL,421,'',508),
(NULL,NULL,NULL,NULL,NULL,423,'',510),
(NULL,NULL,NULL,NULL,NULL,424,'',511),
(NULL,NULL,NULL,NULL,NULL,425,'',512),
(NULL,NULL,NULL,NULL,NULL,426,'',513),
(NULL,NULL,NULL,NULL,NULL,427,'',514),
(NULL,NULL,NULL,NULL,NULL,428,'',515),
(NULL,NULL,NULL,NULL,NULL,430,'',517),
(NULL,NULL,NULL,NULL,NULL,433,'',520),
(NULL,NULL,NULL,NULL,NULL,434,'',521),
(NULL,NULL,NULL,NULL,NULL,435,'',522),
(NULL,NULL,NULL,NULL,NULL,438,'',525),
(NULL,NULL,NULL,NULL,NULL,439,'',527),
(NULL,NULL,NULL,NULL,NULL,440,'',528),
(NULL,NULL,NULL,NULL,NULL,441,'',530),
(NULL,NULL,NULL,NULL,NULL,442,'',531),
(NULL,NULL,NULL,NULL,NULL,443,'',532),
(NULL,NULL,NULL,NULL,NULL,444,'',533),
(NULL,NULL,NULL,NULL,NULL,445,'',535),
(NULL,NULL,NULL,NULL,NULL,446,'',536),
(NULL,NULL,NULL,NULL,NULL,450,'',541),
(NULL,NULL,NULL,NULL,NULL,451,'',542),
(NULL,NULL,NULL,NULL,NULL,453,'',545),
(NULL,NULL,NULL,NULL,NULL,454,'',546),
(NULL,NULL,NULL,NULL,NULL,455,'',547),
(NULL,NULL,NULL,NULL,NULL,460,'',552),
(NULL,NULL,NULL,NULL,NULL,462,'',554),
(NULL,NULL,NULL,NULL,NULL,463,'',555),
(NULL,NULL,NULL,NULL,NULL,465,'',558),
(NULL,NULL,NULL,NULL,NULL,466,'',559),
(NULL,NULL,NULL,NULL,NULL,467,'',560),
(NULL,NULL,NULL,NULL,NULL,470,'',563),
(NULL,NULL,NULL,NULL,NULL,471,'',564),
(NULL,NULL,NULL,NULL,NULL,472,'',566),
(NULL,NULL,NULL,NULL,NULL,477,'',574),
(NULL,NULL,NULL,NULL,NULL,478,'',575),
(NULL,NULL,NULL,NULL,NULL,482,'',579),
(NULL,NULL,NULL,NULL,NULL,484,'',581),
(NULL,NULL,NULL,NULL,NULL,492,'',589),
(NULL,NULL,NULL,NULL,NULL,496,'',593),
(NULL,NULL,NULL,NULL,NULL,497,'',594),
(NULL,NULL,NULL,NULL,NULL,498,'',596),
(NULL,NULL,NULL,NULL,NULL,499,'',597),
(NULL,NULL,NULL,NULL,NULL,500,'',598),
(NULL,NULL,NULL,NULL,NULL,501,'',599),
('Vila Carmela','07859-180','São Paulo','Ap11','SP',502,'Av Paulista, 200',600),
('Vila Carmela','07859-180','Franco da Rocha','Casa','SP',503,'Rua Guaratinguetá, 70',601),
('Alencar','2','Campinas','Casa','SP',504,'Rua da Margarita, 300',602),
('Vila Clemente','33333-333','Francisco Morato','2b','SP',505,'Rua da Lavoura, 200',603);

/*
Table structure for forma_pgto
*/

drop table if exists `forma_pgto`;
CREATE TABLE `forma_pgto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*
Table data for otica_pan.forma_pgto
*/

INSERT INTO `forma_pgto` VALUES 
(1,'Á Vista'),
(2,'Cartão de Crédito'),
(3,'Cheque');

/*
Table structure for fornecedor
*/

drop table if exists `fornecedor`;
CREATE TABLE `fornecedor` (
  `cnpj` varchar(20) DEFAULT NULL,
  `id_pessoa` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `id_pessoa` (`id_pessoa`),
  CONSTRAINT `fornecedor_ibfk_1` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoa` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*
Table data for otica_pan.fornecedor
*/

INSERT INTO `fornecedor` VALUES 
('41.763.462/0001-48',12,2),
('75.315.613/0001-17',13,3),
('65.792.360/0001-19',15,5),
('42.887.546/0001-56',16,6),
('42.887.546/0001-56',17,7),
('40.068.644/0001-36',20,8);

/*
Table structure for grife
*/

drop table if exists `grife`;
CREATE TABLE `grife` (
  `nome` varchar(50) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*
Table data for otica_pan.grife
*/

INSERT INTO `grife` VALUES 
('HB',1),
('Bad Boy',2);

/*
Table structure for informacoes_olho
*/

drop table if exists `informacoes_olho`;
CREATE TABLE `informacoes_olho` (
  `distancia` varchar(20) NOT NULL,
  `lado` varchar(10) NOT NULL,
  `id_diagnostico` int(11) NOT NULL,
  KEY `id_diagnostico` (`id_diagnostico`),
  CONSTRAINT `informacoes_olho_ibfk_1` FOREIGN KEY (`id_diagnostico`) REFERENCES `diagnostico` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
Table structure for itens
*/

drop table if exists `itens`;
CREATE TABLE `itens` (
  `id_orcamento` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `preco_unitario` double NOT NULL,
  `quantidade` int(11) NOT NULL,
  KEY `id_orcamento` (`id_orcamento`),
  KEY `id_produto` (`id_produto`),
  CONSTRAINT `itens_ibfk_1` FOREIGN KEY (`id_orcamento`) REFERENCES `orcamento` (`id`),
  CONSTRAINT `itens_ibfk_2` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
Table structure for lente
*/

drop table if exists `lente`;
CREATE TABLE `lente` (
  `id_orcamento` int(11) NOT NULL,
  `referencia` varchar(20) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `preco_venda` double NOT NULL,
  KEY `id_orcamento` (`id_orcamento`),
  CONSTRAINT `lente_ibfk_1` FOREIGN KEY (`id_orcamento`) REFERENCES `orcamento` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
Table structure for medico
*/

drop table if exists `medico`;
CREATE TABLE `medico` (
  `crm` varchar(20) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `medico_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*
Table data for otica_pan.medico
*/

INSERT INTO `medico` VALUES 
('112492',1,'Adriana Vanella D Agostinho',1),
('738543',2,'Daniela Lima de Souza',6);

/*
Table structure for nivel
*/

drop table if exists `nivel`;
CREATE TABLE `nivel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(40) NOT NULL,
  `descricao` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*
Table data for otica_pan.nivel
*/

INSERT INTO `nivel` VALUES 
(1,'Administrador','Administrador do Sistema.'),
(2,'Atentende','Realiza o atendimento para a venda de produtos.'),
(3,'Oftalmologista','Médica que realiza as consultas nos clientes.');

/*
Table structure for orcamento
*/

drop table if exists `orcamento`;
CREATE TABLE `orcamento` (
  `data` date NOT NULL,
  `id_forma_pgto` int(11) NOT NULL,
  `vendedor` varchar(100) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `desconto` double NOT NULL,
  `status` tinyint(1) DEFAULT '1',
  `id_cliente` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cliente` (`id_cliente`),
  KEY `id_forma_pgto` (`id_forma_pgto`),
  CONSTRAINT `orcamento_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`),
  CONSTRAINT `orcamento_ibfk_2` FOREIGN KEY (`id_forma_pgto`) REFERENCES `forma_pgto` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
Table structure for pessoa
*/

drop table if exists `pessoa`;
CREATE TABLE `pessoa` (
  `email` varchar(100) DEFAULT NULL,
  `nome` varchar(100) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24668 DEFAULT CHARSET=utf8;

/*
Table data for otica_pan.pessoa
*/

INSERT INTO `pessoa` VALUES 
('fdias.d.neves@gmail.com','Fernando Dias Das Neves',10),
('eduardo@gmail.com','Eduardo Pereira',11),
('jose@gmail.com','José Mendes',12),
('pablo.cunha@gmail.com','Pablo Cunha',13),
('eli@aguero.com.br','Eli Aguero',15),
('kauane@lucena.com.br','Kauane Lucena',16),
('pamela.oliveira@gmail.com','Pamela Oliveira',17),
('ree@gmail.com','Renan Lopes',18),
('eduardo.pereira@gmail.com','Eduardo Pereira',19),
('lindo@ema.com','Eduardo Lindo',20),
('andre.henrique.ribeiro@gmail.com','Andre Henrique Ribeiro Pinto',24262),
('andrea_benetton@hotmail.it','Andrea Benetton',24265),
('agloriajuris@hotmail.com','Andrea da Gloria Fonseca',24266),
('ambiental@hotmail.com','Andrea Melo',24269),
('deatonel@gmail.com','Andrea Tonel',24274),
('deinha06@hotmail.com','Andreia Sabatine',24280),
('andreza.fpassos@gmail.com','Andreza ',24285),
('anneti.mota@hotmail.com','Aneti Mota Fran',24288),
('angela_grober@hotmail.com','Angela Cristina Grober',24292),
('anizio.lf58@hotmail.com','Anizio Lima Flix',24300),
('dpmjobras@hotmail.com','Antonio Carlos Ribeiro',24309),
('ac.silvestre@gmail.com','Antonio Carlos Silvestre Villar',24310),
('ac.silvestre@gmail.com','Antonio Carlos Silvestre Villar',24311),
('ac.silvestre@gmail.com','Antonio Carlos Silvestre Villar',24312),
('a.lucioneto@gmail.com','ANTONIO LUCIO NETO',24314),
('paulosilva_adv@hotmail.com','Antonio Paulo',24315),
('anylauriepereira@hotmail.com','Any Laurie Pereira',24317),
('ariane.f.santos@hotmal.com','Ariane',24318),
('aricia_roman@hotmail.com','Aricia Roman',24319),
('arlindojosescipioni@gmail.com','Arlindo Jos Scipioni',24322),
('armandodcp@globo.com','Armando Luiz do Carmo Pereira',24323),
('arthurpradonetto@gmail.com','Arthur Prado Netto',24325),
('barbarakelch@gmail.com','Barbara',24328),
('arq.bartira@gmail.com','Bartira Mendes',24331),
('bia_olicheski@hotmail.com','Beatriz',24332),
('biadv.arq@hotmail.com','Beatriz Ciampi Della Volpe',24337),
('bia_olicheski@hotmail.com','Beatriz Olicheski',24339),
('beatrizsingiengenharia@gmail.com','Beatriz Singi',24340),
('bjmedeiros@gmail.com','Belisa Jesus de Medeiros',24341),
('bem-cart67@gmail.com','Benjamin G. Celeste',24344),
('bernadetemagnani@hotmail.com','Bernadete Magnani',24345),
('blsr80@gmail.com','Bernardo Belis',24347),
('bernardo_stamm@hotmail.com','Bernardo Stamm',24348),
('biancafsignorelli@gmail.com','Bianca Feitosa Signorelli',24351),
('biasiv@hotmail.com','Bianca Sivolella',24352),
('bracarense@ufpr.br','Bracarense',24353),
('briannacb@gmail.com','Brianna Bussinger',24354),
('bruna_sliboni@hotmail.com','Bruna Liboni',24357),
('bruna.amoraes@gmail.com','Bruna Moraes',24360),
('brunaoliveiras@gmail.com','Bruna Oliveira',24361),
('brunatosetto@gmail.com','Bruna Tosetto',24362),
('brunavantin@hotmail.com','Bruna Vantin',24363),
('bruno.prozac@gmail.com','Bruno',24364),
('brunosous.arq@gmail.com','Bruno',24365),
('bruno.betel@hotmail.com','BRUNO ALEXANDRE',24366),
('brunotebr@hotmail.com','Bruno Andrade',24367),
('brunoazevedocarneiro@gmail.com','Bruno Carneiro',24371),
('brunocesarzago@hotmail.com','Bruno Cesar Zago',24372),
('bdieguez@gmail.com','Bruno Dieguez',24374),
('bdieguez@gmail.com','Bruno Dieguez',24375),
('bdieguez@gmail.com','Bruno Dieguez',24376),
('bdieguez@gmail.com','Bruno Dieguez',24377),
('bruno.fernandes@jcicom','Bruno Fernandes',24378),
('brunoferro85@gmail.com','Bruno Fernando P. Ferro',24379),
('bruno1067@hotmail.com','Bruno Freitas Faria',24380),
('sgarbi.fabat@ovi.com','Bruno Sgarbi',24383),
('blsantos@fapesp.br','Bruno Torquato dos Santos',24384),
('byrondecosta@hotmail.com','Byron Costa',24386),
('cassia_pegoraro@hotmail.com','C',24387),
('cassialeticia1@hotmail.com','C',24388),
('carcarvalho@hotmail.com','Caetano de Carvalho Rodrigues',24389),
('caiocerqueira@odebrecht.com','Caio Cerqueira',24390),
('caio_gonzaga@hotmail.com','Caio Gonzaga de Figueiredo',24391),
('caio_1979@hotmail.com','Caio Tadeu ',24393),
('pouldecarte@hotmail.com','Caleb',24394),
('camila20alves@hotmail.com','Camila Alves',24395),
('camila_costa@hotmail.com','Camila de Nobrega da Costa',24398),
('camilarodriguesarq@gmail.com','Camila F. Rodrigues',24399),
('camilamoreno.arq@gmail.com','Camila Leandro Moreno de Figueiredo',24403),
('cacantm@homail.com','Camila NTM',24405),
('camile.rio@hotmail.com','Camile Rio',24406),
('ctlabanca@gmail.com','Camille',24407),
('camilohollanda@gmail.com','Camilo Leite de Hollanda',24408),
('carina.uro@gmail.com','Carina Ur',24410),
('carinesalmeida@hotmail.com','Carine Santos',24411),
('carlacappe@hotmail.com','Carla Cappelletti Tavares Maciel',24412),
('carla.elize@gmail.com','Carla Elize',24413),
('carlagallo@gmail.com','Carla Gallo',24414),
('carla_mauro@msn.com','Carla Mauro',24418),
('carla.raissa.g@gmail.com','Carla Raissa Gottfried dos Santos',24419),
('carlospower21@gmail.com','Carlos Alberto',24422),
('carloscesarpe@hotmail.com','Carlos Cesar Torres Allende ',24424),
('cbconstrutora@hotmail.com','Carlos de Brito',24425),
('edumariano@odebrecht.com','Carlos Eduardo Fernandes Aggio',24426),
('kakobraga@hotmail.com','Carlos Eduardo Gatti Braga',24427),
('panquestorlima@hotmail.com','Carlos Eloi Panquestor Lima',24428),
('jean_oliver00@hotmail.com','Carlos Jean da Concei',24429),
('cls.arq@gmail.com','Carlos labriola Sandler',24430),
('choshii@prefeitura.sp.gov.br','Carlos Tatsuo Hoshii',24435),
('csc@cscarchitects.net','Carmem Silvia de Carvalho',24437),
('carolina.pos@gmail.com','Carolina',24440),
('carollnery@yahoo.com','Carolina',24441),
('carollsantos@gmail.com','Carolina de Lima Santos ',24442),
('carolfomin@gmail.com','Carolina Fernandes Rodrigues Fomin',24443),
('cacamarazul@gmail.com','Carolina Garrido Macedo De Araujo',24444),
('carolhammes@gmailcom','Carolina Hammes Torres',24445),
('carolufrj@gmail.com','Carolina Zanuncio Briard',24449),
('carol_bavaresco@hotmail.com','Caroline',24450),
('carollbraga@hotmail.com','Caroline Braga',24451),
('carolinequeren@hotmail.com','Caroline Queren',24453),
('carol_gcunha@hotmail.com','CAROLLYNE GON',24454),
('cassiano@serpal.com','Cassiano',24455),
('cassi_arq@hotmail.com','Cassiano Eduardo Macedo',24456),
('cassianorolim@hotmail.com','Cassiano Rolim',24457),
('celia27prado@hotmail.com','Celia Prado',24460),
('celmalopesb@hotmail.com','Celma Lopes',24461),
('charlesmafra@seduc.am.gov.br','Charles Gomes Mafra',24465),
('pozzobon.c@gmail.com','Christian Pozzobon',24467),
('chisanches@gmail.com','Christiane Ferreira Sanches',24468),
('christianesrg@yahoo.com','Christiane Regina Gomes',24469),
('gestoramatos@hotmail.com','Cintia Matos',24476),
('bovier.clara@gmail.com','Clara Bovier',24478),
('clarice.pimentel30@hotmail.com','Clarice das Gra',24479),
('clarissahc@gmail.com','Clarissa Horstmann Castilhos',24480),
('octonei@msn.com','Claudenei',24481),
('calu.bessa@gmail.com','Claudia Bessa',24482),
('queirozclaudia@hotmail.com','Claudia Ramires Queiroz',24485),
('claudiabenaim@hotmail.com','Claudia Regina',24486),
('claudio.geodesia@gmail.com','Claudio Bernardo Reis Vaz',24489),
('cleber.gurgel@sa.cushwake.com','Cleber Gurgel',24498),
('caraujo5172@gmail.com','Clebson Anselmo de Ara',24499),
('cleira.torres@hotmail.com','Cleira Torres Lizana',24501),
('cleitonlima@agronomo.eng.br','Cleiton Oliveira Lima',24505),
('clodoaldo@jurado.net.br','Clodoaldo',24507),
('cristina@provecto.arq.br','Crisitna Louvison Ribeiro Albiero Senna',24510),
('crislene.guerreiro@hotmail.com','Crislene Rolim Guerreiro ',24511),
('crisberbert@hotmail.com','Cristiana Berbert',24512),
('chrissreoa@gmail.com','Cristiane',24513),
('cris_biol@hotmail.com','Cristiane A. F. Pezenatto',24514),
('crisap.pietro@hotmail.com','Cristiane Aparecida Prieto',24516),
('crisap@hotmail.com','Cristiane Aparecida Prieto',24517),
('cristianemontenobre@hotmail.com','Cristiane Monte Nobre',24519),
('cristianeortenburger@hotmail.com','CRISTIANE ORTENBURGER',24520),
('cvitorpi@usp.br','Cristiane Vitor Pinheiro',24522),
('cristianna_tm@hotmail.com','Cristianna Tenorio Magalhaes Carnauba',24523),
('cristiano.r.brasil@gmail.com','Cristiano Rayer Brasil',24529),
('christtianno@hotmail.com','Cristiano Rodrigues ',24530),
('christtianno@hotmail.com','Cristiano Rodrigues ',24531),
('criscantergiani@gmail.com','Cristina Cantergiani',24532),
('cynthiaguazzelli@hotmail.com','Cynthia Guazzelli de Faria',24538),
('daiana.ohernandes@gmail.com','Daiana Oliveira Hernandes',24540),
('danielglhardoo@hotmail.com','Daniel',24544),
('danielcalio@gmail.com','Daniel Cali',24545),
('fornaziero.daniel@gmail.com','DANIEL FORNAZIERO',24548),
('dkeiti@gmail.com','Daniel K. Fujihara',24549),
('daniel.eqrj@gmail.com','Daniel Leal Correa',24550),
('maho.daniel@gmail.com','Daniel Mahogany',24551),
('danielmayer_vet@hotmail.com','Daniel Mayer',24552),
('daniel.geraes@gmail.com','Daniel Pena',24553),
('arquitetodamusica@hotmail.com','Daniel Rabelo',24554),
('daniel.rios.rosa@hotmail.com','Daniel Rios Rosa',24555),
('danielcamilo@gmail.com','Daniel Tadeu Camilo',24556),
('daniela.belchior@gmail.com','Daniela Belchior',24557),
('dani.matiello@gmail.com','Daniela mattiello',24560),
('danielayonemoto@hotmail.com','Daniela Yonemoto Cipriano',24562),
('daniele@alianca.eng.br','Daniele',24563),
('danialbuquerque@yahoo.com','Danieli Albuquerque',24566),
('danielle.danioli@gmail.com','Danielle Danioli',24570),
('danigbarbosa@gmail.com','Danielle G. Barbosa',24572),
('daniellemalvaris@hotmail.com','Danielle Malvaris Ribeiro',24573),
('danielle.valiatti@gmail.com','Danielle Monteiro Valiatti',24574),
('danielletardioli@hotmail.com','Danielle Tardioli',24575),
('daniellitadiolli@hotmail.com','Danielle Tardioli Miranda',24576),
('daniellitardiolli@hotmail.com','Danielle Tardiolli Miranda',24577),
('danielli.vb@gmail.com','Danielli Valentini Bragante',24579),
('danilo.matsunaga@gmail.com','Danilo Matsunaga',24582),
('profetajc@hotmail.com','Danilo Prado Macedo',24583),
('ventura.danilo@hotmail.com','Danilo Ventura',24584),
('darcleinemanarte@hotmail.com','DARCLEINE COSTA MANARTE',24587),
('daviszanotta@hotmail.com','David Zanotta',24589),
('dovaleramos@gmail.com','Davidson do Vale Ramos',24590),
('decio2208@hotmail.com','Dcio Ferreira dos Santos',24592),
('deboraffigueira@gmail.com','Debora',24593),
('debora@provecto.arq.br','Debora Colombo de Lima',24594),
('deboradesign@gmail.com','Debora Design',24595),
('decamello@gmail.com','Debora Sanchez Gomes de Mello',24597),
('deborahluga@hotmail.com','Deborah Garcia',24598),
('denishumberto@gmail.com','Denis Humberto',24603),
('denishumberto@gmail.com','Denis Humberto',24604),
('acr@acr.arq.br','Denise Santos',24607),
('dezeitune@hotmail.com','Denise Zeitune Hirchfeld',24608),
('nethi_0O@hotmail.com','Derek Augusto Vasco',24609),
('schinetski@hotmail.com','Diego Schinetski Alves',24614),
('diogocd@hotmail.com','Diogo Castro',24616),
('diokun@hotmail.com','Dion',24617),
('douglasszetta@gmail.com','Douglas Gasetta',24620),
('douglassjbarbosa@gmail.com','Douglas Jord',24621),
('douglas@marc.eng.br','Douglas Pessoa',24622),
('durvalho@gmail.com','Durvalho Costa',24625),
('ebersondavid@hotmail.com','Eberson David',24626),
('ecopazini@gmail.com','Edelcio Pazini',24628),
('ednaldo_734@hotmail.com','Ednaldo 734',24636),
('edwiw@hotmail.com','Edson Fernandes',24637),
('eduardo3302@hotmail.com','Eduardo 3302',24641),
('eduardo3302@hotmail.com','Eduardo Barbosa Costa',24643),
('edu-doc75@hotmail.com','Eduardo Hara',24651),
('eduardoluizrodrigues@hotmail.com','Eduardo Luiz Rodrigues',24655),
('eduardoc.mallmann@gmail.com','Eduardo Mallmann',24656),
('emassao@odebrecht.com','Eduardo Massao',24658),
('eduardomunhoz.castro@gmail.com','Eduardo Munhoz',24659),
('eng_nascimento@hotmail.com','Eduardo Nascimento ',24660),
('eduardolpeixoto@hotmail.com','Eduardo Peixoto',24661),
('rosinha@gmail.com','Rosarinha Dias Das Neves',24663),
('eli.souza@gmail.com','Elisangela Roberta Ferreira De Souza',24664),
('paolo@gmail.com','Paolo Guerrero',24665),
('joao@gmail.com','João Pedro',24666);

/*
Table structure for produto
*/

drop table if exists `produto`;
CREATE TABLE `produto` (
  `cod_barra` varchar(20) DEFAULT NULL,
  `nome` varchar(50) NOT NULL,
  `categoria` int(2) NOT NULL,
  `descricao` text,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `preco_custo` double DEFAULT NULL,
  `preco_venda` double DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `validade` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*
Table structure for receita
*/

drop table if exists `receita`;
CREATE TABLE `receita` (
  `crm` varchar(20) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `observacao` text,
  `dp` double DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `id_dependente` int(11) DEFAULT NULL,
  `medico` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cliente` (`id_cliente`),
  KEY `id_dependente` (`id_dependente`),
  CONSTRAINT `receita_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`),
  CONSTRAINT `receita_ibfk_2` FOREIGN KEY (`id_dependente`) REFERENCES `dependente` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
Table structure for servico
*/

drop table if exists `servico`;
CREATE TABLE `servico` (
  `id_orcamento` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `preco_venda` double NOT NULL,
  `descricao` text,
  KEY `id_orcamento` (`id_orcamento`),
  CONSTRAINT `servico_ibfk_1` FOREIGN KEY (`id_orcamento`) REFERENCES `orcamento` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
Table structure for telefone
*/

drop table if exists `telefone`;
CREATE TABLE `telefone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num_telefone` varchar(15) default NULL,
  `id_tipo_telefone` int(11) NOT NULL,
  `id_pessoa` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_tipo_telefone` (`id_tipo_telefone`),
  KEY `id_pessoa` (`id_pessoa`),
  CONSTRAINT `telefone_ibfk_1` FOREIGN KEY (`id_tipo_telefone`) REFERENCES `tipo_telefone` (`id`),
  CONSTRAINT `telefone_ibfk_2` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoa` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2699 DEFAULT CHARSET=utf8;

/*
Table data for otica_pan.telefone
*/

INSERT INTO `telefone` VALUES 
(14,'(11) 4444-7088',1,10),
(15,'(11) 9650-99747',2,10),
(16,'(11) 4811-5099',1,11),
(17,'(11) 9736-33333',2,11),
(18,'(11) 5908-4170',1,12),
(19,'(11) 7510-45749',2,12),
(20,'(11) 4144-4400',1,13),
(21,'(11) 9874-63837',2,13),
(24,'(11) 2748-3626',1,15),
(25,'(11) 9764-83284',2,15),
(26,'(11) 4376-4363',1,16),
(27,'(11) 9748-97324',2,16),
(28,'(11) 3785-4798',1,17),
(29,'(11) 9789-54984',2,17),
(30,'(11) 5748-9357',1,18),
(31,'(11) 9647-28364',2,18),
(32,'(11) 3333-3333',1,19),
(33,'(33) 3333-33333',2,19),
(34,'(11) 2333-2434',1,20),
(35,'(11) 3333-33333',2,20),
(224,'(11) 4444-8204',1,24262),
(227,'(11) 4444-8222',1,24265),
(228,'(11) 4444-8228',1,24266),
(231,'(11) 4444-8246',1,24269),
(236,'(11) 4444-8276',1,24274),
(242,'(11) 4444-8312',1,24280),
(247,'(11) 4444-8342',1,24285),
(250,'(11) 4444-8360',1,24288),
(254,'(11) 4444-8384',1,24292),
(262,'(11) 4444-8432',1,24300),
(271,'(11) 4444-8486',1,24309),
(272,'(11) 4444-8492',1,24310),
(273,'(11) 4444-8498',1,24311),
(274,'(11) 4444-8504',1,24312),
(276,'(11) 4444-8516',1,24314),
(277,'(11) 4444-8522',1,24315),
(279,'(11) 4444-8534',1,24317),
(280,'(11) 4444-8540',1,24318),
(281,'(11) 4444-8546',1,24319),
(284,'(11) 4444-8564',1,24322),
(285,'(11) 4444-8570',1,24323),
(287,'(11) 4444-8582',1,24325),
(290,'(11) 4444-8600',1,24328),
(293,'(11) 4444-8618',1,24331),
(294,'(11) 4444-8624',1,24332),
(299,'(11) 4444-8654',1,24337),
(301,'(11) 4444-8666',1,24339),
(302,'(11) 4444-8672',1,24340),
(303,'(11) 4444-8678',1,24341),
(306,'(11) 4444-8696',1,24344),
(307,'(11) 4444-8702',1,24345),
(309,'(11) 4444-8714',1,24347),
(310,'(11) 4444-8720',1,24348),
(313,'(11) 4444-8738',1,24351),
(314,'(11) 4444-8744',1,24352),
(315,'(11) 4444-8750',1,24353),
(316,'(11) 4444-8756',1,24354),
(319,'(11) 4444-8774',1,24357),
(322,'(11) 4444-8792',1,24360),
(323,'(11) 4444-8798',1,24361),
(324,'(11) 4444-8804',1,24362),
(325,'(11) 4444-8810',1,24363),
(326,'(11) 4444-8816',1,24364),
(327,'(11) 4444-8822',1,24365),
(328,'(11) 4444-8828',1,24366),
(329,'(11) 4444-8834',1,24367),
(333,'(11) 4444-8858',1,24371),
(334,'(11) 4444-8864',1,24372),
(336,'(11) 4444-8876',1,24374),
(337,'(11) 4444-8882',1,24375),
(338,'(11) 4444-8888',1,24376),
(339,'(11) 4444-8894',1,24377),
(340,'(11) 4444-8900',1,24378),
(341,'(11) 4444-8906',1,24379),
(342,'(11) 4444-8912',1,24380),
(345,'(11) 4444-8930',1,24383),
(346,'(11) 4444-8936',1,24384),
(348,'(11) 4444-8948',1,24386),
(349,'(11) 4444-8954',1,24387),
(350,'(11) 4444-8960',1,24388),
(351,'(11) 4444-8966',1,24389),
(352,'(11) 4444-8972',1,24390),
(353,'(11) 4444-8978',1,24391),
(355,'(11) 4444-8990',1,24393),
(356,'(11) 4444-8996',1,24394),
(357,'(11) 4444-9002',1,24395),
(360,'(11) 4444-9020',1,24398),
(361,'(11) 4444-9026',1,24399),
(365,'(11) 4444-9050',1,24403),
(367,'(11) 4444-9062',1,24405),
(368,'(11) 4444-9068',1,24406),
(369,'(11) 4444-9074',1,24407),
(370,'(11) 4444-9080',1,24408),
(372,'(11) 4444-9092',1,24410),
(373,'(11) 4444-9098',1,24411),
(374,'(11) 4444-9104',1,24412),
(375,'(11) 4444-9110',1,24413),
(376,'(11) 4444-9116',1,24414),
(380,'(11) 4444-9140',1,24418),
(381,'(11) 4444-9146',1,24419),
(384,'(11) 4444-9164',1,24422),
(386,'(11) 4444-9176',1,24424),
(387,'(11) 4444-9182',1,24425),
(388,'(11) 4444-9188',1,24426),
(389,'(11) 4444-9194',1,24427),
(390,'(11) 4444-9200',1,24428),
(391,'(11) 4444-9206',1,24429),
(392,'(11) 4444-9212',1,24430),
(397,'(11) 4444-9242',1,24435),
(399,'(11) 4444-9254',1,24437),
(402,'(11) 4444-9272',1,24440),
(403,'(11) 4444-9278',1,24441),
(404,'(11) 4444-9284',1,24442),
(405,'(11) 4444-9290',1,24443),
(406,'(11) 4444-9296',1,24444),
(407,'(11) 4444-9302',1,24445),
(411,'(11) 4444-9326',1,24449),
(412,'(11) 4444-9332',1,24450),
(413,'(11) 4444-9338',1,24451),
(415,'(11) 4444-9350',1,24453),
(416,'(11) 4444-9356',1,24454),
(417,'(11) 4444-9362',1,24455),
(418,'(11) 4444-9368',1,24456),
(419,'(11) 4444-9374',1,24457),
(422,'(11) 4444-9392',1,24460),
(423,'(11) 4444-9398',1,24461),
(427,'(11) 4444-9422',1,24465),
(429,'(11) 4444-9434',1,24467),
(430,'(11) 4444-9440',1,24468),
(431,'(11) 4444-9446',1,24469),
(438,'(11) 4444-9488',1,24476),
(440,'(11) 4444-9500',1,24478),
(441,'(11) 4444-9506',1,24479),
(442,'(11) 4444-9512',1,24480),
(443,'(11) 4444-9518',1,24481),
(444,'(11) 4444-9524',1,24482),
(447,'(11) 4444-9542',1,24485),
(448,'(11) 4444-9548',1,24486),
(451,'(11) 4444-9566',1,24489),
(460,'(11) 2001-9603',1,24498),
(461,'(11) 2001-9604',1,24499),
(463,'(11) 2001-9606',1,24501),
(467,'(11) 2001-9610',1,24505),
(469,'(11) 2001-0001',1,24507),
(472,'(11) 2001-0004',1,24510),
(473,'(11) 2001-0005',1,24511),
(474,'(11) 2001-0006',1,24512),
(475,'(11) 2001-0007',1,24513),
(476,'(11) 2001-0008',1,24514),
(478,'(11) 2001-0010',1,24516),
(479,'(11) 2001-0011',1,24517),
(481,'(11) 2001-0013',1,24519),
(482,'(11) 2001-0014',1,24520),
(484,'(11) 2001-0016',1,24522),
(485,'(11) 2001-0017',1,24523),
(491,'(11) 2001-0023',1,24529),
(492,'(11) 2001-0024',1,24530),
(493,'(11) 2001-0025',1,24531),
(494,'(11) 2001-0026',1,24532),
(500,'(11) 2001-0032',1,24538),
(502,'(11) 2001-0034',1,24540),
(506,'(11) 2001-0038',1,24544),
(507,'(11) 2001-0039',1,24545),
(510,'(11) 2001-0042',1,24548),
(511,'(11) 2001-0043',1,24549),
(512,'(11) 2001-0044',1,24550),
(513,'(11) 2001-0045',1,24551),
(514,'(11) 2001-0046',1,24552),
(515,'(11) 2001-0047',1,24553),
(516,'(11) 2001-0048',1,24554),
(517,'(11) 2001-0049',1,24555),
(518,'(11) 2001-0050',1,24556),
(519,'(11) 2001-0051',1,24557),
(522,'(11) 2001-0054',1,24560),
(524,'(11) 2001-0056',1,24562),
(525,'(11) 2001-0057',1,24563),
(528,'(11) 2001-0060',1,24566),
(532,'(11) 2001-0064',1,24570),
(534,'(11) 2001-0066',1,24572),
(535,'(11) 2001-0067',1,24573),
(536,'(11) 2001-0068',1,24574),
(537,'(11) 2001-0069',1,24575),
(538,'(11) 2001-0070',1,24576),
(539,'(11) 2001-0071',1,24577),
(541,'(11) 2001-0073',1,24579),
(544,'(11) 2001-0076',1,24582),
(545,'(11) 2001-0077',1,24583),
(546,'(11) 2001-0078',1,24584),
(549,'(11) 2001-0081',1,24587),
(551,'(11) 2001-0083',1,24589),
(552,'(11) 2001-0084',1,24590),
(554,'(11) 2001-0086',1,24592),
(555,'(11) 2001-0087',1,24593),
(556,'(11) 2001-0088',1,24594),
(557,'(11) 2001-0089',1,24595),
(559,'(11) 2001-0091',1,24597),
(560,'(11) 2001-0092',1,24598),
(565,'(11) 2001-0097',1,24603),
(566,'(11) 2001-0098',1,24604),
(569,'(11) 2001-0101',1,24607),
(570,'(11) 2001-0102',1,24608),
(571,'(11) 2001-0103',1,24609),
(576,'(11) 2001-0108',1,24614),
(578,'(11) 2001-0110',1,24616),
(579,'(11) 2001-0111',1,24617),
(582,'(11) 2001-0114',1,24620),
(583,'(11) 2001-0115',1,24621),
(584,'(11) 2001-0116',1,24622),
(587,'(11) 2001-0119',1,24625),
(588,'(11) 2001-0120',1,24626),
(590,'(11) 2001-0122',1,24628),
(598,'(11) 2001-0130',1,24636),
(599,'(11) 2001-0131',1,24637),
(603,'(11) 2001-0135',1,24641),
(605,'(11) 2001-0137',1,24643),
(613,'(11) 2001-0145',1,24651),
(617,'(11) 2001-0149',1,24655),
(618,'(11) 2001-0150',1,24656),
(620,'(11) 2001-0152',1,24658),
(621,'(11) 2001-0153',1,24659),
(622,'(11) 2001-0154',1,24660),
(623,'(11) 2001-0155',1,24661),
(2289,'(11) 99543-0746',2,24262),
(2292,'(11) 99543-0758',2,24265),
(2293,'(11) 99543-0762',2,24266),
(2296,'(11) 99543-0774',2,24269),
(2301,'(11) 99543-0794',2,24274),
(2307,'(11) 99543-0818',2,24280),
(2312,'(11) 99543-0838',2,24285),
(2315,'(11) 99543-0850',2,24288),
(2319,'(11) 99543-0866',2,24292),
(2327,'(11) 99543-0898',2,24300),
(2336,'(11) 99543-0934',2,24309),
(2337,'(11) 99543-0938',2,24310),
(2338,'(11) 99543-0942',2,24311),
(2339,'(11) 99543-0946',2,24312),
(2341,'(11) 99543-0954',2,24314),
(2342,'(11) 99543-0958',2,24315),
(2344,'(11) 99543-0966',2,24317),
(2345,'(11) 99543-0970',2,24318),
(2346,'(11) 99543-0974',2,24319),
(2349,'(11) 99543-0986',2,24322),
(2350,'(11) 99543-0990',2,24323),
(2352,'(11) 99543-0998',2,24325),
(2355,'(11) 99543-1010',2,24328),
(2358,'(11) 99543-1022',2,24331),
(2359,'(11) 99543-1026',2,24332),
(2364,'(11) 99543-1046',2,24337),
(2366,'(11) 99543-1054',2,24339),
(2367,'(11) 99543-1058',2,24340),
(2368,'(11) 99543-1062',2,24341),
(2371,'(11) 99543-1074',2,24344),
(2372,'(11) 99543-1078',2,24345),
(2374,'(11) 99543-1086',2,24347),
(2375,'(11) 99543-1090',2,24348),
(2378,'(11) 99543-1102',2,24351),
(2379,'(11) 99543-1106',2,24352),
(2380,'(11) 99543-1110',2,24353),
(2381,'(11) 99543-1114',2,24354),
(2384,'(11) 99543-1126',2,24357),
(2387,'(11) 99543-1138',2,24360),
(2388,'(11) 99543-1142',2,24361),
(2389,'(11) 99543-1146',2,24362),
(2390,'(11) 99543-1150',2,24363),
(2391,'(11) 99543-1154',2,24364),
(2392,'(11) 99543-1158',2,24365),
(2393,'(11) 99543-1162',2,24366),
(2394,'(11) 99543-1166',2,24367),
(2398,'(11) 99543-1182',2,24371),
(2399,'(11) 99543-1186',2,24372),
(2401,'(11) 99543-1194',2,24374),
(2402,'(11) 99543-1198',2,24375),
(2403,'(11) 99543-1202',2,24376),
(2404,'(11) 99543-1206',2,24377),
(2405,'(11) 99543-1210',2,24378),
(2406,'(11) 99543-1214',2,24379),
(2407,'(11) 99543-1218',2,24380),
(2410,'(11) 99543-1230',2,24383),
(2411,'(11) 99543-1234',2,24384),
(2413,'(11) 99543-1242',2,24386),
(2414,'(11) 99543-1246',2,24387),
(2415,'(11) 99543-1250',2,24388),
(2416,'(11) 99543-1254',2,24389),
(2417,'(11) 99543-1258',2,24390),
(2418,'(11) 99543-1262',2,24391),
(2420,'(11) 99543-1270',2,24393),
(2421,'(11) 99543-1274',2,24394),
(2422,'(11) 99543-1278',2,24395),
(2425,'(11) 99543-1290',2,24398),
(2426,'(11) 99543-1294',2,24399),
(2430,'(11) 99543-1310',2,24403),
(2432,'(11) 99543-1318',2,24405),
(2433,'(11) 99543-1322',2,24406),
(2434,'(11) 99543-1326',2,24407),
(2435,'(11) 99543-1330',2,24408),
(2437,'(11) 99543-1338',2,24410),
(2438,'(11) 99543-1342',2,24411),
(2439,'(11) 99543-1346',2,24412),
(2440,'(11) 99543-1350',2,24413),
(2441,'(11) 99543-1354',2,24414),
(2445,'(11) 99543-1370',2,24418),
(2446,'(11) 99543-1374',2,24419),
(2449,'(11) 99543-1386',2,24422),
(2451,'(11) 99543-1394',2,24424),
(2452,'(11) 99543-1398',2,24425),
(2453,'(11) 99543-1402',2,24426),
(2454,'(11) 99543-1406',2,24427),
(2455,'(11) 99543-1410',2,24428),
(2456,'(11) 99543-1414',2,24429),
(2457,'(11) 99543-1418',2,24430),
(2462,'(11) 99543-1438',2,24435),
(2464,'(11) 99543-1446',2,24437),
(2467,'(11) 99543-1458',2,24440),
(2468,'(11) 99543-1462',2,24441),
(2469,'(11) 99543-1466',2,24442),
(2470,'(11) 99543-1470',2,24443),
(2471,'(11) 99543-1474',2,24444),
(2472,'(11) 99543-1478',2,24445),
(2476,'(11) 99543-1494',2,24449),
(2477,'(11) 99543-1498',2,24450),
(2478,'(11) 99543-1502',2,24451),
(2480,'(11) 99543-1510',2,24453),
(2481,'(11) 99543-1514',2,24454),
(2482,'(11) 99543-1518',2,24455),
(2483,'(11) 99543-1522',2,24456),
(2484,'(11) 99543-1526',2,24457),
(2487,'(11) 99543-1538',2,24460),
(2488,'(11) 99543-1542',2,24461),
(2492,'(11) 99543-1558',2,24465),
(2494,'(11) 99543-1566',2,24467),
(2495,'(11) 99543-1570',2,24468),
(2496,'(11) 99543-1574',2,24469),
(2503,'(11) 99543-1602',2,24476),
(2505,'(11) 99543-1610',2,24478),
(2506,'(11) 99543-1614',2,24479),
(2507,'(11) 99543-1618',2,24480),
(2508,'(11) 99543-1622',2,24481),
(2509,'(11) 99543-1626',2,24482),
(2512,'(11) 99543-1638',2,24485),
(2513,'(11) 99543-1642',2,24486),
(2516,'(11) 99543-1654',2,24489),
(2525,'(11) 99543-1690',2,24498),
(2526,'(11) 99543-1694',2,24499),
(2528,'(11) 99543-1702',2,24501),
(2532,'(11) 99543-1718',2,24505),
(2534,'(11) 99543-1726',2,24507),
(2537,'(11) 99543-1738',2,24510),
(2538,'(11) 99543-1742',2,24511),
(2539,'(11) 99543-1746',2,24512),
(2540,'(11) 99543-1750',2,24513),
(2541,'(11) 99543-1754',2,24514),
(2543,'(11) 99543-1762',2,24516),
(2544,'(11) 99543-1766',2,24517),
(2546,'(11) 99543-1774',2,24519),
(2547,'(11) 99543-1778',2,24520),
(2549,'(11) 99543-1786',2,24522),
(2550,'(11) 99543-1790',2,24523),
(2556,'(11) 99543-1814',2,24529),
(2557,'(11) 99543-1818',2,24530),
(2558,'(11) 99543-1822',2,24531),
(2559,'(11) 99543-1826',2,24532),
(2565,'(11) 99543-1850',2,24538),
(2567,'(11) 99543-1858',2,24540),
(2571,'(11) 99543-1874',2,24544),
(2572,'(11) 99543-1878',2,24545),
(2575,'(11) 99543-1890',2,24548),
(2576,'(11) 99543-1894',2,24549),
(2577,'(11) 99543-1898',2,24550),
(2578,'(11) 99543-1902',2,24551),
(2579,'(11) 99543-1906',2,24552),
(2580,'(11) 99543-1910',2,24553),
(2581,'(11) 99543-1914',2,24554),
(2582,'(11) 99543-1918',2,24555),
(2583,'(11) 99543-1922',2,24556),
(2584,'(11) 99543-1926',2,24557),
(2587,'(11) 99543-1938',2,24560),
(2589,'(11) 99543-1946',2,24562),
(2590,'(11) 99543-1950',2,24563),
(2593,'(11) 99543-1962',2,24566),
(2597,'(11) 99543-1978',2,24570),
(2599,'(11) 99543-1986',2,24572),
(2600,'(11) 99543-1990',2,24573),
(2601,'(11) 99543-1994',2,24574),
(2602,'(11) 99543-1998',2,24575),
(2603,'(11) 99543-2002',2,24576),
(2604,'(11) 99543-2006',2,24577),
(2606,'(11) 99543-2014',2,24579),
(2609,'(11) 99543-2026',2,24582),
(2610,'(11) 99543-2030',2,24583),
(2611,'(11) 99543-2034',2,24584),
(2614,'(11) 99543-2046',2,24587),
(2616,'(11) 99543-2054',2,24589),
(2617,'(11) 99543-2058',2,24590),
(2619,'(11) 99543-2066',2,24592),
(2620,'(11) 99543-2070',2,24593),
(2621,'(11) 99543-2074',2,24594),
(2622,'(11) 99543-2078',2,24595),
(2624,'(11) 99543-2086',2,24597),
(2625,'(11) 99543-2090',2,24598),
(2630,'(11) 99543-2110',2,24603),
(2631,'(11) 99543-2114',2,24604),
(2634,'(11) 99543-2126',2,24607),
(2635,'(11) 99543-2130',2,24608),
(2636,'(11) 99543-2134',2,24609),
(2641,'(11) 99543-2154',2,24614),
(2643,'(11) 99543-2162',2,24616),
(2644,'(11) 99543-2166',2,24617),
(2647,'(11) 99543-2178',2,24620),
(2648,'(11) 99543-2182',2,24621),
(2649,'(11) 99543-2186',2,24622),
(2652,'(11) 99543-2198',2,24625),
(2653,'(11) 99543-2202',2,24626),
(2655,'(11) 99543-2210',2,24628),
(2663,'(11) 99543-2242',2,24636),
(2664,'(11) 99543-2246',2,24637),
(2668,'(11) 99543-2262',2,24641),
(2670,'(11) 99543-2270',2,24643),
(2678,'(11) 99543-2302',2,24651),
(2682,'(11) 99543-2318',2,24655),
(2683,'(11) 99543-2322',2,24656),
(2685,'(11) 99543-2330',2,24658),
(2686,'(11) 99543-2334',2,24659),
(2687,'(11) 99543-2338',2,24660),
(2688,'(11) 99543-2342',2,24661),
(2689,'(11) 4444-7088',1,24663),
(2690,'(11) 99880-4302',2,24663),
(2691,'(11) 4444-7088',1,24664),
(2692,'(11) 94200-7890',2,24664),
(2693,'(11) 5907-2727',1,24665),
(2694,'(11) 96453-8888',2,24665),
(2695,'(11) 4749-8373',1,24666),
(2696,'(11) 98373-6363',2,24666);

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
  `nome` varchar(100) NOT NULL,
  `login` varchar(20) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `lembrete_senha` varchar(200) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `id_nivel` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_nivel` (`id_nivel`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_nivel`) REFERENCES `nivel` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*
Table data for otica_pan.usuario
*/

INSERT INTO `usuario` VALUES 
(1,'Administrador','admin','admin','admin','grupoabdfr@gmail.com',1),
(2,'Eduardo Pereira','eduardo','eduardo','eduardo','eduardo.pereira2806@gmail.com',1),
(3,'Renan Lopes','renan','renan','renan','reee.lopes@gmail.com',1),
(4,'Atendente Geral','atendente','atendente','atendente','atendente@gmail.com',2),
(5,'Daniela Lima de Souza','oftalmologista','oftalmologista','oftalmologista','oftalmologista@gmail.com',3),
(6,'Fernando Neves','fernando','fernado','fernando','fdias.d.neves@gmail.com',1);

/*
Table structure for venda
*/

drop table if exists `venda`;
CREATE TABLE `venda` (
  `data` date NOT NULL,
  `horario` varchar(5) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_orcamento` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_orcamento` (`id_orcamento`),
  CONSTRAINT `venda_ibfk_1` FOREIGN KEY (`id_orcamento`) REFERENCES `orcamento` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

drop table if exists `contas_pagar`;
CREATE TABLE `contas_pagar` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `nome` varchar(50) NOT NULL,
    `descricao` text DEFAULT NULL,
    `valor` double NOT NULL,
    `data` date NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS=1;