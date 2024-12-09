<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] == 'Paciente') {
    header("Location: ../../login.php");
    exit();
}

include '../../Modelo/BD/bd.php';
include '../includes/headerregresar.php';


$citasSql = "SELECT * FROM paciente";
$citasResult = mysqli_query($conn, $citasSql);
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
</head>
<body class="bg-light">
    <div class="container my-5">
        <h1 class="text-center text-primary mb-4">Bienvenido, <?php echo $_SESSION['username']; ?></h1>

        <div class="text-right mb-3">
            <a href="CrearPaciente.php" class="btn btn-success">Crear un paciente nuevo</a>
        </div>
        
        <h2 class="text-secondary">Lista de Pacientes</h2>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID Paciente</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Sexo</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Eliminar</th>
                        <th>Actualizar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($cita = mysqli_fetch_assoc($citasResult)) { ?>
                        <tr>
                            <td><?php echo $cita['idPaciente']; ?></td>
                            <td><?php echo $cita['Nombre']; ?></td>
                            <td><?php echo $cita['ApPaterno'] . " " . $cita['ApMaterno']; ?></td>
                            <td><?php echo $cita['sexo']; ?></td>
                            <td><?php echo $cita['telefono']; ?></td>
                            <td><?php echo $cita['direccion']; ?></td>
                            <td><?php echo $cita['fechaNac']; ?></td>
                            <td><a href="javascript:void(0);" onclick="confirmDelete(<?php echo $cita['idPaciente']; ?>)" class="btn btn-danger btn-sm">Eliminar</a>                            </td>
                            <td><a href="EditarPaciente.php?idPaciente=<?php echo $cita['idPaciente']; ?>" class="btn btn-warning btn-sm">Actualizar</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <hr>
    </div>

    <script>
    function confirmDelete(id) {
        if (confirm("¿Estás seguro de que deseas eliminar este registro?")) {
            window.location.href = "../../Modelo/GestionPacientes/eliPAciente.php?idPaciente=" + id;
        }
    }
    </script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJTYuOHqAyyHnO8MN4TEdgz1Duj8ST8f5T89B5FRz5eF1KpH" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+rZ7pihAxTfWv4w8rP5JpGVPH/nx1tW1p4GRTiqsbtGZR03p" crossorigin="anonymous"></script>
</body>
</html>

<?php
mysqli_close($conn);
?>
