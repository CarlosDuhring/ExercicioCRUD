<?php
// funcoes.php — funções reutilizáveis
include_once 'config.php';
/**
 * Retorna o array de Produtos.
 * Em um projeto real, isso viria do banco de dados.
 */
function obterProdutos(PDO $pdo): array {
	$stmt = $pdo->query('SELECT * FROM tb_produtos ORDER BY nome');
	return $stmt->fetchAll();
}

/**
 * Renderiza a tabela HTML com a lista de Produtoss.
 */
function exibirTabelaProdutos (array $produtos ): void {
    if (empty($produtos)) {
        echo "<p>Nenhum produto encontrado.</p>";
        return;
    }

function formatarPreco($preco) {
    if ($preco > 0) {
        return 'R$ ' . number_format($preco, 2, ',', '.');
    }
    return 'R$ 0,00';
}

    echo "<table>\n";
    echo "  <thead>\n";
    echo "    <tr><th>#</th><th>Nome</th><th>Descrição</th><th>Preço</th><th>Estoque</th><th>Ações</th></tr>\n";
    echo "  </thead>\n";
    echo "  <tbody>\n";

    foreach ($produtos as $indice => $produtos) {
        $num   = $indice + 1;
        $nome  = htmlspecialchars($produtos['nome']);
        $descricao  = htmlspecialchars($produtos['descricao']);
        $preco = htmlspecialchars($produtos['preco']);
        $estoque  = htmlspecialchars($produtos['estoque']);

        echo "    <tr>\n";
        echo "      <td>{$num}</td>\n";
        echo "      <td>{$nome}</td>\n";
        echo "      <td>{$descricao}</td>\n";
        echo "      <td>{$preco}</td>\n";
        echo "      <td>{$estoque}</td>\n";
        echo "<td><a href='excluir_produto.php?id={$produtos['id']}'><button onclick='return confirm(\"Deseja excluir este cliente?\")' type='button'>Excluir</button></a>

            <a href='editar_produtos.php?id={$produtos['id']}'><button type='button'>Editar</button></a></td>";
        echo "    </tr>\n";
    }

    echo "  </tbody>\n";
    echo "</table>\n";
}



?>