<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php
    // expira o cookie de autenticação
    // define a data de validade no passado apra remover o cookie
    setcookie('autenticado', '', time() - 3600);
    header('Location: login.php');
    exit;
    ?>
</body>

</html>