<?php
include 'db.php';

$result = $conn->query("SELECT * FROM events");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestor de Eventos</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container mt-5">
    <div class="jumbotron text-center bg-primary text-white">
        <h1 class="display-4">Gestor de Eventos</h1>
        <p class="lead">Inscríbete en los eventos disponibles y gestiona tu participación</p>
    </div>
    <div class="card">
        <div class="card-header bg-secondary text-white">
            <h2>Eventos Disponibles</h2>
        </div>
        <ul class="list-group list-group-flush">
            <?php while($row = $result->fetch_assoc()): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <h5><?php echo $row['name']; ?></h5>
                        <p class="mb-1"><?php echo $row['description']; ?></p>
                        <small><?php echo $row['date']; ?></small>
                    </div>
                    <div>
                        <a href="register.php?event_id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm">Inscribirse</a>
                        <a href="attendees.php?event_id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">Ver Asistentes</a>
                    </div>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
</div>
</body>
</html>
