<?php
return function (Router $router) {
    $router->get('/cliente', function () {
        $clienteController = new ClienteController();
        $clienteController->listarClientes();
    });

    $router->post('/cliente', function () {
        $clienteController = new ClienteController();
        $cliente = new Cliente();
        $cliente->setNome($_POST["nome"]);
        $clienteController->cadastro($cliente);
        header('Location: cliente');
        exit;
    });

    $router->put('/cliente', function () {
        $clienteController = new ClienteController();
        $novoCliente = new Cliente();
        $novoCliente->setId($_POST["id"]);
        $novoCliente->setNome($_POST["nome"]);
        $clienteController->editarCliente($novoCliente);
        header('Location: cliente');
        exit;
    });

    $router->delete('/cliente', function () {
        $clienteController = new ClienteController();
        $clienteController->excluirCliente($_POST["idcliente"]);
        header('Location: cliente');
        exit;
    });
};
