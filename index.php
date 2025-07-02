<?php
$path = str_replace('/ProjetoTorneart/', '/', $_SERVER["REQUEST_URI"]);

require_once 'router.php';
$router = new Router();

$router->get('/', function () {
    require 'view/home.php';
});

$router->get('/peca/cadastro', function () {
    require 'controller/PecaController.php';
    $pecaController = new PecaController();
    $pecaController->cadastro();
});

$router->post('/teste', function () {
    echo 'Requisição POST!';
});

$router->dispatch($path, $_SERVER["REQUEST_METHOD"]);
