<?php
require_once '../model/Peca.php';
require_once '../dao/PecaDAO.php';

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    require '../view/cadastropeca.php';
}

if (isset($_POST["cadastrar"])) {
    $pecaDAO = new pecaDAO();
    $peca = new Peca();
    $peca->setNome($_POST["nome"]);
    $peca->setPreco($_POST["preco"]);
    $peca->setIdCliente($_POST["idcliente"]);
    $pecaDAO->inserir($peca);
    header('Location: ../view/cadastropeca.php');
}
