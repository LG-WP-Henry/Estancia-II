<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Psicólogo') {
    header("Location: login.php");
    exit();
}

include 'Modelo/BD/bd.php';
include 'Vista/includes/headerPsico.php';


$username = $_SESSION['username'];
$sql = "SELECT id_usuario FROM credenciales WHERE usuario = '$username';";
$result = mysqli_query($conn, $sql);
$psicologo = mysqli_fetch_assoc($result);
$cedulaPsicologo = $psicologo['id_usuario'];

$citasSql = "SELECT *FROM citas WHERE CedulaCita = '$cedulaPsicologo'";
$citasResult = mysqli_query($conn, $citasSql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel del Psicólogo</title>
    <link rel="stylesheet" href="Vista/Estilos/stylesIP.css">
</head>
<body>
    <h1>Bienvenido, <?php echo $_SESSION['username']; ?></h1>

    <h2>Lista de Citas</h2>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID Cita</th>
                <th>Fecha</th>
                <th>Nombre del Paciente</th>
                <th>Apellidos</th>
                <th>Eliminar</th>
                <th>Actualizar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $citasSql = "SELECT citas.idCitas, citas.Fecha, paciente.Nombre, paciente.ApPaterno, paciente.ApMaterno 
                FROM citas JOIN paciente ON citas.idPacienteCi = paciente.idPaciente 
                WHERE citas.CedulaCita = '$cedulaPsicologo'";
            
            $citasResult = mysqli_query($conn, $citasSql);
            while ($cita = mysqli_fetch_assoc($citasResult)) {
            ?>
                <tr>
                    <td><?php echo $cita['idCitas']; ?></td>
                    <td><?php echo date('d/m/Y H:i', strtotime($cita['Fecha'])); ?></td>
                    <td><?php echo $cita['Nombre']; ?></td>
                    <td><?php echo $cita['ApPaterno'] . " " . $cita['ApMaterno']; ?></td>
                    <td><a href="delete_cita.php?id=<?php echo $cita['idCitas']; ?>">Eliminar</a></td>
                    <td><a href="update_cita.php?id=<?php echo $cita['idCitas']; ?>">Actualizar</a></td>
                </tr>
            <?php } ?>
        </tbody>
            </table>
            <br>
            <hr>
            <br>
    <ul>
        <li><a href="cambiar_contrasena.php">Cambiar Contraseña</a></li>
        <li><a href="Controlador/logout.php">Cerrar Sesión</a></li>
    </ul>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJTYuOHqAyyHnO8MN4TEdgz1Duj8ST8f5T89B5FRz5eF1KpH" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+rZ7pihAxTfWv4w8rP5JpGVPH/nx1tW1p4GRTiqsbtGZR03p" crossorigin="anonymous"></script>

<?php
mysqli_close($conn);
?>
