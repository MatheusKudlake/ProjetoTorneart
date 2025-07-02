<?php
$path = str_replace('/ProjetoTorneart/', '/', $_SERVER["REQUEST_URI"]);

require_once 'router.php';
$router = new Router();

require 'controller/PecaController.php';

$router->get('/', function () {
    require 'view/home.php';
});

$router->get('/cadastrar-peca', function () {
    $pecaController = new PecaController();
    $pecaController->formCadastro();
});

$router->post('/peca', function () {
    $pecaController = new PecaController();
    $pecaController->cadastro($_POST);
});

$router->dispatch($path, $_SERVER["REQUEST_METHOD"]);
