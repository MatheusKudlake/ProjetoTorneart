<?php
class Entrega{
    private $id;
    private $idCliente;
    private $dataEntrega;
    private $pago;
    private $dataPagamento;

	public function getId() {
		return $this->id;
	}

	public function setId($value) {
		$this->id = $value;
	}

	public function getIdCliente() {
		return $this->idCliente;
	}

	public function setIdCliente($value) {
		$this->idCliente = $value;
	}

	public function getDataEntrega() {
		return $this->dataEntrega;
	}

	public function setDataEntrega($value) {
		$this->dataEntrega = $value;
	}

	public function getPago() {
		return $this->pago;
	}

	public function setPago($value) {
		$this->pago = $value;
	}

	public function getDataPagamento() {
		return $this->dataPagamento;
	}

	public function setDataPagamento($value) {
		$this->dataPagamento = $value;
	}
}