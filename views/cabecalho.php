<!-- cabecalho.php -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>CRUD PHP</title>
    <link rel="stylesheet" href="/static/style.css">
   
</head>
<body>
    <header>
        <nav class="navbar">
            <h1>CRUD PHP</h1>
            <ul>
                <li><a href="/index.php">Inicio</a></li>
                <li><a href="/index.php?id={$produto->getId()}">Cadastrar Cliente </a></li>
                <li><a href="/index.php?id={$produto->getId()}">Cadastrar Produto</a></li>
                <li><a href="/index.php?id={$produto->getId()}">Cadastrar contato</a></li>
                <li><a href="/index.php?id={$produto->getId()}">Clientes</a></li>
                <li><a href="/index.php?id={$produto->getId()}">Contatos</a></li>
                <li><a href="/index.php?id={$produto->getId()}">Produtos</a></li>
            </ul>  
        </nav>
    </header>

