<?php
session_start();
if (isset($_SESSION['usuario'])) {
    header('Location: painel.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'includes/config.php';
    
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE login = :login");
    $stmt->execute(['login' => $login]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        $_SESSION['usuario'] = $usuario['login'];
        $_SESSION['last_activity'] = time(); // Tempo da última atividade
        header('Location: painel.php');
        exit;
    } else {
        $erro = "Login ou senha inválidos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/adminlte.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <form method="POST">
            <h1>Login</h1>
            <input type="text" name="login" required placeholder="Login">
            <input type="password" name="senha" required placeholder="Senha">
            <button type="submit">Entrar</button>
            <?php if (isset($erro)) echo "<p>$erro</p>"; ?>
        </form>
    </div>
</body>
</html>

