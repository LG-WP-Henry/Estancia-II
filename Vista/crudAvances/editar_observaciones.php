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

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Observaciones</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container my-5">
        <h1 class="text-center text-primary mb-4">Editar Observaciones</h1>
        <form action="../../Controlador/procesar_observaciones.php" method="POST">
            <input type="hidden" name="idPaciente" value="<?php echo $idPaciente; ?>">
            <div class="form-group">
                <label for="observaciones">Observaciones:</label>
                <textarea name="observaciones" id="observaciones" class="form-control" rows="5" required><?php echo $observacion['Observaciones']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Guardar Observaciones</button>
        </form>
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

