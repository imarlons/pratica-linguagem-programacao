<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titulo ?></title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="container">
        <h1><?= $titulo ?></h1>
        <a href="index.php?acao=listar" class="btn btn-secondary">← Voltar para a Lista</a>

        <form action="index.php?acao=<?= $acao ?>" method="POST">

            <?php if ($acao == 'atualizar'): ?>
                <input type="hidden" name="nome_original" value="<?= htmlspecialchars($produto['nome_produto']) ?>">
            <?php endif; ?>

            <label for="nome_produto">Nome do Produto:</label>
            <input type="text" id="nome_produto" name="nome_produto"
                value="<?= $produto ? htmlspecialchars($produto['nome_produto']) : '' ?>"
                required
                <?= ($acao == 'atualizar') ? 'readonly' : '' ?>>
            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" required><?= $produto ? htmlspecialchars($produto['descricao']) : '' ?></textarea>

            <label for="preco">Preço (R$):</label>
            <input type="number" id="preco" name="preco" step="0.01"
                value="<?= $produto ? htmlspecialchars($produto['preco']) : '' ?>"
                required>

            <label for="categoria">Categoria:</label>
            <input type="text" id="categoria" name="categoria"
                value="<?= $produto ? htmlspecialchars($produto['categoria']) : '' ?>"
                <?= ($acao == 'atualizar') ? 'readonly' : '' ?>>
            <input type="submit"
                value="<?= ($acao == 'salvar') ? 'Cadastrar Produto' : 'Atualizar Produto' ?>"
                class="btn btn-primary">
        </form>
    </div>
</body>

</html>