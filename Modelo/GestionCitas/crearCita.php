<?php
require '../../Modelo/BD/bd.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fecha = $_POST['fecha'];
    $idPaciente = $_POST['idPaciente'];
    $CedulaCita = $_POST['CedulaCita'];

    // Prepara la sentencia SQL
    $sql = "INSERT INTO citas (Fecha, idPacienteCi, CedulaCita) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sii", $fecha, $idPaciente, $CedulaCita);

    // Ejecuta la consulta y verifica errores
    if ($stmt->execute()) {
        echo "<script>alert('Cita agregada correctamente');window.location.href='../../indexPaciente.php';</script>";
    } else {
        echo "<script>alert('Cita agregada correctamente');window.location.href='../../indexPaciente.php';</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Método de solicitud no válido.";
}
?>
