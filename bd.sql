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

-- Tabela de medicamentos
CREATE TABLE medicamento (
    id_medicamento INT PRIMARY KEY AUTO_INCREMENT,
    nome_medicamento VARCHAR(100) NOT NULL,
    fabricante VARCHAR(100) NOT NULL,
    bula TEXT NOT NULL
);

-- Tabela de horários de administração de medicamentos
CREATE TABLE horario_administracao (
    id_horario INT PRIMARY KEY AUTO_INCREMENT,
    horario DATETIME NOT NULL,
    id_login INT NOT NULL,
    id_medicamento INT NOT NULL,
    dosagem VARCHAR(50) NOT NULL,
    concentracao VARCHAR(50) NOT NULL,
    FOREIGN KEY (id_login) REFERENCES login(id_login),
    FOREIGN KEY (id_medicamento) REFERENCES medicamento(id_medicamento)
);

-- Tabela de registros de administração de medicamentos
CREATE TABLE registro_administracao (
    id_registro INT PRIMARY KEY AUTO_INCREMENT,
    horario_registro DATETIME NOT NULL,
    id_medicamento INT NOT NULL,
    id_usuario INT NOT NULL,
    FOREIGN KEY (id_medicamento) REFERENCES medicamento(id_medicamento),
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
);
