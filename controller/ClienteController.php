<?php
require_once "../model/Cliente.php";
require_once "../dao/ClienteDAO.php";

class ClienteController
{
    public static function cadastrar()
    {
            $clienteDAO = new ClienteDAO();
            $cliente = new Cliente();
            $cliente->setNome($_POST["nome"]);
            $clienteDAO->inserir($cliente);
            header('Location: ../view/cadastrocliente.php');
    }

    public static function listar(){
        $clienteDAO = new ClienteDAO();
        return $clienteDAO->get();
    }
}