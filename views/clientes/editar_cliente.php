<?php
    include_once '../../models/clienteDAO.php';
    include_once '../../models/clientes.php';
    include_once '../../views/cabecalho.php';

    


    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $id = $_POST["id"];
        $nome = $_POST["nome"];
        $cpf = $_POST["cpf"];
        $email = $_POST["email"];
        $telefone = $_POST["telefone"];
        $endereco = $_POST["endereco"];


        $cliente = new cliente($nome,$cpf, $email, $telefone,$endereco);
        $cliente->setId($id);

        $dao->update($cliente);

        header("Location: lista_clientes.php");
        exit;
    }

    /* =========================
    CARREGAR DADOS (GET)
    ========================= */
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $cliente = $dao->read($id);

        $nome = $cliente->getNome();
        $cpf = $cliente->getCpf();
        $email = $cliente->getEmail();
        $telefone = $cliente->getTelefone();
        $endereco = $cliente->getEndereco();



    } else {
        echo "ID não informado!";
        exit;
    }
?>

<form method="POST">

    <input type="hidden" name="id" value="<?= $id  ?>">

    <label>Nome:</label>
    <input name="nome" type="text" value="<?= $nome ?? '' ?>" required>

    <label>CPF:</label>
    <input name="cpf" type="text" value="<?= $cpf ?? '' ?>" required>

    <label>Email:</label>
    <input name="email" type="email" value="<?= $email ?? '' ?>" required>

    <label>Telefone:</label>
    <input name="telefone" type="text" value="<?= $telefone ?? '' ?>" required>

    <label>Endereço:</label>
    <input name="endereco" type="text" value="<?= $endereco ?? '' ?>" required>

    <button type="submit">Salvar</button>
</form>