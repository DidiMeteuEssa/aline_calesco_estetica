-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 30/04/2025 às 16:39
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `aline_calesco_estetica`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `campos_comuns`
--

CREATE TABLE `campos_comuns` (
  `id` int(3) NOT NULL,
  `cliente` varchar(14) NOT NULL,
  `uso_cosmetico` text DEFAULT NULL,
  `qualidade_sono` varchar(500) DEFAULT NULL,
  `litros_agua` varchar(500) DEFAULT NULL,
  `diureticos` varchar(500) DEFAULT NULL,
  `diabetes` varchar(500) DEFAULT NULL,
  `medicacao` varchar(500) DEFAULT NULL,
  `tratamento_realizou` text DEFAULT NULL,
  `intestino` varchar(500) DEFAULT NULL,
  `fototipo` enum('i','ii','iii','iv','v','vi') NOT NULL,
  `tipo_pele` enum('normal','mista','seca','oleosa','sensivel','acneia') NOT NULL,
  `alimentacao_detalhada` text DEFAULT NULL,
  `trombose` varchar(500) DEFAULT NULL,
  `nivel_exposicao_radiacao` varchar(500) DEFAULT NULL,
  `problemas_cardiacos` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `campos_comuns`
--

INSERT INTO `campos_comuns` (`id`, `cliente`, `uso_cosmetico`, `qualidade_sono`, `litros_agua`, `diureticos`, `diabetes`, `medicacao`, `tratamento_realizou`, `intestino`, `fototipo`, `tipo_pele`, `alimentacao_detalhada`, `trombose`, `nivel_exposicao_radiacao`, `problemas_cardiacos`) VALUES
(4, '203.559.990-30', '', '', '', '', '', '', '', '', 'i', 'normal', '', '', '', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `cpf` varchar(14) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `data_nasc` date NOT NULL,
  `idade` int(3) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `cep` varchar(9) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `cidade` varchar(30) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `profissao` varchar(200) NOT NULL,
  `tel_res` varchar(10) NOT NULL,
  `tel_com` varchar(10) NOT NULL,
  `tel_cel` varchar(15) NOT NULL,
  `status_ficha_corporal` int(1) NOT NULL DEFAULT 0,
  `status_ficha_facial` int(1) NOT NULL DEFAULT 0,
  `status_ficha_melasma` int(1) NOT NULL DEFAULT 0,
  `status_comuns` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`cpf`, `nome`, `data_nasc`, `idade`, `endereco`, `cep`, `bairro`, `cidade`, `estado`, `profissao`, `tel_res`, `tel_com`, `tel_cel`, `status_ficha_corporal`, `status_ficha_facial`, `status_ficha_melasma`, `status_comuns`) VALUES
('203.559.990-30', 'Diego Felippe da Fonseca Calesco', '2005-06-13', 19, 'Yutaka Abé', '17700-000', 'Jardim Alvorada', 'Osvaldo Cruz', 'SP', 'Desenvolvedor Fullstack +  Banco de Dados', 'N tem', 'N tem', '(18) 99722-5754', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `ficha_anamnese_corporal`
--

CREATE TABLE `ficha_anamnese_corporal` (
  `id` int(3) NOT NULL,
  `cliente` varchar(14) NOT NULL,
  `fumante` enum('sim','nao') NOT NULL,
  `dieta_rigorosa` enum('sim','nao') NOT NULL,
  `patologia_pele` enum('hipotireoidismo','hipertiroidismo','nao') NOT NULL,
  `usa_suplemento_oral` enum('sim','nao') NOT NULL,
  `qual_suplemento_oral` varchar(500) DEFAULT NULL,
  `cirurgia_plastica_estetica` enum('sim','nao') NOT NULL,
  `qual_cirurgia_plastica` varchar(500) DEFAULT NULL,
  `queixa_alopecia` text DEFAULT NULL,
  `doenca_acomete_corpo` enum('sim','nao') DEFAULT NULL,
  `qual_doenca_acomete_corpo` varchar(500) DEFAULT NULL,
  `tempo_disfuncao` varchar(500) DEFAULT NULL,
  `status_disfuncao` enum('estavel','aumentando','diminuindo') DEFAULT NULL,
  `antecendentes_oncologicos` enum('sim','nao') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ficha_anamnese_corporal`
--

INSERT INTO `ficha_anamnese_corporal` (`id`, `cliente`, `fumante`, `dieta_rigorosa`, `patologia_pele`, `usa_suplemento_oral`, `qual_suplemento_oral`, `cirurgia_plastica_estetica`, `qual_cirurgia_plastica`, `queixa_alopecia`, `doenca_acomete_corpo`, `qual_doenca_acomete_corpo`, `tempo_disfuncao`, `status_disfuncao`, `antecendentes_oncologicos`) VALUES
(47, '203.559.990-30', 'nao', 'nao', 'hipertiroidismo', 'nao', '', 'nao', '', '', 'nao', '', '', 'diminuindo', 'nao');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ficha_anamnese_facial`
--

CREATE TABLE `ficha_anamnese_facial` (
  `id` int(3) NOT NULL,
  `cliente` varchar(14) NOT NULL,
  `queixa_principal` text DEFAULT NULL,
  `usa_lente` enum('sim','nao') NOT NULL,
  `gestante` enum('sim','nao') NOT NULL,
  `contraceptivo` enum('sim','nao') NOT NULL,
  `qual_contraceptivo` varchar(500) DEFAULT NULL,
  `hipertensao` enum('sim','nao') NOT NULL,
  `ansiedade` enum('sim','nao') NOT NULL,
  `sensivel_dor` enum('sim','nao') NOT NULL,
  `cancer_pele` enum('sim','nao') NOT NULL,
  `habitos_vida` varchar(500) DEFAULT NULL,
  `botox` enum('sim','nao') NOT NULL,
  `botox_local_tempo` varchar(500) DEFAULT NULL,
  `tireoide` enum('sim','nao') NOT NULL,
  `protetor_solar` enum('sim','nao') NOT NULL,
  `protetor_solar_qual_freq` varchar(500) DEFAULT NULL,
  `alergias` enum('sim','nao') NOT NULL,
  `quais_alergias` varchar(500) DEFAULT NULL,
  `disturbio_hormonal` enum('sim','nao') NOT NULL,
  `qual_disturbio` varchar(500) DEFAULT NULL,
  `marcapasso` enum('sim','nao') NOT NULL,
  `menstruacao` enum('regular','irregular','menopausa','histerectomia') NOT NULL,
  `classif_fototipo` enum('i','ii','iii','iv','v','vi') NOT NULL,
  `grau_hidratacao` enum('normal','desidratada_superficial','desidratada_profunda') NOT NULL,
  `textura_pele` enum('lisa','aspera','fina','grossa','normal') NOT NULL,
  `grau_oleosidade` enum('equilibrado','aumentado','excessivo','pontual') NOT NULL,
  `acne` enum('ausente','i','ii','iii','iv') NOT NULL,
  `evolucao_cutanea` varchar(500) DEFAULT NULL,
  `local` varchar(200) DEFAULT NULL,
  `classif_goglau` enum('i','ii','iii','iv') NOT NULL,
  `goglau_estatica` varchar(500) DEFAULT NULL,
  `goglau_dinamica` varchar(500) DEFAULT NULL,
  `alteracoes_epiderme` varchar(500) DEFAULT NULL,
  `lesao_pele` varchar(500) DEFAULT NULL,
  `cicatriz` varchar(500) DEFAULT NULL,
  `pelos` varchar(500) DEFAULT NULL,
  `olheiras` enum('sim','nao') NOT NULL,
  `observacao_olheiras` text DEFAULT NULL,
  `video_foto` text DEFAULT NULL,
  `protocolo` text DEFAULT NULL,
  `antes_depois` enum('sim','nao') NOT NULL,
  `redes_sociais` enum('sim','nao') NOT NULL,
  `acordo_tratamento` enum('sim','nao') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ficha_anamnese_facial`
--

INSERT INTO `ficha_anamnese_facial` (`id`, `cliente`, `queixa_principal`, `usa_lente`, `gestante`, `contraceptivo`, `qual_contraceptivo`, `hipertensao`, `ansiedade`, `sensivel_dor`, `cancer_pele`, `habitos_vida`, `botox`, `botox_local_tempo`, `tireoide`, `protetor_solar`, `protetor_solar_qual_freq`, `alergias`, `quais_alergias`, `disturbio_hormonal`, `qual_disturbio`, `marcapasso`, `menstruacao`, `classif_fototipo`, `grau_hidratacao`, `textura_pele`, `grau_oleosidade`, `acne`, `evolucao_cutanea`, `local`, `classif_goglau`, `goglau_estatica`, `goglau_dinamica`, `alteracoes_epiderme`, `lesao_pele`, `cicatriz`, `pelos`, `olheiras`, `observacao_olheiras`, `video_foto`, `protocolo`, `antes_depois`, `redes_sociais`, `acordo_tratamento`) VALUES
(18, '203.559.990-30', '', 'nao', 'nao', 'nao', '', 'nao', 'nao', 'nao', 'nao', NULL, 'nao', '', 'nao', 'nao', '', 'nao', '', 'nao', '', 'nao', 'irregular', 'v', 'normal', 'normal', 'equilibrado', 'ausente', NULL, '', 'iii', '', '', NULL, NULL, NULL, NULL, 'nao', '', '', '', 'nao', 'nao', 'nao');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ficha_melasma`
--

CREATE TABLE `ficha_melasma` (
  `id` int(3) NOT NULL,
  `cliente` varchar(14) NOT NULL,
  `data_hoje` date NOT NULL,
  `como_conheceu_trabalho` varchar(500) DEFAULT NULL,
  `filhos` enum('sim','nao') NOT NULL,
  `casada` enum('sim','nao') NOT NULL,
  `casamento_saudavel` text DEFAULT NULL,
  `queixa_principal` text DEFAULT NULL,
  `tempo_percebeu_manchas` varchar(500) DEFAULT NULL,
  `tratou_melasma` text DEFAULT NULL,
  `uso_acido` varchar(500) DEFAULT NULL,
  `problemas_saude` varchar(500) DEFAULT NULL,
  `tipo_melanina` enum('eumelanina','feumelanina') NOT NULL,
  `reacao_sol` enum('i','ii','iii','iv') NOT NULL,
  `temperatura_media` varchar(500) DEFAULT NULL,
  `uso_cosmetico_rotina_skincare` enum('sim','nao') NOT NULL,
  `rotina_dia` text DEFAULT NULL,
  `rotina_noite` text DEFAULT NULL,
  `exercicios` varchar(500) DEFAULT NULL,
  `usa_secador_chapinha` varchar(500) DEFAULT NULL,
  `concorda_troca` varchar(500) DEFAULT NULL,
  `indicacao_plano_tratamento` text DEFAULT NULL,
  `indicacao_skin_care` text DEFAULT NULL,
  `indicacao_equipe_multidisciplinar` text DEFAULT NULL,
  `indicacao_nutraceticos_orais` text DEFAULT NULL,
  `pontos_acordados` text DEFAULT NULL,
  `constatacao_raiz_problema` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ficha_melasma`
--

INSERT INTO `ficha_melasma` (`id`, `cliente`, `data_hoje`, `como_conheceu_trabalho`, `filhos`, `casada`, `casamento_saudavel`, `queixa_principal`, `tempo_percebeu_manchas`, `tratou_melasma`, `uso_acido`, `problemas_saude`, `tipo_melanina`, `reacao_sol`, `temperatura_media`, `uso_cosmetico_rotina_skincare`, `rotina_dia`, `rotina_noite`, `exercicios`, `usa_secador_chapinha`, `concorda_troca`, `indicacao_plano_tratamento`, `indicacao_skin_care`, `indicacao_equipe_multidisciplinar`, `indicacao_nutraceticos_orais`, `pontos_acordados`, `constatacao_raiz_problema`) VALUES
(3, '203.559.990-30', '2025-04-30', '', 'nao', 'nao', '', '', '', '', '', '', 'feumelanina', 'i', '', 'nao', '', '', '', 'nao', '', '', '', '', '', '', '');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `campos_comuns`
--
ALTER TABLE `campos_comuns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cliente_comuns` (`cliente`);

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`cpf`);

--
-- Índices de tabela `ficha_anamnese_corporal`
--
ALTER TABLE `ficha_anamnese_corporal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cliente_corporal` (`cliente`) USING BTREE;

--
-- Índices de tabela `ficha_anamnese_facial`
--
ALTER TABLE `ficha_anamnese_facial`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cliente_facial` (`cliente`) USING BTREE;

--
-- Índices de tabela `ficha_melasma`
--
ALTER TABLE `ficha_melasma`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cliente_melasma` (`cliente`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `campos_comuns`
--
ALTER TABLE `campos_comuns`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `ficha_anamnese_corporal`
--
ALTER TABLE `ficha_anamnese_corporal`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de tabela `ficha_anamnese_facial`
--
ALTER TABLE `ficha_anamnese_facial`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `ficha_melasma`
--
ALTER TABLE `ficha_melasma`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `campos_comuns`
--
ALTER TABLE `campos_comuns`
  ADD CONSTRAINT `fk_cliente_comuns` FOREIGN KEY (`cliente`) REFERENCES `clientes` (`cpf`);

--
-- Restrições para tabelas `ficha_anamnese_corporal`
--
ALTER TABLE `ficha_anamnese_corporal`
  ADD CONSTRAINT `fk_cliente_facial` FOREIGN KEY (`cliente`) REFERENCES `clientes` (`cpf`);

--
-- Restrições para tabelas `ficha_anamnese_facial`
--
ALTER TABLE `ficha_anamnese_facial`
  ADD CONSTRAINT `fk_cliente_facial1` FOREIGN KEY (`cliente`) REFERENCES `clientes` (`cpf`);

--
-- Restrições para tabelas `ficha_melasma`
--
ALTER TABLE `ficha_melasma`
  ADD CONSTRAINT `fk_cliente_melasma` FOREIGN KEY (`cliente`) REFERENCES `clientes` (`cpf`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
