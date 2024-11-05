<?php
session_start();
include 'includes/config.php';

if (!isset($_SESSION['usuario']) || (time() - $_SESSION['last_activity'] > 3600)) {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit;
}
$_SESSION['last_activity'] = time(); // Atualiza o tempo da última atividade
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel</title>
    <link rel="stylesheet" href="css/adminlte.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Painel Administrativo</h1>
        <p>Bem-vindo, <?= $_SESSION['usuario'] ?>!</p>
        <a href="cadastro_produto.php">Cadastro de Produtos</a><br>
        <a href="excluir_produto.php">Excluir Produtos</a><br>
        <a href="cadastro_seo.php">Cadastro de SEO</a><br>
        <a href="logout.php">Sair</a>
    </div>
</body>
</html>
