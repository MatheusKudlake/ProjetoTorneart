<?php
class PecaController
{
    public function cadastro($peca)
    {
        $pecaDAO = new PecaDAO();
        $pecaDAO->inserir($peca);
        return true;
    }

    public function listarPecasCliente($idCliente)
    {
        $clienteDAO = new ClienteDAO();
        $pecaDAO = new PecaDAO();
        $cliente = $clienteDAO->getPorId($idCliente);
        $listaPecas = $pecaDAO->listarPorCliente($cliente->getId());
        $pecaEditar = null;
        if(isset($_GET["editar"])){
            $pecaEditar = $pecaDAO->getPorId($_GET["editar"]);
        }else if(isset($_GET["excluir"])){
            $pecaExcluir = $pecaDAO->getPorId($_GET["excluir"]);
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
        $pecaDAO = new PecaDAO();
        $result = $pecaDAO->update($pecaNova);
        if($result) return true;
    }

    public function excluirPeca($idPeca)
    {
        $pecaDAO = new PecaDAO();
        $result = $pecaDAO->delete($idPeca);
        if ($result) return true;
    }
}
