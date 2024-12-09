<?php
include '../../Modelo/BD/bd.php';
session_start();



$username = $_SESSION['username'];
$sql = "SELECT id_usuario FROM credenciales WHERE usuario = '$username';";
$result = mysqli_query($conn, $sql);
$psicologo = mysqli_fetch_assoc($result);
$cedulaPsicologo = $psicologo['id_usuario'];

//$id_usuario = $_SESSION['id_usuario'];


//echo "$cedulaPsicologo";

// Obtener datos del formulario
//$id_psicologo = $_SESSION['id_psicologo']; // Asumiendo que el ID del psicólogo está almacenado en la sesión

$id_paciente = $_POST['id_paciente'];
$preguntas_seleccionadas = $_POST['preguntas_seleccionadas'];
$fecha_actual = date('Y-m-d H:i:s');
$id_test = rand(0,9999); // Generar un ID único para el test
$simonHecho = 0;
// Insertar cada pregunta seleccionada en la tabla "test"
foreach ($preguntas_seleccionadas as $id_pregunta) {
    $sql = "INSERT INTO test (CedulaAvTst, idPacienteTst, idPreguntaTst, fecha,idtestP, realizado) VALUES ('$cedulaPsicologo', '$id_paciente', '$id_pregunta', '$fecha_actual', '$id_test', '$simonHecho')";
    if ($conn->query($sql) === TRUE) {
        echo "Pregunta $id_pregunta insertada correctamente.<br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
sleep(3);
header("Location: ../../indexPsicologo.php");
?>