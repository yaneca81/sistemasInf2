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


        $sql = $conexion->query(" insert into evento (nombre, tema, descripcion, fecha, ubicacion,estado, id_Categoria) values ('$nombre', '$tema', '$descripcion', '$fecha', '$ubicacion','Pendiente', $id_Categoria)");


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

// Editar un evento existente
if (isset($_POST['btneditar'])) {
    if (!empty($_POST["id"]) && !empty($_POST["nombre"]) && !empty($_POST["tema"]) && !empty($_POST["fecha"]) && !empty($_POST["ubicacion"]) && !empty($_POST["descripcion"]) && !empty($_POST["id_Categoria"])) {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $tema = $_POST['tema'];
        $fecha = $_POST['fecha'];
        $ubicacion = $_POST['ubicacion'];
        $id_Categoria = $_POST['id_Categoria'];
        $descripcion = $_POST['descripcion'];

        // Actualización del evento en la base de datos
        $sql = $conexion->query("UPDATE evento SET nombre='$nombre', tema='$tema', descripcion='$descripcion', fecha='$fecha', ubicacion='$ubicacion', id_Categoria=$id_Categoria WHERE id=$id");

        if ($sql) {
            echo '<div class="alert alert-success">Evento actualizado correctamente</div>';
            echo '<meta http-equiv="refresh" content="2;url=index.php">';
        } else {
            echo '<div class="alert alert-danger">Error al actualizar el evento</div>';
        }
    } else {
        echo '<div class="alert alert-danger">Alguno de los campos está vacío</div>';
    }
}


//Listar categoria

$categorias = $conexion->query("SELECT * FROM categoria");

// consulta SQL para incluir la unión con la tabla `categoria`
$listEvents = $conexion->query("SELECT evento.id, evento.nombre, evento.tema, evento.descripcion, evento.fecha, evento.ubicacion,evento.estado,evento.id_Categoria, categoria.nombre AS categoria_nombre 
FROM evento 
JOIN categoria ON evento.id_Categoria = categoria.id");
