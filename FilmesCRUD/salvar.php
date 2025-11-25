<?php
session_start();
require "../db.php";

// Usuário precisa estar logado
if (!isset($_SESSION["usuario_id"])) {
    header("Location: ../login.php");
    exit();
}

$usuario_id = $_SESSION["usuario_id"];

// -------------------------
// 1. CAPA
// -------------------------
$arquivo = $_FILES["capa"];
$nomeImagem = "img_" . time() . "_" . $arquivo["name"];
move_uploaded_file($arquivo["tmp_name"], "../imagens/" . $nomeImagem);

// -------------------------
// 2. CAMPOS DO FORMULÁRIO
// -------------------------
$titulo = $_POST["titulo"];
$genero = $_POST["genero"];
$status = $_POST["status"]; // vem do formulário
$avaliacao = $_POST["avaliacao"];

// -------------------------
// 3. SQL INSERT (com STTS correto!)
// -------------------------
$sql = "INSERT INTO filmes (capa, titulo, genero, stts, avaliacao, usuario_id)
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssii", $nomeImagem, $titulo, $genero, $status, $avaliacao, $usuario_id);

if ($stmt->execute()) {
    header("Location: ../filmes.php");
    exit();
} else {
    echo "Erro ao salvar: " . $conn->error;
}
?>
