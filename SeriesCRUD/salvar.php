<?php
session_start();
require "../db.php";

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
$nomeImagem = "serie_" . time() . "." . $ext;

if (!move_uploaded_file($arquivo["tmp_name"], "../imagens/" . $nomeImagem)) {
    die("Erro ao salvar imagem no servidor.");
}

// -----------------------
// 2. CAMPOS
// -----------------------
$titulo     = $_POST["titulo"];
$genero     = $_POST["genero"];
$temporada  = intval($_POST["temporada"]);
$episodio   = intval($_POST["episodio"]);
$status     = $_POST["stts"];
$avaliacao = $_POST["avaliacao"];
    if ($avaliacao === "" || $avaliacao === null) {
        $avaliacao = null;
}

// -----------------------
// 3. SQL COM data_registro
// -----------------------
$sql = "INSERT INTO series (capa, titulo, genero, temporada, episodio, stts, avaliacao, usuario_id, data_registro)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "sssiisss",
    $nomeImagem,
    $titulo,
    $genero,
    $temporada,
    $episodio,
    $status,
    $avaliacao,
    $usuario_id
);

if ($stmt->execute()) {
    header("Location: ../series.php");
    exit();
} else {
    echo "Erro: " . $conn->error;
}
?>
