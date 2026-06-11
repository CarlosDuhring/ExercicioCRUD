<?php
    include_once '../../models/clienteDAO.php';


	if (isset($_GET['id'])) {
        $id = $_GET['id'];
    
        $dao = new clienteDAO();
        $dao->delete($id);
    
        header("Location: lista_clientes.php");
        exit;
    } else {
        echo "ID não informado!";
    }
?>