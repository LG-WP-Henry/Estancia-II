<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

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
        echo "<script>alert('Cita agregada correctamente');window.location.href='../../Controlador/redireccion.php';</script>";
    } else {
        echo "<script>alert('Cita agregada correctamente');window.location.href='../../Controlador/redireccion.php';</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Método de solicitud no válido.";
}
?>
