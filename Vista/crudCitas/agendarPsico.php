<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Psicólogo') {
    header("Location: login.php");
    exit();
}

include '../includes/headerRegresar.php';
include '../../Modelo/BD/bd.php';

// Obtener la información del psicólogo
$username = $_SESSION['username'];
$sql = "SELECT id_usuario FROM credenciales WHERE usuario = '$username';";
$result = mysqli_query($conn, $sql);
$psicologo = mysqli_fetch_assoc($result);
$cedulaPsicologo = $psicologo['id_usuario'];

// Obtener la lista de pacientes
$pacientesSql = "SELECT idPaciente, Nombre, ApPaterno, ApMaterno FROM paciente";
$pacientesResult = mysqli_query($conn, $pacientesSql);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Cita</title>
    <!-- Enlace a Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Agendar Cita</h1>
        <form action="../../Modelo/GestionCitas/crearCita.php" method="POST">
            <div class="mb-3">
                <label for="paciente" class="form-label">Seleccionar Paciente</label>
                <select class="form-select" id="idPaciente" name="idPaciente" required>
                    <option value="">-- Seleccione un Paciente --</option>
                    <?php while ($paciente = mysqli_fetch_assoc($pacientesResult)) { ?>
                        <option value="<?php echo $paciente['idPaciente']; ?>">
                            <?php echo $paciente['Nombre'] . " " . $paciente['ApPaterno'] . " " . $paciente['ApMaterno']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha y Hora</label>
                <input type="datetime-local" class="form-control" id="fecha" name="fecha" required>
            </div>
            <div>
            <input type="hidden" class="form-label" id="CedulaCita" name="CedulaCita" value="<?php echo $cedulaPsicologo ?>" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Agendar Cita</button>
        </form>
    </div>
    <!-- Enlace a Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
mysqli_close($conn);
?>
