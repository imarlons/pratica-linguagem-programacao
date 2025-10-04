<?php
// Inclui o script de autenticação
require_once '../includes/auth.php';

$resultado_html = '';

// Processa o formulário quando enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Coleta os 5 números do formulário
    $numeros_input = [
        filter_input(INPUT_POST, 'num1', FILTER_VALIDATE_FLOAT),
        filter_input(INPUT_POST, 'num2', FILTER_VALIDATE_FLOAT),
        filter_input(INPUT_POST, 'num3', FILTER_VALIDATE_FLOAT),
        filter_input(INPUT_POST, 'num4', FILTER_VALIDATE_FLOAT),
        filter_input(INPUT_POST, 'num5', FILTER_VALIDATE_FLOAT)
    ];

    // Verifica se todos os valores são números válidos
    if (!in_array(false, $numeros_input, true)) {

        // Ordena o array de números em ordem crescente
        $numeros_ordenados = $numeros_input;
        sort($numeros_ordenados);

        // Salva o resultado ordenado no cookie
        $cookie_value = implode(", ", $numeros_ordenados);
        setcookie('ex06_resultado', $cookie_value, time() + (3600 * 24 * 30), "/");

        // Monta o HTML com as cores destacadas
        $resultado_html = "<h2>Números em ordem crescente:</h2><p style='font-size: 1.2em;'>";

        foreach ($numeros_ordenados as $index => $numero) {
            $classe_css = '';
            // Aplica a classe no menor (índice 0)
            if ($index == 0) $classe_css = 'texto-verde';
            // Aplica a classe no do meio (índice 2)
            if ($index == 2) $classe_css = 'texto-amarelo';
            // Aplica a classe no maior (índice 4)
            if ($index == 4) $classe_css = 'texto-vermelho';

            $resultado_html .= "<span class='{$classe_css}'>{$numero}</span> ";
        }
        $resultado_html .= "</p>";
    } else {
        $resultado_html = "<div class='resultado-erro'>Por favor, insira 5 números válidos.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Exercício 6 - Ordem Crescente</title>
    <link rel="stylesheet" href="../styles.css">
</head>

<body>
    <div class="container">
        <h1>Exercício 6 - Impressão de Valores em Ordem Crescente</h1>

        <form action="EX06.php" method="POST">
            <p>Digite 5 números:</p>
            <input type="number" name="num1" step="any" required>
            <input type="number" name="num2" step="any" required>
            <input type="number" name="num3" step="any" required>
            <input type="number" name="num4" step="any" required>
            <input type="number" name="num5" step="any" required>
            <br><br>
            <button type="submit">Ordenar</button>
        </form>

        <?php if (!empty($resultado_html)): ?>
            <div class="resultado-container" style="margin-top:20px;">
                <?php echo $resultado_html; ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_COOKIE['ex06_resultado'])): ?>
            <div class="historico">
                Última sequência ordenada: <strong><?= htmlspecialchars($_COOKIE['ex06_resultado']) ?></strong>
            </div>
        <?php endif; ?>

        <a href="../index.php" class="btn-voltar">Voltar ao Início</a>
    </div>
</body>

</html>