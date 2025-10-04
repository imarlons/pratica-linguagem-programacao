<?php
// Inclui o script de autenticação
require_once '../includes/auth.php';

$resultado_html = '';

// Processa o formulário quando enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $num1 = filter_input(INPUT_POST, 'num1', FILTER_VALIDATE_FLOAT);
    $num2 = filter_input(INPUT_POST, 'num2', FILTER_VALIDATE_FLOAT);
    $operacao = $_POST['operacao'] ?? '';

    if ($num1 !== false && $num2 !== false) {
        $resultado = 0;
        $simbolo_op = '';
        $calculo_str = '';
        $erro = '';

        switch ($operacao) { // 
            case 'soma':
                $resultado = $num1 + $num2;
                $simbolo_op = '+';
                break;
            case 'subtracao':
                $resultado = $num1 - $num2;
                $simbolo_op = '-';
                break;
            case 'multiplicacao':
                $resultado = $num1 * $num2;
                $simbolo_op = 'x';
                break;
            case 'divisao':
                if ($num2 != 0) { // 
                    $resultado = $num1 / $num2;
                    $simbolo_op = '÷';
                } else {
                    $erro = "Erro: Divisão por zero não é permitida.";
                }
                break;
            case 'potencia':
                $resultado = pow($num1, $num2);
                $simbolo_op = '^';
                break;
            case 'raiz':
                if ($num1 >= 0) {
                    $resultado = sqrt($num1);
                    // Para a raiz, a string de cálculo é diferente
                    $calculo_str = "√{$num1} = {$resultado}";
                } else {
                    $erro = "Erro: Não é possível calcular a raiz quadrada de um número negativo.";
                }
                break;
            default:
                $erro = "Operação inválida selecionada.";
                break;
        }

        if (empty($erro)) {
            // Se a string de cálculo não foi definida (caso da raiz), monta a padrão
            if (empty($calculo_str)) {
                $calculo_str = "{$num1} {$simbolo_op} {$num2} = {$resultado}";
            }

            // Salva a operação completa no cookie 
            setcookie('ex04_ultimo_calculo', $calculo_str, time() + (3600 * 24 * 30), "/");

            // Monta o HTML do resultado com fundo verde 
            $resultado_html = "<div class='resultado-sucesso'>Resultado: {$calculo_str}</div>";
        } else {
            $resultado_html = "<div class='resultado-erro'>{$erro}</div>";
        }
    } else {
        $resultado_html = "<div class='resultado-erro'>Por favor, insira números válidos.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Exercício 4 - Calculadora</title>
    <link rel="stylesheet" href="../styles.css">
</head>

<body>
    <div class="container">
        <h1>Exercício 4 - Calculadora com Switch</h1>

        <form action="EX04.php" method="POST">
            <input type="number" name="num1" step="any" placeholder="Primeiro número" required>

            <select name="operacao" required>
                <option value="soma">+</option>
                <option value="subtracao">-</option>
                <option value="multiplicacao">x</option>
                <option value="divisao">÷</option>
                <option value="potencia">^ (Potência)</option>
                <option value="raiz">√ (Raiz Quadrada)</option>
            </select>

            <input type="number" name="num2" step="any" placeholder="Segundo número" required>
            <p style="font-size: 0.8em; color: #555;">(Para Raiz Quadrada, o segundo número é ignorado)</p>

            <button type="submit">Calcular</button>
        </form>

        <?php echo $resultado_html; ?>

        <?php if (isset($_COOKIE['ex04_ultimo_calculo'])): ?>
            <div class="historico">
                Último cálculo realizado: <strong><?= htmlspecialchars($_COOKIE['ex04_ultimo_calculo']) ?></strong>
            </div>
        <?php endif; ?>

        <a href="../index.php" class="btn-voltar">Voltar ao Início</a>
    </div>
</body>

</html>