create database mpdf;
CREATE TABLE `transacao` (
  `idTransacao` int(11) NOT NULL AUTO_INCREMENT,
  `Data` varchar(45) DEFAULT NULL,
  `Operacao` varchar(45) DEFAULT NULL,
  `Entidade` varchar(45) DEFAULT NULL,
  `Referencia` varchar(45) DEFAULT NULL,
  `Motante` varchar(45) DEFAULT NULL,
  `Descricao` varchar(45) DEFAULT NULL,
  `Transacao` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idTransacao`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1