<?php
include 'cabecalho.php';
include_once 'funcoes_clientes.php';
require_once 'config.php';

$clientes = obterClientes($pdo);
exibirTabelaClientes($clientes);


?>
</body>
</html>
