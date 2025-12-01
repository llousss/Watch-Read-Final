<?php
$host = "localhost:8080";
$user = "root";
$pass = "";
$dbname = "watchread";
$port = 3309;

$conn = new mysqli($host, $user, $pass, $dbname, $port);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>
