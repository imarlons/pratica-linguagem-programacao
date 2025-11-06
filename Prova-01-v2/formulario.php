<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produtos</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <h1>Cadastro de Novos Produtos</h1>
        <form action="manipular_bd.php" method="POST">
            <input type="hidden" name="acao" value="cadastrar">

            <label for="nome_produto">Nome do Produto:</label>
            <input type="text" id="nome_produto" name="nome_produto" required>

            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao"></textarea>

            <label for="preco">Preço (R$):</label>
            <input type="number" id="preco" name="preco" step="0.01" required>

            <label for="categoria">Categoria:</label>
            <input type="text" id="categoria" name="categoria">

            <input type="submit" value="Cadastrar Produto" class="btn btn-primary">
        </form>
        <a href="manipular_bd.php" class="btn btn-secondary">Ver Produtos Cadastrados</a>
    </div>
</body>

</html>