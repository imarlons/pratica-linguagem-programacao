<?php
// incluir o arquivo "conectar.php" para estabelecer a conexão com  banco de dados.

use Dom\Mysql;

include_once("conectar.php");
// obtém o valor da cidade selecionada pelo usuário no formulário HTML e armazena na variável $pesquisa
$pesquisa = $_POST['cidade'];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Resultado da Pesquisa por Cidade</title>
</head>

<body>
    <!-- criando tabela e cabeçalho de dados -->
    <table border="1" style="width:50%">
        <tr>
            <!-- define o cabeçalho da tabela para exibir os resultados da pesquisa -->
            <th>NOME</th>
            <th>IDADE</th>
            <th>CIDADE</th>
        </tr>

        <?php
        // realiza a busca na tabela "alunos" com base na cidade selecionada.
        // usa a variável $pesquisa como critério de filtro.
        // utiliza a função mysqli_query() para executar a consulta.
        $sql = "SELECT * FROM alunos WHERE cidade = '$pesquisa'";
        $resultado = mysqli_query($conexao, $sql);

        while ($registro = mysqli_fetch_array($resultado))
        // o loop while percorre os resultados da consulta e armazena cada linha em $registro.
        // a cada laço do while, preenchemos uma linha da tabela
        {
            $nome = $registro['nome'];
            $idade = $registro['idade'];
            $cidade = $registro['cidade'];
            echo "<tr>";
            echo "<td>" . $nome . "</td>";
            echo "<td>" . $idade . "</td>";
            echo "<td>" . $cidade . "</td>";
            echo "</tr>";
        }
        // fecha a conexão com o banco de dados quando não há mais dados a serem apresentados.
        mysqli_close($conexao);
        echo "</table>"; // fecha a tabela HTML que exibe os resultados.
        ?>
</body>

</html>