<?php
include_once "../../models/contatoDAO.php";



$contatoDAO = new contatosDAO();
$contatos = $contatoDAO->readAll();

if (empty($contatos)) {
        echo "<p>Nenhum contato encontrado.</p>";
        return;
      }

      echo "<table>\n";
      echo "  <thead>\n";
      echo "    <tr><th>#</th><th>Nome</th><th>E-mail</th><th>Telefone</th><th>Ações</th></tr>\n";
      echo "  </thead>\n";
      echo "  <tbody>\n";

      foreach ($contatos as $indice => $contato) {
          $num   = $indice + 1;
          $nome  = htmlspecialchars($contato->getNome());
          $email = htmlspecialchars($contato->getEmail());
          $fone  = htmlspecialchars($contato->getTelefone());

          echo "    <tr>\n";
          echo "      <td>{$num}</td>\n";
          echo "      <td>{$nome}</td>\n";
          echo "      <td>{$email}</td>\n";
          echo "      <td>{$fone}</td>\n";
          echo "<td><a href='excluir_contato.php?id={$contato->getId()}'><button onclick='return confirm(\"Deseja excluir este contato?\")' type='button'>Excluir</button></a><a href='editar_contato.php?id={$contato->getId()}'><button type='button'>Editar</button></a></td>";
          echo "    </tr>\n";
      }

      echo "  </tbody>\n";
      echo "</table>\n";