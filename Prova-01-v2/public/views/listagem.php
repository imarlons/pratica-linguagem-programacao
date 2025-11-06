<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Produtos</title>
    <link rel="stylesheet" href="css/styles.css">

    <script>
        // confirmação de exclusão
        function confirmarExclusao(nomeProduto) {
            return confirm("Tem certeza que deseja excluir o produto '" + nomeProduto + "'?");
        }
    </script>
</head>

<body>
    <div class="container">
        <h1>Lista de Produtos Cadastrados</h1>

        <a href="index.php?acao=formularioCadastro" class="btn btn-secondary">Cadastrar Novo Produto</a>

        <h2>Produtos</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço (R$)</th>
                    <th>Categoria</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($produtos)): ?>
                    <?php foreach ($produtos as $produto): ?>
                        <tr>
                            <td><?= htmlspecialchars($produto['id']) ?></td>
                            <td><?= htmlspecialchars($produto['nome_produto']) ?></td>
                            <td><?= htmlspecialchars($produto['descricao']) ?></td>

                            <td><?= number_format($produto['preco'], 2, ',', '.') ?></td>

                            <td><?= htmlspecialchars($produto['categoria']) ?></td>
                            <td class="action-links">
                                <a href="index.php?acao=formularioAtualizacao&nome=<?= urlencode($produto['nome_produto']) ?>" class="edit-btn">Editar</a>
                                <a href="index.php?acao=deletar&nome=<?= urlencode($produto['nome_produto']) ?>"
                                    class="delete-btn"
                                    onclick="return confirmarExclusao('<?= htmlspecialchars($produto['nome_produto']) ?>')">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">Nenhum produto cadastrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="total-produtos">
            Total de Produtos Cadastrados: <?= $total ?>
        </div>
    </div>
</body>

</html>