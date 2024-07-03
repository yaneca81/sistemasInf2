<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit;
}
require '../includes/conexion.php';

if (isset($_GET['id'])) {
    $id_rol = $_GET['id'];

    $sql = "SELECT Nombre, Descripcion FROM Rol WHERE ID_Rol = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_rol);
    $stmt->execute();
    $stmt->bind_result($nombre, $descripcion);
    $stmt->fetch();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Rol</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/roles.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5">
                <form action="../includes/_functions.php" method="POST">
                    <div class="user-profile">
                        <img src="/iniciosesión1/img/rol.png" alt="perfil" width="40">
                        <h2>Editar Rol</h2>
                    </div>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre del Rol:</label>
                        <input type="text" id="Nombre" name="Nombre" class="form-control form-control-lg" value="<?php echo htmlspecialchars($nombre); ?>" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción:</label>
                        <input type="text" id="Descripcion" name="Descripcion" class="form-control form-control-lg" value="<?php echo htmlspecialchars($descripcion); ?>" required autocomplete="off">
                    </div>
                    <input type="hidden" name="ID_Rol" value="<?php echo $id_rol; ?>">
                    <input type="hidden" name="accion" value="actualizar_rol">
                    <div class="btn-container">
                        <button type="submit" class="btn btn-primary btn-lg">Actualizar</button>
                        <a href="roles.php" class="btn btn-secondary btn-lg ms-2">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
