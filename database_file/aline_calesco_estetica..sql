-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 20/04/2025 às 18:08
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
  `status_ficha_melasma` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ficha_anamnese_corporal`
--

CREATE TABLE `ficha_anamnese_corporal` (
  `id` int(3) NOT NULL,
  `cliente` varchar(14) NOT NULL,
  `usa_cosmetico` enum('sim','nao') NOT NULL,
  `qual_cosmetico` varchar(200) DEFAULT NULL,
  `fumante` enum('sim','nao') NOT NULL,
  `ingere_alcool` enum('sim','nao') NOT NULL,
  `qtde_copos_agua` int(2) NOT NULL,
  `qualidade_sono` enum('bom','ruim','pessimo') NOT NULL,
  `qualidade_alimentacao` enum('bom','ruim','pessimo') NOT NULL,
  `dieta_rigorosa` enum('sim','nao') NOT NULL,
  `patologia_pele` enum('hipotireoidismo','hipertiroidismo','nao') NOT NULL,
  `toma_medicacao` enum('sim','nao') NOT NULL,
  `qual_medicacao` varchar(200) DEFAULT NULL,
  `quanto_tempo_medicacao` varchar(200) DEFAULT NULL,
  `usa_suplemento_oral` enum('sim','nao') NOT NULL,
  `qual_suplemento_oral` varchar(200) DEFAULT NULL,
  `trombose` enum('sim','nao') NOT NULL,
  `qual_trombose` varchar(200) DEFAULT NULL,
  `antecendentes_oncologicos` enum('sim','nao') NOT NULL,
  `diabetes` enum('sim','nao') NOT NULL,
  `qual_diabetes` varchar(200) DEFAULT NULL,
  `cirurgia_plastica_estetica` enum('sim','nao') NOT NULL,
  `qual_cirurgia_plastica` varchar(200) DEFAULT NULL,
  `queixa_alopecia` varchar(500) DEFAULT NULL,
  `doenca_acomete_corpo` enum('sim','nao') DEFAULT NULL,
  `qual_doenca_acomete_corpo` varchar(200) DEFAULT NULL,
  `tempo_disfuncao` varchar(200) DEFAULT NULL,
  `status_disfuncao` enum('estavel','aumentando','diminiundo') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ficha_anamnese_facial`
--

