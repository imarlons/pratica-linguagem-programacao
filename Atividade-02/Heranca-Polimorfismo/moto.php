<?php
require_once 'veiculo.php';

// classe Filha (subclasse)
class Moto extends Veiculo
{
    private $cilindradas;

    public function __construct($marca, $modelo, $cilindradas)
    {
        // chama o construtor da classe pai
        parent::__construct($marca, $modelo);
        $this->cilindradas = $cilindradas;
    }

    // polimorfismo: sobrescrevendo o método info()
    public function info()
    {
        return "Moto: {$this->marca} {$this->modelo} | Cilindradas: {$this->cilindradas}cc";
    }
}
