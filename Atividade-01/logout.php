<?php
// inicia a sessão, para assim poder destruí-la
session_start();

// destrói todas as variáveis de sessão
$_SESSION = array();

// se for usar cookies de sessão, destrói o cookie também
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 3600,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// destrói a sessão
session_destroy();

// redireciona para a tela de login
header("Location: login.html");
exit;
