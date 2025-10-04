<?php
// Inclui o script de autenticação
require_once '../includes/auth.php';

$resultado_html = '';

// Função RECURSIVA para calcular o fatorial
function calcularFatorial($n)
{
    // Caso base: fatorial de 0 é 1
    if ($n == 0) {
        return 1;
    }
    // Passo recursivo
    return $n * calcularFatorial($n - 1);
}

// Função para gerar a string de cálculo (ex: "5 x 4 x 3 x 2 x 1")
function getFatorialString($n)
{
    if ($n == 0) return "1";
    $str = "";
    for ($i = $n; $i >= 1; $i--) {
        $str .= $i . ($i > 1 ? " x " : "");
    }
    return $str;
}

// Processa o formulário quando enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $numero = filter_input(INPUT_POST, 'numero', FILTER_VALIDATE_INT);

    // Valida se o número é um inteiro entre 0 e 20 
    if ($numero !== false && $numero >= 0 && $numero <= 20) {
        // Salva o último número no cookie 
        setcookie('ex03_ultimo_numero', $numero, time() + (3600 * 24 * 30), "/");

        $resultado = calcularFatorial($numero);
        $string_calculo = getFatorialString($numero);

        // Usa a classe CSS de sucesso (verde)
        $resultado_html = "<div class='resultado-sucesso' style='padding: 15px; border: 1px solid #c3e6cb;'>";
        $resultado_html .= "<strong>$numero!</strong> = $string_calculo = <strong>$resultado</strong>";
        $resultado_html .= "</div>";
    } else {
        // Usa a classe CSS de erro (vermelho)
        $resultado_html = "<div class='resultado-erro' style='padding: 15px; border: 1px solid #f5c6cb;'>";
        $resultado_html .= "Erro: Por favor, insira um número inteiro válido entre 0 e 20.";
        $resultado_html .= "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Exercício 3 - Fatorial Recursivo</title>
    <link rel="stylesheet" href="../styles.css">
</head>

<body>
    <div class="container">
        <h1>Exercício 3 - Cálculo de Fatorial com Recursão</h1>

        <form action="EX03.php" method="POST">
            <label for="numero">Digite um número (0 a 20):</label>
            <input type="number" id="numero" name="numero" min="0" max="20" required>
            <button type="submit">Calcular Fatorial</button>
        </form>

        <?php if (!empty($resultado_html)): ?>
            <div class="resultado-container" style="margin-top:20px;">
                <?php echo $resultado_html; ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_COOKIE['ex03_ultimo_numero'])): ?>
            <div class="historico">
                Último número calculado: <strong><?= htmlspecialchars($_COOKIE['ex03_ultimo_numero']) ?></strong>
            </div>
        <?php endif; ?>

        <a href="../index.php" class="btn-voltar">Voltar ao Início</a>
    </div>
</body>

</html>