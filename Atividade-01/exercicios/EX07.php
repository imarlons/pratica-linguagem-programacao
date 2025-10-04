<?php
// Inclui o script de autenticação
require_once '../includes/auth.php';

$resultado_html = '';

// Processa o formulário quando enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $numA = filter_input(INPUT_POST, 'numA', FILTER_VALIDATE_FLOAT);
    $numB = filter_input(INPUT_POST, 'numB', FILTER_VALIDATE_FLOAT);

    // Verifica se ambos os valores são números válidos
    if ($numA !== false && $numB !== false) {

        $mensagem = '';
        $cookie_value = '';

        // Lógica de comparação
        if ($numA > $numB) {
            $mensagem = "O valor A ({$numA}) é <strong>MAIOR</strong> que o valor B ({$numB}).";
            $cookie_value = "{$numA} > {$numB}";
        } elseif ($numB > $numA) {
            $mensagem = "O valor A ({$numA}) é <strong>MENOR</strong> que o valor B ({$numB}).";
            $cookie_value = "{$numA} < {$numB}";
        } else {
            $mensagem = "O valor A ({$numA}) é <strong>IGUAL</strong> ao valor B ({$numB}).";
            $cookie_value = "{$numA} = {$numB}";
        }

        // Salva a última comparação no cookie
        setcookie('ex07_comparacao', $cookie_value, time() + (3600 * 24 * 30), "/");

        // Monta o HTML do resultado. Usaremos a classe de sucesso para dar um destaque genérico.
        $resultado_html = "<div class='resultado-sucesso'>{$mensagem}</div>";
    } else {
        $resultado_html = "<div class='resultado-erro'>Por favor, insira dois números válidos.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Exercício 7 - Comparação de A e B</title>
    <link rel="stylesheet" href="../styles.css">
</head>

<body>
    <div class="container">
        <h1>Exercício 7 - Comparação de Valores A e B</h1>

        <form action="EX07.php" method="POST">
            <label for="numA">Valor A:</label>
            <input type="number" id="numA" name="numA" step="any" required>

            <label for="numB">Valor B:</label>
            <input type="number" id="numB" name="numB" step="any" required>

            <br><br>
            <button type="submit">Comparar</button>
        </form>

        <?php echo $resultado_html; ?>

        <?php if (isset($_COOKIE['ex07_comparacao'])): ?>
            <div class="historico">
                Última comparação realizada: <strong><?= htmlspecialchars($_COOKIE['ex07_comparacao']) ?></strong>
            </div>
        <?php endif; ?>

        <a href="../index.php" class="btn-voltar">Voltar ao Início</a>
    </div>
</body>

</html>