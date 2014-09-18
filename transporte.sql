-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de GeraÃ§Ã£o: Ago 15, 2011 as 06:37 PM
-- VersÃ£o do Servidor: 5.5.8
-- VersÃ£o do PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `transporte`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `motorista`
--

CREATE TABLE IF NOT EXISTS `motorista` (
  `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID do motorista',
  `Nome` varchar(50) DEFAULT NULL COMMENT 'Nome do motorista',
  `Telefone` int(11) DEFAULT NULL COMMENT 'Telefone do motorista',
  `Endereco` varchar(300) DEFAULT NULL COMMENT 'Endereço do motorista',
  `CnhNumero` int(11) DEFAULT NULL COMMENT 'Número da carteira de habilitação',
  `CnhCategoria` varchar(10) DEFAULT NULL COMMENT 'Categoria da Carteira de Haibilitação',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Cadastro de viagens' AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `motorista`
--

INSERT INTO `motorista` (`ID`, `Nome`, `Telefone`, `Endereco`, `CnhNumero`, `CnhCategoria`) VALUES
(1, 'Paulinho', 33511234, 'EndereÃƒÂ§o', 123456789, 'B'),
(2, 'Beltrano', 3351, 'EndereÃƒÂ§o', 9876754, 'C');

-- --------------------------------------------------------

--
-- Estrutura da tabela `revisao`
--

CREATE TABLE IF NOT EXISTS `revisao` (
  `Veiculo_ID` int(11) NOT NULL COMMENT 'ID do veículo',
  `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID da revisão',
  `Data` date DEFAULT NULL COMMENT 'Data em que foi feita a revisão',
  `Quilometragem` int(11) DEFAULT NULL COMMENT 'Quilometragem no momento da revisão',
  `Descricao` text COMMENT 'Detalhes sobre a revisão',
  PRIMARY KEY (`ID`),
  KEY `FK_VeiculoRevisao` (`Veiculo_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Controle de revisões' AUTO_INCREMENT=10 ;

--
-- Extraindo dados da tabela `revisao`
--

INSERT INTO `revisao` (`Veiculo_ID`, `ID`, `Data`, `Quilometragem`, `Descricao`) VALUES
(1, 5, '2011-07-02', 500, ''),
(1, 6, '2011-06-03', 100, ''),
(1, 9, '2011-07-17', 600, '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `ID` varchar(50) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Tipo` smallint(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`ID`, `Nome`, `Tipo`) VALUES
('1712201', 'Cicrano', 1),
('1671212', 'Beltrano', 0),
('123456', 'Cicrano Beltrano', 1),
('654321', 'Fulano Beltrano', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `veiculo`
--

CREATE TABLE IF NOT EXISTS `veiculo` (
  `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID do veículo',
  `Tipo` varchar(50) DEFAULT NULL COMMENT 'Tipo do Veículo',
  `Placa` varchar(10) DEFAULT NULL COMMENT 'Placa do veículo',
  `Categoria` varchar(2) DEFAULT NULL COMMENT 'Categoria do veículo',
  `QtdPessoas` int(11) DEFAULT NULL COMMENT 'Quantidade máxima de pessoas que o veículo pode transportar',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Cadastro de Veículos' AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `veiculo`
--

INSERT INTO `veiculo` (`ID`, `Tipo`, `Placa`, `Categoria`, `QtdPessoas`) VALUES
(1, 'Micro-onibus', 'ABC1234', 'C', 30),
(2, 'Onibus', 'DEF-5678', 'C', 40),
(3, 'Ranger', 'GHI-7890', 'B', 5),
(4, 'Sedan', 'JKL-0987', 'B', 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `viagem`
--

CREATE TABLE IF NOT EXISTS `viagem` (
  `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID da viagem',
  `Data` datetime NOT NULL,
  `Veiculo_ID` int(11) DEFAULT NULL COMMENT 'ID do veículo',
  `Motorista_ID` int(11) DEFAULT NULL COMMENT 'ID do motorista',
  `Usuario_ID` int(11) NOT NULL COMMENT 'IFRN-ID do usuário',
  `Destino` varchar(250) NOT NULL COMMENT 'Destino da viagem',
  `QtdPessoas` int(11) NOT NULL COMMENT 'Quantidade de pessoas',
  `Saida` date NOT NULL COMMENT 'Data e Hora de sa',
  `Chegada` date NOT NULL COMMENT 'Data e Hora de chegada',
  `Motivo` text,
  `Situacao` int(11) NOT NULL DEFAULT '0' COMMENT 'Situação atual da viagem',
  `KmSaida` int(11) DEFAULT NULL COMMENT 'Quilometragem do veículo na saída',
  `KmChegada` int(11) DEFAULT NULL COMMENT 'Quilometragem do veículo na chegada',
  `Abastecido` int(11) DEFAULT NULL COMMENT 'Quantidade de combustível abastecida durante a viagem',
  PRIMARY KEY (`ID`),
  KEY `FK_ViagemMotorista` (`Motorista_ID`),
  KEY `FK_ViagemUsuario` (`Usuario_ID`),
  KEY `FK_ViagemVeiculo` (`Veiculo_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='Controle de viagens' AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `viagem`
--

INSERT INTO `viagem` (`ID`, `Data`, `Veiculo_ID`, `Motorista_ID`, `Usuario_ID`, `Destino`, `QtdPessoas`, `Saida`, `Chegada`, `Motivo`, `Situacao`, `KmSaida`, `KmChegada`, `Abastecido`) VALUES
(1, '2011-07-16 21:38:15', 3, 2, 1712201, 'Campus Central', 2, '2011-08-01', '2011-08-03', 'Qualquer', 1, NULL, NULL, NULL),
(3, '2011-07-17 14:02:46', 0, 0, 1671212, 'Qualquer', 20, '2011-07-17', '2011-07-20', 'Nenhum', 0, NULL, NULL, NULL),
(4, '2011-07-17 14:46:29', 4, 1, 1671212, 'Natal', 5, '2011-07-19', '2011-07-19', 'Nenhum', 4, NULL, NULL, NULL),
(7, '2011-08-04 09:24:34', 0, 0, 654321, 'Natal', 3, '2011-08-04', '2011-08-04', 'ReuniÃƒÂ£o', 2, NULL, NULL, NULL);
