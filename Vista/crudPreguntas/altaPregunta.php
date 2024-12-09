<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'Psicólogo') {
    header("Location: ../../login.php");
    exit();
}
include '../includes/headerregresar.php';

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar pregunta</title>
    <link rel="stylesheet" href="../Estilos/stylesForAddPAc.css">
</head>
<body>
    <h2>Agregar una nueva pregunta</h2>
<a href="consultaPacientes.php"></a>
    <form method="post" action="../../Modelo/GestionPreguntas/crearPregunta.php" class="form">
        <label>Pregunta:</label>
        <input type="text" name="pregunta" required><br><br>

        <input type="submit" value="Agregar Pregunta">
    </form>
</body>
</html>
