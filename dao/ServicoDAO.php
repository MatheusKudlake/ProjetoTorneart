<?php
class ServicoDAO{
    public function inserir(Servico $servico){
        try{
            $sql = "INSERT INTO servicos (idpeca, identrega, quantidade, custo) VALUES (:idpeca, :identrega, :quantidade, :custo);";
            $conn = ConnectionFactory::getConnection();
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':idpeca', $servico->getIdPeca());
            $stmt->bindValue(':identrega', $servico->getIdEntrega());
            $stmt->bindValue(':quantidade', $servico->getQuantidade());
            $stmt->bindValue(':custo', $servico->getCusto());
            $stmt->execute();
        }catch(PDOException $erro){
            echo "Erro ao inserir serviço: $erro";
        }
    }
}