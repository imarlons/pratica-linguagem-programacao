<?php
// inicia ou recupeara uma sessão. deve estar estar no inicio do documento, antes das tags HTML
session_start();

// define as variáveis de sessão
// define uma varivável "nome" na sessão com o valor "Aluno"
$_SESSION['nome'] = "Aluno";
// define uma variável "sobrenome" na sessão com o valor "Dois"
$_SESSION['sobrenome'] = "Dois";
// define uma variável "data" na sessão com a data atual no formado "d/m/y"
$_SESSION['data'] = date("d/m/y", time());

// exibe uma mensagem para o usuário
echo "<h2> As variáveis de sessão foram definidas com SUCESSO! </h2>";
echo "<a href='mostrarSessao.php'> Dados da Sessão </a>";

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
</body>

</html>