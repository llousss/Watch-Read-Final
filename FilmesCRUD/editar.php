<?php
session_start();

// 🔒 Se não estiver logado → login
if (!isset($_SESSION["usuario_id"])) {
    header("Location: ../login.php");
    exit();
}

require "../db.php";

$id = $_GET["id"] ?? null;

if (!$id) {
    die("Filme não encontrado!");
}

// Busca o filme pertencente ao usuário logado
$sql = "SELECT * FROM filmes WHERE id = $id AND usuario_id = " . $_SESSION["usuario_id"];
$resultado = $conn->query($sql);

if ($resultado->num_rows === 0) {
    die("Você não tem permissão para editar este filme.");
}

$filme = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Filme</title>
    <link rel="stylesheet" href="../css/crud.css">
</head>
<body>

<div class="crud-container">

    <h2>Editar Filme</h2>

    <form action="atualizar.php" method="POST" enctype="multipart/form-data" class="crud-form">

        <input type="hidden" name="id" value="<?= $filme['id'] ?>">

        <!-- CAPA ATUAL -->
        <label>Capa Atual:</label>
        <?php if ($filme['capa']): ?>
            <img src="../imagens/<?= $filme['capa'] ?>" 
                 style="width:160px; border-radius:8px; display:block; margin:10px auto;">
        <?php else: ?>
            <p style="text-align:center;">Nenhuma capa enviada.</p>
        <?php endif; ?>

        <!-- TROCAR CAPA -->
        <label>Alterar Capa (opcional):</label>
        <input type="file" name="capa">

        <!-- TÍTULO -->
        <label>Título:</label>
        <input type="text" name="titulo" value="<?= htmlspecialchars($filme['titulo']) ?>" required>

        <!-- GÊNERO -->
        <label>Gênero:</label>
        <input type="text" name="genero" value="<?= htmlspecialchars($filme['genero']) ?>">

        <!-- STATUS -->
        <label>Status:</label>
        <select name="status" required>
            <option value="Assistindo" <?= $filme['stts'] == "Assistindo" ? "selected" : "" ?>>Assistindo</option>
            <option value="Assistido" <?= $filme['stts'] == "Assistido" ? "selected" : "" ?>>Assistido</option>
            <option value="Pendente" <?= $filme['stts'] == "Pendente" ? "selected" : "" ?>>Pendente</option>
        </select>

        <!-- AVALIAÇÃO -->
        <label>Avaliação (0 a 10):</label>
        <input type="number" name="avaliacao" min="0" max="10" 
               value="<?= htmlspecialchars($filme['avaliacao']) ?>">

        <button type="submit">Salvar Alterações</button>

    </form>

    <a href="../filmes.php" class="voltar">Voltar</a>

</div>

</body>
</html>
