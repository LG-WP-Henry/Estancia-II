<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Psicólogo') {
    header("Location: login.php");
    exit();
}
include 'Vista/includes/headerPsico.php';
include 'Modelo/BD/bd.php';

$username = $_SESSION['username'];
$sql = "SELECT id_usuario FROM credenciales WHERE usuario = '$username';";
$result = mysqli_query($conn, $sql);
$psicologo = mysqli_fetch_assoc($result);
$cedulaPsicologo = $psicologo['id_usuario'];

$citasSql = "SELECT * FROM citas WHERE CedulaCita = '$cedulaPsicologo'";
$citasResult = mysqli_query($conn, $citasSql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel del Psicólogo</title>
    <!-- Estilos y Bootstrap eliminados -->
    <link rel="stylesheet" href="Vista/Estilos/stylesP.css">
</head>
<body>
    <h1>Bienvenido, <?php echo $_SESSION['username']; ?></h1>

    <h2>Lista de Citas</h2>
    <table class = "table table-hover table-bordered tabla-3d">
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
            FROM citas 
            JOIN paciente ON citas.idPacienteCi = paciente.idPaciente 
            WHERE citas.CedulaCita = '$cedulaPsicologo' 
            AND citas.Fecha >= NOW() 
            AND citas.Fecha <= DATE_ADD(NOW(), INTERVAL 3 DAY)";
            
            $citasResult = mysqli_query($conn, $citasSql);
            while ($cita = mysqli_fetch_assoc($citasResult)) {
            ?>
                <tr>
                    <td><?php echo $cita['idCitas']; ?></td>
                    <td><?php echo date('d/m/Y H:i', strtotime($cita['Fecha'])); ?></td>
                    <td><?php echo $cita['Nombre']; ?></td>
                    <td><?php echo $cita['ApPaterno'] . " " . $cita['ApMaterno']; ?></td>
                    <td><a href="javascript:void(0);" onclick="confirmDelete(<?php echo $cita['idCitas']; ?>)">Eliminar</a></td>
                    <td><a href="Vista/crudCitas/EditarCita.php?idCita=<?php echo $cita['idCitas']; ?>">Actualizar</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <script>
    function confirmDelete(id) {
        if (confirm("¿Estás seguro de que deseas eliminar este registro?")) {
            window.location.href = "Modelo/GestionCitas/eliCita.php?idCitas=" + id;
        }
    }
    </script>
</body>
</html>

<?php
mysqli_close($conn);
?>
