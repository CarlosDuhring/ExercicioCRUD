<?php
	require_once "../../models/clientes.php";
	require_once "../../models/clienteDAO.php";
	require_once "../../views/cabecalho.php";


	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$nome = $_POST['nome'];
		$cpf = $_POST['cpf'];
		$email = $_POST['email'];
		$telefone = $_POST['telefone'];
		$endereco = $_POST['endereco'];

		$cliente = new Cliente($nome,$cpf, $email, $telefone,$endereco);

		$clienteDAO = new clienteDAO();
		$clienteDAO->create($cliente);
		
		header("Location: clientes.php?success=true");
		exit();
	}
	if (isset($_GET['success']) && $_GET['success'] == 'true') {
		echo "<p>Cliente cadastrado com sucesso!</p>";
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de clientes</title>
</head>
<body>
	<div class="card" >
		<h1 >Cadastro Clientes</h1>
		<form action="" method="POST">
				<label for="nome:">Nome:</label>
				<input name="nome" id="nome" type="text" placeholder="Digite seu nome:" required>
				<label for="cpf:">CPF:</label>
				<input name="cpf" id="cpf" type="text" placeholder="Digite seu CPF:" required>
				<label for="email">Email:</label>
				<input name="email" id="email" type="email" placeholder="Digite seu email:" required>
				<label for="telefone">Telefone:</label>
				<input name="telefone" id="telefone" type="telefone" placeholder="Digite seu telefone:" required>
				<label for="endereco">Endereço:</label>
				<input name="endereco" id="endereco" type="endereco" placeholder="Digite seu endereço:" required>
				<button type="submit">Enviar</button>
		</form>
	</div>
</body>
</html>