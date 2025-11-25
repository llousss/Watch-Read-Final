<?php
session_start();
require "../db.php";

if (!isset($_SESSION["usuario_id"])) {
    header("Location: ../login.php");
    exit();
}

$id = $_POST["id"];
$usuario_id = $_SESSION["usuario_id"];

// Buscar série
$sql = "SELECT capa FROM series WHERE id = $id AND usuario_id = $usuario_id";
$res = $conn->query($sql);

if ($res->num_rows === 0) die("Sem permissão.");
$serie = $res->fetch_assoc();

// ===== CAPA =====
$nomeImagem = $serie["capa"];

if (!empty($_FILES["capa"]["name"])) {
    $arquivo = $_FILES["capa"];
    $nomeImagem = "serie_" . time() . "_" . $arquivo["name"];
    move_uploaded_file($arquivo["tmp_name"], "../imagens/" . $nomeImagem);
}

// ===== CAMPOS =====
$titulo = $_POST["titulo"];
$genero = $_POST["genero"];
$temporada = $_POST["temporada"];
$episodio = $_POST["episodio"];
$status = $_POST["status"];
$avaliacao = $_POST["avaliacao"];

// ===== SQL UPDATE =====
$sqlUpdate = "UPDATE series SET capa=?, titulo=?, genero=?, temporada=?, episodio=?, stts=?, avaliacao=? 
              WHERE id=? AND usuario_id=?";

$stmt = $conn->prepare($sqlUpdate);
$stmt->bind_param("sssiiisii", $nomeImagem, $titulo, $genero, $temporada, $episodio, $status, $avaliacao, $id, $usuario_id);
$stmt->execute();

header("Location: ../series.php");
exit();
