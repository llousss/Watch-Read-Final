CREATE DATABASE IF NOT EXISTS watchread
    CHARACTER SET = utf8mb4
    COLLATE = utf8mb4_unicode_ci;

USE watchread;

CREATE TABLE livros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    capa VARCHAR(255),
    titulo VARCHAR(100) NOT NULL,
    autor VARCHAR(100),
    stts VARCHAR(50) NOT NULL,
    avaliacao INT
);

CREATE TABLE filmes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    capa VARCHAR(255),
    titulo VARCHAR(100) NOT NULL,
    diretor VARCHAR(100),
    stts VARCHAR(50) NOT NULL,
    avaliacao VARCHAR(5),
    usuario_id INT,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

CREATE TABLE series (
    id INT AUTO_INCREMENT PRIMARY KEY,
    capa VARCHAR(255),
    titulo VARCHAR(100) NOT NULL,
    temporadas VARCHAR(50),
    stts VARCHAR(50) NOT NULL,
    avaliacao VARCHAR(5),
    usuario_id INT,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(100) NOT NULL
);

ALTER TABLE livros MODIFY avaliacao TINYINT;
ALTER TABLE filmes MODIFY avaliacao TINYINT;
ALTER TABLE series MODIFY avaliacao TINYINT;
