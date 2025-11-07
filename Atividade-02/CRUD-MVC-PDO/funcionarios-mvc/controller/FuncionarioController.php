<?php
// inclui todos os modelos e a conexão
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../model/Funcionario.php';
require_once __DIR__ . '/../model/Gerente.php';
require_once __DIR__ . '/../model/Desenvolvedor.php';

class FuncionarioController
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // ação: listar todos 
    public function listar()
    {
        $funcionarios = Funcionario::listarTodos($this->db);

        // chama a view e passa os dados
        require __DIR__ . '/../view/listar.php';
    }

    // ação: mostrar formulário de criação 
    public function criar()
    {
        require __DIR__ . '/../view/criar.php';
    }

    // ação: salvar um novo funcionário
    public function salvar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'];
            $salario = $_POST['salario'];
            $tipo = $_POST['tipo'];

            $funcionario = null;

            // instancia o objeto correto baseado no tipo
            if ($tipo === 'gerente') {
                $funcionario = new Gerente($this->db, $nome, $salario);
            } elseif ($tipo === 'desenvolvedor') {
                $funcionario = new Desenvolvedor($this->db, $nome, $salario);
            }

            if ($funcionario && $funcionario->salvar()) {
                // redireciona para a listagem após salvar
                header('Location: index.php?action=listar');
            } else {
                echo "Erro ao salvar funcionário.";
            }
        }
    }
}
