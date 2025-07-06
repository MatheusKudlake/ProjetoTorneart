<?php
require_once 'ConnectionFactory.php';
require_once 'model/Cliente.php';

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

    public function get()
    {
        try {
            $sql = "SELECT * FROM clientes";
            $conn = ConnectionFactory::getConnection();
            $result = $conn->query($sql);
            if ($result) {
                $lista = [];
                foreach ($result as $row) {
                    $lista[] = $this->converterParaObj($row);
                }
                return $lista;
            } else {
                return false;
            }
        } catch (PDOException $erro) {
            echo "Erro ao listar clientes: $erro";
        }
    }

    public function getPorId($id)
    {
        try {
            $sql = "SELECT * FROM clientes WHERE id=:id";
            $conn = ConnectionFactory::getConnection();
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $result = $stmt->execute();
            $cliente = null;
            if ($result) {
                $cliente = $this->converterParaObj($stmt->fetch(PDO::FETCH_ASSOC));
                return $cliente;
            } else {
                return false;
            }
        } catch (PDOException $erro) {
            echo "Erro ao buscar cliente: $erro";
        }
    }

    public function update($novoCliente)
    {
        try {
            $sql = "UPDATE clientes SET nome=:nome WHERE id=:id;";
            $conn = ConnectionFactory::getConnection();
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':nome', $novoCliente->getNome());
            $stmt->bindValue(':id', $novoCliente->getId());
            $result = $stmt->execute();
            if ($result) {
                return true;
            }
            return false;
        } catch (PDOException $erro) {
            echo "Erro ao editar cliente: $erro";
        }
    }

    public function delete($id)
    {
        try {
            $sql = "DELETE FROM clientes WHERE id=:id";
            $conn = ConnectionFactory::getConnection();
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $id);
            $result = $stmt->execute();
            if ($result) {
                return true;
            }
            return false;
        } catch (PDOException $erro) {
            echo "Erro ao excluir cliente: $erro";
        }
    }

    private function converterParaObj($row)
    {
        $cliente = new Cliente();
        $cliente->setId($row["id"]);
        $cliente->setNome($row["nome"]);
        return $cliente;
    }
}
