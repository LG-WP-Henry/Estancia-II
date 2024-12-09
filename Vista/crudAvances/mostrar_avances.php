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

$avances = [];
$actividades = [];
if ($idPaciente) {
    // Obtener avances del paciente
    $sql_avances = "SELECT Puntaje, Observaciones FROM avances WHERE IdPacienteAv = $idPaciente AND CedulaAv = '$cedulaPsicologo' AND (Observaciones IS NULL OR Observaciones = '') LIMIT 1";
    $result_avances = mysqli_query($conn, $sql_avances);
    $avances = mysqli_fetch_assoc($result_avances);

    // Obtener actividades del paciente junto con los comentarios
    $sql_actividades = "SELECT actividades.Actividad, avances.comentariosPac FROM avances 
                        INNER JOIN actividades ON avances.Actividad = actividades.idActividades 
                        WHERE IdPacienteAv = $idPaciente AND CedulaAv = '$cedulaPsicologo'";
    $result_actividades = mysqli_query($conn, $sql_actividades);
    while ($actividad = mysqli_fetch_assoc($result_actividades)) {
        $actividades[] = $actividad;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seguimiento al Paciente</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container my-5">
        <h1 class="text-center text-primary">Dar seguimiento al Paciente</h1>
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
            <button type="submit" class="btn btn-primary">Mostrar Avances</button>
        </form>

        <?php if ($idPaciente && $avances) { ?>
            <h2 class="text-secondary">Puntaje y Observaciones</h2>
            <table class="table table-hover table-bordered">
                <thead class="thead-dark">
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
        <?php } else if ($idPaciente) { ?>
            <p class="text-warning">No se han encontrado avances sin observaciones para este paciente.</p>
        <?php } ?>

        <?php if ($idPaciente && $actividades) { ?>
            <h2 class="text-secondary">Actividades Asignadas</h2>
            <table class="table table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Actividad</th>
                        <th>Comentario</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($actividades as $actividad) { ?>
                        <tr>
                            <td><?php echo $actividad['Actividad']; ?></td>
                            <td><?php echo $actividad['comentariosPac'] ? $actividad['comentariosPac'] : 'Sin comentario'; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else if ($idPaciente) { ?>
            <p class="text-warning">No se han encontrado actividades asignadas para este paciente.</p>
        <?php } ?>

        <div class="d-flex justify-content-between">
            <form action="editar_observaciones.php" method="POST">
                <input type="hidden" name="idPaciente" value="<?php echo $idPaciente; ?>">
                <button type="submit" class="btn btn-secondary">Editar Observaciones</button>
            </form>

            <form action="mostrar_detalles_avances.php" method="POST">
                <input type="hidden" name="idPaciente" value="<?php echo $idPaciente; ?>">
                <button type="submit" class="btn btn-secondary">Mostrar Avances</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6HJTYP/q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+rZ7pihAxTfWv4w8rP5JpGVPH/nx1tW1p4GRTiqsbtGZR03p" crossorigin="anonymous"></script>
</body>
</html>

<?php
mysqli_close($conn);
?>
