<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Editar Funcionário</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <h1>Editar: <?php echo htmlspecialchars($funcionario->getNome()); ?></h1>

        <form action="index.php?action=atualizar" method="POST">
            <input type="hidden" name="id" value="<?php echo $funcionario->getId(); ?>">

            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($funcionario->getNome()); ?>" required>

            <label for="salario">Salário (R$):</label>
            <input type="number" step="0.01" id="salario" name="salario" value="<?php echo $funcionario->getSalario(); ?>" required>

            <label for="tipo">Tipo (Cargo):</label>
            <input type="text" id="tipo" name="tipo_display" value="<?php echo get_class($funcionario); ?>" readonly disabled>

            <button type="submit">Atualizar</button>
        </form>

        <a href="index.php?action=listar">Voltar para Lista</a>
    </div>
</body>

</html>