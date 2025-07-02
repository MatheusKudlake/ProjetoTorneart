<?php
class PecaController
{
    public function formCadastro()
    {
        $clienteDAO = new ClienteDAO();
        $clientes = $clienteDAO->get();
        require 'view/cadastropeca.php';
    }

    public function cadastro($peca)
    {
        require 'dao/PecaDAO.php';
        $pecaDAO = new pecaDAO();
        $pecaDAO->inserir($peca);
        return true;
    }
}
