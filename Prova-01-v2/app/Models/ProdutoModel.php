<?php
/*
  classe produtomodel (dao)
  contém toda a lógica de acesso ao banco de dados (crud).
*/

namespace App\Models;

// importa a classe de Conexão e a entidade produto
use App\Core\Conexao;

class ProdutoModel
{

    private $pdo; // armazena a instância do pdo

    public function __construct()
    {
        // obtém a conexão pdo ao instanciar o model
        $this->pdo = Conexao::getConexao();
    }

    // insere um novo produto no banco.
    public function inserir(Produto $produto): bool
    {
        $sql = "INSERT INTO produtos (nome_produto, descricao, preco, categoria) VALUES (?, ?, ?, ?)";

        try {
            $stmt = $this->pdo->prepare($sql);

            return $stmt->execute([
                $produto->getNomeProduto(),
                $produto->getDescricao(),
                $produto->getPreco(),
                $produto->getCategoria()
            ]);
        } catch (\PDOException $e) {
            echo "Erro ao inserir: " . $e->getMessage();
            return false;
        }
    }

    // lista todos os produtos cadastrados.
    public function listarTodos(): array
    {
        $sql = "SELECT * FROM produtos ORDER BY id DESC";
        $stmt = $this->pdo->query($sql);

        // retorna um array associativo
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


    //busca um produto pelo nome.
    public function buscarPorNome(string $nome): array|false
    {
        $sql = "SELECT * FROM produtos WHERE nome_produto = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nome]);

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }


    // atualiza descrição e preço de um produto, buscando pelo nome.
    public function atualizar(string $nome, string $novaDescricao, float $novoPreco): bool
    {
        $sql = "UPDATE produtos SET descricao = ?, preco = ? WHERE nome_produto = ?";

        try {
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$novaDescricao, $novoPreco, $nome]);
        } catch (\PDOException $e) {
            echo "Erro ao atualizar: " . $e->getMessage();
            return false;
        }
    }

    //  exclui um produto pelo nome.
    public function excluirPorNome(string $nome): bool
    {
        $sql = "DELETE FROM produtos WHERE nome_produto = ?";

        try {
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$nome]);
        } catch (\PDOException $e) {
            echo "Erro ao excluir: " . $e->getMessage();
            return false;
        }
    }


    // conta o total de produtos cadastrados.
    public function contarTotal(): int
    {
        $sql = "SELECT COUNT(*) FROM produtos";
        $stmt = $this->pdo->query($sql);

        return (int) $stmt->fetchColumn();
    }
}
