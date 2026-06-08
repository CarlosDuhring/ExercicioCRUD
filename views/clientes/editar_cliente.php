<?php
require_once "config.php";
require_once "funcoes_clientes.php";
include 'cabecalho.php';

$id = $_GET['id'];


$stmt = $pdo->prepare(
    "SELECT * FROM tb_clientes WHERE id = ?"
);

$stmt->execute([$id]);

$clientes = $stmt->fetch(PDO::FETCH_ASSOC);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome     = trim($_POST['nome'] ?? '');
    $cpf     = trim($_POST['cpf'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');
    $endereco = trim($_POST['endereco'] ?? '');
    $fCpf = formatarCpf($cpf);


    if ($nome && $email) {

        $stmt = $pdo->prepare(
            "UPDATE tb_clientes
             SET nome = ?,cpf = ?,  email =?, telefone = ?, endereco = ?
             WHERE id = ?"
        );

        $stmt->execute([
            $nome,
            $fCpf,
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
    <title>Editar contato</title>
</head>
<body>

    <div class="card">

        <h1 >Cadastro Cliente</h1>
        <form action="" method="POST">
                <label for="nome">Nome:</label>
                <input name="nome" id="nome" type="text" value="<?=  $clientes['nome']?>" placeholder="Digite seu nome:" required>
                <label for="cpf">CPF:</label>
                <input name="cpf" id="cpf" type="text" value="<?=  $clientes['cpf']?>" placeholder="Digite seu CPF:" required>
                <label for="email">Email:</label>
                <input name="email" id="email" type="email" value="<?=  $clientes['email']?>" placeholder="Digite seu email:" required>
                <label for="telefone">Telefone</label>
                <input name="telefone" id="telefone" type="tel" value="<?=  $clientes['telefone']?>" placeholder="Digite seu telefone:" required>
                <label for="endereco">Endereço</label>
                <input name="endereco" id="endereco" type="text" value="<?=  $clientes['endereco']?>" placeholder="Digite seu endereço:" required>
                <button type="submit">Enviar</button>
        </form>

    </div>

</body>
</html>