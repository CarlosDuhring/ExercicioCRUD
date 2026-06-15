<?php
include_once "../../models/produtosDAO.php";
include_once "../../views/cabecalho.php";
include_once "../../models/produto.php";


$produtoDAO = new produtoDAO();
$produtos = $produtoDAO->readAll();

if (empty($produtos)) {
        echo "<p>Nenhum produto encontrado.</p>";
        return;
      }

      echo "<table>\n";
      echo "  <thead>\n";
      echo "    <tr><th>#</th><th>Nome</th><th>Descricao</th><th>Preço</th><th>Estoque</th><th>Imagem</th><th>Ações</th></tr>\n";
      echo "  </thead>\n";
      echo "  <tbody>\n";

      foreach ($produtos as $indice => $produto) {
          $num   = $indice + 1;
          $nome  = htmlspecialchars($produto->getNome());
          $descricao = htmlspecialchars($produto->getDescricao());
          $preco = htmlspecialchars($produto->getPreco());
          $estoque  = htmlspecialchars($produto->getEstoque());
          $imagem  = htmlspecialchars($produto->getImagem());

          echo "    <tr>\n";
          echo "      <td>{$num}</td>\n";
          echo "      <td>{$nome}</td>\n";
          echo "      <td>{$descricao}</td>\n";
          echo "      <td>{$preco}</td>\n";
          echo "      <td>{$estoque}</td>\n";
        
          echo "      <td><img  width='100' src = '../../uploads/{$imagem}'></td>\n";
          echo "<td><a href='excluir_produto.php?id={$produto->getId()}'><button onclick='return confirm(\"Deseja excluir este cliente?\")' type='button'>Excluir</button></a><a href='editar_produtos.php?id={$produto->getId()}'><button type='button'>Editar</button></a></td>";
          echo "    </tr>\n";
      }

      echo "  </tbody>\n";
      echo "</table>\n";