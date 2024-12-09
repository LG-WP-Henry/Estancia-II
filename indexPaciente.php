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
    <form action="Modelo/GestionPreguntas/procesar_test.php" method="POST">
        <table class="table-black">
            <thead>
                <tr>
                    <th>Pregunta</th>
                    <th>Siempre (5)</th>
                    <th>Casi siempre (4)</th>
                    <th>A veces (3)</th>
                    <th>Casi nunca (2)</th>
                    <th>Nunca (1)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                $sql = "SELECT pregunta, idPregunta from test inner join preguntas on test.idPreguntaTst = preguntas.idPregunta where $idPaciente = idPacienteTst and realizado = 0;";
                $PreguntaResult = mysqli_query($conn, $sql);
                while ($preg = mysqli_fetch_assoc($PreguntaResult)) {
                    $idPregunta = $preg['idPregunta'];
                ?>
                    <tr>
                        <td><?php echo $preg['pregunta']; ?></td>
                        <td><input type="radio" name="respuesta_<?php echo $idPregunta; ?>" value="5"></td>
                        <td><input type="radio" name="respuesta_<?php echo $idPregunta; ?>" value="4"></td>
                        <td><input type="radio" name="respuesta_<?php echo $idPregunta; ?>" value="3"></td>
                        <td><input type="radio" name="respuesta_<?php echo $idPregunta; ?>" value="2"></td>
                        <td><input type="radio" name="respuesta_<?php echo $idPregunta; ?>" value="1"></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <button type="submit">Enviar respuestas</button>
    </form>

    <p class="indice" style="text-align: right;">
        <?php echo "Ingrese el valor según la pregunta."; ?>
        
    </p>
</body>



</html>

<?php
mysqli_close($conn);
?>
