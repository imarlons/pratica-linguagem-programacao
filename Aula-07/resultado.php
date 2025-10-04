<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RESULTADO DA SOMA</title>
</head>

<body>
    <h1>RESULTADO DA SOMA</h1>

    <?php
    // incluindo o arquivo de funções
    include 'funcoes.php';

    // verifica se os valores foram enviados pelo formulário
    if (isset($_POST['enviar'])) {
        $valorA = $_POST['valorA'];
        $valorB = $_POST['valorB'];

        // chamando a função somar
        $resultado = somar($valorA, $valorB);

        echo "RESULTADO: $resultado";
    } else {
        echo "POR FAVOR, PREENCHA O FORMULÁRIO E ENVIE OS VALORES!";
    }
    ?>
</body>

</html>