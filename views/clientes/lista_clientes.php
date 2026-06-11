<?php
include_once "../../models/clienteDAO.php";
include_once "../../views/cabecalho.php";
include_once "../../models/clientes.php";


$clienteDAO = new clienteDAO();
$clientes = $clienteDAO->readAll();

if (empty($clientes)) {
        echo "<p>Nenhum cliente encontrado.</p>";
        return;
      }

      echo "<table>\n";
      echo "  <thead>\n";
      echo "    <tr><th>#</th><th>Nome</th><th>CPF</th><th>E-mail</th><th>Telefone</th><th>Endereço</th><th>Ações</th></tr>\n";
      echo "  </thead>\n";
      echo "  <tbody>\n";

      foreach ($clientes as $indice => $cliente) {
          $num   = $indice + 1;
          $nome  = htmlspecialchars($cliente->getNome());
          $cpf = htmlspecialchars($cliente->getCpf());
          $email = htmlspecialchars($cliente->getEmail());
          $fone  = htmlspecialchars($cliente->getTelefone());
          $endereco  = htmlspecialchars($cliente->getEndereco());

          echo "    <tr>\n";
          echo "      <td>{$num}</td>\n";
          echo "      <td>{$nome}</td>\n";
          echo "      <td>{$cpf}</td>\n";
          echo "      <td>{$email}</td>\n";
          echo "      <td>{$fone}</td>\n";
          echo "      <td>{$endereco}</td>\n";
          echo "<td><a href='excluir_cliente.php?id={$cliente->getId()}'><button onclick='return confirm(\"Deseja excluir este cliente?\")' type='button'>Excluir</button></a><a href='editar_cliente.php?id={$cliente->getId()}'><button type='button'>Editar</button></a></td>";
          echo "    </tr>\n";
      }

      echo "  </tbody>\n";
      echo "</table>\n";