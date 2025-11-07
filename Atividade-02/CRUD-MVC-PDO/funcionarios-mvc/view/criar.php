<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastrar Funcionário</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <h1>Cadastrar Novo Funcionário</h1>

        <form action="index.php?action=salvar" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="salario">Salário (R$):</label>
            <input type="number" step="0.01" id="salario" name="salario" required>

            <label for="tipo">Tipo:</label>
            <select id="tipo" name="tipo" required>
                <option value="">Selecione o tipo</option>
                <option value="gerente">Gerente</option>
                <option value="desenvolvedor">Desenvolvedor</option>
            </select>

            <button type="submit">Salvar</button>
        </form>

        <a href="index.php?action=listar">Voltar para Lista</a>
    </div>
</body>

</html>