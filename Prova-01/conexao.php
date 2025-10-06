<?php
// credenciais do banco de dados
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "cadastro_produtos";
$porta = 3307; // porta de acordo com as configs do meu notebook

// criar a conexão
$conexao = mysqli_connect($servidor, $usuario, $senha, $banco, $porta);

// checar a conexão
if (!$conexao) {
    die("falha na conexão: " . mysqli_connect_error());
}
// echo "conectado com sucesso!"; // descomente para testar a conexão
