<?php
require_once "config.php";
require_once "funcoes_produto.php";
include 'cabecalho.php';

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
    $preco = trim($_POST['preco'] ?? '');
	$imagem = trim($_FILES['imagem']['name'] ?? ''); 
    $imagem = $produtos['imagem'];
    $nomeArquivo = $nomeArquivo ?? null;
    
    if (!empty($_FILES['imagem']['name'])) {
		$extensao  = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
		$permitidos = ['jpg', 'jpeg', 'png', 'webp'];

        if (
            !empty($produtos['imagem']) &&
            file_exists('uploads/' . $produtos['imagem'])
        ) {
            unlink('uploads/' . $produtos['imagem']);
        }
	
		if (!in_array(strtolower($extensao), $permitidos)) {
			$erro = 'Tipo de imagem não permitido.';
		} else {
			$nomeArquivo = uniqid('prod_') . '.' . $extensao;
			move_uploaded_file($_FILES['imagem']['tmp_name'], 'uploads/' . $nomeArquivo);
            $imagem = $nomeArquivo;
		}
	}

    if ($nome && $descricao && $estoque && $preco) {

        $stmt = $pdo->prepare(
            "UPDATE tb_produtos 
             SET nome = ?,descricao = ?, preco = ?, estoque = ?, imagem = ?
             WHERE id = ?"
        );

        $stmt->execute([
            $nome,
            $descricao,
            $preco,
            $estoque,
            $imagem,
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

    <div class="card">
        <h1 >Cadastro Produtos</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="Contatos"></label>
                <label for="nome">Nome:</label>
                <input name="nome" id="nome" type="text"  value="<?= $produtos['nome'] ?>" placeholder="Digite seu nome:" required>
                <label for="descricao">Descrição:</label>
                <input name="descricao" id="descricao" type="text"  value="<?= $produtos['descricao'] ?>" placeholder="Digite a descrição:" required>
                <label for="preco">Preço:</label>
                <input name="preco" id="preco" type="number"  value="<?= $produtos['preco'] ?>" placeholder="Digite o preço:" min=0 required>
                <label for="estoque">Estoque:</label>
                <input name="estoque" id="estoque" type="number"  value="<?= $produtos['estoque'] ?>" placeholder="Digite estoque:" min=0 maxlength="1000" required>
                <h2>Imagem Existente: </h2>
                <img 
                    src="uploads/<?= $produtos['imagem'] ?>" 
                    width="120"
                >
                <label for="imagem">Imagem:</label>
                <input name="imagem" id="imagem" type="file" accept="image/*">
                <button type="submit">Enviar</button>
        </form>
    </div>
</body>
</html>

