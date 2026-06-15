<?php
    include_once '../../models/produtosDAO.php';
    include_once '../../models/produto.php';
    include_once '../../views/cabecalho.php';;

    $dao = new produtoDAO();
    $id = $_GET['id'];
    $produto = $dao->read($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome     = trim($_POST['nome'] ?? '');
    $descricao   = trim($_POST['descricao'] ?? '');
    $preco    = trim($_POST['preco'] ?? '');
    $estoque = trim($_POST['estoque'] ?? '');
	$imagem = trim($_FILES['imagem']['name'] ?? ''); 
    $nomeArquivo = $produto->getImagem();
    
    if (!empty($_FILES['imagem']['name'])) {
		$extensao  = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
		$permitidos = ['jpg', 'jpeg', 'png', 'webp'];

        if (
            !empty($produto->getImagem()) &&
            file_exists('uploads/' . $produto->getImagem())
        ) {
            unlink('uploads/' . $produto->getImagem());
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

        $produto = new Produto ($nome,$descricao, $preco, $estoque,$nomeArquivo,$id);
    	$produtoDAO = new produtoDAO();
		$produtoDAO->update($produto);

		header("Location: produto.php?success=true");
		exit();
    }
}
if (isset($_GET['success']) && $_GET['success'] == 'true') {
    echo "<p>Produtos cadastrado com sucesso!</p>";
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
                <input name="nome" id="nome" type="text"  value="<?= $produto->getNome() ?>" placeholder="Digite seu nome:" required>
                <label for="descricao">Descrição:</label>
                <input name="descricao" id="descricao" type="text"  value="<?= $produto->getDescricao() ?>" placeholder="Digite a descrição:" required>
                <label for="preco">Preço:</label>
                <input name="preco" id="preco" type="number"  value="<?= $produto->getPreco() ?>" placeholder="Digite o preço:" min=0 required>
                <label for="estoque">Estoque:</label>
                <input name="estoque" id="estoque" type="number"  value="<?= $produto->getEstoque() ?>" placeholder="Digite estoque:" min=0 max="1000" required>
                <h2>Imagem Existente: </h2>
                <img 
                    src="uploads/<?= $produto->getImagem() ?>" 
                    width="120"
                >
                <label for="imagem">Imagem:</label>
                <input name="imagem" id="imagem" type="file" accept="image/*">
                <button type="submit">Enviar</button>
        </form>
    </div>
</body>
</html>

