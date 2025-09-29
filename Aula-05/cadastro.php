<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php
    // faz a conexão com o banco de dados, ao rodar o script de acesso ao DB
    include('conexao.php');

    // criar as variáveis que virão do formulário html
    $nome = $_POST['nome'];
    $matricula = $_POST['matricula'];
    $idade = $_POST['idade'];
    $cidade = $_POST['cidade'];

    // gravar os dados do formulário html no DB
    $sql = "INSERT INTO alunos(nome, matricula, idade, cidade)
                VALUES ('$nome', '$matricula', '$idade', '$cidade')";

    if (mysqli_query($conexao, $sql)) {
        echo 'usuário cadastrado com sucesso!';
    } else {
        echo "erro" . mysqli_error($conexao);
    }
    mysqli_close($conexao);
    ?>
</body>

</html>