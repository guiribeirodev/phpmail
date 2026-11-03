<?php
require_once __DIR__ . '/app/Controllers/ContatoController.php';

$controller = new ContatoController();
$acao = $_GET['acao'] ?? 'index';

switch ($acao) {
    case 'enviar':
        $controller->enviar();
        break;
    case 'listar':
        $controller->listar();
        break;
    case 'index':
    default:
        $controller->index();
        break;
}