<?php
require_once "../model/Cliente.php";
require_once "../dao/ClienteDAO.php";

$cliente = new Cliente();
$clienteDAO = new ClienteDAO();

//if($_POST['cadastrar']){
//    $cliente->setNome($_POST["nome"]);
//    $clienteDAO->inserir($cliente);
//}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $cliente->setNome($_POST["nome"]);
    $clienteDAO->inserir($cliente);
    header('Location: ../view/cadastrocliente.php');
}