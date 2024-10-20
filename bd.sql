-- Criação do banco de dados e seleção
CREATE DATABASE plm;
USE plm;

-- Tabela de tipos de usuário
CREATE TABLE tipo_usuario (
    id_tipo_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL
);

-- Tabela de usuários
CREATE TABLE usuario (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nome_usuario VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    id_tipo_usuario INT NOT NULL,
    FOREIGN KEY (id_tipo_usuario) REFERENCES tipo_usuario(id_tipo_usuario)
);

-- Tabela de logins (autenticação)
CREATE TABLE login (
    id_login INT PRIMARY KEY AUTO_INCREMENT,
    login VARCHAR(50) NOT NULL UNIQUE,
    senha VARCHAR(200) NOT NULL,
    id_usuario INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
);

-- Tabela de dependentes
CREATE TABLE dependente (
    id_dependente INT PRIMARY KEY AUTO_INCREMENT,
    nome_dependente VARCHAR(100) NOT NULL,
    id_usuario INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
);

-- Tabela de remédios
CREATE TABLE remedios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    codigo VARCHAR(255),
    numeroRegistro VARCHAR(255),
    numeroProcesso VARCHAR(255),
    nomeProduto VARCHAR(255),
    nomeComercial VARCHAR(255),
    apresentacao TEXT,
    formasFarmaceuticas VARCHAR(255),
    tarja VARCHAR(255),
    categoriaRegulatoria VARCHAR(255),
    medicamentoReferencia TEXT,
    principioAtivo VARCHAR(255),
    viasAdministracao VARCHAR(255),
    classeTerapeutica VARCHAR(255),
    empresaNome VARCHAR(255),
    empresaCnpj VARCHAR(255),
    atc VARCHAR(255),
    conservacao TEXT,
    restricaoPrescricao TEXT,
    restricaoUso TEXT,
    classesTerapeuticas VARCHAR(255),
    dataProduto DATE,
    tipoProduto INT,
    restricaoHospitais TEXT,
    situacaoRegistro VARCHAR(255)
);

-- Tabela de horários de administração de medicamentos
CREATE TABLE horario_administracao (
    id_horario INT PRIMARY KEY AUTO_INCREMENT,
    horario DATETIME NOT NULL,
    id_login INT NOT NULL,
    id_remedio INT NOT NULL,
    dosagem DECIMAL(10, 2) NOT NULL CHECK (dosagem > 0),
    dosagem_unidade VARCHAR(20) NOT NULL,
    concentracao DECIMAL(10, 2) NOT NULL CHECK (concentracao > 0),
    concentracao_unidade VARCHAR(20) NOT NULL,
    intervalo_horas INT NOT NULL CHECK (intervalo_horas > 0),
    duracao_dias INT NOT NULL CHECK (duracao_dias > 0),
    data_hora_inicio DATETIME NOT NULL,
    FOREIGN KEY (id_login) REFERENCES login(id_login),
    FOREIGN KEY (id_remedio) REFERENCES remedios(id)
);

-- Tabela de registros de administração de medicamentos
CREATE TABLE registro_administracao (
    id_registro INT PRIMARY KEY AUTO_INCREMENT,
    horario_registro DATETIME NOT NULL,
    id_remedio INT NOT NULL,
    id_usuario INT NOT NULL,
    FOREIGN KEY (id_remedio) REFERENCES remedios(id),
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
);

-- Inserir tipos de usuário
INSERT INTO tipo_usuario (nome) VALUES ('Usuário Comum');
INSERT INTO tipo_usuario (nome) VALUES ('Dependente');
