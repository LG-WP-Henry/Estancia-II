<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Psicólogo') {
    header("Location: ../../login.php");
    exit();
}

include '../../Modelo/BD/bd.php';
include '../../Vista/includes/headerPsico.php';

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

$detalles_avances = [];
if ($idPaciente) {
    //$cedulaPsicologo = $_SESSION['cedula'];

    // Obtener detalles de los avances del paciente
    $sql_detalles = "SELECT Puntaje, Actividad, Observaciones FROM avances WHERE IdPacienteAv = $idPaciente AND CedulaAv = '$cedulaPsicologo'";
    $result_detalles = mysqli_query($conn, $sql_detalles);
    while ($detalle = mysqli_fetch_assoc($result_detalles)) {
        $detalles_avances[] = $detalle;
    }
}
?>

<body>
    <h1>Mostrar Detalles de Avances del Paciente</h1>
    <form method="POST">
        <label for="paciente">Seleccionar Paciente:</label>
        <select name="idPaciente" id="paciente" required>
            <?php while ($paciente = mysqli_fetch_assoc($result_pacientes)) { ?>
                <option value="<?php echo $paciente['idPaciente']; ?>" <?php if ($idPaciente == $paciente['idPaciente']) echo 'selected'; ?>>
                    <?php echo $paciente['Nombre'] . " " . $paciente['ApPaterno'] . " " . $paciente['ApMaterno']; ?>
                </option>
            <?php } ?>
        </select>
        <button type="submit">Mostrar Detalles</button>
    </form>

    <?php if ($idPaciente && $detalles_avances) { ?>
        <h2>Detalles de los Avances</h2>
        <table>
            <thead>
                <tr>
                    <th>Puntaje</th>
                    <th>Actividad</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($detalles_avances as $detalle) { ?>
                    <tr>
                        <td><?php echo $detalle['Puntaje']; ?></td>
                        <td><?php echo $detalle['Actividad']; ?></td>
                        <td><?php echo $detalle['Observaciones']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } ?>
</body>
</html>
