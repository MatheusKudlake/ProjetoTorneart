<?php
class PecaController
{
    public function cadastro($peca)
    {
        require_once 'dao/PecaDAO.php';
        $pecaDAO = new PecaDAO();
        $pecaDAO->inserir($peca);
        return true;
    }

    public function listarPecasCliente($idCliente)
    {
        require_once 'dao/PecaDAO.php';
        $clienteDAO = new ClienteDAO();
        $pecaDAO = new PecaDAO();
        $cliente = $clienteDAO->getPorId($idCliente);
        $listaPecas = $pecaDAO->listarPorCliente($cliente->getId());
        require 'view/listapecas.php';
        return true;
    }

    public function excluirPeca($idPeca)
    {
        require_once 'dao/PecaDAO.php';
        $pecaDAO = new PecaDAO();
        $result = $pecaDAO->delete($idPeca);
        if ($result) return true;
    }
}
