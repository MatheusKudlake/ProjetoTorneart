<?php

return function (Router $router) {
    $router->get('/cadastrar-entrega', function () {
        $entregaController = new EntregaController();
        $entregaController->formCadastro();
    });

    $router->post('/cadastrar-entrega', function () {
        $entregaController = new EntregaController();

        $entrega = new Entrega();
        $entrega->setIdCliente($_POST["idcliente"]);
        $entrega->setDataEntrega($_POST["dataentrega"]);
        $entrega->setDescricao($_POST["descricao"]);

        if (!empty($_POST["datapagamento"])) {
            $entrega->setPago(1);
            $entrega->setDataPagamento($_POST["datapagamento"]);
        } else {
            $entrega->setPago(0);
            $entrega->setDataPagamento(null);
        }

        $servicos = json_decode($_POST["servicosJson"], true);

        $precoTotal = 0;
        foreach ($servicos as $servico) {
            $precoTotal += ($servico["preco"] * $servico["quant"]);
        }

        $lucroTotal = 0;
        foreach ($servicos as $servico) {
            $lucroTotal += ($servico["preco"] * $servico["quant"]) - $servico["custo"];
        }

        $entrega->setPrecoTotal($precoTotal);
        $entrega->setLucroTotal($lucroTotal);

        $entregaController->cadastroComServicos($entrega, $servicos);

        header('Location: entregas');
        exit;
    });

    $router->get('/entregas', function () {
        $entregaController = new EntregaController();
        $entregaController->listarEntregas();
    });

    $router->get('/entregas/{id}', function ($id) {
        $servicoController = new ServicoController();
        $servicoController->listarServicos($id);
    });

    $router->put('/entregas/{id}', function ($id) {
        $entregaController = new EntregaController();
        $entrega = new Entrega();

        if (isset($_POST["pago"])) {
            $entrega->setPago(true);
            $entrega->setDataPagamento($_POST["datapagamento"]);
        } else {
            $entrega->setPago(null);
            $entrega->setDataPagamento(null);
        }
        $entrega->setDescricao($_POST["descricao"]);
        $entrega->setDataEntrega($_POST["dataentrega"]);
        $entrega->setId($id);

        $servicos = $entregaController->getServicos($id);

        $precoTotal = 0;
        foreach ($servicos as $servico) {
            $precoTotal += ($servico->getPreco() * $servico->getQuantidade());
        }

        $lucroTotal = 0;
        foreach ($servicos as $servico) {
            $lucroTotal += ($servico->getPreco() * $servico->getQuantidade()) - $servico->getCusto();
        }

        $entrega->setPrecoTotal($precoTotal);
        $entrega->setLucroTotal($lucroTotal);

        $entregaController->editarEntrega($entrega);

        header('Location: /entregas');
        exit;
    });

    $router->delete('/entregas/{id}', function ($id) {
        $entregaController = new EntregaController();
        $entregaController->excluirEntrega($id);

        header('Location: /entregas');
        exit;
    });

    $router->put('/entregas/{id}/pago', function ($id) {
        $entregaController = new EntregaController();
        $pago = $_POST["pago"];

        if ($pago) {
            $entregaController->alterarPago($id, false);
        } else {
            $entregaController->alterarPago($id, true);
        }

        header('Location: /entregas');
        exit;
    });
};
