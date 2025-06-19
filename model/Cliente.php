<?php
class Cliente
{
    private $id;
    private $nome;

    public function __construct($nome = null)
    {
        $this->nome = $nome;
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

    public function setNome($nome)
    {
        $this->nome = $nome;
    }
}
