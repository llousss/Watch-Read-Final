<?php
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: ../login.php");
    exit();
}

require "../db.php";

$id = $_POST["id"];
$titulo = $_POST["titulo"];
$autor = $_POST["autor"];
$status = $_POST["status"];
$avaliacao = $_POST["avaliacao"];

$usuario_id = $_SESSION["usuario_id"];

// Verifica se o livro pertence ao usuário antes de editar
$sql = "SELECT * FROM livros WHERE id = $id AND usuario_id = $usuario_id";
$result = $conn->query($sql);

if ($result->num_rows === 0) {
    die("Você não tem permissão para editar este livro.");
}

// Verifica se trocou a capa
$novaCapa = null;

if (!empty($_FILES["capa"]["name"])) {
    $arquivo = $_FILES["capa"];
    $novaCapa = "img_" . time() . "_" . $arquivo["name"];
    move_uploaded_file($arquivo["tmp_name"], "../imagens/" . $novaCapa);

    $sqlUpdate = "
        UPDATE livros SET 
            capa='$novaCapa',
            titulo='$titulo',
            autor='$autor',
            stts='$status',
            avaliacao='$avaliacao'
        WHERE id=$id AND usuario_id=$usuario_id";
} else {
    $sqlUpdate = "
        UPDATE livros SET 
            titulo='$titulo',
            autor='$autor',
            stts='$status',
            avaliacao='$avaliacao'
        WHERE id=$id AND usuario_id=$usuario_id";
}

if ($conn->query($sqlUpdate) === TRUE) {
    header("Location: ../livros.php");
} else {
    echo "Erro ao atualizar: " . $conn->error;
}
