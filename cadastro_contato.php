
<?php
require_once "config.php"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$nome     = trim($_POST['nome'] 	?? '');
	$email    = trim($_POST['email']	?? '');
	$telefone = trim($_POST['telefone'] ?? '');
 
	if ($nome && $email) {
    	$stmt = $pdo->prepare(
        	'INSERT INTO tb_contatos (nome, email, telefone) VALUES (?, ?, ?)'
    	);
    	$stmt->execute([$nome, $email, $telefone]);
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
    <title>Cadastro de contatos</title>
</head>
<body>
	<div class="cadastro" style="margin: 20px;">
		<h1 >Cadastro Contatos</h1>
		<form action="" method="POST">
			<label for="Contatos"></label>
				<input name="nome" id="nome" type="text" placeholder="Digite seu nome:" required>
				<input name="email" id="email" type="email" placeholder="Digite seu email:" required>
				<input name="telefone" id="telefone" type="telefone" placeholder="Digite seu telefone:" required>
				<button type="submit">Enviar</button>
		</form>
	</div>
</body>
</html>