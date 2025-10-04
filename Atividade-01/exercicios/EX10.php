<?php
// Inclui o script de autenticação
require_once '../includes/auth.php';

$resultado_html = '';

// Processa o formulário quando enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mes_num = filter_input(INPUT_POST, 'mes', FILTER_VALIDATE_INT);

    if ($mes_num !== false) {
        $nome_mes = '';

        // Estrutura switch para encontrar o mês
        switch ($mes_num) {
            case 1:
                $nome_mes = "Janeiro";
                break;
            case 2:
                $nome_mes = "Fevereiro";
                break;
            case 3:
                $nome_mes = "Março";
                break;
            case 4:
                $nome_mes = "Abril";
                break;
            case 5:
                $nome_mes = "Maio";
                break;
            case 6:
                $nome_mes = "Junho";
                break;
            case 7:
                $nome_mes = "Julho";
                break;
            case 8:
                $nome_mes = "Agosto";
                break;
            case 9:
                $nome_mes = "Setembro";
                break;
            case 10:
                $nome_mes = "Outubro";
                break;
            case 11:
                $nome_mes = "Novembro";
                break;
            case 12:
                $nome_mes = "Dezembro";
                break;
        }

        if (!empty($nome_mes)) {
            // Salva o último mês válido no cookie
            setcookie('ex10_ultimo_mes', $mes_num, time() + (3600 * 24 * 30), "/");
            $resultado_html = "<div class='resultado-sucesso'>O número {$mes_num} corresponde ao mês de <strong>{$nome_mes}</strong>.</div>";
        } else {
            // Mensagem de erro para número fora do intervalo 1-12
            $resultado_html = "<div class='resultado-erro'>Não existe mês com o número {$mes_num}. Por favor, insira um valor entre 1 e 12.</div>";
        }
    } else {
        $resultado_html = "<div class='resultado-erro'>Por favor, insira um número inteiro válido.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Exercício 10 - Mês por Número</title>
    <link rel="stylesheet" href="../styles.css">
</head>

<body>
    <div class="container">
        <h1>Exercício 10 - Identificação do Mês pelo Número</h1>

        <form action="EX10.php" method="POST">
            <label for="mes">Digite um número de 1 a 12:</label>
            <input type="number" id="mes" name="mes" min="1" max="12" required>
            <button type="submit">Identificar Mês</button>
        </form>

        <?php echo $resultado_html; ?>

        <?php if (isset($_COOKIE['ex10_ultimo_mes'])): ?>
            <div class="historico">
                Último número de mês verificado: <strong><?= htmlspecialchars($_COOKIE['ex10_ultimo_mes']) ?></strong>
            </div>
        <?php endif; ?>

        <a href="../index.php" class="btn-voltar">Voltar ao Início</a>
    </div>
</body>

</html>