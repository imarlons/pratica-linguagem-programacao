<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemplo de Função</title>
</head>

<body>
    <h1>EXEMPLO DE FUNÇÕES NA MESMA PÁGINA</h1>

    <form action="" method="post">
        <label for="valorA">1º Número:</label>
        <input type="text" name="valorA" id="valorA"><br>

        <label for="valorB">2º Número:</label>
        <input type="text" name="valorB" id="valorB"><br>

        <input type="submit" name="enviar" value="Calcular">
    </form>

    <?php

    // verifica se o formulário foi enviado
    if (isset($_POST['enviar'])) {
        $valorA = $_POST['valorA'];
        $valorB = $_POST['valorB'];

        // chamando a função somar com os parametros valorA e valorB
        $resultado = somar($valorA, $valorB);

        echo "<p>RESULTADO: $resultado</p>";
    }

    // função que calcula a soma de dois números
    function somar($valorA, $valorB)
    {
        $soma = (int)$valorA + (int)$valorB;
        return $soma;
    }
    ?>
</body>

</html>