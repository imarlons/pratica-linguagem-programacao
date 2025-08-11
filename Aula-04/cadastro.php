<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Cadastro - Processamento</title>
</head>

<body>
    <?php
    // captura os valores dos campos do formulário
    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $cidade = $_POST['cidade'];

    // exibir os dados na tela
    echo "<h1>Dados Recebidos: </h1>";
    echo "<p><strong>Nome:</strong>$nome</p>";
    echo "<p><strong>Endereço:</strong>$endereco</p>";
    echo "<p><strong>Cidade:</strong>$cidade</p>";
    ?>
</body>

</html>