CREATE TABLE `ficha_anamnese_facial` (
  `id` int(3) NOT NULL,
  `cliente` varchar(14) NOT NULL,
  `queixa_principal` varchar(500) NOT NULL,
  `fez_tratamento` enum('sim','nao') NOT NULL,
  `qual_tratamento` varchar(200) DEFAULT NULL,
  `obteve_melhora` varchar(200) DEFAULT NULL,
  `usa_lente` enum('sim','nao') NOT NULL,
  `gestante` enum('sim','nao') NOT NULL,
  `contraceptivo` enum('sim','nao') NOT NULL,
  `qual_contraceptivo` varchar(200) DEFAULT NULL,
  `ingestao_agua` enum('sim','nao') NOT NULL,
  `litros_agua` varchar(10) DEFAULT NULL,
  `classificacao_alimentacao` enum('otima','boa','regular','ruim','pessima') NOT NULL,
  `predominio_alimentar` varchar(200) DEFAULT NULL,
  `hipertensao` enum('sim','nao') NOT NULL,
  `intestino_normal` enum('sim','nao') NOT NULL,
  `insonia` enum('sim','nao') NOT NULL,
  `ansiedade` enum('sim','nao') NOT NULL,
  `sensivel_dor` enum('sim','nao') NOT NULL,
  `cancer_pele` enum('sim','nao') NOT NULL,
  `habitos_vida` varchar(200) DEFAULT NULL,
  `medicamentos` enum('sim','nao') NOT NULL,
  `medicamentos_qual_freq` varchar(200) DEFAULT NULL,
  `cosmeticos` enum('sim','nao') NOT NULL,
  `cosmeticos_qual_freq` varchar(200) DEFAULT NULL,
  `botox` enum('sim','nao') NOT NULL,
  `botox_local_tempo` varchar(200) DEFAULT NULL,
  `tireoide` enum('sim','nao') NOT NULL,
  `trombose` enum('sim','nao') NOT NULL,
  `protetor_solar` enum('sim','nao') NOT NULL,
  `protetor_solar_qual_freq` varchar(200) DEFAULT NULL,
  `alergias` enum('sim','nao') NOT NULL,
  `quais_alergias` varchar(200) DEFAULT NULL,
  `exposicao_sol` enum('sim','nao') NOT NULL,
  `disturbio_hormonal` enum('sim','nao') NOT NULL,
  `qual_disturbio` varchar(200) DEFAULT NULL,
  `problemas_cardiacos` enum('sim','nao') NOT NULL,
  `quais_cardiacos` varchar(200) DEFAULT NULL,
  `marcapasso` enum('sim','nao') NOT NULL,
  `diabetes` enum('sim','nao') NOT NULL,
  `menstruacao` enum('regular','irregular','menopausa','histerectomia') NOT NULL,
  `fototipo` enum('i','ii','iii','iv','v','vi') NOT NULL,
  `classif_fototipo` enum('i','ii','iii','iv','v','vi') NOT NULL,
  `tipo_pele` enum('normal','mista','seca','oleosa','sensível','acneica') NOT NULL,
  `grau_hidratacao` enum('normal','desidratada_superficial','desidratada_profunda') NOT NULL,
  `textura_pele` enum('lisa','aspera','fina','grossa','normal') NOT NULL,
  `grau_oleosidade` enum('equilibrado','aumentado','excessivo','pontual') NOT NULL,
  `acne` enum('ausente','i','ii','iii','iv') NOT NULL,
  `evolucao_cutanea` varchar(200) DEFAULT NULL,
  `local` varchar(200) DEFAULT NULL,
  `classif_goglau` enum('i','ii','iii','iv') NOT NULL,
  `goglau_estatica` varchar(200) DEFAULT NULL,
  `goglau_dinamica` varchar(200) DEFAULT NULL,
  `alteracoes_epiderme` varchar(200) DEFAULT NULL,
  `lesao_pele` varchar(100) DEFAULT NULL,
  `cicatriz` varchar(200) DEFAULT NULL,
  `pelos` varchar(200) DEFAULT NULL,
  `olheiras` enum('sim','nao') NOT NULL,
  `observacao_olheiras` varchar(200) DEFAULT NULL,
  `video_foto` varchar(500) DEFAULT NULL,
  `protocolo` varchar(500) DEFAULT NULL,
  `antes_depois` enum('sim','nao') NOT NULL,
  `redes_sociais` enum('sim','nao') NOT NULL,
  `acordo_tratamento` enum('sim','nao') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ficha_melasma`
--

CREATE TABLE `ficha_melasma` (
  `id` int(3) NOT NULL,
  `cliente` varchar(14) NOT NULL,
  `data_hoje` date NOT NULL,
  `como_conheceu_trabalho` varchar(200) NOT NULL,
  `filhos` enum('sim','nao') NOT NULL,
  `casada` enum('sim','nao') NOT NULL,
  `casamento_saudavel` varchar(200) DEFAULT NULL,
  `queixa_principal` varchar(500) NOT NULL,
  `tempo_percebeu` varchar(200) NOT NULL,
  `tempo_percebeu_manchas` varchar(200) NOT NULL,
  `tratou_melasma` varchar(200) NOT NULL,
  `uso_acido` varchar(200) NOT NULL,
  `problemas_saude` varchar(200) DEFAULT NULL,
  `medicacao` varchar(200) NOT NULL,
  `tipo_pele` enum('oleosa','mista','seca','normal','sensivel','acneia') NOT NULL,
  `fototipo` enum('i','ii','iii','iv','v','vi') NOT NULL,
  `tipo_melanina` enum('eumelanina','feumelanina') NOT NULL,
  `reacao_sol` enum('i','ii','iii','iv') NOT NULL,
  `nivel_exposicao_radiacao` varchar(200) NOT NULL,
  `temperatura_media` varchar(200) NOT NULL,
  `tratamentos_ja_realizou` varchar(500) NOT NULL,
  `uso_cosmetico_rotina_skincare` enum('sim','nao') NOT NULL,
  `rotina_dia` varchar(300) DEFAULT NULL,
  `rotina_noite` varchar(300) DEFAULT NULL,
  `alimentacao_detalhada` varchar(300) NOT NULL,
  `qtde_agua` varchar(200) NOT NULL,
  `ingere_diuretico` varchar(200) NOT NULL,
  `sono` varchar(200) NOT NULL,
  `exercicios` varchar(200) NOT NULL,
  `usa_secador_chapinha` varchar(200) NOT NULL,
  `funcionamento_intestinal` varchar(300) NOT NULL,
  `concorda_troca` varchar(200) NOT NULL,
  `indicacao_plano_tratamento` varchar(300) NOT NULL,
  `indicacao_skin_care` varchar(300) NOT NULL,
  `indicacao_equipe_multidisciplinar` varchar(300) NOT NULL,
  `indicacao_nutraceticos_orais` varchar(300) NOT NULL,
  `pontos_acordados` varchar(300) NOT NULL,
  `constatacao_raiz_problema` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

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
-- AUTO_INCREMENT de tabela `ficha_anamnese_corporal`
--
ALTER TABLE `ficha_anamnese_corporal`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `ficha_anamnese_facial`
--
ALTER TABLE `ficha_anamnese_facial`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para tabelas despejadas
--

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
