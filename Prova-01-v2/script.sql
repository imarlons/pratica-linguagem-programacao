-- garante a criação do banco de dados apenas se ele não existir
CREATE DATABASE IF NOT EXISTS cadastro_produtos DEFAULT CHARACTER SET utf8mb4;

-- seleciona o banco de dados recém-criado para os comandos seguintes
USE `cadastro_produtos`;

-- cria a tabela 'produtos' se ela não existir
CREATE TABLE IF NOT EXISTS produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_produto VARCHAR(255) NOT NULL UNIQUE, -- o nome é a chave para exclusão/atualização
    descricao TEXT,
    preco DECIMAL(10, 2) NOT NULL,
    categoria VARCHAR(100),
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);