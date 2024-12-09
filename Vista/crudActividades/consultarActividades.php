<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Psicólogo') {
    header("Location: ../../login.php");
    exit();
}

include '../../Modelo/BD/bd.php';
include '../../Vista/includes/headerRegresar.php';

$actividadSql = "SELECT * FROM actividades";

$execute = mysqli_query($conn, $actividadSql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel del Psicólogo</title>
    <link rel="stylesheet" href="../Estilos/stylesIP.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script>
        function confirmDeletion(event) {
            if (!confirm("¿Seguro que vas a eliminar esta actividad?")) {
                event.preventDefault();
            }
        }
    </script>
</head>
<body class="bg-light">
    <div class="container my-5">
        <h1 class="text-center text-primary mb-4">Bienvenido, <?php echo $_SESSION['username']; ?></h1>

        <div class="text-right mb-3">
            <a href="mostrar_Actividades.php" class="btn btn-success">Asignar actividad</a>
            <a href="altaActividad.php" class="btn btn-success">Agregar actividad</a>
        </div>
        
        <h2 class="text-secondary">Actividades</h2>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID Actividad</th>
                        <th>Actividad</th>
                        <th>Eliminar</th>
                        <th>Actualizar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($variableA = mysqli_fetch_assoc($execute)) { ?>
                        <tr>
                            <td><?php echo $variableA['idActividades']; ?></td>
                            <td><?php echo $variableA['Actividad']; ?></td>
                            
                            <td><a href="../../Modelo/GestionActividad/eliActividad.php?idActividades=<?php echo $variableA['idActividades']; ?>" class="btn btn-danger btn-sm" onclick="confirmDeletion(event)">Eliminar</a></td>
                            <td><a href="editarActividades.php?idActividades=<?php echo $variableA['idActividades']; ?>" class="btn btn-warning btn-sm">Actualizar</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <hr>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJTYuOHqAyyHnO8MN4TEdgz1Duj8ST8f5T89B5FRz5eF1KpH" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+rZ7pihAxTfWv4w8rP5JpGVPH/nx1tW1p4GRTiqsbtGZR03p" crossorigin="anonymous"></script>
</body>
</html>

<?php
mysqli_close($conn);
?>
