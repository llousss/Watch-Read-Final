<?php
session_start();
require "../db.php";

if (!isset($_SESSION["usuario_id"])) {
    header("Location: ../login.php");
    exit();
}

$id = $_GET["id"] ?? null;
if (!$id) die("Série não encontrada!");

$sql = "SELECT * FROM series WHERE id = $id AND usuario_id = " . $_SESSION["usuario_id"];
$res = $conn->query($sql);

if ($res->num_rows === 0) die("Sem permissão.");
$serie = $res->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Série</title>
    <link rel="stylesheet" href="../css/crud.css">
</head>
<body>

<div class="crud-container">

    <h2>Editar Série</h2>

    <form action="atualizar.php" method="POST" enctype="multipart/form-data" class="crud-form">

        <input type="hidden" name="id" value="<?= $serie['id'] ?>">

        <label>Capa Atual:</label>
        <img src="../imagens/<?= $serie['capa'] ?>" style="width:150px; border-radius:10px; display:block; margin:10px auto;">

        <label>Alterar Capa (opcional):</label>
        <input type="file" name="capa">

        <label>Título:</label>
        <input type="text" name="titulo" value="<?= $serie['titulo'] ?>" required>

        <label>Gênero:</label>
        <input type="text" name="genero" value="<?= $serie['genero'] ?>">

        <label>Temporada:</label>
        <input type="number" name="temporada" min="1" value="<?= $serie['temporada'] ?>">

        <label>Episódio:</label>
        <input type="number" name="episodio" min="1" value="<?= $serie['episodio'] ?>">

        <label>Status:</label>
        <select name="stts">
            <option value="Assistindo" <?= $serie['stts']=="Assistindo"?"selected":"" ?>>Assistindo</option>
            <option value="Assistido" <?= $serie['stts']=="Assistido"?"selected":"" ?>>Assistido</option>
            <option value="Pendente" <?= $serie['stts']=="Pendente"?"selected":"" ?>>Pendente</option>
        </select>

        <label>Avaliação:</label>
        <input type="number" name="avaliacao" min="0" max="10" step="0.1" value="<?= $serie['avaliacao'] ?>">

        <button type="submit">Salvar Alterações</button>

    </form>

    <a href="../series.php" class="voltar">Voltar</a>

</div>

<script src="../js/tema.js"></script>
</body>
</html>
