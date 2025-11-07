<?php

abstract class Funcionario
{
    protected $id;
    protected $nome;
    protected $salario;
    protected $db;

    // construtor
    public function __construct($db, $nome = null, $salario = null)
    {
        $this->db = $db;
        $this->nome = $nome;
        $this->salario = $salario;
    }

    // getters
    public function getNome(): string
    {
        return $this->nome;
    }

    public function getSalario(): float
    {
        return $this->salario;
    }

    public function getId(): int
    {
        return $this->id;
    }

    // setters (para carregar dados do db)
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    public function setSalario($salario)
    {
        $this->salario = $salario;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    // ----- polimorfismo -----
    // método abstrato que força as classes filhas a implementar 
    abstract public function getBonificacao(): float;

    // Método final que usa o polimorfismo
    public final function getSalarioTotal(): float
    {
        return $this->salario + $this->getBonificacao();
    }

    // ----- persistência (crud) -----
    // método salvar (create/update)
    public function salvar()
    {
        // define o tipo baseado na classe
        $tipo = 'funcionario'; // default
        if ($this instanceof Gerente) {
            $tipo = 'gerente';
        } elseif ($this instanceof Desenvolvedor) {
            $tipo = 'desenvolvedor';
        }

        // se tem id, atualiza (update)
        if ($this->id) {
            $query = "UPDATE funcionarios SET nome = :nome, salario = :salario, tipo = :tipo WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $this->id);
        }
        // se não tem id, cria (create)
        else {
            $query = "INSERT INTO funcionarios (nome, salario, tipo) VALUES (:nome, :salario, :tipo)";
        }

        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':salario', $this->salario);
        $stmt->bindParam(':tipo', $tipo);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao salvar: " . $e->getMessage();
            return false;
        }
    }

    // listar todos (read)
    public static function listarTodos($db): array
    {
        $query = "SELECT * FROM funcionarios";
        $stmt = $db->prepare($query);
        $stmt->execute();

        $funcionarios = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $funcionario = null;

            switch ($row['tipo']) {
                case 'gerente':
                    $funcionario = new Gerente($db);
                    break;
                case 'desenvolvedor':
                    $funcionario = new Desenvolvedor($db);
                    break;
            }

            if ($funcionario) {
                $funcionario->setId($row['id']);
                $funcionario->setNome($row['nome']);
                $funcionario->setSalario($row['salario']);
                $funcionarios[] = $funcionario;
            }
        }
        return $funcionarios;
    }
}
