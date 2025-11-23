<?php
include "../db.php";
$id = $_GET["id"];

$sql = "SELECT * FROM livros WHERE id = $id";
$result = $conn->query($sql);
$livro = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Editar Livro</title>
</head>
<body>

<h2>Editar Livro</h2>

<form action="salvar.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $livro['id'] ?>">

    <label>Capa atual:</label><br>
    <img src="../imagens/<?= $livro['capa'] ?>" width="120"><br><br>

    <label>Nova capa (opcional):</label>
    <input type="file" name="capa"><br>

    <label>Título:</label>
    <input type="text" name="titulo" value="<?= $livro['titulo'] ?>" required><br>

    <label>Autor:</label>
    <input type="text" name="autor" value="<?= $livro['autor'] ?>"><br>

    <label>Status:</label>
    <select name="status">
        <option <?= $livro['stts']=="Lendo"?"selected":"" ?>>Lendo</option>
        <option <?= $livro['stts']=="Lido"?"selected":"" ?>>Lido</option>
        <option <?= $livro['stts']=="Pendente"?"selected":"" ?>>Pendente</option>
    </select><br>

    <label>Avaliação:</label>
    <input type="text" name="avaliacao" value="<?= $livro['avaliacao'] ?>"><br>

    <button type="submit">Salvar</button>
</form>

</body>
</html>
