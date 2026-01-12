-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12-Jan-2026 às 12:01
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `tp2`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `adocao`
--

CREATE TABLE `adocao` (
  `id_adocao` int(11) NOT NULL,
  `data_pedido` date NOT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `id_utilizador` int(11) NOT NULL,
  `id_animal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `adocao`
--

INSERT INTO `adocao` (`id_adocao`, `data_pedido`, `estado`, `id_utilizador`, `id_animal`) VALUES
(1, '2024-01-10', 'pendente', 1, 1),
(2, '2024-01-11', 'aprovada', 2, 4),
(3, '2024-01-12', 'pendente', 4, 2),
(4, '2024-01-13', 'rejeitada', 5, 3),
(5, '2024-01-14', 'aprovada', 7, 8),
(6, '2024-01-15', 'pendente', 8, 5),
(7, '2024-01-16', 'pendente', 9, 6),
(8, '2024-01-17', 'aprovada', 1, 10),
(9, '2024-01-18', 'pendente', 2, 7),
(10, '2024-01-19', 'aprovada', 4, 9);

-- --------------------------------------------------------

--
-- Estrutura da tabela `animal`
--

CREATE TABLE `animal` (
  `id_animal` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `especie` varchar(50) NOT NULL,
  `idade` int(11) DEFAULT NULL,
  `porte` enum('pequeno','medio','grande') DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `id_utilizador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `animal`
--

INSERT INTO `animal` (`id_animal`, `nome`, `especie`, `idade`, `porte`, `descricao`, `foto`, `estado`, `id_utilizador`) VALUES
(1, 'Rex', 'Cão', 4, 'grande', 'Muito amigável', 'rex.jpg', 'disponivel', 3),
(2, 'Mia', 'Gato', 2, 'pequeno', 'Calma e dócil', 'mia.jpg', 'disponivel', 6),
(3, 'Bolt', 'Cão', 3, 'medio', 'Muito ativo', 'bolt.jpg', 'disponivel', 3),
(4, 'Luna', 'Gato', 1, 'pequeno', 'Brincalhona', 'luna.jpg', 'adotado', 6),
(5, 'Max', 'Cão', 5, 'grande', 'Protetor', 'max.jpg', 'disponivel', 3),
(6, 'Nina', 'Cão', 2, 'medio', 'Carinhosa', 'nina.jpg', 'disponivel', 6),
(7, 'Simba', 'Gato', 3, 'pequeno', 'Independente', 'simba.jpg', 'disponivel', 3),
(8, 'Toby', 'Cão', 6, 'medio', 'Tranquilo', 'toby.jpg', 'adotado', 6),
(9, 'Kika', 'Gato', 4, 'pequeno', 'Sociável', 'kika.jpg', 'disponivel', 3),
(10, 'Rocky', 'Cão', 2, 'grande', 'Brincalhão', 'rocky.jpg', 'disponivel', 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensagem`
--

CREATE TABLE `mensagem` (
  `id_mensagem` int(11) NOT NULL,
  `texto` text NOT NULL,
  `data` datetime NOT NULL,
  `id_utilizador` int(11) NOT NULL,
  `id_animal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `mensagem`
--

INSERT INTO `mensagem` (`id_mensagem`, `texto`, `data`, `id_utilizador`, `id_animal`) VALUES
(1, 'Gostaria de saber mais sobre o Rex', '2024-01-05 10:00:00', 1, 1),
(2, 'O animal ainda está disponível?', '2024-01-06 11:30:00', 2, 2),
(3, 'Quais os requisitos para adoção?', '2024-01-07 09:15:00', 4, 3),
(4, 'Posso visitar o animal?', '2024-01-08 14:00:00', 5, 4),
(5, 'Ele é sociável com crianças?', '2024-01-09 16:45:00', 7, 5),
(6, 'Qual a idade exata?', '2024-01-10 12:20:00', 8, 6),
(7, 'Tem vacinas em dia?', '2024-01-11 13:10:00', 9, 7),
(8, 'Posso adotar esta semana?', '2024-01-12 15:00:00', 1, 8),
(9, 'Onde posso buscar o animal?', '2024-01-13 17:30:00', 2, 9),
(10, 'Há taxa de adoção?', '2024-01-14 18:00:00', 4, 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `registo`
--

CREATE TABLE `registo` (
  `id_registo` int(11) NOT NULL,
  `data_registo` date NOT NULL,
  `id_animal` int(11) NOT NULL,
  `id_utilizador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `registo`
--

INSERT INTO `registo` (`id_registo`, `data_registo`, `id_animal`, `id_utilizador`) VALUES
(1, '2023-12-01', 1, 3),
(2, '2023-12-02', 2, 6),
(3, '2023-12-03', 3, 3),
(4, '2023-12-04', 4, 6),
(5, '2023-12-05', 5, 3),
(6, '2023-12-06', 6, 6),
(7, '2023-12-07', 7, 3),
(8, '2023-12-08', 8, 6),
(9, '2023-12-09', 9, 3),
(10, '2023-12-10', 10, 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizador`
--

CREATE TABLE `utilizador` (
  `id_utilizador` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `tipo` enum('admin','funcionario','adotante') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `utilizador`
--

INSERT INTO `utilizador` (`id_utilizador`, `nome`, `email`, `senha`, `telefone`, `tipo`) VALUES
(1, 'Ana Silva', 'ana@email.com', 'senha1', '912345678', 'adotante'),
(2, 'Bruno Costa', 'bruno@email.com', 'senha2', '913456789', 'adotante'),
(3, 'Carla Mendes', 'carla@email.com', 'senha3', '914567890', 'funcionario'),
(4, 'Daniel Rocha', 'daniel@email.com', 'senha4', '915678901', 'adotante'),
(5, 'Eva Santos', 'eva@email.com', 'senha5', '916789012', 'adotante'),
(6, 'Fábio Lima', 'fabio@email.com', 'senha6', '917890123', 'funcionario'),
(7, 'Gisela Alves', 'gisela@email.com', 'senha7', '918901234', 'adotante'),
(8, 'Hugo Pires', 'hugo@email.com', 'senha8', '919012345', 'adotante'),
(9, 'Inês Duarte', 'ines@email.com', 'senha9', '910123456', 'adotante'),
(10, 'João Matos', 'joao@email.com', 'senha10', '911234567', 'admin');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `adocao`
--
ALTER TABLE `adocao`
  ADD PRIMARY KEY (`id_adocao`),
  ADD KEY `id_utilizador` (`id_utilizador`),
  ADD KEY `id_animal` (`id_animal`);

--
-- Índices para tabela `animal`
--
ALTER TABLE `animal`
  ADD PRIMARY KEY (`id_animal`),
  ADD KEY `id_utilizador` (`id_utilizador`);

--
-- Índices para tabela `mensagem`
--
ALTER TABLE `mensagem`
  ADD PRIMARY KEY (`id_mensagem`),
  ADD KEY `id_utilizador` (`id_utilizador`),
  ADD KEY `id_animal` (`id_animal`);

--
-- Índices para tabela `registo`
--
ALTER TABLE `registo`
  ADD PRIMARY KEY (`id_registo`),
  ADD KEY `id_animal` (`id_animal`),
  ADD KEY `id_utilizador` (`id_utilizador`);

--
-- Índices para tabela `utilizador`
--
ALTER TABLE `utilizador`
  ADD PRIMARY KEY (`id_utilizador`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `adocao`
--
ALTER TABLE `adocao`
  MODIFY `id_adocao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `animal`
--
ALTER TABLE `animal`
  MODIFY `id_animal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `mensagem`
--
ALTER TABLE `mensagem`
  MODIFY `id_mensagem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `registo`
--
ALTER TABLE `registo`
  MODIFY `id_registo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `utilizador`
--
ALTER TABLE `utilizador`
  MODIFY `id_utilizador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `adocao`
--
ALTER TABLE `adocao`
  ADD CONSTRAINT `adocao_ibfk_1` FOREIGN KEY (`id_utilizador`) REFERENCES `utilizador` (`id_utilizador`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `adocao_ibfk_2` FOREIGN KEY (`id_animal`) REFERENCES `animal` (`id_animal`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `animal`
--
ALTER TABLE `animal`
  ADD CONSTRAINT `animal_ibfk_1` FOREIGN KEY (`id_utilizador`) REFERENCES `utilizador` (`id_utilizador`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limitadores para a tabela `mensagem`
--
ALTER TABLE `mensagem`
  ADD CONSTRAINT `mensagem_ibfk_1` FOREIGN KEY (`id_utilizador`) REFERENCES `utilizador` (`id_utilizador`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mensagem_ibfk_2` FOREIGN KEY (`id_animal`) REFERENCES `animal` (`id_animal`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limitadores para a tabela `registo`
--
ALTER TABLE `registo`
  ADD CONSTRAINT `registo_ibfk_1` FOREIGN KEY (`id_animal`) REFERENCES `animal` (`id_animal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `registo_ibfk_2` FOREIGN KEY (`id_utilizador`) REFERENCES `utilizador` (`id_utilizador`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
