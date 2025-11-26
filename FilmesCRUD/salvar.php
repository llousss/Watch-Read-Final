<?php
session_start();
require "../db.php";

// Verifica login
if (!isset($_SESSION["usuario_id"])) {
    header("Location: ../login.php");
    exit();
}

$usuario_id = $_SESSION["usuario_id"];

// -----------------------
// 1. TRATAMENTO DA CAPA
// -----------------------
if (!isset($_FILES["capa"]) || $_FILES["capa"]["error"] !== UPLOAD_ERR_OK) {
    die("Erro ao enviar a capa.");
}

$arquivo = $_FILES["capa"];
$ext = pathinfo($arquivo["name"], PATHINFO_EXTENSION);
$nomeImagem = "filme_" . time() . "." . $ext;

if (!move_uploaded_file($arquivo["tmp_name"], "../imagens/" . $nomeImagem)) {
    die("Erro ao salvar imagem no servidor.");
}

// -----------------------
// 2. CAMPOS DO FORMULÁRIO
// -----------------------
$titulo    = $_POST["titulo"];
$genero    = $_POST["genero"];
$status    = $_POST["status"];
$avaliacao = ($_POST["avaliacao"] !== "") ? intval($_POST["avaliacao"]) : null;

// -----------------------
// 3. SQL COM data_registro
// -----------------------
$sql = "INSERT INTO filmes (capa, titulo, genero, stts, avaliacao, usuario_id, data_registro)
        VALUES (?, ?, ?, ?, ?, ?, NOW())";

$stmt = $conn->prepare($sql);

// Avaliação precisa ser tratada como NULL corretamente
$stmt->bind_param(
    "ssssii",
    $nomeImagem,
    $titulo,
    $genero,
    $status,
    $avaliacao,
    $usuario_id
);

if ($stmt->execute()) {
    header("Location: ../filmes.php");
    exit();
} else {
    echo "Erro ao salvar: " . $conn->error;
}
?>
