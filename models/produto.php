<?php
  class Produto {
      private $nome;
      private $descricao;
      private $preco;
      private $estoque;
      private $imagem;
      private $id;
    
      public function __construct($nome,$descricao,  $preco, $estoque,$imagem, $id = null) {
        $this->setNome($nome);
        $this->setDescricao($descricao);
        $this->setPreco($preco);
        $this->setEstoque($estoque);
        $this->setImagem($imagem);
        $this->setId($id);
      }
    
      public function getNome()  { return $this->nome; }
      public function getDescricao() { return $this->descricao; }
      public function getPreco() { return $this->preco; }
      public function getEstoque() { return $this->estoque; }
      public function getImagem() { return $this->imagem; }
      public function getId() { return $this->id; }

      
      public function setNome($nome)  { $this->nome = trim($nome); }

      public function setDescricao($descricao)  { 
        if (empty($descricao)) {
          throw new Exception("Descrição não pode ser vazio");
        }
        $this->descricao = trim($descricao); }

      public function setId($id) {$this->id = $id; }
    
      public function setEstoque($estoque) {
        if (empty($estoque)) {
          throw new exception("Estoque não pode ser vazio ou 0");
        }
        if ($estoque < 0) {
            throw new Exception("Estoque não pode ser negativo");
        }
        $this->estoque = $estoque;
      }

      public function setPreco($preco) {
        if (empty($preco)) {
          throw new Exception("Preço não pode ser vazio ou 0");
        }
        if ($preco < 0) {
            throw new Exception("Preço não pode ser negativo");
        }
        $this->preco = $preco;
      }
    
      public function setImagem($imagem)  { $this->imagem = $imagem; }
    
      public function __toString() {
        return "{$this->nome} - {$this->descricao} — {$this->preco} — {$this->estoque} — {$this->imagem}   ";
      }
    }


?>

