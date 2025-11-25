<?php
session_start();
require "db.php";

// Se não estiver logado, bloqueia
if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit();
}

// RECEBE OS CAMPOS
$usuario_id = $_SESSION["usuario_id"];
$nome = $_POST["nome"];
$email = $_POST["email"];
$cpf = $_POST["cpf"];
$assunto = $_POST["assunto"];
$mensagem = $_POST["mensagem"];

// PREPARA SQL
$sql = $conn->prepare("
    INSERT INTO contato (usuario_id, nome, email, cpf, assunto, mensagem)
    VALUES (?, ?, ?, ?, ?, ?)
");

$sql->bind_param("isssss", $usuario_id, $nome, $email, $cpf, $assunto, $mensagem);

if ($sql->execute()) {
    echo "<script>alert('Mensagem enviada com sucesso!'); window.location='contato.php';</script>";
} else {
    echo "<script>alert('Erro ao enviar mensagem.'); window.location='contato.php';</script>";
}

$sql->close();
$conn->close();
?>
