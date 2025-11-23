<?php include "../db.php"; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Livro</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<h2>Adicionar Livro</h2>

<form action="salvar.php" method="POST" enctype="multipart/form-data">
    <label>Capa:</label>
    <input type="file" name="capa" required><br>

    <label>Título:</label>
    <input type="text" name="titulo" required><br>

    <label>Autor:</label>
    <input type="text" name="autor"><br>

    <label>Status:</label>
    <select name="status" required>
        <option value="Lendo">Lendo</option>
        <option value="Lido">Lido</option>
        <option value="Pendente">Pendente</option>
    </select><br>

    <label>Avaliação:</label>
    <input type="text" name="avaliacao"><br>

    <button type="submit">Salvar</button>
</form>

</body>
</html>

<?php
require "../db.php";

$id = $_POST["id"] ?? null;

$titulo = $_POST["titulo"];
$autor = $_POST["autor"];
$status = $_POST["status"];
$avaliacao = $_POST["avaliacao"];

$novaCapa = null;

if (!empty($_FILES["capa"]["name"])) {
    $arquivo = $_FILES["capa"];
    $novaCapa = "img_" . time() . "_" . $arquivo["name"];
    move_uploaded_file($arquivo["tmp_name"], "../imagens/" . $novaCapa);
}

if ($id) {
    // UPDATE
    if ($novaCapa) {
        $sql = "UPDATE livros SET 
                capa='$novaCapa',
                titulo='$titulo',
                autor='$autor',
                stts='$status',
                avaliacao='$avaliacao'
                WHERE id=$id";
    } else {
        $sql = "UPDATE livros SET 
                titulo='$titulo',
                autor='$autor',
                stts='$status',
                avaliacao='$avaliacao'
                WHERE id=$id";
    }

} else {
    // INSERT
    $arquivo = $_FILES["capa"];
    $nomeImagem = "img_" . time() . "_" . $arquivo["name"];
    move_uploaded_file($arquivo["tmp_name"], "../imagens/" . $nomeImagem);

    $sql = "INSERT INTO livros (capa, titulo, autor, stts, avaliacao) 
            VALUES ('$nomeImagem', '$titulo', '$autor', '$status', '$avaliacao')";
}

if ($conn->query($sql) === TRUE) {
    header("Location: ../livros.php");
} else {
    echo "Erro: " . $conn->error;
}
