<?php
include_once("conectar.php")
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Pesquisa Alunos</title>
</head>

<body>
    <!-- criando tabela e cabeçalho de dados -->
    <table border="1" style="width:50%">
        <tr>
            <th>NOME</th>
            <th>IDADE</th>
            <th>CIDADE</th>
        </tr>
        <!-- preenchendo a tabela com os dados do banco -->
        <?php
        $sql = "SELECT * FROM alunos";
        $resultado = mysqli_query($conexao, $sql);

        // o loop while percorre os resultados da consulta e armazena cada linha em $registro.
        while ($registro = mysqli_fetch_array($resultado))
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

        // fecha a conexão com o banco de dados quando não houver mais dados.
        mysqli_close($conexao);
        echo "</table>"; // fecha a tabela HTML que exibe os resultados.
        ?>

        <!-- form que redireciona action para excluir.php -->
        <form name="excluir" action="excluir.php" method="post">
            <p>
                DIGITE O "NOME" DO ALUNO PARA EXLUIR:
                <!-- campo para digitar o nome que se deseja exluir -->
                <input type="text" name="nome" />
                <input type="submit" name="botao" value="EXCLUIR">
            </p>
        </form>
</body>

</html>