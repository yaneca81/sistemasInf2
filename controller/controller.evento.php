<?php
include "../model/conexion.php";

if (isset($_POST['btnregistrar'])) {
    if (!empty($_POST["nombre"]) && !empty($_POST["tema"]) && !empty($_POST["fecha"]) && !empty($_POST["ubicacion"]) && !empty($_POST["descripcion"]) && !empty($_POST["id_Categoria"])) {
        $nombre = $_POST['nombre'];
        $tema = $_POST['tema'];
        $fecha = $_POST['fecha'];
        $ubicacion = $_POST['ubicacion'];
        $id_Categoria = $_POST['id_Categoria']; // Este es el ID de la categoría seleccionada
        $descripcion = $_POST['descripcion'];

        // Inserción del evento en la base de datos


        $sql = $conexion->query(" insert into evento (nombre, tema, descripcion, fecha, ubicacion, id_Categoria) values ('$nombre', '$tema', '$descripcion', '$fecha', '$ubicacion', $id_Categoria)");


        if ($sql) {
            echo '<div class = "alert alert-success">Evento registrado correctamente</div>';
            echo '<meta http-equiv="refresh" content="2;url=index.php">';
        } else {
            echo '<div class = "alert alert-danger">Error al registrar el evento: </div>';
        }
    } else {
        echo '<div class = "alert alert-danger">Alguno de los campos esta Vacio</div>';
    }
}

// Consulta para obtener los datos del evento seleccionado
if (isset($_POST['btneditar'])) {
    //$id_evento = $_POST['id']; // ID del evento que se quiere editar

    echo "Success";
}

//Listar categoria

$categorias = $conexion->query("SELECT * FROM categoria");

// consulta SQL para incluir la unión con la tabla `categoria`
$listEvents = $conexion->query("SELECT evento.id, evento.nombre, evento.tema, evento.descripcion, evento.fecha, evento.ubicacion,evento.estado,evento.id_Categoria, categoria.nombre AS categoria_nombre 
FROM evento 
JOIN categoria ON evento.id_Categoria = categoria.id");
