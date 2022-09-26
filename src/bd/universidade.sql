-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26-Set-2022 às 22:54
-- Versão do servidor: 10.4.20-MariaDB
-- versão do PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `universidade`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `alunos`
--

CREATE TABLE `alunos` (
  `ID` int(11) NOT NULL,
  `NOME` varchar(255) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `TELEFONE` varchar(11) NOT NULL,
  `IMG` varchar(255) DEFAULT NULL,
  `SENHA` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `alunos`
--

INSERT INTO `alunos` (`ID`, `NOME`, `EMAIL`, `TELEFONE`, `IMG`, `SENHA`) VALUES
(1, 'Pedro Estevão Paulista', 'pedropaulista11@gmail.com', '21474836471', 'pedro.jpeg', 'b96f5bfc7c861e708e9f5363e33e70b4');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cursos`
--

CREATE TABLE `cursos` (
  `ID` int(11) NOT NULL,
  `CURSO` varchar(255) NOT NULL,
  `DESCRICAO` varchar(500) NOT NULL,
  `PERIODO` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cursos`
--

INSERT INTO `cursos` (`ID`, `CURSO`, `DESCRICAO`, `PERIODO`) VALUES
(1, 'Ciência da Computação', 'O Curso de Ciência da Computação da Barão de Mauá, apresenta uma sólida formação conceitual, teórica e prática em diversas áreas da computação, voltada para o desenvolvimento de novas ferramentas, transferência de tecnologia e solução de problemas computacionais de outras áreas de conhecimento.', 'Noturno');

-- --------------------------------------------------------

--
-- Estrutura da tabela `devolutiva_trabalhos`
--

CREATE TABLE `devolutiva_trabalhos` (
  `ID` int(11) NOT NULL,
  `DESCRICAO` varchar(500) DEFAULT NULL,
  `DEVOLUTIVA` varchar(255) DEFAULT NULL,
  `NOTA` decimal(10,2) NOT NULL DEFAULT 0.00,
  `SITUACAO` varchar(19) NOT NULL DEFAULT 'AGUARDANDO CORREÇÃO',
  `MATRICULA` int(11) NOT NULL,
  `TRABALHO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `devolutiva_trabalhos`
--

INSERT INTO `devolutiva_trabalhos` (`ID`, `DESCRICAO`, `DEVOLUTIVA`, `NOTA`, `SITUACAO`, `MATRICULA`, `TRABALHO`) VALUES
(1, 'Primeiro teste de devolução', 'primeiro-teste-devolucao.pdf', '0.00', 'AGUARDANDO CORREÇÃO', 1, 10),
(2, 'Teste de devolução corrigida', 'primeiro-teste-devolucao.pdf', '0.98', 'CORRIGIDO', 1, 8),
(5, 'Teste pós devolutiva dinâmica', 'dff4f4029f3f651ee161c8e788a360fe.pdf', '0.00', 'AGUARDANDO CORREÇÃO', 1, 11);

-- --------------------------------------------------------

--
-- Estrutura da tabela `grade`
--

CREATE TABLE `grade` (
  `ID` int(11) NOT NULL,
  `CURSO` int(11) NOT NULL,
  `MATERIA` int(11) NOT NULL,
  `PROFESSOR` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `grade`
--

INSERT INTO `grade` (`ID`, `CURSO`, `MATERIA`, `PROFESSOR`) VALUES
(1, 1, 1, 2),
(2, 1, 3, 2),
(3, 1, 2, 3),
(4, 1, 4, 4),
(5, 1, 5, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `materias`
--

CREATE TABLE `materias` (
  `ID` int(11) NOT NULL,
  `MATERIA` varchar(255) NOT NULL,
  `DESCRICAO` varchar(500) NOT NULL,
  `IMG` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `materias`
--

INSERT INTO `materias` (`ID`, `MATERIA`, `DESCRICAO`, `IMG`) VALUES
(1, 'Técnicas de Programação I', 'A disciplina de Técnicas de Programação compreende os conceitos e boas práticas para a criação de programas de computadores, através de técnicas e recursos como: variáveis, tipos de dados, modularização, estruturas de controle, funções e procedimentos e recursividade.', 'tecnicas-de-programacao.jpg'),
(2, 'Lógica Matemática', 'A lógica matemática é uma subárea da matemática que explora as aplicações da lógica formal para a matemática. Basicamente, tem ligações fortes com matemática, os fundamentos da matemática e ciência da computação teórica.', 'logica-matemarica.jpg'),
(3, 'Laboratório de Técnicas de Programação I', 'Outra parte da pesquisa se concentra na linha de Metodologia e Técnicas de Computação, especialmente em projetos relacionados à programação em ponto grande, onde são ressaltadas a importância da modularidade, do reuso, da qualidade do software, do custo de manutenção etc.', 'laboratorio-tecnicas-de-programacao.jpg'),
(4, 'Circuitos Digitais', 'Os circuitos digitais ou circuitos lógicos são definidos como circuitos eletrônicos que empregam a utilização de sinais elétricos em apenas dois níveis de corrente (ou tensão) para definir a representação de valores binários.', 'circuitos-digitais.jpg'),
(5, 'Cálculo Diferencial e Integral I', 'O Cálculo Diferencial e Integral estuda as taxas de variação de grandezas e a acumulação de quantidades, de maneira mais simples, por meio dele se pode calcular a variação da inclinação de uma reta, bem como a área abaixo de determinado sólido.', 'calculo-1.webp');

-- --------------------------------------------------------

--
-- Estrutura da tabela `matricula`
--

CREATE TABLE `matricula` (
  `ID` int(11) NOT NULL,
  `MATRICULA` varchar(255) DEFAULT NULL,
  `ALUNO` int(11) NOT NULL,
  `CURSO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `matricula`
--

INSERT INTO `matricula` (`ID`, `MATRICULA`, `ALUNO`, `CURSO`) VALUES
(1, '2173562', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `notas_provas`
--

CREATE TABLE `notas_provas` (
  `ID` int(11) NOT NULL,
  `DESCRICAO` varchar(500) NOT NULL,
  `NOTA` decimal(10,2) NOT NULL DEFAULT 0.00,
  `SITUACAO` varchar(20) NOT NULL DEFAULT 'AGUARDANDO CORREÇÃO',
  `MATRICULA` int(11) NOT NULL,
  `PROVA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `notas_provas`
--

INSERT INTO `notas_provas` (`ID`, `DESCRICAO`, `NOTA`, `SITUACAO`, `MATRICULA`, `PROVA`) VALUES
(1, 'Muito bem, só preste um pouco mais de atenção.', '4.10', 'CORRIGIDO', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `professores`
--

CREATE TABLE `professores` (
  `ID` int(11) NOT NULL,
  `NOME` varchar(255) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `CODIGO` varchar(255) DEFAULT NULL,
  `TELEFONE` varchar(11) NOT NULL,
  `IMG` varchar(255) DEFAULT NULL,
  `SENHA` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `professores`
--

INSERT INTO `professores` (`ID`, `NOME`, `EMAIL`, `CODIGO`, `TELEFONE`, `IMG`, `SENHA`) VALUES
(1, 'Elon Musk', 'ellmusk@spacex.com', '1111111', '21474836476', NULL, 'bf2c0220a6691b3cf8b2b10bcaf943eb'),
(2, 'Thiago Nicola Cajuela Garcia', 'thiago.nicola@baraodemaua.br', '2222222', '16996814577', NULL, 'd07ce551b3befa789094244e954b8560'),
(3, 'Jean Jacques Georges Soares de Groote', 'jeangroot@outlook.com', '3333333', '18985647312', NULL, '28bd300c00f6546db35d5863a1cac435'),
(4, 'Heloisa Helena D. Oliveira Rocha Bidoia', 'helodrocha@msn.com', '4444444', '17996748532', NULL, '5afa79aa04ae89bc65a865e775176550');

-- --------------------------------------------------------

--
-- Estrutura da tabela `provas`
--

CREATE TABLE `provas` (
  `ID` int(11) NOT NULL,
  `PROVA` varchar(255) NOT NULL,
  `DATA` datetime NOT NULL,
  `DESCRICAO` varchar(500) NOT NULL,
  `MATERIAL` varchar(255) DEFAULT NULL,
  `RELACAO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `provas`
--

INSERT INTO `provas` (`ID`, `PROVA`, `DATA`, `DESCRICAO`, `MATERIAL`, `RELACAO`) VALUES
(1, 'Prova 3º Bimestre', '2022-09-19 19:10:00', 'Estudar tudo o que foi passado sobre javascript e funções.', NULL, 1),
(2, 'Prova 4º Bimestre', '2022-11-28 19:10:00', 'A ser definido', 'd2f6b9fb361ff2ac317d35ff40539495.pdf', 1),
(3, 'Prova 2º Bimestre', '2022-05-10 19:20:47', 'Teste de não realização de prova', NULL, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `relacao_materia`
--

CREATE TABLE `relacao_materia` (
  `ID` int(11) NOT NULL,
  `SEMESTRE` int(1) NOT NULL,
  `GRADE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `relacao_materia`
--

INSERT INTO `relacao_materia` (`ID`, `SEMESTRE`, `GRADE`) VALUES
(1, 2, 1),
(2, 2, 2),
(3, 2, 3),
(4, 2, 4),
(5, 2, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `relacao_notas`
--

CREATE TABLE `relacao_notas` (
  `ID` int(11) NOT NULL,
  `SEMESTRE` int(1) NOT NULL,
  `NOTA_1` decimal(10,2) DEFAULT 0.00,
  `NOTA_2` decimal(10,2) DEFAULT 0.00,
  `NOTA_FINAL` decimal(10,2) DEFAULT 0.00,
  `SITUACAO` varchar(15) NOT NULL DEFAULT 'CALCULANDO',
  `GRADE` int(11) NOT NULL,
  `MATRICULA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `relacao_notas`
--

INSERT INTO `relacao_notas` (`ID`, `SEMESTRE`, `NOTA_1`, `NOTA_2`, `NOTA_FINAL`, `SITUACAO`, `GRADE`, `MATRICULA`) VALUES
(1, 2, '0.00', '0.00', '0.00', 'CALCULANDO', 1, 1),
(2, 2, '0.00', '0.00', '0.00', 'CALCULANDO', 2, 1),
(3, 2, '0.00', '0.00', '0.00', 'CALCULANDO', 3, 1),
(4, 2, '0.00', '0.00', '0.00', 'CALCULANDO', 4, 1),
(5, 2, '0.00', '0.00', '0.00', 'CALCULANDO', 5, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `trabalhos`
--

CREATE TABLE `trabalhos` (
  `ID` int(11) NOT NULL,
  `TRABALHO` varchar(255) NOT NULL,
  `DATA_INICIO` datetime NOT NULL,
  `DATA_FIM` datetime NOT NULL,
  `DESCRICAO` varchar(500) NOT NULL,
  `MATERIAL` varchar(255) DEFAULT NULL,
  `RELACAO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `trabalhos`
--

INSERT INTO `trabalhos` (`ID`, `TRABALHO`, `DATA_INICIO`, `DATA_FIM`, `DESCRICAO`, `MATERIAL`, `RELACAO`) VALUES
(8, 'Variáveis', '2022-09-25 12:45:34', '2022-08-15 23:59:00', 'Complete a lista de exercícios, apenas texto. Não é necessário código.', 'f003616de0075137353c158d4d15a570.pdf', 1),
(9, 'Protótipos', '2022-09-25 12:48:47', '2022-08-23 23:59:00', 'Verifique informações sobre o exercício no PDF em anexo.', 'd5e68535cb9b4a8a11e8629def80a5b9.pdf', 1),
(10, 'Desenvolver Projeto', '2022-09-25 16:44:46', '2022-09-26 19:10:00', 'Desenvolver um projeto a sua escolha utilizando os conhecimentos aprendidos em aula.', 'e7f4c991320a870429fcc57e84b613e9.pdf', 1),
(11, 'Desenvolver Calculadora Unity', '2022-09-25 18:42:18', '2022-10-10 23:59:00', 'Com base na aula de unity desenvolva uma calculadora.', '85a67544821af4f958de30a0e802ab7e.pdf', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`ID`);

--
-- Índices para tabela `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`ID`);

--
-- Índices para tabela `devolutiva_trabalhos`
--
ALTER TABLE `devolutiva_trabalhos`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDTRABALHO_DEVOLUTIVA` (`TRABALHO`),
  ADD KEY `IDMATRICULA_DEVOLUTIVA` (`MATRICULA`);

--
-- Índices para tabela `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `CURSO` (`CURSO`),
  ADD KEY `MATERIA` (`MATERIA`),
  ADD KEY `PROFESSOR` (`PROFESSOR`);

--
-- Índices para tabela `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`ID`);

--
-- Índices para tabela `matricula`
--
ALTER TABLE `matricula`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `MATRICULA` (`MATRICULA`),
  ADD KEY `ALUNO` (`ALUNO`),
  ADD KEY `CURSO_MATRICULA` (`CURSO`);

--
-- Índices para tabela `notas_provas`
--
ALTER TABLE `notas_provas`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDPROVA_NOTAS` (`PROVA`),
  ADD KEY `IDMATRICULA_NOTAS_PROVAS` (`MATRICULA`);

--
-- Índices para tabela `professores`
--
ALTER TABLE `professores`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `CODIGO` (`CODIGO`);

--
-- Índices para tabela `provas`
--
ALTER TABLE `provas`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDRELACAO_PROVA` (`RELACAO`);

--
-- Índices para tabela `relacao_materia`
--
ALTER TABLE `relacao_materia`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDGRADE_RELACAO` (`GRADE`);

--
-- Índices para tabela `relacao_notas`
--
ALTER TABLE `relacao_notas`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDGRADE_RELACAO_NOTAS` (`GRADE`),
  ADD KEY `IDMATRICULA_RELACAO_NOTA` (`MATRICULA`);

--
-- Índices para tabela `trabalhos`
--
ALTER TABLE `trabalhos`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `IDRELACAO_TRABALHO` (`RELACAO`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alunos`
--
ALTER TABLE `alunos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `cursos`
--
ALTER TABLE `cursos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `devolutiva_trabalhos`
--
ALTER TABLE `devolutiva_trabalhos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `grade`
--
ALTER TABLE `grade`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `materias`
--
ALTER TABLE `materias`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `matricula`
--
ALTER TABLE `matricula`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `notas_provas`
--
ALTER TABLE `notas_provas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `professores`
--
ALTER TABLE `professores`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `provas`
--
ALTER TABLE `provas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `relacao_materia`
--
ALTER TABLE `relacao_materia`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `relacao_notas`
--
ALTER TABLE `relacao_notas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `trabalhos`
--
ALTER TABLE `trabalhos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `devolutiva_trabalhos`
--
ALTER TABLE `devolutiva_trabalhos`
  ADD CONSTRAINT `IDMATRICULA_DEVOLUTIVA` FOREIGN KEY (`MATRICULA`) REFERENCES `matricula` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `IDTRABALHO_DEVOLUTIVA` FOREIGN KEY (`TRABALHO`) REFERENCES `trabalhos` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `grade`
--
ALTER TABLE `grade`
  ADD CONSTRAINT `CURSO` FOREIGN KEY (`CURSO`) REFERENCES `cursos` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `MATERIA` FOREIGN KEY (`MATERIA`) REFERENCES `materias` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `PROFESSOR` FOREIGN KEY (`PROFESSOR`) REFERENCES `professores` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `matricula`
--
ALTER TABLE `matricula`
  ADD CONSTRAINT `ALUNO` FOREIGN KEY (`ALUNO`) REFERENCES `alunos` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `CURSO_MATRICULA` FOREIGN KEY (`CURSO`) REFERENCES `cursos` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `notas_provas`
--
ALTER TABLE `notas_provas`
  ADD CONSTRAINT `IDMATRICULA_NOTAS_PROVAS` FOREIGN KEY (`MATRICULA`) REFERENCES `matricula` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `IDPROVA_NOTAS` FOREIGN KEY (`PROVA`) REFERENCES `provas` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `provas`
--
ALTER TABLE `provas`
  ADD CONSTRAINT `IDRELACAO_PROVA` FOREIGN KEY (`RELACAO`) REFERENCES `relacao_materia` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `relacao_materia`
--
ALTER TABLE `relacao_materia`
  ADD CONSTRAINT `IDGRADE_RELACAO` FOREIGN KEY (`GRADE`) REFERENCES `grade` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `relacao_notas`
--
ALTER TABLE `relacao_notas`
  ADD CONSTRAINT `IDGRADE_RELACAO_NOTAS` FOREIGN KEY (`GRADE`) REFERENCES `grade` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `IDMATRICULA_RELACAO_NOTA` FOREIGN KEY (`MATRICULA`) REFERENCES `matricula` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `trabalhos`
--
ALTER TABLE `trabalhos`
  ADD CONSTRAINT `IDRELACAO_TRABALHO` FOREIGN KEY (`RELACAO`) REFERENCES `relacao_materia` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
