<?php
/*
  ponto de entrada único (front controller / roteador)
  todas as requisições passam por aqui.
*/

// define o namespace base da aplicação
const APP_NAMESPACE_PREFIX = 'App\\';

// autoloader PSR-4 simples
// isso carrega as classes (conexao, produto, etc.) automaticamente
// quando elas são usadas pela primeira vez.
spl_autoload_register(function ($classe) {
    // remove o prefixo do namespace
    $classeSemPrefixo = str_replace(APP_NAMESPACE_PREFIX, '', $classe);

    // converte o nome da classe em um caminho de arquivo
    // Ex: App\Controllers\ProdutoController -> ../app/Controllers/ProdutoController.php
    $arquivo = __DIR__ . '/../app/' . str_replace('\\', '/', $classeSemPrefixo) . '.php';

    if (file_exists($arquivo)) {
        require_once $arquivo;
    }
});

// importa o Controller principal
use App\Controllers\ProdutoController;

// --- roteamento ---

// pega a 'acao' da url. se não houver, o padrão é 'listar'.
$acao = $_GET['acao'] ?? 'listar';

// instancia o controller
$controller = new ProdutoController();

// verifica qual ação deve ser executada
switch ($acao) {
    // === rotas get (exibição de páginas) ===
    case 'listar':
        $controller->listar();
        break;

    case 'formularioCadastro':
        $controller->formularioCadastro();
        break;

    case 'formularioAtualizacao':
        // requer o parâmetro 'nome' na url (ex: &nome=ProdutoA)
        $controller->formularioAtualizacao();
        break;

    case 'deletar':
        // requer o parâmetro 'nome' na URL
        $controller->deletar();
        break;

    // === rotas post (processamento de formulários) ===
    case 'salvar':
        // vem do formulário de cadastro (method="post")
        $controller->salvar();
        break;

    case 'atualizar':
        // vem do formulário de atualização (method="post")
        $controller->atualizar();
        break;

    // === rota padrão ===
    default:
        $controller->listar();
        break;
}
