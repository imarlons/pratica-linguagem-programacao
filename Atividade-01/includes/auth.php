<?php
// garante que a sessão está iniciada em todas as páginas
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// verifica se a variável de sessão 'usuario' existe
if (!isset($_SESSION['usuario'])) {
    // se não estiver logado, redireciona para a página de login (login.html ou login.php)
    header("Location: login.html");
    exit;
}

// armazena o nome do usuário para ser exibido
$usuario_logado = $_SESSION['usuario'];
?>

<div class="auth-info">
    <span>Usuário logado: <strong class="resultado-pos"><?php echo htmlspecialchars($usuario_logado); ?></strong></span>
    <a href="logout.php" class="button-logout">Logout</a>
</div>