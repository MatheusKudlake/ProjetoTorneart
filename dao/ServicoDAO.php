<?php
class ServicoDAO
{
    public function inserir(Servico $servico)
    {
        try {
            $sql = "INSERT INTO servicos (idpeca, identrega, quantidade, custo) VALUES (:idpeca, :identrega, :quantidade, :custo);";
            $conn = ConnectionFactory::getConnection();
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':idpeca', $servico->getIdPeca());
            $stmt->bindValue(':identrega', $servico->getIdEntrega());
            $stmt->bindValue(':quantidade', $servico->getQuantidade());
            $stmt->bindValue(':custo', $servico->getCusto());
            $stmt->execute();
        } catch (PDOException $erro) {
            echo "Erro ao inserir serviço: $erro";
        }
    }

    public function getPorEntrega($idEntrega)
    {
        try {
            $sql = "SELECT * FROM servicos WHERE identrega=:identrega;";
            $conn = ConnectionFactory::getConnection();
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':identrega', $idEntrega);
            $result = $stmt->execute();
            if ($result) {
                $servicos = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $servicosObj = [];
                foreach ($servicos as $servico) {
                    $servicosObj[] = $this->converterParaObj($servico);
                }
                return $servicosObj;
            } else {
                return false;
            }
        } catch (PDOException $erro) {
            echo "Erro ao buscar serviços: $erro";
        }
    }

    public function getPorId($id)
    {
        try {
            $sql = "SELECT * FROM servicos WHERE id=:id;";
            $conn = ConnectionFactory::getConnection();
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(":id", $id);
            $result = $stmt->execute();
            $servico = null;
            if ($result) {
                $servico = $this->converterParaObj($stmt->fetch(PDO::FETCH_ASSOC));
                return $servico;
            }
            return false;
        } catch (PDOException $erro) {
            echo "Erro ao buscar serviço: $erro";
        }
    }

    public function update($novoServico)
    {
        try {
            $sql = "UPDATE servicos SET idpeca=:idpeca, quantidade=:quantidade, custo=:custo, preco=:preco WHERE id=:id;";
            $conn = ConnectionFactory::getConnection();
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':idpeca', $novoServico->getIdPeca());
            $stmt->bindValue(':quantidade', $novoServico->getQuantidade());
            $stmt->bindValue(':custo', $novoServico->getCusto());
            $stmt->bindValue(':preco', $novoServico->getPreco());
            $stmt->bindValue(':id', $novoServico->getId());
            $result = $stmt->execute();
            if ($result) return true;
            return false;
        } catch (PDOException $erro) {
            echo "Erro ao atualizar serviço: $erro";
        }
    }

    public function delete($id)
    {
        try {
            $sql = "DELETE FROM servicos WHERE id=:id;";
            $conn = ConnectionFactory::getConnection();
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $id);
            $result = $stmt->execute();
            if ($result) return true;
            return false;
        } catch (PDOException $erro) {
            echo "Erro ao excluir serviço: $erro";
        }
        }

    private function converterParaObj($row)
    {
        $servico = new Servico();
        $servico->setId($row["id"]);
        $servico->setIdPeca($row["idpeca"]);
        $servico->setPreco($row["preco"]);
        $servico->setQuantidade($row["quantidade"]);
        $servico->setCusto($row["custo"]);
        $servico->setIdEntrega($row["identrega"]);
        return $servico;
    }
}
