<?php
require_once "db.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"] ?? "";
    $senha = $_POST["senha"] ?? "";

    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $user = $resultado->fetch_assoc();

        if (password_verify($senha, $user["senha"])) {
            $_SESSION["usuario"] = $user["id"];
            header("Location: index.php");
            exit();
        }
    }

    $erro = "E-mail ou senha incorretos!";
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login - WatchRead</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

<div class="container">
    <h2>Entrar</h2>

    <?php if (!empty($erro)): ?>
        <p class="erro"><?= $erro ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>E-mail:</label>
        <input type="email" name="email" required>

        <label>Senha:</label>
        <input type="password" name="senha" required>

        <button type="submit">Entrar</button>

        <p class="link">Não tem conta? <a href="registrar.php">Registre-se</a></p>
    </form>
</div>

</body>
</html>
