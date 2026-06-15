<?php
include_once '../../models/contatoDAO.php';
include_once '../../models/contatos.php';
include_once '../../views/cabecalho.php';

$dao = new contatosDAO();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $contato = $dao->read($id);

    $nome = $contato->getNome();
    $email = $contato->getEmail();
    $telefone = $contato->getTelefone();
    $id = $contato->getId();


} else {
    echo "ID não informado!";
    exit;
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    

    $contato = new Contato($nome, $email, $telefone);
    $contato->setId($id);

    $dao->update($contato);

    header("Location: lista_contatos.php");
    exit;
}
?>

<form method="POST">

    <input type="hidden" name="id" value="<?= $id  ?>">

    <label>Nome:</label>
    <input name="nome" type="text" value="<?= $nome ?? '' ?>" required>

    <label>Email:</label>
    <input name="email" type="email" value="<?= $email ?? '' ?>" required>

    <label>Telefone:</label>
    <input name="telefone" type="text" value="<?= $telefone ?? '' ?>" required>

    <button type="submit">Salvar</button>
</form>