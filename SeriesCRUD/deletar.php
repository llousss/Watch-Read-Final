<?php
session_start();
require "../db.php";

if (!isset($_SESSION["usuario_id"])) {
    header("Location: ../login.php");
    exit();
}

$id = $_GET["id"] ?? null;
$usuario_id = $_SESSION["usuario_id"];

$sql = "SELECT capa FROM series WHERE id = $id AND usuario_id = $usuario_id";
$res = $conn->query($sql);

if ($res->num_rows === 0) die("Sem permissão.");

$serie = $res->fetch_assoc();

// Apagar capa
if (!empty($serie["capa"])) {
    $caminho = "../imagens/" . $serie["capa"];
    if (file_exists($caminho)) unlink($caminho);
}

$sqlDelete = "DELETE FROM series WHERE id=? AND usuario_id=?";
$stmt = $conn->prepare($sqlDelete);
$stmt->bind_param("ii", $id, $usuario_id);
$stmt->execute();

header("Location: ../series.php");
exit();
