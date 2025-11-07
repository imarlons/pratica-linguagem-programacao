<?php
require_once 'Funcionario.php';

class Gerente extends Funcionario
{

    // implementação específica do polimorfismo
    public function getBonificacao(): float
    {
        // gerentes ganham 20% de bônus/exemplo
        return $this->getSalario() * 0.20;
    }
}
