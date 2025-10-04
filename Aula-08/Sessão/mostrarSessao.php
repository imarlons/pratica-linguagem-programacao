<?php
// inicia ou recupera uma sessão existente.
session_start();

// exibe um cabeçalho na página HTML
echo "<h2> Dados de Sessão</h2>";

// exibe os valores das variáveis de sessão, acessando o array $_SESSION.
// exibe o valor da variável "nome" da sessão.
echo $_SESSION['nome'] . "<br>";
// exibe o valor da variável "sobrenome" da sessão.
echo $_SESSION['sobrenome'] . "<br>";
// exibe o valor da variável "data" da sessão.
echo $_SESSION['data'] . "<br>";

// cria um link para encerrar a sessão
echo "<br><a href='encerrarSessao.php'> Sair </a>";
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