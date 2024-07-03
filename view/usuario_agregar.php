<!DOCTYPE html>
<html lang="en">
<?php require '../includes/conexion.php' ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/estilo_usuario.css">
    <script>
        function validateForm() {
            var nombre = document.getElementById('Nombre').value;
            var apellido = document.getElementById('Apellido').value;
            var email = document.getElementById('Email').value;
            var username = document.getElementById('Username').value;
            var password = document.getElementById('Password').value;

            if (nombre == "" || apellido == "" || email == "" || username == "" || password == "") {
                alert("Todos los campos son obligatorios.");
                return false;
            }

            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (!emailPattern.test(email)) {
                alert("Por favor, introduce un email válido.");
                return false;
            }

            if (password.length < 6) {
                alert("La contraseña debe tener al menos 6 caracteres.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-10 mt-4">
        <form action="../includes/_functions.php" method="POST">
            <div class="user-profile">
                <img src="/iniciosesión1/img/usuario2.png" alt="perfil" width="40">
                <h2>Registrar Usuario</h2>
            </div>
            <div class="mb-2">
                <label for="id_rol" class="form-label">Rol:</label>
                <select id="id_rol" name="ID_Rol" class="form-control form-control-sm">
                    <?php
                    // Consulta para obtener los roles
                    $sql = "SELECT ID_Rol, Nombre FROM Rol";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) 
                    {
                        while($row = $result->fetch_assoc()) 
                        {
                            echo '<option value="'.$row['ID_Rol'].'">'.$row['Nombre'].'</option>';
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
                <input type="text" id="Nombre" name="Nombre" class="form-control form-control-sm" required autocomplete="off">
            </div>
            <div class="mb-2">
                <label for="apellido" class="form-label">Apellido:</label>
                <input type="text" id="Apellido" name="Apellido" class="form-control form-control-sm" required autocomplete="off">
            </div>
            <div class="mb-2">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="Email" name="Email" class="form-control form-control-sm" required autocomplete="off">
            </div>
            <div class="mb-2">
                <label for="username" class="form-label">Usuario:</label>
                <input type="text" id="Username" name="Username" class="form-control form-control-sm" required autocomplete="off">
            </div>
            <div class="mb-2">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" id="Password" name="Password" class="form-control form-control-sm" required autocomplete="off">
            </div>
            <input type="hidden" name="accion" value="insertar_usuario">
            <div class="btn-container">
                <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                <a href="usuarios.php" class="btn btn-secondary btn-sm">Atrás</a>
            </div>
        </form>
        </div>
    </div>
</div>
<script>
    // Deshabilitar el autocompletado
    document.getElementById('Username').setAttribute('autocomplete', 'off');
    document.getElementById('Password').setAttribute('autocomplete', 'off');
</script>
</body>
</html>
