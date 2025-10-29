<?php
// classe pai (superclasse)
class Veiculo
{
    protected $marca;
    protected $modelo;

    public function __construct($marca, $modelo)
    {
        $this->marca = $marca;
        $this->modelo = $modelo;
    }

    public function getMarca()
    {
        return $this->marca;
    }

    public function getModelo()
    {
        return $this->modelo;
    }

    // método que será sobrescrito (polimorfismo)
    public function info()
    {
        return "Veículo: {$this->marca} {$this->modelo}";
    }
}
