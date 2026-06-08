<?php
    include_once '../../models/contatoDAO.php';


	if (isset($_GET['id'])) {
        $id = $_GET['id'];
    
        $dao = new contatosDAO();
        $dao->delete($id);
    
        header("Location: lista_contatos.php");
        exit;
    } else {
        echo "ID não informado!";
    }
?>