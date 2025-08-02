<?php
class ServicoController
{
    public function cadastro($servico)
    {
        require_once 'dao/ServicoDAO.php';
        $servicoDAO = new ServicoDAO();
        $servicoDAO->inserir($servico);
        return true;
    }

    public function listarServicos($idEntrega)
    {
        require_once 'dao/ServicoDAO.php';
        require_once 'dao/PecaDAO.php';
        require_once 'dao/EntregaDAO.php';
        $servicoDAO = new ServicoDAO();
        $pecaDAO = new PecaDAO();
        $entregaDAO = new EntregaDAO();

        $listaServicos = $servicoDAO->getPorEntrega($idEntrega);

        $servicoEditar = '';
        $listaPecas = '';
        $entrega = '';
        $entrega = $entregaDAO->getPorId($idEntrega);

        if (isset($_GET["editarServico"])) {
            $servicoEditar = $servicoDAO->getPorId($_GET["editarServico"]);
            $listaPecas = $pecaDAO->listarPorCliente($entrega->getIdCliente());
        }

        require 'view/listaservicos.php';
        return true;
    }

    public function editarServico($novoServico)
    {
        require_once 'dao/ServicoDAO.php';
        $servicoDAO = new ServicoDAO();
        if ($servicoDAO->update($novoServico)) return true;
        return false;
    }

    public function excluirServico($id)
    {
        require_once 'dao/ServicoDAO.php';
        $servicoDAO = new ServicoDAO();
        $result = $servicoDAO->delete($id);
        if ($result) return true;
        return false;
    }
}
