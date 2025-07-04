<?php
$path = str_replace('/ProjetoTorneart/', '/', $_SERVER["REQUEST_URI"]);

require_once 'router.php';
$router = new Router();

require_once 'controller/PecaController.php';
require_once 'controller/ClienteController.php';
require_once 'model/Peca.php';
require_once 'model/Cliente.php';

$router->get('/', function () {
    require 'view/home.php';
});

$router->get('/cadastrar-peca', function () {
    $pecaController = new PecaController();
    $pecaController->formCadastro();
});

$router->get('/cadastrar-cliente', function(){
    require 'view/cadastrocliente.php';
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
    header('Location: cadastrar-cliente');
    exit;
});

$router->get('/cliente/{id}/pecas', function($id){
    $pecaController = new PecaController();
    $pecaController->listarPecasCliente($id);
});

$router->post('/peca', function () {
    $pecaController = new PecaController();
    $peca = new Peca();
    $peca->setNome($_POST["nome"]);
    $peca->setPreco($_POST["preco"]);
    $peca->setIdCliente($_POST["idcliente"]);
    $pecaController->cadastro($peca);
    header('Location: cadastrar-peca');
    exit;
});

$router->dispatch($path, $_SERVER["REQUEST_METHOD"]);
