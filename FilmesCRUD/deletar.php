<?php
session_start();

// Se não estiver logado → login
if (!isset($_SESSION["usuario_id"])) {
    header("Location: ../login.php");
    exit();
}

require "../db.php";

$id = $_GET["id"] ?? null;

if (!$id) {
    die("ID inválido!");
}

// Busca o filme, mas só se pertencer ao usuário logado
$sql = "SELECT capa FROM filmes WHERE id = $id AND usuario_id = " . $_SESSION["usuario_id"];
$resultado = $conn->query($sql);

if ($resultado->num_rows === 0) {
    die("Você não tem permissão para excluir este filme.");
}

$filme = $resultado->fetch_assoc();


// ======================================
// 📌 Remover capa física (se existir)
// ======================================
if (!empty($filme["capa"])) {
    $caminhoImagem = "../imagens/" . $filme["capa"];

    if (file_exists($caminhoImagem)) {
        unlink($caminhoImagem);
    }
}


// ======================================
// 📌 Remover filme do banco
// ======================================
$sqlDelete = "DELETE FROM filmes WHERE id = ? AND usuario_id = ?";
$stmt = $conn->prepare($sqlDelete);
$stmt->bind_param("ii", $id, $_SESSION["usuario_id"]);
$stmt->execute();

$stmt->close();
$conn->close();


// Voltar à lista
header("Location: ../filmes.php");
exit();
?>
