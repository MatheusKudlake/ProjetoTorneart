<?php

spl_autoload_register(function($class){
    $pastas = ['controller', 'dao', 'model'];

    foreach($pastas as $pasta){
        $caminho = __DIR__ . "/$pasta" . "/$class.php";
        if(file_exists($caminho)){
            require_once $caminho;
            return;
        }
    }
});

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

$router->post('/cliente/{id}/pecas', function ($id) {
    $pecaController = new PecaController();
    $peca = new Peca();
    $peca->setNome($_POST["nome"]);
    $peca->setPreco($_POST["preco"]);
    $peca->setIdCliente($id);
    $pecaController->cadastro($peca);
    header('Location: /ProjetoTorneart/cliente/'. $id .'/pecas');
    exit;
});

$router->put('/cliente/{id}/pecas', function($id){
    $pecaController = new PecaController();
    $peca = new Peca();
    $peca->setId($_POST["id"]);
    $peca->setNome($_POST["nome"]);
    $peca->setPreco($_POST["preco"]);
    $pecaController->editarPeca($peca);
    header('Location: /ProjetoTorneart/cliente/'. $id .'/pecas');
    exit;
});

$router->delete('/cliente/{id}/pecas', function($id){
    $pecaController = new PecaController();
    $pecaController->excluirPeca($_POST["idpeca"]);
    header('Location: /ProjetoTorneart/cliente/'. $id .'/pecas');
    exit;
});

$router->get('/cadastrar-entrega', function(){
    $entregaController = new EntregaController();
    $entregaController->formCadastro();
});

$router->post('/cadastrar-entrega', function(){
    $entregaController = new EntregaController();

    $entrega = new Entrega();
    $entrega->setIdCliente($_POST["idcliente"]);
    $entrega->setDataEntrega($_POST["dataentrega"]);

    if(!empty($_POST["datapagamento"])){
        $entrega->setPago(1);
        $entrega->setDataPagamento($_POST["datapagamento"]);
    }else{
        $entrega->setPago(0);
        $entrega->setDataPagamento(null);
    }

    $servicos = json_decode($_POST["servicosJson"], true);

    $entregaController->cadastroComServicos($entrega, $servicos);

    header('Location: cadastrar-entrega?cliente=' . $_POST["idcliente"]);
    exit;
});

$router->get('/entregas', function(){
    $entregaController = new EntregaController();
    $entregaController->listarEntregas();
});

$router->get('/entregas/{id}', function($id){
    $servicoController = new ServicoController();
    $servicoController->listarServicos($id);
});

$router->put('/entregas/{id}', function($id){
    $entregaController = new EntregaController();
    $entrega = new Entrega();

    if(isset($_POST["pago"])){
        $entrega->setPago(true);
        $entrega->setDataPagamento($_POST["datapagamento"]);
    }else{
        $entrega->setPago(null);
        $entrega->setDataPagamento(null);
    }
    $entrega->setDataEntrega($_POST["dataentrega"]);
    $entrega->setId($id);

    $entregaController->editarEntrega($entrega);

    header('Location: /ProjetoTorneart/entregas');
    exit;
});

$router->post('/servicos/{id}', function($id){
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

$router->put('/servicos/{id}', function($id){
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

$router->delete('/servicos/{id}', function($id){
    $servicoController = new ServicoController();
    $servicoController->excluirServico($_POST["id"]);

    header('Location: /ProjetoTorneart/entregas/' . $id);
    exit;
});

$router->dispatch($path, $method);
