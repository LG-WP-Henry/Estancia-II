<?php 
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Psicólogo') {
    header("Location: ../../login.php");
    exit();
}

include '../../Modelo/BD/bd.php';
include '../../Vista/includes/headerPsico.php';


// Obtener el ID del paciente
$idPaciente = $_POST['idPaciente'];

// Obtener la cédula del psicólogo desde la sesión
$username = $_SESSION['username'];
$sql = "SELECT id_usuario FROM credenciales WHERE usuario = '$username';";
$result = mysqli_query($conn, $sql);
$psicologo = mysqli_fetch_assoc($result);
$cedulaPsicologo = $psicologo['id_usuario'];

// Obtener la observación actual del paciente
$sql_observacion = "SELECT Observaciones FROM avances WHERE IdPacienteAv = $idPaciente AND CedulaAv = '$cedulaPsicologo' AND (Observaciones IS NULL OR Observaciones = '') LIMIT 1";
$result_observacion = mysqli_query($conn, $sql_observacion);
$observacion = mysqli_fetch_assoc($result_observacion);
?>

<body>
    <h1>Editar Observaciones</h1>
    <form action="../../Modelo/GestionAvance/procesar_observaciones.php" method="POST">
        <input type="hidden" name="idPaciente" value="<?php echo $idPaciente; ?>">
        <label for="observaciones">Observaciones:</label>
        <textarea name="observaciones" id="observaciones" required><?php echo $observacion['Observaciones']; ?></textarea>
        <button type="submit">Guardar Observaciones</button>
    </form>
</body>
</html>
