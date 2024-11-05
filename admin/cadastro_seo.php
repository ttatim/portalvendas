<?php
session_start();
include 'includes/config.php';

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

// Processar o envio do formulário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $palavras_chaves = $_POST['palavras_chaves'];
    $meta_tags = $_POST['meta_tags'];

    // Verifica se já existe uma entrada para SEO e atualiza, caso exista
    $stmt = $pdo->prepare("SELECT * FROM seo LIMIT 1");
    $stmt->execute();
    $seo = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($seo) {
        // Atualiza as informações de SEO
        $stmt = $pdo->prepare("UPDATE seo SET palavras_chaves = ?, meta_tags = ? WHERE id = ?");
        $stmt->execute([$palavras_chaves, $meta_tags, $seo['id']]);
    } else {
        // Insere novas informações de SEO
        $stmt = $pdo->prepare("INSERT INTO seo (palavras_chaves, meta_tags) VALUES (?, ?)");
        $stmt->execute([$palavras_chaves, $meta_tags]);
    }

    echo "SEO cadastrado/atualizado com sucesso!";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de SEO</title>
    <link rel="stylesheet" href="css/adminlte.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Cadastrar/Atualizar SEO</h1>
        <form method="POST">
            <input type="text" name="palavras_chaves" required placeholder="Palavras Chaves"><br>
            <textarea name="meta_tags" required placeholder="Meta Tags"></textarea><br>
            <button type="submit">Salvar</button>
        </form>
    </div>
</body>
</html>
