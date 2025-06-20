<?php
require_once 'ConnectionFactory.php';

class pecaDAO
{
    public function inserir(Peca $peca)
    {
        try {
            $sql = "INSERT INTO peca (nome, preco, idcliente) VALUES (:nome, :preco, :idcliente);";
            $conn = ConnectionFactory::getConnection();
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(":nome", $peca->getNome());
            $stmt->bindValue(":preco", $peca->getPreco());
            $stmt->bindValue(":idcliente", $peca->getIdCliente());
            $stmt->execute();
        } catch (PDOException $erro) {
            echo "Erro ao inserir peça: $erro";
        }
    }
}
