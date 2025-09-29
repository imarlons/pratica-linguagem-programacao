<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $dbname = "escola";
    $porta = 3307;

    // cria a conexão
    $conexao = mysqli_connect($servidor, $usuario, $senha, $dbname, $porta);

    // verifica a conexão
    if (!$conexao) {
        die("FALHA NA CONEXÃO: " . mysqli_connect_error());
    } else {
        echo "SUCESSO NA CONEXÃO!";
    }
    ?>
</body>

</html>