<?php

class ClienteController
{
    public function cadastro($cliente)
    {
        $clienteDAO = new ClienteDAO();
        $result = $clienteDAO->inserir($cliente);
        if($result) return true;
    }

    public function listarClientes()
    {
        $clienteDAO = new ClienteDAO();
        $listaClientes = $clienteDAO->get();
        $clienteEditar = null;
        if (isset($_GET["editar"])) {
            $clienteEditar = $clienteDAO->getPorId($_GET["editar"]);
        }else if(isset($_GET["excluir"])){
            $clienteExcluir = $clienteDAO->getPorId($_GET["excluir"]);
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
        $result = $clienteDAO->update($novoCliente);
        if($result) return true;
    }

    public function excluirCliente($idCliente){
        $clienteDAO = new ClienteDAO();
        $result = $clienteDAO->delete($idCliente);
        if($result) return true;
    }
}
