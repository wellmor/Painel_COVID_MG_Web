-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 28, 2020 at 05:14 PM
-- Server version: 5.6.41-84.1
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `covidmg_bd`
--

-- --------------------------------------------------------

--
-- Table structure for table `casos`
--

CREATE TABLE `casos` (
  `idCaso` int(11) NOT NULL,
  `idMunicipio` int(11) NOT NULL,
  `suspeitosCaso` int(11) NOT NULL,
  `confirmadosCaso` int(11) NOT NULL,
  `descartadosCaso` int(11) NOT NULL,
  `obitosCaso` int(11) NOT NULL,
  `recuperadosCaso` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `casos`
--

INSERT INTO `casos` (`idCaso`, `idMunicipio`, `suspeitosCaso`, `confirmadosCaso`, `descartadosCaso`, `obitosCaso`, `recuperadosCaso`, `created_at`, `updated_at`, `deleted_at`, `idUsuario`) VALUES
(39, 50, 13, 12, 14, 16, 15, '2020-05-22 23:17:19', '2020-05-23 08:42:40', '2020-05-23 08:42:40', 7),
(40, 9, 78, 77, 79, 818, 80, '2020-05-22 23:22:42', '2020-05-23 08:50:22', '2020-05-23 08:50:22', 7),
(47, 50, 2, 1, 3, 5, 4, '2020-05-23 08:50:16', '2020-05-23 08:50:16', '0000-00-00 00:00:00', 7),
(48, 23, 4, 3, 5, 7, 6, '2020-05-23 08:50:33', '2020-05-23 08:50:33', '0000-00-00 00:00:00', 7),
(49, 23, 3, 23, 3, 3, 3, '2020-05-23 09:10:58', '2020-05-23 09:10:58', '0000-00-00 00:00:00', 7),
(50, 31, 2, 1, 3, 5, 4, '2020-05-23 09:11:42', '2020-05-23 09:11:42', '0000-00-00 00:00:00', 7),
(51, 38, 55, 55, 55, 55, 55, '2020-05-23 09:25:48', '2020-05-23 09:25:48', '0000-00-00 00:00:00', 7),
(52, 31, 77, 77, 77, 77, 77, '2020-05-26 10:50:17', '2020-05-26 10:50:17', '0000-00-00 00:00:00', 7),
(53, 9, 13, 12, 15, 17, 16, '2020-05-26 12:00:37', '2020-05-28 11:39:34', '0000-00-00 00:00:00', 8),
(54, 10, 8, 8, 8, 8, 8, '2020-05-26 12:24:55', '2020-05-26 14:54:34', '2020-05-26 14:54:34', 8),
(55, 10, 9, 3, 26, 1, 0, '2020-05-26 14:53:32', '2020-05-26 14:53:32', '0000-00-00 00:00:00', 8),
(56, 12, 1, 1, 1, 1, 1, '2020-05-26 23:12:53', '2020-05-26 23:13:00', '2020-05-26 23:13:00', 8),
(57, 50, 33, 34, 35, 36, 37, '2020-05-27 23:17:19', '2020-05-23 08:42:40', '2020-05-23 08:42:40', 7),
(58, 9, 0, 0, 0, 0, 0, '2020-05-28 13:14:41', '2020-05-28 13:14:47', '2020-05-28 13:14:47', 8),
(59, 2, 4, 1, 19, 0, 0, '2020-05-28 14:00:33', '2020-05-28 15:05:16', '2020-05-28 15:05:16', 12),
(60, 14, 14, 1, 7, 0, 0, '2020-05-28 14:33:00', '2020-05-28 14:33:00', '0000-00-00 00:00:00', 9),
(61, 27, 13, 105, 71, 4, 11, '2020-05-28 14:39:43', '2020-05-28 14:39:43', '0000-00-00 00:00:00', 9),
(62, 25, 0, 1, 0, 0, 0, '2020-05-28 14:44:03', '2020-05-28 14:44:03', '0000-00-00 00:00:00', 9),
(63, 45, 3, 3, 5, 0, 0, '2020-05-28 14:45:55', '2020-05-28 14:45:55', '0000-00-00 00:00:00', 9),
(64, 50, -2, 25, 23, 1, 1, '2020-05-28 14:53:35', '2020-05-28 14:53:49', '2020-05-28 14:53:49', 7),
(65, 42, 5, 0, 16, 0, 0, '2020-05-28 14:54:33', '2020-05-28 14:54:33', '0000-00-00 00:00:00', 9),
(66, 31, 0, 0, 0, 0, 0, '2020-05-28 14:56:50', '2020-05-28 14:57:43', '2020-05-28 14:57:43', 7),
(67, 9, 32, 10, 50, 1, 15, '2020-05-28 14:58:52', '2020-05-28 15:06:40', '0000-00-00 00:00:00', 12),
(68, 15, 42, 24, 89, 3, 10, '2020-05-28 14:59:26', '2020-05-28 14:59:26', '0000-00-00 00:00:00', 12),
(69, 4, 89, 65, 155, 10, 30, '2020-05-28 14:59:58', '2020-05-28 14:59:58', '0000-00-00 00:00:00', 12),
(71, 2, 10, 10, 10, 0, 10, '2020-05-28 15:09:05', '2020-05-28 15:09:05', '0000-00-00 00:00:00', 12),
(72, 9, 9, 6, 8, 2, 7, '2020-05-28 15:11:40', '2020-05-28 15:13:50', '0000-00-00 00:00:00', 8),
(73, 15, 1, 0, 1, 1, 1, '2020-05-28 15:12:52', '2020-05-28 15:12:52', '0000-00-00 00:00:00', 12);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` text NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '20121031100537', 'App\\Database\\Migrations\\AddUsers', 'default', 'App', 1589910572, 1);

-- --------------------------------------------------------

--
-- Table structure for table `municipios`
--

CREATE TABLE `municipios` (
  `idMunicipio` int(11) NOT NULL,
  `nomeMunicipio` varchar(150) NOT NULL,
  `facebookMunicipio` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `municipios`
--

INSERT INTO `municipios` (`idMunicipio`, `nomeMunicipio`, `facebookMunicipio`) VALUES
(1, 'Astolfo Dutra', 'PrefAstolfoDutra'),
(2, 'São Geraldo\r\n', 'prefeitura.saogeraldo'),
(3, 'Dores do Turvo', 'doresdoturvo'),
(4, 'Senador Firmino', 'municipiosenadorfirmino'),
(5, 'Guidoval', 'prefeituradeguidoval'),
(6, 'Visconde do Rio Branco', 'prefeituravrbmg'),
(7, 'Guiricema', 'guiricema'),
(8, 'Mercês', 'prefeiturademerces'),
(9, 'Piraúba', 'municipio.pirauba'),
(10, 'Rio Pomba', 'riopomba'),
(11, 'Tabuleiro', 'prefeituradetabuleiro'),
(12, 'Silverânia', 'Prefeitura-Municipal-de-Silveirânia-2030149240557298'),
(13, 'Rodeiro', 'prefeituraderodeiromg'),
(14, 'Divinésia', 'prefeituraDivinesia'),
(15, 'Guarani', 'Prefeitura-Municipal-de-Guarani-205479812800138'),
(16, 'Tocantins', 'prefeituradetocantins'),
(17, 'Ubá', 'PrefeituradeUba'),
(18, 'Ewbank da Câmara', 'prefeituradeewbankdacamara'),
(19, 'Belmiro Braga', 'prefeituradebelmirobraga'),
(20, 'Bias Fortes', 'PrefeituradeBiasFortes'),
(21, 'Lima Duarte', 'PrefeituraLD'),
(22, 'Chácara', 'prefeituradechacaramg'),
(23, 'Coronel Pacheco', 'pmcpoficial'),
(24, 'Oliveiras Fortes', 'Prefeituramunicipaldeolveirafortes'),
(25, 'Maripá de Minas', 'MaripaDeMinasmg'),
(26, 'Matias Barbosa', 'Prefeituramunicipalmatiasbarbosa'),
(27, 'Mar de Espanha', 'prefeiturademardeespanha'),
(28, 'Paiva', 'prefeituradepaiva'),
(29, 'Descoberto', 'prefeituradescoberto'),
(30, 'Aracitaba', 'pmaadm20172020'),
(31, 'Goianá', 'PrefeituraMunicipalDeGoiana'),
(32, 'Guarará', 'PrefeituraMunicipalDeGuarara'),
(33, 'Bicas', 'prefeituradebicasadm20172020'),
(34, 'Pequeri', 'prefeiturapequerimg'),
(36, 'Rio Novo', 'prefeituramunicipalderionovomg'),
(37, 'Rio Preto', 'pmriopretominas'),
(38, 'Piau', 'prefeituramunicipaldepiau'),
(39, 'Olaria', 'PrefeituraOL'),
(40, 'Pedro Teixeira', 'PrefPtx'),
(41, 'Simão Pereira', 'prefeituradesimaopereira'),
(42, 'Senador Cortes', 'prefeiturasenadorcortes'),
(43, 'São João Nepomuceno', 'prefeiturasjnepomuceno'),
(44, 'Santos Dumont', 'Prefeitura-Municipal-de-Santos-Dumont-561920750577953'),
(45, 'Santana do Deserto', 'santanadodeserto'),
(46, 'Santa Rita do Jacutinga', 'Prefeitura-Municipal-de-Santa-Rita-de-Jacutinga-877687295659117'),
(47, 'Santa Rita de Ibitipoca', 'Informe-Covid-19-Santa-Rita-de-Ibitipoca-MG-100574188269392'),
(48, 'Rochedo de Minas', 'PrefeituraMunicipalDeRochedoDeMinas'),
(49, 'Santa Bárbara do Monte Verde', ''),
(50, 'Juiz de Fora', 'JuizdeForaPJF'),
(51, 'Barbacena', 'BarbacenaGov'),
(52, 'Cataguases', 'prefeituramunicipaldecataguasesmg'),
(53, 'Muriaé', 'Prefeiturademuriae'),
(54, 'Leopoldina', 'camaramunicipaldeleopoldina'),
(55, 'Viçosa', 'prefsvicosa');

-- --------------------------------------------------------

--
-- Table structure for table `noticias`
--

CREATE TABLE `noticias` (
  `idNoticia` int(11) NOT NULL,
  `tituloNoticia` text NOT NULL,
  `conteudoNoticia` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Ariel', 'arielgranatob@gmail.com', '$2y$10$5TTiB6b/OVW0C275DXU28OQt8PIHzvJPE.aMwgioSKAlxoSwmpxuG', '2020-05-21 20:01:04', '2020-05-28 13:14:27'),
(2, 'Thiago', 'thiagomotax@gmail.com', '$2y$10$8aS2l8OsfiZHmR77EGWx3.Q2vYvWT5uzcrjEtFv54nJeUv3vt8Upa', '2020-05-20 21:35:07', '0000-00-00 00:00:00'),
(3, 'Misael', 'misaelg.freitas2000@gmail.com', '$2y$10$8aS2l8OsfiZHmR77EGWx3.Q2vYvWT5uzcrjEtFv54nJeUv3vt8Upa', '2020-05-21 20:58:22', '0000-00-00 00:00:00'),
(4, 'Bruno', 'brunojp178@gmail.com', '$2y$10$8aS2l8OsfiZHmR77EGWx3.Q2vYvWT5uzcrjEtFv54nJeUv3vt8Upa', '2020-05-21 20:57:51', '0000-00-00 00:00:00'),
(5, 'Talles', 'tallesyagofariacota@gmail.com', '$2y$10$8aS2l8OsfiZHmR77EGWx3.Q2vYvWT5uzcrjEtFv54nJeUv3vt8Upa', '2020-05-21 20:43:14', '0000-00-00 00:00:00'),
(6, 'Jesus', 'felipecandian95@gmail.com', '$2y$10$8aS2l8OsfiZHmR77EGWx3.Q2vYvWT5uzcrjEtFv54nJeUv3vt8Upa', '2020-05-21 20:42:53', '0000-00-00 00:00:00'),
(7, 'Gustavo', 'gustavo.teixeira@ifsudestemg.edu.br', '$2y$10$8aS2l8OsfiZHmR77EGWx3.Q2vYvWT5uzcrjEtFv54nJeUv3vt8Upa', '2020-05-21 20:42:18', '0000-00-00 00:00:00'),
(8, 'Wellington', 'wellington.moreira@ifsudestemg.edu.br', '$2y$10$8aS2l8OsfiZHmR77EGWx3.Q2vYvWT5uzcrjEtFv54nJeUv3vt8Upa', '2020-05-21 20:41:04', '0000-00-00 00:00:00'),
(9, 'Lucas', 'lucas.lattari@ifsudestemg.edu.br', '$2y$10$xEzdcqI4QJSTAFAqG0SVR.G4eSBsz2BeB9faFfyNXzOcoTB.XrccC', '2020-05-21 20:41:44', '2020-05-28 14:57:23'),
(10, 'Flávio', 'flavio.freitas@ifsudestemg.edu.br', '$2y$10$8aS2l8OsfiZHmR77EGWx3.Q2vYvWT5uzcrjEtFv54nJeUv3vt8Upa', '2020-05-21 20:42:01', '0000-00-00 00:00:00'),
(11, 'Willian', 'wliberatoc@gmail.com', '$2y$10$8aS2l8OsfiZHmR77EGWx3.Q2vYvWT5uzcrjEtFv54nJeUv3vt8Upa', '2020-05-21 20:42:01', '0000-00-00 00:00:00'),
(12, 'Felipe', 'felipemdb5@gmail.com', '$2y$10$8aS2l8OsfiZHmR77EGWx3.Q2vYvWT5uzcrjEtFv54nJeUv3vt8Upa', '2020-05-21 20:42:01', '0000-00-00 00:00:00'),
(13, 'Letícia', 'lettciaszza@outlook.com', '$2y$10$8aS2l8OsfiZHmR77EGWx3.Q2vYvWT5uzcrjEtFv54nJeUv3vt8Upa', '2020-05-21 20:42:01', '0000-00-00 00:00:00'),
(14, 'Rafael', 'rafael.dias.cont.pro@gmail.com', '$2y$10$8aS2l8OsfiZHmR77EGWx3.Q2vYvWT5uzcrjEtFv54nJeUv3vt8Upa', '2020-05-21 20:42:01', '0000-00-00 00:00:00'),
(15, 'Josué', 'josuelopesfreitas16@gmail.com', '$2y$10$8aS2l8OsfiZHmR77EGWx3.Q2vYvWT5uzcrjEtFv54nJeUv3vt8Upa', '2020-05-21 20:42:01', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users_municipio`
--

CREATE TABLE `users_municipio` (
  `idUsers_municipio` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idMunicipio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_municipio`
--

INSERT INTO `users_municipio` (`idUsers_municipio`, `idUser`, `idMunicipio`) VALUES
(1, 6, 17),
(2, 6, 6),
(3, 6, 16),
(4, 6, 7),
(5, 6, 5),
(6, 6, 13),
(7, 8, 10),
(8, 8, 9),
(9, 8, 8),
(10, 8, 11),
(11, 8, 12),
(12, 10, 1),
(13, 10, 44),
(14, 10, 40),
(15, 12, 2),
(16, 12, 15),
(17, 12, 4),
(18, 12, 3),
(19, 9, 14),
(20, 9, 27),
(21, 9, 45),
(22, 9, 25),
(23, 9, 42),
(24, 7, 50),
(25, 7, 33),
(26, 7, 26),
(27, 7, 36),
(28, 7, 31),
(29, 7, 34),
(30, 7, 23),
(31, 7, 38),
(32, 7, 41),
(33, 13, 43),
(34, 13, 21),
(35, 13, 37),
(36, 14, 46),
(37, 14, 29),
(38, 14, 32),
(39, 14, 20),
(40, 14, 18),
(41, 11, 51),
(42, 11, 52),
(43, 11, 53),
(44, 11, 54),
(45, 11, 55),
(46, 10, 39),
(47, 10, 47);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `casos`
--
ALTER TABLE `casos`
  ADD PRIMARY KEY (`idCaso`) USING BTREE,
  ADD KEY `fk_casos` (`idMunicipio`),
  ADD KEY `fk_casos2` (`idUsuario`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`idMunicipio`);

--
-- Indexes for table `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`idNoticia`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_municipio`
--
ALTER TABLE `users_municipio`
  ADD PRIMARY KEY (`idUsers_municipio`),
  ADD KEY `fk_municipio` (`idMunicipio`),
  ADD KEY `fk_users` (`idUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `casos`
--
ALTER TABLE `casos`
  MODIFY `idCaso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `municipios`
--
ALTER TABLE `municipios`
  MODIFY `idMunicipio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `noticias`
--
ALTER TABLE `noticias`
  MODIFY `idNoticia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users_municipio`
--
ALTER TABLE `users_municipio`
  MODIFY `idUsers_municipio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `casos`
--
ALTER TABLE `casos`
  ADD CONSTRAINT `fk_casos` FOREIGN KEY (`idMunicipio`) REFERENCES `municipios` (`idMunicipio`),
  ADD CONSTRAINT `fk_casos2` FOREIGN KEY (`idUsuario`) REFERENCES `users` (`id`);

--
-- Constraints for table `users_municipio`
--
ALTER TABLE `users_municipio`
  ADD CONSTRAINT `fk_municipio` FOREIGN KEY (`idMunicipio`) REFERENCES `municipios` (`idMunicipio`),
  ADD CONSTRAINT `fk_users` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
