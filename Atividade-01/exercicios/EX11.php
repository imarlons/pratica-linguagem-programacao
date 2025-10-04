<?php
// Inclui os scripts de autenticação e conexão com o banco
require_once '../includes/auth.php';
require_once '../includes/conexao.php'; // Nosso arquivo de conexão com o BD

$resultado_html = '';

// Processa o formulário quando enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // --- LÓGICA PARA CADASTRO DE NOVO ALUNO ---
    if (isset($_POST['cadastrar'])) {
        // Coleta todos os dados do formulário de cadastro
        $nome = $_POST['nome'];
        $matricula = $_POST['matricula'];
        $curso = $_POST['curso'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $endereco = $_POST['endereco'];
        $cep = $_POST['cep'];
        $cidade = $_POST['cidade'];
        $uf = $_POST['uf'];
        $curso_horas = $_POST['curso_horas'];
        $carga_horaria = filter_input(INPUT_POST, 'carga_horaria', FILTER_VALIDATE_INT);

        // Prepara a consulta SQL para inserção (prepared statement)
        $sql = "INSERT INTO alunos (nome, matricula, curso, email, telefone, endereco, cep, cidade, uf, curso_horas, carga_horaria) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conexao->prepare($sql);
        // 's' para string, 'i' para integer. A ordem deve corresponder aos '?'
        $stmt->bind_param("ssssssssssi", $nome, $matricula, $curso, $email, $telefone, $endereco, $cep, $cidade, $uf, $curso_horas, $carga_horaria);

        if ($stmt->execute()) {
            $resultado_html = "<div class='resultado-sucesso'>Aluno cadastrado com sucesso!</div>"; // [cite: 160]
        } else {
            // Verifica se o erro é de matrícula duplicada
            if ($conexao->errno == 1062) {
                $resultado_html = "<div class='resultado-erro'>Erro: A matrícula '{$matricula}' já existe no sistema.</div>";
            } else {
                $resultado_html = "<div class='resultado-erro'>Erro ao cadastrar aluno: " . $stmt->error . "</div>";
            }
        }
        $stmt->close();
    }

    // --- LÓGICA PARA ATUALIZAR CARGA HORÁRIA ---
    if (isset($_POST['atualizar'])) {
        $matricula = $_POST['matricula_up'];
        $horas_adicionar = filter_input(INPUT_POST, 'horas_adicionar', FILTER_VALIDATE_INT);

        // 1. Buscar a carga horária atual
        $sql_select = "SELECT carga_horaria FROM alunos WHERE matricula = ?";
        $stmt_select = $conexao->prepare($sql_select);
        $stmt_select->bind_param("s", $matricula);
        $stmt_select->execute();
        $result = $stmt_select->get_result();

        if ($result->num_rows > 0) {
            $aluno = $result->fetch_assoc();
            $carga_atual = $aluno['carga_horaria'];
            $nova_carga = $carga_atual + $horas_adicionar;

            // 2. Atualizar com o novo valor
            $sql_update = "UPDATE alunos SET carga_horaria = ? WHERE matricula = ?";
            $stmt_update = $conexao->prepare($sql_update);
            $stmt_update->bind_param("is", $nova_carga, $matricula);

            if ($stmt_update->execute()) {
                $resultado_html = "<div class='resultado-sucesso'>Carga horária do aluno com matrícula {$matricula} atualizada para {$nova_carga} horas.</div>";
            } else {
                $resultado_html = "<div class='resultado-erro'>Erro ao atualizar a carga horária: " . $stmt_update->error . "</div>";
            }
            $stmt_update->close();
        } else {
            $resultado_html = "<div class='resultado-erro'>Aluno com a matrícula {$matricula} não encontrado.</div>"; // [cite: 177]
        }
        $stmt_select->close();
    }
}
$conexao->close();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Exercício 11 - Cadastro de Alunos</title>
    <link rel="stylesheet" href="../styles.css">
</head>

<body>
    <div class="container">
        <h1>Exercício 11 - Cadastro e Gestão de Alunos</h1>

        <?php echo $resultado_html; ?>

        <h2>Cadastrar Novo Aluno</h2>
        <form action="EX11.php" method="POST">
            <input type="text" name="nome" placeholder="Nome do Aluno" required>
            <input type="text" name="matricula" placeholder="Matrícula" required>
            <input type="text" name="curso" placeholder="Curso">
            <input type="email" name="email" placeholder="E-mail Institucional">
            <input type="tel" name="telefone" placeholder="Telefone">
            <input type="text" name="endereco" placeholder="Endereço">
            <input type="text" name="cep" placeholder="CEP">
            <input type="text" name="cidade" placeholder="Cidade">
            <input type="text" name="uf" placeholder="UF (2 letras)">
            <input type="text" name="curso_horas" placeholder="Curso para Horas Comp.">
            <input type="number" name="carga_horaria" placeholder="Carga Horária Inicial" required>
            <button type="submit" name="cadastrar">Cadastrar Aluno</button>
        </form>

        <hr style="margin: 40px 0;">

        <h2>Adicionar Carga Horária</h2>
        <form action="EX11.php" method="POST">
            <input type="text" name="matricula_up" placeholder="Matrícula do Aluno" required>
            <input type="number" name="horas_adicionar" placeholder="Horas a Adicionar" required>
            <button type="submit" name="atualizar">Atualizar Horas</button>
        </form>

        <a href="../index.php" class="btn-voltar">Voltar ao Início</a>
    </div>
</body>

</html>