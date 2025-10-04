<?php
// Inclui o script de autenticação
require_once '../includes/auth.php';

$resultado_html = '';

// Processa o formulário quando enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $numero = filter_input(INPUT_POST, 'numero', FILTER_VALIDATE_INT);

    if ($numero !== false) {
        // Salva o último número pesquisado no cookie 
        setcookie('ex02_ultimo_numero', $numero, time() + (3600 * 24 * 30), "/");

        // Monta a string HTML com a tabuada
        $resultado_html .= "<h2>Tabuada do $numero:</h2>";
        $resultado_html .= "<ul>";
        for ($i = 0; $i <= 10; $i++) { // Gera a tabuada de 0 a 10 
            $resultado_html .= "<li>$numero x $i = " . ($numero * $i) . "</li>";
        }
        $resultado_html .= "</ul>";
    } else {
        $resultado_html = "<p class=\"resultado-neg\">Por favor, insira um número inteiro válido.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Exercício 2 - Tabuada</title>
    <link rel="stylesheet" href="../styles.css">
</head>

<body>
    <div class="container">
        <h1>Exercício 2 - Tabuada de um Número</h1>

        <form action="EX02.php" method="POST">
            <label for="numero">Digite um número inteiro:</label>
            <input type="number" id="numero" name="numero" required>
            <button type="submit">Gerar Tabuada</button>
        </form>

        <?php if (!empty($resultado_html)): ?>
            <div class="resultado-container">
                <?php echo $resultado_html; ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_COOKIE['ex02_ultimo_numero'])): ?>
            <div class="historico">
                Última tabuada gerada foi a do número: <strong><?= htmlspecialchars($_COOKIE['ex02_ultimo_numero']) ?></strong>
            </div>
        <?php endif; ?>

        <a href="../index.php" class="btn-voltar">Voltar ao Início</a>
    </div>
</body>

</html>