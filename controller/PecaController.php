<?php
class PecaController
{
    public function cadastro($peca)
    {
        require 'dao/PecaDAO.php';
        $pecaDAO = new PecaDAO();
        $pecaDAO->inserir($peca);
        return true;
    }

    public function listarPecasCliente($idCliente){
        require 'dao/PecaDAO.php';
        $clienteDAO = new ClienteDAO();
        $pecaDAO = new PecaDAO();
        $cliente = $clienteDAO->getPorId($idCliente);
        $listaPecas = $pecaDAO->listarPorCliente($cliente->getId());
        require 'view/listapecas.php';
        return true;
    }
}
