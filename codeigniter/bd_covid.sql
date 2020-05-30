-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2020 at 07:58 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_covid`
--

-- --------------------------------------------------------

--
-- Table structure for table `alerta`
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
-- Table structure for table `caso`
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

-- --------------------------------------------------------

--
-- Table structure for table `doacao`
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
-- Table structure for table `microrregiao`
--

CREATE TABLE `microrregiao` (
  `idMicrorregiao` int(11) NOT NULL,
  `nomeMicrorregiao` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `microrregiao`
--

INSERT INTO `microrregiao` (`idMicrorregiao`, `nomeMicrorregiao`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Microrregião de Juiz de Fora', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Microrregião de Ubá', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Cidades Importantes', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `microrregiao_municipio`
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
-- Table structure for table `municipio`
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
-- Dumping data for table `municipio`
--

INSERT INTO `municipio` (`idMunicipio`, `nomeMunicipio`, `facebookMunicipio`, `created_at`, `updated_at`, `deleted_at`, `slugMunicipio`) VALUES
(0, 'Chiador', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'chiador'),
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
(49, 'Santa Bárbara do Monte Verde', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'santa-barbara-do-monte-verde'),
(50, 'Juiz de Fora', 'JuizdeForaPJF', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'juiz-de-fora'),
(51, 'Barbacena', 'BarbacenaGov', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'barbacena'),
(52, 'Cataguases', 'prefeituramunicipaldecataguasesmg', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'cataguases'),
(53, 'Muriaé', 'Prefeiturademuriae', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'muriae'),
(54, 'Leopoldina', 'camaramunicipaldeleopoldina', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'leopoldina'),
(55, 'Viçosa', 'prefsvicosa', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'vicosa');

-- --------------------------------------------------------

--
-- Table structure for table `noticia`
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
-- Table structure for table `usuario`
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
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nomeUsuario`, `emailUsuario`, `senhaUsuario`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Ariel', 'arielgranatob@gmail.com', '$2y$10$B2/X9MD3cANOMJBvCyeGweBVIBaAqIiUCFys.ZdG6CELj4NqReKzy', '0000-00-00 00:00:00', '2020-05-30 00:26:15', '0000-00-00 00:00:00'),
(2, 'Thiago', 'thiagomotax@gmail.com', '$2y$10$8aS2l8OsfiZHmR77EGWx3.Q2vYvWT5uzcrjEtFv54nJeUv3vt8Upa', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Misael', 'misaelg.freitas2000@gmail.com', '$2y$10$8aS2l8OsfiZHmR77EGWx3.Q2vYvWT5uzcrjEtFv54nJeUv3vt8Upa', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Bruno', 'brunojp178@gmail.com', '$2y$10$8aS2l8OsfiZHmR77EGWx3.Q2vYvWT5uzcrjEtFv54nJeUv3vt8Upa', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Talles', 'tallesyagofariacota@gmail.com', '$2y$10$8aS2l8OsfiZHmR77EGWx3.Q2vYvWT5uzcrjEtFv54nJeUv3vt8Upa', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Jesus', 'felipecandian95@gmail.com', '$2y$10$8aS2l8OsfiZHmR77EGWx3.Q2vYvWT5uzcrjEtFv54nJeUv3vt8Upa', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Gustavo', 'gustavo.teixeira@ifsudestemg.edu.br', '$2y$10$8aS2l8OsfiZHmR77EGWx3.Q2vYvWT5uzcrjEtFv54nJeUv3vt8Upa', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Wellington', 'wellington.moreira@ifsudestemg.edu.br', '$2y$10$8aS2l8OsfiZHmR77EGWx3.Q2vYvWT5uzcrjEtFv54nJeUv3vt8Upa', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'Lucas', 'lucas.lattari@ifsudestemg.edu.br', '$2y$10$8aS2l8OsfiZHmR77EGWx3.Q2vYvWT5uzcrjEtFv54nJeUv3vt8Upa', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'Flávio', 'flavio.freitas@ifsudestemg.edu.br', '$2y$10$8aS2l8OsfiZHmR77EGWx3.Q2vYvWT5uzcrjEtFv54nJeUv3vt8Upa', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'Willian', 'wliberatoc@gmail.com', '$2y$10$8aS2l8OsfiZHmR77EGWx3.Q2vYvWT5uzcrjEtFv54nJeUv3vt8Upa', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'Felipe', 'felipemdb5@gmail.com', '$2y$10$8aS2l8OsfiZHmR77EGWx3.Q2vYvWT5uzcrjEtFv54nJeUv3vt8Upa', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'Letícia', 'lettciaszza@outlook.com', '$2y$10$8aS2l8OsfiZHmR77EGWx3.Q2vYvWT5uzcrjEtFv54nJeUv3vt8Upa', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'Rafael', 'rafael.dias.cont.pro@gmail.com', '$2y$10$8aS2l8OsfiZHmR77EGWx3.Q2vYvWT5uzcrjEtFv54nJeUv3vt8Upa', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'Josué', 'josuelopesfreitas16@gmail.com', '$2y$10$8aS2l8OsfiZHmR77EGWx3.Q2vYvWT5uzcrjEtFv54nJeUv3vt8Upa', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `usuario_municipio`
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
-- Dumping data for table `usuario_municipio`
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
(41, 51, 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 52, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 55, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 39, 10, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 47, 10, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 30, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 28, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 53, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 54, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 19, 15, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 22, 15, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 49, 15, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 24, 15, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 0, 15, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 48, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alerta`
--
ALTER TABLE `alerta`
  ADD PRIMARY KEY (`idAlerta`),
  ADD KEY `idLocalizacaoJ_idx` (`idMunicipio`);

--
-- Indexes for table `caso`
--
ALTER TABLE `caso`
  ADD PRIMARY KEY (`idCaso`),
  ADD KEY `idLocalizacao_idx` (`idMunicipio`),
  ADD KEY `fk_Caso_Usuario1_idx` (`idUsuario`);

--
-- Indexes for table `doacao`
--
ALTER TABLE `doacao`
  ADD PRIMARY KEY (`idDoacao`),
  ADD KEY `idLocalizacaoC_idx` (`idMunicipio`);

--
-- Indexes for table `microrregiao`
--
ALTER TABLE `microrregiao`
  ADD PRIMARY KEY (`idMicrorregiao`);

--
-- Indexes for table `microrregiao_municipio`
--
ALTER TABLE `microrregiao_municipio`
  ADD PRIMARY KEY (`idMicrorregiao_municipio`),
  ADD KEY `fk_Microrregiao_municipio_Municipio1_idx` (`idMunicipio`),
  ADD KEY `fk_Microrregiao_municipio_Microrregiao1_idx` (`idMicrorregiao`);

--
-- Indexes for table `municipio`
--
ALTER TABLE `municipio`
  ADD PRIMARY KEY (`idMunicipio`);

--
-- Indexes for table `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`idNoticia`),
  ADD KEY `idUsuarioZ_idx` (`idUsuario`),
  ADD KEY `idLocalizacaoZ_idx` (`idMunicipio`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- Indexes for table `usuario_municipio`
--
ALTER TABLE `usuario_municipio`
  ADD PRIMARY KEY (`idUsuario_municipio`),
  ADD KEY `fk_Usuarios_municipios_Municipio1_idx` (`idMunicipio`),
  ADD KEY `fk_Usuarios_municipios_Usuario1_idx` (`idUsuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alerta`
--
ALTER TABLE `alerta`
  MODIFY `idAlerta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `caso`
--
ALTER TABLE `caso`
  MODIFY `idCaso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `doacao`
--
ALTER TABLE `doacao`
  MODIFY `idDoacao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `municipio`
--
ALTER TABLE `municipio`
  MODIFY `idMunicipio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `noticia`
--
ALTER TABLE `noticia`
  MODIFY `idNoticia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `usuario_municipio`
--
ALTER TABLE `usuario_municipio`
  MODIFY `idUsuario_municipio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alerta`
--
ALTER TABLE `alerta`
  ADD CONSTRAINT `idMunicipioJ` FOREIGN KEY (`idMunicipio`) REFERENCES `municipio` (`idMunicipio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `caso`
--
ALTER TABLE `caso`
  ADD CONSTRAINT `fk_Caso_Usuario1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idMunicipioY` FOREIGN KEY (`idMunicipio`) REFERENCES `municipio` (`idMunicipio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `doacao`
--
ALTER TABLE `doacao`
  ADD CONSTRAINT `idMunicipioH` FOREIGN KEY (`idMunicipio`) REFERENCES `municipio` (`idMunicipio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `microrregiao_municipio`
--
ALTER TABLE `microrregiao_municipio`
  ADD CONSTRAINT `fk_Microrregiao_municipio_Microrregiao1` FOREIGN KEY (`idMicrorregiao`) REFERENCES `microrregiao` (`idMicrorregiao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Microrregiao_municipio_Municipio1` FOREIGN KEY (`idMunicipio`) REFERENCES `municipio` (`idMunicipio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `noticia`
--
ALTER TABLE `noticia`
  ADD CONSTRAINT `idMunicipioZ` FOREIGN KEY (`idMunicipio`) REFERENCES `municipio` (`idMunicipio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idUsuarioZ` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `usuario_municipio`
--
ALTER TABLE `usuario_municipio`
  ADD CONSTRAINT `fk_Usuarios_municipios_Municipio1` FOREIGN KEY (`idMunicipio`) REFERENCES `municipio` (`idMunicipio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Usuarios_municipios_Usuario1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
