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

