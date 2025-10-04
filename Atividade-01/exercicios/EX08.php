<?php
// Inclui o script de autenticação
require_once '../includes/auth.php';

$resultado_html = '';
$mostrar_form_recuperacao = false;
$media_inicial = 0;

// Processa o formulário quando enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // SEGUNDO PASSO: Formulário de recuperação foi enviado
    if (isset($_POST['submit_recuperacao'])) {
        $media_inicial_rec = filter_input(INPUT_POST, 'media_inicial', FILTER_VALIDATE_FLOAT);
        $nota_rec = filter_input(INPUT_POST, 'nota_recuperacao', FILTER_VALIDATE_FLOAT);

        if ($media_inicial_rec !== false && $nota_rec !== false) {
            $media_final = ($media_inicial_rec + $nota_rec) / 2;
            setcookie('ex08_media', $media_final, time() + (3600 * 24 * 30), "/");

            if ($media_final >= 7) {
                $resultado_html = "<div class='situacao-aprovado'><strong>Aprovado!</strong> Sua média final é {$media_final}.</div>";
            } else {
                $resultado_html = "<div class='situacao-reprovado'><strong>Reprovado.</strong> Sua média final é {$media_final}.</div>";
            }
        } else {
            $resultado_html = "<div class='resultado-erro'>Nota de recuperação inválida.</div>";
        }

        // PRIMEIRO PASSO: Formulário inicial foi enviado
    } else {
        $nota1 = filter_input(INPUT_POST, 'nota1', FILTER_VALIDATE_FLOAT);
        $nota2 = filter_input(INPUT_POST, 'nota2', FILTER_VALIDATE_FLOAT);
        $nota3 = filter_input(INPUT_POST, 'nota3', FILTER_VALIDATE_FLOAT);

        if ($nota1 !== false && $nota2 !== false && $nota3 !== false) {
            $media_inicial = (($nota1 * 2) + ($nota2 * 2) + ($nota3 * 1)) / 5;

            if ($media_inicial >= 7) {
                setcookie('ex08_media', $media_inicial, time() + (3600 * 24 * 30), "/");
                $resultado_html = "<div class='situacao-aprovado'><strong>Aprovado!</strong> Sua média final é {$media_inicial}.</div>";
            } elseif ($media_inicial >= 5) {
                $mostrar_form_recuperacao = true; // Ativa o segundo formulário
            } else {
                setcookie('ex08_media', $media_inicial, time() + (3600 * 24 * 30), "/");
                $resultado_html = "<div class='situacao-reprovado'><strong>Reprovado.</strong> Sua média final é {$media_inicial}.</div>";
            }
        } else {
            $resultado_html = "<div class='resultado-erro'>Por favor, insira três notas válidas.</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Exercício 8 - Média do Aluno</title>
    <link rel="stylesheet" href="../styles.css">
</head>

<body>
    <div class="container">
        <h1>Exercício 8 - Média SGA com Recuperação</h1>

        <?php if ($mostrar_form_recuperacao): ?>
            <div class="situacao-recuperacao">
                Sua média foi <strong><?= number_format($media_inicial, 2) ?></strong>. Você está em recuperação.
            </div>
            <form action="EX08.php" method="POST">
                <input type="hidden" name="media_inicial" value="<?= $media_inicial ?>">
                <label for="nota_recuperacao">Digite a nota da recuperação:</label>
                <input type="number" id="nota_recuperacao" name="nota_recuperacao" step="0.1" min="0" max="10" required>
                <button type="submit" name="submit_recuperacao">Calcular Média Final</button>
            </form>
        <?php else: ?>
            <form action="EX08.php" method="POST">
                <label for="nota1">Nota A1:</label>
                <input type="number" id="nota1" name="nota1" step="0.1" min="0" max="10" required>
                <label for="nota2">Nota A2:</label>
                <input type="number" id="nota2" name="nota2" step="0.1" min="0" max="10" required>
                <label for="nota3">Nota A3:</label>
                <input type="number" id="nota3" name="nota3" step="0.1" min="0" max="10" required>
                <br><br>
                <button type="submit">Calcular Média</button>
            </form>
        <?php endif; ?>

        <?php echo $resultado_html; ?>

        <?php if (isset($_COOKIE['ex08_media'])): ?>
            <div class="historico">
                Última média final calculada: <strong><?= htmlspecialchars($_COOKIE['ex08_media']) ?></strong>
            </div>
        <?php endif; ?>

        <a href="../index.php" class="btn-voltar">Voltar ao Início</a>
    </div>
</body>

</html>