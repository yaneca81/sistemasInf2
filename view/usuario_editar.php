<!DOCTYPE html>
<html lang="en">
<?php require '../includes/conexion.php'; ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/estilo_usuario.css">
</head>
<body>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-10 mt-4">
        <form action="../includes/_functions.php" method="POST">
            <div class="user-profile">
                <img src="/iniciosesión1/img/editar.png" alt="perfil" width="40">
                <h2>Editar Usuario</h2>
            </div>
            <?php
            if (isset($_GET['id'])) 
            {
                $id_usuario = $_GET['id'];

                $sql = "SELECT ID_Rol, Nombre, Apellido, Email, Username FROM usuario WHERE ID_Usuario = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id_usuario);
                $stmt->execute();
                $stmt->bind_result($ID_Rol, $Nombre, $Apellido, $Email, $Username);
                $stmt->fetch();
                $stmt->close();
            } 
            else 
            {
                echo "No se proporcionó un ID de usuario válido.";
                exit;
            }
            ?>
            <div class="mb-2">
                <label for="id_rol" class="form-label">Rol:</label>
                <select id="id_rol" name="ID_Rol" class="form-control form-control-sm">
                    <?php
                    $sql_roles = "SELECT ID_Rol, Nombre FROM Rol";
                    $result_roles = $conn->query($sql_roles);

                    if ($result_roles->num_rows > 0) 
                    {
                        while($row = $result_roles->fetch_assoc()) 
                        {
                            $selected = ($row['ID_Rol'] == $ID_Rol) ? 'selected' : '';
                            echo '<option value="'.$row['ID_Rol'].'" '.$selected.'>'.$row['Nombre'].'</option>';
                        }
                    } 
                    else 
                    {
                        echo '<option value="">No hay roles disponibles</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="mb-2">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" id="Nombre" name="Nombre" class="form-control form-control-sm" value="<?php echo $Nombre; ?>" required>
            </div>
            <div class="mb-2">
                <label for="apellido" class="form-label">Apellido:</label>
                <input type="text" id="Apellido" name="Apellido" class="form-control form-control-sm" value="<?php echo $Apellido; ?>" required>
            </div>
            <div class="mb-2">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="Email" name="Email" class="form-control form-control-sm" value="<?php echo $Email; ?>" required>
            </div>
            <div class="mb-2">
                <label for="username" class="form-label">Usuario:</label>
                <input type="text" id="Username" name="Username" class="form-control form-control-sm" value="<?php echo $Username; ?>" required>
            </div>
            <div class="mb-2">
                <label for="password" class="form-label">Nueva Contraseña:</label>
                <input type="password" id="Password" name="Password" class="form-control form-control-sm" placeholder="Dejar en blanco para no cambiar">
            </div>
            <input type="hidden" name="ID_Usuario" value="<?php echo $id_usuario; ?>">
            <input type="hidden" name="accion" value="actualizar_usuario">
            <div class="btn-container">
                <button type="submit" class="btn btn-primary btn-sm">Guardar Cambios</button>
                <a href="usuarios.php" class="btn btn-secondary btn-sm">Cancelar</a>
            </div>
        </form>
        </div>
    </div>
</div>
</body>
</html>