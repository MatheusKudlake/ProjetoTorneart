<?php

return function (Router $router) {
    $router->post('/servicos/{id}', function ($id) {
        $servico = new Servico();
        $servicoController = new ServicoController();

        $servico->setId($_POST["id"]);
        $servico->setIdPeca($_POST["idpeca"]);
        $servico->setIdEntrega($_POST["identrega"]);
        $servico->setQuantidade($_POST["quantidade"]);
        $servico->setCusto($_POST["custo"]);
        $servico->setPreco($_POST["preco"]);

        $servicoController->cadastro($servico);

        header('Location: /ProjetoTorneart/entregas/' . $id);
        exit;
    });

    $router->put('/servicos/{id}', function ($id) {
        $servicoController = new ServicoController();
        $servico = new Servico();
        $servico->setId($_POST["id"]);
        $servico->setIdPeca($_POST["idpeca"]);
        $servico->setIdEntrega($_POST["identrega"]);
        $servico->setQuantidade($_POST["quantidade"]);
        $servico->setCusto($_POST["custo"]);
        $servico->setPreco($_POST["preco"]);

        $servicoController->editarServico($servico);

        header('Location: /ProjetoTorneart/entregas/' . $id);
        exit;
    });

    $router->delete('/servicos/{id}', function ($id) {
        $servicoController = new ServicoController();
        $servicoController->excluirServico($_POST["id"]);

        header('Location: /ProjetoTorneart/entregas/' . $id);
        exit;
    });
};
