<?php
class EntregaDAO
{
    public function inserir(Entrega $entrega)
    {
        try {
            $sql = "INSERT INTO entregas (idcliente, descricao, dataentrega, pago, datapagamento, precototal, lucrototal) VALUES (:idcliente, :descricao, :dataentrega, :pago, :datapagamento, :precototal, :lucrototal);";
            $conn = ConnectionFactory::getConnection();
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':idcliente', $entrega->getIdCliente());
            $stmt->bindValue(':descricao', $entrega->getDescricao());
            $stmt->bindValue(':dataentrega', $entrega->getDataEntrega());
            $stmt->bindValue(':pago', $entrega->getPago());
            $stmt->bindValue(':datapagamento', $entrega->getDataPagamento());
            $stmt->bindValue(':precototal', $entrega->getPrecoTotal());
            $stmt->bindValue(':lucrototal', $entrega->getLucroTotal());
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

            $sqlEntrega = "INSERT INTO entregas (idcliente, descricao, dataentrega, pago, datapagamento, precototal, lucrototal) VALUES (:idcliente, :descricao, :dataentrega, :pago, :datapagamento, :precototal, :lucrototal);";
            $stmt = $conn->prepare($sqlEntrega);
            $stmt->bindValue(':idcliente', $entrega->getIdCliente());
            $stmt->bindValue(':descricao', $entrega->getDescricao());
            $stmt->bindValue(':dataentrega', $entrega->getDataEntrega());
            $stmt->bindValue(':pago', $entrega->getPago());
            $stmt->bindValue(':datapagamento', $entrega->getDataPagamento());
            $stmt->bindValue(':precototal', $entrega->getPrecoTotal());
            $stmt->bindValue(':lucrototal', $entrega->getLucroTotal());
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
            $sql = "SELECT * FROM entregas ORDER BY dataentrega DESC;";
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

    public function getPorMes($mes, $ano, $idCliente = 0)
    {
        $sql = "SELECT * FROM entregas WHERE dataentrega >= :dataInicio AND dataentrega < :dataFinal";
        if ($idCliente != 0) $sql .= " AND idcliente=:idcliente";
        $sql .= ';';

        $dataInicio = (new DateTime("$ano-$mes-01"))->format('Y-m-d');

        if ($mes == 12) {
            $mesFinal = 1;
            $anoFinal = $ano + 1;
        } else {
            $mesFinal = $mes + 1;
            $anoFinal = $ano;
        }

        $dataFinal = (new DateTime("$anoFinal-$mesFinal-01"))->format('Y-m-d');

        $conn = ConnectionFactory::getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':dataInicio', $dataInicio);
        $stmt->bindValue(':dataFinal', $dataFinal);
        if ($idCliente != 0) $stmt->bindValue(':idcliente', $idCliente);

        $success = $stmt->execute();

        if ($success) {
            $lista = [];
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $lista[] = $this->converterParaObj($row);
            }
            return $lista;
        } else {
            return false;
        }
    }

    public function getPorIntervaloDatas($dataInicio, $dataFinal, $idCliente = 0)
    {
        $sql = "SELECT * FROM entregas WHERE dataentrega >= :dataInicio AND dataentrega < :dataFinal";
        if ($idCliente != 0) $sql .= " AND idcliente=:idcliente";
        $sql .= ';';

        $dataFinal = new DateTime($dataFinal);

        $dataFinal->modify('tomorrow');

        $conn = ConnectionFactory::getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':dataInicio', $dataInicio);
        $stmt->bindValue(':dataFinal', $dataFinal->format('Y-m-d'));
        if ($idCliente != 0) $stmt->bindValue(':idcliente', $idCliente);


        $success = $stmt->execute();

        if ($success) {
            $lista = [];
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $lista[] = $this->converterParaObj($row);
            }
            return $lista;
        } else {
            return false;
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

    public function getbyMonth($month)
    {
        try {
        } catch (PDOException $erro) {
            echo "Erro ao buscar entrega por mês: $erro";
        }
    }

    public function update(Entrega $novaEntrega)
    {
        try {
            $sql = "UPDATE entregas SET pago=:pago, datapagamento=:datapagamento, dataentrega=:dataentrega, descricao=:descricao, precototal=:precototal, lucrototal=:lucrototal WHERE id=:id;";
            $conn = ConnectionFactory::getConnection();
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':pago', $novaEntrega->getPago());
            $stmt->bindValue(':datapagamento', $novaEntrega->getDataPagamento());
            $stmt->bindValue(':descricao', $novaEntrega->getDescricao());
            $stmt->bindValue(':dataentrega', $novaEntrega->getDataEntrega());
            $stmt->bindValue(':precototal', $novaEntrega->getPrecoTotal());
            $stmt->bindValue(':lucrototal', $novaEntrega->getLucroTotal());
            $stmt->bindValue(':id', $novaEntrega->getId());
            $result = $stmt->execute();
            if ($result) return true;
            return false;
        } catch (PDOException $erro) {
            echo "Erro ao editar entrega: $erro";
        }
    }

    public function alterarPago($id, $pago)
    {
        try {
            $sql = "UPDATE entregas SET pago=:pago, datapagamento=:datapagamento WHERE id=:id;";
            $conn = ConnectionFactory::getConnection();
            $entrega = $this->getPorId($id);
            $stmt = $conn->prepare($sql);
            if ($pago) {
                $pagoValor = 1;
                $dataPagamento = $entrega->getDataPagamento() ?: date('Y-m-d');
            } else {
                $pagoValor = 0;
                $dataPagamento = $entrega->getDataPagamento();
            }
            $stmt->bindValue(':pago', $pagoValor);
            $stmt->bindValue(':datapagamento', $dataPagamento);
            $stmt->bindValue(':id', $id);
            $result = $stmt->execute();
            if ($result) return true;
            return false;
        } catch (PDOException $erro) {
            "Erro ao alterar o status do pagamento: $erro";
        }
    }

    public function delete($id)
    {
        try {
            $sql = "DELETE FROM entregas WHERE id=:id;";
            $conn = ConnectionFactory::getConnection();
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':id', $id);
            $result = $stmt->execute();
            if ($result) return true;
            return false;
        } catch (PDOException $erro) {
            echo "Erro ao excluir entrega: $erro";
        }
    }

    private function converterParaObj($row)
    {
        $entrega = new Entrega();
        $entrega->setId($row["id"]);
        $entrega->setIdCliente($row["idcliente"]);
        $entrega->setDescricao($row["descricao"]);
        $entrega->setDataEntrega($row["dataentrega"]);
        $entrega->setPago($row["pago"]);
        $entrega->setDataPagamento($row["datapagamento"]);
        $entrega->setPrecoTotal($row["precototal"]);
        $entrega->setLucroTotal($row["lucrototal"]);

        return $entrega;
    }
}
