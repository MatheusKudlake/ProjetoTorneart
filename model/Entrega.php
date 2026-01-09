<?php
class Entrega
{
	private $id;
	private $idCliente;
	private $descricao;
	private $dataEntrega;
	private $pago;
	private $dataPagamento;
	private $precoTotal;
	private $lucroTotal;

	public function getId()
	{
		return $this->id;
	}

	public function setId($value)
	{
		$this->id = $value;
	}

	public function getIdCliente()
	{
		return $this->idCliente;
	}

	public function setIdCliente($value)
	{
		$this->idCliente = $value;
	}

	public function getDescricao()
	{
		return $this->descricao;
	}

	public function setDescricao($value)
	{
		$this->descricao = $value;
	}

	public function getDataEntrega()
	{
		return $this->dataEntrega;
	}

	public function setDataEntrega($value)
	{
		$this->dataEntrega = $value;
	}

	public function getPago()
	{
		return $this->pago;
	}

	public function setPago($value)
	{
		$this->pago = $value;
	}

	public function getDataPagamento()
	{
		return $this->dataPagamento;
	}

	public function setDataPagamento($value)
	{
		$this->dataPagamento = $value;
	}

	public function getPrecoTotal()
	{
		return $this->precoTotal;
	}

	public function setPrecoTotal($value)
	{
		$this->precoTotal = $value;
	}

	public function getLucroTotal()
	{
		return $this->lucroTotal;
	}

	public function setLucroTotal($value)
	{
		$this->lucroTotal = $value;
	}
}
