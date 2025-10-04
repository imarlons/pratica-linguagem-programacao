<?php
// Inclui os scripts de autenticação e conexão com o banco
require_once '../includes/auth.php';
require_once '../includes/conexao.php';

$mensagem_acao = ''; // Para feedback de exclusão
$alunos = []; // Array para armazenar os resultados da busca

// --- ETAPA 1: VERIFICAR E PROCESSAR EXCLUSÃO ---
// Checa se um ID foi enviado via POST para exclusão
if (isset($_POST['id_excluir'])) {
    $id_para_excluir = filter_input(INPUT_POST, 'id_excluir', FILTER_VALIDATE_INT);

    if ($id_para_excluir) {
        $sql = "DELETE FROM alunos WHERE id = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("i", $id_para_excluir);

        if ($stmt->execute()) {
            $mensagem_acao = "<div class='resultado-sucesso'>Aluno excluído com sucesso!</div>";
        } else {
            $mensagem_acao = "<div class='resultado-erro'>Erro ao excluir o aluno: " . $stmt->error . "</div>";
        }
        $stmt->close();
    }
}

// --- ETAPA 2: REALIZAR A BUSCA DE ALUNOS ---
$termo_busca = $_POST['busca'] ?? '';

if (!empty($termo_busca)) {
    // Busca filtrada
    $sql = "SELECT * FROM alunos WHERE nome LIKE ? OR matricula LIKE ? OR email LIKE ?";
    $stmt = $conexao->prepare($sql);
    $busca_like = "%{$termo_busca}%";
    $stmt->bind_param("sss", $busca_like, $busca_like, $busca_like);
} else {
    // Busca geral para listar todos os alunos
    $sql = "SELECT * FROM alunos ORDER BY nome ASC";
    $stmt = $conexao->prepare($sql);
}

$stmt->execute();
$result = $stmt->get_result();
$alunos = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$conexao->close();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Exercício 12 - Busca e Exclusão</title>
    <link rel="stylesheet" href="../styles.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .btn-excluir {
            background-color: #f44336;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container" style="max-width: 1200px;">
        <h1>Exercício 12 - Busca e Exclusão de Registros</h1>

        <?php echo $mensagem_acao; ?>

        <form action="EX12.php" method="POST">
            <input type="text" name="busca" placeholder="Buscar por nome, matrícula ou e-mail..." value="<?= htmlspecialchars($termo_busca) ?>">
            <button type="submit">Buscar</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Matrícula</th>
                    <th>Curso</th>
                    <th>E-mail</th>
                    <th>Carga Horária</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($alunos) > 0): ?>
                    <?php foreach ($alunos as $aluno): ?>
                        <tr>
                            <td><?= htmlspecialchars($aluno['nome']) ?></td>
                            <td><?= htmlspecialchars($aluno['matricula']) ?></td>
                            <td><?= htmlspecialchars($aluno['curso']) ?></td>
                            <td><?= htmlspecialchars($aluno['email']) ?></td>
                            <td><?= htmlspecialchars($aluno['carga_horaria']) ?></td>
                            <td>
                                <form action="EX12.php" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este aluno?');">
                                    <input type="hidden" name="id_excluir" value="<?= $aluno['id'] ?>">
                                    <button type="submit" class="btn-excluir">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align:center;">Nenhum aluno encontrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <a href="../index.php" class="btn-voltar">Voltar ao Início</a>
    </div>
</body>

</html>