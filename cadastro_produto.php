
<?php
require_once "config.php"; 
require_once "funcoes_produto.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$nome     = trim($_POST['nome'] 	?? '');
    $descricao     = trim($_POST['descricao'] 	?? '');
	$preco    = trim($_POST['preco']	?? '');
	$estoque = trim($_POST['estoque'] ?? '');
    $fPreco = formatarPreco($preco);

 
	if ($nome && $descricao && $estoque && $preco) {
    	$stmt = $pdo->prepare(
        	'INSERT INTO tb_produtos (nome,descricao, preco, estoque) VALUES (?, ?, ?,?)'
    	);
    	$stmt->execute([$nome,$descricao, $fPreco, $estoque]);
    	header('Location: index.php');
    	exit;
	}
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
	<div class="cadastro" style="margin: 20px;">
		<h1 >Cadastro Produtos</h1>
		<form action="" method="POST">
			<label for="Contatos"></label>
                <label for="nome">Nome:</label>
				<input name="nome" id="nome" type="text" placeholder="Digite seu nome:" required>
                <label for="descricao">Descrição:</label>
                <input name="descricao" id="descricao" type="text" placeholder="Digite a descrição:" required>
                <label for="preco">Preço:</label>
				<input name="preco" id="preco" type="number" placeholder="Digite o preço:" min=0 required>
                <label for="estoque">Estoque:</label>
				<input name="estoque" id="estoque" type="number" placeholder="Digite estoque:" min=0 maxlength="1000" required>
				<button type="submit">Enviar</button>
		</form>
	</div>
</body>
</html>