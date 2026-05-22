<?php
require_once "config.php";

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

<div style="margin:20px;">

    <h1>Editar Contatos</h1>

    <form method="POST">

        <input type="text" name="nome" value="<?= $contato['nome'] ?>" required>
        <input type="email"name="email"value="<?= $contato['email'] ?>"required>
        <input type="text"name="telefone"value="<?= $contato['telefone'] ?>">
        <button type="submit">Salvar</button>
    </form>

</div>

</body>
</html>

