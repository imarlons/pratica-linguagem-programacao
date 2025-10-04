<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "atividades";
$porta = 3307;

// criando a conexão
$conexao = new mysqli($servidor, $usuario, $senha, $banco, $porta);

// checando a conexão
if ($conexao->connect_error) {
    die("FALHA NA CONEXÃO COM O BANCO DE DADOS:  " . $conexao->connect_error);
}
