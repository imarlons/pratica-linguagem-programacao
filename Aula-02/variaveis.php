<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aula 02 - Variaveis</title>
</head>

<body>
    <?php
    $nome = 'marlon da silva';
    $idade = 22;
    $status = ($idade >= 18) ? 'maior de idade' : 'menor de idade';
    // ponto (.) serve para concatenar
    echo 'meu nome é ' . $nome . ' e tenho ' . $idade . ' anos!' . " ($status)" . '<br>';

    $temConta = true;
    $temCartao = false;

    echo '<br>';
    echo 'o usuário possui conta? ' . ($temConta ? 'sim' : 'não') . '<br>';
    echo 'o usuário possui cartão? ' . ($temCartao ? 'sim' : 'não') . '<br>';
    echo '<br>';

    $cores = ['amarelo', 'branco', 'cinza', 'dourado'];
    $numeros = [3, 5, 7, 9];

    $posicao = random_int(0, 3);

    echo 'na posição ' . $posicao . ' temos a cor ' . $cores[$posicao] . ' e o número ' . $numeros[$posicao]
    ?>
</body>

</html>