<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Paciente') {
    header("Location: login.php");
    exit();
}

include '../BD/bd.php';
include '../../Vista/includes/headerPac.php';


$username = $_SESSION['username'];
$sql = "SELECT id_usuario FROM credenciales WHERE usuario = '$username';";
$result = mysqli_query($conn, $sql);
$paciente = mysqli_fetch_assoc($result);
$idPaciente = $paciente['id_usuario'];

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$total = 0;
$updates = [];

foreach ($_POST as $key => $value) {
    if (strpos($key, 'respuesta_') !== false) {
        $total += intval($value);
        // Obtener el idPregunta de la clave
        $idPregunta = str_replace('respuesta_', '', $key);
        $updates[] = $idPregunta;
    }
}

// Actualizar la base de datos para marcar las preguntas como realizadas
foreach ($updates as $idPregunta) {
    $sql = "UPDATE test SET realizado = 1 WHERE idPreguntaTst = $idPregunta AND idPacienteTst = $idPaciente";
    $conn->query($sql);
}

echo "El total de las respuestas es: " . $total;

$conn->close();
?>
