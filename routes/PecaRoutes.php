<?php

return function (Router $router) {
    $router->get('/cliente/{id}/pecas', function ($id) {
        $pecaController = new PecaController();
        $pecaController->listarPecasCliente($id);
    });

    $router->post('/cliente/{id}/pecas', function ($id) {
        $pecaController = new PecaController();
        $peca = new Peca();
        $peca->setNome($_POST["nome"]);
        $peca->setPreco($_POST["preco"]);
        $peca->setIdCliente($id);
        $pecaController->cadastro($peca);
        header('Location: /cliente/' . $id . '/pecas');
        exit;
    });

    $router->put('/cliente/{id}/pecas', function ($id) {
        $pecaController = new PecaController();
        $peca = new Peca();
        $peca->setId($_POST["id"]);
        $peca->setNome($_POST["nome"]);
        $peca->setPreco($_POST["preco"]);
        $pecaController->editarPeca($peca);
        header('Location: /cliente/' . $id . '/pecas');
        exit;
    });

    $router->delete('/cliente/{id}/pecas', function ($id) {
        $pecaController = new PecaController();
        $pecaController->excluirPeca($_POST["idpeca"]);
        header('Location: /cliente/' . $id . '/pecas');
        exit;
    });
};
