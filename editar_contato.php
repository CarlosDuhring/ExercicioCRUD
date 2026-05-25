<?php
require_once "config.php";
include 'cabecalho.php';

$id = $_GET['id'];


$stmt = $pdo->prepare(
    "SELECT * FROM tb_contatos WHERE id = ?"
);

$stmt->execute([$id]);

$contato = $stmt->fetch(PDO::FETCH_ASSOC);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome     = trim($_POST['nome'] ?? '');
    $cpf     = trim($_POST['cpf'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');
    $endereco = trim($_POST['endereco'] ?? '');


    if ($nome && $email && $cpf && $telefone && $endereco) {

        $stmt = $pdo->prepare(
            "UPDATE tb_clientes 
             SET nome = ?,cpf = ?, email = ?, telefone = ?, endereco = ?
             WHERE id = ?"
        );

        $stmt->execute([
            $nome,
            $cpf,
            $email,
            $telefone,
            $endereco,
            $id
        ]);

        header('Location: index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Contatos</title>
</head>
<body>

    <div class="card">

        <h1>Editar Contatos</h1>

        <form method="POST">
            <label for="Nome:">Nome:</label>
            <input name="nome" id="nome" type="text" placeholder="Digite seu nome:" required>
            <label for="email">Email:</label>
            <input name="email" id="email" type="email" placeholder="Digite seu email:" required>
            <label for="telefone">Telefone:</label>
            <input name="telefone" id="telefone" type="telefone" placeholder="Digite seu telefone:" required>
            <button type="submit">Enviar</button>
        </form>

    </div>

</body>
</html>

