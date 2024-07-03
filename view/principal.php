<?php
session_start();
// Verificar si el usuario está autenticado, de lo contrario redirigir al inicio de sesión
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit;
}
$username = $_SESSION['username'];

// Configuración de conexión a la base de datos 
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "BaseDatos";

// Crear conexión
$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para obtener usuarios y sus roles
$sql = "SELECT Usuario.Nombre, Usuario.Apellido, Usuario.Email, Usuario.Username, Rol.Nombre AS RolNombre
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
    <title>Administración | Panel</title>
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

        <main>
            <h1>Resumen</h1>
            <div class="analyse">
                <div class="sales">
                    <div class="status">
                        <div class="info">
                        <a href="servicio.php">
                            <h3>Rendimiento</h3>
                            <h1>65,00</h1>
                        </a>
                        </div>
                        <div class="progresss">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="percentage">
                                <p>+81%</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="visits">
                    <div class="status">
                        <div class="info">
                        <a href="reserva.php">
                            <h3>Usuarios</h3>
                            <h1>20</h1>
                        </a>
                        </div>
                        <div class="progresss">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="percentage">
                                <p>+ 48%</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="searches">
                    <div class="status">
                        <div class="info">
                        <a href="cliente.php">    
                            <h3>Roles</h3>
                            <h1>2</h1>
                        </a>
                        </div>
                        <div class="progresss">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="percentage">
                                <p>+21%</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="new-users">
                <h2>Usuarios Nuevos</h2>
                <div class="user-list">
                    <div class="user">
                        <img src="/iniciosesión1/img/profile-2.jpg">
                        <h2>Jack</h2>
                        <p>Hace 34min</p>
                    </div>
                    <div class="user">
                        <img src="/iniciosesión1/img/profile-3.jpg">
                        <h2>Amir</h2>
                        <p>Hace 3 Horas</p>
                    </div>
                    <div class="user">
                        <img src="/iniciosesión1/img/profile-4.jpg">
                        <h2>Ember</h2>
                        <p>sHace 6 Hora</p>
                    </div>
                    <div class="user">
                        <img src="/iniciosesión1/img/plus.png">
                        <h2>Más</h2>
                        <a href="cliente_agregar.php"><p>Nuevo Usuario</p></a>
                    </div>
                </div>
            </div>

            <div class="recent-orders">
                <h2>Usuarios Recientes</h2>
                <table>
                    <thead>
                        <tr>
                        <td style="text-align: left;">Rol</td>
                        <td style="text-align: left;">Nombre</td>
                        <td style="text-align: left;">Apellido</td>
                        <td style="text-align: left;">Email</td>
                        <td style="text-align: left;">Usuario</td>
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
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5' style='text-align: center;'>Aún no existen registros en la Base de Datos.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <a href="usuarios.php">Ver Más</a>
            </div>
        </main>

        <div class="right-section">
            <div class="nav">
                <button id="menu-btn">
                    <span class="material-icons-sharp">
                        menu
                    </span>
                </button>
                <div class="dark-mode">
                    <span class="material-icons-sharp active">
                        light_mode
                    </span>
                    <span class="material-icons-sharp">
                        dark_mode
                    </span>
                </div>

                <div class="profile">
                    <div class="info">
                        <p>Hey, <b><span class="title_usuario"><?php echo htmlspecialchars($username); ?></span></b></p>
                        <small class="text-muted"><?php echo htmlspecialchars($username); ?></small>
                    </div>
                    <div class="profile-photo">
                        <img src="/iniciosesión1/img/usuario.png">
                    </div>
                </div>

            </div>
            <div class="user-profile">
                <div class="logo">
                    <img src="/iniciosesión1/img/LogoPrincipal.png" style="width: 200px;">
                    <h2>Bienvenido</h2>
                    <p>Administración Personal</p>
                </div>
            </div>
            <div class="reminders">
                <div class="header">
                    <h2>Recordatorios</h2>
                    <span class="material-icons-sharp">
                        notifications_none
                    </span>
                </div>
                <div class="notification">
                    <div class="icon">
                        <span class="material-icons-sharp">
                            volume_up
                        </span>
                    </div>
                    <div class="content">
                        <div class="info">
                            <h3>Taller</h3>
                            <small class="text_muted">
                                08:00 AM - 12:00 PM
                            </small>
                        </div>
                        <span class="material-icons-sharp">
                            more_vert
                        </span>
                    </div>
                </div>
                <div class="notification deactive">
                    <div class="icon">
                        <span class="material-icons-sharp">
                            edit
                        </span>
                    </div>
                    <div class="content">
                        <div class="info">
                            <h3>Taller</h3>
                            <small class="text_muted">
                                08:00 AM - 12:00 PM
                            </small>
                        </div>
                        <span class="material-icons-sharp">
                            more_vert
                        </span>
                    </div>
                </div>
                <div class="notification add-reminder">
                    <div>
                        <span class="material-icons-sharp">
                            add
                        </span>
                        <h3>Agregar Recordatorio</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/iniciosesión1/assets/js/index.js"></script>
</body>
</html>