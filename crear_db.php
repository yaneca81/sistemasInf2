<?php
try {
    // Crear y conectar a la base de datos SQLite
    $pdo = new PDO('sqlite:notificaciones.db');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Crear la tabla de notificaciones si no existe
    $query = "
    CREATE TABLE IF NOT EXISTS notificaciones (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        titulo TEXT NOT NULL,
        mensaje TEXT NOT NULL,
        fecha TEXT NOT NULL
    )";
    $pdo->exec($query);

    echo "Base de datos y tabla de notificaciones creadas exitosamente.";
} catch (PDOException $e) {
    echo "Error al crear la base de datos: " . $e->getMessage();
}
?>

