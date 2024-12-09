<?php //ya sirve
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Psicólogo') {
    header("Location: ../../login.php");
    exit();
}

include '../../Modelo/BD/bd.php';
include '../../Vista/includes/headerPsico_IN.php';

$username = $_SESSION['username'];
$sql = "SELECT id_usuario FROM credenciales WHERE usuario = '$username';";
$result = mysqli_query($conn, $sql);
$psicologo = mysqli_fetch_assoc($result);
$cedulaPsicologo = $psicologo['id_usuario'];


// Obtener la lista de pacientes
$sql_pacientes = "SELECT idPaciente, Nombre, ApPaterno, ApMaterno FROM paciente";
$result_pacientes = mysqli_query($conn, $sql_pacientes);

// Verificar si se ha seleccionado un paciente
$idPaciente = isset($_POST['idPaciente']) ? $_POST['idPaciente'] : null;



$avances = [];
$actividades = [];
if ($idPaciente) {
    //$cedulaPsicologo = $_SESSION['cedula'];

    // Obtener avances del paciente
    $sql_avances = "SELECT Puntaje, Observaciones FROM avances WHERE IdPacienteAv = $idPaciente AND CedulaAv = '$cedulaPsicologo' AND (Observaciones IS NULL OR Observaciones = '') LIMIT 1";
    $result_avances = mysqli_query($conn, $sql_avances);
    $avances = mysqli_fetch_assoc($result_avances);

    // Obtener actividades del paciente
    $sql_actividades = "SELECT actividades.Actividad FROM avances inner join actividades on avances.Actividad = actividades.idActividades WHERE IdPacienteAv = $idPaciente AND CedulaAv = '$cedulaPsicologo' AND (Observaciones IS NULL OR Observaciones = '')";
    //$sql_detalles = "SELECT Puntaje, actividades.Actividad, Observaciones FROM avances inner join actividades on avances.actividad = actividades.idActividades WHERE IdPacienteAv = $idPaciente AND CedulaAv = '$cedulaPsicologo'";
    $result_actividades = mysqli_query($conn, $sql_actividades);
    while ($actividad = mysqli_fetch_assoc($result_actividades)) {
        $actividades[] = $actividad['Actividad'];
    }
}
?>

<body>
    <h1>Dar seguimiento al Paciente</h1>
    <form method="POST">
        <label for="paciente">Seleccionar Paciente:</label>
        <select name="idPaciente" id="paciente" required>
            <?php while ($paciente = mysqli_fetch_assoc($result_pacientes)) { ?>
                <option value="<?php echo $paciente['idPaciente']; ?>" <?php if ($idPaciente == $paciente['idPaciente']) echo 'selected'; ?>>
                    <?php echo $paciente['Nombre'] . " " . $paciente['ApPaterno'] . " " . $paciente['ApMaterno']; ?>
                </option>
            <?php } ?>
        </select>
        <button type="submit">Mostrar Avances</button>
    </form>

    <?php if ($idPaciente && $avances) { ?>
        <h2>Puntaje y Observaciones</h2>
        <table>
            <thead>
                <tr>
                    <th>Puntaje</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $avances['Puntaje']; ?></td>
                    <td><?php echo $avances['Observaciones']; ?></td>
                </tr>
            </tbody>
        </table>
    <?php } ?>

    <?php if ($idPaciente && $actividades) { ?>
        <h2>Actividades Asignadas</h2>
        <table>
            <thead>
                <tr>
                    <th>Actividad</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($actividades as $actividad) { ?>
                    <tr>
                        <td><?php echo $actividad; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } ?>

    <form action="editar_observaciones.php" method="POST">
        <input type="hidden" name="idPaciente" value="<?php echo $idPaciente; ?>">
        <button type="submit">Editar Observaciones</button>
    </form>

    <form action="nuevo_avance.php" method="POST">
        <input type="hidden" name="idPaciente" value="<?php echo $idPaciente; ?>">
        <button type="submit">Nuevo Avance</button>
    </form>
</body>
</html>
