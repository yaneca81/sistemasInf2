<!DOCTYPE html>
<html lang="en">
<?php require '../includes/conexion.php'; ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Rol</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/roles.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5">
                <form action="../includes/_functions.php" method="POST">
                    <div class="user-profile">
                        <img src="/iniciosesión1/img/rol.png" alt="perfil" width="40">
                        <h2>Registrar Rol</h2>
                    </div>
                    <div class="mb-3">
                        <label for="Nombre" class="form-label">Nombre del Rol:</label>
                        <input type="text" id="Nombre" name="Nombre" class="form-control form-control-lg" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="Descripcion" class="form-label">Descripción:</label>
                        <input type="text" id="Descripcion" name="Descripcion" class="form-control form-control-lg" required autocomplete="off">
                    </div>
                    <input type="hidden" name="accion" value="insertar_rol">
                    <div class="btn-container">
                        <button type="submit" class="btn btn-primary btn-lg">Guardar</button>
                        <a href="roles.php" class="btn btn-secondary btn-lg ms-2">Atrás</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
