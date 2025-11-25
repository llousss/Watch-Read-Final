<?php
session_start();

// Se não estiver logado → login
if (!isset($_SESSION["usuario_id"])) {
    header("Location: ../login.php");
    exit();
}

require "../db.php";

$id = $_POST["id"] ?? null;

if (!$id) {
    die("ID inválido!");
}

// Pegamos o filme só se pertencer ao usuário logado
$sql = "SELECT * FROM filmes WHERE id = $id AND usuario_id = " . $_SESSION["usuario_id"];
$resultado = $conn->query($sql);

if ($resultado->num_rows === 0) {
    die("Você não tem permissão para editar este filme.");
}

$filme = $resultado->fetch_assoc();

// Campos recebidos
$titulo = $_POST["titulo"];
$genero = $_POST["genero"];
$status = $_POST["status"];
$avaliacao = $_POST["avaliacao"];

// Começamos com a capa antiga
$capaFinal = $filme["capa"];


// ======================================
// 📌 PROCESSAR NOVA CAPA (SE ENVIADA)
// ======================================
if (!empty($_FILES["capa"]["name"])) {

    $ext = pathinfo($_FILES["capa"]["name"], PATHINFO_EXTENSION);
    $novoNome = "img_" . time() . "_" . rand(1000, 9999) . "." . $ext;

    $pastaDestino = "../imagens/" . $novoNome;

    if (move_uploaded_file($_FILES["capa"]["tmp_name"], $pastaDestino)) {
        $capaFinal = $novoNome;

        // ❗ Excluir imagem antiga (se existir)
        if (!empty($filme["capa"]) && file_exists("../imagens/" . $filme["capa"])) {
            unlink("../imagens/" . $filme["capa"]);
        }
    }
}


// ======================================
// 📌 ATUALIZAR NO BANCO
// ======================================
$sqlUpdate = "
    UPDATE filmes
    SET titulo = ?, genero = ?, stts = ?, avaliacao = ?, capa = ?
    WHERE id = ? AND usuario_id = ?
";

$stmt = $conn->prepare($sqlUpdate);
$stmt->bind_param(
    "ssssssi",
    $titulo,
    $genero,
    $status,
    $avaliacao,
    $capaFinal,
    $id,
    $_SESSION["usuario_id"]
);

$stmt->execute();

$stmt->close();
$conn->close();


// Redireciona
header("Location: ../filmes.php");
exit();
?>
