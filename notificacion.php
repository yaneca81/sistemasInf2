<?php
// Incluir el archivo de configuración de la base de datos
include 'includes/conexion.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $titulo = htmlspecialchars($_POST['titulo']);
    $mensaje = htmlspecialchars($_POST['mensaje']);
    $fecha = date('Y-m-d H:i:s'); // Fecha y hora actual

    try {
        // Preparar la consulta de inserción
        $stmt = $pdo->prepare("INSERT INTO notificaciones (titulo, mensaje, fecha) VALUES (:titulo, :mensaje, :fecha)");

        // Bind de parámetros
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':mensaje', $mensaje);
        $stmt->bindParam(':fecha', $fecha);

        // Ejecutar la consulta
        $stmt->execute();

        // Redirigir a una página de confirmación
        header('Location: confirmacion.php');
        exit();
    } catch (PDOException $e) {
        echo "Error al insertar datos: " . $e->getMessage();
    }
}
?>
