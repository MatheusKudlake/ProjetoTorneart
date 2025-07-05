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

    public function listarClientes()
    {
        $clienteDAO = new ClienteDAO();
        $listaClientes = $clienteDAO->get();
        $clienteEditar = null;
        if (isset($_GET["editar"])) {
            $clienteEditar = $clienteDAO->getPorId($_GET["editar"]);
        }
        require 'view/listaclientes.php';
    }

    public function buscarCliente($id)
    {
        $clienteDAO = new ClienteDAO();
        $cliente = $clienteDAO->getPorId($id);
        if ($cliente) {
            return $cliente;
        }
        echo "Cliente não encontrado!";
        return;
    }

    public function editarCliente($novoCliente){
        $clienteDAO = new ClienteDAO();
        $clienteDAO->update($novoCliente);
        return true;
    }
}
