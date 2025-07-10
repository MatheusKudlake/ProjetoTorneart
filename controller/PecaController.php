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
        $pecaEditar = null;
        if(isset($_GET["editar"])){
            $pecaEditar = $pecaDAO->getPorId($_GET["editar"]);
        }
        require 'view/listapecas.php';
        return true;
    }

    public function buscarPeca($idPeca){
        $pecaDAO = new PecaDAO();
        $result = $pecaDAO->getPorId($idPeca);
        if($result) return true;
    }

    public function editarPeca($pecaNova){
        require_once 'dao/PecaDAO.php';
        $pecaDAO = new PecaDAO();
        $result = $pecaDAO->update($pecaNova);
        if($result) return true;
    }

    public function excluirPeca($idPeca)
    {
        require_once 'dao/PecaDAO.php';
        $pecaDAO = new PecaDAO();
        $result = $pecaDAO->delete($idPeca);
        if ($result) return true;
    }
}
