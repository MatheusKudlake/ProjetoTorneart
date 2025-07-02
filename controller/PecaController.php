<?php
class PecaController
{
    public function formCadastro()
    {
        include 'dao/ClienteDAO.php';
        $clienteDAO = new ClienteDAO();
        $clientes = $clienteDAO->get();
        require 'view/cadastropeca.php';
    }

    public function cadastro($post)
    {
        require 'model/Peca.php';
        require 'dao/PecaDAO.php';
        $pecaDAO = new pecaDAO();
        $peca = new Peca();
        $peca->setNome($post["nome"]);
        $peca->setPreco($post["preco"]);
        $peca->setIdCliente($post["idcliente"]);
        $pecaDAO->inserir($peca);
        header('Location: cadastrar-peca');
    }
}
