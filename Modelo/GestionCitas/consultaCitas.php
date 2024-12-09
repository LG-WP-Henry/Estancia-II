<?php
require '../BD/bd.php';

class ModeloCitas {
    private $conn;
    

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function obtenerCitasFuturas($idPaciente) {
        $query = "SELECT fecha, psicologo.Nombre, psicologo.ApPaterno 
                FROM citas 
                INNER JOIN psicologo ON citas.CedulaCita = psicologo.Cedula 
                WHERE idPacienteCi = $idPaciente AND fecha > NOW()
                ORDER BY fecha ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $idPaciente);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function obtenerCitasVencidas($idPaciente) {
        $query = "SELECT fecha, psicologo.Nombre, psicologo.ApPaterno 
                FROM citas 
                INNER JOIN psicologo ON citas.CedulaCita = psicologo.Cedula 
                WHERE idPacienteCi = $idPaciente AND fecha <= NOW()
                ORDER BY fecha DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $idPaciente);
        $stmt->execute();
        return $stmt->get_result();
    }
}
