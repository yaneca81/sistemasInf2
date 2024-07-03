<?php
session_start();
require '../includes/conexion.php'; 

if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit;
}
$username = $_SESSION['username'];

$sql = "SELECT Usuario.ID_Usuario, Usuario.Nombre, Usuario.Apellido, Usuario.Email, Usuario.Username, Rol.Nombre AS RolNombre
        FROM Usuario
        INNER JOIN Rol ON Usuario.ID_Rol = Rol.ID_Rol";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Administración | Usuarios</title>
    <style>
        .action-links {
            display: flex;
            gap: 10px;
            justify-content: flex-start;
        }
    </style>
</head>
<body>
    <div class="container">
        <aside>
            <div class="toggle">
                <div class="logo">
                    <img src="/iniciosesión1/img/registro.png" width="50">
                    <h2>Panel<span class="danger">Admin</span></h2>
                </div>
                <div class="close" id="close-btn">
                    <span class="material-icons-sharp">
                        close
                    </span>
                </div>
            </div>

            <div class="sidebar">
                <a href="./principal.php">
                    <span class="material-icons-sharp">
                        dashboard
                    </span>
                    <h3>Inicio</h3>
                </a>
                <a href="usuarios.php">
                    <span class="material-icons-sharp">
                        person_outline
                    </span>
                    <h3>Usuarios</h3>
                </a>
                <a href="./roles.php">
                    <span class="material-icons-sharp">
                        inventory
                    </span>
                    <h3>Roles</h3>
                    <span class="message-count">3</span>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">
                        settings
                    </span>
                    <h3>Configuración</h3>
                </a>
                <a href="../index.php">
                    <span class="material-icons-sharp">
                        logout
                    </span>
                    <h3>Salir</h3>
                </a>
            </div>
        </aside>
        <main>
            <div class="recent-orders">
                <h2>Usuarios</h2>
                <table>
                    <thead>
                        <tr>
                        <td style="text-align: left;">Rol</td>
                        <td style="text-align: left;">Nombre</td>
                        <td style="text-align: left;">Apellido</td>
                        <td style="text-align: left;">Email</td>
                        <td style="text-align: left;">Usuario</td>
                        <td style="text-align: center;">Acciones</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td style='text-align: left;'>" . htmlspecialchars($row['RolNombre']) . "</td>";
                                echo "<td style='text-align: left;'>" . htmlspecialchars($row['Nombre']) . "</td>";
                                echo "<td style='text-align: left;'>" . htmlspecialchars($row['Apellido']) . "</td>";
                                echo "<td style='text-align: left;'>" . htmlspecialchars($row['Email']) . "</td>";
                                echo "<td style='text-align: left;'>" . htmlspecialchars($row['Username']) . "</td>";
                                echo "<td style='text-align: left;'>";
                                echo "<div class='action-links'>";
                                echo "<a href='usuario_editar.php?id=" . $row['ID_Usuario'] . "'>Editar</a>";
                                echo "<a href='usuario_eliminar.php?id=" . $row['ID_Usuario'] . "' class='btn btn-danger'>Eliminar</a>";
                                echo "</div>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6' style='text-align: center;'>Aún no existen registros en la Base de Datos.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <a href="usuario_agregar.php">Registrar Usuario</a>
            </div>
        </main>
    </div>
    <script>
        function showAlert(message) 
        {
            if (message.trim() !== "") {
                alert(message);
            }
        }
        showAlert("<?php echo htmlspecialchars($message); ?>");
    </script>
    <script src="./js/index.js"></script>
</body>
</html>
<?php
$conn->close();
?>