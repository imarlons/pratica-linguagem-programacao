<?php
require_once 'veiculo.php';

// classe Filha (subclasse)
class Carro extends Veiculo
{
    private $portas;

    public function __construct($marca, $modelo, $portas)
    {
        // chama o construtor da classe pai para reaproveitar o código
        parent::__construct($marca, $modelo);
        $this->portas = $portas;
    }

    // polimorfismo: sobrescrevendo o método info()
    public function info()
    {
        return "Carro: {$this->marca} {$this->modelo} | Portas: {$this->portas}";
    }
}
