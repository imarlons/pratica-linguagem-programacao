<?php
// captura os valores dos campos de entrada do formulário e os armazena em variáveis
$valorA = filter_input(INPUT_POST, 'valorA'); // captura o valor do campo valorA
$valorB = filter_input(INPUT_POST, 'valorB'); // captura o valor do campo valorB

// calcula a soma dos dois valores e armazena o resultado na váriavel $resultado
$resultado = ($valorA + $valorB);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário PHP</title>
</head>

<body>
    <h1>Formulário PHP</h1>
    <!-- formulário para inserir os valores necessários -->
    <form method="post">
        <label>1º Valor: <input type="text" name="valorA" /></label><br>
        <label>2º Valor: <input type="text" name="valorB" /></label><br>
        <br>
        <input type="submit" name="btnCalcular" value="Calcular">
    </form>
    <!-- exibe o resultado da soma dos dois valores -->
    <h2>Resultado</h2>
    <h3><?php echo $resultado; ?></h3>
</body>

</html>