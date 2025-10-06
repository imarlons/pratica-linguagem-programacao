-- garante a criação do banco de dados apenas se ele não existir
CREATE DATABASE IF NOT EXISTS `cadastro_produtos` 
DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- seleciona o banco de dados recém-criado para os comandos seguintes
USE `cadastro_produtos`;

-- cria a tabela 'produtos' se ela não existir
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome_produto` VARCHAR(255) NOT NULL,
  `descricao` TEXT DEFAULT NULL,
  `preco` DECIMAL(10,2) NOT NULL,
  `categoria` VARCHAR(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;