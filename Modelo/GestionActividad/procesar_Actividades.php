<?php
session_start();

include '../BD/bd.php';

$idPaciente = $_POST['idPaciente'];
$actividades = $_POST['actividades'];

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener la cédula del psicólogo desde la sesión
$username = $_SESSION['username'];
$sql = "SELECT id_usuario FROM credenciales WHERE usuario = '$username';";
$result = mysqli_query($conn, $sql);
$psicologo = mysqli_fetch_assoc($result);
$cedulaPsicologo = $psicologo['id_usuario'];

// Proceso de asignación de actividades
foreach ($actividades as $idActividad) {
    // Verificar si hay avances que coincidan y que no tengan observaciones ni actividades asignadas
    $sql_verificar = "SELECT * FROM avances WHERE IdPacienteAv = $idPaciente AND CedulaAv = '$cedulaPsicologo' AND (Actividad IS NULL OR Actividad = '') AND (Observaciones IS NULL OR Observaciones = '') LIMIT 1";
    $result_verificar = mysqli_query($conn, $sql_verificar);
    
    if (mysqli_num_rows($result_verificar) > 0) {
        // Actualizar el primer avance encontrado
        $avance = mysqli_fetch_assoc($result_verificar);
        $sql_actualizar = "UPDATE avances SET Actividad = $idActividad WHERE IdAvances = "$avance['IdAvances'];
        $conn->query($sql_actualizar);
    } else {
        // Insertar un nuevo avance si no se encuentra ninguno que cumpla las condiciones
        $sql_insertar = "INSERT INTO avances (IdPacienteAv, CedulaAv, Puntaje, Actividad) SELECT IdPacienteAv, CedulaAv, Puntaje, $idActividad FROM avances WHERE IdPacienteAv = $idPaciente AND CedulaAv = '$cedulaPsicologo' LIMIT 1";
        $conn->query($sql_insertar);
    }
}

echo "HECHO";
//header("Location: mostrar_actividades.php?mensaje=actividade asignadas");
exit();
?>
