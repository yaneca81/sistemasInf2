<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $event_id = $_POST['event_id'];
    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $registration_date = $_POST['registration_date'];
    $sql = "INSERT INTO registrations (event_id, user_name, email, registration_date) VALUES ('$event_id', '$user_name', '$email', '$registration_date')";
    $conn->query($sql);
    header("Location: index.php");
}

$event_id = $_GET['event_id'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inscribirse en Evento</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-success text-white">
            <h2>Inscribirse en Evento</h2>
        </div>
        <div class="card-body">
            <form method="post" action="">
                <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
                <div class="form-group">
                    <label for="user_name">Nombre:</label>
                    <input type="text" name="user_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="registration_date">Fecha de Inscripción:</label>
                    <input type="date" name="registration_date" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Inscribirse</button>
                <a href="index.php" class="btn btn-secondary">Volver</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>
