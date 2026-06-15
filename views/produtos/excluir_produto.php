<?php
    include_once '../../models/produtosDAO.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $dao = new produtoDAO();
        $produto = $dao->read($id);

        if (
            !empty($produto->getImagem()) &&
            file_exists('../../uploads/' . $produto->getImagem())
        ) {
    
            unlink('../../uploads/' . $produto->getImagem());
        }
    
        $dao->delete($id);

    
        header('Location: lista_produtos.php');
        exit;
    } else {
        echo "ID não informado!";
    }


    

    
?>