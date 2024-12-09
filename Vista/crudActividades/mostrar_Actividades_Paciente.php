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

// Consulta para obtener las actividades asignadas al paciente sin observaciones
$sql_actividad = "SELECT actividades.Actividad 
                  FROM avances 
                  INNER JOIN actividades ON avances.Actividad = actividades.idActividades 
                  WHERE IdPacienteAv = $idPaciente AND (Observaciones IS NULL OR Observaciones = '')";
$result_actividad = mysqli_query($conn, $sql_actividad);

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
                    <li class="list-group-item"><?php echo $actividad['Actividad']; ?></li>
                <?php } ?>
            </ul>
        <?php } else { ?>
            <p class="text-danger text-center mt-4">No se ha asignado ninguna actividad a este paciente sin observaciones.</p>
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

