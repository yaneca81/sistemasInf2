<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Proyecto</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body {
            /* Configuración de la imagen de fondo */
            background-image: url('./imagen/login.jpg');
            background-size: cover; /* Ajusta el tamaño de la imagen para cubrir todo el cuerpo */
             /* Centra la imagen horizontal y verticalmente */
            background-repeat: no-repeat; /* Evita que la imagen se repita */
            /* Otros estilos opcionales */
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0; /* Elimina el margen predeterminado del cuerpo */
            padding: 0; /* Elimina el relleno predeterminado del cuerpo */
        }

        /* Estilos adicionales para el contenido de la página */
        .content {
            padding: 20px; /* Añade un relleno al contenido para separarlo del borde del cuerpo */
            background-color: rgba(255, 255, 255, 0.8); /* Fondo semi-transparente para el contenido */
        }
    </style>
    
</head>
<body>
    <header>
        <nav>
            <ul>
                
                <li><a href="user.php">Regresar</a></li>
                
                
            </ul>
        </nav>
    </header>
    <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title class="">Notificaciones recibidas</title>
    <style>
        .notification {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <h1 class="titulo">Notificaciones recibidas</h1>
    <?php
    // Configuración de conexión a la base de datos MySQL
    $servername = "localhost"; // Cambia esto si tu servidor MySQL está en un host remoto
    $username = "root"; // Nombre de usuario de la base de datos
    $password = ""; // Contraseña de la base de datos
    $dbname = "notificaciones"; // Nombre de la base de datos

    try {
        // Crear conexión
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Establecer el modo de error de PDO a excepción
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consulta SQL para obtener las notificaciones ordenadas por fecha descendente
        $sql = "SELECT * FROM notificaciones ORDER BY fecha DESC";
        $stmt = $pdo->query($sql);
        $notificaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($notificaciones) {
            foreach ($notificaciones as $notificacion) {
                echo '<div class="notification">';
                echo '<h2>' . htmlspecialchars($notificacion['titulo']) . '</h2>';
                echo '<p>' . nl2br(htmlspecialchars($notificacion['mensaje'])) . '</p>';
                echo '<p><small>' . htmlspecialchars($notificacion['fecha']) . '</small></p>';
                echo '</div>';
            }
        } else {
            echo '<p>No hay notificaciones.</p>';
        }
    } catch(PDOException $e) {
        echo "Error al obtener las notificaciones: " . $e->getMessage();
    }
    ?>
</body>
</html>



