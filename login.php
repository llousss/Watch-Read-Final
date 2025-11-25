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

            // 🔥 salva os dados do usuário na sessão
            $_SESSION["usuario_id"] = $user["id"];
            $_SESSION["usuario_nome"] = $user["nome"];
            $_SESSION["usuario_email"] = $user["email"];

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

    <style>
        /* --- ESTILO EXCLUSIVO DA PÁGINA DE LOGIN --- */

        :root {
            --fundo:#f6f8fb;
            --card:#ffffff;
            --destaque:#2196f3;
            --texto-claro:#6b6f76;
        }

        body {
            margin: 0;
            font-family: Inter, "Segoe UI", Roboto, Arial, sans-serif;
            background: var(--fundo);
            display: flex;
            flex-direction: column; /* garante que o header fique em cima */
            align-items: center;
            min-height: 100vh;
        }

        /* Fixar header no topo */
        header {
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
        }

        /* Caixa central */
        .container {
            width: 100%;
            max-width: 420px;
            background: var(--card);
            padding: 28px;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(20, 30, 45, 0.1);
            text-align: center;
            margin-top: 120px; /* espaço para o header */
        }

        /* Título */
        .container h2 {
            margin-bottom: 18px;
            font-size: 24px;
            color: #222;
        }

        /* Inputs */
        .container input {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-bottom: 12px;
            font-size: 14px;
        }

        .container input:focus {
            border-color: var(--destaque);
            box-shadow: 0 0 6px rgba(33,150,243,0.3);
            outline: none;
        }

        /* Botão */
        .container button {
            width: 100%;
            background: var(--destaque);
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-size: 15px;
            cursor: pointer;
            font-weight: 600;
        }

        .container button:hover {
            opacity: 0.9;
        }

        /* Link */
        .container .link {
            margin-top: 14px;
            font-size: 14px;
        }

        .container .link a {
            color: var(--destaque);
            text-decoration: none;
            font-weight: 600;
        }

        /* Mensagem de erro */
        .erro {
            background: #ffdddd;
            color: #c00;
            padding: 8px;
            border-radius: 6px;
            margin-bottom: 10px;
            font-size: 14px;
        }
    </style>

</head>

<body>

    <!-- AGORA O HEADER FICA CORRETAMENTE AQUI -->
    <?php include 'header.php'; ?>

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
  <script src="js/tema.js"></script>
</body>
</html>
