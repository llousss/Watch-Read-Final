<?php
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: ../login.php");
    exit();
}

require "../db.php";

$id = $_GET["id"];
$usuario_id = $_SESSION["usuario_id"];

// Verifica se pertence ao usuário
$sql = "SELECT capa FROM livros WHERE id = $id AND usuario_id = $usuario_id";
$result = $conn->query($sql);

if ($result->num_rows === 0) {
    die("Você não tem permissão para excluir este livro.");
}

$livro = $result->fetch_assoc();
$capa = $livro["capa"];

// Remove a imagem
if (file_exists("../imagens/" . $capa)) {
    unlink("../imagens/" . $capa);
}

// Apaga o livro
$sqlDelete = "DELETE FROM livros WHERE id = $id AND usuario_id = $usuario_id";

if ($conn->query($sqlDelete) === TRUE) {
    header("Location: ../livros.php");
} else {
    echo "Erro ao deletar: " . $conn->error;
}
