<?php

$path_replace = str_replace('/ProjetoTorneart/', '/', $_SERVER["REQUEST_URI"]);
$path = parse_url($path_replace, PHP_URL_PATH);

$method;

if(isset($_POST["method"])){
    $method = $_POST["method"];
}else{
    $method = $_SERVER["REQUEST_METHOD"];
}

require_once 'router.php';
$router = new Router();

require_once 'controller/PecaController.php';
require_once 'controller/ClienteController.php';
require_once 'model/Peca.php';
require_once 'model/Cliente.php';

$router->get('/', function () {
    require 'view/home.php';
});

$router->get('/cliente', function(){
    $clienteController = new ClienteController();
    $clienteController->listarClientes();
});

$router->post('/cliente', function(){
    $clienteController = new ClienteController();
    $cliente = new Cliente();
    $cliente->setNome($_POST["nome"]);
    $clienteController->cadastro($cliente);
    header('Location: cliente');
    exit;
});

$router->put('/cliente', function(){
    $clienteController = new ClienteController();
    $novoCliente = new Cliente();
    $novoCliente->setId($_POST["id"]);
    $novoCliente->setNome($_POST["nome"]);
    $clienteController->editarCliente($novoCliente);
    header('Location: cliente');
    exit;
});

$router->delete('/cliente', function(){
    $clienteController = new ClienteController();
    $clienteController->excluirCliente($_POST["idcliente"]);
    header('Location: cliente');
    exit;
});

$router->get('/cliente/{id}/pecas', function($id){
    $pecaController = new PecaController();
    $pecaController->listarPecasCliente($id);
});

$router->post('/cliente/{id}/pecas', function () {
    $pecaController = new PecaController();
    $peca = new Peca();
    $peca->setNome($_POST["nome"]);
    $peca->setPreco($_POST["preco"]);
    $peca->setIdCliente($_POST["idcliente"]);
    $pecaController->cadastro($peca);
    header('Location: /ProjetoTorneart/cliente/'. $_POST["idcliente"] .'/pecas');
    exit;
});

$router->dispatch($path, $method);
