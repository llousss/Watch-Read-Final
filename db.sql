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
    genero VARCHAR(100),
    stts VARCHAR(50) NOT NULL,
    avaliacao INT
);

CREATE TABLE series (
    id INT AUTO_INCREMENT PRIMARY KEY,
    capa VARCHAR(255),
    titulo VARCHAR(100) NOT NULL,
    genero VARCHAR(50),
    temporadas VARCHAR(20),
    stts VARCHAR(50) NOT NULL,
    avaliacao INT
);

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(100) NOT NULL
);
