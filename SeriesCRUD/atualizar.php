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
$sql = "SELECT capa FROM series WHERE id = ? AND usuario_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $id, $usuario_id);
$stmt->execute();
$res = $stmt->get_result();

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
$titulo    = $_POST["titulo"] ?? "";
$genero    = $_POST["genero"] ?? "";
$temporada = intval($_POST["temporada"] ?? 1);
$episodio  = intval($_POST["episodio"] ?? 1);
$status    = $_POST["stts"] ?? "";  // corrigido para stts
$avaliacao = $_POST["avaliacao"];
if ($avaliacao === "" || $avaliacao === null) {
    $avaliacao = null;
} else {
    $avaliacao = strval($avaliacao); // string porque a coluna é varchar(5)
}

// ===== SQL UPDATE =====
$sqlUpdate = "UPDATE series SET capa=?, titulo=?, genero=?, temporada=?, episodio=?, stts=?, avaliacao=? 
              WHERE id=? AND usuario_id=?";

$stmt = $conn->prepare($sqlUpdate);
$stmt->bind_param(
    "sssiissii",
    $nomeImagem, // capa
    $titulo,     // título
    $genero,     // gênero
    $temporada,  // temporada
    $episodio,   // episódio
    $status,     // stts
    $avaliacao,  // avaliação
    $id,         // id
    $usuario_id  // usuário
);

$stmt->execute();
header("Location: ../series.php");
exit();
?>
