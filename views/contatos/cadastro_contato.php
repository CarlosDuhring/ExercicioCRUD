<?php
	require_once "../../models/contatos.php";
	require_once "../../models/contatoDAO.php";
	require_once "../../views/cabecalho.php";


	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$nome = $_POST['nome'];
		$email = $_POST['email'];
		$telefone = $_POST['telefone'];

		$c = new Contato($nome, $email, $telefone);

		$contatoDAO = new contatosDAO();
		$contatoDAO->create($c);
		header("Location: lista_contatos.php?success=true");
		exit();
	}
if (isset($_GET['success']) && $_GET['success'] == 'true') {
		echo "<p>Contato cadastrado com sucesso!</p>";
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
	<div class="card" >
		<h1 >Cadastro Contatos</h1>
		<form action="" method="POST">
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