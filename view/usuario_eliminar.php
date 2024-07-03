<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit;
}

// Incluir el archivo de conexión a la base de datos
require '../includes/conexion.php';
if (isset($_POST['accion']) && $_POST['accion'] == 'eliminar_usuario') {
    $id_usuario = $_POST['id'];
    $sql = "DELETE FROM Usuario WHERE ID_Usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_usuario);

    if ($stmt->execute()) 
    {
        $success_message = "Usuario eliminado exitosamente.";
    } 
    else 
    {
        $error_message = "Error al eliminar usuario: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
    header('Location: ../view/usuarios.php?msg=' . urlencode($success_message));
    exit;
}

if (isset($_GET['id'])) 
{
    $id_usuario = $_GET['id'];

    $sql = "SELECT Nombre, Apellido FROM Usuario WHERE ID_Usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $stmt->bind_result($Nombre, $Apellido);
    $stmt->fetch();
    $stmt->close();
} 
else 
{
    header('Location: ../view/usuarios.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-6 offset-sm-3">
                <div class="alert alert-danger text-center">
                    <p>¿Desea confirmar la eliminación del usuario <?php echo htmlspecialchars($Nombre . ' ' . $Apellido); ?>?</p>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <form action="usuario_eliminar.php" method="POST">
                            <input type="hidden" name="accion" value="eliminar_usuario">
                            <input type="hidden" name="id" value="<?php echo $id_usuario; ?>">
                            <input type="submit" value="Eliminar" class="btn btn-success">
                            <a href="../view/usuarios.php" class="btn btn-danger">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
