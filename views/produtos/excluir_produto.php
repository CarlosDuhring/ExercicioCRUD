<?php
require_once 'config.php';

$id = $_GET['id'];

$stmt = $pdo->prepare(
    "SELECT imagem FROM tb_produtos WHERE id = ?"
);

$stmt->execute([$id]);

$produto = $stmt->fetch(PDO::FETCH_ASSOC);

if (
    !empty($produto['imagem']) &&
    file_exists('uploads/' . $produto['imagem'])
) {

    unlink('uploads/' . $produto['imagem']);
}

$stmt = $pdo->prepare(
    "DELETE FROM tb_produtos WHERE id = ?"
);

$stmt->execute([$id]);

header('Location: index.php');
exit;
?>