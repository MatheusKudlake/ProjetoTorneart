<?php
class Peca
{
	private $id;
	private $nome;
	private $preco;
	private $idCliente;

	public function __construct($nome=null, $preco=null, $idCliente=null)
	{
		$this->nome = $nome;
		$this->preco = $preco;
		$this->idCliente = $idCliente;
	}

	public function getId()
	{
		return $this->id;
	}

	public function setId($value)
	{
		$this->id = $value;
	}

	public function getNome()
	{
		return $this->nome;
	}

	public function setNome($value)
	{
		$this->nome = $value;
	}

	public function getPreco()
	{
		return $this->preco;
	}

	public function setPreco($value)
	{
		$this->preco = $value;
	}

	public function getIdCliente()
	{
		return $this->idCliente;
	}

	public function setIdCliente($value)
	{
		$this->idCliente = $value;
	}
}
