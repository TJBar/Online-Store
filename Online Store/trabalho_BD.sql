DROP DATABASE IF EXISTS Loja_pc;
CREATE DATABASE Loja_pc;
USE Loja_pc;
 
CREATE TABLE IF NOT EXISTS Cliente (
    n_cliente INTEGER NOT NULL AUTO_INCREMENT,
    nome_cliente VARCHAR(255),
    codigo_postal 255(255),
    localidade VARCHAR(100),
    NIF VARCHAR(255),
    nivel_acesso INTEGER DEFAULT 1,
    contacto VARCHAR(255),
    email VARCHAR(255),
    username VARCHAR(255),
    password VARCHAR(255),
     
    PRIMARY KEY (n_cliente)
);
 

 
CREATE TABLE IF NOT EXISTS Fatura (
    n_fatura INTEGER NOT NULL AUTO_INCREMENT,
    preco_final DECIMAL(15,2),
    data_emissao DATE,
     
    PRIMARY KEY (n_fatura)
);
 
CREATE TABLE IF NOT EXISTS Reparacao (
    n_reparacao INTEGER NOT NULL AUTO_INCREMENT,
    n_cliente INTEGER,
    n_fatura INTEGER,
    tipo_pc VARCHAR(255),
    parte_danificada VARCHAR(255),
	marca_danificada VARCHAR(255),
	modelo_danificado VARCHAR(255),
    data_entrega DATE,
    descricao_problema LONGTEXT,
	estado VARCHAR(255) DEFAULT 'A Processar',
     
    PRIMARY KEY (n_reparacao),
    FOREIGN KEY (n_cliente) REFERENCES Cliente(n_cliente),
    FOREIGN KEY (n_fatura) REFERENCES Fatura(n_fatura)

);
 
CREATE TABLE IF NOT EXISTS Marca (
    n_marca INTEGER,
    nome_marca VARCHAR(255),
    reputacao TEXT,
     
    PRIMARY KEY (n_marca)
);
 
CREATE TABLE IF NOT EXISTS Peca(
    n_peca INTEGER AUTO_INCREMENT,
    n_marca INTEGER,
    tipo_peca VARCHAR(255),
    qtd_stock INTEGER,
    nome_peca VARCHAR(255),
     
    PRIMARY KEY (n_peca),
    FOREIGN KEY (n_marca) REFERENCES Marca(n_marca)

);
 
CREATE TABLE IF NOT EXISTS Linhas_Reparacao(
    n_reparacao INTEGER,
    n_peca  INTEGER,
    quantidade INTEGER,
    preco DECIMAL(15,2),
	parte_danificada VARCHAR(255),
    especializacao_servico VARCHAR(255),
     
    PRIMARY KEY (n_reparacao, n_peca),
    FOREIGN KEY (n_reparacao) REFERENCES Reparacao(n_reparacao),
    FOREIGN KEY (n_peca) REFERENCES Peca(n_peca)

);
 
CREATE TABLE IF NOT EXISTS Funcionario(
    n_funcionario INTEGER NOT NULL AUTO_INCREMENT,
    nome_funcionario VARCHAR(255),
    salario DECIMAL(15,2),
    nivel_acesso INTEGER DEFAULT 2,
    especializacao LONGTEXT,
    localidade VARCHAR(255),
    contacto VARCHAR(255),
    NIF VARCHAR(255),
	email VARCHAR(255),
	codigo_postal VARCHAR(255),
	username VARCHAR(255),
	password VARCHAR(255),
     
    PRIMARY KEY (n_funcionario)
);
 
CREATE TABLE IF NOT EXISTS Participacao(
    n_reparacao INTEGER,
    n_peca INTEGER,
    n_funcionario INTEGER,
    tempo_trabalho TIME,
     
    PRIMARY KEY (n_peca, n_reparacao, n_funcionario),
    FOREIGN KEY (n_peca) REFERENCES Linhas_Reparacao(n_peca),
    FOREIGN KEY (n_funcionario) REFERENCES Funcionario(n_funcionario),
    FOREIGN KEY (n_reparacao) REFERENCES Linhas_Reparacao(n_reparacao)
	
);
 
