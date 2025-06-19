<?php
class Servico
{
	private $id;
	private $peca;
	private $cliente;
	private $quantidade;
	private $prazo;
	private $dataEntrega;
	private $pago;
	private $dataPagamento;

	public function __construct($peca, $cliente, $quantidade, $prazo)
	{
		$this->peca = $peca;
		$this->cliente = $cliente;
		$this->quantidade = $quantidade;
		$this->prazo = $prazo;
	}

	public function getId()
	{
		return $this->id;
	}

	public function setId($value)
	{
		$this->id = $value;
	}

	public function getPeca()
	{
		return $this->peca;
	}

	public function setPeca($value)
	{
		$this->peca = $value;
	}

	public function getQuantidade()
	{
		return $this->quantidade;
	}

	public function setQuantidade($value)
	{
		$this->quantidade = $value;
	}

	public function getPrazo()
	{
		return $this->prazo;
	}

	public function setPrazo($value)
	{
		$this->prazo = $value;
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

	public function getCliente()
	{
		return $this->cliente;
	}

	public function setCliente($value)
	{
		$this->cliente = $value;
	}
}
