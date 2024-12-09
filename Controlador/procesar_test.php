<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Paciente') {
    header("Location: login.php");
    exit();
}

include '../Modelo/BD/bd.php';
//include '../Vista/includes/headerPac.php';


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

//echo "El total de las respuestas es: " . $total;

//Cedula del psicologo
$sql = "SELECT CedulaAvTst FROM test WHERE idPacienteTst = $idPaciente LIMIT 1";
$results = mysqli_query($conn, $sql); 
$cedulaPsicologo = mysqli_fetch_assoc($results)['CedulaAvTst'];


//verificar entradas del paciente en tabla avances
$sql = "SELECT * FROM avances WHERE IdPacienteAv = $idPaciente";
$resultss = mysqli_query($conn, $sql);

$insertado = false;

if (mysqli_num_rows($resultss) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        if (is_null($row['Puntaje'])) {
            $sql = "UPDATE avances SET Puntaje = $total WHERE IdAvance = " . $row['IdAvance'];
            $conn->query($sql);
            $insertado = true;
            break;
        }
    }
}

if (!$insertado) {
    $sql = "INSERT INTO avances (IdPacienteAv, CedulaAv, Puntaje) VALUES ($idPaciente, '$cedulaPsicologo', $total)";
    $conn->query($sql);
    echo "<script>alert('El test se contesto');window.location.href='../indexPaciente.php';</script>";

}else{
    echo "<script>alert('No fue posible');window.location.href='../includes/indexPaciente.php';</script>";
}



$conn->close();
?>
