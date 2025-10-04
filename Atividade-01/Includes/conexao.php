<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$dbname = "atividades";
$porta = 3307;

// cria a conexão
$conexao = mysqli_connect($servidor, $usuario, $senha, $dbname, $porta);

// verifica a conexão
if (!$conexao) {
    die("FALHA NA CONEXÃO: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>

</html>