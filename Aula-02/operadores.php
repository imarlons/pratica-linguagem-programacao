<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aula 02 - Operadores</title>
</head>

<body>
    <?php
    $valorA = 70;
    $valorB = 30;
    $adicao = $valorA + $valorB;
    $subtracao = $valorA - $valorB;
    $multiplicacao = $valorA * $valorB;
    $divisao = $valorA / $valorB;
    $resto = $valorA % $valorB;
    echo 'Valor A: ' . $valorA . '</br>';
    echo 'Valor B: ' . $valorB . '</br>';
    echo '</br>';
    echo 'A soma dos valores é igual a ' . $adicao . '</br>';
    echo 'A subtração dos valores é igual a ' . $subtracao . '</br>';
    echo 'A multiplicação dos valores é igual a ' . $multiplicacao . '</br>';
    echo 'A divisão dos valores é igual a ' . number_format($divisao, 2) . '</br>';
    echo 'A resto da divisão é igual a ' . $resto . '</br>';
    ?>
</body>

</html>