CREATE TABLE IF NOT EXISTS Fornecedor (
    n_fornecedor INTEGER NOT NULL AUTO_INCREMENT,
    contacto VARCHAR(255),
    nome_fornecedor VARCHAR(255),
    localidade VARCHAR(255),
     
    PRIMARY KEY (n_fornecedor)
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS Encomenda (
    n_peca INTEGER,
    n_fornecedor INTEGER,
    data_encomenda DATE,
    quantidade INTEGER,
     
    PRIMARY KEY (n_peca, n_fornecedor),
    FOREIGN KEY (n_peca) REFERENCES Peca(n_peca),
    FOREIGN KEY (n_fornecedor) REFERENCES Fornecedor(n_fornecedor)

);
 
INSERT INTO Marca
VALUES	(1,'NVIDIA','LEGENDARY'),
		(2,'AMD','GOOD'),
		(3,'ASUS','GOOD'),
		(4,'kingston','GOOD'),
		(5,'Corsair','GOOD'),
		(6,'Seagate','GOOD'),
		(7,'Western Digital','GOOD'),	
		(8,'Intel','GOOD'),	
		(9,'Cooler Master','GOOD'),	
		(10,'Cryorig','GOOD'),			
		(11,'MSI','GOOD');

INSERT INTO Peca
VALUES  (DEFAULT,1,'graphic_card',10,'1080'),
		(DEFAULT,1,'graphic_card',10,'1070'),

		(DEFAULT,2,'graphic_card',10,'r9_380x'),
		(DEFAULT,2,'graphic_card',10,'r7_360'),

		(DEFAULT,3,'motherboard',10,'asrock_z97x'),
		(DEFAULT,3,'motherboard',10,'Sabertooth_z97'),
		
		(DEFAULT,11,'motherboard',10,'maximum_hero_8'),
		(DEFAULT,11,'motherboard',10,'msi_970'),

		(DEFAULT,4,'ram',10,'king_192000'),
		(DEFAULT,4,'ram',10,'king_17000'),
		
		(DEFAULT,5,'ram',10,'cors_27700'),
		(DEFAULT,5,'ram',10,'cors_21300'),

		(DEFAULT,6,'disk',10,'enterprise'),
		(DEFAULT,6,'disk',10,'slim'),

		(DEFAULT,7,'disk',10,'black'),
		(DEFAULT,7,'disk',10,'blue'),

		(DEFAULT,8,'processor',10,'intel_6800k'),
		(DEFAULT,8,'processor',10,'intel_6850K'),

		(DEFAULT,2,'processor',10,'bulldozer'),
		(DEFAULT,2,'processor',10,'vishera'),		

		(DEFAULT,10,'cooler',10,'m91'),
		(DEFAULT,10,'coler',10,'c1'),
		
		(DEFAULT,9,'cooler',10,'hyper_612'),
		(DEFAULT,9,'coler',10,'master_8');
		
		
INSERT INTO Fornecedor
VALUES	(DEFAULT,'000','Simao Almeida',"Santo Tirso");


INSERT INTO Cliente
VALUES (DEFAULT,'Tiago Barbosa','4765-144','Pedome','123',3,'925883383','tijbarbosa@homail.com','TJBar','123'),
	   (DEFAULT,'Pedro Barbosa','4765-144','Pedome','123',1,'000','padbarbosa@homail.com','Babinhas','123');
	   
INSERT INTO Funcionario
VALUES	(DEFAULT,'Jose Azevedo',1.00,2,'Limpar o chao','Braga','0000000','111111','000','000','NixOwl','123'),
		(DEFAULT,'Rui Gomes',1.00,2,'Nadinha','Braga','0000000','111111','000','000','Bigfoot','123');


CREATE VIEW test4
AS (SELECT n_funcionario
	FROM Participacao
	WHERE n_reparacao IN (SELECT n_reparacao
						  FROM Reparacao
						  WHERE n_fatura IS NULL )
);


CREATE VIEW test3
AS (SELECT n_funcionario
	FROM Funcionario
	WHERE n_funcionario NOT IN (SELECT n_funcionario FROM test4)
	LIMIT 1
);

CREATE VIEW test5
AS (SELECT n_funcionario,COUNT(n_funcionario) AS contagem
	FROM Participacao
	WHERE n_reparacao IN (SELECT n_reparacao
						  FROM Reparacao
						  WHERE n_fatura IS NULL )
	GROUP BY n_funcionario					  
	ORDER BY contagem 
	LIMIT 1
);

	
DELIMITER //
DROP TRIGGER IF EXISTS rep_ins;
CREATE TRIGGER rep_ins
AFTER INSERT ON Reparacao
FOR EACH ROW
BEGIN
	DECLARE func INTEGER;
	DECLARE variable1 INTEGER;
	DECLARE variable2 INTEGER;
	
	SELECT n_funcionario INTO func FROM test3;
	SELECT n_funcionario INTO variable2 FROM test5;
	
	IF(func IS NOT NULL) THEN INSERT INTO Participacao VALUES(NEW.n_reparacao,1,func,NULL);
	END IF;	
	
	IF(func IS  NULL) THEN INSERT INTO Participacao VALUES(NEW.n_reparacao,1,variable2,NULL);
	END IF;

	
	SELECT n_peca INTO variable1 FROM Peca WHERE nome_peca = NEW.modelo_danificado	;
	INSERT INTO Linhas_Reparacao VALUES(NEW.n_reparacao,variable1,100,0,NEW.parte_danificada,NULL);
END
//
DELIMITER ;

 /*
CREATE VIEW Super_Clientes (n_cliente,nome_cliente)
    AS (SELECT Cl.n_cliente,Cl.nome_cliente
        FROM Cliente Cl
        Where Cl.n_cliente IN (SELECT n_cliente
                                FROM Reparacao
                                WHERE n_fatura IN ( Select n_fatura
                                                    FROM Fatura
                                                    WHERE preco_final = (SELECT MAX(preco_final)
                                                    FROM Fatura))));
                     
CREATE VIEW Total_Pago
    AS (SELECT S.n_cliente, S.nome_cliente,SUM(Fa.preco_final)
        FROM Fatura Fa, Super_Clientes S
        WHERE Fa.n_fatura IN (SELECT Re.n_fatura
                              FROM Reparacao Re, Super_Clientes SC
                              WHERE SC.n_cliente = Re.n_cliente));
 
                                   
CREATE VIEW Funcionario_mes (n_funcionario,nome_funcionario)
    AS (SELECT Fun.n_funcionario, Fun.nome_funcionario
        FROM Funcionario Fun
        Where n_funcionario IN (SELECT n_funcionario
                               FROM Participacao
                               WHERE tempo_trabalho = (SELECT MAX(tempo_trabalho)
                                                       FROM Participacao)));
 
 
CREATE VIEW top_funconarios (n_funcionario,nome_funcionario)
    AS (SELECT Fun.n_funcionario, Fun.nome_funcionario
        FROM Funcionario Fun,Participacao Pa
        WHERE Fun.n_funcionario = Pa.n_funcionario
        ORDER BY Pa.tempo_trabalho DESC
        LIMIT 3);
 
CREATE VIEW distribuicao_regional
    AS (SELECT localidade,n_cliente,nome_cliente
        FROM Cliente
        GROUP BY localidade,n_cliente);
 
DELIMITER @
 
DROP PROCEDURE IF EXISTS teste;
CREATE PROCEDURE teste(IN valor INTEGER)
BEGIN
(SELECT cli.n_cliente, ma.nome_marca
FROM Marca ma, Cliente cli
WHERE ma.n_marca IN
 
(SELECT n_marca
FROM peca
WHERE n_peca IN
 
(SELECT n_peca
FROM Linhas_Reparacao
WHERE preco > valor AND n_reparacao IN
 
(SELECT re.n_reparacao
FROM Reparacao re
WHERE cli.n_cliente = re.n_cliente
 
 
))));
 
END
@
DELIMITER ;
 */