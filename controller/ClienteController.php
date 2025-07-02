<?php
require_once "model/Cliente.php";
require_once "dao/ClienteDAO.php";

/*if ($_SERVER["REQUEST_METHOD"] === "GET") {
    require '../view/cadastrocliente.php';
}


if (isset($_POST["cadastrar"])) {
    $clienteDAO = new ClienteDAO();
    $cliente = new Cliente();
    $cliente->setNome($_POST["nome"]);
    $clienteDAO->inserir($cliente);
    header('Location: ../view/cadastrocliente.php');
}*/

class ClienteController
{
    public function cadastro($cliente)
    {
        $clienteDAO = new ClienteDAO();
        $clienteDAO->inserir($cliente);
        return true;
    }
}
