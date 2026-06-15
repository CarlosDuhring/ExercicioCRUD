<?php

require_once("../../config/config.php");
include_once "produto.php";

class produtoDAO {
    private $conn;
    public function __construct() {
        $this->conn = Conexao::getConexao();
    }

    // CREATE
    public function create(Produto $produto) {
        $sql = "INSERT INTO tb_produtos
                (nome, descricao, preco, estoque, imagem)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $produto->getNome(),
            $produto->getDescricao(),
            $produto->getPreco(),
            $produto->getEstoque(),
            $produto->getImagem()
        ]);
        $produto->setId($this->conn->lastInsertId());
        return $produto;
    }

    // READ ALL
    public function readAll() {
        $sql = "SELECT * FROM tb_produtos ORDER BY nome";
        $stmt = $this->conn->query($sql);
        $produtos = [];
        while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $produto = new Produto(
                $dados['nome'],
                $dados['descricao'],
                $dados['preco'],
                $dados['estoque'],
                $dados['imagem'],
                $dados['id']
            );
            $produto->setId($dados['id']);

            $produtos[] = $produto;
        }
        return $produtos;
    }

    // DELETE
    public function delete($id) {
        $sql = "DELETE FROM tb_produtos WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
    }

    // UPDATE
    public function update(Produto $produto) {
        $sql = "UPDATE tb_produtos
                SET nome = ?, descricao = ?, preco = ?, estoque = ?, imagem = ?
                WHERE id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $produto->getNome(),
            $produto->getDescricao(),
            $produto->getPreco(),
            $produto->getEstoque(),
            $produto->getImagem(),
            $produto->getId()
        ]);
        return $produto;
    }

    // READ
    public function read($id) {

        $sql = "SELECT * FROM tb_produtos WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        $dados = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$dados) return null;
        $produto = new Produto(
            $dados['nome'],
            $dados['descricao'],
            $dados['preco'],
            $dados['estoque'],
            $dados['imagem']
        );
        $produto->setId($dados['id']);
        return $produto;
    }
}