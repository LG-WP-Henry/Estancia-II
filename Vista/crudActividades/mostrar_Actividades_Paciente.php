<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Paciente') {
    header("Location: login.php");
    exit();
}

include '../../Modelo/BD/bd.php';
include '../includes/headerRegresar.php';

// Obtener el ID del paciente desde la sesión
$username = $_SESSION['username'];
$sql = "SELECT id_usuario FROM credenciales WHERE usuario = '$username';";
$result = mysqli_query($conn, $sql);
$paciente = mysqli_fetch_assoc($result);
$idPaciente = $paciente['id_usuario'];

// Obtener el ID del psicólogo desde un parámetro GET o POST (ajusta según tus necesidades)
$cedulaPsicologo = isset($_GET['cedulaPsicologo']) ? $_GET['cedulaPsicologo'] : null;

// Consulta para obtener las actividades asignadas al paciente
$sql_actividad = "SELECT actividades.idActividades, actividades.Actividad, avances.comentariosPac 
                  FROM avances 
                  INNER JOIN actividades ON avances.Actividad = actividades.idActividades 
                  WHERE IdPacienteAv = $idPaciente";
$result_actividad = mysqli_query($conn, $sql_actividad);
if (!$result_actividad) {
    echo "Error en la consulta: " . mysqli_error($conn);
}

// Procesar el envío del formulario de comentarios
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comentario']) && isset($_POST['idActividad'])) {
    $comentario = $_POST['comentario'];
    $idActividad = $_POST['idActividad'];

    // Verificar si ya existe un comentario para la actividad
    $sql_check = "SELECT comentariosPac FROM avances WHERE Actividad = '$idActividad' AND IdPacienteAv = $idPaciente;";
    $result_check = mysqli_query($conn, $sql_check);
    $row_check = mysqli_fetch_assoc($result_check);

    if ($row_check['comentariosPac']) {
        echo "<div class='alert alert-danger text-center'>Ya existe un comentario para esta actividad.</div>";
    } else {
        // Insertar el comentario en la base de datos
        $sql_update = "UPDATE avances SET comentariosPac = '$comentario' WHERE Actividad = '$idActividad' AND IdPacienteAv = $idPaciente;";
        if (mysqli_query($conn, $sql_update)) {
            echo "<div class='alert alert-success text-center'>Comentario agregado exitosamente.</div>";
            // Recargar la página para reflejar el nuevo comentario
            header("Refresh:0");
        } else {
            echo "<div class='alert alert-danger text-center'>Error al agregar el comentario. Inténtalo de nuevo.</div>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividades Asignadas</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container my-5">
        <h1 class="text-center text-primary">Esta es tu actividad asignada</h1>
        <?php if (mysqli_num_rows($result_actividad) > 0) { ?>
            <ul class="list-group">
                <?php while ($actividad = mysqli_fetch_assoc($result_actividad)) { ?>
                    <li class="list-group-item">
                        <div><?php echo $actividad['Actividad']; ?></div>
                        <div>
                            <?php if ($actividad['comentariosPac']) { ?>
                                <p class="text-success">Comentario: <?php echo $actividad['comentariosPac']; ?></p>
                            <?php } else { ?>
                                <form method="post" action="">
                                    <div class="form-group">
                                        <label for="comentario-<?php echo $actividad['idActividades']; ?>">Agregar comentario:</label>
                                        <textarea class="form-control" id="comentario-<?php echo $actividad['idActividades']; ?>" name="comentario" required></textarea>
                                        <input type="hidden" name="idActividad" value="<?php echo $actividad['idActividades']; ?>">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                </form>
                            <?php } ?>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        <?php } else { ?>
            <p class="text-danger text-center mt-4">No se ha asignado ninguna actividad a este paciente.</p>
        <?php } ?>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6HJTYuOHqAyyHnO8MN4TEdgz1Duj8ST8f5T89B5FRz5eF1KpH" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+rZ7pihAxTfWv4w8rP5JpGVPH/nx1tW1p4GRTiqsbtGZR03p" crossorigin="anonymous"></script>
</body>
</html>

<?php
mysqli_close($conn);
?>
