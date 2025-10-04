<?php
// inicia ou recupera uma sessão existente.
session_start();

// limpa todas as variáveis de sessão (os valores da sessão) definindo o array $_SESSION como vazio.
$_SESSION = array();

// destroi a sessão completamente
session_destroy();

// mensagem de confirmação
echo "<h2> SESSÃO ENCERRADA COM SUCESSO! </h2>";

// redireciona o usuário para uma página após a destruição da sessão (por exemplo, uma página de login)
header('Location: sessao.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

</body>

</html>