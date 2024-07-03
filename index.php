
<?php 
include 'includes/header.php'; 
include 'includes/conexion.php'; 
?>

<h1 class="titulo" s>Bienvenido a la Página de Inicio</h1>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Notificación</title>
    <style>
        body {
            /* Configuración de la imagen de fondo */
            background-image: url('./imagen/fond.jpg');
            background-size: cover; /* Ajusta el tamaño de la imagen para cubrir todo el cuerpo */
            background-position: center; /* Centra la imagen horizontal y verticalmente */
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
    <link rel="stylesheet" href="css/styles2.css">
</head>
<h1 class="titulo">Enviar Notificación</h1>
<body >
    
    <div class="centro">
        <form class="boton2" action="notificacion.php" method="post" >
        
            <label for="titulo" style="color:white" class="centro2">Título</label>
            <h1></h1>
            <input type="text" id="titulo" name="titulo"class="absoluto" required>
            <br>
            <h1></h1>
            <h3 for="mensaje" style="color:white" class="centro3">Mensaje</h3>
            
            <textarea id="mensaje" name="mensaje" required class="absoluto2"></textarea>
            <h1></h1>
            
            
            <h4 class="centro2" style="color:white" >Fecha</h4>
            <input type="date" id="fecha"  name="fecha" class="absoluto3">
            <br>
            <h1></h1>
            
            <input type="submit" class="boton" class="boton" class="absoluto4" value="Enviar notificacion">
            
        </form>
</div>
</body>
</html>

<?php include 'includes/footer.php'; ?>



