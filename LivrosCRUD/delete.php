<?php
require "../db.php";

$id = $_GET["id"];
$conn->query("DELETE FROM livros WHERE id=$id");

header("Location: ../livros.php");
exit;
