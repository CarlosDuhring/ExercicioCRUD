<?php
require_once "config.php";
require_once "funcoes_produtos.php";

$id = $_GET['id'];


$stmt = $pdo->prepare(
    "SELECT * FROM tb_produtos WHERE id = ?"
);

$stmt->execute([$id]);

$produtos = $stmt->fetch(PDO::FETCH_ASSOC);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome     = trim($_POST['nome'] ?? '');
    $descricao   = trim($_POST['descricao'] ?? '');
    $preco    = trim($_POST['preco'] ?? '');
    $estoque = trim($_POST['estoque'] ?? '');
    $fPreco = formatarPreco($preco);


    if ($nome && $descricao && $estoque && $preco) {

        $stmt = $pdo->prepare(
            "UPDATE tb_produtos 
             SET nome = ?,descricao = ?, preco = ?, estoque = ?
             WHERE id = ?"
        );

        $stmt->execute([
            $nome,
            $descricao,
            $fPreco,
            $estoque,
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
    <title>Editar Produtos</title>
</head>
<body>

<div style="margin:20px;">

    <h1 >Cadastro Produtos</h1>
    <form action="" method="POST">
        <label for="Contatos"></label>
            <label for="nome">Nome:</label>
            <input name="nome" id="nome" type="text"  value="<?= $produtos['nome'] ?>" placeholder="Digite seu nome:" required>
            <label for="descricao">Descrição:</label>
            <input name="descricao" id="descricao" type="text"  value="<?= $produtos['descricao'] ?>" placeholder="Digite a descrição:" required>
            <label for="preco">Preço:</label>
            <input name="preco" id="preco" type="number"  value="<?= $produtos['preco'] ?>" placeholder="Digite o preço:" min=0 required>
            <label for="estoque">Estoque:</label>
            <input name="estoque" id="estoque" type="number"  value="<?= $produtos['estoque'] ?>" placeholder="Digite estoque:" min=0 maxlength="1000" required>
            <button type="submit">Enviar</button>
    </form>

</div>

</body>
</html>

