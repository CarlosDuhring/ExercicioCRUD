<?php
    require_once("contatos.DAO.php");

    $p = new Contato("Carlos", "ana@example.com", 256564568);
    
    $inserePessoa = new contatosDAO();
    $inserePessoa->create($p);

    
