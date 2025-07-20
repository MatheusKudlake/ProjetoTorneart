<?php
class EntregaController
{
    public function cadastro($entrega){
        require_once 'dao/EntregaDAO.php';
        $entregaDAO = new EntregaDAO();
        $entregaDAO->inserir($entrega);
        return true;
    }

    public function formCadastro()
    {
        require_once 'dao/ClienteDAO.php';
        require_once 'dao/PecaDAO.php';
        $clienteDAO = new ClienteDAO();
        $pecaDAO = new PecaDAO();

        $listaClientes = $clienteDAO->get();
        $listaPecas = "";
        if (isset($_GET["cliente"])) {
            $listaPecas = $pecaDAO->listarPorCliente($_GET["cliente"]);
        }
        require 'view/cadastroentrega.php';
        return true;
    }

    public function cadastroComServicos($entrega, $servicos){
        require_once 'dao/EntregaDAO.php';
        $entregaDAO = new EntregaDAO();
        $entregaDAO->inserirComServicos($entrega, $servicos);
        return true;
    }
}
