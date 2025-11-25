<?php
session_start();

// 🔒 Se não estiver logado → login
if (!isset($_SESSION["usuario_id"])) {
    header("Location: ../login.php");
    exit();
}

require "../db.php";

// ID do livro
$id = $_GET["id"] ?? null;

if (!$id) {
    die("Livro não encontrado!");
}

// Buscar livro
$sql = "SELECT * FROM livros WHERE id = $id AND usuario_id = " . $_SESSION["usuario_id"];
$resultado = $conn->query($sql);

if ($resultado->num_rows === 0) {
    die("Você não tem permissão para editar este livro.");
}

$livro = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Livro</title>
    <link rel="stylesheet" href="../css/crud.css">

<style>
/* --- ESTILO DA PÁGINA DE EDIÇÃO --- */

.form-container {
    width: 100%;
    max-width: 450px;
    margin: 30px auto;
    background: var(--card);
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(20, 30, 45, .1);
}

.titulo-editar {
    text-align: center;
    margin-top: 20px;
    color: var(--texto);
}

.form-editar {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.label {
    font-size: 14px;
    color: var(--texto);
    margin-bottom: -4px;
}

.input-texto,
.input-select,
.input-arquivo {
    width: 100%;
    padding: 10px 12px;
    border-radius: 8px;
    border: 1px solid #ccc;
    background: var(--card);
}

.input-texto:focus,
.input-select:focus {
    outline: none;
    border-color: var(--destaque);
    box-shadow: 0 0 5px rgba(33,150,243,.3);
}

.capa-preview {
    width: 160px;
    border-radius: 8px;
    margin: 8px auto 15px auto;
    display: block;
}

.botao-salvar {
    background: var(--destaque);
    color: #fff;
    padding: 12px;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    cursor: pointer;
    transition: 0.2s;
}

.botao-salvar:hover {
    opacity: .9;
}
</style>

</head>
<body>

<main class="container">

<h2 class="titulo-editar">Editar Livro</h2>

<div class="form-container">

<form action="atualizar.php" method="POST" enctype="multipart/form-data" class="form-editar">

    <input type="hidden" name="id" value="<?= $livro['id'] ?>">

    <label class="label">Capa Atual:</label>
    <img src="../imagens/<?= $livro['capa'] ?>" class="capa-preview">

    <label class="label">Alterar Capa (opcional):</label>
    <input type="file" name="capa" class="input-arquivo">

    <label class="label">Título:</label>
    <input type="text" name="titulo" value="<?= $livro['titulo'] ?>" required class="input-texto">

    <label class="label">Autor:</label>
    <input type="text" name="autor" value="<?= $livro['autor'] ?>" class="input-texto">

    <label class="label">Status:</label>
    <select name="status" class="input-select" required>
        <option value="Lendo"     <?= $livro['stts'] == 'Lendo' ? 'selected' : '' ?>>Lendo</option>
        <option value="Lido"      <?= $livro['stts'] == 'Lido' ? 'selected' : '' ?>>Lido</option>
        <option value="Pendente"  <?= $livro['stts'] == 'Pendente' ? 'selected' : '' ?>>Pendente</option>
    </select>

    <label class="label">Avaliação:</label>
    <input type="text" name="avaliacao" value="<?= $livro['avaliacao'] ?>" class="input-texto">

    <button type="submit" class="botao-salvar">Salvar Alterações</button>

</form>

</div>

</main>

<script src="../js/tema.js"></script>
</body>
</html>
