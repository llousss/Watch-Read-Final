<?php
session_start();
if (!isset($_SESSION["usuario_id"])) {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Série</title>
    <link rel="stylesheet" href="../css/crud.css">
</head>
<body>

<div class="crud-container">

    <h2>Adicionar Série</h2>

    <form action="salvar.php" method="POST" enctype="multipart/form-data" class="crud-form">

        <label>Capa:</label>
        <input type="file" name="capa" required>

        <label>Título:</label>
        <input type="text" name="titulo" required>

        <label>Gênero:</label>
        <input type="text" name="genero">

        <label>Temporada:</label>
        <input type="number" name="temporada" min="1" value="1">

        <label>Episódio:</label>
        <input type="number" name="episodio" min="1" value="1">

        <label for="status">Status:</label>
        <select name="stts" required>
            <option value="Assistindo">Assistindo</option>
            <option value="Assistido">Assistido</option>
            <option value="Pendente">Pendente</option>
        </select>

        <label>Avaliação (0 a 10):</label>
        <input type="number" name="avaliacao" min="0" max="10" step="0.1">

        <button type="submit">Salvar</button>

    </form>

    <a href="../series.php" class="voltar">Voltar</a>

</div>

<script src="../js/tema.js"></script>
</body>
</html>
