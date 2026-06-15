
<?php
	require_once "../../models/produto.php";
	require_once "../../models/produtosDAO.php";
	require_once "../../views/cabecalho.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$nome     = trim($_POST['nome'] 	?? '');
    $descricao     = trim($_POST['descricao'] 	?? '');
	$preco    = trim($_POST['preco']	?? '');
	$estoque = trim($_POST['estoque'] ?? '');
	$imagem = trim($_FILES['imagem']['name'] ?? '');    
	$nomeArquivo = null;

	if (!empty($_FILES['imagem']['name'])) {
		$extensao  = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
		$permitidos = ['jpg', 'jpeg', 'png', 'webp'];
	
		if (!in_array(strtolower($extensao), $permitidos)) {
			$erro = 'Tipo de imagem não permitido.';
			
		} else {
			$nomeArquivo = uniqid('prod_') . '.' . $extensao;
			move_uploaded_file($_FILES['imagem']['tmp_name'], 'uploads/' . $nomeArquivo);
		}
	}
 
	if ($nome && $descricao && $estoque && $preco) {
    	$produto = new Produto ($nome,$descricao, $preco, $estoque,$nomeArquivo);
    	$produtoDAO = new produtoDAO();
		$produtoDAO->create($produto);

		header("Location: produto.php?success=true");
		exit();
	}
}
if (isset($_GET['success']) && $_GET['success'] == 'true') {
		echo "<p>Produtos cadastrado com sucesso!</p>";
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cliente</title>
</head>
<body>
	<div class="card">
		<h1 >Cadastro Produtos</h1>
		<form action="" method="POST" enctype="multipart/form-data">
                <label for="nome">Nome:</label>
				<input name="nome" id="nome" type="text" placeholder="Digite seu nome:" required>
                <label for="descricao">Descrição:</label>
                <input name="descricao" id="descricao" type="text" placeholder="Digite a descrição:" required>
                <label for="preco">Preço:</label>
				<input name="preco" id="preco" type="number" placeholder="Digite o preço:" min=0 required>
                <label for="estoque">Estoque:</label>
				<input name="estoque" id="estoque" type="number" placeholder="Digite estoque:" min=0 max="1000" required>
				<label for="imagem">Imagem:</label>
				<input name="imagem" id="imagem" type="file" placeholder="Coloque a imagem:" required>
				<?php if (!empty($erro)) echo "<p>$erro</p>"; ?>
				<button type="submit">Enviar</button>
		</form>
	</div>
</body>
</html>