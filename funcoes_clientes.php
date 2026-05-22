<?php
// funcoes.php — funções reutilizáveis
include_once 'config.php';
/**
 * Retorna o array de clientes.
 * Em um projeto real, isso viria do banco de dados.
 */
function obterCLientes(PDO $pdo): array {
	$stmt = $pdo->query('SELECT * FROM tb_clientes ORDER BY nome');
	return $stmt->fetchAll();
}

/**
 * Renderiza a tabela HTML com a lista de c$clientess.
 */
function exibirTabelaClientes (array $clientes ): void {
    if (empty($clientes)) {
        echo "<p>Nenhum clientes encontrado.</p>";
        return;
    }

function formatarCpf($cpf) {
    $CPF_LENGTH = 11;
    $fCpf = preg_replace("/\D/", '', $cpf);
    if (strlen($fCpf) === $CPF_LENGTH) {
        return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $fCpf);
    } else {
        return false;
    }
    }


    echo "<table>\n";
    echo "  <thead>\n";
    echo "    <tr><th>#</th><th>Nome</th><th>CPF</th><th>E-mail</th><th>Telefone</th><th>Endereço</th><th>Ações</th></tr>\n";
    echo "  </thead>\n";
    echo "  <tbody>\n";

    foreach ($clientes as $indice => $clientes) {
        $num   = $indice + 1;
        $nome  = htmlspecialchars($clientes['nome']);
        $cpf  = htmlspecialchars($clientes['cpf']);
        $email = htmlspecialchars($clientes['email']);
        $fone  = htmlspecialchars($clientes['telefone']);
        $endereco  = htmlspecialchars($clientes['endereco']);

        echo "    <tr>\n";
        echo "      <td>{$num}</td>\n";
        echo "      <td>{$nome}</td>\n";
        echo "      <td>{$cpf}</td>\n";
        echo "      <td>{$email}</td>\n";
        echo "      <td>{$fone}</td>\n";
        echo "      <td>{$endereco}</td>\n";
        echo "<td><a href='excluir_.php?id={$clientes['id']}'><button onclick='return confirm(\"Deseja excluir este cliente?\")' type='button'>Excluir</button></a>

            <a href='editar_cliente.php?id={$clientes['id']}'><button type='button'>Editar</button></a></td>";
        echo "    </tr>\n";
    }

    echo "  </tbody>\n";
    echo "</table>\n";
}



?>