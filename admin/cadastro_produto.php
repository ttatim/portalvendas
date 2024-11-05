<?php
session_start();
include 'includes/config.php';

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

// Processar o envio do formulário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $palavras_chaves = $_POST['palavras_chaves'];
    $link_pagamento = $_POST['link_pagamento'];

    // Aqui você deve adicionar o código para o upload de fotos
    $foto = ""; // Variável para armazenar o caminho da foto

    // Lógica para upload de arquivo (não incluída neste exemplo)
    // Adicione o código para manipular o upload da imagem conforme necessário

    $stmt = $pdo->prepare("INSERT INTO produtos (nome, descricao, palavras_chaves, link_pagamento, foto) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$nome, $descricao, $palavras_chaves, $link_pagamento, $foto]);

    echo "<div class='alert alert-success'>Produto cadastrado com sucesso!</div>";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Produto</title>
    <link rel="stylesheet" href="css/adminlte.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Cadastrar Produto</h1>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <input type="text" name="nome" class="form-control" required placeholder="Nome do Produto">
            </div>
            <div class="form-group">
                <textarea name="descricao" class="form-control" required placeholder="Descrição"></textarea>
            </div>
            <div class="form-group">
                <input type="text" name="palavras_chaves" class="form-control" placeholder="Palavras Chaves">
            </div>
            <div class="form-group">
                <input type="text" name="link_pagamento" class="form-control" required placeholder="Link de Pagamento">
            </div>
            <div class="form-group">
                <input type="file" name="foto" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>
</body>
</html>
