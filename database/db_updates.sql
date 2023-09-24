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