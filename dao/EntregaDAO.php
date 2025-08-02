<?php
class EntregaDAO
{
    public function inserir(Entrega $entrega)
    {
        try {
            $sql = "INSERT INTO entregas (idcliente, dataentrega, pago, datapagamento) VALUES (:idcliente, :dataentrega, :pago, :datapagamento);";
            $conn = ConnectionFactory::getConnection();
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':idcliente', $entrega->getIdCliente());
            $stmt->bindValue(':dataentrega', $entrega->getDataEntrega());
            $stmt->bindValue(':pago', $entrega->getPago());
            $stmt->bindValue(':datapagamento', $entrega->getDataPagamento());
            $stmt->execute();
        } catch (PDOException $erro) {
            echo "Erro ao inserir entrega: $erro";
        }
    }

    public function inserirComServicos($entrega, $servicos)
    {
        try {
            $conn = ConnectionFactory::getConnection();
            $conn->beginTransaction();

            $sqlEntrega = "INSERT INTO entregas (idcliente, dataentrega, pago, datapagamento) VALUES (:idcliente, :dataentrega, :pago, :datapagamento);";
            $stmt = $conn->prepare($sqlEntrega);
            $stmt->bindValue(':idcliente', $entrega->getIdCliente());
            $stmt->bindValue(':dataentrega', $entrega->getDataEntrega());
            $stmt->bindValue(':pago', $entrega->getPago());
            $stmt->bindValue(':datapagamento', $entrega->getDataPagamento());
            $stmt->execute();

            $idEntrega = $conn->lastInsertId();

            $sqlServico = "INSERT INTO servicos (idpeca, identrega, preco, quantidade, custo) VALUES (:idpeca, :identrega, :preco, :quantidade, :custo);";
            foreach ($servicos as $servico) {
                $stmt = $conn->prepare($sqlServico);
                $stmt->bindValue(':idpeca', $servico["peca"]);
                $stmt->bindValue(':identrega', $idEntrega);
                $stmt->bindValue(':preco', $servico["preco"]);
                $stmt->bindValue(':quantidade', $servico["quant"]);
                $stmt->bindValue(':custo', $servico["custo"]);
                $stmt->execute();
            }

            $conn->commit();
        } catch (PDOException $erro) {
            $conn->rollback();
            echo "Erro ao inserir entrega com serviços: $erro";
        }
    }

    public function get()
    {
        try {
            $sql = "SELECT * FROM entregas;";
            $conn = ConnectionFactory::getConnection();
            $result = $conn->query($sql);
            $listaEntregas = [];
            if ($result) {
                foreach ($result as $row) {
                    $listaEntregas[] = $this->converterParaObj($row);
                }
            }
            return $listaEntregas;
        } catch (PDOException $erro) {
            echo "Erro ao listar entregas: $erro";
        }
    }

    public function getPorId($id)
    {
        try {
            $sql = "SELECT * FROM entregas WHERE id=:id";
            $conn = ConnectionFactory::getConnection();
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $id);
            $result = $stmt->execute();
            $entrega = '';
            if ($result) {
                $entrega = $this->converterParaObj($stmt->fetch(PDO::FETCH_ASSOC));
                return $entrega;
            }
            return false;
        } catch (PDOException $erro) {
            echo "Eror ao buscar entrega: $erro";
        }
    }

    private function converterParaObj($row)
    {
        $entrega = new Entrega();
        $entrega->setId($row["id"]);
        $entrega->setIdCliente($row["idcliente"]);
        $entrega->setDataEntrega($row["dataentrega"]);
        $entrega->setPago($row["pago"]);
        $entrega->setDataPagamento($row["datapagamento"]);

        return $entrega;
    }
}
