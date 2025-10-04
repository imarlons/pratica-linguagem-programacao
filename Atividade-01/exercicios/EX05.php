<?php
// Inclui o script de autenticação
require_once '../includes/auth.php';

$resultado_html = '';

// Processa o formulário quando enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $numero = filter_input(INPUT_POST, 'numero', FILTER_VALIDATE_INT);

    // Verifica se a entrada é um inteiro válido
    if ($numero !== false) {
        // Salva o último número no cookie
        setcookie('ex05_ultimo_numero', $numero, time() + (3600 * 24 * 30), "/"); //

        $classe_css = '';
        $mensagem = '';

        // Lógica para verificar se é par ou ímpar
        if ($numero % 2 == 0) {
            $classe_css = 'resultado-par';
            $mensagem = "O número {$numero} é PAR.";
        } else {
            $classe_css = 'resultado-impar';
            $mensagem = "O número {$numero} é ÍMPAR.";
        }

        $resultado_html = "<h2><span class='{$classe_css}'>{$mensagem}</span></h2>";
    } else {
        $resultado_html = "<div class='resultado-erro'>Por favor, insira um número inteiro válido.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Exercício 5 - Par ou Ímpar</title>
    <link rel="stylesheet" href="../styles.css">
</head>

<body>
    <div class="container">
        <h1>Exercício 5 - Verificação de Número Par ou Ímpar</h1>

        <form action="EX05.php" method="POST">
            <label for="numero">Digite um número inteiro:</label>
            <input type="number" id="numero" name="numero" required>
            <button type="submit">Verificar</button>
        </form>

        <?php if (!empty($resultado_html)): ?>
            <div class="resultado-container" style="margin-top:20px;">
                <?php echo $resultado_html; ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_COOKIE['ex05_ultimo_numero'])): ?>
            <div class="historico">
                Último número verificado: <strong><?= htmlspecialchars($_COOKIE['ex05_ultimo_numero']) ?></strong>
            </div>
        <?php endif; ?>

        <a href="../index.php" class="btn-voltar">Voltar ao Início</a>
    </div>
</body>

</html>