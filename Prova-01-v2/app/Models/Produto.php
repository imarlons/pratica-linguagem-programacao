<?php
/*
  classe produto (entidade)
  mapeia a tabela 'produtos' do banco de dados.
*/

namespace App\Models;

class Produto
{
    private $id;
    private $nomeProduto;
    private $descricao;
    private $preco;
    private $categoria;

    // construtor como definido na UML
    public function __construct(string $nomeProduto, string $descricao, float $preco, string $categoria, ?int $id = null) // ?int $id = null, nullable
    {
        $this->nomeProduto = $nomeProduto;
        $this->descricao = $descricao;
        $this->preco = $preco;
        $this->categoria = $categoria;
        $this->id = $id;
    }

    // --- getters ---
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomeProduto(): string
    {
        return $this->nomeProduto;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function getPreco(): float
    {
        return $this->preco;
    }

    public function getCategoria(): string
    {
        return $this->categoria;
    }

    // --- setters ---
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setNomeProduto(string $nomeProduto): void
    {
        $this->nomeProduto = $nomeProduto;
    }

    public function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }

    public function setPreco(float $preco): void
    {
        $this->preco = $preco;
    }

    public function setCategoria(string $categoria): void
    {
        $this->categoria = $categoria;
    }
}
