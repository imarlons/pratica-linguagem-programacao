<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Lista de Funcionários</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <h1>Sistema de Funcionários</h1>
        <a href="index.php?action=criar" class="btn-novo">Cadastrar Novo Funcionário</a>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th>Salário Base (R$)</th>
                    <th>Bonificação (R$)</th>
                    <th>Salário Total (R$)</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($funcionarios as $func): ?>
                    <tr>
                        <td><?php echo $func->getId(); ?></td>
                        <td><?php echo htmlspecialchars($func->getNome()); ?></td>
                        <td><?php echo get_class($func); ?></td>
                        <td><?php echo number_format($func->getSalario(), 2, ',', '.'); ?></td>
                        <td><?php echo number_format($func->getBonificacao(), 2, ',', '.'); ?></td>
                        <td><?php echo number_format($func->getSalarioTotal(), 2, ',', '.'); ?></td>

                        <td class="acoes">
                            <a href="index.php?action=editar&id=<?php echo $func->getId(); ?>" class="btn-editar">Editar</a>
                            <a href="index.php?action=excluir&id=<?php echo $func->getId(); ?>" class="btn-excluir"
                                onclick="return confirm('Tem certeza que deseja excluir <?php echo htmlspecialchars($func->getNome()); ?>?');">
                                Excluir
                            </a>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>