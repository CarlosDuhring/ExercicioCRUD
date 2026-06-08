<?php
include_once '../../models/contatoDAO.php';
include_once '../../models/contatos.php';

$dao = new contatosDAO();

/* =========================
   SALVAR (POST)
========================= */
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];

    $contato = new Contato($nome, $email, $telefone);
    $contato->setId($id);

    $dao->update($contato);

    header("Location: lista_contatos.php");
    exit;
}

/* =========================
   CARREGAR DADOS (GET)
========================= */
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // aqui você deveria buscar no banco (ideal)
    // $contato = $dao->findById($id);

} else {
    echo "ID não informado!";
    exit;
}
?>

<form method="POST">

    <input type="hidden" name="id" value="<?= $id ?>">

    <label>Nome:</label>
    <input name="nome" type="text" required>

    <label>Email:</label>
    <input name="email" type="email" required>

    <label>Telefone:</label>
    <input name="telefone" type="text" required>

    <button type="submit">Salvar</button>
</form>