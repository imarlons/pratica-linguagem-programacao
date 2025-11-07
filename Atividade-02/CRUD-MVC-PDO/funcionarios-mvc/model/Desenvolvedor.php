<?php
require_once 'Funcionario.php';

class Desenvolvedor extends Funcionario
{
    // implementação específica do polimorfismo
    public function getBonificacao(): float
    {
        // desenvolvedores ganham 10% de bônus/exemplo
        return $this->getSalario() * 0.10;
    }
}
