<?php
// funcoes.php — funções reutilizáveis
require_once("../../config/config.php");
include_once "clientes.php";
/**
 * Retorna o array de clientes.
 * Em um projeto real, isso viria do banco de dados.
 */
class clienteDAO {
    private $conn;
    public function __construct() {
      $this->conn = Conexao::getConexao();
    }
    // CREATE — Insere uma Pessoa no banco
    public function create(Cliente $cliente) {
      $sql = "INSERT INTO tb_clientes (nome,cpf, email, telefone,endereco) VALUES (?, ?, ?,?,?)";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute([$cliente->getNome(),  $cliente->getCpf(),  $cliente->getEmail(), $cliente->getTelefone(),$cliente->getEndereco()]);
      $cliente->setId($this->conn->lastInsertId());
  
      return $cliente;
    }

    public function readAll() {
      $sql = "SELECT * FROM tb_clientes ORDER BY nome";
      $stmt = $this->conn->query($sql);
      $clientes = [];
  
      while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $cliente = new Cliente(
          $dados['nome'],
          $dados['cpf'],
          $dados['email'],
          $dados['telefone'],
          $dados['endereco'],
          $dados['id']
        );
        $cliente->setId($dados['id']);
        $clientes[] = $cliente; // adiciona ao array
      }
      return $clientes;
    }
    public function delete($id) {
      $sql = "DELETE FROM tb_clientes WHERE id = ?";
      
      $stmt = $this->conn->prepare($sql);
      $stmt->execute([$id]);
    }


    public function update(Cliente $cliente) {
      $sql = "UPDATE  tb_clientes SET nome = ?, cpf = ?, email = ?, telefone = ?,endereco = ? WHERE id =?";
      
      $stmt = $this->conn->prepare($sql);

      $stmt->execute([$cliente->getNome(),$cliente->getCpf(), $cliente->getEmail(),  $cliente->getTelefone(), $cliente->getEndereco(),$cliente->getId()]);
      return $cliente;
    }

    public function read($id) {
      $sql = "SELECT * FROM tb_clientes WHERE id = ?";
      
      $stmt = $this->conn->prepare($sql);
      $stmt->execute([$id]);
      $dados = $stmt->fetch(PDO::FETCH_ASSOC);
  
      if (!$dados) return null;
      $cliente = new Cliente($dados['nome'],  $dados['cpf'],  $dados['email'], $dados['telefone'], $dados['endereco']);
      $cliente->setId($dados['id']);
  
      return $cliente;
    }
}






