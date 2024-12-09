<?php //ya sirve
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Psicólogo') {
    header("Location: ../../login.php");
    exit();
}

include '../../Modelo/BD/bd.php';
include '../includes/headerRegresar.php';
$username = $_SESSION['username'];
$sql = "SELECT id_usuario FROM credenciales WHERE usuario = '$username';";
$result = mysqli_query($conn, $sql);
$psicologo = mysqli_fetch_assoc($result);
$cedulaPsicologo = $psicologo['id_usuario'];

$idPaciente = $_POST['idPaciente'];

// Obtener la cédula del psicólogo desde la sesión
//$cedulaPsicologo = $_SESSION['cedula'];

// Crear un nuevo avance en la base de datos
                    
$sql = "INSERT INTO avances (CedulaAv, idPacienteAv) VALUES ('$cedulaPsicologo', '$idPaciente')";
$conn->query($sql);

header("Location: mostrar_avances.php?mensaje=nuevo_avance_creado");
exit();
?>
