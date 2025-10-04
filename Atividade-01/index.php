<?php
// inclui o script de autenticação para proteger a página
require_once 'includes/auth.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>[ INDEX | LISTA DE EXERCÍCIOS ]</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <div class="page-header">
            <h1>Lista de Exercícios</h1>
            <div class="auth-info">
                <span>LOGADO COM: <strong class="resultado-pos"><?= htmlspecialchars($_SESSION['usuario']) ?></strong></span>
                <a href="logout.php" class="button-logout">SAIR</a>
            </div>
        </div>

        <div class="exercise-grid">
            <a href="exercicios/EX01.php" class="exercise-card">
                <h2>Exercício 1</h2>
                <p>Verificação de Número Positivo, Negativo ou Zero</p>
            </a>
            <a href="exercicios/EX02.php" class="exercise-card">
                <h2>Exercício 2</h2>
                <p>Tabuada de um Número</p>
            </a>
            <a href="exercicios/EX03.php" class="exercise-card">
                <h2>Exercício 3</h2>
                <p>Cálculo do Fatorial com Recursão</p>
            </a>
            <a href="exercicios/EX04.php" class="exercise-card">
                <h2>Exercício 4</h2>
                <p>Calculadora com SwitchCase</p>
            </a>
            <a href="exercicios/EX05.php" class="exercise-card">
                <h2>Exercício 5</h2>
                <p>Verificação de Número Par ou Ímpar</p>
            </a>
            <a href="exercicios/EX06.php" class="exercise-card">
                <h2>Exercício 6</h2>
                <p>Impressão de Valores em Ordem Crescente</p>
            </a>
            <a href="exercicios/EX07.php" class="exercise-card">
                <h2>Exercício 7</h2>
                <p>Comparação de Valores A e B</p>
            </a>
            <a href="exercicios/EX08.php" class="exercise-card">
                <h2>Exercício 8</h2>
                <p>Cálculo da Média Final de um Aluno</p>
            </a>
            <a href="exercicios/EX09.php" class="exercise-card">
                <h2>Exercício 9</h2>
                <p>Verificação de Maioridade</p>
            </a>
            <a href="exercicios/EX10.php" class="exercise-card">
                <h2>Exercício 10</h2>
                <p>Identificação do Mês pelo Número</p>
            </a>
            <a href="exercicios/EX11.php" class="exercise-card">
                <h2>Exercício 11</h2>
                <p>Cadastro de Alunos e Carga Horária (BD)</p>
            </a>
            <a href="exercicios/EX12.php" class="exercise-card">
                <h2>Exercício 12</h2>
                <p>Busca e Exclusão de Registros (BD)</p>
            </a>
        </div>
    </div>
</body>

</html>