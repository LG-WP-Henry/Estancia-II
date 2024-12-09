<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Psicólogo') {
    header("Location: ../../login.php");
    exit();
}

include '../../Modelo/BD/bd.php';
include '../../Vista/includes/headerRegresar.php';

// Obtener la lista de actividades
$sql_actividades = "SELECT idActividades, Actividad FROM actividades";
$result_actividades = mysqli_query($conn, $sql_actividades);

// Obtener la lista de pacientes
$sql_pacientes = "SELECT idPaciente, Nombre, ApPaterno, ApMaterno FROM paciente";
$result_pacientes = mysqli_query($conn, $sql_pacientes);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignar Actividades</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container my-5">
        <h1 class="text-center text-primary mb-4">Asignar Actividades</h1>
        <form action="../../Controlador/procesar_Actividades.php" method="POST">
            <div class="form-group">
                <label for="paciente">Seleccionar Paciente:</label>
                <select name="idPaciente" id="paciente" class="form-control" required>
                    <?php while ($paciente = mysqli_fetch_assoc($result_pacientes)) { ?>
                        <option value="<?php echo $paciente['idPaciente']; ?>">
                            <?php echo $paciente['Nombre'] . " " . $paciente['ApPaterno'] . " " . $paciente['ApMaterno']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            
            <h2 class="text-secondary">Actividades</h2>
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Seleccionar</th>
                            <th>Nombre de la Actividad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($actividad = mysqli_fetch_assoc($result_actividades)) { ?>
                            <tr>
                                <td><input type="checkbox" name="actividades[]" value="<?php echo $actividad['idActividades']; ?>"></td>
                                <td><?php echo $actividad['Actividad']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Asignar Actividades</button>
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

