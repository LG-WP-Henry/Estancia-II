<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Paciente') {
    header("Location: login.php");
    exit();
}

include 'Modelo/BD/bd.php';
include 'Vista/includes/headerPac.php';

$username = $_SESSION['username'];
$sql = "SELECT id_usuario FROM credenciales WHERE usuario = '$username';";
$result = mysqli_query($conn, $sql);
$paciente = mysqli_fetch_assoc($result);
$idPaciente = $paciente['id_usuario'];

$citasSql = "SELECT *FROM citas WHERE CedulaCita = '$idPaciente'";
$citasResult = mysqli_query($conn, $citasSql);

$sqlnombre = "SELECT nombre from Paciente where idPaciente = '$idPaciente';"; 
$result2 = mysqli_query($conn, $sqlnombre);
$paciente2 = mysqli_fetch_assoc($result2);
$nombrePaciente = $paciente2['nombre'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paciente</title>
    <link rel="stylesheet" href="Vista/Estilos/stylesPac.css">
</head>
<body>
    <h1>Bienvenido, <?php echo $nombrePaciente; ?></h1>

    <h2>Contesta el test siendo lo mas sincero posible</h2>
    <table class="table-black">
        <thead>
            <tr>
                <th>Pregunta</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $pregunta = "SELECT Pregunta FROM test JOIN preguntas ON test.idPreguntaTst = preguntas.idPregunta
            WHERE test.idPacienteTst ='$idPaciente'";
            
            $PreguntaResult = mysqli_query($conn, $pregunta);
            while ($preg = mysqli_fetch_assoc($PreguntaResult)) {
            ?>
                <tr>
                    <td><?php echo $preg['preguntas.Pregunta']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
            </table>

            <p class='indice' text-align: right>
                <?php echo "Ingrese el valor segun la pegunta." ?>
                //aqui van 10 filas para puntear del 1 al 5

            </p>
</body>
</html>

<?php
mysqli_close($conn);
?>
