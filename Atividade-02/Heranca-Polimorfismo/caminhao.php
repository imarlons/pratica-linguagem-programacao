<?php
require_once 'veiculo.php';

// terceira classe Filha
class Caminhao extends Veiculo
{
    private $capacidadeCarga;

    public function __construct($marca, $modelo, $capacidadeCarga)
    {
        parent::__construct($marca, $modelo);
        $this->capacidadeCarga = $capacidadeCarga;
    }

    // polimorfismo: sobrescrevendo o método info()
    public function info()
    {
        return "Caminhão: {$this->marca} {$this->modelo} | Capacidade: {$this->capacidadeCarga} Toneladas";
    }
}
