<?php
class Peca
{
	private $id;
	private $nome;
	private $preco;
	private $cliente;

	public function __construct($nome, $preco, $cliente)
	{
		$this->nome = $nome;
		$this->preco = $preco;
		$this->cliente = $cliente;
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

	public function getCliente()
	{
		return $this->cliente;
	}

	public function setCliente($value)
	{
		$this->cliente = $value;
	}
}
