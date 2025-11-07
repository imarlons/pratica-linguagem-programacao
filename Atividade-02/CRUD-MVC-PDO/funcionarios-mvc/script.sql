CREATE DATABASE empresa;

USE empresa;

-- tabela de funcionários (com discriminador de tipo)
CREATE TABLE funcionarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL, 
    salario DECIMAL(10, 2) NOT NULL, 
    tipo ENUM('gerente', 'desenvolvedor') NOT NULL
);