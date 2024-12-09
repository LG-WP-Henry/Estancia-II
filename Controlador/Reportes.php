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
        $dompdf = new Dompdf();
        $html = "<h1>{$titulo}</h1>";
        $html .= "<table border='1' style='width: 100%; border-collapse: collapse;'>";
        foreach ($datos as $fila) {
            $html .= "<tr>";
            foreach ($fila as $valor) {
                $html .= "<td style='padding: 8px; text-align: center;'>{$valor}</td>";
            }
            $html .= "</tr>";
        }
        $html .= "</table>";

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("reporte.pdf", ["Attachment" => true]);
    }
}

// Instancia del controlador y generación del reporte
$tipo = $_GET['tipo'] ?? 'hombres_mujeres';
$reporteController = new ReportesController();
$reporteController->generarReporte($tipo);
?>
