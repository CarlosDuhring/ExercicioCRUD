<?php
include 'cabecalho.php';
include_once 'funcoes_produto.php';
require_once 'config.php';

$produtos = obterProdutos($pdo);
exibirTabelaProdutos($produtos);


?>
</body>
</html>
