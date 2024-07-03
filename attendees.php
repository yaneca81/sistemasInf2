<?php
include 'db.php';

$event_id = $_GET['event_id'];
$result = $conn->query("SELECT * FROM registrations WHERE event_id = $event_id");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Asistentes</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-info text-white">
            <h2>Lista de Asistentes</h2>
        </div>
        <ul class="list-group list-group-flush">
            <?php while($row = $result->fetch_assoc()): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <h5><?php echo $row['user_name']; ?></h5>
                        <p class="mb-1"><?php echo $row['email']; ?></p>
                        <small><?php echo $row['registration_date']; ?></small>
                    </div>
                    <a href="cancel.php?id=<?php echo $row['id']; ?>&event_id=<?php echo $event_id; ?>" class="btn btn-danger btn-sm">Cancelar Inscripción</a>
                </li>
            <?php endwhile; ?>
        </ul>
        <div class="card-body">
            <a href="index.php" class="btn btn-secondary">Volver</a>
        </div>
    </div>
</div>
</body>
</html>
