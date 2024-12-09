<?php
require_once '../Modelo/Reportes/ReportesMod.php';
require_once 'dompdf/autoload.inc.php'; // Ruta de DomPDF

use Dompdf\Dompdf;

class ReportesController {
    public function generarReporte($tipo) {
        $modelo = new ReportesModelo();
        $datos = [];
        $titulo = "";

        switch ($tipo) {
            case 'hombres_mujeres':
                $datos = $modelo->porcentajeGeneroSemana();
                $titulo = "Porcentaje de Hombres y Mujeres Atendidos en la Semana";
                break;

            case 'psicologos_semanal':
                $datos = $modelo->pacientesPorPsicologo('semanal');
                $titulo = "Pacientes Atendidos por Psicólogo (Semanal)";
                break;

            case 'psicologos_mensual':
                $datos = $modelo->pacientesPorPsicologo('mensual');
                $titulo = "Pacientes Atendidos por Psicólogo (Mensual)";
                break;

            case 'edad_promedio':
                $datos = $modelo->edadPromedioPuntajeAlto();
                $titulo = "Edad Promedio de Pacientes con Mayor Puntaje";
                break;

            case 'mejor_avance':
                $datos = $modelo->pacientesConMejorAvance();
                $titulo = "Pacientes con Mejor Avance Según Puntaje";
                break;

            default:
                die("Tipo de reporte inválido.");
        }

        $this->crearPDF($titulo, $datos);
    }

    private function crearPDF($titulo, $datos) {
        if (empty($datos)) {
            die("No hay datos disponibles para generar el reporte.");
        }

        $dompdf = new Dompdf();

        // Crear el contenido HTML con el formato deseado
        $html = "
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }
    header {
        text-align: center;
        padding: 10px;
        background-color: #f0f4f8;
        border-bottom: 2px solid #0277bd;
    }
    header img {
        width: 70px;
        vertical-align: middle;
        margin-right: 15px;
    }
    header h1 {
        display: inline-block;
        font-size: 20px;
        margin: 0;
        color: #0277bd;
        vertical-align: middle;
    }
    h2 {
        text-align: center;
        margin-top: 20px;
        color: #424242;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    table, th, td {
        border: 1px solid #ddd;
    }
    th {
        background-color: #e3f2fd;
        color: #0277bd;
        padding: 10px;
        text-align: center;
    }
    td {
        padding: 8px;
        text-align: center;
    }
</style>
<header>
    <img src='http://localhost/EstanciaII.4/Vista/imagenes/logo.png' alt='Logo'>
    <h1>SADNA (Sistema de Apoyo para la Detección de Ansiedad)</h1>
</header>
<h2>{$titulo}</h2>
<table>";

// Crear encabezado de la tabla
$html .= "<thead><tr>";
foreach (array_keys($datos[0]) as $key) {
    $html .= "<th>" . htmlspecialchars($key) . "</th>";
}
$html .= "</tr></thead><tbody>";

// Crear filas de la tabla
foreach ($datos as $fila) {
    $html .= "<tr>";
    foreach ($fila as $valor) {
        $html .= "<td>" . htmlspecialchars($valor) . "</td>";
    }
    $html .= "</tr>";
}
$html .= "</tbody></table>";


        // Configurar y renderizar el PDF
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Descargar el PDF
        $dompdf->stream("reporte.pdf", ["Attachment" => true]);
    }
}

// Instancia del controlador y generación del reporte
$tipo = $_GET['tipo'] ?? 'hombres_mujeres';
$reporteController = new ReportesController();
$reporteController->generarReporte($tipo);
?>
