<?php
include '../cabecalho.php';

class Contato {
    private $nome;
    private $email;
    private $telefone;
    private $id;
  
    public function __construct($nome,  $email, $telefone, $id = null) {
      $this->setNome($nome);
      $this->setEmail($email);
      $this->setTelefone($telefone);
      $this->setId($id);
    }
  
    public function getNome()  { return $this->nome; }
    public function getEmail() { return $this->email; }
    public function getTelefone() { return $this->telefone; }
    public function getId() { return $this->id; }
  
    public function setNome($n)  { $this->nome = trim($n); }
    public function setId($id) { $this->id = $id; }
  
    public function setEmail($e) {
      if (!filter_var($e, FILTER_VALIDATE_EMAIL))
        throw new Exception("Email inválido");
      $this->email = $e;
    }
  
    public function setTelefone($i)  { $this->telefone = $i; }
  
    public function __toString() {
      return "{$this->nome} - {$this->email} — {$this->telefone} ";
    }
  }


?>

