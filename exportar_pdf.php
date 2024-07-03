<?php
require('libs/fpdf.php');
require 'database.php';

class PDF extends FPDF {
    // Cabecera de página
    function Header() {
        // Título
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Reporte de Asistencias', 0, 1, 'C');
    }

    // Pie de página
    function Footer() {
        // Pie de página
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    // Tabla básica
    function BasicTable($header, $data) {
        // Cabecera
        $this->SetFont('Arial', 'B', 10);
        foreach ($header as $col) {
            $this->Cell(40, 7, $col, 1);
        }
        $this->Ln();
        // Datos
        $this->SetFont('Arial', '', 10);
        foreach ($data as $row) {
            $this->Cell(40, 6, $row['nombre'], 1);
            $this->Cell(40, 6, $row['apellido'], 1);
            $this->Cell(40, 6, $row['fecha'], 1);
            $this->Cell(40, 6, $row['tipo'], 1);
            $this->Cell(40, 6, $row['asistencia'] ? 'Presente' : 'Falta', 1);
            $this->Ln();
        }
    }
}

// Capturar el contenido de salida en el buffer
ob_start();

// Crear instancia de la base de datos y obtener los datos de asistencias
$db = new Database();
$asistencias = $db->getAsistencias();

// Crear PDF
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

// Definir cabecera de la tabla
$header = array('Nombre', 'Apellido', 'Fecha', 'Tipo', 'Asistencia');

// Generar tabla básica con los datos
$pdf->BasicTable($header, $asistencias);

// Limpiar el buffer y enviar el PDF al navegador
ob_end_clean();
$pdf->Output('reporte_asistencias.pdf', 'D');
?>
