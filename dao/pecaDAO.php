<?php
require_once 'ConnectionFactory.php';

class PecaDAO
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

    public function listarPorCliente($idCliente)
    {
        try {
            $sql = "SELECT * FROM peca WHERE idcliente = :idcliente;";
            $conn = ConnectionFactory::getConnection();
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':idcliente', $idCliente);
            $success = $stmt->execute();
            if ($success) {
                $lista = [];
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $row) {
                    $lista[] = $this->converterParaObj($row);
                }
                return $lista;
            } else {
                return null;
            }
        } catch (PDOException $erro) {
            echo "Erro ao buscar peças do cliente: $erro";
        }
    }

    public function getPorId($idPeca)
    {
        try {
            $sql = "SELECT * FROM peca WHERE id=:id;";
            $conn = ConnectionFactory::getConnection();
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $idPeca);
            $result = $stmt->execute();
            if ($result) {
                $peca = $this->converterParaObj($stmt->fetch(PDO::FETCH_ASSOC));
                return $peca;
            }
            return false;
        } catch (PDOException $erro) {
            echo "Erro ao buscar peça: $erro";
        }
    }

    public function update($pecaNova)
    {
        try {
            $sql = "UPDATE peca SET nome=:nome, preco=:preco WHERE id=:id;";
            $conn = ConnectionFactory::getConnection();
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':nome', $pecaNova->getNome());
            $stmt->bindValue(':preco', $pecaNova->getPreco());
            $stmt->bindValue(':id', $pecaNova->getId());
            $result = $stmt->execute();
            if ($result) {
                return true;
            }
            return false;
        } catch (PDOException $erro) {
            echo "Erro ao editar peça: $erro";
        }
    }

    public function delete($id)
    {
        try {
            $sql = "DELETE FROM peca WHERE id=:id;";
            $conn = ConnectionFactory::getConnection();
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $id);
            $result = $stmt->execute();
            if ($result) {
                return true;
            }
            return false;
        } catch (PDOException $erro) {
            echo "Erro ao excluir peça: $erro";
        }
    }

    private function converterParaObj($row)
    {
        $peca = new Peca();
        $peca->setId($row["id"]);
        $peca->setNome($row["nome"]);
        $peca->setPreco($row["preco"]);
        $peca->setIdCliente($row["idcliente"]);
        return $peca;
    }
}
