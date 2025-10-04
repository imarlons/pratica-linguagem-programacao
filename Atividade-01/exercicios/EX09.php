<?php
// Inclui o script de autenticação
require_once '../includes/auth.php';

$resultado_html = '';

// Processa o formulário quando enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $idade = filter_input(INPUT_POST, 'idade', FILTER_VALIDATE_INT);

    // Verifica se os dados são válidos
    if ($nome && $idade !== false && $idade >= 0) {

        // Salva os dados no cookie
        $cookie_value = "{$nome},{$idade}";
        setcookie('ex09_ultimo', $cookie_value, time() + (3600 * 24 * 30), "/");

        // 1. Verifica a maioridade
        $mensagem_maioridade = '';
        if ($idade >= 18) {
            $mensagem_maioridade = "é maior de 18 anos";
        } else {
            $mensagem_maioridade = "não é maior de 18 anos";
        }

        // 2. Classifica por faixa etária
        $classificacao = '';
        $classe_css = '';
        if ($idade <= 12) {
            $classificacao = 'Criança';
            $classe_css = 'idade-crianca';
        } elseif ($idade <= 17) {
            $classificacao = 'Adolescente';
            $classe_css = 'idade-adolescente';
        } elseif ($idade <= 59) {
            $classificacao = 'Adulto';
            $classe_css = 'idade-adulto';
        } else {
            $classificacao = 'Idoso';
            $classe_css = 'idade-idoso';
        }

        // Monta o HTML do resultado
        $resultado_html = "<div class='resultado-sucesso'>";
        $resultado_html .= "<p>" . htmlspecialchars($nome) . " {$mensagem_maioridade} e tem {$idade} anos.</p>";
        $resultado_html .= "<p><strong class='{$classe_css}'>Classificação: {$classificacao}</strong></p>";
        $resultado_html .= "</div>";
    } else {
        $resultado_html = "<div class='resultado-erro'>Por favor, insira um nome e uma idade válidos.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Exercício 9 - Verificação de Maioridade</title>
    <link rel="stylesheet" href="../styles.css">
</head>

<body>
    <div class="container">
        <h1>Exercício 9 - Verificação de Maioridade</h1>

        <form action="EX09.php" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="idade">Idade:</label>
            <input type="number" id="idade" name="idade" min="0" required>

            <br><br>
            <button type="submit">Verificar</button>
        </form>

        <?php echo $resultado_html; ?>

        <?php if (isset($_COOKIE['ex09_ultimo'])): ?>
            <div class="historico">
                Última verificação: <strong><?= htmlspecialchars($_COOKIE['ex09_ultimo']) ?></strong>
            </div>
        <?php endif; ?>

        <a href="../index.php" class="btn-voltar">Voltar ao Início</a>
    </div>
</body>

</html>