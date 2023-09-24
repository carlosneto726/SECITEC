-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23/09/2023 às 14:55
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4
--
-- Banco de dados: db_secitec
--

-- --------------------------------------------------------

--
-- Estrutura para tabela tb_usuario
--

CREATE TABLE tb_usuario (
  id int(11) NOT NULL AUTO_INCREMENT,
  nome varchar(200) NOT NULL,
  senha varchar(8) NOT NULL,
  cpf varchar(200) NOT NULL,
  email varchar(200) DEFAULT NULL,
  PRIMARY KEY (id)
);

-- --------------------------------------------------------

--
-- Estrutura para tabela tb_proponente
--

CREATE TABLE tb_proponente (
  id int(11) NOT NULL AUTO_INCREMENT,
  nome varchar(255) NOT NULL,
  titulacao varchar(255) NOT NULL,
  url varchar(255) NOT NULL,
  PRIMARY KEY (id)
);

-- --------------------------------------------------------

--
-- Estrutura para tabela tb_proponente
--

CREATE TABLE tb_redes_proponente(
    id_proponente int(11) NOT NULL,
    rede1 varchar(255),
    rede2 varchar(255),
    rede3 varchar(255),
    PRIMARY KEY(id_proponente),
    FOREIGN KEY(id_proponente) REFERENCES tb_proponente(id) ON DELETE CASCADE
);

-- --------------------------------------------------------

--
-- Estrutura para tabela tb_tipo_evento
--

CREATE TABLE tb_tipo_evento (
    id int AUTO_INCREMENT,
    nome varchar(50) NOT NULL,
    PRIMARY KEY (id)
);

-- --------------------------------------------------------

--
-- Estrutura para tabela tb_evento
--

CREATE TABLE tb_evento (
  id int(11) NOT NULL AUTO_INCREMENT,
  titulo varchar(200) NOT NULL,
  descricao varchar(200) NOT NULL,
  dia varchar(14) NOT NULL,
  horarioI time NOT NULL,
  horarioF time NOT NULL,
  vagas int(11) NOT NULL,
  horas int(11) NOT NULL,
  local varchar(255) NOT NULL,
  url varchar(255) NOT NULL,
  id_proponente int(11) NOT NULL,
  id_tipo_evento int(11) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (id_proponente) REFERENCES tb_proponente (id),
  FOREIGN KEY (id_tipo_evento) REFERENCES tb_tipo_evento (id)
);

-- --------------------------------------------------------

--
-- Estrutura para tabela tb_evento_usuario
--

CREATE TABLE tb_evento_usuario (
  id int(11) NOT NULL AUTO_INCREMENT,
  id_evento int(11) NOT NULL,
  id_usuario int(11) NOT NULL,
  status int(11) NOT NULL,
  checkin time,
  checkout time,
  PRIMARY KEY (id),
  FOREIGN KEY (id_usuario) REFERENCES tb_usuario (id),
  FOREIGN KEY (id_evento) REFERENCES tb_evento (id)
);

-- --------------------------------------------------------

--
-- Estrutura stand-in para view vw_evento
-- (Veja abaixo para a visão atual)
--
CREATE VIEW vw_evento AS 
SELECT tb_usuario.nome AS nome, 
        tb_evento.horas AS horas, 
        tb_evento.titulo AS titulo 
FROM (tb_evento_usuario LEFT JOIN tb_usuario ON (tb_evento_usuario.id_usuario = tb_usuario.id))
    LEFT JOIN tb_evento ON(tb_evento_usuario.id_evento = tb_evento.id);


-- --------------------------------------------------------

--
-- Estrutura stand-in para view vw_eventos_usuario
-- (Veja abaixo para a visão atual)
--
CREATE VIEW vw_eventos_usuario AS
SELECT tb_usuario.nome AS nome, 
tb_evento.descricao AS descricao, 
tb_evento.horas AS horas 
FROM (
  ( tb_evento_usuario JOIN tb_usuario 
    ON(tb_usuario.id = tb_evento_usuario.id_usuario)
  ) JOIN tb_evento 
    ON(tb_evento.id = tb_evento_usuario.id_evento)
  ) 
  WHERE tb_evento_usuario.status = 1 ;


-- --------------------------------------------------------

--
-- Estrutura stand-in para view vw_evento_proponente
-- (Veja abaixo para a visão atual)
--
CREATE VIEW vw_evento_proponente AS
SELECT tb_evento.id AS id, 
tb_evento.titulo AS titulo, 
tb_evento.descricao AS descricao, 
tb_evento.dia AS dia, 
tb_evento.horarioI AS horarioI, 
tb_evento.horarioF AS horarioF, 
tb_evento.vagas AS vagas, 
tb_evento.horas AS horas, 
tb_evento.local AS local, 
tb_evento.url AS url, 
tb_evento.id_proponente AS id_proponente, 
tb_proponente.nome AS proponente, 
tb_proponente.titulacao AS titulacao, 
tb_proponente.url AS url_p 
FROM (tb_evento JOIN tb_proponente 
  ON(tb_evento.id_proponente = tb_proponente.id));

-- --------------------------------------------------------

--
-- Estrutura stand-in para view vw_horas_usuario
-- (Veja abaixo para a visão atual)
--
CREATE VIEW vw_horas_usuario AS
SELECT tb_usuario.nome AS nome_usuario, 
sum(tb_evento.horas) AS total_horas 
FROM ((tb_usuario 
  JOIN tb_evento_usuario ON(tb_usuario.id = tb_evento_usuario.id_usuario)) 
  JOIN tb_evento ON(tb_evento_usuario.id_evento = tb_evento.id)) 
  WHERE tb_evento_usuario.status = 1 GROUP BY tb_usuario.id ;

-- --------------------------------------------------------

--
-- Estrutura stand-in para view vw_nome
-- (Veja abaixo para a visão atual)
--
CREATE VIEW vw_nome AS
SELECT DISTINCT tb_usuario.nome AS nome 
FROM ((tb_evento_usuario 
  LEFT JOIN tb_usuario ON(tb_evento_usuario.id_usuario = tb_usuario.id)) 
  LEFT JOIN tb_evento ON(tb_evento_usuario.id_evento = tb_evento.id));


INSERT INTO tb_tipo_evento (nome) VALUES
    ('palestra'),
    ('mini-curso'),
    ('oficina'),
    ('hackathon');