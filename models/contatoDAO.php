<?php
// funcoes.php — funções reutilizáveis
require_once(__DIR__ . "../../config/config.php");
include_once "contatos.php";
/**
 * Retorna o array de contatos.
 * Em um projeto real, isso viria do banco de dados.
 */
class contatosDAO {
    private $conn;
    public function __construct() {
      $this->conn = Conexao::getConexao();
    }
    // CREATE — Insere uma Pessoa no banco
    public function create(contato $c) {
      $sql = "INSERT INTO tb_contatos (nome, email, telefone) VALUES (?, ?, ?)";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute([$c->getNome(),  $c->getEmail(), $c->getTelefone()]);
      $c->setId($this->conn->lastInsertId());
  
      return $c;
    }

    public function readAll() {
      $sql = "SELECT * FROM tb_contatos ORDER BY nome";
      $stmt = $this->conn->query($sql);
      $contatos = [];
  
      while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $c = new Contato(
          $dados['nome'],
          $dados['email'],
          $dados['telefone'],
          $dados['id']
        );
        $c->setId($dados['id']);
        $contatos[] = $c; // adiciona ao array
      }
      return $contatos;
    }
    public function delete($id) {
      $sql = "DELETE FROM tb_contatos WHERE id = ?";
      
      $stmt = $this->conn->prepare($sql);
      $stmt->execute([$id]);
    }


    public function update(Contato $c) {
      $sql = "UPDATE  tb_contatos (nome,  email, telefone) WHERE id =?";
      
      $stmt = $this->conn->prepare($sql);

      $stmt->execute([$c->getNome(), $c->getEmail(), $c->getTelefone()]);
      $c->setId($this->conn->lastInsertId());

      return $c;
    }
}






