<?php
require_once 'ConnectionFactory.php';
require_once '../model/Cliente.php';

class ClienteDAO
{
    public function inserir(Cliente $cliente)
    {
        try {
            $sql = "INSERT INTO clientes (nome) VALUES (:nome);";
            $conn = ConnectionFactory::getConnection();
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(":nome", $cliente->getNome());
            $stmt->execute();
        } catch (PDOException $erro) {
            echo "Erro ao inserir cliente: $erro";
        }
    }

    public function listar()
    {
        try {
            $sql = "SELECT * FROM clientes";
            $conn = ConnectionFactory::getConnection();
            $result = $conn->query($sql);
            $lista = [];
            foreach($result as $row){
                $lista[] = $this->converterParaObj($row);
            }
            //while($row = $result->fetch(PDO::FETCH_ASSOC)){
            //    $lista[] = $this->converterParaObj($row);
            //}
            return $lista;
        } catch (PDOException $erro) {
            echo "Erro ao listar clientes: $erro";
        }
    }

    private function converterParaObj($row){
        $cliente = new Cliente();
        $cliente->setId($row["id"]);
        $cliente->setNome($row["nome"]);
        return $cliente;
    }
}
