<?php

class Usuario
{
    // atributos
    public $nome;
    public $cpf;
    private $endereco; // privado, só pode ser acessado de dentro desta classe

    // o construtor é chamado automaticamente quando um novo objeto é criado (usando 'new')

    public function __construct($nome, $cpf, $endereco)
    {
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->endereco = $endereco;
    }

    // método "getter" para acessar o atributo privado $endereco.
    // esta é a única forma de ler o endereço de fora da classe.

    public function getEndereco()
    {
        return $this->endereco;
    }
}
