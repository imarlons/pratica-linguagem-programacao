<?php

// inclui a definição da classe Usuario, pois será usada abaixo
require_once 'Usuario.php';

// classe criada para demonstrar a instanciação de Usuario a partir de outro método.
class AcessaUsuario
{

    // método que cria e exibe um usuário.
    public function imprimeUsuario()
    {
        echo "<h2>Teste do arquivo acessaUsuario.php</h2>";

        // 1. instancia a classe Usuario
        $usuario = new Usuario(
            "Bruce Wayne",
            "987.654.321-00",
            "Avenida Wayne, 456 - Gotham"
        );

        // 2. exibe os dados do usuário no navegador
        echo "Nome: " . $usuario->nome . "<br>";
        echo "CPF: " . $usuario->cpf . "<br>";
        echo "Endereço: " . $usuario->getEndereco() . "<br>";
    }
}

// para testar este arquivo, precisamos instanciar a classe AcessaUsuario e chamar seu método
$acesso = new AcessaUsuario();
$acesso->imprimeUsuario();
