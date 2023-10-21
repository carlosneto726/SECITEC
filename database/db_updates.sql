-- ---------------------------------------
-- Arquivo para atualizar o banco de dados


-- Query 1:
-- O usuário não mais precisar de matricula, pois nem todos usuários vai ter uma matricula do IFG.
ALTER TABLE tb_usuario
DROP COLUMN tb_usuario.matricula;

-- Query 2:
-- Adicionando uma tabela para as redes sociais dos proponentes.
CREATE TABLE tb_redes_proponente(
    id_proponente int(11) NOT NULL,
    rede1 varchar(255),
    rede2 varchar(255),
    rede3 varchar(255),
    PRIMARY KEY(id_proponente),
    FOREIGN KEY(id_proponente) REFERENCES tb_proponente(id) ON DELETE CASCADE
);

-- Query 3:
-- Alterando os valores da coluna checkin e checkout da tabela tb_evento_usuario para aceitar null 

ALTER TABLE tb_evento_usuario MODIFY checkin time;
ALTER TABLE tb_evento_usuario MODIFY checkout time;


-- Query 4:
-- Adicionando colunas para a validação e ativação da conta do usuário
ALTER TABLE tb_usuario 
ADD COLUMN token varchar(255),
ADD COLUMN status int(11),
MODIFY COLUMN senha varchar(255) NOT NULL;

-- Query 5:
-- Alterando a view da view para mostrar o nome do tipo de evento
ALTER VIEW vw_evento_proponente AS
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
tb_proponente.url AS url_p,
tb_tipo_evento.nome AS nome_tipo_evento
FROM (tb_evento JOIN tb_proponente 
  ON(tb_evento.id_proponente = tb_proponente.id))
  INNER JOIN tb_tipo_evento ON tb_evento.id_tipo_evento = tb_tipo_evento.id;


ALTER TABLE tb_evento_usuario
ADD COLUMN data_insercao DATE;

-- Query 6:
-- 
CREATE TABLE tb_proponente_evento(
  id int(11) NOT NULL AUTO_INCREMENT,
  id_evento int(11) NOT NULL,
  id_proponente int(11) NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(id_proponente) REFERENCES tb_proponente(id) ON DELETE CASCADE,
  FOREIGN KEY(id_evento) REFERENCES tb_evento(id) ON DELETE CASCADE
);


ALTER VIEW vw_evento_proponente AS
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
tb_tipo_evento.nome AS nome_tipo_evento
FROM tb_evento INNER JOIN tb_tipo_evento ON tb_evento.id_tipo_evento = tb_tipo_evento.id;

-- Query 7:
-- 

CREATE TABLE log_tb_evento_usuario (
  id int(11) NOT NULL AUTO_INCREMENT,
  nome_evento varchar(255) NOT NULL,
  nome_usuario varchar(255) NOT NULL,
  tipo_operacao varchar(15) NOT NULL,
  data_hora datetime NOT NULL,
  PRIMARY KEY (id)
);


DELIMITER //
CREATE TRIGGER trigger_inserir_log_tb_evento_usuario AFTER INSERT ON tb_evento_usuario
FOR EACH ROW
BEGIN
    -- Inserir os dados na tabela log_tb_evento_usuario após a inserção
    INSERT INTO log_tb_evento_usuario (nome_evento, nome_usuario, tipo_operacao, data_hora)
    SELECT
        (SELECT titulo FROM tb_evento WHERE id = NEW.id_evento),
        (SELECT nome FROM tb_usuario WHERE id = NEW.id_usuario),
        'CADASTRAR',
        NOW();
END;
//
DELIMITER ;
DELIMITER //
CREATE TRIGGER trigger_excluir_log_tb_evento_usuario AFTER DELETE ON tb_evento_usuario
FOR EACH ROW
BEGIN
    -- Inserir os dados na tabela log_tb_evento_usuario após a exclusão
    INSERT INTO log_tb_evento_usuario (nome_evento, nome_usuario, tipo_operacao, data_hora)
    SELECT
        (SELECT titulo FROM tb_evento WHERE id = OLD.id_evento),
        (SELECT nome FROM tb_usuario WHERE id = OLD.id_usuario),
        'DESCADASTRAR',
        NOW();
END;
//
DELIMITER ;

-- Query 8:
-- 
ALTER TABLE tb_usuario
MODIFY COLUMN tb_usuario.nome VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN tb_usuario.senha VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN tb_usuario.cpf VARCHAR(255) DEFAULT NULL,
MODIFY COLUMN tb_usuario.email VARCHAR(255) NOT NULL,
MODIFY COLUMN tb_usuario.token VARCHAR(255) NOT NULL,
MODIFY COLUMN tb_usuario.status VARCHAR(255) NOT NULL;

-- Query 9:
--

CREATE VIEW vw_proponente_evento AS
SELECT tb_proponente.nome AS nome,
tb_evento.horas AS horas,
tb_evento.titulo AS titulo,
tb_tipo_evento.nome AS tipo_evento 
FROM 
(
  (
    (tb_proponente_evento LEFT JOIN tb_proponente ON tb_proponente_evento.id_proponente = tb_proponente.id) 
    LEFT JOIN tb_evento ON tb_proponente_evento.id_evento = tb_evento.id
  ) 
  LEFT JOIN tb_tipo_evento ON tb_tipo_evento.id = tb_evento.id_tipo_evento
);