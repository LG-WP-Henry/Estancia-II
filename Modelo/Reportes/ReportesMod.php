
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
    public function porcentajeGeneroSemana() {
        $sql = "SELECT sexo, COUNT(*) AS total FROM citas 
                JOIN paciente ON citas.idPacienteCi = paciente.idPaciente
                WHERE WEEK(Fecha) = WEEK(NOW()) GROUP BY sexo";
        return $this->ejecutarConsulta($sql);
    }

    public function pacientesPorPsicologo($periodo) {
        $fechaFiltro = $periodo === 'semanal' ? "WEEK(Fecha) = WEEK(NOW())" : "MONTH(Fecha) = MONTH(NOW())";
        $sql = "SELECT psicologo.Nombre, psicologo.ApPaterno, COUNT(*) AS total 
                FROM citas 
                JOIN psicologo ON citas.CedulaCita = psicologo.Cedula
                WHERE {$fechaFiltro} GROUP BY CedulaCita";
        return $this->ejecutarConsulta($sql);
    }

    public function edadPromedioPuntajeAlto() {
        $sql = "SELECT AVG(YEAR(CURDATE()) - YEAR(paciente.fechaNac)) AS edad_promedio 
                FROM avances 
                JOIN paciente ON avances.IdPacienteAv = paciente.idPaciente
                WHERE avances.Puntaje = (SELECT MAX(Puntaje) FROM avances)";
        return $this->ejecutarConsulta($sql);
    }

    public function pacientesConMejorAvance() {
        $sql = "SELECT paciente.Nombre, paciente.ApPaterno, MIN(avances.Puntaje) AS puntaje 
                FROM avances 
                JOIN paciente ON avances.IdPacienteAv = paciente.idPaciente
                GROUP BY avances.IdPacienteAv
                ORDER BY puntaje ASC LIMIT 5";
        return $this->ejecutarConsulta($sql);
    }

    private function ejecutarConsulta($sql) {
        $conexion = Conexion::conectar();
        $resultado = $conexion->query($sql);
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }
}
?>
