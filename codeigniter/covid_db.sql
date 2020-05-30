-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30-Maio-2020 às 04:49
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_covid`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `alerta`
--

CREATE TABLE `alerta` (
  `idAlerta` int(11) NOT NULL,
  `idMunicipio` int(11) NOT NULL,
  `emailAlerta` varchar(150) NOT NULL,
  `dataAlerta` datetime NOT NULL,
  `tituloAlerta` varchar(100) NOT NULL,
  `conteudoAlerta` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `caso`
--

CREATE TABLE `caso` (
  `idCaso` int(11) NOT NULL,
  `idMunicipio` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `fonteCaso` varchar(150) NOT NULL,
  `dataCaso` date DEFAULT NULL,
  `suspeitosCaso` varchar(45) DEFAULT NULL,
  `confirmadosCaso` varchar(45) DEFAULT NULL,
  `descartadosCaso` varchar(45) DEFAULT NULL,
  `obitosCaso` varchar(45) DEFAULT NULL,
  `recuperadosCaso` varchar(45) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `caso`
--

INSERT INTO `caso` (`idCaso`, `idMunicipio`, `idUsuario`, `fonteCaso`, `dataCaso`, `suspeitosCaso`, `confirmadosCaso`, `descartadosCaso`, `obitosCaso`, `recuperadosCaso`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 9, 8, 'dd', '1998-04-28', '2', 'null', '3', '5', '4', '2020-05-29 20:48:37', '2020-05-29 20:50:37', '2020-05-29 20:50:37'),
(2, 10, 8, 'ddd', '1998-04-28', '2', '1', '3', '555', '4', '2020-05-29 20:50:33', '2020-05-29 20:51:24', '0000-00-00 00:00:00'),
(3, 10, 8, 'dadas', '2020-05-29', '89', '88', '90', '92', '91', '2020-05-29 20:53:52', '2020-05-29 20:53:52', '0000-00-00 00:00:00'),
(4, 8, 8, 'http://localhost/admin/casos', '2020-04-27', '88', '77', '99', '121', '111', '2020-05-29 21:09:26', '2020-05-29 21:09:26', '0000-00-00 00:00:00'),
(5, 8, 8, 'dasdsadadas', '2020-01-28', '18', '15', '20', '26', '25', '2020-05-29 21:11:55', '2020-05-29 21:11:55', '0000-00-00 00:00:00'),
(6, 8, 8, 'dassa', '2020-03-28', '88', '99', '77', '88', '66', '2020-05-29 21:12:56', '2020-05-29 21:12:56', '0000-00-00 00:00:00'),
(7, 11, 8, 'eu', '1998-04-28', '0', '0', '0', '0', '0', '2020-05-29 21:30:44', '2020-05-29 21:41:54', '0000-00-00 00:00:00'),
(8, 11, 8, '', '0000-00-00', '', '0', '', '', '', '2020-05-29 21:36:46', '2020-05-29 21:36:46', '0000-00-00 00:00:00'),
(9, 12, 8, 'dasdasd', '1998-04-28', '15', '14', '16', '18', '17', '2020-05-29 21:45:49', '2020-05-29 21:45:49', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `doacao`
--

CREATE TABLE `doacao` (
  `idDoacao` int(11) NOT NULL,
  `idMunicipio` int(11) NOT NULL,
  `tipoDoacao` varchar(100) NOT NULL,
  `informacoesDoacao` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `microrregiao`
--

CREATE TABLE `microrregiao` (
  `idMicrorregiao` int(11) NOT NULL,
  `nomeMicrorregiao` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `microrregiao_municipio`
--

CREATE TABLE `microrregiao_municipio` (
  `idMicrorregiao_municipio` int(11) NOT NULL,
  `idMunicipio` int(11) NOT NULL,
  `idMicrorregiao` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `municipio`
--

CREATE TABLE `municipio` (
  `idMunicipio` int(11) NOT NULL,
  `nomeMunicipio` varchar(100) NOT NULL,
  `facebookMunicipio` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL,
  `slugMunicipio` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `municipio`
--

INSERT INTO `municipio` (`idMunicipio`, `nomeMunicipio`, `facebookMunicipio`, `created_at`, `updated_at`, `deleted_at`, `slugMunicipio`) VALUES
(1, 'Astolfo Dutra', 'PrefAstolfoDutra', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'astolfo-dutra'),
(2, 'São Geraldo\r\n', 'prefeitura.saogeraldo', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'sao-geraldo\r\n'),
(3, 'Dores do Turvo', 'doresdoturvo', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'dores-do-turvo'),
(4, 'Senador Firmino', 'municipiosenadorfirmino', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'senador-firmino'),
(5, 'Guidoval', 'prefeituradeguidoval', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'guidoval'),
(6, 'Visconde do Rio Branco', 'prefeituravrbmg', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'visconde-do-rio-branco'),
(7, 'Guiricema', 'guiricema', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'guiricema'),
(8, 'Mercês', 'prefeiturademerces', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'merces'),
(9, 'Piraúba', 'municipio.pirauba', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pirauba'),
(10, 'Rio Pomba', 'riopomba', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'rio-pomba'),
(11, 'Tabuleiro', 'prefeituradetabuleiro', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'tabuleiro'),
(12, 'Silveirânia', 'Prefeitura-Municipal-de-Silveirânia-2030149240557298', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'silverania'),
(13, 'Rodeiro', 'prefeituraderodeiromg', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'rodeiro'),
(14, 'Divinésia', 'prefeituraDivinesia', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'divinesia'),
(15, 'Guarani', 'Prefeitura-Municipal-de-Guarani-205479812800138', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'guarani'),
(16, 'Tocantins', 'prefeituradetocantins', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'tocantins'),
(17, 'Ubá', 'PrefeituradeUba', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'uba'),
(18, 'Ewbank da Câmara', 'prefeituradeewbankdacamara', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'ewbank-da-camara'),
(19, 'Belmiro Braga', 'prefeituradebelmirobraga', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'belmiro-braga'),
(20, 'Bias Fortes', 'PrefeituradeBiasFortes', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'bias-fortes'),
(21, 'Lima Duarte', 'PrefeituraLD', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'lima-duarte'),
(22, 'Chácara', 'prefeituradechacaramg', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'chacara'),
(23, 'Coronel Pacheco', 'pmcpoficial', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'coronel-pacheco'),
(24, 'Oliveiras Fortes', 'Prefeituramunicipaldeolveirafortes', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'oliveiras-fortes'),
(25, 'Maripá de Minas', 'MaripaDeMinasmg', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'maripa-de-minas'),
(26, 'Matias Barbosa', 'Prefeituramunicipalmatiasbarbosa', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'matias-barbosa'),
(27, 'Mar de Espanha', 'prefeiturademardeespanha', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'mar-de-espanha'),
(28, 'Paiva', 'prefeituradepaiva', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'paiva'),
(29, 'Descoberto', 'prefeituradescoberto', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'descoberto'),
(30, 'Aracitaba', 'pmaadm20172020', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'aracitaba'),
(31, 'Goianá', 'PrefeituraMunicipalDeGoiana', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'goiana'),
(32, 'Guarará', 'PrefeituraMunicipalDeGuarara', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'guarara'),
(33, 'Bicas', 'prefeituradebicasadm20172020', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'bicas'),
(34, 'Pequeri', 'prefeiturapequerimg', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pequeri'),
(36, 'Rio Novo', 'prefeituramunicipalderionovomg', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'rio-novo'),
(37, 'Rio Preto', 'pmriopretominas', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'rio-preto'),
(38, 'Piau', 'prefeituramunicipaldepiau', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'piau'),
(39, 'Olaria', 'PrefeituraOL', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'olaria'),
(40, 'Pedro Teixeira', 'PrefPtx', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'pedro-teixeira'),
(41, 'Simão Pereira', 'prefeituradesimaopereira', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'simao-pereira'),
(42, 'Senador Cortes', 'prefeiturasenadorcortes', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'senador-cortes'),
(43, 'São João Nepomuceno', 'prefeiturasjnepomuceno', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'sao-joao-nepomuceno'),
(44, 'Santos Dumont', 'Prefeitura-Municipal-de-Santos-Dumont-561920750577953', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'santos-dumont'),
(45, 'Santana do Deserto', 'santanadodeserto', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'santana-do-deserto'),
(46, 'Santa Rita do Jacutinga', 'Prefeitura-Municipal-de-Santa-Rita-de-Jacutinga-877687295659117', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'santa-rita-do-jacutinga'),
(47, 'Santa Rita de Ibitipoca', 'Informe-Covid-19-Santa-Rita-de-Ibitipoca-MG-100574188269392', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'santa-rita-de-ibitipoca'),
(48, 'Rochedo de Minas', 'PrefeituraMunicipalDeRochedoDeMinas', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'rochedo-de-minas'),
(49, 'Santa Bárbara do Monte Verde', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'santa-barbara-do-monte-verde'),
(50, 'Juiz de Fora', 'JuizdeForaPJF', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'juiz-de-fora'),
(51, 'Barbacena', 'BarbacenaGov', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'barbacena'),
(52, 'Cataguases', 'prefeituramunicipaldecataguasesmg', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'cataguases'),
(53, 'Muriaé', 'Prefeiturademuriae', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'muriae'),
(54, 'Leopoldina', 'camaramunicipaldeleopoldina', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'leopoldina'),
(55, 'Viçosa', 'prefsvicosa', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'vicosa');

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticia`
--

