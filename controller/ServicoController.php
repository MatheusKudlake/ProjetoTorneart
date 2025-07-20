<?php
class ServicoController{
    public function cadastro($servico){
        require_once 'dao/ServicoDAO.php';
        $servicoDAO = new ServicoDAO();
        $servicoDAO->inserir($servico);
        return true;
    }
}