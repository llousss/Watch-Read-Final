<?php
require "../db.php";

$arquivo = $_FILES["capa"];
$nomeImagem = "img_" . time() . "_" . $arquivo["name"];
move_uploaded_file($arquivo["tmp_name"], "../imagens/" . $nomeImagem);

$titulo = $_POST["titulo"];
$autor = $_POST["autor"];
$status = $_POST["status"];
$avaliacao = $_POST["avaliacao"];

$sql = "INSERT INTO livros (capa, titulo, autor, stts, avaliacao) 
        VALUES ('$nomeImagem', '$titulo', '$autor', '$status', '$avaliacao')";

if ($conn->query($sql) === TRUE) {
    header("Location: ../livros.php");
    exit;
} else {
    echo "Erro: " . $conn->error;
}
