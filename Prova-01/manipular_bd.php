<?php
// Inclui o arquivo de conexão
include 'conexao.php';

// --- INSERÇÃO DE DADOS (Critério 4a) ---
if (isset($_POST['acao']) && $_POST['acao'] == 'cadastrar') {
    // Usamos mysqli_real_escape_string para uma proteção básica contra SQL Injection
    $nome_produto = mysqli_real_escape_string($conexao, $_POST['nome_produto']);
    $descricao = mysqli_real_escape_string($conexao, $_POST['descricao']);
    $preco = mysqli_real_escape_string($conexao, $_POST['preco']);
    $categoria = mysqli_real_escape_string($conexao, $_POST['categoria']);

    $sql_insert = "INSERT INTO produtos (nome_produto, descricao, preco, categoria) VALUES ('$nome_produto', '$descricao', '$preco', '$categoria')";

    // Executa a query e, se houver erro, exibe uma mensagem
    if (!mysqli_query($conexao, $sql_insert)) {
        echo "Erro ao cadastrar produto: " . mysqli_error($conexao);
    }
}

// --- EXCLUSÃO DE PRODUTOS (Critério 4c) ---
if (isset($_POST['acao']) && $_POST['acao'] == 'excluir') {
    $nome_produto_excluir = mysqli_real_escape_string($conexao, $_POST['nome_produto_excluir']);

    // ATENÇÃO: Excluir pelo nome pode apagar múltiplos produtos se tiverem nomes iguais.
    $sql_delete = "DELETE FROM produtos WHERE nome_produto = '$nome_produto_excluir'";

    // Executa a query e, se houver erro, exibe uma mensagem
    if (!mysqli_query($conexao, $sql_delete)) {
        echo "Erro ao excluir produto: " . mysqli_error($conexao);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Produtos</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <h1 class="page-title"><a href="formulario.php">← Cadastrar Novo</a> | Lista de Produtos</h1>

        <form action="manipular_bd.php" method="POST">
            <h2>Excluir Produto por Nome</h2>
            <input type="hidden" name="acao" value="excluir">
            <label for="nome_produto_excluir">Nome do Produto:</label>
            <input type="text" id="nome_produto_excluir" name="nome_produto_excluir" required>
            <input type="submit" value="Excluir Produto" class="btn btn-danger">
        </form>

        <h2>Produtos Cadastrados</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome do Produto</th>
                    <th>Descrição</th>
                    <th>Preço (R$)</th>
                    <th>Categoria</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql_select = "SELECT id, nome_produto, descricao, preco, categoria FROM produtos ORDER BY id DESC";
                $resultado = mysqli_query($conexao, $sql_select);

                // --- CALCULO TOTAL DE PRODUTOS (Critério 5) ---
                $total_produtos = mysqli_num_rows($resultado);

                if ($total_produtos > 0) {
                    // Exibe cada produto na tabela
                    while ($linha = mysqli_fetch_assoc($resultado)) {
                        echo "<tr>";
                        // htmlspecialchars() previne ataques XSS ao exibir dados
                        echo "<td>" . htmlspecialchars($linha['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($linha['nome_produto']) . "</td>";
                        echo "<td>" . htmlspecialchars($linha['descricao']) . "</td>";
                        // Formata o preço para o padrão brasileiro
                        echo "<td>" . number_format($linha['preco'], 2, ',', '.') . "</td>";
                        echo "<td>" . htmlspecialchars($linha['categoria']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    // Mensagem caso não haja produtos
                    echo "<tr><td colspan='5'>Nenhum produto cadastrado.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <div class="total-produtos">
            Total de Produtos Cadastrados: <?php echo $total_produtos; ?>
        </div>
    </div>
</body>

</html>
<?php
// fecha a conexão com o banco de dados
mysqli_close($conexao);
?>