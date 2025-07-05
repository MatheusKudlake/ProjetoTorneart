<?php
require_once "model/Cliente.php";
require_once "dao/ClienteDAO.php";

class ClienteController
{
    public function cadastro($cliente)
    {
        $clienteDAO = new ClienteDAO();
        $clienteDAO->inserir($cliente);
        return true;
    }

    public function listarClientes(){
        $clienteDAO = new ClienteDAO();
        $listaClientes = $clienteDAO->get();
        require 'view/listaclientes.php';
    }
}
