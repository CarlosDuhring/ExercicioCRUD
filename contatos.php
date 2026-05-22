<?php
include 'cabecalho.php';
include_once 'funcoes.php';
require_once 'config.php';

$contatos = obterContatos($pdo);
exibirTabelaContatos($contatos);


?>

