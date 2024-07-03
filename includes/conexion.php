
<?php
// Configuración de la base de datos
$host = 'localhost'; // Cambia esto si tu base de datos está en un servidor remoto
$dbname = 'notificaciones'; // Nombre de tu base de datos
$username = 'root'; // Nombre de usuario de la base de datos
$password = ''; // Contraseña de la base de datos

try {
    // Conexión PDO a la base de datos
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Añade más configuraciones si es necesario, como el juego de caracteres
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
