<?php
    require_once "./config/config.php";    // erro fatal se não encontrar
    include      "./views/cabecalho.php"; // warning se não encontrar


    $pagina = $_GET['pagina'] ?? null;

    if (isset($_GET)) {
        switch ($pagina) {
            case 'cadastro_cliente':
                header("Location: ./views/clientes/cadastro_cliente.php");
                exit();
            case 'cadastro_produto':
                header("Location: ./views/produtos/cadastro_produto.php");
                exit();
            case 'cadastro_contato':
                header("Location: ./views/contatos/cadastro_contato.php");
                exit();
            case 'lista_clientes':
                header("Location: ./views/clientes/lista_clientes.php");
                exit();
            case 'lista_produtos':
                header("Location: ./views/produtos/lista_produtos.php");
                exit();
            case 'lista_contatos':
                header("Location: ./views/contatos/lista_contatos.php");
                exit();
            default:
                break;
        }
    }


?>

<div class="card">
    <h2>Bem-vindo ao sistema de gerenciamento de clientes e produtos e contatos</h2>
    <p>Use os links acima para navegar entre as seções de clientes e produtos e contatos.</p>
</div>
</body>
</html>
