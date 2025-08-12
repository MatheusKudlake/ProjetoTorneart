<?php
class EntregaController
{
    public function cadastro($entrega){
        $entregaDAO = new EntregaDAO();
        $entregaDAO->inserir($entrega);
        return true;
    }

    public function formCadastro()
    {
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
        $entregaDAO = new EntregaDAO();
        $entregaDAO->inserirComServicos($entrega, $servicos);
        return true;
    }

    public function listarEntregas(){
        $entregaDAO = new EntregaDAO();
        $clienteDAO = new ClienteDAO();

        $listaEntregas = $entregaDAO->get();
        require 'view/listaentregas.php';
        return true;
    }

    public function editarEntrega($novaEntrega){
        $entregaDAO = new EntregaDAO();
        $result = $entregaDAO->update($novaEntrega);
        if($result) return true;
        return false;
    }

    public function alterarPago($id, $pago){
        $entregaDAO = new EntregaDAO();
        $result = $entregaDAO->alterarPago($id, $pago);
        if($result) return true;
        return false;
    }

    public function excluirEntrega($id){
        $entregaDAO = new EntregaDAO();
        $result = $entregaDAO->delete($id);
        if($result) return true;
        return false;
    }
}
