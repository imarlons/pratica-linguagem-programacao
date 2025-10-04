<?php
// Inclui o script de autenticação e inicia a sessão
require_once '../includes/auth.php';

$resultado_html = '';

// Esta parte do código processa o formulário QUANDO ele é enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $numero = filter_input(INPUT_POST, 'numero', FILTER_VALIDATE_FLOAT);

    if ($numero !== false) {
        // Define o cookie com o último número verificado
        setcookie('ex01_ultimo_numero', $numero, time() + (3600 * 24 * 30), "/");

        if ($numero > 0) {
            $classe_css = 'resultado-pos';
            $mensagem = "O número $numero é POSITIVO.";
        } elseif ($numero < 0) {
            $classe_css = 'resultado-neg';
            $mensagem = "O número $numero é NEGATIVO.";
        } else {
            $classe_css = 'resultado-zero';
            $mensagem = "O número é IGUAL A ZERO.";
        }
        $resultado_html = "<p class=\"$classe_css\">$mensagem</p>";
    } else {
        $resultado_html = "<p class=\"resultado-neg\">Valor inválido fornecido.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Exercício 1 - Positivo, Negativo ou Zero</title>
    <link rel="stylesheet" href="../styles.css">
</head>

<body>
    <div class="container">
        <h1>Exercício 1 - Verificação de Número</h1>

        <form action="EX01.php" method="POST">
            <label for="numero">Digite um número:</label>
            <input type="number" id="numero" name="numero" step="any" required>
            <button type="submit">Verificar</button>
        </form>

        <?php if (!empty($resultado_html)): ?>
            <div class="resultado-container">
                <h2>Resultado:</h2>
                <?php echo $resultado_html; ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_COOKIE['ex01_ultimo_numero'])): ?>
            <div class="historico">
                Último número verificado: <strong><?= htmlspecialchars($_COOKIE['ex01_ultimo_numero']) ?></strong>
            </div>
        <?php endif; ?>

        <a href="../index.php" class="btn-voltar">Voltar ao Início</a>
    </div>
</body>

</html>