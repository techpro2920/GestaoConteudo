CREATE DATABASE `postagem` /*!40100 DEFAULT CHARACTER SET latin1 COLLATE latin1_bin */;

CREATE TABLE `tab_postagem` (
  `cod_postagem` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `des_titulo` varchar(200) COLLATE latin1_bin NOT NULL,
  `des_conteudo` text COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`cod_postagem`),
  UNIQUE KEY `cod_postagem_UNIQUE` (`cod_postagem`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

CREATE TABLE `tab_comentario` (
  `cod_comentario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `des_nome` varchar(200) COLLATE latin1_bin NOT NULL,
  `des_mensagem` text COLLATE latin1_bin NOT NULL,
  `cod_postagem` int(10) unsigned NOT NULL,
  PRIMARY KEY (`cod_comentario`),
  UNIQUE KEY `cod_comentario_UNIQUE` (`cod_comentario`),
  KEY `cod_postagem_idx` (`cod_postagem`),
  CONSTRAINT `cod_postagem` FOREIGN KEY (`cod_postagem`) REFERENCES `tab_postagem` (`cod_postagem`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_bin;
