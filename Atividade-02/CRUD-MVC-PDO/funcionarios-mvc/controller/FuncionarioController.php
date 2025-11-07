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

    public function editar()
    {
        // pega o id da url
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: index.php?action=listar');
            return;
        }

        // busca o funcionário no banco
        $funcionario = Funcionario::findById($this->db, $id);

        if ($funcionario) {
            // chama a view de edição e passa o objeto
            require __DIR__ . '/../view/editar.php';
        } else {
            echo "Funcionário não encontrado.";
            echo '<br><a href="index.php?action=listar">Voltar</a>';
        }
    }

    // ação: atualizar os dados do funcionário no banco
    public function atualizar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $nome = $_POST['nome'];
            $salario = $_POST['salario'];
            // o 'tipo' não é editado, pois ele define a classe do objeto.

            // busca o objeto *existente*
            $funcionario = Funcionario::findById($this->db, $id);

            if ($funcionario) {
                // atualiza as propriedades do objeto
                $funcionario->setNome($nome);
                $funcionario->setSalario($salario);

                // o método salvar() fará o update, pois o objeto já tem um id
                if ($funcionario->salvar()) {
                    header('Location: index.php?action=listar');
                } else {
                    echo "Erro ao atualizar funcionário.";
                }
            } else {
                echo "Funcionário não encontrado para atualização.";
            }
        }
    }

    // ação: excluir um funcionário
    public function excluir()
    {
        $id = $_GET['id'] ?? null;

        if ($id && Funcionario::excluir($this->db, $id)) {
            // sucesso, redireciona para a listagem
            header('Location: index.php?action=listar');
        } else {
            echo "Erro ao excluir funcionário.";
            echo '<br><a href="index.php?action=listar">Voltar</a>';
        }
    }
}
