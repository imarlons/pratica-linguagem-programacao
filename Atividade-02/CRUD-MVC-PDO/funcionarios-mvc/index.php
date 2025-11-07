<?php

require_once 'controller/FuncionarioController.php';

$controller = new FuncionarioController();

// define a ação com base no parâmetro 'action' da URL
$action = $_GET['action'] ?? 'listar'; // ação padrão é 'listar'

switch ($action) {
    case 'listar':
        $controller->listar();
        break;
    case 'criar':
        $controller->criar();
        break;
    case 'salvar':
        $controller->salvar();
        break;
    case 'editar':
        $controller->editar();
        break;
    case 'atualizar':
        $controller->atualizar();
        break;
    case 'excluir':
        $controller->excluir();
        break;
    default:
        $controller->listar();
        break;
}
