<?php
require "../db.php";
session_start();

// Se o usuário não estiver logado, volta
if (!isset($_SESSION["usuario_id"])) {
    header("Location: ../login.php");
    exit();
}

// ========= TRATAMENTO DO UPLOAD =========

// Verifica se veio arquivo
if (!isset($_FILES["capa"]) || $_FILES["capa"]["error"] !== UPLOAD_ERR_OK) {
    die("Erro ao enviar a imagem da capa.");
}

$arquivo = $_FILES["capa"];

// Pasta de destino
$destino = "../imagens/";

// Garante nome seguro
$extensao = pathinfo($arquivo["name"], PATHINFO_EXTENSION);
$nomeImagem = "img_" . time() . "." . $extensao;

// Move o arquivo para a pasta
if (!move_uploaded_file($arquivo["tmp_name"], $destino . $nomeImagem)) {
    die("Erro ao salvar a imagem no servidor.");
}

// ========= DADOS DO FORMULÁRIO =========
$titulo = $conn->real_escape_string($_POST["titulo"]);
$autor = $conn->real_escape_string($_POST["autor"]);
$status = $conn->real_escape_string($_POST["status"]);
$avaliacao = ($_POST["avaliacao"] !== "") ? (int)$_POST["avaliacao"] : null;
$usuario_id = (int)$_POST["usuario_id"];

// ========= INSERT =========
$sql = "INSERT INTO livros (capa, titulo, autor, stts, avaliacao, usuario_id, data_registro)
        VALUES ('$nomeImagem', '$titulo', '$autor', '$status', " .
        ($avaliacao !== null ? $avaliacao : "NULL") . ", $usuario_id, NOW())";

if ($conn->query($sql) === TRUE) {
    header("Location: ../livros.php");
    exit;
} else {
    echo "Erro ao salvar: " . $conn->error;
}
?>
