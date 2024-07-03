<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/index.css">
    <title>Documento</title>
    <style>
        body {
            /* Configuración de la imagen de fondo */
            background-image: url('./imagen/login.jpg');
            background-size: cover; /* Ajusta el tamaño de la imagen para cubrir todo el cuerpo */
            background-position: center; /* Centra la imagen horizontal y verticalmente */
            background-repeat: no-repeat; /* Evita que la imagen se repita */
            /* Otros estilos opcionales */
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0; /* Elimina el margen predeterminado del cuerpo */
            padding: 0; /* Elimina el relleno predeterminado del cuerpo */
        }

        /* Estilos adicionales para el contenido de la página */
        .content {
            padding: 20px; /* Añade un relleno al contenido para separarlo del borde del cuerpo */
            background-color: rgba(255, 255, 255, 0.8); /* Fondo semi-transparente para el contenido */
        }
        body {
            min-height: 100vh;
            display: grid;
            place-items: center;
        }
    </style>
</head>

<body>
    <div>
        <center>
            <h3  style="border:blue 5px solid;" class="color">Inicio de Seción</h3>
        </center>

        <div class="form-container w3-card-4 fondo1" align="center">
            <form onsubmit="onLogin(event)">
                <label for="correo" class="letra1 w3-animate-left">Correo Electrónico</label>
                <input type="text" class="letra1" id="correo" name="correo" placeholder="Correo Electrónico">
                <label for="contraseña" class="letra1 w3-animate-right">Contraseña</label>
                <input type="password" class="letra1" id="contraseña" name="contraseña" placeholder="Contraseña">
                <br>
                <br>
                <input type="submit" class="button button2 letra1" value="Ingresar">
                
                <p id="error"></p>
            </form>
            <a href="index.php" class="button button2 letra1"> Volver</a>
        </div>
        
    </div>
    

    <script>

        const onLogin = (e) => {
            e.preventDefault();
            const correoInput = document.getElementById("correo");
            const contraseñaInput = document.getElementById("contraseña");
            const errorMessage = document.getElementById("error");
            errorMessage.classList.add("error-message");

            if (correoInput.value === "usuario" && contraseñaInput.value === "usuario") {
                // Redireccionar a la página después del login exitoso
                window.location.href = "user.php";
            } else {
                errorMessage.textContent = "Usuario o contraseña incorrectos";

            }
        }

    </script>
</body>

</html>
