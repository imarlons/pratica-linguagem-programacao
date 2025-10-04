<?php
// defina o nome do cookie como "usuario"
$nomeCookie = "usuario";

// defina o valor do cookie como "Aluno"
$valorCookie = "Aluno";

// cria um cookie chamado "usuario" com o valor "Aluno" e define a validade para 1h a partir do momento atual
setcookie($nomeCookie, $valorCookie, time() + 3600);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php
    // verifica se o cookie com o nome "usuario" já foi atribuído
    if (!isset($_COOKIE[$nomeCookie])) {
        // se não foi criado, exibe uma mensagem informando que o cookie não estava definido
        echo "COOKIE " . $nomeCookie . " NÃO ESTÁ ATRIBUÍDO!";
    } else {
        // se i cookie foi atribuído, exibe uma mensagem indicando que o cookie está atribuído
        echo "COOKIE " . $nomeCookie . " ESTÁ ATRIBUÍDO!<br>";

        // exibe o valor do cookie "usuario"
        echo "VALOR: " . $_COOKIE[$nomeCookie];
    }
    ?>
</body>

</html>