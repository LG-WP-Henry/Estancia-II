<?php
session_start();

include '../BD/bd.php';

$idPaciente = $_POST['idPaciente'];
$observaciones = $_POST['observaciones'];

// Obtener la cédula del psicólogo desde la sesión
$username = $_SESSION['username'];
$sql = "SELECT id_usuario FROM credenciales WHERE usuario = '$username';";
$result = mysqli_query($conn, $sql);
$psicologo = mysqli_fetch_assoc($result);
$cedulaPsicologo = $psicologo['id_usuario'];


// Actualizar las observaciones en la base de datos
$sql = "UPDATE avances SET Observaciones = '$observaciones' WHERE IdPacienteAv = $idPaciente AND CedulaAv = '$cedulaPsicologo' AND (Observaciones IS NULL OR Observaciones = '') LIMIT 1";
$conn->query($sql);
echo "quedo";
//header("Location: mostrar_avances.php?mensaje=observaciones_guardadas");
exit();
?>
