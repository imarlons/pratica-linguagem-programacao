<?php
// inicia a sessão
session_start();

$usuario_esperado = 'ADM';
$senha_esperada = '123456';

// verifica se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'] ?? '';
    $senha = $_POST['senha'] ?? '';

    if ($usuario === $usuario_esperado && $senha === $senha_esperada) {
        // autenticação bem-sucedida: armazena apenas o nome do usuário na sessão
        $_SESSION['usuario'] = $usuario;
        // redireciona para o index.php
        header("Location: index.php");
        exit;
    } else {
        // autenticação falhou
        $erro = "USUÁRIO OU SENHA INCORRETOS! TENTE NOVAMENTE!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>[ LOGIN ]</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="login-container">
        <h1>Login</h1>
        <form action="login.php" method="POST">
            <label for="usuario">USUÁRIO:</label>
            <input type="text" id="usuario" name="usuario" required><br><br>
            <label for="senha">SENHA:</label>
            <input type="password" id="senha" name="senha" required><br><br>
            <input type="submit" value="ENTRAR">
        </form>
        <?php if (isset($erro)): ?>
            <p class="resultado-neg"><?php echo $erro; ?></p>
        <?php endif; ?>
    </div>
</body>

</html>