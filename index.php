<?php
session_start();
require './includes/conexion.php';

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['userName']);
    $email = trim($_POST['userEmail']);
    $password = trim($_POST['userPassword']);

    if (empty($username) || empty($email) || empty($password)) {
        $error = 'Todos los campos son obligatorios';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'El formato del correo electrónico es inválido';
    } else {
        $sql = "SELECT * FROM Usuario WHERE username = '$username' AND email = '$email' AND password = '$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $_SESSION['username'] = $username;  
            header('Location: ./view/principal.php');
            exit;
        } else {
            $error = 'Usuario, correo electrónico o contraseña incorrectos';
        }
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <title>Inicio de Sesión | Admin</title>
</head>
<body>
    <div class="container-form register">
        <div class="information">
            <div class="info-childs">
                <h2>¡¡Bienvenido nuevamente!!</h2>
                <p>Para unirte a nuestra comunidad, por favor inicia sesión con tus credenciales de administrador.</p>
            </div>
        </div>
        <div class="form-information">
            <div class="form-information-childs">
                <h2>Iniciar Sesión</h2>
                <div class="icons">
                    <i class='bx bxl-google'></i>
                    <i class='bx bxl-github'></i>
                    <i class='bx bxl-linkedin'></i>
                </div>
                <p>Este inicio de sesión es exclusivo </p>
                <p>para administradores.</p>
                <?php if (!empty($error)): ?>
                    <script>alert('<?php echo $error; ?>');</script>
                <?php endif; ?>
                <form class="form form-login" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" novalidate onsubmit="return validateForm()">
                    <div>
                        <label>
                            <i class='bx bx-user'></i>
                            <input type="text" id="userName" placeholder="Nombre Usuario" name="userName" value="<?php echo htmlspecialchars($username ?? ''); ?>">
                        </label>
                    </div>
                    <div>
                        <label>
                            <i class='bx bx-envelope'></i>
                            <input type="email" id="userEmail" placeholder="Correo Electrónico" name="userEmail" value="<?php echo htmlspecialchars($email ?? ''); ?>">
                        </label>
                    </div>
                    <div>
                        <label>
                            <i class='bx bx-lock-alt'></i>
                            <input type="password" id="userPassword" placeholder="Contraseña" name="userPassword">
                        </label>
                    </div>
                    <input type="submit" value="Iniciar Sesión">
                </form>
            </div>
        </div>
    </div>
    <script>
    function validateForm() {
        var userName = document.getElementById('userName').value.trim();
        var userEmail = document.getElementById('userEmail').value.trim();
        var userPassword = document.getElementById('userPassword').value.trim();

        if (!userName) {
            alert('El nombre de usuario es obligatorio');
            return false;
        }
        if (!userEmail) {
            alert('El correo electrónico es obligatorio');
            return false;
        }
        if (!userPassword) {
            alert('La contraseña es obligatoria');
            return false;
        }
        if (!validateEmail(userEmail)) {
            alert('El formato del correo electrónico es inválido');
            return false;
        }
        return true;
    }

    function validateEmail(email) {
        var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
    </script>
</body>
</html>
