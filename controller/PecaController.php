<?php
require_once '../model/Peca.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $peca = new Peca();
    $peca->setNome($_POST["nome"]);
    $peca->setPreco($_POST["preco"]);
    
}