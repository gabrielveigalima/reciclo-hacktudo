-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 29-Jul-2018 às 07:51
-- Versão do servidor: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `api`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `nome_categoria` varchar(60) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`nome_categoria`, `id_categoria`) VALUES
('Metais', 1),
('Óleos', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa_parceira`
--

CREATE TABLE `empresa_parceira` (
  `id_empresa` int(11) NOT NULL,
  `NomeEmpr` varchar(255) NOT NULL,
  `CnpjEmp` varchar(20) NOT NULL,
  `CepEmp` varchar(15) NOT NULL,
  `Endereco` varchar(255) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `categorias_interesse` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `empresa_parceira`
--

INSERT INTO `empresa_parceira` (`id_empresa`, `NomeEmpr`, `CnpjEmp`, `CepEmp`, `Endereco`, `bairro`, `estado`, `cidade`, `categorias_interesse`) VALUES
(1, 'Piririco', '4234234234', '34243', 'teste', 'nilopolis', '32434234324', 'cererqe', 32423);

-- --------------------------------------------------------

--
-- Estrutura da tabela `residuos`
--

CREATE TABLE `residuos` (
  `id` int(11) NOT NULL,
  `nome_r` varchar(255) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `dias_disponiveis` varchar(255) NOT NULL,
  `endereco_id` int(11) NOT NULL,
  `data_criacao` date NOT NULL,
  `id_owner` int(10) NOT NULL,
  `id_empresa` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(6) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `nivel_id` int(1) NOT NULL,
  `tipo_conta` char(2) NOT NULL,
  `tel_1` int(10) DEFAULT NULL,
  `tel_2` int(10) DEFAULT NULL,
  `qnt_pontos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `nivel_id`, `tipo_conta`, `tel_1`, `tel_2`, `qnt_pontos`) VALUES
(3, 'mario', 'sl4ureano@live.com', '123213', 1, 'pf', 344343553, 434345455, 4000),
(4, 'Celso Inácio', 'celso@a.com', '123', 1, 'pf', NULL, NULL, 999),
(5, 'celso', 'cels2o@a.com', '123', 1, 'pf', NULL, NULL, 0),
(6, 'celso', 'celsaaao@a.com', '123', 1, 'pf', NULL, NULL, 0),
(7, 'sasasa', 'sasasa', 'sasasasas', 1, 'pf', NULL, NULL, 0),
(8, 'sasasa', 'sasasas', 'asasasasas', 1, 'pf', NULL, NULL, 0),
(9, 'SAUSHAUS', 'HUSAHUSHAU', 'HSAUHSAUHSAU', 1, 'pf', NULL, NULL, 0),
(10, 'sasa', 'asasa', 'sasasa', 1, 'pf', NULL, NULL, 0),
(11, 'celso', 'celso', 'celso', 1, 'pf', NULL, NULL, 0),
(12, 'sasasa', 'sasasa@aaa.com', '123', 1, 'pf', NULL, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indexes for table `empresa_parceira`
--
ALTER TABLE `empresa_parceira`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Indexes for table `residuos`
--
ALTER TABLE `residuos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `empresa_parceira`
--
ALTER TABLE `empresa_parceira`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `residuos`
--
ALTER TABLE `residuos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
