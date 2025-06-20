<?php
require_once '../model/Peca.php';
require_once '../dao/PecaDAO.php';

$pecaDAO = new pecaDAO();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $peca = new Peca();
    $peca->setNome($_POST["nome"]);
    $peca->setPreco($_POST["preco"]);
    $peca->setIdCliente($_POST["idcliente"]);
    
    $pecaDAO->inserir($peca);

    header('Location: ../view/cadastropeca.php');
}