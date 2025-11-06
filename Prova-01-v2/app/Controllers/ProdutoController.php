<?php
/*
  classe produtocontroller
  o cérebro da aplicação (controller).
*/

namespace App\Controllers;

// importa os models que o controller irá usar
use App\Models\Produto;
use App\Models\ProdutoModel;

class ProdutoController
{

    private $produtoModel;

    public function __construct()
    {
        // instancia o model para que o controller possa usá-lo
        $this->produtoModel = new ProdutoModel();
    }

    // ação: listar todos os produtos (página inicial)
    public function listar()
    {
        // pede ao model os dados
        $produtos = $this->produtoModel->listarTodos();
        $total = $this->produtoModel->contarTotal();

        // carrega a view de listagem, "injetando" os dados nela
        require_once '../public/views/listagem.php';
    }

    //  ação: exibir o formulário de cadastro (página nova)
    public function formularioCadastro()
    {
        // prepara variáveis para a view do formulário
        $produto = null; // nenhum produto para preencher (é um cadastro)
        $acao = 'salvar'; // ação que o formulário irá executar
        $titulo = 'Cadastro de Novo Produto';

        // carrega a view do formulário
        require_once '../public/views/formulario.php';
    }

    // ação: exibir o formulário de atualização (pré-preenchido)
    public function formularioAtualizacao()
    {
        // pega o nome do produto da url (get)
        $nome = $_GET['nome'];

        // pede ao model para buscar o produto
        $produto = $this->produtoModel->buscarPorNome($nome);

        // prepara variáveis para a view
        $acao = 'atualizar'; // ação que o formulário irá executar
        $titulo = 'Atualizar Produto';

        // carrega a view do formulário
        require_once '../public/views/formulario.php';
    }

    //  ação: Salvar um novo produto (create)
    public function salvar()
    {
        // Cria um objeto Produto com os dados do formulário (post)
        $produto = new Produto(
            $_POST['nome_produto'],
            $_POST['descricao'],
            (float) $_POST['preco'],
            $_POST['categoria']
        );

        // pede ao model para inserir no banco
        $this->produtoModel->inserir($produto);

        // redireciona o usuário para a página de listagem
        header('Location: index.php?acao=listar');
    }

    //  ação: Atualizar um produto existente (update)
    public function atualizar()
    {
        // pega os dados do formulário (post)
        $nomeOriginal = $_POST['nome_original'];
        $novaDescricao = $_POST['descricao'];
        $novoPreco = (float) $_POST['preco'];

        // pede ao model para atualizar
        $this->produtoModel->atualizar($nomeOriginal, $novaDescricao, $novoPreco);

        // redireciona o usuário para a página de listagem
        header('Location: index.php?acao=listar');
    }

    // ação: deletar um produto (delete)
    public function deletar()
    {
        // pega o nome da URL (get)
        $nome = $_GET['nome'];

        // pede ao model para excluir
        $this->produtoModel->excluirPorNome($nome);

        // redireciona o usuário para a página de listagem
        header('Location: index.php?acao=listar');
    }
}
