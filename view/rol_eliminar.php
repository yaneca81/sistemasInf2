<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit;
}

// Incluir el archivo de conexión a la base de datos
require '../includes/conexion.php';

if (isset($_POST['accion']) && $_POST['accion'] == 'eliminar_rol') 
{
    $id_rol = $_POST['id']; 
    $sql = "DELETE FROM Rol WHERE ID_Rol = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_rol);

    if ($stmt->execute()) 
    {
        $success_message = "Rol eliminado exitosamente.";
    } 
    else 
    {
        $error_message = "Error al eliminar el rol: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
    header('Location: ../view/roles.php?msg=' . urlencode($success_message));
    exit;
}

if (isset($_GET['id'])) 
{
    $id_rol = $_GET['id']; // Cambiado a 'id' en lugar de 'id_usuario'

    $sql = "SELECT Nombre, Descripcion FROM Rol WHERE ID_Rol = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_rol);
    $stmt->execute();
    $stmt->bind_result($Nombre, $Descripcion);
    $stmt->fetch();
    $stmt->close();
} 
else 
{
    header('Location: ../view/roles.php?msg=' . urlencode($success_message));
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Rol</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-6 offset-sm-3">
                <div class="alert alert-danger text-center">
                    <p>¿Desea confirmar la eliminación del rol <?php echo htmlspecialchars($Nombre); ?>?</p>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <form action="rol_eliminar.php" method="POST">
                            <input type="hidden" name="accion" value="eliminar_rol">
                            <input type="hidden" name="id" value="<?php echo $id_rol; ?>">
                            <input type="submit" value="Eliminar" class="btn btn-success">
                            <a href="../view/roles.php" class="btn btn-danger">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>