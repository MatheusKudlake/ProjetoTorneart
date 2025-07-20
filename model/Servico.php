<?php
class Servico
{
	private $id;
	private $idPeca;
	private $preco;
	private $quantidade;
	private $custo;
	private $idEntrega;

	public function getId()
	{
		return $this->id;
	}

	public function setId($value)
	{
		$this->id = $value;
	}

	public function getIdPeca()
	{
		return $this->idPeca;
	}

	public function setIdPeca($value)
	{
		$this->idPeca = $value;
	}

	public function getPreco()
	{
		return $this->preco;
	}

	public function setPreco($value)
	{
		$this->preco = $value;
	}

	public function getQuantidade()
	{
		return $this->quantidade;
	}

	public function setQuantidade($value)
	{
		$this->quantidade = $value;
	}

	public function getCusto()
	{
		return $this->custo;
	}

	public function setCusto($value)
	{
		$this->custo = $value;
	}

	public function getIdEntrega()
	{
		return $this->idEntrega;
	}

	public function setIdEntrega($value)
	{
		$this->idEntrega = $value;
	}
}
