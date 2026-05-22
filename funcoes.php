<?php
// funcoes.php — funções reutilizáveis

/**
 * Retorna o array de contatos.
 * Em um projeto real, isso viria do banco de dados.
 */
function obterContatos(PDO $pdo): array {
	$stmt = $pdo->query('SELECT * FROM tb_contatos ORDER BY nome');
	return $stmt->fetchAll();
}

/**
 * Renderiza a tabela HTML com a lista de contatos.
 */
function exibirTabelaContatos(array $contatos): void {
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
        $nome  = htmlspecialchars($contato['nome']);
        $email = htmlspecialchars($contato['email']);
        $fone  = htmlspecialchars($contato['telefone']);

        echo "    <tr>\n";
        echo "      <td>{$num}</td>\n";
        echo "      <td>{$nome}</td>\n";
        echo "      <td>{$email}</td>\n";
        echo "      <td>{$fone}</td>\n";
        echo "<td><a href='excluir_contato.php?id={$contato['id']}'><button onclick='return confirm(\"Deseja excluir este contato?\")' type='button'>Excluir</button></a><a href='editar_contato.php?id={$contato['id']}'><button type='button'>Editar</button></a></td>";
        echo "    </tr>\n";
    }

    echo "  </tbody>\n";
    echo "</table>\n";
}
