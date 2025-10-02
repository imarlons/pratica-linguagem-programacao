<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php
    // inclui o arquivo "conectar.php" para estabelecer uma conexão com o banco de dados.

    use Dom\Mysql;

    include_once("conectar.php");

    // obtém o valor do nome que foi enviado pelo formulário HTML através do método POST
    $nome = $_POST['nome']; // valor enviado fica armazenado na variável $nome

    // cria uma consulta sql para excluir registros da tabela "alunos"
    $sql = "DELETE FROM alunos WHERE nome = '$nome'";
    // onde o valor da colune nome corresponde ao valor armazenado em $nome

    // executa a consulta sql no banco de dados usando a função mysql_query()
    // o resultado da execução é armazenado na variável $resultado
    $resultado = mysqli_query($conexao, $sql);

    echo "EXCLUSÃO REALIZADA COM SUCESSO!";
    mysqli_close($conexao); // é importante fechar a conexão após realizar a operação.

    ?>
</body>

</html>