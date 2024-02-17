<?php
$servername = "localhost";
$username = "root";
$password = "@Inspiron1";
$database = "db_reforged";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $database);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

echo "Conexão bem sucedida";
?>
