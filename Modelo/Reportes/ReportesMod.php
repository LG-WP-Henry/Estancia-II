<?php

class Conexion {
    public static function conectar() {
        $conn = new mysqli('localhost', 'root', '', 'Estanciaii');
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }
        return $conn;
    }
}

class ReportesModelo {
    // Obtiene el porcentaje de hombres y mujeres atendidos en la semana con detalles de fechas y psicólogos
    public function porcentajeGeneroSemana() {
        $sql = "SELECT 
                    paciente.sexo, 
                    COUNT(*) AS total, 
                    GROUP_CONCAT(DISTINCT DATE_FORMAT(citas.Fecha, '%Y-%m-%d') SEPARATOR ', ') AS Fechas, 
                    GROUP_CONCAT(DISTINCT CONCAT(psicologo.Nombre, ' ', psicologo.ApPaterno) SEPARATOR ', ') AS Psicologos 
                FROM citas 
                JOIN paciente ON citas.idPacienteCi = paciente.idPaciente
                JOIN psicologo ON citas.CedulaCita = psicologo.Cedula
                WHERE WEEK(citas.Fecha) = WEEK(NOW()) 
                GROUP BY paciente.sexo";
        return $this->ejecutarConsulta($sql);
    }

    // Obtiene el número de pacientes atendidos por cada psicólogo, tanto semanal como mensual, con detalles adicionales
    public function pacientesPorPsicologo($periodo) {
        $fechaFiltro = $periodo === 'semanal' ? "WEEK(citas.Fecha) = WEEK(NOW())" : "MONTH(citas.Fecha) = MONTH(NOW())";
        $sql = "SELECT 
                    psicologo.Nombre AS NombrePsicologo, 
                    psicologo.ApPaterno AS ApPaternoPsicologo, 
                    psicologo.ApMaterno AS ApMaternoPsicologo, 
                    COUNT(*) AS total, 
                    GROUP_CONCAT(DISTINCT CONCAT(paciente.Nombre, ' ', paciente.ApPaterno) SEPARATOR ', ') AS Pacientes 
                FROM citas 
                JOIN psicologo ON citas.CedulaCita = psicologo.Cedula
                JOIN paciente ON citas.idPacienteCi = paciente.idPaciente
                WHERE {$fechaFiltro} 
                GROUP BY citas.CedulaCita";
        return $this->ejecutarConsulta($sql);
    }

    // Obtiene la edad promedio de pacientes con el mayor puntaje, con detalles adicionales sobre actividades y observaciones
    public function edadPromedioPuntajeAlto() {
        $sql = "SELECT 
                    AVG(YEAR(CURDATE()) - YEAR(paciente.fechaNac)) AS edad_promedio, 
                    MAX(avances.Puntaje) AS PuntajeMaximo, 
                    GROUP_CONCAT(DISTINCT actividades.Actividad SEPARATOR ', ') AS Actividades, 
                    GROUP_CONCAT(DISTINCT avances.Observaciones SEPARATOR ', ') AS Observaciones 
                FROM avances 
                JOIN paciente ON avances.IdPacienteAv = paciente.idPaciente
                JOIN actividades ON avances.Actividad = actividades.idActividades
                WHERE avances.Puntaje = (SELECT MAX(Puntaje) FROM avances)";
        return $this->ejecutarConsulta($sql);
    }

    // Obtiene los pacientes con mejor avance, con detalles de los psicólogos y observaciones
    public function pacientesConMejorAvance() {
        $sql = "SELECT 
                    paciente.Nombre, 
                    paciente.ApPaterno, 
                    paciente.ApMaterno, 
                    MIN(avances.Puntaje) AS puntaje, 
                    GROUP_CONCAT(DISTINCT CONCAT(psicologo.Nombre, ' ', psicologo.ApPaterno) SEPARATOR ', ') AS Psicologos, 
                    GROUP_CONCAT(DISTINCT avances.Observaciones SEPARATOR ', ') AS Observaciones 
                FROM avances 
                JOIN paciente ON avances.IdPacienteAv = paciente.idPaciente
                JOIN psicologo ON avances.CedulaAv = psicologo.Cedula
                GROUP BY avances.IdPacienteAv
                ORDER BY puntaje ASC 
                LIMIT 5";
        return $this->ejecutarConsulta($sql);
    }

    // Método para ejecutar las consultas SQL
    private function ejecutarConsulta($sql) {
        $conexion = Conexion::conectar();
        $resultado = $conexion->query($sql);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }
}
?>
