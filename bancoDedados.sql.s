CREATE DATABASE produtos_db;

USE produtos_db;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(50) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);

CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL,
    palavras_chaves VARCHAR(255),
    link_pagamento VARCHAR(255),
    foto VARCHAR(255)
);

CREATE TABLE seo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    palavras_chaves VARCHAR(255),
    meta_tags TEXT
);
