<?php 
include 'includes/header.php'; 
include 'includes/conexion.php'; 

require 'database.php';
$db = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add'])) {
        $db->addAsistencia($_POST['nombre'], $_POST['apellido'], $_POST['fecha'], $_POST['tipo'], 1); // Asistencia por defecto es 1 (presente)
    } elseif (isset($_POST['update'])) {
        $db->updateAsistencia($_POST['id'], $_POST['nombre'], $_POST['apellido'], $_POST['fecha'], $_POST['tipo'], isset($_POST['asistencia']) ? 1 : 0);
    } elseif (isset($_POST['delete'])) {
        $db->deleteAsistencia($_POST['id']);
    }
}

$asistencias = $db->getAsistencias();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Asistencias</title>
    <style>
        body {
            background-image: url('./imagen/fond.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .content {
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }
    </style>
     
    <link rel="stylesheet" href="css/styles2.css">
</head>
<body>
    <h1 style="color:white">Reporte de Asistencias</h1>
    <form action="reporte_asistencias.php" method="post" class="boton2">
        <label for="nombre" style="color:white">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <label for="apellido" style="color:white">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required>
        <label for="fecha" style="color:white">Fecha:</label>
        <input type="date" id="fecha" name="fecha" required>
        <label for="tipo" style="color:white">Tipo:</label>
        <select id="tipo" name="tipo" required>
            <option value="Presente">Presente</option>
            <option value="Falta">Falta</option>
        </select>
        <input type="submit" name="add" value="Agregar" class="boton">
    </form>
    <table>
        <thead>
            <tr class="boton3">
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Fecha</th>
                <th>Tipo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($asistencias as $asistencia): ?>
                <tr class="boton3">
                    <form action="reporte_asistencias.php" method="post">
                        <td>
                            <input type="text" name="nombre" value="<?php echo htmlspecialchars($asistencia['nombre']); ?>" required>
                        </td>
                        <td>
                            <input type="text" name="apellido" value="<?php echo htmlspecialchars($asistencia['apellido']); ?>" required>
                        </td>
                        <td>
                            <input type="date" name="fecha" value="<?php echo htmlspecialchars($asistencia['fecha']); ?>" required>
                        </td>
                        <td>
                            <select name="tipo" required>
                                <option value="Presente" <?php if ($asistencia['tipo'] == 'Presente') echo 'selected'; ?>>Presente</option>
                                <option value="Falta" <?php if ($asistencia['tipo'] == 'Falta') echo 'selected'; ?>>Falta</option>
                            </select>
                        </td>
                        <td>
                            <input type="hidden" name="id" value="<?php echo $asistencia['id']; ?>">
                            <input type="submit" name="update" value="Editar">
                            <input type="submit" name="delete" value="Eliminar">
                        </td>
                    </form>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <form action="exportar_pdf.php" method="post">
        <input type="submit" value="Exportar a PDF" class="boton">
    </form>
</body>
</html>

<?php include 'includes/footer.php'; ?>


