<?php
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "BaseDatos";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Verificación
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Establecer el conjunto de caracteres a utf8
$conn->set_charset("utf8");
?>
