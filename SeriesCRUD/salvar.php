<?php
session_start();
require "../db.php";

if (!isset($_SESSION["usuario_id"])) {
    header("Location: ../login.php");
    exit();
}

$usuario_id = $_SESSION["usuario_id"];

// ====== CAPA =======
$arquivo = $_FILES["capa"];
$nomeImagem = "serie_" . time() . "_" . $arquivo["name"];
move_uploaded_file($arquivo["tmp_name"], "../imagens/" . $nomeImagem);

// ====== CAMPOS =======
$titulo = $_POST["titulo"];
$genero = $_POST["genero"];
$temporada = $_POST["temporada"];
$episodio = $_POST["episodio"];
$status = $_POST["status"];
$avaliacao = $_POST["avaliacao"];

// ====== SQL INSERT =======
$sql = "INSERT INTO series (capa, titulo, genero, temporada, episodio, stts, avaliacao, usuario_id)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssiiisi", $nomeImagem, $titulo, $genero, $temporada, $episodio, $status, $avaliacao, $usuario_id);

if ($stmt->execute()) {
    header("Location: ../series.php");
} else {
    echo "Erro: " . $conn->error;
}
