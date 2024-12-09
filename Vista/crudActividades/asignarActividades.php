<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Psicólogo') {
    header("Location: login.php");
    exit();
}

include '../../Modelo/BD/bd.php';
include '../../Vista/includes/headerPsico.php';
?>

<?php

$username = $_SESSION['username'];
$sql = "SELECT id_usuario FROM credenciales WHERE usuario = '$username';";
$result = mysqli_query($conn, $sql);
$psicologo = mysqli_fetch_assoc($result);
$cedulaPsicologo = $psicologo['id_usuario'];

//echo "$cedulaPsicologo";

// Consulta para obtener las preguntas
$sql = "SELECT idPregunta, pregunta FROM preguntas";
$result = $conn->query($sql);

// Consulta para obtener los pacientes
$sql_pacientes = "SELECT idPaciente, Nombre, ApPaterno, ApMaterno FROM paciente";
$result_pacientes = $conn->query($sql_pacientes);


if ($result->num_rows > 0 && $result_pacientes->num_rows > 0) {
    echo "<form action='../../modelo/GestionPreguntas/procesar_preguntas.php' method='post'>";

    // Cuadro desplegable para seleccionar el paciente
    echo "<label for='id_paciente'>Seleccionar Paciente:</label>";
    echo "<select name='id_paciente' idPaciente='id_paciente'>";
    while($row_paciente = $result_pacientes->fetch_assoc()) {
        echo "<option value='" . $row_paciente["idPaciente"] . "'>" . $row_paciente["Nombre"] . " " . $row_paciente["ApPaterno"] . " " . $row_paciente["ApMaterno"] . "</option>";
    }
    echo "</select><br><br>";
    echo "<table border='1'>";
    echo "<tr><th>Pregunta</th><th>Seleccionar</th></tr>";


    // Mostrar las preguntas en la tabla
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["pregunta"] . "</td>";
        echo "<td><input type='checkbox' name='preguntas_seleccionadas[]' value='" . $row["idPregunta"] . "'></td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "<input type='submit' value='Enviar'>";
    echo "</form>";
} else {
    echo "No se encontraron preguntas o Pacientes para asignar.";
}

$conn->close();
?>