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

        if (!empty($_POST["datapagamento"])) {
            $entrega->setPago(1);
            $entrega->setDataPagamento($_POST["datapagamento"]);
        } else {
            $entrega->setPago(0);
            $entrega->setDataPagamento(null);
        }

        $servicos = json_decode($_POST["servicosJson"], true);

        $lucroTotal = 0;
        foreach($servicos as $servico){
            $lucroTotal += ($servico["preco"] * $servico["quant"]) - $servico["custo"];
        }

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
        $entrega->setDataEntrega($_POST["dataentrega"]);
        $entrega->setId($id);

        $servicos = $entregaController->getServicos($id);

        $lucroTotal = 0;
        foreach($servicos as $servico){
            $lucroTotal += ($servico->getPreco() * $servico->getQuantidade()) - $servico->getCusto();
        }

        $entrega->setLucroTotal($lucroTotal);   

        $entregaController->editarEntrega($entrega);

        header('Location: /ProjetoTorneart/entregas');
        exit;
    });

    $router->delete('/entregas/{id}', function ($id) {
        $entregaController = new EntregaController();
        $entregaController->excluirEntrega($id);

        header('Location: /ProjetoTorneart/entregas');
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

        header('Location: /ProjetoTorneart/entregas');
        exit;
    });
};
