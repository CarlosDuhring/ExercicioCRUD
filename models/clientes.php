<?php
  class Cliente {
      private $nome;
      private $cpf;

      private $email;
      private $telefone;
      private $endereco;
      private $id;
    
      public function __construct($nome,$cpf,  $email, $telefone,$endereco, $id = null) {
        $this->setNome($nome);
        $this->setCpf($cpf);
        $this->setEmail($email);
        $this->setTelefone($telefone);
        $this->setEndereco($endereco);
        $this->setId($id);
      }
    
      public function getNome()  { return $this->nome; }
      public function getCpf() { return $this->cpf; }

      public function getEmail() { return $this->email; }
      public function getTelefone() { return $this->telefone; }
      public function getEndereco() { return $this->endereco; }

      public function getId() { return $this->id; }
    
      public function setNome($n)  { $this->nome = trim($n); }

      public function setCpf($c)  { 
        if (!preg_match("/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/", $c)) {
          throw new Exception("CPF inválido. O formato deve ser xxx.xxx.xxx-xx");
        }
        if (empty($c)) {
          throw new Exception("Cpf não pode ser vazio");
        }
        $this->cpf = trim($c); }
      public function setId($id) {$this->id = $id; }
    
      public function setEmail($e) {
        if (!filter_var($e, FILTER_VALIDATE_EMAIL))
          throw new Exception("Email inválido");
        $this->email = $e;
      }

      public function setEndereco($endereco) {
        if (empty($endereco)) {
          throw new Exception("Endereço não pode ser vazio");
        }
        $this->endereco = $endereco;
      }
    
      public function setTelefone($i)  { $this->telefone = $i; }
    
      public function __toString() {
        return "{$this->nome} - {$this->email} — {$this->telefone} ";
      }
    }


?>