CREATE TABLE `noticia` (
  `idNoticia` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idMunicipio` int(11) NOT NULL,
  `tituloNoticia` varchar(100) NOT NULL,
  `textoNoticia` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nomeUsuario` varchar(100) NOT NULL,
  `emailUsuario` varchar(100) NOT NULL,
  `senhaUsuario` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nomeUsuario`, `emailUsuario`, `senhaUsuario`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Ariel', 'arielgranatob@gmail.com', '$2y$10$5TTiB6b/OVW0C275DXU28OQt8PIHzvJPE.aMwgioSKAlxoSwmpxuG', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Thiago', 'thiagomotax@gmail.com', '$2y$10$8aS2l8OsfiZHmR77EGWx3.Q2vYvWT5uzcrjEtFv54nJeUv3vt8Upa', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Misael', 'misaelg.freitas2000@gmail.com', '$2y$10$8aS2l8OsfiZHmR77EGWx3.Q2vYvWT5uzcrjEtFv54nJeUv3vt8Upa', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Bruno', 'brunojp178@gmail.com', '$2y$10$8aS2l8OsfiZHmR77EGWx3.Q2vYvWT5uzcrjEtFv54nJeUv3vt8Upa', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Talles', 'tallesyagofariacota@gmail.com', '$2y$10$8aS2l8OsfiZHmR77EGWx3.Q2vYvWT5uzcrjEtFv54nJeUv3vt8Upa', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Jesus', 'felipecandian95@gmail.com', '$2y$10$8aS2l8OsfiZHmR77EGWx3.Q2vYvWT5uzcrjEtFv54nJeUv3vt8Upa', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Gustavo', 'gustavo.teixeira@ifsudestemg.edu.br', '$2y$10$8aS2l8OsfiZHmR77EGWx3.Q2vYvWT5uzcrjEtFv54nJeUv3vt8Upa', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Wellington', 'wellington.moreira@ifsudestemg.edu.br', '$2y$10$8aS2l8OsfiZHmR77EGWx3.Q2vYvWT5uzcrjEtFv54nJeUv3vt8Upa', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'Lucas', 'lucas.lattari@ifsudestemg.edu.br', '$2y$10$xEzdcqI4QJSTAFAqG0SVR.G4eSBsz2BeB9faFfyNXzOcoTB.XrccC', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'Flávio', 'flavio.freitas@ifsudestemg.edu.br', '$2y$10$8aS2l8OsfiZHmR77EGWx3.Q2vYvWT5uzcrjEtFv54nJeUv3vt8Upa', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'Willian', 'wliberatoc@gmail.com', '$2y$10$8aS2l8OsfiZHmR77EGWx3.Q2vYvWT5uzcrjEtFv54nJeUv3vt8Upa', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'Felipe', 'felipemdb5@gmail.com', '$2y$10$8aS2l8OsfiZHmR77EGWx3.Q2vYvWT5uzcrjEtFv54nJeUv3vt8Upa', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'Letícia', 'lettciaszza@outlook.com', '$2y$10$8aS2l8OsfiZHmR77EGWx3.Q2vYvWT5uzcrjEtFv54nJeUv3vt8Upa', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'Rafael', 'rafael.dias.cont.pro@gmail.com', '$2y$10$8aS2l8OsfiZHmR77EGWx3.Q2vYvWT5uzcrjEtFv54nJeUv3vt8Upa', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'Josué', 'josuelopesfreitas16@gmail.com', '$2y$10$8aS2l8OsfiZHmR77EGWx3.Q2vYvWT5uzcrjEtFv54nJeUv3vt8Upa', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'Ariel', '', '', '2020-05-29 19:50:42', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'Ariel', '', 'seila123', '2020-05-29 19:57:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 'Ariel', '', 'seila123', '2020-05-29 19:59:28', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 'Wellington', '', 'painelcovid123', '2020-05-29 20:55:45', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 'Wellington', '', 'painelcovid1234', '2020-05-29 20:56:05', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_municipio`
--

CREATE TABLE `usuario_municipio` (
  `idUsuario_municipio` int(11) NOT NULL,
  `idMunicipio` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario_municipio`
--

INSERT INTO `usuario_municipio` (`idUsuario_municipio`, `idMunicipio`, `idUsuario`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 17, 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 6, 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 16, 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 7, 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 5, 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 13, 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 10, 8, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 9, 8, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 8, 8, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 11, 8, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 12, 8, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 1, 10, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 44, 10, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 40, 10, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 2, 12, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 15, 12, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 4, 12, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 3, 12, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 14, 9, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 27, 9, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 45, 9, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 25, 9, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 42, 9, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 50, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 33, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 26, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 36, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 31, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 34, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 23, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 38, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 41, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 43, 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 21, 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 37, 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 46, 14, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 29, 14, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 32, 14, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 20, 14, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 18, 14, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 51, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 52, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 53, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 54, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 55, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 39, 10, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 47, 10, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `alerta`
--
ALTER TABLE `alerta`
  ADD PRIMARY KEY (`idAlerta`),
  ADD KEY `idLocalizacaoJ_idx` (`idMunicipio`);

--
-- Índices para tabela `caso`
--
ALTER TABLE `caso`
  ADD PRIMARY KEY (`idCaso`),
  ADD KEY `idLocalizacao_idx` (`idMunicipio`),
  ADD KEY `fk_Caso_Usuario1_idx` (`idUsuario`);

--
-- Índices para tabela `doacao`
--
ALTER TABLE `doacao`
  ADD PRIMARY KEY (`idDoacao`),
  ADD KEY `idLocalizacaoC_idx` (`idMunicipio`);

--
-- Índices para tabela `microrregiao`
--
ALTER TABLE `microrregiao`
  ADD PRIMARY KEY (`idMicrorregiao`);

--
-- Índices para tabela `microrregiao_municipio`
--
ALTER TABLE `microrregiao_municipio`
  ADD PRIMARY KEY (`idMicrorregiao_municipio`),
  ADD KEY `fk_Microrregiao_municipio_Municipio1_idx` (`idMunicipio`),
  ADD KEY `fk_Microrregiao_municipio_Microrregiao1_idx` (`idMicrorregiao`);

--
-- Índices para tabela `municipio`
--
ALTER TABLE `municipio`
  ADD PRIMARY KEY (`idMunicipio`);

--
-- Índices para tabela `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`idNoticia`),
  ADD KEY `idUsuarioZ_idx` (`idUsuario`),
  ADD KEY `idLocalizacaoZ_idx` (`idMunicipio`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- Índices para tabela `usuario_municipio`
--
ALTER TABLE `usuario_municipio`
  ADD PRIMARY KEY (`idUsuario_municipio`),
  ADD KEY `fk_Usuarios_municipios_Municipio1_idx` (`idMunicipio`),
  ADD KEY `fk_Usuarios_municipios_Usuario1_idx` (`idUsuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alerta`
--
ALTER TABLE `alerta`
  MODIFY `idAlerta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `caso`
--
ALTER TABLE `caso`
  MODIFY `idCaso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `doacao`
--
ALTER TABLE `doacao`
  MODIFY `idDoacao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `municipio`
--
ALTER TABLE `municipio`
  MODIFY `idMunicipio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de tabela `noticia`
--
ALTER TABLE `noticia`
  MODIFY `idNoticia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `alerta`
--
ALTER TABLE `alerta`
  ADD CONSTRAINT `idMunicipioJ` FOREIGN KEY (`idMunicipio`) REFERENCES `municipio` (`idMunicipio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `caso`
--
ALTER TABLE `caso`
  ADD CONSTRAINT `fk_Caso_Usuario1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idMunicipioY` FOREIGN KEY (`idMunicipio`) REFERENCES `municipio` (`idMunicipio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `doacao`
--
ALTER TABLE `doacao`
  ADD CONSTRAINT `idMunicipioH` FOREIGN KEY (`idMunicipio`) REFERENCES `municipio` (`idMunicipio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `microrregiao_municipio`
--
ALTER TABLE `microrregiao_municipio`
  ADD CONSTRAINT `fk_Microrregiao_municipio_Microrregiao1` FOREIGN KEY (`idMicrorregiao`) REFERENCES `microrregiao` (`idMicrorregiao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Microrregiao_municipio_Municipio1` FOREIGN KEY (`idMunicipio`) REFERENCES `municipio` (`idMunicipio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `noticia`
--
ALTER TABLE `noticia`
  ADD CONSTRAINT `idMunicipioZ` FOREIGN KEY (`idMunicipio`) REFERENCES `municipio` (`idMunicipio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idUsuarioZ` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `usuario_municipio`
--
ALTER TABLE `usuario_municipio`
  ADD CONSTRAINT `fk_Usuarios_municipios_Municipio1` FOREIGN KEY (`idMunicipio`) REFERENCES `municipio` (`idMunicipio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Usuarios_municipios_Usuario1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
