<?php

// 1. inclui a definição da classe Usuario
require_once 'Usuario.php';

echo "<h2>Teste do arquivo mostraUsuario.php</h2>";

// 2. instancia um objeto da classe Usuario, passando os dados para o construtor
$usuario1 = new Usuario(
    "Marlon da Silva",
    "123.456.789-00",
    "Rua das Lendas, 123 - Centro"
);

// 3. exibe os dados
// atributos públicos podem ser acessados diretamente
echo "Nome: " . $usuario1->nome . "<br>";
echo "CPF: " . $usuario1->cpf . "<br>";

// a atributo privado $endereco não pode ser acessado diretamente
// a linha abaixo causaria um erro fatal:
// echo $usuario1->endereco; 

// usamos o método "getter" público para obter o valor
echo "Endereço: " . $usuario1->getEndereco() . "<br>";
