<?php
// verifica se o formulário de login foi enviado
if (isset($_POST['login'])) {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // verifica se o usuário e a senha correspondem
    if ($usuario === 'admin' && $senha === 'admin') {
        // autenticação bem-sucedido, cria um cookie de autenticação
        setcookie('autenticado', 'true', time() + 3600); // define o cookie para durar 1h
        header('Location: conteudo_restrito.php');
        exit;
    } else {
        $mensagem_erro = "CREDENCIAIS INVÁLIDAS. TENTE NOVAMENTE.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h1>Login</h1>

    <?php if (isset($mensagem_erro)) { ?>
        <p><?php echo $mensagem_erro; ?></p>
    <?php } ?>

    <form method="post">
        <label for="usuario">Usuário:</label>
        <input type="text" name="usuario" , id="usuario">
        <br>
        <label for="usuario">Senha:</label>
        <input type="password" name="senha" id="senha">
        <br>
        <input type="submit" name="login" id="Login">
    </form>
</body>

</html>