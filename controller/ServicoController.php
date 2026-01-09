<?php
class ServicoController
{
    public function cadastro($servico)
    {
        $servicoDAO = new ServicoDAO();
        $servicoDAO->inserir($servico);
        return true;
    }

    public function listarServicos($idEntrega)
    {
        $servicoDAO = new ServicoDAO();
        $pecaDAO = new PecaDAO();
        $entregaDAO = new EntregaDAO();

        $listaServicos = $servicoDAO->getPorEntrega($idEntrega);

        $entrega = $entregaDAO->getPorId($idEntrega);
        $listaPecas = $pecaDAO->listarPorCliente($entrega->getIdCliente());
        
        $servicoEditar = '';
        if (isset($_GET["editarServico"])) {
            $servicoEditar = $servicoDAO->getPorId($_GET["editarServico"]);
        }

        $precoTotal = $lucroTotal = 0;
        foreach($listaServicos as $servico){
            $precoTotal += $servico->getPreco() * $servico->getQuantidade();
            $lucroTotal += $servico->getPreco() * $servico->getQuantidade() - $servico->getCusto();
        }

        require 'view/listaservicos.php';
        return true;
    }

    public function editarServico($novoServico)
    {
        $servicoDAO = new ServicoDAO();
        if ($servicoDAO->update($novoServico)) return true;
        return false;
    }

    public function excluirServico($id)
    {
        $servicoDAO = new ServicoDAO();
        $result = $servicoDAO->delete($id);
        if ($result) return true;
        return false;
    }
}
