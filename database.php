<?php
// database.php
class Database {
    private $pdo;

    public function __construct() {
        $this->pdo = new PDO('sqlite:asistencias.db');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->createOrUpdateTable();
    }

    private function createOrUpdateTable() {
        // Verificar si la tabla existe
        $result = $this->pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name='asistencias'");
        if ($result->fetch()) {
            // Si la tabla existe, añadir las columnas necesarias si no están presentes
            $columns = $this->pdo->query("PRAGMA table_info(asistencias)")->fetchAll(PDO::FETCH_ASSOC);
            $columnNames = array_column($columns, 'name');

            if (!in_array('apellido', $columnNames)) {
                $this->pdo->exec("ALTER TABLE asistencias ADD COLUMN apellido TEXT");
            }
            if (!in_array('fecha', $columnNames)) {
                $this->pdo->exec("ALTER TABLE asistencias ADD COLUMN fecha DATE");
            }
            if (!in_array('tipo', $columnNames)) {
                $this->pdo->exec("ALTER TABLE asistencias ADD COLUMN tipo TEXT");
            }
        } else {
            // Si la tabla no existe, crearla
            $this->pdo->exec("CREATE TABLE IF NOT EXISTS asistencias (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                nombre TEXT NOT NULL,
                apellido TEXT NOT NULL,
                fecha DATE NOT NULL,
                tipo TEXT NOT NULL,
                asistencia INTEGER NOT NULL DEFAULT 0
            )");
        }
    }

    public function addAsistencia($nombre, $apellido, $fecha, $tipo, $asistencia) {
        $stmt = $this->pdo->prepare("INSERT INTO asistencias (nombre, apellido, fecha, tipo, asistencia) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$nombre, $apellido, $fecha, $tipo, $asistencia]);
    }

    public function getAsistencias() {
        $stmt = $this->pdo->query("SELECT * FROM asistencias");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateAsistencia($id, $nombre, $apellido, $fecha, $tipo, $asistencia) {
        $stmt = $this->pdo->prepare("UPDATE asistencias SET nombre = ?, apellido = ?, fecha = ?, tipo = ?, asistencia = ? WHERE id = ?");
        $stmt->execute([$nombre, $apellido, $fecha, $tipo, $asistencia, $id]);
    }

    public function deleteAsistencia($id) {
        $stmt = $this->pdo->prepare("DELETE FROM asistencias WHERE id = ?");
        $stmt->execute([$id]);
    }
}
?>

