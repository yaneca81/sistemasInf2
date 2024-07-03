<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit;
}
$username = $_SESSION['username'];
require '../includes/conexion.php';
$message = "";

if (isset($_GET['msg'])) 
{
    $message = $_GET['msg'];
}

// Consulta SQL para obtener usuarios y sus roles
$sql = "SELECT Rol.ID_Rol, Rol.Nombre, Rol.Descripcion FROM Rol";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Administración | Roles</title>
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
        <!-- Sidebar Section -->
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
        <!-- End of Sidebar Section -->
        <!-- Main Content -->
        <main>
            <div class="recent-orders">
                <h2>Roles Disponibles</h2>
                <table>
                    <thead>
                        <tr>
                            <td style="text-align: left;">Rol</td>
                            <td style="text-align: left;">Descripción</td>
                            <td style="text-align: center;">Acciones</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td style='text-align: left;'>" . htmlspecialchars($row['Nombre']) . "</td>";
                                echo "<td style='text-align: left;'>" . htmlspecialchars($row['Descripcion']) . "</td>";
                                echo "<td style='text-align: left;'>";
                                echo "<div class='action-links'>";
                                echo "<a href='rol_editar.php?id=" . $row['ID_Rol'] . "'>Editar</a>";
                                echo "<a href='rol_eliminar.php?id=" . $row['ID_Rol'] . "' class='btn btn-danger'>Eliminar</a>";
                                echo "</div>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3' style='text-align: center;'>Aún no existen registros en la Base de Datos.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <a href="rol_agregar.php">Registrar Rol Nuevo</a>
            </div>
            <!-- End of Recent Orders -->
        </main>
    </div>
    <?php if (!empty($message)) : ?>
                    <script>
                        function showAlert(message) {
                            if (message.trim() !== "") {
                                alert(message);
                            }
                        }
                        showAlert("<?php echo htmlspecialchars($message); ?>");
                    </script>
                <?php endif; ?>
    <script src="./js/index.js"></script>
</body>
</html>
