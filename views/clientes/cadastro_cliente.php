
<?php
require_once "config.php"; 
include 'cabecalho.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$nome     = trim($_POST['nome'] 	?? '');
    $cpf     = trim($_POST['cpf'] 	?? '');
	$email    = trim($_POST['email']	?? '');
	$telefone = trim($_POST['telefone'] ?? '');
    $endereco = trim($_POST['endereco'] ?? '');
	$fCpf = formatarCpf($cpf);

 
	if ($nome && $email && $cpf && $telefone && $endereco) {
    	$stmt = $pdo->prepare(
        	'INSERT INTO tb_clientes (nome,cpf, email, telefone,endereco) VALUES (?, ?, ?,?,?)'
    	);
    	$stmt->execute([$nome,$fCpf, $email, $telefone,$endereco]);
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
	<div class="card">
		<h1 >Cadastro Cliente</h1>
		<form action="" method="POST">
			<label for="Contatos"></label>
                <label for="nome">Nome:</label>
				<input name="nome" id="nome" type="text" placeholder="Digite seu nome:" required>
                <label for="CPF">CPF:</label>
                <input name="cpf" id="cpf" type="text" placeholder="Digite seu CPF:" minlength="11" maxlength="11"  required>
                <label for="email">Email:</label>
				<input name="email" id="email" type="email" placeholder="Digite seu email:" required>
                <label for="telefone">Telefone:</label>
				<input name="telefone" id="telefone" type="tel" placeholder="Digite seu telefone:" required>
                <label for="endereco">Endereço:</label>
                <input name="endereco" id="endereco" type="text" placeholder="Digite seu endereço:" required>
				<button type="submit">Enviar</button>
		</form>
	</div>
</body>
</html>