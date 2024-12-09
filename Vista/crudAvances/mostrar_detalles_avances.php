<?php
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

// Obtener la lista de pacientes
$sql_pacientes = "SELECT idPaciente, Nombre, ApPaterno, ApMaterno FROM paciente";
$result_pacientes = mysqli_query($conn, $sql_pacientes);

// Verificar si se ha seleccionado un paciente
$idPaciente = isset($_POST['idPaciente']) ? $_POST['idPaciente'] : null;

$detalles_avances = [];
if ($idPaciente) {
    // Obtener detalles de los avances del paciente
    $sql_detalles = "SELECT Puntaje, actividades.Actividad, Observaciones 
                     FROM avances 
                     INNER JOIN actividades ON avances.Actividad = actividades.idActividades 
                     WHERE IdPacienteAv = $idPaciente AND CedulaAv = '$cedulaPsicologo'";
    $result_detalles = mysqli_query($conn, $sql_detalles);
    while ($detalle = mysqli_fetch_assoc($result_detalles)) {
        $detalles_avances[] = $detalle;
    }
}
$no_avance = 1;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Detalles de Avances del Paciente</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container my-5">
        <h1 class="text-center text-primary">Mostrar Detalles de Avances del Paciente</h1>
        <form method="POST" class="mb-4">
            <div class="form-group">
                <label for="paciente">Seleccionar Paciente:</label>
                <select name="idPaciente" id="paciente" class="form-control" required>
                    <?php while ($paciente = mysqli_fetch_assoc($result_pacientes)) { ?>
                        <option value="<?php echo $paciente['idPaciente']; ?>" <?php if ($idPaciente == $paciente['idPaciente']) echo 'selected'; ?>>
                            <?php echo $paciente['Nombre'] . " " . $paciente['ApPaterno'] . " " . $paciente['ApMaterno']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Mostrar Detalles</button>
        </form>

        <?php if ($idPaciente && $detalles_avances) { ?>
            <h2 class="text-secondary">Detalles de los Avances</h2>
            <table class="table table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>No. Avance</th>
                        <th>Puntaje del test</th>
                        <th>Actividad asignada</th>
                        <th>Observaciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($detalles_avances as $detalle) { ?>
                        <tr>
                            <td><?php echo $no_avance++; ?></td>
                            <td><?php echo $detalle['Puntaje']; ?></td>
                            <td><?php echo $detalle['Actividad']; ?></td>
                            <td><?php echo $detalle['Observaciones']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else if ($idPaciente) { ?>
            <p class="text-warning">No se han encontrado detalles de avances para este paciente.</p>
        <?php } ?>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJTYuOHqAyyHnO8MN4TEdgz1Duj8ST8f5T89B5FRz5eF1KpH" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+rZ7pihAxTfWv4w8rP5JpGVPH/nx1tW1p4GRTiqsbtGZR03p" crossorigin="anonymous"></script>
</body>
</html>

<?php
mysqli_close($conn);
?>

